[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
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
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
          [@{if $message_stack}@]
          [@{$message_stack}@]          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>              
          [@{/if}@]           
      [@{if $customer_orders}@]      
          <div class="main"><b>[@{#overview_title#}@]</b>&nbsp;<a href="[@{$link_filename_account_history}@]"><span class="text-deco-underline">[@{#overview_show_all_orders#}@]</span></a></div>      
          <div class="info-box-central-contents">
            <div class="main" style="width: 20%; padding: 2px 2px 2px 2px; text-align: center; float: left;"><b>[@{#overview_previous_orders#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>
            <div class="main" style="width: 78%;padding: 2px 2px 2px 2px; float: right;">              
              <table border="0" cellspacing="0" cellpadding="2"> 
              [@{foreach item=order from=$orders}@]                
                <tr class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$order.link_filename_account_history_info}@]'">
                  <td nowrap="nowrap" class="main">#[@{$order.order_id}@]&nbsp;&nbsp;</td>
                  <td nowrap="nowrap" class="main" width="80">[@{$order.date_purchased}@]</td>                    
                  <td class="main">[@{$order.order_name}@], [@{$order.order_country}@]</td>
                  <td nowrap="nowrap" class="main">&nbsp;[@{$order.order_status_name}@]&nbsp;</td>
                  <td nowrap="nowrap" class="main" align="right">[@{$order.order_total}@]</td>                    
                  <td nowrap="nowrap" class="main" align="right"><a href="[@{$order.link_filename_account_history_info}@]" class="button-small-view" style="float: right" title=" [@{#small_button_title_view#}@] "><span>[@{#small_button_text_view#}@]</span></a></td>                    
                </tr>
              [@{/foreach}@]  
              </table>                            
            </div>
            <div class="clear">&nbsp;</div>                
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>      
      [@{/if}@]      
          <div class="main"><b>[@{#my_account_title#}@]</b></div>
          <div class="info-box-central-contents">
            <div class="main account-personal-gif" style="width: 92px; height: 65px; text-align: center; float: left;">&nbsp;</div>
            <div class="main" style="width: 540px; padding: 2px; float: left;">
              <div class="main" style="padding: 2px;"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_account_edit}@]">[@{#my_account_information#}@]</a></div>
              <div class="main" style="padding: 2px;"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_address_book}@]">[@{#my_account_address_book#}@]</a></div>
              <div class="main" style="padding: 2px;"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_account_password}@]">[@{#my_account_password#}@]</a></div>             
            </div>
            <div class="clear">&nbsp;</div>
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                                          
          <div class="main"><b>[@{#my_orders_title#}@]</b></div>
          <div class="info-box-central-contents"> 
            <div class="main account-orders-gif" style="width: 92px; height: 65px; text-align: center; float: left;">&nbsp;</div>
            <div class="main" style="width: 540px; padding: 24px 2px 2px 4px; float: left;">                         
              <div class="main"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_account_history}@]">[@{#my_orders_view#}@]</a></div>
            </div>
            <div class="clear">&nbsp;</div>            
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
      [@{if $link_filename_account_newsletters || $link_filename_account_notifications}@]      
          <div class="main"><b>[@{#email_notifications_title#}@]</b></div>      
          <div class="info-box-central-contents">
            <div class="main account-notifications-gif" style="width: 92px; height: 65px; text-align: center; float: left;">&nbsp;</div>
            <div class="main" style="width: 540px; padding: 2px 2px 2px 2px; float: left;">                    
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="65"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                    [@{if $link_filename_account_newsletters}@]
                    <tr>
                      <td class="main"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_account_newsletters}@]">[@{#email_notifications_newsletters#}@]</a></td>
                    </tr>
                    [@{/if}@]
                    [@{if $link_filename_account_notifications}@]
                    <tr>
                      <td class="main"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_account_notifications}@]">[@{#email_notifications_products#}@]</a></td>
                    </tr>
                    [@{/if}@]
                  </table></td>
                </tr>
              </table>             
            </div>
            <div class="clear">&nbsp;</div>                     
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                          
      [@{/if}@]      
<!-- account_eof -->
