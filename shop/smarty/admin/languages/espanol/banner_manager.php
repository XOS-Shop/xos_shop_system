<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : banner_manager.php
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
//              filename: banner_manager.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_BANNERS_DATE_ADDED', 'Añadido el:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Programado el: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Caduca el: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Caduca tras: <b>%s</b> vistas');
define('TEXT_BANNERS_STATUS_CHANGE', 'Cambio Estado: <b>%s</b>');

define('TEXT_BANNERS_DATA', 'D<br />A<br />T<br />O<br />S');
define('TEXT_BANNERS_LAST_3_DAYS', 'Ultimos 3 dias');
define('TEXT_BANNERS_BANNER_VIEWS', 'Vistas');
define('TEXT_BANNERS_BANNER_CLICKS', 'Clicks');

define('TEXT_INFO_DELETE_INTRO', 'Seguro que quiere eliminar este banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Borrar imagen');

define('SUCCESS_BANNER_INSERTED', 'Exito: Se ha añadido el banner.');
define('SUCCESS_BANNER_UPDATED', 'Exito: Se ha actualizado el banner.');
define('SUCCESS_BANNER_REMOVED', 'Exito: Se ha eliminado el banner.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Exito: El estado del banner se ha actualizado.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Error: Es necesario el título del banner.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Error: Es necesario el grupo del banner.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio destino: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio destino: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Error: No existe imagen.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Error: No se puede eliminar la imagen.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Error: Estado desconocido.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de gráficos. Por favor cree un directorio llamado \'graphs\' dentro de \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de gráficos.');
?>
