[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : newsletter_subscribe.tpl
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

<!-- newsletter_subscribe -->
[@{if $action == 'subscribe'}@] 
          <h1 class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</h1>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        
          <div class="info-box-central-contents"> 
            <div style="height: 10px; font-size: 0;">&nbsp;</div>             
            <div class="main" style="padding: 4px">
            [@{if $successful}@]
              [@{#text_subscribed#}@]
            [@{else}@]
              <span class="red-mark">[@{#text_no_email_address_found#}@]</span>
            [@{/if}@]
            </div>           
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
          </div>                    
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                         
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a>                                                                                                                    
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>
[@{elseif $action == 'unsubscribe'}@]
          <h1 class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</h1>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        
          <div class="info-box-central-contents"> 
            <div style="height: 10px; font-size: 0;">&nbsp;</div>             
            <div class="main" style="padding: 4px">
            [@{if $successful}@]
              [@{#text_unsubscribed#}@]
            [@{else}@]
              <span class="red-mark">[@{#text_no_email_address_found#}@]</span>
            [@{/if}@]
            </div>           
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
          </div>                    
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                         
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a>                                                                                                                    
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>
[@{elseif $newsletter_conf_email_sent}@]
          <h1 class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</h1>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>              
          [@{$message_stack}@]              
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a>                                                                                                                    
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>
[@{else}@]
          [@{$form_begin}@]
          <h1 class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</h1>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        

          [@{if $message_stack}@]          
          [@{$message_stack}@]               
          <div style="height: 10px; font-size: 0;">&nbsp;</div>             
          [@{/if}@]

          <div class="info-box-central-contents"> 
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            <div class="main" style="padding: 4px"><b>[@{#text_main#}@]</b></div>
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            <fieldset>
              <label class="main" style="padding: 4px; width: 145px; float: left; display: block;" for="newsletter_subscribe_email_address"><b>[@{#entry_email_address#}@]</b></label>
              <div class="main" style="padding: 4px; float: left;">[@{$input_field_email_address}@]</div>
              [@{if $pull_down_menu_languages}@]
              <label class="main" style="padding: 4px 4px 4px 35px; float: left; display: block;" for="newsletter_subscribe_languages"><b>[@{#entry_language#}@]</b></label>
              <div class="main" style="padding: 4px; float: left;">[@{$pull_down_menu_languages}@]</div>
              [@{/if}@]
              <div class="clear">&nbsp;</div>              
              <div style="height: 10px; font-size: 0;">&nbsp;</div>
              [@{if !$isset_customer_id}@]
              <label class="main" style="padding: 14px 4px 4px 4px; width: 145px; float: left; display: block;" for="newsletter_subscribe_security_code"><b>[@{#entry_security_code#}@]</b></label>
              <div class="main" style="padding: 14px 4px 4px 4px; float: left;">[@{$input_security_code}@]</div>
              <div class="main" style="padding: 17px 4px 4px 4px; float: left;"><img src="[@{$images_path}@]arrow_captcha.gif" alt="" /></div>
              <div class="main" style="padding: 4px; float: left;">[@{$captcha_img}@]</div>
              <div class="clear">&nbsp;</div>
              [@{/if}@]                         
            </fieldset>
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            <div class="main" style="padding: 4px">[@{#text_info_confirm#}@]</div>
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
          </div>                    
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <div style="float: right;">
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="newsletter_subscribe.submit(); return false" class="button-continue" style="float: left" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
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
[@{/if}@]    
<!-- newsletter_subscribe_eof -->
