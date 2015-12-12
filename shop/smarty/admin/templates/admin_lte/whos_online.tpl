[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0 rc9
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : whos_online.tpl
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
<!-- whos_online -->   
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
                      <th>[@{#table_heading_online#}@]</th> 
                      <th class="text-center">[@{#table_heading_customer_id#}@]</th> 
                      <th>[@{#table_heading_full_name#}@]</th>
                      <th class="text-center">[@{#table_heading_ip_address#}@]</th>                       
                      <th>[@{#table_heading_entry_time#}@]</th>
                      <th class="text-center">[@{#table_heading_last_click#}@]</th> 
                      <th>[@{#table_heading_last_page_url#}@]</th>  
                    </tr> 
                    [@{foreach item=online from=$whos_online}@]
                    [@{if $online.selected}@]                                                                                      
                    <tr class="data-table-rows-elected">
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$online.link_filename_whos_online}@]'">
                    [@{/if}@]                    
                      <td>[@{$online.time_online}@]</td>
                      <td class="text-center">[@{$online.customer_id}@]</td>
                      <td>[@{$online.full_name}@]</td>
                      <td class="text-center">[@{$online.ip_address}@]</td>
                      <td>[@{$online.time_entry}@]</td>
                      <td class="text-center">[@{$online.time_last_click}@]</td>
                      <td>[@{$online.last_page_url}@]</td>
                    </tr>                          
                    [@{/foreach}@]
                  </table>
                </div>
              </div>
              <div class="clearfix pagination-wrapper">
                [@{$text_number_of_customers}@]
              </div>             
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_whos_online}@]         
            </div>              
          </div>
        </section>
      </div>        
<!-- whos_online_eof -->
