{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xos-shop_install_default_v1.0.7
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s                                                                     
* filename   : install_6.tpl
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

<!-- install_6 -->
              <p class="pageTitle">{#text_title#}</p>
              <p><b>{#text_subtitle#}</b></p>
{if $db_error != false}   
              {$form_begin}
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">
                <tr>
                  <td>
                    {#text_not_successful_1#}
                    <div class="boxMe">{$db_error}</div><br />
                    {#text_not_successful_2#}
                  </td>
                </tr>
              </table>
              {$hidden_fields}
              <p>&nbsp;</p>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><a href="{$href_link_index}"><img src="{$buttons_path}button_cancel.gif" border="0" alt="{#image_button_cancel#}" title=" {#image_button_cancel#} " /></a></td>
                  <td align="center"><input type="image" src="{$buttons_path}button_back.gif" alt="{#image_button_back#}" title=" {#image_button_back#} " /></td>
                </tr>
              </table>
              {$form_end}
{elseif $configuration_not_writable}
              {$form_begin}
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">
                <tr>
                  <td>
                    <p>{#text_error_permission#}</p>
                    <div class="boxMe">{if !$config_file_catalog_writeable && !$config_file_admin_writeable}{#text_error_permission_description_a#}{else}{#text_error_permission_description_b#}{/if}
                      {if !$config_file_catalog_writeable}<ul class="boxMe">{eval var=#text_error_permission_message_1#}</ul>{/if}
                      {if !$config_file_admin_writeable}<ul class="boxMe">{eval var=#text_error_permission_message_2#}</ul>{/if}
                    </div>
                    <p class="noteBox">{#text_error_permission_note_1#}</p>
                    <p class="noteBox">{#text_error_permission_note_2#}</p>
                  </td>
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
{elseif $admin_can_not_be_renamed}
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">
                <tr>
                  <td>
                    <p><b>{#text_error_permission#}</b></p>
                    <div class="boxMe">{#text_non_writable_directory#}&nbsp;&nbsp;<b>{$dir_fs_document_root}</b>
                    <p>{#text_non_writable_directory_description#}</p>
                    </div>                  
                    <p class="noteBox">{#text_correct_the_above_error#}</p>
                  </td>
                </tr>
              </table>
              <p>&nbsp;</p>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><a href="{$href_link_index}"><img src="{$buttons_path}button_cancel.gif" border="0" alt="{#image_button_cancel#}" title=" {#image_button_cancel#} " /></a></td>
                  <td align="center">{$form_begin}{$hidden_fields}<input type="image" src="{$buttons_path}button_retry.gif" alt="{#image_button_retry#}" title=" {#image_button_retry#} " />{$form_end}</td>
                  <td align="center">{$form_begin}{$hidden_fields}{$hidden_field_ignore_renaming}<input type="image" src="{$buttons_path}button_continue.gif" alt="{#image_button_continue#}" title=" {#image_button_continue#} " />{$form_end}</td>
                </tr>
              </table>                          
{else}
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">
                <tr>
                  <td>{#text_successful#}</td>
                </tr>
              </table>
              <p>&nbsp;</p>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><a href="{$href_link_catalog}" target="_blank"><img src="{$buttons_path}button_catalog.gif" border="0" alt="{#image_button_catalog#}" title=" {#image_button_catalog#} " /></a></td>
                  <td align="center"><a href="{$href_link_admin}" target="_blank"><img src="{$buttons_path}button_administration_tool.gif" border="0" alt="{#image_button_administration_tool#}" title=" {#image_button_administration_tool#} " /></a></td>
                </tr>
              </table>
{/if}              
<!-- install_6_eof -->
