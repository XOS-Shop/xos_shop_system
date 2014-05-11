<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : invoice.php
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
//              Copyright (c) 2002 - 2003 osCommerce
//              filename: invoice.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_INVOICE_TEXT_TITLE', 'Invoice');
  define('MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION', 'Invoice');

  
  define('MODULE_PAYMENT_INVOICE_STATUS_TITLE', 'Enable Cash Invoice Module');
  define('MODULE_PAYMENT_INVOICE_ZONE_TITLE', 'Payment Zone');
  define('MODULE_PAYMENT_INVOICE_SORT_ORDER_TITLE', 'Sort order of display.');
  define('MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID_TITLE', 'Set Order Status');
  define('MODULE_PAYMENT_INVOICE_FROM_ORDER_TITLE', 'Regular customers');
  define('MODULE_PAYMENT_INVOICE_ENABLED_FOR_DOWNLOADS_TITLE', 'Enable for download products');
     
  define('MODULE_PAYMENT_INVOICE_STATUS_DESCRIPTION', 'Do you want to accept Invoice payments?');
  define('MODULE_PAYMENT_INVOICE_ZONE_DESCRIPTION', 'If a zone is selected, only enable this payment method for that zone.');
  define('MODULE_PAYMENT_INVOICE_SORT_ORDER_DESCRIPTION', 'Sort order of display. Lowest is displayed first.');
  define('MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID_DESCRIPTION', 'Set the status of orders made with this payment module to this value');
  define('MODULE_PAYMENT_INVOICE_FROM_ORDER_DESCRIPTION', 'Rechnung ab x-ter Bestellung anbieten.');
  define('MODULE_PAYMENT_INVOICE_ENABLED_FOR_DOWNLOADS_DESCRIPTION', 'Do you offer payment by invoice, even if only downloadable products are ordered.');
?>
