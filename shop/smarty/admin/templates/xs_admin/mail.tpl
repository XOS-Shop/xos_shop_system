[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : mail.tpl
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

<!-- mail -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
    [@{if $action_preview}@]
      <tr>
        <td>[@{$form_begin_action_send_email_to_user}@][@{$hidden_fields}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">        
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>                                        
          <tr class="dataTableRow">
            <td><table border="0" width="100%" cellpadding="0" cellspacing="2">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="smallText"><b>[@{#text_customer#}@]</b><br />[@{$to}@]</td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="smallText"><b>[@{#text_from#}@]</b><br />[@{$from}@]</td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="smallText"><b>[@{#text_subject#}@]</b><br />[@{$subject}@]</td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="smallText"><b>[@{#text_message#}@]</b><br />[@{$message}@]</td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellpadding="0" cellspacing="2">
                  <tr>
                    <td nowrap="nowrap"><a href="[@{$link_filename_mail}@]" class="button-default" style="float: left" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="mail.back.value = 'true'; mail.submit(); return false" class="button-default" style="margin-left: 5px; float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a><a href="" onclick="mail.submit(); return false" class="button-default" style="margin-left: 5px; float: left" title=" [@{#button_title_send_email#}@] "><span>[@{#button_text_send_email#}@]</span></a></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>[@{$form_end}@]</td>
      </tr>          
    [@{else}@]
      <tr>
        <td>[@{$form_begin_action_preview}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">         
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>                                
          <tr class="dataTableRow">
            <td><table border="0" cellpadding="0" cellspacing="2">
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">[@{#text_customer#}@]</td>
                <td>[@{$pull_down_customers_email_address}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">[@{#text_from#}@]</td>
                <td>[@{$input_from}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">[@{#text_subject#}@]</td>
                <td>[@{$input_subject}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td valign="top" class="main">[@{#text_message#}@]</td>
                <td>[@{$textarea_message}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td nowrap="nowrap" colspan="2" align="right"><a href="" onclick="mail.submit(); return false" class="button-default" style="float: right" title=" [@{#button_title_send_email#}@] "><span>[@{#button_text_send_email#}@]</span></a></td>
              </tr>
            </table></td>
          </tr> 
        </table>[@{$form_end}@]</td>
      </tr>          
    [@{/if}@]
    </table></td>
<!-- mail_eof -->
