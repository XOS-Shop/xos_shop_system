[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
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
<div class="main-div">
<table align="center" border="0" width="995" cellspacing="0" cellpadding="0">
<tr>
<td valign="top">
<!-- header -->
[@{$header}@]
<!-- header_eof -->

<!-- body -->
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="column-left" width="175" valign="top"><table border="0" width="175" cellspacing="0" cellpadding="2">
<!-- column_left -->
[@{$box_categories}@]
[@{$box_manufacturers}@]
[@{$box_specials}@]
[@{$box_currencies}@]
[@{$box_languages}@]
[@{$box_template_changer}@]
[@{$box_information}@]
[@{$box_subscribe_newsletter}@]
[@{$box_banner_column_1}@]
      <tr><td></td></tr>
<!-- column_left_eof -->
    </table></td>
<!-- central_contents -->    
[@{$central_contents}@]
<!-- central_contents_eof -->    
    <td class="column-right" width="160" valign="top"><table border="0" width="160" cellspacing="0" cellpadding="2">
<!-- column_right -->
[@{$box_shopping_cart}@]
[@{$box_share_product}@]
[@{$box_login_my_account}@]
[@{$box_manufacturer_info}@]
[@{$box_order_history}@]
[@{$box_best_sellers}@]
[@{$box_product_notifications}@]
[@{$box_whats_new}@]
[@{$box_reviews}@]
[@{$box_banner_column_2}@]
      <tr><td></td></tr>
<!-- column_right_eof -->
    </table></td>
  </tr>
</table>
<!-- body_eof -->

<!-- footer -->
[@{$footer}@]
<!-- footer_eof -->
<br />
</td>
</tr>
</table>
</div>
[@{$end_tags}@]
