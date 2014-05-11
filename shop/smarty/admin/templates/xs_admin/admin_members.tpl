[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : admin_members.tpl
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

<!-- admin_members -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{$heading_title}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">            
           [@{if $g_path}@]
              [@{$form_begin_define}@][@{$hidden_admin_groups_id}@]
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td colspan="2" class="dataTableHeadingContent">&nbsp;[@{#table_heading_groups_define#}@]</td>
              </tr> 
              [@{foreach name=outer item=box from=$boxes}@]
              <tr class="dataTableRow">
                <td class="dataTableContent" width="23">[@{$box.checkbox}@]</td>
                <td class="dataTableContent"><b>[@{$box.box_name}@]&nbsp;[@{$box.hidden_checked}@][@{$box.hidden_unchecked}@]</b></td>
              </tr>
              <tr class="dataTableRow">
                <td class="dataTableContent">&nbsp;</td>
                <td class="dataTableContent">
                  <table border="0" cellspacing="0" cellpadding="0">
                  [@{foreach name=inner item=file from=$box.files}@]
                    <tr>
                      <td width="20">[@{$file.checkbox}@]</td>
                      <td class="dataTableContent">[@{$file.file_name}@]&nbsp;[@{$file.hidden_checked}@][@{$file.hidden_unchecked}@]</td>
                    </tr>
                  [@{/foreach}@]
                  </table>
                </td>
              </tr>
              [@{/foreach}@]
              [@{if $link_filename_admin_members}@]
              <tr class="dataTableRowBoxes">
                <td nowrap="nowrap" colspan="2" class="dataTableContent" valign="top" align="right"><a href="" onclick="defineForm.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a><a href="[@{$link_filename_admin_members}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a></td>
              </tr>  
              [@{else}@]
              <tr class="dataTableRowBoxes">
                <td nowrap="nowrap" colspan="2" class="dataTableContent" valign="top" align="right"><a href="" onclick="defineForm.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
              </tr>  
              [@{/if}@]  
            </table>[@{$form_end}@]
           [@{elseif $g_id}@]
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;[@{#table_heading_groups_name#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=group from=$groups}@]
              [@{if $group.selected}@]
              <tr class="dataTableRowSelected" onmouseover="this.style.cursor='pointer'" onclick="document.location.href='[@{$group.link_filename_admin_members}@]'">                
                <td class="dataTableContent">&nbsp;<b>[@{$group.name}@]</b></td>               
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>    
              [@{else}@]
              <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='pointer'" onmouseout="this.className='dataTableRow'" onclick="document.location.href='[@{$group.link_filename_admin_members}@]'">                
                <td class="dataTableContent">&nbsp;<b>[@{$group.name}@]</b></td>                
                <td class="dataTableContent" align="right"><a href="[@{$group.link_filename_admin_members}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]          
              [@{/foreach}@]
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>                    
                    <td class="smallText" valign="top">[@{#text_count_groups#}@][@{$groups_counter}@]</td>
                    <td nowrap="nowrap" valign="top" align="right"><a href="[@{$link_filename_admin_members}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_group#}@] "><span>[@{#button_text_new_group#}@]</span></a></td>                    
                  </tr>
                </table></td>
              </tr>
            </table>
           [@{else}@]              
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">[@{#table_heading_name#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_email#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_groups#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_lognum#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>              
              [@{foreach item=member from=$members}@]
              [@{if $member.selected}@]    
              <tr class="dataTableRowSelected" onmouseover="this.style.cursor='pointer'" onclick="document.location.href='[@{$member.link_filename_admin_members}@]'">                  
                <td class="dataTableContent">&nbsp;[@{$member.firstname}@]&nbsp;[@{$member.lastname}@]</td>
                <td class="dataTableContent">[@{$member.email_address}@]</td>
                <td class="dataTableContent" align="center">[@{$member.group_name}@]</td>
                <td class="dataTableContent" align="center">[@{$member.lognum}@]</td>
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='pointer'" onmouseout="this.className='dataTableRow'" onclick="document.location.href='[@{$member.link_filename_admin_members}@]'">                 
                <td class="dataTableContent">&nbsp;[@{$member.firstname}@]&nbsp;[@{$member.lastname}@]</td>
                <td class="dataTableContent">[@{$member.email_address}@]</td>
                <td class="dataTableContent" align="center">[@{$member.group_name}@]</td>
                <td class="dataTableContent" align="center">[@{$member.lognum}@]</td>
                <td class="dataTableContent" align="right"><a href="[@{$member.link_filename_admin_members}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]                        
              [@{/foreach}@]
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>                    
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]<br />[@{$nav_bar_result}@]</td>
                    <td nowrap="nowrap" valign="top" align="right"><a href="[@{$link_filename_admin_members}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_member#}@] "><span>[@{#button_text_new_member#}@]</span></a></td>                    
                  </tr>
                </table></td>
              </tr>
            </table>
           [@{/if}@]
            </td>
          [@{$infobox_admin_members}@]
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- admin_members_eof -->
