<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : reset_and_update.php
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
//              filename: specials.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

////
// Auto expire products on special
  function xos_expire_specials() {
    global $smarty;
  
    $specials_query = xos_db_query("select specials_id, products_id, customers_group_id from " . TABLE_SPECIALS . " where status = '1' and now() > date_add(expires_date,interval 1 day) and expires_date > 0");
    if (xos_db_num_rows($specials_query)) {
      while ($specials = xos_db_fetch_array($specials_query)) {              
        xos_db_query("update " . TABLE_SPECIALS . " set expires_date = null, status = '0' where specials_id = '" . (int)$specials['specials_id'] . "'");
        $specials_status_query = xos_db_query("select products_price from " . TABLE_PRODUCTS . " where products_id = '" . (int)$specials['products_id'] . "'");
        $specials_status = xos_db_fetch_array($specials_status_query);
        $products_prices = xos_get_product_prices($specials_status['products_price']);
        if (isset($products_prices[$specials['customers_group_id']]['special_status'])) {
          $products_prices[$specials['customers_group_id']]['special_status'] = '0';
          xos_db_query("update " . TABLE_PRODUCTS . " set products_price = '" . serialize($products_prices) . "', products_last_modified = now() where products_id = '" . (int)$specials['products_id'] . "'");
        }             
      }            
      $smarty->clearAllCache();
    }
  }
  
////
// Auto update products date available
  function xos_update_products_date_available() {
    global $smarty;
  
    $expected_query = xos_db_query("select products_id  from " . TABLE_PRODUCTS . " p where to_days(now()) >= to_days(p.products_date_available)");
    if (xos_db_num_rows($expected_query)) {
      while ($expected = xos_db_fetch_array($expected_query)) {    
        xos_db_query("update " . TABLE_PRODUCTS . " set products_last_modified = now(), products_date_available = null where products_id = '" . (int)$expected['products_id'] . "'");           
      }     
      $smarty->clearCache(null, 'L3|cc_index_default');
      $smarty->clearCache(null, 'L3|cc_product_info');
    }
  } 
  
////
// Reset new order date and clear all cache
  function xos_update_new_order_date() {
    global $smarty;
  
    $new_order_date_query = xos_db_query("select last_modified  from " . TABLE_CONFIGURATION . " where configuration_key = 'NEW_ORDER' and configuration_value = 'true' and now() > date_add(last_modified,interval " . UPDATE_INTERVAL_AFTER_NEW_ORDER . " day)");
    if (xos_db_num_rows($new_order_date_query)) {
      xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = 'false', last_modified = null where configuration_key = 'NEW_ORDER'");     
      $smarty->clearAllCache();
    }
  }     
?>
