[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-tabs-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and css-buttons and tables for layout                                                                     
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
            <td class="main" colspan="2"><b>[@{eval var=#heading_order_number#}@] <small>([@{$orders_status}@])</small></b></td>
          </tr>
          <tr>
            <td class="small-text">[@{#heading_order_date#}@] [@{$date_purchased}@]</td>
            <td class="small-text" align="right">[@{#heading_order_total#}@] [@{$order_total}@]</td>
          </tr>
        </table></td>
      </tr>      
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td width="50%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#heading_billing_address#}@]</b></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$billing_address}@]</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#heading_payment_method#}@]</b></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$payment_method}@]</td>
              </tr>
            </table></td>
           [@{if $delivery_address}@]                    
            <td width="50%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#heading_delivery_address#}@]</b></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$delivery_address}@]</td>
              </tr>               
             [@{if $shipping_method}@]                           
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#heading_shipping_method#}@]</b></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$shipping_method}@]</td>
              </tr>              
             [@{/if}@]              
            </table></td>   
           [@{/if}@]
          </tr>
        </table></td>
      </tr>            
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>      
            <td class="main"><b>[@{#heading_ordered_products#}@]</b></td>
          </tr>
        </table></td>         
      </tr>     
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">             
            <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>                            
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">        
                  <tr>
                   [@{if $tax_groups}@]
                    <td width="20%" nowrap="nowrap" class="product-listing-account-history-info-heading">[@{#table_heading_products_model#}@]</td>
                    <td width="8%" nowrap="nowrap" class="product-listing-account-history-info-heading" colspan="2">[@{#table_heading_products#}@]</td>       
                    <td width="32%" nowrap="nowrap" class="product-listing-account-history-info-heading" align="right">[@{#table_heading_tax#}@]</td>    
                    <td width="1%" nowrap="nowrap" class="product-listing-account-history-info-heading">&nbsp;</td>
                    <td width="20%" nowrap="nowrap" class="product-listing-account-history-info-heading" align="right">[@{#table_heading_price#}@]</td>
                    <td width="1%" nowrap="nowrap" class="product-listing-account-history-info-heading">&nbsp;</td>
                    <td width="15%" nowrap="nowrap" class="product-listing-account-history-info-heading" align="center">[@{#table_heading_quantity#}@]</td>
                    <td width="1%" nowrap="nowrap" class="product-listing-account-history-info-heading">&nbsp;</td>
                    <td width="2%" nowrap="nowrap" class="product-listing-account-history-info-heading" align="right">[@{#table_heading_total#}@]</td>
                   [@{else}@] 
                    <td width="20%" nowrap="nowrap" class="product-listing-account-history-info-heading">[@{#table_heading_products_model#}@]</td>
                    <td width="8%" nowrap="nowrap" class="product-listing-account-history-info-heading" colspan="2">[@{#table_heading_products#}@]</td>
                    <td width="53%" nowrap="nowrap" class="product-listing-account-history-info-heading" align="right">[@{#table_heading_price#}@]</td>
                    <td width="1%" nowrap="nowrap" class="product-listing-account-history-info-heading">&nbsp;</td>
                    <td width="15%" nowrap="nowrap" class="product-listing-account-history-info-heading" align="center">[@{#table_heading_quantity#}@]</td>
                    <td width="1%" nowrap="nowrap" class="product-listing-account-history-info-heading">&nbsp;</td>
                    <td width="2%" nowrap="nowrap" class="product-listing-account-history-info-heading" align="right">[@{#table_heading_total#}@]</td>            
                   [@{/if}@]  
                  </tr>
                 [@{foreach name=outer item=order_product from=$order_products}@]
                  <tr class="product-listing-account-history-info-background">
                    <td nowrap="nowrap" class="product-listing-account-history-info-data" valign="top" colspan="11">&nbsp;</td>
                  </tr> 
                  <tr class="product-listing-account-history-info-background">
                    <td nowrap="nowrap" class="product-listing-account-history-info-data" valign="top"><b>[@{$order_product.model}@]</b></td>        
                    <td nowrap="nowrap" class="product-listing-account-history-info-data" valign="top">                    
                      <table border="0" cellspacing="0" cellpadding="0">
                        <tr>                                                
                          <td nowrap="nowrap" class="product-listing-account-history-info-data" valign="top">             
                            <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td nowrap="nowrap" class="product-listing-account-history-info-data" valign="top">&nbsp;</td>              
                                <td nowrap="nowrap" class="product-listing-account-history-info-data" valign="top"><b>[@{$order_product.name}@]</b>[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@][@{/foreach}@]</td>                                        
                              </tr>
                            </table>                 
                          </td>
                          <td nowrap="nowrap" class="product-listing-account-history-info-data">&nbsp;</td>
                          <td nowrap="nowrap" class="product-listing-account-history-info-data" valign="top" align="right">
                          [@{if $order_product.products_attributes_option_price}@]
                            <table border="0" cellspacing="0" cellpadding="0"> 
                              <tr>
                                <td nowrap="nowrap" class="product-listing-account-history-info-data">&nbsp;</td>              
                                <td nowrap="nowrap" class="product-listing-account-history-info-data" align="center" valign="top">[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price_prefix}@][@{/if}@][@{/foreach}@]</td>
                                <td nowrap="nowrap" class="product-listing-account-history-info-data" align="right" valign="top">[@{$order_product.price}@][@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price}@][@{/if}@][@{/foreach}@]</td>
                              </tr>
                            </table>  
                          [@{/if}@]                                        
                          </td>                                                            
                        </tr>                                                
                        <tr>            
                          <td colspan="3" class="product-listing-account-history-info-data" nowrap="nowrap">[@{if $order_product.packaging_unit}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />&nbsp;[@{#text_packaging_unit#}@]&nbsp;[@{$order_product.packaging_unit}@][@{/if}@]</td>                                        
                        </tr>                                                                                                                                                 
                      </table>                                                                
                    </td>                                     
                    <td nowrap="nowrap" class="product-listing-account-history-info-data" valign="top">&nbsp;</td> 
                    [@{if $tax_groups}@]       
                    <td nowrap="nowrap" class="product-listing-account-history-info-data" align="right" valign="top">[@{$order_product.tax}@]%</td>
                    <td nowrap="nowrap" class="product-listing-account-history-info-data">&nbsp;</td>
                    [@{/if}@]
                    <td nowrap="nowrap" class="product-listing-account-history-info-data" align="right" valign="top"><b>[@{$order_product.final_single_price}@]</b></td>
                    <td nowrap="nowrap" class="product-listing-account-history-info-data">&nbsp;</td>
                    <td nowrap="nowrap" class="product-listing-account-history-info-data" align="center" valign="top"><b>[@{$order_product.qty}@]</b></td>
                    <td nowrap="nowrap" class="product-listing-account-history-info-data">&nbsp;</td>
                    <td nowrap="nowrap" class="product-listing-account-history-info-data" align="right" valign="top"><b>[@{$order_product.final_price}@]</b></td>
                  </tr>
                 [@{/foreach}@]
                  <tr class="product-listing-account-history-info-background">
                    <td nowrap="nowrap" class="product-listing-account-history-info-data" valign="top" colspan="11">&nbsp;</td>
                  </tr>
                </table></td>                                                        
              </tr>                            
              <tr>
                <td align="right"><table border="0" cellspacing="0" cellpadding="2">
                 [@{foreach item=order from=$order_totals}@]            
                  <tr>
                    <td nowrap="nowrap" class="main" align="right" width="100%">[@{if $tax_groups && $order.totals_tax > -1}@]<span class="red-mark">[@{#table_heading_tax#}@]&nbsp;([@{$order.totals_tax}@]%)&nbsp;</span>[@{/if}@][@{$order.totals_title}@]</td>
                    <td nowrap="nowrap" class="main" align="right">[@{$order.totals_text}@]</td>
                  </tr>              
                 [@{/foreach}@] 
                </table></td>
              </tr>                                        
            </table></td>
          </tr>
        </table></td>
      </tr>      
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>      
            <td class="main"><b>[@{#heading_order_history#}@]</b></td>
          </tr>
        </table></td>         
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">            
             [@{foreach item=status from=$statuses}@]                       
              <tr>
                <td nowrap="nowrap" class="main" valign="top">[@{$status.order_date_added}@]</td>
                <td nowrap="nowrap" class="main" valign="top"><b>[@{$status.order_status_name}@]</b>&nbsp;</td>
                <td class="main" valign="top" width="90%">[@{$status.order_comments}@]</td>
              </tr>               
             [@{/foreach}@]                            
            </table></td>
          </tr>
        </table></td>
      </tr>      
      [@{$downloads}@]      
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td nowrap="nowrap"><a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- account_history_info_eof -->
