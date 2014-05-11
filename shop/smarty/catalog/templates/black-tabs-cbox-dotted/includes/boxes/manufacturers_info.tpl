[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox-dotted
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : manufacturer_info.tpl
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

[@{if $box_manufacturer_info_has_content}@]
<!-- manufacturer_info -->
          <div class="info-box-heading">[@{#box_heading_manufacturer_info#}@]</div>
          <div class="info-box-contents" style="padding: 6px 3px 6px 3px;">          
            <div class="info-box-contents" style="padding: 1px; text-align: center;">[@{$box_manufacturer_info_manufacturer_image}@]</div> 
            [@{if $box_manufacturer_info_link_to_the_manufacturer}@]           
            <div style="padding: 1px; float: left;">-&nbsp;</div>
            <div style="padding: 1px;"><a href="[@{$box_manufacturer_info_link_to_the_manufacturer}@]" target="_blank">[@{eval var = #box_manufacturer_info_homepage#}@]</a></div>
            [@{/if}@]
            <div style="padding: 1px; float: left;">-&nbsp;</div>
            <div style="padding: 1px;"><a href="[@{$box_manufacturer_info_link_filename_default}@]">[@{#box_manufacturer_info_other_products#}@]</a></div>                           
          </div>
<!-- manufacturer_info_eof -->
[@{/if}@]