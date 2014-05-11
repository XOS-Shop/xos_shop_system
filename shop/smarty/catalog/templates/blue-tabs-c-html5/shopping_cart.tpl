[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c-html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : shopping_cart.tpl
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

<!-- shopping_cart -->
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>  
    [@{if $products_in_cart}@]
    [@{$form_begin}@]
          <table class="table-border-cellspacing cellpadding-2px product-listing-cart" style="width: 100%">
            <tr>
             [@{if $tax_groups}@]
              <td class="product-listing-cart-heading" style="width: 1%; white-space: nowrap; text-align: center;">[@{#table_heading_remove#}@]</td>
              <td class="product-listing-cart-heading" style="width: 1%; white-space: nowrap; text-align: center;">[@{#table_heading_model#}@]</td>
              <td class="product-listing-cart-heading" colspan="2" style="width: 7%; white-space: nowrap;">&nbsp; &nbsp;&nbsp;[@{#table_heading_products#}@]</td>
              <td class="product-listing-cart-heading" style="width: 64%; white-space: nowrap; text-align: right;">[@{#table_heading_tax#}@]</td>
              <td class="product-listing-cart-heading" style="width: 9%; white-space: nowrap; text-align: right;">[@{#table_heading_price#}@]</td>
              <td class="product-listing-cart-heading" style="width: 16%; white-space: nowrap; text-align: center;">&nbsp; [@{#table_heading_quantity#}@]</td>
              <td class="product-listing-cart-heading" style="width: 2%; white-space: nowrap; text-align: right;">[@{#table_heading_total#}@]</td>
             [@{else}@]
              <td class="product-listing-cart-heading" style="width: 2%; white-space: nowrap; text-align: center;">[@{#table_heading_remove#}@]</td>
              <td class="product-listing-cart-heading" style="width: 2%; white-space: nowrap; text-align: center;">[@{#table_heading_model#}@]</td>
              <td class="product-listing-cart-heading" colspan="2" style="width: 9%; white-space: nowrap;">&nbsp; &nbsp;&nbsp;[@{#table_heading_products#}@]</td>
              <td class="product-listing-cart-heading" style="width: 52%; white-space: nowrap; text-align: right;">[@{#table_heading_price#}@]</td>
              <td class="product-listing-cart-heading" style="width: 33%; white-space: nowrap; text-align: center;">&nbsp; [@{#table_heading_quantity#}@]</td>
              <td class="product-listing-cart-heading" style="width: 2%; white-space: nowrap; text-align: right;">[@{#table_heading_total#}@]</td>             
             [@{/if}@] 
            </tr>
            [@{foreach name=outer item=product from=$products}@]            
            [@{if (($smarty.foreach.outer.iteration-1)%2) == 0}@]
            <tr class="product-listing-cart-odd">
            [@{else}@]
            <tr class="product-listing-cart-even">
            [@{/if}@]
              <td colspan="[@{if $tax_groups}@]8[@{else}@]7[@{/if}@]"><img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 1px;" /></td>              
            </tr>                                    
            [@{if (($smarty.foreach.outer.iteration-1)%2) == 0}@]
            <tr class="product-listing-cart-odd">
            [@{else}@]
            <tr class="product-listing-cart-even">
            [@{/if}@]
              <td rowspan="2" class="product-listing-cart-data" style="white-space: nowrap; text-align: center;">[@{$product.checkbox_cart_delete}@]</td>
              <td rowspan="2" class="product-listing-cart-data" style="white-space: nowrap;"><b>[@{$product.products_model}@]</b></td>
              <td colspan="[@{if $tax_groups}@]6[@{else}@]5[@{/if}@]" class="product-listing-cart-data" style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;<a href="[@{$product.link_filename_product_info}@]">[@{$product.products_image}@]</a></td>              
            </tr>                       
            [@{if (($smarty.foreach.outer.iteration-1)%2) == 0}@]
            <tr class="product-listing-cart-odd">
            [@{else}@]
            <tr class="product-listing-cart-even">
            [@{/if}@]            
              <td class="product-listing-cart-data" style="vertical-align: top;">
                <table class="table-border-cellspacing cellpadding-0px">
                  <tr>                          
                    <td class="product-listing-cart-data" style="vertical-align: top;">
                      <table class="table-border-cellspacing cellpadding-0px">
                        <tr>
                          <td class="product-listing-cart-data" style="white-space: nowrap;">&nbsp; &nbsp;</td>             
                          <td class="product-listing-cart-data" style="white-space: nowrap;"><a href="[@{$product.link_filename_product_info}@]"><b>[@{$product.products_name}@] [@{$product.stock_check}@]</b></a>[@{foreach name=inner item=product_attribute from=$product.products_attributes}@]<br />[@{$product_attribute.products_options_name}@]: [@{$product_attribute.products_options_values_name}@][@{$product_attribute.hidden_field}@][@{/foreach}@]</td>                                        
                        </tr>
                      </table>                 
                    </td> 
                    <td class="product-listing-cart-data">&nbsp;</td>            
                    <td class="product-listing-cart-data" style="text-align: right; vertical-align: top;">
                    [@{if $product.products_attributes_option_price}@]
                      <table class="table-border-cellspacing cellpadding-0px"> 
                        <tr>
                          <td class="product-listing-cart-data" style="white-space: nowrap;">&nbsp;</td>
                          <td class="product-listing-cart-data" style="white-space: nowrap; text-align: center;">[@{foreach name=inner item=product_attribute from=$product.products_attributes}@]<br />[@{if $product_attribute.options_values_price}@][@{$product_attribute.price_prefix}@][@{else}@]&nbsp;[@{/if}@][@{/foreach}@]</td>
                          <td class="product-listing-cart-data" style="white-space: nowrap; text-align: right;">[@{$product.products_price}@][@{foreach name=inner item=product_attribute from=$product.products_attributes}@]<br />[@{if $product_attribute.options_values_price}@][@{$product_attribute.options_values_price}@][@{else}@]&nbsp;[@{/if}@][@{/foreach}@]</td>
                        </tr>
                      </table>  
                    [@{/if}@]  
                    </td>
                  </tr>                  
                  <tr>            
                    <td colspan="3" class="product-listing-cart-data" style="white-space: nowrap;">[@{if $product.products_packaging_unit}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 4px;" />&nbsp; &nbsp;[@{#text_packaging_unit#}@]&nbsp;[@{$product.products_packaging_unit}@]<br />[@{/if}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 4px;" /></td>                                        
                  </tr>                                                    
                </table>                 
              </td>                                                                   
              <td class="product-listing-cart-data" style="white-space: nowrap;">&nbsp;</td>
              [@{if $tax_groups}@]
              <td class="product-listing-cart-data" style="white-space: nowrap; text-align: right; vertical-align: bottom;">([@{$product.products_tax}@]%)&nbsp;<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 4px;" /></td>
              [@{/if}@]   
              <td class="product-listing-cart-data" style="white-space: nowrap; text-align: right; vertical-align: bottom;"><b>[@{$product.products_final_single_price}@]</b><br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 4px;" /></td>
              <td class="product-listing-cart-data" style="white-space: nowrap; text-align: center; vertical-align: bottom;">&nbsp;[@{$product.input_and_hidden_fields_quantity}@]</td>
              <td class="main" style="white-space: nowrap; text-align: right; vertical-align: bottom;"><b>[@{$product.products_final_price}@]</b><br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 1px;" /></td>
            </tr>                        
            [@{if (($smarty.foreach.outer.iteration-1)%2) == 0}@]
            <tr class="product-listing-cart-odd">
            [@{else}@]
            <tr class="product-listing-cart-even">
            [@{/if}@]
              <td colspan="[@{if $tax_groups}@]8[@{else}@]7[@{/if}@]" class="product-listing-cart-data-last" [@{if !$smarty.foreach.outer.last}@]style="border-bottom: 1px dashed #b6b7cb;"[@{/if}@]><img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 6px;" /></td>              
            </tr>                                    
            [@{/foreach}@]
          </table>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <div style="float: right;">
            <table class="table-border-cellspacing cellpadding-0px">     
              [@{if $sub_total_discount}@]
              <tr>
                <td class="main" style="white-space: nowrap; text-align: right;"><span class="red-mark"><b>[@{$discount_value}@] [@{#sub_title_sub_total_dicount#}@]</b></span></td>
                <td class="main" style="white-space: nowrap; text-align: right;">&nbsp;<span class="red-mark"><b>[@{$sub_total_discount}@]</b></span>&nbsp;</td>
              </tr> 
              [@{/if}@]       
              <tr>
                <td class="main" style="white-space: nowrap; text-align: right;"><b>[@{#sub_title_sub_total#}@]</b></td>
                <td class="main" style="white-space: nowrap; text-align: right;">&nbsp;<b>[@{$sub_total}@]</b>&nbsp;</td>
              </tr>
              [@{foreach item=sub_total_tax_group from=$sub_total_tax_groups}@]
              <tr>
                <td class="main" style="white-space: nowrap; text-align: right;">[@{$sub_total_tax_group.title}@]</td>
                <td class="main" style="white-space: nowrap; text-align: right;">&nbsp;[@{$sub_total_tax_group.text}@]&nbsp;</td>
              </tr>
              [@{foreachelse}@]
              <tr>
                <td colspan="2" class="main" style="white-space: nowrap; text-align: right;">[@{#text_tax_without_vat#}@]&nbsp;</td>
              </tr>            
              [@{/foreach}@]   
            </table>  
          </div>
          <div class="clear">&nbsp;</div>
          [@{if $out_of_stock == 'can_checkout'}@]
            <div class="stock-warning" style="text-align: center;"><br />[@{eval var = #out_of_stock_can_checkout#}@]</div>     
          [@{elseif $out_of_stock == 'cant_checkout'}@]          
            <div class="stock-warning" style="text-align: center;"><br />[@{eval var = #out_of_stock_cant_checkout#}@]</div>      
          [@{/if}@]            
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                          
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
            <div style="width: 40%; float: left;">
              <script type="text/javascript">
              /* <![CDATA[ */
                document.write('<a href="" onclick="cart_quantity.submit(); return false" class="button-update-cart" style="float: left" title=" [@{#button_title_update_cart#}@] "><span>[@{#button_text_update_cart#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
              /* ]]> */  
              </script>
              <noscript>
                <input type="submit" value="[@{#button_text_update_cart#}@]" />
              </noscript>                           
            </div>
            <div style="float: left;">
              <a href="[@{$link_back}@]" class="button-continue-shopping" style="float: left" title=" [@{#button_title_continue_shopping#}@] "><span>[@{#button_text_continue_shopping#}@]</span></a>
            </div>                                                        
            <div style="width: 30%; float: right;">
              <a href="[@{$link_filename_checkout_shipping}@]" class="button-checkout" style="float: right" title=" [@{#button_title_checkout#}@] "><span>[@{#button_text_checkout#}@]</span></a>
            </div>                                                                                       
            <div class="clear">&nbsp;</div>                                        
            </div>             
          </div>    
          <div class="main" style="margin: 4px 15px 4px 15px;">
          [@{foreach name=checkout_methods item=alternative_checkout_method from=$alternative_checkout_methods}@]
            [@{if $smarty.foreach.checkout_methods.first}@]
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            <div class="main" style="float: right;"><b>[@{#text_alternative_checkout_methods#}@]</b></div>
            <div class="clear">&nbsp;</div>   
            [@{/if}@]
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            <div class="main" style="float: right;">[@{$alternative_checkout_method.value}@]</div>
            <div class="clear">&nbsp;</div>
          [@{/foreach}@] 
          </div>        
    [@{$form_end}@]        
    [@{else}@]         
          <div class="info-box-central-contents">                    
            <div  class="box-text"  style="margin: 11px 4px 11px 4px;">
            [@{#text_cart_empty#}@]
            </div>                                                   
          </div>                                       
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                        
          <div class="info-box-central-contents">
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a>                                      
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>                  
    [@{/if}@]  
<!-- shopping_cart_eof --> 
