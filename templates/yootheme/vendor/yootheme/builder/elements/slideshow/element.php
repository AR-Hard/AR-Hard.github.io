<?php

namespace YOOtheme;

return [

    'transforms' => [

        'render' => function ($node) {

            /**
             * @var View $view
             */
            $view = app(View::class);

            // TODO Fix me
            $node->props['parallaxOptions'] = $node->props['overlay_animation'] === 'parallax'
                ? [$view, 'parallaxOptions']
                : function () { return false; };

        },

    ],

    'updates' => [

        '2.0.0-beta.5.1' => function ($node) {

            /**
             * @var Config $config
             */
            $config = app(Config::class);

            list($style) = explode(':', $config('~theme.style'));

            if (!in_array($style, ['jack-baker', 'morgan-consulting', 'vibe'])) {
                if (@$node->props['overlay_container'] === 'large') {
                    $node->props['overlay_container'] = 'xlarge';
                }
            }

            if (in_array($style, ['craft', 'district', 'florence', 'makai', 'matthew-taylor', 'pinewood-lake', 'summit', 'tomsen-brody', 'trek', 'vision', 'yard'])) {
                if (@$node->props['overlay_container'] === 'default') {
                    $node->props['overlay_container'] = 'large';
                }
            }

        },

        '1.20.0-beta.1.1' => function ($node) {

            if (isset($node->props['maxwidth_align'])) {
                $node->props['block_align'] = $node->props['maxwidth_align'];
                unset($node->props['maxwidth_align']);
            }

        },

        '1.20.0-beta.0.1' => function ($node) {

            if (@$node->props['title_style'] === 'heading-hero') {
                $node->props['title_style'] = 'heading-xlarge';
            }

            if (@$node->props['title_style'] === 'heading-primary') {
                $node->props['title_style'] = 'heading-medium';
            }

            /**
             * @var Config $config
             */
            $config = app(Config::class);

            list($style) = explode(':', $config('~theme.style'));

            if (in_array($style, ['craft', 'district', 'jack-backer', 'tomsen-brody', 'vision', 'florence', 'max', 'nioh-studio', 'sonic', 'summit', 'trek'])) {

                if (@$node->props['title_style'] === 'h1' || (empty($node->props['title_style']) && @$node->props['title_element'] === 'h1')) {
                    $node->props['title_style'] = 'heading-small';
                }

            }

            if (in_array($style, ['florence', 'max', 'nioh-studio', 'sonic', 'summit', 'trek'])) {

                if (@$node->props['title_style'] === 'h2') {
                    $node->props['title_style'] = @$node->props['title_element'] === 'h1' ? '' : 'h1';
                } elseif (empty($node->props['title_style']) && @$node->props['title_element'] === 'h2') {
                    $node->props['title_style'] = 'h1';
                }

            }

            if (in_array($style, ['fuse', 'horizon', 'joline', 'juno', 'lilian', 'vibe', 'yard'])) {

                if (@$node->props['title_style'] === 'heading-medium') {
                    $node->props['title_style'] = 'heading-small';
                }

            }

            if (in_array($style, ['copper-hill'])) {

                if (@$node->props['title_style'] === 'heading-medium') {
                    $node->props['title_style'] = @$node->props['title_element'] === 'h1' ? '' : 'h1';
                } elseif (@$node->props['title_style'] === 'h1') {
                    $node->props['title_style'] = @$node->props['title_element'] === 'h2' ? '' : 'h2';
                } elseif (empty($node->props['title_style']) && @$node->props['title_element'] === 'h1') {
                    $node->props['title_style'] = 'h2';
                }

            }

            if (in_array($style, ['trek', 'fjord'])) {

                if (@$node->props['title_style'] === 'heading-medium') {
                    $node->props['title_style'] = 'heading-large';
                }

            }

            if (in_array($style, ['juno', 'vibe', 'yard'])) {

                if (@$node->props['title_style'] === 'heading-xlarge') {
                    $node->props['title_style'] = 'heading-medium';
                }

            }

            if (in_array($style, ['district', 'florence', 'flow', 'nioh-studio', 'summit', 'vision'])) {

                if (@$node->props['title_style'] === 'heading-xlarge') {
                    $node->props['title_style'] = 'heading-large';
                }

            }

            if (in_array($style, ['lilian'])) {

                if (@$node->props['title_style'] === 'heading-xlarge') {
                    $node->props['title_style'] = 'heading-2xlarge';
                }

            }

        },

        '1.19.0-beta.0.1' => function ($node) {

            if (@$node->props['meta_align'] === 'top') {
                $node->props['meta_align'] = 'above-title';
            }

            if (@$node->props['meta_align'] === 'bottom') {
                $node->props['meta_align'] = 'below-title';
            }

        },

        '1.18.10.3' => function ($node) {

            if (@$node->props['meta_align'] === 'top') {
                if (!empty($node->props['meta_margin'])) {
                    $node->props['title_margin'] = $node->props['meta_margin'];
                }
                $node->props['meta_margin'] = '';
            }

        },

        '1.18.10.1' => function ($node) {

            if (isset($node->props['thumbnav_inline_svg'])) {
                $node->props['thumbnav_svg_inline'] = $node->props['thumbnav_inline_svg'];
                unset($node->props['thumbnav_inline_svg']);
            }

        },

        '1.18.0' => function ($node) {

            if (!isset($node->props['slideshow_box_decoration']) && @$node->props['slideshow_box_shadow_bottom'] === true) {
                $node->props['slideshow_box_decoration'] = 'shadow';
            }

            if (!isset($node->props['meta_color']) && @$node->props['meta_style'] === 'muted') {
                $node->props['meta_color'] = 'muted';
                $node->props['meta_style'] = '';
            }

        },

    ],

];
