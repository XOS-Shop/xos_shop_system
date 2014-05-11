<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : ar_reset_password.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2014 Hanspeter Zeller
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
//              Copyright (c) 2013 osCommerce
//              filename: ar_reset_password.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class ar_reset_password {
    var $code = 'ar_reset_password';
    var $title;
    var $description;
    var $sort_order;
    var $minutes = 5;
    var $attempts = 1;
    var $identifier;

    function ar_reset_password() {
      $this->title = MODULE_ACTION_RECORDER_RESET_PASSWORD_TITLE;
      $this->description = MODULE_ACTION_RECORDER_RESET_PASSWORD_DESCRIPTION;

      if ($this->check()) {
        $this->minutes = (int)MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES;
        $this->attempts = (int)MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS;
        $this->sort_order = 0;
      }
    }

    function setIdentifier() {
      $this->identifier = xos_get_ip_address();
    }

    function canPerform($user_id, $user_name) {
      $check_query = xos_db_query("select id from " . TABLE_ACTION_RECORDER . " where module = '" . xos_db_input($this->code) . "' and user_name = '" . xos_db_input($user_name) . "' and date_added >= date_sub(now(), interval " . (int)$this->minutes  . " minute) and success = 1 order by date_added desc limit " . (int)$this->attempts);
      if (xos_db_num_rows($check_query) == $this->attempts) {
        return false;
      } else {
        return true;
      }
    }

    function expireEntries() {
      xos_db_query("delete from " . TABLE_ACTION_RECORDER . " where module = '" . $this->code . "' and date_added < date_sub(now(), interval " . (int)$this->minutes  . " minute)");

      return xos_db_affected_rows();
    }

    function check() {
      return defined('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES');
    }

    function install() {
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES', '5', '6', '0', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS', '1', '6', '0', now())");
    }

    function remove() {
      xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES', 'MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS');
    }
  }
?>
