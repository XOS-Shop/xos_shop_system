[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.6
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
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
[@{$html_header}@]
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>XOS-Shop Admin</b></a>
  </div>
  <div class="login-box-body">
    <p><b>[@{#heading_password_forgotten#}@]</b></p> 
    <noscript><p>[@{#text_javascript_must_be_enabled#}@]</p></noscript>
    [@{$form_login_begin}@]        
    [@{if $try_over_3_times}@]
    <p>[@{#text_forgotten_fail#}@]</p>
      <div class="row">              
        <div class="col-lg-offset-7 col-md-offset-7 col-sm-offset-6 col-lg-5 col-md-5 col-sm-6 col-xs-12">                                
          <a href="[@{$link_filename_login}@]" class="btn btn-primary btn-block btn-flat" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
        </div>
      </div>
      [@{elseif $mailer_error_message}@]
      <p>[@{$mailer_error_message}@]<br />&nbsp;<br />&nbsp;</p> 
      <div class="row">              
        <div class="col-lg-offset-7 col-md-offset-7 col-sm-offset-6 col-lg-5 col-md-5 col-sm-6 col-xs-12">                                
          <a href="[@{$link_filename_password_forgotten}@]" class="btn btn-primary btn-block btn-flat" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                             
        </div>
      </div>
      [@{elseif $login_success}@]
      <p>[@{#text_forgotten_success#}@]</p>
      <div class="row">              
        <div class="col-lg-offset-7 col-md-offset-7 col-sm-offset-6 col-lg-5 col-md-5 col-sm-6 col-xs-12">                                
          <a href="[@{$link_filename_login}@]" class="btn btn-primary btn-block btn-flat" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                             
        </div>
      </div>
      [@{else}@]                                                             
        [@{if $cookie_not_accepted}@]
        <p id="cookie_error">[@{#text_cookie_error#}@]</p>
        [@{elseif $login_fail}@]
        <p>[@{#text_forgotten_error#}@][@{$hidden_field_log_times}@]</p>
        [@{else}@]
        [@{$hidden_field_log_times_0}@]
        [@{/if}@]    
        <div class="form-group has-feedback">
          [@{$input_firstname|replace:'<input':"<input class=\"form-control\" placeholder=\"[@{#entry_firstname#}@]\""}@]
          <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          [@{$input_email_address|replace:'<input':"<input class=\"form-control\" placeholder=\"[@{#entry_email_address#}@]\""}@]
          <span class="fa fa-envelope form-control-feedback"></span>
        </div>      
        <div class="row">              
          <div class="col-lg-offset-7 col-md-offset-7 col-sm-offset-6 col-lg-5 col-md-5 col-sm-6 col-xs-12">
            <a href="" onclick="login.submit(); return false" class="btn btn-primary btn-block btn-flat" title=" [@{#button_title_confirm#}@] ">[@{#button_text_confirm#}@]</a>
            <a href="[@{$link_filename_login}@]" class="btn btn-primary btn-block btn-flat" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
          </div>
        </div>
      [@{/if}@]       
    [@{$form_end}@]
  </div>
</div>
</body>
</html>