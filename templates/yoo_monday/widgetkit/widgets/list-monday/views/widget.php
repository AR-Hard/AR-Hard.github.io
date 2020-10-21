<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

use YOOtheme\Widgetkit\Content\Content;

$warp = include(__DIR__.'/../../../../warp.php');

// tag <> clolor assignment
$settings['tags'] = $warp['config']->get('tag_colors', array());

// List
$list = 'tm-list-monday uk-list';
switch ($settings['list']) {
    case 'line':
    case 'striped':
    case 'space':
        $list .= ' uk-list-' . $settings['list'];
        break;
}

// Media Align
$media_align = ($settings['media_align'] == 'right') ? 'uk-flex-order-last' : '';

// Content Align
$content_align  = $settings['content_align'] ? 'uk-flex-middle' : '';

// Media Border
$border = ($settings['media_border'] != 'none') ? 'uk-border-' . $settings['media_border'] : '';

// Link Target
$link_target = ($settings['link_target']) ? ' target="_blank"' : '';

?>

<ul class="<?php echo $list; ?> <?php echo $settings['class']; ?>">

<?php foreach ($items as $i => $item) :

        // Media Type
        $attrs  = array('class' => '');
        $width  = $item['media.width'];
        $height = $item['media.height'];

        if ($item->type('media') == 'image') {
            $attrs['alt'] = strip_tags($item['title']);

            $attrs['class'] .= ($border) ? $border : '';

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

        // Title
        $title = ($settings['title'] == 'title') ? $item['title'] : $item['content'];

        if ($settings['title_truncate']) {
            $title = Content::truncate($title, $settings['title_truncate']);
        }

        switch ($settings['title_size']) {
            case 'h1':
                $title = '<h1 class="uk-margin-remove">' . $title . '</h1>';
                break;
            case 'h1':
                $title = '<h2 class="uk-margin-remove">' . $title . '</h2>';
                break;
            case 'h3':
                $title = '<h3 class="uk-margin-remove">' . $title . '</h3>';
                break;
        }

        // Link Color
        $link_color = ($settings['link_color'] != 'link') ? 'uk-link-' . $settings['link_color'] : '';

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

    <li class="<?php echo $tag_class; ?>">

        <?php if ($item['link'] && $settings['link']) : ?>
        <a class="uk-display-block <?php echo $link_color; ?>" href="<?php echo $item->escape('link') ?>"<?php echo $link_target; ?>>
        <?php endif; ?>

            <?php if ($item['media'] && $settings['media']) : ?>
            <div class="uk-grid uk-grid-small<?php echo $content_align; ?>">
                <div class="uk-width-2-5 <?php echo $media_align; ?>">
                    <?php echo $media; ?>
                </div>
                <div class="uk-width-3-5 uk-flex-item-1">
            <?php endif; ?>

                <?php if ($tag_name) : ?>
                    <span class="uk-badge uk-display-block"><?php echo $tag_name; ?></span>
                <?php elseif ($item['tags']) : ?>
                    <span class="uk-badge"><?php echo implode($item['tags'], ',') ?></span>
                <?php endif; ?>

                <?php echo $title; ?>

            <?php if ($item['media'] && $settings['media']) : ?>
                </div>
            </div>
            <?php endif; ?>

        <?php if ($item['link'] && $settings['link']) : ?>
        </a>
        <?php endif; ?>

    </li>

<?php endforeach; ?>

</ul>
