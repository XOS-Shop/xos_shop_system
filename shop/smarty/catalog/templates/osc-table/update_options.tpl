[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0.3
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
* filename   : update_options.tpl
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<title></title>
</head>
<body>
<div id="loading" class="main" style="visibility: hidden; width: 100%; position:relative; left:0px; top:0px;">
  <div style="position:absolute; width:100%; display:block;">             
    [@{#text_loading#}@]
  </div> 
</div> 
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="2" class="pageHeading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="6" /><br /><span class="main"><b>[@{#text_product_options#}@]</b></span><br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="6" /></td>
  </tr>               
  [@{foreach item=product_option from=$products_options}@]      
  <tr>
    <td width="1%" nowrap="nowrap" class="main">[@{$product_option.products_options_name}@] : </td>
    <td width="99%" nowrap="nowrap" class="main">[@{$product_option.products_options_pull_down}@]</td>
  </tr>
  [@{/foreach}@]
  [@{if $qty_for_these_options}@] 
  <tr>
    <td colspan="2" nowrap="nowrap" width="100%" class="main"><div style="width:60%; float:left;">[@{#text_in_stock_with_these_options#}@]&nbsp;[@{$qty_for_these_options}@]</div><div class="smallText" style="float:right;"><a href="" style="text-decoration:underline;" onclick="[@{$get_otions_list}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" style="text-decoration:none;" onclick="[@{$get_otions_list}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div><div class="clear">&nbsp;</div></td> 
  </tr>
  [@{else}@]
  <tr>
    <td colspan="2" nowrap="nowrap" width="100%" class="main"><div style="width:60%; float:left;">&nbsp;</div><div class="smallText" style="float:right;"><a href="" style="text-decoration:underline;" onclick="[@{$get_otions_list}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" style="text-decoration:none;" onclick="[@{$get_otions_list}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div><div class="clear">&nbsp;</div></td>
  </tr>
  [@{/if}@]     
</table>
</body>
</html>