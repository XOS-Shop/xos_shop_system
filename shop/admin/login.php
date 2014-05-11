<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : login.php
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
//              filename: login.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////
  
define('SECURITY_CHECK', true);

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_LOGIN) == 'overwrite_all')) :
  if (isset($_GET['action']) && ($_GET['action'] == 'process') && ((SESSION_FORCE_COOKIE_USE == 'true' && isset($_COOKIE[session_name()])) || SESSION_FORCE_COOKIE_USE == 'false')) {
    $email_address = xos_db_prepare_input($_POST['email_address']);
    $password = xos_db_prepare_input($_POST['password']);

// action recorder
    require(DIR_WS_CLASSES . 'action_recorder.php');
    $actionRecorder = new actionRecorderAdmin('ar_admin_login', null, $email_address);
    if ($actionRecorder->canPerform() || !$actionRecorder->check()) {
// Check if email exists
      $check_admin_query = xos_db_query("select admin_id as login_id, admin_groups_id as login_groups_id, admin_firstname as login_firstname, admin_email_address as login_email_address, admin_password as login_password, admin_modified as login_modified, admin_logdate as login_logdate, admin_lognum as login_lognum from " . TABLE_ADMIN . " where admin_email_address = '" . xos_db_input($email_address) . "'");
      if (!xos_db_num_rows($check_admin_query)) {
        $login_error = 'incorrect_values';
        $actionRecorder->record(false);
      } else {
        $check_admin = xos_db_fetch_array($check_admin_query);
        // Check that password is good
        if (!xos_validate_password($password, $check_admin['login_password'])) {
          $login_error = 'incorrect_values';
          $actionRecorder->record(false);
        } else {      
          // migrate old hashed password to new phpass password
          if (xos_password_type($check_admin['login_password']) != 'phpass') {
            xos_db_query("update " . TABLE_ADMIN . " set admin_password = '" . xos_encrypt_password($password) . "' where admin_id = '" . (int)$check_admin['login_id'] . "'");
          }
                    
          if (isset($_SESSION['password_forgotten'])) { 
            unset($_SESSION['password_forgotten']);
          }

          $login_email_address = $check_admin['login_email_address'];
          $login_logdate = $check_admin['login_logdate'];
          $login_lognum = $check_admin['login_lognum'];
          $login_modified = $check_admin['login_modified'];

          $_SESSION['login_id'] = $check_admin['login_id'];
          $_SESSION['login_groups_id'] = $check_admin['login_groups_id'];
          $_SESSION['login_firstname'] = $check_admin['login_firstname'];

          $actionRecorder->_user_id = $check_admin['login_id'];
          $actionRecorder->record();

          //$date_now = date('Ymd');
          xos_db_query("update " . TABLE_ADMIN . " set admin_logdate = now(), admin_lognum = admin_lognum+1 where admin_id = '" . $_SESSION['login_id'] . "'");

          if (($login_lognum == 0) || !($login_logdate) || ($login_email_address == 'admin@localhost') || ($login_modified == '0000-00-00 00:00:00')) {
            xos_redirect(xos_href_link(FILENAME_ADMIN_ACCOUNT, 'selected_box=0'));
          } else {
            xos_redirect(xos_href_link(FILENAME_DEFAULT));
          }
        }
      }
    } else {
      $login_error = sprintf(ERROR_ACTION_RECORDER, (defined('MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES') ? (int)MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES : 5));
    } 
  }

  $javascript = '<script type="text/javascript">' . "\n" .   
                '/* <![CDATA[ */' . "\n" .
                'function center() {' . "\n" .
                '  var height = document.getElementById("text").offsetHeight;' . "\n" .
                '  var marg = (height / 2);' . "\n" .
                '  document.getElementById("spacer").style.margin = "-" + marg + "px" + " 0px" + " 0px" + " 0px";' . "\n" .
                '}' . "\n" .                   
                '/* ]]> */' . "\n" .
                '</script>' . "\n";                                  

  require(DIR_WS_INCLUDES . 'html_header_with_special_stylesheet.php');  
  require(DIR_WS_INCLUDES . 'footer.php');

  if (SESSION_FORCE_COOKIE_USE == 'true' && !isset($_COOKIE[session_name()])) {
    $smarty->assign('cookie_not_accepted', true);
  }

  $smarty->assign('login_fail', $login_error);
  
  if (SEND_EMAILS == 'true') {
// Passwort anfordern ist aus Sicherheitsgruenden nicht sinnvoll.  
//    $smarty->assign('link_filename_password_forgotten', xos_href_link(FILENAME_PASSWORD_FORGOTTEN));
  }   
       
  $smarty->assign(array('link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'link_catalog' => xos_catalog_href_link(),
                        'form_login_begin' => xos_draw_form('login', FILENAME_LOGIN, 'action=process'),
                        'input_email_address' => xos_draw_input_field('email_address'),
                        'input_password' => xos_draw_password_field('password'),
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'login');
  
  $smarty->display(ADMIN_TPL . '/login.tpl');
endif;    
?>
