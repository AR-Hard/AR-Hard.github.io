<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

/*
 * Generate 3-column layout
 */
$config          = $this['config'];
$sidebars        = $config->get('sidebars', array());
$columns         = array('main' => array('width' => 60, 'alignment' => 'right'));
$sidebar_classes = '';

$gcf = function($a, $b = 60) use(&$gcf) {
    return (int) ($b > 0 ? $gcf($b, $a % $b) : $a);
};

$fraction = function($nominator, $divider = 60) use(&$gcf) {
    return $nominator / ($factor = $gcf($nominator, $divider)) .'-'. $divider / $factor;
};

foreach ($sidebars as $name => $sidebar) {
    if (!$this['widgets']->count($name)) {
        unset($sidebars[$name]);
        continue;
    }

    $columns['main']['width'] -= @$sidebar['width'];
    $sidebar_classes .= " tm-{$name}-".@$sidebar['alignment'];
}

if ($count = count($sidebars)) {
    $sidebar_classes .= ' tm-sidebars-'.$count;
}

$columns += $sidebars;
foreach ($columns as $name => &$column) {

    $column['width']     = isset($column['width']) ? $column['width'] : 0;
    $column['alignment'] = isset($column['alignment']) ? $column['alignment'] : 'left';
    $column['class']     = sprintf('tm-%s uk-width-large-%s%s', $name, $fraction($column['width']), ' uk-flex-order-'.($column['alignment'] == 'left' ? 'first' : 'last'));

}

/*
 * Add grid classes
 */
$positions = array_keys($config->get('grid', array()));
$displays  = array('small', 'medium', 'large');
$grid_classes = array();
$display_classes = array();
foreach ($positions as $position) {

    $grid_classes[$position] = array();
    $grid_classes[$position][] = "tm-{$position} uk-grid";
    $display_classes[$position][] = '';

    if ($this['config']->get("grid.{$position}.divider", false)) {
        $grid_classes[$position][] = 'uk-grid-divider';
    }

    if ($gutter = $this['config']->get("grid.{$position}.gutter", '')) {
        $grid_classes[$position][] = 'uk-grid-' . $gutter;
    }

    $widgets = $this['widgets']->load($position);

    foreach($displays as $display) {
        if (!array_filter($widgets, function($widget) use ($config, $display) { return (bool) $config->get("widgets.{$widget->id}.display.{$display}", true); })) {
            $display_classes[$position][] = "uk-hidden-{$display}";
        }
    }

    $display_classes[$position] = implode(" ", $display_classes[$position]);
    $grid_classes[$position] = implode(" ", $grid_classes[$position]);

}

/*
 * Block Footer settings
 */

 $footer_padding = $config->get("footer-padding");
 $footer_background = $config->get("footer-background");

/*
 * Navbar settings
 */
$navbar_sticky  = '';
$navbar_overlay = '';
if ($this['config']->get('navbar_sticky', 0)) {
    $navbar_sticky = 'data-uk-sticky="{media: 768}"';
}
if ($this['config']->get('dropdown_overlay')) {
    $navbar_overlay = 'data-uk-dropdown-overlay="{cls: \'tm-dropdown-overlay\'}"';
}

/*
 * Add body classes
 */

// Tags
$pageInfo   = $this['system']->getPageInfo(array('tags'));
$tag_colors = $config->get('tag_colors', array());;
$tag_class  = '';
$tag_name   = '';

if ($pageInfo) {
    foreach ($pageInfo['tags'] as $name) {
        foreach ($tag_colors as $tag_color) {
            if (in_array(strtolower($name), array_map('strtolower', $tag_color))) {
                $tag_class = $tag_color['color'] . '-nav';
            }
        }
    }
}

$body_classes = array();
$body_classes[] = $sidebar_classes;
$body_classes[] = $tag_class ? $tag_class : '';
$body_classes[] = $this['system']->isBlog() ? 'tm-isblog' : 'tm-noblog';
$body_classes[] = $config->get('page_class');

$config->set('body_classes', trim(implode($body_classes, ' ')));

/*
 * Add social buttons
 */

$body_config = array();
$body_config['twitter']  = (int) $config->get('twitter', 0);
$body_config['plusone']  = (int) $config->get('plusone', 0);
$body_config['facebook'] = (int) $config->get('facebook', 0);
$body_config['style']    = $config->get('style');

$config->set('body_config', json_encode($body_config));

/*
 * Add assets
 */

// add css
$this['asset']->addFile('css', 'css:theme.css');
$this['asset']->addFile('css', 'css:custom.css');

// add scripts
$this['asset']->addFile('js', 'js:uikit.js');
$this['asset']->addFile('js', 'warp:vendor/uikit/js/components/autocomplete.js');
$this['asset']->addFile('js', 'warp:vendor/uikit/js/components/search.js');
$this['asset']->addFile('js', 'warp:vendor/uikit/js/components/tooltip.js');
$this['asset']->addFile('js', 'warp:vendor/uikit/js/components/sticky.js');
$this['asset']->addFile('js', 'js:social.js');
$this['asset']->addFile('js', 'js:theme.js');

// add animated background
if ($config->get('tm_background')) {
    $this['asset']->addFile('js', 'js:'. $config->get('tm_background'));
}


// internet explorer
if ($this['useragent']->browser() == 'msie') {
    $head[] = sprintf('<!--[if IE 8]><link rel="stylesheet" href="%s"><![endif]-->', $this['path']->url('css:ie8.css'));
    $head[] = sprintf('<!--[if lte IE 8]><script src="%s"></script><![endif]-->', $this['path']->url('js:html5.js'));
}

if (isset($head)) {
    $this['template']->set('head', implode("\n", $head));
}
