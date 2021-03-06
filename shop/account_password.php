<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : account_password.php
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
//              filename: account_password.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ACCOUNT_PASSWORD) == 'overwrite_all')) :
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ACCOUNT_PASSWORD);

  if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    $password_current = $_POST['password_current'];
    $password_new = $_POST['password_new'];
    $password_confirmation = $_POST['password_confirmation'];

    $error = false;

    if (strlen($password_new) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_password', ENTRY_PASSWORD_NEW_ERROR);
    } elseif ($password_new != $password_confirmation) {
      $error = true;

      $messageStack->add('account_password', ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING);
    }

    if ($error == false) {
      $check_customer_query = $DB->prepare
      (
       "SELECT customers_password
        FROM   " . TABLE_CUSTOMERS . "
        WHERE  customers_id = :customer_id"
      );
      
      $DB->perform($check_customer_query, array(':customer_id' => (int)$_SESSION['customer_id'])); 
           
      $check_customer = $check_customer_query->fetch();

      if (xos_validate_password($password_current, $check_customer['customers_password'])) {
        $update_customers_query = $DB->prepare
        (
         "UPDATE " . TABLE_CUSTOMERS . "
          SET    customers_password = '" . xos_encrypt_password($password_new) . "'
          WHERE  customers_id = :customer_id"
        );
        
        $DB->perform($update_customers_query, array(':customer_id' => (int)$_SESSION['customer_id']));

        $update_customers_info_query = $DB->prepare
        (
         "UPDATE " . TABLE_CUSTOMERS_INFO . "
          SET    customers_info_date_account_last_modified = Now()
          WHERE  customers_info_id = :customer_id"
        );
        
        $DB->perform($update_customers_info_query, array(':customer_id' => (int)$_SESSION['customer_id']));

        $messageStack->add_session('account', SUCCESS_PASSWORD_UPDATED, 'success');

        xos_redirect(xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
      } else {
        $error = true;

        $messageStack->add('account_password', ERROR_CURRENT_PASSWORD_NOT_MATCHING);
      }
    }
    
    if ($error == true) $smarty->assign('password_error', true);
  }

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'));

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($messageStack->size('account_password') > 0) {
    $smarty->assign('message_stack', $messageStack->output('account_password'));
    $smarty->assign('message_stack_error', $messageStack->output('account_password', 'error'));
    $smarty->assign('message_stack_warning', $messageStack->output('account_password', 'warning')); 
    $smarty->assign('message_stack_success', $messageStack->output('account_password', 'success'));    
  }
  
  $smarty->assign(array('form_begin' => xos_draw_form('account_password', xos_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'), 'post', 'onsubmit="return true;"', true),
                        'hidden_field' => xos_draw_hidden_field('action', 'process'),
                        'input_password_current' => xos_draw_password_field('password_current','', 'class="form-control" id="password_current"') . '&nbsp;' . (xos_not_null(ENTRY_PASSWORD_CURRENT_TEXT) ? '<span class="input-requirement">' . ENTRY_PASSWORD_CURRENT_TEXT . '</span>': ''),
                        'input_password_new' => xos_draw_password_field('password_new','', 'class="form-control" id="password_new" placeholder="' . ENTRY_PASSWORD_PLACEHOLDER . '"') . '&nbsp;' . (xos_not_null(ENTRY_PASSWORD_NEW_TEXT) ? '<span class="input-requirement">' . ENTRY_PASSWORD_NEW_TEXT . '</span>': ''),
                        'input_password_confirmation' => xos_draw_password_field('password_confirmation','', 'class="form-control" id="password_confirmation"') . '&nbsp;' . (xos_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="input-requirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''),
                        'link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL'),
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'account_password');
  $output_account_password = $smarty->fetch(SELECTED_TPL . '/account_password.tpl');
                        
  $smarty->assign('central_contents', $output_account_password);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;