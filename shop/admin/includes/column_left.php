<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : column_left.php
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
//              filename: column_left.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/column_left.php') == 'overwrite_all')) :  
  if (xos_admin_check_boxes('menubox_administrator.php')) require(DIR_WS_BOXES . 'menubox_administrator.php');
  if (xos_admin_check_boxes('menubox_configuration.php')) require(DIR_WS_BOXES . 'menubox_configuration.php');
  if (xos_admin_check_boxes('menubox_modules.php')) require(DIR_WS_BOXES . 'menubox_modules.php');   
  if (xos_admin_check_boxes('menubox_content_manager.php')) require(DIR_WS_BOXES . 'menubox_content_manager.php');    
  if (xos_admin_check_boxes('menubox_catalog.php')) require(DIR_WS_BOXES . 'menubox_catalog.php'); 
  if (xos_admin_check_boxes('menubox_customers.php')) require(DIR_WS_BOXES . 'menubox_customers.php');
// naechste zeile einkommentieren wenn gutscheine fertig  
//  if (xos_admin_check_boxes('menubox_gv_admin.php')) require(DIR_WS_BOXES . 'menubox_gv_admin.php');  
  if (xos_admin_check_boxes('menubox_taxes.php')) require(DIR_WS_BOXES . 'menubox_taxes.php');
  if (xos_admin_check_boxes('menubox_localization.php')) require(DIR_WS_BOXES . 'menubox_localization.php');
  if (xos_admin_check_boxes('menubox_reports.php')) require(DIR_WS_BOXES . 'menubox_reports.php');
  if (xos_admin_check_boxes('menubox_tools.php')) require(DIR_WS_BOXES . 'menubox_tools.php');
endif;    
?>
