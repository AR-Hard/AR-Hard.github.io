<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use YOOtheme\Builder\Source;

class ChoiceFieldType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        return [
            'fields' => [
                'name' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Name',
                    ],
                ],
                'value' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Value',
                    ],
                ],
            ],
        ];
    }
}
