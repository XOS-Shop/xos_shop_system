[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.4
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : orders.tpl
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
<!-- orders -->
      <div class="content-wrapper">
      [@{if $edit}@]     
        <section class="content-header">
          <h1>[@{#heading_title_order#}@][@{$order_id}@]</h1>
        </section>
        <section class="content">
          [@{if $message_stack_header_error}@]
          <div class="callout callout-danger" role="alert">
            [@{$message_stack_header_error}@]
          </div>                            
          [@{/if}@]
          [@{if $message_stack_header_warning}@]
          <div class="callout callout-warning" role="alert">
            [@{$message_stack_header_warning}@]
          </div>                            
          [@{/if}@]          
          [@{if $message_stack_header_success}@]
          <div class="callout callout-success" role="alert">
            [@{$message_stack_header_success}@]
          </div>                            
          [@{/if}@]  
          <div class="row">
            <div class="col-xs-12">                               
              <div class="clearfix">
                <a href="[@{$link_filename_orders}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                   
              </div>                                                                                                   
              <div class="box">
                <div class="box-body">                                                                                 
                  <div class="row"> 
                    <div class="col-md-4 pull-left">
                      <div><b>[@{#entry_customer#}@]</b></div>
                      <div>[@{$customer_address}@]</div>                                                   
                    </div>                                
                    <div class="col-md-4 pull-left">
                      <div><b>[@{#entry_billing_address#}@]</b></div>
                      <div>[@{$billing_address}@]</div>                                                 
                    </div>                
                    <div class="col-md-4 pull-left">
                    [@{if $delivery_address}@]
                      <div><b>[@{#entry_shipping_address#}@]</b></div>
                      <div>[@{$delivery_address}@]</div>              
                    [@{/if}@]                   
                    </div>                
                    <div class="col-xs-12">
                      <div>&nbsp;</div>     
                      [@{if $c_id}@]              
                      <div><b>[@{#entry_customer_id#}@]</b>&nbsp;[@{$c_id}@]</div>
                      [@{/if}@]
                      <div><b>[@{#entry_telephone_number#}@]</b>&nbsp;[@{$telephone_number}@]</div>
                      <div><b>[@{#entry_email_address#}@]</b>&nbsp;<a href="mailto:[@{$email_address}@]">[@{$email_address}@]</a></div>                                                                                                     
                    </div>                                
                    <div class="col-xs-12">
                      <div>&nbsp;</div>                 
                      <div><b>[@{#entry_payment_method#}@]</b>&nbsp;[@{$payment_method}@]</div>
                      [@{if $credit_card}@]
                      <div>[@{#entry_credit_card_type#}@]&nbsp;[@{$credit_card_type}@]</div>
                      <div>[@{#entry_credit_card_owner#}@]&nbsp;[@{$credit_card_owner}@]</div>                  
                      <div>[@{#entry_credit_card_number#}@]&nbsp;[@{$credit_card_number}@]</div>
                      <div>[@{#entry_credit_card_expires#}@]&nbsp;[@{$credit_card_expires}@]</div> 
                      [@{/if}@]                                                                                                                        
                    </div>                                                                                 
                  </div>                                                            
                  <div class="row">
                    <div class="col-xs-12">
                      <div style="overflow: auto;">                              
                        <table class="table-order">     
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                          </tr>       
                          <tr>
                            <td><table class="table-order-products">        
                              <tr class="data-table-heading-row">
                              [@{if $tax_groups}@]
                                <th>[@{#table_heading_products_model#}@]</th>
                                <th colspan="2">[@{#table_heading_products#}@]</th>        
                                <th class="text-right">[@{#table_heading_tax#}@]</th>    
                                <th>&nbsp;</th>
                                <th class="text-right">[@{#table_heading_price#}@]</th>
                                <th>&nbsp;</th>
                                <th class="text-center">[@{#table_heading_quantity#}@]</th>
                                <th>&nbsp;</th>
                                <th class="text-right">[@{#table_heading_total#}@]</th>
                              [@{else}@]          
                                <th>[@{#table_heading_products_model#}@]</th>
                                <th colspan="2">[@{#table_heading_products#}@]</th>        
                                <th class="text-right">[@{#table_heading_price#}@]</th>
                                <th>&nbsp;</th>
                                <th class="text-center">[@{#table_heading_quantity#}@]</th>
                                <th>&nbsp;</th>
                                <th class="text-right">[@{#table_heading_total#}@]</th>          
                              [@{/if}@]  
                              </tr>
                              <tr>
                                <td colspan="[@{if $tax_groups}@]10[@{else}@]8[@{/if}@]"><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                              </tr>           
                             [@{foreach name=outer item=order_product from=$order_products}@]
                              <tr>
                                <td colspan="[@{if $tax_groups}@]10[@{else}@]8[@{/if}@]">&nbsp;</td>
                              </tr> 
                              <tr>
                                <td><b>[@{$order_product.model}@]</b></td>                      
                                <td>
                                  <table>
                                    <tr>                                                        
                                      <td>
                                        <table>
                                          <tr> 
                                            <td>&nbsp;</td>                                  
                                            <td><b>[@{$order_product.name}@]</b>[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@][@{/foreach}@]</td>                                        
                                          </tr>
                                        </table>                 
                                      </td>
                                      <td>&nbsp;</td>
                                      <td class="text-right">
                                      [@{if $order_product.products_attributes_option_price}@]
                                        <table> 
                                          <tr>
                                            <td>&nbsp;</td>              
                                            <td class="text-center">[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price_prefix}@][@{/if}@][@{/foreach}@]</td>
                                            <td class="text-right">[@{$order_product.price}@][@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price}@][@{/if}@][@{/foreach}@]</td>
                                          </tr>
                                        </table>  
                                      [@{/if}@]  
                                      </td>                                                            
                                    </tr>                                                
                                    <tr>            
                                      <td colspan="3">[@{if $order_product.packaging_unit}@]&nbsp;[@{#text_packaging_unit#}@]&nbsp;[@{$order_product.packaging_unit}@][@{/if}@]</td>                                        
                                    </tr>                                                                                                                                                 
                                  </table>                 
                                </td>                                    
                                <td>&nbsp;</td>
                                [@{if $tax_groups}@]        
                                <td class="text-right">[@{$order_product.tax}@]%</td>
                                <td>&nbsp;</td>
                                [@{/if}@]
                                <td class="text-right"><b>[@{$order_product.final_single_price}@]</b></td>
                                <td>&nbsp;</td>
                                <td class="text-center"><b>[@{$order_product.qty}@]</b></td>
                                <td>&nbsp;</td>
                                <td class="text-right"><b>[@{$order_product.final_price}@]</b></td>
                              </tr>
                             [@{/foreach}@]
                              <tr>
                                <td colspan="[@{if $tax_groups}@]10[@{else}@]8[@{/if}@]">&nbsp;</td>
                              </tr>         
                            </table></td>
                          </tr>       
                          <tr>
                            <td><table class="pull-right clearfix">
                             [@{foreach item=order_total from=$order_totals}@]
                              <tr>
                                <td class="text-right">[@{if $tax_groups && $order_total.tax > -1}@]<span style="color : #ff0000;">[@{#table_heading_tax#}@]&nbsp;([@{$order_total.tax}@]%)&nbsp;</span>[@{/if}@][@{$order_total.title}@]</td>
                                <td class="text-right">[@{$order_total.text}@]</td>
                              </tr>
                             [@{/foreach}@]
                            </table></td>
                          </tr>                      
                          <tr>
                            <td><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                          </tr>                  
                          <tr>
                            <td><br><b>[@{#text_order_history#}@]</b><br><table class="table table-bordered">
                              <tr>
                                <th class="text-center">[@{#table_heading_date_added#}@]</th>
                                <th class="text-center">[@{#table_heading_customer_notified#}@]</th>
                                <th>[@{#table_heading_status#}@]</th>
                                <th>[@{#table_heading_comments#}@]</th>
                              </tr>
                              [@{foreach item=order_history from=$orders_history}@]
                              <tr>
                                <td class="text-center">[@{$order_history.date_added}@]</td>
                                <td class="text-center">[@{if $order_history.customer_notified}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
                                <td>[@{$order_history.status}@]</td>
                                <td>[@{$order_history.comments|default:'&nbsp;'}@]</td>
                              </tr>
                              [@{foreachelse}@]
                              <tr>
                                <td colspan="4">[@{#text_no_order_history#}@]</td>
                              </tr>
                              [@{/foreach}@]
                            </table></td>
                          </tr>    
                          <tr>
                            <td><b>[@{#table_heading_comments#}@]</b>&nbsp;<small>([@{#text_language#}@] [@{$order_language_name}@])</small></td>
                          </tr>
                          <tr>
                            <td>[@{$form_begin_status}@]<table>
                              <tr>
                                <td>[@{$textarea_comments|replace:'<textarea':'<textarea class="form-control"'}@]</td>
                              </tr>       
                              <tr>
                                <td><table>
                                  <tr>
                                    <td><br><b>[@{#entry_status#}@]</b>&nbsp;[@{$pull_down_status|replace:'<select':'<select class="form-control"'}@]</td>
                                  </tr>
                                  [@{if $send_emails}@]
                                  <tr>
                                    <td><br><label style="cursor: pointer;">[@{#entry_notify_customer#}@]&nbsp;[@{$checkbox_notify}@]</label>&nbsp; &nbsp; &nbsp;<label style="cursor: pointer;">[@{#entry_notify_comments#}@]&nbsp;[@{$checkbox_notify_comments}@]</label></td>
                                  </tr>
                                  [@{/if}@]
                                </table></td>
                              </tr>
                              <tr>                      
                                <td><a href="" onclick="new_status.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a></td>
                              </tr>
                            </table>[@{$form_end}@]</td>
                          </tr>      
                        </table>                  
                      </div>            
                    </div>                                                               
                  </div>
                </div>                                                               
              </div>
              <a href="[@{$link_filename_orders}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>              
              <a href="javascript:popupWindow('[@{$link_filename_orders_packingslip}@]')" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_orders_packingslip#}@] ">[@{#button_text_orders_packingslip#}@]</a>
              <a href="javascript:popupWindow('[@{$link_filename_orders_invoice}@]')" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_orders_invoice#}@] ">[@{#button_text_orders_invoice#}@]</a>                                        
            </div>            
          </div>     
        </section>               
      [@{else}@] 
        <section class="content-header clearfix">
          <h1 class="pull-left">[@{#heading_title#}@]</h1>
          <div class="pull-right">             
            <div class="pull-right" style="margin-left: 20px">[@{$form_begin_status}@]<label class="control-label text-right pull-left" for="status_id">[@{#heading_title_status#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$pull_down_status|replace:'<select':'<select class="form-control" id="status_id"'}@][@{$hidden_field_session}@]</div>[@{$form_end}@]</div>
            <div class="pull-right" style="margin-left: 20px">[@{$form_begin_orders}@]<label class="control-label text-right pull-left" for="search_id">[@{#heading_title_search#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$input_oid|replace:'<input':'<input class="form-control" id="search_id"'}@][@{$hidden_action}@][@{$hidden_field_session}@]</div>[@{$form_end}@]</div>
          </div>
        </section> 
        <section class="content">
          [@{if $message_stack_header_error}@]
          <div class="callout callout-danger" role="alert">
            [@{$message_stack_header_error}@]
          </div>                            
          [@{/if}@]
          [@{if $message_stack_header_warning}@]
          <div class="callout callout-warning" role="alert">
            [@{$message_stack_header_warning}@]
          </div>                            
          [@{/if}@]          
          [@{if $message_stack_header_success}@]
          <div class="callout callout-success" role="alert">
            [@{$message_stack_header_success}@]
          </div>                            
          [@{/if}@]     
          <div class="row">
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_customers#}@]</th>
                      <th class="text-right">[@{#table_heading_order_total#}@]</th>
                      <th class="text-center">[@{#table_heading_date_purchased#}@]</th>
                      <th class="text-right">[@{#table_heading_status#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>                     
                    </tr>
                    [@{foreach item=order from=$orders}@]
                    [@{if $order.selected}@]                             
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$order.link_filename_orders}@]'">
                      <td><a href="[@{$order.link_filename_orders_action_edit}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a>&nbsp;[@{$order.customers_name}@]</td>
                      <td class="text-right">[@{$order.order_total}@]</td>
                      <td class="text-center">[@{$order.date_purchased}@]</td>
                      <td class="text-right">[@{$order.order_status_name}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$order.link_filename_orders}@]'">
                      <td><a href="[@{$order.link_filename_orders_action_edit}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a>&nbsp;[@{$order.customers_name}@]</td>
                      <td class="text-right">[@{$order.order_total}@]</td>
                      <td class="text-center">[@{$order.date_purchased}@]</td>
                      <td class="text-right">[@{$order.order_status_name}@]</td>
                      <td class="text-right"><a href="[@{$order.link_filename_orders}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]
                  </table>
                </div>
              </div>
              <div class="clearfix pagination-wrapper">
                <div class="pull-left">[@{$nav_bar_number}@]</div>
                <div class="pull-right">[@{$nav_bar_result}@]</div>
              </div>             
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_orders}@]         
            </div>              
          </div>
        </section>                
      [@{/if}@]        
      </div>              
<!-- orders_eof -->