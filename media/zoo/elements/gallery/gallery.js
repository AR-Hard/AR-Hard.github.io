/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

!function(n){function a(){}n.extend(a.prototype,{name:"opacity",initialize:function(e){console.log(e),e.each(function(){var e=n(this).find("img");e.css("opacity",.3),n(this).bind("mouseenter",function(){e.fadeTo("fast",1)}).bind("mouseleave",function(){e.fadeTo("slow",.3)})})}}),n.fn[a.prototype.name]=function(){var o=arguments,i=o[0]?o[0]:null;return this.each(function(){var e=n(this);if(a.prototype[i]&&e.data(a.prototype.name)&&"initialize"!=i)e.data(a.prototype.name)[i].apply(e.data(a.prototype.name),Array.prototype.slice.call(o,1));else if(!i||n.isPlainObject(i)){var t=new a;a.prototype.initialize&&t.initialize.apply(t,n.merge([e],o)),e.data(a.prototype.name,t)}else n.error("Method "+i+" does not exist on jQuery."+a.name)})}}(jQuery);