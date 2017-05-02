[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : darkly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.5
* descrip    : xos-shop template built with Bootstrap3 and theme darkly                                                                    
* filename   : product_reviews_write.tpl
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

<!-- product_reviews_write -->
          [@{$form_begin}@]
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
          [@{if $message_stack_error}@]
          <div class="alert alert-danger" role="alert">
            [@{$message_stack_error}@]
          </div>                            
          [@{/if}@]
          [@{if $message_stack_warning}@]
          <div class="alert alert-warning" role="alert">
            [@{$message_stack_warning}@]
          </div>                            
          [@{/if}@]          
          [@{if $message_stack_success}@]
          <div class="alert alert-success" role="alert">
            [@{$message_stack_success}@]
          </div>                            
          [@{/if}@]                                        
          <div><b>[@{#sub_title_from#}@]</b> [@{$customers_name}@]</div> 
          <label class="control-label" for="review"><b>[@{#sub_title_review#}@]</b></label>                                   
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              <div><small><span class="red-mark"><b>[@{#sub_title_no_html#}@]</b></span></small>&nbsp;[@{#text_no_html#}@]</div>                     
              <div>[@{$textarea_field|replace:'<textarea ':'<textarea id="review" class="form-control" '}@]</div> 
              <div class="div-spacer-h10"></div>
              <div><b>[@{#sub_title_rating#}@]</b> <small><span class="red-mark"><b>[@{#text_bad#}@]</b></span></small> [@{$radio_fields}@] <small><span class="red-mark"><b>[@{#text_good#}@]</b></span></small></div>                
            </div>             
          </div>                 
          <div class="well well-sm clearfix">                             
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                               
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                           
          </div>                               
          [@{$form_end}@]
<!-- product_reviews_write_eof -->
