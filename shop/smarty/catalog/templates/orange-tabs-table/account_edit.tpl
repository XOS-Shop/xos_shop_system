[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-tabs-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and css-buttons and tables for layout                                                                     
* filename   : account_edit.tpl
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

<!-- account_edit -->
    <td width="100%" valign="top">[@{$form_begin}@][@{$hidden_field}@][@{$hidden_field_languages}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="page-heading">[@{#heading_title#}@]</td>
            <td class="page-heading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#page_heading_width#}@]" height="[@{#page_heading_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{if $message_stack}@]
      <tr>
        <td>[@{$message_stack}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{/if}@]      
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b>[@{#my_account_title#}@]</b></td>
                <td class="input-requirement" align="right">[@{#form_required_information#}@]</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
              <tr class="info-box-central-contents">
                <td><table border="0" cellspacing="2" cellpadding="2">
                  [@{if $account_gender}@]
                  <tr>
                    <td class="main">[@{#entry_gender#}@]</td>
                    <td class="main">[@{$input_gender}@]</td>
                  </tr>
                  [@{/if}@]
                  [@{if $c_id}@]
                  <tr>
                    <td class="main">[@{#entry_customer_id#}@]</td>
                    <td class="main"><b>[@{$c_id}@]</b></td>
                  </tr>
                  [@{/if}@]                  
                  <tr>
                    <td class="main">[@{#entry_first_name#}@]</td>
                    <td class="main">[@{$input_firstname}@]</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_last_name#}@]</td>
                    <td class="main">[@{$input_lastname}@]</td>
                  </tr>
                  [@{if $account_dob}@]
                  <tr>
                    <td class="main">[@{#entry_date_of_birth#}@]</td>
                    <td class="main">[@{$input_dob}@]</td>
                  </tr>
                  [@{/if}@]
                  <tr>
                    <td class="main">[@{#entry_email_address#}@]</td>
                    <td class="main">[@{$input_email_address}@]</td>
                  </tr>                  
                  <tr>
                    <td class="main">[@{#entry_telephone_number#}@]</td>
                    <td class="main">[@{$input_telephone}@]</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_fax_number#}@]</td>
                    <td class="main">[@{$input_fax}@]</td>
                  </tr>
                  [@{if $languages}@]
                  <tr>
                    <td class="main">[@{#entry_language#}@]</td>
                    <td class="main">[@{$pull_down_menu_languages}@]</td>
                  </tr> 
                  [@{/if}@]                   
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>                
                <td nowrap="nowrap"><a href="[@{$link_filename_account}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                <td nowrap="nowrap" align="right">
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="if(account_edit.onsubmit())account_edit.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                  /* ]]> */  
                  </script>
                  <noscript>
                    <input type="submit" value="[@{#button_text_continue#}@]" />
                  </noscript>                         
                </td>     
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>[@{$form_end}@]</td>
<!-- account_edit_eof -->
