[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : backup.tpl
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

<!-- backup -->
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
                <td class="dataTableHeadingContent">[@{#table_heading_title#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_file_date#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_file_size#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
            [@{foreach item=backup from=$backups}@]
            [@{if $backup.selected}@]                         
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" onclick="document.location.href='[@{$backup.link_filename_backup_onclick}@]'"><a href="[@{$backup.link_filename_backup_action}@]"><img src="[@{$images_path}@]icons/file_download.gif" alt="[@{#icon_title_file_download#}@]" title=" [@{#icon_title_file_download#}@] " /></a>&nbsp;[@{$backup.file_name}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$backup.link_filename_backup_onclick}@]'">[@{$backup.file_date}@]</td>
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$backup.link_filename_backup_onclick}@]'">[@{$backup.file_size}@]&nbsp;bytes</td>
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
            [@{else}@]  
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" onclick="document.location.href='[@{$backup.link_filename_backup_onclick}@]'"><a href="[@{$backup.link_filename_backup_action}@]"><img src="[@{$images_path}@]icons/file_download.gif" alt="[@{#icon_title_file_download#}@]" title=" [@{#icon_title_file_download#}@] " /></a>&nbsp;[@{$backup.file_name}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$backup.link_filename_backup_onclick}@]'">[@{$backup.file_date}@]</td>
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$backup.link_filename_backup_onclick}@]'">[@{$backup.file_size}@]&nbsp;bytes</td>
                <td class="dataTableContent" align="right"><a href="[@{$backup.link_filename_backup_file}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
            [@{/if}@]  
            [@{/foreach}@]                       
              <tr>
                <td class="smallText" colspan="4">[@{#text_backup_directory#}@]&nbsp;[@{$backup_directory}@]</td>
              </tr>                                    
              <tr>
                <td nowrap="nowrap" align="right" colspan="4">
                [@{if $link_filename_backup_action_restorelocal}@]  
                  <a href="[@{$link_filename_backup_action_restorelocal}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_restore#}@] "><span>[@{#button_text_restore#}@]</span></a>
                [@{/if}@]                 
                [@{if $link_filename_backup_action_backup}@]
                  <a href="[@{$link_filename_backup_action_backup}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_backup#}@] "><span>[@{#button_text_backup#}@]</span></a>
                [@{/if}@]
                </td>
              </tr>
              [@{if $db_last_restore}@]
              <tr>
                <td class="smallText" colspan="4">[@{#text_last_restoration#}@]&nbsp;[@{$db_last_restore}@]&nbsp;<a href="[@{$link_filename_backup_action_forget}@]">[@{#text_forget#}@]</a></td>
              </tr>
              [@{/if}@]
            </table></td>
          [@{$infobox_backup}@]
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- backup_eof -->
