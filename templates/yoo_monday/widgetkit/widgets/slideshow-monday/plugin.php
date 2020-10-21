<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

return array(

    'name' => 'widget/slideshow-monday',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'slideshow-monday',
        'label' => 'Slideshow Monday',
        'core'  => false,
        'icon'  => 'plugins/widgets/slideshow-monday/widget.svg',
        'view'  => 'plugins/widgets/slideshow-monday/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'fields' => array(
            array('name' => 'tags')
        ),
        'settings' => array(
            'panel'              => 'box',
            'slidenav'           => 'default',
            'thumbnail_height'   => '150',
            'nav_contrast'       => true,
            'animation'          => 'fade',
            'slices'             => '15',
            'duration'           => '500',
            'autoplay'           => false,
            'interval'           => '3000',
            'autoplay_pause'     => true,
            'kenburns'           => false,
            'kenburns_animation' => '',
            'kenburns_duration'  => '15',
            'min_height'         => '300',

            'media'              => true,
            'image_width'        => 'auto',
            'image_height'       => 'auto',

            'title'              => true,
            'content'            => true,
            'title_size'         => 'h3',
            'content_size'       => '',
            'link'               => true,
            'link_style'         => 'button-arrow',
            'link_text'          => 'Read more',

            'link_target'        => false,
            'class'              => ''
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {

        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('slideshow-monday.edit', 'plugins/widgets/slideshow-monday/views/edit.php', true);
        }

    )

);
