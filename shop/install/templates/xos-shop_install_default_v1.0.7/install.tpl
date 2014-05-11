{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xos-shop_install_default_v1.0.7
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s                                                                     
* filename   : install.tpl
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

*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{#lang_code#}" xml:lang="{#lang_code#}">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="{#lang_code#}" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<meta name="generator" content="XOS-Shop version 1.0 rc7s, open source e-commerce system" />
<title>XOS-Shop</title>
<link rel="stylesheet" type="text/css" href="{$css_path}stylesheet.css" />
<script type="text/javascript" src="{$js_path}toggle_xmlhttp.js"></script>
</head>
<body bgcolor="#ffffff" {$body_tag_params}>
<div id="spacer"></div>
<div id="content">
<table width="75%" cellpadding="0" cellspacing="0" border="0" align="center">
  <tr class="logo-head">
    <td><img src="{$images_path}xos-shop_project_logo.gif" border="0" alt="XOS-Shop" title=" XOS-Shop " /></td>
    <td align="right" class="nav-head" nowrap="nowrap"><a href="http://www.xos-shop.com" target="_blank" class="nav-head">{#header_title_support_site#}</a>&nbsp;&nbsp;</td>
  </tr>  
  <tr>           
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="main">
        <td><table width="85%" cellpadding="0" cellspacing="0" border="0"  align="center">
          <tr>         
            <td>            
            <br />
            {$install_inner_content}
            <br />                                     
            </td>        
          </tr>
        </table></td>                                       
      </tr>
    </table></td>                                             
  </tr>   
  <tr>
    <td class="smallText" colspan="2"><img src="{$images_path}pixel_trans.gif" border="0" alt="" width="900" height="2" /></td>
  </tr>
  <tr>  
    <td colspan="2" align="center"><table border="0" cellspacing="0" cellpadding="0">
      <tr>        
        <td nowrap="nowrap" align="left" class="smallText">                               
          <a href="http://www.xos-shop.com"  target="_blank"><b>XOS-Shop open source e-commerce system</b></a>, Copyright © 2012 Hanspeter Zeller<br />XOS-Shop comes with ABSOLUTELY NO WARRANTY; <a href="./includes/LICENSE.html#section15" target="_blank">click for details</a>. This is free<br />software, and you can redistribute it under certain conditions; <a href="./includes/LICENSE.html#terms" target="_blank">click for details</a>.
        </td>
      </tr>    
    </table></td>
  </tr>            
</table>
</div>
</body>
</html>
