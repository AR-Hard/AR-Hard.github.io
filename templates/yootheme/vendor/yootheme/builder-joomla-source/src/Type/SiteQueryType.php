<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use Joomla\CMS\Factory;
use YOOtheme\Builder\Source;

class SiteQueryType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'site' => [
                'type' => 'Site',
                'metadata' => [
                    'label' => 'Site',
                ],
            ],

        ];

        $resolvers = $source->mapResolvers($this);

        return compact('fields', 'resolvers');
    }

    public function site()
    {
        $app = Factory::getApplication();
        $config = Factory::getConfig();

        return [
            'title' => $config->get('sitename'),
            'page_title' => $app->getParams()->get('page_title'),
        ];
    }
}
