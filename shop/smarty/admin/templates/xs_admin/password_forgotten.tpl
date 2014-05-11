[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : password_forgotten.tpl
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
[@{$html_header}@]
<body bgcolor="#FFFFFF" onload="center()">
<div id="spacer"></div>
<div id="content">
<table id="text" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="1">
      <tr class="mainback">
        <td><table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr class="logo-head">
            <td><img src="[@{$images_path}@][@{$project_logo}@]" alt="[@{$project_title}@]" title=" [@{$project_title}@] " /></td>
            <td align="right" class="nav-head" nowrap="nowrap"><a href="[@{$link_filename_default}@]" class="nav-head">[@{#header_title_administration#}@]</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="[@{$link_catalog}@]" class="nav-head">[@{#header_title_online_catalog#}@]</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.xos-shop.com" target="_blank" class="nav-head">[@{#header_title_support_site#}@]</a>&nbsp;&nbsp;</td>
          </tr>
          <tr>           
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr class="main">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="400" /></td>                    
                <td>[@{$form_login_begin}@]<table style="border: solid #fffc53" width="280" cellspacing="0" cellpadding="2" align="center">
                  <tr>
                    <td class="login_heading" valign="top">&nbsp;[@{#heading_password_forgotten#}@]</td>
                  </tr>
                  <tr>
                    <td align="center">
                      <table border="0" cellspacing="0" cellpadding="1" class="login_form_bg">
                        <tr>
                          <td>
                            <table width="100%" cellspacing="3" cellpadding="2" class="login_form">
                              [@{if $try_over_3_times}@]
                              <tr>
                                <td align="left" class="smallText">[@{#text_forgotten_fail#}@]</td>
                              </tr>
                              <tr>
                                <td nowrap="nowrap" valign="top"><a href="[@{$link_filename_login}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                              </tr>
                              <tr>
                                <td nowrap="nowrap" valign="top"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="16" />[@{$hidden_field_log_times_0}@]</td>
                              </tr>
                              [@{elseif $mailer_error_message}@]
                              <tr>
                                <td align="left" class="smallText">[@{$mailer_error_message}@]<br />&nbsp;</td>
                              </tr>
                              <tr>
                                <td nowrap="nowrap" valign="top"><a href="[@{$link_filename_password_forgotten}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                              </tr>
                              <tr>
                                <td nowrap="nowrap" valign="top"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="28" /></td>
                              </tr>                                                              
                              [@{elseif $login_success}@]
                              <tr>
                                <td align="left" class="smallText">[@{#text_forgotten_success#}@]<br />&nbsp;</td>
                              </tr>
                              <tr>
                                <td nowrap="nowrap" valign="top"><a href="[@{$link_filename_login}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                              </tr>
                              <tr>
                                <td nowrap="nowrap" valign="top"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="28" /></td>
                              </tr>                              
                              [@{else}@]                                                             
                                [@{if $cookie_not_accepted}@]
                              <tr>
                                <td colspan="2" class="smallText" align="center">[@{#text_cookie_error#}@]</td>
                              </tr>                                
                                [@{elseif $login_fail}@]
                              <tr>
                                <td colspan="2" class="smallText" align="center">[@{#text_forgotten_error#}@][@{$hidden_field_log_times}@]</td>
                              </tr>
                                [@{else}@]
                              <tr>
                                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="12" />[@{$hidden_field_log_times_0}@]</td>
                              </tr>
                                [@{/if}@]
                              <tr>
                                <td align="left" class="login">[@{#entry_firstname#}@]</td>
                                <td class="login">[@{$input_firstname}@]</td>
                              </tr>
                              <tr>
                                <td align="left" class="login">[@{#entry_email_address#}@]</td>
                                <td class="login">[@{$input_email_address}@]</td>
                              </tr>
                              <tr>
                                <td nowrap="nowrap" colspan="2" align="right" valign="top"><a href="" onclick="login.submit(); return false" class="button-default" style="margin-left: 2px; float: right" title=" [@{#button_title_confirm#}@] "><span>[@{#button_text_confirm#}@]</span></a><a href="[@{$link_filename_login}@]" class="button-default" style="margin-left: 2px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                              </tr>
                              <tr>
                                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="15" /></td>
                              </tr>                          
                              [@{/if}@]
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                    
                  </tr>                                  
                </table>[@{$form_end}@]</td>            
              </tr>
            </table></td>                                
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
        [@{$footer}@]
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
</body>
</html>  
