<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : database_mysqli.php
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
//              filename: database.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  function xos_db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') {
    global $$link;

    if (USE_PCONNECT == 'true') {
      $$link = @mysqli_connect('p:' . $server, $username, $password, $database);
    } else {
      $$link = @mysqli_connect($server, $username, $password, $database);
    }

    if (mysqli_connect_errno($$link)) {
      die('<span style="color : #000000;"><b><br />Unable to connect to database server!<br />Connection error: ' . mysqli_connect_errno() . '<br /></b></span>');
    } else {
      mysqli_set_charset($$link,"utf8");
      if (DISABLE_SQL_MODE == 'true') xos_db_query("SET SESSION sql_mode=''");      

      return $$link;
    }
  }

  function xos_db_close($link = 'db_link') {
    global $$link;

    return mysqli_close($$link);
  }

  function xos_db_error($query, $errno, $error, $link = 'db_link') {
    global $$link;
    
    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
       if (mysqli_errno($$link)) error_log('ERROR ' . mysqli_error($$link) . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }
      
    die('<span style="color : #000000;"><b>' . $errno . ' - ' . $error . '<br /><br />' . $query . '<br /><br /><small><span style="color : #ff0000;">[XOS STOP]</span></small><br /><br /></b></span>');
  }

  function xos_db_query($query, $link = 'db_link') {
    global $$link;

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
      error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    $result = mysqli_query($$link, $query) or xos_db_error($query, mysqli_errno($$link), mysqli_error($$link));

    return $result;
  }

  function xos_db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link') {
    reset($data);
    if ($action == 'insert') {
      $query = 'insert into ' . $table . ' (';
      foreach(array_keys($data) as $columns) {
        $query .= $columns . ', ';
      }
      $query = substr($query, 0, -2) . ') values (';
      reset($data);
      foreach($data as $value) {
        switch ((string)$value) {
          case 'now()':
            $query .= 'now(), ';
            break;
          case 'null':
            $query .= 'null, ';
            break;
          default:
            $query .= '\'' . xos_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'update') {
      $query = 'update ' . $table . ' set ';
      foreach($data as $columns => $value) {
        switch ((string)$value) {
          case 'now()':
            $query .= $columns . ' = now(), ';
            break;
          case 'null':
            $query .= $columns .= ' = null, ';
            break;
          default:
            $query .= $columns . ' = \'' . xos_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }

    return xos_db_query($query, $link);
  }

  function xos_db_fetch_array($db_query) {
    return mysqli_fetch_array($db_query, MYSQLI_ASSOC);
  }

  function xos_db_num_rows($db_query) {
    return mysqli_num_rows($db_query);
  }

  function xos_db_data_seek($db_query, $row_number) {
    return mysqli_data_seek($db_query, $row_number);
  }

  function xos_db_insert_id($link = 'db_link') {
    global $$link;
    
    return mysqli_insert_id($$link);
  }

  function xos_db_free_result($db_query) {
    return mysqli_free_result($db_query);
  }

  function xos_db_fetch_fields($db_query) {
    return mysqli_fetch_field($db_query);
  }

  function xos_db_output($string) {
    return htmlspecialchars($string);
  }

  function xos_db_input($string, $link = 'db_link') {
    global $$link;

    return mysqli_real_escape_string($$link, $string);
  }

  function xos_db_prepare_input($string) {
    if (is_string($string)) {
      return trim(xos_sanitize_string(stripslashes($string)));
    } elseif (is_array($string)) {
      reset($string);
      foreach($string as $key => $value) {
        $string[$key] = xos_db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }
  }
  
  function xos_db_affected_rows($link = 'db_link') {
    global $$link;

    return mysqli_affected_rows($$link);
  }   
?>
