<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : sessions.php
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
//              filename: sessions.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  if (STORE_SESSIONS == 'mysql') {
    if (!$SESS_LIFE = get_cfg_var('session.gc_maxlifetime')) {
      $SESS_LIFE = 1440;
    }

    function _sess_open($save_path, $session_name) {
       
      register_shutdown_function('session_write_close');
              
      return true;
    }

    function _sess_close() {
      return true;
    }

    function _sess_read($key) {
      $value_query = xos_db_query("select value from " . TABLE_SESSIONS . " where sesskey = '" . xos_db_input($key) . "' and expiry > '" . time() . "'");
      $value = xos_db_fetch_array($value_query);

      if (isset($value['value'])) {
        return $value['value'];
      }

      return '';
    }

    function _sess_write($key, $val) {
      global $SESS_LIFE;

      $expiry = time() + $SESS_LIFE;
      $value = $val;

      $check_query = xos_db_query("select count(*) as total from " . TABLE_SESSIONS . " where sesskey = '" . xos_db_input($key) . "'");
      $check = xos_db_fetch_array($check_query);

      if ($check['total'] > 0) {
        return xos_db_query("update " . TABLE_SESSIONS . " set expiry = '" . xos_db_input($expiry) . "', value = '" . xos_db_input($value) . "' where sesskey = '" . xos_db_input($key) . "'");
      } else {
        return xos_db_query("insert into " . TABLE_SESSIONS . " values ('" . xos_db_input($key) . "', '" . xos_db_input($expiry) . "', '" . xos_db_input($value) . "')");
      }      
    }

    function _sess_destroy($key) {
      return xos_db_query("delete from " . TABLE_SESSIONS . " where sesskey = '" . xos_db_input($key) . "'");
    }

    function _sess_gc($maxlifetime) {
      xos_db_query("delete from " . TABLE_SESSIONS . " where expiry < '" . time() . "'");

      return true;
    }

    session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
  }

  function xos_session_start() {

    $sane_session_id = true;

    if (isset($_GET[xos_session_name()])) {
      if (preg_match('/^[a-zA-Z0-9]+$/', $_GET[xos_session_name()]) == false) {
        unset($_GET[xos_session_name()]);

        $sane_session_id = false;
      }
    } elseif (isset($_POST[xos_session_name()])) {
      if (preg_match('/^[a-zA-Z0-9]+$/', $_POST[xos_session_name()]) == false) {
        unset($_POST[xos_session_name()]);

        $sane_session_id = false;
      }
    } elseif (isset($_COOKIE[xos_session_name()])) {
      if (preg_match('/^[a-zA-Z0-9]+$/', $_COOKIE[xos_session_name()]) == false) {
        $session_data = session_get_cookie_params();

        setcookie(xos_session_name(), '', time()-42000, $session_data['path'], $session_data['domain']);

        $sane_session_id = false;
      }
    }

    if ($sane_session_id == false) {
      xos_redirect(xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
    }

    return session_start();
  }

  function xos_session_id($sessid = '') {
    if (!empty($sessid)) {
      return session_id($sessid);
    } else {
      return session_id();
    }
  }

  function xos_session_name($name = '') {
    if (!empty($name)) {
      return session_name($name);
    } else {
      return session_name();
    }
  }

  function xos_session_save_path($path = '') {
    if (!empty($path)) {
      return session_save_path($path);
    } else {
      return session_save_path();
    }
  }

  function xos_session_recreate() {

      $old_id = session_id();
      
      session_regenerate_id(true);
      
      xos_whos_online_update_session_id($old_id, session_id());  
  }
?>
