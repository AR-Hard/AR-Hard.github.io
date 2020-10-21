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

// JS Options
$options = array();
$options[] = ($settings['duration'] != '500') ? 'duration: ' . $settings['duration'] : '';
$options[] = ($settings['autoplay']) ? 'autoplay: true ' : '';
$options[] = ($settings['interval'] != '3000') ? 'autoplayInterval: ' . $settings['interval'] : '';
$options[] = ($settings['autoplay_pause']) ? '' : 'pauseOnHover: false';

$options = '{'.implode(',', array_filter($options)).'}';

// Panel
$panel = 'uk-panel';
if ($settings['panel'] == 'box') {
    $panel .= ' uk-panel-box';
}

// Media Width
$media_width = 'uk-width-' . $settings['media_breakpoint'] . '-' . $settings['media_width'];

switch ($settings['media_width']) {
    case '1-5':
        $content_width = '4-5';
        break;
    case '1-4':
        $content_width = '3-4';
        break;
    case '3-10':
        $content_width = '7-10';
        break;
    case '1-3':
        $content_width = '2-3';
        break;
    case '2-5':
        $content_width = '3-5';
        break;
    case '1-2':
        $content_width = '1-2';
        break;
    case '3-5':
        $content_width = '2-5';
        break;
    case '2-3':
        $content_width = '1-3';
        break;
}

$content_width = 'uk-width-' . $settings['media_breakpoint'] . '-' . $content_width;

// Align Right
$media_width .= ($settings['media_align'] == 'left') ? ' uk-flex-order-first-' . $settings['media_breakpoint'] : '';

// Title Size
switch ($settings['title_size']) {
    case 'panel':
        $title_size = 'uk-panel-title';
        break;
    case 'large':
        $title_size = 'uk-heading-large uk-margin-top-remove';
        break;
    default:
        $title_size = 'uk-' . $settings['title_size'] . ' uk-margin-top-remove';
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

// Badge Style
switch ($settings['badge_style']) {
    case 'badge':
        $badge_style = 'uk-badge';
        break;
    case 'success':
        $badge_style = 'uk-badge uk-badge-success';
        break;
    case 'warning':
        $badge_style = 'uk-badge uk-badge-warning';
        break;
    case 'danger':
        $badge_style = 'uk-badge uk-badge-danger';
        break;
    case 'text-muted':
        $badge_style  = 'uk-text-muted';
        break;
    case 'text-primary':
        $badge_style  = 'uk-text-primary';
        break;
}

// Custom Class
$class = $settings['class'];

?>

<div id="wk-<?php echo $settings['id']; ?>" class="tm-slideshow-panel-monday  <?php echo $class; ?>">
    <div class="<?php echo $panel; ?> uk-padding-remove">

        <?php if ($settings['media']) : ?>
        <div class="uk-grid uk-grid-collapse uk-grid-match <?php echo ($settings['content_align']) ? 'uk-flex-middle' : ''; ?>" data-uk-grid-margin>
            <div class="<?php echo $content_width ?>">
        <?php endif; ?>

                <div data-uk-slideshow="<?php echo $options; ?>">
                    <ul class="uk-slideshow <?php if ($settings['fullscreen']) echo ' uk-slideshow-fullscreen'; ?>">
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

                        <li class="<?php echo $tag_class; ?>">

                            <div class="uk-panel-body uk-text-<?php echo $settings['text_align']; ?>">

                                <?php if ($tag_name) : ?>
                                    <p class="uk-badge"><?php echo $tag_name; ?></p>
                                <?php elseif ($item['tags']) : ?>
                                    <p class="uk-badge"><?php echo implode($item['tags'], ',') ?></p>
                                <?php endif; ?>

                                <?php if ($item['title'] && $settings['title']) : ?>
                                <h3 class="<?php echo $title_size; ?>">

                                    <?php if ($item['link']) : ?>
                                        <a class="uk-link-reset" href="<?php echo $item->escape('link'); ?>" <?php echo $link_target; ?>><?php echo $item['title']; ?></a>
                                    <?php else : ?>
                                        <?php echo $item['title']; ?>
                                    <?php endif; ?>

                                    <?php if ($item['badge'] && $settings['badge']) : ?>
                                    <span class="uk-margin-small-left <?php echo $badge_style; ?>"><?php echo $item['badge']; ?></span>
                                    <?php endif; ?>

                                </h3>
                                <?php endif; ?>

                                <?php if ($item['content'] && $settings['content']) : ?>
                                <div class="<?php echo $content_size; ?> uk-margin-top"><?php echo $item['content']; ?></div>
                                <?php endif; ?>

                                <?php if ($item['link'] && $settings['link']) : ?>
                                <p class="uk-margin-bottom-remove uk-margin-large-top"><a<?php if($link_style) echo ' class="' . $link_style . '"'; ?> href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>><?php echo $app['translator']->trans($settings['link_text']); ?></a></p>
                                <?php endif; ?>

                            </div>

                        </li>

                    <?php endforeach; ?>
                    </ul>

                    <?php if (in_array($settings['slidenav'], array('top-left', 'top-right', 'bottom-left', 'bottom-right'))) : ?>
                    <div class="uk-position-<?php echo $settings['slidenav']; ?> ">
                            <a href="#" class="uk-slidenav <?php if ($settings['nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                            <a href="#" class="uk-slidenav <?php if ($settings['nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-next" data-uk-slideshow-item="next"></a>
                    </div>
                    <?php endif; ?>

                </div>

        <?php if ($settings['media']) : ?>
            </div>

            <div class="<?php echo $media_width ?> uk-text-center">
                <?php echo $this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_media.php', compact('items', 'settings', 'widget')); ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<script>

    (function($){

        var settings   = <?php echo json_encode($settings); ?>,
            container  = $('#wk-<?php echo $settings["id"]; ?>'),
            slideshows = container.find('[data-uk-slideshow]');

        if (slideshows.length > 1) {
            container.on('beforeshow.uk.slideshow', function(e, next) {
                slideshows.not(next.closest('[data-uk-slideshow]')[0]).data('slideshow').show(next.index());
            });
        }

        if (settings.autoplay && settings.autoplay_pause) {

            container.on({
                mouseenter: function() {
                    slideshows.each(function(){
                        $(this).data('slideshow').stop();
                    });
                },
                mouseleave: function() {
                    slideshows.each(function(){
                        $(this).data('slideshow').start();
                    });
                }
            });
        }

    })(jQuery);

</script>
