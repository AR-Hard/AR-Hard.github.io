/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

jQuery(function($) {

	var config = $('html').data('config') || {};

	// Social buttons
	$('article[data-permalink]').socialButtons(config);

	// Change background-color when scroll
	if (config["bg_color_scroll"]) {

		function getBgOptions() {
			var colorelementstart = $('<div class="var-scroll-startcolor" style="position:absolute;top:-10000px;"></div>').appendTo("body"),
				colorelementend   = $('<div class="var-scroll-endcolor" style="position:absolute;top:-10000px;"></div>').appendTo("body"),
				startColor 	      = colorelementstart.css('background-color'),
				endColor 	      = colorelementend.css('background-color');

			colorelementstart.remove();
			colorelementend.remove();

			return {"start": startColor, "end": endColor, "minheight": (window.innerHeight * 2)};
		}

		var body = $('body').bgColorScroll(getBgOptions());
		
		$(window).on("message", $.UIkit.Utils.debounce(function(e) {
			if (e.originalEvent.data == "customizer-update") {
				body.data("bgColorScroll", {"options": getBgOptions()});
				body.trigger("scroll");
			}
		}, 150));

	}

});