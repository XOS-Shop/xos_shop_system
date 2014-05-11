[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with popup windows as lightboxes 
*              and div/css layout                                                                     
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
          <div class="rt-gray">
	    <div class="lt-gray">
              <div class="rb">
                <div class="lb">
                  <div class="box-content">
                    <h4 class="info-box-heading">[@{#box_heading_bestsellers#}@]</h4>
                    <div class="info-box-contents" style="padding: 11px 3px 11px 3px;">          
                      [@{foreach item=bestseller from=$box_best_sellers_bestsellers}@]            
                      <div style="padding: 1px; float: left;">[@{$bestseller.number}@].</div>
                      <div style="padding: 1px;"><a href="[@{$bestseller.link_filename_product_info}@]">[@{$bestseller.name}@]</a></div>
                      [@{/foreach}@]                        
                    </div>
                  </div>
                </div>
              </div>
	    </div>
          </div>
          <div class="clear">&nbsp;</div>            
<!-- best_sellers_eof -->
[@{/if}@]