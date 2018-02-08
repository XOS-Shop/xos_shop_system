[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.8
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : xsell.tpl
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
<!-- xsell -->
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
              [@{$form_begin_filter_xsell_products}@]
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
                    <div class="col-xs-12 col-sm-9 col-lg-4">
                      <br>
                      <a href="" onclick="filter_xsell_products.submit(); return false" class="btn btn-success pull-right" title=" [@{#button_title_select#}@] ">[@{#button_text_select#}@]</a>
                    </div>
                  </div>
                </div>
              </div>
              [@{$hidden_field_add_related_product_ID}@][@{$hidden_field_session}@][@{$form_end}@]                      
            </div>            
          </div>           
        [@{/if}@]
[@{if $relating_products == 'yes'}@]        
          <div class="row">                      
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">                                        
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#text_product_id#}@]</th>
                      <th>[@{#text_quickfind_code#}@]</th>
                      <th>[@{#text_product_name#}@]</th>
                      <th>[@{#text_cur_cross_sells#}@]</th>
                      <th class="text-center" colspan="2">[@{#text_update_cross_sells#}@]</th>
                    </tr>                                                 
                    [@{foreach name=outer item=product from=$products}@]                  
                    <tr>                                      
                      <td>[@{$product.products_id}@]</td>
                      <td>[@{$product.products_model}@]</td>
                      <td>[@{$product.products_status_image}@]&nbsp;[@{$product.products_name}@]</td>                      
                      <td>
                      [@{foreach name=inner item=related_product from=$product.related_products}@]
                        <div>&nbsp;[@{$related_product.related_products_status_image}@]&nbsp;&nbsp;<span style="font-style: italic">[@{$related_product.related_products_model}@]</span> [@{$related_product.related_products_name}@]</div>
                      [@{if $smarty.foreach.inner.last}@]              
                      </td>
                      [@{/if}@]          
                      [@{foreachelse}@]
                      &nbsp;--</td>
                      [@{/foreach}@]
                      <td class="text-center" onclick="document.location.href='[@{$product.link_to_edit_related_product}@]'">&nbsp;<a href="[@{$product.link_to_edit_related_product}@]">[@{#text_edit#}@]</a>&nbsp;</td>
                    [@{if $product.link_to_sort_related_products}@]
                      <td class="text-center" onclick="document.location.href='[@{$product.link_to_sort_related_products}@]'">&nbsp;<a href="[@{$product.link_to_sort_related_products}@]">[@{#text_prioritise#}@]</a>&nbsp;</td>
                    </tr>
                    [@{else}@]
                      <td class="text-center">--</td>
                    </tr>
                    [@{/if}@]      
                    [@{/foreach}@]                                                                     
                  </table>
                </div>
              </div>             
            </div>
            <div class="clearfix" style="margin: 0 30px;">
              <div class="pull-left">[@{$nav_bar_number}@]</div>
              <div class="pull-right">[@{$nav_bar_result}@]</div>
            </div>
          </div>                                                                             
[@{elseif $relating_products == 'no_products'}@]
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
[@{if $run_update_product}@]
          <div class="row">                                                         
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body text-center">                                     
                  [@{#text_cross_sells_for#}@]&nbsp;[@{$product_id}@]<br>
                  <b>[@{$product_name}@]</b><br>
                  [@{#text_quickfind_code_for#}@]&nbsp;[@{$product_model}@]<br>
                  [@{#text_status#}@]&nbsp;[@{$product_status_image}@]<br><br>
                  [@{$product_image}@]<br><br>
                [@{if $update_products}@]
                  [@{#text_update_product#}@]
                [@{else}@]                
                  [@{#text_no_update_product#}@]
                [@{/if}@]
                </div>                           
              </div>                     
              <a href="[@{$link_to_relating_products}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_product#}@] ">[@{#button_text_new_product#}@]</a>
              [@{if $link_to_sort_related_products}@]
              <a href="[@{$link_to_sort_related_products}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_sort_product#}@] ">[@{#button_text_sort_product#}@]</a>
              [@{/if}@]                                                 
            </div>                           
          </div>               
[@{/if}@]          
[@{if $add_relating_products}@]
          <div class="row">                                                                  
            <div class="col-xs-12 text-center">
              [@{#text_cross_sells_for#}@]&nbsp;[@{$product_id}@]<br>
              <b>[@{$product_name}@]</b><br>
              [@{#text_quickfind_code_for#}@]&nbsp;[@{$product_model}@]<br>
              [@{#text_status#}@]&nbsp;[@{$product_status_image}@]<br><br>
              [@{$product_image}@]<br><br>
            </div>                     
            <div class="col-xs-12">
              [@{$form_begin_add_relating_products}@]             
              <div class="box">                
                <div class="box-body table-responsive no-padding">                                                        
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#text_product_id#}@] </th>
                      <th>[@{#text_quickfind_code#}@] </th>
                      <th>[@{#text_cross_sells#}@] </th>
                      <th>[@{#text_product_name#}@] </th>
                    </tr>
                [@{if $related_products}@]                     
                    <tr class="data-table-heading-row">
                      <td colspan="4"><b>[@{#text_prducts_cross_sell#}@]</b></td>
                    </tr>
                    [@{foreach name=related_products item=cross_product from=$cross_products}@]                     
                    <tr>
                      <td>[@{$cross_product.product_id}@]</td>
                      <td>[@{$cross_product.product_model}@]</td>
                      <td>
                        <label style="cursor: pointer;">
                        <input style="cursor: pointer;" checked="checked" name="xsell_id[]" type="checkbox" value="[@{$cross_product.product_id}@]" />&nbsp;[@{#text_cross_sell#}@]</label>
                      </td>                     
                      <td>[@{$cross_product.product_status_image}@]&nbsp;[@{$cross_product.product_name}@]</td>
                    </tr>                               
                    [@{/foreach}@]                 
                [@{/if}@]                 
          [@{if $new_products}@]
                    <tr class="data-table-heading-row">
                      <td colspan="4"><b>[@{#text_prducts_for_adding_cross_sell#}@]</b></td>
                    </tr>
                    [@{foreach name=relating_products item=product from=$products}@]                     
                    <tr>
                      <td>[@{$product.product_id}@]</td>
                      <td>[@{$product.product_model}@]</td>
                      <td>
                        <label style="cursor: pointer;">
                        <input style="cursor: pointer;" name="xsell_id[]" type="checkbox" value="[@{$product.product_id}@]" />&nbsp;[@{#text_cross_sell#}@]</label>
                      </td>                     
                      <td>[@{$product.product_status_image}@]&nbsp;[@{$product.product_name}@]</td>
                    </tr> 
                    [@{/foreach}@]                     
                  </table> 
                </div>                   
              </div>
              [@{$hidden_field_run_update}@][@{$hidden_field_categories_or_pages_id}@][@{$hidden_field_manufacturers_id}@][@{$hidden_field_add_related_product_ID}@]
              [@{$form_end}@]                       
              <div class="clearfix pagination-wrapper">
                <div class="pull-left">[@{$nav_bar_number}@]</div>
                <div class="pull-right">[@{$nav_bar_result}@]</div>
              </div>
              <a href="[@{$link_to_relating_products}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_product#}@] ">[@{#button_text_new_product#}@]</a><a href="" onclick="runing_update.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_save#}@] ">[@{#button_text_save#}@]</a>                                       
            </div>
          </div>                                                                                                                                                              
          [@{else}@]                          
                    <tr class="data-table-heading-row">
                      <td class="text-center" colspan="4"><b>[@{#text_no_products_1a#}@]</b><br>[@{#text_no_products_2#}@]</td>
                    </tr>   
                  </table> 
                </div>                   
              </div>
              [@{$hidden_field_run_update}@][@{$hidden_field_categories_or_pages_id}@][@{$hidden_field_manufacturers_id}@][@{$hidden_field_add_related_product_ID}@]
              [@{$form_end}@]              
              [@{if $related_products}@]
              <a href="[@{$link_to_relating_products}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_product#}@] ">[@{#button_text_new_product#}@]</a><a href="" onclick="runing_update.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_save#}@] ">[@{#button_text_save#}@]</a> 
              [@{else}@]
              <a href="[@{$link_to_relating_products}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_product#}@] ">[@{#button_text_new_product#}@]</a>
              [@{/if}@]                         
            </div>
          </div>                                                                                                                          
          [@{/if}@]                                                                                                                           
[@{/if}@]
[@{if $sort_related_products}@]
          <div class="row">                                                                  
            <div class="col-xs-12 text-center">
              [@{#text_order_for#}@]&nbsp;[@{$product_id}@]<br>
              <b>[@{$product_name}@]</b><br>
              [@{#text_quickfind_code_for#}@]&nbsp;[@{$product_model}@]<br>
              [@{#text_status#}@]&nbsp;[@{$product_status_image}@]<br><br>
              [@{$product_image}@]<br><br>           
            </div>                     
            <div class="col-xs-12">
              [@{$form_begin_runing_update}@]             
              <div class="box">                
                <div class="box-body table-responsive no-padding">                                                        
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#text_product_id#}@]</th>
                      <th>[@{#text_quickfind_code#}@]</th>
                      <th>[@{#text_product_name#}@]</th>
                      <th>[@{#text_order#}@]</th>
                    </tr>                
                    [@{foreach item=cross_product from=$cross_products}@]                     
                    <tr>
                      <td>[@{$cross_product.product_id}@]</td>
                      <td>[@{$cross_product.product_model}@]</td>                    
                      <td>[@{$cross_product.product_status_image}@]&nbsp;[@{$cross_product.product_name}@]</td> 
                      <td>[@{$cross_product.select_tag|replace:'<select':'<select class="form-control input-sm" style="min-width: 70px; max-width: 100px;"'}@]</td>                      
                    </tr> 
                    [@{/foreach}@]                     
                  </table> 
                </div>                   
              </div>
              <a href="[@{$link_to_relating_products}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_product#}@] ">[@{#button_text_new_product#}@]</a>
              <a href="" onclick="runing_update.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a> 
              [@{$form_end}@]            
            </div>
          </div>                                                                                                                                                                              
[@{/if}@]   
        </section>  
      </div>    
<!-- xsell_eof -->