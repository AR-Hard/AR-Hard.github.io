<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

return array(

    'name' => 'widget/tabs-monday',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'tabs-monday',
        'label' => 'Tabs Monday',
        'core'  => false,
        'icon'  => 'plugins/widgets/tabs-monday/widget.svg',
        'view'  => 'plugins/widgets/tabs-monday/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'fields' => array(
            array('name' => 'tags')
        ),
        'settings' => array(
            'tab_position'      => 'right',
            'nav_size'          => 'h4',

            'panel'             => 'box',
            'content_width'     => '1-2',
            'content_position'  => '',
            'animation'         => 'none',
            'min_height'        => '300',

            'media'             => true,
            'image_width'       => 'auto',
            'image_height'      => 'auto',

            'title'             => true,
            'title_size'        => 'panel',
            'contrast'          => false,
            'background'        => false,
            'link'              => true,
            'link_style'        => 'button-link',
            'link_text'         => 'Continue reading',

            'link_target'       => false,
            'class'             => ''
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {

        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('tabs-monday.edit', 'plugins/widgets/tabs-monday/views/edit.php', true);
        }

    )

);
