<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : password_forgotten.php
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
//              filename: password_forgotten.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

// Passwort anfordern ist aus Sicherheitsgruenden nicht sinnvoll.
  die('not in use');
  
  define('SECURITY_CHECK', true);

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_PASSWORD_FORGOTTEN) == 'overwrite_all')) :  
  if (SEND_EMAILS != 'true') {
    xos_redirect(xos_href_link(FILENAME_LOGIN));
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'process') && ((SESSION_FORCE_COOKIE_USE == 'true' && isset($_COOKIE[session_name()])) || SESSION_FORCE_COOKIE_USE == 'false')) {
    $email_address = xos_db_prepare_input($_POST['email_address']);
    $firstname = xos_db_prepare_input($_POST['firstname']);
    $log_times = $_POST['log_times']+1;
    if ($log_times >= 4) {
      $_SESSION['password_forgotten'] = true;
    }

// Check if email exists
    $check_admin_query = xos_db_query("select admin_id as check_id, admin_firstname as check_firstname, admin_lastname as check_lastname, admin_email_address as check_email_address from " . TABLE_ADMIN . " where admin_email_address = '" . xos_db_input($email_address) . "'");
    if (!xos_db_num_rows($check_admin_query)) {
      $_GET['login'] = 'fail';
    } else {
      $check_admin = xos_db_fetch_array($check_admin_query);
      if ($check_admin['check_firstname'] != $firstname) {
        $_GET['login'] = 'fail';
      } else {
        $_GET['login'] = 'success';

        $makePassword = xos_create_random_value(7);
        
        @require(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/' . FILENAME_LOGIN);

        $email_to_admin = new mailer($check_admin['check_firstname'] . ' ' . $check_admin['admin_lastname'], $check_admin['check_email_address'], ADMIN_EMAIL_SUBJECT, '', sprintf(ADMIN_EMAIL_TEXT, $check_admin['check_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $check_admin['check_email_address'], $makePassword, STORE_OWNER), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        if(!$email_to_admin->send()) {
          $mailer_error_message = sprintf(ERROR_PHPMAILER, $email_to_admin->ErrorInfo);
        } else {
          xos_db_query("update " . TABLE_ADMIN . " set admin_password = '" . xos_encrypt_password($makePassword) . "' where admin_id = '" . $check_admin['check_id'] . "'");
        }
      }
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

  if ($_GET['login'] == 'success') {
    $smarty->assign('login_success', true);
  } elseif ($_GET['login'] == 'fail') {
    $smarty->assign('login_fail', true);
  }

  if (isset($_SESSION['password_forgotten'])) {
    $smarty->assign('try_over_3_times', true);
  } elseif (isset($mailer_error_message)) {
    $smarty->assign(array('mailer_error_message' => $mailer_error_message,
                          'link_filename_password_forgotten' => xos_href_link(FILENAME_PASSWORD_FORGOTTEN)));
  }
  
  $smarty->assign(array('link_filename_login' => xos_href_link(FILENAME_LOGIN),
                        'input_firstname' => xos_draw_input_field('firstname'),
                        'input_email_address' => xos_draw_input_field('email_address'),
                        'hidden_field_log_times' => xos_draw_hidden_field('log_times', $log_times),
                        'hidden_field_log_times_0' => xos_draw_hidden_field('log_times', '0'),
                        'link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'link_catalog' => xos_catalog_href_link(),
                        'form_login_begin' => xos_draw_form('login', FILENAME_PASSWORD_FORGOTTEN, 'action=process'),
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'password_forgotten');
  
  $smarty->display(ADMIN_TPL . '/password_forgotten.tpl');
endif;    
?>
