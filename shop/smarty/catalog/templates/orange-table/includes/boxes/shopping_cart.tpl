[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
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
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr id="shopping_cart_box_header">
              <td class="info-box-heading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="6" height="18" /></td>
              <td width="100%" class="info-box-heading"><a href="[@{$box_shopping_cart_link_filename_shopping_cart}@]">[@{#box_heading_shopping_cart#}@]</a></td>
              <td class="info-box-heading" nowrap="nowrap"><a href="[@{$box_shopping_cart_link_filename_shopping_cart}@]"><img src="[@{$images_path}@]arrow_right.gif" alt="[@{#more#}@]" title=" [@{#more#}@] " /></a></td>
            </tr>
          </table>
          <table id="shopping_cart_box_content" border="0" width="100%" cellspacing="0" cellpadding="1" class="info-box">
            <tr>
              <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="info-box-contents">
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
               [@{if $box_shopping_cart_cart_empty}@]
                <tr>
                  <td class="box-text">[@{#box_shopping_cart_empty#}@]</td>
                </tr>
               [@{else}@]
                <tr>
                  <td class="box-text">                  
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
                              'onClosed':function() { $("#shopping_cart_box_content").css({'visibility':'visible', 'width':'100%'}); },
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
                  </table></td>
                </tr>  
                <tr>
                  <td class="box-text"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                </tr>
                <tr>
                  <td align="right" class="box-text"><div align="right">[@{if $box_shopping_cart_total_discount}@]<span class="red-mark">[@{$box_shopping_cart_total_discount}@]</span><br />[@{/if}@][@{$box_shopping_cart_total_price}@]</div></td>
                </tr> 
               [@{/if}@]
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </td>
      </tr>
<!-- shopping_cart_eof -->
