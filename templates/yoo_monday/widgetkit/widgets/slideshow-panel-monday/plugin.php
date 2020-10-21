<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

return array(

    'name' => 'widget/slideshow-panel-monday',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'slideshow-panel-monday',
        'label' => 'Slideshow Panel Monday',
        'core'  => false,
        'icon'  => 'plugins/widgets/slideshow-panel-monday/widget.svg',
        'view'  => 'plugins/widgets/slideshow-panel-monday/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'fields' => array(
            array('name' => 'tags')
        ),
        'settings' => array(
            'panel'              => 'blank',
            'slidenav'           => 'top-right',
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
            'fullscreen'         => false,
            'min_height'         => '300',

            'media'              => true,
            'image_width'        => 'auto',
            'image_height'       => 'auto',
            'media_align'        => 'left',
            'media_width'        => '1-2',
            'media_breakpoint'   => 'medium',
            'content_align'      => true,

            'title'              => true,
            'content'            => true,
            'title_size'         => 'h3',
            'content_size'       => '',
            'text_align'        => 'left',
            'link'               => true,
            'link_style'         => 'button-arrow',
            'link_text'          => 'Read more',
            'badge'              => true,
            'badge_style'        => 'badge',

            'link_target'        => false,
            'class'              => ''
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {

        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('slideshow-panel-monday.edit', 'plugins/widgets/slideshow-panel-monday/views/edit.php', true);
        }

    )

);
