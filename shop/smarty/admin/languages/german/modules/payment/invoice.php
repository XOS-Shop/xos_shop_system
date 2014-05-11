<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : invoice.php
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
//              Copyright (c) 2002 - 2003 osCommerce
//              filename: invoice.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_INVOICE_TEXT_TITLE', 'Rechnung');
  define('MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION', 'Rechnung');

  
  define('MODULE_PAYMENT_INVOICE_STATUS_TITLE', 'Rechnungs-Modul freischalten');
  define('MODULE_PAYMENT_INVOICE_ZONE_TITLE', 'Zahlungszone');
  define('MODULE_PAYMENT_INVOICE_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
  define('MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID_TITLE', 'Bestellstatus');
  define('MODULE_PAYMENT_INVOICE_FROM_ORDER_TITLE', 'Stammkunden');
  define('MODULE_PAYMENT_INVOICE_ENABLED_FOR_DOWNLOADS_TITLE', 'Für Download-Produkte anbieten');
     
  define('MODULE_PAYMENT_INVOICE_STATUS_DESCRIPTION', 'Wollen Sie Zahlungen per Rechnung anbieten?');
  define('MODULE_PAYMENT_INVOICE_ZONE_DESCRIPTION', 'Wenn eine Zone ausgewählt ist, wird dieses Zahlungsmodul nur für die ausgewählte Zone angeboten.');
  define('MODULE_PAYMENT_INVOICE_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
  define('MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID_DESCRIPTION', 'Bestellungen die mit diesem Modul bezahlt werden auf diesen Bestellstatus setzen.');
  define('MODULE_PAYMENT_INVOICE_FROM_ORDER_DESCRIPTION', 'Rechnung ab x-ter Bestellung anbieten.');
  define('MODULE_PAYMENT_INVOICE_ENABLED_FOR_DOWNLOADS_DESCRIPTION', 'Wollen Sie Zahlungen per Rechnung auch dann anbieten, wenn nur Download-Produkte bestellt werden.');
?>
