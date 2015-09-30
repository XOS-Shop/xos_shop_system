[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc8
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                    
* filename   : product_info.tpl
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

<!-- product_info -->
    [@{if !$product_check}@]
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px; font-size: 0;">&nbsp;</div>           
          <div class="info-box-central-contents">                    
            <div  class="box-text"  style="margin: 11px 4px 11px 4px;">
            [@{#text_product_not_found#}@]
            </div>                                                   
          </div>                                       
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                        
          <div class="info-box-central-contents">
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a>                                         
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>             
    [@{else}@]
          <div>
            [@{$form_begin}@]
            <div style="height: 19px; font-size: 0;">&nbsp;</div>             
            <div style="width: 100%">
[@{$javascript}@]                                     
              [@{if $products_images}@]            
<script type="text/javascript">
/* <![CDATA[ */
function changeImg(no, qty) { 
  for (i=0; i<qty; i++) {
    if (document.getElementById("info" + i)) {
      $('#info' + i).css({'visibility' : 'hidden', 'display' : 'none'});
      $('#glass' + i).css({'visibility' : 'hidden'});
      $('#thumb' + i).css({'borderColor' : '#94A6B5'});       
    }
  }
  $('#info' + no).css({'visibility' : 'visible', 'display' : 'inline'});
  $('#glass' + no).css({'visibility' : 'visible'});
  $('#thumb' + no).css({'borderColor' : 'red'});                                                                                                  
}
/* ]]> */
</script>               
              <div style="padding: 2px 0 0 88px; float: left;">
                <div id="info-images-header">[@{#text_products_image#}@]</div>                          
                <div id="info-images">
                         [@{foreach name=images item=product_image from=$products_images}@]
                           [@{if $smarty.foreach.images.total > 1}@]                        
                            <script  type="text/javascript">
                            /* <![CDATA[ */
                              document.write('<span class="info"><img class="info-img" id="info[@{$product_image.i}@]" src="[@{$product_image.src_product_img_medium}@]" data-zoom-image="[@{$product_image.href_to_product_img_large}@]" /></span><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.href_to_product_img_large}@]" rel="images_group" target="_blank"><img align="right" src="[@{$images_path}@]magnifying_glass.gif" alt="[@{#text_click_to_enlarge#}@]" title=" [@{#text_click_to_enlarge#}@] " /></a>')                          
                              $("#info[@{$product_image.i}@]").elevateZoom({
                                zoomType: "window",                              
                                zoomWindowWidth: "300",
                                zoomWindowHeight: "300",
                                cursor: "crosshair",
                                borderSize: "1",
                                borderColour: "#b6b7cb",
                                zoomWindowOffetx: 100,
                                zoomWindowOffety: 0,    
                                easing: true                        
                              });
                            /* ]]> */  
                            </script>
                            <noscript>
                              <a id="info[@{$product_image.i}@]" class="info" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><img class="info-img" src="[@{$product_image.src_product_img_medium}@]" title=" [@{$products_name}@] " alt="[@{$products_name}@]" /></a><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><img align="right" src="[@{$images_path}@]magnifying_glass.gif" alt="[@{#text_click_to_enlarge#}@]" title=" [@{#text_click_to_enlarge#}@] " /></a>
                            </noscript>                      
                           [@{elseif $smarty.foreach.images.total == 1}@]
                            <script type="text/javascript">
                            /* <![CDATA[ */
                              document.write('<span class="info"><img class="info-img" id="info[@{$product_image.i}@]" src="[@{$product_image.src_product_img_medium}@]" data-zoom-image="[@{$product_image.href_to_product_img_large}@]" /></span><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.href_to_product_img_large}@]" rel="images_group" target="_blank"><img align="right" src="[@{$images_path}@]magnifying_glass.gif" alt="[@{#text_click_to_enlarge#}@]" title=" [@{#text_click_to_enlarge#}@] " /></a>')
                              $("#info[@{$product_image.i}@]").elevateZoom({
                                zoomType: "window",                              
                                zoomWindowWidth: "300",
                                zoomWindowHeight: "300",
                                cursor: "crosshair",
                                borderSize: "1",
                                borderColour: "#b6b7cb",
                                zoomWindowOffetx: 100,
                                zoomWindowOffety: 0,    
                                easing: true                              
                              });
                            /* ]]> */  
                            </script>
                            <noscript>
                              <a id="info[@{$product_image.i}@]" class="info" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><img class="info-img" src="[@{$product_image.src_product_img_medium}@]" title=" [@{$products_name}@] " alt="[@{$products_name}@]" /></a><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><img align="right" src="[@{$images_path}@]magnifying_glass.gif" alt="[@{#text_click_to_enlarge#}@]" title=" [@{#text_click_to_enlarge#}@] " /></a>
                            </noscript>                      
                           [@{/if}@]                 
                         [@{/foreach}@]
                </div> 
                <div id="info-thumbs">
                         [@{if $smarty.foreach.images.total > 1}@]                          
                           [@{foreach name=thumbs item=product_image from=$products_images}@]
                            <script type="text/javascript">
                            /* <![CDATA[ */
                              document.write('<a href="[@{$product_image.link_product_img}@]" id="thumb[@{$product_image.i}@]" class="thumb lightbox-img" onmouseover="changeImg([@{$product_image.i}@], [@{$smarty.foreach.thumbs.total}@])" onclick="return false" target="_blank">[@{$product_image.product_img_extra_small}@]</a>')                              
                            /* ]]> */  
                            </script>                                                                                                
                           [@{/foreach}@]
                         [@{/if}@]
                <div class="clear">&nbsp;</div>                         
                </div>                                                            
              </div>                                                       
<script type="text/javascript">
/* <![CDATA[ */

changeImg(0, [@{$smarty.foreach.images.total}@]);


$("a[rel=images_group]").colorbox({ 			
  maxWidth:'90%',
  maxHeight:'90%',
  photo:true
});

$(".lightbox-img").colorbox({
  iframe:true, 
  innerWidth:[@{$box_width}@], 
  innerHeight:[@{$box_height}@]
});             
/* ]]> */   
</script> 
              [@{/if}@]                         
              <div style="width : 442px; float: right;">
                <div class="page-heading" style="line-height: 21px; padding: 0 0 4px 0;">[@{$products_name}@]</div>               
                <div style="float: left;">                 
                  <div class="main">[@{if $products_model}@]<b>[@{#text_model#}@]</b><br />[@{$products_model}@][@{/if}@]</div>
                  <div class="main">[@{if $products_weight}@]<b>[@{#text_weight#}@]</b><br />[@{$products_weight}@]kg[@{/if}@]</div>
                  <div class="main">[@{if $products_p_unit}@]<b>[@{#text_packing_unit#}@]</b><br />[@{$products_p_unit}@][@{/if}@]</div>
                  <div class="main" >[@{if $products_quantity}@]<b>[@{#text_quantity#}@]</b><br />[@{$products_quantity}@][@{/if}@]</div>                                                                                
                </div>                  
                <div style="text-align: right; float: right;">                  
                  <table class="table-border-cellspacing cellpadding-0px"> 
                    <tr>
                      <td style="text-align: right;">                                                                   
                        [@{if $products_price_breaks}@]                 
                        <div class="price-label main" style="padding: 2px 2px 0 2px; text-align: right; white-space: nowrap;"><b>[@{if $products_price_special}@]<span class="text-deco-line-through">[@{$products_price}@]</span> <span class="product-special-price">[@{$products_price_special}@]</span>[@{else}@][@{$products_price}@][@{/if}@]</b></div>
                        <div class="price-label main" style="padding: 0 2px 0 2px;">
                          <table class="price-label table-border-cellspacing cellpadding-0px" style="float: right;">                     
                            [@{foreach name=price_breaks item=product_price_break from=$products_price_breaks}@]                        
                            [@{if $smarty.foreach.price_breaks.first}@]
                            <tr>                       
                              <td colspan="2" class="main" style="white-space: nowrap; text-align: center; vertical-align: bottom;"><img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 4px;" />[@{#text_price_breaks#}@]<img src="[@{$images_path}@]pixel_black.gif" alt="" style="display: block; width: 100%; height: 1px;" /></td>
                            </tr>                      
                            <tr>
                              <td class="main" style="white-space: nowrap; text-align: right; vertical-align: top;">[@{#text_quantity_in_price_breaks#}@]&nbsp;&nbsp;</td>
                              <td class="main" style="white-space: nowrap; text-align: center; vertical-align: top;">[@{#text_price_in_price_breaks#}@]</td>
                            </tr>                                                                   
                            [@{/if}@]                                
                            <tr>   
                              <td class="main" style="white-space: nowrap; text-align: right; vertical-align: top;">[@{$product_price_break.qty}@]<sup>+</sup>&nbsp;&nbsp;&nbsp;</td>                
                              <td class="main" style="white-space: nowrap; text-align: right; vertical-align: top;"><b>[@{if $product_price_break.price_break_special}@]<span class="text-deco-line-through">[@{$product_price_break.price_break}@]</span> <span class="product-special-price">[@{$product_price_break.price_break_special}@]</span>[@{else}@][@{$product_price_break.price_break}@][@{/if}@]</b></td>
                            </tr>                                                 
                            [@{/foreach}@] 
                          </table>                 
                        </div>
                        <div class="clear">&nbsp;</div>
                        <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;">                         
                          [@{$products_tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />                                                                                     
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
                          [@{if $link_filename_popup_content_products_delivery_time && $products_delivery_time}@]
                            &nbsp;<br /><span class="price-label main"><b>[@{#text_delivery_time#}@]</b>&nbsp;<a href="[@{$link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$products_delivery_time}@]</span></a><br /></span>
                          [@{elseif $products_delivery_time}@]
                            &nbsp;<br /><span class="price-label main"><b>[@{#text_delivery_time#}@]</b>&nbsp;[@{$products_delivery_time}@]<br /></span>
                          [@{/if}@]                           
                        </div>                                                      
                        [@{else}@]
                        <div class="price-label main" style="padding: 2px 2px 0 2px; text-align: right; white-space: nowrap;"><b>[@{if $products_price_special}@]<span class="text-deco-line-through">[@{$products_price}@]</span> <span class="product-special-price">[@{$products_price_special}@]</span>[@{else}@][@{$products_price}@][@{/if}@]</b></div>
                        <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;">
                          [@{$products_tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />              
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
                          [@{if $link_filename_popup_content_products_delivery_time && $products_delivery_time}@]
                            &nbsp;<br /><span class="price-label main"><b>[@{#text_delivery_time#}@]</b>&nbsp;<a href="[@{$link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$products_delivery_time}@]</span></a><br /></span>
                          [@{elseif $products_delivery_time}@]
                            &nbsp;<br /><span class="price-label main"><b>[@{#text_delivery_time#}@]</b>&nbsp;[@{$products_delivery_time}@]<br /></span>
                          [@{/if}@]                            
                        </div>      
                        [@{/if}@]                   
                      </td>
                    </tr>
                  </table>                                      
                </div>                                                
                <div class="clear">&nbsp;</div>
                <div style="height: 10px; font-size: 0;">&nbsp;</div>                        
                [@{if $products_options}@]                
                <div class="main"><b>[@{#text_product_options#}@]</b></div>                    
                <div id="options" class="info-box-central-contents">               
                <script type="text/javascript">
                /* <![CDATA[ */
                  [@{strip}@]
                  document.write('
                  <div id="loading" class="main" style="visibility: hidden; width: 100%; position:relative; left:0px; top:0px;">
                    <div style="position:absolute; width:100%; display:block; margin:0 auto; text-align:center;">             
                      [@{#text_loading#}@]
                    </div> 
                  </div>                                  
                  <div class="main">                    
                          [@{foreach name=options_name item=product_option from=$products_options}@]      
                            <div style="white-space: nowrap; line-height: 22px; margin:5px 0 0 4px; height: 22px; font-weight: bold;"> 
                            [@{$product_option.products_options_name}@]:
                            </div>     
                            <div class="products-options-pull-down" style="margin: 0 0 5px 3px;">
                            [@{$product_option.products_options_pull_down|escape:"quotes"}@]
                            </div>
                          [@{/foreach}@]
                  </div>                                                    
                  <div class="clear">&nbsp;</div>
                  [@{if $qty_for_these_options}@]
                  <div class="main" style="line-height: 20px; margin: 3px 3px 3px 4px; font-weight: bold;"><div style="width:60%; float:left;">[@{#text_in_stock_with_these_options#}@]&nbsp;[@{$qty_for_these_options}@]</div><div class="small-text" style="float:right;"><a href="" style="text-decoration:underline;" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" style="text-decoration:none;" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div><div class="clear">&nbsp;</div></div>
                  [@{else}@]
                  <div class="main" style="line-height: 20px; margin: 3px 3px 3px 4px; font-weight: bold;"><div style="width:60%; float:left;">&nbsp;</div><div class="small-text" style="float:right;"><a href="" style="text-decoration:underline;" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" style="text-decoration:none;" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div><div class="clear">&nbsp;</div></div>
                  [@{/if}@]');
                  [@{/strip}@]
                /* ]]> */  
                </script>                                        
                <noscript>                                
                  <div class="main">                    
                          [@{foreach item=product_option from=$products_options}@]      
                            <div style="white-space: nowrap; line-height: 14px; padding: 10px 0 0 12px;"> 
                            [@{$product_option.products_options_name}@]:
                            </div>                             
                            <div style="white-space: nowrap; line-height: 14px; padding: 0 0 10px 12px;">
                            [@{$product_option.products_options_list_noscript}@]
                            </div>                                                     
                          [@{/foreach}@]
                  </div>
                  [@{if $qty_for_these_options}@]
                  <div class="main" style="white-space: nowrap; line-height: 20px; margin: 3px;"><div style="width:60%; float:left;">[@{#text_in_stock_with_these_options#}@]&nbsp;[@{$qty_for_these_options}@]</div><div class="small-text" style="float:right;"><a href="[@{$link_options_noscript}@]" target="_blank" style="text-decoration:underline;">[@{#text_options_at_a_glance#}@]</a>&nbsp;</div></div><div class="clear">&nbsp;</div>
                  [@{else}@]
                  <div class="main" style="white-space: nowrap; line-height: 20px; margin: 3px;"><div style="width:60%; float:left;">&nbsp;</div><div class="small-text" style="float:right;"><a href="[@{$link_options_noscript}@]" target="_blank" style="text-decoration:underline;">[@{#text_options_at_a_glance#}@]</a>&nbsp;</div></div><div class="clear">&nbsp;</div>                  
                  [@{/if}@]                                                                                               
                </noscript>                                                                                                      
                </div> 
                <script type="text/javascript">
                /* <![CDATA[ */
                [@{strip}@]
                document.write('                                   
                <div style="width:100%; position:relative; left:0px; top:2px; z-index:3;">                                
                  <div id="loading_list" class="product-listing" style="background:#fff; display:none; position:absolute; right:0px; top:0px; padding-left:20px; padding-top:10px; padding-right:20px; padding-bottom:40px; min-width:300px;">                                                             
                    <div class="main" style="width:100%; margin:0 auto; text-align:center;">             
                      [@{#text_loading#}@]
                    </div>                                                                          
                  </div>                                                 
                  <div id="box_products_options_overview" class="product-listing" style="background:#fff; display:none; position:absolute; right:0px; top:0px; padding-left:20px; padding-top:10px; padding-right:20px; padding-bottom:40px; min-width:300px;">                                                                                          
                  </div>                
                </div>');
                [@{/strip}@]
                $('#loading_list').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});
                $('#box_products_options_overview').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});                
                /* ]]> */  
                </script>                                             
                <div style="height: 10px; font-size: 0;">&nbsp;</div> 
                [@{/if}@] 
                <div class="info-box-central-contents">                             
                  <div class="main" style="margin: 4px 15px 4px 15px;">                      
                    <div style="float: left;">
                      <a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
                    </div>
                    <div style="float: right;">
                      <script type="text/javascript">
                      /* <![CDATA[ */ 
                        $(function(){
                          $("input[name='products_quantity']").before('<a id="inc" class="btn-plus">+</a>').after('<a id="dec" class="btn-minus">&ndash;</a>');
                          $(".btn-plus, .btn-minus").click(function() {
                            var oldValue = parseInt($(this).parent().find("input[name='products_quantity']").val());
                            if ($(this).hasClass("btn-plus")) {
                              if (oldValue > 0) {
                                newVal = oldValue + 1;
                              } else {
                                newVal = 1;
                              }
                            } else {
                              // Don't allow decrementing below 1
                              if (oldValue > 1) {
                                newVal = oldValue - 1;
                              } else {
                                newVal = 1;
                              }
                            }
                          $(this).parent().find("input[name='products_quantity']").val(newVal);
                          });
                        });                       
                        document.write('<a id="add_to_cart" href="" onclick="cart_quantity.submit(); return false" class="button-add-to-cart" style="float: left" title=" [@{#button_title_in_cart#}@] "><span>[@{#button_text_in_cart#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                      /* ]]> */  
                      </script>
                      <noscript>
                        <input type="submit" value="[@{#button_text_in_cart#}@]" />
                      </noscript> 
                    </div>                             
                    <div style="margin: -1px; padding: 0 2px 0 0; float: right;">
                      [@{$hidden_field_products_id}@][@{$input_products_quantity}@]
                    </div>
                    [@{if $link_filename_product_reviews}@]                             
                    <div style="margin: 0; padding: 0 30px 0 0; float: right;">
                      <a href="[@{$link_filename_product_reviews}@]" class="button-reviews" style="float: left" title=" [@{#button_title_reviews#}@] "><span>[@{#button_text_reviews#}@]</span></a>
                    </div>
                    [@{/if}@]                                                                                       
                    <div class="clear">&nbsp;</div>                    
                  </div>             
                </div> 
              </div>               
              <div class="clear">&nbsp;</div>        
            </div>        
            <div style="height: 10px; font-size: 0;">&nbsp;</div>         
            <noscript>
            <div class="main"><b>[@{#text_products_description#}@]:</b></div>
            </noscript>                    
            <ul class="descrip-tabs main">            
            [@{foreach name=label item=product_description from=$products_description}@]
               <li><a href="#tab[@{$smarty.foreach.label.iteration}@]"><b>[@{$product_description.tab_label|default:#text_products_description#}@]</b></a></li>          
            [@{/foreach}@]            
            </ul>
            <div class="info-box-central-contents" style="background : #fafafa; padding: 0 10px 0 3px;">            
            [@{foreach name=description item=product_description from=$products_description}@]
              <div id="tab[@{$smarty.foreach.description.iteration}@]" class="main">[@{$product_description.description|default:#text_no_content#}@]</div>
              <div class="clear">&nbsp;</div>         
            [@{/foreach}@]
            </div>                   
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            [@{if $reviews_count}@]
            <div class="main">[@{#text_current_reviews#}@] [@{$reviews_count}@]</div>
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            [@{/if}@]
            [@{if $link_products_url}@]
            <div class="main">[@{eval var = #text_more_information#}@]</div>
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            [@{/if}@]
            [@{if $products_date_available}@]
            <div class="small-text" style="text-align: center">[@{eval var = #text_date_available#}@]</div>
            [@{else}@]
            <div class="small-text" style="text-align: center">[@{eval var = #text_date_added#}@]</div>
            [@{/if}@]
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            <div><img src="[@{$images_path}@]pixel_black.gif" alt="" style="display: block; width: 100%; height: 1px;" /></div>  
            [@{$form_end}@]
          </div>       
          [@{if $xsell_products}@] 
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <div> 
          [@{$xsell_products}@]
          </div>
          [@{/if}@]
          [@{if $also_purchased_products}@]      
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <div> 
          [@{$also_purchased_products}@]
          </div>      
          [@{/if}@]
    [@{/if}@]      
<!-- product_info_eof -->
