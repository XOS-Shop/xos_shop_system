[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-a
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : checkout_confirmation.tpl
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

<!-- checkout_confirmation -->
    [@{$form_begin}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>           
          <div class="info-box-central-contents">
            <div class="main" style="padding: 4px 2px 4px 4px; width: 49%; float: left;">
              <div class="main"><b>[@{#heading_billing_address#}@]</b> <a href="[@{$link_filename_checkout_payment_address}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>
              <div class="main">[@{$billing_address}@]</div>
              <div class="main"><b>[@{#heading_payment_method#}@]</b> <a href="[@{$link_filename_checkout_payment}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>
              <div class="main">[@{$payment_method}@]</div>
            </div>
           [@{if $delivery_address}@]
            <div class="main" style="border-left: solid 1px #b6b7cb; padding: 4px 0 4px 4px; width: 48%; float: left;">                   
              <div class="main"><b>[@{#heading_delivery_address#}@]</b> <a href="[@{$link_filename_checkout_shipping_address}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>
              <div class="main">[@{$delivery_address}@]</div>               
             [@{if $shipping_method}@]                           
              <div class="main"><b>[@{#heading_shipping_method#}@]</b> <a href="[@{$link_filename_checkout_shipping}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>
              <div class="main">[@{$shipping_method}@]</div>             
             [@{/if}@]              
            </div>   
           [@{/if}@]
            <div class="clear">&nbsp;</div> 
          </div>          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>          
          <div class="main"><b>[@{#heading_products#}@]</b> <a href="[@{$link_filename_shopping_cart}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>      
          <div class="info-box-central-contents"> 
            <div>                           
                <table border="0" cellspacing="0" cellpadding="2">        
                  <tr>
                   [@{if $tax_groups}@]
                    <td width="20%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading">[@{#table_heading_products_model#}@]</td>
                    <td width="8%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading" colspan="2">[@{#table_heading_products#}@]</td>       
                    <td width="32%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading" align="right">[@{#table_heading_tax#}@]</td>    
                    <td width="1%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading">&nbsp;</td>
                    <td width="20%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading" align="right">[@{#table_heading_price#}@]</td>
                    <td width="1%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading">&nbsp;</td>
                    <td width="15%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading" align="center">[@{#table_heading_quantity#}@]</td>
                    <td width="1%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading">&nbsp;</td>
                    <td width="2%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading" align="right">[@{#table_heading_total#}@]</td>
                   [@{else}@] 
                    <td width="20%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading">[@{#table_heading_products_model#}@]</td>
                    <td width="8%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading" colspan="2">[@{#table_heading_products#}@]</td>
                    <td width="53%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading" align="right">[@{#table_heading_price#}@]</td>
                    <td width="1%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading">&nbsp;</td>
                    <td width="15%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading" align="center">[@{#table_heading_quantity#}@]</td>
                    <td width="1%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading">&nbsp;</td>
                    <td width="2%" nowrap="nowrap" class="product-listing-checkout-confirmation-heading" align="right">[@{#table_heading_total#}@]</td>            
                   [@{/if}@]  
                  </tr>
                 [@{foreach name=outer item=order_product from=$order_products}@]
                  <tr class="product-listing-checkout-confirmation-background">
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" valign="top" colspan="11">&nbsp;</td>
                  </tr> 
                  <tr class="product-listing-checkout-confirmation-background">
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" valign="top"><b>[@{$order_product.model}@]</b></td>                   
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" valign="top">
                      <table border="0" cellspacing="0" cellpadding="0">
                        <tr>                                                
                          <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" valign="top">
                            <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" valign="top">&nbsp;</td>              
                                <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" valign="top"><b>[@{$order_product.name}@]</b>[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@][@{/foreach}@]</td>                                        
                              </tr>
                            </table>                 
                          </td>
                          <td nowrap="nowrap" class="product-listing-checkout-confirmation-data">&nbsp;</td>
                          <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" valign="top" align="right">
                          [@{if $order_product.products_attributes_option_price}@]
                            <table border="0" cellspacing="0" cellpadding="0"> 
                              <tr>
                                <td nowrap="nowrap" class="product-listing-checkout-confirmation-data">&nbsp;</td>              
                                <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" align="center" valign="top">[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price_prefix}@][@{/if}@][@{/foreach}@]</td>
                                <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" align="right" valign="top">[@{$order_product.price}@][@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price}@][@{/if}@][@{/foreach}@]</td>
                              </tr>
                            </table>  
                          [@{/if}@]  
                          </td>                                                            
                        </tr>                                                
                        <tr>            
                          <td colspan="3" class="product-listing-checkout-confirmation-data" nowrap="nowrap">[@{if $order_product.packaging_unit}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />&nbsp;[@{#text_packaging_unit#}@]&nbsp;[@{$order_product.packaging_unit}@][@{/if}@]</td>                                        
                        </tr>                                                                                                                                                 
                      </table>                 
                    </td>                                                                                                                        
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" valign="top">&nbsp;</td> 
                    [@{if $tax_groups}@]       
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" align="right" valign="top">[@{$order_product.tax}@]%</td>
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data">&nbsp;</td>
                    [@{/if}@]
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" align="right" valign="top"><b>[@{$order_product.final_single_price}@]</b></td>
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data">&nbsp;</td>
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" align="center" valign="top"><b>[@{$order_product.qty}@]</b></td>
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data">&nbsp;</td>
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" align="right" valign="top"><b>[@{$order_product.final_price}@]</b></td>
                  </tr>
                 [@{/foreach}@]
                  <tr class="product-listing-checkout-confirmation-background">
                    <td nowrap="nowrap" class="product-listing-checkout-confirmation-data" valign="top" colspan="11">&nbsp;</td>
                  </tr>                               
                </table>
            </div>     
            <div style="float: right;">                  
                <table border="0" cellspacing="0" cellpadding="2">
                 [@{foreach item=order from=$order_totals}@]            
                  <tr>
                    <td nowrap="nowrap" class="main" align="right">[@{if $tax_groups && $order.totals_tax > -1}@]<span class="red-mark">[@{#table_heading_tax#}@]&nbsp;([@{$order.totals_tax}@]%)&nbsp;</span>[@{/if}@][@{$order.totals_title}@]</td>
                    <td nowrap="nowrap" class="main" align="right">[@{$order.totals_text}@]</td>
                  </tr>              
                 [@{/foreach}@] 
                </table>
            </div>
            <div class="clear">&nbsp;</div>      
          </div>                                             
     [@{if $comments}@]
          <div style="height: 10px; font-size: 0;">&nbsp;</div>          
          <div class="main"><b>[@{#heading_order_comments#}@]</b> <a href="[@{$link_filename_checkout_payment}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>      
          <div class="info-box-central-contents"> 
            <div class="main" style="padding: 4px;">[@{$comments}@][@{$hidden_field_comments}@]</div>      
          </div>   
     [@{/if}@] 
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                               
     [@{if $confirmation}@]
          <div class="main"><b>[@{#heading_payment_information#}@]</b></div> 
          <div class="info-box-central-contents">
            <div style="padding: 2px;">
              <table border="0" cellspacing="0" cellpadding="2">
              [@{if $confirmation_title}@]
                <tr>
                  <td class="main" style="padding: 0 4px 0 4px;" colspan="2">[@{$confirmation_title}@]</td>
                </tr>
              [@{/if}@]  
               [@{foreach item=confirmation_field from=$confirmation_fields}@]  
                <tr>
                  <td class="main" style="padding: 0 10px 0 4px;">[@{$confirmation_field.title}@]</td>
                  <td class="main">[@{$confirmation_field.field}@]</td>
                </tr>              
               [@{/foreach}@]              
              </table>
            </div>
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                
     [@{/if}@]
     [@{if $link_filename_popup_content_7}@]
          <div class="main"><b>[@{#table_heading_conditions#}@]</b></div>      
          <div class="info-box-central-contents" style="padding: 2px 11px 2px 11px;">                       
            <div class="main" style="padding: 1px;">              
              <script type="text/javascript">
              /* <![CDATA[ */            
                document.write('<a href="[@{$link_filename_popup_content_7}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a><a style="margin: 0 0 0 30px;" href="[@{$link_filename_popup_content_7}@]" target="_blank"><img src="[@{$images_path}@]print_red.gif" style="vertical-align:middle" title=" [@{#text_printable_version#}@] " alt="[@{#text_printable_version#}@]" /></a>');
              /* ]]> */   
              </script>             
              <noscript>
                &nbsp;<a href="[@{$link_filename_popup_content_7}@]" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a>
              </noscript>   
            </div>                       
          </div>        
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                  
     [@{/if}@]      
          <div class="main" style="float: right;">[@{$input_process_button}@]     
            <script type="text/javascript">
            /* <![CDATA[ */
              document.write('<a href="" onclick="if(checkout_confirmation.onsubmit())checkout_confirmation.submit(); return false" class="button-confirm-order" style="float: right" title=" [@{#button_title_confirm_order#}@] "><span>[@{#button_text_confirm_order#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
            /* ]]> */  
            </script>
            <noscript>
              <input type="submit" value="[@{#button_text_confirm_order#}@]" />
            </noscript>                         
          </div>
          <div class="clear">&nbsp;</div>
          <div style="padding: 0 84px 0 84px"> 
            <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
            <div class="checkout-bar-confirmation-gif">&nbsp;</div>      
            <div class="checkout-bar-from" style="width: 25%; text-align: center; float: left;"><a href="[@{$link_filename_checkout_shipping}@]" class="checkout-bar-from">[@{#checkout_bar_delivery#}@]</a></div>
            <div class="checkout-bar-from" style="width: 25%; text-align: center; float: left;"><a href="[@{$link_filename_checkout_payment}@]" class="checkout-bar-from">[@{#checkout_bar_payment#}@]</a></div>
            <div class="checkout-bar-current" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_confirmation#}@]</div>
            <div class="checkout-bar-to" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_finished#}@]</div>
            <div class="clear">&nbsp;</div>
          </div>        
    [@{$form_end}@]
<!-- checkout_confirmation_eof -->
