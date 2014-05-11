[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with div/css layout                                                                     
* filename   : account_history.tpl
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

<!-- account_history -->
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>      
      [@{if $orders}@]         
          [@{foreach item=order from=$orders_array}@]          
          <div class="main" style="float: left;"><b>[@{#text_order_number#}@]</b> [@{$order.order_id}@]</div>
          <div class="main" style="text-align: right; float: right;"><b>[@{#text_order_status#}@]</b> [@{$order.order_status_name}@]</div>
          <div class="clear">&nbsp;</div>
          <div class="info-box-central-contents">          
            <div class="main" style="padding: 4px 2px 4px 2px; width: 50%; float: left;"><b>[@{#text_order_date#}@]</b> [@{$order.date_purchased}@]<br /><b>[@{if $order.order_type == 'shipped_to'}@][@{#text_order_shipped_to#}@][@{else}@][@{#text_order_billed_to#}@][@{/if}@]</b> [@{$order.order_name}@]</div>
            <div class="main" style="padding: 4px 2px 4px 2px; width: 30%; float: left;"><b>[@{#text_order_products#}@]</b> [@{$order.products_count}@]<br /><b>[@{#text_order_cost#}@]</b> [@{$order.order_total}@]</div>
            <div class="main" style="padding: 14px 8px 0 0; width: 17%; float: right; white-space: nowrap;"><a href="[@{$order.link_filename_account_history_info}@]" class="button-small-view" style="float: right" title=" [@{#small_button_title_view#}@] "><span>[@{#small_button_text_view#}@]</span></a></div>
            <div class="clear">&nbsp;</div>              
          </div>    
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          [@{/foreach}@]
          <div class="small-text" style="float: left; white-space: nowrap;">[@{$nav_bar_number}@]</div>          
          <div class="small-text" style="float: right; white-space: nowrap;">[@{$nav_bar_result}@]</div>
          <div class="clear">&nbsp;</div>        
      [@{else}@] 
          <div class="info-box-central-contents">  
            <div class="main" style="padding: 4px 2px 4px 2px;">[@{#text_no_purchases#}@]</div>        
          </div>                 
      [@{/if}@]      
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <a href="[@{$link_filename_account}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              <div class="clear">&nbsp;</div> 
            </div>
          </div>
<!-- account_history_eof --> 
