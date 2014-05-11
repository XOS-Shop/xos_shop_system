[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : admin_account.tpl
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

<!-- admin_account -->
    <td width="100%" valign="top">[@{$form_begin_save_account}@][@{$form_begin_check_password}@][@{$form_begin_check_account}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="2" align="center">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">[@{#table_heading_account#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td>
                  <table border="0" cellspacing="0" cellpadding="3">                  
                  [@{if $admin_firstname}@]
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_fullname#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$admin_firstname}@]&nbsp;[@{$admin_lastname}@]</td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_email#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$admin_email_address}@]</td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_password#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{#text_info_password_hidden#}@]</td>
                    </tr>
                    <tr class="dataTableRowSelected">
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_group#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$admin_groups_name}@]</td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_created#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$admin_created}@]</td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_lognum#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$admin_lognum}@]</td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_logdate#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$admin_logdate}@]</td>
                    </tr>                    
                  [@{else}@]
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_firstname#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$input_admin_firstname}@]</td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_lastname#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$input_admin_lastname}@]</td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_email#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{if $email_used}@][@{$input_admin_email_address}@]&nbsp;<font color="red">[@{$email_used}@]</font>[@{elseif $email_not_valid}@][@{$input_admin_email_address}@]&nbsp;<font color="red">[@{$email_not_valid}@]</font>[@{else}@][@{$input_admin_email_address}@][@{/if}@]</td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_password#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$input_admin_password}@]</td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap" class="dataTableContent"><b>[@{#text_info_password_confirm#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                      <td class="dataTableContent">[@{$input_admin_password_confirm}@]</td>
                    </tr>   
                  [@{/if}@]                                      
                  </table>
                </td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td nowrap="nowrap" class="smallText" valign="top">[@{#text_info_modified#}@][@{$admin_modified}@]</td>
                    <td nowrap="nowrap" align="right">[@{if $link_filename_admin_account}@][@{if $confirm_account}@]<a href="" onclick="validateForm(); if(document.returnValue)account.submit(); return false" class="button-default" style="margin-left: 5px; float: right" title=" [@{#button_title_save#}@] "><span>[@{#button_text_save#}@]</span></a>[@{/if}@]<a href="[@{$link_filename_admin_account}@]" class="button-default" style="margin-left: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>[@{elseif $form_begin_check_password}@]&nbsp;[@{else}@]<a href="" onclick="account.submit(); return false" class="button-default" style="margin-left: 5px; float: right" title=" [@{#button_title_edit#}@] "><span>[@{#button_text_edit#}@]</span></a>[@{/if}@]</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            [@{$infobox_admin_account}@]
          </tr>
        </table></td>
      </tr>
    </table>[@{$form_end}@]</td>
<!-- admin_account_eof -->
