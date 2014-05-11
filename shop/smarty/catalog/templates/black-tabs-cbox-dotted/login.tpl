[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox-dotted
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
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
    [@{$form_begin}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        
      [@{if $sppc_toggle_login}@]
          <div class="info-box-central-contents" style="width: 315px; padding: 4px; margin : 0 auto;">
            <fieldset>                
              <div style="height: 10px; font-size: 0;">&nbsp;</div>                
              <label class="main" for="new_customers_group_id"><b>[@{#text_choose_customer_group#}@]</b></label>
              <div style="height: 10px; font-size: 0;">&nbsp;</div>
              <div class="main">[@{$customers_groups_pull_down_menu}@]</div>            
              <div style="height: 10px; font-size: 0;">&nbsp;</div>
            </fieldset>            
            <div class="main" style="padding: 2px 6px 2px 0; float: right;">[@{$hidden_field_email_address}@][@{$hidden_field_password}@]                      
              <script type="text/javascript">
              /* <![CDATA[ */
                document.write('<a href="" onclick="login.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
              /* ]]> */  
              </script>
              <noscript>
                <input type="submit" value="[@{#button_text_continue#}@]" />
              </noscript>                 
            </div>
            <div style="height: 0; font-size: 0;">&nbsp;</div>             
            <div class="clear">&nbsp;</div>
            <div style="height: 0; font-size: 0;">&nbsp;</div>                         
          </div>                                                             
      [@{else}@]          
          [@{if $cart_contents}@]      
          <div class="small-text">[@{#text_visitors_cart#}@]
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
          </div>          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>          
          [@{/if}@] 
      
          [@{if $message_stack}@]
          [@{$message_stack}@]          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>             
          [@{/if}@]            

          <div style="width: 315px; padding: 2px 0 0 2px; float: left">             
            <div class="main"><b>[@{#heading_new_customer#}@]</b></div>
            <div class="info-box-central-contents" style="padding: 4px;">            
        
                <div style="height: 10px; font-size: 0;">&nbsp;</div>             
                <div class="main">[@{#text_new_customer#}@]<br /><br />[@{eval var=#text_new_customer_introduction#}@]</div>            
                <div style="height: 10px; font-size: 0;">&nbsp;</div>            
                          
              <div class="main" style="padding: 2px 6px 2px 0; float: right;">                      
                <a href="[@{$link_filename_create_account}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a>                  
              </div> 
              <div style="height: 0; font-size: 0;">&nbsp;</div>            
              <div class="clear">&nbsp;</div>
              <div style="height: 0; font-size: 0;">&nbsp;</div>
            </div>                                               
          </div>
          <div style="width: 315px; padding: 2px 2px 0 0; float: right">
            
            <div class="main"><b>[@{#heading_returning_customer#}@]</b></div>

            <div class="info-box-central-contents" style="padding: 4px;">
                <div style="height: 10px; font-size: 0;">&nbsp;</div>             
                <div class="main">[@{#text_returning_customer#}@]</div>            
                <div style="height: 10px; font-size: 0;">&nbsp;</div> 

              <fieldset>                                                 
                <label class="main login-label" for="email_address"><b>[@{#entry_email_address#}@]</b></label>
                <div class="main login-input">[@{$input_field_email_address}@]</div>
                <div class="clear">&nbsp;</div> 

                <label class="main login-label" for="password"><b>[@{#entry_password#}@]</b></label>
                <div class="main login-input">[@{$input_field_password}@]</div>
                <div class="clear">&nbsp;</div> 
            
                <div style="height: 10px; font-size: 0;">&nbsp;</div>

                [@{if $link_filename_password_forgotten}@]
                <div class="small-text"><a href="[@{$link_filename_password_forgotten}@]">[@{#text_password_forgotten#}@]</a></div>
                [@{/if}@]                            
                <div style="height: 10px; font-size: 0;">&nbsp;</div>
              </fieldset>            
              <div class="main" style="padding: 2px 6px 2px 0; float: right;">                      
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="login.submit(); return false" class="button-login" style="float: right;" title=" [@{#button_title_login#}@] "><span>[@{#button_text_login#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                /* ]]> */  
                </script>
                <noscript>
                  <input type="submit" value="[@{#button_text_login#}@]" />
                </noscript>                  
              </div>
              <div style="height: 0; font-size: 0;">&nbsp;</div>             
              <div class="clear">&nbsp;</div>
              <div style="height: 0; font-size: 0;">&nbsp;</div>                         
            </div>                                                             
          </div>
          <div class="clear">&nbsp;</div>
      [@{/if}@]      
    [@{$form_end}@]            
          <div style="padding: 0 2px 0 2px;">
            <div style="height: 20px; font-size: 0;">&nbsp;</div>
            <div class="info-box-central-contents">                             
              <div class="main" style="margin: 4px 15px 4px 15px;">                      
                <a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>                                                                                                                 
                <div class="clear">&nbsp;</div>                    
              </div>             
            </div>
          </div>    
<!-- login_eof -->
