[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-b
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
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
          [@{if $page_info == 'false' or $heading_title}@]<div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{$heading_image}@][@{$heading_title|default:$category_name}@]</div>[@{/if}@]
          [@{if $category_description}@]
          <div class="main">[@{$category_description}@]</div>
          [@{/if}@]
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          [@{if $page_info == 'false'}@]
          <div> 
            [@{foreach item=categorie from=$categories}@]
            <div class="small-text" style="padding: 0 0 11px 0; text-align: center;  float: left; width: [@{$categorie.td_width}@]"><a href="[@{$categorie.link_to_product_listing}@]">[@{$categorie.image}@]<br />[@{$categorie.name}@]</a></div>
            [@{if $categorie.more_rows}@]  
            <div class="clear">&nbsp;</div>
            [@{/if}@]               
            [@{/foreach}@]  
            <div class="clear">&nbsp;</div>
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            <div>
            [@{if $product_listing}@][@{$product_listing}@][@{else}@][@{$new_products}@][@{/if}@]
            </div>
          </div>
          [@{/if}@]  
<!-- index_category_listing_eof -->                    
[@{elseif $display == 'products'}@]
<!-- index_product listing -->
          [@{if $manufacturer}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{$heading_image}@][@{#heading_title_manufacturer#}@] [@{$heading_title}@]</div>
          [@{else}@]
          [@{if $page_info == 'false' or $heading_title}@]<div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{$heading_image}@][@{$heading_title|default:$category_name}@]</div>[@{/if}@]
          [@{/if}@]          
          [@{if $category_description}@]
          <div class="main">[@{$category_description}@]</div>
          [@{/if}@]
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          [@{if $page_info == 'false'}@]
          <div>
          [@{$product_listing}@]
          </div>
          [@{/if}@]
<!-- index_product_listing_eof -->    
[@{else}@]
<!-- index_default --> 
          [@{if $heading_title}@]<div class="page-heading" style="line-height: [@{#page_heading_height#}@]px; padding: 0 0 10px 0">[@{$heading_title}@]</div>[@{/if}@]
          <div class="main" style="padding: 0 0 10px 0">[@{$content}@]</div>
          [@{if $heading_title}@]
          <div>
          [@{$new_products}@]
          </div>
          <div style="padding: 20px 0 0 0">
          [@{$upcoming_products}@]
          </div>
          [@{/if}@]
<!-- index_default_eof -->    
[@{/if}@]
