[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with popup windows as lightboxes 
*              and div/css layout                                                                     
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
          <h1 class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{eval var=#heading_title#}@]</h1>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
        [@{if $new_products}@]       
          [@{if $nav_bar_top}@]      
          <div class="small-text" style="line-height: 22px; float: left; white-space: nowrap;">[@{$nav_bar_number}@]</div>          
          <div class="small-text" style="line-height: 22px; float: right; white-space: nowrap;">
            <script type="text/javascript">
            /* <![CDATA[ */
              document.write('[@{$nav_bar_result_in_pull_down_menu}@]')
            /* ]]> */  
            </script>
            <noscript>
              [@{$nav_bar_result}@]
            </noscript>                      
          </div>         
          <div class="clear">&nbsp;</div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          [@{/if}@]

          [@{foreach name=outer item=product_new from=$products_new}@]
          <div class="r-orange"> 
            <div class="rt-orange-empty">
              <div class="l-orange">
                <div class="lt-orange-empty">
                  <div class="rb-orange">
                    <div class="lb-orange">
                      <div class="box-content-orange">  
                        <div class="main" style="padding: 4px; width: [@{$product_new.td_width_img}@]px; float: left;"><a href="[@{$product_new.link_filename_product_info}@]">[@{$product_new.image}@]</a></div>
                        <div class="main" style="padding: 4px 0 0 0; width: 285px; float: left;">
                          <h3 class="main"><a href="[@{$product_new.link_filename_product_info}@]"><b><span class="text-deco-underline">[@{$product_new.name}@]</span></b></a></h3><br />
                          [@{if $product_new.info}@][@{$product_new.info}@][@{/if}@]
                          <img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10%" height="5" /><br />
                          <b>[@{#text_date_added#}@]</b> [@{$product_new.date_added}@]<br />
                          <img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10%" height="5" /><br />
                          [@{if $product_new.manufacturer}@]<b>[@{#text_manufacturer#}@]</b> [@{$product_new.manufacturer}@]<br />
                          <img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10%" height="5" /><br />[@{/if}@]                                                             
                        </div>
                        <div class="main" style="padding: 4px 4px 4px 0; float: right;">  
                          <div class="rt-price-label">
                            <div class="lt-price-label">
                              <div class="rb-price-label">
                                <div class="lb-price-label">
                                  <div class="box-content-price-label"> 
                                    <table border="0" cellspacing="0" cellpadding="0"> 
                                      <tr>
                                        <td align="right">                                                                        
                                          [@{if $product_new.price_breaks}@]              
                                          <div class="price-label main" style="padding: 1px; text-align: right; white-space: nowrap;"><b>[@{if $product_new.price_special}@]<span class="text-deco-line-through">[@{$product_new.price}@]</span> <span class="product-special-price">[@{$product_new.price_special}@]</span>[@{else}@][@{$product_new.price}@][@{/if}@]</b></div>
                                          <div class="price-label main" style="padding: 0 1px 0 1px;">
                                            <table border="0" class="price-label" cellspacing="0" cellpadding="0">                     
                                              [@{foreach name=inner item=price_break from=$product_new.price_breaks}@]                       
                                              [@{if $smarty.foreach.inner.first}@]
                                              <tr>                       
                                                <td colspan="2" nowrap="nowrap" class="main" align="center" valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />[@{#text_price_breaks#}@]<br /><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                                              </tr>                      
                                              <tr>
                                                <td nowrap="nowrap" class="main" align="right" valign="top">[@{#text_quantity_in_price_breaks#}@]&nbsp;&nbsp;</td>
                                                <td nowrap="nowrap" class="main" align="center" valign="top">[@{#text_price_in_price_breaks#}@]</td>
                                              </tr>                                                                   
                                              [@{/if}@]                                
                                              <tr>   
                                                <td nowrap="nowrap" class="main" align="right" valign="top">[@{$price_break.qty}@]<sup>+</sup>&nbsp;&nbsp;&nbsp;</td>                
                                                <td nowrap="nowrap" class="main" align="right" valign="top"><b>[@{if $price_break.price_break_special}@]<span class="text-deco-line-through">[@{$price_break.price_break}@]</span> <span class="product-special-price">[@{$price_break.price_break_special}@]</span>[@{else}@][@{$price_break.price_break}@][@{/if}@]</b></td>
                                              </tr>                                                 
                                              [@{/foreach}@] 
                                            </table>                 
                                          </div>
                                          <div class="price-label small-text" style="padding: 1px; text-align: right; white-space: nowrap;">                         
                                            [@{$product_new.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />                                                                                     
                                            [@{if $link_filename_popup_content_5}@]                 
                                            <script type="text/javascript">
                                            /* <![CDATA[ */
                                              document.write('[@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_5}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />');
                                            /* ]]> */   
                                            </script>
                                            <noscript>
                                              [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_5}@]" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                                            </noscript>
                                            [@{else}@]
                                              [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                                            [@{/if}@]
                                          </div>                                                  
                                          [@{else}@]
                                          <div style="width: 100%;">
                                            <div class="price-label main" style="padding: 1px; text-align: right; white-space: nowrap;"><b>[@{if $product_new.price_special}@]<span class="text-deco-line-through">[@{$product_new.price}@]</span> <span class="product-special-price">[@{$product_new.price_special}@]</span>[@{else}@][@{$product_new.price}@][@{/if}@]</b></div>
                                            <div class="price-label small-text" style="padding: 1px; text-align: right; white-space: nowrap;">
                                              [@{$product_new.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />              
                                              [@{if $link_filename_popup_content_5}@]                 
                                              <script type="text/javascript">
                                              /* <![CDATA[ */
                                                document.write('[@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_5}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />');
                                              /* ]]> */   
                                              </script>
                                              <noscript>
                                                [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_5}@]" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                                              </noscript>
                                              [@{else}@]
                                                [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                                              [@{/if}@] 
                                            </div>
                                            <div style="height: 0; font-size: 0;">&nbsp;</div> 
                                            <div class="clear">&nbsp;</div>
                                            <div style="height: 0; font-size: 0;">&nbsp;</div>
                                          </div>       
                                          [@{/if}@]               
                                        </td>
                                      </tr>
                                    </table>              
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>                                             
                        </div>
                        <div class="clear">&nbsp;</div>                       
                        <div class="main" style="padding: 0 4px 4px 4px; float: right;">                
                          <a href="[@{$product_new.href_buy_now}@]" class="button-add-to-cart" style="float: left" title=" [@{#button_title_in_cart#}@] "><span>[@{#button_text_in_cart#}@]</span></a>                
                        </div>
                        <div class="clear">&nbsp;</div>                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clear">&nbsp;</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>           
          [@{/foreach}@]
          
          [@{if $nav_bar_bottom}@]
          <div class="small-text" style="line-height: 22px; float: left; white-space: nowrap;">[@{$nav_bar_number}@]</div>          
          <div class="small-text" style="line-height: 22px; float: right; white-space: nowrap;">
            <script type="text/javascript">
            /* <![CDATA[ */
              document.write('[@{$nav_bar_result_in_pull_down_menu}@]')
            /* ]]> */  
            </script>
            <noscript>
              [@{$nav_bar_result}@]
            </noscript>                      
          </div>           
          <div class="clear">&nbsp;</div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          [@{/if}@]
    [@{else}@] 
          <div class="main" style="padding: 2px;">[@{#text_no_new_products#}@]</div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>  
    [@{/if}@]                     
<!-- products_new_eof -->
