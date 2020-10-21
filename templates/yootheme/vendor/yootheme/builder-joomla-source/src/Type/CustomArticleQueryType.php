<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use YOOtheme\Builder\Joomla\Source\ArticleHelper;
use YOOtheme\Builder\Source;

class CustomArticleQueryType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'customArticle' => [
                'type' => 'Article',
                'args' => [
                    'id' => [
                        'type' => 'String',
                    ],
                ],
                'metadata' => [
                    'label' => 'Custom Article',
                    'group' => 'Custom',
                    'fields' => [
                        'id' => [
                            'label' => 'Article',
                            'type' => 'select-item',
                            'labels' => ['type' => 'Article'],
                        ],
                    ],
                ],
            ],

        ];

        $resolvers = $source->mapResolvers($this);

        return compact('fields', 'resolvers');
    }

    public function customArticle($root, array $args)
    {
        $args += ['id' => 0];

        if ($articles = ArticleHelper::get($args['id'])) {
            return $articles[0];
        }
    }
}
