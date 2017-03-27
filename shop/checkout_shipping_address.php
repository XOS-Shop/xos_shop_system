<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : checkout_shipping_address.php
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
//              filename: checkout_shipping_address.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CHECKOUT_SHIPPING_ADDRESS) == 'overwrite_all')) :
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
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CHECKOUT_SHIPPING_ADDRESS);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed
  if ($order->content_type == 'virtual') { 
    $_SESSION['shipping'] = false;
    $_SESSION['sendto'] = false;
    xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  }

  $error = false;
  $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'submit') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
// process a new shipping address
    if (xos_not_null($_POST['firstname']) || xos_not_null($_POST['lastname']) || xos_not_null($_POST['street_address'])) {
      $process = true;

      if (ACCOUNT_GENDER == 'true') $gender = $_POST['gender'];
      if (ACCOUNT_COMPANY == 'true') $company = $_POST['company'];
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

          $messageStack->add('checkout_address', ENTRY_GENDER_ERROR);
          $smarty->assign('gender_error', true);
        }
      }

      if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_FIRST_NAME_ERROR);
        $smarty->assign('first_name_error', true);
      }

      if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_LAST_NAME_ERROR);
        $smarty->assign('last_name_error', true);
      }

      if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_STREET_ADDRESS_ERROR);
        $smarty->assign('street_address_error', true);
      }

      if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_POST_CODE_ERROR);
        $smarty->assign('post_code_error', true);
      }

      if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_CITY_ERROR);
        $smarty->assign('city_error', true);
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
            FROM   " . TABLE_ZONES . "
            WHERE  zone_country_id = :country
            AND    zone_name = :state"
          );
          
          $DB->perform($zone_query, array(':country' => (int)$country,
                                          ':state' => $state));
                   
          if ($zone_query->rowCount() == 1) {
            $zone = $zone_query->fetch();
            $zone_id = $zone['zone_id'];
          } else {
            $error = true;

            $messageStack->add('checkout_address', ENTRY_STATE_ERROR_SELECT);
            $smarty->assign('state_error', true);
          }
        } else {
          if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
            $error = true;

            $messageStack->add('checkout_address', ENTRY_STATE_ERROR);
            $smarty->assign('state_error', true);
          }
        }
      }

      if ( (is_numeric($country) == false) || ($country < 1) ) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_COUNTRY_ERROR);
        $smarty->assign('country_error', true);
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

        $DB->insertPrepareExecute(TABLE_ADDRESS_BOOK, $sql_data_array);

        $_SESSION['sendto'] = $DB->lastInsertId();

        if (isset($_SESSION['shipping'])) unset($_SESSION['shipping']);

        xos_redirect(xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      }
// process the selected shipping destination
    } elseif (isset($_POST['address'])) {
      $reset_shipping = false;
      if (isset($_SESSION['sendto'])) {
        if ($_SESSION['sendto'] != $_POST['address']) {
          if (isset($_SESSION['shipping'])) {
            $reset_shipping = true;
          }
        }     
      }

      $_SESSION['sendto'] = $_POST['address'];

      $check_address_query = $DB->prepare
      (
       "SELECT Count(*) AS total
        FROM   " . TABLE_ADDRESS_BOOK . "
        WHERE  customers_id = :customer_id
        AND    address_book_id = :sendto"
      );
      
      $DB->perform($check_address_query, array(':customer_id' => (int)$_SESSION['customer_id'],
                                               ':sendto' => (int)$_SESSION['sendto']));
                                                
      $check_address = $check_address_query->fetch();

      if ($check_address['total'] == '1') {
        if ($reset_shipping == true) unset($_SESSION['shipping']);
        xos_redirect(xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      } else {
        unset($_SESSION['sendto']);
      }
    } else {
      $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];

      xos_redirect(xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// if no shipping destination address was selected, use their own address as default
  if (!isset($_SESSION['sendto'])) {
    $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];
  }

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'));

  $addresses_count = xos_count_customer_address_book_entries();
  
  $add_header = '<script type="text/javascript">' . "\n" .
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
                 
                '/* ]]> */' . "\n" .                               
                '</script> ' . "\n";  
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');
  require(DIR_WS_MODULES . 'checkout_new_address.php');  

  if ($messageStack->size('checkout_address') > 0) {  
    $smarty->assign('message_stack', $messageStack->output('checkout_address'));
    $smarty->assign('message_stack_error', $messageStack->output('checkout_address', 'error'));
    $smarty->assign('message_stack_warning', $messageStack->output('checkout_address', 'warning')); 
    $smarty->assign('message_stack_success', $messageStack->output('checkout_address', 'success'));    
  }

  if ($process == false) {  
    $smarty->assign('address_label', xos_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br />'));
    if ($addresses_count > 1) { 
      $radio_buttons = 0;
      $addresses_query = $DB->prepare
      (
       "SELECT address_book_id,
               entry_firstname      AS firstname,
               entry_lastname       AS lastname,
               entry_company        AS company,
               entry_street_address AS street_address,
               entry_suburb         AS suburb,
               entry_city           AS city,
               entry_postcode       AS postcode,
               entry_state          AS state,
               entry_zone_id        AS zone_id,
               entry_country_id     AS country_id
        FROM   " . TABLE_ADDRESS_BOOK . "
        WHERE  customers_id = :customer_id"
      );
      
      $DB->perform($addresses_query, array(':customer_id' => (int)$_SESSION['customer_id']));
      
      $addresses_array = array();
      while ($addresses = $addresses_query->fetch()) {
        $format_id = xos_get_address_format_id($addresses['country_id']);
       ($addresses['address_book_id'] == $_SESSION['sendto']) ? $actual_address = true : $actual_address = false;

        $addresses_array[]=array('radio_field' => xos_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $_SESSION['sendto']), 'id="address_' . $radio_buttons . '"'),
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
                          'link_filename_checkout_shipping_address' => xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')));
  }

  $smarty->assign(array('form_begin' => xos_draw_form('checkout_address', xos_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'), 'post', 'onsubmit="return true;"', true),
                        'form_end' => '</form>',
                        'hidden_field_submit' => xos_draw_hidden_field('action', 'submit')));
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'checkout_shipping_address');
  $output_checkout_shipping_address = $smarty->fetch(SELECTED_TPL . '/checkout_shipping_address.tpl');
                        
  $smarty->assign('central_contents', $output_checkout_shipping_address);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;