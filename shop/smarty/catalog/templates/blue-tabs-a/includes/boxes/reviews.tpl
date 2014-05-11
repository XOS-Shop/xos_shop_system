[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-a
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : reviews.tpl
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

<!-- reviews -->
          <div class="info-box-heading"><a href="[@{$box_reviews_link_filename_reviews}@]"><img src="[@{$images_path}@]arrow_right.gif" alt="[@{#more#}@]" title=" [@{#more#}@] " />[@{#box_heading_reviews#}@]</a></div>
          [@{if $box_reviews_link_filename_product_reviews_info}@]
            <div class="info-box-contents" style="padding: 11px 3px 11px 3px;">
              <div align="center"><a href="[@{$box_reviews_link_filename_product_reviews_info}@]">[@{$box_reviews_product_image}@]</a><br />&nbsp;</div>
              <a href="[@{$box_reviews_link_filename_product_reviews_info}@]">[@{$box_reviews_review_text|truncate:60:'...':false}@]</a><br /><br />
              <div align="center">[@{$box_reviews_stars_image}@]</div>
            </div>
          [@{elseif $box_reviews_link_filename_product_reviews_write}@]
            <div class="info-box-contents" style="padding: 11px 3px 1px 3px;">
              <div class="info-box-contents" style="padding: 1px 5px 1px 1px; float: left;"><a href="[@{$box_reviews_link_filename_product_reviews_write}@]">[@{$box_reviews_write_review_image}@]</a></div>
              <div class="info-box-contents" style="padding: 12px 0 0 0;"><a href="[@{$box_reviews_link_filename_product_reviews_write}@]">[@{#box_reviews_write_review#}@]</a></div>
              <div class="clear">&nbsp;</div> 
            </div>
          [@{else}@]
            <div class="info-box-contents" style="padding: 11px 3px 11px 3px;">[@{#box_reviews_no_reviews#}@]</div>
          [@{/if}@]  
<!-- reviews_eof -->
