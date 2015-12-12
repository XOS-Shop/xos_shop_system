[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0 rc9
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : cache.tpl
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
<!-- cache -->    
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
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_cache#}@]</th>                     
                      <th class="text-right">[@{#table_heading_action#}@]</th>    
                    </tr> 
                    [@{foreach name=loop item=cache_block from=$cache_blocks}@]
                    <tr>
                      <td>[@{$cache_block.title}@]</td> 
                      <td class="text-right"><a href="[@{$cache_block.link_filename_cache_reset_block}@]" class="btn btn-danger btn-xs btn-margin-attributes pull-right" title=" [@{#image_reset#}@]:&nbsp;[@{$cache_block.title}@] ">[@{#button_text_delete#}@]</a></td>
                    </tr>
                    [@{if $smarty.foreach.loop.last}@]
                    <tr>
                      <td><b>[@{#text_cache_directory#}@]&nbsp;[@{$cache_dir}@]</b></td> 
                      <td class="text-right"><a href="[@{$link_filename_cache_reset_all_blocks}@]" class="btn btn-danger btn-xs btn-margin-attributes pull-right" title=" [@{#text_clear_all_cache#}@] ">[@{#text_clear_all_cache#}@]</a></td>
                    </tr>                     
                    [@{/if}@]                                           
                    [@{/foreach}@]
                  </table>
                </div>
              </div>
              <a href="[@{$link_filename_cache_reset_all_compiled_template_files}@]" class="btn btn-danger pull-right btn-margin-after-pagination" title=" [@{#button_title_clear_all_compiled_template_files#}@] ">[@{#button_text_clear_all_compiled_template_files#}@]</a>           
            </div>              
          </div>
        </section>
      </div>        
<!-- cache_eof -->