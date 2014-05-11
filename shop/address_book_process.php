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
      xos_db_query("delete from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_GET['delete'] . "' and customers_id = '" . (int)$_SESSION['customer_id'] . "'");
      $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_DELETED, 'success');
    }
    
    xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
  }

// error checking when updating or adding an entry
  $process = false;
  if (isset($_POST['action']) && (($_POST['action'] == 'process') || ($_POST['action'] == 'update')) && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {  
    $process = true;
    $error = false;

    if (ACCOUNT_GENDER == 'true') $gender = xos_db_prepare_input($_POST['gender']);
    if (ACCOUNT_COMPANY == 'true') $company = xos_db_prepare_input($_POST['company']);
    if (ACCOUNT_COMPANY == 'true' && isset($_POST['company_tax_id'])) $company_tax_id = xos_db_prepare_input($_POST['company_tax_id']);    
    $firstname = xos_db_prepare_input($_POST['firstname']);
    $lastname = xos_db_prepare_input($_POST['lastname']);
    $street_address = xos_db_prepare_input($_POST['street_address']);
    if (ACCOUNT_SUBURB == 'true') $suburb = xos_db_prepare_input($_POST['suburb']);
    $postcode = xos_db_prepare_input($_POST['postcode']);
    $city = xos_db_prepare_input($_POST['city']);
    $country = xos_db_prepare_input($_POST['country']);
    if (ACCOUNT_STATE == 'true') {
      if (isset($_POST['zone_id'])) {
        $zone_id = xos_db_prepare_input($_POST['zone_id']);
      } else {
        $zone_id = false;
      }
      $state = xos_db_prepare_input($_POST['state']);
    }

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_LAST_NAME_ERROR);
    }

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_POST_CODE_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_CITY_ERROR);
    }

    if (!is_numeric($country)) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_COUNTRY_ERROR);
    }

    if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = xos_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
      $check = xos_db_fetch_array($check_query);
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = xos_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and zone_name = '" . xos_db_input($state) . "'");
        if (xos_db_num_rows($zone_query) == 1) {
          $zone = xos_db_fetch_array($zone_query);
          $zone_id = $zone['zone_id'];
        } else {
          $error = true;

          $messageStack->add('addressbook', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('addressbook', ENTRY_STATE_ERROR);
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
        $check_query = xos_db_query("select address_book_id from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_GET['edit'] . "' and customers_id = '" . (int)$_SESSION['customer_id'] . "' limit 1");      
        if (xos_db_num_rows($check_query) == 1) {      
          xos_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "address_book_id = '" . (int)$_GET['edit'] . "' and customers_id ='" . (int)$_SESSION['customer_id'] . "'");
          if (ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id)) {
            $sql_data_array2['customers_group_ra'] = '1';
            xos_db_perform(TABLE_CUSTOMERS, $sql_data_array2, 'update', "customers_id ='" . (int)$_SESSION['customer_id'] . "'");
          
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

            xos_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$_SESSION['customer_id'] . "'");
          }
          
          $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
        }  
      } else {
        if (xos_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {      
          $sql_data_array['customers_id'] = (int)$_SESSION['customer_id'];
          xos_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

          $new_address_book_id = xos_db_insert_id();

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

            xos_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$_SESSION['customer_id'] . "'");
            
            $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
          }
        }  
      }
      
      if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) $smarty->clearAllCache();

      xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }
  }

  if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $entry_query = xos_db_query("select entry_gender, entry_company, entry_company_tax_id, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_zone_id, entry_country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and address_book_id = '" . (int)$_GET['edit'] . "'");

    if (!xos_db_num_rows($entry_query)) {
      $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

      xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }

    $entry = xos_db_fetch_array($entry_query);
  } elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    if ($_GET['delete'] == $_SESSION['customer_default_address_id']) {
      $messageStack->add_session('addressbook', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');

      xos_redirect(xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    } else {
      $check_query = xos_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_GET['delete'] . "' and customers_id = '" . (int)$_SESSION['customer_id'] . "'");
      $check = xos_db_fetch_array($check_query);

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
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n";
  
  if (!isset($_GET['delete'])) {
    require(DIR_WS_INCLUDES . 'form_check.js.php');
  }  
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($messageStack->size('addressbook') > 0) {
    $smarty->assign('message_stack', $messageStack->output('addressbook'));
  }

  if (isset($_GET['delete'])) {
  
    $smarty->assign(array('delete_address' => true,
                          'address_label' => xos_address_label($_SESSION['customer_id'], $_GET['delete'], true, ' ', '<br />'),
                          'link_filename_address_book' => xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'),
                          'link_filename_address_book_process_delete' => xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'] . '&action=deleteconfirm&formid=' . md5($_SESSION['sessiontoken']), 'SSL')));
                           
  } elseif (isset($_GET['edit']) && is_numeric($_GET['edit'])) {  
  
    $smarty->assign(array('edit_address' => true,
                          'form_begin' => xos_draw_form('addressbook', xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, (isset($_GET['edit']) ? 'edit=' . $_GET['edit'] : ''), 'SSL'), 'post', 'onsubmit="return check_form(addressbook);"', true),
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
    
    $smarty->assign(array('form_begin' => xos_draw_form('addressbook', xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, (isset($_GET['edit']) ? 'edit=' . $_GET['edit'] : ''), 'SSL'), 'post', 'onsubmit="return check_form(addressbook);"', true),
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
?>
