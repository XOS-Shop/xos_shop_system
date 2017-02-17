[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cosmo-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.4
* descrip    : xos-shop template built with Bootstrap3 and theme cosmo                                                                    
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
          <h1 class="text-orange">[@{#heading_title#}@]</h1>                     
      [@{if $orders}@]
          [@{foreach  name=orders item=order from=$orders_array}@]          
          <div class="text-nowrap pull-left"><b>[@{#text_order_number#}@]</b> [@{$order.order_id}@]&nbsp;</div>
          <div class="text-nowrap text-right pull-right"><b>[@{#text_order_status#}@]</b> [@{$order.order_status_name}@]</div> 
          <div class="clearfix invisible"></div>     
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div class="row"> 
                <div class="col-md-6 text-nowrap pull-left"><b>[@{#text_order_date#}@]</b> [@{$order.date_purchased}@]<br /><b>[@{if $order.order_type == 'shipped_to'}@][@{#text_order_shipped_to#}@][@{else}@][@{#text_order_billed_to#}@][@{/if}@]</b> [@{$order.order_name}@]</div>
                <div class="col-md-3 text-nowrap pull-left"><b>[@{#text_order_products#}@]</b> [@{$order.products_count}@]<br /><b>[@{#text_order_cost#}@]</b> [@{$order.order_total}@]</div>
                <div class="col-md-3 text-nowrap pull-right"><a href="[@{$order.link_filename_account_history_info}@]" class="btn btn-info pull-right" title=" [@{#small_button_title_view#}@] ">[@{#small_button_text_view#}@]</a></div> 
              </div> 
            </div>               
          </div>       
          [@{/foreach}@]
          <div class="clearfix">
            <div class="pagination-number">[@{$nav_bar_number}@]</div>          
            <div class="pagination-result">[@{$nav_bar_result}@]</div>
          </div>
          <div class="div-spacer-h20"></div>       
      [@{else}@] 
          <div class="panel panel-default clearfix">           
            <div class="panel-body"> 
              <div>[@{#text_no_purchases#}@]</div>        
            </div>               
          </div>                  
      [@{/if}@]       
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_filename_account}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                                                                                                                                                                        
          </div>           
<!-- account_history_eof --> 
