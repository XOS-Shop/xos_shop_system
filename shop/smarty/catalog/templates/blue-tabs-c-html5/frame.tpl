[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c-html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : frame.tpl
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
[@{$html_header}@]
<body [@{$body_tag_params}@]>
<div id="main-div">
<div id="page">
<!-- header -->
[@{$header}@]
<!-- header_eof -->
<!-- body -->
<div class="column-left">
<!-- column_left -->
[@{$box_share_product}@]
[@{$box_categories}@]
[@{$box_manufacturers}@]
[@{$box_specials}@]
[@{$box_information}@]
[@{$box_template_changer}@]
[@{$box_subscribe_newsletter}@]
[@{$box_manufacturer_info}@]
[@{$box_order_history}@]
[@{$box_best_sellers}@]
[@{$box_product_notifications}@]
[@{$box_whats_new}@]
[@{$box_reviews}@]
[@{$box_banner_column_1}@]
[@{$box_banner_column_2}@]
<!-- column_left_eof --> 
</div>
<div class="central-contents">
<div class="for-ie6">
<!-- central_contents -->    
[@{$central_contents}@]
<!-- central_contents_eof -->
</div>
</div>    
<div class="clear">&nbsp;</div>
<div style="width: 100%; background: #fff;">
<!-- body_eof -->
<!-- footer -->
[@{$footer}@]
<!-- footer_eof --> 
<br />
</div>
</div>
</div>
[@{$end_tags}@]
