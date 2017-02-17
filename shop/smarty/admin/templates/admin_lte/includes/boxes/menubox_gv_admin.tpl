[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.4
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : menubox_gv_admin.tpl
* author     : Hanspeter Zeller <hpz@xos-shop.com>
* copyright  : Copyright (c) 2010 Hanspeter Zeller
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
<!-- menubox_gv_admin -->
            <li class="treeview[@{if $menu_box_selected}@] active[@{/if}@]">
              <a href="#">
                <i class="fa fa-cog"></i> <span>[@{$menu_box_heading_name}@]</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              [@{foreach name=outer item=menu_box_content from=$menu_box_contents}@]                   
                <li [@{if $menu_box_content.selected}@]class="active"[@{/if}@]><a href="[@{$menu_box_content.link}@]"><i class="fa fa-circle-o"></i> [@{$menu_box_content.name}@]</a></li>          
              [@{/foreach}@]              
              </ul>
            </li>
<!-- menubox_gv_admin_eof -->