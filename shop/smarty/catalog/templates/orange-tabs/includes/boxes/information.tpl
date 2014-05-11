[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : information.tpl
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

<!-- information -->
          <div class="info-box-heading">[@{#box_heading_information#}@]</div>
          <div class="info-box-contents" style="padding: 11px 3px 11px 3px;">
            [@{foreach name=loop item=content from=$box_information_contents}@]
              <div style="padding: 1px;"><a href="[@{$content.link_filename_content_content_id}@]">[@{$content.name}@]</a></div>
            [@{/foreach}@]
              <div style="padding: 1px;"><a href="[@{$box_information_link_filename_contact_us}@]">[@{#box_information_contact#}@]</a></div>
          </div>
<!-- information_eof -->
