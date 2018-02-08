[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.8
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : attributes_options.tpl
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
<!-- options --> 
              [@{if $delete_product_option}@]
              <h4>[@{$products_options_name}@]</h4>
              <div style="height: 30px;">&nbsp;</div>                
              [@{if $products_linked}@] 
              <div class="box"> 
                <div class="box-body table-responsive no-padding">
                  <table class="table">
                    <tr class="data-table-heading-row">
                      <th class="text-center">[@{#table_heading_id#}@]</th>
                      <th>[@{#table_heading_opt_value#}@]</th>                                                          
                    </tr>
                    [@{foreach name=products_values item=products_value from=$products_values}@] 
                    <tr>                    
                      <td class="text-center">[@{$products_value.id}@]</td>
                      <td class="smallText">[@{$products_value.name}@]</td>
                    </tr>
                    [@{/foreach}@]
                  </table>  
                </div>
              </div>
              <div class="clearfix">
                [@{#text_warning_of_delete_option#}@]
                <a href="[@{$link_filename_products_attributes}@]" class="btn btn-primary btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a>
              </div>
              [@{else}@]
              <div class="clearfix" style="padding-top: 10px; border-top: 1px solid black;">
                [@{#text_ok_to_delete_option#}@]
                <a href="[@{$link_filename_products_attributes}@]" class="btn btn-primary btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="[@{$link_filename_products_attributes_delete}@]" class="btn btn-danger btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_delete#}@] ">[@{#button_text_delete#}@]</a>
              </div>
              [@{/if}@]                                                                                                             
              [@{else}@]                       
              <h4>[@{#heading_title_opt#}@]</h4>            
              <div style="height: 30px;">[@{$split_page}@]</div>          
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_opt_name#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>                                                          
                    </tr> 
                    [@{foreach name=options item=option from=$options}@]
                    [@{if $option.inputs_name}@]                     
                    [@{if $option.error_message}@]                
                    <tr class="data-table-heading-row">                                            
                      <td colspan="2">[@{$option.error_message}@]</td>                           
                    </tr>                                    
                    [@{/if}@]
                    <tr>                                            
                      <td colspan="2">
                        [@{$option.form_begin_option}@]
                        <div class="col-xs-8 text-nowrap" style="padding-left: 0;">
                          [@{$option.inputs_name|replace:'class="smallText"':'class="form-control input-sm" style="max-width: 65%; display: inline-block;"'}@][@{$option.hidden_id}@]
                        </div>
                        <div class="col-xs-4 text-right" style="padding-right: 0;">
                          <a href="[@{$option.link_filename_products_attributes}@]" class="btn btn-default btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="option.submit(); return false" class="btn btn-default btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>
                        </div>
                        [@{$option.form_end}@]                      
                      </td>                            
                    </tr>                                                                                                
                    [@{else}@]                    
                    <tr>          
                      <td>[@{$option.name}@]</td>            
                      <td class="text-right"><a href="[@{$option.link_filename_products_attributes_action_delete}@]" class="btn btn-danger btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_delete#}@] ">[@{#button_text_delete#}@]</a><a href="[@{$option.link_filename_products_attributes_action_update}@]" class="btn btn-default btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_edit#}@] ">[@{#button_text_edit#}@]</a></td> 
                    </tr>                    
                    [@{/if}@]                                        
                    [@{/foreach}@]
                    <tr class="data-table-heading-row">
                      <td colspan="2" style="margin: 0; padding: 0; line-height: 0;"><img src="[@{$images_path}@]pixel_black.gif" style="width: 100%; height: 1px;" alt=""></td>
                    </tr>                    
                    [@{if $form_begin_option}@]              
                    [@{if $error_message}@]                
                    <tr class="data-table-heading-row">                                            
                      <td colspan="2">[@{$error_message}@]</td>                           
                    </tr>                                 
                    [@{/if}@]                                
                    <tr>                                            
                      <td colspan="2">
                        [@{$form_begin_option}@]
                        <div class="col-xs-8 text-nowrap" style="padding-left: 0;">
                          [@{$inputs_name|replace:'class="smallText"':'class="form-control input-sm" style="max-width: 65%; display: inline-block;"'}@]
                        </div>
                        <div class="col-xs-4 text-right" style="padding-right: 0;">
                          <a href="" onclick="options.submit(); return false" class="btn btn-default btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a>
                        </div>
                        [@{$form_end}@]                      
                      </td>                            
                    </tr>                                 
                    [@{/if}@]                                                           
                  </table>  
                </div>
              </div> 
              [@{/if}@]                                
<!-- options_eof -->