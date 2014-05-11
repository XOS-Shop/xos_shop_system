<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : offline.php
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
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_OFFLINE) == 'overwrite_all')) : 
  $_SESSION['navigation']->remove_current_page();

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_OFFLINE);

  $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $email_address = xos_db_prepare_input($_POST['email_address']);
    $password = xos_db_prepare_input($_POST['password']);

// Check if email exists
    $check_admin_query = xos_db_query("select admin_id as login_id, admin_email_address as login_email_address, admin_password as login_password from " . TABLE_ADMIN . " where admin_email_address = '" . xos_db_input($email_address) . "'");

    if (!xos_db_num_rows($check_admin_query)) {
      $error = true;
    } else {
      $check_admin = xos_db_fetch_array($check_admin_query);
// Check that password is good
      if (!xos_validate_password($password, $check_admin['login_password'])) {
        $error = true;
      } else {         
        $_SESSION['access_allowed'] = true;        
        xos_redirect(xos_href_link(FILENAME_DEFAULT), false);
      }
    }
  }

  if ($error == true) {
    unset($_SESSION['access_allowed']);
    $messageStack->add('offline', TEXT_OFFLINE_ERROR);
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_OFFLINE, '', 'SSL'));

  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';            
                
  require(DIR_WS_INCLUDES . 'html_header.php');
//  require(DIR_WS_INCLUDES . 'boxes.php');
//  require(DIR_WS_INCLUDES . 'header.php');
//  require(DIR_WS_INCLUDES . 'footer.php');                  
  
  if ($messageStack->size('offline') > 0) {
    $smarty->assign('message_stack', $messageStack->output('offline'));
  }

  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language;
  }

  $language_string = '';
  reset($lng->catalog_languages);
  
  if (sizeof($lng->catalog_languages) > 1) { 
  
    while (list($key, $value) = each($lng->catalog_languages)) {
      $language_str .= ' <a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('language', 'currency', 'tpl', 'dfrom', 'dto')) . 'language=' . $key, $request_type) . '">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $value['directory'] . '/' . $value['image'], $value['name']) . '</a> ';
    }

    $smarty->assign('language_str', $language_str);
  }

  
  $smarty->assign(array('form_begin' => xos_draw_form('offline', xos_href_link(FILENAME_OFFLINE, 'action=process', 'SSL')),
                        'input_field_email_address' => xos_draw_input_field('email_address', '', 'id="email_address"'),
                        'input_field_password' => xos_draw_password_field('password', '', 'id="password"'),
                        'form_end' => '</form>'));   

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'offline');
  $output_offline = $smarty->fetch(SELECTED_TPL . '/offline.tpl');
                        
  $smarty->assign('central_contents', $output_offline);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
