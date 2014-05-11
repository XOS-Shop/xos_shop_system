<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : secpay.php
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
//              filename: secpay.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_SECPAY_TEXT_TITLE', 'SECPay');
  define('MODULE_PAYMENT_SECPAY_TEXT_DESCRIPTION', 'Tarjeta de Crédito para Pruebas:<br /><br />Numero: 4444333322221111<br />Caducidad Cualquiera');
  
  
  define('MODULE_PAYMENT_SECPAY_STATUS_TITLE', 'Enable SECpay Module');
  define('MODULE_PAYMENT_SECPAY_MERCHANT_ID_TITLE', 'Merchant ID');
  define('MODULE_PAYMENT_SECPAY_CURRENCY_TITLE', 'Transaction Currency');
  define('MODULE_PAYMENT_SECPAY_TEST_STATUS_TITLE', 'Transaction Mode');
  define('MODULE_PAYMENT_SECPAY_SORT_ORDER_TITLE', 'Sort order of display.');
  define('MODULE_PAYMENT_SECPAY_ZONE_TITLE', 'Payment Zone');
  define('MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID_TITLE', 'Set Order Status');
  
  define('MODULE_PAYMENT_SECPAY_STATUS_DESCRIPTION', 'Do you want to accept SECPay payments?');
  define('MODULE_PAYMENT_SECPAY_MERCHANT_ID_DESCRIPTION', 'Merchant ID to use for the SECPay service');
  define('MODULE_PAYMENT_SECPAY_CURRENCY_DESCRIPTION', 'The currency to use for credit card transactions');
  define('MODULE_PAYMENT_SECPAY_TEST_STATUS_DESCRIPTION', 'Transaction mode to use for the SECPay service');
  define('MODULE_PAYMENT_SECPAY_SORT_ORDER_DESCRIPTION', 'Sort order of display. Lowest is displayed first.');
  define('MODULE_PAYMENT_SECPAY_ZONE_DESCRIPTION', 'If a zone is selected, only enable this payment method for that zone.');
  define('MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID_DESCRIPTION', 'Set the status of orders made with this payment module to this value');  
?>
