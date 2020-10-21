<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

return array(

    'name' => 'widget/list-monday',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'list-monday',
        'label' => 'List Monday',
        'core'  => false,
        'icon'  => 'plugins/widgets/list-monday/widget.svg',
        'view'  => 'plugins/widgets/list-monday/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'settings' => array(
            'list'              => 'line',

            'media'             => true,
            'image_width'       => 'auto',
            'image_height'      => 'auto',
            'media_align'       => 'left',
            'content_align'     => true,
            'media_border'      => 'none',

            'title'             => 'title',
            'title_size'        => 'default',
            'title_truncate'    => '',
            'link'              => true,
            'link_color'        => 'muted',

            'link_target'       => false,
            'class'             => ''
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {
        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('list-monday.edit', 'plugins/widgets/list-monday/views/edit.php', true);
        }

    )

);
