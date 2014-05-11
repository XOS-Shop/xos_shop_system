[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with popup windows as lightboxes 
*              and div/css layout                                                                     
* filename   : options_window.tpl
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
[@{$html_header}@]
<body>
  <div style="text-align:left;">                              
  <table class="product-listing" style="background:#fff; width:10%; padding-left:20px; padding-top:20px; padding-right:20px; padding-bottom:20px;"> 
    <tr>
      <td align="right">                                                                    
        <table style="text-align:left;" border="0" cellspacing="1" cellpadding="0"> 
          <tr>
          [@{foreach name=names item=options_name from=$products_options_overview.options_names}@]
            <td nowrap="nowrap" class="small-text">[@{if !$smarty.foreach.names.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@]<b>[@{$options_name.options_name}@]</b></td>
          [@{/foreach}@] 
            <td nowrap="nowrap" class="small-text" align="center">&nbsp;&nbsp;&nbsp;[@{if $stock_check == 'true'}@]<b>[@{#text_in_stock#}@]</b>[@{/if}@]</td>                         
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
[@{$end_tags}@]