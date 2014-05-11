[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox-dotted
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : upcoming_products.tpl
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

<!-- upcoming_products -->
            <div>
              <div class="table-heading-upcoming-products" style="padding: 2px; white-space: nowrap; float: left;">&nbsp;[@{#table_heading_upcoming_products#}@]&nbsp;</div><div class="table-heading-upcoming-products" style="padding: 2px; white-space: nowrap; text-align: right;  float: right;">&nbsp;[@{#table_heading_date_expected#}@]&nbsp;</div>
              <div class="clear">&nbsp;</div>
              <div style="padding: 2px;"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></div>
              [@{foreach name=loop item=upcoming_product from=$upcoming_products}@]
              [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
              <div class="small-text" style="background : #d7d7d7; padding: 3px; white-space: nowrap;">
              [@{else}@]
              <div class="small-text" style="background : #ffffff; padding: 3px; white-space: nowrap;">
              [@{/if}@]
              <div style="float: left;">&nbsp;<a href="[@{$upcoming_product.link_filename_product_info}@]">[@{$upcoming_product.name}@]</a>&nbsp;</div><div style="text-align: right; float: right;">&nbsp;[@{$upcoming_product.date_expected}@]&nbsp;</div>
              <div class="clear">&nbsp;</div>
              </div>
              [@{/foreach}@]
              <div style="padding: 2px;"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></div>
            </div>
<!-- upcoming_products_eof -->
