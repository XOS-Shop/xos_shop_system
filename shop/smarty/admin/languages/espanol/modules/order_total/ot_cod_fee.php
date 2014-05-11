<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : ot_cod_fee.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2007 Hanspeter Zeller
// license    : This file is part of XOS-Shop.
//
//              XOS-Shop is free software: you can redistribute it and/or modify
//              it under the terms of the GNU General Public License as published
//              by the Free Software Foundation, either version 3 of the License,
//              or (at your option) any later version.
//
//              XOS-Shop is distributed in the hope that it will be useful,
//              but WITHOUT ANY WARRANTY; without even the implied warranty of
//              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//              GNU General Public License for more details.
//
//              You should have received a copy of the GNU General Public License
//              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>.   
//------------------------------------------------------------------------------
// this file is based on: 
//              osCommerce, Open Source E-Commerce Solutions
//              http://www.oscommerce.com
//              Copyright (c) 2002 osCommerce
//              filename: ot_loworderfee.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_ORDER_TOTAL_COD_FEE_TITLE', 'Contra Reembolso');
  define('MODULE_ORDER_TOTAL_COD_FEE_DESCRIPTION', 'Contra Reembolso');
  
  
  define('MODULE_ORDER_TOTAL_COD_FEE_STATUS_TITLE', 'Display Cash on Delivery Fee');
  define('MODULE_ORDER_TOTAL_COD_FEE_SORT_ORDER_TITLE', 'Sort Order');
  define('MODULE_ORDER_TOTAL_COD_FEE_FLAT_TITLE', 'COD Fee for FLAT');
  define('MODULE_ORDER_TOTAL_COD_FEE_ITEM_TITLE', 'COD Fee for ITEM');
  define('MODULE_ORDER_TOTAL_COD_FEE_TABLE_TITLE', 'COD Fee for TABLE');
  define('MODULE_ORDER_TOTAL_COD_FEE_USPS_TITLE', 'COD Fee for USPS');        
  define('MODULE_ORDER_TOTAL_COD_FEE_ZONES_TITLE', 'COD Fee for ZONES');
  define('MODULE_ORDER_TOTAL_COD_FEE_FREE_TITLE', 'COD Fee for Free Shipping');
  define('MODULE_ORDER_TOTAL_COD_FEE_TAX_CLASS_TITLE', 'Tax Class');
  
  define('MODULE_ORDER_TOTAL_COD_FEE_STATUS_DESCRIPTION', 'Do you want to display the cash on delivery fee?');
  define('MODULE_ORDER_TOTAL_COD_FEE_SORT_ORDER_DESCRIPTION', 'Sort order of display.');
  define('MODULE_ORDER_TOTAL_COD_FEE_FLAT_DESCRIPTION', '&lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If you leave this field blank no COD fee will be charged for this shipping method. Example: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_ITEM_DESCRIPTION', '&lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If you leave this field blank no COD fee will be charged for this shipping method. Example: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_TABLE_DESCRIPTION', '&lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If you leave this field blank no COD fee will be charged for this shipping method. Example: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_USPS_DESCRIPTION', '&lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If you leave this field blank no COD fee will be charged for this shipping method. Example: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_ZONES_DESCRIPTION', '&lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If you leave this field blank no COD fee will be charged for this shipping method. Example: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_FREE_DESCRIPTION', '&lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If you leave this field blank no COD fee will be charged for this shipping method. Example: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_TAX_CLASS_DESCRIPTION', 'Use the following tax class on the cash on delivery fee.');  
?>
