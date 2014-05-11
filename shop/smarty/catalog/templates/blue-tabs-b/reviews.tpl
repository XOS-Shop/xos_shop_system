[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-b
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
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
        [@{if $reviews}@]       
          [@{if $nav_bar_top}@]        
          <div class="small-text" style="float: left; white-space: nowrap;">[@{$nav_bar_number}@]</div>          
          <div class="small-text" style="float: right; white-space: nowrap;">[@{$nav_bar_result}@]</div>
          <div class="clear">&nbsp;</div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          [@{/if}@]       
          [@{foreach item=review from=$reviews_array}@]          
          <div class="main" style="float: left; padding: 2px;"><a href="[@{$review.link_filename_product_reviews_info}@]"><span class="text-deco-underline"><b>[@{$review.products_name}@]</b></span></a><span class="small-text"> [@{eval var=#text_review_by#}@]</span></div>          
          <div class="small-text" style="float: right; padding: 4px 2px 2px 2px;">[@{eval var=#text_review_date_added#}@]</div>
          <div class="clear">&nbsp;</div>                           
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <div style="float: left;">
                <a href="[@{$review.link_filename_product_reviews_info}@]">[@{$review.products_image}@]</a>
              </div>
              <div class="main" style="float: left;">
                [@{$review.review_text|truncate:90:'...':false}@]<br /><br /><i>[@{#text_review_rating#}@] [@{$review.stars_image}@] [[@{eval var=#text_of_5_stars#}@]]</i>
              </div>                                                                                                                    
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>            
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                     
          [@{/foreach}@]       
          [@{if $nav_bar_bottom}@]
          <div class="small-text" style="float: left; white-space: nowrap;">[@{$nav_bar_number}@]</div>          
          <div class="small-text" style="float: right; white-space: nowrap;">[@{$nav_bar_result}@]</div>
          <div class="clear">&nbsp;</div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          [@{/if}@]        
        [@{else}@]
          <div class="info-box-central-contents">                    
            <div  class="box-text"  style="margin: 11px 4px 11px 4px;">
            [@{#text_no_reviews#}@]
            </div>                                                   
          </div>                                       
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        
        [@{/if}@]  
<!-- reviews_eof -->
