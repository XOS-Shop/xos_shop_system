<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : psigate.php
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
//              filename: psigate.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_PSIGATE_TEXT_TITLE', 'PSiGate');
  define('MODULE_PAYMENT_PSIGATE_TEXT_DESCRIPTION', 'Kreditkarten Test Info:<br /><br />CC#: 4111111111111111<br />Gültig bis: Any');


  define('MODULE_PAYMENT_PSIGATE_STATUS_TITLE', 'PSiGate-Modul freischalten');
  define('MODULE_PAYMENT_PSIGATE_MERCHANT_ID_TITLE', 'Händler-ID');
  define('MODULE_PAYMENT_PSIGATE_TRANSACTION_MODE_TITLE', 'Transaktionsmodus');
  define('MODULE_PAYMENT_PSIGATE_TRANSACTION_TYPE_TITLE', 'Transaktionstyp');
  define('MODULE_PAYMENT_PSIGATE_INPUT_MODE_TITLE', 'Erfassung der Kreditkartendetails');
  define('MODULE_PAYMENT_PSIGATE_CURRENCY_TITLE', 'Transaktionswährung');
  define('MODULE_PAYMENT_PSIGATE_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
  define('MODULE_PAYMENT_PSIGATE_ZONE_TITLE', 'Zahlungszone');
  define('MODULE_PAYMENT_PSIGATE_ORDER_STATUS_ID_TITLE', 'Bestellstatus');
  
  define('MODULE_PAYMENT_PSIGATE_STATUS_DESCRIPTION', 'Wollen Sie Zahlungen mit diesem Modul zulassen?');
  define('MODULE_PAYMENT_PSIGATE_MERCHANT_ID_DESCRIPTION', 'Händler-ID die beim PSiGate Service gebraucht wird.');
  define('MODULE_PAYMENT_PSIGATE_TRANSACTION_MODE_DESCRIPTION', 'Transaktionsmodus der beim PSiGate Service gebraucht wird.');
  define('MODULE_PAYMENT_PSIGATE_TRANSACTION_TYPE_DESCRIPTION', 'Transaktionstyp der beim PSiGate Service gebraucht wird.');
  define('MODULE_PAYMENT_PSIGATE_INPUT_MODE_DESCRIPTION', 'Sollen die Kreditkartendetails lokal oder bei PSiGate erfasst werden?');
  define('MODULE_PAYMENT_PSIGATE_CURRENCY_DESCRIPTION', 'Währung die bei der Kreditkarten-Transaktion benutzt wird.');
  define('MODULE_PAYMENT_PSIGATE_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
  define('MODULE_PAYMENT_PSIGATE_ZONE_DESCRIPTION', 'Wenn eine Zone ausgewählt ist, wird dieses Zahlungsmodul nur für die ausgewählte Zone angeboten.');
  define('MODULE_PAYMENT_PSIGATE_ORDER_STATUS_ID_DESCRIPTION', 'Bestellungen die mit diesem Modul bezahlt werden auf diesen Bestellstatus setzen.');
?>
