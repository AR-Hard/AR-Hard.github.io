<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use YOOtheme\Builder\Source;

class ValueFieldType
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
