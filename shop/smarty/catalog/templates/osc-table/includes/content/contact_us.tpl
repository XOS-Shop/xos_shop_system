[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7z
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
* filename   : contact_us.tpl
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

<!-- contact_us -->
    [@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      [@{if $message_stack}@]
      <tr>
        <td>[@{$message_stack}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{/if}@]
      [@{if $sent}@]      
      <tr>
        <td class="main" align="center"><img src="[@{$images_path}@]table_background_man_on_board.gif" alt="[@{$smarty.const.CONTACT_US_HEADING_TITLE}@]" title=" [@{$smarty.const.CONTACT_US_HEADING_TITLE}@] " align="left" />[@{$smarty.const.CONTACT_US_TEXT_SUCCESS}@]</td>
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
                <td nowrap="nowrap" align="right"><a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{$smarty.const.CONTACT_US_BUTTON_TITLE_CONTINUE}@] "><span>[@{$smarty.const.CONTACT_US_BUTTON_TEXT_CONTINUE}@]</span></a></td>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>      
      [@{else}@]      
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td colspan="3" class="main">[@{$smarty.const.CONTACT_US_ENTRY_NAME}@]</td>
              </tr>
              <tr>
                <td colspan="3" class="main">[@{$input_field_name}@]</td>
              </tr>
              <tr>
                <td colspan="3" class="main">[@{$smarty.const.CONTACT_US_ENTRY_EMAIL}@]</td>
              </tr>
              <tr>
                <td colspan="3" class="main">[@{$input_field_email}@]</td>
              </tr> 
            [@{if !$isset_customer_id}@]   
              <tr>
                <td colspan="2" nowrap="nowrap" class="main" width="1%">[@{$smarty.const.CONTACT_ENTRY_SECURITY_CODE}@]</td>
                <td rowspan="2" nowrap="nowrap" class="main" width="99%">[@{$captcha_img}@]</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="main">[@{$input_security_code}@]</td>
                <td nowrap="nowrap" class="main"><img src="[@{$images_path}@]arrow_captcha.gif" alt="" /></td>
                <td></td>
              </tr>
             [@{/if}@]                            
              <tr>
                <td colspan="3" class="main">[@{$smarty.const.CONTACT_ENTRY_ENQUIRY}@]</td>
              </tr>
              <tr>
                <td colspan="3"><div>[@{$textarea}@]<br /></div></td>
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
                <td nowrap="nowrap" align="right">                        
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="contact_us.submit(); return false" class="button-continue" style="float: right" title=" [@{$smarty.const.CONTACT_US_BUTTON_TITLE_CONTINUE}@] "><span>[@{$smarty.const.CONTACT_US_BUTTON_TEXT_CONTINUE}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                  /* ]]> */  
                  </script>
                  <noscript>
                    <input type="submit" value="[@{$smarty.const.CONTACT_US_BUTTON_TEXT_CONTINUE}@]" />
                  </noscript>                                                
                </td>                 
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      [@{/if}@]      
    </table>[@{$form_end}@]
<!-- contact_us_eof -->
