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

define('TEXT_INFO_ERROR_EMAIL_USED', 'Die eMail Adresse ist bereits vergeben! Bitte erneut versuchen!');
define('TEXT_INFO_ERROR_EMAIL_NOT_VALID', 'Die eMail Adresse scheint nicht gültig zu sein - bitte korrigieren.');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Versteckt-');

define('TEXT_INFO_HEADING_DEFAULT', 'Konto bearbeiten ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Kennwort-Bestätigung ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Kennwort:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>FEHLER:</b> falsches Kennwort!</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Klicken Sie auf <b><i>Bearbeiten</i></b>, um Ihre Kontoinformationen zu ändern.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br /><b>Warnung:</b><br />Hallo <b>%s</b>, Dies ist Ihr erster Besuch, wir empfehlen dringend eine Änderung des Kennworts!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br /><b>WARNUNG:</b><br />Hallo <b>%s</b>, Wir empfehlen eine Änderung Ihrer Email von <font color="red">admin@localhost</font> und Ihres Kennworts!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Alle Felder müssen ausgefüllt werden.');

define('JS_ALERT_FIRSTNAME',        '- Erforderlich: Vorname \n');
define('JS_ALERT_LASTNAME',         '- Erforderlich: Nachname \n');
define('JS_ALERT_EMAIL',            '- Erforderlich: eMail Adresse \n');
define('JS_ALERT_PASSWORD',         '- Erforderlich: Kennwort \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Der Vorname sollte mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('JS_ALERT_LASTNAME_LENGTH',  '- Der Nachname sollte mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('JS_ALERT_PASSWORD_LENGTH',  '- Das Kennwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('JS_ALERT_EMAIL_LENGTH',     '- Die eMail Adresse sollte mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('JS_ALERT_PASSWORD_CONFIRM', '- Kennworte sind unterschiedlich, bitte noch einmal eingeben! \n');

define('ADMIN_EMAIL_SUBJECT', 'Persönliche Informationen wurden bearbeitet');
define('ADMIN_EMAIL_TEXT', 'Hallo %s,' . "\n\n" . 'Ihre persönlichen Informationen, möglicherweise auch Ihr Kennwort, sind geändert worden. Wenn dies ohne Ihr Wissen oder Ihre Zustimmung geschehen ist, treten Sie mit dem Administrator schnellstens in Verbindung!' . "\n\n" . 'Website: %s' . "\n" . 'Email-Adresse: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Dies ist eine automatische Nachricht, bitte antworten Sie nicht!');
?>
