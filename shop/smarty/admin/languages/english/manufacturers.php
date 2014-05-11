<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : manufacturers.php
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
//              filename: manufacturers.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_HEADING_NEW_MANUFACTURER', 'New Manufacturer');
define('TEXT_HEADING_EDIT_MANUFACTURER', 'Edit Manufacturer');
define('TEXT_HEADING_DELETE_MANUFACTURER', 'Delete Manufacturer');

define('TEXT_MANUFACTURERS', 'Manufacturers:');
define('TEXT_DATE_ADDED', 'Date Added:');
define('TEXT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_PRODUCTS', 'Products:');

define('TEXT_NEW_INTRO', 'Please fill out the following information for the new manufacturer');
define('TEXT_EDIT_INTRO', 'Please make any necessary changes');

define('TEXT_MANUFACTURERS_NAME', 'Manufacturers Name:');
define('TEXT_DELETE', 'Delete:');
define('TEXT_MANUFACTURERS_IMAGE', 'Manufacturers Image:');
define('TEXT_MANUFACTURERS_URL', 'Manufacturers URL: (http://example.com)');

define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this manufacturer?');
define('TEXT_DELETE_IMAGE', 'Delete manufacturers image?');
define('TEXT_DELETE_PRODUCTS', 'Delete products from this manufacturer? (including product reviews, products on special, upcoming products)');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNING:</b> There are %s products still linked to this manufacturer!');

define('ERROR_DIRECTORY_NOT_WRITEABLE', 'Error: I can not write to this directory. Please set the right user permissions on: %s');
define('ERROR_DIRECTORY_DOES_NOT_EXIST', 'Error: Directory does not exist: %s');
?>
