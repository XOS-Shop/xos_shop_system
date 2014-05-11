<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : menubox_reports.php
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
//              filename: reports.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/menubox_reports.php') == 'overwrite_all')) :
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'reports' || EXPAND_MENUBOX_REPORTS == 'true') {
    if (xos_admin_check_files(FILENAME_STATS_PRODUCTS_VIEWED)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_STATS_PRODUCTS_VIEWED, 'selected_box=reports'), 'selected' => $_SESSION['selected_box'] == 'reports' && FILENAME_STATS_PRODUCTS_VIEWED == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_REPORTS_PRODUCTS_VIEWED);
    if (xos_admin_check_files(FILENAME_STATS_PRODUCTS_PURCHASED)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports'), 'selected' => $_SESSION['selected_box'] == 'reports' && FILENAME_STATS_PRODUCTS_PURCHASED == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_REPORTS_PRODUCTS_PURCHASED);
    if (xos_admin_check_files(FILENAME_STATS_CUSTOMERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_STATS_CUSTOMERS, 'selected_box=reports'), 'selected' => $_SESSION['selected_box'] == 'reports' && FILENAME_STATS_CUSTOMERS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_REPORTS_ORDERS_TOTAL);
// naechste zeile einkommentieren wenn gutscheine fertig
//    if (xos_admin_check_files(FILENAME_STATS_CREDITS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_STATS_CREDITS, 'selected_box=reports'), 'selected' => $_SESSION['selected_box'] == 'reports' && FILENAME_STATS_CREDITS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_REPORTS_CREDITS);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_STATS_PRODUCTS_VIEWED, 'selected_box=reports'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'reports' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_REPORTS));
                         
  $output_menubox_reports = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_reports.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_reports', $output_menubox_reports);
endif;
?>
