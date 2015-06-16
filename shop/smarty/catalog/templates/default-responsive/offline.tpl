[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : default-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7z
* descrip    : xos-shop default template built with Bootstrap3                                                                    
* filename   : offline.tpl
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

<!-- offline -->
    [@{$form_begin}@]
          <div class="div-spacer-h100"></div>
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
            <div class="panel-body">            
              <div style="padding: 5px 5px 52px 5px; text-align: right;">[@{$language_str}@]</div>
              <div  style="padding: 2px 2px 52px 2px; text-align: center;"><b>[@{#text_offline#}@]</b></div>
              <fieldset>
                <label style="padding: 4px; width: 100px; float: left; display: block;" for="email_address">[@{#entry_email_address#}@]</label>
                <div style="padding: 4px; float: left;">[@{$input_field_email_address}@]</div>
                <div class="clearfix invisible"></div>              
                <label style="padding: 0 4px 4px 4px; width: 100px; float: left; display: block;" for="password">[@{#entry_password#}@]</label>
                <div style="padding:  0 4px 4px 4px; float: left;">[@{$input_field_password}@]</div>
                <div class="clearfix invisible"></div>                        
              </fieldset>
              <div style="padding: 14px 0 0 4px">
                <input type="submit" class="btn btn-success" style="float: left" value="[@{#button_text_login#}@]" />
              </div>
              <div class="clearfix invisible" style="margin-bottom: 5px;"></div>
            </div>
          </div>                  
    [@{$form_end}@]
<!-- offline_eof -->
