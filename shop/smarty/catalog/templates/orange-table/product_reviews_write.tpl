[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
* filename   : product_reviews_write.tpl
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

<!-- product_reviews_write -->
    <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">        
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="19" /></td>
              </tr>
            </table></td>
          </tr>        
          <tr>
            <td class="main" valign="top"><span class="page-heading"  style="line-height: 21px;">[@{$products_name}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="4" /></span>[@{if $products_model}@]<br /><b>[@{#text_model#}@]</b>&nbsp;&nbsp;[@{$products_model}@][@{/if}@][@{if $products_p_unit}@]<br /><b>[@{#text_packing_unit#}@]</b>&nbsp;&nbsp;[@{$products_p_unit}@][@{/if}@]</td>             
            <td align="right" valign="top"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="4" /><br /><table style="background-color: #f8f8f9; border: solid 1px #b6b7cb" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td nowrap="nowrap" class="main" align="right" valign="top">&nbsp;&nbsp;<b>[@{#text_price#}@]</b>&nbsp;&nbsp;</td>                                  
                <td align="right" valign="top"><table border="0" class="price-label" cellspacing="0" cellpadding="0">                     
                  <tr>
                    <td nowrap="nowrap" class="main" align="right" valign="top">&nbsp;</td>
                    <td colspan="2" nowrap="nowrap" class="main" align="right" valign="top"><b>[@{if $products_price_special}@]<span class="text-deco-line-through">[@{$products_price}@]</span> <span class="product-special-price">[@{$products_price_special}@]</span>[@{else}@][@{$products_price}@][@{/if}@]</b></td>
                    <td nowrap="nowrap" class="main" align="right" valign="top">&nbsp;</td>
                  </tr>                                             
                  [@{foreach name=price_breaks item=product_price_break from=$products_price_breaks}@]                        
                  [@{if $smarty.foreach.price_breaks.first}@]
                  <tr>
                    <td valign="bottom"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>                       
                    <td colspan="2" nowrap="nowrap" class="main" align="center" valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />[@{#text_price_breaks#}@]<br /><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                    <td valign="bottom"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
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
                    <td nowrap="nowrap" class="main" align="right" valign="top">[@{$product_price_break.qty}@]<sup> </sup>&nbsp;&nbsp;&nbsp;</td>                
                    <td nowrap="nowrap" class="main" align="right" valign="top"><b>[@{if $product_price_break.price_break_special}@]<span class="text-deco-line-through">[@{$product_price_break.price_break}@]</span> <span class="product-special-price">[@{$product_price_break.price_break_special}@]</span>[@{else}@][@{$product_price_break.price_break}@][@{/if}@]</b></td>
                    <td></td>
                  </tr>                                                 
                  [@{/foreach}@]
                  <tr>
                    <td></td>                       
                    <td colspan="2" nowrap="nowrap" class="small-text" align="right" valign="top">
                      [@{$products_tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />                                                                                     
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
                      <img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="2" /><br />
                    </td>
                    <td></td>
                  </tr>            
                </table></td> 
              </tr>            
            </table></td>          
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{if $message_stack}@]      
      <tr>
        <td>[@{$message_stack}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{/if}@]      
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main"><b>[@{#sub_title_from#}@]</b> [@{$customers_name}@]</td>
              </tr>
              <tr>
                <td class="main"><b>[@{#sub_title_review#}@]</b></td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
                  <tr class="info-box-central-contents">
                    <td><table border="0" width="100%" cellspacing="2" cellpadding="2">
                      <tr>
                        <td class="main"><div>[@{$textarea_field}@]<br /></div></td>
                      </tr>
                      <tr>
                        <td class="small-text" align="right"><small><span class="red-mark"><b>[@{#sub_title_no_html#}@]</b></span></small>&nbsp;[@{#text_no_html#}@]</td>
                      </tr>
                      <tr>
                        <td class="main"><b>[@{#sub_title_rating#}@]</b> <small><span class="red-mark"><b>[@{#text_bad#}@]</b></span></small> [@{$radio_fields}@] <small><span class="red-mark"><b>[@{#text_good#}@]</b></span></small></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
                  <tr class="info-box-central-contents">
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>                                                
                        <td nowrap="nowrap" class="main"><a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>                        
                        <td nowrap="nowrap" class="main" align="right">                        
                          <script type="text/javascript">
                          /* <![CDATA[ */
                            document.write('<a href="" onclick="if(product_reviews_write.onsubmit())product_reviews_write.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                          /* ]]> */  
                          </script>
                          <noscript>
                            <input type="submit" value="[@{#button_text_continue#}@]" />
                          </noscript>                                                
                        </td>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="[@{$td_width_img}@]" align="right" valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td align="center" class="small-text">
               [@{if $product_img}@]                
               <script type="text/javascript">
               /* <![CDATA[ */
                 document.write('<a class="lightbox-img" href="[@{$link_product_img}@]" target="_blank">[@{$product_img}@]<br />[@{#text_click_to_enlarge#}@]</a>');

                 $(".lightbox-img").fancybox({
                   'width':[@{$box_width}@],
                   'height':[@{$box_height}@],
                   'autoScale':false,
                   'transitionIn':'elastic',
                   'transitionOut':'fade',
                   'padding':4,
                   'onComplete':function() { $("#fancybox-content").css({'border-color':'#b6b7cb'}); },
                   'onClosed':function() { $("#fancybox-content").css({'border-color':'#fff'}); },  
                   'type':'iframe'
                 }); 
               /* ]]> */  
               </script> 
                <noscript>
                  <a href="[@{$link_product_img_noscript}@]" target="_blank">[@{$product_img}@]<br />[@{#text_click_to_enlarge#}@]</a>
                </noscript>
               [@{/if}@]
                <p><a href="[@{$link_buy_now}@]" class="button-add-to-cart" style="float: right" title=" [@{#button_title_in_cart#}@] "><span>[@{#button_text_in_cart#}@]</span></a></p>
                </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>[@{$form_end}@]</td>
<!-- product_reviews_write_eof -->
