{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xos-shop_install_default_v1.0.7
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s                                                                     
* filename   : install_1.tpl
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

*}

<!-- install_1 -->
              <p class="pageTitle">{#text_title#}</p>
            {if $error}            
              {$form_begin}
              <p><b>{#text_subtitle_error#}</b></p>
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">              
              {foreach name=list_1 item=nonexistent_d from=$nonexistent_directories}
                {if $smarty.foreach.list_1.first}              
                <tr>
                  <td width="30%" valign="top">{#text_nonexistent_directories#}</td>
                  <td width="70%" class="smallDesc">
                {/if}
                    <div class="mainContent" style="color:#ffffff;">{$nonexistent_d.directory}</div>    
                {if $smarty.foreach.list_1.last}                
                    <b>{#text_nonexistent_directories_short_description#}</b>
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('nonexistentD');" onmouseover="this.style.cursor='pointer'" alt="" /><br />                    
                    <div id="nonexistentD" class="longDescription">{#text_nonexistent_directoriest_description#}</div>
                    <div id="nonexistentSDD">&nbsp;</div>                                 
                  </td>
                </tr>
                {/if}
              {/foreach}                
              {foreach name=list_2 item=not_writeable_d from=$not_writeable_directories}
                {if $smarty.foreach.list_2.first}  
                <tr>
                  <td width="30%" valign="top">{#text_non_writable_directories#}</td>
                  <td width="70%" class="smallDesc">
                {/if}  
                    <div class="mainContent" style="color:#ffffff;">{$not_writeable_d.directory}</div>
                {if $smarty.foreach.list_2.last}                
                    <b>{#text_non_writable_directories_short_description#}</b>
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('notWriteableD');" onmouseover="this.style.cursor='pointer'" alt="" /><br />                    
                    <div id="notWriteableD" class="longDescription">{#text_non_writable_directories_description#}</div>
                    <div id="notWriteableSDD">&nbsp;</div>                                
                  </td>
                </tr>
                {/if}
              {/foreach}              
              {foreach name=list_3 item=nonexistent_f from=$nonexistent_files}
                {if $smarty.foreach.list_3.first}              
                <tr>
                  <td width="30%" valign="top">{#text_nonexistent_files#}</td>
                  <td width="70%" class="smallDesc">
                {/if}
                    <div class="mainContent" style="color:#ffffff;">{$nonexistent_f.file}</div>    
                {if $smarty.foreach.list_3.last}                
                    <b>{#text_nonexistent_files_short_description#}</b>
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('nonexistentF');" onmouseover="this.style.cursor='pointer'" alt="" /><br />                    
                    <div id="nonexistentF" class="longDescription">{#text_nonexistent_files_description#}</div>
                    <div id="nonexistentSDF">&nbsp;</div>                                 
                  </td>
                </tr>
                {/if}
              {/foreach}                
              {foreach name=list_4 item=not_writeable_f from=$not_writeable_files}
                {if $smarty.foreach.list_4.first}  
                <tr>
                  <td width="30%" valign="top">{#text_non_writable_files#}</td>
                  <td width="70%" class="smallDesc">
                {/if}  
                    <div class="mainContent" style="color:#ffffff;">{$not_writeable_f.file}</div>
                {if $smarty.foreach.list_4.last}                
                    <b>{#text_non_writable_files_short_description#}</b>
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('notWriteableF');" onmouseover="this.style.cursor='pointer'" alt="" /><br />                    
                    <div id="notWriteableF" class="longDescription">{#text_non_writable_files_description#}</div>
                    <div id="notWriteableSDF">&nbsp;</div>                                
                  </td>
                </tr>
                {/if}
              {/foreach}                                           
                <tr>
                  <td colspan="2" align="center">{#text_correct_the_above_errors#}</td>
                </tr>                                            
              </table>
              {$hidden_fields}
              <p>&nbsp;</p>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><a href="{$href_link_index}"><img src="{$buttons_path}button_cancel.gif" border="0" alt="{#image_button_cancel#}" title=" {#image_button_cancel#} " /></a></td>
                  <td align="center"><input type="image" src="{$buttons_path}button_retry.gif" alt="{#image_button_retry#}" title=" {#image_button_retry#} " /></td>
                </tr>
              </table>
              {$form_end}              
            {else}
              {$form_begin}
              <p><b>{#text_subtitle#}</b></p>
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="30%" valign="top">{#text_import_catalog_database#}</td>
                  <td width="70%" class="smallDesc">
                    {$checkbox_database}
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbImport');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                    {#text_with_sample_data#}&nbsp;{$radio_field_database_data_source_with_sample_data}&nbsp;&nbsp;{#text_without_sample_data#}&nbsp;{$radio_field_database_data_source_without_sample_data}                 
                    <div id="dbImportSD">{#text_import_catalog_database_short_description#}</div>
                    <div id="dbImport" class="longDescription">{#text_import_catalog_database_description#}</div>
                  </td>
                </tr>
                <tr>
                  <td width="30%" valign="top">{#text_automatic_config#}</td>
                  <td width="70%" class="smallDesc">
                    {$checkbox_configure}
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('autoConfig');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                    <div id="autoConfigSD">{#text_automatic_config_short_description#}</div>
                    <div id="autoConfig" class="longDescription">{#text_automatic_config_description#}</div>
                  </td>
                </tr>
              </table>
              {$hidden_fields}
              <p>&nbsp;</p>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><a href="{$href_link_index}"><img src="{$buttons_path}button_cancel.gif" border="0" alt="{#image_button_cancel#}" title=" {#image_button_cancel#} " /></a></td>
                  <td align="center"><input type="image" src="{$buttons_path}button_continue.gif" alt="{#image_button_continue#}" title=" {#image_button_continue#} " /></td>
                </tr>
              </table>
              {$form_end}
            {/if}
<!-- install_1_eof -->
              
