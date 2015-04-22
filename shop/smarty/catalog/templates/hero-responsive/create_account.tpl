[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7y
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
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
          <h1 class="text-orange">[@{#heading_title#}@]</h1>  
              
          <div class="div-spacer-h10"></div>
          
          <div><br /><span class="red-mark"><small><b>[@{#sub_title_origin_login#}@]</b></small></span> [@{eval var=#text_origin_login#}@]</div>
          
          <div class="div-spacer-h10"></div>  
           
          [@{if $message_stack_error}@]
          <div class="alert alert-danger" role="alert">
            [@{$message_stack_error}@]
          </div>                            
          [@{/if}@]
          [@{if $message_stack_warning}@]
          <div class="alert alert-warning" role="alert">
            [@{$message_stack_warning}@]
          </div>                            
          [@{/if}@]          
          [@{if $message_stack_success}@]
          <div class="alert alert-success" role="alert">
            [@{$message_stack_success}@]
          </div>                            
          [@{/if}@]
          
          <div class="input-requirement-moved pull-right">[@{#form_required_information#}@]</div>
          <div class="clearfix invisible"></div>          
          
          <fieldset>
            <legend>[@{#category_personal#}@]</legend>
            <div class="well well-sm">                                
              [@{if $account_gender}@] 
              <div class="row [@{if $gender_error}@]has-error[@{/if}@]">           
                <div class="col-xs-3 col-sm-2 form-group">            
                  <span class="control-label">[@{#entry_gender#}@]</span><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_GENDER_TEXT}@]</span> 
                </div>                      
                <div class="col-xs-9 col-sm-10 form-group">            
                  [@{$input_gender}@]
                </div>            
              </div>                     
              [@{/if}@]
              
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $first_name_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="firstname">[@{#entry_first_name#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_FIRST_NAME_TEXT}@]</span>
                  [@{$input_firstname|replace:'>&nbsp;':'>'}@] 
                </div>                      
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group[@{if $last_name_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="lastname">[@{#entry_last_name#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_LAST_NAME_TEXT}@]</span>
                  [@{$input_lastname|replace:'>&nbsp;':'>'}@]
                </div>            
              </div>                         
              
              [@{if $languages}@]            
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $email_address_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="email_address">[@{#entry_email_address#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_EMAIL_ADDRESS_TEXT}@]</span>
                  [@{$input_email_address|replace:'>&nbsp;':'>'}@]
                </div>                       
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group">
                  <label class="control-label" for="languages">[@{#entry_language#}@]</label>
                  [@{$pull_down_menu_languages|replace:'>&nbsp;':'>'}@]
                </div>            
              </div>                             
              [@{else}@]            
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $email_address_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="email_address">[@{#entry_email_address#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_EMAIL_ADDRESS_TEXT}@]</span>
                  [@{$input_email_address|replace:'>&nbsp;':'>'}@]
                </div>            
              </div> 
              [@{/if}@]
              
              [@{if $account_dob}@]
              <div class="row">           
                <div class="col-sm-9 form-group[@{if $date_of_birth_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="dob_first">[@{#entry_date_of_birth#}@]</label><span class="input-requirement-moved">&nbsp;&nbsp;[@{$smarty.const.ENTRY_DATE_OF_BIRTH_TEXT_1}@]</span>
                  <div class="form-inline-dob">                                            
                    [@{$pull_down_menus_dob}@]
                  </div> 
                </div>            
              </div>                         
              [@{/if}@]                       
            </div>                            
          </fieldset>
          [@{if $account_company}@]
          
          <div class="div-spacer-h10"></div>
           
          <fieldset>
            <legend>[@{#category_company#}@]</legend>
            <div class="well well-sm">            
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group">
                  <label class="control-label" for="company">[@{#entry_company#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_COMPANY_TEXT}@]</span>
                  [@{$input_company|replace:'>&nbsp;':'>'}@]
                </div>                     
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group">
                  <label class="control-label" for="company_tax_id">[@{#entry_company_tax_id#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_COMPANY_TAX_ID_TEXT}@]</span>
                  [@{$input_company_tax_id|replace:'>&nbsp;':'>'}@]
                </div>            
              </div>                                              
            </div>
          </fieldset>          
          [@{/if}@] 
      
          <div class="div-spacer-h10"></div>

          <fieldset>
            <legend>[@{#category_address#}@]</legend>   
            <div class="well well-sm">            
              [@{if $account_suburb}@]          
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $street_address_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="street_address">[@{#entry_street_address#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_STREET_ADDRESS_TEXT}@]</span>
                  [@{$input_street_address|replace:'>&nbsp;':'>'}@]
                </div>                      
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group">
                  <label class="control-label" for="suburb">[@{#entry_suburb#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_SUBURB_TEXT}@]</span>
                  [@{$input_suburb|replace:'>&nbsp;':'>'}@]
                </div>            
              </div>                             
              [@{else}@]
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $street_address_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="street_address">[@{#entry_street_address#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_STREET_ADDRESS_TEXT}@]</span>
                  [@{$input_street_address|replace:'>&nbsp;':'>'}@]
                </div>            
              </div>
              [@{/if}@]               
  
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $post_code_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="postcode">[@{#entry_post_code#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_POST_CODE_TEXT}@]</span>
                  [@{$input_postcode|replace:'>&nbsp;':'>'}@]
                </div>                     
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group[@{if $city_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="city">[@{#entry_city#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_CITY_TEXT}@]</span>
                  [@{$input_city|replace:'>&nbsp;':'>'}@]
                </div>            
              </div>  
  
              [@{if $account_state}@] 
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $state_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="state">[@{#entry_state#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_STATE_TEXT}@]</span>
                  [@{$input_state|replace:'>&nbsp;':'>'}@]
                </div>                      
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group[@{if $country_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="country">[@{#entry_country#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_COUNTRY_TEXT}@]</span>
                  [@{$input_country|replace:'>&nbsp;':'>'}@]
                </div>            
              </div> 
              [@{else}@]             
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $country_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="country">[@{#entry_country#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_COUNTRY_TEXT}@]</span>
                  [@{$input_country|replace:'>&nbsp;':'>'}@]
                </div>            
              </div> 
              [@{/if}@]                                                  
            </div>
          </fieldset>          
          
          <div class="div-spacer-h10"></div>

          <fieldset>
            <legend>[@{#category_contact#}@]</legend>   
            <div class="well well-sm">
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $telephone_number_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="telephone">[@{#entry_telephone_number#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_TELEPHONE_NUMBER_TEXT}@]</span>
                  [@{$input_telephone|replace:'>&nbsp;':'>'}@]
                </div>                      
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group">
                  <label class="control-label" for="fax">[@{#entry_fax_number#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_FAX_NUMBER_TEXT}@]</span>
                  [@{$input_fax|replace:'>&nbsp;':'>'}@]
                </div>            
              </div>                        
            </div>
          </fieldset>          
          
          [@{if $input_newsletter}@]
          <div class="div-spacer-h10"></div>

          <fieldset>
            <legend>[@{#category_options#}@]</legend>   
            <div class="well well-sm"> 
              <div class="row">           
                <div class="col-sm-6">
                  <div class="checkbox">
                    <label>
                      [@{$input_newsletter|replace:'>&nbsp;':'>'}@]
                      <b>[@{#entry_newsletter#}@]</b><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_NEWSLETTER_TEXT}@]</span> 
                    </label>
                  </div>  
                </div>
              </div>
            </div>
          </fieldset>          
          [@{/if}@]
      
          <div class="div-spacer-h10"></div>

          <fieldset>
            <legend>[@{#category_password#}@]</legend>   
            <div class="well well-sm">
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group[@{if $password_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="password">[@{#entry_password#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_PASSWORD_TEXT}@]</span>
                  [@{$input_password|replace:'>&nbsp;':'>'}@]
                </div>                      
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group[@{if $password_error}@] has-error[@{/if}@]">
                  <label class="control-label" for="confirmation">[@{#entry_password_confirmation#}@]</label><span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_PASSWORD_CONFIRMATION_TEXT}@]</span>
                  [@{$input_confirmation|replace:'>&nbsp;':'>'}@]
                </div>            
              </div>              
            </div>
          </fieldset>          

          <div class="div-spacer-h10"></div>
          
          [@{if $link_filename_popup_content_7}@] 
          <div><b>[@{#category_information#}@]</b></div>     
          <div>                   
            <a href="[@{$link_filename_popup_content_7}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_privacy_notice_link#}@]</span></a>
          </div>
                     
          <div class="div-spacer-h20"></div>               
          [@{/if}@]
          
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                             
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                  
          </div>                     
          [@{$form_end}@]
<!-- create_account_eof -->
