<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : delivery_times.php
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
//              filename: orders_status.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_INFO_EDIT_INTRO', 'Bitte führen Sie alle notwendigen Änderungen durch');
define('TEXT_INFO_DELIVERY_TIMES_TEXT', 'Lieferzeit:');
define('TEXT_INFO_POPUP_CONTENT_ID', 'Popup-Content ID:');
define('TEXT_INFO_INSERT_INTRO', 'Bitte geben Sie die neue Lieferzeit mit allen relevanten Daten ein');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Lieferzeit löschen möchten?');
define('TEXT_INFO_HEADING_NEW_DELIVERY_TIME', 'Neue Lieferzeit');
define('TEXT_INFO_HEADING_EDIT_DELIVERY_TIME', 'Lieferzeit bearbeiten');
define('TEXT_INFO_HEADING_DELETE_DELIVERY_TIME', 'Lieferzeit löschen');

define('ERROR_REMOVE_DEFAULT_DELIVERY_TIME', 'Fehler: Die Standard-Lieferzeit kann nicht gelöscht werden. Bitte definieren Sie eine neue Standard-Lieferzeit und wiederholen Sie den Vorgang.');
define('ERROR_DELIVERY_TIME_USED_IN_PRODUCTS', 'Fehler: Diese Lieferzeit wird zurzeit noch bei Produkten verwendet.');
?>
