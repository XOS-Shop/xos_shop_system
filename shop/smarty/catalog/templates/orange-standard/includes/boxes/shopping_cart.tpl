[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with div/css layout                                                                     
* filename   : shopping_cart.tpl
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

<!-- shopping_cart -->
          <div id="shopping_cart_box_header" class="info-box-heading"><a href="[@{$box_shopping_cart_link_filename_shopping_cart}@]"><img src="[@{$images_path}@]arrow_right.gif" alt="[@{#more#}@]" title=" [@{#more#}@] " />[@{#box_heading_shopping_cart#}@]</a></div>
          [@{if $box_shopping_cart_cart_empty}@]
            <div class="info-box-contents" style="padding: 11px 3px 11px 3px;">[@{#box_shopping_cart_empty#}@]</div>
          [@{else}@]
            <div id="shopping_cart_box_content" class="info-box-contents" style="padding: 11px 3px 11px 3px; text-align: left">
            <div id="shopping_cart_box_title" align="left" class="info-box-contents" style="display:none"><b>[@{#box_product_has_been_added#}@]<br />&nbsp;</b></div>
              <table border="0" cellspacing="0" cellpadding="0">
              [@{foreach item=product from=$box_shopping_cart_cart_products}@]
              [@{if $product.new_product_in_cart == true}@]  
                <tr>
                  <td align="right" valign="top" class="info-box-contents"><span class="new-item-in-cart">[@{$product.quantity}@]&nbsp;x&nbsp;</span></td>                  
                  <td align="left" valign="top" class="info-box-contents">
                    <a href="[@{$product.link_filename_product_info}@]"><span class="new-item-in-cart">[@{$product.name}@]</span></a>
                    [@{if $shopping_cart_will_not_display == true}@]
                    <script type="text/javascript">
                    /* <![CDATA[ */
                      $(document).ready(function () {
                        $.fancybox({
                          'orig':'#shopping_cart_box_header',
                          'transitionIn':'fade',
                          'transitionOut':'elastic',
                          'speedOut':600,
                          'padding':3,
                          'onStart':function() { $("#fancybox-content").css({'border-color':'#b6b7cb'}); $("#shopping_cart_box_title").css({'display':'block'}); $("#shopping_cart_box_content").css({'width':'320px'}); },
                          'onCleanup':function() { $("#fancybox-content").css({'border-color':'#fff'}); $("#shopping_cart_box_title").css({'display':'none'}); $("#shopping_cart_box_content").css({'visibility':'hidden'});},
                          'onClosed':function() { $("#shopping_cart_box_content").css({'visibility':'visible', 'width':''}); },
                          'href':'#shopping_cart_box_content'
                        });
                      });                                                
                    /* ]]> */  
                    </script>
                    [@{/if}@]                      
                  </td>                                     
                </tr>    
              [@{else}@]
                <tr>
                  <td align="right" valign="top" class="info-box-contents"><span class="info-box-contents">[@{$product.quantity}@]&nbsp;x&nbsp;</span></td>
                  <td align="left" valign="top" class="info-box-contents"><a href="[@{$product.link_filename_product_info}@]"><span class="info-box-contents">[@{$product.name}@]</span></a></td>
                </tr>
              [@{/if}@]    
              [@{/foreach}@]  
              </table>
              <div class="info-box-contents" style="padding: 2px 0 1px 0;"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></div>
              <div class="info-box-contents" style="padding: 1px; text-align: right;">[@{if $box_shopping_cart_total_discount}@]<span class="red-mark">[@{$box_shopping_cart_total_discount}@]</span><br />[@{/if}@][@{$box_shopping_cart_total_price}@]</div>
            </div>               
          [@{/if}@]             
<!-- shopping_cart_eof -->
