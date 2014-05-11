[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
* filename   : offline.tpl
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

<!-- offline -->
    <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="100" /></td>
      </tr>
      [@{if $message_stack}@]      
      <tr>
        <td>[@{$message_stack}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{else}@]
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="26" /></td>
      </tr>      
      [@{/if}@]    
      <tr>          
        <td valign="top"><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box">
          <tr class="info-box-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td colspan="2" style="padding: 10px 3px 50px 3px; text-align: right;">[@{$language_str}@]</td>
              </tr>
              <tr>
                <td class="main" colspan="2" align="center"><b>[@{#text_offline#}@]</b></td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="50" /></td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main" width="10%">[@{#entry_email_address#}@]</td>
                <td class="main">[@{$input_field_email_address}@]</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main" width="10%">[@{#entry_password#}@]</td>
                <td class="main">[@{$input_field_password}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
              </tr>
              <tr>
                <td colspan="2" nowrap="nowrap">
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="offline.submit(); return false" class="button-login" style="float: left" title=" [@{#button_title_login#}@] "><span>[@{#button_text_login#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                  /* ]]> */  
                  </script>
                  <noscript>
                    <input type="submit" value="[@{#button_text_login#}@]" />
                  </noscript>                         
                </td> 
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
              </tr>                  
            </table></td>
          </tr>
        </table></td>
      </tr>     
    </table>[@{$form_end}@]</td>
<!-- offline_eof -->
