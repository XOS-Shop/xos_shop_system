<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : paypal_standard.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2008 Hanspeter Zeller
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
//              Copyright (c) 2008 osCommerce
//              filename: paypal_standard.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class paypal_standard {
    var $code, $title, $description, $enabled;

// class constructor
    function paypal_standard() {
      global $order;

      $this->signature = 'paypal|paypal_standard|1.0|2.2';

      $this->code = 'paypal_standard';
      $this->title = MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_TITLE;
      $this->public_title = MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PUBLIC_TITLE;
      $this->description = MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PAYPAL_STANDARD_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_PAYPAL_STANDARD_STATUS == 'true') ? true : false);

      if ((int)MODULE_PAYMENT_PAYPAL_STANDARD_PREPARE_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PAYPAL_STANDARD_PREPARE_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      if (MODULE_PAYMENT_PAYPAL_STANDARD_GATEWAY_SERVER == 'Live') {
        $this->form_action_url = 'https://www.paypal.com/cgi-bin/webscr';
      } else {
        $this->form_action_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
      }
    }
    
// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PAYPAL_STANDARD_ZONE > 0) ) {
        $check_flag = false;
        $check_query = xos_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAYPAL_STANDARD_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = xos_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function selection() {

      if (isset($_SESSION['cart_PayPal_Standard_ID'])) {
        $order_id = substr($_SESSION['cart_PayPal_Standard_ID'], strpos($_SESSION['cart_PayPal_Standard_ID'], '-')+1);

        $check_query = xos_db_query('select orders_id from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '" limit 1');

        if (xos_db_num_rows($check_query) < 1) {
          xos_db_query('delete from ' . TABLE_ORDERS . ' where orders_id = "' . (int)$order_id . '"');
          xos_db_query('delete from ' . TABLE_ORDERS_TOTAL . ' where orders_id = "' . (int)$order_id . '"');
          xos_db_query('delete from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '"');
          xos_db_query('delete from ' . TABLE_ORDERS_PRODUCTS . ' where orders_id = "' . (int)$order_id . '"');
          xos_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . ' where orders_id = "' . (int)$order_id . '"');
          xos_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_DOWNLOAD . ' where orders_id = "' . (int)$order_id . '"');

          unset($_SESSION['cart_PayPal_Standard_ID']);
        }
      }

      return array('id' => $this->code,
                   'module' => $this->public_title);
    }

    function pre_confirmation_check() {

      if (empty($_SESSION['cart']->cartID)) {
        $_SESSION['cartID'] = $_SESSION['cart']->cartID = $_SESSION['cart']->generate_cart_id();
      }
    }

    function confirmation() {
      global $order, $order_total_modules;

      if (isset($_SESSION['cartID'])) {
        $insert_order = false;

        if (isset($_SESSION['cart_PayPal_Standard_ID'])) {
          $order_id = substr($_SESSION['cart_PayPal_Standard_ID'], strpos($_SESSION['cart_PayPal_Standard_ID'], '-')+1);

          $curr_check = xos_db_query("select currency from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
          $curr = xos_db_fetch_array($curr_check);

          if ( ($curr['currency'] != $order->info['currency']) || ($_SESSION['cartID'] != substr($_SESSION['cart_PayPal_Standard_ID'], 0, strlen($_SESSION['cartID']))) ) {
            $check_query = xos_db_query('select orders_id from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '" limit 1');

            if (xos_db_num_rows($check_query) < 1) {
              xos_db_query('delete from ' . TABLE_ORDERS . ' where orders_id = "' . (int)$order_id . '"');
              xos_db_query('delete from ' . TABLE_ORDERS_TOTAL . ' where orders_id = "' . (int)$order_id . '"');
              xos_db_query('delete from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '"');
              xos_db_query('delete from ' . TABLE_ORDERS_PRODUCTS . ' where orders_id = "' . (int)$order_id . '"');
              xos_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . ' where orders_id = "' . (int)$order_id . '"');
              xos_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_DOWNLOAD . ' where orders_id = "' . (int)$order_id . '"');
            }

            $insert_order = true;
          }
        } else {
          $insert_order = true;
        }
        
        if ($insert_order == true) {
          $order_totals = array();
          if (is_array($order_total_modules->modules)) {
            reset($order_total_modules->modules);
            while (list(, $value) = each($order_total_modules->modules)) {
              $class = substr($value, 0, strrpos($value, '.'));
              if ($GLOBALS[$class]->enabled) {
                for ($i=0, $n=sizeof($GLOBALS[$class]->output); $i<$n; $i++) {
                  if (xos_not_null($GLOBALS[$class]->output[$i]['title']) && xos_not_null($GLOBALS[$class]->output[$i]['text'])) {
                    $order_totals[] = array('code' => $GLOBALS[$class]->code,
                                            'title' => $GLOBALS[$class]->output[$i]['title'],
                                            'text' => $GLOBALS[$class]->output[$i]['text'],
                                            'value' => $GLOBALS[$class]->output[$i]['value'],
                                            'tax' => $GLOBALS[$class]->output[$i]['tax'],
                                            'sort_order' => $GLOBALS[$class]->sort_order);
                  }
                }                                                                            
              }
            }
          }

          $sql_data_array = array('customers_id' => $_SESSION['customer_id'],
                                  'customers_c_id' => $order->customer['c_id'],
                                  'customers_name' => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
                                  'customers_company' => $order->customer['company'],
                                  'customers_street_address' => $order->customer['street_address'],
                                  'customers_suburb' => $order->customer['suburb'],
                                  'customers_city' => $order->customer['city'],
                                  'customers_postcode' => $order->customer['postcode'], 
                                  'customers_state' => $order->customer['state'], 
                                  'customers_country' => $order->customer['country']['title'], 
                                  'customers_telephone' => $order->customer['telephone'], 
                                  'customers_email_address' => $order->customer['email_address'],
                                  'customers_address_format_id' => $order->customer['format_id'], 
                                  'delivery_name' => trim($order->delivery['firstname'] . ' ' . $order->delivery['lastname']), 
                                  'delivery_company' => $order->delivery['company'],
                                  'delivery_street_address' => $order->delivery['street_address'], 
                                  'delivery_suburb' => $order->delivery['suburb'], 
                                  'delivery_city' => $order->delivery['city'], 
                                  'delivery_postcode' => $order->delivery['postcode'], 
                                  'delivery_state' => $order->delivery['state'], 
                                  'delivery_country' => $order->delivery['country']['title'], 
                                  'delivery_address_format_id' => $order->delivery['format_id'], 
                                  'billing_name' => $order->billing['firstname'] . ' ' . $order->billing['lastname'], 
                                  'billing_company' => $order->billing['company'],
                                  'billing_street_address' => $order->billing['street_address'], 
                                  'billing_suburb' => $order->billing['suburb'], 
                                  'billing_city' => $order->billing['city'], 
                                  'billing_postcode' => $order->billing['postcode'], 
                                  'billing_state' => $order->billing['state'], 
                                  'billing_country' => $order->billing['country']['title'], 
                                  'billing_address_format_id' => $order->billing['format_id'], 
                                  'payment_method' => $order->info['payment_method'], 
                                  'date_purchased' => 'now()', 
                                  'orders_status' => $order->info['order_status'],
                                  'language_id' => $_SESSION['languages_id'],
                                  'language_directory' => $_SESSION['language'], 
                                  'currency' => $order->info['currency'], 
                                  'currency_value' => $order->info['currency_value']); 
                                  
          xos_db_perform(TABLE_ORDERS, $sql_data_array);
  
          $insert_id = xos_db_insert_id(); 
  
          for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
            $sql_data_array = array('orders_id' => $insert_id,
                                    'title' => $order_totals[$i]['title'],
                                    'text' => $order_totals[$i]['text'],
                                    'value' => $order_totals[$i]['value'],
                                    'tax' => $order_totals[$i]['tax'], 
                                    'class' => $order_totals[$i]['code'], 
                                    'sort_order' => $order_totals[$i]['sort_order']);
                                    
            xos_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
          }
          
          for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
          
            $attributes_sting = null;
            if (strpos($order->products[$i]['id'], '-') !== false) {
              list($prid, $attributes_sting) = explode('-', $order->products[$i]['id']);
            }          
          
            $sql_data_array = array('orders_id' => $insert_id, 
                                    'products_id' => xos_get_prid($order->products[$i]['id']),
                                    'products_attributes_sting' => $attributes_sting, 
                                    'products_model' => $order->products[$i]['model'], 
                                    'products_name' => $order->products[$i]['name'],
                                    'products_p_unit' => $order->products[$i]['packaging_unit'], 
                                    'products_price' => $order->products[$i]['price'], 
                                    'final_price' => $order->products[$i]['final_price'],
                                    'products_price_text' => $order->products[$i]['price_formated'], 
                                    'final_price_text' => $order->products[$i]['final_price_formated'],
                                    'total_price_text' => $order->products[$i]['total_price_formated'],                                      
                                    'products_tax' => $order->products[$i]['tax'], 
                                    'products_quantity' => $order->products[$i]['qty']);

            xos_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);

            $order_products_id = xos_db_insert_id();
                           
            $attributes_exist = '0';
            if (isset($order->products[$i]['attributes'])) {
              $attributes_exist = '1';         
              for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
                if (DOWNLOAD_ENABLED == 'true') {
                  $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename 
                                       from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa 
                                       left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                       on pa.products_attributes_id=pad.products_attributes_id
                                       where pa.products_id = '" . $order->products[$i]['id'] . "' 
                                       and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' 
                                       and pa.options_id = popt.products_options_id 
                                       and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' 
                                       and pa.options_values_id = poval.products_options_values_id 
                                       and popt.language_id = '" . $_SESSION['languages_id'] . "' 
                                       and poval.language_id = '" . $_SESSION['languages_id'] . "'";
                  $attributes = xos_db_query($attributes_query);
                } else {
                  $attributes = xos_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $_SESSION['languages_id'] . "' and poval.language_id = '" . $_SESSION['languages_id'] . "'");
                }
                $attributes_values = xos_db_fetch_array($attributes);

                $sql_data_array = array('orders_id' => $insert_id, 
                                        'orders_products_id' => $order_products_id, 
                                        'products_options' => $attributes_values['products_options_name'],
                                        'products_options_values' => $attributes_values['products_options_values_name'], 
                                        'options_values_price' => $order->products[$i]['attributes'][$j]['price'],
                                        'options_values_price_text' => $order->products[$i]['attributes'][$j]['price'] != 0 ? $order->products[$i]['attributes'][$j]['price_formated'] : '', 
                                        'price_prefix' => $attributes_values['price_prefix']); 
                                        
                xos_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);

                if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && xos_not_null($attributes_values['products_attributes_filename'])) {
                  $sql_data_array = array('orders_id' => $insert_id, 
                                          'orders_products_id' => $order_products_id, 
                                          'orders_products_filename' => $attributes_values['products_attributes_filename'], 
                                          'download_maxdays' => $attributes_values['products_attributes_maxdays'], 
                                          'download_count' => $attributes_values['products_attributes_maxcount']);
                                          
                  xos_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
                }                 
              }
            }
          }

          $_SESSION['cart_PayPal_Standard_ID'] = $_SESSION['cartID'] . '-' . $insert_id; 
        }
      }

      return false;
    }

    function process_button() {
      global $order, $currencies;

      $process_button_string = '';
      $parameters = array('cmd' => '_xclick',
                          'item_name' => STORE_NAME,
                          'shipping' => round((($_SESSION['sppc_customer_group_show_tax'] == '1') ? $order->info['shipping_cost'] - $order->info['shipping_tax'] : $order->info['shipping_cost']), $currencies->currencies[$_SESSION['currency']]['decimal_places']),
                          'tax' => round((($order->info['tax'] == 0) ? '0' : $order->info['tax']), $currencies->currencies[$_SESSION['currency']]['decimal_places']),
                          'business' => MODULE_PAYMENT_PAYPAL_STANDARD_ID,
                          'amount' => $order->info['total'] - $order->info['tax'] - round(($_SESSION['sppc_customer_group_show_tax'] == '1') ? $order->info['shipping_cost'] - $order->info['shipping_tax'] : $order->info['shipping_cost'], $currencies->currencies[$_SESSION['currency']]['decimal_places']),
                          'currency_code' => $_SESSION['currency'],
                          'invoice' => substr($_SESSION['cart_PayPal_Standard_ID'], strpos($_SESSION['cart_PayPal_Standard_ID'], '-')+1),
                          'custom' => $_SESSION['customer_id'],
                          'no_note' => '1',
                          'notify_url' => xos_href_link('ext/modules/payment/paypal/standard_ipn.php', '', 'SSL', false, false),
                          'return' => xos_href_link(FILENAME_CHECKOUT_PROCESS, 'return_from=paypal_st', 'SSL'),
                          'cancel_return' => xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'),
//                          'bn' => 'XOS-Shop_Default_ST',
//                          'bn' => 'osCommerce22_Default_ST',
                          'paymentaction' => ((MODULE_PAYMENT_PAYPAL_STANDARD_TRANSACTION_METHOD == 'Sale') ? 'sale' : 'authorization'));

      if (is_numeric($_SESSION['sendto']) && ($_SESSION['sendto'] > 0)) {
        $parameters['address_override'] = '1';
        $parameters['first_name'] = $order->delivery['firstname'];
        $parameters['last_name'] = $order->delivery['lastname'];
        $parameters['address1'] = $order->delivery['street_address'];
        $parameters['city'] = $order->delivery['city'];
        $parameters['state'] = xos_get_zone_code($order->delivery['country']['id'], $order->delivery['zone_id'], $order->delivery['state']);
        $parameters['zip'] = $order->delivery['postcode'];
        $parameters['country'] = $order->delivery['country']['iso_code_2'];
      } else {
        $parameters['no_shipping'] = '1';
        $parameters['first_name'] = $order->billing['firstname'];
        $parameters['last_name'] = $order->billing['lastname'];
        $parameters['address1'] = $order->billing['street_address'];
        $parameters['city'] = $order->billing['city'];
        $parameters['state'] = xos_get_zone_code($order->billing['country']['id'], $order->billing['zone_id'], $order->billing['state']);
        $parameters['zip'] = $order->billing['postcode'];
        $parameters['country'] = $order->billing['country']['iso_code_2'];
      }

      if (xos_not_null(MODULE_PAYMENT_PAYPAL_STANDARD_PAGE_STYLE)) {
        $parameters['page_style'] = MODULE_PAYMENT_PAYPAL_STANDARD_PAGE_STYLE;
      }

      if (MODULE_PAYMENT_PAYPAL_STANDARD_EWP_STATUS == 'true') {
        $parameters['cert_id'] = MODULE_PAYMENT_PAYPAL_STANDARD_EWP_CERT_ID;

        $random_string = rand(100000, 999999) . '-' . $_SESSION['customer_id'] . '-';

        $data = '';
        reset($parameters);
        while (list($key, $value) = each($parameters)) {
          $data .= $key . '=' . $value . "\n";
        }

        $fp = fopen(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt', 'w');
        fwrite($fp, $data);
        fclose($fp);

        unset($data);

        if (function_exists('openssl_pkcs7_sign') && function_exists('openssl_pkcs7_encrypt')) {
          openssl_pkcs7_sign(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt', MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt', file_get_contents(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PUBLIC_KEY), file_get_contents(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PRIVATE_KEY), array('From' => MODULE_PAYMENT_PAYPAL_STANDARD_ID), PKCS7_BINARY);

          unlink(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt');

// remove headers from the signature
          $signed = file_get_contents(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt');
          $signed = explode("\n\n", $signed);
          $signed = base64_decode($signed[1]);

          $fp = fopen(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt', 'w');
          fwrite($fp, $signed);
          fclose($fp);

          unset($signed);

          openssl_pkcs7_encrypt(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt', MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt', file_get_contents(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PAYPAL_KEY), array('From' => MODULE_PAYMENT_PAYPAL_STANDARD_ID), PKCS7_BINARY);

          unlink(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt');

// remove headers from the encrypted result
          $data = file_get_contents(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt');
          $data = explode("\n\n", $data);
          $data = '-----BEGIN PKCS7-----' . "\n" . $data[1] . "\n" . '-----END PKCS7-----';

          unlink(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt');
        } else {
          exec(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_OPENSSL . ' smime -sign -in ' . MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt -signer ' . MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PUBLIC_KEY . ' -inkey ' . MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PRIVATE_KEY . ' -outform der -nodetach -binary > ' . MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt');
          unlink(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt');

          exec(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_OPENSSL . ' smime -encrypt -des3 -binary -outform pem ' . MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PAYPAL_KEY . ' < ' . MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt > ' . MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt');
          unlink(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt');

          $fh = fopen(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt', 'rb');
          $data = fread($fh, filesize(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt'));
          fclose($fh);

          unlink(MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt');
        }

        $process_button_string = xos_draw_hidden_field('cmd', '_s-xclick') .
                                 xos_draw_hidden_field('encrypted', $data);

        unset($data);
      } else {
        reset($parameters);
        while (list($key, $value) = each($parameters)) {
          $process_button_string .= xos_draw_hidden_field($key, $value);
        }
      }

      return $process_button_string;
    }

    function before_process() {
      global $order, $order_totals, $currencies, $smarty, $messageStack, $$_SESSION['payment'];

      $order_id = substr($_SESSION['cart_PayPal_Standard_ID'], strpos($_SESSION['cart_PayPal_Standard_ID'], '-')+1);
  
// initialized for the email confirmation
      $tax_rates = array();
      $order_products_array = array();
      $products_out_of_stock_string = '';
      for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
// Stock Update
    if (STOCK_LIMITED == 'true' && STOCK_CHECK == 'true') {   
      $product_id = xos_get_prid($order->products[$i]['id']);
 
      if ($product_id == $order->products[$i]['id']) {   
        $stock_query = xos_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
        $stock_values = xos_db_fetch_array($stock_query);

        $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
        xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$stock_left . "' where products_id = '" . (int)$product_id . "'");

        if ( ($stock_left < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
          xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . (int)$product_id . "'");
        
          $products_out_of_stock_string .= "\n" . MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PRODUCTS_NAME . ' = ' . $order->products[$i]['name'] . "\n" .                
                                                  MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PRODUCTS_MODEL . ' = ' . $order->products[$i]['model'] . "\n" .
                                                  MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PRODUCTS_ID . ' = ' . $product_id . "\n" .                                                        
                                                  MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PRODUCTS_QTY_IN_STOCK . ' = ' . $stock_left . "\n";
          $smarty->clearAllCache();
        }         

      } else {                  
        $stock_query = xos_db_query("select products_quantity, attributes_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
        $stock_values = xos_db_fetch_array($stock_query);
     
        $attributes_quantity = xos_get_attributes_quantity($stock_values['attributes_quantity']);        

        if (xos_not_null($attributes_quantity)) {               
          list($prid, $params_sting) = explode('-', $order->products[$i]['id']);        
          $stock_left = $attributes_quantity[$params_sting] - $order->products[$i]['qty'];
          
          if ($attributes_quantity[$params_sting] > 0) {          
            $stock_values['products_quantity'] = $stock_values['products_quantity'] - min($attributes_quantity[$params_sting], $order->products[$i]['qty']);          
          }
                  
          $attributes_quantity[$params_sting] = $stock_left;        
          xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)max(0, $stock_values['products_quantity']) . "', attributes_quantity = '" . xos_db_input(serialize($attributes_quantity)) . "' where products_id = '" . (int)$product_id . "'");
        
          if ($stock_left < 1) {
            $smarty->clearCache(null, 'L3|cc_product_info');
          }
          
          if ( ($stock_values['products_quantity'] < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
            xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . (int)$product_id . "'");

            $products_out_of_stock_string .= "\n" . MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PRODUCTS_NAME . ' = ' . $order->products[$i]['name'] . "\n" .                
                                                    MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PRODUCTS_MODEL . ' = ' . $order->products[$i]['model'] . "\n" .
                                                    MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PRODUCTS_ID . ' = ' . $product_id . "\n" .                                                        
                                                    MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PRODUCTS_QTY_IN_STOCK . ' = ' . $stock_values['products_quantity'] . "\n";
            $smarty->clearAllCache();
          }                                       
        }        
      }   
    }
    
// Update products_ordered (for bestsellers list)
        xos_db_query("update " . TABLE_PRODUCTS . " set products_last_modified = now(), products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = '" . xos_get_prid($order->products[$i]['id']) . "'");

//------insert customer choosen option to order--------
        $attributes_exist = '0';
        $attributes_options_values_price = false;
        if (isset($order->products[$i]['attributes'])) {
          $attributes_exist = '1';    
          $order_attributes_array = array();      
          for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
            if (DOWNLOAD_ENABLED == 'true') {
              $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename 
                                   from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa 
                                   left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                   on pa.products_attributes_id=pad.products_attributes_id
                                   where pa.products_id = '" . $order->products[$i]['id'] . "' 
                                   and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' 
                                   and pa.options_id = popt.products_options_id 
                                   and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' 
                                   and pa.options_values_id = poval.products_options_values_id 
                                   and popt.language_id = '" . $_SESSION['languages_id'] . "' 
                                   and poval.language_id = '" . $_SESSION['languages_id'] . "'";
              $attributes = xos_db_query($attributes_query);
            } else {
              $attributes = xos_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $_SESSION['languages_id'] . "' and poval.language_id = '" . $_SESSION['languages_id'] . "'");
            }
            $attributes_values = xos_db_fetch_array($attributes);

            $options_values_price = '';
            if ($attributes_values['options_values_price'] != 0) {
              $attributes_options_values_price = true;
              $options_values_price = $order->products[$i]['attributes'][$j]['price_formated'];
            }  
         
            $order_attributes_array[]=array('option_name' => $attributes_values['products_options_name'],
                                            'option_value_name' => $attributes_values['products_options_values_name'],
                                            'option_price' => $options_values_price,
                                            'option_price_prefix' => $attributes_values['price_prefix']);      
          }
        }
//------insert customer choosen option eof ----    
        $tax_rate = xos_display_tax_value($order->products[$i]['tax']);
    
        $order_products_array[]=array('qty' => $order->products[$i]['qty'], 
                                      'model' => $order->products[$i]['model'],    
                                      'name' => $order->products[$i]['name'],
                                      'packaging_unit' => $order->products[$i]['packaging_unit'],
                                      'tax_value' => $tax_rate,
                                      'price' => $order->products[$i]['price_formated'],
                                      'final_single_price' => $order->products[$i]['final_price_formated'],
                                      'final_price' => $order->products[$i]['total_price_formated'],                                       
                                      'products_attributes_option_price' => $attributes_options_values_price,
                                      'product_attributes' => $order_attributes_array);
                                  
        if (isset($tax_rate)) $tax_rates[$tax_rate] = '1';                              

        unset($order_attributes_array); 
      }
 
      $order_totals_array = array();
      for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {                 
        $order_totals_array[]=array('totals_title' => $order_totals[$i]['title'],
                                    'totals_text' => $order_totals[$i]['text'],
                                    'totals_tax' => $order_totals[$i]['tax']); 
                                
        if ($order_totals[$i]['tax'] > -1) $tax_rates[$order_totals[$i]['tax']] = '1';                                     
      }

// lets start with the email confirmation
      if (SEND_EMAILS == 'true') {
      
        $smarty->unregisterFilter('output','smarty_outputfilter_trimwhitespace');
      
        if ((sizeof($tax_rates) > 1) && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) { 
          $smarty->assign('more_tax_groups', true);
        }   
  
        if ($order->info['comments']) {
          $smarty->assign('order_comments', xos_db_output($order->info['comments']));
        }
  
        if ($order->content_type != 'virtual') {
          $smarty->assign('delivery_address', xos_address_label($_SESSION['customer_id'], $_SESSION['sendto'], 0, '', "\n"));
        } 
  
        if (is_object($$_SESSION['payment'])) {
          $payment_class = $$_SESSION['payment'];
          $smarty->assign('payment_method', $order->info['payment_method']);
          if ($payment_class->email_footer) {
            $smarty->assign('payment_email_footer', $payment_class->email_footer); 
          }
        }
  
        $smarty->assign(array('html_params' => HTML_PARAMS,
                              'xhtml_lang' => XHTML_LANG,
                              'charset' => CHARSET,
                              'link_invoice' => xos_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $order_id, 'SSL', false, false),
                              'default_address' => xos_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], 0, '', "\n"),
                              'billing_address' => xos_address_label($_SESSION['customer_id'], $_SESSION['billto'], 0, '', "\n"),
                              'store_name' => STORE_NAME,
                              'store_name_address' => STORE_NAME_ADDRESS,
                              'order_id' => $order_id,
                              'date_ordered' => xos_date_format(DATE_FORMAT_LONG),
                              'order_products' => $order_products_array,
                              'order_totals' => $order_totals_array,
                              'src_embedded_shop_logo' => 'cid:shop_logo',
                              'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . SELECTED_TPL . '/') . EMAIL_SHOP_LOGO));
  
        $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'order_email_html');
        $output_order_email_html = $smarty->fetch(SELECTED_TPL . '/includes/email/order_email_html.tpl');
        $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'order_email_text');  
        $output_order_email_text = $smarty->fetch(SELECTED_TPL . '/includes/email/order_email_text.tpl');
  
        $email_to_customer = new mailer($order->customer['firstname'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], sprintf(EMAIL_TEXT_SUBJECT_CUSTOMER, $order_id, xos_date_format(DATE_FORMAT_SHORT)), $output_order_email_html, $output_order_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SHOP_LOGO);
  
        if(!$email_to_customer->send()) {
          $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_customer->ErrorInfo));
        } 
  
// send emails to other people      
        if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
          $send_extra_order_emails_to = SEND_EXTRA_ORDER_EMAILS_TO;
          $decoded_send_extra_order_emails_to = html_entity_decode($send_extra_order_emails_to, ENT_QUOTES, 'UTF-8');      
          $recipients = explode(',', $decoded_send_extra_order_emails_to);      
          for ($i=0, $n=count($recipients); $i<$n; $i++) {
            $address = '';
            $name = ''; 
            $pieces = explode('<', $recipients[$i]);
            if (count($pieces) == 2) {
              $address = trim($pieces[1], " >");      
              $name = trim($pieces[0]); 
            } elseif (count($pieces) == 1) {      
              $pos = stripos($pieces[0], '@');      
              $address = $pos ? trim($pieces[0], " >") : '';
            } 
      
            $email_to_other_people = new mailer($name, $address, sprintf(EMAIL_TEXT_SUBJECT_OTHER, $order_id, xos_date_format(DATE_FORMAT_SHORT)), $output_order_email_html, $output_order_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SHOP_LOGO);
    
            if(!$email_to_other_people->send()) {
              $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_other_people->ErrorInfo));
            } 
          }                  
        }        
      }
      
      $check_query = xos_db_query("select orders_status from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
      if (xos_db_num_rows($check_query)) {
        $check = xos_db_fetch_array($check_query);

        if ($check['orders_status'] == MODULE_PAYMENT_PAYPAL_STANDARD_PREPARE_ORDER_STATUS_ID) {
          $sql_data_array = array('orders_id' => $order_id,
                                  'orders_status_id' => MODULE_PAYMENT_PAYPAL_STANDARD_PREPARE_ORDER_STATUS_ID,
                                  'date_added' => 'now()',
                                  'customer_notified' => '0',
                                  'comments' => ($products_out_of_stock_string == '') ? '' : MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_STOCK_WARNING . $products_out_of_stock_string);

          xos_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
        }
      }

      xos_db_query("update " . TABLE_ORDERS . " set orders_status = '" . (MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID > 0 ? (int)MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID : (int)DEFAULT_ORDERS_STATUS_ID) . "', last_modified = now() where orders_id = '" . (int)$order_id . "'");

      $sql_data_array = array('orders_id' => $order_id,
                              'orders_status_id' => (MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID > 0 ? (int)MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID : (int)DEFAULT_ORDERS_STATUS_ID),
                              'date_added' => 'now()',
                              'customer_notified' => (SEND_EMAILS == 'true') ? '1' : '0',
                              'comments' => $order->info['comments']);

      xos_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
      
// Set new order true and add last modified in table configuration
      if (NEW_ORDER == 'false') {
        xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = 'true', last_modified = '" . date('Ymd') . "' where configuration_key = 'NEW_ORDER'");
      }        
    
// load the after_process function from the payment modules
      $this->after_process();
//      $payment_modules->after_process();

      $_SESSION['cart']->reset(true);

// unregister session variables used during checkout
      unset($_SESSION['sendto']);
      unset($_SESSION['billto']);
      unset($_SESSION['shipping']);
      unset($_SESSION['payment']);
      unset($_SESSION['comments']);  
      unset($_SESSION['cart_PayPal_Standard_ID']);
  
      xos_redirect(xos_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));    
    }

    function after_process() {
      return false;
    }

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = xos_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPAL_STANDARD_STATUS'");
        $this->_check = xos_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      $check_query = xos_db_query("select orders_status_id from " . TABLE_ORDERS_STATUS . " where orders_status_code = 'paypal_st' limit 1");

      if (xos_db_num_rows($check_query) < 1) {
        $status_query = xos_db_query("select max(orders_status_id) as status_id from " . TABLE_ORDERS_STATUS);
        $status = xos_db_fetch_array($status_query);

        $status_id = $status['status_id']+1;

        $languages = xos_get_languages();

        foreach ($languages as $lang) {
          xos_db_query("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name, orders_status_code) values ('" . $status_id . "', '" . $lang['id'] . "', 'Preparing [PayPal Standard]', 'paypal_st')");
        }

        $flags_query = xos_db_query("describe " . TABLE_ORDERS_STATUS . " public_flag");
        if (xos_db_num_rows($flags_query) == 1) {
          xos_db_query("update " . TABLE_ORDERS_STATUS . " set public_flag = 0 and downloads_flag = 0 where orders_status_id = '" . $status_id . "'");
        }
      } else {
        $check = xos_db_fetch_array($check_query);

        $status_id = $check['orders_status_id'];
      }

      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_STATUS', 'false', '6', '3', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_ID', '', '6', '4', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_SORT_ORDER', '8', '6', '0', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_ZONE', '0', '6', '2', 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_PREPARE_ORDER_STATUS_ID', '" . $status_id . "', '6', '0', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID', '0', '6', '0', 'xos_cfg_pull_down_order_statuses(', 'xos_get_order_status_name', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_GATEWAY_SERVER', 'Live', '6', '6', 'xos_cfg_select_option(array(\'Live\', \'Sandbox\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_TRANSACTION_METHOD', 'Sale', '6', '0', 'xos_cfg_select_option(array(\'Authorization\', \'Sale\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_PAGE_STYLE', '', '6', '4', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_DEBUG_EMAIL', '', '6', '4', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_STATUS', 'false', '6', '3', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PRIVATE_KEY', '', '6', '4', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PUBLIC_KEY', '', '6', '4', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PAYPAL_KEY', '', '6', '4', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_CERT_ID', '', '6', '4', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY', '', '6', '4', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_OPENSSL', '/usr/bin/openssl', '6', '4', now())");
    }

    function remove() {
      xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->installed_keys()) . "')");
    }

    function installed_keys() {
      return array('MODULE_PAYMENT_PAYPAL_STANDARD_STATUS', 'MODULE_PAYMENT_PAYPAL_STANDARD_ID', 'MODULE_PAYMENT_PAYPAL_STANDARD_ZONE', 'MODULE_PAYMENT_PAYPAL_STANDARD_PREPARE_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPAL_STANDARD_GATEWAY_SERVER', 'MODULE_PAYMENT_PAYPAL_STANDARD_TRANSACTION_METHOD', 'MODULE_PAYMENT_PAYPAL_STANDARD_PAGE_STYLE', 'MODULE_PAYMENT_PAYPAL_STANDARD_DEBUG_EMAIL', 'MODULE_PAYMENT_PAYPAL_STANDARD_SORT_ORDER', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_STATUS', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PRIVATE_KEY', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PUBLIC_KEY', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PAYPAL_KEY', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_CERT_ID', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_OPENSSL');
    }

    function keys() {
      return array('MODULE_PAYMENT_PAYPAL_STANDARD_STATUS', 'MODULE_PAYMENT_PAYPAL_STANDARD_ID', 'MODULE_PAYMENT_PAYPAL_STANDARD_ZONE', 'MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPAL_STANDARD_GATEWAY_SERVER', 'MODULE_PAYMENT_PAYPAL_STANDARD_TRANSACTION_METHOD', 'MODULE_PAYMENT_PAYPAL_STANDARD_PAGE_STYLE', 'MODULE_PAYMENT_PAYPAL_STANDARD_DEBUG_EMAIL', 'MODULE_PAYMENT_PAYPAL_STANDARD_SORT_ORDER', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_STATUS', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PRIVATE_KEY', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PUBLIC_KEY', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PAYPAL_KEY', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_CERT_ID', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_OPENSSL');
    }
  }
?>
