<?php
/**
* @package   yoo_helios
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

<head>
<?php echo $this['template']->render('head'); ?>
</head>

<body class="<?php echo $this['config']->get('body_classes'); ?>">

    <div id="tm-header" class="tm-block-header<?php echo $block_classes['block-header']; ?> <?php echo $this['widgets']->count('header') !== 0 ? 'tm-fullscreen' : ''; ?>">

    <?php if (($this['config']->get('gradient_stalker', false)) && ($this['widgets']->count('header') !== 0)) : ?>
    <div class="tm-stalker uk-hidden-small uk-hidden-medium">
        <canvas></canvas>
    </div>
    <?php endif; ?>

        <div class="<?php echo $block_texture['block-header']; ?>">

            <?php if ($this['widgets']->count('menu + logo + search')) : ?>
            <nav class="tm-navbar <?php echo $this['widgets']->count('header') !== 0 ? '' : 'tm-navbar-attached'; ?>">
                <div class="uk-container uk-container-center <?php echo $block_container['block-header']; ?>">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">

                    <?php if ($this['widgets']->count('logo')) : ?>
                    <div class="tm-nav-logo uk-hidden-small">
                        <a class="tm-logo uk-hidden-small uk-responsive-width uk-responsive-height" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
                    </div>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('menu')) : ?>
                    <div class="tm-nav uk-hidden-small">
                        <div class="tm-nav-wrapper"><?php echo $this['widgets']->render('menu'); ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('search')) : ?>
                    <div class="tm-search uk-text-right uk-hidden-small uk-hidden-medium">
                        <?php echo $this['widgets']->render('search'); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('offcanvas')) : ?>
                    <a href="#offcanvas" class="uk-navbar-toggle tm-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('logo-small')) : ?>
                    <div class="uk-navbar-content uk-navbar-center uk-flex uk-flex-middle uk-visible-small">
                        <a class="tm-logo-small uk-responsive-width uk-responsive-height" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a>
                    </div>
                    <?php endif; ?>

                    </div>
                </div>
            </nav>
            <?php endif; ?>

            <?php if ($this['widgets']->count('header')) : ?>
            <div class="uk-container uk-container-center <?php echo $block_container['block-header']; ?> tm-header-container">
                <section class="<?php echo $grid_classes['header']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('header', array('layout'=>$this['config']->get('grid.header.layout'))); ?></section>
            </div>
            <?php endif; ?>

            <?php if ($this['config']->get('tobottom_scroller', false)) : ?>
            <a class="tm-tobottom-scroller" data-uk-smooth-scroll href="#tm-anchor-bottom"></a>
            <?php endif; ?>

        </div>
    </div>

    <?php if ($this['widgets']->count('top-a')) : ?>
    <div id="tm-top-a" class="tm-block-top-a<?php echo $block_classes['top-a']; echo $display_classes['top-a']; ?>">
        <div class="<?php echo $block_texture['top-a']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['top-a']; ?>">
                <section class="<?php echo $grid_classes['top-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?></section>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('top-b')) : ?>
    <div id="tm-top-b" class="tm-block-top-b<?php echo $block_classes['top-b']; echo $display_classes['top-b']; ?>">
        <div class="<?php echo $block_texture['top-b']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['top-b']; ?>">
                <section class="<?php echo $grid_classes['top-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?></section>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('top-c')) : ?>
    <div id="tm-top-c" class="tm-block-top-c<?php echo $block_classes['top-c']; echo $display_classes['top-c']; ?>">
        <div class="<?php echo $block_texture['top-c']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['top-c']; ?>">
                <section class="<?php echo $grid_classes['top-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-c', array('layout'=>$this['config']->get('grid.top-c.layout'))); ?></section>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
    <div id="tm-main" class="tm-block-top-main<?php echo $block_classes['main']; ?>">
        <div class="<?php echo $block_texture['main']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['main']; ?>">

                <div class="tm-middle uk-grid" data-uk-grid-match data-uk-grid-margin>

                    <?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
                    <div class="<?php echo $columns['main']['class'] ?>">

                        <?php if ($this['widgets']->count('main-top')) : ?>
                        <section class="<?php echo $grid_classes['main-top']; echo $display_classes['main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
                        <?php endif; ?>

                        <?php if ($this['config']->get('system_output', true)) : ?>
                        <main class="tm-content">

                            <?php if ($this['widgets']->count('breadcrumbs')) : ?>
                            <?php echo $this['widgets']->render('breadcrumbs'); ?>
                            <?php endif; ?>

                            <?php echo $this['template']->render('content'); ?>

                        </main>
                        <?php endif; ?>

                        <?php if ($this['widgets']->count('main-bottom')) : ?>
                        <section class="<?php echo $grid_classes['main-bottom']; echo $display_classes['main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
                        <?php endif; ?>

                    </div>
                    <?php endif; ?>

                    <?php foreach($columns as $name => &$column) : ?>
                    <?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
                    <aside class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
                    <?php endif ?>
                    <?php endforeach ?>

                </div>

            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('bottom-a')) : ?>
    <div id="tm-bottom-a" class="tm-block-bottom-a<?php echo $block_classes['bottom-a']; echo $display_classes['bottom-a']; ?>">
        <div class="<?php echo $block_texture['bottom-a']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['bottom-a']; ?>">
                <section class="<?php echo $grid_classes['bottom-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('bottom-b')) : ?>
    <div id="tm-bottom-b" class="tm-block-bottom-b<?php echo $block_classes['bottom-b']; echo $display_classes['bottom-b']; ?>">
        <div class="<?php echo $block_texture['bottom-b']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['bottom-b']; ?>">
                <section class="<?php echo $grid_classes['bottom-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('bottom-c')) : ?>
    <div id="tm-bottom-c" class="tm-block-bottom-c<?php echo $block_classes['bottom-c']; echo $display_classes['bottom-c']; ?>">
        <div class="<?php echo $block_texture['bottom-c']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['bottom-c']; ?>">
                <section class="<?php echo $grid_classes['bottom-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-c', array('layout'=>$this['config']->get('grid.bottom-c.layout'))); ?></section>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('bottom-d')) : ?>
    <div id="tm-bottom-d" class="tm-block-bottom-d<?php echo $block_classes['bottom-d']; echo $display_classes['bottom-d']; ?>">
        <div class="<?php echo $block_texture['bottom-d']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['bottom-d']; ?>">
                <section class="<?php echo $grid_classes['bottom-d']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-d', array('layout'=>$this['config']->get('grid.bottom-d.layout'))); ?></section>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('bottom-e')) : ?>
    <div id="tm-bottom-e" class="tm-block-bottom-e<?php echo $block_classes['bottom-e']; echo $display_classes['bottom-e']; ?>">
        <div class="<?php echo $block_texture['bottom-e']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['bottom-e']; ?>">
                <section class="<?php echo $grid_classes['bottom-e']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-e', array('layout'=>$this['config']->get('grid.bottom-e.layout'))); ?></section>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div id="tm-footer" class="tm-block-footer<?php echo $block_classes['block-footer']; ?>">
        <div class="<?php echo $block_texture['block-footer']; ?>">
            <div class="uk-container uk-container-center <?php echo $block_container['block-footer']; ?>">

            <?php if ($this['widgets']->count('footer-top')) : ?>
            <section class="<?php echo $grid_classes['footer-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('footer-top', array('layout'=>$this['config']->get('grid.footer-top.layout'))); ?></section>
            <hr class="tm-divider">
            <?php endif; ?>

            <?php if ($this['widgets']->count('footer-bottom')) : ?>
            <section class="<?php echo $grid_classes['footer-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('footer-bottom', array('layout'=>$this['config']->get('grid.footer-bottom.layout'))); ?></section>
            <?php endif; ?>

            <?php if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
            <footer class="tm-footer tm-link-muted">

                <?php if ($this['config']->get('totop_scroller', true)) : ?>
                <a id="tm-anchor-bottom" class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a>
                <?php endif; ?>

                <?php
                    echo $this['widgets']->render('footer');
                    $this->output('warp_branding');
                    echo $this['widgets']->render('debug');
                ?>

            </footer>
            <?php endif; ?>

            </div>
        </div>
    </div>

    <?php echo $this->render('footer'); ?>

    <?php if ($this['widgets']->count('offcanvas')) : ?>
    <div id="offcanvas" class="uk-offcanvas">
        <div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('smoothscroll')) : ?>
        <div class="tm-smoothscroll-bar uk-flex uk-flex-middle uk-hidden-small"><ul class="uk-dotnav uk-dotnav-contrast uk-flex-column" data-uk-scrollspy-nav="{smoothscroll: {offset: 90}, closest:'li'}"><?php echo $this['widgets']->render('smoothscroll'); ?></ul></div>
    <?php endif; ?>

</body>
</html>
