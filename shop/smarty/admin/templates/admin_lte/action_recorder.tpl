[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.9
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : action_recorder.tpl
* author     : Hanspeter Zeller <hpz@xos-shop.com>
* copyright  : Copyright (c) 2014 Hanspeter Zeller
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
<!-- action_recorder -->
      <div class="content-wrapper">    
        <section class="content-header clearfix">
          <h1 class="pull-left">[@{#heading_title#}@]</h1>
          <div class="pull-right">             
            <div class="pull-right" style="margin-left: 20px">[@{$form_begin_filter}@]<div class="pull-right">[@{$pull_down_module|replace:'<select':'<select class="form-control" id="module_id"'}@][@{$hidden_search}@][@{$hidden_field_session}@]</div>[@{$form_end}@]</div>
            <div class="pull-right" style="margin-left: 20px">[@{$form_begin_search}@]<label class="control-label text-right pull-left" for="search_id">[@{#heading_title_search#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$input_search|replace:'<input':'<input class="form-control" id="search_id"'}@][@{$hidden_module}@][@{$hidden_field_session}@]</div>[@{$form_end}@]</div>
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
                      <th class="text-center">[@{#table_heading_success#}@]</th>
                      <th>[@{#table_heading_module#}@]</th>
                      <th>[@{#table_heading_user_name#}@]</th>
                      <th class="text-center">[@{#table_heading_date_added#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>                     
                    </tr>
                    [@{foreach item=action from=$actions}@]
                    [@{if $action.selected}@]                                              
                    <tr class="data-table-rows-elected">
                      <td class="text-center">[@{if $action.success_flag}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
                      <td>[@{$action.module_title}@]</td>
                      <td>[@{$action.user_name}@]</td>
                      <td class="text-center">[@{$action.date_added}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$action.link_filename_action_recorder}@]'">
                      <td class="text-center">[@{if $action.success_flag}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
                      <td>[@{$action.module_title}@]</td>
                      <td>[@{$action.user_name}@]</td>
                      <td class="text-center">[@{$action.date_added}@]</td>
                      <td class="text-right"><a href="[@{$action.link_filename_action_recorder}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
              [@{if $link_filename_action_recorder_delete}@]
              <a href="[@{$link_filename_action_recorder_delete}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_delete#}@] ">[@{#button_text_delete#}@]</a>
              [@{/if}@]                                           
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_action_recorder}@]         
            </div>              
          </div>
        </section>                       
      </div>     
<!-- action_recorder_eof -->