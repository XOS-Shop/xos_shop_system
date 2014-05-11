<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : newsletters.php
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
//              filename: newsletters.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_NEWSLETTER_DATE_ADDED', 'hinzugefügt am:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Datum gesendet:');

define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie dieses Rundschreiben löschen möchten?');
define('TEXT_TEXT', 'Text [text/plain]');
define('TEXT_HTML', 'HTML [text/html]');

define('ERROR_NEWSLETTER_TITLE', 'Fehler: Ein Titel für das Rundschreiben ist erforderlich.');
define('ERROR_NEWSLETTER_MODULE', 'Fehler: Das Newsletter Modul wird benötigt.');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Fehler: Bitte sperren Sie das Rundschreiben bevor Sie es löschen.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Fehler: Bitte sperren Sie das Rundschreiben bevor Sie es bearbeiten.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Fehler: Bitte sperren Sie das Rundschreiben bevor Sie es versenden.');

define('ERROR_PHP_MAILER', 'Mailer Fehler: %s (eMail wurde nicht gesendet an %s)');
define('ERROR_EMAIL_WAS_NOT_SENT', 'Fehler: eMail(s) wurde(n) nicht gesendet.');
define('NOTICE_EMAIL_SENT_TO', 'Hinweis: eMail wurde versendet an: %s');
?>
