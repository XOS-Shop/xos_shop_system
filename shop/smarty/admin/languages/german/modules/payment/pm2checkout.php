<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : pm2checkout.php
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
//              filename: pm2checkout.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_2CHECKOUT_TEXT_TITLE', '2CheckOut');
  define('MODULE_PAYMENT_2CHECKOUT_TEXT_DESCRIPTION', 'Kreditkarten Test Info:<br /><br />CC#: 4111111111111111<br />Gültig bis: Any');


  define('MODULE_PAYMENT_2CHECKOUT_STATUS_TITLE', '2CheckOut-Modul freischalten');
  define('MODULE_PAYMENT_2CHECKOUT_LOGIN_TITLE', 'Login/Shop-Nummer');
  define('MODULE_PAYMENT_2CHECKOUT_TESTMODE_TITLE', 'Transaktionsmodus');
  define('MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT_TITLE', 'Händlerbenachrichtigung');
  define('MODULE_PAYMENT_2CHECKOUT_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
  define('MODULE_PAYMENT_2CHECKOUT_ZONE_TITLE', 'Zahlungszone');
  define('MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID_TITLE', 'Bestellstatus');
  
  define('MODULE_PAYMENT_2CHECKOUT_STATUS_DESCRIPTION', 'Wollen Sie Zahlungen mit diesem Modul zulassen?');
  define('MODULE_PAYMENT_2CHECKOUT_LOGIN_DESCRIPTION', 'Login/Shop-Nummer die beim 2CheckOut Service gebraucht wird.');
  define('MODULE_PAYMENT_2CHECKOUT_TESTMODE_DESCRIPTION', 'Modus der für den 2CheckOut Service verwendet wird.');
  define('MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT_DESCRIPTION', 'Soll 2CheckOut eine eMail als Bestätigung dem Shop-Besitzer senden?');
  define('MODULE_PAYMENT_2CHECKOUT_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
  define('MODULE_PAYMENT_2CHECKOUT_ZONE_DESCRIPTION', 'Wenn eine Zone ausgewählt ist, wird dieses Zahlungsmodul nur für die ausgewählte Zone angeboten.');
  define('MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID_DESCRIPTION', 'Bestellungen die mit diesem Modul bezahlt werden auf diesen Bestellstatus setzen.');  
?>
