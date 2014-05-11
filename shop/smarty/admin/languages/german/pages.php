<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : pages.php
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
//              filename: categories.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TABLE_HEADING_ID', 'ID');

define('TEXT_NEW_PAGE_1', 'Neue Seite');
define('TEXT_NEW_PAGE_2', 'Seite');
define('TEXT_NEW_PAGE_3', '%s bearbeiten in "%s"');
define('TEXT_PAGES', 'Seiten:');
define('TEXT_SUBPAGES', 'Unterseiten:');

define('TEXT_DATE_ADDED', 'hinzugefügt am:');
define('TEXT_DATE_AVAILABLE', 'Erscheinungsdatum:');
define('TEXT_LAST_MODIFIED', 'letzte Änderung:');
define('TEXT_NO_CHILD_PAGES', 'Bitte fügen Sie eine neue Seite ein.');

define('TEXT_INFO_CURRENT_PAGES', 'aktuelle Seiten:');

define('TEXT_INFO_HEADING_DELETE_PAGE', 'Seite löschen');
define('TEXT_INFO_HEADING_MOVE_PAGE', 'Seite verschieben');

define('TEXT_DELETE_PAGE_INTRO', 'Sind Sie sicher, dass Sie diese Seite löschen möchten?');

define('TEXT_DELETE_WARNING_CHILDREN', '<b>WARNUNG:</b> Es existieren noch %s (Unter-)Seiten, die mit dieser Kategorie verbunden sind!');

define('TEXT_MOVE_PAGES_INTRO', 'Bitte wählen Sie die übergordnete Seite, in die Sie <b>%s</b> verschieben möchten');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');

define('EMPTY_PAGE', 'Keine Seite');

define('ERROR_CANNOT_MOVE_PAGE_TO_PARENT', 'Error: Seite kann nicht in eine eigene Unterseite verschoben werden.');
define('ERROR_PAGE_NAME', 'Fehler: Ein Name für diese Seite ist erforderlich.');
define('TEXT_EDIT_STATUS', 'Status');
?>
