<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use YOOtheme\Builder\Source;

class ArticlesQueryType
{
    /**
     * @var array
     */
    public $fields;

    /**
     * @var array
     */
    public $resolvers;

    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'articles' => [
                'type' => [
                    'listOf' => 'Article',
                ],
                'args' => [
                    'offset' => [
                        'type' => 'Int',
                    ],
                    'limit' => [
                        'type' => 'Int',
                    ],
                ],
                'metadata' => [
                    'label' => 'Articles',
                    'view' => ['com_content.category', 'com_content.featured'],
                    'group' => 'Page',
                    'fields' => [
                        '_offset' => [
                            'description' => 'Set the starting point and limit the number of articles.',
                            'type' => 'grid',
                            'width' => '1-2',
                            'fields' => [
                                'offset' => [
                                    'label' => 'Start',
                                    'type' => 'number',
                                    'default' => 0,
                                    'modifier' => 1,
                                    'attrs' => [
                                        'min' => 1,
                                        'required' => true,
                                    ],
                                ],
                                'limit' => [
                                    'label' => 'Quantity',
                                    'type' => 'limit',
                                    'attrs' => [
                                        'placeholder' => 'No limit',
                                        'min' => 0,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $resolvers = $source->mapResolvers($this);

        return compact('fields', 'resolvers');
    }

    public function articles($root, array $args)
    {
        $args += [
            'offset' => 0,
            'limit' => null,
        ];

        if (isset($root['items'])) {

            $items = $root['items'];

            if ($args['offset'] || $args['limit']) {
                $items = array_slice($items, (int) $args['offset'], (int) $args['limit'] ?: null);
            }

            return $items;
        }
    }
}
