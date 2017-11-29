[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : info_pages.tpl
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
<!-- info_pages -->
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
  [@{if $action == 'new'}@]       
          <div class="row">
            <div class="col-xs-12">           
            [@{$form_begin_new}@][@{$hidden_content_id}@]
<script>
function toggle(targetId, iState) // 1 visible, 0 hidden
{
   $(targetId).css('visibility', iState ? 'visible' : 'hidden');
}

function updateSort() {
  var selected_value = document.forms["content"].type.selectedIndex;
  var selectedVal = document.forms["content"].type[selected_value].value;
  var sortVal = document.forms["content"].sort_order.defaultValue;

  if (selectedVal == "info") {
    document.forms["content"].sort_order.value = sortVal;
    toggle('#sort1',1);
    toggle('#sort2',1);
    toggle('#sort3',1);
    toggle('#sort4',1);     
    toggle('#content_title_note',0);
  } else if (selectedVal == "index") {
    document.forms["content"].sort_order.value = "";
    toggle('#sort1',0);
    toggle('#sort2',0);
    toggle('#sort3',0);
    toggle('#sort4',0);         
    toggle('#content_title_note',1);     
  } else {
    document.forms["content"].sort_order.value = "";
    toggle('#sort1',0);
    toggle('#sort2',0);
    toggle('#sort3',0);
    toggle('#sort4',0);    
    toggle('#content_title_note',0); 
  }
}
</script>                       
              <div class="box">
                <div class="box-body">          
                  <div class="form-horizontal">                                  
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_content_type#}@]</b></div>
                      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-5">
                        [@{$pull_down_type|replace:'<select':'<select class="form-control"'}@]
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <div id="sort1" class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_content_sort#}@]</b></div>
                      <div id="sort2" class="col-md-2 col-sm-3 col-xs-4">
                        [@{$input_sort_order|replace:'<input':'<input class="form-control"'}@]
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <div id="sort3" class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_connection_type#}@]</b></div>
                      <div id="sort4" class="col-md-2 col-sm-3 col-xs-5">
                        [@{$pull_down_link_request_type|replace:'<select':'<select class="form-control"'}@]
                      </div>
                    </div>
                    [@{if $update}@]                           
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_content_status#}@]</b></div>
                      <div class="col-sm-6 col-xs-12 radio">
                        <span class="radio-wrapper-in-form-horizontal-first">[@{$radio_status_1}@]</span>[@{#text_status_active#}@]<span class="radio-wrapper-in-form-horizontal-not-first">[@{$radio_status_0}@]</span>[@{#text_status_inactive#}@]
                      </div>
                    </div>                                        
                    [@{/if}@]                                                                          
                    [@{foreach name=name item=content_data from=$contents_data}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.name.first}@]<b>[@{#text_content_name#}@]</b>[@{/if}@]</div>
                      <div class="col-sm-6 col-xs-9 text-nowrap">
                        <div class="input-group">
                          <span class="input-group-addon">[@{$content_data.languages_image}@]</span>[@{$content_data.input_name|replace:'<input':'<input class="form-control"'}@]
                        </div>    
                      </div>      
                    </div>        
                    [@{/foreach}@]                                                        
                    [@{foreach name=heading_title item=content_data from=$contents_data}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.heading_title.first}@]<b>[@{#text_content_title#}@]</b>[@{/if}@]</div>
                      <div class="col-lg-7 col-sm-8 col-xs-12 text-nowrap">
                        <div class="input-group">
                          <span class="input-group-addon">[@{$content_data.languages_image}@]</span>[@{$content_data.input_heading_title|replace:'<input':'<input class="form-control"'}@]
                        </div>    
                      </div>      
                    </div>        
                    [@{/foreach}@]
                    <div id="content_title_note" class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 "></div>
                      <div class="col-lg-7 col-sm-8 col-xs-12">[@{#text_content_title_note#}@]</div>        
                    </div>                                                          
                    [@{if $wysiwyg}@]
                    [@{foreach name=content item=content_data from=$contents_data}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{if $smarty.foreach.content.first}@][@{#text_content#}@][@{/if}@]</b><br>[@{$content_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$content_data.textarea_content|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
<script>
  CKEDITOR.replace( '[@{$content_data.content_name}@]',
    {
      baseHref: '[@{$info_pages_base_href}@]',
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$info_pages_config}@]',
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$content_data.info_pages_template_file}@]' ],
      templates: '[@{$content_data.info_pages_template_lang}@]'     
    });
</script>                                              
                    </div>               
                    [@{/foreach}@]
                    [@{else}@] 
                    [@{foreach name=content item=content_data from=$contents_data}@]              
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{if $smarty.foreach.content.first}@][@{#text_content#}@][@{/if}@]</b><br>[@{$content_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$content_data.textarea_content|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
                    </div>                                       
                    [@{/foreach}@]                             
                    [@{/if}@]                                                                                               
                    [@{foreach name=php_source item=content_data from=$contents_data}@]
                    [@{if $php_code_included}@] 
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.php_source.first}@]<a class="btn btn-danger textarea-unlock" title=" [@{#button_title_unlock#}@] ">[@{#button_text_unlock#}@]</a><a class="btn btn-success textarea-lock" style="display: none;" title=" [@{#button_title_lock#}@] ">[@{#button_text_lock#}@]</a><br><b>[@{#text_embedded_php_code#}@]</b>[@{/if}@]<br>[@{$content_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$content_data.textarea_php_source|replace:'class="':'class="form-control '}@]
                      </div>
                    </div>                  
                    [@{else}@]               
                    [@{if $smarty.foreach.php_source.first}@]  
                      <div class="text-embed-php-code-wrapper"><b>[@{#text_embed_php_code#}@]</b>&nbsp;<img id="icon_arrow_down" class="icon-arrow-down" src="[@{$images_path}@]icon_arrow_down.gif" height="15" width="24" title=" [@{#text_embed_php_code#}@] " alt="[@{#text_embed_php_code#}@]" /></div>               
                    [@{/if}@]               
                    <div class="textareas_php_code form-group clearfix" style="display: none;">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.php_source.first}@]<a class="btn btn-danger textarea-unlock" title=" [@{#button_title_unlock#}@] ">[@{#button_text_unlock#}@]</a><a class="btn btn-success textarea-lock" style="display: none;" title=" [@{#button_title_lock#}@] ">[@{#button_text_lock#}@]</a><br><b>[@{#text_embedded_php_code#}@]</b>[@{/if}@]<br>[@{$content_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$content_data.textarea_php_source|replace:'class="':'class="form-control '}@]
                      </div>
                    </div>                         
                    [@{/if}@]              
                    [@{/foreach}@]                                                  
                  </div>
<script>
updateSort();
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
              <a href="[@{$link_filename_info_pages_cancel}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a> 
              [@{if $update}@]
              <a href="" onclick="if(content.onsubmit())content.submit(); return false" return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>
              [@{else}@]
              <a href="" onclick="if(content.onsubmit())content.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_save#}@] ">[@{#button_text_save#}@]</a> 
              [@{* <a href="" onclick="if(content.onsubmit())content.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a> *}@]
              [@{/if}@]                  
            [@{$form_end}@]        
            </div>            
          </div>    
  [@{elseif $action == 'preview'}@]        
          <div class="row">
            <div class="col-xs-12">                               
              <div class="clearfix">
                <a href="[@{$link_filename_info_pages_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                   
              </div>                                                                                              
              [@{foreach name=name item=content_data from=$contents_data}@]
              <p>&nbsp;[@{$content_data.languages_image}@]</p>       
              <div class="box">
                <div class="box-body">                                                 
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_content_name#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$content_data.name}@]
                      </div>    
                    </div>      
                  </div>                     
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_content_title#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$content_data.heading_title}@]
                      </div>    
                    </div>      
                  </div>                    
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_content#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$content_data.content}@]
                      </div>    
                    </div>      
                  </div>                                             
                </div>                                                               
              </div>                            
              [@{/foreach}@]                                                                
              <a href="[@{$link_filename_info_pages_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                          
            </div>            
          </div>               
  [@{else}@]
          <div class="row">
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">                 
                    <tr class="data-table-heading-row">
                      <th>&nbsp;</th>
                      <th class="text-center">&nbsp;</th>
                      <th>[@{#table_heading_name#}@]</th>
                      <th>[@{#table_heading_module#}@]</th>
                      <th class="text-center">[@{#table_heading_status#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                    [@{foreach item=content from=$contents}@]
                    [@{if $content.type == 'index'}@]
                    [@{if $content.selected}@]                    
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>                     
                    [@{else}@]                                       
                    <tr class="data-table-row" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><a href="[@{$content.link_filename_info_pages}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]
                    [@{/if}@]                        
                    [@{/foreach}@]                    
                    [@{foreach item=content from=$contents}@]               
                    [@{if $content.first == 'info'}@] 
                    <tr class="data-table-heading-row">
                      <th>&nbsp;</th>
                      <th class="text-center">[@{#table_heading_sort#}@]</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th class="text-center">&nbsp;</th>
                      <th class="text-right">&nbsp;</th>
                    </tr>                                                                             
                    [@{/if}@]                          
                    [@{if $content.type == 'info'}@]
                    [@{if $content.selected}@]
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.sort_order}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>                             
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.sort_order}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><a href="[@{$content.link_filename_info_pages}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>                                  
                    [@{/if}@]
                    [@{/if}@]                                                              
                    [@{/foreach}@]                    
                    [@{foreach item=content from=$contents}@]               
                    [@{if $content.first == 'not_in_menu'}@] 
                    <tr class="data-table-heading-row">
                      <th>&nbsp;</th>
                      <th class="text-center">[@{#table_heading_content_id#}@]</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th class="text-center">&nbsp;</th>
                      <th class="text-right">&nbsp;</th>
                    </tr>                                                                   
                    [@{/if}@]                          
                    [@{if $content.type == 'not_in_menu'}@]
                    [@{if $content.selected}@]                           
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>                
                    [@{else}@]              
                    <tr class="data-table-row" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><a href="[@{$content.link_filename_info_pages}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>               
                    [@{/if}@]
                    [@{/if}@]                                                              
                    [@{/foreach}@]                                          

                    [@{foreach item=content from=$contents}@]
                    [@{if $content.first == 'system_popup'}@]
                    <tr class="data-table-heading-row">
                      <th>&nbsp;</th>
                      <th class="text-center">[@{#table_heading_popup_id#}@]</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th class="text-center">&nbsp;</th>
                      <th class="text-right">&nbsp;</th>
                    </tr>                                                        
                    [@{/if}@]                
                    [@{if $content.type == 'system_popup'}@]
                    [@{if $content.selected}@]              
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>              
                    [@{else}@]              
                    <tr class="data-table-row" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><a href="[@{$content.link_filename_info_pages}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>               
                    [@{/if}@]
                    [@{/if}@]                        
                    [@{/foreach}@]                                      
                  </table>
                </div>
              </div>
              <a href="[@{$link_filename_info_pages_new}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_content#}@] ">[@{#button_text_new_content#}@]</a>                             
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_info_pages}@]         
            </div>              
          </div>
  [@{/if}@]
        </section>        
      </div>
<!-- info_pages_eof -->