<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$warp = include(__DIR__.'/../../../../warp.php');

// Id
$settings['id'] = substr(uniqid(), -3);

// tag <> clolor assignment
$settings['tags'] = $warp['config']->get('tag_colors', array());

// min-height
$style = $settings['min_height'] ? 'style="min-height: ' . $settings['min_height'] . 'px;"' : '';

// Panel
$panel = 'uk-panel';
if ($settings['panel'] == 'box') {
    $panel .= ' uk-panel-box';
}

?>

<div class="tm-tabs-monday <?php echo $panel; ?> uk-padding-remove">
    <div class="uk-grid uk-grid-collapse uk-grid-match <?php echo $settings['class']; ?>" data-uk-grid-margin>

        <div class="uk-width-medium-1-4 <?php echo $settings['tab_position'] == 'right' ? 'uk-flex-order-last-medium' : ''; ?>">
            <?php echo $this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_nav.php', compact('items', 'settings')); ?>
        </div>

        <div class="uk-width-medium-3-4" <?php echo $style ?>>
            <?php echo $this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_content.php', compact('items', 'settings')); ?>
        </div>

    </div>
</div>
