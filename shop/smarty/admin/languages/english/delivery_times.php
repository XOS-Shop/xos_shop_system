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

define('TEXT_INFO_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_INFO_DELIVERY_TIMES_TEXT', 'Delivery time:');
define('TEXT_INFO_POPUP_CONTENT_ID', 'Popup content ID:');
define('TEXT_INFO_INSERT_INTRO', 'Please enter the new delivery time with its related data');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this delivery time?');
define('TEXT_INFO_HEADING_NEW_DELIVERY_TIME', 'New delivery time');
define('TEXT_INFO_HEADING_EDIT_DELIVERY_TIME', 'Edit delivery time');
define('TEXT_INFO_HEADING_DELETE_DELIVERY_TIME', 'Delete delivery time');

define('ERROR_REMOVE_DEFAULT_DELIVERY_TIME', 'Error: The default delivery time can not be removed. Please set another delivery time as default, and try again.');
define('ERROR_DELIVERY_TIME_USED_IN_PRODUCTS', 'Error: This delivery time is currently used in products.');
?>
