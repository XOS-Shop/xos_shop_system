[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : sandstone-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.6
* descrip    : xos-shop default template built with Bootstrap3                                                                    
* filename   : account_newsletters.tpl
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

<!-- account_newsletters -->
    [@{$form_begin}@][@{$hidden_field}@]
          <h1 class="text-orange">[@{#heading_title#}@]</h1>    
          <div><b>[@{#my_newsletters_title#}@]</b></div>        
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    [@{$checkbox_field|replace:' onclick="checkBox(\'newsletter_general\')"':''}@]
                    <b>[@{#my_newsletters_general_newsletter#}@]</b>
                 </label>
                </div>
              </div>               
              <p>[@{#my_newsletters_general_newsletter_description#}@]</p>       
            </div>               
          </div>
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_filename_account}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>    
            <input type="submit" class="btn btn-success  pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                                                     
          </div>                      
    [@{$form_end}@]
<!-- account_newsletters_eof -->
