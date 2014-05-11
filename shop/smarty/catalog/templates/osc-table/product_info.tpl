[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
    [@{if !$product_check}@]
      <tr>
        <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">     
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                  </tr>
                  <tr>
                    <td class="boxText">[@{#text_product_not_found#}@]</td>
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
        </table></td>
      </tr>      
    [@{else}@]
      <tr>
        <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">   
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pageHeading" valign="top">[@{$products_name}@]<span class="smallText">[@{if $products_model}@]<br /><b>[@{#text_model#}@]</b>&nbsp;&nbsp;[@{$products_model}@][@{/if}@][@{if $products_weight}@]<br /><b>[@{#text_weight#}@]</b>&nbsp;&nbsp;[@{$products_weight}@]kg[@{/if}@][@{if $products_p_unit}@]<br /><b>[@{#text_packing_unit#}@]</b>&nbsp;&nbsp;[@{$products_p_unit}@][@{/if}@][@{if $products_quantity}@]<br /><b>[@{#text_quantity#}@]</b>&nbsp;&nbsp;[@{$products_quantity}@][@{/if}@]</span></td>                                               
                <td align="right" valign="top" class="pageHeading"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td nowrap="nowrap" align="right" valign="top">&nbsp;&nbsp;<b>[@{#text_price#}@]</b>&nbsp;&nbsp;</td>                                  
                    <td align="right" valign="top"><table border="0" class="price-label" cellspacing="0" cellpadding="0">                     
                      <tr>
                        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="1" /></td>
                        <td colspan="2" nowrap="nowrap" align="right" valign="top"><b>[@{if $products_price_special}@]<span class="text-deco-line-through">[@{$products_price}@]</span> <span class="productSpecialPrice">[@{$products_price_special}@]</span>[@{else}@][@{$products_price}@][@{/if}@]</b></td>
                        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="1" /></td>
                      </tr>                                             
                      [@{foreach name=price_breaks item=product_price_break from=$products_price_breaks}@]                        
                      [@{if $smarty.foreach.price_breaks.first}@]
                      <tr>
                        <td valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="1" /></td>                       
                        <td colspan="2" nowrap="nowrap" class="main" align="center" valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />[@{#text_price_breaks#}@]<br /><img src="[@{$images_path}@]pixel_white.gif" alt="" width="100%" height="1" /></td>
                        <td valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="1" /></td>
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
                        <td nowrap="nowrap" class="main" align="right" valign="top">[@{$product_price_break.qty}@]<sup>+</sup>&nbsp;&nbsp;&nbsp;</td>                
                        <td nowrap="nowrap" class="main" align="right" valign="top"><b>[@{if $product_price_break.price_break_special}@]<span class="text-deco-line-through">[@{$product_price_break.price_break}@]</span> <span class="productSpecialPrice">[@{$product_price_break.price_break_special}@]</span>[@{else}@][@{$product_price_break.price_break}@][@{/if}@]</b></td>
                        <td></td>
                      </tr>                                                 
                      [@{/foreach}@]
                      <tr>
                        <td></td>                       
                        <td colspan="2" nowrap="nowrap" class="smallText" align="right" valign="top">
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
          <tr>
            <td class="main">
[@{$javascript}@]            
            [@{if $products_images}@]
<script type="text/javascript">
/* <![CDATA[ */
function changeImg(no, qty) { 

  for (i=0; i<qty; i++) {
    if (document.getElementById("info" + i)) {
      document.getElementById("info" + i).style.visibility = "hidden";
      document.getElementById("glass" + i).style.visibility = "hidden";
      document.getElementById("thumb" + i).style.borderColor = "#94A6B5";
    }
  }            
  
  document.getElementById("info" + no).style.visibility = "visible";
  document.getElementById("glass" + no).style.visibility = "visible";
  document.getElementById("thumb" + no).style.borderColor = "red";
                                                                                     
}

if ((navigator.userAgent.toString().toLowerCase().indexOf("safari") == -1) || (navigator.userAgent.toString().toLowerCase().indexOf("chrome") != -1)) { //exclude safari browser
  $(document).ready(function() {
    $('.jqzoom').jqzoom({
      zoomType : 'innerzoom',
/*      zoomType : 'standard', */
      preloadText : '',
      lens : true,
      title : true,
      preloadImages : false,
      alwaysOn : false,
/*      allowAlerts: true, */
      zoomWidth : 450,
      zoomHeight : 450,
      xOffset : 50,
      yOffset : 0,
      showEffect : 'fadein',
      hideEffect: 'fadeout',           
      position : 'left'
    });
  });
}  
/* ]]> */
</script>              
              <table border="0" cellspacing="0" cellpadding="1" align="right" class="infoBox">
                <tr>            
                  <td>                   
                    <table border="0" cellpadding="0" cellspacing="0" class="infoBoxContents">                                               
                      <tr>
                        <td class="smallText"> 
                          <div id="info-images-header">[@{#text_products_image#}@]
                          </div>                          
                          <div id="info-images">
                         [@{foreach name=images item=product_image from=$products_images}@]
                           [@{if $smarty.foreach.images.total > 1}@]                        
                            <script  type="text/javascript">
                            /* <![CDATA[ */
                              document.write('<span class="info"><a id="info[@{$product_image.i}@]" rel="images_group" class="jqzoom" href="[@{$product_image.href_to_product_img_large}@]" title="[@{#text_zoom#}@]" onclick="return false">[@{$product_image.product_img_medium}@]</a></span><a id="glass[@{$product_image.i}@]" class="glass lightbox-img" href="[@{$product_image.link_product_img}@]" target="_blank"><img align="right" src="[@{$images_path}@]magnifying_glass.gif" alt="[@{#text_click_to_enlarge#}@]" title=" [@{#text_click_to_enlarge#}@] " /></a>')
                            /* ]]> */  
                            </script>
                            <noscript>
                              <a id="info[@{$product_image.i}@]" class="info" href="[@{$product_image.link_product_img_noscript}@]" target="_blank">[@{$product_image.product_img_medium}@]</a><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><img align="right" src="[@{$images_path}@]magnifying_glass.gif" alt="[@{#text_click_to_enlarge#}@]" title=" [@{#text_click_to_enlarge#}@] " /></a>
                            </noscript>                      
                           [@{elseif $smarty.foreach.images.total == 1}@]
                            <script type="text/javascript">
                            /* <![CDATA[ */
                              document.write('<span class="info"><a id="info[@{$product_image.i}@]" rel="images_group" class="jqzoom" href="[@{$product_image.href_to_product_img_large}@]" title="[@{#text_zoom#}@]" onclick="return false">[@{$product_image.product_img_medium}@]</a></span><a id="glass[@{$product_image.i}@]" class="glass lightbox-img" href="[@{$product_image.link_product_img}@]" target="_blank"><img align="right" src="[@{$images_path}@]magnifying_glass.gif" alt="[@{#text_click_to_enlarge#}@]" title=" [@{#text_click_to_enlarge#}@] " /></a>')
                            /* ]]> */  
                            </script>
                            <noscript>
                              <a id="info[@{$product_image.i}@]" class="info" href="[@{$product_image.link_product_img_noscript}@]" target="_blank">[@{$product_image.product_img_medium}@]</a><a id="glass[@{$product_image.i}@]" class="glass" href="[@{$product_image.link_product_img_noscript}@]" target="_blank"><img align="right" src="[@{$images_path}@]magnifying_glass.gif" alt="[@{#text_click_to_enlarge#}@]" title=" [@{#text_click_to_enlarge#}@] " /></a>
                            </noscript>                      
                           [@{/if}@]                 
                         [@{/foreach}@]
                          </div> 
                          <div id="info-thumbs">
                         [@{if $smarty.foreach.images.total > 1}@]                          
                           [@{foreach name=thumbs item=product_image from=$products_images}@]
                            <script type="text/javascript">
                            /* <![CDATA[ */
                              document.write('<a href="" id="thumb[@{$product_image.i}@]" class="thumb" onclick="changeImg([@{$product_image.i}@], [@{$smarty.foreach.thumbs.total}@]);return false">[@{$product_image.product_img_extra_small}@]</a>')
                            /* ]]> */  
                            </script>                                                                                                
                           [@{/foreach}@]
                         [@{/if}@]                         
                          <div class="clear">&nbsp;</div>
                          </div>
<script type="text/javascript">
/* <![CDATA[ */            
$("a[rel=images_group]").fancybox({ 			
  'transitionIn':'elastic',
  'transitionOut':'elastic',
  'titlePosition':'inside',
  'titleFormat':function(title, currentArray, currentIndex, currentOpts) { return '<span id="fancybox-title-in-product-info-tpl">[@{#text_products_image#}@] ' + (currentIndex + 1) + ' / ' + currentArray.length + '</span>'; }  
});

$(".lightbox-img").fancybox({
  'width':[@{$box_width}@],
  'height':[@{$box_height}@],
  'autoScale':false,
  'transitionIn':'elastic',
  'transitionOut':'fade',
  'padding':4,
  'onComplete':function() { $("#fancybox-content").css({'border-color':'#bbc3d3'}); },
  'onClosed':function() { $("#fancybox-content").css({'border-color':'#fff'}); },  
  'type':'iframe'
}); 
/* ]]> */   
</script>                                                
                        </td>
                      </tr>                                                                   
                    </table>                     
                  </td>              
                </tr>
              </table>
            [@{/if}@]
              <noscript>
              <table border="0" cellspacing="0" cellpadding="0">    
                <tr>
                  <td class="main"><b>[@{#text_products_description#}@]:</b></td>
                </tr>
                <tr>
                  <td class="pageHeading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /></td>
                </tr>
              </table>                               
              </noscript>            
              <table border="0" cellspacing="0" cellpadding="0">                         
                <tr>
                  <td>                               
                    <ul class="descrip-tabs main">            
                    [@{foreach name=label item=product_description from=$products_description}@]
                      <li><a href="#tab[@{$smarty.foreach.label.iteration}@]"><b>[@{$product_description.tab_label|default:#text_products_description#}@]</b></a></li>          
                    [@{/foreach}@]            
                    </ul>
                  </td>
                </tr> 
                <tr>
                  <td class="pageHeading"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="99%" height="1" /></td>
                </tr>                    
                <tr>
                  <td>                               
                    <div class="product-listing info-box-central-contents" style="padding: 0 10px 0 3px;">            
                    [@{foreach name=description item=product_description from=$products_description}@]
                      <div id="tab[@{$smarty.foreach.description.iteration}@]" class="main">[@{$product_description.description|default:#text_no_content#}@]</div>
                      <div class="clear">&nbsp;</div>         
                    [@{/foreach}@]
                    </div>            
                  </td>
                </tr>
                <tr>
                  <td class="pageHeading"><img src="[@{$images_path}@]pixel_silver.gif" alt="" width="99%" height="1" /><span style="font-size: 12px; line-height: 1%; visibility: hidden;"><br />- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</span></td>
                </tr>                                            
              </table>
              <div class="clear">&nbsp;</div>
            [@{if $products_options}@]
              <div id="options">
              <script type="text/javascript">
              /* <![CDATA[ */
              [@{strip}@]
              document.write('
                <div id="loading" class="main" style="visibility: hidden; width: 100%; position:relative; left:0px; top:0px;">
                  <div style="position:absolute; width:100%; display:block;">             
                    [@{#text_loading#}@]
                  </div> 
                </div>                              
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="2" class="pageHeading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="6" /><br /><span class="main"><b>[@{#text_product_options#}@]</b></span><br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="6" /></td>
                  </tr>               
                  [@{foreach item=product_option from=$products_options}@]      
                  <tr>
                    <td width="1%" nowrap="nowrap" class="main">[@{$product_option.products_options_name}@] : </td>
                    <td width="99%" nowrap="nowrap" class="main">[@{$product_option.products_options_pull_down|escape:"quotes"}@]</td>
                  </tr>
                  [@{/foreach}@]
                  [@{if $qty_for_these_options}@] 
                  <tr>
                    <td colspan="2" nowrap="nowrap" width="100%" class="main"><div style="width:60%; float:left;">[@{#text_in_stock_with_these_options#}@]&nbsp;[@{$qty_for_these_options}@]</div><div class="smallText" style="float:right;"><a href="" style="text-decoration:underline;" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" style="text-decoration:none;" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div><div class="clear">&nbsp;</div></td>
                  </tr>
                  [@{else}@]
                  <tr>
                    <td colspan="2" nowrap="nowrap" width="100%" class="main"><div style="width:60%; float:left;">&nbsp;</div><div class="smallText" style="float:right;"><a href="" style="text-decoration:underline;" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">[@{#text_options_at_a_glance#}@]</a><a href="" style="text-decoration:none;" onclick="[@{$get_otions_list|escape:"quotes"}@] return false">&nbsp;<img src="[@{$images_path}@]icon_arrow_down.gif" title=" [@{#more#}@] " alt="[@{#more#}@]" /></a>&nbsp;</div><div class="clear">&nbsp;</div></td>
                  </tr>
                  [@{/if}@]                    
                </table>');
              [@{/strip}@]
              /* ]]> */  
              </script> 
              <noscript> 
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="2" class="pageHeading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="6" /><br /><span class="main"><b>[@{#text_product_options#}@]</b></span><br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="6" /></td>
                  </tr>               
                  [@{foreach item=product_option from=$products_options}@]      
                  <tr>
                    <td width="1%" nowrap="nowrap" class="main" valign="top">[@{$product_option.products_options_name}@] : </td>
                    <td width="99%" nowrap="nowrap" class="main" valign="top">[@{$product_option.products_options_list_noscript}@]</td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="3" /></td>
                  </tr>                     
                  [@{/foreach}@]
                  [@{if $qty_for_these_options}@] 
                  <tr>
                    <td colspan="2" nowrap="nowrap" width="100%" class="main"><div style="width:60%; float:left;">[@{#text_in_stock_with_these_options#}@]&nbsp;[@{$qty_for_these_options}@]</div><div class="smallText" style="float:right;"><a href="[@{$link_options_noscript}@]" target="_blank" style="text-decoration:underline;">[@{#text_options_at_a_glance#}@]</a>&nbsp;</div><div class="clear">&nbsp;</div></td>
                  </tr>
                  [@{else}@]
                  <tr>
                    <td colspan="2" nowrap="nowrap" width="100%" class="main"><div style="width:60%; float:left;">&nbsp;</div><div class="smallText" style="float:right;"><a href="[@{$link_options_noscript}@]" target="_blank" style="text-decoration:underline;">[@{#text_options_at_a_glance#}@]</a>&nbsp;</div><div class="clear">&nbsp;</div></td>
                  </tr>
                  [@{/if}@] 
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                  </tr>                   
                </table>
              </noscript>                               
              </div>
              <script type="text/javascript">
              /* <![CDATA[ */
              [@{strip}@]
              document.write('                                   
              <div style="width:100%; position:relative; left:0px; top:2px; z-index:3;">                               
                <div id="loading_list" class="productListing" style="background:#fff; display:none; position:absolute; right:0px; top:0px; padding-left:20px; padding-top:10px; padding-right:20px; padding-bottom:40px; min-width:300px;">                                                             
                  <div class="main" style="width:100%; margin:0 auto; text-align:center;">             
                    [@{#text_loading#}@]
                  </div>                                                                          
                </div>                                                 
                <div id="box_products_options_overview" class="productListing" style="background:#fff; display:none; position:absolute; right:0px; top:0px; padding-left:20px; padding-top:10px; padding-right:20px; padding-bottom:40px; min-width:300px;">                                                                                          
                </div>                
              </div>');
              [@{/strip}@]
              $('#loading_list').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});
              $('#box_products_options_overview').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});              
              /* ]]> */  
              </script>              
            [@{/if}@]                         
            </td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          [@{if $reviews_count}@]
          <tr>
            <td class="main">[@{#text_current_reviews#}@] [@{$reviews_count}@]</td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          [@{/if}@]
          [@{if $link_products_url}@]
          <tr>
            <td class="main">[@{eval var = #text_more_information#}@]</td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          [@{/if}@]
          [@{if $products_date_available}@]
          <tr>
            <td align="center" class="smallText">[@{eval var = #text_date_available#}@]</td>
          </tr>
          [@{else}@]
          <tr>
            <td align="center" class="smallText">[@{eval var = #text_date_added#}@]</td>
          </tr>
          [@{/if}@]
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td nowrap="nowrap" width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td nowrap="nowrap" class="main"><a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                    <td nowrap="nowrap" class="main">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    [@{if $link_filename_product_reviews}@]
                    <td nowrap="nowrap" class="main"><a href="[@{$link_filename_product_reviews}@]" class="button-reviews" style="float: left" title=" [@{#button_title_reviews#}@] "><span>[@{#button_text_reviews#}@]</span></a></td>
                    [@{/if}@]
                    <td nowrap="nowrap" class="main" align="right"><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />[@{$hidden_field_products_id}@][@{$input_products_quantity}@]&nbsp;</td>
                    <td nowrap="nowrap" width="1%" class="main" align="right">
                      <script type="text/javascript">
                      /* <![CDATA[ */
                        document.write('<a id="add_to_cart" href="" onclick="cart_quantity.submit(); return false" class="button-add-to-cart" style="float: right" title=" [@{#button_title_in_cart#}@] "><span>[@{#button_text_in_cart#}@]</span></a>')
                      /* ]]> */  
                      </script>
                      <noscript>
                        <input type="submit" value="[@{#button_text_in_cart#}@]" />
                      </noscript>                           
                    </td>               
                    <td nowrap="nowrap" width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>    
        </table>[@{$form_end}@]</td>
      </tr>       
      [@{if $xsell_products}@] 
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td> 
       [@{$xsell_products}@]
        </td>
      </tr>
      [@{/if}@]
      [@{if $also_purchased_products}@]
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>            
      <tr>
        <td> 
       [@{$also_purchased_products}@]
        </td>
      </tr>
      [@{/if}@]
    [@{/if}@]      
    </table></td>
<!-- product_info_eof -->
