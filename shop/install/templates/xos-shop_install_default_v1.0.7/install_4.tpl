{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xos-shop_install_default_v1.0.7
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s                                                                    
* filename   : install_4.tpl
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

<!-- install_4 -->
              <p class="pageTitle">{#text_title#}</p>
              <p><b>{#text_subtitle#}</b></p> 
              <p><b>{#text_sub_subtitle#}</b></p>
              {$form_begin}
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="30%" valign="top">{#text_www_address#}</td>
                  <td width="70%" class="smallDesc">
                    {$input_field_http_www_address}
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbWWW');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                    <div id="dbWWWSD">{#text_www_address_short_description#}</div>
                    <div id="dbWWW" class="longDescription">{#text_www_address_description#}</div>
                  </td>
                </tr>
                <tr>
                  <td width="30%" valign="top">{#text_webserver_root_directory#}</td>
                  <td width="70%" class="smallDesc">
                    {$input_field_document_root}
                    <img src="{$images_path}help_icon.gif"  onclick="toggleBox('dbRoot');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                    <div id="dbRootSD">{#text_webserver_root_directory_short_description#}</div>
                    <div id="dbRoot" class="longDescription">{#text_webserver_root_directory_description#}</div>
                  </td>
                </tr>
                <tr>
                  <td width="30%" valign="top">{#text_http_cookie_domain#}</td>
                  <td width="70%" class="smallDesc">
                    {$input_field_http_cookie_domain}
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbCookieD');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                    <div id="dbCookieDSD">{#text_http_cookie_domain_short_description#}</div>
                    <div id="dbCookieD" class="longDescription">{#text_http_cookie_domain_description#}</div>
                  </td>
                </tr>
                <tr>
                  <td width="30%" valign="top">{#text_http_cookie_path#}</td>
                  <td width="70%" class="smallDesc">
                    {$input_field_http_cookie_path}
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbCookieP');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                    <div id="dbCookiePSD">{#text_http_cookie_path_short_description#}</div>
                    <div id="dbCookieP" class="longDescription">{#text_http_cookie_path_description#}</div>
                  </td>
                </tr>
                <tr>
                  <td width="30%" valign="top">{#text_rename_admin_dir#}</td>
                  <td width="70%" class="smallDesc">
                    {$checkbox_field_rename_admin_dir}
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbAdminDir');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                    <div id="dbAdminDirSD"></div>
                    <div id="dbAdminDir" class="longDescription">{#text_rename_admin_dir_description#}</div>
                  </td>
                </tr>                
                <tr>
                  <td width="30%" valign="top">{#text_enable_ssl_connections#}</td>
                  <td width="70%" class="smallDesc">
                    {$checkbox_field_enable_ssl}
                    <img src="{$images_path}help_icon.gif" onclick="toggleBox('dbSSL');" onmouseover="this.style.cursor='pointer'" alt="" /><br />
                    <div id="dbSSLSD"></div>
                    <div id="dbSSL" class="longDescription">{#text_enable_ssl_connections_description#}</div>
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
<!-- install_4_eof -->
