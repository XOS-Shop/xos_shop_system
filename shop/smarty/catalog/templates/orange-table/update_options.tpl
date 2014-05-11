[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                    
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
  <div style="position:absolute; width:100%; display:block; margin:0 auto; text-align:center;">             
    [@{#text_loading#}@]
  </div> 
</div> 
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td nowrap="nowrap" width="100%" class="main"><b>[@{#text_product_options#}@]</b></td>
  </tr>                    
  <tr>
    <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="3" class="product-listing">                    
      [@{foreach item=product_option from=$products_options}@]      
      <tr class="info-box-central-contents">
        <td class="main" style="white-space: nowrap; font-weight: bold;">[@{$product_option.products_options_name}@]:</td>
      </tr>
      <tr class="info-box-central-contents">
        <td class="products-options-pull-down">[@{$product_option.products_options_pull_down}@]</td>
      </tr>      
      [@{/foreach}@]      
      [@{if $qty_for_these_options}@] 
      <tr class="info-box-central-contents">
        <td colspan="2" style="white-space: nowrap; font-weight: bold;" width="100%" class="main"><div style="width:60%; float:left;">[@{#text_in_stock_with_these_options#}@]&nbsp;[@{$qty_for_these_options}@]</div><div class="small-text" style="float:right;"><a href="" style="text-decoration:underline;" onclick="[@{$get_otions_list}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" style="text-decoration:none;" onclick="[@{$get_otions_list}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div><div class="clear">&nbsp;</div></td> 
      </tr>
      [@{else}@]
      <tr class="info-box-central-contents">
        <td colspan="2" style="white-space: nowrap; font-weight: bold;" width="100%" class="main"><div style="width:60%; float:left;">&nbsp;</div><div class="small-text" style="float:right;"><a href="" style="text-decoration:underline;" onclick="[@{$get_otions_list}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" style="text-decoration:none;" onclick="[@{$get_otions_list}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div><div class="clear">&nbsp;</div></td>
      </tr>
      [@{/if}@]                                                 
    </table></td>               
  </tr>
</table>
</body>
</html> 