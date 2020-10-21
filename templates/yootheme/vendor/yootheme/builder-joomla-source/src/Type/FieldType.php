<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

class FieldType
{
    /**
     * @var array
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function __invoke()
    {
        return $this->config;
    }
}
