[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons                                                                     
* filename   : attribute_lists.tpl
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
[@{if $action == 'combinations'}@]                                                                             
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td nowrap="nowrap" class="smallText"><b>[@{#table_heading_product#}@]</b></td>
    <td nowrap="nowrap" class="smallText" align="center"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="20" height="1" /><b>[@{#text_product_status#}@]</b></td>
  </tr> 
  <tr>
    <td nowrap="nowrap" class="smallText">[@{$products_name}@]</td>
    <td nowrap="nowrap" class="smallText" align="center"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="20" height="1" /><span style="background: green;">[@{$radio_products_status_1}@]</span>&nbsp;<span style="background: red;">[@{$radio_products_status_0}@]</span></td>
  </tr>                                                   
</table>                       
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td nowrap="nowrap" class="smallText"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" /></td>
  </tr>                                                    
</table>                                             
<table border="0" cellspacing="0" cellpadding="0"> 
  <tr>
  [@{foreach name=names item=options_name from=$combinations.options_names}@]
    <td nowrap="nowrap" class="smallText">[@{if !$smarty.foreach.names.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@]<b>[@{$options_name.options_name}@]</b></td>
  [@{/foreach}@] 
    <td nowrap="nowrap" class="smallText" align="center">&nbsp;&nbsp;&nbsp;<b>[@{#text_in_stock#}@]</b></td>
    <td nowrap="nowrap" class="smallText">&nbsp;&nbsp;&nbsp;<b>[@{#text_offer#}@]</b></td>                           
  </tr>                        
  [@{foreach name=values_outer item=option_values from=$combinations.options_values}@]
  <tr> 
  [@{foreach name=values_inner item=data from=$option_values}@]
    <td nowrap="nowrap" class="smallText" [@{if $smarty.foreach.values_inner.last}@]align="center"[@{/if}@]>[@{if !$smarty.foreach.values_inner.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@][@{$data}@]</td>
  [@{/foreach}@]                          
  </tr>
  [@{/foreach}@]                                                                                              
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" nowrap="nowrap" class="smallText"><a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); toggle_box_sort(); return false" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="update_action('[@{$products_id}@]', '', 'update_combinations'); attribute.submit(); return false" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>
  </tr>                                                    
</table>
[@{elseif $action == 'options_sort'}@]
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td nowrap="nowrap" class="smallText"><b>[@{#table_heading_product#}@]</b></td>
    <td nowrap="nowrap" class="smallText">&nbsp;&nbsp;<b>[@{#table_heading_sort_order#}@]</b>&nbsp;&nbsp;</td>
    <td nowrap="nowrap" class="smallText"><b>[@{#table_heading_opt_name#}@]</b></td>
  </tr>
  [@{foreach name=attributes_option_sort item=option_sort from=$options_sort}@]
  <tr>
    <td nowrap="nowrap" class="smallText">[@{if $smarty.foreach.attributes_option_sort.first}@][@{$option_sort.products_name}@][@{/if}@]</td>
    <td nowrap="nowrap" class="smallText" align="center">[@{$option_sort.options_sort_order}@]</td>
    <td nowrap="nowrap" class="smallText">&nbsp;[@{$option_sort.options_name}@]</td>
  </tr>
  [@{/foreach}@]                                              
  <tr>
    <td colspan="3" nowrap="nowrap" class="smallText"><a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); toggle_box_sort(); return false" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="update_action('[@{$products_id}@]', '', 'update_options_sort_order'); attribute.submit(); return false" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>
  </tr>                         
</table>  
[@{elseif $action == 'options_values_sort'}@]
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td nowrap="nowrap" class="smallText"><b>[@{#table_heading_opt_name#}@]</b></td>
    <td nowrap="nowrap" class="smallText">&nbsp;&nbsp;<b>[@{#table_heading_sort_order#}@]</b>&nbsp;&nbsp;</td>
    <td nowrap="nowrap" class="smallText"><b>[@{#table_heading_opt_value#}@]</b></td>
  </tr>
  [@{foreach name=attributes_option_values_sort item=option_values_sort from=$options_values_sort}@]
  <tr>
    <td nowrap="nowrap" class="smallText">[@{if $smarty.foreach.attributes_option_values_sort.first}@][@{$option_values_sort.options_name}@][@{/if}@]</td>
    <td nowrap="nowrap" class="smallText" align="center">[@{$option_values_sort.options_values_sort_order}@]</td>
    <td nowrap="nowrap" class="smallText">&nbsp;[@{$option_values_sort.options_values_name}@]</td>
  </tr>
  [@{/foreach}@] 
  <tr>
    <td colspan="3" nowrap="nowrap" class="smallText"><a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); toggle_box_sort(); return false" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="update_action('[@{$products_id}@]', '[@{$options_id}@]', 'update_options_values_sort_order'); attribute.submit(); return false" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>
  </tr>                         
</table>  
[@{/if}@]                                                                                          
</body>
</html>