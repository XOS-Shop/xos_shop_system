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

define('NAVBAR_TITLE', 'Produkt weiterempfehlen');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Ihre eMail über <b>%s</b> wurde gesendet an <b>%s</b>.');

define('TEXT_EMAIL_SUBJECT', 'Ihr Freund %s, hat dieses Produkt gefunden, und zwar hier: %s');

define('ERROR_TO_NAME', 'Fehler: Der Empfängername darf nicht leer sein.');
define('ERROR_TO_ADDRESS', 'Fehler: Die Empfängeradresse muss eine gültige Mail-Adresse sein.');
define('ERROR_TO_ADDRESS_MIN_LENGTH', 'Fehler: Die Empfängeradresse sollte mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('ERROR_FROM_NAME', 'Fehler: Der Absendername (Ihr Name) muss angegeben werden.');
define('ERROR_FROM_ADDRESS', 'Fehler: Die Absenderadresse muss eine gültige Mail-Adresse sein.');
define('ERROR_FROM_ADDRESS_MIN_LENGTH', 'Fehler: Die Absenderadresse sollte mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('ERROR_SECURITY_CODE', 'Fehler: Der eingegebene Sicherheitscode stimmt nicht mit mit dem angezeigten Code überein.');
define('ERROR_ACTION_RECORDER', 'Fehler: Eine E-Mail wurde bereits gesendet. Bitte versuchen Sie es erneut in %s Minuten.');
?>
