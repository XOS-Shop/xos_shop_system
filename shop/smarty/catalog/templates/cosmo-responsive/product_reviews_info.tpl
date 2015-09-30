[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cosmo-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc8
* descrip    : xos-shop template built with Bootstrap3 and theme cosmo                                                                    
* filename   : product_reviews_info.tpl
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

<!-- product_reviews_info -->
          <div class="row">             
            <div class="col-sm-8 col-lg-9">                     
              <h1 class="text-orange">[@{$products_name}@]</h1>                 
              [@{if $products_model}@]<div><b>[@{#text_model#}@]</b>&nbsp;&nbsp;[@{$products_model}@]</div>[@{/if}@]                                                                            
            </div>                                                               
            <div class="col-sm-4 col-lg-3">
              [@{if $product_img}@]                
              <div class="hidden-xs pull-right">[@{$product_img|replace:'style="margin: 5px;"':'class="img-responsive"'}@]</div>
              <div class="visible-xs-block">[@{$product_img|replace:'style="margin: 5px;"':'class="img-responsive"'}@]</div>
              [@{/if}@]
            </div>
          </div> 
          <div class="clearfix invisible"></div>
          <div class="div-spacer-h20"></div>          
          <div class="pull-left"><b>[@{eval var=#text_review_by#}@]</b>&nbsp;</div>          
          <div class="text-right pull-right">[@{eval var=#text_review_date_added#}@]</div>
          <div class="clearfix invisible"></div>                           
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                     
              [@{$review_text}@]<br /><br /><i>[@{#text_review_rating#}@] [@{$stars_image}@] [[@{eval var=#text_of_5_stars#}@]]</i>                
            </div>             
          </div>          
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                             
            <a href="[@{$link_filename_product_reviews_write}@]" class="btn btn-primary pull-right" title=" [@{#button_title_write_review#}@] ">[@{#button_text_write_review#}@]</a>                                                                                                                                                                             
          </div>             
<!-- product_reviews_info_eof -->
