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

define('TEXT_INFO_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Orders Status:');
define('TEXT_INFO_INSERT_INTRO', 'Please enter the new orders status with its related data');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this order status?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'New Orders Status');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Edit Orders Status');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Delete Orders Status');

define('TEXT_SET_PUBLIC_STATUS', 'Show the order to the customer at this order status level.'); 
define('TEXT_SET_DOWNLOADS_STATUS', 'Allow downloads of virtual products at this order status level.');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Error: The default order status can not be removed. Please set another order status as default, and try again.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Error: This order status is currently used in orders.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Error: This order status is currently used in the order status history.');
?>
