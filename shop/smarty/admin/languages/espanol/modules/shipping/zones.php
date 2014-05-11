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

define('MODULE_SHIPPING_ZONES_TEXT_TITLE', 'Tarifa por Zona');
define('MODULE_SHIPPING_ZONES_TEXT_DESCRIPTION', 'Tarifa basada en Zonas');


define('MODULE_SHIPPING_ZONES_STATUS_TITLE', 'Enable Zones Method');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_TITLE', 'Tax Class');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_TITLE', 'Sort Order');

define('MODULE_SHIPPING_ZONES_STATUS_DESCRIPTION', 'Do you want to offer zone rate shipping?');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_DESCRIPTION', 'Use the following tax class on the shipping fee.');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_DESCRIPTION', 'Sort order of display.');

$zones = new zones;
for ($i=1;$i<=$zones->num_zones;$i++) {
  define("MODULE_SHIPPING_ZONES_COUNTRIES_" . $i ."_TITLE", "Zone " . $i ." Countries");
  define("MODULE_SHIPPING_ZONES_COST_" . $i ."_TITLE", "Zone " . $i ." Shipping Table");
  define("MODULE_SHIPPING_ZONES_HANDLING_" . $i ."_TITLE", "Zone " . $i ." Handling Fee");

  define("MODULE_SHIPPING_ZONES_COUNTRIES_" . $i ."_DESCRIPTION", "Comma separated list of two character ISO country codes that are part of Zone " . $i . ".");
  define("MODULE_SHIPPING_ZONES_COST_" . $i ."_DESCRIPTION", "Shipping rates to Zone " . $i . " destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone " . $i . " destinations.");
  define("MODULE_SHIPPING_ZONES_HANDLING_" . $i ."_DESCRIPTION", "Handling Fee for this shipping zone");
}
?>
