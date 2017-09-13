[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.6
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : languages.tpl
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
<!-- languages -->    
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
                      <th>[@{#table_heading_language_name#}@]</th> 
                      <th>[@{#table_heading_language_code#}@]</th> 
                      <th class="text-right">[@{#table_heading_action#}@]</th>    
                    </tr> 
                    [@{foreach item=language from=$languages}@]
                    [@{if $language.selected}@]                                                                                         
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$language.link_filename_languages}@]'">
                      <td>[@{if $language.default_language}@]<b>[@{$language.name}@]&nbsp;([@{#text_default#}@])</b>[@{else}@][@{$language.name}@][@{/if}@]</td>
                      <td>[@{$language.code}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>                   
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$language.link_filename_languages}@]'">
                      <td>[@{if $language.default_language}@]<b>[@{$language.name}@]&nbsp;([@{#text_default#}@])</b>[@{else}@][@{$language.name}@][@{/if}@]</td>
                      <td>[@{$language.code}@]</td>
                      <td class="text-right"><a href="[@{$language.link_filename_languages}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
              [@{if $link_filename_languages_action_new}@]
              <a href="[@{$link_filename_languages_action_new}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_language#}@] ">[@{#button_text_new_language#}@]</a>
              [@{/if}@]              
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_languages}@]         
            </div>              
          </div>
        </section>
      </div>     
<!-- languages_eof -->