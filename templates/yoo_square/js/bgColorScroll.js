/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

(function($){

	$.fn.bgColorScroll = function(options){

		if(!options) {
			return this;
		}

		options = $.extend({
			minheight: false,
			start : false,
			end   : false	
		}, options)

		this.each(function(){

			var element = $(this), fn;

			if(element.data("bgColorScroll")) {
				return;
			}

			element.data("bgColorScroll", {"start": getRGB(options.start), "end": getRGB(options.end), "options": options});

			if(element.is("body")) {

				$(document).on('scroll', (function() {

					fn = function(){
						
						if(options.minheight && options.minheight > $(document).height()) {
							return;
						}
						
						var data = element.data("bgColorScroll");

						if (!data.start) data.start = getRGB(data.options.start);
						if (!data.end)   data.end   = getRGB(data.options.end);

						var newColor = makeGradientColor(data.start, data.end, Math.round($(document).scrollTop() / ($(document).height() - $(window).height()) * 100));
						element.css('background-color', newColor.cssColor);
					};
					fn();
					return fn;
				})());

			} else {

				element.on('scroll', (function() {

					fn = function(){
						
						if(options.minheight && options.minheight > element.prop('scrollHeight')) {
							return;
						}

						var data = element.data("bgColorScroll");

						if (!data.start) data.start = getRGB(data.options.start);
						if (!data.end)   data.end   = getRGB(data.options.end);

						var newColor = makeGradientColor(data.start, data.end, Math.round(element.scrollTop() / (element.prop('scrollHeight') - element.height()) * 100));
						element.css('background-color', newColor.cssColor);
					};
					fn();
					return fn;
				})());
			}

		});

		return this;
	};

	function getRGB(color) {
	
		var rgb;

		color = colorNameToHex(color);

		if(color.match(/^#/)) {
			rgb = hexToRgb(color);
		} else {
			rgb = color.replace(/^(rgb|rgba)\(/,'').replace(/\)$/,'').replace(/\s/g,'').split(',');
			rgb = {r:parseInt(rgb[0]), g:parseInt(rgb[1]), b:parseInt(rgb[2])};
		}

		return rgb;
	}

	function hexToRgb(hex) {
		// Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
		hex = hex.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i, function(m, r, g, b) { return r + r + g + g + b + b; });
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		return result ? { r: parseInt(result[1], 16), g: parseInt(result[2], 16), b: parseInt(result[3], 16) } : null;
	}

	function colorNameToHex(color) {

	    var colors = {
	        "aliceblue": "#f0f8ff",
	        "antiquewhite": "#faebd7",
	        "aqua": "#00ffff",
	        "aquamarine": "#7fffd4",
	        "azure": "#f0ffff",
	        "beige": "#f5f5dc",
	        "bisque": "#ffe4c4",
	        "black": "#000000",
	        "blanchedalmond": "#ffebcd",
	        "blue": "#0000ff",
	        "blueviolet": "#8a2be2",
	        "brown": "#a52a2a",
	        "burlywood": "#deb887",
	        "cadetblue": "#5f9ea0",
	        "chartreuse": "#7fff00",
	        "chocolate": "#d2691e",
	        "coral": "#ff7f50",
	        "cornflowerblue": "#6495ed",
	        "cornsilk": "#fff8dc",
	        "crimson": "#dc143c",
	        "cyan": "#00ffff",
	        "darkblue": "#00008b",
	        "darkcyan": "#008b8b",
	        "darkgoldenrod": "#b8860b",
	        "darkgray": "#a9a9a9",
	        "darkgreen": "#006400",
	        "darkkhaki": "#bdb76b",
	        "darkmagenta": "#8b008b",
	        "darkolivegreen": "#556b2f",
	        "darkorange": "#ff8c00",
	        "darkorchid": "#9932cc",
	        "darkred": "#8b0000",
	        "darksalmon": "#e9967a",
	        "darkseagreen": "#8fbc8f",
	        "darkslateblue": "#483d8b",
	        "darkslategray": "#2f4f4f",
	        "darkturquoise": "#00ced1",
	        "darkviolet": "#9400d3",
	        "deeppink": "#ff1493",
	        "deepskyblue": "#00bfff",
	        "dimgray": "#696969",
	        "dodgerblue": "#1e90ff",
	        "firebrick": "#b22222",
	        "floralwhite": "#fffaf0",
	        "forestgreen": "#228b22",
	        "fuchsia": "#ff00ff",
	        "gainsboro": "#dcdcdc",
	        "ghostwhite": "#f8f8ff",
	        "gold": "#ffd700",
	        "goldenrod": "#daa520",
	        "gray": "#808080",
	        "green": "#008000",
	        "greenyellow": "#adff2f",
	        "honeydew": "#f0fff0",
	        "hotpink": "#ff69b4",
	        "indianred ": "#cd5c5c",
	        "indigo ": "#4b0082",
	        "ivory": "#fffff0",
	        "khaki": "#f0e68c",
	        "lavender": "#e6e6fa",
	        "lavenderblush": "#fff0f5",
	        "lawngreen": "#7cfc00",
	        "lemonchiffon": "#fffacd",
	        "lightblue": "#add8e6",
	        "lightcoral": "#f08080",
	        "lightcyan": "#e0ffff",
	        "lightgoldenrodyellow": "#fafad2",
	        "lightgrey": "#d3d3d3",
	        "lightgreen": "#90ee90",
	        "lightpink": "#ffb6c1",
	        "lightsalmon": "#ffa07a",
	        "lightseagreen": "#20b2aa",
	        "lightskyblue": "#87cefa",
	        "lightslategray": "#778899",
	        "lightsteelblue": "#b0c4de",
	        "lightyellow": "#ffffe0",
	        "lime": "#00ff00",
	        "limegreen": "#32cd32",
	        "linen": "#faf0e6",
	        "magenta": "#ff00ff",
	        "maroon": "#800000",
	        "mediumaquamarine": "#66cdaa",
	        "mediumblue": "#0000cd",
	        "mediumorchid": "#ba55d3",
	        "mediumpurple": "#9370d8",
	        "mediumseagreen": "#3cb371",
	        "mediumslateblue": "#7b68ee",
	        "mediumspringgreen": "#00fa9a",
	        "mediumturquoise": "#48d1cc",
	        "mediumvioletred": "#c71585",
	        "midnightblue": "#191970",
	        "mintcream": "#f5fffa",
	        "mistyrose": "#ffe4e1",
	        "moccasin": "#ffe4b5",
	        "navajowhite": "#ffdead",
	        "navy": "#000080",
	        "oldlace": "#fdf5e6",
	        "olive": "#808000",
	        "olivedrab": "#6b8e23",
	        "orange": "#ffa500",
	        "orangered": "#ff4500",
	        "orchid": "#da70d6",
	        "palegoldenrod": "#eee8aa",
	        "palegreen": "#98fb98",
	        "paleturquoise": "#afeeee",
	        "palevioletred": "#d87093",
	        "papayawhip": "#ffefd5",
	        "peachpuff": "#ffdab9",
	        "peru": "#cd853f",
	        "pink": "#ffc0cb",
	        "plum": "#dda0dd",
	        "powderblue": "#b0e0e6",
	        "purple": "#800080",
	        "red": "#ff0000",
	        "rosybrown": "#bc8f8f",
	        "royalblue": "#4169e1",
	        "saddlebrown": "#8b4513",
	        "salmon": "#fa8072",
	        "sandybrown": "#f4a460",
	        "seagreen": "#2e8b57",
	        "seashell": "#fff5ee",
	        "sienna": "#a0522d",
	        "silver": "#c0c0c0",
	        "skyblue": "#87ceeb",
	        "slateblue": "#6a5acd",
	        "slategray": "#708090",
	        "snow": "#fffafa",
	        "springgreen": "#00ff7f",
	        "steelblue": "#4682b4",
	        "tan": "#d2b48c",
	        "teal": "#008080",
	        "thistle": "#d8bfd8",
	        "tomato": "#ff6347",
	        "turquoise": "#40e0d0",
	        "violet": "#ee82ee",
	        "wheat": "#f5deb3",
	        "white": "#ffffff",
	        "whitesmoke": "#f5f5f5",
	        "yellow": "#ffff00",
	        "yellowgreen": "#9acd32"
	    };

	    if (typeof colors[color.toLowerCase()] != 'undefined')
	        return colors[color.toLowerCase()];

	    return color;

	}

	function makeGradientColor(color1, color2, percent) {

		var newColor = {};

		function makeChannel(a, b) {
			return(a + Math.round((b-a)*(percent/100)));
		}

		function makeColorPiece(num) {
			num = Math.min(num, 255);   // not more than 255
			num = Math.max(num, 0);     // not less than 0
			var str = num.toString(16);
			if (str.length < 2) {
				str = "0" + str;
			}
			return(str);
		}

		newColor.r = makeChannel(color1.r, color2.r);
		newColor.g = makeChannel(color1.g, color2.g);
		newColor.b = makeChannel(color1.b, color2.b);
		newColor.cssColor = "#" + 
							makeColorPiece(newColor.r) + 
							makeColorPiece(newColor.g) + 
							makeColorPiece(newColor.b);

		return(newColor);

	}

})(jQuery);