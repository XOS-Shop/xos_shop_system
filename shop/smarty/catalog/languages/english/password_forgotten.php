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

define('NAVBAR_TITLE_1', 'Login');
define('NAVBAR_TITLE_2', 'Password Forgotten');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Error: The E-Mail Address was not found in our records, please try again.');
define('TEXT_SECURITY_CODE_ERROR', 'Error: The entered Security-Code does not agree with the indicated code, please try again.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - New Password');

define('SUCCESS_PASSWORD_SENT', 'Success: A new password has been sent to your e-mail address.');

define('ERROR_ACTION_RECORDER', 'Error: A password reset link has already been sent. Please try again in %s minutes.');
?>
