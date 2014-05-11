<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : geo_zones.php
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
//              filename: geo_zones.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_INFO_HEADING_NEW_ZONE', 'Neue Steuerzone');
define('TEXT_INFO_NEW_ZONE_INTRO', 'Bitte geben Sie die neue Steuerzone mit allen relevanten Daten ein');

define('TEXT_INFO_HEADING_EDIT_ZONE', 'Steuerzone bearbeiten');
define('TEXT_INFO_EDIT_ZONE_INTRO', 'Bitte führen Sie alle notwendigen Änderungen durch.');

define('TEXT_INFO_HEADING_DELETE_ZONE', 'Steuerzone löschen');
define('TEXT_INFO_DELETE_ZONE_INTRO', 'Sind Sie sicher, dass Sie diese Steuerzone löschen wollen?');

define('TEXT_INFO_HEADING_NEW_SUB_ZONE', 'Neue Unterzone');
define('TEXT_INFO_NEW_SUB_ZONE_INTRO', 'Bitte geben Sie die neue Unterzone mit allen relevanten Daten ein');

define('TEXT_INFO_HEADING_EDIT_SUB_ZONE', 'Unterzone bearbeiten');
define('TEXT_INFO_EDIT_SUB_ZONE_INTRO', 'Bitte führen Sie alle notwendigen Änderungen durch.');

define('TEXT_INFO_HEADING_DELETE_SUB_ZONE', 'Unterzone löschen');
define('TEXT_INFO_DELETE_SUB_ZONE_INTRO', 'Sind Sie sicher, dass Sie diese Unterzone löschen wollen?');

define('TEXT_INFO_DATE_ADDED', 'hinzugefügt am:');
define('TEXT_INFO_LAST_MODIFIED', 'letzte Änderung:');
define('TEXT_INFO_ZONE_NAME', 'Name der Steuerzone:');
define('TEXT_INFO_NUMBER_ZONES', 'Anzahl der Steuerzonen:');
define('TEXT_INFO_ZONE_DESCRIPTION', 'Beschreibung:');
define('TEXT_INFO_COUNTRY', 'Land:');
define('TEXT_INFO_COUNTRY_ZONE', 'Kanton/Bundesland:');
define('TYPE_BELOW', 'Alle Kantone/Bundesländer');
define('PLEASE_SELECT', 'Alle Kantone/Bundesländer');
define('TEXT_ALL_COUNTRIES', 'Alle Länder');

define('TEXT_INFO_DELETE_NOT_ALLOWED', '<font color="red"><b>Diese Steuerzone kann nicht gelöscht werden.</b><br /><br />Dieser Steuerzone ist ein Steuersatz zugeordnet.</font>');
define('TEXT_INFO_TAX_ZONE_NAME_ERROR', '<font color="red"><b>[%s]</b> existiert bereits, bitte wählen Sie einen anderen Namen für die Steuerzone.</font>');
define('TEXT_INFO_TAX_ZONE_NAME_ERROR_EMPTY', '<font color="red">Der Name für die Steuerzone darf nicht leer sein.</font>');
?>
