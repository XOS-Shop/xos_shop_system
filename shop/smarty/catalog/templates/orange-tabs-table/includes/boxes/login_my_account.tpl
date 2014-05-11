[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-tabs-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and css-buttons and tables for layout                                                                     
* filename   : login_my_account.tpl
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

[@{if $box_login_my_account_display_box_my_account}@]
<!-- my_account -->
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="info-box-heading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="6" height="18" /></td>
              <td width="100%" class="info-box-heading">[@{#box_heading_login_my_account_my_account#}@]</td>
              <td class="info-box-heading" nowrap="nowrap"></td>  
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="1" class="info-box">
            <tr>
              <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="info-box-contents">
                <tr>
                  <td><img src="images/pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
                <tr>
                  <td class="box-text"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="info-box-contents">
              	         [@{$box_login_my_account_welcome_string}@]<br /><br />
                      </td>
                    </tr>            
                    <tr>
                      <td class="info-box-contents">
                        <a href="[@{$box_login_my_account_link_filename_account}@]">[@{#box_login_my_account_my_account#}@]</a>
                      </td>
                    </tr>
                    <tr>
                      <td class="info-box-contents">
                        <a href="[@{$box_login_my_account_link_filename_account_edit}@]">[@{#box_login_my_account_account_edit#}@]</a>
                      </td>
                    </tr>
                    <tr>
                      <td class="info-box-contents">
                        <a href="[@{$box_login_my_account_link_filename_account_history}@]">[@{#box_login_my_account_account_history#}@]</a>
                      </td>
                    </tr>
                    <tr>
                      <td class="info-box-contents">
                        <a href="[@{$box_login_my_account_link_filename_address_book}@]">[@{#box_login_my_account_address_book#}@]</a>
                      </td>
                    </tr>
                    [@{if $box_login_my_account_link_filename_account_notifications}@]
                    <tr>
                      <td class="info-box-contents">
                        <a href="[@{$box_login_my_account_link_filename_account_notifications}@]">[@{#box_login_my_account_product_notifications#}@]</a>
                      </td>
                    </tr>
                    [@{/if}@]
                    <tr>
                      <td class="info-box-contents">
                        <br /><a href="[@{$box_login_my_account_link_filename_logoff}@]"><b>[@{#box_login_my_account_logoff#}@]</b></a>
                      </td>
                    </tr>                                                                                    
                  </table></td>
                </tr>
                <tr>
                  <td><img src="images/pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </td>
      </tr>
<!-- my_account_eof -->
[@{else}@]
<!-- login -->
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="info-box-heading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="6" height="18" /></td>
              <td width="100%" class="info-box-heading">[@{#box_heading_login_my_account_login_here#}@]</td>
              <td class="info-box-heading" nowrap="nowrap"></td>            
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="1" class="info-box">
            <tr>
              <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="info-box-contents">
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
                <tr>
                  <td class="box-text">[@{$box_login_my_account_form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="info-box-contents">
              	        [@{$box_login_my_account_welcome_string}@]<br /><br />
                      </td>
                    </tr>
                    <tr>
                      <td class="info-box-contents">
                        [@{#box_login_my_account_email#}@]
                      </td>
                    </tr>
                    <tr>
                      <td class="info-box-contents">
                        [@{$box_login_my_account_input_field_email_address}@]
                      </td>
                    </tr>
                    <tr>
                      <td class="info-box-contents">
                        [@{#box_login_my_account_password#}@]
                      </td>
                    </tr>
                    <tr>
                      <td class="info-box-contents">
                        [@{$box_login_my_account_input_field_password}@]
                      </td>
                    </tr>
                    [@{if $box_login_my_account_link_filename_password_forgotten}@]
                    <tr>
                      <td class="info-box-contents">
                        <a href="[@{$box_login_my_account_link_filename_password_forgotten}@]">[@{#box_login_my_account_forgot_password#}@]</a>
                      </td>
                    </tr>
                    [@{/if}@]            
                    <tr>
                      <td class="info-box-contents"><br />
                        <script type="text/javascript">
                        /* <![CDATA[ */
                          document.write('<a href="" onclick="box_login.submit(); return false" class="button-login" style="float: left" title=" [@{#button_title_login#}@] "><span>[@{#button_text_login#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                        /* ]]> */  
                        </script>
                        <noscript>
                          <input type="submit" value="[@{#button_text_login#}@]" />
                        </noscript>
		        <br /><br /><br />	
                      </td>
                    </tr>
                    <tr>
                      <td class="info-box-contents">
              	        <span class="greet-user">[@{#box_login_my_account_new_a#}@]</span><br /><a href="[@{$box_login_my_account_link_filename_create_account}@]"><span class="smallText">[@{#box_login_my_account_new_b#}@]</span></a>
                      </td>
                    </tr>
                  </table>[@{$box_login_my_account_form_end}@]</td>
                </tr>
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </td>
      </tr>
<!-- login_eof -->
[@{/if}@]
