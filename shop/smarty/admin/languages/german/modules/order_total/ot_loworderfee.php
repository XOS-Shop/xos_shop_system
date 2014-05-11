<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : ot_loworderfee.php
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
//              filename: ot_loworderfee.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_ORDER_TOTAL_LOWORDERFEE_TITLE', 'Mindermengenzuschlag');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESCRIPTION', 'Zuschlag bei Unterschreitung des Mindestbestellwertes');
  
  
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_TITLE', 'Mindermengenzuschlag anzeigen');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_TITLE', 'Zuschlag für Bestellungen unter');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_TITLE', 'Zuschlag');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_TITLE', 'Zuschlag nach Region anwenden');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_TITLE', 'Steuerklasse');
  
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_DESCRIPTION', 'Wollen Sie den Mindermengenzuschlag anzeigen?');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_DESCRIPTION', 'Der Zuschlag wird für Bestellungen unter diesem Betrag hinzugefügt.');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_DESCRIPTION', 'Zuschlag der hinzugefügt wird (siehe oben).');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_DESCRIPTION', 'Den Zuschlag für folgende Region anwenden.');
  define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_DESCRIPTION', 'Die folgende Steuerklasse für den Mindermengenzuschlag anwenden.');
?>
