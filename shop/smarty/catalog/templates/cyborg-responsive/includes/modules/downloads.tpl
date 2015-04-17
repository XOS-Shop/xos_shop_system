[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cyborg-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7x
* descrip    : xos-shop template built with Bootstrap3 and theme cyborg                                                                    
* filename   : downloads.tpl
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

<!-- downloads --> 
          <div><b>[@{#heading_download#}@]</b></div>
          <div class="panel panel-default clearfix">           
            <div class="panel-body">            
              [@{foreach item=download_product from=$download_products}@]
              <div class="row">              
                <div class="col-lg-3"><u>[@{$download_product.name}@]</u></div>
                <div class="col-lg-6">[@{#table_heading_download_date#}@] [@{$download_product.expiry_date}@]</div>
                <div class="col-lg-3">
                  [@{eval var=#table_heading_download_count#}@]
                  <div class="div-spacer-h20 hidden-lg"></div>
                </div>      
              </div>                                  
              [@{/foreach}@]                                     
            </div>               
          </div>                   
          [@{if $download_link}@]       
          <div>[@{eval var=#footer_download#}@]</div>
          <div class="div-spacer-h10"></div>          
          [@{/if}@]      
<!-- downloads_eof -->
