[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : products_attributes.tpl
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

<!-- products_attributes -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
    [@{if $single_product}@]
      <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" colspan="4">[@{$text_new_product}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>                                     
        </table></td>
      </tr>            
      <tr>
        <td>[@{$form_begin_filter_products_attributes}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">         
          <tr id="filter" class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left" width="98%"  colspan="4"><b>&nbsp;[@{#table_heading_set_filter#}@]</b></td>
            <td class="dataTableHeadingContent" align="left">[@{#table_heading_max_rows#}@]&nbsp;<br />[@{$pull_down_menu_max_rows}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="right" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="7" /><br /><a href="" onclick="filter_products_attributes.submit(); return false" class="button-default" style="margin-left: 5px; margin-right: 5px; float: right" title=" [@{#button_title_select#}@] "><span>[@{#button_text_select#}@]</span></a></td>            
          </tr>
          <tr id="no-filter" class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" colspan="6" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="33" /></td> 
          </tr>            
        </table>[@{$hidden_fields_page_info}@][@{$hidden_field_session}@][@{$form_end_filter}@]</td>
      </tr>                          
    [@{else}@]    
      <tr>
        <td valign="top">[@{$form_begin_filter_products_attributes}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" colspan="4">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>           
          <tr id="filter" class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left" width="15%"><b>&nbsp;[@{#table_heading_set_filter#}@]</b></td>
            <td class="dataTableHeadingContent" align="left" width="20%">[@{#table_heading_categories#}@]&nbsp;<br />[@{$pull_down_menu_categories_or_pages_id}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="left" width="20%">[@{#table_heading_manufacturers#}@]&nbsp;<br />[@{$pull_down_menu_manufacturers_id}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="left" width="15%">[@{#table_heading_max_rows#}@]&nbsp;<br />[@{$pull_down_menu_max_rows}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="left" width="20%">[@{#table_heading_max_products_in_pullwown#}@]&nbsp;<br />[@{$pull_down_menu_max_products}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="right" width="10%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="7" /><br /><a href="" onclick="filter_products_attributes.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_select#}@] "><span>[@{#button_text_select#}@]</span></a></td>            
          </tr>
          <tr id="no-filter" class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" colspan="6" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="33" /></td> 
          </tr>                          
        </table>[@{$hidden_fields_page_info}@][@{$hidden_field_session}@][@{$form_end_filter}@]</td>
      </tr>
    [@{/if}@]        
      <tr id="attributes">
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">          
          <tr>
            <td width="100%" align="right">[@{if $link_back_to_product_list}@]<a href="[@{$link_back_to_product_list}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back_to_product_list#}@] "><span>[@{#button_text_back_to_product_list#}@]</span></a>[@{/if}@]<a href="" onclick="toggle(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_edit_option_and_values#}@] "><span>[@{#button_text_edit_option_and_values#}@]</span></a></td>
          </tr>    
          [@{$attributes_products}@]      
        </table></td>
      </tr>                                 
      <tr id="options">
        <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3" width="100%" align="right">[@{if $link_back_to_product_list}@]<a href="[@{$link_back_to_product_list}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back_to_product_list#}@] "><span>[@{#button_text_back_to_product_list#}@]</span></a>[@{/if}@]<a href="" onclick="toggle(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_edit_attributes#}@] "><span>[@{#button_text_edit_attributes#}@]</span></a></td>
          </tr>         
          <tr> 
            [@{$attributes_options}@]
            <td height="100%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="100%" /></td>
            [@{$attributes_values}@]           
          </tr>
        </table></td>
      </tr>
      <tr style="display: none;">
        <td>                         
[@{$js_init_style}@]                   
        </td>
      </tr>               
    </table></td>
<!-- products_attributes_eof -->
