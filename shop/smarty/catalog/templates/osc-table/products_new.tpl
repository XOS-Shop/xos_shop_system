[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0.7
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
* filename   : products_new.tpl
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

<!-- products_new -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{eval var=#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_products_new.gif" alt="[@{eval var=#heading_title#}@]" title=" [@{eval var=#heading_title#}@] " /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
    [@{if $new_products}@]
      [@{if $nav_bar_top}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td nowrap="nowrap" class="smallText">[@{$nav_bar_number}@]</td>
            <td nowrap="nowrap" align="right" class="smallText">[@{$nav_bar_result}@]</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr> 
      [@{/if}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          [@{foreach name=outer item=product_new from=$products_new}@]          
          <tr>
            <td><table style="border: solid 1px #b6b7cb" width="100%" cellspacing="4" cellpadding="4">                    
              <tr>
                <td width="[@{$product_new.td_width_img}@]" valign="top" class="main"><a href="[@{$product_new.link_filename_product_info}@]">[@{$product_new.image}@]</a></td>
                <td valign="top" class="main">
                  <a href="[@{$product_new.link_filename_product_info}@]"><b><span class="text-deco-underline">[@{$product_new.name}@]</span></b></a><br />
                  [@{if $product_new.info}@][@{$product_new.info}@][@{/if}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="5" /><br /><b>[@{#text_date_added#}@]</b> [@{$product_new.date_added}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="5" /><br />
                  [@{if $product_new.manufacturer}@]<b>[@{#text_manufacturer#}@]</b> [@{$product_new.manufacturer}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="5" /><br />[@{/if}@]
                  [@{if $product_new.link_filename_popup_content_products_delivery_time && $product_new.products_delivery_time}@]
                    <b>[@{#text_delivery_time#}@]</b>&nbsp;<a href="[@{$product_new.link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$product_new.products_delivery_time}@]</span></a><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="7" /><br />
                  [@{elseif $product_new.products_delivery_time}@]
                    <b>[@{#text_delivery_time#}@]</b>&nbsp;[@{$product_new.products_delivery_time}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="7" /><br />       
                  [@{/if}@]                      
                  <div>                             
                  <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td nowrap="nowrap" class="main" valign="top"><b>[@{#text_price#}@]</b>&nbsp;&nbsp;</td>                                  
                      <td align="right" valign="top"><table border="0" class="price-label" cellspacing="0" cellpadding="0">                     
                        <tr>
                          <td nowrap="nowrap" class="main" align="right" valign="top">&nbsp;</td>
                          <td colspan="2" nowrap="nowrap" class="main" align="right" valign="top"><b>[@{if $product_new.price_special}@]<span class="text-deco-line-through">[@{$product_new.price}@]</span> <span class="productSpecialPrice">[@{$product_new.price_special}@]</span>[@{else}@][@{$product_new.price}@][@{/if}@]</b></td>
                          <td nowrap="nowrap" class="main" align="right" valign="top">&nbsp;</td>
                        </tr> 
                        [@{foreach name=inner item=price_break from=$product_new.price_breaks}@]                       
                        [@{if $smarty.foreach.inner.first}@]
                        <tr>
                          <td valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>                       
                          <td colspan="2" nowrap="nowrap" class="main" align="center" valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />[@{#text_price_breaks#}@]<br /><img src="[@{$images_path}@]pixel_white.gif" alt="" width="100%" height="1" /></td>
                          <td valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                        </tr>                      
                        <tr>
                          <td></td>
                          <td nowrap="nowrap" class="main" align="right" valign="top">[@{#text_quantity_in_price_breaks#}@]&nbsp;&nbsp;</td>
                          <td nowrap="nowrap" class="main" align="center" valign="top">[@{#text_price_in_price_breaks#}@]</td>
                          <td></td>
                        </tr>                                                                   
                        [@{/if}@]                                
                        <tr>
                          <td></td>     
                          <td nowrap="nowrap" class="main" align="right" valign="top">[@{$price_break.qty}@]<sup>+</sup>&nbsp;&nbsp;&nbsp;</td>                
                          <td nowrap="nowrap" class="main" align="right" valign="top"><b>[@{if $price_break.price_break_special}@]<span class="text-deco-line-through">[@{$price_break.price_break}@]</span> <span class="productSpecialPrice">[@{$price_break.price_break_special}@]</span>[@{else}@][@{$price_break.price_break}@][@{/if}@]</b></td>
                          <td></td>
                        </tr>                                                 
                        [@{/foreach}@]
                        <tr>
                          <td></td>                       
                          <td colspan="2" nowrap="nowrap" class="smallText" align="right" valign="top">
                            [@{$product_new.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />                                                                                     
                            [@{if $link_filename_popup_content_6}@]                 
                              <script type="text/javascript">
                              /* <![CDATA[ */
                                document.write('[@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />');
                              /* ]]> */   
                              </script>
                              <noscript>
                                [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                              </noscript>
                            [@{else}@]
                              [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                            [@{/if}@]                             
                            <img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="2" /><br />
                          </td> 
                          <td></td>
                        </tr>            
                      </table></td> 
                    </tr>            
                  </table>                                    
                  </div>            
                </td>
                <td nowrap="nowrap" align="right" valign="bottom" class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="10" />[@{*<a href="[@{$product_new.href_buy_now}@]" class="button-add-to-cart" style="float: right" title=" [@{#button_title_in_cart#}@] "><span>[@{#button_text_in_cart#}@]</span></a>*}@]</td>
              </tr>          
            </table></td>
          </tr>                        
          <tr>
            <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          [@{/foreach}@]
        </table></td>
      </tr>
      [@{if $nav_bar_bottom}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td nowrap="nowrap" class="smallText">[@{$nav_bar_number}@]</td>
            <td nowrap="nowrap" align="right" class="smallText">[@{$nav_bar_result}@]</td>
          </tr>
        </table></td>
      </tr>
      [@{/if}@]
    [@{else}@] 
       <tr>
         <td class="main">[@{#text_no_new_products#}@]</td>
       </tr>
       <tr>
         <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
       </tr> 
    [@{/if}@]
    </table></td>                       
<!-- products_new_eof -->
