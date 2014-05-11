[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-tabs-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and css-buttons and tables for layout                                                                     
* filename   : checkout_shipping.tpl
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

<!-- checkout_shipping -->
    <td width="100%" valign="top">[@{$form_begin}@][@{$hidden_field}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
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
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#table_heading_shipping_address#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>                
                <td class="main" width="50%" valign="top">[@{#text_choose_shipping_destination#}@]<br />&nbsp;<br /><a href="[@{$link_filename_checkout_shipping_address}@]" class="button-change-address" style="float: left" title=" [@{#button_title_change_address#}@] "><span>[@{#button_text_change_address#}@]</span></a></td>
                <td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="0">
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
     [@{if $shipping_modules}@]            
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#table_heading_shipping_method#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">           
             [@{if $several_shipping_modules and !$free_shipping}@]            
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="50%" valign="top">[@{#text_choose_shipping_method#}@]</td>
                <td class="main" width="50%" valign="top" align="right"><b>[@{#title_please_select#}@]</b><br /><img src="[@{$images_path}@]arrow_east_south.gif" alt="" /></td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>              
             [@{elseif !$free_shipping}@]              
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="100%" colspan="2">[@{#text_enter_shipping_information#}@]</td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>               
             [@{/if}@]
             [@{if $free_shipping}@]
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td colspan="2" width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" colspan="3"><b>[@{#free_shipping_title#}@]</b>&nbsp;[@{$shipping_icon}@]</td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                  <tr id="default-selected" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, 0)">
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" width="100%">[@{eval var=#free_shipping_description#}@][@{$hidden_field_shipping}@]</td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                </table></td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td> 
              </tr>
             [@{else}@]
             [@{foreach name=outer item=shipping_module from=$shipping_modules_array}@]                                     
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" colspan="3"><b>[@{$shipping_module.name}@]</b>&nbsp;[@{$shipping_module.icon}@]</td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>                                    
                 [@{if $shipping_module.error}@]    
                  <tr>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" colspan="3">[@{$shipping_module.error}@]</td>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>                    
                 [@{else}@]    
                 [@{foreach name=inner item=method from=$shipping_module.methods}@]      
                 [@{if $method.actual_method}@]                      
                  <tr id="default-selected" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$method.radio_select}@])">                  
                 [@{else}@]        
                  <tr class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$method.radio_select}@])">        
                 [@{/if}@]          
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" width="75%">[@{$method.title}@]</td>                     
                   [@{if $method.several_methods}@]                                
                    <td class="main">[@{$method.cost}@]</td>
                    <td class="main" align="right">[@{$method.radio_field}@]</td>                                        
                   [@{else}@]        
                    <td class="main" align="right" colspan="2">[@{$method.cost}@][@{$method.hidden_field}@]</td>        
                   [@{/if}@]                                
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>                  
                 [@{/foreach}@]            
                 [@{/if}@]              
                </table></td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td> 
              </tr>
             [@{/foreach}@]              
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#table_heading_comments#}@]</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="small-text"><b>[@{#sub_title_no_html#}@]</b>&nbsp;[@{#text_no_html#}@]</td>
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
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main"><b>[@{#title_continue_checkout_procedure#}@]</b><br />[@{#text_continue_checkout_procedure#}@]</td>               
                <td nowrap="nowrap" class="main" align="right">
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="checkout_address.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
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
                <td width="50%" align="right"><img src="[@{$images_path}@]arrow_checkout.gif" alt="" /></td>
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
            <td align="center" width="25%" class="checkout-bar-current">[@{#checkout_bar_delivery#}@]</td>
            <td align="center" width="25%" class="checkout-bar-to">[@{#checkout_bar_payment#}@]</td>
            <td align="center" width="25%" class="checkout-bar-to">[@{#checkout_bar_confirmation#}@]</td>
            <td align="center" width="25%" class="checkout-bar-to">[@{#checkout_bar_finished#}@]</td>
          </tr>
        </table></td>
      </tr>
    </table>[@{$form_end}@]</td>
<!-- checkout_shipping_eof -->
