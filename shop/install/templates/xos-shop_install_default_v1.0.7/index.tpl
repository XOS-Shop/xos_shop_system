{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xos-shop_install_default_v1.0.7
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s                                                                    
* filename   : index.tpl
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{#lang_code#}" xml:lang="{#lang_code#}">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="{#lang_code#}" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<meta name="generator" content="XOS-Shop version 1.0 rc7s, open source e-commerce system" />
<title>XOS-Shop</title>
<link rel="stylesheet" type="text/css" href="{$css_path}stylesheet.css" />
</head>
<body bgcolor="#ffffff">
<div id="spacer"></div>
<div id="content">
{$form_begin}{$hidden_fields}
<table width="75%" cellpadding="0" cellspacing="0" border="0" align="center">
  <tr class="logo-head">
    <td><img src="{$images_path}xos-shop_project_logo.gif" border="0" alt="XOS-Shop" title=" XOS-Shop " /></td>
    <td align="right" class="nav-head" nowrap="nowrap"><a href="index.php?lang=en"><img src="{$images_path}icon_english.gif" width="24" height="15" border="0" alt="English" title=" English " /></a>&nbsp;<a href="index.php?lang=de"><img src="{$images_path}icon_german.gif" width="24" height="15" border="0" alt="Deutsch" title=" Deutsch " /></a>&nbsp;<a href="index.php?lang=es"><img src="{$images_path}icon_espanol.gif" width="24" height="15" border="0" alt="Español" title=" Español "  /></a>&nbsp;&nbsp;</td>
  </tr>  
  <tr>           
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="main">
        <td><table width="85%" cellpadding="0" cellspacing="0" border="0"  align="center">
          <tr>         
            <td>
              <br />
              <p class="pageTitle">{#text_welcome#}</p>                                              
              <table width="100%" cellspacing="0" cellpadding="0">                                             
                <tr>
                  <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                    <tr>
                      <td>                     
                        <table width="100%" class="mainContent" cellspacing="0" cellpadding="2">
                          <tr>
                            <td>
                              <p>{#text_intro#}</p>
                            </td>
                          </tr>
                        </table>
                        <br />                       
                      </td>
                    </tr>
                  </table></td>                                                                                                                    
{if $php_ver_warning}
                  <td valign="top"><table border="0" width="220" cellspacing="3" cellpadding="3">
                    <tr>
                      <td> 
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr class="infoBoxHeading">
                            <td nowrap="nowrap" class="infoBoxHeading">&nbsp;{#text_title_warning#}&nbsp;</td>
                          </tr>
                        </table>
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr class="infoBox">
                            <td class="infoBox">                                                                            
                              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;<b>{#text_php_version#}</b></td>                          
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;&nbsp;<b>{$php_version}</b>&nbsp;&nbsp;</td>                         
                                  <td nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}cross.gif" border="0" alt="" />&nbsp;</td>                          
                                </tr>                                                                
                                <tr>    
                                  <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="4">
                                    <tr>                         
                                      <td class="infoBoxContent">{#text_version_not_suitable#}<br /><br />{#text_require_help#}<br />&nbsp;</td>                          
                                    </tr>                                
                                  </table></td>
                                </tr>                                                                                                                                                                                                
                              </table>                                                 
                            </td>
                          </tr>
                        </table>
                        <br /> 
                      </td>
                    </tr>
                  </table></td>
                </tr>
              </table>                                         
              <table border="0" width="100%" cellspacing="2" cellpadding="2">
                <tr>           
                  <td align="center">&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;</td>                  
                </tr>
              </table> 
{else}
                  <td valign="top"><table border="0" width="220" cellspacing="3" cellpadding="3">
                    <tr>
                      <td>  
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr class="infoBoxHeading">
                            <td nowrap="nowrap" class="infoBoxHeading">&nbsp;{#text_title_server_cps#}&nbsp;</td>
                          </tr>
                        </table>
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr class="infoBox">
                            <td nowrap="nowrap" class="infoBox">                                                                            
                              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;<b>{#text_php_version#}</b></td>                          
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;&nbsp;{$php_version}&nbsp;&nbsp;</td>                          
                                  <td nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}tick.gif" border="0" alt="" />&nbsp;</td>                          
                                </tr>                                                               
                                <tr>                         
                                  <td colspan="3" class="infoBoxContent">&nbsp;</td>                          
                                </tr>                                                                                                                                                        
                                <tr>
                                  <td colspan="3" nowrap="nowrap" class="infoBoxContent">&nbsp;<b>{#text_php_settings#}</b></td>                                                  
                                </tr>                                  
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;{#text_register_globals#}</td>                          
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;&nbsp;{$register_globals}&nbsp;&nbsp;</td>                          
                                  <td nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}{if $register_globals == 'Off'}tick.gif{else}cross.gif{/if}" border="0" alt="" />&nbsp;</td>                          
                                </tr>                                 
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;{#text_file_uploads#}</td>                          
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;&nbsp;{$file_uploads}&nbsp;&nbsp;</td>                          
                                  <td nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}{if $file_uploads == 'Off'}cross.gif{else}tick.gif{/if}" border="0" alt="" />&nbsp;</td>                          
                                </tr>                                 
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;{#text_session_auto_start#}</td>                          
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;&nbsp;{$session_auto_start}&nbsp;&nbsp;</td>                          
                                  <td nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}{if $session_auto_start == 'Off'}tick.gif{else}cross.gif{/if}" border="0" alt="" />&nbsp;</td>                          
                                </tr>                                 
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;{#text_session_use_trans_sid#}</td>                          
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;&nbsp;{$session_use_trans_sid}&nbsp;&nbsp;</td>                          
                                  <td nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}{if $session_use_trans_sid == 'Off'}tick.gif{else}cross.gif{/if}" border="0" alt="" />&nbsp;</td>                          
                                </tr>                                                               
                                <tr>                         
                                  <td colspan="3" class="infoBoxContent">&nbsp;</td>                          
                                </tr>                                                                                                                                                        
                                <tr>
                                  <td colspan="3" nowrap="nowrap" class="infoBoxContent">&nbsp;<b>{#text_extensions#}</b></td>                                                  
                                </tr>                                                       
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;{#text_gd_lib#}{if $extension_gd_loaded != 'not_loaded'}{$extension_gd_loaded}{/if}</td>                                                    
                                  <td colspan="2" nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}{if $extension_gd_loaded == '2'}tick.gif{else}cross.gif{/if}" border="0" alt="" />&nbsp;</td>                          
                                </tr>
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;{#text_curl#}</td>                                                   
                                  <td colspan="2" nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}{if $extension_curl_loaded == 'loaded'}tick.gif{else}cross.gif{/if}" border="0" alt="" />&nbsp;</td>                          
                                </tr>                                
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;{#text_mysql#}</td>                                                  
                                  <td colspan="2" nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}{if $extension_mysql_loaded == 'loaded'}tick.gif{else}cross.gif{/if}" border="0" alt="" />&nbsp;</td>                          
                                </tr>
                                <tr>
                                  <td nowrap="nowrap" class="infoBoxContent">&nbsp;{#text_openssl#}</td>                                                   
                                  <td colspan="2" nowrap="nowrap" valign="middle" width="1%" align="right" class="infoBoxContent"><img src="{$images_path}{if $extension_openssl_loaded == 'loaded'}tick.gif{else}cross.gif{/if}" border="0" alt="" />&nbsp;</td>                          
                                </tr>                                                                                                                                                                                                                                                                                              
                              </table>                                                 
                            </td>
                          </tr>
                        </table>
                        <br />
                      </td>
                    </tr>
                  </table></td>
                </tr>
              </table>                                         
              <table border="0" width="100%" cellspacing="2" cellpadding="2">
                <tr>           
                  <td align="center">&nbsp;<br /><input type="image" src="{$buttons_path}button_install.gif" alt="{#image_button_install#}" title=" {#image_button_install#} " /><br />&nbsp;<br />&nbsp;</td>                  
                </tr>
              </table> 
{/if}                                                      
            </td>        
          </tr>
        </table></td>                                       
      </tr>
    </table></td>                                             
  </tr>   
  <tr>
    <td class="smallText" colspan="2"><img src="{$images_path}pixel_trans.gif" border="0" alt="" width="900" height="2" /></td>
  </tr>
  <tr>  
    <td colspan="2" align="center"><table border="0" cellspacing="0" cellpadding="0">
      <tr>        
        <td nowrap="nowrap" align="left" class="smallText">                               
          <a href="http://www.xos-shop.com"  target="_blank"><b>XOS-Shop open source e-commerce system</b></a>, Copyright © 2012 Hanspeter Zeller<br />XOS-Shop comes with ABSOLUTELY NO WARRANTY; <a href="./includes/LICENSE.html#section15" target="_blank">click for details</a>. This is free<br />software, and you can redistribute it under certain conditions; <a href="./includes/LICENSE.html#terms" target="_blank">click for details</a>.
        </td>
      </tr>    
    </table></td>
  </tr>         
</table>
{$form_end}
</div>
</body>
</html>
