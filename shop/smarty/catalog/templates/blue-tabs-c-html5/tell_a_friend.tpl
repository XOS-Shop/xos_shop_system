[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c-html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : tell_a_friend.tpl
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

<!-- tell_a_friend -->           
    [@{$form_begin}@]    
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{eval var=#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        

          [@{if $message_stack}@]          
          [@{$message_stack}@]               
          <div style="height: 10px; font-size: 0;">&nbsp;</div>             
          [@{/if}@]   


          <fieldset>
          <legend>[@{#form_title_customer_details#}@]</legend>
          
          <div class="main" style="float: left;"><b>[@{#form_title_customer_details#}@]</b></div>
          <div class="input-requirement" style="text-align: right; float: right;">[@{#form_required_information#}@]</div>
          <div class="clear">&nbsp;</div>
          
          <div class="info-box-central-contents">
                      
            <label class="main tell-a-friend-label" for="tell_a_friend_from_name">[@{#form_field_customer_name#}@]</label>
            <div class="main tell-a-friend-input">[@{$input_field_from_name}@]&nbsp;<span class="input-requirement">[@{#entry_first_name_text#}@]</span></div>
            <div class="clear">&nbsp;</div>
                
            <label class="main tell-a-friend-label" for="tell_a_friend_from_email_address">[@{#form_field_customer_email#}@]</label>
            <div class="main tell-a-friend-input">[@{$input_field_from_email_address}@]&nbsp;<span class="input-requirement">[@{#entry_email_address_text#}@]</span></div>
            <div class="clear">&nbsp;</div>                                 
                            
          </div>
          </fieldset>
          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
           
          <fieldset>
          <legend>[@{#form_title_friend_details#}@]</legend>
                    
          <div class="main"><b>[@{#form_title_friend_details#}@]</b></div>

          <div class="info-box-central-contents">
          
            <label class="main tell-a-friend-label" for="tell_a_friend_to_name">[@{#form_field_friend_name#}@]</label>
            <div class="main tell-a-friend-input">[@{$input_field_to_name}@]&nbsp;<span class="input-requirement">[@{#entry_first_name_text#}@]</span></div>
            <div class="clear">&nbsp;</div>                       

            <label class="main tell-a-friend-label" for="tell_a_friend_to_email_address">[@{#form_field_friend_email#}@]</label>
            <div class="main tell-a-friend-input">[@{$input_field_to_email_address}@]&nbsp;<span class="input-requirement">[@{#entry_email_address_text#}@]</span></div>
            <div class="clear">&nbsp;</div>  

          </div>
          </fieldset> 


        [@{if !$isset_customer_id}@]          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
                    
          <fieldset>
          <legend>[@{#form_title_for_your_safety#}@]</legend>
                    
          <div class="main"><b>[@{#form_title_for_your_safety#}@]</b></div>

          <div class="info-box-central-contents">

            <label class="main" style="padding: 14px 4px 4px 4px; width: 180px; float: left; display: block;" for="tell_a_friend_security_code">[@{#form_field_security_code#}@]</label>
            <div class="main" style="padding: 14px 4px 4px 4px; float: left;">[@{$input_security_code}@]</div>
            <div class="main" style="padding: 17px 4px 4px 4px; float: left;"><img src="[@{$images_path}@]arrow_captcha.gif" alt="" /></div>
            <div class="main" style="padding: 4px; float: left;">[@{$captcha_img}@]</div>
            <div class="main" style="padding: 17px 4px 4px 4px; float: left;"><span class="input-requirement">[@{#entry_security_code_text#}@]</span></div>
            <div class="clear">&nbsp;</div>                         

          </div>
          </fieldset>        
        [@{/if}@] 
        
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
           
          <fieldset>
          <legend>[@{#form_title_friend_message#}@]</legend>
                    
          <div class="main"><label for="tell_a_friend_message"><b>[@{#form_title_friend_message#}@]</b></label></div>

          <div class="info-box-central-contents">
            
            <div class="small-text" style="padding: 2px;"><b>[@{#sub_title_no_html#}@]</b>&nbsp;[@{#text_no_html#}@]<br />[@{$textarea_field_message}@]</div>                  

          </div>
          </fieldset>                   
          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>

          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <div style="float: left;">
                <a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              </div>
              <div style="float: right;">
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="email_friend.submit(); return false" class="button-continue" style="float: left" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
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
<!-- tell_a_friend_eof -->
