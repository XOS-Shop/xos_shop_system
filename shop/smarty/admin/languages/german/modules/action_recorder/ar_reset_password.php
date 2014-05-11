<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : ar_reset_password.php
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
//              filename: ar_reset_password.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('MODULE_ACTION_RECORDER_RESET_PASSWORD_TITLE', 'Kunden-Passwort zurücksetzen');
define('MODULE_ACTION_RECORDER_RESET_PASSWORD_DESCRIPTION', 'Aufzeichnen wenn Kunden ihr Passwort zurücksetzen.');
  
define('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES_TITLE', 'Zeitsperre');
define('MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS_TITLE', 'Anzahl erlaubter Passwort Rücksetzungen'); 

define('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES_DESCRIPTION', 'Zeitraum in Minuten, während dem das Passwort nicht zurückgesetzt werden kann.');
define('MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS_DESCRIPTION', 'Anzahl erlaubter Passwort Rücksetzungen bis obige Zeitsperre in Kraft tritt.'); 
?>
