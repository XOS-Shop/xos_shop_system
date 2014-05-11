<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : ot_cod_fee.php
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
//              filename: ot_loworderfee.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_ORDER_TOTAL_COD_FEE_TITLE', 'Nachnahmegebühr');
  define('MODULE_ORDER_TOTAL_COD_FEE_DESCRIPTION', 'Nachnahmegebühr');
  
  
  define('MODULE_ORDER_TOTAL_COD_FEE_STATUS_TITLE', 'Nachnahmegebühr anzeigen');
  define('MODULE_ORDER_TOTAL_COD_FEE_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
  define('MODULE_ORDER_TOTAL_COD_FEE_FLAT_TITLE', 'Gebühr für Pauschale Versandkosten');
  define('MODULE_ORDER_TOTAL_COD_FEE_ITEM_TITLE', 'Gebühr für Versandkosten pro Stück');
  define('MODULE_ORDER_TOTAL_COD_FEE_TABLE_TITLE', 'Gebühr für Tabellarische Versandkosten');
  define('MODULE_ORDER_TOTAL_COD_FEE_USPS_TITLE', 'Gebühr für United States Postal Service');        
  define('MODULE_ORDER_TOTAL_COD_FEE_ZONES_TITLE', 'Gebühr für Versandkosten nach Zonen');
  define('MODULE_ORDER_TOTAL_COD_FEE_FREE_TITLE', 'Gebühr für  Versandkostenfrei');
  define('MODULE_ORDER_TOTAL_COD_FEE_TAX_CLASS_TITLE', 'Steuerklasse');
  
  define('MODULE_ORDER_TOTAL_COD_FEE_STATUS_DESCRIPTION', 'Wollen Sie die Nachnahmegebühr anzeigen?');
  define('MODULE_ORDER_TOTAL_COD_FEE_SORT_ORDER_DESCRIPTION', 'Reihenfolge der Anzeige im Shop.<br /><i>Kleinste Zahl wird zuerst angezeigt</i>.');
  define('MODULE_ORDER_TOTAL_COD_FEE_FLAT_DESCRIPTION', '&lt;Ländercode nach ISO 3166&gt;:&lt;Gebühr&gt;, ... . 00 als Ländercode gilt für alle übrigen Länder. Wenn Sie das Feld leer lassen wird keine Nachnahmegebühr für diese Versandart berechnet. Beispiel: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_ITEM_DESCRIPTION', '&lt;Ländercode nach ISO 3166&gt;:&lt;Gebühr&gt;, ... . 00 als Ländercode gilt für alle übrigen Länder. Wenn Sie das Feld leer lassen wird keine Nachnahmegebühr für diese Versandart berechnet. Beispiel: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_TABLE_DESCRIPTION', '&lt;Ländercode nach ISO 3166&gt;:&lt;Gebühr&gt;, ... . 00 als Ländercode gilt für alle übrigen Länder. Wenn Sie das Feld leer lassen wird keine Nachnahmegebühr für diese Versandart berechnet. Beispiel: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_USPS_DESCRIPTION', '&lt;Ländercode nach ISO 3166&gt;:&lt;Gebühr&gt;, ... . 00 als Ländercode gilt für alle übrigen Länder. Wenn Sie das Feld leer lassen wird keine Nachnahmegebühr für diese Versandart berechnet. Beispiel: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_ZONES_DESCRIPTION', '&lt;Ländercode nach ISO 3166&gt;:&lt;Gebühr&gt;, ... . 00 als Ländercode gilt für alle übrigen Länder. Wenn Sie das Feld leer lassen wird keine Nachnahmegebühr für diese Versandart berechnet. Beispiel: CH:4.00,AT:3.00,DE:3.58,00:9.99');
  define('MODULE_ORDER_TOTAL_COD_FEE_FREE_DESCRIPTION', '&lt;Ländercode nach ISO 3166&gt;:&lt;Gebühr&gt;, ... . 00 als Ländercode gilt für alle übrigen Länder. Wenn Sie das Feld leer lassen wird keine Nachnahmegebühr für diese Versandart berechnet. Beispiel: CH:4.00,AT:3.00,DE:3.58,00:9.99');  
  define('MODULE_ORDER_TOTAL_COD_FEE_TAX_CLASS_DESCRIPTION', 'Die folgende Steuerklasse für die Nachnahmegebühr anwenden.');
?>
