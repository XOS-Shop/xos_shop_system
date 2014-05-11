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

define('NAVBAR_TITLE', 'Tell A Friend');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Your email about <b>%s</b> has been successfully sent to <b>%s</b>.');

define('TEXT_EMAIL_SUBJECT', 'Your friend %s has recommended this great product from %s');

define('ERROR_TO_NAME', 'Error: Your friends name must not be empty.');
define('ERROR_TO_ADDRESS', 'Error: Your friends e-mail address must be a valid e-mail address.');
define('ERROR_TO_ADDRESS_MIN_LENGTH', 'Error: Your friends e-mail address must contain a minimum of ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.');
define('ERROR_FROM_NAME', 'Error: Your name must not be empty.');
define('ERROR_FROM_ADDRESS', 'Error: Your e-mail address must be a valid e-mail address.');
define('ERROR_FROM_ADDRESS_MIN_LENGTH', 'Error: Your e-mail address must contain a minimum of ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.');
define('ERROR_SECURITY_CODE', 'Error: The entered Security-Code does not agree with the indicated code.');
define('ERROR_ACTION_RECORDER', 'Error: An e-mail has already been sent. Please try again in %s minutes.');
?>
