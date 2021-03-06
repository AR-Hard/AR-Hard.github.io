<?php
/**
* @package   yoo_moustache
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

	<?php if ($this['widgets']->count('toolbar-l + toolbar-r + menu + search')) : ?>
	<div id="tm-headerbar" class="tm-headerbar">

		<?php if ($this['widgets']->count('toolbar-l + toolbar-r')) : ?>
		<div class="tm-toolbar uk-clearfix uk-hidden-small">
			<div class="uk-container uk-container-center">

				<?php if ($this['widgets']->count('toolbar-l')) : ?>
				<div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
				<?php endif; ?>

				<?php if ($this['widgets']->count('toolbar-r')) : ?>
				<div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
				<?php endif; ?>

			</div>
		</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('menu + search')) : ?>
		<nav class="tm-navbar uk-navbar">
			<div class="uk-container uk-container-center">
				<div class="uk-clearfix">

					<?php if ($this['widgets']->count('logo')) : ?>
					<a class="tm-logo uk-navbar-brand uk-hidden-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
					<?php endif; ?>

					<?php if ($this['widgets']->count('search')) : ?>
					<div class="uk-navbar-flip uk-visible-large">
						<div class="uk-navbar-content"><?php echo $this['widgets']->render('search'); ?></div>
					</div>
					<?php endif; ?>

					<?php if ($this['widgets']->count('menu')) : ?>
					<div class="uk-navbar-flip">
						<?php echo $this['widgets']->render('menu'); ?>
					</div>
					<?php endif; ?>

					<?php if ($this['widgets']->count('offcanvas')) : ?>
					<a href="#offcanvas" class="uk-navbar-toggle uk-navbar-flip uk-hidden-large" data-uk-offcanvas></a>
					<?php endif; ?>

					<?php if ($this['widgets']->count('logo-small')) : ?>
					<a class="tm-logo-small uk-navbar-brand uk-visible-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a>
					<?php endif; ?>

				</div>
			</div>
		</nav>
		<?php endif; ?>

	</div>
	<?php endif; ?>

	<?php if ($this['config']->get('fullscreen_image')) : ?>
	<div id="tm-fullscreen" class="tm-fullscreen">
		<div class="<?php echo $display_classes['fullscreen']; ?>"><?php echo $this['widgets']->render('fullscreen'); ?></div>
	</div>
	<?php endif; ?>

	<?php if ($this['widgets']->count('top-a')) : ?>
	<div id="tm-top-a" class="tm-block <?php if (isset($block_classes['top-a'])) echo $block_classes['top-a']; echo $display_classes['top-a']; ?>">
		<div class="uk-container uk-container-center">
			<section class="<?php echo $grid_classes['top-a']; ?>" data-uk-scrollspy="{targets:true, repeat:true}" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?></section>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this['widgets']->count('top-b')) : ?>
	<div id="tm-top-b" class="tm-block <?php if (isset($block_classes['top-b'])) echo $block_classes['top-b']; echo $display_classes['top-b']; ?>">
		<div class="uk-container uk-container-center">
			<section class="<?php echo $grid_classes['top-b']; ?>" data-uk-scrollspy="{targets:true, repeat:true}" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?></section>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
	<div id="tm-middle" class="tm-block <?php if (isset($block_classes['main'])) echo $block_classes['main']; ?>">
		<div class="uk-container uk-container-center">
			<div class="tm-middle uk-grid" data-uk-scrollspy="{targets:true, repeat:true}" data-uk-grid-match data-uk-grid-margin>

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
	<?php endif; ?>

	<?php if ($this['widgets']->count('bottom-a')) : ?>
	<div id="tm-bottom-a" class="tm-block <?php if (isset($block_classes['bottom-a'])) echo $block_classes['bottom-a']; echo $display_classes['bottom-a']; ?>">
		<div class="uk-container uk-container-center">
			<section class="<?php echo $grid_classes['bottom-a']; ?>" data-uk-scrollspy="{targets:true, repeat:true}" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this['widgets']->count('bottom-b')) : ?>
	<div id="tm-bottom-b" class="tm-block <?php if (isset($block_classes['bottom-b'])) echo $block_classes['bottom-b']; echo $display_classes['bottom-b']; ?>">
		<div class="uk-container uk-container-center">
			<section class="<?php echo $grid_classes['bottom-b']; ?>" data-uk-scrollspy="{targets:true, repeat:true}" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this['widgets']->count('bottom-c')) : ?>
		<?php if ($this['widgets']->count('bottom-c')) : ?>
		<div id="tm-bottom-c" class="tm-block tm-block-dark <?php if (isset($block_classes['bottom-c'])) echo $block_classes['bottom-c']; echo $display_classes['bottom-c']; ?>">
			<div class="uk-container uk-container-center">
				<section class="<?php echo $grid_classes['bottom-c']; ?>" data-uk-scrollspy="{targets:true, repeat:true}" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-c', array('layout'=>$this['config']->get('grid.bottom-c.layout'))); ?></section>
			</div>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
	<div class="tm-block tm-block-footer">
		<div class="uk-container uk-container-center">

			<footer class="tm-footer uk-text-center">

				<?php if ($this['config']->get('totop_scroller', true)) : ?>
				<a class="tm-totop-scroller" data-uk-smooth-scroll href="#">TOP</a>
				<?php endif; ?>

				<?php
					echo $this['widgets']->render('footer');
					$this->output('warp_branding');
					echo $this['widgets']->render('debug');
				?>

			</footer>

		</div>
	</div>
	<?php endif; ?>

	<?php echo $this->render('footer'); ?>

	<?php if ($this['widgets']->count('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar uk-offcanvas-bar-flip"><?php echo $this['widgets']->render('offcanvas'); ?></div>
	</div>
	<?php endif; ?>

	<?php if ($this['widgets']->count('smoothscroll')) : ?>
		<div class="tm-smoothscroll-bar uk-hidden-small"><ul data-uk-scrollspy-nav="{smoothscroll: {offset: 90}}"><?php echo $this['widgets']->render('smoothscroll'); ?></ul></div>
	<?php endif; ?>

</body>
</html>