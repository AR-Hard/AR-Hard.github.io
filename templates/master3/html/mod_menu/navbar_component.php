<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu.navbar
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Filter\OutputFilter;

$attributes = [];

if ($item->anchor_title) {
    $attributes['title'] = $item->anchor_title;
}

if ($item->anchor_css) {
    $attributes['class'] = $item->anchor_css;
}

if ($item->anchor_rel) {
    $attributes['rel'] = $item->anchor_rel;
}

$linktype = (int)$item->level === $firstLevel ? '<span class="uk-display-block">' : '<span class="uk-flex uk-flex-middle">';

if ($item->menu_image) {
    $linktype .= (int)$item->level === $firstLevel ? '<span class="uk-flex uk-flex-middle">' : '';
    
    if ($item->menu_image_css) {
        $image_attributes['class'] = $item->menu_image_css;
        $linktype .= HTMLHelper::_('image', $item->menu_image, $item->title, $image_attributes);
    } else {
        $linktype .= HTMLHelper::_('image', $item->menu_image, $item->title);
    }

    if ($item->params->get('menu_text', 1)) {
        $linktype .= '<span class="uk-display-inline-block uk-margin-small-left">' . $item->title . '</span>';
    }
    
    $linktype .= (int)$item->level === $firstLevel ? '</span>' : '';
} else {
    $linktype .= $item->title;
}

if ((int)$item->level === $firstLevel && $miParams->subtitle) {
    $linktype .= '<span class="uk-display-block uk-navbar-subtitle">' . $miParams->subtitle . '</span>';
}

$linktype .= '</span>';

if ($item->browserNav == 1) {
    $attributes['target'] = '_blank';
} elseif ($item->browserNav == 2) {
    $options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';
    $attributes['onclick'] = "window.open( this.href, 'targetWindow', '" . $options . "' ); return false;";
}

echo HTMLHelper::_('link', OutputFilter::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $linktype, $attributes);
