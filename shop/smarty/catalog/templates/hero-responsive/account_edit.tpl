[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.8
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
* filename   : account_edit.tpl
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

<!-- account_edit -->
    [@{$form_begin}@][@{$hidden_field}@][@{$hidden_field_languages}@] 
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
              
                [@{if $account_gender}@]
                  <div class="form-group">                                
                    <div class="col-sm-offset-4 col-sm-12">            
                      [@{$input_gender}@]<span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_GENDER_TEXT}@]</span>
                    </div>            
                  </div>             
                [@{/if}@]
                
                [@{if $c_id}@]                             
                <div class="form-group">
                  <label class="col-sm-4 control-label">[@{#entry_customer_id#}@]</label>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    <p class="form-control-static">[@{$c_id}@]</p>
                  </div>  
                </div>
                [@{/if}@]                  

                <div class="form-group">
                  <label class="col-sm-4 control-label" for="firstname">[@{#entry_first_name#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_FIRST_NAME_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_firstname|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>
            
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="lastname">[@{#entry_last_name#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_LAST_NAME_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_lastname|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>
                
                [@{if $account_dob}@]
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="dob">[@{#entry_date_of_birth#}@] <span class="small input-requirement-moved text-nowrap visible-xs-inline">[@{$smarty.const.ENTRY_DATE_OF_BIRTH_TEXT}@]</span></label><span class="small input-requirement-moved text-nowrap hidden-xs">[@{$smarty.const.ENTRY_DATE_OF_BIRTH_TEXT}@]</span>
                  <div class="col-sm-3 col-lg-4">
                    [@{$input_dob|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>
                [@{/if}@]
                
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="email_address">[@{#entry_email_address#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_EMAIL_ADDRESS_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_email_address|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>  
                
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="telephone">[@{#entry_telephone_number#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_TELEPHONE_NUMBER_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_telephone|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>  
                
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="fax">[@{#entry_fax_number#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_FAX_NUMBER_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_fax|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>  
                
                [@{if $languages}@]
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="languages">[@{#entry_language#}@]</label>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$pull_down_menu_languages}@]
                  </div>  
                </div>
                [@{/if}@]                                                                                                                              
              
              </div>                
            </div>
          </fieldset>

          <div class="well well-sm clearfix"> 
            <a href="[@{$link_filename_account}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>               
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                               
          </div>                   
    [@{$form_end}@]
<!-- account_edit_eof -->
