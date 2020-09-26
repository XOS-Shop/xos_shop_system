[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : darkly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop template built with Bootstrap3 and theme darkly                                                                    
* filename   : checkout_confirmation.tpl
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

<!-- checkout_confirmation -->
    [@{$form_begin}@]
          <h1 class="text-orange">[@{#heading_title#}@]</h1>
          <div class="row">                                          
            <div class="col-sm-3 col-xs-6 checkout-bar-from text-center"><span class="lead">1</span><br /><a href="[@{$link_filename_checkout_shipping}@]" class="checkout-bar-from">[@{#checkout_bar_delivery#}@]</a></div>
            <div class="col-sm-3 col-xs-6 checkout-bar-from text-center"><span class="lead">2</span><br /><a href="[@{$link_filename_checkout_payment}@]" class="checkout-bar-from">[@{#checkout_bar_payment#}@]</a></div>
            <div class="clearfix visible-xs-block"></div>
            <div class="visible-xs-block div-spacer-h10"></div>
            <div class="col-sm-3 col-xs-6 checkout-bar-current text-center"><span class="lead"><b>3</b></span><br /><b>[@{#checkout_bar_confirmation#}@]</b></div>
            <div class="col-sm-3 col-xs-6 checkout-bar-to text-center"><span class="lead">4</span><br />[@{#checkout_bar_finished#}@]</div>
          </div>
          <div class="div-spacer-h20"></div>           
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div class="row"> 
                <div class="col-md-6 pull-left">
                  <div><b>[@{#heading_billing_address#}@]</b> <a href="[@{$link_filename_checkout_payment_address}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>
                  <div>[@{$billing_address}@]</div>
                  <div><b>[@{#heading_payment_method#}@]</b> <a href="[@{$link_filename_checkout_payment}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>
                  <div>[@{$payment_method}@]</div>
                  <div class="div-spacer-h20 visible-sm-block visible-xs-block"></div>                
                </div>
                [@{if $delivery_address}@]                
                <div class="col-md-6 pull-left">
                  <div><b>[@{#heading_delivery_address#}@]</b> <a href="[@{$link_filename_checkout_shipping_address}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>
                  <div>[@{$delivery_address}@]</div>               
                  [@{if $shipping_method}@]                           
                  <div><b>[@{#heading_shipping_method#}@]</b> <a href="[@{$link_filename_checkout_shipping}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>
                  <div>[@{$shipping_method}@]</div>             
                  [@{/if}@]                 
                </div>
                [@{/if}@]                
              </div> 
            </div>               
          </div>                             
          <div><b>[@{#heading_products#}@]</b> <a href="[@{$link_filename_shopping_cart}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div>
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              [@{foreach name=outer item=order_product from=$order_products}@]                    
              <div class="row">          
                <div class="col-sm-10">
                  <table class="table-border-cellspacing cellpadding-0px">
                    <tr>     
                      <td style="vertical-align: top;">
                        <table class="table-border-cellspacing cellpadding-0px"> 
                          <tr>          
                            <td>
                              <b>[@{$order_product.name}@]</b>
                            </td> 
                            <td class="text-nowrap">&nbsp;</td>                           
                            <td class="text-nowrap text-right" style="vertical-align: bottom;">
                              [@{if $order_product.products_attributes_option_price}@][@{$order_product.price}@][@{else}@]&nbsp;[@{/if}@]
                            </td>                                        
                          </tr>                       
                          [@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@] 
                          <tr>            
                            <td>
                              <span class="text-nowrap">[@{$product_attribute.option_name}@]:</span> <span class="text-nowrap">[@{$product_attribute.option_value_name}@]</span>
                            </td> 
                            <td class="text-nowrap" style="vertical-align: bottom;">
                              [@{if $product_attribute.option_price}@]&nbsp;&nbsp;[@{$product_attribute.option_price_prefix}@]&nbsp;[@{else}@]&nbsp;[@{/if}@]
                            </td>                            
                            <td class="text-nowrap text-right" style="vertical-align: bottom;">
                              [@{if $product_attribute.option_price}@][@{$product_attribute.option_price}@][@{else}@]&nbsp;[@{/if}@]
                            </td>                                                                                            
                          </tr>
                          [@{/foreach}@]                         
                        </table>                 
                      </td> 
                    </tr>                  
                    <tr>         
                      <td>
                      <div class="div-spacer-h4"></div><span class="text-nowrap">[@{#table_heading_products_model#}@]:</span> <span class="text-nowrap">[@{$order_product.model}@]</span><br />
                      [@{if $order_product.packaging_unit}@]
                        <div class="div-spacer-h4"></div><span class="text-nowrap"><em>[@{#text_packaging_unit#}@]</em></span> <span class="text-nowrap"><em>[@{$order_product.packaging_unit}@]</em></span><br />
                      [@{/if}@]                     
                      [@{if $order_product.link_filename_popup_content_delivery_time && $order_product.delivery_time}@]
                        <div class="div-spacer-h4"></div><span class="text-nowrap"><em><b>[@{#text_delivery_time#}@]</b></em></span> <span class="text-nowrap"><a href="[@{$order_product.link_filename_popup_content_delivery_time}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline"><em>[@{$order_product.delivery_time}@]</span></em></a></span><br />
                      [@{elseif $order_product.delivery_time}@]
                        <div class="div-spacer-h4"></div><span class="text-nowrap"><em><b>[@{#text_delivery_time#}@]</b></em></span> <span class="text-nowrap"><em>[@{$order_product.delivery_time}@]</em></span><br />
                      [@{/if}@]                                                                              
                        <div class="div-spacer-h4"></div>
                      </td>                                        
                    </tr>                                                    
                  </table>                 
                </div>
              </div>  
              <div class="row">                                                                         
                [@{if $tax_groups}@]
                <div>&nbsp;</div>                                 
                <div class="col-xs-12 col-sm-3 text-nowrap text-right"><div class="text-nowrap text-right">[@{#table_heading_tax#}@]</div><div class="div-spacer-h4"></div>([@{$order_product.tax}@]%)</div>
                <div class="col-xs-12 visible-xs div-spacer-h10"></div>
                [@{else}@]
                <div class="visible-sm">&nbsp;</div>
                <div class="col-xs-12 col-sm-3">&nbsp;</div>
                [@{/if}@]    
                <div class="col-xs-4 col-sm-3 text-nowrap text-right"><div class="text-nowrap text-right">[@{#table_heading_price#}@]</div><div class="div-spacer-h4"></div><b>[@{$order_product.final_single_price}@]</b></div>
                <div class="col-xs-4 col-sm-3 col-md-4 form-inline wrapper-for-input-qty text-nowrap text-center"><div class="text-nowrap text-center">[@{#table_heading_quantity#}@]</div><b>[@{$order_product.qty}@]</b></div>
                <div class="col-xs-4 col-sm-3 col-md-2 text-nowrap text-right"><div class="text-nowrap text-right">[@{#table_heading_total#}@]</div> <div class="div-spacer-h4"></div><b>[@{$order_product.final_price}@]</b></div>          
              </div>                          
              <hr>
              [@{/foreach}@]           
              <div class="div-spacer-h10"></div>
              <div class="pull-right">
                <table class="table-border-cellspacing cellpadding-0px">     
                  [@{foreach item=order from=$order_totals}@] 
                  <tr>
                    <td class="text-right">[@{if $tax_groups && $order.totals_tax > -1}@]<span class="red-mark">[@{#table_heading_tax#}@]&nbsp;([@{$order.totals_tax}@]%)</span>[@{/if}@] [@{$order.totals_title|replace:'#ff0000':'#fb716d'}@]</td>
                    <td class="text-nowrap text-right" style="vertical-align: bottom;">&nbsp;[@{$order.totals_text|replace:'#ff0000':'#fb716d'}@]</td>
                  </tr>           
                  [@{/foreach}@]   
                </table>  
              </div>
              <div class="clearfix invisible"></div>          
            </div>               
          </div>                                                          
     [@{if $comments}@]
          <div><b>[@{#heading_order_comments#}@]</b> <a href="[@{$link_filename_checkout_payment}@]"><span class="order-edit">([@{#text_edit#}@])</span></a></div> 
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div>[@{$comments}@][@{$hidden_field_comments}@]</div> 
            </div>               
          </div>           
     [@{/if}@]                              
     [@{if $confirmation}@]
          <div><b>[@{#heading_payment_information#}@]</b></div>
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              [@{if $confirmation_title}@]
              <div><b>[@{$confirmation_title}@]</b></div>
              <div class="div-spacer-h10"></div>                                                        
              [@{/if}@]          
              [@{foreach item=confirmation_field from=$confirmation_fields}@]   
              <div>[@{$confirmation_field.title}@]</div>
              <div>[@{$confirmation_field.field}@]</div>
              <div class="div-spacer-h10"></div>                                                   
              [@{/foreach}@]
            </div>               
          </div>                  
     [@{/if}@]     
     [@{if $link_filename_popup_content_8}@]
          <div><b>[@{#table_heading_conditions#}@]</b></div>          
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div>              
                <script type="text/javascript">          
                  document.write('<a href="[@{$link_filename_popup_content_8}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a><a style="margin: 0 0 0 30px;" href="[@{$link_filename_popup_content_8}@]" target="_blank"><img src="[@{$images_path}@]print_red.gif" style="vertical-align:middle" title=" [@{#text_printable_version#}@] " alt="[@{#text_printable_version#}@]" /></a>'); 
                </script>             
                <noscript>
                  <a href="[@{$link_filename_popup_content_8}@]" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a>
                </noscript>   
              </div>    
            </div>               
          </div>                             
     [@{/if}@] 
          <div class="well well-sm clearfix">
              [@{$input_process_button}@]                     
              <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_confirm_order#}@]" /> 
          </div>                       
    [@{$form_end}@]
<!-- checkout_confirmation_eof -->
