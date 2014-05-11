<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : newsletter_subscribe.php
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
////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] == 'unsubscribe') {
  define('NAVBAR_TITLE', 'Newsletter abmelden');
} else {
  define('NAVBAR_TITLE', 'Newsletter abonnieren');
}

define('TEXT_SECURITY_CODE_ERROR', 'Der eingegebene Sicherheitscode stimmt nicht mit mit dem angezeigten Code überein - bitte korrigieren.');

define('EMAIL_NEWSLETTER_SUBSCRIBE_SUBJECT', STORE_NAME . ' - Newsletter abonnieren');
define('NEWSLETTER_CONFIRMATION_EMAIL_SENT', 'Eine Bestätigung wurde an die angegebene eMail-Adresse gesandt.');
?>
