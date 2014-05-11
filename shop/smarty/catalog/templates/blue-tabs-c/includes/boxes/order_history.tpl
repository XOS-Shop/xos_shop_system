[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
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
          <div class="info-box-heading">[@{#box_heading_customer_orders#}@]</div>
          <div class="info-box-contents" style="padding: 11px 3px 11px 3px;">          
            [@{foreach item=customer_order from=$box_order_history_customer_orders}@]
            <div style="padding: 6px 0 6px 1px;"><div><a href="[@{$customer_order.in_cart}@]"><img style="float: right;" src="[@{$images_path}@]cart.gif" alt="[@{#in_cart#}@]" title=" [@{#in_cart#}@] " /></a><a href="[@{$customer_order.link_filename_product_info}@]">[@{$customer_order.name}@]</a></div></div>
            [@{/foreach}@]                        
          </div>
<!-- order_history_eof -->
