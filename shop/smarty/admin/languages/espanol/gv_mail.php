<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : gv_mail.php
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
//              filename: gv_mail.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_SELECT_CUSTOMER', 'Seleccionar Cliente');
define('TEXT_ALL_CUSTOMERS', 'Todos los Clientes');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Todos los Suscritos');

define('NOTICE_EMAIL_SENT_TO', 'Aviso: Email enviado a: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Error: No ha seleccionado ningun cliente.');
define('ERROR_NO_AMOUNT_SELECTED', 'Error: No ha seleccionado ningun cantidad.');
define('ERROR_AMOUNT_MUST_BE_A_NUMBER', 'Error: La cantidad debe ser un número.');
define('ERROR_PHP_MAILER', 'Mailer Error: %s (Email no fue enviado a %s)');

define('TEXT_SINGLE_EMAIL', '&nbsp;<span class="smallText">Use this for sending single emails, otherwise use dropdown above</span>');
?>
