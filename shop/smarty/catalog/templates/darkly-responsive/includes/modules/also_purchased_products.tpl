[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : darkly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop template built with Bootstrap3 and theme darkly                                                                    
* filename   : also_purchased_products.tpl
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

<!-- also_purchased_products -->
          <div class="info-box-heading">[@{#text_also_purchased_products#}@]</div>
          <div class="row eq-height">
            [@{foreach name=outer item=also_purchased from=$also_purchased_products}@]
            <div class="col-sm-6 col-md-4"> 
              <div class="panel panel-default clearfix">           
                <div class="panel-body text-center">
                  <br /> 
                  <a href="[@{$also_purchased.link_filename_product_info}@]">[@{$also_purchased.image|replace:'<img ':'<img class="img-responsive center-block" '}@]</a><br />
                  <a href="[@{$also_purchased.link_filename_product_info}@]"><b>[@{$also_purchased.name}@]</b></a><br /><br />
                  [@{if $also_purchased.price_special}@]
                  <b><span class="text-deco-line-through">[@{$also_purchased.price}@]</span> <span class="product-special-price">[@{$also_purchased.price_special}@]</span></b><br />
                  [@{else}@]
                  <b>[@{$also_purchased.price}@]</b><br />
                  [@{/if}@]
                  [@{$also_purchased.tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />
                  [@{if $link_filename_popup_content_6}@]                 
                  [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br /><br />
                  [@{else}@]
                  [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br /><br />
                  [@{/if}@]
                </div>
              </div>                        
            </div>
            [@{if ($smarty.foreach.outer.iteration)%3 == 0}@]
            <div class="visible-lg visible-md clearfix"></div>            
            [@{/if}@]
            [@{if ($smarty.foreach.outer.iteration)%2 == 0}@]
            <div class="visible-sm clearfix"></div>            
            [@{/if}@]            
            [@{/foreach}@]
          </div>
<!-- also_purchased_products_eof -->
