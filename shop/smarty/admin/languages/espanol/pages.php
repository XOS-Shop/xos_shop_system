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

define('TEXT_NEW_PAGE_1', 'Nueva página');
define('TEXT_NEW_PAGE_2', 'Página');
define('TEXT_NEW_PAGE_3', '%s de edición en "%s"');
define('TEXT_PAGES', 'Páginas:');
define('TEXT_SUBPAGES', 'Subpáginas:');

define('TEXT_DATE_ADDED', 'Añadido el:');
define('TEXT_DATE_AVAILABLE', 'Fecha Disponibilidad:');
define('TEXT_LAST_MODIFIED', 'Modificado el:');
define('TEXT_NO_CHILD_PAGES', 'Inserte una nueva página.');

define('TEXT_INFO_CURRENT_PAGES', 'Páginas actuales:');

define('TEXT_INFO_HEADING_DELETE_PAGE', 'Eliminar Página');
define('TEXT_INFO_HEADING_MOVE_PAGE', 'Mover Página');

define('TEXT_DELETE_PAGE_INTRO', 'Seguro que desea eliminar esta página?');

define('TEXT_DELETE_WARNING_CHILDREN', '<b>ADVERTENCIA:</b> Hay %s páginas que pertenecen a esta página!');

define('TEXT_MOVE_PAGES_INTRO', 'Elija la página hacia donde quiera mover <b>%s</b>');
define('TEXT_MOVE', 'Mover <b>%s</b> a:');

define('EMPTY_PAGE', 'No hay página');

define('ERROR_CANNOT_MOVE_PAGE_TO_PARENT', 'Error: Page cannot be moved into child Page.');
define('ERROR_PAGE_NAME', 'Error: Se requiere un nombre para la página');
define('TEXT_EDIT_STATUS', 'Estado');
?>
