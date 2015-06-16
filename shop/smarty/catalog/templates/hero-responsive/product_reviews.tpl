[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7z
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
* filename   : product_reviews.tpl
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

<!-- product_reviews -->
          <div class="row">             
            <div class="col-sm-8 col-lg-9">                     
              <h1 class="text-orange">[@{$products_name}@]</h1>                 
              [@{if $products_model}@]<div><b>[@{#text_model#}@]</b>&nbsp;&nbsp;[@{$products_model}@]</div>[@{/if}@]                                                                            
            </div>                                                               
            <div class="col-sm-4 col-lg-3">
              [@{if $product_img}@]                
              <div class="hidden-xs pull-right">[@{$product_img}@]</div>
              <div class="visible-xs-block">[@{$product_img}@]</div>
              [@{/if}@]
            </div>
          </div> 
          <div class="clearfix invisible"></div>
          <div class="div-spacer-h20"></div>                        
        [@{if $product_reviews}@]
          [@{if $nav_bar_top}@]        
          <div class="clearfix">
            <div class="pagination-number">[@{$nav_bar_number}@]</div>          
            <div class="pagination-result">[@{$nav_bar_result}@]</div>
          </div>
          <div class="div-spacer-h10"></div>
          [@{/if}@]                     
          [@{foreach item=product_reviews from=$product_reviews_array}@]          
          <div class="pull-left"><a href="[@{$product_reviews.link_filename_product_reviews_info}@]"><span class="text-deco-underline"><b>[@{eval var=#text_review_by#}@]</b></span></a>&nbsp;</div>          
          <div class="text-right pull-right">[@{eval var=#text_review_date_added#}@]</div>
          <div class="clearfix invisible"></div>                           
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                     
              [@{$product_reviews.review_text|truncate:90:'...':false}@]<br /><br /><i>[@{#text_review_rating#}@] [@{$product_reviews.stars_image}@] [[@{eval var=#text_of_5_stars#}@]]</i>                 
            </div>             
          </div>                                
          [@{/foreach}@]
          [@{if $nav_bar_bottom}@]
          <div class="clearfix">
            <div class="pagination-number">[@{$nav_bar_number}@]</div>          
            <div class="pagination-result">[@{$nav_bar_result}@]</div>
          </div>
          <div class="div-spacer-h20"></div>
          [@{/if}@]
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                             
            <a href="[@{$link_filename_product_reviews_write}@]" class="btn btn-primary pull-right" title=" [@{#button_title_write_review#}@] ">[@{#button_text_write_review#}@]</a>                                                                                                                                                                             
          </div>                                             
        [@{else}@]
          <div class="panel panel-default clearfix">
            <div class="panel-body">
              [@{#text_no_reviews#}@]
            </div>
          </div>                                                         
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                             
            <a href="[@{$link_filename_product_reviews_write}@]" class="btn btn-primary pull-right" title=" [@{#button_title_write_review#}@] ">[@{#button_text_write_review#}@]</a>                                                                                                                                                                             
          </div>                     
        [@{/if}@]          
<!-- product_reviews_eof -->
