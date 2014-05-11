[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons                                                                     
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
[@{if $input_attributes_quantities.options_names}@]
<table border="0" cellspacing="1" cellpadding="0"> 
  <tr>
  [@{foreach name=names item=options_name from=$input_attributes_quantities.options_names}@]
    <td nowrap="nowrap" class="smallText">[@{if !$smarty.foreach.names.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@]<b>[@{$options_name.options_name}@]</b></td>
  [@{/foreach}@] 
    <td nowrap="nowrap" class="smallText" align="center">&nbsp;&nbsp;&nbsp;<b>[@{#text_in_stock#}@]</b></td>                         
  </tr>                        
  [@{foreach name=values_outer item=option_values from=$input_attributes_quantities.options_values}@]
  <tr> 
  [@{foreach name=values_inner item=data from=$option_values}@]
    <td nowrap="nowrap" class="smallText" [@{if $smarty.foreach.values_inner.last}@]align="right"[@{/if}@]>[@{if !$smarty.foreach.values_inner.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@][@{$data}@]</td>
  [@{/foreach}@]                          
  </tr>
  [@{/foreach}@]                                                                                              
</table>                      
[@{elseif $input_attributes_quantities.options_error}@]                      
<table border="0" cellspacing="1" cellpadding="0"> 
  <tr>
    <td nowrap="nowrap" class="smallText"><b>[@{#text_options_error#}@]</b></td>                         
  </tr>                                                                                                                      
</table>                                                                  
[@{/if}@]                                                                        
</body>
</html>