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

// Grid
$grid  = 'uk-grid-width-1-'.$settings['columns'];
$grid .= $settings['columns_small'] ? ' uk-grid-width-small-1-'.$settings['columns_small'] : '';
$grid .= $settings['columns_medium'] ? ' uk-grid-width-medium-1-'.$settings['columns_medium'] : '';
$grid .= $settings['columns_large'] ? ' uk-grid-width-large-1-'.$settings['columns_large'] : '';
$grid .= $settings['columns_xlarge'] ? ' uk-grid-width-xlarge-1-'.$settings['columns_xlarge'] : '';

$grid .= ' uk-grid uk-grid-match';
$grid .= in_array($settings['gutter'], array('collapse','large','medium','small')) ? ' uk-grid-'.$settings['gutter'] : '' ;

// Panel
$panel     = 'uk-panel';
$panel_alt = '';
switch ($settings['panel']) {
    case 'box' :
        $panel .= ' uk-panel-box';
        break;
    case 'primary' :
        $panel .= ' uk-panel-box uk-panel-box-primary';
        break;
    case 'secondary' :
        $panel .= ' uk-panel-box uk-panel-box-secondary';
        break;
    case 'hover' :
        $panel .= ' uk-panel-hover';
        break;
    case 'header' :
        $panel .= ' uk-panel-header';
        break;
    case 'space' :
        $panel .= ' uk-panel-space';
        break;
    case 'sequence1' :
        $panel .= ' uk-panel-box';
        $panel_alt = 'uk-panel uk-panel-box uk-panel-box-primary';
        break;
    case 'sequence2' :
        $panel .= ' uk-panel-box';
        $panel_alt = 'uk-panel uk-panel-box uk-panel-box-secondary';
        break;
    case 'sequence3' :
        $panel .= ' uk-panel-box uk-panel-box-primary';
        $panel_alt = 'uk-panel uk-panel-box uk-panel-box-secondary';
        break;
}

// Panel Sequence
$panel = array(
    $panel,
    $panel_alt ? $panel_alt : $panel
);

// Content Align
$content_align  = $settings['content_align'] ? 'uk-flex-middle' : '';

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
        $badge_style .= ($settings['badge_position'] == 'panel') ? ' uk-panel-badge' : '';
        break;
    case 'text-primary':
        $badge_style  = 'uk-text-primary';
        $badge_style .= ($settings['badge_position'] == 'panel') ? ' uk-panel-badge' : '';
        break;
}

// Animation
$animation = ($settings['animation'] != 'none') ? ' data-uk-scrollspy="{cls:\'uk-animation-' . $settings['animation'] . ' uk-invisible\', target:\'> div > .uk-panel\', delay:300}"' : '';

// Link Target
$link_target = ($settings['link_target']) ? ' target="_blank"' : '';

?>

<div id="wk-grid<?php echo $settings['id']; ?>" class="tm-grid-monday <?php echo $grid; ?> uk-text-<?php echo $settings['text_align']; ?> <?php echo $settings['class']; ?>" data-uk-grid-margin <?php echo $animation; ?>>

