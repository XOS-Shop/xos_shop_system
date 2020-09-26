[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : flatly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop template built with Bootstrap3 and theme flatly                                                                    
* filename   : index.tpl
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
[@{if $display == 'categories'}@]
<!-- index_category listing -->
          [@{if $page_info == 'false' or $heading_title}@]<h1 class="text-orange heading-title-with-embedded-image clearfix">[@{$heading_image}@][@{$heading_title|default:$category_name}@]</h1>[@{/if}@]
          [@{if $category_description}@]
          <div>[@{$category_description}@]</div>
          [@{/if}@]
          <div class="div-spacer-h10"></div>
          [@{if $page_info == 'false'}@]
          <div> 
            [@{foreach name=cat item=categorie from=$categories}@]
            <div class="col-xs-6 col-sm-4 text-center"><a href="[@{$categorie.link_to_product_listing}@]">[@{$categorie.image|replace:'<img ':'<img class="img-responsive center-block" '}@][@{$categorie.name}@]</a><br /><br /></div>            
            [@{if ($smarty.foreach.cat.iteration)%3 == 0}@]
            <div class="visible-lg visible-md visible-sm clearfix"></div>            
            [@{/if}@]            
            [@{/foreach}@]  
            <div class="clearfix invisible"></div>
            <div class="div-spacer-h10"></div>
            <div>
            [@{if $product_listing}@][@{$product_listing}@][@{else}@][@{$new_products}@][@{/if}@]
            </div>
          </div>
          [@{/if}@]  
<!-- index_category_listing_eof -->                    
[@{elseif $display == 'products'}@]
<!-- index_product listing -->
          [@{if $manufacturer}@]
          <h1 class="text-orange heading-title-with-embedded-image clearfix">[@{$heading_image}@][@{#heading_title_manufacturer#}@] [@{$heading_title}@]</h1>
          [@{else}@]
          [@{if $page_info == 'false' or $heading_title}@]<h1 class="text-orange heading-title-with-embedded-image clearfix">[@{$heading_image}@][@{$heading_title|default:$category_name}@]</h1>[@{/if}@]
          [@{/if}@]          
          [@{if $category_description}@]
          <div>[@{$category_description}@]</div>
          [@{/if}@]
          <div class="div-spacer-h10"></div>
          [@{if $page_info == 'false'}@]
          <div>
          [@{$product_listing}@]
          </div>
          [@{/if}@]
<!-- index_product_listing_eof -->    
[@{else}@]
<!-- index_default --> 
          [@{if $heading_title}@]<h1 class="text-orange h3">[@{$heading_title}@]</h1>[@{/if}@]
          <div>[@{$content}@]</div>
          <div class="div-spacer-h10"></div>
          [@{if $heading_title}@]
          <div>
          [@{$new_products}@]
          </div>
          <div>
          [@{$upcoming_products}@]
          </div>
          [@{/if}@]
<!-- index_default_eof -->    
[@{/if}@]
