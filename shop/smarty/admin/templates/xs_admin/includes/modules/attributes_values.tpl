[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : attributes_values.tpl
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

<!-- values -->            
            <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
            [@{if $delete_option_value}@]          
              <tr>
                <td colspan="3" class="pageHeading">&nbsp;[@{$products_options_values_name}@]&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" class="smallText"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="20" /></td>
              </tr>                
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
             [@{if $products_linked}@]  
              <tr class="dataTableHeadingRow">
                <td width="5%" class="dataTableHeadingContent" align="center">&nbsp;[@{#table_heading_id#}@]&nbsp;</td>
                <td width="90%" class="dataTableHeadingContent">&nbsp;[@{#table_heading_product#}@]&nbsp;</td>
                <td width="5%" class="dataTableHeadingContent">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              [@{foreach name=products item=product from=$products}@]
              [@{if (($smarty.foreach.products.iteration-1)%2) == 0}@]
              <tr class="attributes-odd">
              [@{else}@]
              <tr class="attributes-even">
              [@{/if}@]
                <td align="center" class="smallText">&nbsp;[@{$product.id}@]&nbsp;</td>
                <td class="smallText">&nbsp;[@{$product.name}@]&nbsp;</td>
                <td class="smallText">&nbsp;</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr>
                <td class="main" colspan="3"><br />[@{#text_warning_of_delete_option_value#}@]</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main" align="right" colspan="3"><br /><a href="[@{$link_filename_products_attributes}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a></td>
              </tr>
             [@{else}@]
              <tr>
                <td class="main" colspan="3"><br />[@{#text_ok_to_delete_option_value#}@]</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main" align="right" colspan="3"><br /><a href="[@{$link_filename_products_attributes}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="[@{$link_filename_products_attributes_delete}@]" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_delete#}@] "><span>[@{#button_text_delete#}@]</span></a></td>
              </tr>
             [@{/if}@]
            [@{else}@]
              <tr>
                <td colspan="3" class="pageHeading">&nbsp;[@{#heading_title_val#}@]&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="smallText">[@{$split_page}@]</td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="20" /></td>                
              </tr>
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td nowrap="nowrap" width="20%" class="dataTableHeadingContent">&nbsp;[@{#table_heading_opt_name#}@]&nbsp;</td>
                <td nowrap="nowrap" width="35%" class="dataTableHeadingContent">&nbsp;[@{#table_heading_opt_value#}@]&nbsp;</td>
                <td nowrap="nowrap" width="45%" class="dataTableHeadingContent" style="padding-right: 20px; text-align: right">&nbsp;[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>              
              [@{if $previous_option_the_same}@] 
              <tr>
                <td colspan="3" style="margin: 0; padding: 0 0 0 5px;"><img src="[@{$images_path}@]arrow_previous.gif" alt="" /></td>
              </tr>                            
              [@{/if}@]              
              [@{foreach name=options item=option from=$options}@]
              [@{if (($smarty.foreach.options.iteration-1)%2) == 0}@]              
              <tr class="attributes-odd">
              [@{else}@]
              <tr class="attributes-even">
              [@{/if}@]
              [@{if $option.inputs_options_value}@]              
                <td colspan="3">[@{$option.form_begin_values}@]<table width="100%" border="0" cellspacing="0" cellpadding="0">
                [@{if $option.error_message}@]
                  <tr>                                            
                    <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>                           
                  </tr>                 
                  <tr>                                            
                    <td class="smallText" colspan="3">[@{$option.error_message}@]</td>                           
                  </tr>
                  <tr>                                            
                    <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>                           
                  </tr>                  
                [@{/if}@]                               
                  <tr>                         
                    <td nowrap="nowrap" width="20%" class="smallText">&nbsp;[@{$option.option_name}@][@{$option.hidden_ids}@]&nbsp;</td>
                    <td nowrap="nowrap" width="35%" class="smallText">[@{$option.inputs_options_value}@]</td>
                    <td nowrap="nowrap" width="45%" class="smallText"><a href="[@{$option.link_filename_products_attributes}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="values.submit(); return false" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>                            
                  </tr>
                </table>[@{$option.form_end}@]</td>              
              </tr>
              [@{else}@]              
                <td class="smallText">&nbsp;[@{$option.option_name}@]&nbsp;</td>
                <td class="smallText">&nbsp;[@{$option.value_name}@]&nbsp;</td>
                <td nowrap="nowrap" class="smallText"><a href="[@{$option.link_filename_products_attributes_action_delete}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_delete#}@] "><span>[@{#button_text_delete#}@]</span></a><a href="[@{$option.link_filename_products_attributes_action_update}@]" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_edit#}@] "><span>[@{#button_text_edit#}@]</span></a></td>
              </tr>
              [@{/if}@]              
              [@{/foreach}@]              
              [@{if $next_option_the_same}@]
              <tr>
                <td colspan="3" style="margin: 0; padding: 0 0 0 5px;"><img src="[@{$images_path}@]arrow_next.gif" alt="" /></td>
              </tr>                        
              [@{/if}@]                                           
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              [@{if $form_begin_option}@]
              <tr>              
                <td colspan="3">[@{$form_begin_option}@]<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                [@{if $error_message}@]
                  <tr>                                            
                    <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>                           
                  </tr>                 
                  <tr>                                            
                    <td class="smallText" colspan="3">[@{$error_message}@]</td>                           
                  </tr>
                  <tr>                                            
                    <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>                           
                  </tr>                  
                [@{/if}@]                              
                  <tr>                                          
                    <td nowrap="nowrap" width="20%" class="smallText">&nbsp;[@{$inputs_options_name}@]&nbsp;</td>
                    <td nowrap="nowrap" width="35%" class="smallText">[@{$hidden_value_id}@][@{$inputs_options_value}@]</td>
                    <td nowrap="nowrap" width="45%" class="smallText"><a href="" onclick="values.submit(); return false" class="button-attributes-default" style="float: right" title=" [@{#button_title_insert#}@] "><span>[@{#button_text_insert#}@]</span></a></td>                            
                  </tr>
                </table>[@{$form_end}@]</td>                             
              </tr>
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              [@{/if}@]
            [@{/if}@]              
            </table></td>
<!-- values_eof -->
