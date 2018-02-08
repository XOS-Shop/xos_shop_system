[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : sandstone-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.7
* descrip    : xos-shop default template built with Bootstrap3                                                                    
* filename   : login.tpl
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

<!-- login -->
    [@{$form_begin}@]
          <h1 class="text-orange">[@{#heading_title#}@]</h1>                
          <div class="div-spacer-h10"></div>        
        
          [@{if $cart_contents && $is_shop}@]      
          <div>[@{#text_visitors_cart#}@]
            [@{if $link_filename_popup_content_10}@]                   
            <a href="[@{$link_filename_popup_content_10}@]" class="lightbox-system-popup" target="_blank">[@{#text_visitors_cart_link#}@]</a>
            [@{/if}@]  
          </div>          
          <div class="div-spacer-h10"></div>          
          [@{/if}@] 
      
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
          <div class="row"> 
        [@{if $is_shop}@]                                      
            <div class="col-sm-6 col-lg-5">              
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">[@{#heading_new_customer#}@]</h3>
                </div>
                <div class="panel-body">                          
                  <div class="div-spacer-h10"></div>             
                  <div>[@{#text_new_customer#}@]<br /><br />[@{eval var=#text_new_customer_introduction#}@]</div>            
                  <div class="div-spacer-h10"></div>                               
                  <a href="[@{$link_filename_create_account}@]" class="btn btn-success  pull-right" title=" [@{#button_title_continue#}@] ">[@{#button_text_continue#}@]</a>                              
                </div>
              </div>   
            </div>                       
            <div class="col-sm-6 col-lg-5 col-lg-offset-2">                     
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">[@{#heading_returning_customer#}@]</h3>
                </div> 
                <div class="panel-body">
                  <div class="div-spacer-h10"></div>             
                  <div>[@{#text_returning_customer#}@]</div>            
                  <div class="div-spacer-h10"></div> 
                  <fieldset>                   
                    <div class="row">           
                      <div class="col-sm-12 col-md-9 form-group">
                        <label class="control-label" for="email_address">[@{#entry_email_address#}@]</label>
                        [@{$input_field_email_address}@]  
                      </div>            
                    </div>
                    <div class="row">           
                      <div class="col-sm-12 col-md-9 form-group">
                        <label class="control-label" for="password">[@{#entry_password#}@]</label>
                        [@{$input_field_password}@]  
                      </div>            
                    </div>                                 
                    [@{if $link_filename_password_forgotten}@]
                    <div><a href="[@{$link_filename_password_forgotten}@]">[@{#text_password_forgotten#}@]</a></div>
                    [@{/if}@]                            
                    <div class="div-spacer-h10"></div>
                  </fieldset>                                 
                  <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_login#}@]" />                            
                </div>
              </div>                             
            </div>
        [@{else}@]
            <div class="col-sm-6 col-lg-5">                      
              <div class="panel panel-info">
                <div class="panel-body">           
                  <div class="div-spacer-h10"></div> 
                  <fieldset>                   
                    <div class="row">           
                      <div class="col-sm-12 col-md-9 form-group">
                        <label class="control-label" for="email_address">[@{#entry_email_address#}@]</label>
                        [@{$input_field_email_address}@]  
                      </div>            
                    </div>
                    <div class="row">           
                      <div class="col-sm-12 col-md-9 form-group">
                        <label class="control-label" for="password">[@{#entry_password#}@]</label>
                        [@{$input_field_password}@]  
                      </div>            
                    </div>                                 
                         
                    <div class="div-spacer-h10"></div>
                  </fieldset>                                 
                  <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_login#}@]" />                            
                </div>
              </div>                               
            </div>
        [@{/if}@]            
          </div>      
    [@{$form_end}@]            
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                                                                                                                                                                              
          </div>              
<!-- login_eof -->
