/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

!function(a){function o(){}a.extend(o.prototype,{name:"ZooItemOrder",initialize:function(t){var e=this;this.input=t,this.application=a("body").find(".zoo-application select.application"),this.application.length&&(t.find("select.element, input:checkbox").each(function(){a(this).data("_name",a(this).attr("name"))}),this.application.bind("change",function(){e.refresh()}),this.refresh())},refresh:function(){var e=this.application.val();e?this.input.find(".select-message").hide().nextAll().show():this.input.find(".select-message").show().nextAll().hide(),this.input.find(".apps .app").each(function(){var t=a(this);t.find("select.element, input:checkbox").attr("name",function(){return e&&t.hasClass(e)?a(this).data("_name"):""}),e&&t.hasClass(e)?t.show():t.hide()})}}),a.fn[o.prototype.name]=function(){var i=arguments,n=i[0]?i[0]:null;return this.each(function(){var t=a(this);if(o.prototype[n]&&t.data(o.prototype.name)&&"initialize"!=n)t.data(o.prototype.name)[n].apply(t.data(o.prototype.name),Array.prototype.slice.call(i,1));else if(!n||a.isPlainObject(n)){var e=new o;o.prototype.initialize&&e.initialize.apply(e,a.merge([t],i)),t.data(o.prototype.name,e)}else a.error("Method "+n+" does not exist on jQuery."+o.name)})}}(jQuery);