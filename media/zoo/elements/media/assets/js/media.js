/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

!function(o){function r(){}o.extend(r.prototype,{name:"ElementMedia",initialize:function(t){var i=this;this.file_row=t.find("input:text.file").parent(),this.file_button=t.find(".trigger .file"),this.poster_button=t.find(".trigger .poster"),this.url_row=t.find("input:text.url").parent(),this.url_button=t.find(".trigger .url"),this.url_row.css("margin-top","0"),this.file_button.bind("click",function(){i.file_row.prependTo(t),i.url_row.detach(),i.file_button.hide(),i.poster_button.show(),i.url_button.show()}),this.url_button.bind("click",function(){i.file_row.detach(),i.url_row.prependTo(t),i.file_button.show(),i.poster_button.hide(),i.url_button.hide()}),t.find("input:text.file").val()?this.file_button.trigger("click"):this.url_button.trigger("click")}}),o.fn[r.prototype.name]=function(){var e=arguments,n=e[0]?e[0]:null;return this.each(function(){var t=o(this);if(r.prototype[n]&&t.data(r.prototype.name)&&"initialize"!=n)t.data(r.prototype.name)[n].apply(t.data(r.prototype.name),Array.prototype.slice.call(e,1));else if(!n||o.isPlainObject(n)){var i=new r;r.prototype.initialize&&i.initialize.apply(i,o.merge([t],e)),t.data(r.prototype.name,i)}else o.error("Method "+n+" does not exist on jQuery."+r.name)})}}(jQuery);