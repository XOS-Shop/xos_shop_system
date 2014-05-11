<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : zones.php
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
//              filename: zones.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_INFO_EDIT_INTRO', 'Haga los cambios necesarios');
define('TEXT_INFO_ZONES_NAME', 'Nombre de la Zona:');
define('TEXT_INFO_ZONES_CODE', 'Código de la Zona:');
define('TEXT_INFO_COUNTRY_NAME', 'País:');
define('TEXT_INFO_INSERT_INTRO', 'Introduzca los datos de la nueva zona');
define('TEXT_INFO_DELETE_INTRO', 'Seguro que desea eliminar esta zona?');
define('TEXT_INFO_HEADING_NEW_ZONE', 'Nueva Zona');
define('TEXT_INFO_HEADING_EDIT_ZONE', 'Editar Zone');
define('TEXT_INFO_HEADING_DELETE_ZONE', 'Eliminar Zone');

define('TEXT_INFO_DELETE_NOT_ALLOWED', '<font color="red"><b>Dieser Kanton/Bundesland kann nicht gelöscht werden.</b><br /><br />Diesem Kanton/Bundesland ist mindestens ein Kunde und/oder eine Steuerzone und/oder der Shop-Standort zugeordnet.</font>');
define('TEXT_INFO_ZONES_NAME_ERROR', '<font color="red"><b>[%s]</b> existiert bereits für den gewählten Kanton/Bundesland, bitte wählen Sie einen anderen Namen für den Kanton/Bundesland oder wählen Sie ein anderes Land.</font>');
define('TEXT_INFO_ZONES_NAME_ERROR_EMPTY', '<font color="red">Der Name für den Kanton/Bundesland darf nicht leer sein.</font>');
?>
