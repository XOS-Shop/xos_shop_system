<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : cc.php
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
//              Copyright (c) 2007 osCommerce
//              filename: cc.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class cc {
    var $code, $title, $description, $enabled;

// class constructor
    function cc() {
      global $order;

      $this->code = 'cc';
      $this->title = MODULE_PAYMENT_CC_TEXT_TITLE;
      $this->public_title = MODULE_PAYMENT_CC_TEXT_PUBLIC_TITLE;
      $this->description = MODULE_PAYMENT_CC_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_CC_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_CC_STATUS == 'true') ? true : false);

      if ((int)MODULE_PAYMENT_CC_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_CC_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_CC_ZONE > 0) ) {
        $check_flag = false;
        $check_query = xos_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_CC_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
    
    function js_validation() {
      $js = '  var cc_owner = document.checkout_confirmation["cc_owner"].value;' . "\n" .
            '  var cc_number = document.checkout_confirmation["cc_number_nh-dns"].value;' . "\n\n" .
            '  if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '    error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER . '";' . "\n" .
            '    error = 1;' . "\n" .
            '  }' . "\n\n" .
            '  if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '    error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '    error = 1;' . "\n" .
            '  }' . "\n";

      return $js;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->public_title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      global $order;

      for ($i=1; $i<13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => xos_date_format('%B', mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => xos_date_format('%y', mktime(0,0,0,1,1,$i)), 'text' => xos_date_format('%Y', mktime(0,0,0,1,1,$i)));
      }

      $confirmation = array('fields' => array(array('title' => '<label for="cc_owner">' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER . '</label>',
                                                    'field' => xos_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'], 'id="cc_owner"')),
                                              array('title' => '<label for="cc_number_nh-dns">' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER . '</label>',
                                                    'field' => xos_draw_input_field('cc_number_nh-dns', '', 'id="cc_number_nh-dns"')),
                                              array('title' => '<label for="cc_expires_month">' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES . '</label>',
                                                    'field' => xos_draw_pull_down_menu('cc_expires_month', $expires_month, '', 'id="cc_expires_month"') . '<span style="position:absolute; left:-1000px; top:-1000px; width:0; height:0; overflow:hidden; display:inline;"><label for="cc_expires_year">' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES . '</label></span>&nbsp;' . xos_draw_pull_down_menu('cc_expires_year', $expires_year, '', 'id="cc_expires_year"'))));

      return $confirmation;
    }

    function process_button() {
      return false;
    }

    function before_process() {
      global $order;

      include(DIR_WS_CLASSES . 'cc_validation.php');
      
      $post_input_cc_number = str_replace(' ', '', $_POST['cc_number_nh-dns']);
      
      $cc_validation = new cc_validation();
      $result = $cc_validation->validate($post_input_cc_number, $_POST['cc_expires_month'], $_POST['cc_expires_year']);

      $error = '';
      switch ($result) {
        case -1:
          $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
          break;
        case -2:
        case -3:
        case -4:
          $error = TEXT_CCVAL_ERROR_INVALID_DATE;
          break;
        case false:
          $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
          break;
      }

      if ( ($result == false) || ($result < 1) ) {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&cc_owner=' . urlencode($_POST['cc_owner']) . '&cc_expires_month=' . $_POST['cc_expires_month'] . '&cc_expires_year=' . $_POST['cc_expires_year'];

        xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }    

      $order->info['cc_owner'] = $_POST['cc_owner'];
      $order->info['cc_type'] = $cc_validation->cc_type;
      $order->info['cc_number'] = $post_input_cc_number;
      $order->info['cc_expires'] = $_POST['cc_expires_month'] . $_POST['cc_expires_year'];

      if ( (defined('MODULE_PAYMENT_CC_EMAIL')) && (xos_validate_email(MODULE_PAYMENT_CC_EMAIL)) && (SEND_EMAILS == 'true') ) {
        $len = strlen($post_input_cc_number);

        $this->cc_middle = substr($post_input_cc_number, 4, ($len-8));
        $order->info['cc_number'] = substr($post_input_cc_number, 0, 4) . str_repeat('X', (strlen($post_input_cc_number) - 8)) . substr($post_input_cc_number, -4);
      }     
    }

    function after_process() {
      global $insert_id;

      if ( (defined('MODULE_PAYMENT_CC_EMAIL')) && (xos_validate_email(MODULE_PAYMENT_CC_EMAIL)) && (SEND_EMAILS == 'true') ) {
        $message = 'Order #' . $insert_id . "\n\n" . 'Middle: ' . $this->cc_middle . "\n\n";

        $email_to_admin = new mailer('', MODULE_PAYMENT_CC_EMAIL, 'Extra Order Info: #' . $insert_id, '', $message, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        
        if(!$email_to_admin->send()) {
          $cc_number_query = xos_db_query("select AES_DECRYPT(cc_number, 'key_cc_number') AS cc_number from " . TABLE_ORDERS . " where orders_id = '" . (int)$insert_id . "'");
          $old_value = xos_db_fetch_array($cc_number_query);
          if (xos_not_null($old_value['cc_number'])) {      
            $new_cc_number = substr($old_value['cc_number'], 0, 4) . $this->cc_middle . substr($old_value['cc_number'], -4);    
            xos_db_query("update " . TABLE_ORDERS . " set last_modified = now(), cc_number = AES_ENCRYPT('" . $new_cc_number . "', 'key_cc_number') where orders_id = '" . (int)$insert_id . "'");
          }  
        }
      }
    }

    function get_error() {

      $error = array('title' => MODULE_PAYMENT_CC_TEXT_ERROR,
                     'error' => stripslashes(urldecode($_GET['error'])));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = xos_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_STATUS'");
        $this->_check = xos_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_CC_STATUS', 'true', '6', '0', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_CC_EMAIL', '', '6', '0', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_CC_SORT_ORDER', '2', '6', '0' , now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_PAYMENT_CC_ZONE', '0', '6', '2', 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) values ('MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', '6', '0', 'xos_cfg_pull_down_order_statuses(', 'xos_get_order_status_name', now())");
    }

    function remove() {
      xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_CC_STATUS', 'MODULE_PAYMENT_CC_EMAIL', 'MODULE_PAYMENT_CC_ZONE', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', 'MODULE_PAYMENT_CC_SORT_ORDER');
    }
  }
?>
