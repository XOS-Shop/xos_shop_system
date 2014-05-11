[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
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
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <h3 class="main"><b>[@{#heading_download#}@]</b></h3>         
          <div class="info-box-central-contents"> 
          [@{foreach item=download_product from=$download_products}@]
            <div class="main" style="border-right: solid 1px #b6b7cb; padding: 4px 2px 4px 4px; width: 20%; float: left;">[@{$download_product.name}@]</div>
            <div class="main" style="padding: 4px 2px 4px 4px; width: 52%; float: left;">[@{#table_heading_download_date#}@] [@{$download_product.expiry_date}@]</div>
            <div class="main" style="padding: 4px 2px 4px 2px; width: 24%; text-align: right; float: right;">[@{eval var=#table_heading_download_count#}@]</div>
            <div class="clear">&nbsp;</div>                          
          [@{/foreach}@]                                                  
          </div>          
          [@{if $download_link}@]       
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <div class="main">[@{eval var=#footer_download#}@]</div>
          [@{/if}@]      
<!-- downloads_eof -->
