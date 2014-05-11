<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : moneyorder.php
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
//              filename: moneyorder.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Scheck/Vorkasse');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Zahlbar an:<br />' . (defined('MODULE_PAYMENT_MONEYORDER_PAYTO') ? nl2br(MODULE_PAYMENT_MONEYORDER_PAYTO) : '') . '<br /><br />Adressat:<br />' . nl2br(STORE_NAME_ADDRESS) . '<br /><br />' . 'Ihre Bestellung wird nicht versandt, bis wir das Geld erhalten haben!');
  
   
  define('MODULE_PAYMENT_MONEYORDER_STATUS_TITLE', 'Scheck/Vorkasse-Modul freischalten');
  define('MODULE_PAYMENT_MONEYORDER_PAYTO_TITLE', 'Zahlbar an:');
  define('MODULE_PAYMENT_MONEYORDER_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
  define('MODULE_PAYMENT_MONEYORDER_ZONE_TITLE', 'Zahlungszone');
  define('MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID_TITLE', 'Bestellstatus');
  
  define('MODULE_PAYMENT_MONEYORDER_STATUS_DESCRIPTION', 'Wollen Sie Zahlungen mit diesem Modul zulassen?');
  define('MODULE_PAYMENT_MONEYORDER_PAYTO_DESCRIPTION', 'An wen sollen Zahlungen geleistet werden?');
  define('MODULE_PAYMENT_MONEYORDER_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
  define('MODULE_PAYMENT_MONEYORDER_ZONE_DESCRIPTION', 'Wenn eine Zone ausgewählt ist, wird dieses Zahlungsmodul nur für die ausgewählte Zone angeboten.');
  define('MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID_DESCRIPTION', 'Bestellungen die mit diesem Modul bezahlt werden auf diesen Bestellstatus setzen.');  
?>
