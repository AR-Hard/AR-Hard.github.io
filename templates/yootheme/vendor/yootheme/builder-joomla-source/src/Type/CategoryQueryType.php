<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use YOOtheme\Builder\Source;

class CategoryQueryType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'category' => [
                'type' => 'Category',
                'metadata' => [
                    'label' => 'Category',
                    'view' => ['com_content.category'],
                    'group' => 'Page',
                ],
            ],

        ];

        $resolvers = $source->mapResolvers($this);

        return compact('fields', 'resolvers');
    }

    public function category($root)
    {
        if (isset($root['category'])) {
            return $root['category'];
        }
    }
}
