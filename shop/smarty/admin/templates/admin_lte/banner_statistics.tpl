[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.2
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : banner_statistics.tpl
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
<!-- banner_statistics -->    
      <div class="content-wrapper">    
        <section class="content-header clearfix">
          <h1 class="pull-left">[@{#heading_title#}@]</h1>
          <div class="pull-right">
            [@{$form_begin}@]             
            [@{if $case_daily}@]
            <div class="pull-right" style="margin-left: 20px"><label class="control-label text-right pull-left" for="year_id">[@{#title_year#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$pull_down_year|replace:'<select':'<select class="form-control" id="year_id"'}@]</div></div>            
            <div class="pull-right" style="margin-left: 20px"><label class="control-label text-right pull-left" for="month_id">[@{#title_month#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$pull_down_month|replace:'<select':'<select class="form-control" id="month_id"'}@]</div></div>
            [@{elseif $case_monthly}@]
            <div class="pull-right" style="margin-left: 20px"><label class="control-label text-right pull-left" for="year_id">[@{#title_year#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$pull_down_year|replace:'<select':'<select class="form-control" id="year_id"'}@]</div></div>
            [@{/if}@]
            <div class="pull-right" style="margin-left: 20px"><label class="control-label text-right pull-left" for="type_id">[@{#title_type#}@]&nbsp;&nbsp;</label><div class="pull-right">[@{$pull_down_type|replace:'<select':'<select class="form-control" id="type_id"'}@]</div></div>            
            [@{$hidden_field_page}@][@{$hidden_field_bid}@][@{$hidden_field_session}@][@{$form_end}@]
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
            <div class="col-xs-12">                                                                                                                                 
              <div class="box">
                <div class="box-body table-responsive">                  
                  <div style="margin: 0 auto; width: 600px;">
                  [@{if $function_exists_imagecreate}@]        
                  [@{$banner_graph}@]
                  [@{$javascript}@]         
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                     <th>[@{#table_heading_source#}@]</th>
                     <th class="text-right">[@{#table_heading_views#}@]</th>
                     <th class="text-right">[@{#table_heading_clicks#}@]</th>
                    </tr>
                    [@{foreach item=stat_value from=$stat_values}@]           
                    <tr class="data-table-row">
                      <td>[@{$stat_value.source}@]</td>
                      <td class="text-right">[@{$stat_value.views}@]</td>
                      <td class="text-right">[@{$stat_value.clicks}@]</td>
                    </tr>
                    [@{/foreach}@]            
                  </table>
                  [@{else}@]
                  [@{$html_banner_graph}@]
                  [@{/if}@]                  
                  </div>          
                </div>
              </div> 
              <a href="[@{$link_filename_banner_manager}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                           
            </div>            
          </div>
        </section>        
      </div>       
<!-- banner_statistics_eof -->