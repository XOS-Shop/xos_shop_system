<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : authorizenet.php
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
//              filename: authorizenet.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TITLE', 'Authorize.net');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', 'Credit Card Test Info:<br /><br />CC#: 4111111111111111<br />Expiry: Any');


  define('MODULE_PAYMENT_AUTHORIZENET_STATUS_TITLE', 'Enable Authorize.net Module');
  define('MODULE_PAYMENT_AUTHORIZENET_LOGIN_TITLE', 'Login Username');
  define('MODULE_PAYMENT_AUTHORIZENET_TXNKEY_TITLE', 'Transaction Key');
  define('MODULE_PAYMENT_AUTHORIZENET_TESTMODE_TITLE', 'Transaction Mode');
  define('MODULE_PAYMENT_AUTHORIZENET_METHOD_TITLE', 'Transaction Method');
  define('MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER_TITLE', 'Customer Notifications');
  define('MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER_TITLE', 'Sort order of display.');
  define('MODULE_PAYMENT_AUTHORIZENET_ZONE_TITLE', 'Payment Zone');
  define('MODULE_PAYMENT_AUTHORIZENET_ORDER_STATUS_ID_TITLE', 'Set Order Status');
  
  define('MODULE_PAYMENT_AUTHORIZENET_STATUS_DESCRIPTION', 'Do you want to accept Authorize.net payments?');
  define('MODULE_PAYMENT_AUTHORIZENET_LOGIN_DESCRIPTION', 'The login username used for the Authorize.net service');
  define('MODULE_PAYMENT_AUTHORIZENET_TXNKEY_DESCRIPTION', 'Transaction Key used for encrypting TP data');
  define('MODULE_PAYMENT_AUTHORIZENET_TESTMODE_DESCRIPTION', 'Transaction mode used for processing orders');
  define('MODULE_PAYMENT_AUTHORIZENET_METHOD_DESCRIPTION', 'Transaction method used for processing orders');
  define('MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER_DESCRIPTION', 'Should Authorize.Net e-mail a receipt to the customer?');
  define('MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER_DESCRIPTION', 'Sort order of display. Lowest is displayed first.');
  define('MODULE_PAYMENT_AUTHORIZENET_ZONE_DESCRIPTION', 'If a zone is selected, only enable this payment method for that zone.');
  define('MODULE_PAYMENT_AUTHORIZENET_ORDER_STATUS_ID_DESCRIPTION', 'Set the status of orders made with this payment module to this value');   
?>
