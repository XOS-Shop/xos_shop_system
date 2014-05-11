[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c-html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : specials.tpl
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

<!-- specials -->
          <div class="info-box-heading"><a href="[@{$box_specials_link_filename_specials}@]"><img src="[@{$images_path}@]arrow_right.gif" alt="[@{#more#}@]" title=" [@{#more#}@] " />[@{#box_heading_specials#}@]</a></div>
          <div class="info-box-contents" style="padding: 11px 3px 11px 3px; text-align: center;">
            <a href="[@{$box_specials_link_filename_product_info}@]">[@{$box_specials_product_image}@]</a><br />
            <a href="[@{$box_specials_link_filename_product_info}@]">[@{$box_specials_product_name}@]</a><br />
            <span class="text-deco-line-through">[@{$box_specials_product_price}@]</span><br />
            <span class="product-special-price">[@{$box_specials_product_price_special}@]</span><br />
            [@{$box_specials_products_tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />
            [@{if $link_filename_popup_content_5}@]                 
              <script type="text/javascript">
              /* <![CDATA[ */
                document.write('[@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_5}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />');
              /* ]]> */   
              </script>
              <noscript>
                [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_5}@]" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
              </noscript>
            [@{else}@]
              [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
            [@{/if}@]                  
          </div>
<!-- specials_eof -->
