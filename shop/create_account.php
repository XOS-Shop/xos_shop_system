<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : create_account.php
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
//              filename: create_account.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CREATE_ACCOUNT) == 'overwrite_all')) :
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    xos_redirect(xos_href_link(FILENAME_COOKIE_USAGE));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CREATE_ACCOUNT);

  $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    $process = true;

    if (ACCOUNT_GENDER == 'true') {
      if (isset($_POST['gender'])) {
        $gender = xos_db_prepare_input($_POST['gender']);
      } else {
        $gender = false;
      }
    }
    $firstname = xos_db_prepare_input($_POST['firstname']);
    $lastname = xos_db_prepare_input($_POST['lastname']);
    if (ACCOUNT_DOB == 'true') {
      $dob_month = xos_db_prepare_input($_POST['dob_month']);    
      $dob_day = xos_db_prepare_input($_POST['dob_day']);
      $dob_year = xos_db_prepare_input($_POST['dob_year']);
    }  
    $email_address = xos_db_prepare_input($_POST['email_address']);    
    if (isset($_POST['languages'])) { 
      $language_id = xos_db_prepare_input($_POST['languages']);
    } else {    
      $language_id = $_SESSION['languages_id'];
    }
    if (ACCOUNT_COMPANY == 'true') {
      $company = xos_db_prepare_input($_POST['company']);
      $company_tax_id = xos_db_prepare_input($_POST['company_tax_id']);
    } 
    $street_address = xos_db_prepare_input($_POST['street_address']);
    if (ACCOUNT_SUBURB == 'true') $suburb = xos_db_prepare_input($_POST['suburb']);
    $postcode = xos_db_prepare_input($_POST['postcode']);
    $city = xos_db_prepare_input($_POST['city']);
    if (ACCOUNT_STATE == 'true') {
      $state = xos_db_prepare_input($_POST['state']);
      if (isset($_POST['zone_id'])) {
        $zone_id = xos_db_prepare_input($_POST['zone_id']);
      } else {
        $zone_id = false;
      }
    }
    $country = xos_db_prepare_input($_POST['country']);
    $telephone = xos_db_prepare_input($_POST['telephone']);
    $fax = xos_db_prepare_input($_POST['fax']);
    if (isset($_POST['newsletter'])) {
      $newsletter = xos_db_prepare_input($_POST['newsletter']);
    } else {
      $newsletter = false;
    }
    $password = xos_db_prepare_input($_POST['password']);
    $confirmation = xos_db_prepare_input($_POST['confirmation']);

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('create_account', ENTRY_GENDER_ERROR);
      }
    } 

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
      if ((strlen($dob_month . $dob_day . $dob_year) != 8) || (ctype_digit($dob_month . $dob_day . $dob_year) == false) || (@checkdate($dob_month, $dob_day, $dob_year) == false)) {
        $error = true;

        $messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (xos_validate_email($email_address) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    } else {
      $check_email_query = xos_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . xos_db_input($email_address) . "'");
      $check_email = xos_db_fetch_array($check_email_query);
      if ($check_email['total'] > 0) {
        $error = true;

        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      }
    }

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_POST_CODE_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_CITY_ERROR);
    }

    if (is_numeric($country) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
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

          $messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('create_account', ENTRY_STATE_ERROR);
        }
      }
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_TELEPHONE_NUMBER_ERROR);
    }


    if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR);
    } elseif ($password != $confirmation) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
    }

    if ($error == false) {
      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_language_id' => $language_id,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_password' => xos_encrypt_password($password));

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = $dob_year . $dob_month . $dob_day;
      // if you would like to have an alert in the admin section when either a company name has been entered in
      // the appropriate field or a tax id number, or both then uncomment the next line and comment the default
      // setting: only alert when a tax_id number has been given
      //if ( (ACCOUNT_COMPANY == 'true' && xos_not_null($company) ) || (ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id) ) ) {      
      if ( ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id)  ) {
        $sql_data_array['customers_group_ra'] = '1';
      }
      
      xos_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $_SESSION['customer_id'] = xos_db_insert_id();

      $sql_data_array = array('customers_id' => $_SESSION['customer_id'],
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') {
        $sql_data_array['entry_company'] = $company;
        $sql_data_array['entry_company_tax_id'] = $company_tax_id;
      }
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

      xos_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = xos_db_insert_id();

      xos_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$_SESSION['customer_id'] . "'");

      xos_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$_SESSION['customer_id'] . "', '0', now())");
      
      $check_subscriber_query = xos_db_query("select subscriber_id, newsletter_status from " . TABLE_NEWSLETTER_SUBSCRIBERS . " where subscriber_email_address = '" . xos_db_input($email_address) . "'");
      if (xos_db_num_rows($check_subscriber_query)) {
        $check_subscriber = xos_db_fetch_array($check_subscriber_query);

        if ($newsletter == '1' && $check_subscriber['newsletter_status'] == '0') {
          xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set customers_id = '" . (int)$_SESSION['customer_id'] . "', subscriber_language_id = '" . xos_db_input($language_id) . "', newsletter_status = '" . xos_db_input($newsletter) . "', newsletter_status_change = now() where subscriber_id = '" . (int)$check_subscriber['subscriber_id'] . "'");                
        } else {
          xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set customers_id = '" . (int)$_SESSION['customer_id'] . "', subscriber_language_id = '" . xos_db_input($language_id) . "' where subscriber_id = '" . (int)$check_subscriber['subscriber_id'] . "'");
        }                                                   
      } else {
        $identity_code  = xos_create_random_value(12);
        xos_db_query("insert into " . TABLE_NEWSLETTER_SUBSCRIBERS . " (customers_id, subscriber_language_id, subscriber_email_address, subscriber_identity_code, newsletter_status, subscriber_date_added) values ('" . (int)$_SESSION['customer_id'] . "', '" . xos_db_input($language_id) . "', '" . xos_db_input($email_address) . "', '" . $identity_code . "', '" . xos_db_input($newsletter) . "', now())");
      } 
      
      if (SESSION_RECREATE == 'true') {
        xos_session_recreate();
      }

      if (ACCOUNT_GENDER == 'true') {
        $_SESSION['customer_gender'] = $gender;
      }            
      $_SESSION['customer_first_name'] = $firstname;
      $_SESSION['customer_lastname'] = $lastname;
      $_SESSION['customer_default_address_id'] = $address_id;
      $_SESSION['customer_country_id'] = $country;
      $_SESSION['customer_zone_id'] = $zone_id;

