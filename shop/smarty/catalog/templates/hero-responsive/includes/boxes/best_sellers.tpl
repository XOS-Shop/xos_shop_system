[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.6
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
* filename   : best_sellers.tpl
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

[@{if $box_best_sellers_has_content}@]
<!-- best_sellers -->
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">[@{#box_heading_bestsellers#}@]</h3></div>
            <div class="panel-body">          
              [@{foreach item=bestseller from=$box_best_sellers_bestsellers}@]
              <div style="width: 100%;">            
                <div class="pull-left" style="padding: 1px; max-width: 20%;">[@{$bestseller.number}@].</div>
                <div class="pull-left" style="padding: 1px; max-width: 80%;"><a href="[@{$bestseller.link_filename_product_info}@]">[@{$bestseller.name}@]</a></div>
                <div class="clearfix invisible"></div>
                <div class="div-spacer-h10"></div>
              </div>
              [@{/foreach}@]                        
            </div>
          </div>          
<!-- best_sellers_eof -->
[@{/if}@]