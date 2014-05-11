<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : database_mysql.php
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

  function xos_db_connect($server, $username, $password, $link = 'db_link') {
    global $$link, $db_error;

    $db_error = false;

    if (!$server) {
      $db_error = 'No Server selected.'; 
      return false;
    }

    $$link = @mysql_connect($server, $username, $password) or $db_error = mysql_error();
    
    @mysql_query("SET NAMES 'utf8'");

    return $$link;
  }

  function xos_db_select_db($database) {
    return mysql_select_db($database);
  }

  function xos_db_close($link = 'db_link') {
    global $$link;

    return mysql_close($$link);
  }

  function xos_db_query($query, $link = 'db_link') {
    global $$link;

    return mysql_query($query, $$link);
  }

  function xos_db_fetch_array($db_query) {
    return mysql_fetch_array($db_query);
  }

  function xos_db_num_rows($db_query) {
    return mysql_num_rows($db_query);
  }

  function xos_db_data_seek($db_query, $row_number) {
    return mysql_data_seek($db_query, $row_number);
  }

  function xos_db_insert_id($link = 'db_link') {
    global $$link;
    
    return mysql_insert_id($$link);
  }

  function xos_db_free_result($db_query) {
    return mysql_free_result($db_query);
  }

  function xos_db_test_create_db_permission($database) {
    global $db_error;

    $db_created = false;
    $db_error = false;

    if (!$database) {
      $db_error = 'No Database selected.';
      return false;
    }

    if (!$db_error) {
      if (!@xos_db_select_db($database)) {
        $db_created = true;
        if (!@xos_db_query('CREATE DATABASE ' . $database . ' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci')) {
          $db_error = mysql_error();
        }
      } else {
        $db_error = mysql_error();
      }
      if (!$db_error) {
        if (@xos_db_select_db($database)) {
          if (@xos_db_query('create table temp ( temp_id int(5) )')) {
            if (@xos_db_query('drop table temp')) {
              if ($db_created) {
                if (@xos_db_query('drop database ' . $database)) {
                } else {
                  $db_error = mysql_error();
                }
              }
            } else {
              $db_error = mysql_error();
            }
          } else {
            $db_error = mysql_error();
          }
        } else {
          $db_error = mysql_error();
        }
      }
    }

    if ($db_error) {
      return false;
    } else {
      return true;
    }
  }

  function xos_db_test_connection($database) {
    global $db_error;

    $db_error = false;

    if (!$db_error) {
      if (!@xos_db_select_db($database)) {
        $db_error = mysql_error();
      } else {
        if (!@xos_db_query('select count(*) from configuration')) {
          $db_error = mysql_error();
        }
      }
    }

    if ($db_error) {
      return false;
    } else {
      return true;
    }
  }

  function xos_db_install($database, $sql_file) {
    global $db_error;

    $db_error = false;

    if (!@xos_db_select_db($database)) {
      if (@xos_db_query('CREATE DATABASE ' . $database . ' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci')) {
        xos_db_select_db($database);
      } else {
        $db_error = mysql_error();
      }
    } else {
      xos_db_query('ALTER DATABASE ' . $database . ' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci');
    }

    if (!$db_error) {
      if (file_exists($sql_file)) {
        $fd = fopen($sql_file, 'rb');
        $restore_query = fread($fd, filesize($sql_file));
        fclose($fd);
      } else {
        $db_error = 'SQL file does not exist: ' . $sql_file;
        return false;
      }

      $sql_array = array();
      $sql_length = strlen($restore_query);
      $pos = strpos($restore_query, ';');
      for ($i=$pos; $i<$sql_length; $i++) {
        if ($restore_query[0] == '#') {
          $restore_query = ltrim(substr($restore_query, strpos($restore_query, "\n")));
          $sql_length = strlen($restore_query);
          $i = strpos($restore_query, ';')-1;
          continue;
        }
        if ($restore_query[($i+1)] == "\n") {
          for ($j=($i+2); $j<$sql_length; $j++) {
            if (trim($restore_query[$j]) != '') {
              $next = substr($restore_query, $j, 6);
              if ($next[0] == '#') {
// find out where the break position is so we can remove this line (#comment line)
                for ($k=$j; $k<$sql_length; $k++) {
                  if ($restore_query[$k] == "\n") break;
                }
                $query = substr($restore_query, 0, $i+1);
                $restore_query = substr($restore_query, $k);
// join the query before the comment appeared, with the rest of the dump
                $restore_query = $query . $restore_query;
                $sql_length = strlen($restore_query);
                $i = strpos($restore_query, ';')-1;
                continue 2;
              }
              break;
            }
          }
          if ($next == '') { // get the last insert query
            $next = 'insert';
          }
          if ( (preg_match('/create/i', $next)) || (preg_match('/insert/i', $next)) || (preg_match('/drop t/i', $next)) ) {
            $next = '';
            $sql_array[] = substr($restore_query, 0, $i);
            $restore_query = ltrim(substr($restore_query, $i+1));
            $sql_length = strlen($restore_query);
            $i = strpos($restore_query, ';')-1;
          }
        }
      }

      xos_db_query("drop table if exists address_book,
                                         address_format,
                                         admin,
                                         admin_files,
                                         admin_groups,  
                                         banners,
                                         banners_content,  
                                         banners_history,
                                         categories_or_pages,
                                         categories_or_pages_data,
                                         configuration,
                                         contents,
                                         contents_data,
                                         counter,
                                         counter_history, 
                                         countries,
                                         countries_list,
                                         coupons,
                                         coupons_description,
                                         coupon_email_track,
                                         coupon_gv_customer,
                                         coupon_gv_queue,
                                         coupon_redeem_track,
                                         currencies,
                                         customers,
                                         customers_basket,
                                         customers_groups,  
                                         customers_info, 
                                         geo_zones,  
                                         languages,
                                         manufacturers,
                                         manufacturers_info,
                                         newsletter_subscribers,  
                                         newsletters,  
                                         orders,
                                         orders_products,
                                         orders_products_attributes,
                                         orders_products_download,
                                         orders_status,
                                         orders_status_history,
                                         orders_total,
                                         products,
                                         products_attributes,
                                         products_attributes_download,
                                         products_description,
                                         products_notifications,
                                         products_options,
                                         products_options_values,
                                         products_options_values_to_products_options,  
                                         products_prices,  
                                         products_to_categories,
                                         products_xsell,  
                                         reviews,
                                         reviews_description,
                                         sessions,
                                         specials,
                                         tax_class,
                                         tax_rates,
                                         tax_rates_description,
                                         tax_rates_final,
                                         whos_online,    
                                         zones,
                                         zones_list,
                                         zones_to_geo_zones");
                                                                                 
      for ($i=0; $i<sizeof($sql_array); $i++) {
        xos_db_query($sql_array[$i]);
      }
    } else {
      return false;
    }
  }
?>
