[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0.7
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : zones.tpl
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

<!-- zones -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">[@{#table_heading_country_name#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_zone_name#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_zone_code#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=zone from=$zones}@]
              [@{if $zone.selected}@]                              
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$zone.link_filename_zones}@]'">
                <td class="dataTableContent">[@{$zone.country_name}@]</td>
                <td class="dataTableContent">[@{$zone.zone_name}@]</td>
                <td class="dataTableContent" align="center">[@{$zone.zone_code}@]</td>
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$zone.link_filename_zones}@]'">
                <td class="dataTableContent">[@{$zone.country_name}@]</td>
                <td class="dataTableContent">[@{$zone.zone_name}@]</td>
                <td class="dataTableContent" align="center">[@{$zone.zone_code}@]</td>
                <td class="dataTableContent" align="right"><a href="[@{$zone.link_filename_zones}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]                        
              [@{/foreach}@]              
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]</td>
                    <td class="smallText" align="right">[@{$nav_bar_result}@]</td>
                  </tr>
                  [@{if $link_filename_zones_action_new}@]
                  <tr>
                    <td nowrap="nowrap" colspan="2" align="right"><a href="[@{$link_filename_zones_action_new}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_zone#}@] "><span>[@{#button_text_new_zone#}@]</span></a></td>
                  </tr>
                  [@{/if}@]
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_zones}@]
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- zones_eof -->
