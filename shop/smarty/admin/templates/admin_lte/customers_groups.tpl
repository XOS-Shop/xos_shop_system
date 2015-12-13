[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.1
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : customers_groups.tpl
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
<!-- customers_groups -->
      <div class="content-wrapper">
   [@{if $edit}@]
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
          <div class="row">
            <div class="col-xs-12">                                                                                                                                  
            [@{$form_begin_customers_update}@]
              <div class="box">
                <div class="box-body">
                  <div class="form-horizontal">                                
                    <h3>[@{#category_personal#}@]</h3> 
                    <hr>                         
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_groups_name#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 text-nowrap">
                        [@{$group_name_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]&nbsp;&nbsp;<small>[@{#text_char_max_length#}@]</small> 
                      </div>      
                    </div>                    
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_group_show_tax#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 text-nowrap">
                        [@{$group_show_tax_in_out_values|replace:'<select':'<select class="form-control form-element-required"'}@]   
                      </div>      
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_group_tax_exempt#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 text-nowrap">
                        [@{$group_tax_exempt_in_out_values|replace:'<select':'<select class="form-control form-element-required"'}@]   
                      </div>      
                    </div>                                                                                                                                                                         
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_group_discount#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 text-nowrap">
                        [@{$group_discount_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]&nbsp;&nbsp;%   
                      </div>      
                    </div>          
                    <h3>[@{#heading_title_modules_payment#}@]</h3>
                    <hr> 
                    <div class="form-group clearfix">                           
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                        <label>
                          [@{$group_payment_settings_in_out_values_1}@]
                          [@{#entry_group_payment_set#}@]
                        </label>
                      </div>
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                        <label>
                          [@{$group_payment_settings_in_out_values_0}@]
                          [@{#entry_group_payment_default#}@]
                        </label>
                      </div>                            
                      [@{foreach item=payment from=$payment_allowed}@]                        
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                        <div class="checkbox">
                          <label>
                            [@{$payment.group_payment_allowed_in_out_values}@][@{$payment.group_payment_allowed_title}@]
                          </label>
                        </div>                            
                      </div>                              
                      [@{/foreach}@]                  
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                        <br>[@{#entry_payment_set_explain#}@]
                      </div>
                    </div>                                        
                    <h3>[@{#heading_title_modules_shipping#}@]</h3>
                    <hr> 
                    <div class="form-group clearfix">                           
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                        <label>
                          [@{$group_shipment_settings_in_out_values_1}@]
                          [@{#entry_group_shipping_set#}@]
                        </label>
                      </div>
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                        <label>
                          [@{$group_shipment_settings_in_out_values_0}@]
                          [@{#entry_group_shipping_default#}@]
                        </label>
                      </div>                            
                      [@{foreach item=shipping from=$shipping_allowed}@]                        
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                        <div class="checkbox">
                          <label>
                            [@{$shipping.group_shipping_allowed_in_out_values}@][@{$shipping.group_shipping_allowed_title}@]
                          </label>
                        </div>                            
                      </div>                              
                      [@{/foreach}@]                  
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                        <br>[@{#entry_shipping_set_explain#}@]
                      </div>
                    </div>                                                                                                                                                              
                  </div>                                                                                                                                                                                                                                                                                                                                           
                </div>                                                               
              </div>
              <a href="[@{$link_filename_customers_groups}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a>
              <a href="" onclick="if(customers.onsubmit())customers.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>
            [@{$form_end}@]
            </div>            
          </div>     
        </section>            
   [@{elseif $new}@]
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
          <div class="row">
            <div class="col-xs-12">                                                                                                                                  
            [@{$form_begin_customers_new}@]
              <div class="box">
                <div class="box-body">
                  <div class="form-horizontal">                                
                    <h3>[@{#category_personal#}@]</h3> 
                    <hr>                         
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_groups_name#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 text-nowrap">
                        [@{$group_name_in_values|replace:'<input':'<input class="form-control form-element-required"'}@]&nbsp;&nbsp;<small>[@{#text_char_max_length#}@]</small> 
                      </div>      
                    </div>                    
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_group_show_tax#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 text-nowrap">
                        [@{$group_show_tax_in_values|replace:'<select':'<select class="form-control form-element-required"'}@]   
                      </div>      
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_group_tax_exempt#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 text-nowrap">
                        [@{$group_tax_exempt_in_values|replace:'<select':'<select class="form-control form-element-required"'}@]   
                      </div>      
                    </div>                                                                                                                                                                         
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_group_discount#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 text-nowrap">
                        [@{$group_discount_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]&nbsp;&nbsp;%   
                      </div>      
                    </div>          
                    <h3>[@{#heading_title_modules_payment#}@]</h3>
                    <hr> 
                    <div class="form-group clearfix">                           
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                        <label>
                          [@{$group_payment_settings_in_values_1}@]
                          [@{#entry_group_payment_set#}@]
                        </label>
                      </div>
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                        <label>
                          [@{$group_payment_settings_in_values_0}@]
                          [@{#entry_group_payment_default#}@]
                        </label>
                      </div>                            
                      [@{foreach item=payment from=$payment_allowed}@]                        
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                        <div class="checkbox">
                          <label>
                            [@{$payment.group_payment_allowed_in_values}@][@{$payment.group_payment_allowed_title}@]
                          </label>
                        </div>                            
                      </div>                              
                      [@{/foreach}@]                  
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                        <br>[@{#entry_payment_set_explain#}@]
                      </div>
                    </div>                                        
                    <h3>[@{#heading_title_modules_shipping#}@]</h3>
                    <hr> 
                    <div class="form-group clearfix">                           
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                        <label>
                          [@{$group_shipment_settings_in_values_1}@]
                          [@{#entry_group_shipping_set#}@]
                        </label>
                      </div>
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                        <label>
                          [@{$group_shipment_settings_in_values_0}@]
                          [@{#entry_group_shipping_default#}@]
                        </label>
                      </div>                            
                      [@{foreach item=shipping from=$shipping_allowed}@]                        
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                        <div class="checkbox">
                          <label>
                            [@{$shipping.group_shipping_allowed_in_values}@][@{$shipping.group_shipping_allowed_title}@]
                          </label>
                        </div>                            
                      </div>                              
                      [@{/foreach}@]                  
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                        <br>[@{#entry_shipping_set_explain#}@]
                      </div>
                    </div>                                                                                                                                                              
                  </div>                                                                                                                                                                                                                                                                                                                                           
                </div>                                                               
              </div>
              <a href="[@{$link_filename_customers_groups}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a>
              <a href="" onclick="if(customers.onsubmit())customers.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a>
            [@{$form_end}@]
            </div>            
          </div>     
        </section>                
   [@{else}@]    
        <section class="content-header clearfix">
          <h1 class="pull-left">[@{#heading_title#}@]</h1>          
          <div class="pull-right" style="margin-left: 20px">[@{$form_begin_search}@]<label class="control-label text-right pull-left" for="search_id">[@{#heading_title_search#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$input_search|replace:'<input':'<input class="form-control" id="search_id"'}@][@{$hidden_field_session}@]</div>[@{$form_end}@]</div>
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
                      <th><a href="[@{$link_filename_customers_groups_sort_asc}@]"><i class="fa fa-fw fa-chevron-up[@{if $smarty.get.listing == 'group'}@] active[@{/if}@]" title=" [@{$text_sort_asc}@] "></i></a><a href="[@{$link_filename_customers_groups_sort_desc}@]"><i class="fa fa-fw fa-chevron-down[@{if $smarty.get.listing == 'group-desc' || $smarty.get.listing == ''}@] active[@{/if}@]" title=" [@{$text_sort_desc}@] "></i></a><br />[@{#table_heading_name#}@]</th>
                      <th class="text-right">&nbsp;<br />[@{#table_heading_action#}@]</th>                                           
                    </tr> 
                    [@{foreach item=customers_group from=$customers_groups}@]
                    [@{if $customers_group.selected}@]                                                                                  
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$customers_group.link_filename_customers_groups}@]'">
                      <td>[@{$customers_group.group_name}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>              
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$customers_group.link_filename_customers_groups}@]'">
                      <td>[@{$customers_group.group_name}@]</td>
                      <td class="text-right"><a href="[@{$customers_group.link_filename_customers_groups}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
              [@{if $link_filename_customers_groups_reset}@]
                <a href="[@{$link_filename_customers_groups_reset}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_reset#}@] ">[@{#button_text_reset#}@]</a>                 
              [@{elseif $link_filename_customers_groups_insert}@]                  
                <a href="[@{$link_filename_customers_groups_insert}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a>
              [@{/if}@]                                                                   
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_customers_groups}@]         
            </div>              
          </div>
        </section>      
   [@{/if}@]
      </div>         
<!-- customers_groups_eof -->