[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_history.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>        
      [@{if $orders}@]         
      <tr>
        <td> 
          [@{foreach item=order from=$orders_array}@]       
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td class="main"><b>[@{#text_order_number#}@]</b> [@{$order.order_id}@]</td>
              <td class="main" align="right"><b>[@{#text_order_status#}@]</b> [@{$order.order_status_name}@]</td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
            <tr class="infoBoxContents">
              <td><table border="0" width="100%" cellspacing="2" cellpadding="4">
                <tr>
                  <td class="main" width="50%" valign="top"><b>[@{#text_order_date#}@]</b> [@{$order.date_purchased}@]<br /><b>[@{if $order.order_type == 'shipped_to'}@][@{#text_order_shipped_to#}@][@{else}@][@{#text_order_billed_to#}@][@{/if}@]</b> [@{$order.order_name}@]</td>
                  <td class="main" width="30%" valign="top"><b>[@{#text_order_products#}@]</b> [@{$order.products_count}@]<br /><b>[@{#text_order_cost#}@]</b> [@{$order.order_total}@]</td>
                  <td nowrap="nowrap" class="main" width="20%"><a href="[@{$order.link_filename_account_history_info}@]" class="button-small-view" style="float: left" title=" [@{#small_button_title_view#}@] "><span>[@{#small_button_text_view#}@]</span></a></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
            </tr>
          </table> 
          [@{/foreach}@]
        </td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td nowrap="nowrap" class="smallText" valign="top">[@{$nav_bar_number}@]</td>
            <td nowrap="nowrap" class="smallText" align="right">[@{$nav_bar_result}@]</td>
          </tr>
        </table></td>
      </tr>          
      [@{else}@]
      <tr>
        <td>          
          <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
            <tr class="infoBoxContents">
              <td><table border="0" width="100%" cellspacing="2" cellpadding="4">
                <tr>
                  <td class="main">[@{#text_no_purchases#}@]</td>
                </tr>
              </table></td>
            </tr>
          </table>         
        </td>
      </tr>
      [@{/if}@]      
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td nowrap="nowrap"><a href="[@{$link_filename_account}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- account_history_eof --> 
