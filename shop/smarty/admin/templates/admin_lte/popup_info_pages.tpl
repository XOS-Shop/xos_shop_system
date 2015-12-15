[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.1
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : popup_info_pages.tpl
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
[@{$html_header}@]
<body class="hold-transition skin-purple sidebar-collapse">
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
  [@{if $action == 'preview'}@]        
          <div class="row">
            <div class="col-xs-12">                               
              <div class="clearfix">
                <a href="[@{$link_filename_popup_info_pages_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                   
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
              <a href="[@{$link_filename_popup_info_pages_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                          
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
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_popup_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>                     
                    [@{else}@]                                       
                    <tr class="data-table-row" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_popup_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><a href="[@{$content.link_filename_popup_info_pages}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_popup_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.sort_order}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>                             
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_popup_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.sort_order}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><a href="[@{$content.link_filename_popup_info_pages}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_popup_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>                
                    [@{else}@]              
                    <tr class="data-table-row" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_popup_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><a href="[@{$content.link_filename_popup_info_pages}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_popup_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr>              
                    [@{else}@]              
                    <tr class="data-table-row" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                      <td><a href="[@{$content.link_filename_popup_info_pages_preview}@]"><i class="fa fa-fw fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a></td>
                      <td class="text-center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                      <td>[@{$content.name}@]</td>
                      <td>[@{$content.type}@]</td>
                      <td class="text-center">
                      [@{if $content.status}@]                
                        [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]
                      [@{/if}@]                                           
                      </td>
                      <td class="text-right"><a href="[@{$content.link_filename_popup_info_pages}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>               
                    [@{/if}@]
                    [@{/if}@]                        
                    [@{/foreach}@]                                      
                  </table>
                </div>
              </div>                           
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_popup_info_pages}@]         
            </div>              
          </div>
  [@{/if}@]
        </section>        
      </div>
<!-- info_pages_eof -->
</body>
</html>