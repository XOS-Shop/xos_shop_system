<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : cc.php
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
//              filename: cc.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_CC_TEXT_PUBLIC_TITLE', 'Tarjeta de Crédito');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_TYPE', 'Tipo de Tarjeta:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER', 'Titular de la Tarjeta:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER', 'Número de la Tarjeta:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES', 'Fecha de Caducidad:');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER', '* El titular de la tarjeta de crédito debe de tener al menos ' . CC_OWNER_MIN_LENGTH . ' letras.\n');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER', '* El número de la tarjeta de crédito debe de tener al menos ' . CC_NUMBER_MIN_LENGTH . ' numeros.\n'); 
  define('MODULE_PAYMENT_CC_TEXT_ERROR', 'Error en Tarjeta de Crédito!');
?>
