[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0.7
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
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
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td height="14" class="infoBoxHeading"><img src="[@{$images_path}@]corner_right_left.gif" alt="" /></td>
              <td width="100%" height="14" class="infoBoxHeading"><a href="[@{$box_whats_new_link_filename_products_new}@]">[@{#box_heading_whats_new#}@]</a></td>
              <td height="14" class="infoBoxHeading" nowrap="nowrap"><a href="[@{$box_whats_new_link_filename_products_new}@]"><img src="[@{$images_path}@]arrow_right.gif" alt="[@{#more#}@]" title=" [@{#more#}@] " /></a><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="11" height="14" /></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox">
            <tr>
              <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
                <tr>
                  <td align="center" class="boxText">
                    <a href="[@{$box_whats_new_link_filename_product_info}@]">[@{$box_whats_new_product_image}@]</a><br />
                    <a href="[@{$box_whats_new_link_filename_product_info}@]">[@{$box_whats_new_product_name}@]</a><br />
                    [@{if $box_whats_new_product_price_special}@]
                      <span class="text-deco-line-through">[@{$box_whats_new_product_price}@]</span><br />
                      <span class="productSpecialPrice">[@{$box_whats_new_product_price_special}@]</span><br />
                    [@{else}@]
                      [@{$box_whats_new_product_price}@]<br />
                    [@{/if}@]
                    [@{$box_whats_new_products_tax_description|replace:'SMARTY_TAX_WITHOUT_VAT':#text_tax_without_vat#|replace:'SMARTY_TAX_NO_VAT':#text_tax_no_vat#|replace:'SMARTY_TAX_INC_VAT':#text_tax_inc_vat#|replace:'SMARTY_TAX_PLUS_VAT':#text_tax_plus_vat#}@]<br />
                    [@{if $link_filename_popup_content_6}@]                 
                      <script type="text/javascript">
                      /* <![CDATA[ */
                        document.write('[@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />');
                      /* ]]> */   
                      </script>
                      <noscript>
                        [@{#text_plus#}@]&nbsp;<a href="[@{$link_filename_popup_content_6}@]" target="_blank"><span class="text-deco-underline">[@{#text_shipping#}@]</span></a><br />
                      </noscript>
                    [@{else}@]
                      [@{#text_plus#}@]&nbsp;[@{#text_shipping#}@]<br />
                    [@{/if}@]                  
                  </td>                    
                </tr>
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </td>
      </tr>
<!-- whats_new_eof -->
