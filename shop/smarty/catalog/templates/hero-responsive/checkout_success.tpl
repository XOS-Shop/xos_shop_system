[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.1
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
* filename   : checkout_success.tpl
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

<!-- checkout_success -->
    [@{$form_begin}@]
          <div class="row">                                          
            <div class="col-sm-3 col-xs-6 checkout-bar-finished-from text-center"><span class="lead">1</span><br />[@{#checkout_bar_delivery#}@]</div>
            <div class="col-sm-3 col-xs-6 checkout-bar-finished-from text-center"><span class="lead">2</span><br />[@{#checkout_bar_payment#}@]</div>
            <div class="clearfix visible-xs-block"></div>
            <div class="visible-xs-block div-spacer-h10"></div>
            <div class="col-sm-3 col-xs-6 checkout-bar-finished-from text-center"><span class="lead">3</span><br />[@{#checkout_bar_confirmation#}@]</div>
            <div class="col-sm-3 col-xs-6 checkout-bar-current text-center"><span class="lead"><b>4</b></span><br /><b>[@{#checkout_bar_finished#}@]</b></div>
          </div>
          <div class="div-spacer-h20"></div>         
          <div class="row">
            <div class="col-sm-4 col-md-3">
              <img class="img-responsive" src="[@{$images_path}@]table_background.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " />
            </div>
            <div class="col-sm-8 col-md-9">
              <h1 class="text-orange">[@{#heading_title#}@]</h1>
              <div style="margin-top: 18px; padding-right: 10px;">
                [@{#text_success#}@]<br /><br />
                [@{if $notify}@]            
                [@{#text_notify_products#}@]
                [@{foreach item=product_notify from=$products_notify}@]                
                <div class="checkbox">
                  <label class="products-notifications">
                    [@{$product_notify.checkbox_field}@]
                    [@{$product_notify.text}@]
                  </label>
                </div>                
                [@{/foreach}@]
                <br />
                [@{/if}@]
                [@{eval var=#text_see_orders#}@]<br /><br />[@{eval var=#text_contact_store_owner#}@]
                <h4>[@{#text_thanks_for_shopping#}@]</h4>            
              </div>
            </div>                     
          </div>
          <div class="div-spacer-h20"></div>          
          [@{$downloads}@]           
          <div class="div-spacer-h20"></div>  
          <div class="well well-sm clearfix"> 
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                                                               
          </div>
    [@{$form_end}@]                      
<!-- checkout_success_eof -->
