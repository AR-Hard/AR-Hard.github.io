<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

/**
* @package   yoo_sun
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// Animation
$animation = ($settings['animation'] != 'none') ? ',animation:\'' . $settings['animation'] . '\'' : '';

// Tab Position
$tab_position = 'uk-tab-' . $settings['tab_position'];

$nav_size = 'uk-' . $settings['nav_size'] . ' uk-margin-top-remove';

?>

<ul class="uk-tab <?php echo $tab_position; ?>" data-uk-tab="{connect:'#wk-<?php echo $settings['id']; ?>'<?php echo $animation; ?>}">
    <?php foreach ($items as $item) : ?>
        <?php

        $tag_colors = $settings['tags'];
        $tag_class  = '';
        $tag_name   = '';


        if (is_array($item['tags'])) {
            foreach ($item['tags'] as $name) {
                foreach ($tag_colors as $tag_color) {
                    if (in_array(strtolower($name), array_map('strtolower', $tag_color))) {
                        $tag_class = $tag_color['color'];
                        $tag_name = $name;
                    }
                }
            }
        }

        ?>

        <li class="<?php echo $tag_class ?>">
            <a class="" href="">
                <?php if ($tag_name) : ?>
                    <span class="uk-badge"><?php echo $tag_name; ?></span>
                <?php elseif ($item['tags']) : ?>
                    <span class="uk-badge"><?php echo implode($item['tags'], ',') ?></span>
                <?php endif; ?>

                <h3 class="<?php echo $nav_size; ?>"><?php echo $item['title']; ?></h3>
            </a>
        </li>

    <?php endforeach; ?>
</ul>
