<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : admin_account.php
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
//              filename: admin_account.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_ADMIN_ACCOUNT) == 'overwrite_all')) :
  $current_boxes = DIR_FS_ADMIN . DIR_WS_BOXES;

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'check_password':
        $check_pass_query = xos_db_query("select admin_password as confirm_password from " . TABLE_ADMIN . " where admin_id = '" . (int)$_POST['id_info'] . "'");
        $check_pass = xos_db_fetch_array($check_pass_query);

        // Check that password is good
        if (!xos_validate_password($_POST['password_confirmation'], $check_pass['confirm_password'])) {
          xos_redirect(xos_href_link(FILENAME_ADMIN_ACCOUNT, 'action=check_account&error=password'));
        } else {
          //$confirm = 'confirm_account';
          $_SESSION['confirm_account'] = true;
          xos_redirect(xos_href_link(FILENAME_ADMIN_ACCOUNT, 'action=edit_process'));
        }

        break;
      case 'save_account':
        $admin_id = xos_db_prepare_input($_POST['id_info']);
        $admin_email_address = xos_db_prepare_input($_POST['admin_email_address']);
        $stored_email[] = 'NONE';
        $hiddenPassword = TEXT_INFO_PASSWORD_HIDDEN;

        $check_email_query = xos_db_query("select admin_email_address from " . TABLE_ADMIN . " where admin_id <> " . (int)$admin_id . "");
        while ($check_email = xos_db_fetch_array($check_email_query)) {
          $stored_email[] = $check_email['admin_email_address'];
        }
        
        if (xos_validate_email($admin_email_address) == false) {
           xos_redirect(xos_href_link(FILENAME_ADMIN_ACCOUNT, 'action=edit_process&error=email_not_valid'));
        } elseif (in_array($admin_email_address, $stored_email)) {
          xos_redirect(xos_href_link(FILENAME_ADMIN_ACCOUNT, 'action=edit_process&error=email_used'));
        } else {         
          $my_old_account_query = xos_db_query ("select admin_id, admin_firstname, admin_lastname, admin_email_address from " . TABLE_ADMIN . " where admin_id= " . $_SESSION['login_id'] . "");
          $my_old_account = xos_db_fetch_array($my_old_account_query);         
          $sql_data_array = array('admin_firstname' => xos_db_prepare_input($_POST['admin_firstname']),
                                  'admin_lastname' => xos_db_prepare_input($_POST['admin_lastname']),
                                  'admin_email_address' => $admin_email_address,                                 
                                  'admin_modified' => 'now()');

          $admin_password = xos_db_prepare_input($_POST['admin_password']);
                                                                    
          if (xos_not_null($admin_password)) {                              
            $insert_sql_data = array('admin_password' => xos_encrypt_password($admin_password));
            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);                                  
          } 

          xos_db_perform(TABLE_ADMIN, $sql_data_array, 'update', 'admin_id = \'' . $admin_id . '\'');

          if (SEND_EMAILS == 'true') {
            $email_to_admin = new mailer($my_old_account['admin_firstname'] . ' ' . $my_old_account['admin_lastname'], $my_old_account['admin_email_address'], ADMIN_EMAIL_SUBJECT, '', sprintf(ADMIN_EMAIL_TEXT, $my_old_account['admin_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $my_old_account['admin_email_address'], $hiddenPassword, STORE_OWNER), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            if(!$email_to_admin->send()) {
              $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_admin->ErrorInfo), 'error');
            }
          }

          xos_redirect(xos_href_link(FILENAME_ADMIN_ACCOUNT));
        }
        break;
    }
  }
  
  $my_account_query = xos_db_query ("select a.admin_id, a.admin_firstname, a.admin_lastname, a.admin_email_address, a.admin_created, a.admin_modified, a.admin_logdate, a.admin_lognum, g.admin_groups_name from " . TABLE_ADMIN . " a, " . TABLE_ADMIN_GROUPS . " g where a.admin_id= " . $_SESSION['login_id'] . " and g.admin_groups_id= " . $_SESSION['login_groups_id'] . "");
  $myAccount = xos_db_fetch_array($my_account_query);  
  
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  require('includes/account_check.js.php');
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  
  
  if ($action == 'edit_process') {
    $smarty->assign('form_begin_save_account', xos_draw_form('account', FILENAME_ADMIN_ACCOUNT, 'action=save_account', 'post', 'enctype="multipart/form-data"')); 
  } elseif ($action == 'check_account') {
    $smarty->assign('form_begin_check_password', xos_draw_form('account', FILENAME_ADMIN_ACCOUNT, 'action=check_password', 'post', 'enctype="multipart/form-data"')); 
  } else { 
    $smarty->assign('form_begin_check_account', xos_draw_form('account', FILENAME_ADMIN_ACCOUNT, 'action=check_account', 'post', 'enctype="multipart/form-data"')); 
  }
  
  if ($action == 'edit_process') {
    $smarty->assign('link_filename_admin_account', xos_href_link(FILENAME_ADMIN_ACCOUNT));
    if (isset($_SESSION['confirm_account'])) {
      $smarty->assign('confirm_account', true);
    }    
  }
    
  if ( ($action == 'edit_process') && (isset($_SESSION['confirm_account'])) ) {  
    $smarty->assign(array('input_admin_firstname' => xos_draw_input_field('admin_firstname', $myAccount['admin_firstname']),
                          'input_admin_lastname' => xos_draw_input_field('admin_lastname', $myAccount['admin_lastname']),
                          'input_admin_password' => xos_draw_password_field('admin_password'),
                          'input_admin_password_confirm' => xos_draw_password_field('admin_password_confirm')));    
    if ($_GET['error'] == 'email_used') {
      $smarty->assign(array('email_used' => TEXT_INFO_ERROR_EMAIL_USED,
                            'input_admin_email_address' => xos_draw_input_field('admin_email_address')));
    } elseif ($_GET['error'] == 'email_not_valid') { 
      $smarty->assign(array('email_not_valid' => TEXT_INFO_ERROR_EMAIL_NOT_VALID,
                            'input_admin_email_address' => xos_draw_input_field('admin_email_address'))); 
    } else { 
      $smarty->assign('input_admin_email_address', xos_draw_input_field('admin_email_address', $myAccount['admin_email_address'])); 
    }  
  } else {  
    if (isset($_SESSION['confirm_account'])) unset($_SESSION['confirm_account']);    
    $smarty->assign(array('admin_firstname' => $myAccount['admin_firstname'],
                          'admin_lastname' => $myAccount['admin_lastname'],
                          'admin_email_address' => $myAccount['admin_email_address'],
                          'admin_groups_name' => $myAccount['admin_groups_name'],
                          'admin_created' => $myAccount['admin_created'],
                          'admin_lognum' => $myAccount['admin_lognum'],
                          'admin_logdate' => $myAccount['admin_logdate']));   
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'admin_modified' => $myAccount['admin_modified'],
                        'form_end' => '</form>'));
  
  require(DIR_WS_BOXES . 'infobox_admin_account.php');
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'admin_account');
  $output_admin_account = $smarty->fetch(ADMIN_TPL . '/admin_account.tpl');
  
  $smarty->assign('central_contents', $output_admin_account);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>  
