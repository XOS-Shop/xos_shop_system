<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : authorizenet.php
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
//              filename: authorizenet.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TITLE', 'Authorize.net');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', 'Kreditkarten Test Info:<br /><br />CC#: 4111111111111111<br />Gültig bis: Any');


  define('MODULE_PAYMENT_AUTHORIZENET_STATUS_TITLE', 'Authorize.net Modul freischalten');
  define('MODULE_PAYMENT_AUTHORIZENET_LOGIN_TITLE', 'Login Benutzername');
  define('MODULE_PAYMENT_AUTHORIZENET_TXNKEY_TITLE', 'Transaktionsschlüssel');
  define('MODULE_PAYMENT_AUTHORIZENET_TESTMODE_TITLE', 'Transaktionsmodus');
  define('MODULE_PAYMENT_AUTHORIZENET_METHOD_TITLE', 'Transaktionsmethode');
  define('MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER_TITLE', 'Kundenbenachrichtigung');
  define('MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
  define('MODULE_PAYMENT_AUTHORIZENET_ZONE_TITLE', 'Zahlungszone');
  define('MODULE_PAYMENT_AUTHORIZENET_ORDER_STATUS_ID_TITLE', 'Bestellstatus');
  
  define('MODULE_PAYMENT_AUTHORIZENET_STATUS_DESCRIPTION', 'Wollen Sie Zahlungen mit diesem Modul zulassen?');
  define('MODULE_PAYMENT_AUTHORIZENET_LOGIN_DESCRIPTION', 'Benutzername der zur Anmeldung beim Authorize.net Service gebraucht wird.');
  define('MODULE_PAYMENT_AUTHORIZENET_TXNKEY_DESCRIPTION', 'Schlüssel der zur Verschlüsselung von TP Daten gebraucht wird.');
  define('MODULE_PAYMENT_AUTHORIZENET_TESTMODE_DESCRIPTION', 'Modus der für dieses Modul verwendet wird.');
  define('MODULE_PAYMENT_AUTHORIZENET_METHOD_DESCRIPTION', 'Methode die für diese Zahlungsmethode verwendet wird.');
  define('MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER_DESCRIPTION', 'Soll Authorize.net eine eMail als Bestätigung dem Kunden senden?');
  define('MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
  define('MODULE_PAYMENT_AUTHORIZENET_ZONE_DESCRIPTION', 'Wenn eine Zone ausgewählt ist, wird dieses Zahlungsmodul nur für die ausgewählte Zone angeboten.');
  define('MODULE_PAYMENT_AUTHORIZENET_ORDER_STATUS_ID_DESCRIPTION', 'Bestellungen die mit diesem Modul bezahlt werden auf diesen Bestellstatus setzen.');  
?>
