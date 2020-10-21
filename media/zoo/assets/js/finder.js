/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

!function(a){function o(){}a.extend(o.prototype,{name:"finder",initialize:function(n,e){var o=this;this.options=a.extend({url:"",path:"",open:"open",loading:"loading"},e),n.data("path",this.options.path).bind("retrieve:finder",function t(e){e.preventDefault();var i=a(this).closest("li",n);i.length||(i=n);i.hasClass(o.options.open)?i.removeClass(o.options.open).children("ul").slideUp():(i.addClass(o.options.loading),a.post(o.options.url,{path:i.data("path")},function(e){i.removeClass(o.options.loading).addClass(o.options.open),e.length&&(i.children().remove("ul"),i.append("<ul>").children("ul").hide(),a.each(e,function(e,t){i.children("ul").append(a('<li><a href="#">'+t.name+"</a></li>").addClass(t.type).data("path",t.path))}),i.find("ul a").bind("click",t),i.children("ul").slideDown())},"json"))}).trigger("retrieve:finder")}}),a.fn[o.prototype.name]=function(){var i=arguments,n=i[0]?i[0]:null;return this.each(function(){var e=a(this);if(o.prototype[n]&&e.data(o.prototype.name)&&"initialize"!=n)e.data(o.prototype.name)[n].apply(e.data(o.prototype.name),Array.prototype.slice.call(i,1));else if(!n||a.isPlainObject(n)){var t=new o;o.prototype.initialize&&t.initialize.apply(t,a.merge([e],i)),e.data(o.prototype.name,t)}else a.error("Method "+n+" does not exist on jQuery."+o.name)})}}(jQuery),function(l){function o(){}l.extend(o.prototype,{name:"Directories",initialize:function(i,e){this.options=l.extend({url:"",title:"Folders",mode:"folder",msgDelete:"Delete"},e);var n=this,o=l('<div class="finder" />').insertAfter(i).finder(this.options).delegate("a","click",function(e){o.find("li").removeClass("selected");var t=l(this).parent().addClass("selected");"file"==n.options.mode&&!t.hasClass("file")||i.focus().val(t.data("path")).blur()}),t=o.dialog(l.extend({autoOpen:!1,resizable:!1,open:function(){t.position({of:a,my:"center top",at:"center bottom"})}},this.options)).dialog("widget"),a=l('<span title="'+this.options.title+'" class="'+this.options.mode+'s" />').insertAfter(i).bind("click",function(){o.dialog(o.dialog("isOpen")?"close":"open")});l('<span title="'+this.options.msgDelete+'" class="delete-file" />').insertAfter(a).bind("click",function(){i.val("")}),l("body").bind("click",function(e){!o.dialog("isOpen")||a.is(e.target)||t.find(e.target).length||o.dialog("close")})}}),l.fn[o.prototype.name]=function(){var i=arguments,n=i[0]?i[0]:null;return this.each(function(){var e=l(this);if(o.prototype[n]&&e.data(o.prototype.name)&&"initialize"!=n)e.data(o.prototype.name)[n].apply(e.data(o.prototype.name),Array.prototype.slice.call(i,1));else if(!n||l.isPlainObject(n)){var t=new o;o.prototype.initialize&&t.initialize.apply(t,l.merge([e],i)),e.data(o.prototype.name,t)}else l.error("Method "+n+" does not exist on jQuery."+o.name)})}}(jQuery);