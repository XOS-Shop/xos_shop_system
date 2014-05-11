<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : menubox_taxes.php
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
//              filename: taxes.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/menubox_taxes.php') == 'overwrite_all')) :
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'taxes' || EXPAND_MENUBOX_TAXES == 'true') {
    if (xos_admin_check_files(FILENAME_COUNTRIES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_COUNTRIES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_COUNTRIES);
    if (xos_admin_check_files(FILENAME_ZONES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ZONES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_ZONES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_ZONES);                                   
    if (xos_admin_check_files(FILENAME_GEO_ZONES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_GEO_ZONES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_GEO_ZONES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_GEO_ZONES);
    if (xos_admin_check_files(FILENAME_TAX_CLASSES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_TAX_CLASSES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_TAX_CLASSES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_TAX_CLASSES);
    if (xos_admin_check_files(FILENAME_TAX_RATES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_TAX_RATES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_TAX_RATES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_TAX_RATES);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                                                    
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'taxes' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_LOCATION_AND_TAXES));
                          
  $output_menubox_taxes = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_taxes.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_taxes', $output_menubox_taxes);
endif;
?>
