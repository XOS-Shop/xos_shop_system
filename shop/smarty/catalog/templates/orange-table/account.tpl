[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="page-heading">[@{#heading_title#}@]</td>
            <td class="page-heading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#page_heading_width#}@]" height="[@{#page_heading_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{if $message_stack}@]
      <tr>
        <td>[@{$message_stack}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{/if}@]      
      [@{if $customer_orders}@]
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#overview_title#}@]</b></td>
            <td class="main"><a href="[@{$link_filename_account_history}@]"><span class="text-deco-underline">[@{#overview_show_all_orders#}@]</span></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">            
              <tr>
                <td class="main" align="center" valign="top" width="130"><b>[@{#overview_previous_orders#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2"> 
                [@{foreach item=order from=$orders}@]                
                  <tr class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$order.link_filename_account_history_info}@]'">
                    <td nowrap="nowrap" class="main">#[@{$order.order_id}@]&nbsp;&nbsp;</td>
                    <td nowrap="nowrap" class="main" width="80">[@{$order.date_purchased}@]</td>                    
                    <td class="main">[@{$order.order_name}@], [@{$order.order_country}@]</td>
                    <td nowrap="nowrap" class="main">&nbsp;&nbsp;[@{$order.order_status_name}@]</td>
                    <td nowrap="nowrap" class="main" align="right">[@{$order.order_total}@]</td>                    
                    <td nowrap="nowrap" class="main" align="right"><a href="[@{$order.link_filename_account_history_info}@]" class="button-small-view" style="float: right" title=" [@{#small_button_title_view#}@] "><span>[@{#small_button_text_view#}@]</span></a></td>                    
                  </tr>
                [@{/foreach}@]  
                </table></td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{/if}@]      
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#my_account_title#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td width="60"><img src="[@{$images_path}@]account_personal.gif" alt="" /></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_account_edit}@]">[@{#my_account_information#}@]</a></td>
                  </tr>
                  <tr>
                    <td class="main"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_address_book}@]">[@{#my_account_address_book#}@]</a></td>
                  </tr>
                  <tr>
                    <td class="main"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_account_password}@]">[@{#my_account_password#}@]</a></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#my_orders_title#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td width="60"><img src="[@{$images_path}@]account_orders.gif" alt="" /></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><img src="[@{$images_path}@]arrow_violet.gif" alt="" /> <a href="[@{$link_filename_account_history}@]">[@{#my_orders_view#}@]</a></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      [@{if $link_filename_account_newsletters || $link_filename_account_notifications}@]      
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#email_notifications_title#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td width="60"><img src="[@{$images_path}@]account_notifications.gif" alt="" /></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
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
                <td width="10" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      [@{/if}@]      
    </table></td>
<!-- account_eof -->
