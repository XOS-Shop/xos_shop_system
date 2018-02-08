[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.8
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : admin_members.tpl
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
<!-- admin_members --> 
      <div class="content-wrapper">
        <section class="content-header">
          <h1>[@{$heading_title}@]</h1>
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
          [@{if $g_path}@]
            [@{$form_begin_define}@][@{$hidden_admin_groups_id}@]
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table">
                    <tr class="data-table-heading-row">
                      <th colspan="2">[@{#table_heading_groups_define#}@]</th>
                    </tr>
                    [@{foreach name=outer item=box from=$boxes}@]                                                
                    <tr>
                      <td style="width: 23px; border-top : none;">[@{$box.checkbox}@]</td>
                      <td style="border-top : none;"><label for="[@{$box.checkbox_id}@]">[@{$box.box_name}@]</label>[@{$box.hidden_checked}@][@{$box.hidden_unchecked}@]</td>
                    </tr>                     
                    <tr>
                      <td style="border-top : none;">&nbsp;</td>
                      <td style="border-top : none;">
                        <table style="margin-top: -15px;">
                        [@{foreach name=inner item=file from=$box.files}@]
                          <tr>
                            <td style="width: 20px;">[@{$file.checkbox}@]</td>
                            <td><label style="font-weight: normal;" for="[@{$file.checkbox_id}@]">[@{$file.file_name}@]</label>[@{$file.hidden_checked}@][@{$file.hidden_unchecked}@]</td>
                          </tr>
                        [@{/foreach}@]
                        </table>
                      </td>
                    </tr>                              
                    [@{/foreach}@]
                  </table>
                </div>
              </div>            
              [@{if $link_filename_admin_members}@]
                <a href="" onclick="defineForm.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a><a href="[@{$link_filename_admin_members}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a>
              [@{else}@]              
                <a href="" onclick="defineForm.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>               
              [@{/if}@]                       
            </div>
            [@{$form_end}@]           
          [@{elseif $g_id}@]
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_groups_name#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                    [@{foreach item=group from=$groups}@]
                    [@{if $group.selected}@]                                               
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$group.link_filename_admin_members}@]'">
                      <td>[@{$group.name}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$group.link_filename_admin_members}@]'">
                      <td>[@{$group.name}@]</td>
                      <td class="text-right"><a href="[@{$member.link_filename_admin_members}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]
                  </table>
                </div>
              </div>
              <div class="pagination-wrapper">
                [@{#text_count_groups#}@][@{$groups_counter}@]
              </div>
              <a href="[@{$link_filename_admin_members}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_group#}@] ">[@{#button_text_new_group#}@]</a>              
            </div>          
          [@{else}@]
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_name#}@]</th>
                      <th>[@{#table_heading_email#}@]</th>
                      <th class="text-center">[@{#table_heading_groups#}@]</th>
                      <th class="text-center">[@{#table_heading_lognum#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                    [@{foreach item=member from=$members}@]
                    [@{if $member.selected}@]                                                  
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$member.link_filename_admin_members}@]'">
                      <td>[@{$member.firstname}@]&nbsp;[@{$member.lastname}@]</td>
                      <td>[@{$member.email_address}@]</td>
                      <td class="text-center">[@{$member.group_name}@]</td>
                      <td class="text-center">[@{$member.lognum}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$member.link_filename_admin_members}@]'">
                      <td>[@{$member.firstname}@]&nbsp;[@{$member.lastname}@]</td>
                      <td>[@{$member.email_address}@]</td>
                      <td class="text-center">[@{$member.group_name}@]</td>
                      <td class="text-center">[@{$member.lognum}@]</td>
                      <td class="text-right"><a href="[@{$member.link_filename_admin_members}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
              <a href="[@{$link_filename_admin_members}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_member#}@] ">[@{#button_text_new_member#}@]</a>              
            </div> 
          [@{/if}@]
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_admin_members}@]         
            </div>              
          </div>
        </section>
      </div>
<!-- admin_members_eof -->