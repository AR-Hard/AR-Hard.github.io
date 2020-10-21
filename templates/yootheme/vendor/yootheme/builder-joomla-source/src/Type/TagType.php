<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use YOOtheme\Builder\Source;

class TagType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'title' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Title',
                    'filters' => ['limit'],
                ],
            ],

            'description' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Description',
                    'filters' => ['limit'],
                ],
            ],

            'hits' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Hits',
                ],
            ],

            'link' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Link',
                ],
            ],

        ];

        $metadata = [
            'type' => true,
            'label' => 'Tag',
        ];

        $resolvers = $source->mapResolvers($this);

        return compact('fields', 'resolvers', 'metadata');
    }

    public function link($tag)
    {
        \JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

        return \TagsHelperRoute::getTagRoute("{$tag->tag_id}:{$tag->alias}");
    }
}
