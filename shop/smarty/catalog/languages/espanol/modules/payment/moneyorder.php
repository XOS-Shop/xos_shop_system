<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : moneyorder.php
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
//              filename: moneyorder.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Cheque/Transferencia Bancaria');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Pagadero a:<br />' . nl2br(MODULE_PAYMENT_MONEYORDER_PAYTO) . '<br /><br />Enviar a:<br />' . nl2br(STORE_NAME_ADDRESS) . '<br /><br />' . 'Su pedido se enviará en cuanto se reciba el pago.');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', "Pagadero a:\n". MODULE_PAYMENT_MONEYORDER_PAYTO . "\n\nEnviar a:\n" . STORE_NAME_ADDRESS . "\n\n" . 'Su pedido se enviará en cuanto se reciba el pago.');
?>
