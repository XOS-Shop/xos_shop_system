<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : menubox_catalog.php
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
//              filename: catalog.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/menubox_catalog.php') == 'overwrite_all')) :
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'catalog' || EXPAND_MENUBOX_CATALOG == 'true') {
    if (xos_admin_check_files(FILENAME_CATEGORIES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_CATEGORIES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_CATALOG_CATEGORIES_PRODUCTS);
    if (xos_admin_check_files(FILENAME_PRODUCTS_ATTRIBUTES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'selected_box=catalog&first_entrance=1'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_PRODUCTS_ATTRIBUTES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES);
    if (xos_admin_check_files(FILENAME_MANUFACTURERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_MANUFACTURERS, 'selected_box=catalog'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_MANUFACTURERS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_CATALOG_MANUFACTURERS);
    if (xos_admin_check_files(FILENAME_REVIEWS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_REVIEWS, 'selected_box=catalog'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_REVIEWS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_CATALOG_REVIEWS);  
    if (xos_admin_check_files(FILENAME_UPDATE_PRODUCTS_PRICES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_UPDATE_PRODUCTS_PRICES, 'selected_box=catalog&first_entrance=1'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_UPDATE_PRODUCTS_PRICES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_CATALOG_UPDATE_PRODUCTS_PRICES);   
    if (xos_admin_check_files(FILENAME_XSELL_PRODUCTS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_XSELL_PRODUCTS, 'selected_box=catalog&first_entrance=1'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_XSELL_PRODUCTS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_CATALOG_XSELL_PRODUCTS);
    if (xos_admin_check_files(FILENAME_PRODUCTS_EXPECTED)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_PRODUCTS_EXPECTED, 'selected_box=catalog'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_PRODUCTS_EXPECTED == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_CATALOG_PRODUCTS_EXPECTED);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                                                             
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'catalog' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_CATALOG));
                         
  $output_menubox_catalog = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_catalog.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                                
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_catalog', $output_menubox_catalog);
endif;
?>
