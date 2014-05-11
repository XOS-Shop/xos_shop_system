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
//              Copyright (c) 2003 osCommerce
//              filename: header.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/header.php') == 'overwrite_all')) : 
// check if the session folder is writeable
  if (WARN_SESSION_DIRECTORY_NOT_WRITEABLE == 'true') {
    if (STORE_SESSIONS == '') {
      if (!is_dir(xos_session_save_path())) {
        $messageStack->add('header', WARNING_SESSION_DIRECTORY_NON_EXISTENT, 'warning');
      } elseif (!is_writable(xos_session_save_path())) {
        $messageStack->add('header', WARNING_SESSION_DIRECTORY_NOT_WRITEABLE, 'warning');
      }
    }
  }

// check session.auto_start is disabled
  if ( (function_exists('ini_get')) && (WARN_SESSION_AUTO_START == 'true') ) {
    if (ini_get('session.auto_start') == '1') {
      $messageStack->add('header', WARNING_SESSION_AUTO_START, 'warning');
    }
  }

// warn the admin if the site is offline
  if ( (SITE_OFFLINE == 'true') && ($_SESSION['access_allowed'] == 'true') ) {
    $messageStack->add('header', WARNING_SITE_IS_OFFLINE, 'warning');
  }

  if ( (WARN_DOWNLOAD_DIRECTORY_NOT_READABLE == 'true') && (DOWNLOAD_ENABLED == 'true') ) {
    if (!is_dir(DIR_FS_DOWNLOAD)) {
      $messageStack->add('header', WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT, 'warning');
    }
  }

  if ($messageStack->size('header') > 0) {
    $smarty->assign('header_message_stack_output', $messageStack->output('header'));
  }
  
  if (isset($_GET['error_message']) && xos_not_null($_GET['error_message'])) {
    $smarty->assign('header_error_message', htmlspecialchars(stripslashes(urldecode($_GET['error_message']))));
  }
  
  if (isset($_GET['info_message']) && xos_not_null($_GET['info_message'])) {
    $smarty->assign('header_info_message', htmlspecialchars(stripslashes(urldecode($_GET['info_message']))));
  }
  
  if (isset($_SESSION['customer_id'])) {
    $smarty->assign('header_link_filename_logoff', xos_href_link(FILENAME_LOGOFF, '', 'SSL'));
  }
  
  if ($banner_header = xos_banner_exists('dynamic', 'header')) {                         
    $smarty->assign('header_banner_header',  xos_display_banner('static', $banner_header));
  }   
  
  $smarty->assign(array('header_store_name' => STORE_NAME,
                        'header_link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'header_link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL'),
                        'header_link_filename_shopping_cart' => xos_href_link(FILENAME_SHOPPING_CART),
                        'header_link_filename_checkout_shipping' => xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'),
                        'header_breadcrumb' => $site_trail->breadcrumb_trail(BREADCRUMB_TRAIL_SEPARATOR))); 
  $output_header = $smarty->fetch(SELECTED_TPL . '/includes/header.tpl');
                        
  $smarty->assign('header', $output_header);
endif;    
?>
