[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : sandstone-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.7
* descrip    : xos-shop default template built with Bootstrap3                                                                    
* filename   : account_history_info.tpl
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

<!-- account_history_info -->
          <h1 class="text-orange">[@{#heading_title#}@]</h1>                                  
          <div><b>[@{eval var=#heading_order_number#}@] <small>([@{$orders_status}@])</small></b></div>
          <div class="text-nowrap pull-left">[@{#heading_order_date#}@] [@{$date_purchased}@]&nbsp;</div>
          <div class="text-nowrap text-right pull-right">[@{#heading_order_total#}@] [@{$order_total}@]</div> 
          <div class="clearfix invisible"></div>     
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div class="row"> 
                <div class="col-md-6 pull-left">
                  <div><b>[@{#heading_billing_address#}@]</b></div>
                  <div>[@{$billing_address}@]</div>
                  <div><b>[@{#heading_payment_method#}@]</b></div>
                  <div>[@{$payment_method}@]</div>
                  <div class="div-spacer-h20 visible-sm-block visible-xs-block"></div>                
                </div>
                [@{if $delivery_address}@]                
                <div class="col-md-6 pull-left">
                  <div><b>[@{#heading_delivery_address#}@]</b></div>
                  <div>[@{$delivery_address}@]</div>               
                  [@{if $shipping_method}@]                           
                  <div><b>[@{#heading_shipping_method#}@]</b></div>
                  <div>[@{$shipping_method}@]</div>             
                  [@{/if}@]                 
                </div>
                [@{/if}@]                
              </div> 
            </div>               
          </div>                                    
          <div><b>[@{#heading_ordered_products#}@]</b></div>                
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
                    <td class="text-right">[@{if $tax_groups && $order.totals_tax > -1}@]<span class="red-mark">[@{#table_heading_tax#}@]&nbsp;([@{$order.totals_tax}@]%)</span>[@{/if}@] [@{$order.totals_title}@]</td>
                    <td class="text-nowrap text-right" style="vertical-align: bottom;">&nbsp;[@{$order.totals_text}@]</td>
                  </tr>           
                  [@{/foreach}@]   
                </table>  
              </div>
              <div class="clearfix invisible"></div>          
            </div>               
          </div>                           
          <div><b>[@{#heading_order_history#}@]</b></div>           
          <div class="panel panel-default clearfix">           
            <div class="panel-body">            
              [@{foreach item=status from=$statuses}@]
              <div class="row">              
                <div class="col-lg-2"><b>[@{$status.order_date_added}@]</b>&nbsp;</div>
                <div class="col-lg-2"><b>[@{$status.order_status_name}@]</b>&nbsp;</div>
                <div class="col-lg-8">
                  [@{$status.order_comments}@]
                  <div class="div-spacer-h20 hidden-lg"></div>
                </div>      
              </div>                                  
              [@{/foreach}@]                                     
            </div>               
          </div>          
                            
          [@{$downloads}@]      
        
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                                                                                                                                                                        
          </div>                  
<!-- account_history_info_eof -->
