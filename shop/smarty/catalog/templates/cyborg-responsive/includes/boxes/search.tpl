[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cyborg-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.3
* descrip    : xos-shop template built with Bootstrap3 and theme cyborg                                                                    
* filename   : search.tpl
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

<!-- search --> 
          <div class="navbar-form navbar-left" role="search">     
            <div style="display: none;">                     
              [@{$box_search_js_check_keywords}@]                  
            </div>            
            [@{$box_search_form_begin}@]     
              <div class="form-group has-feedback">
                [@{$box_search_imput_field|replace:'<input':"<input placeholder=\"`$smarty.config.button_title_quick_find`\" title=\" `$smarty.config.button_title_quick_find` \""}@]
                [@{*<span class="text-default glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>*}@]
                <button type="submit" class="btn btn-link form-control-feedback" style="pointer-events: auto;"><span class="text-default glyphicon glyphicon-search form-control-feedback" style="color: #000;" aria-hidden="true"></span></button>         
              </div>              
            [@{$box_search_form_end}@]       
            <div id="list-quick-search-suggest-wrapper">
              <div id="list-quick-search-suggest" class="dropdown-menu"></div>                     
            </div>     
            <script type="text/javascript"> 
              quick_search_suggest('box_search_keywords', 'list-quick-search-suggest', '[@{$box_search_link_quick_search_suggest}@]');  
            </script>
          </div>                             
          <ul class="nav navbar-nav navbar-left">
            <li class="visible-xs">
              <a href="[@{$box_search_link_filename_advanced_search_and_results}@]">[@{#box_search_advanced_search#}@]</a> 
            </li>                      
            <li id="search_box" class="dropdown hidden-xs">
              <a class="dropdown-toggle" role="button" aria-expanded="false" style="margin-left: -15px;"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
              <ul id="search_contents" class="dropdown-menu" role="menu">
                <li>
                  <div class="box-search">                 
                    <a href="[@{$box_search_link_filename_advanced_search_and_results}@]">[@{#box_search_advanced_search#}@]</a>
                  </div> 
                  <script type="text/javascript">
                    $('#search_contents').css('display','none');                                                     
                    $('#search_box').mouseleave(function(){
                      $('#search_contents').css('display','none');
                    }).mouseenter(function(){               
                      $('#search_contents').show(400); 
                    });                                                  
                  </script>                                         
                </li>
              </ul>
            </li>
          </ul>                                                         
<!-- search_eof -->