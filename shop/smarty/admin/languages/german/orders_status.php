<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : orders_status.php
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
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Bestellstatus:');
define('TEXT_INFO_INSERT_INTRO', 'Bitte geben Sie den neuen Bestellstatus mit allen relevanten Daten ein');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diesen Bestellstatus löschen möchten?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Neuer Bestellstatus');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Bestellstatus bearbeiten');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Bestellstatus löschen');

define('TEXT_SET_PUBLIC_STATUS', 'Bestellung wird dem Kunden bei diesem Bestellstatus angezeigt.'); 
define('TEXT_SET_DOWNLOADS_STATUS', 'Virtuelle Produkte können bei diesem Status heruntergeladen werden.'); 

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Fehler: Der Standard-Bestellstatus kann nicht gelöscht werden. Bitte definieren Sie einen neuen Standard-Bestellstatus und wiederholen Sie den Vorgang.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Fehler: Dieser Bestellstatus wird zurzeit noch bei den Bestellungen verwendet.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Fehler: Dieser Bestellstatus wird zurzeit noch in der Bestellhistorie verwendet.');
?>
