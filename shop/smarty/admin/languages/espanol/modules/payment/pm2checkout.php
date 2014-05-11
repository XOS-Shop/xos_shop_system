<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : pm2checkout.php
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
//              filename: pm2checkout.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_2CHECKOUT_TEXT_TITLE', '2CheckOut');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_DESCRIPTION', 'Tarjeta de Crédito para Pruebas:<br /><br />Numero: 4111111111111111<br />Caducidad: Cualquiera');


  define('MODULE_PAYMENT_2CHECKOUT_STATUS_TITLE', 'Enable 2CheckOut Module');
  define('MODULE_PAYMENT_2CHECKOUT_LOGIN_TITLE', 'Login/Store Number');
  define('MODULE_PAYMENT_2CHECKOUT_TESTMODE_TITLE', 'Transaction Mode');
  define('MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT_TITLE', 'Merchant Notifications');
  define('MODULE_PAYMENT_2CHECKOUT_SORT_ORDER_TITLE', 'Sort order of display.');
  define('MODULE_PAYMENT_2CHECKOUT_ZONE_TITLE', 'Payment Zone');
  define('MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID_TITLE', 'Set Order Status');
  
  define('MODULE_PAYMENT_2CHECKOUT_STATUS_DESCRIPTION', 'Do you want to accept 2CheckOut payments?');
  define('MODULE_PAYMENT_2CHECKOUT_LOGIN_DESCRIPTION', 'Login/Store Number used for the 2CheckOut service');
  define('MODULE_PAYMENT_2CHECKOUT_TESTMODE_DESCRIPTION', 'Transaction mode used for the 2Checkout service');
  define('MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT_DESCRIPTION', 'Should 2CheckOut e-mail a receipt to the store owner?');
  define('MODULE_PAYMENT_2CHECKOUT_SORT_ORDER_DESCRIPTION', 'Sort order of display. Lowest is displayed first.');
  define('MODULE_PAYMENT_2CHECKOUT_ZONE_DESCRIPTION', 'If a zone is selected, only enable this payment method for that zone.');
  define('MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID_DESCRIPTION', 'Set the status of orders made with this payment module to this value');  
?>
