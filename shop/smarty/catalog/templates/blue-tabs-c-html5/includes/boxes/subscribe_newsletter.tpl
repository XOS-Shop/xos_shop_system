[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c-html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : subscribe_newsletter.tpl
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

<!-- subscribe_newsletter -->
          <div class="info-box-heading"><label for="box_subscriber_email_address">[@{#box_heading_subscribe_newsletter#}@]</label></div>
          <div class="info-box-contents" style="padding: 11px 3px 11px 3px; text-align: center;">
            [@{$box_subscribe_newsletter_form_begin}@][@{$box_subscribe_newsletter_input_field_subscriber_email_address}@]&nbsp;
            <input type="image" src="[@{$images_path}@]button_subscribe_newsletter.gif" alt="[@{#button_title_subscribe_newsletter#}@]" title=" [@{#button_title_subscribe_newsletter#}@] " />
            [@{$box_subscribe_newsletter_input_hide_session}@][@{$box_subscribe_newsletter_form_end}@]<br />
            <a href="[@{$box_subscribe_newsletter_link_filename_newsletter_subscribe}@]">[@{#box_subscribe_newsletter_text#}@]</a>
          </div>
<!-- subscribe_newsletter_eof -->
