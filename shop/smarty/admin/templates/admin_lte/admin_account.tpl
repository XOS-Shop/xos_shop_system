[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.2
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : admin_account.tpl
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
<!-- admin_account -->
      <div class="content-wrapper">
        [@{$form_begin_save_account}@][@{$form_begin_check_password}@][@{$form_begin_check_account}@]
        <section class="content-header">
          <h1>[@{$heading_title}@]</h1>
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
          <div class="row">
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_account#}@]</th>
                    </tr>
                    <tr>
                      <td>                      
                        <table>                  
                        [@{if $admin_firstname}@]
                          <tr>
                            <td><b>[@{#text_info_fullname#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                            <td>[@{$admin_firstname}@]&nbsp;[@{$admin_lastname}@]</td>
                          </tr>
                          <tr>
                            <td><b>[@{#text_info_email#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                            <td >[@{$admin_email_address}@]</td>
                          </tr>
                          <tr>
                            <td><b>[@{#text_info_password#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                            <td >[@{#text_info_password_hidden#}@]</td>
                          </tr>
                          <tr>
                            <td><b>[@{#text_info_group#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                            <td>[@{$admin_groups_name}@]</td>
                          </tr>
                          <tr>
                            <td><b>[@{#text_info_created#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                            <td>[@{$admin_created}@]</td>
                          </tr>
                          <tr>
                            <td><b>[@{#text_info_lognum#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                            <td>[@{$admin_lognum}@]</td>
                          </tr>
                          <tr>
                            <td><b>[@{#text_info_logdate#}@]</b>&nbsp;&nbsp;&nbsp;</td>
                            <td >[@{$admin_logdate}@]</td>
                          </tr>                    
                        [@{else}@]
                          <tr>
                            <td><div class="form-group"><b>[@{#text_info_firstname#}@]</b>&nbsp;&nbsp;</div></td>
                            <td style="min-width: 200px"><div class="form-group">[@{$input_admin_firstname|replace:'<input':'<input class="form-control"'}@]</div></td>
                          </tr>
                          <tr>
                            <td><div class="form-group"><b>[@{#text_info_lastname#}@]</b>&nbsp;&nbsp;</div></td>
                            <td><div class="form-group">[@{$input_admin_lastname|replace:'<input':'<input class="form-control"'}@]</div></td>
                          </tr>
                          <tr>
                            <td><div class="form-group"><b>[@{#text_info_email#}@]</b>&nbsp;&nbsp;</div></td>
                            <td><div class="form-group">[@{if $email_used}@][@{$input_admin_email_address|replace:'<input':'<input class="form-control"'}@]&nbsp;<font color="red">[@{$email_used}@]</font>[@{elseif $email_not_valid}@][@{$input_admin_email_address|replace:'<input':'<input class="form-control"'}@]&nbsp;<font color="red">[@{$email_not_valid}@]</font>[@{else}@][@{$input_admin_email_address|replace:'<input':'<input class="form-control"'}@][@{/if}@]</div></td>
                          </tr>
                          <tr>
                            <td><div class="form-group"><b>[@{#text_info_password#}@]</b>&nbsp;&nbsp;</div></td>
                            <td><div class="form-group">[@{$input_admin_password|replace:'<input':'<input class="form-control"'}@]</div></td>
                          </tr>
                          <tr>
                            <td><div class="form-group"><b>[@{#text_info_password_confirm#}@]</b>&nbsp;&nbsp;</td>
                            <td><div class="form-group">[@{$input_admin_password_confirm|replace:'<input':'<input class="form-control"'}@]</div></td>
                          </tr>   
                        [@{/if}@]                                      
                        </table>                                            
                      </td>
                    </tr>                              
                  </table>
                </div>
              </div>
              <div class="pagination-wrapper">
                [@{#text_info_modified#}@][@{$admin_modified}@]
              </div>
              [@{if $link_filename_admin_account}@]
                [@{if $confirm_account}@]
                  <a href="" onclick="validateForm(); if(document.returnValue)account.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_save#}@] ">[@{#button_text_save#}@]</a>
                [@{/if}@]
                <a href="[@{$link_filename_admin_account}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
              [@{elseif $form_begin_check_password}@]
                &nbsp;
              [@{else}@]
                <a href="" onclick="account.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_edit#}@] ">[@{#button_text_edit#}@]</a>
              [@{/if}@] 
            </div>            
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_admin_account}@]         
            </div>              
          </div>
        </section>
        [@{$form_end}@]
      </div>
<!-- admin_account_eof -->