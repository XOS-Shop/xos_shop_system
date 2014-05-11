<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : create_account.php
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
//              filename: create_account.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('NAVBAR_TITLE', 'Konto erstellen');

define('EMAIL_SUBJECT', 'Willkommen bei ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr %s,');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau %s,');
define('EMAIL_GREET_NONE', 'Sehr geehrte(r) %s,');

define('EMAIL_SUBJECT_COMPANY_ACCOUNT_CREATED', 'Firmenkundenkonto eröffnet');
define('EMAIL_TEXT_COMPANY_ACCOUNT_CREATED', '%s %s der Firma %s hat ein Kundenkonto eröffnet.');
?>
