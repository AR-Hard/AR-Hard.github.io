<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use YOOtheme\Builder\Joomla\Source\ArticleHelper;
use YOOtheme\Builder\Source;
use YOOtheme\Str;

class FieldsType
{
    /**
     * @var string
     */
    protected $context;

    /**
     * @var Source
     */
    protected $source;

    /**
     * Constructor.
     *
     * @param string $context
     */
    public function __construct($context)
    {
        $this->context = $context;
    }

    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $this->source = $source;

        if (!class_exists(\FieldsHelper::class)) {
            return;
        }

        $fields = [];
        $resolvers = [];

        foreach (\FieldsHelper::getFields($this->context) as $field) {

            if ($field->state != 1) {
                continue;
            }

            $config = [
                'type' => 'String',
                'metadata' => [
                    'label' => $field->title,
                    'group' => $field->group_title,
                ],
            ];

            $fields[$field->name] = is_callable($load = [$this, "loadField{$field->type}"]) ? $load($field, $config) : $this->loadField($field, $config);
            $resolvers[$field->name] = function ($item) use ($field) {

                if (!$field = $this->getField($item, $field->name)) {
                    return;
                }

                return is_callable($resolve = [$this, "resolveField{$field->type}"]) ? $resolve($field) : $this->resolveField($field, $field->rawvalue);
            };
        }

        return compact('fields', 'resolvers');
    }

    protected function loadField($field, array $config)
    {
        if ($field->fieldparams->get('multiple')) {
            return ['type' => ['listOf' => 'ValueField']] + $config;
        }

        return $config;
    }

    protected function resolveField($field, $value)
    {
        if ($field->fieldparams->exists('multiple')) {
            $value = (array) $value;
            if ($field->fieldparams['multiple']) {
                return array_map(function ($value) {
                    return is_scalar($value) ? compact('value') : $value;
                }, $value);
            } else {
                return array_shift($value);
            }
        }

        return $field->rawvalue;
    }

    protected function loadFieldText($field, array $config)
    {
        return array_merge_recursive($config, ['metadata' => ['filters' => ['limit']]]);
    }

    protected function loadFieldTextarea($field, array $config)
    {
        return array_merge_recursive($config, ['metadata' => ['filters' => ['limit']]]);
    }

    protected function loadFieldEditor($field, array $config)
    {
        return array_merge_recursive($config, ['metadata' => ['filters' => ['limit']]]);
    }

    protected function loadFieldCalendar($field, array $config)
    {
        return array_merge_recursive($config, ['metadata' => ['filters' => ['date']]]);
    }

    protected function loadFieldUser($field, array $config)
    {
        return ['type' => 'User'] + $config;
    }

    protected function resolveFieldUser($field)
    {
        return Factory::getUser($field->rawvalue);
    }

    protected function loadFieldArticles($field, array $config)
    {
        $multiple = $field->fieldparams->get('multiple');

        return ['type' => $multiple ? ['listOf' => 'Article'] : 'Article'] + $config;
    }

    protected function resolveFieldArticles($field)
    {
        return $this->resolveField($field, ArticleHelper::get($field->rawvalue));
    }

    protected function loadFieldRepeatable($field, array $config)
    {
        $name = Str::camelCase(['Field', $field->name], true);
        $fields = [];

        foreach ((array) $field->fieldparams->get('fields') as $params) {

            // TODO Sluggify $params->fieldname

            $fields[$params->fieldname] = [
                'type' => 'String',
                'name' => $params->fieldname,
                'metadata' => [
                    'label' => $params->fieldname,
                    'group' => $field->group_title,
                ],
            ];

        }

        $this->source->addType($name, FieldType::class, compact('fields'));

        return ['type' => ['listOf' => $name]] + $config;
    }

    protected function resolveFieldRepeatable($field)
    {
        return array_values((array) json_decode($field->rawvalue));
    }

    protected function loadFieldList($field, array $config)
    {
        return $this->loadFieldSelect($field, $config, $field->fieldparams->get('multiple'));
    }

    protected function resolveFieldList($field)
    {
        return $this->resolveFieldSelect($field, $field->fieldparams->get('multiple'));
    }

    protected function loadFieldCheckboxes($field, array $config)
    {
        return $this->loadFieldSelect($field, $config, true);
    }

    protected function resolveFieldCheckboxes($field)
    {
        return $this->resolveFieldSelect($field, true);
    }

    protected function loadFieldRadio($field, array $config)
    {
        return $this->loadFieldSelect($field, $config);
    }

    protected function resolveFieldRadio($field)
    {
        return $this->resolveFieldSelect($field);
    }

    protected function loadFieldSelect($field, array $config, $multiple = false)
    {
        return ['type' => $multiple ? ['listOf' => 'ChoiceField'] : 'ChoiceField'] + $config;
    }

    protected function resolveFieldSelect($field, $multiple = false)
    {
        $result = [];

        foreach ($field->fieldparams->get('options', []) as $option) {
            if ($multiple) {
                if (in_array($option->value, (array) $field->rawvalue ?: [])) {
                    $result[] = $option;
                }
            } elseif ($option->value === $field->rawvalue) {
                return $option;
            }
        }

        return $result;
    }

    protected function resolveFieldImagelist($field)
    {
        $root = ComponentHelper::getParams('com_media')->get('file_path', 'images') . "/{$field->fieldparams->get('directory')}";

        return $this->resolveField($field, array_map(function ($value) use ($root) {
            return "{$root}/{$value}";
        }, array_filter((array) $field->rawvalue, function ($value) {
            return $value && $value != -1;
        })));
    }

    protected function resolveFieldUsergrouplist($field)
    {
        return $this->resolveField($field, array_intersect_key(
            static::getUserGroups(),
            array_flip((array) $field->rawvalue)
        ));
    }

    protected function getField($item, $name)
    {
        foreach (\FieldsHelper::getFields($this->context, $item) as $field) {
            if ($field->name === $name) {
                return $field;
            }
        }
    }

    protected static function getUserGroups()
    {
        \JLoader::register('UsersHelper', JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php');

        $data = [];

        foreach (\UsersHelper::getGroups() as $group) {
            $data[$group->value] = Text::_(preg_replace('/^(- )+/', '', $group->text));
        }

        return $data;
    }

    protected function loadFieldSql($field, array $config)
    {
        return ['type' => $field->fieldparams->get('multiple') ? ['listOf' => 'SqlField'] : 'SqlField'] + $config;
    }

    protected function resolveFieldSql($field)
    {
        $multiple = $field->fieldparams->get('multiple');

        $value = $field->value;

        if ($value === '') {
            return;
        }

        $db = Factory::getDbo();
        $condition = '';

        foreach ((array) $value as $v) {
            if ($v) {
                $condition .= ', ' . $db->q($v);
            }
        }

        $query = $field->fieldparams->get('query', '');

        // Run the query with a having condition because it supports aliases
        $db->setQuery($query . ' having value in (' . trim($condition, ',') . ')');

        try {

            $items = $db->loadObjectlist();

            return $multiple
                ? $items
                : array_pop($items);

        } catch (\Exception $e) {
            return;
        }
    }
}
