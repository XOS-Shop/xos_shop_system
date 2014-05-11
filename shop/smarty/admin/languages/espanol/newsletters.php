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

define('TEXT_NEWSLETTER_DATE_ADDED', 'Añadido el:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Fecha de Envío:');

define('TEXT_INFO_DELETE_INTRO', 'Seguro que quiere eliminar este boletín?');
define('TEXT_TEXT', 'Texto [text/plain]');
define('TEXT_HTML', 'HTML [text/html]');

define('ERROR_NEWSLETTER_TITLE', 'Error: Se requiere un título para el boletín');
define('ERROR_NEWSLETTER_MODULE', 'Error: Se requiere un modulo para el boletin');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Error: Bloquee el boletín antes de eliminarlo.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Error: Bloquee el boletín antes de editarlo.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Error: Bloquee el boletín antes de enviarlo.');

define('ERROR_PHP_MAILER', 'Mailer Error: %s (Email no fue enviado a %s)');
define('ERROR_EMAIL_WAS_NOT_SENT', 'Error: Email(s) no fue enviado.');
define('NOTICE_EMAIL_SENT_TO', 'Aviso: Email enviado a: %s');
?>
