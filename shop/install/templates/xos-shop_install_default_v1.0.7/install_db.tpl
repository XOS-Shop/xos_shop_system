{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xos-shop_install_default_v1.0.7
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s                                                                     
* filename   : install_db.tpl
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

<!-- install_db -->
{if $db_error != false}
              {$form_begin}
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">
                <tr>
                  <td>
                    {#text_not_successful#}
                    <div class="boxMe">{$db_error}</div>
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
{elseif $fatal_error} 
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">
                <tr>
                  <td>
                    <div width="100%" class="boxMe"><h2>{#text_fatal_error#}</h2></div>
                    <div align="center" width="100%" class="boxMe"><h2>{#text_fatal_error#}</h2></div>
                    <div align="right" width="100%" class="boxMe"><h2>{#text_fatal_error#}</h2></div>
                  </td>
                </tr>
              </table>
              <p>&nbsp;</p>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><a href="{$href_link_index}"><img src="{$buttons_path}button_cancel.gif" border="0" alt="{#image_button_cancel#}" title=" {#image_button_cancel#} " /></a></td>
                </tr>
              </table>           
{else}
              {$form_begin}
              <table width="100%" class="mainContent" cellspacing="2" cellpadding="2">
                <tr>
                  <td>
                    <p>{#text_successful#}</p>
                  </td>
                </tr>
              </table>
              {$hidden_fields}
              <p>&nbsp;</p>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  {if $configure_also}
                  <td align="center"><input type="image" src="{$buttons_path}button_continue.gif" alt="{#image_button_continue#}" title=" {#image_button_continue#} " /></td>
                  {else}
                  <td align="center"><a href="{$href_link_index}"><img src="{$buttons_path}button_continue.gif" border="0" alt="{#image_button_continue#}" title=" {#image_button_continue#} " /></a></td>
                  {/if}
                </tr>
              </table>
              {$form_end}
{/if}
<!-- install_db_eof -->
  