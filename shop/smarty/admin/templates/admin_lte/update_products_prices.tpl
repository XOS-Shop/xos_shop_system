[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.1
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : update_products_prices.tpl
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
<!-- update_products_prices -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>[@{#heading_title#}@]</h1>
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
        [@{if $set_filter}@]           
          <div class="row">
            <div class="col-xs-12">                                   
              [@{$form_begin_filter_update_products_prices}@]
              <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-1">
                      <b>[@{#table_heading_set_filter#}@]</b><br><br>                  
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-6 col-lg-3">
                      <div class="form-group text-nowrap">
                        <label><small>[@{#table_heading_categories#}@]</small></label>
                        [@{$pull_down_menu_categories_or_pages_id|replace:'<select':'<select class="form-control input-sm"'}@]
                      </div>
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-6 col-lg-3">
                      <div class="form-group text-nowrap">
                        <label><small>[@{#table_heading_manufacturers#}@]</small></label>
                        [@{$pull_down_menu_manufacturers_id|replace:'<select':'<select class="form-control input-sm"'}@]
                      </div>
                    </div>                                        
                    <div class="col-xs-12 col-sm-3 col-lg-1">
                      <div class="form-group text-nowrap">
                        <label><small>[@{#table_heading_max_rows#}@]</small></label>
                        [@{$pull_down_menu_max_rows|replace:'<select':'<select class="form-control input-sm"'}@]
                      </div>
                    </div>                                        
                    <div class="col-xs-12 col-sm-3 col-lg-2">
                      <div class="form-group text-nowrap">
                        <label class="text-center">
                          <small>[@{#table_heading_only_specials#}@]</small>
                          <br>[@{$checkbox_specials_only}@]
                        </label>
                      </div>
                    </div>                                        
                    <div class="col-xs-12 col-sm-6 col-lg-2">
                      <br>
                      <a href="" onclick="filter_update_products_prices.submit(); return false" class="btn btn-success pull-right" title=" [@{#button_title_select#}@] ">[@{#button_text_select#}@]</a>
                    </div>
                  </div>
                </div>
              </div>
              [@{$hidden_field_add_related_product_ID}@][@{$hidden_field_session}@][@{$form_end}@]                      
            </div>            
          </div>           
        [@{/if}@]
[@{if $info_prices == 'yes'}@]        
          <div class="row">
[@{$javascript}@]
            [@{$form_begin|replace:'action=""':''}@]          
            <div class="col-sm-10 col-sm-offset-2">            
              <div class="form-horizontal">                               
                <div class="form-group clearfix">
                  <div class="col-lg-2 col-md-3 col-sm-3 control-label text-nowrap"><b>[@{#text_products_tax_rates#}@]</b></div>
                  <div class="col-lg-8 col-md-9 col-sm-9 col-xs-10">
                    [@{$pull_down_tax_rates|replace:'<select ':'<select class="form-control input-sm" '|replace:'style="font-size : 9px; font-weight : normal;"':'style="max-width : 350px;"'}@]
                  </div>
                </div>
              </div>                                     
            </div>             
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">                                        
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#text_product_id#}@]</th>
                      <th>[@{#text_quickfind_code#}@]</th>
                      <th>[@{#text_product_name#}@]</th>
                      <th>[@{#text_product_price#}@]</th>
                    </tr>                                                 
                    [@{foreach name=outer item=product from=$products}@]                  
                    <tr onclick="document.location.href='[@{$product.link_to_edit_related_product}@]'">
                      <td>[@{$product.products_id}@]</td>
                      <td>[@{$product.products_model}@]</td>
                      <td>[@{$product.products_status_image}@]&nbsp;[@{$product.products_name}@]</td>                                                     
                      <td><table>                              
                        [@{foreach name=inner item=products_prices from=$product.products_prices}@]
                        <tr>
                          <td><b>[@{$products_prices.name}@]</b></td>
                        </tr>                                       
                        <tr>
                          <td style="padding-left: 20px;"><table class="price-table">
                            <tr>                  
                              <td >[@{#text_products_price_net#}@]</td>
                              <td>[@{#text_products_price_gross#}@]</td>                                                                               
                              [@{if $products_prices.is_special}@]
                              <td style="color: red;">[@{#text_specials#}@]</td>
                              <td style="color: red;">[@{#text_specials_expires_date#}@]</td>
                              [@{else}@]
                              <td style="visibility: hidden;">[@{#text_specials#}@]</td>
                              <td style="visibility: hidden;">[@{#text_specials_expires_date#}@]</td>                                        
                              [@{/if}@]
                            </tr>                        
                            <tr>                                                                              
                              [@{if $products_prices.is_special}@]
                              <td>[@{$products_prices.input_price|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$products_prices.input_special_price|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                              <td>[@{$products_prices.input_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$products_prices.input_special_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                              <td class="text-center">[@{$products_prices.special_status_image}@]</td>
                              <td>[@{$products_prices.input_special_expires_date|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td> 
                              [@{else}@]
                              <td>[@{$products_prices.input_price|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{*<span style="visibility: hidden;">[@{$products_prices.input_special_price|replace:'<input':'<input class="form-control input-sm input-price"'}@]</span>*}@]</td>
                              <td>[@{$products_prices.input_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{*<span style="visibility: hidden;">[@{$products_prices.input_special_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</span>*}@]</td>
                              <td class="text-center" style="visibility: hidden;">[@{$products_prices.special_status_image}@]</td>
                              <td style="visibility: hidden;">[@{$products_prices.input_special_expires_date|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>                                         
                              [@{/if}@]
                            </tr>                                                                 
                            <tr>
                              <td colspan="4"><table class="price-table">
                                [@{foreach name=inner_inner item=price_break from=$products_prices.price_breaks}@]
                                [@{if $smarty.foreach.inner_inner.first}@]                                           
                                <tr>
                                  <td>[@{#text_products_price_breaks_quantity#}@]</td>
                                  <td>[@{#text_products_price_breaks_net#}@]</td>
                                  <td>[@{#text_products_price_breaks_gross#}@]</td>
                                </tr>
                                [@{/if}@]                         
                                <tr>                                                                                   
                                  [@{if $products_prices.is_special}@]
                                  <td>[@{$price_break.input_quantity|replace:'<input':'<input class="form-control input-sm price-break-input-quantity"'}@]</td>
                                  <td>[@{$price_break.input_price_break|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$price_break.input_special_price_break|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                  <td>[@{$price_break.input_price_break_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$price_break.input_special_price_break_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                  [@{else}@]
                                  <td>[@{$price_break.input_quantity|replace:'<input':'<input class="form-control input-sm price-break-input-quantity"'}@]</td>
                                  <td>[@{$price_break.input_price_break|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{*<span style="visibility: hidden;">[@{$price_break.input_special_price_break|replace:'<input':'<input class="form-control input-sm input-price"'}@]</span>*}@]</td>
                                  <td>[@{$price_break.input_price_break_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{*<span style="visibility: hidden;">[@{$price_break.input_special_price_break_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</span>*}@]</td>                                            
                                  [@{/if}@]
                                </tr> 
                                [@{/foreach}@]                                                           
                              </table></td>
                            </tr>               
                          </table></td>                
                        </tr>                                                                                  
                        [@{if !$smarty.foreach.inner.last}@]
                        <tr>
                          <td><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                        </tr>
                        [@{else}@]                                                                             
                        [@{foreach name=inner_inner1 item=attributes_value from=$product.attributes_values}@]
                        [@{if $smarty.foreach.inner_inner1.first}@]
                        <tr>
                          <td>[@{$hidden_attributes_price_array}@]<img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                        </tr>
                        <tr>
                          <td><b>[@{#text_attributes#}@]</b></td>
                        </tr>               
                        <tr>
                          <td style="padding-left: 20px;"><table class="price-table">
                            <tr>                  
                              <td>[@{#text_attributes_opt_name#}@]</td>
                              <td>[@{#text_attributes_opt_value#}@]</td>
                              <td class="text-center">[@{#text_attributes_opt_price_prefix#}@]</td>
                              <td>[@{#text_attributes_opt_price_net#}@]</td>
                              <td>[@{#text_attributes_opt_price_gross#}@]</td>
                            </tr>
                        [@{/if}@]                        
                            <tr>
                              <td>[@{$attributes_value.option_name}@]</td>
                              <td>[@{$attributes_value.value_name}@]</td>
                              <td>[@{$attributes_value.input_price_prefix|replace:'<input':'<input class="form-control input-sm attributes-value-input-price-prefix"'}@]</td>
                              <td>[@{$attributes_value.input_value_price|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                              <td>[@{$attributes_value.input_value_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                            </tr>
                        [@{if $smarty.foreach.inner_inner1.last}@]                                            
                          </table></td>                
                        </tr>                                                                      
                        [@{/if}@]            
                        [@{/foreach}@] 
                        <tr>
                          <td class="text-nowrap text-right"><a href="[@{$product.link_to_edit_related_product}@]"><img src="[@{$images_path}@]icon_edit.gif" alt="[@{#text_edit#}@]" title=" [@{#text_edit#}@] " width="16" height="16" />[@{#text_edit#}@]</a></td>
                        </tr>                                   
                        [@{/if}@]
                        [@{/foreach}@]                             
                      </table></td>
                    </tr>                                 
                    [@{/foreach}@]
                  </table>
                </div>
              </div>             
            </div>
            [@{$form_end}@]
            <div class="clearfix" style="margin: 0 30px;">
              <div class="pull-left">[@{$nav_bar_number}@]</div>
              <div class="pull-right">[@{$nav_bar_result}@]</div>
            </div>
          </div>                                                                             
[@{elseif $info_prices == 'no_prices'}@]
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">                 
                  <table class="table">
                    <tr>
                      <td class="text-center"><b>[@{#text_no_products_1#}@]</b><br>[@{#text_no_products_2#}@]</td>
                    </tr> 
                  </table> 
                </div>
              </div>             
            </div>                           
          </div>     
[@{/if}@]
[@{if $edit_prices}@] 
          <div class="row">        
[@{$javascript}@]
            [@{$form_begin}@]  
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">                                        
                  <table class="table">
                    <tr class="data-table-heading-row">
                      <th>[@{#text_product_id#}@]</th>
                      <th>[@{#text_product_name#}@]</th>
                      <th>[@{#text_product_price#}@]</th>
                    </tr>                                                          
                    <tr>
                      <td>[@{$product_id}@]</td>
                      <td>[@{$product_status_image}@]&nbsp;[@{$product_name}@]</td>                                                     
                      <td>[@{$hidden_price_array}@]<table>                              
                        [@{foreach name=outer item=customer_group from=$customers_groups}@]
                        [@{if $smarty.foreach.outer.first}@]
                        <tr>
                          <td>[@{#text_products_tax_class#}@]<br>[@{$pull_down_products_tax_class|replace:'<select':'<select class="form-control" style="width: 300px;"'}@]<br></td>
                        </tr>                                                                                                 
                        <tr>
                          <td>[@{#text_products_tax_rates#}@]<br>[@{$pull_down_tax_rates|replace:'<select':'<select class="form-control" style="width: 300px;"'}@]<br></td>
                        </tr>
                        <tr>
                          <td><p><small><i>[@{#text_note#}@]</i></small></p></td>
                        </tr>                                                 
                        [@{if $message_price_error}@]              
                        <tr>
                          <td><p><b>[@{$message_price_error}@]</b></p></td>
                        </tr>                                  
                        [@{/if}@]                           
                        <tr>
                          <td><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                        </tr>                        
                        [@{/if}@]
                        <tr>
                          <td style="padding-left: 2px;">[@{if $customer_group.input_checkbox}@][@{$customer_group.input_checkbox}@][@{else}@]<img src="[@{$images_path}@]checkbox_dummy.gif" alt="" />[@{/if}@]&nbsp;<b>[@{$customer_group.name}@]</b></td>
                        </tr>                                       
                        <tr>
                          <td style="padding-left: 20px;"><table class="price-table" id="box_[@{$customer_group.id}@]">                                    
                            <tr>                  
                              <td style="position: relative;">[@{if $customer_group.display}@]<a href="" onclick="toggle('[@{$customer_group.toggle_name}@]');return false"><img style="position: absolute; left: -20px;" onmouseover="this.style.cursor='pointer'" src="[@{$images_path}@]icon_arrow_down.gif" alt="" /></a>[@{/if}@][@{#text_products_price_net#}@]</td>
                              <td>[@{#text_products_price_gross#}@]</td>
                              <td style="color: red;">[@{#text_specials#}@]</td>
                              <td style="color : red;">[@{#text_specials_expires_date#}@]</td>
                            </tr>                        
                            <tr>
                              <td>[@{$customer_group.input_price|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$customer_group.input_special_price|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                              <td>[@{$customer_group.input_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$customer_group.input_special_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                              <td class="text-center"><span style="background: green; margin: 5px; padding: 5px;">[@{$customer_group.radio_special_status_1}@]</span><span style="background: red; margin: 5px; padding: 5px;">[@{$customer_group.radio_special_status_0}@]</span></td>
                              <td>[@{$customer_group.input_special_expires_date|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                            </tr>                           
                            <tr id="[@{$customer_group.toggle_name}@]" style="[@{$customer_group.display}@]">
                              <td colspan="4"><table class="price-table">
                                [@{foreach name=inner item=price_break from=$customer_group.price_breaks}@]
                                [@{if $smarty.foreach.inner.first}@]                                           
                                <tr>
                                  <td>[@{#text_products_price_breaks_quantity#}@]</td>
                                  <td>[@{#text_products_price_breaks_net#}@]</td>
                                  <td>[@{#text_products_price_breaks_gross#}@]</td>
                                </tr>
                                [@{/if}@]                         
                                <tr>
                                  <td>[@{$price_break.input_quantity|replace:'<input':'<input class="form-control input-sm price-break-input-quantity"'}@]</td>
                                  <td>[@{$price_break.input_price_break|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$price_break.input_special_price_break|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                  <td>[@{$price_break.input_price_break_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$price_break.input_special_price_break_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                </tr> 
                                [@{/foreach}@]                                                           
                              </table></td>
                            </tr>               
                          </table></td>                
                        </tr>                                                                                  
                        [@{if !$smarty.foreach.outer.last}@]
                        <tr>
                          <td><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                        </tr>                              
                        [@{/if}@]
                        [@{/foreach}@]
                        [@{foreach name=outer1 item=attributes_value from=$attributes_values}@]
                        [@{if $smarty.foreach.outer1.first}@]
                        <tr>
                          <td>[@{$hidden_attributes_price_array}@]<img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                        </tr>
                        <tr>
                          <td style="padding-left: 20px;"><b>[@{#text_attributes#}@]</b></td>
                        </tr>               
                        <tr>
                          <td style="padding-left: 20px;"><table class="price-table">
                            <tr>                  
                              <td>[@{#text_attributes_opt_name#}@]</td>
                              <td>[@{#text_attributes_opt_value#}@]</td>
                              <td class="text-center">[@{#text_attributes_opt_price_prefix#}@]</td>
                              <td>[@{#text_attributes_opt_price_net#}@]</td>
                              <td>[@{#text_attributes_opt_price_gross#}@]</td>
                            </tr>
                        [@{/if}@]                        
                            <tr>
                              <td>[@{$attributes_value.option_name}@]</td>
                              <td>[@{$attributes_value.value_name}@]</td>
                              <td>[@{$attributes_value.input_price_prefix|replace:'<input':'<input class="form-control input-sm attributes-value-input-price-prefix"'}@]</td>
                              <td>[@{$attributes_value.input_value_price|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                              <td>[@{$attributes_value.input_value_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                            </tr>
                        [@{if $smarty.foreach.outer1.last}@]                                           
                          </table></td>                
                        </tr>                                                                      
                        [@{/if}@]            
                        [@{/foreach}@]                             
                      </table></td>
                    </tr>                                               
                  </table>
<script>
  [@{$update_prices}@]
  [@{$update_checked_string}@]
</script>                                   
                </div>
              </div>
              <a href="[@{$link_filename_update_products_prices}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="if(update_prices.onsubmit())update_prices.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>            
            </div>                                               
            [@{$form_end}@]
          </div>                                                    
[@{/if}@]         
        </section>  
      </div>     
<!-- update_products_prices_eof -->