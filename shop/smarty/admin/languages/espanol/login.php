<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : login.php
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
//              filename: login.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('ADMIN_EMAIL_SUBJECT', 'Nueva Contraseña');
define('ADMIN_EMAIL_TEXT', 'Hola %s,' . "\n\n" . 'Puedes entrar en el area de Admin con la seguiente contraseña. Despues del login, es mejor cambiar tu contraseña!' . "\n\n" . 'Website: %s' . "\n" . 'E-Mail: %s' . "\n" . 'Contraseña: %s' . "\n\n" . 'Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mail automatico, entonces no respondes!');
define('ERROR_ACTION_RECORDER', '<span style="color: #ff0000; font-weight: bold;">Error:</span> Se ha alcanzado el número máximo de intentos de inicio de sesión. Por favor trate nuevamente en %s minutos.');
?>
