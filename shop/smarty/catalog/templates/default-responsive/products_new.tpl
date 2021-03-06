[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : default-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop default template built with Bootstrap3                                                                    
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
          <h1 class="text-orange">[@{eval var=#heading_title#}@]</h1>                
    [@{if $new_products}@]       
          [@{if $nav_bar_top}@]        
          <div class="clearfix">
            <div class="pagination-number">[@{$nav_bar_number}@]</div>          
            <div class="pagination-result">[@{$nav_bar_result}@]</div>
          </div>
          <div class="div-spacer-h10"></div>
          [@{/if}@]
          [@{foreach name=outer item=product_new from=$products_new}@]
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div style="padding: 4px; width: [@{$product_new.td_width_img}@]px; float: left;"><a href="[@{$product_new.link_filename_product_info}@]">[@{$product_new.image}@]</a></div>
              <div style="padding: 4px 0 0 0; width: 285px; float: left;">
                <a href="[@{$product_new.link_filename_product_info}@]"><b><span class="text-deco-underline">[@{$product_new.name}@]</span></b></a><br />
                [@{if $product_new.info}@][@{$product_new.info}@][@{/if}@]
                <img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 10%; height: 5px;" />
                <b>[@{#text_date_added#}@]</b> [@{$product_new.date_added}@]<br />
                <img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 10%; height: 5px;" />
                [@{if $product_new.manufacturer}@]<b>[@{#text_manufacturer#}@]</b> [@{$product_new.manufacturer}@]<br />
                <img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 10%; height: 5px;" />[@{/if}@]                                                             
              </div>
              <div style="padding: 4px 4px 4px 0; float: right;">              
                <table class="table-border-cellspacing cellpadding-0px"> 
                  <tr>
                    <td style="text-align: right;">                                                                        
                      [@{if $product_new.price_breaks}@]              
                      <div class="price-label main" style="padding: 2px; text-align: right; white-space: nowrap;"><b>[@{if $product_new.price_special}@]<span class="text-deco-line-through">[@{$product_new.price}@]</span> <span class="product-special-price">[@{$product_new.price_special}@]</span>[@{else}@][@{$product_new.price}@][@{/if}@]</b></div>
                      <div class="price-label main" style="padding: 0 2px 0 2px;">
                        <table class="price-label table-border-cellspacing cellpadding-0px" style="float: right;">                     
                          [@{foreach name=inner item=price_break from=$product_new.price_breaks}@]                       
                          [@{if $smarty.foreach.inner.first}@]
                          <tr>                       
                            <td colspan="2" style="white-space: nowrap; text-align: center; vertical-align: bottom;"><img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 4px;" />[@{#text_price_breaks#}@]<img src="[@{$images_path}@]pixel_black.gif" alt="" style="display: block; width: 100%; height: 1px;" /></td>
                          </tr>                      
                          <tr>
                            <td style="white-space: nowrap; text-align: right; vertical-align: top;">[@{#text_quantity_in_price_breaks#}@]&nbsp;&nbsp;</td>
                            <td style="white-space: nowrap; text-align: center; vertical-align: top;">[@{#text_price_in_price_breaks#}@]</td>
                          </tr>                                                                   
                          [@{/if}@]                                
                          <tr>   
                            <td style="white-space: nowrap; text-align: right; vertical-align: top;">[@{$price_break.qty}@]<sup>+</sup>&nbsp;&nbsp;&nbsp;</td>                
                            <td style="white-space: nowrap; text-align: right; vertical-align: top;"><b>[@{if $price_break.price_break_special}@]<span class="text-deco-line-through">[@{$price_break.price_break}@]</span> <span class="product-special-price">[@{$price_break.price_break_special}@]</span>[@{else}@][@{$price_break.price_break}@][@{/if}@]</b></td>
                          </tr>                                                 
                          [@{/foreach}@] 
                        </table>                 
                      </div>
                      <div class="clearfix invisible"></div>
                      <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;">                         
                        [@{$product_new.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />                                                                                     
                        [@{if $link_filename_popup_content_6}@]                 
                          [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                        [@{else}@]
                          [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                        [@{/if}@]
                      </div>
                      [@{if $product_new.link_filename_popup_content_products_delivery_time && $product_new.products_delivery_time}@]
                      <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;"><b>[@{#text_delivery_time#}@]</b>&nbsp;<a href="[@{$product_new.link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$product_new.products_delivery_time}@]</span></a></div>
                      [@{elseif $product_new.products_delivery_time}@]
                      <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;"><b>[@{#text_delivery_time#}@]</b>&nbsp;[@{$product_new.products_delivery_time}@]</div>        
                      [@{/if}@]                                                                        
                      [@{else}@]
                      <div style="width: 100%;">
                        <div class="price-label main" style="padding: 2px; text-align: right; white-space: nowrap;"><b>[@{if $product_new.price_special}@]<span class="text-deco-line-through">[@{$product_new.price}@]</span> <span class="product-special-price">[@{$product_new.price_special}@]</span>[@{else}@][@{$product_new.price}@][@{/if}@]</b></div>
                        <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;">
                          [@{$product_new.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />              
                          [@{if $link_filename_popup_content_6}@]                 
                            [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                          [@{else}@]
                            [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                          [@{/if}@] 
                        </div>
                        [@{if $product_new.link_filename_popup_content_products_delivery_time && $product_new.products_delivery_time}@]
                        <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;"><b>[@{#text_delivery_time#}@]</b>&nbsp;<a href="[@{$product_new.link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$product_new.products_delivery_time}@]</span></a></div>
                        [@{elseif $product_new.products_delivery_time}@]
                        <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;"><b>[@{#text_delivery_time#}@]</b>&nbsp;[@{$product_new.products_delivery_time}@]</div>        
                        [@{/if}@]                         
                        <div class="clearfix invisible"></div>
                      </div>       
                      [@{/if}@]               
                    </td>
                  </tr>
                </table>                               
              </div>
              <div class="clearfix invisible"></div>                       
              [@{*<a href="[@{$product_new.href_buy_now}@]" class="btn btn-success pull-right" title=" [@{#button_title_in_cart#}@] ">[@{#button_text_in_cart#}@]</a>*}@]                
            </div>                        
          </div>                      
          [@{/foreach}@]          
          [@{if $nav_bar_bottom}@]
          <div class="clearfix">
            <div class="pagination-number">[@{$nav_bar_number}@]</div>          
            <div class="pagination-result">[@{$nav_bar_result}@]</div>
          </div>
          <div class="div-spacer-h10"></div>
          [@{/if}@]
    [@{else}@]
          <div class="panel panel-default clearfix">           
            <div class="panel-body">     
              [@{#text_no_new_products#}@]
            </div>
          </div>  
    [@{/if}@]                     
<!-- products_new_eof -->
