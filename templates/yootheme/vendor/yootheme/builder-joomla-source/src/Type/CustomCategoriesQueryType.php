<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use Joomla\CMS\Categories\Categories;
use YOOtheme\Builder\Source;

class CustomCategoriesQueryType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'customCategories' => [
                'type' => [
                    'listOf' => 'Category',
                ],
                'args' => [
                    'catid' => [
                        'type' => 'String',
                    ],
                    'offset' => [
                        'type' => 'Int',
                    ],
                    'limit' => [
                        'type' => 'Int',
                    ],
                    'order' => [
                        'type' => 'String',
                    ],
                    'order_direction' => [
                        'type' => 'String',
                    ],
                ],
                'metadata' => [
                    'label' => 'Custom Categories',
                    'group' => 'Custom',
                    'fields' => [
                        'catid' => [
                            'label' => 'Parent Category',
                            'description' => 'Only categories from the selected parent category are loaded.',
                            'type' => 'select-category',
                            'default' => '0',
                            'root' => true,
                        ],
                        '_offset' => [
                            'description' => 'Set the starting point and limit the number of categories.',
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
                                    'default' => 10,
                                    'attrs' => [
                                        'min' => 1,
                                    ],
                                ],
                            ],
                        ],
                        '_order' => [
                            'type' => 'grid',
                            'width' => '1-2',
                            'fields' => [
                                'order' => [
                                    'label' => 'Order',
                                    'type' => 'select',
                                    'default' => 'ordering',
                                    'options' => [
                                        'Alphabetical' => 'title',
                                        'Category Order' => 'ordering',
                                        'Random' => 'rand',
                                    ],
                                ],
                                'order_direction' => [
                                    'label' => 'Direction',
                                    'type' => 'select',
                                    'default' => 'ASC',
                                    'options' => [
                                        'Ascending' => 'ASC',
                                        'Descending' => 'DESC',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],

        ];

        $resolvers = $source->mapResolvers($this, array_keys($fields));

        return compact('fields', 'resolvers');
    }

    public function customCategories($root, array $args)
    {
        if ($category = Categories::getInstance('content', ['countItems' => true])->get($args['catid'])) {

            $categories = $category->getChildren();

            if ($args['order'] === 'rand') {
                shuffle($categories);
            } elseif ($args['order']) {
                $prop = $args['order'] === 'ordering' ? 'lft' : $args['order'];
                usort($categories, function ($article, $other) use ($prop) {
                    return strcmp($article->$prop, $other->$prop);
                });
            }

            if ($args['offset'] || $args['limit']) {
                $categories = array_slice($categories, (int) $args['offset'], (int) $args['limit'] ?: null);
            }

            if ($args['order_direction'] === 'DESC') {
                $categories = array_reverse($categories);
            }

            return $categories;
        }
    }
}
