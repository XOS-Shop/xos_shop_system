[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : popup_file_manager.tpl
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
[@{$html_header}@]
<body bgcolor="#ffffff" style="margin: 0; padding: 0" onload="adjustHeight();">
<div class="main-div" id="main-div" style="overflow: auto; margin: 0; padding: 0; width:100%;">
<div id="inner-div" style="margin: 0; padding: 0; width:100%;">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" valign="top">
<!-- popup_file_manager -->
[@{$message_stack_output}@]
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
    [@{if $entrence_link}@]    
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"></td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="80" /></td>
      </tr>          
      <tr>      
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main" width="30%"></td>
            <td class="main" width="40%">
              <span style="margin-left: 5px; float: left">[@{#text_please_select#}@]</span><br /><br />
              <a href="[@{$link_filename_popup_file_manager}@]" class="button-default" style="margin-left: 5px; float: left" title=" [@{#button_title_file_manager#}@] "><span>[@{#button_text_file_manager#}@]</span></a>
              <a href="[@{$link_filename_popup_pages}@]" class="button-default" style="margin-left: 5px; float: left" title=" [@{#button_title_pages_in_menu_tree#}@] "><span>[@{#button_text_pages_in_menu_tree#}@]</span></a>
              <a href="[@{$link_filename_popup_info_pages}@]" class="button-default" style="margin-left: 5px; float: left" title=" [@{#button_title_info_pages#}@] "><span>[@{#button_text_info_pages#}@]</span></a>           
            </td>
            <td class="main" width="30%"></td>
          </tr>                             
        </table></td>      
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="400" /></td>
      </tr>                             
    [@{else if $new_edit_file}@] 
      <tr>
        <td width="100%">[@{$form_begin_goto}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]<br /><span class="smallText">[@{$current_path}@]</span></td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="pageHeading" align="right">[@{$pull_down_goto}@]</td>
          </tr>
        </table>[@{$hidden_field_session}@][@{$form_end}@]</td>
      </tr>               
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
      </tr>
      <tr>
        <td width="100%">[@{$form_begin_new_file}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" width="1%">[@{#text_file_name#}@]</td>
            <td class="main">[@{$filename_or_input_filename}@]</td>
          </tr>
          <tr>
            <td colspan="2" class="main">[@{#text_file_contents#}@]</td>
          </tr>
          <tr>
            <td colspan="2" class="main">[@{$textarea_file_contents}@]</td>
          </tr>          
          <tr>
            <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td nowrap="nowrap" align="right" class="main" colspan="2">
              <a href="[@{$link_filename_popup_file_manager}@]" class="button-default" style="float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a>
              [@{if $file_writeable}@]
              <a href="" onclick="new_file.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_save#}@] "><span>[@{#button_text_save#}@]</span></a>
              [@{/if}@]              
            </td>
          </tr>
        </table>[@{$form_end}@]</td>
      </tr>
    [@{else if $image_view}@]
      <tr>
        <td width="100%">[@{$form_begin_goto}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]<br /><span class="smallText">[@{$current_path}@]</span></td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="pageHeading" align="right">[@{$pull_down_goto}@]</td>
          </tr>
        </table>[@{$hidden_field_session}@][@{$form_end}@]</td>
      </tr>                   
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td nowrap="nowrap" class="main">
              <a href="[@{$link_filename_popup_file_manager}@]" class="button-default" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>           
            </td>
          </tr>        
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>        
          <tr>
            <td class="main">[@{#text_file_name#}@]&nbsp;&nbsp;<b>[@{$filename}@]</b></td>
          </tr>
          <tr>
            <td class="main"><div style="overflow: auto;"><img src="[@{$image_src}@]" alt="[@{$filename}@]" title=" [@{$filename}@] " [@{if $image_data[0] && $image_data[1]}@]width="[@{$image_data[0]}@]" height="[@{$image_data[1]}@]"[@{/if}@] /></div></td>
          </tr>          
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td nowrap="nowrap" align="right" class="main">
              <a href="[@{$link_filename_popup_file_manager}@]" class="button-default" style="float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>           
            </td>
          </tr>
        </table></td>
      </tr>       
    [@{else}@]
      <tr>
        <td width="100%">[@{$form_begin_goto}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]<br /><span class="smallText">[@{$current_path}@]</span></td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="pageHeading" align="right">[@{$pull_down_goto}@]</td>
          </tr>
        </table>[@{$hidden_field_session}@][@{$form_end}@]</td>
      </tr>          
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">[@{#table_heading_filename#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_size#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_permissions#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_user#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_group#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_last_modified#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=content from=$folders_and_files}@]
              [@{if $content.selected}@]   
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" onclick="document.location.href='[@{$content.link_onclick}@]'"><a href="[@{$content.link}@]">[@{$content.icon}@]</a>&nbsp;[@{$content.name}@]</td>
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$content.link_onclick}@]'">&nbsp;[@{$content.size}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$content.link_onclick}@]'"><tt>[@{$content.permissions}@]</tt></td>
                <td class="dataTableContent" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.user}@]</td>
                <td class="dataTableContent" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.group}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.last_modified}@]</td>
                <td class="dataTableContent" align="right">[@{if $content.link_delete}@]<a href="[@{$content.link_delete}@]"><img src="[@{$images_path}@]icons/delete.gif" alt="[@{#icon_title_delete#}@]" title=" [@{#icon_title_delete#}@] " /></a>&nbsp;[@{/if}@]<img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>    
              [@{else}@]   
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" onclick="document.location.href='[@{$content.link_onclick}@]'"><a href="[@{$content.link}@]">[@{$content.icon}@]</a>&nbsp;[@{$content.name}@]</td>
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$content.link_onclick}@]'">&nbsp;[@{$content.size}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$content.link_onclick}@]'"><tt>[@{$content.permissions}@]</tt></td>
                <td class="dataTableContent" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.user}@]</td>
                <td class="dataTableContent" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.group}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$content.link_onclick}@]'">[@{$content.last_modified}@]</td>
                <td class="dataTableContent" align="right">[@{if $content.link_delete}@]<a href="[@{$content.link_delete}@]"><img src="[@{$images_path}@]icons/delete.gif" alt="[@{#icon_title_delete#}@]" title=" [@{#icon_title_delete#}@] " /></a>&nbsp;[@{/if}@]<a href="[@{$content.link_filename_popup_file_manager_info}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]                        
              [@{/foreach}@]              
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr valign="top">
                    <td nowrap="nowrap"><a href="[@{$link_filename_popup_file_manager_reset}@]" class="button-default" style="float: left" title=" [@{#button_title_reset#}@] "><span>[@{#button_text_reset#}@]</span></a></td>
                    <td nowrap="nowrap" align="right"><a href="[@{$link_filename_popup_file_manager_new_folder}@]" class="button-default" style="float: right" title=" [@{#button_title_new_folder#}@] "><span>[@{#button_text_new_folder#}@]</span></a><a href="[@{$link_filename_popup_file_manager_new_file}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_file#}@] "><span>[@{#button_text_new_file#}@]</span></a><a href="[@{$link_filename_popup_file_manager_upload}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_upload#}@] "><span>[@{#button_text_upload#}@]</span></a></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_popup_file_manager}@]
          </tr>
        </table></td>
      </tr>      
    [@{/if}@]            
    </table>
<!-- popup_file_manager_eof --> 
<!-- footer -->
[@{$footer}@]
<!-- footer_eof --> 
    <br />
    </td>
  </tr>
</table>
</div>
</div>
</body>
</html>