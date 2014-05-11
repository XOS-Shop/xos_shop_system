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

define('NAVBAR_TITLE_1', 'Búsqueda Avanzada');
define('NAVBAR_TITLE_2', 'Resultados de la Búsqueda');

define('TEXT_ALL_CATEGORIES', 'Todas las categorías');
define('TEXT_ALL_MANUFACTURERS', 'Todos los fabricantes');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS', 'Nombre del producto');
define('TABLE_HEADING_INFO', 'Breve descripción');
define('TABLE_HEADING_PACKING_UNIT', 'Unidad de envasado');
define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
define('TABLE_HEADING_QUANTITY', 'Stock #');
define('TABLE_HEADING_PRICE', 'Precio');
define('TABLE_HEADING_WEIGHT', 'Peso');
define('TABLE_HEADING_BUY_NOW', 'Compre Ahora');

define('TEXT_NO_PRODUCTS', 'No hay productos que corresponden con los criterios de búsqueda.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Debe introducir al menos un criterio de búsqueda.');
define('ERROR_INVALID_FROM_DATE', 'La Fecha de Alta Desde es inválida');
define('ERROR_INVALID_TO_DATE', 'La Fecha de Alta Hasta es inválida');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'Fecha de Alta Hasta debe ser mayor que Fecha de Alta Desde');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'El Precio Desde debe ser númerico');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'El Precio Hasta debe ser númerico');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Precio Hasta debe ser mayor que Precio Desde.');
define('ERROR_INVALID_KEYWORDS', 'Palabras clave incorrectas');
?>
