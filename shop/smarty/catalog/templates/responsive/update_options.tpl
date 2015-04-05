[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7w
* descrip    : xos-shop default template built with Bootstrap3                                                                   
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
<!DOCTYPE html>
<html>
<head>
<meta content="charset=UTF-8" />
<title></title>
</head>
<body>
<div id="loading" style="visibility: hidden; width: 100%; position:relative; left:0px; top:0px;">
  <div style="position:absolute; width:100%; display:block; margin:0 auto; text-align:center;">             
    [@{#text_loading#}@]
  </div> 
</div> 
<div class="clearfix">                   
[@{foreach name=options_name item=product_option from=$products_options}@]      
  <div class="form-group">
    <label for="option_[@{$product_option.products_options_id}@]">[@{$product_option.products_options_name}@]:</label>
    [@{$product_option.products_options_pull_down}@]
  </div>          
[@{/foreach}@]
</div>                                                    
[@{if $qty_for_these_options}@]
  <div class="clearfix"><div style="float:left;">[@{#text_in_stock_with_these_options#}@]<b>[@{$qty_for_these_options}@]</b>&nbsp;</div><div style="float:right;"><a href="" class="text-deco-underline" onclick="[@{$get_otions_list}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" class="text-deco-underline-hover-none" onclick="[@{$get_otions_list}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div></div>
[@{else}@]
  <div class="clearfix"><div style="float:left;">&nbsp;</div><div style="float:right;"><a href="" class="text-deco-underline" onclick="[@{$get_otions_list}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" class="text-deco-underline-hover-none" onclick="[@{$get_otions_list}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div></div>
[@{/if}@]
</body>
</html>