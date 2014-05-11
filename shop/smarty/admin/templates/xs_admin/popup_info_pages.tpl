[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : popup_info_pages.tpl
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
<!-- popup_info_pages -->
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>     
  [@{if $action == 'preview'}@]
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left" colspan="3">&nbsp;</td> 
          </tr>           
          <tr class="dataTableRow">
            <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>                     
          <tr class="dataTableRow">
            <td nowrap="nowrap" align="right" colspan="3"><a href="[@{$link_filename_popup_info_pages_back}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
          </tr>
          <tr>
            <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
          </tr>        
          [@{foreach name=name item=content_data from=$contents_data}@]
          <tr>
            <td class="main" valign="top">[@{$content_data.languages_image}@]&nbsp;</td>
            <td class="main" valign="top" nowrap="nowrap">[@{#text_content_name#}@]&nbsp;&nbsp;</td>
            <td class="main" valign="top" width="100%">[@{$content_data.name}@]</td>
          </tr>
          <tr>
           <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="5" /></td>
          </tr> 
          <tr>
            <td class="main" valign="top">&nbsp;</td>
            <td class="main" valign="top" nowrap="nowrap">[@{#text_content_title#}@]&nbsp;&nbsp;</td>
            <td class="main" valign="top" width="100%">[@{$content_data.heading_title}@]</td>
          </tr>
          <tr>
           <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" /></td>
          </tr>
          <tr>
            <td class="main" valign="top">&nbsp;</td>
            <td class="main" valign="top" nowrap="nowrap">[@{#text_content#}@]&nbsp;&nbsp;</td>
            <td class="main" valign="top" width="100%">[@{$content_data.content}@]</td>
          </tr>
          <tr>
            <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
          </tr>                     
          [@{/foreach}@]            
          <tr class="dataTableRow">
            <td nowrap="nowrap" align="right" colspan="3"><a href="[@{$link_filename_popup_info_pages_back}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
          </tr>      
        </table></td>
      </tr>             
  [@{else}@]     
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" nowrap="nowrap" width="1%">&nbsp;</td>
                <td class="dataTableHeadingContent" align="center" nowrap="nowrap">&nbsp;</td>              
                <td class="dataTableHeadingContent" nowrap="nowrap">[@{#table_heading_name#}@]</td>
                <td class="dataTableHeadingContent" nowrap="nowrap">[@{#table_heading_module#}@]</td>
                <td class="dataTableHeadingContent" align="center" nowrap="nowrap">[@{#table_heading_status#}@]</td>
                <td class="dataTableHeadingContent" align="right" nowrap="nowrap">[@{#table_heading_action#}@]&nbsp;</td>
              </tr> 
              [@{foreach item=content from=$contents}@]
              [@{if $content.type == 'index'}@]
              [@{if $content.selected}@]              
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_popup_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;&nbsp;</td>
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_popup_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;&nbsp;</td>
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>               
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><a href="[@{$content.link_filename_popup_info_pages}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/if}@]                        
              [@{/foreach}@]              
              [@{foreach item=content from=$contents}@]               
              [@{if $content.first == 'info'}@]              
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" nowrap="nowrap" width="1%">&nbsp;</td>
                <td class="dataTableHeadingContent" align="center" nowrap="nowrap">[@{#table_heading_sort#}@]</td>                
                <td class="dataTableHeadingContent" nowrap="nowrap">&nbsp;</td>
                <td class="dataTableHeadingContent" nowrap="nowrap">&nbsp;</td>
                <td class="dataTableHeadingContent" align="center" nowrap="nowrap">&nbsp;</td>
                <td class="dataTableHeadingContent" align="right" nowrap="nowrap">&nbsp;</td>
              </tr>                           
              [@{/if}@]                          
              [@{if $content.type == 'info'}@]
              [@{if $content.selected}@]              
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_popup_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.sort_order}@]&nbsp;</td>                               
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_popup_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.sort_order}@]&nbsp;</td>                
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>               
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><a href="[@{$content.link_filename_popup_info_pages}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/if}@]                                                              
              [@{/foreach}@]                        
              [@{foreach item=content from=$contents}@]               
              [@{if $content.first == 'not_in_menu'}@]              
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" nowrap="nowrap" width="1%">&nbsp;</td>
                <td class="dataTableHeadingContent" align="center" nowrap="nowrap">[@{#table_heading_content_id#}@]</td>                
                <td class="dataTableHeadingContent" nowrap="nowrap">&nbsp;</td>
                <td class="dataTableHeadingContent" nowrap="nowrap">&nbsp;</td>
                <td class="dataTableHeadingContent" align="center" nowrap="nowrap">&nbsp;</td>
                <td class="dataTableHeadingContent" align="right" nowrap="nowrap">&nbsp;</td>
              </tr>                           
              [@{/if}@]                          
              [@{if $content.type == 'not_in_menu'}@]
              [@{if $content.selected}@]              
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_popup_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.content_id}@]&nbsp;</td>                               
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_popup_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.content_id}@]&nbsp;</td>                
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>               
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><a href="[@{$content.link_filename_popup_info_pages}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/if}@]                                                              
              [@{/foreach}@]                                                      
              [@{foreach item=content from=$contents}@]
              [@{if $content.first == 'system_popup'}@]
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" nowrap="nowrap" width="1%">&nbsp;</td>
                <td class="dataTableHeadingContent" align="center" nowrap="nowrap">[@{#table_heading_popup_id#}@]</td>               
                <td class="dataTableHeadingContent" nowrap="nowrap">&nbsp;</td>
                <td class="dataTableHeadingContent" nowrap="nowrap">&nbsp;</td>
                <td class="dataTableHeadingContent" align="center" nowrap="nowrap">&nbsp;</td>
                <td class="dataTableHeadingContent" align="right" nowrap="nowrap">&nbsp;</td>
              </tr>                                           
              [@{/if}@]                
              [@{if $content.type == 'system_popup'}@]
              [@{if $content.selected}@]              
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_popup_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_popup_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_popup_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>               
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_popup_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_popup_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><a href="[@{$content.link_filename_popup_info_pages}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/if}@]                        
              [@{/foreach}@]                                        
              <tr>
                <td colspan="6">&nbsp;</td>
              </tr>
            </table></td>
          [@{$infobox_popup_info_pages}@]
          </tr>
        </table></td>
      </tr>
  [@{/if}@]      
    </table>
<!-- popup_info_pages_eof -->
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