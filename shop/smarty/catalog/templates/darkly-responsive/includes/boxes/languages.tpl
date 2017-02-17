[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : darkly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.4
* descrip    : xos-shop template built with Bootstrap3 and theme darkly                                                                    
* filename   : languages.tpl
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

<!-- languages --> 
          <div class="nav navbar-nav navbar-right visible-xs"><span class="navbar-brand">[@{$box_languages_languages_string}@]</span></div>                            
          <ul class="nav navbar-nav navbar-right hidden-xs">          
            <li id="languages_box" class="dropdown">
              <a class="dropdown-toggle" role="button" aria-expanded="false">[@{$box_languages_language_used}@]</a>
              <ul id="languages_list" class="dropdown-menu" role="menu">
                <li>        
                  <div class="box-languages">            
                    [@{$box_languages_languages_list}@]
                  </div>                 
                  <script type="text/javascript">
                    $('#languages_list').css('display','none');                                                     
                    $('#languages_box').mouseleave(function(){
                      $('#languages_list').css('display','none');
                    }).mouseenter(function(){               
                      $('#languages_list').show(400); 
                    });                                                
                  </script>                                         
                </li>
              </ul>
            </li>
          </ul>                              
<!-- languages_eof -->
