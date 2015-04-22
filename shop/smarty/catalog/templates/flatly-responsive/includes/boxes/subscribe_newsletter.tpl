[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : flatly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7y
* descrip    : xos-shop template built with Bootstrap3 and theme flatly                                                                    
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
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><label class="label-for-box-subscriber" for="box_subscriber_email_address">[@{#box_heading_subscribe_newsletter#}@]</label></h3></div>
            <div class="panel-body form-inline">
              [@{$box_subscribe_newsletter_form_begin}@][@{$box_subscribe_newsletter_input_field_subscriber_email_address}@]
              <button type="submit" class="btn btn-link" title=" [@{#button_title_subscribe_newsletter#}@] "><span class="text-primary glyphicon glyphicon-envelope"></span></button>
              [@{$box_subscribe_newsletter_input_hide_session}@][@{$box_subscribe_newsletter_form_end}@]<br />
              <a href="[@{$box_subscribe_newsletter_link_filename_newsletter_subscribe}@]">[@{#box_subscribe_newsletter_text#}@]</a>
            </div>
          </div>          
<!-- subscribe_newsletter_eof -->
