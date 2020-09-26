[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
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
          <h1 class="text-orange">[@{#heading_title#}@]</h1>                
          <div class="div-spacer-h10"></div> 
        [@{if $reviews}@]
          [@{if $nav_bar_top}@]        
          <div class="clearfix">
            <div class="pagination-number">[@{$nav_bar_number}@]</div>          
            <div class="pagination-result">[@{$nav_bar_result}@]</div>
          </div>
          <div class="div-spacer-h10"></div>
          [@{/if}@]             
          [@{foreach item=review from=$reviews_array}@]          
          <div class="pull-left"><a href="[@{$review.link_filename_product_reviews_info}@]"><span class="text-deco-underline"><b>[@{$review.products_name}@]</b></span></a><span> [@{eval var=#text_review_by#}@]</span>&nbsp;</div>          
          <div class="text-right pull-right">[@{eval var=#text_review_date_added#}@]</div>
          <div class="clearfix invisible"></div>           
          <div class="panel panel-default clearfix">           
            <div class="panel-body"> 
              <div class="row">             
                <div class="col-sm-3 col-lg-2">                                                                   
                  <a href="[@{$review.link_filename_product_reviews_info}@]">[@{$review.products_image}@]</a>
                </div>
                <div class="col-sm-9 col-lg-10">
                  [@{$review.review_text|truncate:90:'...':false}@]<br /><br /><i>[@{#text_review_rating#}@] [@{$review.stars_image}@] [[@{eval var=#text_of_5_stars#}@]]</i>
                </div>              
              </div>                                                                                                                                      
            </div>             
          </div>                               
          [@{/foreach}@]
          [@{if $nav_bar_bottom}@]
          <div class="clearfix">
            <div class="pagination-number">[@{$nav_bar_number}@]</div>          
            <div class="pagination-result">[@{$nav_bar_result}@]</div>
          </div>
          <div class="div-spacer-h10"></div>
          [@{/if}@]                 
        [@{else}@]
          <div class="panel panel-default clearfix">
            <div class="panel-body">
              [@{#text_no_reviews#}@]
            </div>
          </div>                                               
          <div class="div-spacer-h10"></div>        
        [@{/if}@]  
<!-- reviews_eof -->
