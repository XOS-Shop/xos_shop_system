<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : checkout_payment_address.php
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
//              filename: checkout_payment_address.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CHECKOUT_PAYMENT_ADDRESS) == 'overwrite_all')) :
// if the customer is not logged on, redirect them to the login page
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($_SESSION['cart']->count_contents() < 1) {
    xos_redirect(xos_href_link(FILENAME_SHOPPING_CART), false);
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CHECKOUT_PAYMENT_ADDRESS);

  $error = false;
  $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'submit') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
// process a new billing address
    if (xos_not_null($_POST['firstname']) && xos_not_null($_POST['lastname']) && xos_not_null($_POST['street_address'])) {
      $process = true;

      if (ACCOUNT_GENDER == 'true') $gender = xos_db_prepare_input($_POST['gender']);
      if (ACCOUNT_COMPANY == 'true') $company = xos_db_prepare_input($_POST['company']);
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

          $messageStack->add('checkout_address', ENTRY_GENDER_ERROR);
        }
      }

      if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_FIRST_NAME_ERROR);
      }

      if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_LAST_NAME_ERROR);
      }

      if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_STREET_ADDRESS_ERROR);
      }

      if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_POST_CODE_ERROR);
      }

      if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_CITY_ERROR);
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

            $messageStack->add('checkout_address', ENTRY_STATE_ERROR_SELECT);
          }
        } else {
          if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
            $error = true;

            $messageStack->add('checkout_address', ENTRY_STATE_ERROR);
          }
        }
      }

      if ( (is_numeric($country) == false) || ($country < 1) ) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_COUNTRY_ERROR);
      }

      if ($error == false) {
        $sql_data_array = array('customers_id' => $_SESSION['customer_id'],
                                'entry_firstname' => $firstname,
                                'entry_lastname' => $lastname,
                                'entry_street_address' => $street_address,
                                'entry_postcode' => $postcode,
                                'entry_city' => $city,
                                'entry_country_id' => $country);

        if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
        if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
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

        $_SESSION['billto'] = xos_db_insert_id();

        if (isset($_SESSION['payment'])) unset($_SESSION['payment']);

        xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
      }
// process the selected billing destination
    } elseif (isset($_POST['address'])) {
      $reset_payment = false;
      if (isset($_SESSION['billto'])) {
        if ($_SESSION['billto'] != $_POST['address']) {
          if (isset($_SESSION['payment'])) {
            $reset_payment = true;
          }
        }
      }

      $_SESSION['billto'] = $_POST['address'];

      $check_address_query = xos_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and address_book_id = '" . (int)$_SESSION['billto'] . "'");
      $check_address = xos_db_fetch_array($check_address_query);

      if ($check_address['total'] == '1') {
        if ($reset_payment == true) unset($_SESSION['payment']);
        xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
      } else {
        unset($_SESSION['billto']);
      }
// no addresses to select from - customer decided to keep the current assigned address
    } else {
      $_SESSION['billto'] = $_SESSION['customer_default_address_id'];

      xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }
  }

// if no billing destination address was selected, use their own address as default
  if (!isset($_SESSION['billto'])) {
    $_SESSION['billto'] = $_SESSION['customer_default_address_id'];
  }

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL'));

  $addresses_count = xos_count_customer_address_book_entries();

  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                'var selected;' . "\n\n" .

                'function selectRowEffect(object, buttonSelect) {' . "\n" .
                '  if (!selected) {' . "\n" .
                '    if (document.getElementById) {' . "\n" .
                '      selected = document.getElementById("default-selected");' . "\n" .
                '    } else {' . "\n" .
                '      selected = document.all["default-selected"];' . "\n" .
                '    }' . "\n" .
                '  }' . "\n\n" .

                '  if (selected) selected.className = "module-row";' . "\n" .
                '  object.className = "module-row-selected";' . "\n" .
                '  selected = object;' . "\n\n" .

                '// one button is not an array' . "\n" .
                '  if (document.checkout_address.address[0]) {' . "\n" .
                '    document.checkout_address.address[buttonSelect].checked=true;' . "\n" .
                '  } else {' . "\n" .
                '    document.checkout_address.address.checked=true;' . "\n" .
                '  }' . "\n" .
                '}' . "\n\n" .

                'function rowOverEffect(object) {' . "\n" .
                '  if (object.className == "module-row") object.className = "module-row-over";' . "\n" .
                '}' . "\n\n" .

                'function rowOutEffect(object) {' . "\n" .
                '  if (object.className == "module-row-over") object.className = "module-row";' . "\n" .
                '}' . "\n\n" . 
                
                'function check_form_optional(form_name) {' . "\n" .
                '  var form = form_name;' . "\n\n" .

                '  var firstname = form.elements[\'firstname\'].value;' . "\n" .
                '  var lastname = form.elements[\'lastname\'].value;' . "\n" .
                '  var street_address = form.elements[\'street_address\'].value;' . "\n\n" .

                '  if (firstname == "" && lastname == "" && street_address == "") {' . "\n" .
                '    return true;' . "\n" .
                '  } else {' . "\n" .
                '    return check_form(form_name);' . "\n" .
                '  }' . "\n" .
                '}' . "\n" .
                '/* ]]> */' . "\n" .                                
                '</script> ' . "\n";  
  
  require(DIR_WS_INCLUDES . 'form_check.js.php');
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');
  require(DIR_WS_MODULES . 'checkout_new_address.php');  

  if ($messageStack->size('checkout_address') > 0) {  
    $smarty->assign('message_stack', $messageStack->output('checkout_address'));
  }

  if ($process == false) {  
    $smarty->assign('address_label', xos_address_label($_SESSION['customer_id'], $_SESSION['billto'], true, ' ', '<br />'));
    if ($addresses_count > 1) {
      $radio_buttons = 0;
      $addresses_query = xos_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
      $addresses_array = array();
      while ($addresses = xos_db_fetch_array($addresses_query)) {
        $format_id = xos_get_address_format_id($addresses['country_id']);
       ($addresses['address_book_id'] == $_SESSION['billto']) ? $actual_address = true : $actual_address = false;

        $addresses_array[]=array('radio_field' => xos_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $_SESSION['billto']), 'id="address_' . $radio_buttons . '"'),
                                 'actual_address' => $actual_address,
                                 'address_name' => xos_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']),
                                 'full_address' => xos_address_format($format_id, $addresses, true, ' ', ', '),
                                 'radio_select' => $radio_buttons);
        $radio_buttons++;
      }

      $smarty->assign(array('several_addresses' => true,
                            'addresses' => $addresses_array));
    }
  }

  if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) {  
    $smarty->assign('not_max_address_book_entries', true);
  }

  if ($process == true) {  
    $smarty->assign(array('process' => true,
                          'link_filename_checkout_payment_address' => xos_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL')));
  }

  $smarty->assign(array('form_begin' => xos_draw_form('checkout_address', xos_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL'), 'post', 'onsubmit="return check_form_optional(checkout_address);"', true),
                        'form_end' => '</form>',
                        'hidden_field_submit' => xos_draw_hidden_field('action', 'submit'),
                        'link_filename_checkout_shipping' => xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')));
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'checkout_payment_address');
  $output_checkout_payment_address = $smarty->fetch(SELECTED_TPL . '/checkout_payment_address.tpl');
                        
  $smarty->assign('central_contents', $output_checkout_payment_address);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
