[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : popup_image.tpl
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="[@{$html_header_xhtml_lang}@]" xml:lang="[@{$html_header_xhtml_lang}@]">
<head>
<meta http-equiv="content-type" content="text/html; charset=[@{$html_header_charset}@]" />
<meta http-equiv="content-language" content="[@{$html_header_xhtml_lang}@]" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />

<!--


*******************************************************************
      this online shop is powered by XOS-Shop
      XOS-Shop is a free open source e-commerce system
      created by Hanspeter Zeller and licensed under GNU/GPL.
      XOS-Shop is copyright ©2012 of Hanspeter Zeller.
*******************************************************************

      	
-->

<meta name="generator" content="XOS-Shop version 1.0 rc7s, open source e-commerce system" />
<title>[@{$html_header_page_title}@][@{$html_header_add_page_title}@]</title>
<link rel="shortcut icon" type="image/x-icon" href="[@{$images_path}@]favicon.ico" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]nav.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]buttons.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]stylesheet.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]jquery.fancybox-1.3.4.css" />
<link rel="stylesheet" type="text/css" href="[@{$link_to_dynamic_css}@]" />
</head>
<body style="background : #fff; color : #000;">
          <div style="height: [@{$blind_image_height}@]px; padding-bottom: 10px;"><div style="padding-top: [@{$image_padding_top}@]px;">[@{$popup_image}@]</div></div>
          [@{if $small_images}@]
          <div style="width: [@{$thumb_width_total}@]px; margin: 0 auto">[@{$small_images}@]</div>          
          <div class="clear">&nbsp;</div>
          [@{/if}@]
[@{$end_tags}@]
