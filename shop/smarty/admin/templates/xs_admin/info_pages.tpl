[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : info_pages.tpl
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

<!-- info_pages -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr> 
  [@{if $action == 'new'}@]
      <tr>
        <td>[@{$form_begin_new}@][@{$hidden_content_id}@]  
<script type="text/javascript">
/* <![CDATA[ */
function toggle(targetId, iState) // 1 visible, 0 hidden
{
   var obj = document.getElementById(targetId).style;
   obj.visibility = iState ? "visible" : "hidden";
}

function updateSort() {
  var selected_value = document.forms["content"].type.selectedIndex;
  var selectedVal = document.forms["content"].type[selected_value].value;
  var sortVal = document.forms["content"].sort_order.defaultValue;

  if (selectedVal == "info") {
    document.forms["content"].sort_order.value = sortVal;
    toggle('sort1',1);
    toggle('sort2',1);
    toggle('content_title_note',0);
  } else if (selectedVal == "index") {
    document.forms["content"].sort_order.value = "";
    toggle('sort1',0);
    toggle('sort2',0);    
    toggle('content_title_note',1);     
  } else {
    document.forms["content"].sort_order.value = "";
    toggle('sort1',0);
    toggle('sort2',0);
    toggle('content_title_note',0); 
  }
}
/* ]]> */
</script>   
        <table border="0" width="100%" cellspacing="0" cellpadding="2">                 
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>                        
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr class="dataTableRow">
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main">[@{#text_content_type#}@]</td>
                <td class="main">[@{$pull_down_type}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr> 
              <tr>
                <td class="main"><div id="sort1">[@{#text_content_sort#}@]</div></td>
                <td class="main"><div id="sort2">[@{$input_sort_order}@]</div></td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>         
              [@{if $update}@]                    
              <tr>
                <td class="main">[@{#text_content_status#}@]</td>
                <td class="main">&nbsp;[@{$radio_status_1}@][@{#text_status_active#}@]&nbsp;&nbsp;&nbsp;[@{$radio_status_0}@][@{#text_status_inactive#}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              [@{/if}@]          
              [@{foreach name=name item=content_data from=$contents_data}@]
              <tr>
                <td class="main">[@{if $smarty.foreach.name.first}@][@{#text_content_name#}@][@{/if}@]</td>
                <td class="main">[@{$content_data.languages_image}@]&nbsp;[@{$content_data.input_name}@]</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              [@{foreach name=heading_title item=content_data from=$contents_data}@]
              <tr>
                <td class="main">[@{if $smarty.foreach.heading_title.first}@][@{#text_content_title#}@][@{/if}@]</td>
                <td class="main">[@{$content_data.languages_image}@]&nbsp;[@{$content_data.input_heading_title}@]</td>
              </tr>
              [@{/foreach}@]              
              <tr>
                <td class="main">&nbsp;</td>
                <td class="smallText">
                  <div id="content_title_note" style="padding: 0 0 5px 30px">[@{#text_content_title_note#}@]</div>
<script type="text/javascript">
/* <![CDATA[ */
updateSort();
/* ]]> */
</script>                 
                </td>
              </tr>
              [@{if $wysiwyg}@]
              [@{foreach name=content item=content_data from=$contents_data}@]
              <tr>              
                <td class="main" valign="top">[@{if $smarty.foreach.content.first}@][@{#text_content#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">         
                  <tr>
                    <td class="main" valign="top">[@{$content_data.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$content_data.textarea_content}@]
<script type="text/javascript">
/* <![CDATA[ */
  CKEDITOR.replace( '[@{$content_data.content_name}@]',
    {
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$info_pages_config}@]',
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$content_data.info_pages_template_file}@]' ],
      templates: '[@{$content_data.info_pages_template_lang}@]'     
    });
/* ]]> */
</script>                      
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
                  </tr>               
                </table></td>             
              </tr>
              [@{/foreach}@]
              [@{else}@] 
              [@{foreach name=content item=content_data from=$contents_data}@]
              <tr>              
                <td class="main" valign="top">[@{if $smarty.foreach.content.first}@][@{#text_content#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">         
                  <tr>
                    <td class="main" valign="top">[@{$content_data.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$content_data.textarea_content}@]</td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
                  </tr>               
                </table></td>             
              </tr>
              [@{/foreach}@]                             
              [@{/if}@]         
            </table></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="main" align="right"><a href="[@{$link_filename_info_pages_cancel}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a>[@{if $update}@]<a href="" onclick="if(content.onsubmit())content.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a>[@{else}@]<a href="" onclick="if(content.onsubmit())content.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_save#}@] "><span>[@{#button_text_save#}@]</span></a>[@{/if}@]</td>                   
              </tr>
            </table></td>             
          </tr>     
        </table>[@{$form_end}@]</td>
      </tr>       
  [@{elseif $action == 'preview'}@]
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left" colspan="3">&nbsp;</td> 
          </tr>           
          <tr class="dataTableRow">
            <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>                     
          <tr class="dataTableRow">
            <td nowrap="nowrap" align="right" colspan="3"><a href="[@{$link_filename_info_pages_back}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
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
            <td nowrap="nowrap" align="right" colspan="3"><a href="[@{$link_filename_info_pages_back}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
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
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;&nbsp;</td>
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;&nbsp;</td>
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>               
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><a href="[@{$content.link_filename_info_pages}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
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
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.sort_order}@]&nbsp;</td>                               
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.sort_order}@]&nbsp;</td>                
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>               
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><a href="[@{$content.link_filename_info_pages}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
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
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.content_id}@]&nbsp;</td>                               
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.content_id}@]&nbsp;</td>                
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>               
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><a href="[@{$content.link_filename_info_pages}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
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
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$content.link_filename_info_pages}@]'">
                <td class="dataTableContent" nowrap="nowrap">&nbsp;<a href="[@{$content.link_filename_info_pages_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent" align="center">&nbsp;[@{$content.content_id}@]&nbsp;</td>
                <td class="dataTableContent" nowrap="nowrap">[@{$content.name}@]</td>
                <td class="dataTableContent">[@{$content.type}@]</td>               
                <td class="dataTableContent" align="center">                
                [@{if $content.status}@]                
                  [@{$content.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$content.link_filename_info_pages_action_setflag_0}@]">[@{$content.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$content.link_filename_info_pages_action_setflag_1}@]">[@{$content.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$content.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right"><a href="[@{$content.link_filename_info_pages}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/if}@]                        
              [@{/foreach}@]                                        
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td nowrap="nowrap" align="right"><a href="[@{$link_filename_info_pages_new}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_content#}@] "><span>[@{#button_text_new_content#}@]</span></a></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_info_pages}@]
          </tr>
        </table></td>
      </tr>
  [@{/if}@]      
    </table></td>
<!-- info_pages_eof -->