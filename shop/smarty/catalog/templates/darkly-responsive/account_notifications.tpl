[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : darkly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.4
* descrip    : xos-shop template built with Bootstrap3 and theme darkly                                                                    
* filename   : account_notifications.tpl
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

<!-- account_notifications -->
    [@{$form_begin}@][@{$hidden_field}@]
          <h1 class="text-orange">[@{#heading_title#}@]</h1> 
          <div><b>[@{#my_notifications_title#}@]</b></div>        
          <div class="panel panel-default clearfix">           
            <div class="panel-body">           
              <p>[@{#my_notifications_description#}@]</p>       
            </div>               
          </div>                      
          <div><b>[@{#global_notifications_title#}@]</b></div>        
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    [@{$checkbox_field_product_global|replace:' onclick="checkBox(\'product_global\')"':''}@]
                    <b>[@{#global_notifications_title#}@]</b>
                  </label>
                </div>
              </div>              
              <p>[@{#global_notifications_description#}@]</p>       
            </div>               
          </div>          
          [@{if $not_global_product_notifications}@]      
          <div><b>[@{#notifications_title#}@]</b></div>       
          <div class="panel panel-default clearfix">           
            <div class="panel-body">            
              [@{if $products_notification}@]
              <p>[@{#notifications_description#}@]</p> 
              [@{foreach item=product_notification from=$products_notifications_array}@]           
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    [@{$product_notification.checkbox_field_product|replace:" onclick=\"checkBox('products[`$product_notification.product_counter`]')\"":''}@]
                    <b>[@{$product_notification.product_name}@]</b>
                  </label>
                </div>            
              </div>
              [@{/foreach}@] 
              [@{else}@]            
              <p>[@{#notifications_non_existing#}@]</p>           
              [@{/if}@]                                   
            </div>               
          </div>
          [@{/if}@]          
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_filename_account}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>    
            <input type="submit" class="btn btn-success  pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                                                               
          </div>          
    [@{$form_end}@]
<!-- account_notifications_eof -->
