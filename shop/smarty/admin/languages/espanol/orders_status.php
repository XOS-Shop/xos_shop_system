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

define('TEXT_INFO_EDIT_INTRO', 'Haga los cambios necesarios');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Estado Pedido:');
define('TEXT_INFO_INSERT_INTRO', 'Introduzca un nombre y los datos del nuevo estado de pedido');
define('TEXT_INFO_DELETE_INTRO', 'Esta seguro que desea suprimir permanentemente este estado de pedido?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Nuevo Estado Pedido');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Editar Estado Pedido');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Eliminar Estado Pedido');

define('TEXT_SET_PUBLIC_STATUS', 'Show the order to the customer at this order status level.'); 
define('TEXT_SET_DOWNLOADS_STATUS', 'Allow downloads of virtual products at this order status level.');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Error: El estado de pedido por defecto no se puede eliminar. Establezca otro estado de pedido predeterminado y pruebe de nuevo.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Error: Este estado de pedido esta siendo usado actualmente.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Error: Este estado de pedido se esta usando en algun histórico de algun pedido.');
?>
