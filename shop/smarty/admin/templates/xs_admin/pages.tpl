[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : pages.tpl
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

<!-- pages -->
    <td width="100%" valign="top">
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@] "[@{$current_page_name}@]"</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="smallText" align="right">[@{$form_begin_goto}@][@{#heading_title_goto#}@] [@{$pull_down_pages}@][@{$form_end}@]</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" colspan="2">[@{#table_heading_pages#}@]</td>
                <td class="dataTableHeadingContent">&nbsp;[@{#table_heading_page_name#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_in_menu#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_status#}@]</td>                              
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=page from=$pages}@]
              [@{if $page.selected}@]             
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{if $page.children}@][@{$page.link_filename_pages_get_path}@][@{else}@][@{$page.link_filename_pages_edit}@][@{/if}@]'">               
                <td nowrap="nowrap" width="1%" class="dataTableContent">
                [@{if $page.children}@]
                  <img src="[@{$images_path}@]icons/pages.gif" alt="" title=" [@{eval var=#text_page_has_subpages#}@] " />
                [@{else}@]
                  <img src="[@{$images_path}@]icons/page.gif" alt="" title=" [@{#text_page_has_no_subpages#}@] " />
                [@{/if}@]
                </td>
                <td nowrap="nowrap" width="1%" class="dataTableContent"><b>[@{$page.sort_order}@]</b></td>
                <td nowrap="nowrap" class="dataTableContent">&nbsp;<b>[@{$page.name}@]</b></td>        
                <td nowrap="nowrap" class="dataTableContent" align="center">
                [@{if $page.page_not_in_menu}@]
                  <a href="[@{$page.link_filename_pages_flag_not_in_menu_0}@]">[@{$page.icon_not_in_menu_green_light}@]</a>&nbsp;&nbsp;[@{$page.icon_not_in_menu_red}@]                                  
                [@{else}@]
                  [@{$page.icon_not_in_menu_green}@]&nbsp;&nbsp;<a href="[@{$page.link_filename_pages_flag_not_in_menu_1}@]">[@{$page.icon_not_in_menu_red_light}@]</a>
                [@{/if}@]
                </td>                                
                <td nowrap="nowrap" class="dataTableContent" align="center">
                [@{if $page.status}@]                
                  [@{$page.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$page.link_filename_pages_flag_status_0}@]">[@{$page.icon_status_red_light}@]</a>
                [@{else}@]
                  <a href="[@{$page.link_filename_pages_flag_status_1}@]">[@{$page.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$page.icon_status_red}@]
                [@{/if}@]
                </td>
                <td nowrap="nowrap" class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$page.link_filename_pages_cpath_cpath_cid}@]'">                
                <td nowrap="nowrap" width="1%" class="dataTableContent">
                [@{if $page.children}@]
                  <a href="[@{$page.link_filename_pages_get_path}@]"><img src="[@{$images_path}@]icons/pages.gif" alt="" title=" [@{eval var=#text_page_has_subpages#}@] " /></a>
                [@{else}@]
                  <img src="[@{$images_path}@]icons/page.gif" alt="" title=" [@{#text_page_has_no_subpages#}@] " />
                [@{/if}@]
                </td>
                <td nowrap="nowrap" width="1%" class="dataTableContent"><b>[@{$page.sort_order}@]</b></td>
                <td nowrap="nowrap" class="dataTableContent">&nbsp;<b>[@{$page.name}@]</b></td>  
                <td nowrap="nowrap" class="dataTableContent" align="center">
                [@{if $page.page_not_in_menu}@]
                  <a href="[@{$page.link_filename_pages_flag_not_in_menu_0}@]">[@{$page.icon_not_in_menu_green_light}@]</a>&nbsp;&nbsp;[@{$page.icon_not_in_menu_red}@]                                  
                [@{else}@]
                  [@{$page.icon_not_in_menu_green}@]&nbsp;&nbsp;<a href="[@{$page.link_filename_pages_flag_not_in_menu_1}@]">[@{$page.icon_not_in_menu_red_light}@]</a>
                [@{/if}@]
                </td>                  
                <td nowrap="nowrap" class="dataTableContent" align="center">
                [@{if $page.status}@]                
                  [@{$page.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$page.link_filename_pages_flag_status_0}@]">[@{$page.icon_status_red_light}@]</a>
                [@{else}@]
                  <a href="[@{$page.link_filename_pages_flag_status_1}@]">[@{$page.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$page.icon_status_red}@]
                [@{/if}@]
                </td>    
                <td nowrap="nowrap" class="dataTableContent" align="right"><a href="[@{$page.link_filename_pages_cpath_cpath_cid}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]              
              [@{/foreach}@]                           
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText">[@{#text_pages#}@]&nbsp;[@{$pages_count}@]</td>
                    <td nowrap="nowrap" align="right" class="smallText">
                    [@{if $link_filename_pages_action_new_page}@]                  
                      <a href="[@{$link_filename_pages_action_new_page}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_page#}@] [@{$current_page_name}@] "><span>[@{#button_text_new_page#}@]&nbsp;"[@{$current_page_name}@]"</span></a>
                    [@{/if}@]
                    [@{if $link_filename_pages_back}@]
                      <a href="[@{$link_filename_pages_back}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a> 
                    [@{/if}@]                           
                    </td> 
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_pages}@] 
          </tr>
        </table></td>
      </tr>
    </table>
    </td>
<!-- pages_eof -->
