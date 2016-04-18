[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : default-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.2
* descrip    : xos-shop default template built with Bootstrap3                                                                    
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
          <ul class="nav navbar-nav navbar-right">
            <li class="visible-xs">
             <a href="[@{$box_shopping_cart_link_filename_shopping_cart}@]">[@{#box_heading_shopping_cart#}@] <b>[@{$products_quantity_total}@]</b></a> 
            </li>                              
            <li id="shopping_cart_box" class="dropdown hidden-xs">
              <a class="dropdown-toggle hidden-sm" role="button" aria-expanded="false">[@{#box_heading_shopping_cart#}@] [@{$products_quantity_total}@]</a>
              <a class="dropdown-toggle visible-sm navbar-brand" title=" [@{#box_heading_shopping_cart#}@] " role="button" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span> [@{$products_quantity_total}@]</a>               
              <ul id="shopping_cart_list" class="dropdown-menu" role="menu">
                <li>        
                  [@{if $products_quantity_total == 0}@]
                    <div style="width:120px; padding: 11px 3px 11px 3px; float: right;">[@{#box_shopping_cart_empty#}@]</div>
                  [@{else}@]
                    <div id="shopping_cart_box_content" style="width: 220px; padding: 11px 3px 3px 3px; text-align: left; float: right;">
                    <div id="shopping_cart_box_title" style="text-align: left; vertical-align: top; display:none;"><b>[@{#box_product_has_been_added#}@]<br />&nbsp;</b></div>
                      <table class="table-border-cellspacing cellpadding-0px">
                      [@{foreach item=product from=$box_shopping_cart_cart_products}@]
                      [@{if $product.new_product_in_cart == true}@]  
                        <tr>
                          <td style="text-align: right; vertical-align: top;"><span class="new-item-in-cart">[@{$product.quantity}@]&nbsp;x&nbsp;</span></td>
                          <td style="text-align: left; vertical-align: top;">
                            <a href="[@{$product.link_filename_product_info}@]"><span class="new-item-in-cart">[@{$product.name}@]</span></a>
                           [@{if $shopping_cart_will_not_display == true}@]
                            <script type="text/javascript">
                              $(document).ready(function () {
                                $.colorbox({ 
                                  onLoad: function() { $("#inline").css({'text-align':'left'}); },
                                  inline: true,
                                  onLoad:function() { $("#shopping_cart_box_title").css({'display':'block'}); $("#shopping_cart_box_content").css({'width':'280px', 'float':'left'}); },
                                  onCleanup:function() { $("#shopping_cart_box_title").css({'display':'none'}); $("#shopping_cart_box_content").css({'visibility':'hidden'});},
                                  onClosed:function() { $("#shopping_cart_box_content").css({'visibility':'visible', 'width':'220px', 'float':'right'}); },    
                                  href:'#shopping_cart_box_content'                          
                                });
                              });                                                
                            </script>
                            [@{/if}@]                      
                          </td>                    
                        </tr>    
                      [@{else}@]
                        <tr>
                          <td style="text-align: right; vertical-align: top;">[@{$product.quantity}@]&nbsp;x&nbsp;</td>
                          <td style="text-align: left; vertical-align: top;"><a href="[@{$product.link_filename_product_info}@]">[@{$product.name}@]</a></td>
                        </tr>
                      [@{/if}@]    
                      [@{/foreach}@]  
                      </table>
                      <div style="padding: 2px 0 1px 0;"><img src="[@{$images_path}@]pixel_black.gif" alt="" style="display: block; width: 100%; height: 1px;" /></div>
                      <div style="padding: 1px 1px 12px 1px; text-align: right;">[@{if $box_shopping_cart_total_discount}@]<span class="red-mark">[@{$box_shopping_cart_total_discount}@]</span><br />[@{/if}@][@{$box_shopping_cart_total_price}@]</div>
                      <a href="[@{$box_shopping_cart_link_filename_shopping_cart}@]" class="btn btn-success" style="float: left" title=" [@{#box_heading_shopping_cart#}@] | [@{#header_title_checkout#}@] ">[@{#box_heading_shopping_cart#}@] | [@{#header_title_checkout#}@]</a>
                    </div>               
                  [@{/if}@]                 
                  <script type="text/javascript">
                    $('#shopping_cart_list').css('display','none');                                                     
                    $('#shopping_cart_box').mouseleave(function(){
                      $('#shopping_cart_list').css('display','none');
                    }).mouseenter(function(){               
                      $('#shopping_cart_list').show(400); 
                    });                                                  
                  </script>                                         
                </li>
              </ul>
            </li>
          </ul>                                                           
<!-- shopping_cart_eof -->
