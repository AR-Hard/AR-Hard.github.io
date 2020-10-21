<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

class CategoryParamsType
{
    /**
     * @return array
     */
    public function __invoke()
    {
        $fields = [

            'image' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Image',
                ],
            ],

            'image_alt' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Image Alt',
                    'filters' => ['limit'],
                ],
            ],

        ];

        return compact('fields');
    }
}
