<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : address_book_process.php
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
//              filename: address_book_process.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ADDRESS_BOOK_PROCESS) == 'overwrite_all')) :
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ADDRESS_BOOK_PROCESS);

  if (isset($_GET['action']) && ($_GET['action'] == 'deleteconfirm') && isset($_GET['delete']) && is_numeric($_GET['delete']) && isset($_GET['formid']) && ($_GET['formid'] == md5($_SESSION['sessiontoken']))) {    
    if ((int)$_GET['delete'] == $_SESSION['customer_default_address_id']) {
      $messageStack->add_session('addressbook', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');
    } else {   
      $DB->deletePrepareExecute(TABLE_ADDRESS_BOOK, array('address_book_id' => (int)$_GET['delete'],
                                                          'customers_id' => (int)$_SESSION['customer_id']));
                                                          
      $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_DELETED, 'success');
    }
    
    xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
  }

// error checking when updating or adding an entry
  $process = false;
  if (isset($_POST['action']) && (($_POST['action'] == 'process') || ($_POST['action'] == 'update')) && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {  
    $process = true;
    $error = false;

    if (ACCOUNT_GENDER == 'true') $gender = $_POST['gender'];
    if (ACCOUNT_COMPANY == 'true') $company = $_POST['company'];
    if (ACCOUNT_COMPANY == 'true' && isset($_POST['company_tax_id'])) $company_tax_id = $_POST['company_tax_id'];    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $street_address = $_POST['street_address'];
    if (ACCOUNT_SUBURB == 'true') $suburb = $_POST['suburb'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    if (ACCOUNT_STATE == 'true') {
      if (isset($_POST['zone_id'])) {
        $zone_id = $_POST['zone_id'];
      } else {
        $zone_id = false;
      }
      $state = $_POST['state'];
    }

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_GENDER_ERROR);
        $smarty->assign('gender_error', true);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_FIRST_NAME_ERROR);
      $smarty->assign('first_name_error', true);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_LAST_NAME_ERROR);
      $smarty->assign('last_name_error', true);
    }

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_STREET_ADDRESS_ERROR);
      $smarty->assign('street_address_error', true);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_POST_CODE_ERROR);
      $smarty->assign('post_code_error', true);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_CITY_ERROR);
      $smarty->assign('city_error', true);
    }

    if (!is_numeric($country)) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_COUNTRY_ERROR);
      $smarty->assign('country_error', true);
    }

    if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = $DB->prepare
      (
       "SELECT Count(*) AS total
        FROM   " . TABLE_ZONES . "
        WHERE  zone_country_id = :country"
      );
      
      $DB->perform($check_query, array(':country' => (int)$country));
                                            
      $check = $check_query->fetch();
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = $DB->prepare
        (
         "SELECT DISTINCT zone_id
          FROM            " . TABLE_ZONES . "
          WHERE           zone_country_id = :country
          AND             zone_name = :state"
        );
        
        $DB->perform($zone_query, array(':country' => (int)$country,
                                        ':state' => $state));
                                              
        if ($zone_query->rowCount() == 1) {
          $zone = $zone_query->fetch();
          $zone_id = $zone['zone_id'];
        } else {
          $error = true;

          $messageStack->add('addressbook', ENTRY_STATE_ERROR_SELECT);
          $smarty->assign('state_error', true);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('addressbook', ENTRY_STATE_ERROR);
          $smarty->assign('state_error', true);
        }
      }
    }

    if ($error == false) {
      $sql_data_array = array('entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => (int)$country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
      if (ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id)) {
        $sql_data_array['entry_company_tax_id'] = $company_tax_id;
      } elseif (ACCOUNT_COMPANY == 'true' && isset($_POST['primary']) && $_POST['primary'] == 'on') {
        $sql_data_array['entry_company_tax_id'] = '';
      }         
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = (int)$zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

      if ($_POST['action'] == 'update') {
        $check_query = $DB->prepare
        (
         "SELECT address_book_id
          FROM   " . TABLE_ADDRESS_BOOK . "
          WHERE  address_book_id = :edit
          AND    customers_id = :customer_id
          LIMIT  1"
        );
        
        $DB->perform($check_query, array(':edit' => (int)$_GET['edit'],
                                         ':customer_id' => (int)$_SESSION['customer_id']));
                                                      
        if ($check_query->rowCount() == 1) {
          $DB->updatePrepareExecute(TABLE_ADDRESS_BOOK, $sql_data_array, array('address_book_id' => (int)$_GET['edit'], 
                                                                               'customers_id' => (int)$_SESSION['customer_id']));
                                                                               
          if (ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id)) {
            $sql_data_array2['customers_group_ra'] = '1';
            $DB->updatePrepareExecute(TABLE_CUSTOMERS, $sql_data_array2, array('customers_id' => (int)$_SESSION['customer_id']));
          
            if (SEND_EMAILS == 'true') {
              // if you would *not* like to have an email when a tax id number has been entered in
              // the appropriate field, comment out this section. The alert in admin is raised anyway
              $alert_email_text = sprintf(EMAIL_TEXT_TAX_ID_ADDED, $firstname, $lastname, $company);
        
              $email_to_store_owner = new mailer(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT_TAX_ID_ADDED, '', $alert_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        
              if(!$email_to_store_owner->send()) {
                $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_store_owner->ErrorInfo));
              }
            }   
          }        

// reregister session variables
          if ( (isset($_POST['primary']) && ($_POST['primary'] == 'on')) || ($_GET['edit'] == $_SESSION['customer_default_address_id']) ) {
            if (ACCOUNT_GENDER == 'true') {
              $_SESSION['customer_gender'] = $gender;
            }
            $_SESSION['customer_first_name'] = $firstname;
            $_SESSION['customer_lastname'] = $lastname;
            $_SESSION['customer_country_id'] = $country;
            $_SESSION['customer_zone_id'] = (($zone_id > 0) ? (int)$zone_id : '0');
            $_SESSION['customer_default_address_id'] = (int)$_GET['edit'];

            $sql_data_array = array('customers_firstname' => $firstname,
                                    'customers_lastname' => $lastname,
                                    'customers_default_address_id' => (int)$_GET['edit']);

            if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;

            $DB->updatePrepareExecute(TABLE_CUSTOMERS, $sql_data_array, array('customers_id' => (int)$_SESSION['customer_id']));
          }
          
          $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
        }  
      } else {
        if (xos_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {      
          $sql_data_array['customers_id'] = (int)$_SESSION['customer_id'];
          $DB->insertPrepareExecute(TABLE_ADDRESS_BOOK, $sql_data_array);
     
          $new_address_book_id = $DB->lastInsertId();

// reregister session variables
          if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) {
            if (ACCOUNT_GENDER == 'true') {
              $_SESSION['customer_gender'] = $gender;
            }        
            $_SESSION['customer_first_name'] = $firstname;
            $_SESSION['customer_lastname'] = $lastname;
            $_SESSION['customer_country_id'] = $country;
            $_SESSION['customer_zone_id'] = (($zone_id > 0) ? (int)$zone_id : '0');
            $_SESSION['customer_default_address_id'] = $new_address_book_id;

            $sql_data_array = array('customers_firstname' => $firstname,
                                    'customers_lastname' => $lastname);

            if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
            $sql_data_array['customers_default_address_id'] = $new_address_book_id;

            $DB->updatePrepareExecute(TABLE_CUSTOMERS, $sql_data_array, array('customers_id' => (int)$_SESSION['customer_id']));            
          }
          
          $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
        }  
      }
      
      if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) $smarty->clearAllCache();

      xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }
  }

  if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $entry_query = $DB->prepare
    (
     "SELECT entry_gender,
             entry_company,
             entry_company_tax_id,
             entry_firstname,
             entry_lastname,
             entry_street_address,
             entry_suburb,
             entry_postcode,
             entry_city,
             entry_state,
             entry_zone_id,
             entry_country_id
      FROM   " . TABLE_ADDRESS_BOOK . "
      WHERE  customers_id = :customer_id
      AND    address_book_id = :edit"
    );

    $DB->perform($entry_query, array(':customer_id' => (int)$_SESSION['customer_id'],
                                     ':edit' => (int)$_GET['edit']));
                                         
    if (!$entry_query->rowCount()) {
      $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

      xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }

    $entry = $entry_query->fetch();
  } elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    if ($_GET['delete'] == $_SESSION['customer_default_address_id']) {
      $messageStack->add_session('addressbook', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');

      xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    } else {
      $check_query = $DB->prepare
      (
       "SELECT Count(*) AS total
        FROM   " . TABLE_ADDRESS_BOOK . "
        WHERE  address_book_id = :delete
        AND    customers_id = :customer_id"
      );
      
      $DB->perform($check_query, array(':delete' => (int)$_GET['delete'],
                                       ':customer_id' => (int)$_SESSION['customer_id'])); 
                                            
      $check = $check_query->fetch();

      if ($check['total'] < 1) {
        $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

        xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
      }
    }
  } else {
    $entry = array();
  }

  if (!isset($_GET['delete']) && !isset($_GET['edit'])) {
    if (xos_count_customer_address_book_entries() >= MAX_ADDRESS_BOOK_ENTRIES) {
      $messageStack->add_session('addressbook', ERROR_ADDRESS_BOOK_FULL);

      xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }
  }

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));

  if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $site_trail->add(NAVBAR_TITLE_MODIFY_ENTRY, xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $_GET['edit'], 'SSL'));
  } elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $site_trail->add(NAVBAR_TITLE_DELETE_ENTRY, xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'], 'SSL'));
  } else {
    $site_trail->add(NAVBAR_TITLE_ADD_ENTRY, xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL'));
  }
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($messageStack->size('addressbook') > 0) {
    $smarty->assign('message_stack', $messageStack->output('addressbook'));
    $smarty->assign('message_stack_error', $messageStack->output('addressbook', 'error'));
    $smarty->assign('message_stack_warning', $messageStack->output('addressbook', 'warning')); 
    $smarty->assign('message_stack_success', $messageStack->output('addressbook', 'success'));    
  }

  if (isset($_GET['delete'])) {
  
    $smarty->assign(array('delete_address' => true,
                          'address_label' => xos_address_label($_SESSION['customer_id'], $_GET['delete'], true, ' ', '<br />'),
                          'link_filename_address_book' => xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'),
                          'link_filename_address_book_process_delete' => xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'] . '&action=deleteconfirm&formid=' . md5($_SESSION['sessiontoken']), 'SSL')));
                           
  } elseif (isset($_GET['edit']) && is_numeric($_GET['edit'])) {  
  
    $smarty->assign(array('edit_address' => true,
                          'form_begin' => xos_draw_form('addressbook', xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, (isset($_GET['edit']) ? 'edit=' . $_GET['edit'] : ''), 'SSL'), 'post', 'onsubmit="return true;"', true),
                          'link_filename_address_book' => xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'),
                          'hidden_field_update' => xos_draw_hidden_field('action', 'update'),
                          'hidden_field_edit' => xos_draw_hidden_field('edit', $_GET['edit']),
                          'form_end' => '</form>'));
                          
    include(DIR_WS_MODULES . 'address_book_details.php');
  } else {
    if (sizeof($_SESSION['navigation']->snapshot) > 0) {
      $back_link = xos_href_link($_SESSION['navigation']->snapshot['page'], xos_array_to_query_string($_SESSION['navigation']->snapshot['get'], array(xos_session_name())), $_SESSION['navigation']->snapshot['mode']);
    } else {
      $back_link = xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL');
    }  
    
    $smarty->assign(array('form_begin' => xos_draw_form('addressbook', xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, (isset($_GET['edit']) ? 'edit=' . $_GET['edit'] : ''), 'SSL'), 'post', 'onsubmit="return true;"', true),
                          'link_back' => $back_link,
                          'hidden_field_process' => xos_draw_hidden_field('action', 'process'),
                          'form_end' => '</form>'));
                          
    include(DIR_WS_MODULES . 'address_book_details.php');
  }
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'address_book_process');
  $output_address_book_process = $smarty->fetch(SELECTED_TPL . '/address_book_process.tpl');
                        
  $smarty->assign('central_contents', $output_address_book_process);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');  
endif;