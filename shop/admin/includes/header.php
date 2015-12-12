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
    $smarty->assign('message_stack_header', $messageStack->output('header'));
    $smarty->assign('message_stack_header_error', $messageStack->output('header', 'error'));
    $smarty->assign('message_stack_header_warning', $messageStack->output('header', 'warning')); 
    $smarty->assign('message_stack_header_success', $messageStack->output('header', 'success'));    
  }
  
  $account_info_query = xos_db_query ("select a.admin_firstname, a.admin_lastname, a.admin_created, g.admin_groups_name from " . TABLE_ADMIN . " a, " . TABLE_ADMIN_GROUPS . " g where a.admin_id = " . $_SESSION['login_id'] . " and g.admin_groups_id = a.admin_groups_id");
  $account_info = xos_db_fetch_array($account_info_query);  
  
  $smarty->assign(array('admin_firstname' => $account_info['admin_firstname'],
                        'admin_lastname' => $account_info['admin_lastname'],
                        'admin_groups_name' => $account_info['admin_groups_name'],
                        'admin_created' => $account_info['admin_created'],
                        'link_filename_default' => xos_href_link(FILENAME_DEFAULT, 'selected_box=0'),
                        'link_filename_admin_account' => xos_href_link(FILENAME_ADMIN_ACCOUNT, 'selected_box=0'),
                        'link_catalog' => xos_catalog_href_link(),
                        'link_filename_logoff' => xos_href_link(FILENAME_LOGOFF)));
 
  $output_header = $smarty->fetch(ADMIN_TPL . '/includes/header.tpl');
  $smarty->clearAssign(array('admin_firstname',
                             'admin_lastname',
                             'admin_groups_name',
                             'admin_created',  
                             'link_filename_default',
                             'link_filename_admin_account',
                             'link_catalog',
                             'link_filename_logoff'));  

  $smarty->assign('header', $output_header);
endif;  
?>
