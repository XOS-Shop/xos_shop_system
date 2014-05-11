[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
* filename   : checkout_shipping_address.tpl
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

<!-- checkout_shipping_address -->
    <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_delivery.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></td>
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
     [@{if !$process}@]            
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#table_heading_shipping_address#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="50%" valign="top">[@{#text_selected_shipping_destination#}@]</td>
                <td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main" align="center" valign="top"><b>[@{#title_shipping_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></td>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" valign="top">[@{$address_label}@]</td>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
     [@{if $several_addresses}@]      
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#table_heading_address_book_entries#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="50%" valign="top">[@{#text_select_other_shipping_destination#}@]</td>
                <td class="main" width="50%" valign="top" align="right"><b>[@{#title_please_select#}@]</b><br /><img src="[@{$images_path}@]arrow_east_south.gif" alt="" /></td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>              
             [@{foreach item=address from=$addresses}@]              
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                [@{if $address.actual_address}@]
                  <tr id="default-selected" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$address.radio_select}@])">
                [@{else}@]                  
                  <tr class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$address.radio_select}@])">
                [@{/if}@]  
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" colspan="2"><b>[@{$address.address_name}@]</b></td>
                    <td class="main" align="right">[@{$address.radio_field}@]</td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                  <tr>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td colspan="3"><table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                        <td class="main">[@{$address.full_address}@]</td>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                      </tr>
                    </table></td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                </table></td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>              
             [@{/foreach}@]                            
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
     [@{/if}@]            
     [@{/if}@]      
     [@{if $not_max_address_book_entries}@]      
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#table_heading_new_shipping_address#}@]</b></td>
            <td class="input-requirement" align="right">[@{#form_required_information#}@]</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="100%" valign="top">[@{#text_create_new_shipping_address#}@]</td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td>
                    [@{$checkout_new_address}@]
                    </td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                </table></td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
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
                <td class="main"><b>[@{#title_continue_checkout_procedure#}@]</b><br />[@{#text_continue_checkout_procedure#}@]</td>               
                <td nowrap="nowrap" class="main" align="right">[@{$hidden_field_submit}@]
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="if(checkout_address.onsubmit())checkout_address.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
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
     [@{if $process}@]
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td nowrap="nowrap"><a href="[@{$link_filename_checkout_shipping_address}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
      </tr>      
     [@{/if}@]      
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="right"><img src="[@{$images_path}@]checkout_bullet.gif" alt="" /></td>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
              </tr>
            </table></td>
            <td width="25%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
            <td width="25%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="1" height="5" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkoutBarCurrent">[@{#checkout_bar_delivery#}@]</td>
            <td align="center" width="25%" class="checkoutBarTo">[@{#checkout_bar_payment#}@]</td>
            <td align="center" width="25%" class="checkoutBarTo">[@{#checkout_bar_confirmation#}@]</td>
            <td align="center" width="25%" class="checkoutBarTo">[@{#checkout_bar_finished#}@]</td>
          </tr>
        </table></td>
      </tr>
    </table>[@{$form_end}@]</td>
<!-- checkout_shipping_address_eof -->
