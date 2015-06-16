[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7z
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
* filename   : logoff.tpl
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

<!-- logoff -->
          <div class="row">
            <div class="col-sm-4 col-md-3">
              <img class="img-responsive" src="[@{$images_path}@]table_background.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " />
            </div>
            <div class="col-sm-8 col-md-9">
              <h1 class="text-orange">[@{#heading_title#}@]</h1>
              <div>[@{#text_main#}@]</div>
            </div>                     
          </div>
          <div class="div-spacer-h20"></div>  
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_filename_default}@]" class="btn btn-success pull-right" title=" [@{#button_title_continue#}@] ">[@{#button_text_continue#}@]</a>                                                                                                                                                                                                               
          </div>                    
<!-- logoff_eof -->
