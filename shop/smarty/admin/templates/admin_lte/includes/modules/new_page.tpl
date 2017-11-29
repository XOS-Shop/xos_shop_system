[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : new_page.tpl
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
<!-- new_page --> 
      <div class="content-wrapper">
        <section class="content-header">
          <h1>[@{$text_new_page}@]</h1>
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
            [@{$form_begin}@][@{$hidden_fields}@]            
              <div class="box">
                <div class="box-body">          
                  <div class="form-horizontal">
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_page_in_menu#}@]</b></div>
                      <div class="col-sm-6 col-xs-12 radio">
                        <span class="radio-wrapper-in-form-horizontal-first">[@{$radio_page_not_in_menu_0}@]</span>[@{#text_page_in_menu_yes#}@]<span class="radio-wrapper-in-form-horizontal-not-first">[@{$radio_page_not_in_menu_1}@]</span>[@{#text_page_in_menu_no#}@]
                      </div>
                    </div>                                        
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_edit_sort_order#}@]</b></div>
                      <div class="col-md-2 col-sm-3 col-xs-4">
                        [@{$input_sort_order|replace:'<input':'<input class="form-control"'}@]
                      </div>
                    </div>                     
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_connection_type#}@]</b></div>
                      <div class="col-md-2 col-sm-3 col-xs-5">
                        [@{$pull_down_link_request_type|replace:'<select':'<select class="form-control"'}@]
                      </div>
                    </div>                                        
                    [@{if $update}@]                    
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_edit_status#}@]</b></div> 
                      <div class="col-sm-6 col-xs-12 radio">                
                        <span class="radio-wrapper-in-form-horizontal-first">[@{$radio_status_1}@]</span>[@{#text_status_active#}@]<span class="radio-wrapper-in-form-horizontal-not-first">[@{$radio_status_0}@]</span>[@{#text_status_inactive#}@]
                      </div>
                    </div>  
                    [@{/if}@]                    
                    [@{foreach name=name item=page_data from=$pages_data}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.name.first}@]<b>[@{#text_edit_pages_name#}@]</b>[@{/if}@]</div>
                      <div class="col-sm-6 col-xs-9 text-nowrap">
                        <div class="input-group">
                          <span class="input-group-addon">[@{$page_data.languages_image}@]</span>[@{$page_data.input_name|replace:'<input':'<input class="form-control"'}@]
                        </div>    
                      </div>      
                    </div>        
                    [@{/foreach}@]                                                        
                    [@{foreach name=heading_title item=page_data from=$pages_data}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.heading_title.first}@]<b>[@{#text_edit_pages_heading_title#}@]</b>[@{/if}@]</div>
                      <div class="col-lg-7 col-sm-8 col-xs-12 text-nowrap">
                        <div class="input-group">
                          <span class="input-group-addon">[@{$page_data.languages_image}@]</span>[@{$page_data.input_heading_title|replace:'<input':'<input class="form-control"'}@]
                        </div>    
                      </div>      
                    </div>        
                    [@{/foreach}@] 
                    [@{if $wysiwyg}@]
                    [@{foreach name=page item=page_data from=$pages_data}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{if $smarty.foreach.page.first}@][@{#text_edit_pages_description#}@][@{/if}@]</b><br>[@{$page_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$page_data.page_textarea|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
<script>
  CKEDITOR.replace( '[@{$page_data.page_description}@]',
    {
      baseHref: '[@{$page_base_href}@]',
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$page_config}@]',
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$page_data.page_template_file}@]' ],
      templates: '[@{$page_data.page_template_lang}@]'     
    });
</script>                       
                    </div>               
                    [@{/foreach}@]
                    [@{else}@] 
                    [@{foreach name=page item=page_data from=$pages_data}@]              
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{if $smarty.foreach.page.first}@][@{#text_edit_pages_description#}@][@{/if}@]</b><br>[@{$page_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$page_data.page_textarea|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
                    </div>                                       
                    [@{/foreach}@]                             
                    [@{/if}@]                                      
                    [@{foreach name=php_source item=page_data from=$pages_data}@]
                    [@{if $php_code_included}@] 
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.php_source.first}@]<a class="btn btn-danger textarea-unlock" title=" [@{#button_title_unlock#}@] ">[@{#button_text_unlock#}@]</a><a class="btn btn-success textarea-lock" style="display: none;" title=" [@{#button_title_lock#}@] ">[@{#button_text_lock#}@]</a><br><b>[@{#text_embedded_php_code#}@]</b>[@{/if}@]<br>[@{$page_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$page_data.page_textarea_php_source|replace:'class="':'class="form-control '}@]
                      </div>
                    </div>                  
                    [@{else}@]               
                    [@{if $smarty.foreach.php_source.first}@]  
                      <div class="text-embed-php-code-wrapper"><b>[@{#text_embed_php_code#}@]</b>&nbsp;<img id="icon_arrow_down" class="icon-arrow-down" src="[@{$images_path}@]icon_arrow_down.gif" height="15" width="24" title=" [@{#text_embed_php_code#}@] " alt="[@{#text_embed_php_code#}@]" /></div>               
                    [@{/if}@]               
                    <div class="textareas_php_code form-group clearfix" style="display: none;">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.php_source.first}@]<a class="btn btn-danger textarea-unlock" title=" [@{#button_title_unlock#}@] ">[@{#button_text_unlock#}@]</a><a class="btn btn-success textarea-lock" style="display: none;" title=" [@{#button_title_lock#}@] ">[@{#button_text_lock#}@]</a><br><b>[@{#text_embedded_php_code#}@]</b>[@{/if}@]<br>[@{$page_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$page_data.page_textarea_php_source|replace:'class="':'class="form-control '}@]
                      </div>
                    </div>                         
                    [@{/if}@]              
                    [@{/foreach}@]                                                  
                  </div>     
<script>
  $("#icon_arrow_down").click(function() {
    $(".textareas_php_code").toggle();
  });
  $(".textarea-unlock").click(function() {
    $(".textarea-php-code").attr("readonly", false);
    $(".textarea-unlock").css("display", "none");
    $(".textarea-lock").css("display", "");
  });
  $(".textarea-lock").click(function() {
    $(".textarea-php-code").attr("readonly", true);
    $(".textarea-unlock").css("display", "");
    $(".textarea-lock").css("display", "none");  
  });
</script>
                </div>
              </div>         
              <a href="[@{$link_filename_pages}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a> 
              [@{if $update}@]
              <a href="" onclick="if(update_page.onsubmit())update_page.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>
              [@{else}@]
              <a href="" onclick="if(insert_page.onsubmit())insert_page.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a>
              [@{/if}@]      
            [@{$form_end}@]        
            </div>            
          </div>
        </section>
      </div>
<!-- new_page_eof -->