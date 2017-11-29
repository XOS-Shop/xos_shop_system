[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : reviews.tpl
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
<!-- reviews -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>[@{#heading_title#}@]</h1>
        </section>
      [@{if $edit}@]        
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
              [@{$form_begin_review}@]                                                                                                                               
              <div class="box">
                <div class="box-body">                                                 
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_product#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$products_name}@]<br>[@{$products_image}@]
                      </div>    
                    </div>      
                  </div>                     
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_from#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$customers_name}@]
                      </div>    
                    </div>      
                  </div>                    
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_date#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$date_added}@]
                      </div>    
                    </div>      
                  </div>
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_review#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$textarea_reviews_text|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>    
                    </div>      
                  </div> 
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_rating#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group rating-text text-nowrap">
                        <span class="rating-text-bad">[@{#text_bad#}@]</span>[@{$reviews_rating}@]<span class="rating-text-good">[@{#text_good#}@]</span>
                      </div>    
                    </div>      
                  </div>                                                                                  
                </div>                                                               
              </div>                
              <input type="hidden" name="reviews_id" value="1">
              [@{$hidden_reviews_id}@]
              [@{$hidden_products_id}@]
              [@{$hidden_customers_name}@]
              [@{$hidden_products_name}@]
              [@{$hidden_products_image}@]
              [@{$hidden_date_added}@]
              <a href="[@{$link_filename_reviews_cancel}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="review.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_preview#}@] ">[@{#button_text_preview#}@]</a>              
              [@{$form_end}@]      
            </div>            
          </div>
        </section> 
      [@{elseif $preview}@]     
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
              [@{if $hidden_post_values}@][@{$form_begin_update}@][@{/if}@]                                                                                                                               
              <div class="box">
                <div class="box-body">                                                 
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_product#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$products_name}@]<br>[@{$products_image}@]
                      </div>    
                    </div>      
                  </div>                     
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_from#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$customers_name}@]
                      </div>    
                    </div>      
                  </div>                    
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_date#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$date_added}@]
                      </div>    
                    </div>      
                  </div>
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_review#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$reviews_text}@]
                      </div>    
                    </div>      
                  </div> 
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#entry_rating#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group text-nowrap">
                        [@{$stars_image}@]&nbsp;<small>[@{$text_of_5_stars}@]</small>
                      </div>    
                    </div>      
                  </div>                                                                                  
                </div>                                                               
              </div>                                                                                                                                  
              [@{if $hidden_post_values}@]
              [@{$hidden_post_values}@]         
              <a href="[@{$link_filename_reviews_cancel}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="update.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a><a href="[@{$link_filename_reviews_back_edit}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
              [@{$form_end}@]     
              [@{else}@]
              <a href="[@{$link_filename_reviews_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>      
              [@{/if}@]      
            </div>            
          </div>
        </section>     
      [@{else}@]
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
                      <th>[@{#table_heading_products#}@]</th>
                      <th class="text-center">[@{#table_heading_rating#}@]</th>
                      <th class="text-center">[@{#table_heading_date_added#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                    [@{foreach item=review from=$reviews}@]
                    [@{if $review.selected}@]                             
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$review.link_filename_reviews}@]'">
                      <td><a href="[@{$review.link_filename_reviews_review}@]"><i class="fa fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a>&nbsp;&nbsp;[@{$review.products_name}@]</td>
                      <td class="text-center">[@{$review.stars_image}@]</td>
                      <td class="text-center">[@{$review.date_added}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$review.link_filename_reviews}@]'">
                      <td><a href="[@{$review.link_filename_reviews_review}@]"><i class="fa fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a>&nbsp;&nbsp;[@{$review.products_name}@]</td>
                      <td class="text-center">[@{$review.stars_image}@]</td>
                      <td class="text-center">[@{$review.date_added}@]</td>
                      <td class="text-right"><a href="[@{$review.link_filename_reviews}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
              [@{$infobox_reviews}@]         
            </div>              
          </div>
        </section>     
      [@{/if}@]                  
      </div>   
<!-- reviews_eof -->