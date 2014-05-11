<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : address_book_process.php
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
//              filename: address_book_process.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('NAVBAR_TITLE_1', 'Mi Cuenta');
define('NAVBAR_TITLE_2', 'Mis Direcciones');

define('NAVBAR_TITLE_ADD_ENTRY', 'Nueva Dirección');
define('NAVBAR_TITLE_MODIFY_ENTRY', 'Modificar Dirección');
define('NAVBAR_TITLE_DELETE_ENTRY', 'Eliminar Dirección');

define('EMAIL_SUBJECT_TAX_ID_ADDED', 'Tax id number added');
define('EMAIL_TEXT_TAX_ID_ADDED', 'Please note that %s %s of the company: %s has added a tax id number to his account information.');

define('SUCCESS_ADDRESS_BOOK_ENTRY_DELETED', 'Se ha eliminado la dirección correctamente.');
define('SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED', 'Se ha actualizado la dirección correctamente.');

define('WARNING_PRIMARY_ADDRESS_DELETION', 'La dirección principal no se puede eliminar. Seleccione otra dirección como la principal e inténtelo de nuevo.');

define('ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY', 'No existe la dirección.');
define('ERROR_ADDRESS_BOOK_FULL', 'Ha llegado al limite de direcciones permitidas. Elimine una dirección que no utilice para poder añadir una nueva.');
?>
