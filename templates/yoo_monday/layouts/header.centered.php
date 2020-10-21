<div class="uk-navbar tm-headerbar uk-container uk-container-center uk-flex uk-flex-center uk-flex-middle">

    <?php if ($this['widgets']->count('logo-small')) : ?>
    <div class="tm-headerbar-left uk-flex uk-flex-middle">

        <?php if ($this['widgets']->count('logo-small')) : ?>
        <a class="tm-logo-small uk-hidden-large" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a>
        <?php endif; ?>

    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('logo')) : ?>
        <a class="tm-logo uk-visible-large" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
    <?php endif; ?>

    <?php if ($this['widgets']->count('headerbar + search + offcanvas')) : ?>
    <div class="tm-headerbar-right uk-flex uk-flex-middle">

        <?php if ($this['widgets']->count('search')) : ?>
        <div class="uk-visible-large">
            <?php echo $this['widgets']->render('search'); ?>
        </div>
        <?php endif; ?>

        <?php if ($this['widgets']->count('offcanvas')) : ?>
        <a href="#offcanvas" class="uk-navbar-toggle uk-hidden-large" data-uk-offcanvas></a>
        <?php endif; ?>

        <?php if ($this['widgets']->count('headerbar')) : ?>
            <?php echo $this['widgets']->render('headerbar'); ?>
        <?php endif; ?>

    </div>
    <?php endif; ?>

</div>

<?php if ($this['widgets']->count('menu')) : ?>
<nav class="uk-visible-large">
    <div class="uk-flex uk-flex-center">
        <?php echo $this['widgets']->render('menu'); ?>
    </div>
</nav>
<?php endif; ?>
