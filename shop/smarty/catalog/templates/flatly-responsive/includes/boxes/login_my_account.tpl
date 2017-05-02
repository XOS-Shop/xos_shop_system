[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : flatly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.5
* descrip    : xos-shop template built with Bootstrap3 and theme flatly                                                                    
* filename   : login_my_account.tpl
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

[@{if $box_login_my_account_display_box_my_account}@]
<!-- my_account -->  
          <ul class="nav navbar-nav navbar-right">
            <li class="visible-xs">        
              <a href="[@{$box_login_my_account_link_filename_account}@]">
                [@{#box_heading_login_my_account_my_account#}@]                
              </a>               
            </li> 
            <li class="dropdown hidden-xs">          
              <a class="dropdown-toggle hidden-sm" data-toggle="dropdown" role="button" aria-expanded="false" href="[@{$box_login_my_account_link_filename_account}@]">
                [@{#box_heading_login_my_account_my_account#}@] <span class="caret"></span>         
              </a>              
              <a class="dropdown-toggle navbar-brand visible-sm" data-toggle="dropdown" role="button" aria-expanded="false" title=" [@{#box_heading_login_my_account_my_account#}@] " href="[@{$box_login_my_account_link_filename_account}@]">
                <span class="glyphicon glyphicon-user"></span> <span class="caret"></span>         
              </a>
              <ul id="toggle_my_account_contents" class="dropdown-menu" role="menu">
                <li>                 
                <div>[@{$box_login_my_account_welcome_string}@]<br /><br /></div>
                <div><a href="[@{$box_login_my_account_link_filename_account}@]">[@{#box_login_my_account_my_account#}@]</a></div>
                <div><a href="[@{$box_login_my_account_link_filename_account_edit}@]">[@{#box_login_my_account_account_edit#}@]</a></div>
                <div><a href="[@{$box_login_my_account_link_filename_account_history}@]">[@{#box_login_my_account_account_history#}@]</a></div>
                <div><a href="[@{$box_login_my_account_link_filename_address_book}@]">[@{#box_login_my_account_address_book#}@]</a></div>
                [@{if $box_login_my_account_link_filename_account_notifications}@]
                <div><a href="[@{$box_login_my_account_link_filename_account_notifications}@]">[@{#box_login_my_account_product_notifications#}@]</a></div>
                [@{/if}@]
                <div class="divider"></div>
                <div class="lead"><a href="[@{$box_login_my_account_link_filename_logoff}@]">[@{#box_login_my_account_logoff#}@]</a></div>                        
                </li>
                <script type="text/javascript">
                  // ADD SLIDEDOWN ANIMATION TO DROPDOWN //
                  $('.dropdown').on('show.bs.dropdown', function(e){
                    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
                  });
                 // ADD SLIDEUP ANIMATION TO DROPDOWN //
                 $('.dropdown').on('hide.bs.dropdown', function(e){
                   $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
                 });                     
                </script>                
              </ul>
            </li>
          </ul>                      
<!-- my_account_eof -->
[@{else}@]
<!-- login -->
          <ul class="nav navbar-nav navbar-right">
            <li class="visible-xs">        
              <a href="[@{$box_login_my_account_link_filename_account}@]">
                [@{#box_heading_login_my_account_login_here#}@]                
              </a>               
            </li>              
            <li class="dropdown hidden-xs">          
              <a class="dropdown-toggle hidden-sm" data-toggle="dropdown" role="button" aria-expanded="false" href="[@{$box_login_my_account_link_filename_account}@]">
                [@{#box_heading_login_my_account_login_here#}@] <span class="caret"></span>         
              </a>              
              <a class="dropdown-toggle navbar-brand visible-sm" data-toggle="dropdown" role="button" aria-expanded="false" title=" [@{#box_heading_login_my_account_login_here#}@] " href="[@{$box_login_my_account_link_filename_account}@]">
                <span class="glyphicon glyphicon-user"></span> <span class="caret"></span>         
              </a>              
              <ul id="toggle_login_contents" class="dropdown-menu" role="menu">
                <li>
                  [@{$box_login_my_account_form_begin}@]                 
                  <div>[@{$box_login_my_account_welcome_string}@]<br /><br /></div>                  
                  <div class="form-group">
                    <label class="control-label" for="box_login_email_address">[@{#box_login_my_account_email#}@]</label>
                    [@{$box_login_my_account_input_field_email_address}@]                
                  </div>                   
                  <div class="form-group">
                    <label class="control-label" for="box_login_password">[@{#box_login_my_account_password#}@]</label>
                    [@{$box_login_my_account_input_field_password}@]                
                  </div>                                    
                  [@{if $box_login_my_account_link_filename_password_forgotten}@]
                  <div><a href="[@{$box_login_my_account_link_filename_password_forgotten}@]">[@{#box_login_my_account_forgot_password#}@]</a></div>
                  [@{/if}@]            
                  <div>
                    <br />
                    <input type="submit" class="btn btn-success" style="float: left" value="[@{#button_text_login#}@]" />
                    <br /><br /><br />            
                  </div>
                  <div><span class="greet-user">[@{#box_login_my_account_new_a#}@]</span><br /><a href="[@{$box_login_my_account_link_filename_create_account}@]"><span class="smallText">[@{#box_login_my_account_new_b#}@]</span></a></div>
                  [@{$box_login_my_account_form_end}@]                         
                </li>
                <script type="text/javascript">
                  // ADD SLIDEDOWN ANIMATION TO DROPDOWN //
                  $('.dropdown').on('show.bs.dropdown', function(e){
                    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
                  });
                 // ADD SLIDEUP ANIMATION TO DROPDOWN //
                 $('.dropdown').on('hide.bs.dropdown', function(e){
                   $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
                 });                     
                </script>                
              </ul>
            </li>
          </ul>        
<!-- login_eof -->
[@{/if}@]
[@{*
[@{if $box_login_my_account_display_box_my_account}@]
<!-- my_account -->  
          <ul class="nav navbar-nav navbar-right">
            <li class="visible-xs">        
              <a href="[@{$box_login_my_account_link_filename_account}@]">
                [@{#box_heading_login_my_account_my_account#}@]                
              </a>               
            </li> 
            <li class="dropdown hidden-xs">          
              <a class="dropdown-toggle toggle_my_account hidden-sm" role="button" aria-expanded="false" href="[@{$box_login_my_account_link_filename_account}@]">
                [@{#box_heading_login_my_account_my_account#}@] <span class="caret"></span>         
              </a>              
              <a class="dropdown-toggle toggle_my_account navbar-brand visible-sm" role="button" aria-expanded="false" title=" [@{#box_heading_login_my_account_my_account#}@] " href="[@{$box_login_my_account_link_filename_account}@]">
                <span class="glyphicon glyphicon-user"></span> <span class="caret"></span>         
              </a>
              <ul id="toggle_my_account_contents" class="dropdown-menu" role="menu">
                <li>
                <img id="toggle_my_account_close" class="pull-right" src="[@{$images_path}@]button_close.gif" title=" [@{#close_window#}@] " alt="[@{#close_window#}@]" />                  
                <div>[@{$box_login_my_account_welcome_string}@]<br /><br /></div>
                <div><a href="[@{$box_login_my_account_link_filename_account}@]">[@{#box_login_my_account_my_account#}@]</a></div>
                <div><a href="[@{$box_login_my_account_link_filename_account_edit}@]">[@{#box_login_my_account_account_edit#}@]</a></div>
                <div><a href="[@{$box_login_my_account_link_filename_account_history}@]">[@{#box_login_my_account_account_history#}@]</a></div>
                <div><a href="[@{$box_login_my_account_link_filename_address_book}@]">[@{#box_login_my_account_address_book#}@]</a></div>
                [@{if $box_login_my_account_link_filename_account_notifications}@]
                <div><a href="[@{$box_login_my_account_link_filename_account_notifications}@]">[@{#box_login_my_account_product_notifications#}@]</a></div>
                [@{/if}@]
                <div class="divider"></div>
                <div class="lead"><a href="[@{$box_login_my_account_link_filename_logoff}@]">[@{#box_login_my_account_logoff#}@]</a></div>                        
                </li>
              <script type="text/javascript">
                $('.toggle_my_account').click(function() {
                  $('#toggle_my_account_contents').toggle(400);
                  return false;
                });
                $('#toggle_my_account_close').click(function() {
                  $('#toggle_my_account_contents').toggle(400);
                  return false;
                });
              </script>                
              </ul>
            </li>
          </ul>                      
<!-- my_account_eof -->
[@{else}@]
<!-- login -->
          <ul class="nav navbar-nav navbar-right">
            <li class="visible-xs">        
              <a href="[@{$box_login_my_account_link_filename_account}@]">
                [@{#box_heading_login_my_account_login_here#}@]                
              </a>               
            </li>              
            <li class="dropdown hidden-xs">          
              <a class="dropdown-toggle toggle_login hidden-sm" role="button" aria-expanded="false" href="[@{$box_login_my_account_link_filename_account}@]">
                [@{#box_heading_login_my_account_login_here#}@] <span class="caret"></span>         
              </a>              
              <a class="dropdown-toggle toggle_login navbar-brand visible-sm" role="button" aria-expanded="false" title=" [@{#box_heading_login_my_account_login_here#}@] " href="[@{$box_login_my_account_link_filename_account}@]">
                <span class="glyphicon glyphicon-user"></span> <span class="caret"></span>         
              </a>              
              <ul id="toggle_login_contents" class="dropdown-menu" role="menu">
                <li>
                  [@{$box_login_my_account_form_begin}@]
                  <img id="toggle_login_close" class="pull-right" src="[@{$images_path}@]button_close.gif" title=" [@{#close_window#}@] " alt="[@{#close_window#}@]" />                  
                  <div>[@{$box_login_my_account_welcome_string}@]<br /><br /></div>
                  <div><label for="box_login_email_address">[@{#box_login_my_account_email#}@]</label></div> 
                  <div>[@{$box_login_my_account_input_field_email_address}@]</div> 
                  <div><label for="box_login_password">[@{#box_login_my_account_password#}@]</label></div> 
                  <div>[@{$box_login_my_account_input_field_password}@]</div>
                  [@{if $box_login_my_account_link_filename_password_forgotten}@]
                  <div><a href="[@{$box_login_my_account_link_filename_password_forgotten}@]">[@{#box_login_my_account_forgot_password#}@]</a></div>
                  [@{/if}@]            
                  <div>
                    <br />
                    <input type="submit" class="btn btn-success" style="float: left" value="[@{#button_text_login#}@]" />
                    <br /><br /><br />            
                  </div>
                  <div><span class="greet-user">[@{#box_login_my_account_new_a#}@]</span><br /><a href="[@{$box_login_my_account_link_filename_create_account}@]"><span class="smallText">[@{#box_login_my_account_new_b#}@]</span></a></div>
                  [@{$box_login_my_account_form_end}@]                         
                </li>
                <script type="text/javascript">
                  $('.toggle_login').click(function() {
                    $('#toggle_login_contents').toggle(400);
                    return false;
                  });
                  $('#toggle_login_close').click(function() {
                    $('#toggle_login_contents').toggle(400);
                    return false;
                  });                      
                </script>                
              </ul>
            </li>
          </ul>        
<!-- login_eof -->
[@{/if}@]
*}@]