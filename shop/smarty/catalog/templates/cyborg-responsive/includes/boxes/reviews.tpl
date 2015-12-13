[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cyborg-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.1
* descrip    : xos-shop template built with Bootstrap3 and theme cyborg                                                                    
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
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><a href="[@{$box_reviews_link_filename_reviews}@]">[@{#box_heading_reviews#}@]&nbsp;»</a></h3></div>
            [@{if $box_reviews_link_filename_product_reviews_info}@]
              <div class="panel-body text-center">
                <div><a href="[@{$box_reviews_link_filename_product_reviews_info}@]">[@{$box_reviews_product_image}@]</a><br />&nbsp;</div>
                <a href="[@{$box_reviews_link_filename_product_reviews_info}@]">[@{$box_reviews_review_text|truncate:60:'...':false}@]</a><br /><br />
                <div>[@{$box_reviews_stars_image}@]</div>
              </div>
            [@{elseif $box_reviews_link_filename_product_reviews_write}@]
              <div class="panel-body text-center clearfix">
                <div><a href="[@{$box_reviews_link_filename_product_reviews_write}@]">[@{#box_reviews_write_review#}@]</a></div><div><a href="[@{$box_reviews_link_filename_product_reviews_write}@]"><span class="text-info glyphicon glyphicon-pencil" style="font-size: 32px; line-height: 55px;"></span></a></div>
              </div>
            [@{else}@]
              <div class="panel-body">[@{#box_reviews_no_reviews#}@]</div>
            [@{/if}@]
          </div>            
<!-- reviews_eof -->
