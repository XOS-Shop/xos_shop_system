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

define('TEXT_NEW_PAGE_1', 'New page');
define('TEXT_NEW_PAGE_2', 'Page');
define('TEXT_NEW_PAGE_3', '%s edit in "%s"');
define('TEXT_PAGES', 'Pages:');
define('TEXT_SUBPAGES', 'Subpages:');

define('TEXT_DATE_ADDED', 'Date Added:');
define('TEXT_DATE_AVAILABLE', 'Date Available:');
define('TEXT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_NO_CHILD_PAGES', 'Please insert a new page in this level.');

define('TEXT_INFO_CURRENT_PAGES', 'Current Pages:');

define('TEXT_INFO_HEADING_DELETE_PAGE', 'Delete Page');
define('TEXT_INFO_HEADING_MOVE_PAGE', 'Move Page');

define('TEXT_DELETE_PAGE_INTRO', 'Are you sure you want to delete this page?');

define('TEXT_DELETE_WARNING_CHILDREN', '<b>WARNING:</b> There are %s (child-)pages still linked to this category!');

define('TEXT_MOVE_PAGES_INTRO', 'Please select which page you wish <b>%s</b> to reside in');
define('TEXT_MOVE', 'Move <b>%s</b> to:');

define('EMPTY_PAGE', 'No Page');

define('ERROR_CANNOT_MOVE_PAGE_TO_PARENT', 'Error: Page cannot be moved into child page.');
define('ERROR_PAGE_NAME', 'Error: Page name required');
define('TEXT_EDIT_STATUS', 'Status');
?>
