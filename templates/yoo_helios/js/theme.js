/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

jQuery(function($) {

    var config = $('html').data('config') || {}, navbar = $('.tm-navbar');

    // Social buttons
    $('article[data-permalink]').socialButtons(config);

    // Navbar
    if (navbar.length) {

        if (config.stickynav) {

            $.UIkit.sticky(navbar, (function(){

                var fullscreen = $('.tm-header'),
                    cfg        = {top: 0,media: 960};

                if (fullscreen.length) {
                    cfg.top = fullscreen.innerHeight() * -1;
                    cfg.animation = 'uk-animation-slide-top';
                    cfg.clsactive ='uk-active tm-navbar-attached';
                }
                else {
                    cfg.clsactive = 'uk-active';
                }

                return cfg;

            })());
        }

        if (config.centereddropdown) {

            navbar.addClass('tm-navbar-centered').find('[data-uk-dropdown]').attr('data-uk-dropdown', '{justify:\'body\'}').find('.uk-grid').addClass('uk-flex-center').children().attr('class', '');

            function justify(dropdown) {

                if (dropdown && dropdown.length) {

                    dropdown.css("margin-" + UIkit.langdirection, "");

                    var jwidth         = UIkit.$body.outerWidth(),
                        offset         = dropdown.show().offset(),
                        boundarywidth  = UIkit.$win.width(),
                        boundaryoffset = UIkit.$win.offset() ? UIkit.$win.offset().left:0;

                    dropdown.css("min-width", jwidth);

                    if (UIkit.langdirection == 'right') {

                        var right1   = boundarywidth - (UIkit.$body.offset().left + jwidth),
                            right2   = boundarywidth - (dropdown.offset().left + dropdown.outerWidth());

                        dropdown.css("margin-right", right1 - right2);

                    } else {
                        dropdown.css("margin-left", UIkit.$body.offset().left - offset.left);
                    }
                }
            }

            var dropdowns  = navbar.find('.uk-dropdown'),
                elements   = navbar.find('[data-uk-dropdown]').removeAttr('data-uk-dropdown');

            function exitNav() {
                elements.removeClass("uk-open");
                return true;
            }

            function activateDropdown(row) {
                justify($(row).addClass('uk-open').find('.uk-dropdown:first'));
            }

            function deactivateDropdown(row) {
                $(row).removeClass('uk-open');
            }

            // Menu Aim
            navbar.menuAim({
                activate        : activateDropdown,
                deactivate      : deactivateDropdown,
                exitMenu        : exitNav,
                rowSelector     : '.uk-navbar-nav > li',
                submenuSelector : '.uk-parent',
                submenuDirection: 'below',
                tolerance       : 200
            });

        } else {

            navbar.find('.uk-dropdown').addClass('uk-dropdown-center');
        }

    }

    // Gradient follower
    if ($('.tm-stalker').length) {

        var stalker = $('.tm-stalker'), canvas = stalker.find('canvas')[0], ctx = canvas.getContext('2d'), gradient, initialized = false;

        UIkit.$doc.on('mousemove', function(e){

            setTimeout(function(){

                initialized = true;

                canvas.width  = stalker.width();
                canvas.height = stalker.height();

                gradient = ctx.createRadialGradient(e.pageX, e.pageY, 0, e.pageX, e.pageY, canvas.width);
                gradient.addColorStop(0, stalker.css('border-top-color'));
                gradient.addColorStop(1, stalker.css('border-bottom-color'));
                ctx.fillStyle = gradient;
                ctx.fillRect(0, 0, canvas.width, canvas.height);

            }, initialized ? 200 : 0);

        });
    }

});