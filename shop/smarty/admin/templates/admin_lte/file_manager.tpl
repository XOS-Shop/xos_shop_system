[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.9
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : file_manager.tpl
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
<!-- file_manager -->  
      <div class="content-wrapper">    
        <section class="content-header clearfix"> 
          <h1 class="pull-left">[@{#heading_title#}@]<br><small>[@{$current_path}@]</small></h1>                    
          <div class="pull-right" style="margin-left: 20px">[@{$form_begin_goto}@][@{$pull_down_goto|replace:'<select':'<select class="form-control"'}@][@{$hidden_field_session}@][@{$form_end}@]</div>          
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
    [@{if $new_edit_file}@]   
          <div class="row">
            <div class="col-xs-12">                          
              [@{$form_begin_new_file}@] 
              <div class="box">
                <div class="box-body table-responsive">
                  <b>[@{#text_file_name#}@]</b> [@{$filename_or_input_filename}@]            
                  <div class="form-group">
                    <label for="textarea_id">[@{#text_file_contents#}@]</label>
                    [@{$textarea_file_contents|replace:'<textarea':'<textarea class="form-control" id="textarea_id"'}@]
                  </div>        
                </div>
              </div>              
              <a href="[@{$link_filename_file_manager}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a>
              [@{if $file_writeable}@]
              <a href="" onclick="new_file.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_save#}@] ">[@{#button_text_save#}@]</a>
              [@{/if}@]                                                                         
              [@{$form_end}@]                                                                           
            </div>              
          </div>          
    [@{else if $image_view}@]                        
          <div class="row">
            <div class="col-xs-12">                          
              <div class="clearfix">
                <a href="[@{$link_filename_file_manager}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                   
              </div>
              <div class="box">
                <div class="box-body table-responsive">
                  [@{#text_file_name#}@]&nbsp;&nbsp;<b>[@{$filename}@]</b>            
                  <div><img src="[@{$image_src}@]" alt="[@{$filename}@]" title=" [@{$filename}@] " [@{if $image_data[0] && $image_data[1]}@]width="[@{$image_data[0]}@]" height="[@{$image_data[1]}@]"[@{/if}@] /></div>       
                </div>
              </div>              
              <a href="[@{$link_filename_file_manager}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                                         
            </div>              
          </div>            
    [@{else}@]               
          <div class="row">
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_filename#}@]</th>
                      <th class="text-right">[@{#table_heading_size#}@]</th>
                      <th class="text-center">[@{#table_heading_permissions#}@]</th>
                      <th>[@{#table_heading_user#}@]</th>
                      <th>[@{#table_heading_group#}@]</th>
                      <th class="text-center">[@{#table_heading_last_modified#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>                     
                    </tr>
                    [@{foreach item=content from=$folders_and_files}@]
                    [@{if $content.selected}@]                              
                    <tr class="data-table-rows-elected">
                      <td onclick="document.location.href='[@{$content.link_onclick}@]'"><a href="[@{$content.link}@]">[@{$content.icon}@]</a>&nbsp;[@{$content.name}@]</td>
                      <td class="text-right" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.size}@]</td>
                      <td class="text-center" onclick="document.location.href='[@{$content.link_onclick}@]'"><samp>[@{$content.permissions}@]</samp></td>
                      <td onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.user}@]</td>
                      <td onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.group}@]</td>
                      <td class="text-center" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.last_modified}@]</td>                      
                      <td class="text-right">[@{if $content.link_delete}@]<a href="[@{$content.link_delete}@]"><img src="[@{$images_path}@]icons/delete.gif" alt="[@{#icon_title_delete#}@]" title=" [@{#icon_title_delete#}@] " /></a>&nbsp;[@{/if}@]<i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row">
                      <td onclick="document.location.href='[@{$content.link_onclick}@]'"><a href="[@{$content.link}@]">[@{$content.icon}@]</a>&nbsp;[@{$content.name}@]</td>
                      <td class="text-right" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.size}@]</td>
                      <td class="text-center" onclick="document.location.href='[@{$content.link_onclick}@]'"><samp>[@{$content.permissions}@]</samp></td>
                      <td onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.user}@]</td>
                      <td onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.group}@]</td>
                      <td class="text-center" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.last_modified}@]</td>                      
                      <td class="text-right">[@{if $content.link_delete}@]<a href="[@{$content.link_delete}@]"><img src="[@{$images_path}@]icons/delete.gif" alt="[@{#icon_title_delete#}@]" title=" [@{#icon_title_delete#}@] " /></a>&nbsp;[@{/if}@]<a href="[@{$content.link_filename_file_manager_info}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]
                  </table>
                </div>
              </div>                       
              <a href="[@{$link_filename_file_manager_reset}@]" class="btn btn-primary pull-left btn-margin-after-pagination" title=" [@{#button_title_reset#}@] ">[@{#button_text_reset#}@]</a>
              <a href="[@{$link_filename_file_manager_new_folder}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_folder#}@] ">[@{#button_text_new_folder#}@]</a><a href="[@{$link_filename_file_manager_new_file}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_file#}@] ">[@{#button_text_new_file#}@]</a><a href="[@{$link_filename_file_manager_upload}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_upload#}@] ">[@{#button_text_upload#}@]</a>
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_file_manager}@]         
            </div>              
          </div>
    [@{/if}@]                     
        </section>                       
      </div>     
<!-- file_manager_eof -->