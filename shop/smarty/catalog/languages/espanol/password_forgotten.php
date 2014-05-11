<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : password_forgotten.php
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
//              filename: password_forgotten.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('NAVBAR_TITLE_1', 'Entrar');
define('NAVBAR_TITLE_2', 'Constraseña Olvidada');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Error: Ese E-Mail no figura en nuestros datos, inténtelo de nuevo.');
define('TEXT_SECURITY_CODE_ERROR', 'Error: El código de seguridad que ha introducido es incorrecto, inténtelo de nuevo.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nueva Contraseña');

define('SUCCESS_PASSWORD_SENT', 'Exito: Se ha enviado una nueva contraseña a su e-mail');

define('ERROR_ACTION_RECORDER', 'Error: Ya se ha enviado un enlace de restablecimiento de contraseña. Por favor trate nuevamente en %s minutos.');
?>
