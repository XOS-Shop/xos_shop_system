[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : paper-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop template built with Bootstrap3 and theme paper                                                                    
* filename   : password_forgotten.tpl
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

<!-- password_forgotten -->
    [@{$form_begin}@]
          <h1 class="text-orange">[@{#heading_title#}@]</h1>                
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
          <div class="panel panel-default clearfix">
            <div class="panel-heading">
              <h4 class="panel-title">[@{#text_main#}@]</h4>
            </div>            
            <div class="panel-body form-horizontal">            
              <div class="div-spacer-h10"></div>
              <fieldset>           
                <div class="form-group[@{if $error_email_address}@] has-error[@{/if}@]">
                  <label class="col-sm-3 control-label" for="password_forgotten_email_address">[@{#entry_email_address#}@]</label>
                  <div class="col-sm-4">
                    [@{$input_field_email_address}@]
                  </div>  
                </div>                                             
                <div class="form-group[@{if $error_security_code}@] has-error[@{/if}@]">   
                  <label class="col-sm-3 col-xs-9 control-label" for="password_forgotten_security_code">[@{#entry_security_code#}@]</label>
                  <div class="clearfix visible-xs-block"></div>
                  <div class="col-sm-3 col-xs-4">
                    [@{$input_security_code}@]
                  </div>
                  <div class="col-sm-6 col-xs-6">
                    <span class="hidden-xs"><img src="[@{$images_path}@]arrow_captcha.gif" alt="" />&nbsp;&nbsp;&nbsp;&nbsp;</span>[@{$captcha_img}@]
                  </div>
                </div>                                                                   
              </fieldset>        
            </div>
          </div>                   
          <div class="well well-sm clearfix">
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                           
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                 
          </div>          
    [@{$form_end}@]
<!-- password_forgotten_eof -->
