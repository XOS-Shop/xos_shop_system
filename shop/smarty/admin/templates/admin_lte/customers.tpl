[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.3
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : customers.tpl
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
<!-- customers -->
      <div class="content-wrapper">
      [@{if $edit_or_update}@]                       
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
            [@{$form_begin_customers}@][@{$hidden_default_address_id}@][@{$hidden_field_customers_language_id}@]
              <div class="box">
                <div class="box-body">
                  <div class="form-horizontal">                                
                    <h3>[@{#category_personal#}@]</h3>
                    <hr> 
                    [@{if $account_gender}@]                   
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_gender#}@]</b></div>
                      <div class="col-sm-6 col-xs-12 radio">
                        [@{$gender_in_out_values}@]
                      </div>
                    </div> 
                    [@{/if}@]                         
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_customer_id#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$cid_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]   
                      </div>      
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_first_name#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$firstname_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]  
                      </div>      
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_last_name#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$lastname_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]
                      </div>      
                    </div>
                    [@{if $account_dob}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_date_of_birth#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$dob_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@] 
                      </div>      
                    </div>                    
                    [@{/if}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_email_address#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$email_address_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]    
                      </div>      
                    </div>                    
                    [@{if $languages}@] 
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_language#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$languages_in_out_values|replace:'<select':'<select class="form-control form-element-required"'}@]   
                      </div>      
                    </div>                                                                                        
                    [@{/if}@]                                                            
                    [@{if $account_company}@]
                    <h3>[@{#category_company#}@]</h3>
                    <hr>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_company#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$company_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]   
                      </div>      
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_company_tax_id#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$company_tax_id_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]   
                      </div>      
                    </div>                                                    
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_customers_group_request_authentication#}@]</b></div>
                      <div class="col-sm-6 col-xs-12 radio">
                        [@{$customers_group_ra_in_out_values}@]
                      </div>
                    </div>                                                                 
                    [@{/if}@]           
                    <h3>[@{#category_address#}@]</h3>
                    <hr>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_street_address#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$street_address_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]   
                      </div>      
                    </div>
                    [@{if $account_suburb}@]                      
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_suburb#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$suburb_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]  
                      </div>      
                    </div>
                    [@{/if}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_post_code#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$post_code_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]   
                      </div>      
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_city#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$city_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]   
                      </div>      
                    </div>
                    [@{if $account_state}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_state#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$state_in_out_values|replace:'<input':'<input class="form-control form-element-required"'|replace:'<select':'<select class="form-control form-element-required"'}@]   
                      </div>      
                    </div>                    
                    [@{/if}@]                    
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_country#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$country_in_out_values|replace:'<select':'<select class="form-control form-element-required"'}@]   
                      </div>      
                    </div>                                                                                                                                                   
                    <h3>[@{#category_contact#}@]</h3>
                    <hr>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_telephone_number#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$telephone_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]   
                      </div>      
                    </div>                     
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_fax_number#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$fax_in_out_values|replace:'<input':'<input class="form-control form-element-required"'}@]   
                      </div>      
                    </div>                                       
                    <h3>[@{#category_options#}@]</h3>
                    <hr>                 
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_newsletter#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$newsletter_in_out_values|replace:'<select':'<select class="form-control form-element-required"'}@]   
                      </div>      
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_customers_group_name#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value text-nowrap">
                        [@{$customers_group_id_in_out_values|replace:'<select':'<select class="form-control form-element-required"'}@]   
                      </div>      
                    </div>                           
                    <h3>[@{#category_comments#}@]</h3>
                    <hr>
                    [@{if $several_lng_in_admin}@]               
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>&nbsp;</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9">
                        [@{#entry_comments_text_multilingualism#}@]   
                      </div>      
                    </div>
                    [@{/if}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_comments#}@]</b></div>
                      <div class="col-lg-4 col-sm-5 col-xs-9 in-out-value">
                        [@{$comments_in_out_values|replace:'<textarea':'<textarea class="form-control form-element-required"'}@]
                      </div>      
                    </div>                                                                                                                                                                                                                                                                                                                          
                  </div>
                </div>                                                               
              </div>
              <a href="[@{$link_filename_customers}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a>
              <a href="" onclick="if(customers.onsubmit())customers.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>                                      
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
                      <th><a href="[@{$link_self_company_sort_asc}@]"><i class="fa fa-fw fa-chevron-up[@{if $smarty.get.listing == 'company'}@] active[@{/if}@]" title=" [@{$text_company_sort_asc}@] "></i></a><a href="[@{$link_self_company_sort_desc}@]"><i class="fa fa-fw fa-chevron-down[@{if $smarty.get.listing == 'company-desc'}@] active[@{/if}@]" title=" [@{$text_company_sort_desc}@] "></i></a><br />[@{#table_heading_company#}@]</th>
                      <th><a href="[@{$link_self_lastname_sort_asc}@]"><i class="fa fa-fw fa-chevron-up[@{if $smarty.get.listing == 'lastname'}@] active[@{/if}@]" title=" [@{$text_lastname_sort_asc}@] "></i></a><a href="[@{$link_self_lastname_sort_desc}@]"><i class="fa fa-fw fa-chevron-down[@{if $smarty.get.listing == 'lastname-desc'}@] active[@{/if}@]" title=" [@{$text_lastname_sort_desc}@] "></i></a><br />[@{#table_heading_lastname#}@]</th>
                      <th><a href="[@{$link_self_firstname_sort_asc}@]"><i class="fa fa-fw fa-chevron-up[@{if $smarty.get.listing == 'firstname'}@] active[@{/if}@]" title=" [@{$text_firstname_sort_asc}@] "></i></a><a href="[@{$link_self_firstname_sort_desc}@]"><i class="fa fa-fw fa-chevron-down[@{if $smarty.get.listing == 'firstname-desc'}@] active[@{/if}@]" title=" [@{$text_firstname_sort_desc}@] "></i></a><br />[@{#table_heading_firstname#}@]</th>
	       	      <th><a href="[@{$link_self_cg_name_sort_asc}@]"><i class="fa fa-fw fa-chevron-up[@{if $smarty.get.listing == 'cg_name'}@] active[@{/if}@]" title=" [@{$text_cg_name_sort_asc}@] "></i></a><a href="[@{$link_self_cg_name_sort_desc}@]"><i class="fa fa-fw fa-chevron-down[@{if $smarty.get.listing == 'cg_name-desc'}@] active[@{/if}@]" title=" [@{$text_cg_name_sort_desc}@] "></i></a><br />[@{#table_heading_customers_groups#}@]</th>
                      <th class="text-right"><a href="[@{$link_self_id_sort_asc}@]"><i class="fa fa-fw fa-chevron-up[@{if $smarty.get.listing == 'id-asc'}@] active[@{/if}@]" title=" [@{$text_id_sort_asc}@] "></i></a><a href="[@{$link_self_id_sort_desc}@]"><i class="fa fa-fw fa-chevron-down[@{if $smarty.get.listing == 'id-desc' || $smarty.get.listing == ''}@] active[@{/if}@]" title=" [@{$text_id_sort_desc}@] "></i></a><br />[@{#table_heading_account_created#}@]</th>
                      <th class="text-center"><a href="[@{$link_self_ra_sort_asc}@]"><i class="fa fa-fw fa-chevron-up[@{if $smarty.get.listing == 'ra'}@] active[@{/if}@]" title=" [@{$text_ra_sort_asc}@] "></i></a><a href="[@{$link_self_ra_sort_desc}@]"><i class="fa fa-fw fa-chevron-down[@{if $smarty.get.listing == 'ra-desc'}@] active[@{/if}@]" title=" [@{$text_ra_sort_desc}@] "></i></a><br />[@{#table_heading_request_authentication#}@]&nbsp;</th>
                      <th class="text-right">&nbsp;<br />[@{#table_heading_action#}@]</th>                                           
                    </tr>                    
                    [@{foreach item=customer from=$customers}@]
                    [@{if $customer.selected}@]                            
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$customer.link_filename_customers}@]'">
                      <td>[@{$customer.company}@]</td>
                      <td>[@{$customer.lastname}@]</td>
                      <td>[@{$customer.firstname}@]</td>
                      <td>[@{$customer.group_name}@]</td>
                      <td class="text-right">[@{$customer.date_account_created}@]</td>
                      <td class="text-center">[@{$customer.group_ra_status_image}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>              
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$customer.link_filename_customers}@]'">
                      <td>[@{$customer.company}@]</td>
                      <td>[@{$customer.lastname}@]</td>
                      <td>[@{$customer.firstname}@]</td>
                      <td>[@{$customer.group_name}@]</td>
                      <td class="text-right">[@{$customer.date_account_created}@]</td>
                      <td class="text-center">[@{$customer.group_ra_status_image}@]</td>
                      <td class="text-right"><a href="[@{$customer.link_filename_customers}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
              [@{if $link_filename_customers_reset}@]
                <a href="[@{$link_filename_customers_reset}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_reset#}@] ">[@{#button_text_reset#}@]</a>                 
              [@{/if}@]                          
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_customers}@]         
            </div>              
          </div>
        </section>                
      [@{/if}@]        
      </div>         
<!-- customers_eof -->