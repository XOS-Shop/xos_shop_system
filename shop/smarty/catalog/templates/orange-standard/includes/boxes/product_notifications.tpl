[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with div/css layout                                                                     
* filename   : product_notifications.tpl
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

<!-- product_notifications -->
          <div class="info-box-heading"><a href="[@{$box_product_notifications_link_filename_account_notifications}@]"><img src="[@{$images_path}@]arrow_right.gif" alt="[@{#more#}@]" title=" [@{#more#}@] " />[@{#box_heading_notifications#}@]</a></div>         
            <div class="info-box-contents" style="padding: 11px 3px 11px 3px;">
            [@{if $box_product_notifications_notification_exists}@]
              <div class="info-box-contents">
                <div style="width: 52px; float: left;"><a href="[@{$box_product_notifications_link_notify_notify_remove}@]">[@{$box_product_notifications_image}@]</a></div>
                <div style="width: 90px; float: left;"><a href="[@{$box_product_notifications_link_notify_notify_remove}@]">[@{eval var = #box_notifications_notify_remove#}@]</a></div>
              </div>     
            [@{else}@]
              <div class="info-box-contents">
                <div style="width: 52px; float: left;"><a href="[@{$box_product_notifications_link_notify_notify_remove}@]">[@{$box_product_notifications_image}@]</a></div>
                <div style="width: 90px; float: left;"><a href="[@{$box_product_notifications_link_notify_notify_remove}@]">[@{eval var = #box_notifications_notify#}@]</a></div>
              </div>
            [@{/if}@]
            <div class="clear">&nbsp;</div> 
          </div>
<!-- product_notifications_eof -->
