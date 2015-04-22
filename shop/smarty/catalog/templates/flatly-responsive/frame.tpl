[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : flatly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7y
* descrip    : xos-shop template built with Bootstrap3 and theme flatly                                                                    
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
<!-- header -->
[@{$header}@]
<!-- header_eof -->
<div class="container">
<div class="row">
<!-- body --> 
<div class="col-sm-9 col-sm-push-3">
<!-- central_contents --> 
<div class="row">
<div class="col-sm-12">
[@{if $header_breadcrumb}@]
<div class="breadcrumb">
[@{$header_breadcrumb}@]  
</div>
[@{/if}@]   
</div>  
</div> 
[@{if $header_error_message}@]
<div class="row">
<div class="col-sm-12">
<div class="alert alert-danger" role="alert">
[@{$header_error_message}@]
</div>   
</div>  
</div>  
[@{/if}@]   
[@{if $header_info_message}@]
<div class="row">
<div class="col-sm-12">      
<div class="alert alert-info" role="alert">
[@{$header_info_message}@]
</div>   
</div>  
</div>  
[@{/if}@]  
[@{$central_contents}@]
<!-- central_contents_eof -->
</div>
<div class="col-sm-3 col-sm-pull-9">
<!-- column_left -->
[@{$box_share_product}@]
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
<!-- body_eof -->
</div>
<div class="row">   
<div class="col-sm-12">
<!-- footer -->
[@{$footer}@]
<!-- footer_eof --> 
<br />
</div>
</div>
</div>
[@{$end_tags}@]
