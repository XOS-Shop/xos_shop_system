[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
* filename   : tell_a_friend.tpl
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

<!-- tell_a_friend -->
    <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{eval var=#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_contact_us.gif" alt="[@{eval var=#heading_title#}@]" title=" [@{eval var=#heading_title#}@] " /></td>
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
                <td class="main"><b>[@{#form_title_customer_details#}@]</b></td>
                <td class="input-requirement" align="right">[@{#form_required_information#}@]</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><table border="0" cellspacing="0" cellpadding="2">
                  <tr>            
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#tell_a_friend_width#}@]" height="1" /></td>
                    <td></td> 
                  </tr>                               
                  <tr>
                    <td class="main">[@{#form_field_customer_name#}@]</td>
                    <td class="main">[@{$input_field_from_name}@]&nbsp;<span class="input-requirement">[@{#entry_first_name_text#}@]</span></td>
                  </tr>
                  <tr>
                    <td class="main">[@{#form_field_customer_email#}@]</td>
                    <td class="main">[@{$input_field_from_email_address}@]&nbsp;<span class="input-requirement">[@{#entry_email_address_text#}@]</span></td>
                  </tr>                  
                  <tr>            
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#tell_a_friend_width#}@]" height="1" /></td>
                    <td></td> 
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          <tr>
            <td class="main"><b>[@{#form_title_friend_details#}@]</b></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><table border="0" cellspacing="0" cellpadding="2">
                  <tr>            
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#tell_a_friend_width#}@]" height="1" /></td>
                    <td></td> 
                  </tr>                                 
                  <tr>
                    <td class="main">[@{#form_field_friend_name#}@]</td>
                    <td class="main">[@{$input_field_to_name}@]&nbsp;<span class="input-requirement">[@{#entry_first_name_text#}@]</span></td>
                  </tr>
                  <tr>
                    <td class="main">[@{#form_field_friend_email#}@]</td>
                    <td class="main">[@{$input_field_to_email_address}@]&nbsp;<span class="input-requirement">[@{#entry_email_address_text#}@]</span></td>
                  </tr>                  
                  <tr>            
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#tell_a_friend_width#}@]" height="1" /></td>
                    <td></td> 
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        [@{if !$isset_customer_id}@]
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          <tr>
            <td class="main"><b>[@{#form_title_for_your_safety#}@]</b></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><table border="0" cellspacing="0" cellpadding="2">
                  <tr>            
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#tell_a_friend_width#}@]" height="1" /></td>
                    <td colspan="4"></td> 
                  </tr>                                 
                  <tr>                  
                    <td nowrap="nowrap" class="main" width="10%">[@{#form_field_security_code#}@]</td>
                    <td nowrap="nowrap" class="main" width="10%">[@{$input_security_code}@]</td>
                    <td nowrap="nowrap" class="main" width="1%"><img src="[@{$images_path}@]arrow_captcha.gif" alt="" /></td>
                    <td nowrap="nowrap" class="main" width="9%">[@{$captcha_img}@]</td>
                    <td nowrap="nowrap" class="main" width="70%"><span class="input-requirement">[@{#entry_security_code_text#}@]</span></td>                                     
                  </tr>                  
                  <tr>            
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#tell_a_friend_width#}@]" height="1" /></td>
                    <td colspan="4"></td> 
                  </tr> 
                </table></td>
              </tr>
            </table></td>
          </tr>
        [@{/if}@]          
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          <tr>
            <td class="main"><b>[@{#form_title_friend_message#}@]</b></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td class="smallText"><div><b>[@{#sub_title_no_html#}@]</b>&nbsp;[@{#text_no_html#}@]<br />[@{$textarea_field_message}@]</div></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>              
                <td nowrap="nowrap"><a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                <td nowrap="nowrap" align="right">                       
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="email_friend.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
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
<!-- tell_a_friend_eof -->
