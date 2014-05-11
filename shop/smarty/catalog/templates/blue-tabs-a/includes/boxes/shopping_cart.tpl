[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-a
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
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
          [@{if $box_shopping_cart_cart_empty}@]<img style="position:absolute; right:133px; top:2px;" src="[@{$images_path}@]shopping_basket_empty.gif" alt="" />[@{else}@]<a href="[@{$box_shopping_cart_link_filename_shopping_cart}@]"><img style="position:absolute; right:133px; top:2px;" src="[@{$images_path}@]shopping_basket_filled.gif" alt="" /></a>[@{/if}@]
          <div id="shopping_cart_box" style="position:absolute; right:4px; top:50px;">                   
            <script type="text/javascript">
            /* <![CDATA[ */
              document.write('<a id="shopping_cart_box_header" class="header" style="float: right; cursor: pointer;">[@{#box_heading_shopping_cart#}@]</a>');
            /* ]]> */  
            </script>
            <noscript>                    
              <a class="header" style="float: right; cursor: pointer;" href="[@{$box_shopping_cart_link_filename_shopping_cart}@]">[@{#box_heading_shopping_cart#}@]</a>
            </noscript>
            <div class="clear">&nbsp;</div>          
            <div id="shopping_cart_list">          
            [@{if $box_shopping_cart_cart_empty}@]
              <div class="info-box-contents" style="width:120px; padding: 11px 3px 11px 3px; float: right; border: 1px solid #b6b7cb;">[@{#box_shopping_cart_empty#}@]</div>
            [@{else}@]
              <div id="shopping_cart_box_content" class="info-box-contents" style="width: 200px; padding: 11px 3px 3px 3px; text-align: left; float: right; border: 1px solid #b6b7cb;">
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
                            'onStart':function() { $("#fancybox-content").css({'border-color':'#b6b7cb'}); $("#shopping_cart_box_title").css({'display':'block'}); $("#shopping_cart_box_content").css({'width':'320px', 'float':'left'}); },
                            'onCleanup':function() { $("#fancybox-content").css({'border-color':'#fff'}); $("#shopping_cart_box_title").css({'display':'none'}); $("#shopping_cart_box_content").css({'visibility':'hidden'});},
                            'onClosed':function() { $("#shopping_cart_box_content").css({'visibility':'visible', 'width':'200px', 'float':'right'}); },
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
                <div class="info-box-contents" style="padding: 1px 1px 12px 1px; text-align: right;">[@{if $box_shopping_cart_total_discount}@]<span class="red-mark">[@{$box_shopping_cart_total_discount}@]</span><br />[@{/if}@][@{$box_shopping_cart_total_price}@]</div>
                <a href="[@{$box_shopping_cart_link_filename_shopping_cart}@]" class="button-back" style="float: left" title=" [@{#box_heading_shopping_cart#}@] | [@{#header_title_checkout#}@] "><span>[@{#box_heading_shopping_cart#}@] | [@{#header_title_checkout#}@]</span></a>
              </div>               
            [@{/if}@]
              <div class="clear">&nbsp;</div>          
            </div>          
          </div>          
          <script type="text/javascript">
          /* <![CDATA[ */
            $('#shopping_cart_list').css('display','none');                                                     
            $('#shopping_cart_box').mouseleave(function(){
              $('#shopping_cart_list').css('display','none');
            }).mouseenter(function(){               
              $('#shopping_cart_list').show(400); 
            });
            $('#shopping_cart_list').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});                                                 
          /* ]]> */  
          </script>                         
<!-- shopping_cart_eof -->
