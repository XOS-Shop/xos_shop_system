[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
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
          <tr>
            <td><br /><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="tableHeading">&nbsp;[@{#table_heading_upcoming_products#}@]&nbsp;</td>
                <td align="right" class="tableHeading">&nbsp;[@{#table_heading_date_expected#}@]&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              [@{foreach name=loop item=upcoming_product from=$upcoming_products}@]
              [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
              <tr class="productListing-odd">
              [@{else}@]
              <tr class="productListing-even">
              [@{/if}@]
                <td class="smallText">&nbsp;<a href="[@{$upcoming_product.link_filename_product_info}@]">[@{$upcoming_product.name}@]</a>&nbsp;</td>
                <td align="right" class="smallText">&nbsp;[@{$upcoming_product.date_expected}@]&nbsp;</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
            </table></td>
          </tr>
<!-- upcoming_products_eof -->
