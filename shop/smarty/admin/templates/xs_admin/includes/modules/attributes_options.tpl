[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
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
            <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
            [@{if $delete_product_option}@] 
              <tr>
                <td colspan="3" class="pageHeading">&nbsp;[@{$products_options_name}@]&nbsp;</td>
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
                <td width="90%" class="dataTableHeadingContent">&nbsp;[@{#table_heading_opt_value#}@]&nbsp;</td>
                <td width="5%" class="dataTableHeadingContent">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              [@{foreach name=products_values item=products_value from=$products_values}@]
              [@{if (($smarty.foreach.products_values.iteration-1)%2) == 0}@]
              <tr class="attributes-odd">
              [@{else}@]
              <tr class="attributes-even">
              [@{/if}@]                            
                <td align="center" class="smallText">&nbsp;[@{$products_value.id}@]&nbsp;</td>
                <td class="smallText">&nbsp;[@{$products_value.name}@]&nbsp;</td>
                <td class="smallText">&nbsp;</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr>
                <td colspan="3" class="main"><br />[@{#text_warning_of_delete_option#}@]</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main" align="right" colspan="3"><br /><a href="[@{$link_filename_products_attributes}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a></td>
              </tr>
             [@{else}@]
              <tr>
                <td class="main" colspan="3"><br />[@{#text_ok_to_delete_option#}@]</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main" align="right" colspan="3"><br /><a href="[@{$link_filename_products_attributes}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="[@{$link_filename_products_attributes_delete}@]" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_delete#}@] "><span>[@{#button_text_delete#}@]</span></a></td>
              </tr>              
             [@{/if}@]              
            [@{else}@]         
              <tr>
                <td colspan="2" class="pageHeading">&nbsp;[@{#heading_title_opt#}@]&nbsp;</td>
              </tr>
              <tr>
                <td class="smallText">[@{$split_page}@]</td>                
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="20" /></td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td nowrap="nowrap" width="50%" class="dataTableHeadingContent">&nbsp;[@{#table_heading_opt_name#}@]&nbsp;</td>
                <td nowrap="nowrap" width="50%" class="dataTableHeadingContent" style="padding-right: 20px; text-align: right">&nbsp;[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              [@{foreach name=options item=option from=$options}@]
              [@{if (($smarty.foreach.options.iteration-1)%2) == 0}@]              
              <tr class="attributes-odd">
              [@{else}@]
              <tr class="attributes-even">
              [@{/if}@]  
              [@{if $option.inputs_name}@]              
                <td colspan="2">[@{$option.form_begin_option}@]<table width="100%" border="0" cellspacing="0" cellpadding="0">
                [@{if $option.error_message}@]
                  <tr>                                            
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>                           
                  </tr>                 
                  <tr>                                            
                    <td class="smallText" colspan="2">[@{$option.error_message}@]</td>                           
                  </tr>
                  <tr>                                            
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>                           
                  </tr>                  
                [@{/if}@]                               
                  <tr>                                                         
                    <td nowrap="nowrap" width="50%" class="smallText">[@{$option.inputs_name}@][@{$option.hidden_id}@]</td>
                    <td nowrap="nowrap" width="50%" class="smallText"><a href="[@{$option.link_filename_products_attributes}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="option.submit(); return false" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>                            
                  </tr>
                </table>[@{$option.form_end}@]</td>                            
              </tr>              
              [@{else}@]
                <td class="smallText">&nbsp;[@{$option.name}@]&nbsp;</td>
                <td nowrap="nowrap" class="smallText"><a href="[@{$option.link_filename_products_attributes_action_delete}@]" class="button-attributes-default" style="float: right" title=" [@{#button_title_delete#}@] "><span>[@{#button_text_delete#}@]</span></a><a href="[@{$option.link_filename_products_attributes_action_update}@]" class="button-attributes-default" style="margin-right: 2px; float: right" title=" [@{#button_title_edit#}@] "><span>[@{#button_text_edit#}@]</span></a></td>
              </tr>
              [@{/if}@]              
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              [@{if $form_begin_option}@]              
              <tr>              
                <td colspan="2">[@{$form_begin_option}@]<table width="100%" border="0" cellspacing="0" cellpadding="0">
                [@{if $error_message}@]
                  <tr>                                            
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>                           
                  </tr>                 
                  <tr>                                            
                    <td class="smallText" colspan="2">[@{$error_message}@]</td>                           
                  </tr>
                  <tr>                                            
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>                           
                  </tr>                  
                [@{/if}@]                                
                  <tr>                                            
                    <td nowrap="nowrap" width="50%" class="smallText">[@{$inputs_name}@]</td>
                    <td nowrap="nowrap" width="45%" class="smallText"><a href="" onclick="options.submit(); return false" class="button-attributes-default" style="float: right" title=" [@{#button_title_insert#}@] "><span>[@{#button_text_insert#}@]</span></a></td>                             
                  </tr>
                </table>[@{$form_end}@]</td>                                  
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              [@{/if}@]
            [@{/if}@]
            </table></td>                       
<!-- options_eof -->
