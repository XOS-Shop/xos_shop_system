<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : header.php
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
//              filename: header.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/header.php') == 'overwrite_all')) :
  if ($messageStack->size('header') > 0) {
    $smarty->assign('message_stack_output', $messageStack->output('header'));
  }
  
  $smarty->assign(array('link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'link_filename_admin_account' => xos_href_link(FILENAME_ADMIN_ACCOUNT, 'selected_box=0'),
                        'link_catalog' => xos_catalog_href_link(),
                        'link_filename_logoff' => xos_href_link(FILENAME_LOGOFF)));
 
  $output_header = $smarty->fetch(ADMIN_TPL . '/includes/header.tpl');
  $smarty->clearAssign(array('message_stack_output',
                              'link_filename_default',
                              'link_filename_admin_account',
                              'link_catalog',
                              'link_filename_logoff'));  

  $smarty->assign('header', $output_header);
endif;  
?>
