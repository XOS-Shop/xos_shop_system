[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.5
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
* filename   : manufacturer_info.tpl
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

[@{if $box_manufacturer_info_has_content}@]
<!-- manufacturer_info -->
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">[@{#box_heading_manufacturer_info#}@]</h3></div>
            <div class="panel-body">          
              <div class="text-center">[@{$box_manufacturer_info_manufacturer_image}@]</div>
              <div class="div-spacer-h10"></div> 
              [@{if $box_manufacturer_info_link_to_the_manufacturer}@]           
              <div class="pull-left" style="padding: 1px;">-&nbsp;</div>
              <div style="padding: 1px;"><a href="[@{$box_manufacturer_info_link_to_the_manufacturer}@]" target="_blank">[@{eval var = #box_manufacturer_info_homepage#}@]</a></div>
              <div class="clearfix invisible"></div>              
              [@{/if}@]
              <div class="div-spacer-h10"></div>              
              <div class="pull-left" style="padding: 1px;">-&nbsp;</div>
              <div style="padding: 1px;"><a href="[@{$box_manufacturer_info_link_filename_default}@]">[@{#box_manufacturer_info_other_products#}@]</a></div>
              <div class="clearfix invisible"></div>                           
            </div>
          </div>          
<!-- manufacturer_info_eof -->
[@{/if}@]