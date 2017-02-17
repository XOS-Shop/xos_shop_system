[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cyborg-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.4
* descrip    : xos-shop template built with Bootstrap3 and theme cyborg                                                                   
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
          <div class="text-orange h1">&nbsp;</div>           
          <div class="panel panel-default clearfix">
            <div class="panel-body">
              [@{#text_product_not_found#}@]
            </div>
          </div>           
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_filename_default}@]" class="btn btn-primary pull-right" title=" [@{#button_title_continue#}@] ">[@{#button_text_continue#}@]</a>                                                                                                                                                               
          </div>                       
    [@{else}@]
          <div>
            [@{$form_begin}@]
            <div class="div-spacer-h20"></div>            
            <div class="row">
[@{$javascript}@]                                     
              [@{if $products_images}@]
              <div class="col-sm-5 col-md-4 col-md-offset-1">            
<script type="text/javascript">
function changeImg(no, qty) { 
  for (i=0; i<qty; i++) {
    if (document.getElementById("info" + i)) {
      $('#info' + i).css({'visibility' : 'hidden', 'display' : 'none'});
      $('#glass' + i).css({'visibility' : 'hidden'});
      $('#thumb' + i).css({'borderColor' : 'transparent'});       
    }
  }
  $('#info' + no).css({'visibility' : 'visible', 'display' : 'inline'});
  $('#glass' + no).css({'visibility' : 'visible'});
  $('#thumb' + no).css({'borderColor' : 'red'});                                                                                                  
}

$(window).resize(function() {
  if(this.resizeTO) clearTimeout(this.resizeTO);
  this.resizeTO = setTimeout(function() {
    $(this).trigger('resizeEnd');
  }, 500);
});
    
$(window).bind('resizeEnd', function() {                            
  $(".zoomContainer").remove(); 
});    
</script>               
                [@{*<div id="info-images-header">[@{#text_products_image#}@]</div>*}@]                          
                <div id="info-images">
                         [@{foreach name=images item=product_image from=$products_images}@]
                           [@{if $smarty.foreach.images.total > 1}@]                        
                            <script type="text/javascript">
                              document.write('<span class="info"><img class="info-img" id="info[@{$product_image.i}@]" src="[@{$product_image.src_product_img_medium}@]" data-zoom-image="[@{$product_image.href_to_product_img_large}@]" /></span><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.href_to_product_img_large}@]" rel="images_group" target="_blank"><span class="text-info glyphicon glyphicon-plus pull-right" style="font-size: 14px; line-height: 18px;" title=" [@{#text_click_to_enlarge#}@] "></span></a>')                          
                              $(window).bind('ready resizeEnd', function () {                             

                                  $("#info[@{$product_image.i}@]").removeData('elevateZoom');
                               
                                  if ($(window).width() >= 480 && $(window).width() <= 550) { 
                                    zWindowWidth = 220;
                                    zWindowHeight = 220;
                                    zWindowOffetx = 30;
                                    zWindowOffety = 0;                                             
                                  } else if ($(window).width() > 550) {          
                                    zWindowWidth = 300;
                                    zWindowHeight = 300;
                                    zWindowOffetx = 30;
                                    zWindowOffety = 0;                  
                                  } else {
                                    zWindowWidth = 220;
                                    zWindowHeight = 220;
                                    zWindowOffetx = -130;
                                    zWindowOffety = 95;  
                                  }

                                  $("#info[@{$product_image.i}@]").elevateZoom({
                                    zoomType: "window",                              
                                    zoomWindowWidth: zWindowWidth,
                                    zoomWindowHeight: zWindowHeight,
                                    cursor: "crosshair",
                                    borderSize: "1",
                                    borderColour: "#b6b7cb",
                                    zoomWindowOffetx: zWindowOffetx,
                                    zoomWindowOffety: zWindowOffety,    
                                    easing: true                        
                                  });
  
                              });                              
                            </script>
                            <noscript>
                              <a id="info[@{$product_image.i}@]" class="info" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><img class="info-img" src="[@{$product_image.src_product_img_medium}@]" title=" [@{$products_name}@] " alt="[@{$products_name}@]" /></a><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><span class="text-info glyphicon glyphicon-plus pull-right" style="font-size: 14px; line-height: 18px;" title=" [@{#text_click_to_enlarge#}@] "></span></a>
                            </noscript>                      
                           [@{elseif $smarty.foreach.images.total == 1}@]
                            <script type="text/javascript">
                              document.write('<span class="info"><img class="info-img" id="info[@{$product_image.i}@]" src="[@{$product_image.src_product_img_medium}@]" data-zoom-image="[@{$product_image.href_to_product_img_large}@]" /></span><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.href_to_product_img_large}@]" rel="images_group" target="_blank"><span class="text-info glyphicon glyphicon-plus pull-right" style="font-size: 14px; line-height: 18px;" title=" [@{#text_click_to_enlarge#}@] "></span></a>')
                              $(window).bind('ready resizeEnd', function () {                             

                                  $("#info[@{$product_image.i}@]").removeData('elevateZoom');
                               
                                  if ($(window).width() >= 480 && $(window).width() <= 550) { 
                                    zWindowWidth = 220;
                                    zWindowHeight = 220;
                                    zWindowOffetx = 30;
                                    zWindowOffety = 0;                                             
                                  } else if ($(window).width() > 550) {          
                                    zWindowWidth = 300;
                                    zWindowHeight = 300;
                                    zWindowOffetx = 30;
                                    zWindowOffety = 0;                  
                                  } else {
                                    zWindowWidth = 220;
                                    zWindowHeight = 220;
                                    zWindowOffetx = -130;
                                    zWindowOffety = 95;  
                                  }

                                  $("#info[@{$product_image.i}@]").elevateZoom({
                                    zoomType: "window",                              
                                    zoomWindowWidth: zWindowWidth,
                                    zoomWindowHeight: zWindowHeight,
                                    cursor: "crosshair",
                                    borderSize: "1",
                                    borderColour: "#b6b7cb",
                                    zoomWindowOffetx: zWindowOffetx,
                                    zoomWindowOffety: zWindowOffety,    
                                    easing: true                        
                                  });
  
                              });  
                            </script>
                            <noscript>
                              <a id="info[@{$product_image.i}@]" class="info" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><img class="info-img" src="[@{$product_image.src_product_img_medium}@]" title=" [@{$products_name}@] " alt="[@{$products_name}@]" /></a><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><span class="text-info glyphicon glyphicon-plus pull-right" style="font-size: 14px; line-height: 18px;" title=" [@{#text_click_to_enlarge#}@] "></span></a>
                            </noscript>                      
                           [@{/if}@]                 
                         [@{/foreach}@]
                </div> 
                <div id="info-thumbs">
                         [@{if $smarty.foreach.images.total > 1}@]                          
                           [@{foreach name=thumbs item=product_image from=$products_images}@]
                            <script type="text/javascript">
                              document.write('<a href="" id="thumb[@{$product_image.i}@]" class="thumb" onclick="changeImg([@{$product_image.i}@], [@{$smarty.foreach.thumbs.total}@]);return false">[@{$product_image.product_img_medium}@]</a>')                            
                            </script>                                                                                                
                           [@{/foreach}@]
                         [@{/if}@]
                <div class="clearfix invisible"></div>                         
                </div>                                                            
              </div>                                                       
<script type="text/javascript">

changeImg(0, [@{$smarty.foreach.images.total}@]);

$(document).ready(function () {
  $("a[rel=images_group]").colorbox({ 			
    maxWidth:'90%',
    maxHeight:'90%',
    photo:true
  });
});              
</script> 
              [@{/if}@]                         
              <div class="col-sm-7 col-md-7">
                <h1 class="text-orange product-name h2">[@{$products_name}@]</h1>               
                <div style="float: left;">                 
                  <div>[@{if $products_model}@]<b>[@{#text_model#}@]</b><br />[@{$products_model}@][@{/if}@]</div>
                  <div>[@{if $products_weight}@]<b>[@{#text_weight#}@]</b><br />[@{$products_weight}@]kg[@{/if}@]</div>
                  <div>[@{if $products_p_unit}@]<b>[@{#text_packing_unit#}@]</b><br />[@{$products_p_unit}@][@{/if}@]</div>
                  <div >[@{if $products_quantity}@]<b>[@{#text_quantity#}@]</b><br />[@{$products_quantity}@][@{/if}@]</div>                                                                                
                </div>                  
                <div style="text-align: right; float: right;">                  
                  <table class="table-border-cellspacing cellpadding-0px"> 
                    <tr>
                      <td style="text-align: right;">                                                                   
                        [@{if $products_price_breaks}@]                 
                        <div class="main" style="padding: 2px 2px 0 2px; text-align: right; white-space: nowrap;"><b>[@{if $products_price_special}@]<span class="text-deco-line-through">[@{$products_price}@]</span> <span class="product-special-price">[@{$products_price_special}@]</span>[@{else}@][@{$products_price}@][@{/if}@]</b></div>
                        <div class="main" style="padding: 0 2px 0 2px;">
                          <table class="table-border-cellspacing cellpadding-0px" style="float: right;">                     
                            [@{foreach name=price_breaks item=product_price_break from=$products_price_breaks}@]                        
                            [@{if $smarty.foreach.price_breaks.first}@]
                            <tr>                       
                              <td colspan="2" style="white-space: nowrap; text-align: center; vertical-align: bottom;"><img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 4px;" />[@{#text_price_breaks#}@]<img src="[@{$images_path}@]pixel_white.gif" alt="" style="display: block; width: 100%; height: 1px;" /></td>
                            </tr>                      
                            <tr>
                              <td style="white-space: nowrap; text-align: right; vertical-align: top;">[@{#text_quantity_in_price_breaks#}@]&nbsp;&nbsp;</td>
                              <td style="white-space: nowrap; text-align: center; vertical-align: top;">[@{#text_price_in_price_breaks#}@]</td>
                            </tr>                                                                   
                            [@{/if}@]                                
                            <tr>   
                              <td style="white-space: nowrap; text-align: right; vertical-align: top;">[@{$product_price_break.qty}@]<sup>+</sup>&nbsp;&nbsp;&nbsp;</td>                
                              <td style="white-space: nowrap; text-align: right; vertical-align: top;"><b>[@{if $product_price_break.price_break_special}@]<span class="text-deco-line-through">[@{$product_price_break.price_break}@]</span> <span class="product-special-price">[@{$product_price_break.price_break_special}@]</span>[@{else}@][@{$product_price_break.price_break}@][@{/if}@]</b></td>
                            </tr>                                                 
                            [@{/foreach}@] 
                          </table>                 
                        </div>
                        <div class="clearfix invisible"></div>
                        <div class="small-text" style="padding: 2px; text-align: right; white-space: nowrap;">                         
                          [@{$products_tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />                                                                                     
                          [@{if $link_filename_popup_content_6}@]                 
                            [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                          [@{else}@]
                            [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                          [@{/if}@]
                          [@{if $link_filename_popup_content_products_delivery_time && $products_delivery_time}@]
                            &nbsp;<br /><span class="main"><b>[@{#text_delivery_time#}@]</b>&nbsp;<a href="[@{$link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$products_delivery_time}@]</span></a><br /></span>
                          [@{elseif $products_delivery_time}@]
                            &nbsp;<br /><span class="main"><b>[@{#text_delivery_time#}@]</b>&nbsp;[@{$products_delivery_time}@]<br /></span>
                          [@{/if}@]                           
                        </div>                                                      
                        [@{else}@]
                        <div class="main" style="padding: 2px 2px 0 2px; text-align: right; white-space: nowrap;"><b>[@{if $products_price_special}@]<span class="text-deco-line-through">[@{$products_price}@]</span> <span class="product-special-price">[@{$products_price_special}@]</span>[@{else}@][@{$products_price}@][@{/if}@]</b></div>
                        <div class="small-text" style="padding: 2px; text-align: right; white-space: nowrap;">
                          [@{$products_tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />              
                          [@{if $link_filename_popup_content_6}@]                 
                            [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                          [@{else}@]
                            [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                          [@{/if}@]
                          [@{if $link_filename_popup_content_products_delivery_time && $products_delivery_time}@]
                            &nbsp;<br /><span class="main"><b>[@{#text_delivery_time#}@]</b>&nbsp;<a href="[@{$link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$products_delivery_time}@]</span></a><br /></span>
                          [@{elseif $products_delivery_time}@]
                            &nbsp;<br /><span class="main"><b>[@{#text_delivery_time#}@]</b>&nbsp;[@{$products_delivery_time}@]<br /></span>
                          [@{/if}@]                            
                        </div>      
                        [@{/if}@]                   
                      </td>
                    </tr>
                  </table>                                      
                </div>                                                
                <div class="clearfix invisible"></div>
                <div class="div-spacer-h10"></div>                        
                [@{if $products_options}@]                
                <div><b>[@{#text_product_options#}@]</b></div> 
                <div class="panel panel-default clearfix">           
                  <div id="options" class="panel-body">                                                 
                    <script type="text/javascript">
                      [@{strip}@]
                      document.write('
                      <div id="loading" style="visibility: hidden; width: 100%; position:relative; left:0px; top:0px;">
                        <div style="position:absolute; width:100%; display:block; margin:0 auto; text-align:center;">             
                          [@{#text_loading#}@]
                        </div> 
                      </div>                                  
                      <div class="clearfix">                    
                      [@{foreach name=options_name item=product_option from=$products_options}@]         
                        <div class="form-group">
                          <label for="option_[@{$product_option.products_options_id}@]">[@{$product_option.products_options_name}@]:</label>
                          [@{$product_option.products_options_pull_down|escape:"quotes"}@]
                        </div>
                      [@{/foreach}@]
                      </div>                                                    
                      [@{if $qty_for_these_options}@]
                      <div class="clearfix">
                        <div class="pull-left">[@{#text_in_stock_with_these_options#}@]<b>[@{$qty_for_these_options}@]</b>&nbsp;</div>
                        <div class="hidden-xs pull-right"><a href="" class="text-deco-underline" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" class="text-deco-underline-hover-none" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div>                     
                        <div class="visible-xs-block pull-right"><a href="[@{$link_options_noscript}@]" target="_blank" class="text-deco-underline">[@{#text_options_at_a_glance#}@]</a>&nbsp;</div>
                      </div>
                      [@{else}@]
                      <div class="clearfix">
                        <div class="pull-left">&nbsp;</div>
                        <div class="hidden-xs pull-right"><a href="" class="text-deco-underline" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" class="text-deco-underline-hover-none" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div>
                        <div class="visible-xs-block pull-right"><a href="[@{$link_options_noscript}@]" target="_blank" class="text-deco-underline">[@{#text_options_at_a_glance#}@]</a>&nbsp;</div>
                      </div>
                      [@{/if}@]');
                      [@{/strip}@] 
                    </script>                                        
                    <noscript>                                
                      <div>                    
                      [@{foreach item=product_option from=$products_options}@]                            
                        <div class="form-group">
                          <label class="control-label">[@{$product_option.products_options_name}@]:</label>
                          <p>[@{$product_option.products_options_list_noscript}@]</p>
                        </div>                                                     
                      [@{/foreach}@]
                      </div>
                      [@{if $qty_for_these_options}@]
                      <div class="clearfix"><div class="pull-left">[@{#text_in_stock_with_these_options#}@]<b>[@{$qty_for_these_options}@]</b>&nbsp;</div><div class="pull-right"><a href="[@{$link_options_noscript}@]" target="_blank" class="text-deco-underline">[@{#text_options_at_a_glance#}@]</a>&nbsp;</div></div>
                      [@{else}@]
                      <div class="clearfix"><div class="pull-left">&nbsp;</div><div class="pull-right"><a href="[@{$link_options_noscript}@]" target="_blank" class="text-deco-underline">[@{#text_options_at_a_glance#}@]</a>&nbsp;</div></div>                 
                      [@{/if}@]                                                                                               
                    </noscript>                                
                  </div>                                                                                                                      
                </div> 
                <script type="text/javascript">
                [@{strip}@]
                document.write('                                   
                <div style="width:100%; position:relative; left:0px; top: -10px; z-index:3;">                                
                  <div id="loading_list" style="background:#151515; display:none; position:absolute; right:0px; top:0px; padding-left:20px; padding-top:10px; padding-right:20px; padding-bottom:40px; min-width:300px; border: 1px solid transparent; border-radius: 4px;">                                                             
                    <div style="width:100%; margin:0 auto; text-align:center;">             
                      [@{#text_loading#}@]
                    </div>                                                                          
                  </div>                                                 
                  <div id="box_products_options_overview" style="background:#151515; display:none; position:absolute; right:0px; top:0px; padding-left:20px; padding-top:10px; padding-right:20px; padding-bottom:40px; min-width:300px; border: 1px solid transparent; border-radius: 4px;">                                                                                          
                  </div>                
                </div>');
                [@{/strip}@]
                $('#loading_list').css({'box-shadow' : '3px 3px 7px #111111', '-moz-box-shadow' : '3px 3px 7px #111111', '-webkit-box-shadow' : '3px 3px 7px #111111'});
                $('#box_products_options_overview').css({'box-shadow' : '3px 3px 7px #111111', '-moz-box-shadow' : '3px 3px 7px #111111', '-webkit-box-shadow' : '3px 3px 7px #111111'});                
                </script>                                             
                [@{/if}@]
                <div class="panel panel-default visible-xs-block">
                  <div class="panel-heading"><h3 class="panel-title">[@{#box_heading_share_product#}@]</h3></div>
                  <div class="panel-body text-center">
                    [@{$box_share_product_social_bookmarks}@]         
                  </div>
                </div>                 
                <div class="panel panel-default clearfix">           
                  <div class="panel-body">                                                             
                    <div class="form-inline wrapper-for-input-qty">                      
                      <div class="pull-right">
                        <script type="text/javascript">
                          $(function(){
                            $("input[name='products_quantity']").before('<a id="inc" class="glyphicon glyphicon-plus btn-plus"></a>').after('<a id="dec" class="glyphicon glyphicon-minus btn-minus"></a>&nbsp;');
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
                        </script>
                        <input type="submit" id="add_to_cart" class="btn btn-success" value="[@{#button_text_in_cart#}@]" />
                      </div>                             
                      <div class="form-group has-success" style="padding: 0 2px 0 0; float: right;">
                        [@{$hidden_field_products_id}@][@{$input_products_quantity}@]
                      </div>                                                                                      
                      <div class="clearfix invisible"></div>                    
                    </div>                                   
                  </div>             
                </div>                
                <div class="well well-sm clearfix"> 
                  <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                             
                  [@{if $link_filename_product_reviews}@]                             
                  <a href="[@{$link_filename_product_reviews}@]" class="btn btn-primary pull-right" title=" [@{#button_title_reviews#}@] ">[@{#button_text_reviews#}@]</a>
                  [@{/if}@]                                                                                                                                                                 
                </div>                 
              </div>               
              <div class="clearfix invisible"></div>        
            </div>        
            <div class="div-spacer-h10"></div>         
            <noscript>
            <div><b>[@{#text_products_description#}@]:</b></div>
            </noscript>                    
            <ul class="descrip-tabs">            
            [@{foreach name=label item=product_description from=$products_description}@]
               <li><a href="#tab[@{$smarty.foreach.label.iteration}@]"><b>[@{$product_description.tab_label|default:#text_products_description#}@]</b></a></li>          
            [@{/foreach}@]            
            </ul>
            <div class="panel panel-default clearfix">           
              <div class="panel-body">                    
                [@{foreach name=description item=product_description from=$products_description}@]
                <div id="tab[@{$smarty.foreach.description.iteration}@]">[@{$product_description.description|default:#text_no_content#}@]</div>
                <div class="clearfix invisible"></div>         
                [@{/foreach}@]
              </div>
            </div>                   
            [@{if $reviews_count}@]
            <div>[@{#text_current_reviews#}@] [@{$reviews_count}@]</div>
            <div class="div-spacer-h10"></div>
            [@{/if}@]
            [@{if $link_products_url}@]
            <div>[@{eval var = #text_more_information#}@]</div>
            <div class="div-spacer-h10"></div>
            [@{/if}@]
            [@{if $products_date_available}@]
            <div style="text-align: center">[@{eval var = #text_date_available#}@]</div>
            [@{else}@]
            <div style="text-align: center">[@{eval var = #text_date_added#}@]</div>
            [@{/if}@]
            <div class="div-spacer-h10"></div>
            <div><img src="[@{$images_path}@]pixel_white.gif" alt="" style="display: block; width: 100%; height: 1px;" /></div>  
            [@{$form_end}@]
          </div>       
          [@{if $xsell_products}@] 
          <div class="div-spacer-h10"></div>
          <div> 
          [@{$xsell_products}@]
          </div>
          [@{/if}@]
          [@{if $also_purchased_products}@]      
          <div class="div-spacer-h10"></div>
          <div> 
          [@{$also_purchased_products}@]
          </div>      
          [@{/if}@]
    [@{/if}@]      
<!-- product_info_eof -->
