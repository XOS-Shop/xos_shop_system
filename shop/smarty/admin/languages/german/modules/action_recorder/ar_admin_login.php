<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : ar_admin_login.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2014 Hanspeter Zeller
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
//              Copyright (c) 2013 osCommerce
//              filename: ar_admin_login.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('MODULE_ACTION_RECORDER_ADMIN_LOGIN_TITLE', 'Anmeldungen in die Administration');
define('MODULE_ACTION_RECORDER_ADMIN_LOGIN_DESCRIPTION', 'Anmeldungen in die Administration aufzeichnen.');
  
define('MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES_TITLE', 'Zeitsperre');
define('MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS_TITLE', 'Anzahl erlaubter Versuche'); 

define('MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES_DESCRIPTION', 'Zeitraum in Minuten, während dem Anmeldeversuche in die Administration gesperrt werden.');
define('MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS_DESCRIPTION', 'Anzahl der Versuche sich in der Administration anzumelden bis obige Zeitsperre in Kraft tritt.');   
?>
