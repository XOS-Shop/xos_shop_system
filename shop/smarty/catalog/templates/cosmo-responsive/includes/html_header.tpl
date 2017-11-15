[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cosmo-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.6
* descrip    : xos-shop template built with Bootstrap3 and theme cosmo                                                                    
* filename   : html_header.tpl
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
<!DOCTYPE html>
<html lang="[@{$html_header_html_lang}@]">
<head>
<meta charset="[@{$html_header_charset}@]" />

<!--


*******************************************************************
      this online shop is powered by XOS-Shop
      XOS-Shop is a free open source e-commerce system
      created by Hanspeter Zeller and licensed under GNU/GPL.
      XOS-Shop is copyright ©2012 of Hanspeter Zeller.
*******************************************************************

      	
-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="generator" content="XOS-Shop version 1.0.6, open source e-commerce system" />
<title>[@{$html_header_page_title}@][@{$html_header_add_page_title}@]</title>
[@{if $base_href}@]
<base href="[@{$base_href}@]" />
[@{/if}@]
<link rel="canonical" href="[@{$html_header_link_canonical}@]" />
[@{foreach item=hreflang from=$html_header_hreflang_link_and_code}@]
<link rel="alternate" hreflang="[@{$hreflang.lang_code}@]" href="[@{$hreflang.link}@]" />
[@{/foreach}@]
<link rel="shortcut icon" type="image/x-icon" href="[@{$images_path}@]favicon.ico" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]bootstrap.min.[@{"`$absolute_images_path`bootstrap.min.css"|filemtime}@].css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]jquery-ui-1.10.3.custom.[@{"`$absolute_images_path`jquery-ui-1.10.3.custom.css"|filemtime}@].css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]nav.[@{"`$absolute_images_path`nav.css"|filemtime}@].css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]stylesheet.[@{"`$absolute_images_path`stylesheet.css"|filemtime}@].css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]colorbox.[@{"`$absolute_images_path`colorbox.css"|filemtime}@].css" />
[@{*<link rel="stylesheet" type="text/css" href="[@{$link_to_dynamic_css}@]" />*}@]

<script type="text/javascript" src="[@{$images_path}@]jquery-1.10.2.min.[@{"`$absolute_images_path`jquery-1.10.2.min.js"|filemtime}@].js"></script>
<script type="text/javascript" src="[@{$images_path}@]jquery-ui-1.10.3.custom.min.[@{"`$absolute_images_path`jquery-ui-1.10.3.custom.min.js"|filemtime}@].js"></script>
<script type="text/javascript" src="[@{$images_path}@]jquery.scrollUp.min.[@{"`$absolute_images_path`jquery.scrollUp.min.js"|filemtime}@].js"></script>
<script type="text/javascript" src="[@{$images_path}@]quick_search_suggest.[@{"`$absolute_images_path`quick_search_suggest.js"|filemtime}@].js"></script>
<script type="text/javascript" src="[@{$images_path}@]jquery.colorbox-min.[@{"`$absolute_images_path`jquery.colorbox-min.js"|filemtime}@].js"></script>
<script type="text/javascript" src="[@{$languages_path}@]jquery.colorbox-language.[@{"`$absolute_images_path``$smarty.session.language`/jquery.colorbox-language.js"|filemtime}@].js"></script>
<script type="text/javascript" src="[@{$images_path}@]bootstrap.min.[@{"`$absolute_images_path`bootstrap.min.js"|filemtime}@].js"></script>
<script type="text/javascript" src="[@{$images_path}@]jquery.doubletaptogo.min.[@{"`$absolute_images_path`jquery.doubletaptogo.min.js"|filemtime}@].js"></script>
<script type="text/javascript" src="[@{$images_path}@]general.[@{"`$absolute_images_path`general.js"|filemtime}@].js"></script>
[@{*<script type="text/javascript" src="[@{$link_to_dynamic_js}@]"></script>*}@]
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]nav_ie8.[@{"`$absolute_images_path`nav_ie8.css"|filemtime}@].css" />
<script type="text/javascript" src="[@{$images_path}@]respond.min.[@{"`$absolute_images_path`respond.min.js"|filemtime}@].js"></script> 
<![endif]-->

<style>
  body {overflow-y: scroll;}
</style>
[@{$add_headTag_elements}@]
</head>
