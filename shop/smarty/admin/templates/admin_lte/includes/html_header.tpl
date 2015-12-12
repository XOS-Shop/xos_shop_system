[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0 rc9
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
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
<html lang="[@{$xhtml_lang}@]">
<head>
<meta charset="[@{$charset}@]">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="generator" content="XOS-Shop version 1.0 rc9, open source e-commerce system">
<title>[@{$project_title}@][@{$add_title}@]</title>
[@{if $base_href}@]
<base href="[@{$base_href}@]">
[@{/if}@]
<link rel="shortcut icon" type="image/x-icon" href="[@{$images_path}@]favicon.ico">
<link rel="stylesheet" href="[@{$images_path}@]bootstrap.min.css">
<link rel="stylesheet" href="[@{$images_path}@]font-awesome.min.css">
<link rel="stylesheet" href="[@{$images_path}@]ionicons.min.css">
<link rel="stylesheet" href="[@{$images_path}@]AdminLTE.min.css">
<link rel="stylesheet" href="[@{$images_path}@]skins/skin-purple.min.css">
<link rel="stylesheet" href="[@{$images_path}@]jquery-ui-1.10.3.custom.css">
<link rel="stylesheet" href="[@{$images_path}@]style.css">

<script src="[@{$images_path}@]jQuery-2.1.4.min.js"></script>
<script src="[@{$images_path}@]bootstrap.min.js"></script>
<script src="[@{$images_path}@]jquery.slimscroll.min.js"></script>
<script src="[@{$images_path}@]fastclick.min.js"></script>
<script src="[@{$images_path}@]app.min.js"></script>
<script src="[@{$images_path}@]jquery-ui-1.10.3.custom.min.js"></script>
[@{$style}@][@{$javascript}@]</head>