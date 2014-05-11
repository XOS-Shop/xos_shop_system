[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox-dotted
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : contact_us.tpl
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

<!-- contact_us -->
    [@{$form_begin}@]        
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        

          [@{if $message_stack}@]          
          [@{$message_stack}@]               
          <div style="height: 10px; font-size: 0;">&nbsp;</div>             
          [@{/if}@]  
                      
      [@{if $sent}@]  
      
          <div style="float: left;"><img src="[@{$images_path}@]table_background.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></div>
          <div style="padding-left: 200px;">
            <div class="main">[@{#text_success#}@]</div>
          </div>
          <div class="clear">&nbsp;</div>          
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px; 4px 15px;">                      
              <a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a>
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div> 
                                      
      [@{else}@]      

          <fieldset>          
          <div class="info-box-central-contents">
                      
            <label class="main" style="padding: 4px;" for="contact_us_name"><b>[@{#entry_name#}@]</b></label>
            <div class="main" style="padding: 4px;">[@{$input_field_name}@]</div>
                
            <label class="main" style="padding: 4px;" for="contact_us_email_address"><b>[@{#entry_email#}@]</b></label>
            <div class="main" style="padding: 4px;">[@{$input_field_email}@]</div>                              
                            
        [@{if !$isset_customer_id}@]          

            <label class="main" style="padding: 4px;" for="contact_us_security_code"><b>[@{#entry_security_code#}@]</b></label>
            <div>
              <div class="main" style="padding: 4px; float: left;">[@{$input_security_code}@]</div>
              <div class="main" style="padding: 6px 4px 4px 4px; float: left;"><img src="[@{$images_path}@]arrow_captcha.gif" alt="" /></div>
              <div class="main" style="margin: -17px 4px 4px 4px; float: left;">[@{$captcha_img}@]</div>                         
            </div>
            <div class="clear">&nbsp;</div>
     
        [@{/if}@] 
        
            <label class="main" style="padding: 4px;" for="contact_us_enquiry"><b>[@{#entry_enquiry#}@]</b></label>
            <div class="main" style="padding: 4px;">[@{$textarea}@]</div> 

          </div>  
          </fieldset> 
          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <script type="text/javascript">
              /* <![CDATA[ */
                document.write('<a href="" onclick="contact_us.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
              /* ]]> */  
              </script>
              <noscript>
                <input type="submit" value="[@{#button_text_continue#}@]" />
              </noscript>                                                                                                                      
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>        
        
      [@{/if}@]      
    [@{$form_end}@]
<!-- contact_us_eof -->
