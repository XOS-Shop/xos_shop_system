[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : paper-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7x
* descrip    : xos-shop template built with Bootstrap3 and theme paper                                                                    
* filename   : currencies.tpl
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

<!-- currencies -->
          <div class="navbar-form navbar-right visible-xs">
            <span class="navbar-text">[@{#box_heading_currencies#}@]<br /><br /></span>  
            [@{$box_currencies_currencies}@]
          </div>                       
          <ul class="nav navbar-nav navbar-right hidden-xs">          
            <li id="currencies_box" class="dropdown">
              <a class="dropdown-toggle" role="button" aria-expanded="false">[@{#box_heading_currencies#}@]</a>
              <ul id="currencies_list" class="dropdown-menu" role="menu">
                <li>        
                  <div class="box-currencies">            
                    [@{$box_currencies_currencies_string}@]
                  </div>                 
                  <script type="text/javascript">
                    $('#currencies_list').css('display','none');                                                     
                    $('#currencies_box').mouseleave(function(){
                      $('#currencies_list').css('display','none');
                    }).mouseenter(function(){               
                      $('#currencies_list').show(400); 
                    });                                                  
                  </script>                                         
                </li>
              </ul>
            </li>
          </ul>                                                      
<!-- currencies_eof -->
