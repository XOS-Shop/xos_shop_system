<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : menubox_localization.php
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
//              filename: localization.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/menubox_localization.php') == 'overwrite_all')) :
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'localization' || EXPAND_MENUBOX_LOCALIZATION == 'true') {                                   
    if (xos_admin_check_files(FILENAME_CURRENCIES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_CURRENCIES, 'selected_box=localization'), 'selected' => $_SESSION['selected_box'] == 'localization' && FILENAME_CURRENCIES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_LOCALIZATION_CURRENCIES);
    if (xos_admin_check_files(FILENAME_LANGUAGES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_LANGUAGES, 'selected_box=localization'), 'selected' => $_SESSION['selected_box'] == 'localization' && FILENAME_LANGUAGES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_LOCALIZATION_LANGUAGES);
    if (xos_admin_check_files(FILENAME_ORDERS_STATUS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ORDERS_STATUS, 'selected_box=localization'), 'selected' => $_SESSION['selected_box'] == 'localization' && FILENAME_ORDERS_STATUS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_LOCALIZATION_ORDERS_STATUS);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                                                    
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_CURRENCIES, 'selected_box=localization'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'localization' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_LOCALIZATION));
                          
  $output_menubox_localization = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_localization.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_localization', $output_menubox_localization);
endif;
?>
