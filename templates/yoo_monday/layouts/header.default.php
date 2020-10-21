<div class="uk-navbar">
    <div class="tm-headerbar tm-headerbar-default uk-container uk-container-center uk-flex uk-flex-space-between">
        <div class="uk-flex uk-flex-middle">

            <?php if ($this['widgets']->count('logo')) : ?>
            <a class="tm-logo uk-visible-large" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
            <?php endif; ?>

            <?php if ($this['widgets']->count('logo-small')) : ?>
            <a class="tm-logo-small uk-hidden-large" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a>
            <?php endif; ?>

            <?php if ($this['widgets']->count('menu')) : ?>
            <nav class="uk-visible-large">
                <?php echo $this['widgets']->render('menu'); ?>
            </nav>
            <?php endif; ?>
        </div>
            <?php if ($this['widgets']->count('search + offcanvas')) : ?>
                <div class="uk-flex uk-flex-middle uk-flex-right">
                    <?php if ($this['widgets']->count('search')) : ?>
                    <div class="uk-visible-large">
                        <?php echo $this['widgets']->render('search'); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($this['widgets']->count('offcanvas')) : ?>
                    <a href="#offcanvas" class="uk-navbar-toggle uk-hidden-large" data-uk-offcanvas></a>
                <?php endif; ?>
            <?php endif; ?>
    </div>
</div>
