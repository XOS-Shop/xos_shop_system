<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : menubox_administrator.php
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
//              filename: administrator.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/menubox_administrator.php') == 'overwrite_all')) :
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'administrator' || EXPAND_MENUBOX_ADMINISTRATOR == 'true') {                              
    if (xos_admin_check_files(FILENAME_ADMIN_MEMBERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator'), 'selected' => ($_SESSION['selected_box'] == 'administrator' && FILENAME_ADMIN_MEMBERS == basename($_SERVER['PHP_SELF']) && (!isset($_GET['gID']) && !isset($_GET['gPath']))) ? true : false, 'name' => BOX_ADMINISTRATOR_MEMBERS);
    if (xos_admin_check_files(FILENAME_ADMIN_MEMBERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator&gID=groups'), 'selected' => ($_SESSION['selected_box'] == 'administrator' && FILENAME_ADMIN_MEMBERS == basename($_SERVER['PHP_SELF']) && (isset($_GET['gID']) || isset($_GET['gPath']))) ? true : false, 'name' => BOX_ADMINISTRATOR_GROUPS);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                   
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'administrator' ? true : false,    
                        'menu_box_heading_name' => BOX_HEADING_ADMINISTRATOR));
                          
  $output_menubox_administrator = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_administrator.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_administrator', $output_menubox_administrator);
endif;
?>
