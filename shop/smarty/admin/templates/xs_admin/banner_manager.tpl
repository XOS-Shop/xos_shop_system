[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : banner_manager.tpl
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

<!-- banner_manager -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
   [@{if $new_banner}@]   
      <tr>
        <td>[@{$form_begin}@][@{$hidden_field_banners_id}@][@{$hidden_field_current_date_scheduled}@]     
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>
          <tr class="dataTableRow">            
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top">[@{#text_banners_group#}@]</td>
                <td class="main">[@{$pull_down_banners_group}@]&nbsp;[@{#text_banners_new_group#}@]&nbsp;[@{$input_new_banners_group}@]</td>
              </tr>              
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">[@{#text_banners_scheduled_at#}@]</td>
                <td class="main">[@{$input_date_scheduled}@]</td>
              </tr>
              <tr>
                <td class="main">&nbsp;</td>
                <td class="smallText">[@{#text_banners_schedule_note#}@]</td>
              </tr>              
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">[@{#text_banners_expires_on#}@]</td>
                <td class="main">[@{$input_expires_date}@]&nbsp;[@{#text_banners_or_at#}@]&nbsp;[@{$input_expires_impressions}@]&nbsp;[@{#text_banners_impressions#}@]</td>
              </tr>              
              <tr>
                <td class="main">&nbsp;</td>
                <td class="smallText">[@{#text_banners_expircy_note#}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              [@{foreach name=banners_title item=banner_content from=$banners_content}@]                                       
              <tr>
                <td class="main">[@{if $smarty.foreach.banners_title.first}@][@{#text_banners_title#}@][@{/if}@]</td>
                <td class="main">[@{$banner_content.languages_image}@]&nbsp;[@{$banner_content.input_banners_title}@]</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>              
              [@{foreach name=banners_url item=banner_content from=$banners_content}@] 
              <tr>
                <td class="main">[@{if $smarty.foreach.banners_url.first}@][@{#text_banners_url#}@][@{/if}@]</td>
                <td class="main">[@{$banner_content.languages_image}@]&nbsp;[@{$banner_content.input_banners_url}@]</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>                            
              <tr>                                       
                <td class="main" valign="top">[@{#text_banners_image#}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0"> 
                  [@{foreach name=banners_image item=banner_content from=$banners_content}@]      
                  <tr>                   
                    <td class="main" valign="top">[@{$banner_content.languages_image}@]&nbsp;</td>
                    [@{if $banner_content.current_banners_image}@]
                    <td class="main"><a href="javascript:popupImageWindow('[@{$banner_content.link_popup_image}@]')"><img src="[@{$images_path}@]icon_popup.gif" alt="[@{#icon_title_view_banner#}@]" title=" [@{#icon_title_view_banner#}@] " /></a>&nbsp;<b>[@{$banner_content.current_banners_image}@]</b>&nbsp;</td>
                    <td class="main">[@{$banner_content.selection_field_delete_banners_image}@][@{#text_banners_image_delete#}@]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class="main">[@{#text_banners_image_new#}@]&nbsp;</td>
                    <td class="main">[@{$banner_content.hidden_field_current_banners_image}@][@{$banner_content.input_banners_image}@]</td>
                    [@{else}@]
                    <td class="main"></td>
                    <td class="main"></td>
                    <td class="main"></td>
                    <td class="main">[@{$banner_content.hidden_field_current_banners_image}@][@{$banner_content.input_banners_image}@]</td>
                    [@{/if}@]
                  </tr>
                  <tr>
                    <td colspan="4"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="5" /></td>
                  </tr>                      
                  [@{/foreach}@]             
                </table></td>          
              </tr>              
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="8" /></td>
              </tr>                                                               
              [@{if $wysiwyg}@]
              [@{foreach name=banners_html_text item=banner_content from=$banners_content}@]                                                      
              <tr>
                <td class="main" valign="top">[@{if $smarty.foreach.banners_html_text.first}@][@{#text_banners_html_text#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">         
                  <tr>
                    <td class="main" valign="top">[@{$banner_content.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$banner_content.textarea_banners_html_text}@]
<script type="text/javascript">
/* <![CDATA[ */
  CKEDITOR.replace( '[@{$banner_content.banners_html_text_name}@]',
    {
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$banner_manager_config}@]',
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$banner_content.banner_manager_template_file}@]' ],
      templates: '[@{$banner_content.banner_manager_template_lang}@]'     
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
              [@{foreach name=banners_html_text item=banner_content from=$banners_content}@]
              <tr>                            
                <td class="main" valign="top">[@{if $smarty.foreach.banners_html_text.first}@][@{#text_banners_html_text#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">         
                  <tr>
                    <td class="main" valign="top">[@{$banner_content.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$banner_content.textarea_banners_html_text}@]</td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
                  </tr>               
                </table></td> 
              </tr>
              [@{/foreach}@]              
              [@{/if}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
            </table></td>
          </tr>         
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2"> 
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>            
              <tr>
                <td class="main" align="right" valign="top" nowrap="nowrap"><a href="[@{$link_filename_banner_manager}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a>[@{if $form_action_insert}@]<a href="" onclick="if(new_banner.onsubmit())new_banner.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_save#}@] "><span>[@{#button_text_save#}@]</span></a>[@{else}@]<a href="" onclick="if(new_banner.onsubmit())new_banner.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a>[@{/if}@]</td>
              </tr>
            </table></td>                
          </tr>
        </table>[@{$form_end}@]</td>               
      </tr>
   [@{else}@] 
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">[@{#table_heading_banners#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_groups#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_statistics#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_status#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>              
              [@{foreach item=banner from=$banners}@]
              [@{if $banner.selected}@]
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" onclick="document.location.href='[@{$banner.link_filename_banner_statistics}@]'">[@{$banner.title}@]</td>
                <td class="dataTableContent" onclick="document.location.href='[@{$banner.link_filename_banner_statistics}@]'">[@{$banner.group}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$banner.link_filename_banner_statistics}@]'">[@{$banner.shown}@]&nbsp;/&nbsp;[@{$banner.clicked}@]</td>
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$banner.link_filename_banner_statistics}@]'">
                [@{if $banner.status}@]                
                  [@{$banner.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$banner.link_filename_banner_manager_action_setflag_0}@]">[@{$banner.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$banner.link_filename_banner_manager_action_setflag_1}@]">[@{$banner.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$banner.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$banner.link_filename_banner_statistics}@]'"><a href="[@{$banner.link_filename_banner_statistics_icon}@]"><img src="[@{$images_path}@]icons/statistics.gif" alt="[@{#icon_title_statistics#}@]" title=" [@{#icon_title_statistics#}@] " /></a>&nbsp;<img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>             
              [@{else}@]
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" onclick="document.location.href='[@{$banner.link_filename_banner_manager}@]'">[@{$banner.title}@]</td>
                <td class="dataTableContent" onclick="document.location.href='[@{$banner.link_filename_banner_manager}@]'">[@{$banner.group}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$banner.link_filename_banner_manager}@]'">[@{$banner.shown}@]&nbsp;/&nbsp;[@{$banner.clicked}@]</td>
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$banner.link_filename_banner_manager}@]'">
                [@{if $banner.status}@]                
                  [@{$banner.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$banner.link_filename_banner_manager_action_setflag_0}@]">[@{$banner.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$banner.link_filename_banner_manager_action_setflag_1}@]">[@{$banner.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$banner.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$banner.link_filename_banner_manager}@]'"><a href="[@{$banner.link_filename_banner_statistics_icon}@]"><img src="[@{$images_path}@]icons/statistics.gif" alt="[@{#icon_title_statistics#}@]" title=" [@{#icon_title_statistics#}@] " /></a>&nbsp;<a href="[@{$banner.link_filename_banner_manager}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]               
              [@{/foreach}@]              
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]</td>
                    <td class="smallText" align="right">[@{$nav_bar_result}@]</td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap" align="right" colspan="2"><a href="[@{$link_filename_banner_manager}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_banner#}@] "><span>[@{#button_text_new_banner#}@]</span></a></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_banner_manager}@]
          </tr>
        </table></td>
      </tr>
   [@{/if}@]     
    </table></td>
<!-- banner_manager_eof -->
