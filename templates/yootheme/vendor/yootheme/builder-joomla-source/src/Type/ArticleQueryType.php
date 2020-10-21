<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use YOOtheme\Builder\Source;

class ArticleQueryType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'article' => [
                'type' => 'Article',
                'metadata' => [
                    'label' => 'Article',
                    'view' => ['com_content.article'],
                    'group' => 'Page',
                ],
            ],

        ];

        $resolvers = $source->mapResolvers($this);

        return compact('fields', 'resolvers');
    }

    public function article($root)
    {
        if (isset($root['article'])) {
            return $root['article'];
        }

        if (isset($root['item'])) {
            return $root['item'];
        }
    }
}
