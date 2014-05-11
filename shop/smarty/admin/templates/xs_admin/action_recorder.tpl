[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : action_recorder.tpl
* author     : Hanspeter Zeller <hpz@xos-shop.com>
* copyright  : Copyright (c) 2014 Hanspeter Zeller
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

<!-- action_recorder -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>               
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>                
                <td class="smallText" align="right">[@{$form_begin_search}@][@{#heading_title_search#}@]&nbsp;[@{$input_search}@][@{$hidden_module}@][@{$hidden_field_session}@][@{$form_end}@]</td>
              </tr>
              <tr>
                <td class="smallText" align="right">[@{$form_begin_filter}@][@{$pull_down_module}@][@{$hidden_search}@][@{$hidden_field_session}@][@{$form_end}@]</td>
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
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_success#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_module#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_user_name#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_date_added#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=action from=$actions}@]
              [@{if $action.selected}@]
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="center">[@{if $action.success_flag}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
                <td class="dataTableContent">[@{$action.module_title}@]</td>
                <td class="dataTableContent">[@{$action.user_name}@]</td>
                <td class="dataTableContent" align="center">[@{$action.date_added}@]</td>
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$action.link_filename_action_recorder}@]'">
                <td class="dataTableContent" align="center">[@{if $action.success_flag}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
                <td class="dataTableContent">[@{$action.module_title}@]</td>
                <td class="dataTableContent">[@{$action.user_name}@]</td>
                <td class="dataTableContent" align="center">[@{$action.date_added}@]</td>
                <td class="dataTableContent" align="right"><a href="[@{$action.link_filename_orders}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/foreach}@]
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]</td>
                    <td class="smallText" align="right">[@{$nav_bar_result}@]</td>
                  </tr>
                  [@{if $link_filename_action_recorder_delete}@]
                  <tr>
                    <td nowrap="nowrap" colspan="2" align="right">
                      <a href="[@{$link_filename_action_recorder_delete}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_delete#}@] "><span>[@{#button_text_delete#}@]</span></a>
                    </td>
                  </tr>
                  [@{/if}@]                  
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_action_recorder}@]
          </tr>
        </table></td>
      </tr>            
    </table></td>
<!-- action_recorder_eof -->
