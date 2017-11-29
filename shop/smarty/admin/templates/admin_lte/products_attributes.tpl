[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : products_attributes.tpl
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
<!-- products_attributes -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>[@{if $single_product}@][@{$text_new_product}@][@{else}@][@{#heading_title#}@][@{/if}@]</h1>
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
      [@{if $single_product}@]                            
          <div id="filter" class="row">
            <div class="col-xs-12">                                   
              [@{$form_begin_filter_products_attributes}@]
              <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-4 col-md-6 col-lg-8">
                      <b>[@{#table_heading_set_filter#}@]</b><br><br>                  
                    </div>                                       
                    <div class="col-sm-4 col-md-3 col-lg-2">
                      <div class="form-group text-nowrap">
                        <label><small>[@{#table_heading_max_rows#}@]</small></label>
                        [@{$pull_down_menu_max_rows|replace:'<select':'<select class="form-control input-sm"'}@]
                      </div>
                    </div>                                                                                
                    <div class="col-sm-4 col-md-3 col-lg-2">
                      <br>
                      <a href="" onclick="filter_products_attributes.submit(); return false" class="btn btn-success pull-right" title=" [@{#button_title_select#}@] ">[@{#button_text_select#}@]</a>
                    </div>
                  </div>
                </div>
              </div>
              [@{$hidden_fields_page_info}@][@{$hidden_field_session}@][@{$form_end_filter}@]                     
            </div>            
          </div> 
          <div id="no-filter" class="row">
          </div>                
      [@{else}@]                        
          <div id="filter" class="row">
            <div class="col-xs-12">                                   
              [@{$form_begin_filter_products_attributes}@]
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
                        <label><small>[@{#table_heading_max_products_in_pullwown#}@]</small></label>
                        [@{$pull_down_menu_max_products|replace:'<select':'<select class="form-control input-sm"'}@]
                      </div>
                    </div>                                        
                    <div class="col-xs-12 col-sm-6 col-lg-2">
                      <br>
                      <a href="" onclick="filter_products_attributes.submit(); return false" class="btn btn-success pull-right" title=" [@{#button_title_select#}@] ">[@{#button_text_select#}@]</a>
                    </div>
                  </div>
                </div>
              </div>
              [@{$hidden_fields_page_info}@][@{$hidden_field_session}@][@{$form_end_filter}@]                      
            </div>            
          </div> 
          <div id="no-filter" class="row">
          </div>          
      [@{/if}@]
          <div id="attributes">      
            <div class="row">
              <div class="col-xs-12">
                [@{if $link_back_to_product_list}@]<a href="[@{$link_back_to_product_list}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back_to_product_list#}@] ">[@{#button_text_back_to_product_list#}@]</a>[@{/if}@]<a href="" onclick="toggle(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_edit_option_and_values#}@] ">[@{#button_text_edit_option_and_values#}@]</a>
              </div>
            </div>  
            <div class="row">  
              [@{$attributes_products}@]     
            </div>
          </div>
          <div id="options">          
            <div class="row">
              <div class="col-xs-12">
                [@{if $link_back_to_product_list}@]<a href="[@{$link_back_to_product_list}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back_to_product_list#}@] ">[@{#button_text_back_to_product_list#}@]</a>[@{/if}@]<a href="" onclick="toggle(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_edit_attributes#}@] ">[@{#button_text_edit_attributes#}@]</a>
              </div>
            </div>
            <div class="row">                         
              <div class="col-lg-6">                                 
                [@{$attributes_options}@]                   
              </div>                      
              <div class="col-lg-6">                                      
                [@{$attributes_values}@]                    
              </div>                        
            </div>
          </div>                                           
        </section>  
      </div>                
[@{$js_init_style}@]
<!-- products_attributes_eof -->