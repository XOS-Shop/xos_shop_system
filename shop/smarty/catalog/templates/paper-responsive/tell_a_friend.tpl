[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : paper-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.1
* descrip    : xos-shop template built with Bootstrap3 and theme paper                                                                    
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
          <h1 class="text-orange">[@{eval var=#heading_title#}@]</h1>                      

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
          <legend>[@{#form_title_customer_details#}@]</legend>
                   
            <div class="row">           
              <div class="col-sm-6 col-lg-5 form-group[@{if $error_from_name}@] has-error[@{/if}@]">
                <label class="control-label" for="tell_a_friend_from_name">[@{#form_field_customer_name#}@]</label><span class="input-requirement-moved">&nbsp;[@{#entry_first_name_text#}@]</span>
                [@{$input_field_from_name}@]
              </div>                      
              <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group[@{if $error_from_address}@] has-error[@{/if}@]">
                <label class="control-label" for="tell_a_friend_from_email_address">[@{#form_field_customer_email#}@]</label><span class="input-requirement-moved">&nbsp;[@{#entry_email_address_text#}@]</span>
                [@{$input_field_from_email_address}@]
              </div>            
            </div>                                                            
                            
          </fieldset>
          
          <div class="div-spacer-h10"></div>
           
          <fieldset>
          <legend>[@{#form_title_friend_details#}@]</legend>
                    
            <div class="row">           
              <div class="col-sm-6 col-lg-5 form-group[@{if $error_to_name}@] has-error[@{/if}@]">
                <label class="control-label" for="tell_a_friend_to_name">[@{#form_field_friend_name#}@]</label><span class="input-requirement-moved">&nbsp;[@{#entry_first_name_text#}@]</span>
                [@{$input_field_to_name}@]
              </div>                      
              <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group[@{if $error_to_address}@] has-error[@{/if}@]">
                <label class="control-label" for="tell_a_friend_to_email_address">[@{#form_field_friend_email#}@]</label><span class="input-requirement-moved">&nbsp;[@{#entry_email_address_text#}@]</span>
                [@{$input_field_to_email_address}@]
              </div>            
            </div> 

          </fieldset> 


        [@{if !$isset_customer_id}@]          
          <div class="div-spacer-h10"></div>
                    
          <fieldset>
          <legend>[@{#form_title_for_your_safety#}@]</legend>
                    
            <div class="row">           
              <div class="col-xs-6 col-md-3 form-group[@{if $error_security_code}@] has-error[@{/if}@]">
                <label class="control-label" for="tell_a_friend_security_code">[@{#form_field_security_code#}@]</label><span class="input-requirement-moved">&nbsp;[@{#entry_security_code_text#}@]</span>
                [@{$input_security_code}@]  
              </div>             
              <div class="col-xs-6 col-md-9" id="captcha-contact-us">
                <span class="hidden-xs"><img src="[@{$images_path}@]arrow_captcha.gif" alt="" />&nbsp;&nbsp;&nbsp;&nbsp;</span>[@{$captcha_img}@]
              </div>                                            
            </div> 

          </fieldset>        
        [@{/if}@] 
        
          <div class="div-spacer-h10"></div>
           
          <fieldset>
          <legend>[@{#form_title_friend_message#}@]</legend>
                    
            <div class="row">           
              <div class="col-sm-12 form-group">
                <label class="control-label" for="tell_a_friend_message">[@{#sub_title_no_html#}@]</label>&nbsp;[@{#text_no_html#}@]
                [@{$textarea_field_message}@] 
              </div>            
            </div>                  

          </fieldset>                   
          
          <div class="div-spacer-h10"></div>
          
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                             
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                  
          </div>                      
    [@{$form_end}@]
<!-- tell_a_friend_eof -->
