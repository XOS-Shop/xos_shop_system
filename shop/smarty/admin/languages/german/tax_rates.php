<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : tax_rates.php
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
//              filename: tax_rates.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_INFO_EDIT_INTRO', 'Bitte führen Sie alle notwendigen Änderungen durch');
define('TEXT_INFO_DATE_ADDED', 'hinzugefügt am:');
define('TEXT_INFO_LAST_MODIFIED', 'letzte Änderung:');
define('TEXT_INFO_CLASS_TITLE', 'Name der Steuerklasse:');
define('TEXT_INFO_COUNTRY_NAME', 'Land:');
define('TEXT_INFO_ZONE_NAME', 'Steuerzone:');
define('TEXT_INFO_TAX_RATE', 'Steuersatz (%):');
define('TEXT_INFO_TAX_RATE_PRIORITY', 'Steuersätze der gleichen Priorität werden addiert, andere gemischt.<br /><br />Priorität:');
define('TEXT_INFO_RATE_DESCRIPTION', 'Beschreibung:');
define('TEXT_INFO_INSERT_INTRO', 'Bitte geben Sie den neuen Steuersatz mit allen relevanten Daten ein');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diesen Steuersatz löschen möchten?');
define('TEXT_INFO_HEADING_NEW_TAX_RATE', 'Neuer Steuersatz');
define('TEXT_INFO_HEADING_EDIT_TAX_RATE', 'Steuersatz bearbeiten');
define('TEXT_INFO_HEADING_DELETE_TAX_RATE', 'Steuersatz löschen');
define('TEXT_INFO_NO_TAX_CLASS_AND_OR_NO_TAX_ZONE_DEFINED', '<span style="color: #ff0000;"><b>Es wurde noch keine Steuerzone und/oder keine Steuerklasse definiert.</b></span>');
define('TEXT_INFO_DELETE_NOT_ALLOWED', '<span style="color: #ff0000;"><b>Dieser Steuersatz kann nicht gelöscht werden.</b><br /><br />Dieser Steuersatz verwendet eine Steuerklasse der Produkte zugeordnet sind.</span>');
define('TEXT_INFO_DESCRIPTION_ERROR', '<span style="color: #ff0000;"><b>[%s]</b> existiert bereits, bitte wählen Sie eine andere Beschreibung für den Steuersatz.</span>');
define('TEXT_INFO_DESCRIPTION_ERROR_EMPTY', '<span style="color: #ff0000;"><b>[%s]</b> Die Beschreibung für den Steuersatz darf nicht leer sein.</span>');
define('TEXT_INFO_DESCRIPTION_ERROR_MARK', '**');
define('TEXT_INFO_DESCRIPTION_ERROR_EMPTY_MARK', '*');
?>
