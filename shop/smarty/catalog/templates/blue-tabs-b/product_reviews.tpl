[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-b
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : product_reviews.tpl
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

<!-- product_reviews -->
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{$products_name}@]</div>           
          <div style="float: left;">                 
            [@{if $products_model}@]<div class="main"><b>[@{#text_model#}@]</b>&nbsp;&nbsp;[@{$products_model}@]</div>[@{/if}@]
            [@{if $products_p_unit}@]<div class="main"><b>[@{#text_packing_unit#}@]</b>&nbsp;&nbsp;[@{$products_p_unit}@]</div>[@{/if}@]                                                                             
          </div>                                                               
          <div style="text-align: right; float: right;">                                     
            <table border="0" cellspacing="0" cellpadding="0"> 
              <tr>
                <td align="right">                                                                   
                  [@{if $products_price_breaks}@]                 
                  <div class="price-label main" style="padding: 2px 2px 0 2px; text-align: right; white-space: nowrap;"><b>[@{if $products_price_special}@]<span class="text-deco-line-through">[@{$products_price}@]</span> <span class="product-special-price">[@{$products_price_special}@]</span>[@{else}@][@{$products_price}@][@{/if}@]</b></div>
                  <div class="price-label main" style="padding: 0 2px 0 2px;">
                    <table border="0" class="price-label" cellspacing="0" cellpadding="0">                     
                      [@{foreach name=price_breaks item=product_price_break from=$products_price_breaks}@]                        
                      [@{if $smarty.foreach.price_breaks.first}@]
                      <tr>                       
                        <td colspan="2" nowrap="nowrap" class="main" align="center" valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />[@{#text_price_breaks#}@]<br /><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                      </tr>                      
                      <tr>
                        <td nowrap="nowrap" class="main" align="right" valign="top">[@{#text_quantity_in_price_breaks#}@]&nbsp;&nbsp;</td>
                        <td nowrap="nowrap" class="main" align="center" valign="top">[@{#text_price_in_price_breaks#}@]</td>
                      </tr>                                                                   
                      [@{/if}@]                                
                      <tr>   
                        <td nowrap="nowrap" class="main" align="right" valign="top">[@{$product_price_break.qty}@]<sup>+</sup>&nbsp;&nbsp;&nbsp;</td>                
                        <td nowrap="nowrap" class="main" align="right" valign="top"><b>[@{if $product_price_break.price_break_special}@]<span class="text-deco-line-through">[@{$product_price_break.price_break}@]</span> <span class="product-special-price">[@{$product_price_break.price_break_special}@]</span>[@{else}@][@{$product_price_break.price_break}@][@{/if}@]</b></td>
                      </tr>                                                 
                      [@{/foreach}@] 
                    </table>                 
                  </div>
                  <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;">                         
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
                  </div>                                                      
                  [@{else}@]
                  <div class="price-label main" style="padding: 2px 2px 0 2px; text-align: right; white-space: nowrap;"><b>[@{if $products_price_special}@]<span class="text-deco-line-through">[@{$products_price}@]</span> <span class="product-special-price">[@{$products_price_special}@]</span>[@{else}@][@{$products_price}@][@{/if}@]</b></div>
                  <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;">
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
                  </div>      
                  [@{/if}@]                  
                </td>
              </tr>
            </table>  
          </div> 
          <div class="clear">&nbsp;</div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                        
        [@{if $product_reviews}@]
          <div style="width: 450px; padding: 0 4px 0 0; float: left;">          
            [@{if $nav_bar_top}@]        
            <div class="small-text" style="float: left; white-space: nowrap;">[@{$nav_bar_number}@]</div>          
            <div class="small-text" style="float: right; white-space: nowrap;">[@{$nav_bar_result}@]</div>
            <div class="clear">&nbsp;</div>
            <div style="height: 10px; font-size: 0;">&nbsp;</div> 
            [@{/if}@]
          
            [@{foreach item=product_reviews from=$product_reviews_array}@]          
            <div class="main" style="float: left; padding: 2px;"><a href="[@{$product_reviews.link_filename_product_reviews_info}@]"><span class="text-deco-underline"><b>[@{eval var=#text_review_by#}@]</b></span></a></div>          
            <div class="small-text" style="float: right; padding: 4px 2px 2px 2px;">[@{eval var=#text_review_date_added#}@]</div>
            <div class="clear">&nbsp;</div>                           
            <div class="info-box-central-contents">                             
              <div class="main" style="margin: 4px 15px 4px 15px;">                      
                [@{$product_reviews.review_text|truncate:90:'...':false}@]<br /><br /><i>[@{#text_review_rating#}@] [@{$product_reviews.stars_image}@] [[@{eval var=#text_of_5_stars#}@]]</i>                 
              </div>             
            </div>            
            <div style="height: 10px; font-size: 0;">&nbsp;</div>                     
            [@{/foreach}@] 

            [@{if $nav_bar_bottom}@]
            <div class="small-text" style="float: left; white-space: nowrap;">[@{$nav_bar_number}@]</div>          
            <div class="small-text" style="float: right; white-space: nowrap;">[@{$nav_bar_result}@]</div>
            <div class="clear">&nbsp;</div>
            <div style="height: 10px; font-size: 0;">&nbsp;</div> 
            [@{/if}@] 
           
            <div class="info-box-central-contents">                             
              <div class="main" style="margin: 4px 15px 4px 15px;">                      
                <a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
                <a href="[@{$link_filename_product_reviews_write}@]" class="button-write-review" style="float: right" title=" [@{#button_title_write_review#}@] "><span>[@{#button_text_write_review#}@]</span></a>                                                                                                                  
                <div class="clear">&nbsp;</div>                    
              </div>             
            </div>            
          </div>           
        [@{else}@]
          <div style="width: 450px; padding: 0 4px 0 0; float: left;">                     
            <div class="info-box-central-contents">                    
              <div  class="box-text"  style="margin: 11px 4px 11px 4px;">
              [@{#text_no_reviews#}@]
              </div>                                                   
            </div>                                       
            <div style="height: 10px; font-size: 0;">&nbsp;</div>           
          
            <div class="info-box-central-contents">                             
              <div class="main" style="margin: 4px 15px 4px 15px;">                      
                <a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
                <a href="[@{$link_filename_product_reviews_write}@]" class="button-write-review" style="float: right" title=" [@{#button_title_write_review#}@] "><span>[@{#button_text_write_review#}@]</span></a>                                                                                                                  
                <div class="clear">&nbsp;</div>                    
              </div>             
            </div>           
          </div>
        [@{/if}@]          
          <div class="small-text" style="width: [@{$td_width_img}@]px; text-align: center; float: right;">
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
          </div>
          <div class="clear">&nbsp;</div>
<!-- product_reviews_eof -->
