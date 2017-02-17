[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.4
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : pages.tpl
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
<!-- pages -->
      <div class="content-wrapper">
        <section class="content-header clearfix">
          <h1 class="pull-left">[@{#heading_title#}@] "[@{$current_page_name}@]"</h1>
          <div class="pull-right">[@{$form_begin_goto}@]<label class="control-label text-right pull-left" for="goto_page_id">[@{#heading_title_goto#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$pull_down_pages|replace:'<select':'<select class="form-control" id="goto_page_id"'}@]</div>[@{$form_end}@]</div>
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
                      <th>[@{#table_heading_pages#}@]</th>
                      <th>[@{#table_heading_sort_order#}@]</th>
                      <th>[@{#table_heading_page_name#}@]</th>
                      <th class="text-center">[@{#table_heading_in_menu#}@]</th>
                      <th class="text-center">[@{#table_heading_status#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                    [@{foreach item=page from=$pages}@]
                    [@{if $page.selected}@]                     
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{if $page.children}@][@{$page.link_filename_pages_get_path}@][@{else}@][@{$page.link_filename_pages_edit}@][@{/if}@]'">
                      <td>
                      [@{if $page.children}@]
                        <a href="[@{$page.link_filename_pages_get_path}@]"><i class="fa fa-files-o" title=" [@{eval var=#text_page_has_subpages#}@] "></i></a>
                      [@{else}@]
                        <i class="fa fa-file-o" title=" [@{#text_page_has_no_subpages#}@] "></i>
                      [@{/if}@]
                      </td>
                      <td>[@{$page.sort_order}@]</td>
                      <td>[@{$page.name}@]</td>
                      <td class="text-center">
                      [@{if $page.page_not_in_menu}@]
                        <a href="[@{$page.link_filename_pages_flag_not_in_menu_0}@]">[@{$page.icon_not_in_menu_green_light}@]</a>&nbsp;&nbsp;[@{$page.icon_not_in_menu_red}@]                                  
                      [@{else}@]
                        [@{$page.icon_not_in_menu_green}@]&nbsp;&nbsp;<a href="[@{$page.link_filename_pages_flag_not_in_menu_1}@]">[@{$page.icon_not_in_menu_red_light}@]</a>
                      [@{/if}@]                      
                      </td>
                      <td class="text-center">
                      [@{if $page.status}@]                
                        [@{$page.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$page.link_filename_pages_flag_status_0}@]">[@{$page.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$page.link_filename_pages_flag_status_1}@]">[@{$page.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$page.icon_status_red}@]
                      [@{/if}@]                      
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$page.link_filename_pages_cpath_cpath_cid}@]'">
                      <td>
                      [@{if $page.children}@]
                        <a href="[@{$page.link_filename_pages_get_path}@]"><i class="fa fa-files-o" title=" [@{eval var=#text_page_has_subpages#}@] "></i></a>
                      [@{else}@]
                        <i class="fa fa-file-o" title=" [@{#text_page_has_no_subpages#}@] "></i>
                      [@{/if}@]
                      </td>
                      <td>[@{$page.sort_order}@]</td>
                      <td>[@{$page.name}@]</td>
                      <td class="text-center">
                      [@{if $page.page_not_in_menu}@]
                        <a href="[@{$page.link_filename_pages_flag_not_in_menu_0}@]">[@{$page.icon_not_in_menu_green_light}@]</a>&nbsp;&nbsp;[@{$page.icon_not_in_menu_red}@]                                  
                      [@{else}@]
                        [@{$page.icon_not_in_menu_green}@]&nbsp;&nbsp;<a href="[@{$page.link_filename_pages_flag_not_in_menu_1}@]">[@{$page.icon_not_in_menu_red_light}@]</a>
                      [@{/if}@]                   
                      </td>
                      <td class="text-center">
                      [@{if $page.status}@]                
                        [@{$page.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$page.link_filename_pages_flag_status_0}@]">[@{$page.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$page.link_filename_pages_flag_status_1}@]">[@{$page.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$page.icon_status_red}@]
                      [@{/if}@]                     
                      </td>
                      <td class="text-right"><a href="[@{$page.link_filename_pages_cpath_cpath_cid}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]                  
                  </table>
                </div>
              </div>
              <div class="pagination-wrapper">
                [@{#text_pages#}@]&nbsp;[@{$pages_count}@]
              </div>              
              [@{if $link_filename_pages_action_new_page}@]                  
              <a href="[@{$link_filename_pages_action_new_page}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_page#}@] [@{$current_page_name}@] ">[@{#button_text_new_page#}@]&nbsp;"[@{$current_page_name}@]"</a>
              [@{/if}@]
              [@{if $link_filename_pages_back}@]
              <a href="[@{$link_filename_pages_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a> 
              [@{/if}@]                             
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_pages}@]         
            </div>              
          </div>
        </section>
      </div>
<!-- pages_eof -->