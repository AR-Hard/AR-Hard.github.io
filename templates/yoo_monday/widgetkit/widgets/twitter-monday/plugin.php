<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

return array(

    'name' => 'widget/twitter-monday',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'twitter-monday',
        'label' => 'Twitter Monday',
        'core'  => false,
        'icon'  => 'plugins/widgets/twitter-monday/widget.svg',
        'view'  => 'plugins/widgets/twitter-monday/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'settings' => array(

            'media'             => true,
            'image_width'       => 'auto',
            'image_height'      => 'auto',

            'title_size'        => 'default',
            'title_truncate'    => '',
            'link'              => true,
            'link_color'        => 'link',
            'link_text'         => 'Open in Twitter',

            'link_target'       => false,
            'class'             => '',
            'subtitle'          => 'Tweets of the day'
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {
        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('twitter-monday.edit', 'plugins/widgets/twitter-monday/views/edit.php', true);
        }

    )

);
