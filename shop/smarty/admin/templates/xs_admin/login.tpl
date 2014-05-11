[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : login.tpl
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
                    <td class="login_heading" valign="top">&nbsp;[@{#heading_returning_admin#}@]</td>
                  </tr>
                  <tr>
                    <td align="center">
                      <table border="0" cellspacing="0" cellpadding="1" class="login_form_bg">
                        <tr>
                          <td align="left">
                            <table width="100%" cellspacing="3" cellpadding="2" class="login_form">
                              [@{if $cookie_not_accepted}@]                            	
                              <tr>
                                <td colspan="2" class="smallText" align="center">[@{#text_cookie_error#}@]</td>
                              </tr>
                              [@{elseif $login_fail == 'incorrect_values'}@]
                              <tr>
                                <td colspan="2" class="smallText" align="center">[@{#text_login_error#}@]</td>
                              </tr> 
                              [@{elseif $login_fail}@]
                              <tr>
                                <td colspan="2" class="smallText" align="center">[@{$login_fail}@]</td>
                              </tr>                                                            
                              [@{else}@]
                              <tr>
                                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="12" /></td>
                              </tr>
                              [@{/if}@]                                                          
                              <tr>
                                <td align="left" class="login">[@{#entry_email_address#}@]</td>
                                <td class="login">[@{$input_email_address}@]</td>
                              </tr>
                              <tr>
                                <td align="left" class="login">[@{#entry_password#}@]</td>
                                <td class="login">[@{$input_password}@]</td>
                              </tr>
                              <tr>
                                <td nowrap="nowrap" colspan="2" align="right" valign="top"><a href="" onclick="login.submit(); return false" class="button-default" style="margin-left: 2px; float: right" title=" [@{#button_title_confirm#}@] "><span>[@{#button_text_confirm#}@]</span></a></td>
                              </tr>
                            </table>
                            <noscript>
                              <div style="width:1px; position:relative; left:0px; top:0px;">               
                                <div style="position:absolute; right:-264px; top:-28px; background-color:#fffc53; padding-left:2px; padding-top:2px; padding-right:2px; padding-bottom:2px;">                                              
                                  <table border="0" cellspacing="1" cellpadding="0"> 
                                    <tr>
                                      <td nowrap="nowrap" class="smallText" align="center" height="50">&nbsp;<b>[@{#text_javascript_must_be_enabled#}@]</b>&nbsp;</td>                         
                                    </tr>                                                                                                                   
                                  </table>
                                </div>                
                              </div>
                            </noscript>                                                                   
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  [@{if $link_filename_password_forgotten}@]                    
                  <tr>
                    <td valign="top" align="right"><a class="sub" href="[@{$link_filename_password_forgotten}@]">[@{#text_password_forgotten#}@]</a><span class="sub">&nbsp;</span></td>
                  </tr>
                  [@{else}@]
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="3" /></td>
                  </tr>                     
                  [@{/if}@]                    
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
