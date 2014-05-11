[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : orders.tpl
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

<!-- orders -->
   [@{if $edit}@]
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title_order#}@][@{$order_id}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">        
          <tr class="dataTableHeadingRow">
            <td colspan="3" class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>        
          <tr class="dataTableRow">
            <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>           
          <tr class="dataTableRow">
            <td nowrap="nowrap" colspan="3" align="right"><a href="[@{$link_filename_orders}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
          </tr>                                     
          <tr class="dataTableRow">
            <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
          </tr>                              
          <tr>
            <td valign="top" width="33%"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#entry_customer#}@]</b></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$customer_address}@]</td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="5" /></td>
              </tr>          
              <tr>
                <td><table border="0" cellspacing="0" cellpadding="0">                    
                  [@{if $c_id}@]
                  <tr>
                    <td nowrap="nowrap" class="main"><b>[@{#entry_customer_id#}@]</b>&nbsp;</td>
                    <td nowrap="nowrap" class="main">[@{$c_id}@]</td>
                  </tr>          
                  [@{/if}@]          
                  <tr>
                    <td nowrap="nowrap" class="main"><b>[@{#entry_telephone_number#}@]</b>&nbsp;</td>
                    <td nowrap="nowrap" class="main">[@{$telephone_number}@]</td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap" class="main"><b>[@{#entry_email_address#}@]</b>&nbsp;</td>
                    <td nowrap="nowrap" class="main"><a href="mailto:[@{$email_address}@]"><span class="text-deco-underline">[@{$email_address}@]</span></a></td>
                  </tr>
                </table></td> 
              </tr>          
            </table></td>
            <td valign="top" width="33%"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#entry_billing_address#}@]</b></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$billing_address}@]</td>
              </tr>
            </table></td>                    
            <td valign="top" width="33%">
            [@{if $delivery_address}@]
              <table border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td nowrap="nowrap" class="main"><b>[@{#entry_shipping_address#}@]</b></td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="main">[@{$delivery_address}@]</td>
                </tr>
              </table>
            [@{/if}@]  
            </td>
          </tr>
        </table></td>
      </tr>     
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#entry_payment_method#}@]</b></td>
            <td class="main">[@{$payment_method}@]</td>
          </tr>
          [@{if $credit_card}@]         
          <tr>
            <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td class="main">[@{#entry_credit_card_type#}@]</td>
            <td class="main">[@{$credit_card_type}@]</td>
          </tr>
          <tr>
            <td class="main">[@{#entry_credit_card_owner#}@]</td>
            <td class="main">[@{$credit_card_owner}@]</td>
          </tr>
          <tr>
            <td class="main">[@{#entry_credit_card_number#}@]</td>
            <td class="main">[@{$credit_card_number}@]</td>
          </tr>
          <tr>
            <td class="main">[@{#entry_credit_card_expires#}@]</td>
            <td class="main">[@{$credit_card_expires}@]</td>
          </tr>
          [@{/if}@]          
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">        
          <tr class="dataHeadingRow">
          [@{if $tax_groups}@]
            <td width="20%" nowrap="nowrap" class="dataHeadingContent">[@{#table_heading_products_model#}@]</td>
            <td width="8%" nowrap="nowrap" class="dataHeadingContent" colspan="2">[@{#table_heading_products#}@]</td>        
            <td width="32%" nowrap="nowrap" class="dataHeadingContent" align="right">[@{#table_heading_tax#}@]</td>    
            <td width="1%" nowrap="nowrap" class="dataHeadingContent">&nbsp;</td>
            <td width="20%" nowrap="nowrap" class="dataHeadingContent" align="right">[@{#table_heading_price#}@]</td>
            <td width="1%" nowrap="nowrap" class="dataHeadingContent">&nbsp;</td>
            <td width="15%" nowrap="nowrap" class="dataHeadingContent" align="center">[@{#table_heading_quantity#}@]</td>
            <td width="1%" nowrap="nowrap" class="dataHeadingContent">&nbsp;</td>
            <td width="2%" nowrap="nowrap" class="dataHeadingContent" align="right">[@{#table_heading_total#}@]</td>
          [@{else}@]          
            <td width="20%" nowrap="nowrap" class="dataHeadingContent">[@{#table_heading_products_model#}@]</td>
            <td width="8%" nowrap="nowrap" class="dataHeadingContent" colspan="2">[@{#table_heading_products#}@]</td>        
            <td width="53%" nowrap="nowrap" class="dataHeadingContent" align="right">[@{#table_heading_price#}@]</td>
            <td width="1%" nowrap="nowrap" class="dataHeadingContent">&nbsp;</td>
            <td width="15%" nowrap="nowrap" class="dataHeadingContent" align="center">[@{#table_heading_quantity#}@]</td>
            <td width="1%" nowrap="nowrap" class="dataHeadingContent">&nbsp;</td>
            <td width="2%" nowrap="nowrap" class="dataHeadingContent" align="right">[@{#table_heading_total#}@]</td>          
          [@{/if}@]  
          </tr>
         [@{foreach name=outer item=order_product from=$order_products}@]
          <tr>
            <td nowrap="nowrap" class="smallText" valign="top" colspan="11">&nbsp;</td>
          </tr> 
          <tr>
            <td nowrap="nowrap" class="smallText" valign="top"><b>[@{$order_product.model}@]</b></td>                      
            <td nowrap="nowrap" class="smallText" valign="top">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>                                                        
                  <td nowrap="nowrap" class="smallText" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td nowrap="nowrap" class="smallText" valign="top">&nbsp;</td>              
                        <td nowrap="nowrap" class="smallText" valign="top"><b>[@{$order_product.name}@]</b>[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@][@{/foreach}@]</td>                                        
                      </tr>
                    </table>                 
                  </td>
                  <td nowrap="nowrap" class="smallText">&nbsp;</td>
                  <td nowrap="nowrap" class="smallText" valign="top" align="right">
                  [@{if $order_product.products_attributes_option_price}@]
                    <table border="0" cellspacing="0" cellpadding="0"> 
                      <tr>
                        <td nowrap="nowrap" class="smallText">&nbsp;</td>              
                        <td nowrap="nowrap" class="smallText" align="center" valign="top">[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price_prefix}@][@{/if}@][@{/foreach}@]</td>
                        <td nowrap="nowrap" class="smallText" align="right" valign="top">[@{$order_product.price}@][@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price}@][@{/if}@][@{/foreach}@]</td>
                      </tr>
                    </table>  
                  [@{/if}@]  
                  </td>                                                            
                </tr>                                                
                <tr>            
                  <td colspan="3" class="smallText" nowrap="nowrap">[@{if $order_product.packaging_unit}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />&nbsp;[@{#text_packaging_unit#}@]&nbsp;[@{$order_product.packaging_unit}@][@{/if}@]</td>                                        
                </tr>                                                                                                                                                 
              </table>                 
            </td>                                    
            <td nowrap="nowrap" class="smallText" valign="top">&nbsp;</td>
            [@{if $tax_groups}@]        
            <td nowrap="nowrap" class="smallText" align="right" valign="top">[@{$order_product.tax}@]%</td>
            <td nowrap="nowrap" class="smallText">&nbsp;</td>
            [@{/if}@]
            <td nowrap="nowrap" class="smallText" align="right" valign="top"><b>[@{$order_product.final_single_price}@]</b></td>
            <td nowrap="nowrap" class="smallText">&nbsp;</td>
            <td nowrap="nowrap" class="smallText" align="center" valign="top"><b>[@{$order_product.qty}@]</b></td>
            <td nowrap="nowrap" class="smallText">&nbsp;</td>
            <td nowrap="nowrap" class="smallText" align="right" valign="top"><b>[@{$order_product.final_price}@]</b></td>
          </tr>
         [@{/foreach}@]
          <tr>
            <td nowrap="nowrap" class="smallText" valign="top" colspan="11">&nbsp;</td>
          </tr>         
        </table></td>
      </tr>       
      <tr>
        <td align="right"><table border="0" cellspacing="0" cellpadding="2">
         [@{foreach item=order_total from=$order_totals}@]
          <tr>
            <td nowrap="nowrap" align="right" class="smallText">[@{if $tax_groups && $order_total.tax > -1}@]<span style="color : #ff0000;">[@{#table_heading_tax#}@]&nbsp;([@{$order_total.tax}@]%)&nbsp;</span>[@{/if}@][@{$order_total.title}@]</td>
            <td nowrap="nowrap" align="right" class="smallText">[@{$order_total.text}@]</td>
          </tr>
         [@{/foreach}@]
        </table></td>
      </tr>                      
      <tr class="dataTableRow">
        <td><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
      </tr>           
      <tr class="dataTableRow">
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
      </tr>       
      <tr class="dataTableRow">
        <td><table style="background-color: #fefe51" border="2" cellspacing="0" cellpadding="5">
          <tr class="smallText">
            <td align="center"><b>[@{#table_heading_date_added#}@]</b></td>
            <td align="center"><b>[@{#table_heading_customer_notified#}@]</b></td>
            <td align="center"><b>[@{#table_heading_status#}@]</b></td>
            <td align="center"><b>[@{#table_heading_comments#}@]</b></td>
          </tr>
          [@{foreach item=order_history from=$orders_history}@]
          <tr class="smallText">
            <td align="center">[@{$order_history.date_added}@]</td>
            <td align="center">[@{if $order_history.customer_notified}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
            <td>[@{$order_history.status}@]</td>
            <td>[@{$order_history.comments|default:'&nbsp;'}@]</td>
          </tr>
          [@{foreachelse}@]
          <tr class="smallText">
            <td colspan="4">[@{#text_no_order_history#}@]</td>
          </tr>
          [@{/foreach}@]
        </table></td>
      </tr>
      <tr class="dataTableRow">
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" /></td>
      </tr>       
      <tr class="dataTableRow">
        <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="2" height="10" /><b>[@{#table_heading_comments#}@]</b>&nbsp;<span class="smallText">([@{#text_language#}@] [@{$order_language_name}@])</span></td>
      </tr>
      <tr class="dataTableRow">
        <td>[@{$form_begin_status}@]<table border="0" cellspacing="0" cellpadding="1">
          <tr>
            <td class="main">[@{$textarea_comments}@]</td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>        
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b>[@{#entry_status#}@]</b>&nbsp;[@{$pull_down_status}@]</td>
              </tr>
              [@{if $send_emails}@]
              <tr>
                <td class="main"><b>[@{#entry_notify_customer#}@]</b>&nbsp;[@{$checkbox_notify}@]</td>
                <td class="main"><b>[@{#entry_notify_comments#}@]</b>&nbsp;[@{$checkbox_notify_comments}@]</td>
              </tr>
              [@{/if}@]
            </table></td>
            <td nowrap="nowrap" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;<a href="" onclick="new_status.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>
          </tr>
        </table>[@{$form_end}@]</td>
      </tr>      
      <tr class="dataTableRow">
        <td nowrap="nowrap" colspan="2" align="right"><a href="[@{$link_filename_orders}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a><a href="javascript:popupWindow('[@{$link_filename_orders_packingslip}@]')" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_orders_packingslip#}@] "><span>[@{#button_text_orders_packingslip#}@]</span></a><a href="javascript:popupWindow('[@{$link_filename_orders_invoice}@]')" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_orders_invoice#}@] "><span>[@{#button_text_orders_invoice#}@]</span></a></td>
      </tr>       
   [@{else}@] 
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>               
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>                
                <td class="smallText" align="right">[@{$form_begin_orders}@][@{#heading_title_search#}@]&nbsp;[@{$input_oid}@][@{$hidden_action}@][@{$hidden_field_session}@][@{$form_end}@]</td>
              </tr>
              <tr>
                <td class="smallText" align="right">[@{$form_begin_status}@][@{#heading_title_status#}@]&nbsp;[@{$pull_down_status}@][@{$hidden_field_session}@][@{$form_end}@]</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">[@{#table_heading_customers#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_order_total#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_date_purchased#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_status#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=order from=$orders}@]
              [@{if $order.selected}@]
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$order.link_filename_orders}@]'">
                <td class="dataTableContent"><a href="[@{$order.link_filename_orders_action_edit}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a>&nbsp;[@{$order.customers_name}@]</td>
                <td class="dataTableContent" align="right">[@{$order.order_total}@]</td>
                <td class="dataTableContent" align="center">[@{$order.date_purchased}@]</td>
                <td class="dataTableContent" align="right">[@{$order.order_status_name}@]</td>
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$order.link_filename_orders}@]'">
                <td class="dataTableContent"><a href="[@{$order.link_filename_orders_action_edit}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a>&nbsp;[@{$order.customers_name}@]</td>
                <td class="dataTableContent" align="right">[@{$order.order_total}@]</td>
                <td class="dataTableContent" align="center">[@{$order.date_purchased}@]</td>
                <td class="dataTableContent" align="right">[@{$order.order_status_name}@]</td>
                <td class="dataTableContent" align="right"><a href="[@{$order.link_filename_orders}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/foreach}@]
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]</td>
                    <td class="smallText" align="right">[@{$nav_bar_result}@]</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_orders}@]
          </tr>
        </table></td>
      </tr> 
   [@{/if}@]           
    </table></td>
<!-- orders_eof -->
