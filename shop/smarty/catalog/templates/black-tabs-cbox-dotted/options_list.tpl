[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox-dotted
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                   
* filename   : options_list.tpl
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
<body style="background : transparent;">                                                           
<div style="width:100%; text-align:right; position:absolute; float:right; right:6px; top:6px;">[@{if $options_values_price}@]<span class="small-text" style="display:inline-block; vertical-align:top;"><b>[@{#text_prices#}@]</b>&nbsp;&nbsp;<a href="" style="text-decoration:underline;" onclick="toggleByClassName('options-price'); return false">[@{#text_show_hide#}@]</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>[@{/if}@]<a href="" onclick="toggle('box_products_options_overview'); return false"><img src="[@{$images_path}@]button_close.gif" title=" [@{#close_window#}@] " alt="[@{#close_window#}@]" /></a></div>                       
<div class="clear">&nbsp;</div>  
<div style="text-align:right; position:relative; float:right; right:0px; top:20px;">                        
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr>
    <td align="right">                                                                    
      <table style="text-align:left;" border="0" cellspacing="1" cellpadding="0"> 
        <tr>
        [@{foreach name=names item=options_name from=$products_options_overview.options_names}@]
          <td nowrap="nowrap" class="small-text">[@{if !$smarty.foreach.names.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@]<b>[@{$options_name.options_name}@]</b></td>
        [@{/foreach}@] 
          <td nowrap="nowrap" class="small-text" align="center">&nbsp;&nbsp;&nbsp;[@{if $stock_check == 'true'}@]<b>[@{#text_in_stock#}@]</b>[@{/if}@]</td>                         
          <td nowrap="nowrap" class="small-text" align="center">&nbsp;</td>
        </tr>                        
        [@{foreach name=values_outer item=option_values from=$products_options_overview.options_values}@]
        <tr> 
        [@{foreach name=values_inner item=data from=$option_values}@]
        <td nowrap="nowrap" class="small-text">[@{if !$smarty.foreach.values_inner.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@][@{if $data == 'cross'}@]<img src="[@{$images_path}@]cross.gif" alt="[@{$data}@]" />[@{elseif $data == 'tick'}@]<img src="[@{$images_path}@]tick.gif" alt="[@{$data}@]" />[@{else}@][@{$data}@][@{/if}@]</td>
        [@{/foreach}@]                          
        </tr>
        [@{/foreach}@]                                                                                              
      </table>                                                  
    </td>
  </tr> 
  <tr>
    <td align="right">
      <div style="width:100%; padding:6px 0 6px 0;"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></div>
      [@{if $stock_check == 'true'}@]
        [@{if $stock_allow_checkout == 'true'}@]
        <div class="small-text red-mark" style="text-align:center; whitespace:nowrap; font-weight:bold; float:right;">X<br />0/-1/-2/...</div>                      
        <div class="small-text" style="text-align:right; whitespace:nowrap; float:right;">[@{#text_is_not_offered#}@]&nbsp;&nbsp;&nbsp;<br />[@{#text_will_be_reordered#}@]&nbsp;&nbsp;&nbsp;</div>
        [@{else}@]
        <div class="small-text" style="whitespace:nowrap; float:right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div> 
        <div class="small-text" style="text-align:right; whitespace:nowrap; float:right;">[@{#text_is_not_offered#}@]&nbsp;&nbsp;&nbsp;<span class="red-mark" style="font-weight : bold;">X</span><br />[@{#text_sold_out#}@]&nbsp;&nbsp;&nbsp;<span class="red-mark" style="font-weight : bold;">0</span></div>
        [@{/if}@]
      [@{else}@]
        <div class="small-text" style="whitespace:nowrap; float:right;">&nbsp;&nbsp;&nbsp;</div>
        <div class="small-text" style="text-align:right; whitespace:nowrap; float:right;">[@{#text_is_offered#}@]&nbsp;&nbsp;&nbsp;<img src="[@{$images_path}@]tick.gif" alt="" /><br />[@{#text_is_not_offered#}@]&nbsp;&nbsp;&nbsp;<img src="[@{$images_path}@]cross.gif" alt="" /></div>
      [@{/if}@]
      <div class="clear">&nbsp;</div>                      
    </td>
  </tr>                                                                                                                                                                
</table>
</div>
<div class="clear">&nbsp;</div>                                                                        
</body>
</html>