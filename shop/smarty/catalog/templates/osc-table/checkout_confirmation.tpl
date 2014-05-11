[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
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
    <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_confirmation.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="50%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#heading_billing_address#}@]</b> <a href="[@{$link_filename_checkout_payment_address}@]"><span class="orderEdit">([@{#text_edit#}@])</span></a></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$billing_address}@]</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#heading_payment_method#}@]</b> <a href="[@{$link_filename_checkout_payment}@]"><span class="orderEdit">([@{#text_edit#}@])</span></a></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$payment_method}@]</td>
              </tr>
            </table></td>
           [@{if $delivery_address}@]
            <td width="50%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#heading_delivery_address#}@]</b> <a href="[@{$link_filename_checkout_shipping_address}@]"><span class="orderEdit">([@{#text_edit#}@])</span></a></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$delivery_address}@]</td>
              </tr>
             [@{if $shipping_method}@] 
              <tr>
                <td nowrap="nowrap" class="main"><b>[@{#heading_shipping_method#}@]</b> <a href="[@{$link_filename_checkout_shipping}@]"><span class="orderEdit">([@{#text_edit#}@])</span></a></td>
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
            <td class="main"><b>[@{#heading_products#}@]</b> <a href="[@{$link_filename_shopping_cart}@]"><span class="orderEdit">([@{#text_edit#}@])</span></a></td>
          </tr>
        </table></td>        
      </tr>     
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">            
            <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">           
              <tr>                            
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">        
                  <tr class="dataTableHeadingRow">
                   [@{if $tax_groups}@]
                    <td width="20%" nowrap="nowrap" class="productListing-heading">[@{#table_heading_products_model#}@]</td>
                    <td width="8%" nowrap="nowrap" class="productListing-heading" colspan="2">[@{#table_heading_products#}@]</td>       
                    <td width="32%" nowrap="nowrap" class="productListing-heading" align="right">[@{#table_heading_tax#}@]</td>    
                    <td width="1%" nowrap="nowrap" class="productListing-heading">&nbsp;</td>
                    <td width="20%" nowrap="nowrap" class="productListing-heading" align="right">[@{#table_heading_price#}@]</td>
                    <td width="1%" nowrap="nowrap" class="productListing-heading">&nbsp;</td>
                    <td width="15%" nowrap="nowrap" class="productListing-heading" align="center">[@{#table_heading_quantity#}@]</td>
                    <td width="1%" nowrap="nowrap" class="productListing-heading">&nbsp;</td>
                    <td width="2%" nowrap="nowrap" class="productListing-heading" align="right">[@{#table_heading_total#}@]</td>
                   [@{else}@] 
                    <td width="20%" nowrap="nowrap" class="productListing-heading">[@{#table_heading_products_model#}@]</td>
                    <td width="8%" nowrap="nowrap" class="productListing-heading" colspan="2">[@{#table_heading_products#}@]</td>
                    <td width="53%" nowrap="nowrap" class="productListing-heading" align="right">[@{#table_heading_price#}@]</td>
                    <td width="1%" nowrap="nowrap" class="productListing-heading">&nbsp;</td>
                    <td width="15%" nowrap="nowrap" class="productListing-heading" align="center">[@{#table_heading_quantity#}@]</td>
                    <td width="1%" nowrap="nowrap" class="productListing-heading">&nbsp;</td>
                    <td width="2%" nowrap="nowrap" class="productListing-heading" align="right">[@{#table_heading_total#}@]</td>            
                   [@{/if}@]  
                  </tr>
                 [@{foreach name=outer item=order_product from=$order_products}@]
                  <tr class="productListing-odd">
                    <td nowrap="nowrap" class="productListing-data" valign="top" colspan="11">&nbsp;</td>
                  </tr> 
                  <tr class="productListing-odd">                    
                    <td nowrap="nowrap" class="productListing-data" valign="top"><b>[@{$order_product.model}@]</b></td>        
                    <td nowrap="nowrap" class="productListing-data" valign="top">                    
                      <table border="0" cellspacing="0" cellpadding="0">
                        <tr>                                                
                          <td nowrap="nowrap" class="productListing-data" valign="top">             
                            <table border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td nowrap="nowrap" class="productListing-data" valign="top">&nbsp;</td>              
                                <td nowrap="nowrap" class="productListing-data" valign="top"><b>[@{$order_product.name}@]</b>[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@][@{/foreach}@]</td>                                        
                              </tr>
                            </table>                 
                          </td>
                          <td nowrap="nowrap" class="productListing-data">&nbsp;</td>
                          <td nowrap="nowrap" class="productListing-data" valign="top" align="right">
                          [@{if $order_product.products_attributes_option_price}@]
                            <table border="0" cellspacing="0" cellpadding="0"> 
                              <tr>
                                <td nowrap="nowrap" class="productListing-data">&nbsp;</td>              
                                <td nowrap="nowrap" class="productListing-data" align="center" valign="top">[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price_prefix}@][@{/if}@][@{/foreach}@]</td>
                                <td nowrap="nowrap" class="productListing-data" align="right" valign="top">[@{$order_product.price}@][@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price}@][@{/if}@][@{/foreach}@]</td>
                              </tr>
                            </table>  
                          [@{/if}@]                                        
                          </td>                                                            
                        </tr>                                                
                        <tr>            
                          <td colspan="3" class="productListing-data" nowrap="nowrap">[@{if $order_product.packaging_unit}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />&nbsp;[@{#text_packaging_unit#}@]&nbsp;[@{$order_product.packaging_unit}@][@{/if}@]</td>                                        
                        </tr>                                                                                                                                                 
                      </table>                                                                
                    </td>                                                         
                    <td nowrap="nowrap" class="productListing-data" valign="top">&nbsp;</td> 
                    [@{if $tax_groups}@]       
                    <td nowrap="nowrap" class="productListing-data" align="right" valign="top">[@{$order_product.tax}@]%</td>
                    <td nowrap="nowrap" class="productListing-data">&nbsp;</td>
                    [@{/if}@]
                    <td nowrap="nowrap" class="productListing-data" align="right" valign="top"><b>[@{$order_product.final_single_price}@]</b></td>
                    <td nowrap="nowrap" class="productListing-data">&nbsp;</td>
                    <td nowrap="nowrap" class="productListing-data" align="center" valign="top"><b>[@{$order_product.qty}@]</b></td>
                    <td nowrap="nowrap" class="productListing-data">&nbsp;</td>
                    <td nowrap="nowrap" class="productListing-data" align="right" valign="top"><b>[@{$order_product.final_price}@]</b></td>
                  </tr>
                 [@{/foreach}@]
                  <tr class="productListing-odd">
                    <td nowrap="nowrap" class="productListing-data" valign="top" colspan="11">&nbsp;</td>
                  </tr>                               
                </table></td>                                                                 
              </tr>              
              <tr>
                <td align="right"><table border="0" cellspacing="0" cellpadding="2">
                 [@{foreach item=order from=$order_totals}@]            
                  <tr>
                    <td nowrap="nowrap" class="main" align="right" width="100%">[@{if $tax_groups && $order.totals_tax > -1}@]<span style="color : #ff0000;">[@{#table_heading_tax#}@]&nbsp;([@{$order.totals_tax}@]%)&nbsp;</span>[@{/if}@][@{$order.totals_title}@]</td>
                    <td nowrap="nowrap" class="main" align="right">[@{$order.totals_text}@]</td>
                  </tr>              
                 [@{/foreach}@] 
                </table></td>
              </tr>                                                                                     
            </table></td>
          </tr>
        </table></td>
      </tr>
     [@{if $comments}@]
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      <tr>      
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>      
            <td class="main"><b>[@{#heading_order_comments#}@]</b> <a href="[@{$link_filename_checkout_payment}@]"><span class="orderEdit">([@{#text_edit#}@])</span></a></td>
          </tr>
        </table></td>              
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main">[@{$comments}@][@{$hidden_field_comments}@]</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>    
     [@{/if}@] 
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>                      
     [@{if $confirmation}@]
      <tr>      
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>      
            <td class="main"><b>[@{#heading_payment_information#}@]</b></td>
          </tr>
        </table></td>              
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" colspan="4">[@{$confirmation_title}@]</td>
              </tr>
             [@{foreach item=confirmation_field from=$confirmation_fields}@]  
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main">[@{$confirmation_field.title}@]</td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main">[@{$confirmation_field.field}@]</td>
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
     [@{if $link_filename_popup_content_7}@]
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
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" colspan="2">                          
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('&nbsp;<a href="[@{$link_filename_popup_content_7}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a><a style="margin: 0 0 0 30px;" href="[@{$link_filename_popup_content_7}@]" target="_blank"><img src="[@{$images_path}@]print_red.gif" style="vertical-align:middle" title=" [@{#text_printable_version#}@] " alt="[@{#text_printable_version#}@]" /></a>');
                  /* ]]> */   
                  </script>
                  <noscript>
                    &nbsp;<a href="[@{$link_filename_popup_content_7}@]" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a>
                  </noscript>                              
                </td>                
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" class="main">            
            <td nowrap="nowrap" class="main" align="right">[@{$input_process_button}@]
              <script type="text/javascript">
              /* <![CDATA[ */
                document.write('<a href="" onclick="if(checkout_confirmation.onsubmit())checkout_confirmation.submit(); return false" class="button-confirm-order" style="float: right" title=" [@{#button_title_confirm_order#}@] "><span>[@{#button_text_confirm_order#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
              /* ]]> */  
              </script>
              <noscript>
                <input type="submit" value="[@{#button_text_confirm_order#}@]" />
              </noscript>                         
            </td>            
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
            <td width="25%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
                <td><img src="[@{$images_path}@]checkout_bullet.gif" alt="" /></td>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
              </tr>
            </table></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="100%" height="1" /></td>
                <td width="50%"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="1" height="5" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkoutBarFrom"><a href="[@{$link_filename_checkout_shipping}@]" class="checkoutBarFrom">[@{#checkout_bar_delivery#}@]</a></td>
            <td align="center" width="25%" class="checkoutBarFrom"><a href="[@{$link_filename_checkout_payment}@]" class="checkoutBarFrom">[@{#checkout_bar_payment#}@]</a></td>
            <td align="center" width="25%" class="checkoutBarCurrent">[@{#checkout_bar_confirmation#}@]</td>
            <td align="center" width="25%" class="checkoutBarTo">[@{#checkout_bar_finished#}@]</td>
          </tr>
        </table></td>
      </tr>
    </table>[@{$form_end}@]</td>
<!-- checkout_confirmation_eof -->
