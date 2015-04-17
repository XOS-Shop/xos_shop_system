[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7x
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
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

<meta name="generator" content="XOS-Shop version 1.0 rc7x, open source e-commerce system" />
<title>[@{$html_header_page_title}@][@{$html_header_add_page_title}@]</title>
<base href="[@{$base_href}@]" />
<link rel="shortcut icon" type="image/x-icon" href="[@{$images_path}@]favicon.ico" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]nav.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]buttons.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]stylesheet.css" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]jquery.fancybox-1.3.4.css" />
<link rel="stylesheet" type="text/css" href="[@{$link_to_dynamic_css}@]" />

<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]stylesheet_lte_ie6.css" />
<![endif]-->

<script type="text/javascript" src="[@{$images_path}@]jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="[@{$images_path}@]jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="[@{$images_path}@]quick_search_suggest.js"></script>
<script type="text/javascript" src="[@{$images_path}@]jquery.mousewheel.js"></script>  
<script type="text/javascript" src="[@{$images_path}@]jquery.fancybox-1.3.4.patch.pack.js"></script>
<script type="text/javascript" src="[@{$link_to_dynamic_js}@]"></script>
</head>
<body>
<table width="100%" style="min-width : 450px;" border="0" cellspacing="0" cellpadding="0">
  <tr>   
    <td width="1%">&nbsp;</td>
    <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      [@{if $heading_title}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{$heading_title}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_specials.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></td>
          </tr>
        </table></td>
      </tr>
      [@{/if}@]
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">[@{$content}@]</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
    </table></td>
    <td width="1%">&nbsp;</td>            
  </tr>
</table>    
[@{$end_tags}@]