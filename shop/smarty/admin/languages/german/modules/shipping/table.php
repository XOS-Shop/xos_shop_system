<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : table.php
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
//              filename: table.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('MODULE_SHIPPING_TABLE_TEXT_TITLE', 'Tabellarische Versandkosten');
define('MODULE_SHIPPING_TABLE_TEXT_DESCRIPTION', 'Tabellarische Versandkosten');


define('MODULE_SHIPPING_TABLE_STATUS_TITLE', 'Tabellarische Versandkosten freischalten');
define('MODULE_SHIPPING_TABLE_COST_TITLE', 'Versandkosten Tabelle');
define('MODULE_SHIPPING_TABLE_MODE_TITLE', 'Versandkostenmethode');
define('MODULE_SHIPPING_TABLE_HANDLING_TITLE', 'Bearbeitungsgebühr');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_TITLE', 'Steuerklasse');
define('MODULE_SHIPPING_TABLE_ZONE_TITLE', 'Versandzone');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_TITLE', 'Anzeigereihenfolge');

define('MODULE_SHIPPING_TABLE_STATUS_DESCRIPTION', 'Wollen Sie Tabellarische Versandkosten anbieten?');
define('MODULE_SHIPPING_TABLE_COST_DESCRIPTION', 'Die Versandkosten basieren auf dem Gesamtpreis  oder dem Gesamtgewicht der Bestellung. Beispiel: 25:5.50,50:8.50,etc.. Bis 25 werden 5.50 darüber bis 50 werden 8.50 verrechnet, etc.');
define('MODULE_SHIPPING_TABLE_MODE_DESCRIPTION', 'Die Versandkosten basieren auf dem Gesamtpreis oder  dem Gesamtgewicht der Bestellung.');
define('MODULE_SHIPPING_TABLE_HANDLING_DESCRIPTION', 'Bearbeitungsgebühr für diese Vesandart.');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_DESCRIPTION', 'Folgende Steuerklasse für die Versandkosten anwenden.');
define('MODULE_SHIPPING_TABLE_ZONE_DESCRIPTION', 'Wenn eine Zone ausgewählt ist, wird diese Versandart nur für die ausgewählte Zone angeboten.');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
?>
