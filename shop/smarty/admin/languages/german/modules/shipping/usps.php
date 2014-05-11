<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : usps.php
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
//              filename: usps.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('MODULE_SHIPPING_USPS_TEXT_TITLE', 'United States Postal Service');
define('MODULE_SHIPPING_USPS_TEXT_DESCRIPTION', 'United States Postal Service<br /><br />Sie benötigen einen Account bei USPS unter http://www.uspsprioritymail.com/et_regcert.html um dieses Modul nutzen zu können<br /><br />USPS erwartet, dass Sie <b>lbs</b> als Gewichtseinheit bei Ihren Produkten verwenden.');


define('MODULE_SHIPPING_USPS_STATUS_TITLE', 'Versand mit USPS freischalten');
define('MODULE_SHIPPING_USPS_USERID_TITLE', 'USPS Benutzer-ID');
define('MODULE_SHIPPING_USPS_PASSWORD_TITLE', 'USPS Passwort');
define('MODULE_SHIPPING_USPS_SERVER_TITLE', 'Server auswählen');
define('MODULE_SHIPPING_USPS_HANDLING_TITLE', 'Bearbeitungsgebühr');
define('MODULE_SHIPPING_USPS_TAX_CLASS_TITLE', 'Steuerklasse');
define('MODULE_SHIPPING_USPS_ZONE_TITLE', 'Versandzone');
define('MODULE_SHIPPING_USPS_SORT_ORDER_TITLE', 'Anzeigereihenfolge');

define('MODULE_SHIPPING_USPS_STATUS_DESCRIPTION', 'Wollen Sie USPS (United States Postal Service) anbieten?');
define('MODULE_SHIPPING_USPS_USERID_DESCRIPTION', 'Die von USPS Ihnen zugewiesene Benutzer-ID.');
define('MODULE_SHIPPING_USPS_PASSWORD_DESCRIPTION', 'Das von USPS Ihnen zugewiesene Passwort.');
define('MODULE_SHIPPING_USPS_SERVER_DESCRIPTION', 'Zur Benutzung des Produktions-Servers wird ein Kundenkonto benötigt.');
define('MODULE_SHIPPING_USPS_HANDLING_DESCRIPTION', 'Bearbeitungsgebühr für diese Vesandart.');
define('MODULE_SHIPPING_USPS_TAX_CLASS_DESCRIPTION', 'Folgende Steuerklasse für die Versandkosten anwenden.');
define('MODULE_SHIPPING_USPS_ZONE_DESCRIPTION', 'Wenn eine Zone ausgewählt ist, wird diese Versandart nur für die ausgewählte Zone angeboten.');
define('MODULE_SHIPPING_USPS_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
?>
