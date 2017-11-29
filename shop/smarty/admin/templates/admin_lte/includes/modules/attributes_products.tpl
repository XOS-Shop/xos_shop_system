[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : attributes_products.tpl
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
<!-- attributes_products --> 
            <div class="col-xs-12">
              <h4>[@{#heading_title_atrib#}@]</h4>            
            </div>
            <div class="col-md-6 col-sm-4">
              [@{$split_page}@]<br>
            </div>
            <div class="col-md-6 col-sm-8">            
              <div class="form-horizontal">
                [@{$form_begin_tax_rates}@]                                 
                <div class="form-group clearfix">
                  <div class="col-lg-2 col-md-3 col-sm-3 control-label text-nowrap"><b>[@{#text_products_tax_rates#}@]</b></div>
                  <div class="col-lg-8 col-md-9 col-sm-9 col-xs-10">
                    [@{$pull_down_tax_rates|replace:'class="smallText"':'class="form-control input-sm"'}@]
                  </div>
                </div>
                [@{$hidden_fields}@][@{$hidden_field_session}@][@{$form_end}@]
              </div>                                     
            </div>                         
            <div class="col-xs-12">                               
              <div class="box">
                <div class="box-body table-responsive no-padding"> 
                [@{if $no_products}@]
                  <table class="table">
                    <tr>
                      <td class="text-center"><b>[@{#text_no_products_1#}@]</b><br>[@{#text_no_products_2#}@]</td>
                    </tr> 
                  </table>          
                [@{else}@]                                  
[@{$javascript}@]                                 
                  [@{$form_begin_attributes}@]
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>[@{#table_heading_product#}@]</th>
                      <th>[@{#table_heading_opt_name#}@]</th>
                      <th>[@{#table_heading_opt_value#}@]</th>            
                      <th class="text-right">[@{#table_heading_opt_price#}@]:</th>                        
                      <th class="text-center">([@{#table_heading_opt_price_prefix#}@]</th>            
                      <th class="text-right">[@{#table_heading_opt_price_net#}@]</th>        
                      <th class="text-right">[@{#table_heading_opt_price_gross#}@])</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                   [@{if $previous_product_the_same}@] 
                    <tr class="data-table-heading-row">
                      <td></td>
                      <td></td>
                      <td colspan="8" style="margin: 0; padding: 0 0 0 15px; line-height: 10px;"><img src="[@{$images_path}@]arrow_previous.gif" alt="" /></td>
                    </tr>                            
                   [@{/if}@]
                   [@{foreach name=attributes item=attribute from=$attributes}@]
                    <tr>
                    [@{if $attribute.action == 'update'}@]
                      <td>&nbsp;</td>
                      <td>[@{$attribute.products_status_image}@]</td>
                      <td>[@{$attribute.products_name}@][@{$attribute.hidden_ids}@]</td>
                      <td>[@{$attribute.inputs_options_name|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>
                      <td>[@{$attribute.inputs_options_value|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>  
                      <td class="text-right">&nbsp;</td>                       
                      <td class="text-center">[@{$attribute.input_price_prefix|replace:'class="smallText"':'class="form-control input-sm"'|replace:'style="':'style="min-width: 30px; '}@]</td>            
                      <td class="text-right">[@{$attribute.input_value_price|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>            
                      <td class="text-right">[@{$attribute.input_value_price_gross|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>                       
                      <td class="text-right"><a href="[@{$attribute.link_filename_products_attributes_attribute_page}@]" class="btn btn-default btn-xs pull-right btn-margin-attributes" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="attribute.submit(); return false" class="btn btn-default btn-xs pull-right btn-margin-attributes" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a></td>
                    [@{if $download}@]
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>         
                      <td colspan="7">
                        <table>
                          <tr>
                            <td><b>[@{#table_heading_download#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                            <td>[@{#table_text_filename#}@]&nbsp;</td>
                            <td>[@{$attribute.input_attributes_filename|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>
                            <td>&nbsp;&nbsp;&nbsp;[@{#table_text_max_days#}@]&nbsp;</td>
                            <td>[@{$attribute.input_attributes_maxdays|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>
                            <td>&nbsp;&nbsp;&nbsp;[@{#table_text_max_count#}@]&nbsp;</td>
                            <td>[@{$attribute.input_attributes_maxcount|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>
                          </tr>
                        </table>
                      </td>            
                    [@{/if}@]
                    [@{elseif $attribute.action == 'delete'}@]
                      <td>&nbsp;</td>
                      <td>[@{$attribute.products_status_image}@]</td>          
                      <td>[@{$attribute.products_name}@]</td>
                      <td>[@{$attribute.option_name}@]</td>
                      <td><span style="color : red; font-weight : bold;">[@{$attribute.value_name}@]</span></td>             
                      <td class="text-right">&nbsp;</td>                       
                      <td class="text-center"><span style="color : red; font-weight : bold;">[@{$attribute.price_prefix}@]</span></td>            
                      <td class="text-right"><span style="color : red; font-weight : bold;">[@{$attribute.values_price}@]</span></td>            
                      <td class="text-right"><span style="color : red; font-weight : bold;">[@{$attribute.values_price_gross}@]</span></td>            
                      <td class="text-right"><a href="[@{$attribute.link_filename_products_attributes_option_page}@]" class="btn btn-default btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="[@{$attribute.link_filename_products_attributes_delete_attribute}@]" class="btn btn-danger btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_confirm#}@] ">[@{#button_text_confirm#}@]</a></td>          
                    [@{else}@]              
                      <td>[@{if $attribute.products_name}@][@{if $attribute.attributes_up_to_date}@]<a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); get_attribute_lists('[@{$attribute.attributes_combs_list_url}@]', '[@{$attribute.box_id_combs}@]'); toggle_box_sort('[@{$attribute.box_id_combs}@]'); return false" class="btn btn-default btn-xs btn-margin-attributes pull-right" title="[@{#button_title_combinations#}@]">[@{#button_text_combinations#}@]</a>[@{else}@]<a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); get_attribute_lists('[@{$attribute.attributes_combs_list_url}@]', '[@{$attribute.box_id_combs}@]'); toggle_box_sort('[@{$attribute.box_id_combs}@]'); return false" class="btn btn-danger btn-xs btn-margin-attributes pull-right" title="[@{#button_title_combinations_update#}@]">[@{#button_text_combinations_update#}@]</a>[@{/if}@][@{/if}@]</td>                        
                      <td>[@{$attribute.products_status_image}@]</td>
                      <td>
                        [@{if $attribute.products_name}@]                  
                        <div id="[@{$attribute.box_id_combs}@]_1" style="display:none; position:relative; left:0px; top:0px;">               
                          <div id="[@{$attribute.box_id_combs}@]_2" style="display:none; position:absolute; left:-2px; top:-19px; background-color:#ffffcc; padding-left:12px; padding-top:14px; padding-right:12px; padding-bottom:14px; border: 1px solid #d2d6de;">                                                                                                             
                            <table> 
                              <tr>
                                <td class="text-nowrap"><b>[@{#text_loading#}@]</b></td>                         
                              </tr>                                                                                                                      
                            </table>                                  
                          </div>                
                        </div>                                                                        
                        <div id="[@{$attribute.box_id_sort_options}@]_1" style="display:none; position:relative; left:0px; top:0px;">               
                          <div id="[@{$attribute.box_id_sort_options}@]_2" style="display:none; position:absolute; left:-2px; top:-19px; background-color:#ffffcc; padding-left:12px; padding-top:14px; padding-right:12px; padding-bottom:14px; border: 1px solid #d2d6de;">                                                                
                            <table> 
                              <tr>
                                <td class="text-nowrap"><b>[@{#text_loading#}@]</b></td>                         
                              </tr>                                                                                                                      
                            </table>                                   
                          </div>                
                        </div>                                  
                        <a class="updateAttribute" href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); get_attribute_lists('[@{$attribute.attributes_options_sort_url}@]', '[@{$attribute.box_id_sort_options}@]'); toggle_box_sort('[@{$attribute.box_id_sort_options}@]'); return false" title=" [@{#text_options_sort_order#}@] ">[@{$attribute.products_name}@]</a>
                        [@{/if}@]
                      </td>                             
                      <td>
                        [@{if $attribute.option_name}@]                
                        <div id="[@{$attribute.box_id_sort_options_values}@]_1" style="display:none; position:relative; left:0px; top:0px;">               
                          <div id="[@{$attribute.box_id_sort_options_values}@]_2" style="display:none; position:absolute; left:-2px; top:-19px; background-color:#ffffcc; padding-left:12px; padding-top:14px; padding-right:12px; padding-bottom:14px; border: 1px solid #d2d6de;">                                                                
                            <table> 
                              <tr>
                                <td class="text-nowrap"><b>[@{#text_loading#}@]</b></td>                         
                              </tr>                                                                                                                      
                            </table>                                
                          </div>                
                        </div>                                  
                        <a class="updateAttribute" href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); get_attribute_lists('[@{$attribute.attributes_options_values_sort_url}@]', '[@{$attribute.box_id_sort_options_values}@]'); toggle_box_sort('[@{$attribute.box_id_sort_options_values}@]'); return false" title=" [@{#text_option_values_sort_order#}@] ">[@{$attribute.option_name}@]</a>
                        [@{/if}@]
                      </td>
                      <td>[@{$attribute.value_name}@]</td>            
                      <td class="text-right">&nbsp;</td>                        
                      <td class="text-center">[@{$attribute.price_prefix}@]</td>            
                      <td class="text-right">[@{$attribute.values_price}@]</td>            
                      <td class="text-right">[@{$attribute.values_price_gross}@]</td>            
                      <td class="text-right"><a href="[@{$attribute.link_filename_products_attributes_delete_product_attribute}@]" class="btn btn-danger btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_delete#}@] ">[@{#button_text_delete#}@]</a><a href="[@{$attribute.link_filename_products_attributes_update}@]" class="btn btn-default btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_edit#}@] ">[@{#button_text_edit#}@]</a></td>            
                    [@{/if}@]                        
                    </tr>
                   [@{foreachelse}@] 
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td colspan="8"><b>[@{if $single_product}@][@{#text_please_select_option#}@][@{else}@][@{#text_no_products_with_attributes#}@][@{/if}@]</b></td>
                    </tr>             
                   [@{/foreach}@]             
                   [@{if $next_product_the_same}@]
                    <tr class="data-table-heading-row">
                      <td></td>
                      <td></td>
                      <td colspan="8" style="margin: 0; padding: 0 0 0 15px; line-height: 15px;"><img src="[@{$images_path}@]arrow_next.gif" alt="" /></td>
                    </tr>                                    
                   [@{/if}@]             
                   [@{if $insert_new_attribute}@]          
                    <tr class="data-table-heading-row">
                      <td colspan="10" style="margin: 0; padding: 0; line-height: 0;"><img src="[@{$images_path}@]pixel_black.gif" style="width: 100%; height: 1px;" alt=""></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
            	        <td>[@{$inputs_products_name|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>
                      <td>[@{$inputs_options_name|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>           
                      <td>[@{$inputs_options_value|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>            
                      <td class="text-right">&nbsp;</td>                        
                      <td class="text-center">[@{$input_price_prefix|replace:'class="smallText"':'class="form-control input-sm"'|replace:'style="':'style="min-width: 30px; '}@]</td>            
                      <td class="text-right">[@{$input_value_price|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>            
                      <td class="text-right">[@{$input_value_price_gross|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>            
                      <td class="text-right"><a href="" onclick="attribute.submit(); return false" class="btn btn-default btn-xs btn-margin-attributes pull-right" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a></td>
                    </tr>          
                    [@{if $download}@]          
                    <tr>
                      <td>&nbsp;</td> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td colspan="7">
                        <table>
                          <tr>
                            <td><b>[@{#table_heading_download#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                            <td>[@{#table_text_filename#}@]&nbsp;</td>
                            <td>[@{$input_attributes_filename|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>
                            <td>&nbsp;&nbsp;&nbsp;[@{#table_text_max_days#}@]&nbsp;</td>
                            <td>[@{$input_attributes_maxdays|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>
                            <td>&nbsp;&nbsp;&nbsp;[@{#table_text_max_count#}@]&nbsp;</td>
                            <td>[@{$input_attributes_maxcount|replace:'class="smallText"':'class="form-control input-sm"'}@]</td>
                          </tr>
                        </table>
                      </td>   
                    </tr>
                    [@{/if}@]
                   [@{/if}@]          
                  </table>
                  [@{$form_end}@]                        
<script>
 [@{$update_prices}@]
</script>                                       
                [@{/if}@]  
                </div>
              </div>                     
            </div>                 
<!-- attributes_products_eof -->