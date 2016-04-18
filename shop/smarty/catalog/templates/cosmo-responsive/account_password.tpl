[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cosmo-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.2
* descrip    : xos-shop template built with Bootstrap3 and theme cosmo                                                                    
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
          <h1 class="text-orange">[@{#heading_title#}@]</h1>                
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
          <div class="div-spacer-h10"></div>
          
          <fieldset>          
            <div class="panel panel-default clearfix">           
              <div class="panel-body form-horizontal">   
              
                <div class="form-group[@{if $password_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="password_current">[@{#entry_password_current#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_PASSWORD_CURRENT_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_password_current|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>
                
                <div class="form-group[@{if $password_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="password_new">[@{#entry_password_new#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_PASSWORD_NEW_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_password_new|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>
                
                <div class="form-group[@{if $password_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="password_confirmation">[@{#entry_password_confirmation#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_PASSWORD_CONFIRMATION_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_password_confirmation|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>                                              
              
              </div>                
            </div>
          </fieldset>
         
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_filename_account}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>               
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                               
          </div>                 
    [@{$form_end}@]
<!-- account_password_eof -->
