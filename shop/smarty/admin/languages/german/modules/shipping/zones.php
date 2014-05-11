<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : zones.php
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
//              filename: zones.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('MODULE_SHIPPING_ZONES_TEXT_TITLE', 'Versandkosten nach Zonen');
define('MODULE_SHIPPING_ZONES_TEXT_DESCRIPTION', 'Versandkosten Zonenbasierend');


define('MODULE_SHIPPING_ZONES_STATUS_TITLE', 'Versandkosten nach Zonen freischalten');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_TITLE', 'Steuerklasse');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_TITLE', 'Anzeigereihenfolge');

define('MODULE_SHIPPING_ZONES_STATUS_DESCRIPTION', 'Wollen Sie Versandkosten nach Zonen anbieten?');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_DESCRIPTION', 'Folgende Steuerklasse für die Versandkosten anwenden.');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');

$zones = new zones;
for ($i=1;$i<=$zones->num_zones;$i++) {
  define("MODULE_SHIPPING_ZONES_COUNTRIES_" . $i ."_TITLE", "Zone " . $i ." Länder");
  define("MODULE_SHIPPING_ZONES_COST_" . $i ."_TITLE", "Zone " . $i ." Versandkosten Tabelle");
  define("MODULE_SHIPPING_ZONES_HANDLING_" . $i ."_TITLE", "Zone " . $i ." Bearbeitungsgebühr");

  define("MODULE_SHIPPING_ZONES_COUNTRIES_" . $i ."_DESCRIPTION", "Komma separierte Liste von zwei Buchstabe (ISO-Ländercode), die Teile der Zone " . $i . " sind. Beispiel: CH,DE,AT, etc.");
  define("MODULE_SHIPPING_ZONES_COST_" . $i ."_DESCRIPTION", "Versandkosten nach Zone " . $i . ", basierend auf dem Gesamtgewicht. Beispiel: 3:8.50,7:10.50,... Gesamtgewicht kleiner oder gleich 3 würde 8.50 für die Zone " . $i . " kosten.");
  define("MODULE_SHIPPING_ZONES_HANDLING_" . $i ."_DESCRIPTION", "Bearbeitungsgebühr für diese Vesandzone.");
}
?>
