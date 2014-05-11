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

define('NAVBAR_TITLE_1', 'Advanced Search');
define('NAVBAR_TITLE_2', 'Search Results');

define('TEXT_ALL_CATEGORIES', 'All Categories');
define('TEXT_ALL_MANUFACTURERS', 'All Manufacturers');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Product Name');
define('TABLE_HEADING_INFO', 'Brief Description');
define('TABLE_HEADING_PACKING_UNIT', 'Packing unit');
define('TABLE_HEADING_MANUFACTURER', 'Manufacturer');
define('TABLE_HEADING_QUANTITY', 'Stock #');
define('TABLE_HEADING_PRICE', 'Price');
define('TABLE_HEADING_WEIGHT', 'Weight');
define('TABLE_HEADING_BUY_NOW', 'Buy Now');

define('TEXT_NO_PRODUCTS', 'There is no product that matches the search criteria.');

define('ERROR_AT_LEAST_ONE_INPUT', 'At least one of the fields in the search form must be entered.');
define('ERROR_INVALID_FROM_DATE', 'Invalid From Date.');
define('ERROR_INVALID_TO_DATE', 'Invalid To Date.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'To Date must be greater than or equal to From Date.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Price From must be a number.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Price To must be a number.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Price To must be greater than Price From.');
define('ERROR_INVALID_KEYWORDS', 'Invalid keywords.');
?>
