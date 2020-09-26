[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : paper-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop template built with Bootstrap3 and theme paper                                                                    
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
      [@{if $sent}@]        
          <div class="pull-left"><img src="[@{$images_path}@]table_background.gif" alt="[@{$smarty.const.CONTACT_US_HEADING_TITLE}@]" title=" [@{$smarty.const.CONTACT_US_HEADING_TITLE}@] " /></div>
          <div style="padding-left: 200px;">
            <div>[@{$smarty.const.CONTACT_US_TEXT_SUCCESS}@]</div>
          </div>
          <div class="clearfix invisible"></div>          
          <div class="div-spacer-h10"></div> 
          <div class="panel panel-default clearfix">
            <div class="panel-body">                                                
              <a href="[@{$link_filename_default}@]" class="btn btn-success pull-right" title=" [@{$smarty.const.CONTACT_US_BUTTON_TITLE_CONTINUE}@] ">[@{$smarty.const.CONTACT_US_BUTTON_TEXT_CONTINUE}@]</a>                                                                                                                                                               
            </div>
          </div>                                                  
      [@{else}@]                         
          <fieldset>            
            <div class="row">           
              <div class="col-sm-6 form-group">
                <label class="control-label" for="contact_us_name">[@{$smarty.const.CONTACT_US_ENTRY_NAME}@]</label>
                [@{$input_field_name}@]  
              </div>            
            </div> 
            <div class="row">           
              <div class="col-sm-6 form-group[@{if $error_email_address}@] has-error[@{/if}@]">
                <label class="control-label" for="contact_us_email_address">[@{$smarty.const.CONTACT_US_ENTRY_EMAIL}@]</label>
                [@{$input_field_email}@]  
              </div>            
            </div>            
          [@{if !$isset_customer_id}@] 
            <div class="row">           
              <div class="col-xs-6 col-md-3 form-group[@{if $error_security_code}@] has-error[@{/if}@]">
                <label class="control-label" for="contact_us_security_code">[@{$smarty.const.CONTACT_ENTRY_SECURITY_CODE}@]</label>
                [@{$input_security_code}@]  
              </div>             
              <div class="col-xs-6 col-md-9" id="captcha-contact-us">
                <span class="hidden-xs"><img src="[@{$images_path}@]arrow_captcha.gif" alt="" />&nbsp;&nbsp;&nbsp;&nbsp;</span>[@{$captcha_img}@]
              </div>                                            
            </div>                
          [@{/if}@]         
            <div class="row">           
              <div class="col-sm-12 form-group">
                <label class="control-label" for="contact_us_enquiry">[@{$smarty.const.CONTACT_ENTRY_ENQUIRY}@]</label>
                [@{$textarea}@]  
              </div>            
            </div>          
          </fieldset>                             
          <div class="well well-sm clearfix">                                              
            <input type="submit" class="btn btn-success pull-right" value="[@{$smarty.const.CONTACT_US_BUTTON_TEXT_CONTINUE}@]" />                                                                                                                                                                 
          </div>                         
      [@{/if}@]      
    [@{$form_end}@]
<!-- contact_us_eof -->
