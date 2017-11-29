[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.7
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
* filename   : shopping_cart.tpl
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

<!-- shopping_cart -->
          <h1 class="text-orange">[@{#heading_title#}@]</h1>
          <div class="div-spacer-h10"></div>  
    [@{if $products_in_cart}@]
<script type="text/javascript">
  $(function(){
    $("input[name='cart_quantity[]']").before('<a class="glyphicon glyphicon-plus btn-plus" title=" [@{#text_update_product#}@] "></a>').after('<a class="glyphicon glyphicon-minus btn-minus" title=" [@{#text_update_product#}@] "></a>');
    $(".btn-plus, .btn-minus").click(function() {
      var oldValue = parseInt($(this).parent().find("input[name='cart_quantity[]']").val());
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
    $(this).parent().find("input[name='cart_quantity[]']").val(newVal);
    cart_quantity.submit();
    });
  }); 
</script>     
    [@{$form_begin}@] 
          [@{foreach name=outer item=product from=$products}@]          
          [@{if $smarty.foreach.outer.first}@]
          <hr>
          [@{/if}@]          
          <div class="row">
            <div class="col-sm-12 col-md-2 text-nowrap"><a href="[@{$product.link_filename_product_info}@]">[@{$product.products_image|replace:'<img ':'<img class="img-responsive" '}@]</a></div>           
            <div class="col-sm-10">
              <table class="table-border-cellspacing cellpadding-0px">
                <tr>     
                  <td style="vertical-align: top;">
                    <table class="table-border-cellspacing cellpadding-0px"> 
                      <tr>          
                        <td>
                          <a href="[@{$product.link_filename_product_info}@]"><b>[@{$product.products_name}@]&nbsp;[@{$product.stock_check}@]</b></a>
                        </td> 
                        <td class="text-nowrap">&nbsp;</td>                           
                        <td class="text-nowrap text-right" style="vertical-align: bottom;">
                          [@{if $product.products_attributes_option_price}@][@{$product.products_price}@][@{else}@]&nbsp;[@{/if}@]
                        </td>                                        
                      </tr>                       
                      [@{foreach name=inner item=product_attribute from=$product.products_attributes}@] 
                      <tr>            
                        <td>
                          <span class="text-nowrap">[@{$product_attribute.products_options_name}@]:</span> <span class="text-nowrap">[@{$product_attribute.products_options_values_name}@]</span>[@{$product_attribute.hidden_field}@]
                        </td> 
                        <td class="text-nowrap" style="vertical-align: bottom;">
                          [@{if $product_attribute.options_values_price}@]&nbsp;&nbsp;[@{$product_attribute.price_prefix}@]&nbsp;[@{else}@]&nbsp;[@{/if}@]
                        </td>                            
                        <td class="text-nowrap text-right" style="vertical-align: bottom;">
                          [@{if $product_attribute.options_values_price}@][@{$product_attribute.options_values_price}@][@{else}@]&nbsp;[@{/if}@]
                        </td>                                                                                            
                      </tr>
                      [@{/foreach}@]                         
                    </table>                 
                  </td> 
                </tr>                  
                <tr>         
                  <td>
                  <div class="div-spacer-h4"></div><span class="text-nowrap">[@{#table_heading_model#}@]:</span> <span class="text-nowrap">[@{$product.products_model}@]</span><br />
                  [@{if $product.products_packaging_unit}@]
                    <div class="div-spacer-h4"></div><span class="text-nowrap">[@{#text_packaging_unit#}@]</span> <span class="text-nowrap">[@{$product.products_packaging_unit}@]</span><br />
                  [@{/if}@]                    
                  [@{if $product.link_filename_popup_content_products_delivery_time && $product.products_delivery_time}@]
                    <div class="div-spacer-h4"></div><span class="text-nowrap"><b>[@{#text_delivery_time#}@]</b></span> <span class="text-nowrap"><a href="[@{$product.link_filename_popup_content_products_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{$product.products_delivery_time}@]</span></a></span><br />
                  [@{elseif $product.products_delivery_time}@]
                    <div class="div-spacer-h4"></div><span class="text-nowrap"><b>[@{#text_delivery_time#}@]</b></span> <span class="text-nowrap">[@{$product.products_delivery_time}@]</span><br />
                  [@{/if}@]                                                           
                    <div class="div-spacer-h4"></div>
                  </td>                                        
                </tr>                                                    
              </table>                 
            </div>
          </div>  
          <div class="row">                                                                          
            [@{if $tax_groups}@]
            <div class="col-xs-12 col-md-2 hidden-sm">&nbsp;</div>
            <div class="col-xs-12 col-sm-2 text-nowrap text-right"><div class="text-nowrap text-right">[@{#table_heading_tax#}@]</div><div class="div-spacer-h4"></div>([@{$product.products_tax}@]%)</div>
            <div class="col-xs-12 visible-xs div-spacer-h10"></div>
            [@{else}@]
            <div class="col-xs-12 col-sm-2 col-md-4">&nbsp;</div>
            [@{/if}@]    
            <div class="col-xs-4 col-sm-2 text-nowrap text-right"><div class="text-nowrap text-right">[@{#table_heading_price#}@]</div><div class="div-spacer-h4"></div><b>[@{$product.products_final_single_price}@]</b></div>
            <div class="col-xs-4 col-sm-3 col-md-2 form-inline wrapper-for-input-qty text-nowrap text-center"><div class="text-nowrap text-center">[@{#table_heading_quantity#}@]&nbsp;&nbsp;</div>[@{$product.input_and_hidden_fields_quantity}@]</div>
            <div class="col-sm-1 hidden-xs" style="white-space: nowrap;"><div class="text-nowrap">&nbsp;</div><button class="btn btn-link btn-xs" title=" [@{#text_update_product#}@] "><span class="glyphicon glyphicon-refresh" style="font-size:22px; font-weight:bold; color:#5cb85c;"></span></button></div>
            <div class="col-sm-1 hidden-xs" style="white-space: nowrap;"><div class="text-nowrap">&nbsp;</div><a href="[@{$product.link_remove_product}@]"><span class="glyphicon glyphicon-trash" style="font-size:22px; color:#fb716d;" title=" [@{#text_remove_product#}@] "></span></a></div>
            <div class="col-xs-4 col-sm-3 col-md-2 text-nowrap text-right"><div class="text-nowrap text-right">[@{#table_heading_total#}@]</div> <div class="div-spacer-h4"></div><b>[@{$product.products_final_price}@]</b></div>          
          </div>                  
          <div class="row visible-xs-block"> 
            <div class="div-spacer-h4"></div>
            <div class="col-xs-4">&nbsp;</div>
            <div class="col-xs-4 text-nowrap text-center"><button class="btn btn-link btn-xs" title=" [@{#text_update_product#}@] "><span class="glyphicon glyphicon-refresh" style="font-size:22px; font-weight:bold; color:#5cb85c;"></span></button>&nbsp;&nbsp;</div>
            <div class="col-xs-4 text-nowrap text-right"><a href="[@{$product.link_remove_product}@]"><span class="glyphicon glyphicon-trash" style="font-size:22px; color:#fb716d;" title=" [@{#text_remove_product#}@] "></span></a></div>
          </div>          
          <hr>
          [@{/foreach}@]                  
          <div class="div-spacer-h10"></div>
          <div class="pull-right">
            <table class="table-border-cellspacing cellpadding-0px">     
              [@{if $sub_total_discount}@]
              <tr>
                <td class="text-nowrap text-right"><span class="red-mark"><b>[@{$discount_value}@] [@{#sub_title_sub_total_dicount#}@]</b></span></td>
                <td class="text-nowrap text-right">&nbsp;<span class="red-mark"><b>[@{$sub_total_discount}@]</b></span>&nbsp;</td>
              </tr> 
              [@{/if}@]       
              <tr>
                <td class="text-nowrap text-right"><b>[@{#sub_title_sub_total#}@]</b></td>
                <td class="text-nowrap text-right">&nbsp;<b>[@{$sub_total}@]</b>&nbsp;</td>
              </tr>
              [@{foreach item=sub_total_tax_group from=$sub_total_tax_groups}@]
              <tr>
                <td class="text-right">[@{$sub_total_tax_group.title}@]</td>
                <td class="text-nowrap text-right" style="vertical-align: bottom;">&nbsp;[@{$sub_total_tax_group.text}@]&nbsp;</td>
              </tr>
              [@{foreachelse}@]
              <tr>
                <td colspan="2" class="text-nowrap text-right">[@{#text_tax_without_vat#}@]&nbsp;</td>
              </tr>            
              [@{/foreach}@]   
            </table>  
          </div>
          <div class="clearfix invisible"></div>
          [@{if $out_of_stock == 'can_checkout'}@]
            <div class="stock-warning text-center"><br />[@{eval var = #out_of_stock_can_checkout#}@]</div>     
          [@{elseif $out_of_stock == 'cant_checkout'}@]          
            <div class="stock-warning text-center"><br />[@{eval var = #out_of_stock_cant_checkout#}@]</div>      
          [@{/if}@]            
          <div class="div-spacer-h20"></div>                          
          <div class="well well-sm clearfix">
            <div class="row">                             
              <div class="col-sm-4 hidden-xs">
                &nbsp;                         
              </div>                                 
              <div class="col-sm-4">
                <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_continue_shopping#}@] ">[@{#button_text_continue_shopping#}@]</a>
              </div>                                                        
              <div class="col-sm-4">
                <a href="[@{$link_filename_checkout_shipping}@]" class="btn btn-success pull-right" title=" [@{#button_title_checkout#}@] ">[@{#button_text_checkout#}@]</a>
              </div> 
            </div>                                                                                                                                           
          </div>
          <div style="margin: -10px 15px 0 15px;">
          [@{foreach name=checkout_methods item=alternative_checkout_method from=$alternative_checkout_methods}@]
            [@{if $smarty.foreach.checkout_methods.first}@]
            <div class="pull-right"><b>[@{#text_alternative_checkout_methods#}@]</b></div>
            <div class="clearfix invisible"></div>   
            [@{/if}@]
            <div class="div-spacer-h10"></div>
            <div class="pull-right">[@{$alternative_checkout_method.value}@]</div>
            <div class="clearfix invisible"></div>
            <div class="div-spacer-h20"></div>
          [@{/foreach}@]  
          </div>                      
    [@{$form_end}@]        
    [@{else}@]
          <div class="panel panel-default clearfix">           
            <div class="panel-body"> 
              <div>[@{#text_cart_empty#}@]</div>        
            </div>               
          </div>    
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_filename_default}@]" class="btn btn-primary pull-right" title=" [@{#button_title_continue#}@] ">[@{#button_text_continue#}@]</a>                                                                                                                                                                                                        
          </div>                                                        
    [@{/if}@]  
<!-- shopping_cart_eof -->