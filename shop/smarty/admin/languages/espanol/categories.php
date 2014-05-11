<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : categories.php
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

define('TEXT_NEW_PRODUCT_1', 'Nuevo producto');
define('TEXT_NEW_PRODUCT_2', 'Producto');
define('TEXT_NEW_PRODUCT_3', '%s de edición en "%s"');
define('TEXT_NEW_CATEGORY_1', 'Nueva categoria');
define('TEXT_NEW_CATEGORY_2', 'Categoria');
define('TEXT_NEW_CATEGORY_3', '%s de edición en "%s"');
define('TEXT_CATEGORIES', 'Categorias:');
define('TEXT_SUBCATEGORIES', 'Subcategorias:');
define('TEXT_PRODUCTS', 'Productos:');

define('TEXT_PRODUCTS_PRICE_INFO', 'Precio:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Evaluación Media:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Stock #');
define('TEXT_DATE_ADDED', 'Añadido el:');
define('TEXT_DATE_AVAILABLE', 'Fecha Disponibilidad:');
define('TEXT_LAST_MODIFIED', 'Modificado el:');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Inserte una nueva categoria o producto.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Si quiere mas información, visite la <a href="http://%s" target="blank"><span class="text-deco-underline">página</span></a> de este producto.');
define('TEXT_PRODUCT_DATE_ADDED', 'Este producto fue añadido el %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este producto estará disponible el %s.');

define('TEXT_INFO_COPY_TO_INTRO', 'Elija la categoria hacia donde quiera copiar este producto');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Categorias:');

define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Eliminar Categoria');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover Categoria');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Eliminar Producto');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover Producto');
define('TEXT_INFO_HEADING_COPY_TO', 'Copiar A');

define('TEXT_DELETE_CATEGORY_INTRO', 'Seguro que desea eliminar esta categoria?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Es usted seguro usted desea suprimir permanentemente este producto?');

define('TEXT_DELETE_WARNING_CHILDREN', '<b>ADVERTENCIA:</b> Hay %s categorias que pertenecen a esta categoria!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ADVERTENCIA:</b> Hay %s productos en esta categoria!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Elija la categoria hacia donde quiera mover <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Elija la categoria hacia donde quiera mover <b>%s</b>');
define('TEXT_MOVE', 'Mover <b>%s</b> a:');

define('EMPTY_CATEGORY', 'Categoria Vacia');

define('TEXT_HOW_TO_COPY', 'Metodo de Copia:');
define('TEXT_COPY_AS_LINK', 'Enlazar el producto');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicar el producto');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: No se pueden enlazar productos en la misma categoria.');
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Categories cannot be moved into child category.');
define('ERROR_CANNOT_MOVE_CATEGORY_TO_CATEGORY_CONTAINING_PRODUCTS', 'Error: Categories cannot be moved into a category containing products.');
define('ERROR_CANNOT_MOVE_PRODUCT_TO_TOP_OR_TO_CATEGORY_CONTAINS_SUBCATEGORIES', 'Error: Products cannot be moved into a category containing subcategories or to Top.');
define('ERROR_CANNOT_LINKED_PRODUCT_TO_TOP_OR_TO_CATEGORY_CONTAINS_SUBCATEGORIES', 'Error: Products cannot be linked or duplicated into a category containing subcategories or to Top.');
define('ERROR_NOT_ALL_NECESSARY_PRICES', 'Error: No todos los precios necesarios completados! (fondo negro)');
define('ERROR_CATEGORY_NAME', 'Error: Se requiere un nombre para la categoría');
define('TEXT_EDIT_STATUS', 'Estado');
?>
