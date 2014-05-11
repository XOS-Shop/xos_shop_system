[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox-dotted
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
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
          <a id="toggle_my_account_heading" class="header" style="float: right;" href="[@{$box_login_my_account_link_filename_account}@]">[@{#box_heading_login_my_account_my_account#}@]</a>
          <div class="clear">&nbsp;</div>
          <div id="toggle_my_account_contents" class="info-box-contents" style="width:180px; padding: 3px 3px 11px 3px; float: right; border: 1px solid #b6b7cb; display: none;">
            <img id="toggle_my_account_close" style="float: right;" src="[@{$images_path}@]button_close.gif" title=" [@{#close_window#}@] " alt="[@{#close_window#}@]" />                  
            <div style="padding-left: 1px;"><br />[@{$box_login_my_account_welcome_string}@]<br /><br /></div>
            <div style="padding: 1px;"><a href="[@{$box_login_my_account_link_filename_account}@]">[@{#box_login_my_account_my_account#}@]</a></div>
            <div style="padding: 1px;"><a href="[@{$box_login_my_account_link_filename_account_edit}@]">[@{#box_login_my_account_account_edit#}@]</a></div>
            <div style="padding: 1px;"><a href="[@{$box_login_my_account_link_filename_account_history}@]">[@{#box_login_my_account_account_history#}@]</a></div>
            <div style="padding: 1px;"><a href="[@{$box_login_my_account_link_filename_address_book}@]">[@{#box_login_my_account_address_book#}@]</a></div>
            [@{if $box_login_my_account_link_filename_account_notifications}@]
            <div style="padding: 1px;"><a href="[@{$box_login_my_account_link_filename_account_notifications}@]">[@{#box_login_my_account_product_notifications#}@]</a></div>
            [@{/if}@]
            <div class="main" style="padding: 5px 0 0 1px;"><a href="[@{$box_login_my_account_link_filename_logoff}@]"><b>[@{#box_login_my_account_logoff#}@]</b></a></div>
          </div>
          <div class="clear">&nbsp;</div>
          <script type="text/javascript">
          /* <![CDATA[ */
            $('#toggle_my_account_heading').click(function() {
              $('#toggle_my_account_contents').toggle(400);
              return false;
            });
            $('#toggle_my_account_close').click(function() {
              $('#toggle_my_account_contents').toggle(400);
              return false;
            });                      
            $('#toggle_my_account_contents').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});
          /* ]]> */  
          </script>          
<!-- my_account_eof -->
[@{else}@]
<!-- login -->
          <a id="toggle_login_heading" class="header" style="float: right;" href="[@{$box_login_my_account_link_filename_account}@]">[@{#box_heading_login_my_account_login_here#}@]</a>
          <div class="clear">&nbsp;</div>
          <div id="toggle_login_contents" class="info-box-contents" style="width:180px; padding: 3px 3px 11px 3px; float: right; border: 1px solid #b6b7cb; display: none;">
          [@{$box_login_my_account_form_begin}@]
            <img id="toggle_login_close" style="float: right;" src="[@{$images_path}@]button_close.gif" title=" [@{#close_window#}@] " alt="[@{#close_window#}@]" />                   
            <div style="padding-left: 1px;">[@{$box_login_my_account_welcome_string}@]<br /><br /></div>
            <div style="padding-left: 1px;"><label for="box_login_email_address">[@{#box_login_my_account_email#}@]</label></div> 
            <div style="padding-left: 1px;">[@{$box_login_my_account_input_field_email_address}@]</div> 
            <div style="padding-left: 1px;"><label for="box_login_password">[@{#box_login_my_account_password#}@]</label></div> 
            <div style="padding-left: 1px;">[@{$box_login_my_account_input_field_password}@]</div>
            [@{if $box_login_my_account_link_filename_password_forgotten}@]
            <div style="padding-left: 1px;"><a href="[@{$box_login_my_account_link_filename_password_forgotten}@]">[@{#box_login_my_account_forgot_password#}@]</a></div>
            [@{/if}@]            
            <div style="padding-left: 1px;">
              <br />
              <script type="text/javascript">
              /* <![CDATA[ */
                document.write('<a href="" onclick="box_login.submit(); return false" class="button-login" style="float: left" title=" [@{#button_title_login#}@] "><span>[@{#button_text_login#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
              /* ]]> */  
              </script>
              <noscript>
                <input type="submit" value="[@{#button_text_login#}@]" />
              </noscript>
              <br /><br /><br />            
            </div>
            <div style="padding-left: 1px;"><span class="greet-user">[@{#box_login_my_account_new_a#}@]</span><br /><a href="[@{$box_login_my_account_link_filename_create_account}@]"><span class="smallText">[@{#box_login_my_account_new_b#}@]</span></a></div>
          [@{$box_login_my_account_form_end}@]                          
          </div>
          <div class="clear">&nbsp;</div>
          <script type="text/javascript">
          /* <![CDATA[ */
            $('#toggle_login_heading').click(function() {
              $('#toggle_login_contents').toggle(400);
              return false;
            });
            $('#toggle_login_close').click(function() {
              $('#toggle_login_contents').toggle(400);
              return false;
            });                      
            $('#toggle_login_contents').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});
          /* ]]> */  
          </script>          
<!-- login_eof -->
[@{/if}@]