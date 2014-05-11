[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
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
    <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_cart.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
    [@{if $products_in_cart}@]      
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="2" class="productListing">
            <tr>
             [@{if $tax_groups}@]
              <td width="2%" align="center" class="productListing-heading" nowrap="nowrap">[@{#table_heading_remove#}@]</td>
              <td width="2%" align="center" class="productListing-heading" nowrap="nowrap">[@{#table_heading_model#}@]</td>
              <td width="9%" class="productListing-heading" colspan="3" nowrap="nowrap">&nbsp; &nbsp; &nbsp; &nbsp;[@{#table_heading_products#}@]</td>
              <td width="40%" align="right" class="productListing-heading" nowrap="nowrap">[@{#table_heading_tax#}@]</td>    
              <td width="12%" align="right" class="productListing-heading" nowrap="nowrap">[@{#table_heading_price#}@]</td>
              <td width="33%" align="center" class="productListing-heading" nowrap="nowrap">[@{#table_heading_quantity#}@]</td>
              <td width="2%" align="right" class="productListing-heading" nowrap="nowrap">[@{#table_heading_total#}@]</td>
             [@{else}@]
              <td width="2%" align="center" class="productListing-heading" nowrap="nowrap">[@{#table_heading_remove#}@]</td>
              <td width="2%" align="center" class="productListing-heading" nowrap="nowrap">[@{#table_heading_model#}@]</td>
              <td width="9%" class="productListing-heading" colspan="3" nowrap="nowrap">&nbsp; &nbsp; &nbsp; &nbsp;[@{#table_heading_products#}@]</td>
              <td width="52%" align="right" class="productListing-heading" nowrap="nowrap">[@{#table_heading_price#}@]</td>
              <td width="33%" align="center" class="productListing-heading" nowrap="nowrap">[@{#table_heading_quantity#}@]</td>
              <td width="2%" align="right" class="productListing-heading" nowrap="nowrap">[@{#table_heading_total#}@]</td>             
             [@{/if}@] 
            </tr>
            [@{foreach name=outer item=product from=$products}@]
            [@{if (($smarty.foreach.outer.iteration-1)%2) == 0}@]
            <tr class="productListing-odd">
            [@{else}@]
            <tr class="productListing-even">
            [@{/if}@]
              <td align="center" class="productListing-data" nowrap="nowrap">[@{$product.checkbox_cart_delete}@]</td>
              <td align="center" class="productListing-data" nowrap="nowrap"><b>[@{$product.products_model}@]</b></td>
              <td valign="top">
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="productListing-data" align="center" nowrap="nowrap"><a href="[@{$product.link_filename_product_info}@]">[@{$product.products_image}@]</a></td>
                    <td class="productListing-data" nowrap="nowrap">&nbsp;</td>              
                    <td class="productListing-data" nowrap="nowrap" valign="top"><a href="[@{$product.link_filename_product_info}@]"><b>[@{$product.products_name}@] [@{$product.stock_check}@]</b></a>[@{foreach name=inner item=product_attribute from=$product.products_attributes}@]<br />[@{$product_attribute.products_options_name}@]: [@{$product_attribute.products_options_values_name}@][@{$product_attribute.hidden_field}@][@{/foreach}@][@{if $product.products_packaging_unit}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />[@{#text_packaging_unit#}@]<br />-&nbsp;[@{$product.products_packaging_unit}@][@{/if}@]</td>                                       
                  </tr>
                </table>                 
              </td>              
              <td align="right" valign="top">
              [@{if $product.products_attributes_option_price}@]
                <table border="0" cellspacing="0" cellpadding="0"> 
                  <tr>
                    <td class="productListing-data" nowrap="nowrap">&nbsp;</td>
                    <td align="center" class="productListing-data" nowrap="nowrap">[@{foreach name=inner item=product_attribute from=$product.products_attributes}@]<br />[@{if $product_attribute.options_values_price}@][@{$product_attribute.price_prefix}@][@{else}@]&nbsp;[@{/if}@][@{/foreach}@]</td>
                    <td align="right" class="productListing-data" nowrap="nowrap">[@{$product.products_price}@][@{foreach name=inner item=product_attribute from=$product.products_attributes}@]<br />[@{if $product_attribute.options_values_price}@][@{$product_attribute.options_values_price}@][@{else}@]&nbsp;[@{/if}@][@{/foreach}@]</td>
                  </tr>
                </table>  
              [@{/if}@]  
              </td>                                     
              <td class="productListing-data" nowrap="nowrap">&nbsp;</td> 
              [@{if $tax_groups}@]
              <td align="right" class="productListing-data" nowrap="nowrap">([@{$product.products_tax}@]%)&nbsp;</td>
              [@{/if}@]                                
              <td align="right" class="productListing-data" nowrap="nowrap"><b>[@{$product.products_final_single_price}@]</b></td>
              <td align="center" class="productListing-data" nowrap="nowrap">[@{$product.input_and_hidden_fields_quantity}@]</td>
              <td align="right" class="main" nowrap="nowrap"><b>[@{$product.products_final_price}@]</b></td>
            </tr>
            [@{/foreach}@]
          </table>
        </td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">               
          <tr>
            <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          [@{if $sub_total_discount}@]
          <tr>
            <td align="right" width="99%" class="main"><font color="#ff0000"><b>[@{$discount_value}@] [@{#sub_title_sub_total_dicount#}@]</b></font></td> 
            <td align="right" width="1%" class="main">&nbsp;<font color="#ff0000"><b>[@{$sub_total_discount}@]</b></font>&nbsp;</td>
          </tr> 
          [@{/if}@]       
          <tr>
            <td align="right" width="99%" class="main" nowrap="nowrap"><b>[@{#sub_title_sub_total#}@]</b></td>
            <td align="right" width="1%" class="main" nowrap="nowrap">&nbsp;<b>[@{$sub_total}@]</b>&nbsp;</td>
          </tr>
          [@{foreach item=sub_total_tax_group from=$sub_total_tax_groups}@]
          <tr>
            <td align="right" width="99%" class="main" nowrap="nowrap">[@{$sub_total_tax_group.title}@]</td>
            <td align="right" width="1%" class="main" nowrap="nowrap">&nbsp;[@{$sub_total_tax_group.text}@]&nbsp;</td>
          </tr>
          [@{foreachelse}@]
          <tr>
            <td colspan="2" align="right" class="main" nowrap="nowrap">[@{#text_tax_without_vat#}@]&nbsp;</td>
          </tr>            
          [@{/foreach}@]      
          [@{if $out_of_stock == 'can_checkout'}@]
          <tr>
            <td colspan="2" class="stockWarning" align="center"><br />[@{eval var = #out_of_stock_can_checkout#}@]</td>
          </tr>      
          [@{elseif $out_of_stock == 'cant_checkout'}@]
          <tr>
            <td colspan="2" class="stockWarning" align="center"><br />[@{eval var = #out_of_stock_cant_checkout#}@]</td>
          </tr>       
          [@{/if}@]
          <tr>
            <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>      
        </table></td>
      </tr>       
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>                
                <td nowrap="nowrap" class="main">
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="cart_quantity.submit(); return false" class="button-update-cart" style="float: left" title=" [@{#button_title_update_cart#}@] "><span>[@{#button_text_update_cart#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                  /* ]]> */  
                  </script>
                  <noscript>
                    <input type="submit" value="[@{#button_text_update_cart#}@]" />
                  </noscript>
                </td>
                <td nowrap="nowrap" class="main"><a href="[@{$link_back}@]" class="button-continue-shopping" style="float: left" title=" [@{#button_title_continue_shopping#}@] "><span>[@{#button_text_continue_shopping#}@]</span></a></td>
                <td nowrap="nowrap" align="right" class="main"><a href="[@{$link_filename_checkout_shipping}@]" class="button-checkout" style="float: right" title=" [@{#button_title_checkout#}@] "><span>[@{#button_text_checkout#}@]</span></a></td>                
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
              [@{foreach name=checkout_methods item=alternative_checkout_method from=$alternative_checkout_methods}@]
              [@{if $smarty.foreach.checkout_methods.first}@]
              <tr>
                <td colspan="5"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
              </tr>
              <tr>
                <td colspan="4" align="right" class="main"><b>[@{#text_alternative_checkout_methods#}@]</b></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>      
              [@{/if}@]
              <tr>
                <td colspan="5"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
              </tr>
              <tr>
                <td colspan="4" align="right" class="main">[@{$alternative_checkout_method.value}@]</td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>              
              [@{/foreach}@]              
            </table></td>
          </tr>
        </table></td>
      </tr>
    [@{else}@]
      <tr>
        <td align="center" class="main"><table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr>
                <td class="boxText">[@{#text_cart_empty#}@]</td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td nowrap="nowrap" class="main" align="right"><a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>    
    [@{/if}@]  
    </table>[@{$form_end}@]</td>
<!-- shopping_cart_eof --> 
