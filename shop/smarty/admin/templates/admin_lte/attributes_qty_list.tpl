[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.4
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : attributes_qty_list.tpl
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
[@{if $input_attributes_quantities.options_names}@]
<table class="attributes_qty_list"> 
  <tr>
  [@{foreach name=names item=options_name from=$input_attributes_quantities.options_names}@]
    <td>[@{if !$smarty.foreach.names.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@]<b>[@{$options_name.options_name}@]</b></td>
  [@{/foreach}@] 
    <td class="text-center">&nbsp;&nbsp;&nbsp;<b>[@{#text_in_stock#}@]</b></td>                         
  </tr>                        
  [@{foreach name=values_outer item=option_values from=$input_attributes_quantities.options_values}@]
  <tr> 
  [@{foreach name=values_inner item=data from=$option_values}@]
    <td [@{if $smarty.foreach.values_inner.last}@]class="text-right"[@{/if}@]>[@{if !$smarty.foreach.values_inner.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@][@{$data}@]</td>
  [@{/foreach}@]                          
  </tr>
  [@{/foreach}@]                                                                                              
</table>                      
[@{elseif $input_attributes_quantities.options_error}@]                      
<table class="attributes_qty_list"> 
  <tr>
    <td><b>[@{#text_options_error#}@]</b></td>                         
  </tr>                                                                                                                      
</table>                                                                  
[@{/if}@]