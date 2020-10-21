<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

return array(

    'name' => 'widget/grid-monday',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'   => 'grid-monday',
        'label'  => 'Grid Monday',
        'core'   => false,
        'icon'   => 'plugins/widgets/grid-monday/widget.svg',
        'view'   => 'plugins/widgets/grid-monday/views/widget.php',
        'item'   => array('title', 'content', 'media'),
        'fields' => array(
            array('name' => 'tags')
        ),
        'settings' => array(
            'gutter'              => 'default',
            'columns'             => '1',
            'columns_small'       => 0,
            'columns_medium'      => 0,
            'columns_large'       => 0,
            'columns_xlarge'      => 0,
            'panel'               => 'box',
            'panel_link'          => false,
            'animation'           => 'none',

            'media'               => true,
            'image_width'         => 'auto',
            'image_height'        => 'auto',
            'media_alternate'     => false,
            'content_align'       => true,
            'media_overlay'       => 'icon',
            'overlay_animation'   => 'fade',
            'media_animation'     => 'scale',

            'title'               => true,
            'content'             => true,
            'social_buttons'      => true,
            'title_size'          => 'panel',
            'text_align'          => 'left',
            'link'                => true,
            'link_style'          => 'button-arrow',
            'link_text'           => 'Read more',
            'badge'               => true,
            'badge_style'         => 'badge',
            'badge_position'      => 'panel',

            'link_target'         => false,
            'class'               => ''
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {

        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('grid-monday.edit', 'plugins/widgets/grid-monday/views/edit.php', true);
        }

    )

);
