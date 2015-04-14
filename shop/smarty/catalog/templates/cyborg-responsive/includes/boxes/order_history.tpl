[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7w
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
* filename   : order_history.tpl
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

<!-- order_history -->
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">[@{#box_heading_customer_orders#}@]</h3></div>
            <div class="panel-body">
              <div class="div-spacer-h10"></div>         
              [@{foreach item=customer_order from=$box_order_history_customer_orders}@]
              <div><div class="pull-right">&nbsp;&nbsp;<a href="[@{$customer_order.in_cart}@]"><span class="text-primary glyphicon glyphicon-shopping-cart pull-right" title=" [@{#in_cart#}@] "></span></a></div><a href="[@{$customer_order.link_filename_product_info}@]">[@{$customer_order.name}@]</a></div>
              <div class="div-spacer-h10"></div>
              [@{/foreach}@]                        
            </div>
          </div>
<!-- order_history_eof -->
