<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : tax_rates.php
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
//              filename: tax_rates.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_INFO_EDIT_INTRO', 'Haga los cambios necesarios');
define('TEXT_INFO_DATE_ADDED', 'Fecha de Alta:');
define('TEXT_INFO_LAST_MODIFIED', 'Ultima Modificación:');
define('TEXT_INFO_CLASS_TITLE', 'Nombre del Porcentaje:');
define('TEXT_INFO_COUNTRY_NAME', 'País:');
define('TEXT_INFO_ZONE_NAME', 'Zona:');
define('TEXT_INFO_TAX_RATE', 'Porcentaje (%):');
define('TEXT_INFO_TAX_RATE_PRIORITY', 'Impuestos con la misma prioridad se suman, los demás se aplican sucesivamente.<br /><br />Prioridad:');
define('TEXT_INFO_RATE_DESCRIPTION', 'Descripción:');
define('TEXT_INFO_INSERT_INTRO', 'Introduzca un nombre y los datos del nuevo porcentaje');
define('TEXT_INFO_DELETE_INTRO', 'Seguro que desea eliminar este porcentaje?');
define('TEXT_INFO_HEADING_NEW_TAX_RATE', 'Nuevo Porcentaje');
define('TEXT_INFO_HEADING_EDIT_TAX_RATE', 'Editar Porcentaje');
define('TEXT_INFO_HEADING_DELETE_TAX_RATE', 'Eliminar Porcentaje');
define('TEXT_INFO_NO_TAX_CLASS_AND_OR_NO_TAX_ZONE_DEFINED', '<font color="red"><b>Es wurde noch keine Steuerzone und/oder keine Steuerklasse definiert.</b></font>');
define('TEXT_INFO_DELETE_NOT_ALLOWED', '<font color="red"><b>Dieser Steuersatz kann nicht gelöscht werden.</b><br /><br />Dieser Steuersatz verwendet eine Steuerklasse der Produkte zugeordnet sind.</font>');
define('TEXT_INFO_DESCRIPTION_ERROR', '<font color="red"><b>[%s]</b> existiert bereits, bitte wählen Sie eine andere Beschreibung für den Steuersatz.</font>');
define('TEXT_INFO_DESCRIPTION_ERROR_EMPTY', '<font color="red"><b>[%s]</b> Die Beschreibung für den Steuersatz darf nicht leer sein.</font>');
define('TEXT_INFO_DESCRIPTION_ERROR_MARK', '**');
define('TEXT_INFO_DESCRIPTION_ERROR_EMPTY_MARK', '*');
?>
