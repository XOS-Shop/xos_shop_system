[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.1
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
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
[@{if $action == 'combinations'}@]                                                                             
<table class="attribute_lists">
  <tr>
    <td><b>[@{#table_heading_product#}@]</b></td>
    <td class="text-center"><b>[@{#text_product_status#}@]</b></td>
  </tr> 
  <tr>
    <td>[@{$products_name}@]</td>
    <td class="text-center"><span style="background: green;">[@{$radio_products_status_1}@]</span>&nbsp;<span style="background: red;">[@{$radio_products_status_0}@]</span></td>
  </tr>                                                   
</table>                       
<table class="attribute_lists">
  <tr>
    <td>&nbsp;</td>
  </tr>                                                    
</table>                                             
<table class="attribute_lists"> 
  <tr>
  [@{foreach name=names item=options_name from=$combinations.options_names}@]
    <td>[@{if !$smarty.foreach.names.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@]<b>[@{$options_name.options_name}@]</b></td>
  [@{/foreach}@] 
    <td class="text-center">&nbsp;&nbsp;&nbsp;<b>[@{#text_in_stock#}@]</b></td>
    <td>&nbsp;&nbsp;&nbsp;<b>[@{#text_offer#}@]</b></td>                           
  </tr>                        
  [@{foreach name=values_outer item=option_values from=$combinations.options_values}@]
  <tr> 
  [@{foreach name=values_inner item=data from=$option_values}@]
    <td [@{if $smarty.foreach.values_inner.last}@]class="text-center"[@{/if}@]>[@{if !$smarty.foreach.values_inner.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@][@{$data}@]</td>
  [@{/foreach}@]                          
  </tr>
  [@{/foreach}@]                                                                                              
</table>
<div><a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); toggle_box_sort(); return false" class="btn btn-default btn-xs btn-margin-attribut_list pull-right" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="update_action('[@{$products_id}@]', '', 'update_combinations'); attribute.submit(); return false" class="btn btn-default btn-xs btn-margin-attribut_list pull-right" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a></div>
[@{elseif $action == 'options_sort'}@]
<table class="attribute_lists">
  <tr>
    <td><b>[@{#table_heading_product#}@]</b></td>
    <td>&nbsp;&nbsp;<b>[@{#table_heading_sort_order#}@]</b>&nbsp;&nbsp;</td>
    <td><b>[@{#table_heading_opt_name#}@]</b></td>
  </tr>
  [@{foreach name=attributes_option_sort item=option_sort from=$options_sort}@]
  <tr>
    <td>[@{if $smarty.foreach.attributes_option_sort.first}@][@{$option_sort.products_name}@][@{/if}@]</td>
    <td class="text-center">[@{$option_sort.options_sort_order}@]</td>
    <td>&nbsp;[@{$option_sort.options_name}@]</td>
  </tr>
  [@{/foreach}@]
</table>                                                 
<div><a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); toggle_box_sort(); return false" class="btn btn-default btn-xs btn-margin-attribut_list pull-right" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="update_action('[@{$products_id}@]', '', 'update_options_sort_order'); attribute.submit(); return false" class="btn btn-default btn-xs btn-margin-attribut_list pull-right" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a></div> 
[@{elseif $action == 'options_values_sort'}@]
<table class="attribute_lists">
  <tr>
    <td><b>[@{#table_heading_opt_name#}@]</b></td>
    <td>&nbsp;&nbsp;<b>[@{#table_heading_sort_order#}@]</b>&nbsp;&nbsp;</td>
    <td><b>[@{#table_heading_opt_value#}@]</b></td>
  </tr>
  [@{foreach name=attributes_option_values_sort item=option_values_sort from=$options_values_sort}@]
  <tr>
    <td>[@{if $smarty.foreach.attributes_option_values_sort.first}@][@{$option_values_sort.options_name}@][@{/if}@]</td>
    <td class="text-center">[@{$option_values_sort.options_values_sort_order}@]</td>
    <td>&nbsp;[@{$option_values_sort.options_values_name}@]</td>
  </tr>
  [@{/foreach}@] 
</table>
<div><a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); toggle_box_sort(); return false" class="btn btn-default btn-xs btn-margin-attribut_list pull-right" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="update_action('[@{$products_id}@]', '[@{$options_id}@]', 'update_options_values_sort_order'); attribute.submit(); return false" class="btn btn-default btn-xs btn-margin-attribut_list pull-right" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a></div>  
[@{/if}@]