<?php foreach ($items as $i => $item) :

        // Social Buttons
        $socials = '';
        if ($settings['social_buttons']) {
            $socials .= $item['twitter'] ? '<div><a class="uk-icon-button uk-icon-twitter" href="'. $item->escape('twitter') .'"></a></div>': '';
            $socials .= $item['facebook'] ? '<div><a class="uk-icon-button uk-icon-facebook" href="'. $item->escape('facebook') .'"></a></div>': '';
            $socials .= $item['google-plus'] ? '<div><a class="uk-icon-button uk-icon-google-plus" href="'. $item->escape('google-plus') .'"></a></div>': '';
            $socials .= $item['email'] ? '<div><a class="uk-icon-button uk-icon-envelope-o" href="mailto:'. $item->escape('email') .'"></a></div>': '';
        }

        // Second Image as Overlay
        $media2 = '';
        if ($settings['media_overlay'] == 'image') {
            foreach ($item as $field) {
                if ($field != 'media' && $item->type($field) == 'image') {
                    $media2 = $field;
                    break;
                }
            }
        }

        // Media Type
        $attrs  = array('class' => '');
        $width  = $item['media.width'];
        $height = $item['media.height'];

        if ($item->type('media') == 'image') {
            $attrs['alt'] = strip_tags($item['title']);

            $attrs['class'] .= ($settings['media_animation'] != 'none' && !$media2) ? ' uk-overlay-' . $settings['media_animation'] : '';

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

        // Second Image as Overlay
        if ($media2) {

            $attrs['class'] .= ' uk-overlay-panel uk-overlay-image';
            $attrs['class'] .= ($settings['media_animation'] != 'none') ? ' uk-overlay-' . $settings['media_animation'] : '';

            $media2 = $item->thumbnail($media2, $width, $height, $attrs);
        }

        // Link and Overlay
        $overlay       = '';
        $overlay_hover = '';
        $panel_hover   = '';

        if ($item['link']) {

            if ($settings['panel_link']) {

                $panel_hover .= ($settings['panel'] == 'box') ? ' uk-panel-box-hover' : '';
                $panel_hover .= ($settings['panel'] == 'primary') ? ' uk-panel-box-primary-hover' : '';
                $panel_hover .= ($settings['panel'] == 'secondary') ? ' uk-panel-box-secondary-hover' : '';

                if ($settings['panel'] == 'sequence1') {
                    $panel_hover .= !($i % 2)  ? ' uk-panel-box-hover' : ' uk-panel-box-primary-hover';
                }
                if ($settings['panel'] == 'sequence2') {
                    $panel_hover .= !($i % 2)  ? ' uk-panel-box-hover' : ' uk-panel-box-secondary-hover';
                }
                if ($settings['panel'] == 'sequence3') {
                    $panel_hover .= !($i % 2)  ? ' uk-panel-box-primary-hover' : ' uk-panel-box-secondary-hover';
                }

                if (($settings['media_overlay'] == 'icon') ||
                    ($media2) ||
                    ($socials && $settings['media_overlay'] == 'social-buttons') ||
                    ($item['media'] && $settings['media'] && $settings['media_animation'] != 'none')) {
                    $panel_hover .= ' uk-overlay-hover';
                }

            } elseif ($settings['media_overlay'] == 'link' || $settings['media_overlay'] == 'icon' || $settings['media_overlay'] == 'image') {
                $overlay = '<a class="uk-position-cover" href="' . $item->escape('link') . '"' . $link_target . '></a>';
                $overlay_hover = ' uk-overlay-hover';
            }

            if ($settings['media_overlay'] == 'icon') {
                $overlay = '<div class="uk-overlay-panel uk-overlay-background uk-overlay-icon uk-overlay-' . $settings['overlay_animation'] . '"></div>' . $overlay;
            }

            if ($media2) {
                $overlay = $media2 . $overlay;
            }

        }

        if ($socials && $settings['media_overlay'] == 'social-buttons') {

            $overlay  = '<div class="uk-overlay-panel uk-overlay-background uk-overlay-' . $settings['overlay_animation'] . ' uk-flex uk-flex-center uk-flex-middle uk-text-center"><div>';
            $overlay .= '<div class="uk-grid uk-grid-small" data-uk-grid-margin>' . $socials . '</div>';
            $overlay .= '</div></div>';

            $overlay_hover = !$settings['panel_link'] ? ' uk-overlay-hover' : '';
        }

        if ($overlay || ($settings['panel_link'] && $settings['media_animation'] != 'none')) {
            $media  = '<div class="uk-overlay' . $overlay_hover . ' ">' . $media . $overlay . '</div>';
        }

        // Meta
        $meta = '';
        if ($item['date']) {
            $date = '<time datetime="'.$item['date'].'">'.$app['date']->format($item['date']).'</time>';
            if ($item['author']) {
                $meta = $app['translator']->trans('Written by %author% on %date%',  array('%author%' => $item['author'], '%date%' => $date));
            } else {
                $meta = $app['translator']->trans('Written on %date%',  array('%date%' => $date));
            }
        } elseif ($item['author']) {
            $meta = $app['translator']->trans('Written by %author%',  array('%author%' => $item['author']));
        }

        if ($item['categories']) {

            $categories = array();
            foreach ($item['categories'] as $category => $url) {
                $categories[] = '<a href="'.$url.'">'.$category.'</a>';
            }
            $categories = implode(', ', array_filter($categories));

            $meta .= ($meta) ? '. ' : '';
            $meta .= $app['translator']->trans('Posted in %categories%',  array('%categories%' => $categories));

        }

        // Panel Title last
        if ($settings['title_size'] == 'panel' &&
            !($meta) &&
            // !($item['media'] && $settings['media'] && $settings['media_align'] == 'bottom') &&
            !($item['content'] && $settings['content']) &&
            !($socials && ($settings['media_overlay'] != 'social-buttons')) &&
            !($item['link'] && $settings['link'])) {
                $title_size .= ' uk-margin-bottom-remove';
        }

        // Tags
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

    <div>
        <div class="<?php echo $panel[$i % 2]; ?> <?php echo $panel_hover; ?> <?php echo $tag_class; ?> <?php if ($settings['animation'] != 'none') echo ' uk-invisible'; ?>">

            <?php if ($item['link'] && $settings['panel_link']) : ?>
            <a class="uk-position-cover uk-position-z-index" href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>></a>
            <?php endif; ?>

            <?php if ($item['badge'] && $settings['badge'] && $settings['badge_position'] == 'panel') : ?>
            <div class="uk-panel-badge <?php echo $badge_style; ?>"><?php echo $item['badge']; ?></div>
            <?php endif; ?>

            <?php if ($item['media'] && $settings['media'] && (!$settings['media_alternate'] || $settings['media_alternate'] && !($i % 2))) : ?>
            <div class="uk-panel-teaser"><?php echo $media; ?></div>
            <?php endif; ?>

            <?php if (!$settings['media_alternate'] || !$item['media'] || !$settings['media'] || ($settings['media_alternate'] && !($i % 2))) : ?>
            <div class="tm-tag-border"></div>
            <?php endif; ?>

            <?php if (!$settings['panel']) : ?>
            <div class="uk-panel-body">
            <?php endif; ?>

                <?php if ($tag_name) : ?>
                    <span class="uk-badge"><?php echo $tag_name; ?></span>
                <?php elseif ($item['tags']) : ?>
                    <span class="uk-badge"><?php echo implode($item['tags'], ',') ?></span>
                <?php endif; ?>

                <?php if ($item['title'] && $settings['title']) : ?>
                <h3 class="<?php echo $title_size; ?>">

                    <?php if ($item['link']) : ?>
                        <a class="uk-link-reset" href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>><?php echo $item['title']; ?></a>
                    <?php else : ?>
                        <?php echo $item['title']; ?>
                    <?php endif; ?>

                    <?php if ($item['badge'] && $settings['badge'] && $settings['badge_position'] == 'title') : ?>
                    <span class="uk-margin-small-left <?php echo $badge_style; ?>"><?php echo $item['badge']; ?></span>
                    <?php endif; ?>

                </h3>
                <?php endif; ?>

                <?php if ($meta) : ?>
                <p class="uk-article-meta"><?php echo $meta; ?></p>
                <?php endif; ?>

                <?php if ($item['content'] && $settings['content']) : ?>
                <div class="uk-margin"><?php echo $item['content']; ?></div>
                <?php endif; ?>

                <?php if ($socials && ($settings['media_overlay'] != 'social-buttons')) : ?>
                <div class="uk-grid uk-grid-small uk-flex-<?php echo $settings['text_align']; ?>" data-uk-grid-margin><?php echo $socials; ?></div>
                <?php endif; ?>

                <?php if ($item['link'] && $settings['link']) : ?>
                <p><a<?php if($link_style) echo ' class="' . $link_style . '"'; ?> href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>><?php echo $app['translator']->trans($settings['link_text']); ?></a></p>
                <?php endif; ?>

            <?php if (!$settings['panel']) : ?>
            </div>
            <?php endif; ?>

            <?php if ($item['media'] && $settings['media'] && $settings['media_alternate'] && ($i % 2)) : ?>
            <div class="tm-panel-teaser-bottom">
                <div class="tm-tag-border"></div>
                <?php echo $media; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>

<?php endforeach; ?>

</div>

<script>
(function($){
    // get the images of the grid and replace it by a canvas of the same size to fix the problem with overlapping images on load.
    $('img[width][height]:not(.uk-overlay-panel)', $('#wk-grid<?php echo $settings['id']; ?>')).each(function() {

        var $img = $(this);

        if (this.width == 'auto' || this.height == 'auto' || !$img.is(':visible')) {
            return;
        }

        var $canvas = $('<canvas class="uk-responsive-width"></canvas>').attr({width:$img.attr('width'), height:$img.attr('height')}),
            img = new Image;

        $img.css('display', 'none').after($canvas);

        img.onload = function(){
            $canvas.remove();
            $img.css('display', '');
        };

        img.src = this.src;
    });

})(jQuery);
</script>
