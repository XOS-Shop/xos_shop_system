[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : image_processing.tpl
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
[@{if $recreate_product_images_now}@]
    [@{if $script}@]
      [@{$script}@] 
                    <i class="fa fa-refresh fa-spin"></i>&nbsp; &nbsp; &nbsp;[@{#text_run#}@] [@{$counter}@] [@{#text_of#}@] [@{$total_runs}@] | [@{#text_please_wait#}@]      
    [@{else}@]       
                    [@{#text_product_images_regenerated#}@]
                    <a href="[@{$link_filename_image_processing_back}@]" class="btn btn-primary btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
    [@{/if}@]                    
[@{elseif $recreate_category_images_now}@]
                    [@{#text_category_images_regenerated#}@]
                    <a href="[@{$link_filename_image_processing_back}@]" class="btn btn-primary btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
[@{else}@]
<!-- image_processing -->
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
          <div class="row">
            <div class="col-xs-12">                                 
              <div class="box">
                <div class="box-body">                                 
                [@{if $action == 'confirm_recreate'}@]                     
                  <div id="infoSend">
                    <i class="fa fa-refresh fa-spin"></i>&nbsp; &nbsp; &nbsp;[@{#text_please_wait#}@]
                  </div>
                [@{else}@]         
                  [@{$form_begin_action_confirm_recreate_product_images}@]
                  <a href="" onclick="if(processing_product_images.onsubmit())processing_product_images.submit(); return false" class="btn btn-primary btn-margin-after-pagination" title=" [@{#button_title_product_images_regenerate#}@] ">[@{#button_text_product_images_regenerate#}@]</a>
                  [@{$form_end}@]
                  [@{$form_begin_action_confirm_recreate_category_images}@]
                  <a href="" onclick="if(processing_category_images.onsubmit())processing_category_images.submit(); return false" class="btn btn-primary btn-margin-after-pagination" title=" [@{#button_title_category_images_regenerate#}@] ">[@{#button_text_category_images_regenerate#}@]</a>
                  [@{$form_end}@]             
                [@{/if}@]                                                        
                </div>
              </div>                            
            </div>             
          </div>
        </section>        
      </div>     
<!-- image_processing_eof -->
[@{/if}@]        