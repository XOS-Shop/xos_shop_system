[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c-html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : account_history_info.tpl
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

<!-- account_history_info -->
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>          
          <div class="main"><b>[@{eval var=#heading_order_number#}@] <small>([@{$orders_status}@])</small></b></div>
          <div class="small-text" style="padding: 0 0 2px 0; float: left;">[@{#heading_order_date#}@] [@{$date_purchased}@]</div>
          <div class="small-text" style="padding: 0 0 2px 0; text-align: right; float: right;">[@{#heading_order_total#}@] [@{$order_total}@]</div>
          <div class="clear">&nbsp;</div>                  
          <div class="info-box-central-contents">
            <div class="main" style="padding: 4px 2px 4px 4px; width: 49%; float: left;">
              <div class="main"><b>[@{#heading_billing_address#}@]</b></div>
              <div class="main">[@{$billing_address}@]</div>
              <div class="main"><b>[@{#heading_payment_method#}@]</b></div>
              <div class="main">[@{$payment_method}@]</div>
            </div>
           [@{if $delivery_address}@]
            <div class="main" style="border-left: solid 1px #b6b7cb; padding: 4px 0 4px 4px; width: 48%; float: left;">                   
              <div class="main"><b>[@{#heading_delivery_address#}@]</b></div>
              <div class="main">[@{$delivery_address}@]</div>               
             [@{if $shipping_method}@]                           
              <div class="main"><b>[@{#heading_shipping_method#}@]</b></div>
              <div class="main">[@{$shipping_method}@]</div>             
             [@{/if}@]              
            </div>   
           [@{/if}@]
            <div class="clear">&nbsp;</div> 
          </div>          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        
          <div class="main"><b>[@{#heading_ordered_products#}@]</b></div>      
          <div class="info-box-central-contents"> 
            <div>                
                <table class="table-border-cellspacing cellpadding-2px">        
                  <tr>
                   [@{if $tax_groups}@]
                    <td class="product-listing-account-history-info-heading" style="width: 20%; white-space: nowrap; border-top-left-radius: 10px;">[@{#table_heading_products_model#}@]</td>
                    <td class="product-listing-account-history-info-heading" style="width: 8%; white-space: nowrap;" colspan="2">[@{#table_heading_products#}@]</td>       
                    <td class="product-listing-account-history-info-heading" style="width: 32%; white-space: nowrap; text-align: right;">[@{#table_heading_tax#}@]</td>    
                    <td class="product-listing-account-history-info-heading" style="width: 1%; white-space: nowrap;">&nbsp;</td>
                    <td class="product-listing-account-history-info-heading" style="width: 20%; white-space: nowrap; text-align: right;">[@{#table_heading_price#}@]</td>
                    <td class="product-listing-account-history-info-heading" style="width: 1%; white-space: nowrap;">&nbsp;</td>
                    <td class="product-listing-account-history-info-heading" style="width: 15%; white-space: nowrap; text-align: center;">[@{#table_heading_quantity#}@]</td>
                    <td class="product-listing-account-history-info-heading" style="width: 1%; white-space: nowrap;">&nbsp;</td>
                    <td class="product-listing-account-history-info-heading" style="width: 2%; white-space: nowrap; text-align: right; border-top-right-radius: 10px;">[@{#table_heading_total#}@]</td>
                   [@{else}@] 
                    <td class="product-listing-account-history-info-heading" style="width: 20%; white-space: nowrap; border-top-left-radius: 10px;">[@{#table_heading_products_model#}@]</td>
                    <td class="product-listing-account-history-info-heading" style="width: 8%; white-space: nowrap;" colspan="2">[@{#table_heading_products#}@]</td>
                    <td class="product-listing-account-history-info-heading" style="width: 53%; white-space: nowrap; text-align: right;">[@{#table_heading_price#}@]</td>
                    <td class="product-listing-account-history-info-heading" style="width: 1%; white-space: nowrap;">&nbsp;</td>
                    <td class="product-listing-account-history-info-heading" style="width: 15%; white-space: nowrap; text-align: center;">[@{#table_heading_quantity#}@]</td>
                    <td class="product-listing-account-history-info-heading" style="width: 1%; white-space: nowrap;">&nbsp;</td>
                    <td class="product-listing-account-history-info-heading" style="width: 2%; white-space: nowrap; text-align: right; border-top-right-radius: 10px;">[@{#table_heading_total#}@]</td>            
                   [@{/if}@]  
                  </tr>
                 [@{foreach name=outer item=order_product from=$order_products}@]
                  <tr class="product-listing-account-history-info-background">
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap; vertical-align: top;" colspan="[@{if $tax_groups}@]10[@{else}@]8[@{/if}@]">&nbsp;</td>
                  </tr> 
                  <tr class="product-listing-account-history-info-background">
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap; vertical-align: top;"><b>[@{$order_product.model}@]</b></td>        
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap; vertical-align: top;">                    
                      <table class="table-border-cellspacing cellpadding-0px">
                        <tr>                                                
                          <td class="product-listing-account-history-info-data" style="white-space: nowrap; vertical-align: top;">             
                            <table class="table-border-cellspacing cellpadding-0px">
                              <tr>
                                <td class="product-listing-account-history-info-data" style="white-space: nowrap; vertical-align: top;">&nbsp;</td>              
                                <td class="product-listing-account-history-info-data" style="white-space: nowrap; vertical-align: top;"><b>[@{$order_product.name}@]</b>[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@][@{/foreach}@]</td>                                        
                              </tr>
                            </table>                 
                          </td>
                          <td class="product-listing-account-history-info-data" style="white-space: nowrap;">&nbsp;</td> 
                          <td class="product-listing-account-history-info-data" style="white-space: nowrap; text-align: right; vertical-align: top;">
                          [@{if $order_product.products_attributes_option_price}@]
                            <table class="table-border-cellspacing cellpadding-0px"> 
                              <tr>
                                <td class="product-listing-account-history-info-data" style="white-space: nowrap;">&nbsp;</td>              
                                <td class="product-listing-account-history-info-data" style="white-space: nowrap; text-align: center; vertical-align: top;">[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price_prefix}@][@{/if}@][@{/foreach}@]</td>
                                <td class="product-listing-account-history-info-data" style="white-space: nowrap; text-align: right; vertical-align: top;">[@{$order_product.price}@][@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price}@][@{/if}@][@{/foreach}@]</td>
                              </tr>
                            </table>  
                          [@{/if}@]                                        
                          </td>                                                            
                        </tr>                                                
                        <tr>            
                          <td colspan="3" class="product-listing-account-history-info-data" style="white-space: nowrap;">[@{if $order_product.packaging_unit}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 4px;" />&nbsp;[@{#text_packaging_unit#}@]&nbsp;[@{$order_product.packaging_unit}@][@{/if}@]</td>                                        
                        </tr>                                                                                                                                                 
                      </table>                                                                
                    </td>                                     
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap; vertical-align: top;">&nbsp;</td> 
                    [@{if $tax_groups}@]       
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap; text-align: right; vertical-align: top;">[@{$order_product.tax}@]%</td>
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap;">&nbsp;</td>
                    [@{/if}@]
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap; text-align: right; vertical-align: top;"><b>[@{$order_product.final_single_price}@]</b></td>
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap;">&nbsp;</td>
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap; text-align: center; vertical-align: top;"><b>[@{$order_product.qty}@]</b></td>
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap;">&nbsp;</td>
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap; text-align: right; vertical-align: top;"><b>[@{$order_product.final_price}@]</b></td>
                  </tr>
                 [@{/foreach}@]
                  <tr class="product-listing-account-history-info-background">
                    <td class="product-listing-account-history-info-data" style="white-space: nowrap; vertical-align: top;" colspan="[@{if $tax_groups}@]10[@{else}@]8[@{/if}@]">&nbsp;</td>
                  </tr>
                </table>
            </div>     
            <div style="float: right;">      
              <table class="table-border-cellspacing cellpadding-2px">
               [@{foreach item=order from=$order_totals}@]            
                <tr>
                  <td class="main" style="white-space: nowrap; text-align: right;">[@{if $tax_groups && $order.totals_tax > -1}@]<span class="red-mark">[@{#table_heading_tax#}@]&nbsp;([@{$order.totals_tax}@]%)&nbsp;</span>[@{/if}@][@{$order.totals_title}@]</td>
                  <td class="main" style="white-space: nowrap; text-align: right;">[@{$order.totals_text}@]</td>
                </tr>              
               [@{/foreach}@] 
              </table>                
            </div>
            <div class="clear">&nbsp;</div>      
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <div class="main"><b>[@{#heading_order_history#}@]</b></div>        
          <div class="info-box-central-contents"> 
          [@{foreach item=status from=$statuses}@]
            <div class="main" style="padding: 4px 2px 4px 4px; width: 10%; float: left;">[@{$status.order_date_added}@]</div>
            <div class="main" style="padding: 4px 2px 4px 2px; width: 16%; float: left; white-space: nowrap;"><b>[@{$status.order_status_name}@]</b>&nbsp;</div>
            <div class="main" style="padding: 4px 2px 4px 2px; width: 71%; float: left;">[@{$status.order_comments}@]</div>
            <div class="clear">&nbsp;</div>                          
          [@{/foreach}@]                            
          </div>
           
          [@{$downloads}@]      
        
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              <div class="clear">&nbsp;</div> 
            </div>
          </div>         
<!-- account_history_info_eof -->
