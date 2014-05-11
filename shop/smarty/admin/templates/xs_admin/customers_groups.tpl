[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : customers_groups.tpl
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

<!-- customers_groups -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
   [@{if $edit}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>[@{$form_begin_customers_update}@]<table border="0" width="100%" cellspacing="0" cellpadding="10">         
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="8" /></td> 
          </tr>                    
          <tr class="dataTableRow">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">           
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
              </tr>                                                                                                        
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#category_personal#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td class="main">[@{#entry_groups_name#}@]</td>
                    <td class="main">[@{$group_name_in_out_values}@]&nbsp;&nbsp;<span class="smallText">[@{#text_char_max_length#}@]</span></td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_group_show_tax#}@]</td>
                    <td class="main">[@{$group_show_tax_in_out_values}@]&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_group_tax_exempt#}@]</td>
                    <td class="main">[@{$group_tax_exempt_in_out_values}@]</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_group_discount#}@]</td>
                    <td class="main">[@{$group_discount_in_out_values}@]%</td>
                  </tr>              
	         </table>
	        </td>
              </tr>
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#heading_title_modules_payment#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
	          <tr>
                    <td class="main">[@{$group_payment_settings_in_out_values_1}@]&nbsp;&nbsp;[@{#entry_group_payment_set#}@]&nbsp;&nbsp;[@{$group_payment_settings_in_out_values_0}@]&nbsp;&nbsp;[@{#entry_group_payment_default#}@]</td>
                  </tr>
                  [@{foreach item=payment from=$payment_allowed}@]
	          <tr>
                    <td class="main">[@{$payment.group_payment_allowed_in_out_values}@]&nbsp;&nbsp;[@{$payment.group_payment_allowed_title}@]</td>
                  </tr>
                  [@{/foreach}@]
	          <tr>
                    <td class="main" style="padding-left: 30px; padding-right: 10px; padding-top: 10px;">[@{#entry_payment_set_explain#}@]</td>
                  </tr>
                </table>
               </td>
              </tr>
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#heading_title_modules_shipping#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
	          <tr>
                    <td class="main">[@{$group_shipment_settings_in_out_values_1}@]&nbsp;&nbsp;[@{#entry_group_shipping_set#}@]&nbsp;&nbsp;[@{$group_shipment_settings_in_out_values_0}@]&nbsp;&nbsp;[@{#entry_group_shipping_default#}@]</td>
                  </tr>
                  [@{foreach item=shipping from=$shipping_allowed}@]
	          <tr>
                    <td class="main">[@{$shipping.group_shipping_allowed_in_out_values}@]&nbsp;&nbsp;[@{$shipping.group_shipping_allowed_title}@]</td>
                  </tr>
                  [@{/foreach}@]
	          <tr>
                    <td class="main" style="padding-left: 30px; padding-right: 10px; padding-top: 10px;">[@{#entry_shipping_set_explain#}@]</td>
                  </tr>
                </table>
               </td>
              </tr>          
            </table></td>
          </tr>                    
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td nowrap="nowrap" align="right" class="main"><a href="[@{$link_filename_customers_groups}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="if(customers.onsubmit())customers.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>
          </tr>      
        </table>[@{$form_end}@]</td>
      </tr>      
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="70" /></td>
      </tr>
   [@{elseif $new}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>[@{$form_begin_customers_new}@]<table border="0" width="100%" cellspacing="0" cellpadding="10">  
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="8" /></td> 
          </tr>                    
          <tr class="dataTableRow">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">           
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
              </tr>             
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#category_personal#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td class="main">[@{#entry_groups_name#}@]</td>
                    <td class="main">[@{$group_name_in_values}@]&nbsp;&nbsp;<span class="smallText">[@{#text_char_max_length#}@]</span></td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_group_show_tax#}@]</td>
                    <td class="main">[@{$group_show_tax_in_values}@]&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_group_tax_exempt#}@]</td>
                    <td class="main">[@{$group_tax_exempt_in_values}@]</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_group_discount#}@]</td>
                    <td class="main">[@{$group_discount_in_out_values}@]%</td>
                  </tr>               
	         </table>
	        </td>
              </tr>
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#heading_title_modules_payment#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
	          <tr>
                    <td class="main">[@{$group_payment_settings_in_values_1}@]&nbsp;&nbsp;[@{#entry_group_payment_set#}@]&nbsp;&nbsp;[@{$group_payment_settings_in_values_0}@]&nbsp;&nbsp;[@{#entry_group_payment_default#}@]</td>
                  </tr>
                  [@{foreach item=payment from=$payment_allowed}@]
	          <tr>
                    <td class="main">[@{$payment.group_payment_allowed_in_values}@]&nbsp;&nbsp;[@{$payment.group_payment_allowed_title}@]</td>
                  </tr>
                  [@{/foreach}@]
                  <tr>
                    <td class="main" style="padding-left: 30px; padding-right: 10px; padding-top: 10px;">[@{#entry_payment_set_explain#}@]</td>
                  </tr>
                </table>
               </td>
              </tr>       
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#heading_title_modules_shipping#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
	          <tr>
                    <td class="main">[@{$group_shipment_settings_in_values_1}@]&nbsp;&nbsp;[@{#entry_group_shipping_set#}@]&nbsp;&nbsp;[@{$group_shipment_settings_in_values_0}@]&nbsp;&nbsp;[@{#entry_group_shipping_default#}@]</td>
                  </tr>
                  [@{foreach item=shipping from=$shipping_allowed}@]
	          <tr>
                    <td class="main">[@{$shipping.group_shipping_allowed_in_values}@]&nbsp;&nbsp;[@{$shipping.group_shipping_allowed_title}@]</td>
                  </tr>
                  [@{/foreach}@]
	          <tr>
                    <td class="main" style="padding-left: 30px; padding-right: 10px; padding-top: 10px;">[@{#entry_shipping_set_explain#}@]</td>
                  </tr>
                </table>
               </td>
              </tr>         
            </table></td>
          </tr>                            
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td nowrap="nowrap" align="right" class="main"><a href="[@{$link_filename_customers_groups}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="if(customers.onsubmit())customers.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_insert#}@] "><span>[@{#button_text_insert#}@]</span></a></td>
          </tr>      
        </table>[@{$form_end}@]</td>
      </tr>      
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="70" /></td>
      </tr>      
   [@{else}@]
      <tr>
        <td>[@{$form_begin_search}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="smallText" align="right">[@{#heading_title_search#}@]&nbsp;[@{$input_search}@]</td>
          </tr>
        </table>[@{$hidden_field_session}@][@{$form_end}@]</td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
	        <td class="dataTableHeadingContent"><a href="[@{$link_filename_customers_groups_sort_asc}@]"><img src="[@{$images_path}@]ic_up.gif" alt="[@{$text_sort_asc}@]" title=" [@{$text_sort_asc}@] " /></a>&nbsp;<a href="[@{$link_filename_customers_groups_sort_desc}@]"><img src="[@{$images_path}@]ic_down.gif" alt="[@{$text_sort_desc}@]" title=" [@{$text_sort_desc}@] " /></a><br />[@{#table_heading_name#}@]</td>
                <td class="dataTableHeadingContent" align="right" valign="bottom">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=customers_group from=$customers_groups}@]
              [@{if $customers_group.selected}@]               
              <tr class="dataTableRowSelected" onmouseover="this.style.cursor='hand'" onclick="document.location.href='[@{$customers_group.link_filename_customers_groups}@]'">
                <td class="dataTableContent">[@{$customers_group.group_name}@]</td>
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]
              <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='hand'" onmouseout="this.className='dataTableRow'" onclick="document.location.href='[@{$customers_group.link_filename_customers_groups}@]'">
                <td class="dataTableContent">[@{$customers_group.group_name}@]</td>
                <td class="dataTableContent" align="right"><a href="[@{$customers_group.link_filename_customers_groups}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/foreach}@]              
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]</td>
                    <td class="smallText" align="right">[@{$nav_bar_result}@]</td>
                  </tr>
                  <tr>
                  [@{if $link_filename_customers_groups_reset}@]
                    <td nowrap="nowrap" colspan="2" align="right"><a href="[@{$link_filename_customers_groups_reset}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_reset#}@] "><span>[@{#button_text_reset#}@]</span></a></td>                 
                  [@{elseif $link_filename_customers_groups_insert}@]                  
                    <td nowrap="nowrap" colspan="2" align="right"><a href="[@{$link_filename_customers_groups_insert}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_insert#}@] "><span>[@{#button_text_insert#}@]</span></a></td>
                  [@{/if}@]  
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_customers_groups}@]  
          </tr>
        </table></td>
      </tr>
   [@{/if}@]    
    </table></td>
<!-- customers_groups_eof -->
