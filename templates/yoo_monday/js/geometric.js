/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

(function($) {

    $(function() {

        var container = $('<div></div>').prependTo('body'),
            count     = 20,
            figs      = [
                //square
                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M95,5.646H5v90h90V5.646z M94,94.646H6v-88h88V94.646z"></path></svg>',
                //circle
                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M50,95.646c24.854,0,45-20.147,45-45s-20.146-45-45-45s-45,20.147-45,45S25.146,95.646,50,95.646z M50,6.646  c24.262,0,44,19.738,44,44s-19.738,44-44,44s-44-19.738-44-44S25.738,6.646,50,6.646z"></path></svg>',
                //triangle
                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 94 81.408" enable-background="new 0 0 94 81.408" xml:space="preserve"><path d="M0,81.408l23.5-40.704L47,0l23.5,40.704L94,81.408H47H0z M46.999,4.001L25.232,41.703L3.464,79.408h43.535h43.536  L68.768,41.703L46.999,4.001L46.999,4.001z"></path></svg>',
                // hexagon
                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M72.5,89.616L95,50.646L72.5,11.675h-45L5,50.646l22.5,38.971H72.5z M28.077,12.675h43.846l21.922,37.971L71.923,88.616  H28.077L6.155,50.646L28.077,12.675z"></path></svg>',
                //waves
                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><g><path d="M73.959,79.8c-13.607,0-24.956-11.188-25.432-11.664c-0.102-0.104-10.624-10.449-22.485-10.449   c-11.902,0-22.378,10.344-22.486,10.449c-0.812,0.812-2.13,0.812-2.944,0c-0.816-0.814-0.816-2.132,0-2.948   c0.476-0.476,11.825-11.67,25.43-11.67c13.607,0,24.955,11.194,25.432,11.67c0.102,0.104,10.624,10.447,22.486,10.447   c11.859,0,22.382-10.344,22.488-10.447c0.816-0.812,2.134-0.812,2.942,0.006c0.816,0.812,0.816,2.128,0,2.942   C98.912,68.612,87.563,79.8,73.959,79.8z"></path><path d="M73.959,63.147c-13.607,0-24.956-11.194-25.432-11.67c-0.102-0.102-10.624-10.445-22.485-10.445   c-11.902,0-22.378,10.343-22.486,10.445c-0.812,0.814-2.13,0.814-2.944,0c-0.816-0.816-0.816-2.132,0-2.944   c0.476-0.476,11.825-11.668,25.43-11.668c13.607,0,24.955,11.192,25.432,11.668c0.102,0.1,10.624,10.447,22.486,10.447   c11.859,0,22.382-10.348,22.488-10.447c0.816-0.812,2.134-0.812,2.942,0.002c0.816,0.816,0.816,2.126,0,2.942   C98.912,51.953,87.563,63.147,73.959,63.147z"></path><path d="M73.959,46.482c-13.607,0-24.956-11.194-25.432-11.67c-0.102-0.104-10.624-10.447-22.485-10.447   c-11.902,0-22.378,10.343-22.486,10.447c-0.812,0.812-2.13,0.812-2.944,0c-0.816-0.816-0.816-2.134,0-2.948   C1.088,31.388,12.437,20.2,26.042,20.2c13.607,0,24.955,11.188,25.432,11.664c0.102,0.104,10.624,10.449,22.486,10.449   c11.859,0,22.382-10.346,22.488-10.449c0.816-0.812,2.134-0.81,2.942,0.006c0.816,0.812,0.816,2.126,0,2.942   C98.912,35.288,87.563,46.482,73.959,46.482z"></path></g></svg>'
            ];

        container.css({
            position: 'fixed',
            top: 0,
            right: 0,
            bottom: 0,
            left: 0,
            overflow: 'hidden',
            zIndex: -1
        });

        function draw(count) {

            container.children().remove();

            for(var i=0,w=window.innerWidth,h=window.innerHeight,ele;i<count;i++) {

                ele = $('<div class="tm-bg-item">'+figs[getRandomInt(0,figs.length-1)]+'</div>').css({
                    top: getRandomInt(100, h)+'px',
                    left: getRandomInt((i%2) ? 50:w-Math.abs(w/3), (i%2) ? Math.abs(w/3):w-50)+'px',
                    animationDelay: getRandomInt(0, 800)+'ms',
                    animationDuration: getRandomInt(10, 40)+'s'
                });

                container.append(ele);
            }
        }

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }


        draw(count);

        $(window).on('resize', function() {
            draw(count)
        });

    });

})(jQuery);
