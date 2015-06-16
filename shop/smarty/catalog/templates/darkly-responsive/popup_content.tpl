[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : darkly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7z
* descrip    : xos-shop template built with Bootstrap3 and theme darkly                                                                    
* filename   : popup_content.tpl
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
<html lang="[@{$html_header_xhtml_lang}@]">
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
<meta name="generator" content="XOS-Shop version 1.0 rc7z, open source e-commerce system" />
<title>[@{$html_header_page_title}@][@{$html_header_add_page_title}@]</title>
<base href="[@{$base_href}@]" />
<link rel="shortcut icon" type="image/x-icon" href="[@{$images_path}@]favicon.ico" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]nav.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]stylesheet.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]colorbox.css" />
[@{*<link rel="stylesheet" type="text/css" href="[@{$link_to_dynamic_css}@]" />*}@]

<script type="text/javascript" src="[@{$images_path}@]jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="[@{$images_path}@]jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="[@{$images_path}@]quick_search_suggest.js"></script>
<script type="text/javascript" src="[@{$images_path}@]jquery.colorbox-min.js"></script>
<script type="text/javascript" src="[@{$languages_path}@]jquery.colorbox-language.js"></script>
<script type="text/javascript" src="[@{$images_path}@]bootstrap.min.js"></script>
<script type="text/javascript" src="[@{$images_path}@]general.js"></script>
[@{*<script type="text/javascript" src="[@{$link_to_dynamic_js}@]"></script>*}@]
<!--[if lt IE 9]>
<script type="text/javascript" src="[@{$images_path}@]respond.min.js"></script> 
<![endif]-->
</head>
<body style="text-align : left;">
          <div style="margin: 0 6px 0 6px; min-width : 250px; text-align : left;">
            <h1 class="text-orange">[@{$heading_title}@]</h1>        
            <div class="div-spacer-h10"></div>          
            <div>[@{$content}@]</div>
            <div class="div-spacer-h10"></div>
          </div>
[@{$end_tags}@]
