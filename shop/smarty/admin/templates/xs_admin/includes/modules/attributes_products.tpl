[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
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
        [@{if $no_products}@]
          <tr>
            <td class="main" align="center"><br />&nbsp;<br />&nbsp;<br /><b>[@{#text_no_products_1#}@]</b><br /><br />[@{#text_no_products_2#}@]</td>
          </tr> 
          <tr>         
        [@{else}@] 
          <tr style="display: none;">
            <td>                         
[@{$javascript}@]                   
            </td>
          </tr> 
          <tr>
            <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="pageHeading">&nbsp;[@{#heading_title_atrib#}@]&nbsp;</td>
              </tr>
            </table></td>
          </tr>      
          <tr>
            <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">      
              <tr>
                <td class="smallText">[@{$split_page}@]</td>
                <td class="smallText" align="right">
                  [@{$form_begin_tax_rates}@]
                  [@{#text_products_tax_rates#}@] [@{$pull_down_tax_rates}@]
                  [@{$hidden_fields}@][@{$hidden_field_session}@][@{$form_end}@]          
                </td>
                <td width="18%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="20" /></td>            
              </tr>      
            </table></td>
          </tr>      
          <tr>
            <td>[@{$form_begin_attributes}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td colspan="10"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td nowrap="nowrap" class="dataTableHeadingContent">&nbsp;</td>
                <td nowrap="nowrap" class="dataTableHeadingContent">&nbsp;</td>
                <td nowrap="nowrap" class="dataTableHeadingContent">[@{#table_heading_product#}@]&nbsp;</td>
                <td nowrap="nowrap" class="dataTableHeadingContent">[@{#table_heading_opt_name#}@]&nbsp;</td>
                <td nowrap="nowrap" class="dataTableHeadingContent">&nbsp;[@{#table_heading_opt_value#}@]&nbsp;</td>            
                <td nowrap="nowrap" class="dataTableHeadingContent" align="right">&nbsp;[@{#table_heading_opt_price#}@]:</td>                        
                <td nowrap="nowrap" class="dataTableHeadingContent" align="center">([@{#table_heading_opt_price_prefix#}@]&nbsp;</td>            
                <td nowrap="nowrap" class="dataTableHeadingContent" align="right">&nbsp;[@{#table_heading_opt_price_net#}@]&nbsp;</td>        
                <td nowrap="nowrap" class="dataTableHeadingContent" align="right">&nbsp;[@{#table_heading_opt_price_gross#}@])</td>
                <td nowrap="nowrap" class="dataTableHeadingContent" style="padding-right: 20px; text-align: right">&nbsp;[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              <tr>
                <td colspan="10"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
             [@{if $previous_product_the_same}@] 
              <tr>
                <td style="margin: 0; padding: 0;"></td>
                <td style="margin: 0; padding: 0;"></td>
                <td colspan="8" style="margin: 0; padding: 0 0 0 15px;"><img src="[@{$images_path}@]arrow_previous.gif" alt="" /></td>
              </tr>                            
             [@{/if}@]
             [@{foreach name=attributes item=attribute from=$attributes}@]
              [@{if (($smarty.foreach.attributes.iteration-1)%2) == 0}@]
              <tr class="attributes-odd">
              [@{else}@]
              <tr class="attributes-even">
              [@{/if}@] 
              [@{if $attribute.action == 'update'}@]
                <td nowrap="nowrap" class="smallText">&nbsp;</td>
                <td nowrap="nowrap" class="smallText">[@{$attribute.products_status_image}@]</td>
                <td nowrap="nowrap" width="25%" class="smallText">[@{$attribute.products_name}@][@{$attribute.hidden_ids}@]&nbsp;</td>
                <td nowrap="nowrap" class="smallText">[@{$attribute.inputs_options_name}@]&nbsp;</td>
                <td nowrap="nowrap" width="30%" class="smallText">&nbsp;[@{$attribute.inputs_options_value}@]&nbsp;</td>  
                <td nowrap="nowrap" class="smallText">&nbsp;</td>                       
                <td nowrap="nowrap" align="center" class="smallText">&nbsp;[@{$attribute.input_price_prefix}@]&nbsp;</td>            
                <td nowrap="nowrap" align="right" class="smallText">&nbsp;[@{$attribute.input_value_price}@]&nbsp;</td>            
                <td nowrap="nowrap" align="right" class="smallText">&nbsp;[@{$attribute.input_value_price_gross}@]&nbsp;</td>                       
                <td nowrap="nowrap" width="20%" class="smallText"><a href="[@{$attribute.link_filename_products_attributes_attribute_page}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="attribute.submit(); return false" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>
              [@{if $download}@]
              </tr>
              [@{if (($smarty.foreach.attributes.iteration-1)%2) == 0}@]
              <tr class="attributes-odd">
              [@{else}@]
              <tr class="attributes-even">
              [@{/if}@]
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>         
                <td colspan="7">
                  <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="smallText"><b>[@{#table_heading_download#}@]</b>&nbsp;</td>
                      <td class="smallText">[@{#table_text_filename#}@]</td>
                      <td class="smallText">[@{$attribute.input_attributes_filename}@]&nbsp;</td>
                      <td class="smallText">[@{#table_text_max_days#}@]</td>
                      <td class="smallText">[@{$attribute.input_attributes_maxdays}@]&nbsp;</td>
                      <td class="smallText">[@{#table_text_max_count#}@]</td>
                      <td class="smallText">[@{$attribute.input_attributes_maxcount}@]&nbsp;</td>
                    </tr>
                  </table>
                </td>            
              [@{/if}@]
              [@{elseif $attribute.action == 'delete'}@]
                <td nowrap="nowrap" class="smallText">&nbsp;</td>
                <td nowrap="nowrap" class="smallText">[@{$attribute.products_status_image}@]</td>          
                <td nowrap="nowrap" width="25%" class="smallText">[@{$attribute.products_name}@]&nbsp;</td>
                <td nowrap="nowrap" class="smallText">[@{$attribute.option_name}@]&nbsp;</td>
                <td nowrap="nowrap" width="30%" class="smallText">&nbsp;<span style="color : red; font-weight : bold;">[@{$attribute.value_name}@]</span>&nbsp;</td>             
                <td nowrap="nowrap" class="smallText">&nbsp;</td>                       
                <td nowrap="nowrap" align="center" class="smallText">&nbsp;<span style="color : red; font-weight : bold;">[@{$attribute.price_prefix}@]</span>&nbsp;</td>            
                <td nowrap="nowrap" align="right" class="smallText">&nbsp;<span style="color : red; font-weight : bold;">[@{$attribute.values_price}@]</span>&nbsp;</td>            
                <td nowrap="nowrap" align="right" class="smallText">&nbsp;<span style="color : red; font-weight : bold;">[@{$attribute.values_price_gross}@]</span>&nbsp;</td>            
                <td nowrap="nowrap" width="20%" class="smallText"><a href="[@{$attribute.link_filename_products_attributes_option_page}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="[@{$attribute.link_filename_products_attributes_delete_attribute}@]" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_confirm#}@] "><span>[@{#button_text_confirm#}@]</span></a></td>          
              [@{else}@]              
                <td nowrap="nowrap" class="smallText">[@{if $attribute.products_name}@][@{if $attribute.attributes_up_to_date}@]<a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); get_attribute_lists('[@{$attribute.attributes_combs_list_url}@]', '[@{$attribute.box_id_combs}@]'); toggle_box_sort('[@{$attribute.box_id_combs}@]'); return false" class="button-attributes-default" style="float: right" title="[@{#button_title_combinations#}@]"><span>[@{#button_text_combinations#}@]</span></a>[@{else}@]<a href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); get_attribute_lists('[@{$attribute.attributes_combs_list_url}@]', '[@{$attribute.box_id_combs}@]'); toggle_box_sort('[@{$attribute.box_id_combs}@]'); return false" class="button-attributes-not-up-to-date" style="float: right" title="[@{#button_title_combinations_update#}@]"><span>[@{#button_text_combinations_update#}@]</span></a>[@{/if}@][@{/if}@]</td>                        
                <td nowrap="nowrap" class="smallText">[@{$attribute.products_status_image}@]</td>
                <td nowrap="nowrap" width="25%" class="smallText">
                  [@{if $attribute.products_name}@]                  
                  <div id="[@{$attribute.box_id_combs}@]_1" style="display:none; position:relative; left:0px; top:0px;">               
                    <div id="[@{$attribute.box_id_combs}@]_2" style="display:none; position:absolute; left:-2px; top:-19px; background-color:yellow; padding-left:2px; padding-top:4px; padding-right:2px; padding-bottom:4px;">                                                                                                             
                      <table border="0" cellspacing="0" cellpadding="10"> 
                        <tr>
                          <td nowrap="nowrap" class="smallText"><b>[@{#text_loading#}@]</b></td>                         
                        </tr>                                                                                                                      
                      </table>                                  
                    </div>                
                  </div>                                                                        
                  <div id="[@{$attribute.box_id_sort_options}@]_1" style="display:none; position:relative; left:0px; top:0px;">               
                    <div id="[@{$attribute.box_id_sort_options}@]_2" style="display:none; position:absolute; left:-2px; top:-19px; background-color:yellow; padding-left:2px; padding-top:4px; padding-right:2px; padding-bottom:4px;">                                                                
                      <table border="0" cellspacing="0" cellpadding="10"> 
                        <tr>
                          <td nowrap="nowrap" class="smallText"><b>[@{#text_loading#}@]</b></td>                         
                        </tr>                                                                                                                      
                      </table>                                   
                    </div>                
                  </div>                                  
                  <a class="updateAttribute" href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); get_attribute_lists('[@{$attribute.attributes_options_sort_url}@]', '[@{$attribute.box_id_sort_options}@]'); toggle_box_sort('[@{$attribute.box_id_sort_options}@]'); return false" title=" [@{#text_options_sort_order#}@] ">[@{$attribute.products_name}@]</a>
                  [@{/if}@]
                  &nbsp;
                </td>                             
                <td nowrap="nowrap" class="smallText">
                  [@{if $attribute.option_name}@]                
                  <div id="[@{$attribute.box_id_sort_options_values}@]_1" style="display:none; position:relative; left:0px; top:0px;">               
                    <div id="[@{$attribute.box_id_sort_options_values}@]_2" style="display:none; position:absolute; left:-2px; top:-19px; background-color:yellow; padding-left:2px; padding-top:4px; padding-right:2px; padding-bottom:4px;">                                                                
                      <table border="0" cellspacing="0" cellpadding="10"> 
                        <tr>
                          <td nowrap="nowrap" class="smallText"><b>[@{#text_loading#}@]</b></td>                         
                        </tr>                                                                                                                      
                      </table>                                
                    </div>                
                  </div>                                  
                  <a class="updateAttribute" href="" onclick="attribute.reset(); update_option_values(attribute); updatePrices(true, true); get_attribute_lists('[@{$attribute.attributes_options_values_sort_url}@]', '[@{$attribute.box_id_sort_options_values}@]'); toggle_box_sort('[@{$attribute.box_id_sort_options_values}@]'); return false" title=" [@{#text_option_values_sort_order#}@] ">[@{$attribute.option_name}@]</a>
                  [@{/if}@]
                  &nbsp;
                </td>
                <td nowrap="nowrap" width="30%" class="smallText">&nbsp;[@{$attribute.value_name}@]&nbsp;</td>            
                <td nowrap="nowrap" class="smallText">&nbsp;</td>                        
                <td nowrap="nowrap" align="center" class="smallText">&nbsp;[@{$attribute.price_prefix}@]&nbsp;</td>            
                <td nowrap="nowrap" align="right" class="smallText">&nbsp;[@{$attribute.values_price}@]&nbsp;</td>            
                <td nowrap="nowrap" align="right" class="smallText">&nbsp;[@{$attribute.values_price_gross}@]&nbsp;</td>            
                <td nowrap="nowrap" width="20%" class="smallText"><a href="[@{$attribute.link_filename_products_attributes_delete_product_attribute}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_delete#}@] "><span>[@{#button_text_delete#}@]</span></a><a href="[@{$attribute.link_filename_products_attributes_update}@]" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_edit#}@] "><span>[@{#button_text_edit#}@]</span></a></td>            
              [@{/if}@]                        
              </tr>
             [@{foreachelse}@] 
              <tr class="attributes-odd">
                <td class="smallText"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="16" /></td>
                <td class="smallText">&nbsp;</td>
                <td colspan="8" class="smallText"><b>[@{if $single_product}@][@{#text_please_select_option#}@][@{else}@][@{#text_no_products_with_attributes#}@][@{/if}@]</b></td>
              </tr>             
             [@{/foreach}@]             
             [@{if $next_product_the_same}@]
              <tr>
                <td style="margin: 0; padding: 0;"></td>
                <td style="margin: 0; padding: 0;"></td>
                <td colspan="8" style="margin: 0; padding: 0 0 0 15px;"><img src="[@{$images_path}@]arrow_next.gif" alt="" /></td>
              </tr>                        
             [@{/if}@]             
             [@{if $insert_new_attribute}@]          
              <tr>
                <td colspan="10"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="smallText">&nbsp;</td>
                <td nowrap="nowrap" class="smallText">&nbsp;</td>
      	        <td nowrap="nowrap" width="25%" class="smallText">[@{$inputs_products_name}@]&nbsp;</td>
                <td nowrap="nowrap" class="smallText">[@{$inputs_options_name}@]&nbsp;</td>           
                <td nowrap="nowrap" width="30%" class="smallText">&nbsp;[@{$inputs_options_value}@]&nbsp;</td>            
                <td nowrap="nowrap" class="smallText">&nbsp;</td>                        
                <td nowrap="nowrap" align="center" class="smallText">&nbsp;[@{$input_price_prefix}@]&nbsp;</td>            
                <td nowrap="nowrap" align="right" class="smallText">&nbsp;[@{$input_value_price}@]&nbsp;</td>            
                <td nowrap="nowrap" align="right" class="smallText">&nbsp;[@{$input_value_price_gross}@]&nbsp;</td>            
                <td nowrap="nowrap" width="20%" class="smallText"><a href="" onclick="attribute.submit(); return false" class="button-attributes-default" style="float: right" title=" [@{#button_title_insert#}@] "><span>[@{#button_text_insert#}@]</span></a></td>
              </tr>          
              [@{if $download}@]          
              <tr>
                <td>&nbsp;</td> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="7">
                  <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="smallText"><b>[@{#table_heading_download#}@]</b>&nbsp;</td>
                      <td class="smallText">[@{#table_text_filename#}@]</td>
                      <td class="smallText">[@{$input_attributes_filename}@]&nbsp;</td>
                      <td class="smallText">[@{#table_text_max_days#}@]</td>
                      <td class="smallText">[@{$input_attributes_maxdays}@]&nbsp;</td>
                      <td class="smallText">[@{#table_text_max_count#}@]</td>
                      <td class="smallText">[@{$input_attributes_maxcount}@]&nbsp;</td>
                    </tr>
                  </table>
                </td>   
              </tr>
              [@{/if}@]
             [@{/if}@]          
              <tr>
                <td colspan="10"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
            </table>[@{$form_end}@]</td>
          </tr>
          <tr style="display: none;">
            <td>                         
<script type="text/javascript">
/* <![CDATA[ */ 
[@{$update_prices}@]
/* ]]> */
</script>                    
            </td>
          </tr>
        [@{/if}@]        
<!-- attributes_products_eof -->
