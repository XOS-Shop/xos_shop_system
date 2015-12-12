[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0 rc9
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : categories_and_products.tpl
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
<!-- categories_and_products -->
      <div class="content-wrapper">
        <section class="content-header clearfix">
          <h1 class="pull-left">[@{#heading_title#}@]</h1>
          <div class="pull-right">             
            <div class="pull-right" style="margin-left: 20px">[@{$form_begin_goto}@]<label class="control-label text-right pull-left" for="goto_id">[@{#heading_title_goto#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$pull_down_categories|replace:'<select':'<select class="form-control" id="goto_id"'}@][@{$hidden_field_session}@]</div>[@{$form_end}@]</div>
            <div class="pull-right" style="margin-left: 20px">[@{$form_begin_search}@]<label class="control-label text-right pull-left" for="search_id">[@{#heading_title_search#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$input_search|replace:'<input':'<input class="form-control" id="search_id"'}@][@{$hidden_field_session}@]</div>[@{$form_end}@]</div>
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
                      <th style="width: 1%;">&nbsp;</th>
                      <th>[@{#table_heading_sort_order#}@]</th>
                      <th>[@{#table_heading_categories_products#}@]</th>
                      <th class="text-center">[@{#table_heading_status#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                    [@{foreach item=category from=$categories}@]
                    [@{if $category.selected}@]                                       
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$category.link_filename_categories_get_path}@]'">
                      <td><a href="[@{$category.link_filename_categories_get_path}@]"><i class="fa fa-folder" title=" [@{#icon_title_folder#}@] "></i></a></td>
                      <td>[@{$category.sort_order}@]</td>
                      <td>[@{$category.name}@]</td>
                      <td class="text-center"> 
                      [@{if $category.status}@]                
                        [@{$category.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$category.link_filename_categories_flag_0}@]">[@{$category.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$category.link_filename_categories_flag_1}@]">[@{$category.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$category.icon_status_red}@]
                      [@{/if}@]                    
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$category.link_filename_categories_cpath_cpath_cid}@]'">
                     <td><a href="[@{$category.link_filename_categories_get_path}@]"><i class="fa fa-folder" title=" [@{#icon_title_folder#}@] "></i></a></td>
                      <td>[@{$category.sort_order}@]</td>
                      <td>[@{$category.name}@]</td>
                      <td class="text-center"> 
                      [@{if $category.status}@]                
                        [@{$category.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$category.link_filename_categories_flag_0}@]">[@{$category.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$category.link_filename_categories_flag_1}@]">[@{$category.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$category.icon_status_red}@]
                      [@{/if}@]                    
                      </td>
                      <td class="text-right"><a href="[@{$category.link_filename_categories_cpath_cpath_cid}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]
                    [@{foreach item=product from=$products}@]
                    [@{if $product.selected}@]                                                          
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$product.link_filename_categories_action_product_preview}@]'">
                      <td><a href="[@{$product.link_filename_categories_action_product_preview}@]"><i class="fa fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td>[@{$product.sort_order}@]</td>
                      <td>[@{$product.name}@]</td>
                      <td class="text-center">
                      [@{if $product.status}@]                
                        [@{$product.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$product.link_filename_categories_flag_0}@]">[@{$product.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$product.link_filename_categories_flag_1}@]">[@{$product.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$product.icon_status_red}@]
                      [@{/if}@]                                          
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$product.link_filename_categories_cpath_cpath_pid}@]'">
                      <td><a href="[@{$product.link_filename_categories_action_product_preview}@]"><i class="fa fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td>[@{$product.sort_order}@]</td>
                      <td>[@{$product.name}@]</td>
                      <td class="text-center">
                      [@{if $product.status}@]                
                        [@{$product.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$product.link_filename_categories_flag_0}@]">[@{$product.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$product.link_filename_categories_flag_1}@]">[@{$product.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$product.icon_status_red}@]
                      [@{/if}@]                                          
                      </td>
                      <td class="text-right"><a href="[@{$product.link_filename_categories_cpath_cpath_pid}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]                                                            
                  </table>
                </div>
              </div>
              <div class="pagination-wrapper">
                [@{#text_categories#}@]&nbsp;[@{$categories_count}@]<br>[@{#text_products#}@]&nbsp;[@{$products_count}@]
              </div>                           
              [@{if $link_filename_categories_action_new_category}@]
                [@{if $categories_count == 0 && !$is_level_top}@]
                  <a href="[@{$link_filename_categories_action_new_product}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_product#}@] ">[@{#button_text_new_product#}@]</a>
                [@{/if}@]                    
                [@{if $products_count == 0}@]
                  <a href="[@{$link_filename_categories_action_new_category}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_category#}@] ">[@{#button_text_new_category#}@]</a>
                [@{/if}@]
              [@{/if}@]
              [@{if $link_filename_categories_back}@]
                <a href="[@{$link_filename_categories_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a> 
              [@{/if}@]                                           
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_categories}@]         
            </div>              
          </div>
        </section>
      </div>
<!-- categories_and_products_eof -->