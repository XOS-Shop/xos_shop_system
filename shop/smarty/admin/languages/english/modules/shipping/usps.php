<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : usps.php
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
//              filename: usps.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('MODULE_SHIPPING_USPS_TEXT_TITLE', 'United States Postal Service');
define('MODULE_SHIPPING_USPS_TEXT_DESCRIPTION', 'United States Postal Service<br /><br />You will need to have registered an account with USPS at http://www.uspsprioritymail.com/et_regcert.html to use this module<br /><br />USPS expects you to use pounds as weight measure for your products.');


define('MODULE_SHIPPING_USPS_STATUS_TITLE', 'Enable USPS Shipping');
define('MODULE_SHIPPING_USPS_USERID_TITLE', 'Enter the USPS User ID');
define('MODULE_SHIPPING_USPS_PASSWORD_TITLE', 'Enter the USPS Password');
define('MODULE_SHIPPING_USPS_SERVER_TITLE', 'Which server to use');
define('MODULE_SHIPPING_USPS_HANDLING_TITLE', 'Handling Fee');
define('MODULE_SHIPPING_USPS_TAX_CLASS_TITLE', 'Tax Class');
define('MODULE_SHIPPING_USPS_ZONE_TITLE', 'Shipping Zone');
define('MODULE_SHIPPING_USPS_SORT_ORDER_TITLE', 'Sort Order');

define('MODULE_SHIPPING_USPS_STATUS_DESCRIPTION', 'Do you want to offer USPS shipping?');
define('MODULE_SHIPPING_USPS_USERID_DESCRIPTION', 'Enter the USPS USERID assigned to you.');
define('MODULE_SHIPPING_USPS_PASSWORD_DESCRIPTION', 'See USERID, above.');
define('MODULE_SHIPPING_USPS_SERVER_DESCRIPTION', 'An account at USPS is needed to use the Production server');
define('MODULE_SHIPPING_USPS_HANDLING_DESCRIPTION', 'Handling fee for this shipping method.');
define('MODULE_SHIPPING_USPS_TAX_CLASS_DESCRIPTION', 'Use the following tax class on the shipping fee.');
define('MODULE_SHIPPING_USPS_ZONE_DESCRIPTION', 'If a zone is selected, only enable this shipping method for that zone.');
define('MODULE_SHIPPING_USPS_SORT_ORDER_DESCRIPTION', 'Sort order of display.');
?>
