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

define('NAVBAR_TITLE_1', 'Anmelden');
define('NAVBAR_TITLE_2', 'Passwort vergessen');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Fehler: Die eingegebene eMail-Adresse ist nicht registriert. Bitte versuchen Sie es noch einmal.');
define('TEXT_SECURITY_CODE_ERROR', 'Fehler: Der eingegebene Sicherheitscode stimmt nicht mit mit dem angezeigten Code überein. Bitte versuchen Sie es noch einmal.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Ihr neues Passwort.');

define('SUCCESS_PASSWORD_SENT', 'Erfolg: Ein neues Passwort wurde per eMail verschickt.');

define('ERROR_ACTION_RECORDER', 'Fehler: Ein Passwort-Reset-Link wurde bereits gesendet. Bitte versuchen Sie es erneut in %s Minuten.');
?>
