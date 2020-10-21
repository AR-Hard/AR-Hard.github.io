<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// Link Target
$link_target = ($settings['link_target']) ? ' target="_blank"' : '';

// Link Color
$link_color = ($settings['link_color'] != 'link') ? 'uk-link-' . $settings['link_color'] : '';

?>

<div class="uk-position-relative" data-uk-slideshow>

    <ul class="uk-slideshow tm-twitter-monday">
        <?php foreach ($items as $item) :

            // Media Type
            $attrs  = array('class' => '');
            $width  = $item['media.width'];
            $height = $item['media.height'];

            if ($item->type('media') == 'image') {
                $attrs['alt'] = strip_tags($item['title']);

                $width  = ($settings['image_width'] != 'auto') ? $settings['image_width'] : '';
                $height = ($settings['image_height'] != 'auto') ? $settings['image_height'] : '';
            }

            if ($item->type('media') == 'video') {
                $attrs['class'] = 'uk-responsive-width';
                $attrs['controls'] = true;
            }

            if ($item->type('media') == 'iframe') {
                $attrs['class'] = 'uk-responsive-width';
            }

            $attrs['width']  = ($width) ? $width : '';
            $attrs['height'] = ($height) ? $height : '';

            if (($item->type('media') == 'image') && ($settings['image_width'] != 'auto' || $settings['image_height'] != 'auto')) {
                $media = $item->thumbnail('media', $width, $height, $attrs);
            } else {
                $media = $item->media('media', $attrs);
            }

            $title = $item['title'];
            if ($item['link']) {
                $title = '<a class="uk-link-reset" href="'.$item->escape('link').'" '.$link_target.'>'.$title.'</a>';
            }

        ?>
        <li>
            <div class="uk-panel uk-panel-box uk-flex uk-flex-column uk-height-1-1 uk-text-center">

                <i class="uk-icon uk-icon-medium uk-icon-twitter"></i>

                <div class="uk-flex-item-auto uk-margin-large">
                    <?php if ($item['title']) : ?>
                    <blockquote>
                        <?php echo $item['content']; ?>
                    </blockquote>
                    <?php endif; ?>

                    <?php if ($media && $settings['media']) : ?>
                        <?php echo $media; ?>
                    <?php endif; ?>

                    <?php if ($item['link'] && $settings['link']) : ?>
                    <p>
                        <a class="<?php echo $link_color; ?>" href="<?php echo $item->escape('link'); ?>" <?php echo $link_target; ?>><?php echo $settings['link_text']; ?></a>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="tm-panel-teaser-bottom uk-text-center">
                    <?php if ($settings['subtitle'] !== '') : ?>
                    <span class="tm-twitter-subtitle"><?php echo $settings['subtitle']; ?></span>
                    <?php endif; ?>

                    <?php if ($item['title']) : ?>
                    <h4 class="tm-twitter-title uk-margin-small-top"><?php echo $title; ?></h4>
                    <?php endif; ?>
                </div>

            </div>
        </li>
        <?php endforeach; ?>
    </ul>

    <div class="uk-overlay-panel uk-overlay-bottom">
        <ul class="uk-dotnav uk-flex-center">
            <?php foreach ($items as $i => $item) : ?>
            <li data-uk-slideshow-item="<?php echo $i; ?>" class=""><a href="#">Slideshow</a></li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>
