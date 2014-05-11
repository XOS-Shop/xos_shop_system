[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : account_password.tpl
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

<!-- account_password -->
    [@{$form_begin}@][@{$hidden_field}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
          [@{if $message_stack}@]
          [@{$message_stack}@]          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>              
          [@{/if}@]

          <fieldset>
          <legend>[@{#my_password_title#}@]</legend>
          
          <div class="main" style="float: left;"><b>[@{#my_password_title#}@]</b></div>
          <div class="input-requirement" style="text-align: right; float: right;">[@{#form_required_information#}@]</div>
          <div class="clear">&nbsp;</div>
          
          <div class="info-box-central-contents">
            
            <label class="main account-password-label" for="password_current">[@{#entry_password_current#}@]</label>
            <div class="main account-password-input">[@{$input_password_current}@]</div>
            <div class="clear">&nbsp;</div>
            
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
                
            <label class="main account-password-label" for="password_new">[@{#entry_password_new#}@]</label>
            <div class="main account-password-input">[@{$input_password_new}@]</div>
            <div class="clear">&nbsp;</div>                                 
            
            <label class="main account-password-label" for="password_confirmation">[@{#entry_password_confirmation#}@]</label>
            <div class="main account-password-input">[@{$input_password_confirmation}@]</div>
            <div class="clear">&nbsp;</div>                    
                            
          </div>
          </fieldset>
    
          <div style="height: 10px; font-size: 0;">&nbsp;</div>          
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <div style="float: left;">
                <a href="[@{$link_filename_account}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              </div>
              <div style="float: right;">
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="if(account_password.onsubmit())account_password.submit(); return false" class="button-continue" style="float: left" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                /* ]]> */  
                </script>
                <noscript>
                  <input type="submit" value="[@{#button_text_continue#}@]" />
                </noscript>                               
              </div>                                                                                                                                 
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>      
    [@{$form_end}@]
<!-- account_password_eof -->
