<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : countries.php
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
//              filename: countries.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_INFO_EDIT_INTRO', 'Haga los cambios necesarios');
define('TEXT_INFO_COUNTRY_NAME', 'Nombre:');
define('TEXT_INFO_COUNTRY_CODE_2', 'Código ISO (2):');
define('TEXT_INFO_COUNTRY_CODE_3', 'Código ISO (3):');
define('TEXT_INFO_ADDRESS_FORMAT', 'Formato de Dirección:');
define('TEXT_INFO_INSERT_INTRO', 'Introduzca el nuevo país con sus datos');
define('TEXT_INFO_DELETE_INTRO', 'Seguro que desea eliminar este país?');
define('TEXT_INFO_HEADING_NEW_COUNTRY', 'Nuevo País');
define('TEXT_INFO_HEADING_NEW_COUNTRY_FROM_LIST', 'País nuevo de la lista');
define('TEXT_INFO_HEADING_EDIT_COUNTRY', 'Editar País');
define('TEXT_INFO_HEADING_DELETE_COUNTRY', 'Eliminar País');

define('TEXT_INFO_DELETE_NOT_ALLOWED', '<span style="color: #ff0000;"><b>Dieses Land kann nicht gelöscht werden.</b><br /><br />Diesem Land ist mindestens ein Kunde und/oder eine Steuerzone und/oder der Shop-Standort zugeordnet.</span>');
define('TEXT_INFO_COUNTRY_NAME_ERROR', '<span style="color: #ff0000;"><b>[%s]</b> existiert bereits, bitte wählen Sie einen anderen Namen für das Land.</span>');
define('TEXT_INFO_COUNTRY_NAME_ERROR_EMPTY', '<span style="color: #ff0000;">Der Name für das Land darf nicht leer sein.</span>');
?>
