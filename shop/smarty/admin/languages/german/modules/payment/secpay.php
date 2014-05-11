<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : secpay.php
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
//              filename: secpay.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_SECPAY_TEXT_TITLE', 'SECPay');
  define('MODULE_PAYMENT_SECPAY_TEXT_DESCRIPTION', 'Kreditkarten Test Info:<br /><br />CC#: 4444333322221111<br />Gültig bis: Any');
  
  
  define('MODULE_PAYMENT_SECPAY_STATUS_TITLE', 'SECPay-Modul freischalten');
  define('MODULE_PAYMENT_SECPAY_MERCHANT_ID_TITLE', 'Händler-ID');
  define('MODULE_PAYMENT_SECPAY_CURRENCY_TITLE', 'Transaktionswährung');
  define('MODULE_PAYMENT_SECPAY_TEST_STATUS_TITLE', 'Transaktionsmodus');
  define('MODULE_PAYMENT_SECPAY_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
  define('MODULE_PAYMENT_SECPAY_ZONE_TITLE', 'Zahlungszone');
  define('MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID_TITLE', 'Bestellstatus');
  
  define('MODULE_PAYMENT_SECPAY_STATUS_DESCRIPTION', 'Wollen Sie Zahlungen mit diesem Modul zulassen?');
  define('MODULE_PAYMENT_SECPAY_MERCHANT_ID_DESCRIPTION', 'Händler-ID die beim SECPay Service gebraucht wird.');
  define('MODULE_PAYMENT_SECPAY_CURRENCY_DESCRIPTION', 'Währung die bei der Kreditkarten-Transaktion benutzt wird.');
  define('MODULE_PAYMENT_SECPAY_TEST_STATUS_DESCRIPTION', 'Transaktionsmodus der beim SECPay Service gebraucht wird.');
  define('MODULE_PAYMENT_SECPAY_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
  define('MODULE_PAYMENT_SECPAY_ZONE_DESCRIPTION', 'Wenn eine Zone ausgewählt ist, wird dieses Zahlungsmodul nur für die ausgewählte Zone angeboten.');
  define('MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID_DESCRIPTION', 'Bestellungen die mit diesem Modul bezahlt werden auf diesen Bestellstatus setzen.');
?>
