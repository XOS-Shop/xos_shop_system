<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : table.php
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
//              filename: table.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('MODULE_SHIPPING_TABLE_TEXT_TITLE', 'Tabla de Tarifas');
define('MODULE_SHIPPING_TABLE_TEXT_DESCRIPTION', 'Tabla de Tarifas');


define('MODULE_SHIPPING_TABLE_STATUS_TITLE', 'Enable Table Method');
define('MODULE_SHIPPING_TABLE_COST_TITLE', 'Shipping Table');
define('MODULE_SHIPPING_TABLE_MODE_TITLE', 'Table Method');
define('MODULE_SHIPPING_TABLE_HANDLING_TITLE', 'Handling Fee');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_TITLE', 'Tax Class');
define('MODULE_SHIPPING_TABLE_ZONE_TITLE', 'Shipping Zone');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_TITLE', 'Sort Order');

define('MODULE_SHIPPING_TABLE_STATUS_DESCRIPTION', 'Do you want to offer table rate shipping?');
define('MODULE_SHIPPING_TABLE_COST_DESCRIPTION', 'The shipping cost is based on the total cost or weight of items. Example: 25:8.50,50:5.50,etc.. Up to 25 charge 8.50, from there to 50 charge 5.50, etc');
define('MODULE_SHIPPING_TABLE_MODE_DESCRIPTION', 'The shipping cost is based on the order total or the total weight of the items ordered.');
define('MODULE_SHIPPING_TABLE_HANDLING_DESCRIPTION', 'Handling fee for this shipping method.');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_DESCRIPTION', 'Use the following tax class on the shipping fee.');
define('MODULE_SHIPPING_TABLE_ZONE_DESCRIPTION', 'If a zone is selected, only enable this shipping method for that zone.');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_DESCRIPTION', 'Sort order of display.');
?>
