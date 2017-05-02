[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.5
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : modules.tpl
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
<!-- modules -->
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
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_modules#}@]</th>
                      <th class="text-center">[@{#table_heading_sort_order#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                    [@{foreach item=module from=$modules}@]
                    [@{if $module.selected}@]
                    <tr class="data-table-rows-elected"[@{if $module.installed}@] onclick="document.location.href='[@{$module.link_filename_modules}@]'"[@{/if}@]>
                      <td>[@{$module.title}@]</td>
                      <td class="text-center">[@{$module.sort_order}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$module.link_filename_modules}@]'">
                      <td>[@{$module.title}@]</td>
                      <td class="text-center">[@{$module.sort_order}@]</td>
                      <td class="text-right"><a href="[@{$module.link_filename_modules}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]                  
                  </table>
                </div>
              </div>
              <div class="pagination-wrapper">
                [@{#text_module_directory#}@]&nbsp;[@{$directory_path}@]
              </div>
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_modules}@]         
            </div>              
          </div>
        </section>
      </div>     
<!-- modules_eof -->