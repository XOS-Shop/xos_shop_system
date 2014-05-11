<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : advanced_search_and_results.php
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
//              Copyright (c) 2003 osCommerce
//              filename: advanced_search.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('NAVBAR_TITLE_1', 'Erweiterte Suche');
define('NAVBAR_TITLE_2', 'Suchergebnisse');

define('TEXT_ALL_CATEGORIES', 'Alle Kategorien');
define('TEXT_ALL_MANUFACTURERS', 'Alle Hersteller');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Artikel-Nr.');
define('TABLE_HEADING_PRODUCTS', 'Produkt-Name');
define('TABLE_HEADING_INFO', 'Kurzbeschreibung');
define('TABLE_HEADING_PACKING_UNIT', 'Einheit (VPE)');
define('TABLE_HEADING_MANUFACTURER', 'Hersteller');
define('TABLE_HEADING_QUANTITY', 'An&nbsp;Lager');
define('TABLE_HEADING_PRICE', 'Preis');
define('TABLE_HEADING_WEIGHT', 'Gewicht');
define('TABLE_HEADING_BUY_NOW', 'Bestellen');

define('TEXT_NO_PRODUCTS', 'Es wurden keine Artikel gefunden, die den Suchkriterien entsprechen.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Wenigstens ein Feld des Suchformulars muss ausgefüllt werden.');
define('ERROR_INVALID_FROM_DATE', 'Unzulässiges von Datum');
define('ERROR_INVALID_TO_DATE', 'Unzulässiges bis jetzt Datum');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'Das Datum bis muss grösser oder gleich dem von Datum sein');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Preis ab muss eine Zahl sein');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Preis bis muss eine Zahl sein');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Preis bis muss grösser als Preis ab sein.');
define('ERROR_INVALID_KEYWORDS', 'Suchbegriff unzulässig');
?>
