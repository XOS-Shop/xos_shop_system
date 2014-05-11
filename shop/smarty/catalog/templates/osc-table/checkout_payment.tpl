[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
* filename   : checkout_payment.tpl
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

<!-- checkout_payment -->
    <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_payment.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{if $payment_error}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{$payment_error_title}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBoxNotice">
          <tr class="infoBoxNoticeContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="100%" valign="top">[@{$payment_error_sting}@]</td>
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
            <td class="main"><b>[@{#table_heading_billing_address#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="50%" valign="top">[@{#text_selected_billing_destination#}@]<br />&nbsp;<br /><a href="[@{$link_filename_checkout_payment_address}@]" class="button-change-address" style="float: left" title=" [@{#button_title_change_address#}@] "><span>[@{#button_text_change_address#}@]</span></a></td>
                <td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main" align="center" valign="top"><b>[@{#title_billing_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></td>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td> 
                    <td nowrap="nowrap" class="main" valign="top">[@{$address_label}@]</td>
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
     [@{if $payment_modules}@]      
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#table_heading_payment_method#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
            [@{if $several_payment_modules}@]
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="50%" valign="top">[@{#text_select_payment_method#}@]</td>
                <td class="main" width="50%" valign="top" align="right"><b>[@{#title_please_select#}@]</b><br /><img src="[@{$images_path}@]arrow_east_south.gif" alt="" /></td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            [@{else}@]  
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="100%" colspan="2">[@{#text_enter_payment_information#}@]</td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            [@{/if}@]  
            [@{foreach name=outer item=payment_module from=$payment_modules}@]
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                [@{if $payment_module.actual_payment_method}@]
                  <tr id="default-selected" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$payment_module.radio_select}@])">
                [@{else}@]
                  <tr class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$payment_module.radio_select}@])">
                [@{/if}@]  
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" colspan="3"><b>[@{$payment_module.loaded_modules}@]</b></td>
                    <td class="main" align="right">[@{$payment_module.radio_field}@]</td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                [@{if $payment_module.module_error}@]
                  <tr>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" colspan="4">[@{$module_error_text}@]</td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                [@{elseif $payment_module.fields}@] 
                  <tr>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td colspan="4"><table border="0" cellspacing="0" cellpadding="2">
                    [@{foreach name=inner item=selection_field from=$payment_module.selection_fields}@]
                      <tr>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                        <td class="main">[@{$selection_field.title}@]</td>
                        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                        <td class="main">[@{$selection_field.field}@]</td>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                      </tr>
                    [@{/foreach}@]  
                    </table></td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                [@{/if}@]  
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
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#table_heading_comments#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText"><b>[@{#sub_title_no_html#}@]</b>&nbsp;[@{#text_no_html#}@]</td>
              </tr>             
              <tr>
                <td><div>[@{$textarea}@]<br /></div></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>     
     [@{if $checkbox_accept_conditions}@]
      <tr>      
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>      
            <td class="main"><b>[@{#table_heading_conditions#}@]</b></td>
          </tr>
        </table></td>              
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="0" cellpadding="2">
             [@{if $link_filename_popup_content_7}@]              
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" colspan="2">                          
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('&nbsp;<a href="[@{$link_filename_popup_content_7}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a>');
                  /* ]]> */   
                  </script>
                  <noscript>
                    &nbsp;<a href="[@{$link_filename_popup_content_7}@]" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a>
                  </noscript>                              
                </td>                
              </tr>
             [@{/if}@]
             [@{if $checkbox_accept_conditions}@]                             
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main">[@{$checkbox_accept_conditions}@]</td>
                <td class="main">[@{#text_accept_conditions#}@]</td>
              </tr>
             [@{/if}@]                                                       
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
                <td class="main"><b>[@{#title_continue_checkout_procedure#}@]</b><br />[@{#text_continue_checkout_procedure#}@]</td>                
                <td nowrap="nowrap" class="main" align="right">
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="if(checkout_payment.onsubmit())checkout_payment.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
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
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
                <td><img src="[@{$images_path}@]checkout_bullet.gif" alt="" /></td>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
              </tr>
            </table></td>
            <td width="25%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="1" height="5" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkoutBarFrom"><a href="[@{$link_filename_checkout_shipping}@]">[@{#checkout_bar_delivery#}@]</a></td>
            <td align="center" width="25%" class="checkoutBarCurrent">[@{#checkout_bar_payment#}@]</td>
            <td align="center" width="25%" class="checkoutBarTo">[@{#checkout_bar_confirmation#}@]</td>
            <td align="center" width="25%" class="checkoutBarTo">[@{#checkout_bar_finished#}@]</td>
          </tr>
        </table></td>
      </tr>
    </table>[@{$form_end}@]</td>
<!-- checkout_payment_eof -->
