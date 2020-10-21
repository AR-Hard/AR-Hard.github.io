<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

class ArticleUrlsType
{
    /**
     * @return array
     */
    public function __invoke()
    {
        $fields = [

            'urla' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'URL A',
                ],
            ],

            'urlatext' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'URL A Text',
                    'filters' => ['limit'],
                ],
            ],

            'urlb' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'URL B',
                ],
            ],

            'urlbtext' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'URL B Text',
                    'filters' => ['limit'],
                ],
            ],

            'urlc' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'URL C',
                ],
            ],

            'urlctext' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'URL C Text',
                    'filters' => ['limit'],
                ],
            ],

        ];

        $resolver = function ($item, $args, $context, $info) {
            return $item->{$info->fieldName} ?: '';
        };

        $resolvers = [
            'urla' => $resolver,
            'urlb' => $resolver,
            'urlc' => $resolver,
        ];

        return compact('fields', 'resolvers');
    }
}
