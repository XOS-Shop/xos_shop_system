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
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_TYPE', 'Tipo:');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_CREDIT_CARD_OWNER', 'Titular de la Tarjeta:');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_CREDIT_CARD_OWNER_FIRST_NAME', 'Nombre del Titular:');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_CREDIT_CARD_OWNER_LAST_NAME', 'Apellidos del Titular:');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_CREDIT_CARD_NUMBER', 'Número de la Tarjeta:');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_CREDIT_CARD_EXPIRES', 'Fecha de Caducidad:');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_CREDIT_CARD_CHECKNUMBER', 'Número de comprobación:');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '(lo puede encontrar en la parte de atrás de la tarjeta de credito)');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_JS_CC_NUMBER', '* El número de la tarjeta de crédito debe tener al menos ' . CC_NUMBER_MIN_LENGTH . ' caracteres.\n');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_ERROR_MESSAGE', 'Ha ocurrido un error procesando su tarjeta de crédito, por favor inténtelo de nuevo.');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_ERROR', 'Error de Tarjeta de Crédito!');
?>
