[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.2
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : backup.tpl
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
<!-- backup -->    
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
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_title#}@]</th> 
                      <th class="text-center">[@{#table_heading_file_date#}@]</th>                      
                      <th class="text-right">[@{#table_heading_file_size#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>    
                    </tr> 
                    [@{foreach item=backup from=$backups}@]
                    [@{if $backup.selected}@]                                                                                     
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$backup.link_filename_backup_onclick}@]'">
                      <td><a href="[@{$backup.link_filename_backup_action}@]"><i class="fa fa-download" title=" [@{#icon_title_file_download#}@] "></i></a>&nbsp; &nbsp;[@{$backup.file_name}@]</td>
                      <td class="text-center">[@{$backup.file_date}@]</td>
                      <td class="text-right">[@{$backup.file_size}@]&nbsp;bytes</td>                  
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>                   
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$backup.link_filename_backup_onclick}@]'">
                      <td><a href="[@{$backup.link_filename_backup_action}@]"><i class="fa fa-download" title=" [@{#icon_title_file_download#}@] "></i></a>&nbsp; &nbsp;[@{$backup.file_name}@]</td>
                      <td class="text-center">[@{$backup.file_date}@]</td>
                      <td class="text-right">[@{$backup.file_size}@]&nbsp;bytes</td> 
                      <td class="text-right"><a href="[@{$backup.link_filename_backup_file}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]
                  </table>
                </div>
              </div>
              <div class="pagination-wrapper">
                [@{#text_backup_directory#}@]&nbsp;[@{$backup_directory}@]
                [@{if $db_last_restore}@]
                <br>[@{#text_last_restoration#}@]&nbsp;[@{$db_last_restore}@]&nbsp;<a href="[@{$link_filename_backup_action_forget}@]">[@{#text_forget#}@]</a>
                [@{/if}@]                
              </div>
              [@{if $link_filename_backup_action_restorelocal}@]  
              <a href="[@{$link_filename_backup_action_restorelocal}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_restore#}@] ">[@{#button_text_restore#}@]</a>
              [@{/if}@]                 
              [@{if $link_filename_backup_action_backup}@]
              <a href="[@{$link_filename_backup_action_backup}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_backup#}@] ">[@{#button_text_backup#}@]</a>
              [@{/if}@]                            
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_backup}@]         
            </div>              
          </div>
        </section>
      </div>       
<!-- backup_eof -->