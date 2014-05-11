[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : categories_and_products.tpl
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

<!-- categories_and_products -->
    <td width="100%" valign="top">
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText" align="right">
                  [@{$form_begin_search}@]
                  [@{#heading_title_search#}@] [@{$input_search}@]
                  [@{$hidden_field_session}@][@{$form_end}@]
                </td>
              </tr>
              <tr>
                <td class="smallText" align="right">
                [@{$form_begin_goto}@]
                [@{#heading_title_goto#}@] [@{$pull_down_categories}@]
                [@{$hidden_field_session}@][@{$form_end}@]
                </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" colspan="3">[@{#table_heading_categories_products#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_status#}@]</td>                              
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=category from=$categories}@]
              [@{if $category.selected}@]             
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$category.link_filename_categories_get_path}@]'">               
                <td nowrap="nowrap" width="1%" class="dataTableContent"><a href="[@{$category.link_filename_categories_get_path}@]"><img src="[@{$images_path}@]icons/folder.gif" alt="[@{#icon_title_folder#}@]" title=" [@{#icon_title_folder#}@] " /></a></td>
                <td nowrap="nowrap" width="1%" class="dataTableContent"><b>[@{$category.sort_order}@]</b></td>
                <td nowrap="nowrap" class="dataTableContent">&nbsp;<b>[@{$category.name}@]</b></td>
                <td nowrap="nowrap" class="dataTableContent" align="center">
                [@{if $category.status}@]                
                  [@{$category.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$category.link_filename_categories_flag_0}@]">[@{$category.icon_status_red_light}@]</a>
                [@{else}@]
                  <a href="[@{$category.link_filename_categories_flag_1}@]">[@{$category.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$category.icon_status_red}@]
                [@{/if}@]
                </td>
                <td nowrap="nowrap" class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$category.link_filename_categories_cpath_cpath_cid}@]'">                
                <td nowrap="nowrap" width="1%" class="dataTableContent"><a href="[@{$category.link_filename_categories_get_path}@]"><img src="[@{$images_path}@]icons/folder.gif" alt="[@{#icon_title_folder#}@]" title=" [@{#icon_title_folder#}@] " /></a></td>
                <td nowrap="nowrap" width="1%" class="dataTableContent"><b>[@{$category.sort_order}@]</b></td>
                <td nowrap="nowrap" class="dataTableContent">&nbsp;<b>[@{$category.name}@]</b></td>
                <td nowrap="nowrap" class="dataTableContent" align="center">
                [@{if $category.status}@]                
                  [@{$category.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$category.link_filename_categories_flag_0}@]">[@{$category.icon_status_red_light}@]</a>
                [@{else}@]
                  <a href="[@{$category.link_filename_categories_flag_1}@]">[@{$category.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$category.icon_status_red}@]
                [@{/if}@]
                </td>    
                <td nowrap="nowrap" class="dataTableContent" align="right"><a href="[@{$category.link_filename_categories_cpath_cpath_cid}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]              
              [@{/foreach}@]              
              [@{foreach item=product from=$products}@]
              [@{if $product.selected}@]
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$product.link_filename_categories_action_product_preview}@]'">
                <td nowrap="nowrap" width="1%" class="dataTableContent"><a href="[@{$product.link_filename_categories_action_product_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td nowrap="nowrap" width="1%" class="dataTableContent">[@{$product.sort_order}@]</td>
                <td nowrap="nowrap" class="dataTableContent">&nbsp;[@{$product.name}@]</td>
                <td nowrap="nowrap" class="dataTableContent" align="center">
                [@{if $product.status}@]                
                  [@{$product.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$product.link_filename_categories_flag_0}@]">[@{$product.icon_status_red_light}@]</a>
                [@{else}@]
                  <a href="[@{$product.link_filename_categories_flag_1}@]">[@{$product.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$product.icon_status_red}@]
                [@{/if}@]    
                </td>
                <td nowrap="nowrap" class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$product.link_filename_categories_cpath_cpath_pid}@]'">
                <td nowrap="nowrap" width="1%" class="dataTableContent"><a href="[@{$product.link_filename_categories_action_product_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td nowrap="nowrap" width="1%" class="dataTableContent">[@{$product.sort_order}@]</td>
                <td nowrap="nowrap" class="dataTableContent">&nbsp;[@{$product.name}@]</td>
                <td nowrap="nowrap" class="dataTableContent" align="center">
                [@{if $product.status}@]                
                  [@{$product.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$product.link_filename_categories_flag_0}@]">[@{$product.icon_status_red_light}@]</a>
                [@{else}@]
                  <a href="[@{$product.link_filename_categories_flag_1}@]">[@{$product.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$product.icon_status_red}@]
                [@{/if}@]
                </td>    
                <td nowrap="nowrap" class="dataTableContent" align="right"><a href="[@{$product.link_filename_categories_cpath_cpath_pid}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/foreach}@]              
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText">[@{#text_categories#}@]&nbsp;[@{$categories_count}@]<br />[@{#text_products#}@]&nbsp;[@{$products_count}@]</td>
                    <td nowrap="nowrap" align="right" class="smallText">
                    [@{if $link_filename_categories_action_new_category}@]
                      [@{if $categories_count == 0 && !$is_level_top}@]
                        <a href="[@{$link_filename_categories_action_new_product}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_product#}@] "><span>[@{#button_text_new_product#}@]</span></a>
                      [@{/if}@]                    
                      [@{if $products_count == 0}@]
                        <a href="[@{$link_filename_categories_action_new_category}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_category#}@] "><span>[@{#button_text_new_category#}@]</span></a>
                      [@{/if}@]
                    [@{/if}@]
                    [@{if $link_filename_categories_back}@]
                      <a href="[@{$link_filename_categories_back}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a> 
                    [@{/if}@]                           
                    </td> 
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_categories}@] 
          </tr>
        </table></td>
      </tr>
    </table>
    </td>
<!-- categories_and_products_eof -->
