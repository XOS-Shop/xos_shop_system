[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.3
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : geo_zones.tpl
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
<!-- geo_zones -->    
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
                [@{if $action_list}@]
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_country#}@]</th> 
                      <th>[@{#table_heading_country_zone#}@]</th>                      
                      <th class="text-right">[@{#table_heading_action#}@]</th>    
                    </tr> 
                    [@{foreach item=zone from=$zones}@]
                    [@{if $zone.selected}@]                                                                                                           
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$zone.link_filename_geo_zones}@]'">
                      <td>[@{$zone.country_name}@]</td>
                      <td>[@{$zone.zone_name}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>                   
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$zone.link_filename_geo_zones}@]'">
                      <td>[@{$zone.country_name}@]</td>
                      <td>[@{$zone.zone_name}@]</td>
                      <td class="text-right"><a href="[@{$zone.link_filename_geo_zones}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]
                  </table>
                [@{else}@]   
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_tax_zones#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>    
                    </tr> 
                    [@{foreach item=zone from=$zones}@]
                    [@{if $zone.selected}@]                                                                                        
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$zone.link_filename_geo_zones}@]'">
                      <td><a href="[@{$zone.link_filename_geo_zones_action_list}@]"><i class="fa fa-folder" title=" [@{#icon_title_folder#}@] "></i></a>&nbsp;&nbsp;[@{$zone.geo_zone_name}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>                   
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$zone.link_filename_geo_zones}@]'">
                      <td><a href="[@{$zone.link_filename_geo_zones_action_list}@]"><i class="fa fa-folder" title=" [@{#icon_title_folder#}@] "></i></a>&nbsp;&nbsp;[@{$zone.geo_zone_name}@]</td>
                      <td class="text-right"><a href="[@{$zone.link_filename_geo_zones}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]
                  </table>
                [@{/if}@]                    
                </div>
              </div>
              <div class="clearfix pagination-wrapper">
                <div class="pull-left">[@{$nav_bar_number}@]</div>
                <div class="pull-right">[@{$nav_bar_result}@]</div>
              </div>
              [@{if $link_filename_geo_zones_saction_new}@]
              <a href="[@{$link_filename_geo_zones_saction_new}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a>
              <a href="[@{$link_filename_geo_zones}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
              [@{elseif $link_filename_geo_zones_action_new_zone}@]
              <a href="[@{$link_filename_geo_zones_action_new_zone}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a>
              [@{/if}@]                                                    
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_geo_zones}@]         
            </div>              
          </div>
        </section>
      </div>     
<!-- geo_zones_eof -->