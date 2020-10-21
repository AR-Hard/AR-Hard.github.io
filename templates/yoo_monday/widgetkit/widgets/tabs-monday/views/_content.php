<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// Title Size
switch ($settings['title_size']) {
    case 'panel':
        $title_size = 'uk-panel-title';
        break;
    case 'large':
        $title_size = 'uk-heading-large uk-margin-top-remove';
        break;
    case 'article':
        $title_size = 'uk-article-title uk-margin-top-remove';
        break;
    default:
        $title_size = 'uk-' . $settings['title_size'] . ' uk-margin-top-remove';
}

// Content Width
$content_width = ($settings['content_width']) ? 'uk-width-large-' . $settings['content_width'] : '';

// Content Position
$content_position = ($settings['content_position'] && $settings['content_width']) ? $settings['content_position'] . $settings['content_width'] : '';

// Link Style
switch ($settings['link_style']) {
    case 'button':
        $link_style = 'uk-button';
        break;
    case 'primary':
        $link_style = 'uk-button uk-button-primary';
        break;
    case 'button-large':
        $link_style = 'uk-button uk-button-large';
        break;
    case 'primary-large':
        $link_style = 'uk-button uk-button-large uk-button-primary';
        break;
    case 'button-link':
        $link_style = 'uk-button uk-button-link';
        break;
    case 'button-arrow':
        $link_style = 'tm-button-arrow';
        break;
    default:
        $link_style = '';
}

// Link Target
$link_target = ($settings['link_target']) ? ' target="_blank"' : '';

// Contrast
$contrast = $settings['contrast'] ? 'uk-contrast' : '';

// Overlay background
$background = $settings['background'] ? 'uk-overlay-background' : '';

?>

<ul id="wk-<?php echo $settings['id']; ?>" class="uk-switcher uk-flex" data-uk-check-display>
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

        // Media
        $attrs  = array('class' => 'uk-invisible');
        $width  = $item['media.width'];
        $height = $item['media.height'];

        if ($item->type('media') == 'image') {
            $attrs['alt'] = strip_tags($item['title']);

            $width  = ($settings['image_width'] != 'auto') ? $settings['image_width'] : $width;
            $height = ($settings['image_height'] != 'auto') ? $settings['image_height'] : $height;
        }

        $attrs['width']  = ($width) ? $width : '';
        $attrs['height'] = ($height) ? $height : '';

        if (($item->type('media') == 'image') && ($settings['image_width'] != 'auto' || $settings['image_height'] != 'auto')) {
            $media = $item->thumbnail('media', $width, $height, $attrs);
        } else {
            $media = $item->media('media', $attrs);
        }

        if ($item->get('media')) {
            if ($img = $app['image']->create($item->get('media'))) {
                $style = 'background-image: url(' . $img->getURL() . ');';
            }
            else {
                $style = 'background-image: url(' . $item['media'] . ');';
            }
        }


        ?>

        <li class="uk-flex uk-flex-item-1">

            <div class="uk-flex-item-1 uk-position-relative <?php echo $tag_class; ?>" <?php if ($item['media'] && $settings['media']) echo 'style="background-size: cover; ' . $style . '"'; ?>>

                <?php echo $media; ?>

                <div class="uk-overlay-panel">

                        <div class="tm-overlay-content  <?php echo $content_width; ?> <?php echo $content_position; ?> <?php echo $contrast; ?> <?php echo $background; ?>">

                            <?php if ($tag_name) : ?>
                                <p class="uk-badge"><?php echo $tag_name; ?></p>
                            <?php elseif ($item['tags']) : ?>
                                <p class="uk-badge"><?php echo implode($item['tags'], ',') ?></p>
                            <?php endif; ?>

                            <?php if ($settings['title']) : ?>
                            <h5 class="<?php echo $title_size; ?>"><?php echo $item['title']; ?></h5>
                            <?php endif; ?>

                            <div class="uk-margin">
                                <?php echo $item['content']; ?>
                            </div>

                            <?php if ($settings['link']) : ?>
                                <p class="uk-margin-bottom-remove uk-margin-large-top"><a<?php if($link_style) echo ' class="' . $link_style . '"'; ?> href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>><?php echo $app['translator']->trans($settings['link_text']); ?></a></p>
                            <?php endif; ?>

                        </div>

                </div>

            </div>
        </li>
    <?php endforeach; ?>
</ul>
