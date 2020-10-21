<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use YOOtheme\Builder\Source;

class SqlFieldType
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
                'text' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Text',
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
