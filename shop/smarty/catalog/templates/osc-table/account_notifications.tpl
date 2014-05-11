[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
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
    <td width="100%" valign="top">[@{$form_begin}@][@{$hidden_field}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_account.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="main"><b>[@{#my_notifications_title#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main">[@{#my_notifications_description#}@]</td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="main"><b>[@{#global_notifications_title#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="checkBox('product_global')">
                    <td class="main" width="30">[@{$checkbox_field_product_global}@]</td>
                    <td class="main"><b>[@{#global_notifications_title#}@]</b></td>
                  </tr>
                  <tr>
                    <td width="30">&nbsp;</td>
                    <td class="main">[@{#global_notifications_description#}@]</td>
                  </tr>
                </table></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
  
      <tr>      <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{if $not_global_product_notifications}@]      
      <tr>
        <td class="main"><b>[@{#notifications_title#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">                
                [@{if $products_notification}@]  
                  <tr>
                    <td class="main" colspan="2">[@{#notifications_description#}@]</td>
                  </tr> 
                  [@{foreach item=product_notification from=$products_notifications_array}@]                  
                  <tr class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="checkBox('products[[@{$product_notification.product_counter}@]]')">
                    <td class="main" width="30">[@{$product_notification.checkbox_field_product}@]</td>
                    <td class="main"><b>[@{$product_notification.product_name}@]</b></td>
                  </tr>
                  [@{/foreach}@]
                [@{else}@]                  
                  <tr>
                    <td class="main">[@{#notifications_non_existing#}@]</td>
                  </tr>                                    
                [@{/if}@]                    
                </table></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
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
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>     
                <td nowrap="nowrap"><a href="[@{$link_filename_account}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                <td nowrap="nowrap" align="right">
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="account_notifications.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                  /* ]]> */  
                  </script>
                  <noscript>
                    <input type="submit" value="[@{#button_text_continue#}@]" />
                  </noscript>                         
                </td>      
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>[@{$form_end}@]</td>
<!-- account_notifications_eof -->
