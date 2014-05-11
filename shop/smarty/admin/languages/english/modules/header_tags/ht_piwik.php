<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : ht_piwik.php
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
//              Copyright (c) 2010 osCommerce
//              filename: ht_piwik.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('MODULE_HEADER_TAGS_PIWIK_TITLE', 'Piwik');
define('MODULE_HEADER_TAGS_PIWIK_DESCRIPTION', 'Add Piwik to the shop');


define('MODULE_HEADER_TAGS_PIWIK_STATUS_TITLE', 'Enable Piwik Module');
define('MODULE_HEADER_TAGS_PIWIK_HTTP_URL_TITLE', 'Piwik URL/HTTP');
define('MODULE_HEADER_TAGS_PIWIK_HTTPS_URL_TITLE', 'Piwik URL/HTTPS');
define('MODULE_HEADER_TAGS_PIWIK_ID_TITLE', 'Piwik ID');
define('MODULE_HEADER_TAGS_PIWIK_EC_TRACKING_TITLE', 'E-Commerce Tracking');
define('MODULE_HEADER_TAGS_PIWIK_JS_PLACEMENT_TITLE', 'Javascript Placement');
define('MODULE_HEADER_TAGS_PIWIK_SORT_ORDER_TITLE', 'Sort Order');

define('MODULE_HEADER_TAGS_PIWIK_STATUS_DESCRIPTION', 'Do you want to add Piwik to your shop?');
define('MODULE_HEADER_TAGS_PIWIK_HTTP_URL_DESCRIPTION', 'The HTTP-URL where Piwik is installed.<br />e.G.: http://www.domain.de/piwik/');
define('MODULE_HEADER_TAGS_PIWIK_HTTPS_URL_DESCRIPTION', 'The HTTPS-URL where Piwik is installed.<br />e.G.: https://www.domain.de/piwik/');
define('MODULE_HEADER_TAGS_PIWIK_ID_DESCRIPTION', 'The Piwik profile ID to track.<br />e.G.: 1');
define('MODULE_HEADER_TAGS_PIWIK_EC_TRACKING_DESCRIPTION', 'Do you want to enable e-commerce tracking?');
define('MODULE_HEADER_TAGS_PIWIK_JS_PLACEMENT_DESCRIPTION', 'Should the Piwik javascript be loaded in the header or footer?<br />1 = Header<br />2 = Footer');
define('MODULE_HEADER_TAGS_PIWIK_SORT_ORDER_DESCRIPTION', 'Sort order of display. Lowest is displayed first.');
?>