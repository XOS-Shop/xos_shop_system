[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cosmo-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.2
* descrip    : xos-shop template built with Bootstrap3 and theme cosmo                                                                    
* filename   : account.tpl
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

<!-- account --> 
          <h1 class="text-orange">[@{#heading_title#}@]</h1>                
          [@{if $message_stack_error}@]
          <div class="alert alert-danger" role="alert">
            [@{$message_stack_error}@]
          </div>                            
          [@{/if}@]
          [@{if $message_stack_warning}@]
          <div class="alert alert-warning" role="alert">
            [@{$message_stack_warning}@]
          </div>                            
          [@{/if}@]          
          [@{if $message_stack_success}@]
          <div class="alert alert-success" role="alert">
            [@{$message_stack_success}@]
          </div>                            
          [@{/if}@]           
      [@{if $customer_orders}@]        
          <div><b>[@{#overview_title#}@]</b>&nbsp;<a href="[@{$link_filename_account_history}@]"><span class="text-deco-underline">[@{#overview_show_all_orders#}@]</span></a></div>        
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div class="row">                       
                <div class="col-lg-2 visible-lg text-center">
                  <b>[@{#overview_previous_orders#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" />           
                </div>
                <div class="col-lg-10">
                  [@{foreach name=orders item=order from=$orders}@]
                  <div class="row">
                    <div class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">                
                      <div class="col-md-2 text-nowrap">#[@{$order.order_id}@]&nbsp;&nbsp;[@{$order.date_purchased}@]&nbsp;</div>
                      <div class="col-md-4 text-nowrap">[@{$order.order_name}@],&nbsp;[@{$order.order_country}@]&nbsp;</div>
                      <div class="col-md-2 text-nowrap">[@{$order.order_status_name}@]&nbsp;</div>                  
                      <div class="col-md-4 nowrap"><a href="[@{$order.link_filename_account_history_info}@]" class="btn btn-info btn-xs pull-right" title=" [@{#small_button_title_view#}@] ">[@{#small_button_text_view#}@]</a>[@{$order.order_total}@]</div> 
                      <div class="clearfix invisible"></div>   
                    </div> 
                    [@{if !$smarty.foreach.orders.last}@]
                    <div class="div-spacer-h10"></div>
                    [@{/if}@]
                  </div> 
                  [@{/foreach}@]         
                </div>
              </div>          
            </div>               
          </div>                   
      [@{/if}@]        
          <div><b>[@{#my_account_title#}@]</b></div>        
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
            <div class="row">                      
              <div class="col-sm-2 text-center hidden-xs">
                <span class="text-primary glyphicon glyphicon-folder-open" style="font-size: 30px; line-height: 70px;"></span>            
              </div>
              <div class="col-sm-10">
                <p><span class="text-primary glyphicon glyphicon-hand-right"></span> <a href="[@{$link_filename_account_edit}@]">[@{#my_account_information#}@]</a></p>
                <p><span class="text-primary glyphicon glyphicon-hand-right"></span> <a href="[@{$link_filename_address_book}@]">[@{#my_account_address_book#}@]</a></p>
                <div><span class="text-primary glyphicon glyphicon-hand-right"></span> <a href="[@{$link_filename_account_password}@]">[@{#my_account_password#}@]</a></div>             
              </div>
            </div>         
            </div>               
          </div>             
          <div><b>[@{#my_orders_title#}@]</b></div>        
          <div class="panel panel-default clearfix">           
            <div class="panel-body"> 
            <div class="row">                     
              <div class="col-sm-2 text-center hidden-xs">
                <span class="text-primary glyphicon glyphicon-list-alt" style="font-size: 32px; line-height: 55px;"></span>            
              </div>
              <div class="col-sm-10">
                <div><span class="text-primary glyphicon glyphicon-hand-right"></span> <a href="[@{$link_filename_account_history}@]">[@{#my_orders_view#}@]</a></div>             
              </div>
            </div>         
            </div>               
          </div>           
      [@{if $link_filename_account_newsletters || $link_filename_account_notifications}@]      
          <div><b>[@{#email_notifications_title#}@]</b></div>       
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
            <div class="row">                      
              <div class="col-sm-2 text-center hidden-xs">
                <span class="text-primary glyphicon glyphicon-envelope" style="font-size: 32px; line-height: 55px;"></span>            
              </div>
              <div class="col-sm-10">
              [@{if $link_filename_account_newsletters}@]
                <p><span class="text-primary glyphicon glyphicon-hand-right"></span> <a href="[@{$link_filename_account_newsletters}@]">[@{#email_notifications_newsletters#}@]</a></p>
              [@{/if}@]
              [@{if $link_filename_account_notifications}@]
                <div><span class="text-primary glyphicon glyphicon-hand-right"></span> <a href="[@{$link_filename_account_notifications}@]">[@{#email_notifications_products#}@]</a></div>
              [@{/if}@]          
              </div>
            </div>         
            </div>               
          </div>                                    
      [@{/if}@]      
<!-- account_eof -->
