<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$warp = include(__DIR__.'/../../../../warp.php');

$settings['id'] = uniqid('wk-');

// tag <> clolor assignment
$settings['tag_colors'] = $warp['config']->get('tag_colors', array());

// JS Options
$options = array();
$options[] = ($settings['animation'] != 'fade') ? 'animation: \'' . $settings['animation'] . '\'' : '';
$options[] = ($settings['duration'] != '500') ? 'duration: ' . $settings['duration'] : '';
$options[] = ($settings['slices'] != '15') ? 'slices: ' . $settings['slices'] : '';
$options[] = ($settings['autoplay']) ? 'autoplay: true ' : '';
$options[] = ($settings['interval'] != '3000') ? 'autoplayInterval: ' . $settings['interval'] : '';
$options[] = ($settings['autoplay_pause']) ? '' : 'pauseOnHover: false';
if ($settings['kenburns'] && $settings['kenburns_duration']) {
    $kenburns_animation = ($settings['kenburns_animation']) ? ', kenburnsanimations: \'' . $settings['kenburns_animation'] . '\'' : '';
    $options[] = 'kenburns: \'' . $settings['kenburns_duration'] . 's\'' . $kenburns_animation;
}

$options = '{'.implode(',', array_filter($options)).'}';

// Title Size
switch ($settings['title_size']) {
    case 'large':
        $title_size = 'uk-heading-large';
        break;
    default:
        $title_size = 'uk-' . $settings['title_size'];
}

// Panel
$panel = 'uk-panel';
if ($settings['panel'] == 'box') {
    $panel .= ' uk-panel-box';
}

// Content Size
switch ($settings['content_size']) {
    case 'large':
        $content_size = 'uk-text-large';
        break;
    case 'h2':
    case 'h3':
    case 'h4':
        $content_size = 'uk-' . $settings['content_size'];
        break;
    default:
        $content_size = '';
}

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

// Position Relative
if ($settings['slidenav'] == 'default') {
    $position_relative = 'uk-slidenav-position';
} else {
    $position_relative = 'uk-position-relative';
}

// Custom Class
$class = $settings['class'] ? $settings['class'] : '';

?>

<div id="<?php echo $settings['id']; ?>" class="tm-slideshow-monday <?php echo $panel; ?> uk-padding-remove <?php echo $class; ?>" data-uk-slideshow="<?php echo $options; ?>">

    <div class="<?php echo $position_relative; ?>">

        <ul class="uk-slideshow">
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
                    $attrs['autoplay'] = true;
                    $attrs['loop']     = true;
                    $attrs['muted']    = true;
                    $attrs['class']   .= 'uk-cover-object uk-position-absolute';
                    $attrs['class']   .= ($item['media.poster']) ? ' uk-hidden-touch' : '';
                }

                $attrs['width']  = ($width) ? $width : '';
                $attrs['height'] = ($height) ? $height : '';

                if (($item->type('media') == 'image') && ($settings['image_width'] != 'auto' || $settings['image_height'] != 'auto')) {
                    $media = $item->thumbnail('media', $width, $height, $attrs);
                } else {
                    $media = $item->media('media', $attrs);
                }

                // Tags
                $tag_colors = $settings['tag_colors'];
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

            <li class="<?php echo $tag_class; ?>" style="min-height: <?php echo $settings['min_height']; ?>px;">

                <div class="tm-overlay uk-overlay-active uk-overlay-hover">

                <?php if ($item['media'] && $settings['media']) : ?>

                    <?php echo $media; ?>

                    <?php if ($item['media.poster']) : ?>
                    <div class="uk-cover-background uk-position-cover uk-hidden-notouch" style="background-image: url(<?php echo $item['media.poster'] ?>);"></div>
                    <?php endif ?>

                    <?php if (($item['title'] && $settings['title']) || ($item['content'] && $settings['content']) || ($item['link'] && $settings['link'])) : ?>
                    <div class="tm-overlay-panel uk-flex uk-flex-center uk-flex-middle">

                        <div class="tm-overlay-content uk-panel uk-panel-box uk-overlay-fade">

                            <?php if ($item['tags']) : ?>
                            <span class="uk-badge"><?php echo $tag_name; ?></span>
                            <?php endif; ?>

                            <?php if ($item['title'] && $settings['title']) : ?>
                            <h3 class="<?php echo $title_size; ?>"><?php echo $item['title']; ?></h3>
                            <?php endif; ?>

                            <?php if ($item['content'] && $settings['content']) : ?>
                            <div class="<?php echo $content_size; ?> uk-margin"><?php echo $item['content']; ?></div>
                            <?php endif; ?>

                            <?php if ($item['link'] && $settings['link']) : ?>
                            <p class="uk-margin-large-top"><a<?php if($link_style) echo ' class="' . $link_style . '"'; ?> href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>><?php echo $app['translator']->trans($settings['link_text']); ?></a></p>
                            <?php endif; ?>

                        </div>

                    </div>
                    <?php endif; ?>

                <?php endif; ?>

                </div>

            </li>

        <?php endforeach; ?>
        </ul>

        <?php if (in_array($settings['slidenav'], array('top-left', 'top-right', 'bottom-left', 'bottom-right'))) : ?>
        <div class="uk-position-<?php echo $settings['slidenav']; ?> uk-margin uk-margin-left uk-margin-right">
            <div class="uk-grid uk-grid-small">
                <div><a href="#" class="uk-slidenav <?php if ($settings['nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-previous" data-uk-slideshow-item="previous"></a></div>
                <div><a href="#" class="uk-slidenav <?php if ($settings['nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-next" data-uk-slideshow-item="next"></a></div>
            </div>
        </div>
        <?php elseif ($settings['slidenav'] == 'default') : ?>
        <a href="#" class="uk-slidenav <?php if ($settings['nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-previous uk-hidden-touch" data-uk-slideshow-item="previous"></a>
        <a href="#" class="uk-slidenav <?php if ($settings['nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-next uk-hidden-touch" data-uk-slideshow-item="next"></a>
        <?php endif; ?>

    </div>

    <?php echo $this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_nav.php', compact('items', 'settings')); ?>

</div>

<script>

(function($) {

    var container = $('#<?php echo $settings['id']; ?>'),
        nav = $('[data-uk-slider]', container);

    container.on('beforeshow.uk.slideshow', function(e, next) {
        nav.data('slider').updateFocus(next.index());
    });

})(jQuery);
</script>
