<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : ipayment.php
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
//              filename: ipayment.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_IPAYMENT_TEXT_TITLE', 'iPayment');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_DESCRIPTION', 'Tarjeta de Crédito para Pruebas:<br /><br />Numero: 4111111111111111<br />Caducidad: Cualquiera');


  define('MODULE_PAYMENT_IPAYMENT_STATUS_TITLE', 'Enable iPayment Module');
  define('MODULE_PAYMENT_IPAYMENT_ID_TITLE', 'Account Number');
  define('MODULE_PAYMENT_IPAYMENT_USER_ID_TITLE', 'User ID');
  define('MODULE_PAYMENT_IPAYMENT_PASSWORD_TITLE', 'User Password');
  define('MODULE_PAYMENT_IPAYMENT_CURRENCY_TITLE', 'Transaction Currency');
  define('MODULE_PAYMENT_IPAYMENT_SORT_ORDER_TITLE', 'Sort order of display.');
  define('MODULE_PAYMENT_IPAYMENT_ZONE_TITLE', 'Payment Zone');
  define('MODULE_PAYMENT_IPAYMENT_ORDER_STATUS_ID_TITLE', 'Set Order Status');
  
  define('MODULE_PAYMENT_IPAYMENT_STATUS_DESCRIPTION', 'Do you want to accept iPayment payments?');
  define('MODULE_PAYMENT_IPAYMENT_ID_DESCRIPTION', 'The account number used for the iPayment service');
  define('MODULE_PAYMENT_IPAYMENT_USER_ID_DESCRIPTION', 'The user ID for the iPayment service');
  define('MODULE_PAYMENT_IPAYMENT_PASSWORD_DESCRIPTION', 'The user password for the iPayment service');
  define('MODULE_PAYMENT_IPAYMENT_CURRENCY_DESCRIPTION', 'The currency to use for credit card transactions');
  define('MODULE_PAYMENT_IPAYMENT_SORT_ORDER_DESCRIPTION', 'Sort order of display. Lowest is displayed first.');
  define('MODULE_PAYMENT_IPAYMENT_ZONE_DESCRIPTION', 'If a zone is selected, only enable this payment method for that zone.');
  define('MODULE_PAYMENT_IPAYMENT_ORDER_STATUS_ID_DESCRIPTION', 'Set the status of orders made with this payment module to this value');  
?>
