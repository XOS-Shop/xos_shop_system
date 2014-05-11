[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with div/css layout                                                                     
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
/* <![CDATA[ */
  if(document.getElementById("advanced-search-and-results-heading") != null) {
    document.getElementById("advanced-search-and-results-heading").style.display = "block";
  }
/* ]]> */  
</script> 
          [@{if $listing}@]
          <div class="clear">&nbsp;</div> 
          <div>          
            [@{if $link_switch_view}@]          
            <div class="small-text" style="float: left; padding: 3px;">                       
              <b>&nbsp;</b>     
              <div class="small-text" style="padding: 4px 20px 0 0; white-space: nowrap;">
                <a href="[@{$link_switch_view}@]" class="button-switch-view" style="float: left" title=" [@{#button_title_switch_view#}@] "><span>[@{#button_text_switch_view#}@]</span></a>                       
              </div>                                   
            </div> 
            [@{/if}@]           
            [@{if $pull_down_menu_display_products}@]          
            <div class="small-text" style="float: left; padding: 3px;">                       
              <b>[@{#text_products_per_page#}@]</b>     
              <div class="small-text" style="padding: 4px 20px 0 0; white-space: nowrap;">
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('[@{$pull_down_menu_display_products}@]');
                /* ]]> */  
                </script>
                <noscript>
                  [@{$pull_down_menu_display_products_noscript_begin}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /><input type="submit" value="[@{#small_button_text_view#}@]" /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="20" height="10" />[@{$pull_down_menu_display_products_noscript_end}@]
                </noscript>                         
              </div>                                   
            </div> 
            [@{/if}@]            
            [@{if $pull_down_menu}@]          
            <div class="small-text" style="float: left; padding: 3px;">                       
              <b>[@{#text_show#}@]</b>     
              <div class="small-text" style="padding: 4px 20px 0 0; white-space: nowrap;">
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('[@{$pull_down_menu}@]');
                /* ]]> */  
                </script>
                <noscript>
                  [@{$pull_down_menu_noscript_begin}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /><input type="submit" value="[@{#small_button_text_view#}@]" /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="20" height="10" />[@{$pull_down_menu_noscript_end}@]
                </noscript>                         
              </div>                                   
            </div> 
            [@{/if}@]                                                     
            <div id="sort" class="small-text">
              <b>[@{#text_sorting#}@]</b>
              <div style="padding: 4px 20px 0 0"> 
                <div id="sort_box">
                  [@{if $selected_none}@]
                  <ul>
                    <li><img src="[@{$images_path}@]arrow_asc_desc_alternate.gif" alt="" />[@{#text_please_select#}@]&nbsp;</li>
                  </ul>
                  [@{else}@]
                  [@{foreach item=heading_top from=$table_heading_alt}@]
                  [@{if $heading_top.selected}@]
                  <ul>
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
            <div class="clear">&nbsp;</div>            
            <script type="text/javascript">
            /* <![CDATA[ */                                                      
              $('#sort_box').mouseleave(function(){
                $('#sort_list').css('display','none');
              }).mouseenter(function(){
                $(this).css('cursor', 'pointer');                  
                $('#sort_list').show(200); 
              });
              $('#sort').css('display','block');                                                  
            /* ]]> */  
            </script>                                                          
          </div>
          <div class="clear">&nbsp;</div>  
          [@{if $nav_bar_top}@]
          <div class="small-text" style="float: left; padding: 2px; white-space: nowrap;">[@{$nav_bar_number}@]</div>          
          <div class="small-text" style="float: right; padding: 2px; white-space: nowrap;">[@{$nav_bar_result}@]</div>
          <div class="clear">&nbsp;</div>
          [@{/if}@]
          <div style="height: 4px; font-size: 0;">&nbsp;</div> 
          <div class="info-box-central-contents">                  
            [@{foreach name=outer item=table_data from=$table_data_list}@]
            <div class="small-text" style="overflow: hidden; padding: 4px; float: left; width: 32%">    
              <div class="info-box-central-contents" style="padding: 2px; background : #ffffff; background-image : url('[@{$images_path}@]box-product-listing-b-background.jpg'); background-repeat : no-repeat; background-position: right bottom;">
                [@{foreach name=inner item=data from=$table_data.table_inner}@]  
                [@{if $data.case == 'model'}@]<div class="small-text" style="padding: 2px; white-space: nowrap;">[@{if $data.products_model}@]<b>[@{#text_model#}@]&nbsp;</b>[@{$data.products_model}@][@{/if}@]</div>[@{/if}@]
                [@{if $data.case == 'name'}@]<div class="main" style="padding: 2px; text-align: center;"><b><a href="[@{$data.products_link}@]"><span class="text-deco-underline">[@{$data.products_name}@]</span></a></b></div>[@{/if}@]
                [@{if $data.case == 'info'}@]<div class="small-text" style="padding: 2px;">[@{if $data.products_info}@]<b>[@{#text_brief_description#}@]</b><br />[@{$data.products_info}@][@{/if}@]</div>[@{/if}@]
                [@{if $data.case == 'packing_unit'}@]<div class="small-text" style="padding: 2px; white-space: nowrap;">[@{if $data.products_p_unit}@]<b>[@{#text_packing_unit#}@]&nbsp;</b>[@{$data.products_p_unit}@][@{/if}@]</div>[@{/if}@]
                [@{if $data.case == 'manufacturer'}@]<div class="small-text" style="padding: 2px; white-space: nowrap;">[@{if $data.manufacturers_name}@]<b>[@{#text_manufacturer#}@]&nbsp;</b><a href="[@{$data.manufacturers_link}@]"><span class="text-deco-underline">[@{$data.manufacturers_name}@]</span></a>[@{/if}@]</div>[@{/if}@]        
                [@{if $data.case == 'price'}@]
                <div class="small-text" style="padding: 2px; white-space: nowrap;"><b>[@{#text_price#}@]</b>&nbsp;</div>
                
                [@{if $data.price_breaks}@]                
                <div style="width: 100%;">
                  <div style="float: right;">  
                    <table border="0" cellspacing="0" cellpadding="0"> 
                      <tr>
                        <td>                                    
                          <div id="toggle_arrow_[@{$data.products_id}@]" class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;"><a><img onmouseover="this.style.cursor='pointer'" src="[@{$images_path}@]icon_arrow_down.gif" height="10" width="13" alt="" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<b>[@{if $data.price_special}@]<span class="text-deco-line-through">[@{$data.price}@]</span> <span class="product-special-price">[@{$data.price_special}@]</span>[@{else}@][@{$data.price}@][@{/if}@]</b></div>
                          <div class="price-label small-text">  
                            <div id="toggle_[@{$data.products_id}@]" style="padding: 2px; float: right;">
                            <table border="0" cellspacing="0" cellpadding="0">                
                              [@{foreach name=inner_inner item=price_breaks from=$data.price_breaks}@]                             
                              [@{if $smarty.foreach.inner_inner.first}@]
                              <tr>                       
                                <td colspan="2" nowrap="nowrap" class="small-text" align="center" valign="bottom"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />[@{#text_price_breaks#}@]<br /><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                              </tr>                      
                              <tr>
                                <td nowrap="nowrap" class="small-text" align="right" valign="top">[@{#text_quantity_in_price_breaks#}@]</td>
                                <td nowrap="nowrap" class="small-text" align="center" valign="top">[@{#text_price_in_price_breaks#}@]</td>
                              </tr>                                                                   
                              [@{/if}@]                                                     
                              <tr>
                                <td nowrap="nowrap" align="right" class="small-text">[@{$price_breaks.qty}@]<sup>+</sup>&nbsp;&nbsp;</td>
                                <td nowrap="nowrap" align="right" class="small-text"><b>[@{if $price_breaks.price_break_special}@]<span class="text-deco-line-through">[@{$price_breaks.price_break}@]</span> <span class="product-special-price">[@{$price_breaks.price_break_special}@]</span>[@{else}@][@{$price_breaks.price_break}@][@{/if}@]</b></td>
                              </tr>                 
                              [@{/foreach}@]                
                            </table>
                            </div>
                            <div style="height: 0; font-size: 0;">&nbsp;</div> 
                            <div class="clear">&nbsp;</div>                            
                            <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;"> 
                              [@{$data.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />              
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
                          </div>                                         
                        </td>
                      </tr>
                    </table>                     
                    <script type="text/javascript">
                    /* <![CDATA[ */
                      $('#toggle_arrow_[@{$data.products_id}@]').click(function() {
                        $('#toggle_[@{$data.products_id}@]').toggle(400);
                        return false;
                      });
                      $('#toggle_[@{$data.products_id}@]').css('display','none');
                    /* ]]> */  
                    </script>
                  </div> 
                  <div style="height: 0; font-size: 0;">&nbsp;</div> 
                  <div class="clear">&nbsp;</div>
                  <div style="height: 0; font-size: 0;">&nbsp;</div> 
                </div>                                                                               
                [@{else}@]
                <div style="width: 100%;">
                  <div style="float: right;">
                    <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;"><b>[@{if $data.price_special}@]<span class="text-deco-line-through">[@{$data.price}@]</span> <span class="product-special-price">[@{$data.price_special}@]</span>[@{else}@][@{$data.price}@][@{/if}@]</b></div>
                    <div class="price-label small-text" style="padding: 2px; text-align: right; white-space: nowrap;">
                      [@{$data.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />              
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
                  </div>
                  <div style="height: 0; font-size: 0;">&nbsp;</div> 
                  <div class="clear">&nbsp;</div>
                  <div style="height: 0; font-size: 0;">&nbsp;</div>
                </div>       
                [@{/if}@]                

                [@{/if}@]    
                [@{if $data.case == 'quantity'}@]<div class="small-text" style="padding: 2px; white-space: nowrap;"><b>[@{#text_quantity#}@]&nbsp;</b>[@{$data.products_quantity}@]</div>[@{/if}@]
                [@{if $data.case == 'weight'}@]<div class="small-text" style="padding: 2px; white-space: nowrap;">[@{if $data.products_weight > 0}@]<b>[@{#text_weight#}@]&nbsp;</b>[@{$data.products_weight}@]kg[@{/if}@]</div>[@{/if}@]
                [@{if $data.case == 'image'}@]<div class="small-text" style="padding: 2px; text-align: center;"><a href="[@{$data.products_link_image}@]">[@{$data.products_image_small}@]</a></div>[@{/if}@]      
                [@{if $data.case == 'buy_now'}@]
                [@{$data.products_buy_form_begin}@]          
                <div style="width: 100%;">
                  <div style="padding: 6px 0 2px 2px;">
                    <div style="float: right;">
                      <script type="text/javascript">
                      /* <![CDATA[ */
                        document.write('<a href="" onclick="[@{$data.form_name}@].submit(); return false" class="button-buy-now" style="float: left" title=" [@{#button_title_buy_now#}@] "><span>[@{#button_text_buy_now#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                      /* ]]> */  
                      </script>
                      <noscript>
                        <input type="submit" value="[@{#button_text_buy_now#}@]" />
                      </noscript>   
                    </div>                             
                    <div style="margin-top: -2px; padding: 0 4px 0 0; float: right;">
                      [@{$data.products_hidden_field}@][@{$data.products_input_quantity}@]
                    </div>
                    <div style="height: 0; font-size: 0;">&nbsp;</div>  
                    <div class="clear">&nbsp;</div>
                    <div style="height: 0; font-size: 0;">&nbsp;</div>          
                  </div>
                </div>                                 
                [@{$data.form_end}@]
                [@{/if}@]      
                [@{/foreach}@]     
              </div>    
            </div>   
            [@{if ((($smarty.foreach.outer.iteration)%3) == 0) or $smarty.foreach.outer.last}@]
            <div class="clear">&nbsp;</div> 
            [@{/if}@]    
            [@{/foreach}@]
          </div>          
          <div style="height: 4px; font-size: 0;">&nbsp;</div>
          [@{if $nav_bar_bottom}@]
          <div class="small-text" style="float: left; padding: 2px; white-space: nowrap;">[@{$nav_bar_number}@]</div>          
          <div class="small-text" style="float: right; padding: 2px; white-space: nowrap;">[@{$nav_bar_result}@]</div>
          <div class="clear">&nbsp;</div>
          [@{/if}@]
          [@{else}@]
          <div class="info-box-central-contents" style="padding: 2px;">[@{$text_no_products}@]</div>
          [@{/if}@]          
<!-- product_listing_b_eof -->
