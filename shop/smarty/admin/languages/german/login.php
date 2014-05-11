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

define('ADMIN_EMAIL_SUBJECT', 'Neues Kennwort');
define('ADMIN_EMAIL_TEXT', 'Hallo %s,' . "\n\n" . 'Das Administrator-Pannel kann mit dem folgenden Kennwort geöffnet werden. Bitte Kennwort sofort ändern!' . "\n\n" . 'Website: %s' . "\n" . 'Email-Adresse: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Das ist eine automatische Nachricht!, bitte nicht antworten.');
define('ERROR_ACTION_RECORDER', '<span style="color: #ff0000; font-weight: bold;">Fehler:</span> Die maximale Anzahl von Anmeldeversuchen wurde erreicht. Bitte versuchen Sie es erneut in %s Minuten.');
?>
