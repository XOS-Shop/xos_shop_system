[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cyborg-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7w
* descrip    : xos-shop template built with Bootstrap3 and theme cyborg                                                                    
* filename   : upcoming_products.tpl
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

<!-- upcoming_products -->
            <div class="div-spacer-h20"></div>
            <div>
              <div class="col-xs-8 pull-left"><b>[@{#table_heading_upcoming_products#}@]</b>&nbsp;</div>
              <div class="col-xs-4 text-nowrap text-right pull-right"><b>[@{#table_heading_date_expected#}@]</b></div>            
              <div class="clearfix invisible"></div>
              <div class="panel panel-default clearfix">           
                <div class="panel-body">
                  <div class="row">                 
                  [@{foreach name=loop item=upcoming_product from=$upcoming_products}@]  
                    <div class="col-xs-6"><a href="[@{$upcoming_product.link_filename_product_info}@]">[@{$upcoming_product.name}@]</a></div>
                    <div class="col-xs-6 text-right text-nowrap">[@{$upcoming_product.date_expected}@]</div>
                    [@{if !$smarty.foreach.loop.last}@]
                    <div class="col-xs-12 div-spacer-h10"></div>
                    [@{/if}@]
                  [@{/foreach}@]
                  </div>
                </div>
              </div>                  
            </div>
<!-- upcoming_products_eof -->
