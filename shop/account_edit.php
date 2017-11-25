<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : account_edit.php
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
//              filename: account_edit.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ACCOUNT_EDIT) == 'overwrite_all')) :
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ACCOUNT_EDIT);

  if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    if (ACCOUNT_GENDER == 'true') $gender = $_POST['gender'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    if (ACCOUNT_DOB == 'true') $dob = $_POST['dob'];
    $email_address = $_POST['email_address'];
    $language_id = $_POST['languages'];
    $telephone = $_POST['telephone'];
    $fax = $_POST['fax'];

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
      if ((strlen(substr(xos_date_raw($dob), 4, 2) . substr(xos_date_raw($dob), 6, 2) . substr(xos_date_raw($dob), 0, 4)) != 8) || (ctype_digit(substr(xos_date_raw($dob), 4, 2) . substr(xos_date_raw($dob), 6, 2) . substr(xos_date_raw($dob), 0, 4)) == false) || (@checkdate(substr(xos_date_raw($dob), 4, 2), substr(xos_date_raw($dob), 6, 2), substr(xos_date_raw($dob), 0, 4)) == false)) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR);
    }

    if (!xos_validate_email($email_address)) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }

    $check_email_query = $DB->prepare
    (
     "SELECT Count(*) AS total
      FROM   " . TABLE_CUSTOMERS . "
      WHERE  customers_email_address = :email_address
      AND    customers_id != :customer_id"
    );
    
    $DB->perform($check_email_query, array(':email_address' => $email_address,
                                           ':customer_id' => (int)$_SESSION['customer_id']));  
                                             
    $check_email = $check_email_query->fetch();
    
    $check_admin_email_query = $DB->prepare
    (
     "SELECT Count(*) AS total
      FROM   " . TABLE_ADMIN . "
      WHERE  admin_email_address = :email_address"
    );
    
    $DB->perform($check_admin_email_query, array(':email_address' => $email_address));
                                          
    $check_admin_email = $check_admin_email_query->fetch();      
    
    if ($check_email['total'] > 0 || $check_admin_email['total'] > 0) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_TELEPHONE_NUMBER_ERROR);
    }

    if ($error == false) {
      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_language_id' => $language_id,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = xos_date_raw($dob);
      
      $DB->updatePrepareExecute(TABLE_CUSTOMERS, $sql_data_array, array('customers_id' => (int)$_SESSION['customer_id']));
      
      $delete_email_query = $DB->prepare
      (
       "DELETE
        FROM   " . TABLE_NEWSLETTER_SUBSCRIBERS . "
        WHERE  subscriber_email_address = :email_address
        AND    customers_id <> :customer_id"
      );
      
      $DB->perform($delete_email_query, array(':email_address' => $email_address,
                                              ':customer_id' => (int)$_SESSION['customer_id']));                   
      
      $update_customers_info_query = $DB->prepare
      (
       "UPDATE " . TABLE_CUSTOMERS_INFO . "
        SET    customers_info_date_account_last_modified = Now()
        WHERE  customers_info_id = :customer_id"
      );
      
      $DB->perform($update_customers_info_query, array(':customer_id' => (int)$_SESSION['customer_id'])); 
                                                    
      $update_newsletter_subscribers_query = $DB->prepare
      (
       "UPDATE " . TABLE_NEWSLETTER_SUBSCRIBERS . "
        SET    subscriber_language_id = :language_id,
               subscriber_email_address = :email_address
        WHERE  customers_id = :customer_id"
      );
      
      $DB->perform($update_newsletter_subscribers_query, array(':language_id' => $language_id,
                                                               ':email_address' => $email_address,
                                                               ':customer_id' => (int)$_SESSION['customer_id']));      

      $sql_data_array = array('entry_firstname' => $firstname,
                              'entry_lastname' => $lastname);
                              
      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;                        

      $sql_where_array = array('customers_id' => (int)$_SESSION['customer_id'],
                               'address_book_id' => (int)$_SESSION['customer_default_address_id']);
                              
      $DB->updatePrepareExecute(TABLE_ADDRESS_BOOK, $sql_data_array, $sql_where_array);

// reset the session variables
      if (ACCOUNT_GENDER == 'true') {
        $_SESSION['customer_gender'] = $gender;
      }
      $_SESSION['customer_first_name'] = $firstname;
      $_SESSION['customer_lastname'] = $lastname;
      
      $messageStack->add_session('account', SUCCESS_ACCOUNT_UPDATED, 'success');

      xos_redirect(xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
    }
  }

  $account_query = $DB->prepare
  (
   "SELECT customers_gender,
           customers_c_id,
           customers_firstname,
           customers_lastname,
           customers_dob,
           customers_email_address,
           customers_language_id,
           customers_telephone,
           customers_fax
    FROM   " . TABLE_CUSTOMERS . "
    WHERE  customers_id = :customer_id"
  );
  
  $DB->perform($account_query, array(':customer_id' => (int)$_SESSION['customer_id']));
     
  $account = $account_query->fetch();

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'));

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($messageStack->size('account_edit') > 0) {
    $smarty->assign('message_stack', $messageStack->output('account_edit'));
    $smarty->assign('message_stack_error', $messageStack->output('account_edit', 'error'));
    $smarty->assign('message_stack_warning', $messageStack->output('account_edit', 'warning')); 
    $smarty->assign('message_stack_success', $messageStack->output('account_edit', 'success'));     
  }
  
  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
    } else {
      $male = ($account['customers_gender'] == 'm') ? true : false;
    }
    $female = !$male;
      
    $smarty->assign(array('account_gender' => true,
                          'input_gender' => xos_draw_radio_field('gender', 'm', $male, 'id="gender_m"') . '<label class="control-label" for="gender_m">&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;</label>' . xos_draw_radio_field('gender', 'f', $female, 'id="gender_f"') . '<label class="control-label" for="gender_f">&nbsp;&nbsp;' . FEMALE . '&nbsp;</label>' . (xos_not_null(ENTRY_GENDER_TEXT) ? '<span class="input-requirement">' . ENTRY_GENDER_TEXT . '</span>': '')));
  } 
  
  if (ACCOUNT_DOB == 'true') {
    $smarty->assign(array('account_dob' => true,
                          'input_dob' => xos_draw_input_field('dob', xos_date_short($account['customers_dob']), 'class="form-control" id="dob"') . '&nbsp;' . (xos_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="input-requirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': '')));
  }

  reset($lng->catalog_languages);
  
  if (sizeof($lng->catalog_languages) > 1) {

    $lang_array = array();
    $languages_selected = '';
    while (list($key, $value) = each($lng->catalog_languages)) {
      $lang_array[] = array('id' => $value['id'],
                            'text' => $value['name']);
      
      if (!empty($language_id)) {
        $languages_selected = $language_id;                      
      } elseif ($value['id'] == $account['customers_language_id']) {
        $languages_selected = $account['customers_language_id'];
      }                            
    }
    $smarty->assign(array('languages' => true,
                          'pull_down_menu_languages' => xos_draw_pull_down_menu('languages', $lang_array, $languages_selected, 'class="form-control" id="languages"')));
  } else {
    $smarty->assign('hidden_field_languages', xos_draw_hidden_field('languages', $account['customers_language_id']));
  }  
  
  
  $smarty->assign(array('form_begin' => xos_draw_form('account_edit', xos_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', 'onsubmit="return true;"', true),
                        'hidden_field' => xos_draw_hidden_field('action', 'process'),
                        'link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL'),
                        'c_id' => $account['customers_c_id'],
                        'input_firstname' => xos_draw_input_field('firstname', $account['customers_firstname'], 'class="form-control" id="firstname"') . '&nbsp;' . (xos_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="input-requirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''),
                        'input_lastname' => xos_draw_input_field('lastname', $account['customers_lastname'], 'class="form-control" id="lastname"') . '&nbsp;' . (xos_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="input-requirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''),
                        'input_email_address' => xos_draw_input_field('email_address', $account['customers_email_address'], 'class="form-control" id="email_address"') . '&nbsp;' . (xos_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="input-requirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''),
                        'input_telephone' => xos_draw_input_field('telephone', $account['customers_telephone'], 'class="form-control" id="telephone"') . '&nbsp;' . (xos_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="input-requirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''),
                        'input_fax' => xos_draw_input_field('fax', $account['customers_fax'], 'class="form-control" id="fax"') . '&nbsp;' . (xos_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="input-requirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''),
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'account_edit');
  $output_account_edit = $smarty->fetch(SELECTED_TPL . '/account_edit.tpl');
                        
  $smarty->assign('central_contents', $output_account_edit);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;