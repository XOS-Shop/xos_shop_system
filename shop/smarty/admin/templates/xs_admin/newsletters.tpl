[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : newsletters.tpl
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
[@{if $send_now}@]
<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="50" /><br />
[@{$message_stack_output}@]
<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /><br />
<a href="[@{$link_filename_newsletters_back}@]" class="button-default" style="margin-right: 5px; float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
[@{else}@]

<!-- newsletters -->
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
        <td>[@{$form_begin_new}@][@{$hidden_newsletter_id}@][@{$hidden_field_language_id}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">        
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>        
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>        
          <tr class="dataTableRow">          
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main">[@{#text_newsletter_module#}@]</td>
                <td class="main">[@{$pull_down_module}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              [@{if $languages}@]
              <tr>
                <td class="main">[@{#text_newsletter_language#}@]</td>
                <td class="main">[@{$pull_down_languages}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>               
              [@{/if}@]
              <tr>
                <td class="main">[@{#text_newsletter_title#}@]</td>
                <td class="main">[@{$input_title}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main" valign="top">[@{#text_newsletter_content#}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                [@{if $wysiwyg}@]           
                  <tr class="dataHeadingRow">
                    <td class="dataHeadingContent" valign="top"><b>[@{#text_text#}@]</b></td>
                  </tr>            
                  <tr>
                    <td class="main">[@{$textarea_content_text_plain}@]</td>
                  </tr>
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" /></td>
                  </tr>
                  <tr>
                    <td><table border="0" cellspacing="0" cellpadding="0">
                      <tr class="dataHeadingRow">
                        <td class="dataHeadingContent" valign="top"><b>[@{#text_html#}@]</b></td>
                      </tr>           
                      <tr>
                        <td class="main">[@{$textarea_content_text_htlm}@]
<script type="text/javascript">
/* <![CDATA[ */
  CKEDITOR.replace( 'content_text_htlm',
    {
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$newsletter_config}@]',
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$newsletter_template_file}@]' ],
      templates: '[@{$newsletter_template_lang}@]'             
    });
/* ]]> */
</script>
                        </td>
                      </tr>
                    </table></td>
                  </tr>              
                [@{elseif $use_html}@]
                  <tr class="dataHeadingRow">
                    <td class="dataHeadingContent" valign="top"><b>[@{#text_text#}@]</b></td>
                  </tr>            
                  <tr>
                    <td class="main">[@{$textarea_content_text_plain}@]</td>
                  </tr>
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" /></td>
                  </tr>                          
                  <tr class="dataHeadingRow">
                    <td class="dataHeadingContent" valign="top"><b>[@{#text_html#}@]</b></td>
                  </tr>             
                  <tr>
                    <td class="main">[@{$textarea_content_text_htlm}@]</td>
                  </tr>
                [@{else}@]
                  <tr class="dataHeadingRow">
                    <td class="dataHeadingContent" valign="top"><b>[@{#text_text#}@]</b></td>
                  </tr>            
                  <tr>
                    <td class="main">[@{$textarea_content_text_plain}@]</td>
                  </tr>              
                [@{/if}@]
                </table></td>             
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="main" align="right"><a href="[@{$link_filename_newsletters_cancel}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a>[@{if $update}@]<a href="" onclick="if(newsletter.onsubmit())newsletter.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a>[@{else}@]<a href="" onclick="if(newsletter.onsubmit())newsletter.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_save#}@] "><span>[@{#button_text_save#}@]</span></a>[@{/if}@]</td>
              </tr>
            </table></td>      
          </tr>
        </table>[@{$form_end}@]</td>
      </tr>              
  [@{elseif $action == 'preview'}@]  
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">   
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr> 
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>      
          <tr class="dataTableRow">
            <td nowrap="nowrap" align="right"><a href="[@{$link_filename_newsletters_back}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
          </tr>
          <tr class="dataHeadingRow">
            <td class="dataHeadingContent" valign="top">[@{#text_text#}@]</td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
          </tr>            
          <tr>
            [@{$content_text_plain}@]
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
          </tr>      
          [@{if $content_text_htlm}@]
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>      
          <tr class="dataHeadingRow">
            <td class="dataHeadingContent" valign="top">[@{#text_html#}@]</td>
          </tr> 
          <tr>
            <td><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
          </tr>              
          <tr>
            [@{$content_text_htlm}@]
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
          </tr>      
          [@{/if}@]      
          <tr class="dataTableRow">
            <td nowrap="nowrap" align="right"><a href="[@{$link_filename_newsletters_back}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
          </tr>      
        </table></td>
      </tr>       
  [@{elseif $action == 'send'}@]  
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">   
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="16" /></td> 
          </tr>   
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>       
          <tr>
            <td>[@{$module}@]</td>
          </tr>       
        </table></td>
      </tr>        
  [@{elseif $action == 'confirm'}@]  
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">   
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="16" /></td> 
          </tr>   
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>          
          <tr>
            <td>[@{$module}@]</td>
          </tr>            
        </table></td>
      </tr>      
  [@{elseif $action == 'confirm_send'}@]     
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">        
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="16" /></td> 
          </tr>   
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>         
          <tr class="dataTableRow">        
            <td id="infoSend" class="main" valign="middle">
              <img src="[@{$images_path}@]ani_send_email.gif" alt="[@{#image_ani_send_email#}@]" title=" [@{#image_ani_send_email#}@] " />
              <b>[@{#text_please_wait#}@]</b>
            </td>
          </tr>        
        </table></td>
      </tr>     
  [@{else}@]     
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" width="1%">&nbsp;</td>
                <td class="dataTableHeadingContent">[@{#table_heading_newsletters#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_languages#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_size#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_module#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_sent#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_status#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=newsletter from=$newsletters}@]
              [@{if $newsletter.selected}@]              
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$newsletter.link_filename_newsletters}@]'">
                <td class="dataTableContent"><a href="[@{$newsletter.link_filename_newsletters_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent">[@{$newsletter.title}@]</td>
                <td class="dataTableContent">[@{$newsletter.langauge_name}@]</td>
                <td class="dataTableContent" align="right">[@{$newsletter.content_length}@]&nbsp;bytes</td>
                <td class="dataTableContent" align="right">[@{$newsletter.module_name}@]</td>
                <td class="dataTableContent" align="center">[@{if $newsletter.status}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
                <td class="dataTableContent" align="center">[@{if $newsletter.locked}@]<img src="[@{$images_path}@]icons/locked.gif" alt="[@{#icon_title_locked#}@]" title=" [@{#icon_title_locked#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/unlocked.gif" alt="[@{#icon_title_unlocked#}@]" title=" [@{#icon_title_unlocked#}@] " />[@{/if}@]</td>
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$newsletter.link_filename_newsletters}@]'">
                <td class="dataTableContent"><a href="[@{$newsletter.link_filename_newsletters_preview}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a></td>
                <td class="dataTableContent">[@{$newsletter.title}@]</td>
                <td class="dataTableContent">[@{$newsletter.langauge_name}@]</td>
                <td class="dataTableContent" align="right">[@{$newsletter.content_length}@]&nbsp;bytes</td>
                <td class="dataTableContent" align="right">[@{$newsletter.module_name}@]</td>
                <td class="dataTableContent" align="center">[@{if $newsletter.status}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
                <td class="dataTableContent" align="center">[@{if $newsletter.locked}@]<img src="[@{$images_path}@]icons/locked.gif" alt="[@{#icon_title_locked#}@]" title=" [@{#icon_title_locked#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/unlocked.gif" alt="[@{#icon_title_unlocked#}@]" title=" [@{#icon_title_unlocked#}@] " />[@{/if}@]</td>
                <td class="dataTableContent" align="right"><a href="[@{$newsletter.link_filename_newsletters}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]                        
              [@{/foreach}@]
              <tr>
                <td colspan="8"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]</td>
                    <td class="smallText" align="right">[@{$nav_bar_result}@]</td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap" align="right" colspan="2"><a href="[@{$link_filename_newsletters_new}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_newsletter#}@] "><span>[@{#button_text_new_newsletter#}@]</span></a></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_newsletters}@]
          </tr>
        </table></td>
      </tr>
  [@{/if}@]      
    </table></td>
<!-- newsletters_eof -->
[@{/if}@]    
