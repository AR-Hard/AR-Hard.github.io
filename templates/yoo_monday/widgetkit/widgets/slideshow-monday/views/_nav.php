<?php
/**
* @package   yoo_monday
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$grid = 'uk-grid-width-medium-1-';
$grid .= count($items) <= 5 ? count($items) : '5';

$size = 'height: '.$settings['thumbnail_height'].'px; width: 100%;';

// TODO: This needs to come from warp settings !!!
// $settings['tags'] = $warp['config']->get('tag_colors', array());
$settings['tags'] = [
    ['name' => 'people', 'color' => 'tm-tag-1'],
    ['name' => 'agency', 'color' => 'tm-tag-2'],
    ['name' => 'events', 'color' => 'tm-tag-3'],
    ['name' => 'marketing', 'color' => 'tm-tag-4']
];

?>

<div class="uk-slidenav-position uk-slider-container" data-uk-slider="{infinite: false}">

    <ul class="uk-slider uk-grid uk-grid-match uk-flex-center uk-grid-collapse uk-grid-width-1-2 uk-grid-width-small-1-2 <?php echo $grid; ?>" >

        <?php foreach ($items as $i => $item) :

            // Media Type
            $width = $item['media.width'];
            $height = $item['media.height'];
            if ($item->type('media') == 'image' && $settings['media']) {
                if ($settings['image_width'] != 'auto' || $settings['image_height'] != 'auto') {
                    $width  = ($settings['image_width'] != 'auto') ? $settings['image_width'] : '';
                    $height = ($settings['image_height'] != 'auto') ? $settings['image_height'] : '';
                    $media = 'background-image: url(' . $item->thumbnail('media', $width, $height, array(), true) . ');';
                } else {
                    $img = $app['image']->create($item->get('media'));
                    $media = 'background-image: url(' . $img->getURL() . ');';
                }
            } else {
                $media = '';
            }

            $media = 'style="' . $size . $media . '"';

            // Tags
            $tag_colors = $settings['tag_colors'];
            $tag_class  = '';
            $tag_name   = '';


            if (is_array($item['tags'])) {
                foreach ($item['tags'] as $name) {
                    foreach ($tag_colors as $tag_color) {
                        if (in_array(strtolower($name), array_map('strtolower', $tag_color))) {
                            $tag_class = $tag_color['color'];
                        }
                    }
                }
            }
        ?>

        <li data-uk-slideshow-item="<?php echo $i; ?>">
            <div class="uk-cover-background <?php echo $tag_class; ?>" <?php echo $media; ?>>
                <div class="uk-position-cover uk-overlay-background"></div>
                <a class="uk-position-cover" href="#"></a>
            </div>
        </li>

        <?php endforeach; ?>

    </ul>

</div>