// reset session token
      $_SESSION['sessiontoken'] = md5(xos_rand() . xos_rand() . xos_rand() . xos_rand()); 

// restore cart contents
      $_SESSION['cart']->restore_contents();

// build the message content
      if (SEND_EMAILS == 'true') {
      
        $smarty->unregisterFilter('output','smarty_outputfilter_trimwhitespace');
      
        $name = $firstname . ' ' . $lastname;

        if (ACCOUNT_GENDER == 'true') {
           if ($gender == 'm') {
             $smarty->assign('email_greet', sprintf(EMAIL_GREET_MR, $lastname));
           } else {
             $smarty->assign('email_greet', sprintf(EMAIL_GREET_MS, $lastname));
           }
        } else {
          $smarty->assign('email_greet', sprintf(EMAIL_GREET_NONE, $name));
        }

        $smarty->assign(array('html_params' => HTML_PARAMS,
                              'xhtml_lang' => XHTML_LANG,
                              'charset' => CHARSET,
                              'store_name_address' => STORE_NAME_ADDRESS,
                              'store_name' => STORE_NAME,
                              'src_embedded_shop_logo' => 'cid:shop_logo',
                              'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . SELECTED_TPL . '/') . EMAIL_SHOP_LOGO,
                              'store_owner_email_address' => STORE_OWNER_EMAIL_ADDRESS));
      
        $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'create_account_email_html');
        $output_create_account_email_html = $smarty->fetch(SELECTED_TPL . '/includes/email/create_account_email_html.tpl');
        $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'create_account_email_text');  
        $output_create_account_email_text = $smarty->fetch(SELECTED_TPL . '/includes/email/create_account_email_text.tpl');
        $smarty->clearAssign(array('email_greet',
                                    'html_params',
                                    'xhtml_lang',
                                    'charset',
                                    'store_name_address',
                                    'store_name',
                                    'src_embedded_shop_logo',
                                    'src_shop_logo',
                                    'store_owner_email_address'));  
  
        $email_to_customer = new mailer($name, $email_address, EMAIL_SUBJECT, $output_create_account_email_html, $output_create_account_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SHOP_LOGO);
        
        if(!$email_to_customer->send()) {
          $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_customer->ErrorInfo));
        }
        
        // if you would like to have an email when either a company name has been entered in
        // the appropriate field or a tax id number, or both then uncomment the next line and comment the default
        // setting: only email when a tax_id number has been given
        //if ( (ACCOUNT_COMPANY == 'true' && xos_not_null($company) ) || (ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id) ) ) {        
        if ( ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id) ) {
          $alert_email_text = sprintf(EMAIL_TEXT_COMPANY_ACCOUNT_CREATED, $firstname, $lastname, $company);
                  
          $email_to_store_owner = new mailer(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT_COMPANY_ACCOUNT_CREATED, '', $alert_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        
          if(!$email_to_store_owner->send()) {
            $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_store_owner->ErrorInfo));
          }          
        }          
      }
      
      $_SESSION['navigation']->remove_current_page();
      xos_redirect(xos_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));
    }
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL')); 

  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n";
  require(DIR_WS_INCLUDES . 'form_check.js.php');

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($messageStack->size('create_account') > 0) {
    $smarty->assign('message_stack', $messageStack->output('create_account'));
  }
  
  if (ACCOUNT_GENDER == 'true') {
    $smarty->assign(array('account_gender' => true,
                          'input_gender' => xos_draw_radio_field('gender', 'm', '', 'id="gender_m"') . '<label for="gender_m">&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;</label>' . xos_draw_radio_field('gender', 'f', '', 'id="gender_f"') . '<label for="gender_f">&nbsp;&nbsp;' . FEMALE . '&nbsp;</label>' . (xos_not_null(ENTRY_GENDER_TEXT) ? '<span class="input-requirement">' . ENTRY_GENDER_TEXT . '</span>': '')));
  } 
  
  if (ACCOUNT_DOB == 'true') {
  
    $years = array();
    $years_array = array();
    $year = xos_date_format('%Y');

    $years = range((int)($year - 9), (int)($year - 110));
    rsort($years, SORT_NUMERIC);
//    sort($years, SORT_NUMERIC);
    
    $years_array[] = array('id' => '', 'text' => DATE_OF_BIRTH_ENTRY_TEXT_YEAR);
    
    while (list($key, $value) = each($years)) {    
      $years_array[] = array('id' => $value,
                             'text' => $value);
    }    
    
    $days_array = array();

    $days_array[] = array('id' => '', 'text' => DATE_OF_BIRTH_ENTRY_TEXT_DAY);
 
    for ($i = 1; $i <= 31; $i++) {        
      $days_array[] = array('id' => sprintf('%02d', $i),
                            'text' => sprintf('%02d', $i));        
    }                 
    
    $months_array = array();

    $months_array[] = array('id' => '', 'text' => DATE_OF_BIRTH_ENTRY_TEXT_MONTH);
 
    for ($i = 1; $i <= 12; $i++) {        
      $months_array[] = array('id' => sprintf('%02d', $i),
                              'text' => sprintf('%02d', $i));        
    }
    
    $pull_down_menu_field = '';
    $field_order = strtoupper(DATE_OF_BIRTH_FIELD_ORDER);
    for ($i = 0; $i <= 2; $i++) {
      $c = substr($field_order, $i, 1);
      switch ($c) {
        case 'D':
          $pull_down_menu_field .= xos_draw_pull_down_menu('dob_day', $days_array, (int)$_POST['dob_day'], ($i == 0 ? 'id="dob_first"' : ''));
          break;
        case 'M':
          $pull_down_menu_field .= xos_draw_pull_down_menu('dob_month', $months_array, (int)$_POST['dob_month'], ($i == 0 ? 'id="dob_first"' : ''));
          break;
        case 'Y':
          $pull_down_menu_field .= xos_draw_pull_down_menu('dob_year', $years_array, (int)$_POST['dob_year'], ($i == 0 ? 'id="dob_first"' : ''));
          break;
      } 

      if ($i < 2) {
        $pull_down_menu_field .= DATE_OF_BIRTH_FIELD_SEPARATOR;
//        $pull_down_menu_field .= '&nbsp;' . DATE_OF_BIRTH_FIELD_SEPARATOR . '&nbsp;';
      } 
    }                                        
     
    $smarty->assign(array('account_dob' => true,
                          'pull_down_menus_dob' => $pull_down_menu_field . '&nbsp;' . (xos_not_null(ENTRY_DATE_OF_BIRTH_TEXT_1) ? '<span class="input-requirement">' . ENTRY_DATE_OF_BIRTH_TEXT_1 . '</span>': '')));
  }
  
  if (ACCOUNT_COMPANY == 'true') {
    $smarty->assign(array('account_company' => true,
                          'input_company' => xos_draw_input_field('company', '', 'id="company"') . '&nbsp;' . (xos_not_null(ENTRY_COMPANY_TEXT) ? '<span class="input-requirement">' . ENTRY_COMPANY_TEXT . '</span>': ''),
                          'input_company_tax_id' => xos_draw_input_field('company_tax_id', '', 'id="company_tax_id"') . '&nbsp;' . (xos_not_null(ENTRY_COMPANY_TAX_ID_TEXT) ? '<span class="input-requirement">' . ENTRY_COMPANY_TAX_ID_TEXT . '</span>': '')));
  }
  
  if (ACCOUNT_SUBURB == 'true') {
    $smarty->assign(array('account_suburb' => true,
                          'input_suburb' => xos_draw_input_field('suburb', '', 'id="suburb"') . '&nbsp;' . (xos_not_null(ENTRY_SUBURB_TEXT) ? '<span class="input-requirement">' . ENTRY_SUBURB_TEXT . '</span>': '')));
  }
  
  if (ACCOUNT_STATE == 'true') {
    $smarty->assign('account_state', true);
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = xos_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = xos_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        $smarty->assign('input_state', xos_draw_pull_down_menu('state', $zones_array, '', 'id="state"') . '&nbsp;' . (xos_not_null(ENTRY_STATE_TEXT) ? '<span class="input-requirement">' . ENTRY_STATE_TEXT . '</span>': ''));
      } else {
        $smarty->assign('input_state', xos_draw_input_field('state', '', 'id="state"') . '&nbsp;' . (xos_not_null(ENTRY_STATE_TEXT) ? '<span class="input-requirement">' . ENTRY_STATE_TEXT . '</span>': ''));
      }
    } else {
      $smarty->assign('input_state', xos_draw_input_field('state', '', 'id="state"') . '&nbsp;' . (xos_not_null(ENTRY_STATE_TEXT) ? '<span class="input-requirement">' . ENTRY_STATE_TEXT . '</span>': ''));
    }   
  }               

  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language;
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
      } elseif ($value['id'] == $_SESSION['languages_id']) {
        $languages_selected = $value['id'];
      }                            
    }
    $smarty->assign(array('languages' => true,
                          'pull_down_menu_languages' => xos_draw_pull_down_menu('languages', $lang_array, $languages_selected, 'id="languages"')));
  }

  $popup_status_query = xos_db_query("select status from " . TABLE_CONTENTS . "  where type = 'system_popup' and status = '1' and content_id = '6' LIMIT 1");

  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';        
    $back_link = xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']);
  } else {
    $back_link = 'javascript:history.go(-1)';
  }

  $smarty->assign(array('form_begin' => xos_draw_form('create_account', xos_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_form(create_account);"', true),
                        'hidden_field' => xos_draw_hidden_field('action', 'process'),
                        'link_filename_login' => xos_href_link(FILENAME_LOGIN, xos_get_all_get_params(), 'SSL'),
                        'link_filename_popup_content_6' => xos_db_num_rows($popup_status_query) ? xos_href_link(FILENAME_POPUP_CONTENT, 'content_id=6', $request_type) : '',
                        'input_firstname' => xos_draw_input_field('firstname', '', 'id="firstname"') . '&nbsp;' . (xos_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="input-requirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''),
                        'input_lastname' => xos_draw_input_field('lastname', '', 'id="lastname"') . '&nbsp;' . (xos_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="input-requirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''),
                        'input_email_address' => xos_draw_input_field('email_address', '', 'id="email_address"') . '&nbsp;' . (xos_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="input-requirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''),
                        'input_street_address' => xos_draw_input_field('street_address', '', 'id="street_address"') . '&nbsp;' . (xos_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="input-requirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''),
                        'input_postcode' => xos_draw_input_field('postcode', '', 'id="postcode"') . '&nbsp;' . (xos_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="input-requirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''),
                        'input_city' => xos_draw_input_field('city', '', 'id="city"') . '&nbsp;' . (xos_not_null(ENTRY_CITY_TEXT) ? '<span class="input-requirement">' . ENTRY_CITY_TEXT . '</span>': ''),
                        'input_country' => xos_get_country_list('country', '', 'id="country"') . '&nbsp;' . (xos_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="input-requirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''),
                        'input_telephone' => xos_draw_input_field('telephone', '', 'id="telephone"') . '&nbsp;' . (xos_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="input-requirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''),
                        'input_fax' => xos_draw_input_field('fax', '', 'id="fax"') . '&nbsp;' . (xos_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="input-requirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''),
                        'input_newsletter' => (NEWSLETTER_ENABLED == 'true') ? xos_draw_checkbox_field('newsletter', '1', '', 'id="newsletter"') . '&nbsp;' . (xos_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="input-requirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': '') : '',
                        'input_password' => xos_draw_password_field('password', '', 'id="password"') . '&nbsp;' . (xos_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="input-requirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''),
                        'input_confirmation' => xos_draw_password_field('confirmation', '', 'id="confirmation"') . '&nbsp;' . (xos_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="input-requirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''),
                        'link_back' => $back_link,
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'create_account');
  $output_create_account = $smarty->fetch(SELECTED_TPL . '/create_account.tpl');
                        
  $smarty->assign('central_contents', $output_create_account);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
