[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.2
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                   
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
<body style="padding:20px;">
  <div class="text-left">                              
  <table> 
    <tr>
      <td class="text-right">                                                                    
        <table class="table-border-cellspacing text-left"> 
          <tr>
          [@{foreach name=names item=options_name from=$products_options_overview.options_names}@]
            <td class="text-nowrap">[@{if !$smarty.foreach.names.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@]<b>[@{$options_name.options_name}@]</b></td>
          [@{/foreach}@] 
            <td  class="text-nowrap text-center">&nbsp;&nbsp;&nbsp;[@{if $stock_check == 'true'}@]<b>[@{#text_in_stock#}@]</b>[@{/if}@]</td>                         
          </tr>                        
          [@{foreach name=values_outer item=option_values from=$products_options_overview.options_values}@]
          <tr> 
          [@{foreach name=values_inner item=data from=$option_values}@]
            <td  class="text-nowrap">[@{if !$smarty.foreach.values_inner.first}@]&nbsp;&nbsp;&nbsp;[@{/if}@][@{if $data == 'cross'}@]<img src="[@{$images_path}@]cross.gif" alt="[@{$data}@]" />[@{elseif $data == 'tick'}@]<img src="[@{$images_path}@]tick.gif" alt="[@{$data}@]" />[@{else}@][@{$data}@][@{/if}@]</td>
          [@{/foreach}@]                          
          </tr>
          [@{/foreach}@]                                                                                              
        </table>                                                  
      </td>
    </tr>                           
    <tr>
      <td class="text-left">                             
        <div style="width:100%; padding:6px 0 6px 0;"><img src="[@{$images_path}@]pixel_white.gif" alt="" style="display: block; width: 100%; height: 1px;" /></div>
        [@{if $stock_check == 'true'}@]
          [@{if $stock_allow_checkout == 'true'}@]
          <div class="small-text red-mark text-nowrap text-center pull-right"><b>X<br />0/-1/-2/...</b></div>                      
          <div class="text-nowrap text-right pull-right">[@{#text_is_not_offered#}@]&nbsp;&nbsp;&nbsp;<br />[@{#text_will_be_reordered#}@]&nbsp;&nbsp;&nbsp;</div>
          [@{else}@]
          <div class="text-nowrap pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div> 
          <div class="text-nowrap text-right pull-right">[@{#text_is_not_offered#}@]&nbsp;&nbsp;&nbsp;<span class="red-mark"><b>X</b></span><br />[@{#text_sold_out#}@]&nbsp;&nbsp;&nbsp;<span class="red-mark"><b>0</b></span></div>
          [@{/if}@]
        [@{else}@]
          <div class="text-nowrap pull-right">&nbsp;&nbsp;&nbsp;</div>
          <div class="text-nowrap text-right pull-right">[@{#text_is_offered#}@]&nbsp;&nbsp;&nbsp;<img src="[@{$images_path}@]tick.gif" alt="" /><br />[@{#text_is_not_offered#}@]&nbsp;&nbsp;&nbsp;<img src="[@{$images_path}@]cross.gif" alt="" /></div>
        [@{/if}@]
        <div class="clearfix invisible"></div>                                                                                                                                                                            
      </td>
    </tr>                                                                                                                                                                         
  </table>
  </div>                                                            
[@{$end_tags}@]