<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use Joomla\CMS\Categories\Categories;
use YOOtheme\Builder\Source;

class CustomCategoryQueryType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'customCategory' => [
                'type' => 'Category',
                'args' => [
                    'id' => [
                        'type' => 'String',
                    ],
                ],
                'metadata' => [
                    'label' => 'Custom Category',
                    'group' => 'Custom',
                    'fields' => [
                        'id' => [
                            'label' => 'Category',
                            'type' => 'select-category',
                        ],
                    ],
                ],
            ],

        ];

        $resolvers = $source->mapResolvers($this, array_keys($fields));

        return compact('fields', 'resolvers');
    }

    public function customCategory($root, array $args)
    {
        return Categories::getInstance('content', ['countItems' => true])->get($args['id']);
    }
}
