[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : paper-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop template built with Bootstrap3 and theme paper                                                                    
* filename   : whats_new.tpl
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

<!-- whats_new -->
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><a href="[@{$box_whats_new_link_filename_products_new}@]">[@{#box_heading_whats_new#}@]&nbsp;<span style="vertical-align: text-top;">»</span></a></h3></div>
            <div class="panel-body text-center">         
              <a href="[@{$box_whats_new_link_filename_product_info}@]">[@{$box_whats_new_product_image}@]</a><br />
              <a href="[@{$box_whats_new_link_filename_product_info}@]">[@{$box_whats_new_product_name}@]</a><br />
              [@{if $box_whats_new_product_price_special}@]
                <span class="text-deco-line-through">[@{$box_whats_new_product_price}@]</span><br />
                <span class="product-special-price">[@{$box_whats_new_product_price_special}@]</span><br />
              [@{else}@]
                [@{$box_whats_new_product_price}@]<br />
              [@{/if}@]
              [@{$box_whats_new_products_tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />
              [@{if $link_filename_popup_content_6}@]                 
                [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
              [@{else}@]
                [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
              [@{/if}@]                              
            </div>
          </div>
<!-- whats_new_eof -->
