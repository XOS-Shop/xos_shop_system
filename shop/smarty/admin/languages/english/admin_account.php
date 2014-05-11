<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : admin_account.php
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
//              filename: admin_account.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_INFO_ERROR_EMAIL_USED', 'E-Mail Address has already been used! Please try again.');
define('TEXT_INFO_ERROR_EMAIL_NOT_VALID', 'E-Mail Address does not appear to be valid - please make any necessary corrections.');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Hidden-');

define('TEXT_INFO_HEADING_DEFAULT', 'Edit Account ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Password Confirmation ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Password:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>ERROR:</b> wrong password!</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Click <b>edit button</b> below to change your account.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br /><b>WARNING:</b><br />Hello <b>%s</b>, you just come here for the first time. We recommend you to change your password!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br /><b>WARNING:</b><br />Hello <b>%s</b>, we recommend you to change your email (<font color="red">admin@localhost</font>) and password!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'All fields are required. Click save to submit.');

define('JS_ALERT_FIRSTNAME',        '- Required: Firstname \n');
define('JS_ALERT_LASTNAME',         '- Required: Lastname \n');
define('JS_ALERT_EMAIL',            '- Required: E-Mail Address \n');
define('JS_ALERT_PASSWORD',         '- Required: Password \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Your First Name must contain a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.');
define('JS_ALERT_LASTNAME_LENGTH',  '- Your Last Name must contain a minimum of ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.');
define('JS_ALERT_PASSWORD_LENGTH',  '- Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('JS_ALERT_EMAIL_LENGTH',     '- Your E-Mail Address must contain a minimum of ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters');
define('JS_ALERT_PASSWORD_CONFIRM', '- Miss typing in Password Confirmation field! \n');

define('ADMIN_EMAIL_SUBJECT', 'Personal Information Change');
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'Your personal information, perhaps including your password, has been changed.  If this was done without your knowledge or consent please contact the administrator immediatly!' . "\n\n" . 'Website: %s' . "\n" . 'E-Mail Address: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!');
?>
