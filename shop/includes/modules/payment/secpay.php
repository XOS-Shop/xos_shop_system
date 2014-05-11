<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : secpay.php
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
//              filename: secpay.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class secpay {
    var $code, $title, $description, $enabled;

// class constructor
    function secpay() {
      global $order;

      $this->code = 'secpay';
      $this->title = MODULE_PAYMENT_SECPAY_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_SECPAY_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_SECPAY_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_SECPAY_STATUS == 'true') ? true : false);

      if ((int)MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = 'https://www.secpay.com/java-bin/ValCard';
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_SECPAY_ZONE > 0) ) {
        $check_flag = false;
        $check_query = xos_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_SECPAY_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }

    function process_button() {
      global $order, $currencies;

      switch (MODULE_PAYMENT_SECPAY_CURRENCY) {
        case 'Default Currency':
          $sec_currency = DEFAULT_CURRENCY;
          break;
        case 'Any Currency':
        default:
          $sec_currency = $_SESSION['currency'];
          break;
      }

      switch (MODULE_PAYMENT_SECPAY_TEST_STATUS) {
        case 'Always Fail':
          $test_status = 'false';
          break;
        case 'Production':
          $test_status = 'live';
          break;
        case 'Always Successful':
        default:
          $test_status = 'true';
          break;
      }

      $process_button_string = xos_draw_hidden_field('merchant', MODULE_PAYMENT_SECPAY_MERCHANT_ID) .
                               xos_draw_hidden_field('trans_id', STORE_NAME . date('Ymdhis')) .
                               xos_draw_hidden_field('amount', number_format($order->info['total'] * $currencies->get_value($sec_currency), $currencies->currencies[$sec_currency]['decimal_places'], '.', '')) .
                               xos_draw_hidden_field('bill_name', $order->billing['firstname'] . ' ' . $order->billing['lastname']) .
                               xos_draw_hidden_field('bill_addr_1', $order->billing['street_address']) .
                               xos_draw_hidden_field('bill_addr_2', $order->billing['suburb']) .
                               xos_draw_hidden_field('bill_city', $order->billing['city']) .
                               xos_draw_hidden_field('bill_state', $order->billing['state']) .
                               xos_draw_hidden_field('bill_post_code', $order->billing['postcode']) .
                               xos_draw_hidden_field('bill_country', $order->billing['country']['title']) .
                               xos_draw_hidden_field('bill_tel', $order->customer['telephone']) .
                               xos_draw_hidden_field('bill_email', $order->customer['email_address']) .
                               xos_draw_hidden_field('ship_name', $order->delivery['firstname'] . ' ' . $order->delivery['lastname']) .
                               xos_draw_hidden_field('ship_addr_1', $order->delivery['street_address']) .
                               xos_draw_hidden_field('ship_addr_2', $order->delivery['suburb']) .
                               xos_draw_hidden_field('ship_city', $order->delivery['city']) .
                               xos_draw_hidden_field('ship_state', $order->delivery['state']) .
                               xos_draw_hidden_field('ship_post_code', $order->delivery['postcode']) .
                               xos_draw_hidden_field('ship_country', $order->delivery['country']['title']) .
                               xos_draw_hidden_field('currency', $sec_currency) .
                               xos_draw_hidden_field('callback', xos_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', false) . ';' . xos_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL', false)) .
                               xos_draw_hidden_field(xos_session_name(), xos_session_id()) .
                               xos_draw_hidden_field('options', 'test_status=' . $test_status . ',dups=false,cb_post=true,cb_flds=' . xos_session_name());

      return $process_button_string;
    }

    function before_process() {

      if ($_POST['valid'] == 'true') {
        if ($remote_host = getenv('REMOTE_HOST')) {
          if ($remote_host != 'secpay.com') {
            $remote_host = gethostbyaddr($remote_host);
          }
          if ($remote_host != 'secpay.com') {
            xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, xos_session_name() . '=' . $_POST[xos_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
          }
        } else {
          xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, xos_session_name() . '=' . $_POST[xos_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
        }
      }
    }

    function after_process() {
      return false;
    }

    function get_error() {

      if (isset($_GET['message']) && (strlen($_GET['message']) > 0)) {
        $error = stripslashes(urldecode($_GET['message']));
      } else {
        $error = MODULE_PAYMENT_SECPAY_TEXT_ERROR_MESSAGE;
      }

      return array('title' => MODULE_PAYMENT_SECPAY_TEXT_ERROR,
                   'error' => $error);
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = xos_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_SECPAY_STATUS'");
        $this->_check = xos_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_SECPAY_STATUS', 'true', '6', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_SECPAY_MERCHANT_ID', 'secpay', '6', '2', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_SECPAY_CURRENCY', 'Any Currency', '6', '3', 'xos_cfg_select_option(array(\'Any Currency\', \'Default Currency\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_SECPAY_TEST_STATUS', 'Always Successful', '6', '4', 'xos_cfg_select_option(array(\'Always Successful\', \'Always Fail\', \'Production\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_SECPAY_SORT_ORDER', '11', '6', '0', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_PAYMENT_SECPAY_ZONE', '0', '6', '2', 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) values ('MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID', '0', '6', '0', 'xos_cfg_pull_down_order_statuses(', 'xos_get_order_status_name', now())");
    }

    function remove() {
      xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_SECPAY_STATUS', 'MODULE_PAYMENT_SECPAY_MERCHANT_ID', 'MODULE_PAYMENT_SECPAY_CURRENCY', 'MODULE_PAYMENT_SECPAY_TEST_STATUS', 'MODULE_PAYMENT_SECPAY_ZONE', 'MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID', 'MODULE_PAYMENT_SECPAY_SORT_ORDER');
    }
  }
?>
