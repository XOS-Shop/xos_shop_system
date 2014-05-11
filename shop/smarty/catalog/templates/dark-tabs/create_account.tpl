[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : create_account.tpl
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

<!-- create_account -->
          [@{$form_begin}@][@{$hidden_field}@]
          <h1 class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</h1>  
              
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          
          <div class="small-text"><br /><span class="red-mark"><small><b>[@{#sub_title_origin_login#}@]</b></small></span> [@{eval var=#text_origin_login#}@]</div>
          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>  
           
          [@{if $message_stack}@]
          [@{$message_stack}@]
          
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
             
          [@{/if}@]
          <fieldset>
          <legend>[@{#category_personal#}@]</legend>
          
          <div class="main" style="float: left;"><b>[@{#category_personal#}@]</b></div>
          <div class="input-requirement" style="text-align: right; float: right;">[@{#form_required_information#}@]</div>
          <div class="clear">&nbsp;</div>
          
          <div class="info-box-central-contents">
                      
            [@{if $account_gender}@]
            <div class="main create-account-label">[@{#entry_gender#}@]</div>
            <div class="main create-account-input">[@{$input_gender}@]</div>
            <div class="clear">&nbsp;</div>
            [@{/if}@]
            
            <label class="main create-account-label" for="firstname">[@{#entry_first_name#}@]</label>
            <div class="main create-account-input">[@{$input_firstname}@]</div>
            <div class="clear">&nbsp;</div>
                
            <label class="main create-account-label" for="lastname">[@{#entry_last_name#}@]</label>
            <div class="main create-account-input">[@{$input_lastname}@]</div>
            <div class="clear">&nbsp;</div>                                 

            [@{if $account_dob}@]
            <label class="main create-account-label" for="dob_first">[@{#entry_date_of_birth#}@]</label>
            <div class="main create-account-input">[@{$pull_down_menus_dob}@]</div>
            <div class="clear">&nbsp;</div>              
            [@{/if}@]
            
            <label class="main create-account-label" for="email_address">[@{#entry_email_address#}@]</label>
            <div class="main create-account-input">[@{$input_email_address}@]</div>
            <div class="clear">&nbsp;</div>              

            [@{if $languages}@] 
            <label class="main create-account-label" for="languages">[@{#entry_language#}@]</label>
            <div class="main create-account-input">[@{$pull_down_menu_languages}@]</div>
            <div class="clear">&nbsp;</div>                
            [@{/if}@]
                            
          </div>
          </fieldset>
          [@{if $account_company}@]
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
           
          <fieldset>
          <legend>[@{#category_company#}@]</legend>
                    
          <div class="main"><b>[@{#category_company#}@]</b></div>

          <div class="info-box-central-contents">
          
            <label class="main create-account-label" for="company">[@{#entry_company#}@]</label>
            <div class="main create-account-input">[@{$input_company}@]</div>
            <div class="clear">&nbsp;</div>                       

            <label class="main create-account-label" for="company_tax_id">[@{#entry_company_tax_id#}@]</label>
            <div class="main create-account-input">[@{$input_company_tax_id}@]</div>
            <div class="clear">&nbsp;</div>  

          </div>
          </fieldset>          
          [@{/if}@] 
      
          <div style="height: 10px; font-size: 0;">&nbsp;</div>

          <fieldset>
          <legend>[@{#category_address#}@]</legend>
          
          <div class="main"><b>[@{#category_address#}@]</b></div>     

          <div class="info-box-central-contents">
          
            <label class="main create-account-label" for="street_address">[@{#entry_street_address#}@]</label>
            <div class="main create-account-input">[@{$input_street_address}@]</div>
            <div class="clear">&nbsp;</div>            

            [@{if $account_suburb}@] 
            <label class="main create-account-label" for="suburb">[@{#entry_suburb#}@]</label>
            <div class="main create-account-input">[@{$input_suburb}@]</div>
            <div class="clear">&nbsp;</div>                
            [@{/if}@]
              
            <label class="main create-account-label" for="postcode">[@{#entry_post_code#}@]</label>
            <div class="main create-account-input">[@{$input_postcode}@]</div>
            <div class="clear">&nbsp;</div>                

            <label class="main create-account-label" for="city">[@{#entry_city#}@]</label>
            <div class="main create-account-input">[@{$input_city}@]</div>
            <div class="clear">&nbsp;</div>                

            [@{if $account_state}@] 
            <label class="main create-account-label" for="state">[@{#entry_state#}@]</label>
            <div class="main create-account-input">[@{$input_state}@]</div>
            <div class="clear">&nbsp;</div>                
            [@{/if}@]
            
            <label class="main create-account-label" for="country">[@{#entry_country#}@]</label>
            <div class="main create-account-input">[@{$input_country}@]</div>
            <div class="clear">&nbsp;</div>                

          </div>
          </fieldset>          
          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>

          <fieldset>
          <legend>[@{#category_contact#}@]</legend>
          
          <div class="main"><b>[@{#category_contact#}@]</b></div>     

          <div class="info-box-central-contents">
           
            <label class="main create-account-label" for="telephone">[@{#entry_telephone_number#}@]</label>
            <div class="main create-account-input">[@{$input_telephone}@]</div>
            <div class="clear">&nbsp;</div>                     
            
            <label class="main create-account-label" for="fax">[@{#entry_fax_number#}@]</label>
            <div class="main create-account-input">[@{$input_fax}@]</div>
            <div class="clear">&nbsp;</div>                

          </div>
          </fieldset>          
          
          [@{if $input_newsletter}@]
          <div style="height: 10px; font-size: 0;">&nbsp;</div>

          <fieldset>
          <legend>[@{#category_options#}@]</legend>
          
          <div class="main"><b>[@{#category_options#}@]</b></div>     

          <div class="info-box-central-contents"> 
               
            <label class="main create-account-label" for="newsletter">[@{#entry_newsletter#}@]</label>
            <div class="main create-account-input">[@{$input_newsletter}@]</div>
            <div class="clear">&nbsp;</div> 
                               
          </div>
          </fieldset>          
          [@{/if}@]
      
          <div style="height: 10px; font-size: 0;">&nbsp;</div>

          <fieldset>
          <legend>[@{#category_password#}@]</legend>
          
          <div class="main"><b>[@{#category_password#}@]</b></div>     

          <div class="info-box-central-contents"> 
                
            <label class="main create-account-label" for="password">[@{#entry_password#}@]</label>
            <div class="main create-account-input">[@{$input_password}@]</div>
            <div class="clear">&nbsp;</div>              

            <label class="main create-account-label" for="confirmation">[@{#entry_password_confirmation#}@]</label>
            <div class="main create-account-input">[@{$input_confirmation}@]</div>
            <div class="clear">&nbsp;</div>               

          </div>
          </fieldset>          

          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          
          [@{if $link_filename_popup_content_6}@] 
          <div class="main"><b>[@{#category_information#}@]</b></div>     

          <div class="info-box-central-contents">            

            <div class="main" style="margin: 4px;">         
              <script type="text/javascript">
              /* <![CDATA[ */            
                document.write('<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_privacy_notice_link#}@]</span></a>');
              /* ]]> */   
              </script>              
              <noscript>
                <a href="[@{$link_filename_popup_content_6}@]" target="_blank"><span class="text-deco-underline">[@{#text_privacy_notice_link#}@]</span></a>
              </noscript>          
            </div> 
            
          </div>
          
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
              
          [@{/if}@]
      
          <div class="info-box-central-contents">

            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <div style="float: left;">
                <a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              </div>
              <div style="float: right;">                  
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="if(create_account.onsubmit())create_account.submit(); return false" class="button-continue" style="float: left" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
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
<!-- create_account_eof -->
