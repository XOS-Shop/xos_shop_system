[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
* filename   : checkout_success.tpl
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

<!-- checkout_success -->
    <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="4" cellpadding="2">
          <tr>
            <td valign="top"><img src="[@{$images_path}@]table_background.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></td>
            <td valign="top" class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" />
              <div align="center" class="page-heading">[@{#heading_title#}@]</div><br />
            [@{#text_success#}@]<br /><br />
            [@{if $notify}@]            
            [@{#text_notify_products#}@]<br /><span class="products-notifications">
            [@{foreach item=product_notify from=$products_notify}@]
            [@{$product_notify.checkbox_field}@] [@{$product_notify.text}@]<br />
            [@{/foreach}@]
            </span><br /><br />
            [@{/if}@]
            [@{eval var=#text_see_orders#}@]<br /><br />[@{eval var=#text_contact_store_owner#}@]
            <h3>[@{#text_thanks_for_shopping#}@]</h3>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>       
        <td nowrap="nowrap" class="main" align="right">
          <script type="text/javascript">
          /* <![CDATA[ */
            document.write('<a href="" onclick="order.submit(); return false" class="button-continue" style="float: right; position: relative; right: 12px" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
          /* ]]> */  
          </script>
          <noscript>
            <input type="submit" value="[@{#button_text_continue#}@]" />
          </noscript>                         
        </td>        
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="right"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="1" height="5" /></td>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
              </tr>
            </table></td>
            <td width="25%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
            <td width="25%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
                <td width="50%"><img src="[@{$images_path}@]arrow_checkout.gif" alt="" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkout-bar-from">[@{#checkout_bar_delivery#}@]</td>
            <td align="center" width="25%" class="checkout-bar-from">[@{#checkout_bar_payment#}@]</td>
            <td align="center" width="25%" class="checkout-bar-from">[@{#checkout_bar_confirmation#}@]</td>
            <td align="center" width="25%" class="checkout-bar-current">[@{#checkout_bar_finished#}@]</td>
          </tr>
        </table></td>
      </tr>
      [@{$downloads}@]
    </table>[@{$form_end}@]</td>
<!-- checkout_success_eof -->
