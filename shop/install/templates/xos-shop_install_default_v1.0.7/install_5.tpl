{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xos-shop_install_default_v1.0.7
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s                                                                     
* filename   : install_5.tpl
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

<!-- install_5 -->
              <p class="pageTitle">{#text_title#}</p>
              <p><b>{#text_subtitle#}</b></p>
              {$form_begin}
              <table width="95%" border="0" cellpadding="2" class="mainContent">
                <tr>
                  <td width="30%" valign="top">{#text_database_server#}</td>
                    <td width="70%" class="smallDesc">
                      {$input_field_server}
                      <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbHost');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                      <div id="dbHostSD">{#text_database_server_short_description#}</div>
                      <div id="dbHost" class="longDescription">{#text_database_server_description#}</div>
                    </td>
                  </tr>
                  <tr>
                    <td width="30%" valign="top">{#text_database_username#}</td>
                    <td width="70%" class="smallDesc">
                      {$input_field_username}
                      <img src="{$images_path}help_icon.gif"  onclick="toggleBox('dbUser');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                      <div id="dbUserSD">{#text_database_username_short_description#}</div>
                      <div id="dbUser" class="longDescription">{#text_database_username_description#}</div>
                    </td>
                  </tr>
                  <tr>
                    <td width="30%" valign="top">{#text_database_password#}</td>
                    <td width="70%" class="smallDesc">
                      {$password_field}
                      <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbPass');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                      <div id="dbPassSD">{#text_database_password_short_description#}</div>
                      <div id="dbPass" class="longDescription">{#text_database_password_description#}</div>
                    </td>
                  </tr>
                  <tr>
                    <td width="30%" valign="top">{#text_database_name#}</td>
                    <td width="70%" class="smallDesc">
                      {$input_field_database}
                      <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbName');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                      <div id="dbNameSD">{#text_database_name_short_description#}</div>
                      <div id="dbName" class="longDescription">{#text_database_name_description#}</div>
                    </td>
                  </tr>
                  <tr>
                    <td width="30%" valign="top">{#text_persistent_connections#}</td>
                    <td width="70%" class="smallDesc">
                      {$checkbox_field_pconnect}
                      <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbConn');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                      <div id="dbConnSD"></div>
                      <div id="dbConn" class="longDescription">{#text_persistent_connections_description#}</div>
                    </td>
                  </tr>
                  <tr>
                    <td width="30%" valign="top">{#text_session_storage#}</td>
                    <td width="70%" class="smallDesc">
                    {$radio_field_store_sessions_files}&nbsp;{#text_session_storage_files#}&nbsp;&nbsp;{$radio_field_store_sessions_mysql}&nbsp;{#text_session_storage_database#}&nbsp;&nbsp;
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbSess');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                    <div id="dbSessSD"></div>
                    <div id="dbSess" class="longDescription">{#text_session_storage_description#}</div>
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
<!-- install_5_eof -->
