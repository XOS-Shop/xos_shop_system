<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : tell_a_friend.php
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
//              Copyright (c) 2003 osCommerce
//              filename: tell_a_friend.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('NAVBAR_TITLE', 'Enviar a un Amigo');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Tu email sobre <b>%s</b> ha sido enviado con éxito a <b>%s</b>.');

define('TEXT_EMAIL_SUBJECT', 'Tu amigo %s te quiere recomendar "%s"');

define('ERROR_TO_NAME', 'Error: La dirección de su amigo no puede estar vacia.');
define('ERROR_TO_ADDRESS', 'Error: La dirección de su amigo debe ser válida.');
define('ERROR_TO_ADDRESS_MIN_LENGTH', 'Error: La dirección de su amigo debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.');
define('ERROR_FROM_NAME', 'Error: Su nombre no debe estar vacio.');
define('ERROR_FROM_ADDRESS', 'Error: Su dirección de email debe de ser válida.');
define('ERROR_FROM_ADDRESS_MIN_LENGTH', 'Error: Su dirección de email debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras');
define('ERROR_SECURITY_CODE', 'Error: El código de seguridad que ha introducido es incorrecto.');
define('ERROR_ACTION_RECORDER', 'Error: Ya se ha enviado un correo electrónico. Por favor trate nuevamente en %s minutos.');
?>
