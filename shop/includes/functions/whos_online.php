<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : whos_online.php
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
//              filename: whos_online.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  function xos_update_whos_online() {
    global $session_started;  

    if (isset($_SESSION['customer_id'])) {
      $wo_customer_id = $_SESSION['customer_id'];

      $customer_query = xos_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
      $customer = xos_db_fetch_array($customer_query);

      $wo_full_name = $customer['customers_firstname'] . ' ' . $customer['customers_lastname'];
    } else {
      $wo_customer_id = '';
      $wo_full_name = 'Guest';
    }

    $wo_session_id = xos_session_id();
    $wo_ip_address = getenv('REMOTE_ADDR');
    $wo_last_page_url = getenv('REQUEST_URI');

    $current_time = time();
    $xx_mins_ago = ($current_time - 900);

// remove entries that have expired
    xos_db_query("delete from " . TABLE_WHOS_ONLINE . " where time_last_click < '" . $xx_mins_ago . "'");

    if ($session_started) {
      $where_str = " where session_id = '" . xos_db_input($wo_session_id) . "'";
    } else {
      $where_str = " where session_id = '' and ip_address = '" . xos_db_input($wo_ip_address) . "'";    
    }

    $stored_customer_query = xos_db_query("select count(*) as count from " . TABLE_WHOS_ONLINE . $where_str);
    $stored_customer = xos_db_fetch_array($stored_customer_query);

    if ($stored_customer['count'] > 0) {
      xos_db_query("update " . TABLE_WHOS_ONLINE . " set customer_id = '" . (int)$wo_customer_id . "', full_name = '" . xos_db_input($wo_full_name) . "', ip_address = '" . xos_db_input($wo_ip_address) . "', time_last_click = '" . xos_db_input($current_time) . "', last_page_url = '" . xos_db_input($wo_last_page_url) . "'" . $where_str);
    } else {
      xos_db_query("insert into " . TABLE_WHOS_ONLINE . " (customer_id, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url) values ('" . (int)$wo_customer_id . "', '" . xos_db_input($wo_full_name) . "', '" . xos_db_input($wo_session_id) . "', '" . xos_db_input($wo_ip_address) . "', '" . xos_db_input($current_time) . "', '" . xos_db_input($current_time) . "', '" . xos_db_input($wo_last_page_url) . "')");
    }
  }
?>
