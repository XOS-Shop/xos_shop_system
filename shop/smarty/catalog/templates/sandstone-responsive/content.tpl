[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : sandstone-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop default template built with Bootstrap3                                                                    
* filename   : content.tpl
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

<!-- content -->
          [@{if $heading_title}@]<h1 class="text-orange">[@{$heading_title}@]</h1>[@{/if}@]
          <div class="clearfix">[@{$content}@]</div>
          <div class="div-spacer-h10"></div>
          <div class="well well-sm clearfix">                                               
            <a href="[@{$link_back}@]" class="btn btn-primary" style="float: left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                                                                                                                               
          </div>                      
<!-- content_eof -->
