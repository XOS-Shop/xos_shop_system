[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7t
* descrip    : xos-shop extra template with popup windows as lightboxes 
*              and div/css layout                                                                     
* filename   : css.tpl
* author     : Hanspeter Zeller <hpz@xos-shop.com>
* copyright  : Copyright (c) 2007 Hanspeter Zeller
* license    : This file is part of XOS-Shop.
*
*              XOS-Shop is free software: you can redistribute it and/or modify
*              it under the terms of the GNU General Public License as published
*              by the Free Software Foundation, either version 3 of the License,
*              or (at your option) any later version.
*
*              XOS-Shop is distributed in the hope that it will be useful,
*              but WITHOUT ANY WARRANTY; without even the implied warranty of
*              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*              GNU General Public License for more details.
*
*              You should have received a copy of the GNU General Public License
*              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>. 
********************************************************************************
*}@]
/* IE6 */

.fancybox-ie6 #fancybox-close { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_close.png', sizingMethod='scale'); }
.fancybox-ie6 #fancybox-left-ico { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_nav_left.png', sizingMethod='scale'); }
.fancybox-ie6 #fancybox-right-ico { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_nav_right.png', sizingMethod='scale'); }
.fancybox-ie6 #fancybox-title-over { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_title_over.png', sizingMethod='scale'); zoom: 1; }
.fancybox-ie6 #fancybox-title-float-left { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_title_left.png', sizingMethod='scale'); }
.fancybox-ie6 #fancybox-title-float-main { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_title_main.png', sizingMethod='scale'); }
.fancybox-ie6 #fancybox-title-float-right { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_title_right.png', sizingMethod='scale'); }
.fancybox-ie6 #fancybox-bg-w, .fancybox-ie6 #fancybox-bg-e, .fancybox-ie6 #fancybox-left, .fancybox-ie6 #fancybox-right, #fancybox-hide-sel-frame { height: expression(this.parentNode.clientHeight + "px"); }
#fancybox-loading.fancybox-ie6 { position: absolute; margin-top: 0; top: expression( (-20 + (document.documentElement.clientHeight ? document.documentElement.clientHeight/2 : document.body.clientHeight/2 ) + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop )) + 'px'); }
#fancybox-loading.fancybox-ie6 div { background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_loading.png', sizingMethod='scale'); }

/* IE6, IE7, IE8 */

.fancybox-ie .fancybox-bg { background: transparent !important; }
.fancybox-ie #fancybox-bg-n { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_shadow_n.png', sizingMethod='scale'); }
.fancybox-ie #fancybox-bg-ne { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_shadow_ne.png', sizingMethod='scale'); }
.fancybox-ie #fancybox-bg-e { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_shadow_e.png', sizingMethod='scale'); }
.fancybox-ie #fancybox-bg-se { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_shadow_se.png', sizingMethod='scale'); }
.fancybox-ie #fancybox-bg-s { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_shadow_s.png', sizingMethod='scale'); }
.fancybox-ie #fancybox-bg-sw { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_shadow_sw.png', sizingMethod='scale'); }
.fancybox-ie #fancybox-bg-w { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_shadow_w.png', sizingMethod='scale'); }
.fancybox-ie #fancybox-bg-nw { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[@{$images_path}@]fancy_shadow_nw.png', sizingMethod='scale'); }

/* Put here your css code */