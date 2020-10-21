<?php

namespace YOOtheme\Builder\Joomla\Source\Type;

use YOOtheme\Builder\Joomla\Source\UserHelper;
use YOOtheme\Builder\Source;

class UserType
{
    /**
     * @param Source $source
     *
     * @return array
     */
    public function __invoke(Source $source)
    {
        $fields = [

            'name' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Name',
                    'filters' => ['limit'],
                ],
            ],

            'username' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Username',
                    'filters' => ['limit'],
                ],
            ],

            'email' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Email',
                    'filters' => ['limit'],
                ],
            ],

            'registerDate' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Registered',
                    'filters' => ['date'],
                ],
            ],

            'lastvisitDate' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Last Visit Date',
                    'filters' => ['date'],
                ],
            ],

            'link' => [
                'type' => 'String',
                'metadata' => [
                    'label' => 'Link',
                ],
            ],

            'field' => [
                'type' => 'UserFields',
                'metadata' => [
                    'label' => 'Fields',
                ],
            ],

        ];

        $metadata = [
            'type' => true,
            'label' => 'User',
        ];

        $resolvers = $source->mapResolvers($this);

        return compact('fields', 'resolvers', 'metadata');
    }

    public function link($user)
    {
        return UserHelper::getContactLink($user->id);
    }

    public function field($user)
    {
        return $user;
    }
}
