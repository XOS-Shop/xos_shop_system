[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cosmo-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.6
* descrip    : xos-shop template built with Bootstrap3 and theme cosmo                                                                    
* filename   : product_listing_b.tpl
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

<!-- product_listing_b -->
<script type="text/javascript">
  $(function(){
    $("input[name='products_quantity']").before('<a class="glyphicon glyphicon-plus btn-plus"></a>').after('<a class="glyphicon glyphicon-minus btn-minus"></a>');
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
  if(document.getElementById("advanced-search-and-results-heading") != null) {
    $('#advanced-search-and-results-heading').css('display','block');
    $('#advanced-search-and-results-forms').css('display','none');
    $('#toggle_forms').css('display','block');
  } 
  $('#toggle_forms').click(function() {
    $('#advanced-search-and-results-forms').slideToggle(600);
    return false;
  }); 
</script> 
          [@{if $listing}@]
          <div class="clearfix invisible"></div> 
          <div>          
            [@{if $link_switch_view}@]          
            <div style="float: left; padding: 3px;">                       
              &nbsp;     
              <div style="padding: 1px 20px 0 0; white-space: nowrap;">
                <a href="[@{$link_switch_view}@]" class="btn btn-default" style="float: left" title=" [@{#button_title_switch_view#}@] "><span class="glyphicon glyphicon-align-justify"  style="color:grey;"></span> <span class="glyphicon glyphicon-th"  style="color:red;"></span> [@{#button_text_switch_view#}@]</a>                       
              </div>                                   
            </div> 
            [@{/if}@]           
            [@{if $pull_down_menu_display_products}@]          
            <div style="float: left; padding: 3px;">                       
              [@{#text_products_per_page#}@]     
              <div class="form-inline" style="padding: 2px 20px 0 0; white-space: nowrap;">
                <div class="onload-display" style="display: none;">
                  [@{$pull_down_menu_display_products}@]
                </div>
                <noscript>
                  [@{$pull_down_menu_display_products_noscript_begin}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /><input type="submit" value="[@{#small_button_text_view#}@]" />[@{$pull_down_menu_display_products_noscript_end}@]
                </noscript>                         
              </div>                                   
            </div> 
            [@{/if}@]            
            [@{if $pull_down_menu}@]          
            <div style="float: left; padding: 3px;">                       
              [@{#text_show#}@]     
              <div class="form-inline" style="padding: 2px 20px 0 0; white-space: nowrap;">
                <div class="onload-display" style="display: none;">
                  [@{$pull_down_menu}@]
                </div>
                <noscript>
                  [@{$pull_down_menu_noscript_begin}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /><input type="submit" value="[@{#small_button_text_view#}@]" />[@{$pull_down_menu_noscript_end}@]
                </noscript>                         
              </div>                                   
            </div> 
            [@{/if}@]                                                     
            <div id="sort">
              [@{#text_sorting#}@]
              <div style="padding: 2px 20px 0 0;"> 
                <div id="sort_box">
                  [@{if $selected_none}@]
                  <ul style="padding: 7px;">
                    <li><img src="[@{$images_path}@]arrow_asc_desc_alternate.gif" alt="" />[@{#text_please_select#}@]&nbsp;</li>
                  </ul>
                  [@{else}@]
                  [@{foreach item=heading_top from=$table_heading_alt}@]
                  [@{if $heading_top.selected}@]
                  <ul style="padding: 7px;">
                    <li>[@{$heading_top.text}@]&nbsp;</li>
                  </ul>
                  [@{/if}@]
                  [@{/foreach}@]
                  [@{/if}@]
                  <div id="sort_list">
                    <ul>
                    [@{foreach item=heading from=$table_heading_alt}@]
                    [@{if !$heading.selected}@]
                      <li>[@{$heading.text}@]&nbsp;</li>
                    [@{/if}@]
                    [@{/foreach}@]
                    </ul>
                  </div>
                </div>                                                                                                                                    
              </div>
            </div>                                     
            <div class="clearfix invisible"></div>            
            <script type="text/javascript">                                                     
              $('#sort_box').mouseleave(function(){
                $('#sort_list').css('display','none');
              }).mouseenter(function(){
                $(this).css('cursor', 'pointer');                  
                $('#sort_list').show(200); 
              });
              $('#sort').css('display','block');                                                  
            </script>                                                          
          </div>
          <div class="clearfix invisible"></div>
          <div class="div-spacer-h10"></div>  
          [@{if $nav_bar_top}@]
          <div class="clearfix">
            <div class="pagination-number">[@{$nav_bar_number}@]</div>          
            <div class="pagination-result">[@{$nav_bar_result}@]</div>
          </div>
          <div class="div-spacer-h10"></div>
          [@{/if}@] 
          <div class="row eq-height">                 
            [@{foreach name=outer item=table_data from=$table_data_list}@]
            <div class="col-sm-6 col-md-4"> 
              <div class="panel panel-default clearfix">           
                <div class="panel-body">                           
                  [@{foreach name=inner item=data from=$table_data.table_inner}@]  
                  [@{if $data.case == 'model'}@]<div class="product-listing-b-item-data">[@{if $data.products_model}@]<b>[@{#text_model#}@] </b>[@{$data.products_model}@][@{/if}@]</div>[@{/if}@]                  
                  [@{if $data.case == 'name'}@]
                  <div class="product-listing-b-item-data text-center hidden-xs"><b><a href="[@{$data.products_link}@]"><span class="text-deco-underline">[@{$data.products_name}@]</span></a></b></div>
                  <div class="product-listing-b-item-data visible-xs-block"><b><a href="[@{$data.products_link}@]"><span class="text-deco-underline">[@{$data.products_name}@]</span></a></b></div>
                  [@{/if}@]                                                     
                  [@{if $data.case == 'info'}@]<div class="product-listing-b-item-data">[@{if $data.products_info}@]<b>[@{#text_brief_description#}@]</b><br />[@{$data.products_info}@][@{/if}@]</div>[@{/if}@]
                  [@{if $data.case == 'packing_unit'}@]<div class="product-listing-b-item-data">[@{if $data.products_p_unit}@]<b>[@{#text_packing_unit#}@] </b>[@{$data.products_p_unit}@][@{/if}@]</div>[@{/if}@]
                  [@{if $data.case == 'manufacturer'}@]<div class="product-listing-b-item-data">[@{if $data.manufacturers_name}@]<b>[@{#text_manufacturer#}@] </b><a href="[@{$data.manufacturers_link}@]"><span class="text-deco-underline">[@{$data.manufacturers_name}@]</span></a>[@{/if}@]</div>[@{/if}@]        
                  [@{if $data.case == 'price'}@]
                  <span><b>[@{#text_price#}@]</b>&nbsp;</span>
                  
                  [@{if $data.price_breaks}@]                
  
                    <div class="pull-right">  
                      <table class="table-border-cellspacing cellpadding-0px"> 
                        <tr>
                          <td>                                    
                            <div id="toggle_arrow_[@{$data.products_id}@]" class="price-label small-text text-right text-nowrap"><a><img onmouseover="this.style.cursor='pointer'" src="[@{$images_path}@]icon_arrow_down.gif" height="10" width="13" alt="" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<b>[@{if $data.price_special}@]<span class="text-deco-line-through">[@{$data.price}@]</span> <span class="product-special-price">[@{$data.price_special}@]</span>[@{else}@][@{$data.price}@][@{/if}@]</b></div>
                            <div class="price-label small-text">  
                              <div id="toggle_[@{$data.products_id}@]" class="pull-right">
                              <table class="table-border-cellspacing cellpadding-0px">                
                                [@{foreach name=inner_inner item=price_breaks from=$data.price_breaks}@]                             
                                [@{if $smarty.foreach.inner_inner.first}@]
                                <tr>                       
                                  <td colspan="2" class="text-center text-nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" style="display: block; width: 100%; height: 4px;" />[@{#text_price_breaks#}@]<img src="[@{$images_path}@]pixel_black.gif" alt="" style="display: block; width: 100%; height: 1px;" /></td>
                                </tr>                      
                                <tr>
                                  <td class="text-right text-nowrap">[@{#text_quantity_in_price_breaks#}@]</td>
                                  <td class="text-center text-nowrap">[@{#text_price_in_price_breaks#}@]</td>
                                </tr>                                                                   
                                [@{/if}@]                                                     
                                <tr>
                                  <td class="text-right text-nowrap">[@{$price_breaks.qty}@]<sup>+</sup>&nbsp;&nbsp;</td>
                                  <td class="text-right text-nowrap"><b>[@{if $price_breaks.price_break_special}@]<span class="text-deco-line-through">[@{$price_breaks.price_break}@]</span> <span class="product-special-price">[@{$price_breaks.price_break_special}@]</span>[@{else}@][@{$price_breaks.price_break}@][@{/if}@]</b></td>
                                </tr>                 
                                [@{/foreach}@]                
                              </table>
                              </div> 
                              <div class="clearfix invisible"></div>                            
                              <div class="product-listing-b-item-data price-label small-text text-right text-nowrap"> 
                                [@{$data.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />              
                                [@{if $link_filename_popup_content_6}@]                 
                                  [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                                [@{else}@]
                                  [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                                [@{/if}@] 
                              </div>
                              [@{if $data.link_filename_popup_content_products_delivery_time && $data.products_delivery_time}@]
                              <div class="product-listing-b-item-data price-label small-text text-right text-nowrap"><b>[@{#text_delivery_time#}@]</b>&nbsp;<a href="[@{$data.link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$data.products_delivery_time}@]</span></a></div>
                              [@{elseif $data.products_delivery_time}@]
                              <div class="product-listing-b-item-data price-label small-text text-right text-nowrap"><b>[@{#text_delivery_time#}@]</b>&nbsp;[@{$data.products_delivery_time}@]</div>        
                              [@{/if}@]                                
                            </div>                                         
                          </td>
                        </tr>
                      </table>                     
                      <script type="text/javascript">
                        $('#toggle_arrow_[@{$data.products_id}@]').click(function() {
                          $('#toggle_[@{$data.products_id}@]').toggle(400);
                          return false;
                        });
                        $('#toggle_[@{$data.products_id}@]').css('display','none');
                      </script>
                    </div> 
                    <div class="clearfix invisible"></div>
                                                                                
                  [@{else}@]
  
                    <div class="pull-right">
                      <div class="price-label small-text text-right text-nowrap"><b>[@{if $data.price_special}@]<span class="text-deco-line-through">[@{$data.price}@]</span> <span class="product-special-price">[@{$data.price_special}@]</span>[@{else}@][@{$data.price}@][@{/if}@]</b></div>
                      <div class="product-listing-b-item-data price-label small-text text-right text-nowrap">
                        [@{$data.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />              
                        [@{if $link_filename_popup_content_6}@]                 
                          [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                        [@{else}@]
                          [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                        [@{/if}@] 
                      </div> 
                      [@{if $data.link_filename_popup_content_products_delivery_time && $data.products_delivery_time}@]
                      <div class="product-listing-b-item-data price-label small-text text-right text-nowrap"><b>[@{#text_delivery_time#}@]</b>&nbsp;<a href="[@{$data.link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$data.products_delivery_time}@]</span></a></div>
                      [@{elseif $data.products_delivery_time}@]
                      <div class="product-listing-b-item-data price-label small-text text-right text-nowrap"><b>[@{#text_delivery_time#}@]</b>&nbsp;[@{$data.products_delivery_time}@]</div>        
                      [@{/if}@]                       
                    </div>
                    <div class="clearfix invisible"></div>
        
                  [@{/if}@]                
  
                  [@{/if}@]    
                  [@{if $data.case == 'quantity'}@]<div class="product-listing-b-item-data"><b>[@{#text_quantity#}@] </b>[@{$data.products_quantity}@]</div>[@{/if}@]
                  [@{if $data.case == 'weight'}@]<div class="product-listing-b-item-data">[@{if $data.products_weight > 0}@]<b>[@{#text_weight#}@] </b>[@{$data.products_weight}@]kg[@{/if}@]</div>[@{/if}@]                 
                  [@{if $data.case == 'image'}@]
                  <div class="product-listing-b-item-data hidden-xs"><a href="[@{$data.products_link_image}@]">[@{$data.products_image_medium}@]</a></div>
                  <div class="product-listing-b-item-data visible-xs-block"><a href="[@{$data.products_link_image}@]">[@{$data.products_image_medium|replace:'center-block':''}@]</a></div>
                  [@{/if}@]                                           
                  [@{if $data.case == 'buy_now'}@]
                  [@{$data.products_buy_form_begin}@]          
                  <div class="product-listing-b-item-data">
                    <div class="form-inline wrapper-for-input-qty">
                      <div class="pull-right">
                          <input type="submit" class="btn btn-success pull-left" value="[@{#button_text_buy_now#}@]" /> 
                      </div>                             
                      <div class="form-group has-success pull-right">
                        [@{$data.products_hidden_field}@][@{$data.products_input_quantity}@]
                      </div>
                      <div class="clearfix invisible"></div>        
                    </div>
                  </div>                                 
                  [@{$data.form_end}@]
                  [@{/if}@]      
                  [@{/foreach}@]                                 
                </div>                                     
              </div>    
            </div>   
            [@{if ($smarty.foreach.outer.iteration)%3 == 0}@]
            <div class="visible-lg visible-md clearfix"></div>            
            [@{/if}@]
            [@{if ($smarty.foreach.outer.iteration)%2 == 0}@]
            <div class="visible-sm clearfix"></div>            
            [@{/if}@]                
            [@{/foreach}@]
          </div>          
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
              [@{$text_no_products}@]
            </div>
          </div> 
          [@{/if}@]          
<!-- product_listing_b_eof -->
