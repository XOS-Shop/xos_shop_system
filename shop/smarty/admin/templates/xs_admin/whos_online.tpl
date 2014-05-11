[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : whos_online.tpl
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

<!-- whos_online -->
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
                <td nowrap="nowrap" class="dataTableHeadingContent">[@{#table_heading_online#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent" align="center">[@{#table_heading_customer_id#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent">[@{#table_heading_full_name#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent" align="center">[@{#table_heading_ip_address#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent">[@{#table_heading_entry_time#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent" align="center">[@{#table_heading_last_click#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent">[@{#table_heading_last_page_url#}@]&nbsp;</td>
              </tr>
              [@{foreach item=online from=$whos_online}@]
              [@{if $online.selected}@]                            
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
              [@{else}@]
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$online.link_filename_whos_online}@]'">
              [@{/if}@]
                <td nowrap="nowrap" class="dataTableContent">[@{$online.time_online}@]</td>
                <td nowrap="nowrap" class="dataTableContent" align="center">[@{$online.customer_id}@]</td>
                <td nowrap="nowrap" class="dataTableContent">[@{$online.full_name}@]</td>
                <td nowrap="nowrap" class="dataTableContent" align="center">[@{$online.ip_address}@]</td>
                <td nowrap="nowrap" class="dataTableContent">[@{$online.time_entry}@]</td>
                <td nowrap="nowrap" class="dataTableContent" align="center">[@{$online.time_last_click}@]</td>
                <td class="dataTableContent">[@{$online.last_page_url}@]&nbsp;</td>
              </tr>
              [@{/foreach}@]                               
              <tr>
                <td class="smallText" colspan="7">[@{$text_number_of_customers}@]</td>
              </tr>
            </table></td>
          [@{$infobox_whos_online}@]
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- whos_online_eof -->
