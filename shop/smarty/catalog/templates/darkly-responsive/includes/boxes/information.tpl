[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : darkly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop template built with Bootstrap3 and theme darkly                                                                    
* filename   : information.tpl
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

[@{if $box_information_has_content}@]
<!-- information --> 
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">[@{#box_heading_information#}@]</h3></div>
            <div class="panel-body">
              [@{foreach name=loop item=content from=$box_information_contents}@]
              <div style="padding: 1px;"><a href="[@{$content.link_filename_content_content_id}@]">[@{$content.name}@]</a></div>
              [@{/foreach}@]
            </div>
          </div>          
<!-- information_eof -->
[@{/if}@]
