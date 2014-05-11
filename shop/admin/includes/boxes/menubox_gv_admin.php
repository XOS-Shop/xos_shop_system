<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : menubox_gv_admin.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2010 Hanspeter Zeller
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
//              and
//              Gift Voucher System v1.0
//              http://www.phesis.org
//              Copyright (c) 2001,2002 Ian C Wilson
//              filename: menubox_gv_admin.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/menubox_gv_admin.php') == 'overwrite_all')) :
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'gv_admin' || EXPAND_MENUBOX_GV_ADMIN == 'true') {
    if (xos_admin_check_files(FILENAME_COUPON_ADMIN)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_COUPON_ADMIN, 'selected_box=gv_admin'), 'selected' => $_SESSION['selected_box'] == 'gv_admin' && FILENAME_COUPON_ADMIN == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_COUPON_ADMIN);
    if (xos_admin_check_files(FILENAME_GV_QUEUE)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_GV_QUEUE, 'selected_box=gv_admin'), 'selected' => $_SESSION['selected_box'] == 'gv_admin' && FILENAME_GV_QUEUE == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_GV_ADMIN_QUEUE);
    if (SEND_EMAILS == 'true' && xos_admin_check_files(FILENAME_GV_MAIL)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_GV_MAIL, 'selected_box=gv_admin'), 'selected' => $_SESSION['selected_box'] == 'gv_admin' && FILENAME_GV_MAIL == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_GV_ADMIN_MAIL);
    if (xos_admin_check_files(FILENAME_GV_SENT)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_GV_SENT, 'selected_box=gv_admin'), 'selected' => $_SESSION['selected_box'] == 'gv_admin' && FILENAME_GV_SENT == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_GV_ADMIN_SENT);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                   		
  }
  
  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_COUPON_ADMIN, 'selected_box=gv_admin'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'gv_admin' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_GV_ADMIN));
                          
  $output_menubox_gv_admin = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_gv_admin.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_gv_admin', $output_menubox_gv_admin);  
endif;
?>
