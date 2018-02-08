[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.8
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : mail.tpl
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
<!-- mail -->    
      <div class="content-wrapper">                     
        <section class="content-header">
          <h1>[@{#heading_title#}@]</h1>
        </section>
        <section class="content">
          [@{if $message_stack_header_error}@]
          <div class="callout callout-danger" role="alert">
            [@{$message_stack_header_error}@]
          </div>                            
          [@{/if}@]
          [@{if $message_stack_header_warning}@]
          <div class="callout callout-warning" role="alert">
            [@{$message_stack_header_warning}@]
          </div>                            
          [@{/if}@]          
          [@{if $message_stack_header_success}@]
          <div class="callout callout-success" role="alert">
            [@{$message_stack_header_success}@]
          </div>                            
          [@{/if}@]
    [@{if $action_preview}@]    
          <div class="row">
            <div class="col-xs-12">                                                                                                                                  
            [@{$form_begin_action_send_email_to_user}@][@{$hidden_fields}@]
              <div class="box">
                <div class="box-body">
                  <div class="form-horizontal">
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_customer#}@]</b></div>
                      <div class="col-lg-4 col-sm-8 col-xs-12 in-out-value text-nowrap">
                        [@{$to}@]   
                      </div>      
                    </div>   
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_from#}@]</b></div>
                      <div class="col-lg-4 col-sm-8 col-xs-12 in-out-value text-nowrap">
                        [@{$from}@]   
                      </div>      
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_subject#}@]</b></div>
                      <div class="col-lg-6 col-sm-8 col-xs-12 in-out-value">
                        [@{$subject}@]  
                      </div>      
                    </div>                                                
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_message#}@]</b></div>
                      <div class="col-lg-6 col-sm-8 col-xs-12 in-out-value">
                        [@{$message}@]
                      </div>      
                    </div>                                                                                                                                                                                                                                                                                                                          
                  </div>
                </div>                                                               
              </div>
              <a href="[@{$link_filename_mail}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="mail.back.value = 'true'; mail.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a><a href="" onclick="mail.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_send_email#}@] ">[@{#button_text_send_email#}@]</a>                                    
            [@{$form_end}@]
            </div>            
          </div>    
    [@{else}@]               
          <div class="row">
            <div class="col-xs-12">                                                                                                                                  
            [@{$form_begin_action_preview}@]
              <div class="box">
                <div class="box-body">
                  <div class="form-horizontal">
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_customer#}@]</b></div>
                      <div class="col-lg-4 col-sm-8 col-xs-12 text-nowrap">
                        [@{$pull_down_customers_email_address|replace:'<select':'<select class="form-control"'}@]   
                      </div>      
                    </div>   
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_from#}@]</b></div>
                      <div class="col-lg-4 col-sm-8 col-xs-12 text-nowrap">
                        [@{$input_from|replace:'<input':'<input class="form-control"'}@]   
                      </div>      
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_subject#}@]</b></div>
                      <div class="col-lg-6 col-sm-8 col-xs-12 text-nowrap">
                        [@{$input_subject|replace:'<input':'<input class="form-control"'}@]   
                      </div>      
                    </div>                                                
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_message#}@]</b></div>
                      <div class="col-lg-6 col-sm-8 col-xs-12 text-nowrap">
                        [@{$textarea_message|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>      
                    </div>                                                                                                                                                                                                                                                                                                                          
                  </div>
                </div>                                                               
              </div> 
              <a href="" onclick="mail.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_send_email#}@] ">[@{#button_text_send_email#}@]</a>                                   
            [@{$form_end}@]
            </div>            
          </div>
    [@{/if}@]               
        </section>                     
      </div>     
<!-- mail_eof -->