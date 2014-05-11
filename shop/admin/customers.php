<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : customers.php
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
//              filename: customers.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_CUSTOMERS) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $error = false;
  $processed = false;

  if (xos_not_null($action)) {
    switch ($action) {
      case 'update':
        $customers_id = xos_db_prepare_input($_GET['cID']);
        $customers_c_id = xos_db_prepare_input($_POST['customers_c_id']); 
        $customers_firstname = xos_db_prepare_input($_POST['customers_firstname']);
        $customers_lastname = xos_db_prepare_input($_POST['customers_lastname']);
        $customers_email_address = xos_db_prepare_input($_POST['customers_email_address']);
        $customers_language_id = xos_db_prepare_input($_POST['customers_language_id']);
        $customers_telephone = xos_db_prepare_input($_POST['customers_telephone']);
        $customers_fax = xos_db_prepare_input($_POST['customers_fax']);
        $customers_comments = xos_db_prepare_input($_POST['customers_comments']);
        if (isset($_POST['newsletter_status'])) $newsletter_status = xos_db_prepare_input($_POST['newsletter_status']);

        $customers_group_id = xos_db_prepare_input($_POST['customers_group_id']);
        $customers_group_ra = xos_db_prepare_input($_POST['customers_group_ra']);
        $entry_company_tax_id = xos_db_prepare_input($_POST['entry_company_tax_id']);

        $customers_gender = xos_db_prepare_input($_POST['customers_gender']);
        $customers_dob = xos_db_prepare_input($_POST['customers_dob']);

        $default_address_id = xos_db_prepare_input($_POST['default_address_id']);
        $entry_street_address = xos_db_prepare_input($_POST['entry_street_address']);
        $entry_suburb = xos_db_prepare_input($_POST['entry_suburb']);
        $entry_postcode = xos_db_prepare_input($_POST['entry_postcode']);
        $entry_city = xos_db_prepare_input($_POST['entry_city']);
        $entry_country_id = xos_db_prepare_input($_POST['entry_country_id']);

        $entry_company = xos_db_prepare_input($_POST['entry_company']);
        $entry_state = xos_db_prepare_input($_POST['entry_state']);
        if (isset($_POST['entry_zone_id'])) $entry_zone_id = xos_db_prepare_input($_POST['entry_zone_id']);

        if (strlen($customers_firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_firstname_error = true;
        } else {
          $entry_firstname_error = false;
        }

        if (strlen($customers_lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_lastname_error = true;
        } else {
          $entry_lastname_error = false;
        }

        if (ACCOUNT_DOB == 'true') {
          if (checkdate(substr(xos_date_raw($customers_dob), 4, 2), substr(xos_date_raw($customers_dob), 6, 2), substr(xos_date_raw($customers_dob), 0, 4))) {
            $entry_date_of_birth_error = false;
          } else {
            $error = true;
            $entry_date_of_birth_error = true;
          }
        }

        if (strlen($customers_email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_email_address_error = true;
        } else {
          $entry_email_address_error = false;
        }

        if (!xos_validate_email($customers_email_address)) {
          $error = true;
          $entry_email_address_check_error = true;
        } else {
          $entry_email_address_check_error = false;
        }

        if (strlen($entry_street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_street_address_error = true;
        } else {
          $entry_street_address_error = false;
        }

        if (strlen($entry_postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
          $error = true;
          $entry_post_code_error = true;
        } else {
          $entry_post_code_error = false;
        }

        if (strlen($entry_city) < ENTRY_CITY_MIN_LENGTH) {
          $error = true;
          $entry_city_error = true;
        } else {
          $entry_city_error = false;
        }

        if ($entry_country_id == false) {
          $error = true;
          $entry_country_error = true;
        } else {
          $entry_country_error = false;
        }

        if (ACCOUNT_STATE == 'true') {
          if ($entry_country_error == true) {
            $entry_state_error = true;
          } else {
            $zone_id = 0;
            $entry_state_error = false;
            $check_query = xos_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry_country_id . "'");
            $check_value = xos_db_fetch_array($check_query);
            $entry_state_has_zones = ($check_value['total'] > 0);
            if ($entry_state_has_zones == true) {
              $zone_query = xos_db_query("select zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry_country_id . "' and zone_name = '" . xos_db_input($entry_state) . "'");
              if (xos_db_num_rows($zone_query) == 1) {
                $zone_values = xos_db_fetch_array($zone_query);
                $entry_zone_id = $zone_values['zone_id'];
              } else {
                $error = true;
                $entry_state_error = true;
              }
            } else {
              if (strlen($entry_state) < ENTRY_STATE_MIN_LENGTH) {
                $error = true;
                $entry_state_error = true;
              }
            }
         }
      }

      if (strlen($customers_telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
        $error = true;
        $entry_telephone_error = true;
      } else {
        $entry_telephone_error = false;
      }

      $check_email = xos_db_query("select customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . xos_db_input($customers_email_address) . "' and customers_id != '" . (int)$customers_id . "'");
      if (xos_db_num_rows($check_email)) {
        $error = true;
        $entry_email_address_exists = true;
      } else {
        $entry_email_address_exists = false;
      }

      if ($error == false) {

        $sql_data_array = array('customers_c_id' => $customers_c_id,
                                'customers_firstname' => $customers_firstname,
                                'customers_lastname' => $customers_lastname,
                                'customers_email_address' => $customers_email_address,
                                'customers_language_id' => $customers_language_id,
                                'customers_telephone' => $customers_telephone,
                                'customers_fax' => $customers_fax,
                                'customers_comments' => $customers_comments,
                                'customers_group_id' => $customers_group_id,
                                'customers_group_ra' => $customers_group_ra);

        if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $customers_gender;
        if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = xos_date_raw($customers_dob);

        xos_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "'");
        
        xos_db_query("delete from " . TABLE_NEWSLETTER_SUBSCRIBERS . " where subscriber_email_address = '" . xos_db_input($customers_email_address) . "' and customers_id <> '" . (int)$customers_id . "'");
        
        if (isset($_POST['newsletter_status'])) {
          $check_newsletter_status_changed = xos_db_query("select newsletter_status from " . TABLE_NEWSLETTER_SUBSCRIBERS . " where newsletter_status = '" . (int)$newsletter_status . "' and customers_id = '" . (int)$customers_id . "'");
          if (xos_db_num_rows($check_newsletter_status_changed)) {
            xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set subscriber_language_id = '" . xos_db_input($customers_language_id) . "', subscriber_email_address = '" . xos_db_input($customers_email_address) . "' where customers_id = '" . (int)$customers_id . "'");
          } else {
            xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set subscriber_language_id = '" . xos_db_input($customers_language_id) . "', subscriber_email_address = '" . xos_db_input($customers_email_address) . "', newsletter_status = '" . (int)$newsletter_status . "', newsletter_status_change = now() where customers_id = '" . (int)$customers_id . "'");
          }
        }
        
        xos_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customers_id . "'");

        if ($entry_zone_id > 0) $entry_state = '';

        $sql_data_array = array('entry_firstname' => $customers_firstname,
                                'entry_lastname' => $customers_lastname,
                                'entry_street_address' => $entry_street_address,
                                'entry_postcode' => $entry_postcode,
                                'entry_city' => $entry_city,
                                'entry_country_id' => $entry_country_id);

        if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $customers_gender;
        if (ACCOUNT_COMPANY == 'true') {
          $sql_data_array['entry_company'] = $entry_company;
          $sql_data_array['entry_company_tax_id'] = $entry_company_tax_id;
        }
        
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $entry_suburb;

        if (ACCOUNT_STATE == 'true') {
          if ($entry_zone_id > 0) {
            $sql_data_array['entry_zone_id'] = $entry_zone_id;
            $sql_data_array['entry_state'] = '';
          } else {
            $sql_data_array['entry_zone_id'] = '0';
            $sql_data_array['entry_state'] = $entry_state;
          }
        }

        xos_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "' and address_book_id = '" . (int)$default_address_id . "'");

        xos_redirect(xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $customers_id));

        } else if ($error == true) {
          $cInfo = new objectInfo($_POST);
          $processed = true;
        }

        break;
      case 'deleteconfirm':
        $customers_id = xos_db_prepare_input($_GET['cID']);

        if (isset($_POST['delete_reviews']) && ($_POST['delete_reviews'] == 'on')) {
          $reviews_query = xos_db_query("select reviews_id from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers_id . "'");
          while ($reviews = xos_db_fetch_array($reviews_query)) {
            xos_db_query("delete from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$reviews['reviews_id'] . "'");
          }

          xos_db_query("delete from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers_id . "'");
        } else {
          xos_db_query("update " . TABLE_REVIEWS . " set customers_id = null where customers_id = '" . (int)$customers_id . "'");
        }     
    
        xos_db_query("delete from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customers_id . "'");
        xos_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customers_id . "'");
        xos_db_query("delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customers_id . "'");
        xos_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customers_id . "'");
        xos_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$customers_id . "'");
        xos_db_query("delete from " . TABLE_WHOS_ONLINE . " where customer_id = '" . (int)$customers_id . "'");

        xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set customers_id = '0' where customers_id = '" . (int)$customers_id . "'");

        $smarty_cache_control->clearCache(null, 'L3|cc_reviews');
        $smarty_cache_control->clearCache(null, 'L3|cc_product_reviews');
        $smarty_cache_control->clearCache(null, 'L3|cc_product_reviews_info');

        xos_redirect(xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action'))));
        break;
      case 'confirm':
        break;  
      default:
        $customers_query = xos_db_query("select c.customers_id, c.customers_gender, c.customers_c_id, c.customers_firstname, c.customers_lastname, c.customers_dob, c.customers_email_address, c.customers_language_id, a.entry_company, a.entry_company_tax_id, a.entry_street_address, a.entry_suburb, a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id, a.entry_country_id, c.customers_telephone, c.customers_fax, ns.newsletter_status, c.customers_group_id,  c.customers_group_ra, c.customers_default_address_id, c.customers_comments from " . TABLE_NEWSLETTER_SUBSCRIBERS . " ns, " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_default_address_id = a.address_book_id where a.customers_id = c.customers_id and ns.customers_id = c.customers_id and c.customers_id = '" . (int)$_GET['cID'] . "'");
	$existing_customers_query = xos_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id ");    
        $customers = xos_db_fetch_array($customers_query);
        $cInfo = new objectInfo($customers);
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";  
  
  if ($action == 'edit' || $action == 'update') {

    $javascript .= '<script type="text/javascript">' . "\n\n" .
    
                   '/* <![CDATA[ */' . "\n" .
                   'function check_form() {' . "\n" .
                   '  var error = 0;' . "\n" .
                   '  var error_message = "' . JS_ERROR . '";' . "\n\n" .

                   '  var customers_firstname = document.customers.customers_firstname.value;' . "\n" .
                   '  var customers_lastname = document.customers.customers_lastname.value;' . "\n";
                 
    if (ACCOUNT_COMPANY == 'true') {
      $javascript .= '  var entry_company = document.customers.entry_company.value;' . "\n";
    }

    if (ACCOUNT_DOB == 'true') {
      $javascript .= '  var customers_dob = document.customers.customers_dob.value;' . "\n";
    }
  
    $javascript .= '  var customers_email_address = document.customers.customers_email_address.value;' . "\n" .
                   '  var entry_street_address = document.customers.entry_street_address.value;' . "\n" .
                   '  var entry_postcode = document.customers.entry_postcode.value;' . "\n" .
                   '  var entry_city = document.customers.entry_city.value;' . "\n" .
                   '  var customers_telephone = document.customers.customers_telephone.value;' . "\n\n";

    if (ACCOUNT_GENDER == 'true') {
      $javascript .= '  if (document.customers.elements["customers_gender"].type != "hidden") {' . "\n" .    
                     '    if (document.customers.customers_gender[0].checked || document.customers.customers_gender[1].checked) {' . "\n" .
                     '    } else {' . "\n" .
                     '      error_message = error_message + "' . JS_GENDER . '";' . "\n" .
                     '      error = 1;' . "\n" .
                     '    }' . "\n" .
                     '  }' . "\n\n";
    }

    $javascript .= '  if (customers_firstname == "" || customers_firstname.length < ' . ENTRY_FIRST_NAME_MIN_LENGTH . ') {' . "\n" .
                   '    error_message = error_message + "' . JS_FIRST_NAME . '";' . "\n" .
                   '    error = 1;' . "\n" .
                   '  }' . "\n\n" .

                   '  if (customers_lastname == "" || customers_lastname.length < ' . ENTRY_LAST_NAME_MIN_LENGTH . ') {' . "\n" .
                   '    error_message = error_message + "' . JS_LAST_NAME . '";' . "\n" .
                   '    error = 1;' . "\n" .
                   '  }' . "\n\n";

    if (ACCOUNT_DOB == 'true') {
      $javascript .= '  if (customers_dob == "" || customers_dob.length < ' . ENTRY_DOB_MIN_LENGTH . ') {' . "\n" .
                     '    error_message = error_message + "' . JS_DOB . '";' . "\n" .
                     '    error = 1;' . "\n" .
                     '  }' . "\n\n";
    }

    $javascript .= '  if (customers_email_address == "" || customers_email_address.length < ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ') {' . "\n" .
                   '    error_message = error_message + "' . JS_EMAIL_ADDRESS . '";' . "\n" .
                   '    error = 1;' . "\n" .
                   '  }' . "\n\n" .

                   '  if (entry_street_address == "" || entry_street_address.length < ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ') {' . "\n" .
                   '    error_message = error_message + "' . JS_ADDRESS . '";' . "\n" .
                   '    error = 1;' . "\n" .
                   '  }' . "\n\n" .

                   '  if (entry_postcode == "" || entry_postcode.length < ' . ENTRY_POSTCODE_MIN_LENGTH . ') {' . "\n" .
                   '    error_message = error_message + "' . JS_POST_CODE . '";' . "\n" .
                   '    error = 1;' . "\n" .
                   '  }' . "\n\n" .

                   '  if (entry_city == "" || entry_city.length < ' . ENTRY_CITY_MIN_LENGTH . ') {' . "\n" .
                   '    error_message = error_message + "' . JS_CITY . '";' . "\n" .
                   '    error = 1;' . "\n" .
                   '  }' . "\n\n";


    if (ACCOUNT_STATE == 'true') {
      $javascript .= '  if (document.customers.elements["entry_state"].type != "hidden") {' . "\n" .
                     '    if (document.customers.entry_state.value == "" || document.customers.entry_state.value.length < ' . ENTRY_STATE_MIN_LENGTH . ') {' . "\n" .
                     '       error_message = error_message + "' . JS_STATE . '";' . "\n" .
                     '       error = 1;' . "\n" .
                     '    }' . "\n" .
                     '  }' . "\n\n";
    }

    $javascript .= '  if (document.customers.elements["entry_country_id"].type != "hidden") {' . "\n" .
                   '    if (document.customers.entry_country_id.value == 0) {' . "\n" .
                   '      error_message = error_message + "' . JS_COUNTRY . '";' . "\n" .
                   '      error = 1;' . "\n" .
                   '    }' . "\n" .
                   '  }' . "\n\n" .

                   '  if (customers_telephone == "" || customers_telephone.length < ' . ENTRY_TELEPHONE_MIN_LENGTH . ') {' . "\n" .
                   '    error_message = error_message + "' . JS_TELEPHONE . '";' . "\n" .
                   '    error = 1;' . "\n" .
                   '  }' . "\n\n" .

                   '  if (error == 1) {' . "\n" .
                   '    alert(error_message);' . "\n" .
                   '    return false;' . "\n" .
                   '  } else {' . "\n" .
                   '    return true;' . "\n" .
                   '  }' . "\n" .                 
                   '}' . "\n\n" .
                   
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n";
  }
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');      

  if ($action == 'edit' || $action == 'update') {
    $newsletter_array = array(array('id' => '1', 'text' => ENTRY_NEWSLETTER_YES),
                              array('id' => '0', 'text' => ENTRY_NEWSLETTER_NO));

    if (ACCOUNT_GENDER == 'true') {
      $smarty->assign('account_gender', true);            
      if ($error == true) {
        if ($entry_gender_error == true) {
          $smarty->assign('gender_in_out_values', xos_draw_radio_field('customers_gender', 'm', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . xos_draw_radio_field('customers_gender', 'f', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . ENTRY_GENDER_ERROR);
        } else {
          $smarty->assign('gender_in_out_values', (($cInfo->customers_gender == 'm') ? MALE : FEMALE) . xos_draw_hidden_field('customers_gender'));
        }
      } else {
        $smarty->assign('gender_in_out_values', xos_draw_radio_field('customers_gender', 'm', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . xos_draw_radio_field('customers_gender', 'f', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . FEMALE);
      }
    }
    
    if ($processed == true) {
      $smarty->assign('cid_in_out_values', $cInfo->customers_c_id . xos_draw_hidden_field('customers_c_id'));
    } else {
      $smarty->assign('cid_in_out_values', xos_draw_input_field('customers_c_id', $cInfo->customers_c_id, 'maxlength="32"'));
    }    

    if ($error == true) {
      if ($entry_firstname_error == true) {
        $smarty->assign('firstname_in_out_values', xos_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'maxlength="32"') . '&nbsp;' . ENTRY_FIRST_NAME_ERROR);
      } else {
        $smarty->assign('firstname_in_out_values', $cInfo->customers_firstname . xos_draw_hidden_field('customers_firstname'));
      }
    } else {
      $smarty->assign('firstname_in_out_values', xos_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'maxlength="32"', true));
    }

    if ($error == true) {
      if ($entry_lastname_error == true) {
        $smarty->assign('lastname_in_out_values', xos_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'maxlength="32"') . '&nbsp;' . ENTRY_LAST_NAME_ERROR);
      } else {
        $smarty->assign('lastname_in_out_values', $cInfo->customers_lastname . xos_draw_hidden_field('customers_lastname'));
      }
    } else {
      $smarty->assign('lastname_in_out_values', xos_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'maxlength="32"', true));
    }

    if (ACCOUNT_DOB == 'true') {
      $smarty->assign('account_dob', true);
      if ($error == true) {
        if ($entry_date_of_birth_error == true) {
          $smarty->assign('dob_in_out_values', xos_draw_input_field('customers_dob', xos_date_short($cInfo->customers_dob), 'maxlength="10"') . '&nbsp;' . ENTRY_DATE_OF_BIRTH_ERROR);
        } else {
          $smarty->assign('dob_in_out_values', $cInfo->customers_dob . xos_draw_hidden_field('customers_dob'));
        }
      } else {
        $smarty->assign('dob_in_out_values', xos_draw_input_field('customers_dob', xos_date_short($cInfo->customers_dob), 'maxlength="10"', true));
      }   
    }

    if ($error == true) {
      if ($entry_email_address_error == true) {
        $smarty->assign('email_address_in_out_values', xos_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR);
      } elseif ($entry_email_address_check_error == true) {
        $smarty->assign('email_address_in_out_values', xos_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
      } elseif ($entry_email_address_exists == true) {
        $smarty->assign('email_address_in_out_values', xos_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      } else {
        $smarty->assign('email_address_in_out_values', $customers_email_address . xos_draw_hidden_field('customers_email_address'));
      }
    } else {
      $smarty->assign('email_address_in_out_values', xos_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"', true));
    }
    
    if ($processed == true) {    
      $languages = xos_get_languages();
      if (sizeof($languages) > 1) {      
        $customers_language_name = '';                          
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {              
          if ($languages[$i]['id'] == $cInfo->customers_language_id) {
            $customers_language_name = $languages[$i]['name'];
          }         
        }                 
        $smarty->assign(array('languages' => true,
                              'languages_in_out_values' => $customers_language_name . xos_draw_hidden_field('customers_language_id')));  
      } else {
        $smarty->assign('hidden_field_customers_language_id', xos_draw_hidden_field('customers_language_id', $cInfo->customers_language_id));
      }
    } else {    
      $languages = xos_get_languages();  
      if (sizeof($languages) > 1) {       
        $lang_array = array();
        $languages_id_selected = '';                          
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) { 
          $lang_array[] = array('id' => $languages[$i]['id'],
                                'text' => $languages[$i]['name']);        
        }
        $smarty->assign(array('languages' => true,
                              'languages_in_out_values' => xos_draw_pull_down_menu('customers_language_id', $lang_array, $cInfo->customers_language_id)));        
      } else {
        $smarty->assign('hidden_field_customers_language_id', xos_draw_hidden_field('customers_language_id', $cInfo->customers_language_id));
      }       
    }                   
    
    if (ACCOUNT_COMPANY == 'true') {
      $smarty->assign('account_company', true);
      if ($error == true) {
        $smarty->assign('company_in_out_values', $cInfo->entry_company . xos_draw_hidden_field('entry_company'));
      } else {
        $smarty->assign('company_in_out_values', xos_draw_input_field('entry_company', $cInfo->entry_company, 'maxlength="32"'));
      }
      
      if ($error == true) {
        if ($entry_company_tax_id_error == true) {
          $smarty->assign('company_tax_id_in_out_values', xos_draw_input_field('entry_company_tax_id', $cInfo->entry_company_tax_id, 'maxlength="32"') . '&nbsp;' . ENTRY_COMPANY_TAX_ID_ERROR);
        } else {
          $smarty->assign('company_tax_id_in_out_values', $cInfo->entry_company_tax_id . xos_draw_hidden_field('entry_company_tax_id'));
        }
      } else {
        $smarty->assign('company_tax_id_in_out_values', xos_draw_input_field('entry_company_tax_id', $cInfo->entry_company_tax_id, 'maxlength="32"'));
      }
      
      if ($error == true) {
        if ($customers_group_ra_error == true) {
          $smarty->assign('customers_group_ra_in_out_values', xos_draw_radio_field('customers_group_ra', '0', false, $cInfo->customers_group_ra) . '&nbsp;&nbsp;' . ENTRY_CUSTOMERS_GROUP_RA_NO . '&nbsp;&nbsp;' . xos_draw_radio_field('customers_group_ra', '1', false, $cInfo->customers_group_ra) . '&nbsp;&nbsp;' . ENTRY_CUSTOMERS_GROUP_RA_YES . '&nbsp;' . ENTRY_CUSTOMERS_GROUP_RA_ERROR);
        } else {
          $smarty->assign('customers_group_ra_in_out_values', ($cInfo->customers_group_ra == '' ? '' : (($cInfo->customers_group_ra == '0') ? ENTRY_CUSTOMERS_GROUP_RA_NO : ENTRY_CUSTOMERS_GROUP_RA_YES)) . xos_draw_hidden_field('customers_group_ra'));
        }
      } else {
        $smarty->assign('customers_group_ra_in_out_values', xos_draw_radio_field('customers_group_ra', '0', false, $cInfo->customers_group_ra) . '&nbsp;&nbsp;' . ENTRY_CUSTOMERS_GROUP_RA_NO . '&nbsp;&nbsp;' . xos_draw_radio_field('customers_group_ra', '1', false, $cInfo->customers_group_ra) . '&nbsp;&nbsp;' . ENTRY_CUSTOMERS_GROUP_RA_YES);
      }                    
    }

    if ($error == true) {
      if ($entry_street_address_error == true) {
        $smarty->assign('street_address_in_out_values', xos_draw_input_field('entry_street_address', $cInfo->entry_street_address, 'maxlength="64"') . '&nbsp;' . ENTRY_STREET_ADDRESS_ERROR);
      } else {
        $smarty->assign('street_address_in_out_values', $cInfo->entry_street_address . xos_draw_hidden_field('entry_street_address'));
      }
    } else {
      $smarty->assign('street_address_in_out_values', xos_draw_input_field('entry_street_address', $cInfo->entry_street_address, 'maxlength="64"', true));
    }

    if (ACCOUNT_SUBURB == 'true') {
      $smarty->assign('account_suburb', true);
      if ($error == true) {
        $smarty->assign('suburb_in_out_values', $cInfo->entry_suburb . xos_draw_hidden_field('entry_suburb'));
      } else {
        $smarty->assign('suburb_in_out_values', xos_draw_input_field('entry_suburb', $cInfo->entry_suburb, 'maxlength="32"'));
      }    
    }

    if ($error == true) {
      if ($entry_post_code_error == true) {
        $smarty->assign('post_code_in_out_values', xos_draw_input_field('entry_postcode', $cInfo->entry_postcode, 'maxlength="8"') . '&nbsp;' . ENTRY_POST_CODE_ERROR);
      } else {
        $smarty->assign('post_code_in_out_values', $cInfo->entry_postcode . xos_draw_hidden_field('entry_postcode'));
      }
    } else {
      $smarty->assign('post_code_in_out_values', xos_draw_input_field('entry_postcode', $cInfo->entry_postcode, 'maxlength="8"', true));
    }

    if ($error == true) {
      if ($entry_city_error == true) {
        $smarty->assign('city_in_out_values', xos_draw_input_field('entry_city', $cInfo->entry_city, 'maxlength="32"') . '&nbsp;' . ENTRY_CITY_ERROR);
     } else {
        $smarty->assign('city_in_out_values', $cInfo->entry_city . xos_draw_hidden_field('entry_city'));
      }
    } else {
      $smarty->assign('city_in_out_values', xos_draw_input_field('entry_city', $cInfo->entry_city, 'maxlength="32"', true));
    }

    if (ACCOUNT_STATE == 'true') {
      $smarty->assign('account_state', true);
      $entry_state = xos_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state);
      if ($error == true) {
        if ($entry_state_error == true) {
          if ($entry_state_has_zones == true) {
            $zones_array = array();
            $zones_query = xos_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . xos_db_input($cInfo->entry_country_id) . "' order by zone_name");
            while ($zones_values = xos_db_fetch_array($zones_query)) {
              $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
            }
            $smarty->assign('state_in_out_values', xos_draw_pull_down_menu('entry_state', $zones_array) . '&nbsp;' . ENTRY_STATE_ERROR);
          } else {
            $smarty->assign('state_in_out_values', xos_draw_input_field('entry_state', xos_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state)) . '&nbsp;' . ENTRY_STATE_ERROR);
          }
        } else {
          $smarty->assign('state_in_out_values', $entry_state . xos_draw_hidden_field('entry_zone_id') . xos_draw_hidden_field('entry_state'));
        }
      } else {
        $smarty->assign('state_in_out_values', xos_draw_input_field('entry_state', xos_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state)));
      }
    }

    if ($error == true) {
      if ($entry_country_error == true) {
        $smarty->assign('country_in_out_values', xos_draw_pull_down_menu('entry_country_id', xos_get_countries(), $cInfo->entry_country_id) . '&nbsp;' . ENTRY_COUNTRY_ERROR);
      } else {
        $smarty->assign('country_in_out_values', xos_get_country_name($cInfo->entry_country_id) . xos_draw_hidden_field('entry_country_id'));
      }
    } else {
      $smarty->assign('country_in_out_values', xos_draw_pull_down_menu('entry_country_id', xos_get_countries(), $cInfo->entry_country_id));
    }

    if ($error == true) {
      if ($entry_telephone_error == true) {
        $smarty->assign('telephone_in_out_values', xos_draw_input_field('customers_telephone', $cInfo->customers_telephone, 'maxlength="32"') . '&nbsp;' . ENTRY_TELEPHONE_NUMBER_ERROR);
      } else {
        $smarty->assign('telephone_in_out_values', $cInfo->customers_telephone . xos_draw_hidden_field('customers_telephone'));
      }
    } else {
      $smarty->assign('telephone_in_out_values', xos_draw_input_field('customers_telephone', $cInfo->customers_telephone, 'maxlength="32"', true));
    }

    if ($processed == true) {
      $smarty->assign('fax_in_out_values', $cInfo->customers_fax . xos_draw_hidden_field('customers_fax'));
    } else {
      $smarty->assign('fax_in_out_values', xos_draw_input_field('customers_fax', $cInfo->customers_fax, 'maxlength="32"'));
    }
    
    if (NEWSLETTER_ENABLED == 'true') {
      if ($processed == true) {
        if ($cInfo->newsletter_status == '1') {
          $smarty->assign('newsletter_in_out_values', ENTRY_NEWSLETTER_YES . xos_draw_hidden_field('newsletter_status'));
        } else {
          $smarty->assign('newsletter_in_out_values', ENTRY_NEWSLETTER_NO . xos_draw_hidden_field('newsletter_status'));
        }
      } else {
        $smarty->assign('newsletter_in_out_values', xos_draw_pull_down_menu('newsletter_status', $newsletter_array, (($cInfo->newsletter_status == '1') ? '1' : '0')));
      }
    }
    
    if ($processed != true) {
      $index = 0;
      while ($existing_customers =  xos_db_fetch_array($existing_customers_query)) {
        $existing_customers_array[] = array("id" => $existing_customers['customers_group_id'], "text" => '&nbsp;' . $existing_customers['customers_group_name'] . '&nbsp;');
        ++$index;
      }
    }

    if ($processed == true) {
      $customer_group_name_query = xos_db_query("select customers_group_name as name from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" . $cInfo->customers_group_id . "'");
      $customer_group_name =  xos_db_fetch_array($customer_group_name_query);
      $smarty->assign('customers_group_id_in_out_values', $customer_group_name['name'] . xos_draw_hidden_field('customers_group_id'));
    } else {
      $smarty->assign('customers_group_id_in_out_values', xos_draw_pull_down_menu('customers_group_id', $existing_customers_array, $cInfo->customers_group_id));
    }
    
    if ($processed == true) {
      $smarty->assign(array('several_lng_in_admin' => false,
                            'comments_in_out_values' => nl2br($cInfo->customers_comments) . xos_draw_hidden_field('customers_comments')));
    } else {
      $lng_query = xos_db_query("select languages_id from " . TABLE_LANGUAGES . " where use_in_id <> '2'");
      $smarty->assign(array('several_lng_in_admin' => xos_db_num_rows($lng_query) > 1 ? true : false,
                            'comments_in_out_values' => xos_draw_textarea_field('customers_comments', '80', '10', $cInfo->customers_comments)));
    }       

    $smarty->assign(array('edit_or_update' => true,
                          'form_begin_customers' => xos_draw_form('customers', FILENAME_CUSTOMERS, xos_get_all_get_params(array('action')) . 'action=update', 'post', 'onsubmit="return check_form();"'),
                          'hidden_default_address_id' => xos_draw_hidden_field('default_address_id', $cInfo->customers_default_address_id),
                          'link_filename_customers' => xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('action'))),
                          'form_end' => '</form>'));
    
  } else {
  
          switch ($_GET['listing']) {
              case "id-asc":
                $order = "c.customers_id";
                break;
              case "cg_name":
                $order = "cg.customers_group_name, c.customers_lastname";
                break;
              case "cg_name-desc":
                $order = "cg.customers_group_name DESC, c.customers_lastname";
                break;
              case "firstname":
                $order = "c.customers_firstname";
                break;
              case "firstname-desc":
                $order = "c.customers_firstname DESC";
                break;
              case "company":
                $order = "a.entry_company, c.customers_lastname";
                break;
              case "company-desc":
                $order = "a.entry_company DESC,c .customers_lastname DESC";
                break;
              case "ra":
                $order = "c.customers_group_ra DESC, c.customers_id DESC";
                break;
              case "ra-desc":
                $order = "c.customers_group_ra, c.customers_id DESC";
                break;
              case "lastname":
                $order = "c.customers_lastname, c.customers_firstname";
                break;
              case "lastname-desc":
                $order = "c.customers_lastname DESC, c.customers_firstname";
                break;
              default:
                $order = "c.customers_id DESC";
          }  

    $search_string = '';
    if (isset($_GET['search']) && xos_not_null($_GET['search'])) {
      $keywords = xos_db_input(xos_db_prepare_input($_GET['search']));
      $search_string = "where c.customers_lastname like '%" . $keywords . "%' or c.customers_firstname like '%" . $keywords . "%' or c.customers_email_address like '%" . $keywords . "%'";
    }
    $customers_query_raw = "select c.customers_id, c.customers_lastname, c.customers_firstname, c.customers_email_address, c.customers_group_id, c.customers_group_ra, a.entry_country_id, a.entry_company, cg.customers_group_name from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id left join customers_groups cg on c.customers_group_id = cg.customers_group_id " . $search_string . " order by $order";
    $customers_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $customers_query_raw, $customers_query_numrows);
    $customers_query = xos_db_query($customers_query_raw);
    $customers_array = array();
    while ($customers = xos_db_fetch_array($customers_query)) {
      $info_query = xos_db_query("select customers_info_date_account_created as date_account_created, customers_info_date_account_last_modified as date_account_last_modified, customers_info_date_of_last_logon as date_last_logon, customers_info_number_of_logons as number_of_logons from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . $customers['customers_id'] . "'");
      $info = xos_db_fetch_array($info_query);

      if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $customers['customers_id']))) && !isset($cInfo)) {
        $country_query = xos_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$customers['entry_country_id'] . "'");
        $country = xos_db_fetch_array($country_query);

        $reviews_query = xos_db_query("select count(*) as number_of_reviews from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers['customers_id'] . "'");
        $reviews = xos_db_fetch_array($reviews_query);

        $customer_info = array_merge((array)$country, (array)$info, (array)$reviews);

        $cInfo_array = array_merge((array)$customers, (array)$customer_info);
        $cInfo = new objectInfo($cInfo_array);
      }
      
      $selected = false;

      if (isset($cInfo) && is_object($cInfo) && ($customers['customers_id'] == $cInfo->customers_id)) {
        $selected = true;
        $link_filename_customers = xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=edit');
      } else {
        $link_filename_customers = xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID')) . 'cID=' . $customers['customers_id']);
      }

      $customers_array[]=array('selected' => $selected,
                               'link_filename_customers' => $link_filename_customers,
                               'company' => (strlen($customers['entry_company']) > 16 ) ? "<acronym title=\"".$customers['entry_company']."\">".substr($customers['entry_company'], 0, 16)."&nbsp;</acronym>" : $customers['entry_company'],
                               'lastname' => (strlen($customers['customers_lastname']) > 15 ) ? "<acronym title=\"".$customers['customers_lastname']."\">".substr($customers['customers_lastname'], 0, 15)."&nbsp;</acronym>" : $customers['customers_lastname'],
                               'firstname' => (strlen($customers['customers_firstname']) > 15 ) ? "<acronym title=\"".$customers['customers_firstname']."\">".substr($customers['customers_firstname'], 0, 15)."&nbsp;</acronym>" : $customers['customers_firstname'],
                               'group_name' => (strlen($customers['customers_group_name']) > 17 ) ? "<acronym title=\"".$customers['customers_group_name']."\"> ".substr($customers['customers_group_name'], 0, 17)."&nbsp;</acronym>" : $customers['customers_group_name'],
                               'date_account_created' => xos_date_short($info['date_account_created']),
                               'group_ra_status_image' => ($customers['customers_group_ra'] == '1') ? xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_GREEN, 10, 10) : xos_draw_separator('pixel_trans.gif', '10', '10'));
    } 
    
    $smarty->assign(array('link_self_company_sort_asc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=company'),
                          'link_self_lastname_sort_asc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=lastname'),
                          'link_self_firstname_sort_asc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=firstname'),
                          'link_self_cg_name_sort_asc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=cg_name'),
                          'link_self_id_sort_asc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=id-asc'),
                          'link_self_ra_sort_asc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=ra'),
                          'link_self_company_sort_desc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=company-desc'),
                          'link_self_lastname_sort_desc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=lastname-desc'),
                          'link_self_firstname_sort_desc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=firstname-desc'),
                          'link_self_cg_name_sort_desc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=cg_name-desc'),
                          'link_self_id_sort_desc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=id-desc'),
                          'link_self_ra_sort_desc' => xos_href_link(FILENAME_CUSTOMERS, 'listing=ra-desc'),
                          'text_company_sort_asc' => ICON_TITLE_IC_UP_TEXT_SORT . ' ' . ENTRY_COMPANY . ' ' . ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC,
                          'text_lastname_sort_asc' => ICON_TITLE_IC_UP_TEXT_SORT . ' ' . TABLE_HEADING_LASTNAME . ' ' . ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC,
                          'text_firstname_sort_asc' => ICON_TITLE_IC_UP_TEXT_SORT . ' ' . TABLE_HEADING_FIRSTNAME . ' ' . ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC,
                          'text_cg_name_sort_asc' => ICON_TITLE_IC_UP_TEXT_SORT . ' ' . TABLE_HEADING_CUSTOMERS_GROUPS . ' ' . ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC,
                          'text_id_sort_asc' => ICON_TITLE_IC_UP_TEXT_SORT . ' ' . TABLE_HEADING_ACCOUNT_CREATED . ' ' . ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC,
                          'text_ra_sort_asc' => ICON_TITLE_IC_UP_TEXT_SORT . ' ' . TABLE_HEADING_REQUEST_AUTHENTICATION . ' ' . ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC,
                          'text_company_sort_desc' => ICON_TITLE_IC_DOWN_TEXT_SORT . ' ' . ENTRY_COMPANY . ' ' . ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX,
                          'text_lastname_sort_desc' => ICON_TITLE_IC_DOWN_TEXT_SORT . ' ' . TABLE_HEADING_LASTNAME . ' ' . ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX,
                          'text_firstname_sort_desc' => ICON_TITLE_IC_DOWN_TEXT_SORT . ' ' . TABLE_HEADING_FIRSTNAME . ' ' . ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX,
                          'text_cg_name_sort_desc' => ICON_TITLE_IC_DOWN_TEXT_SORT . ' ' . TABLE_HEADING_CUSTOMERS_GROUPS . ' ' . ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX,
                          'text_id_sort_desc' => ICON_TITLE_IC_DOWN_TEXT_SORT . ' ' . TABLE_HEADING_ACCOUNT_CREATED . ' ' . ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX,
                          'text_ra_sort_desc' => ICON_TITLE_IC_DOWN_TEXT_SORT . ' ' . TABLE_HEADING_REQUEST_AUTHENTICATION . ' ' . ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX));

    if (SID) {
      $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
    }
        
    $smarty->assign(array('form_begin_search' => xos_draw_form('search', FILENAME_CUSTOMERS, '', 'get'),
                          'input_search' => xos_draw_input_field('search'),
                          'form_end' => '</form>',
                          'customers' => $customers_array,
                          'nav_bar_number' => $customers_split->display_count($customers_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS),
                          'nav_bar_result' => $customers_split->display_links($customers_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], xos_get_all_get_params(array('page', 'info', 'x', 'y', 'cID')))));

    if (isset($_GET['search']) && xos_not_null($_GET['search'])) {      
      $smarty->assign('link_filename_customers_reset', xos_href_link(FILENAME_CUSTOMERS));
    }

    require(DIR_WS_BOXES . 'infobox_customers.php');
  }
  
  $smarty->assign('BODY_TAG_PARAMS', 'onload="SetFocus();"');  

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'customers');
  $output_customers = $smarty->fetch(ADMIN_TPL . '/customers.tpl');
  
  $smarty->assign('central_contents', $output_customers);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
