[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-tabs-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and css-buttons and tables for layout                                                                     
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

<!-- login -->
    <td width="100%" valign="top">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
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
      [@{if $sppc_toggle_login}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td width="100%" height="100%" valign="top"><table align="center" border="0" width="40%" cellspacing="1" cellpadding="2" class="info-box-central">
              <tr class="info-box-central-contents">
                <td><table border="0" width="100%" cellspacing="2" cellpadding="4">
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap" class="main" valign="top">&nbsp;<b>[@{#text_choose_customer_group#}@]</b><br /><br />&nbsp;[@{$customers_groups_pull_down_menu}@]</td>
                  </tr>
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                  </tr>
                  <tr>
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                        <td nowrap="nowrap" align="right">[@{$hidden_field_email_address}@][@{$hidden_field_password}@]                        
                          <script type="text/javascript">
                          /* <![CDATA[ */
                            document.write('<a href="" onclick="login.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                          /* ]]> */  
                          </script>
                          <noscript>
                            <input type="submit" value="[@{#button_text_continue#}@]" />
                          </noscript>                     
                        </td>                          
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="1" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      [@{else}@]
      [@{if $message_stack}@]      
      <tr>
        <td>[@{$message_stack}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{/if}@]
      [@{if $cart_contents}@]
      <tr>
        <td class="small-text">[@{#text_visitors_cart#}@]
        [@{if $link_filename_popup_content_9}@]       
        <script type="text/javascript">
        /* <![CDATA[ */
          document.write('<a href="[@{$link_filename_popup_content_9}@]" class="lightbox-system-popup" target="_blank">[@{#text_visitors_cart_link#}@]</a>');
        /* ]]> */   
        </script>
        <noscript>
          <a href="[@{$link_filename_popup_content_9}@]" target="_blank">[@{#text_visitors_cart_link#}@]</a>
        </noscript>
        [@{/if}@]                
        </td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{/if}@]      
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" width="50%" valign="top"><b>[@{#heading_new_customer#}@]</b></td>
            <td class="main" width="50%" valign="top"><b>[@{#heading_returning_customer#}@]</b></td>
          </tr>
          <tr>
            <td width="50%" height="100%" valign="top"><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
              <tr class="info-box-central-contents">
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                  </tr>
                  <tr>
                    <td class="main" valign="top">[@{#text_new_customer#}@]<br /><br />[@{eval var=#text_new_customer_introduction#}@]</td>
                  </tr>
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                  </tr>
                  <tr>
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>                       
                        <td nowrap="nowrap" align="right"><a href="[@{$link_filename_create_account}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a></td>                        
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="50%" height="100%" valign="top"><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
              <tr class="info-box-central-contents">
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                  </tr>
                  <tr>
                    <td class="main" colspan="2">[@{#text_returning_customer#}@]</td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                  </tr>
                  <tr>
                    <td class="main"><b>[@{#entry_email_address#}@]</b></td>
                    <td class="main">[@{$input_field_email_address}@]</td>
                  </tr>
                  <tr>
                    <td class="main"><b>[@{#entry_password#}@]</b></td>
                    <td class="main">[@{$input_field_password}@]</td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                  </tr>
                  [@{if $link_filename_password_forgotten}@]
                  <tr>
                    <td class="small-text" colspan="2"><a href="[@{$link_filename_password_forgotten}@]">[@{#text_password_forgotten#}@]</a></td>
                  </tr>
                  [@{/if}@]
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>               
                        <td nowrap="nowrap" align="right">
                          <script type="text/javascript">
                          /* <![CDATA[ */
                            document.write('<a href="" onclick="login.submit(); return false" class="button-login" style="float: right" title=" [@{#button_title_login#}@] "><span>[@{#button_text_login#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                          /* ]]> */  
                          </script>
                          <noscript>
                            <input type="submit" value="[@{#button_text_login#}@]" />
                          </noscript>                         
                        </td> 
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      [@{/if}@]      
    </table>[@{$form_end}@]
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="20" /></td>
      </tr>  
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>                
                <td nowrap="nowrap"><a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr> 
    </table></td>    
<!-- login_eof -->
