/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

!function(n){function d(){}n.extend(d.prototype,{name:"ElementRepeatableTextarea",initialize:function(e){var t=e.find("ul.repeatable-list");t.find("li.hidden").each(function(){n(this).find("*").each(function(){n(this).attr("name")&&(n(this).data("name",n(this).attr("name")),n(this).attr("name",""))})}),e.delegate("span.delete","click",function(){n(this).closest("li.repeatable-element").fadeOut(200,function(){n(this).addClass("hidden"),n(this).find("*").each(function(){n(this).attr("name")&&n(this).attr("name","")})})}),e.find("p.add a").bind("click",function(){var e=n(t.find("li.hidden").get(0)).removeClass("hidden");e.find("*").each(function(){n(this).data("name")&&n(this).attr("name",n(this).data("name"))}),e.find("div.repeatable-content").effect("highlight",{},1e3),0==t.find("li.hidden").length&&n(this).parent().hide()})}}),n.fn[d.prototype.name]=function(){var i=arguments,a=i[0]?i[0]:null;return this.each(function(){var e=n(this);if(d.prototype[a]&&e.data(d.prototype.name)&&"initialize"!=a)e.data(d.prototype.name)[a].apply(e.data(d.prototype.name),Array.prototype.slice.call(i,1));else if(!a||n.isPlainObject(a)){var t=new d;d.prototype.initialize&&t.initialize.apply(t,n.merge([e],i)),e.data(d.prototype.name,t)}else n.error("Method "+a+" does not exist on jQuery."+d.name)})}}(jQuery);