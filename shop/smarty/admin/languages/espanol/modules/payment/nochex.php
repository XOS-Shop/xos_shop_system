<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : nochex.php
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
//              filename: nochex.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_NOCHEX_TEXT_TITLE', 'NOCHEX');
  define('MODULE_PAYMENT_NOCHEX_TEXT_DESCRIPTION', 'NOCHEX<br />Requiere la moneda GBP (Libras).');
  
  
  define('MODULE_PAYMENT_NOCHEX_STATUS_TITLE', 'Enable NOCHEX Module');
  define('MODULE_PAYMENT_NOCHEX_ID_TITLE', 'E-Mail Address');
  define('MODULE_PAYMENT_NOCHEX_SORT_ORDER_TITLE', 'Sort order of display.');
  define('MODULE_PAYMENT_NOCHEX_ZONE_TITLE', 'Payment Zone');
  define('MODULE_PAYMENT_NOCHEX_ORDER_STATUS_ID_TITLE', 'Set Order Status');
  
  define('MODULE_PAYMENT_NOCHEX_STATUS_DESCRIPTION', 'Do you want to accept NOCHEX payments?');
  define('MODULE_PAYMENT_NOCHEX_ID_DESCRIPTION', 'The e-mail address to use for the NOCHEX service');
  define('MODULE_PAYMENT_NOCHEX_SORT_ORDER_DESCRIPTION', 'Sort order of display. Lowest is displayed first.');
  define('MODULE_PAYMENT_NOCHEX_ZONE_DESCRIPTION', 'If a zone is selected, only enable this payment method for that zone.');
  define('MODULE_PAYMENT_NOCHEX_ORDER_STATUS_ID_DESCRIPTION', 'Set the status of orders made with this payment module to this value');  
?>
