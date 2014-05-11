<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : products_attributes.php
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
//              filename: products_attributes.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_PRODUCTS_ATTRIBUTES) == 'overwrite_all')) :  
  $languages = xos_get_languages();

  $pID = (isset($_GET['pID']) && is_numeric($_GET['pID'])) ? $_GET['pID'] : 0;
  $cPath = (isset($_GET['cPath']) && !empty($_GET['cPath'])) ? $_GET['cPath'] : 0;

  $categories_or_pages_id = (isset($_GET['categories_or_pages_id']) && is_numeric($_GET['categories_or_pages_id'])) ? $_GET['categories_or_pages_id'] : 0;
  $manufacturers_id = (isset($_GET['manufacturers_id']) && is_numeric($_GET['manufacturers_id'])) ? $_GET['manufacturers_id'] : 0;

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
   
  $option_page = (isset($_GET['option_page']) && is_numeric($_GET['option_page'])) ? $_GET['option_page'] : 1; 
  $value_page = (isset($_GET['value_page']) && is_numeric($_GET['value_page'])) ? $_GET['value_page'] : 1; 
  $attribute_page = (isset($_GET['attribute_page']) && is_numeric($_GET['attribute_page'])) ? $_GET['attribute_page'] : 1; 
  
  $parameter_string = 'categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows'] . '&max_products_in_pullwown=' . $_GET['max_products_in_pullwown'] . '&selected_tax_rate_id=' . $_GET['selected_tax_rate_id'] . '&option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page . (($pID && $cPath) ? '&pID=' . $pID . '&cPath=' . $cPath : '');
  $cmm_parameter_string = 'categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows'] . '&max_products_in_pullwown=' . $_GET['max_products_in_pullwown'] . '&selected_tax_rate_id=' . $_GET['selected_tax_rate_id'] . (($pID && $cPath) ? '&pID=' . $pID . '&cPath=' . $cPath : ''); 
  
  if (xos_not_null($action)) {    
    switch ($action) {
      case 'add_product_options':
        $products_options_id = xos_db_prepare_input($_POST['products_options_id']);
        $option_name_array = $_POST['option_name'];

        $products_options_name_error = array();
        $error_options_name = false;
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {     
          $check_query = xos_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages[$i]['id'] . "' and products_options_name = '" . xos_db_input(htmlspecialchars($option_name_array[$languages[$i]['id']])) . "'"); 
          if (xos_db_num_rows($check_query) || $option_name_array[$languages[$i]['id']] == '') {
            $error_options_name = true;
            $products_options_name_error[$languages[$i]['id']] = $option_name_array[$languages[$i]['id']];             
          }
        } 
        
        if ($error_options_name) {
          $products_options_name_error_array = urlencode(serialize($products_options_name_error));
          $products_options_name_array = urlencode(serialize($option_name_array));
          xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&options_name=' . $products_options_name_array  . '&options_name_error=' . $products_options_name_error_array . '&' . $parameter_string));
        } else {        
          for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
            $option_name = xos_db_prepare_input(htmlspecialchars($option_name_array[$languages[$i]['id']]));

            xos_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, products_options_name, language_id) values ('" . (int)$products_options_id . "', '" . xos_db_input($option_name) . "', '" . (int)$languages[$i]['id'] . "')");
          }
          
          xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string));
        }
        break;
      case 'add_product_option_values':
        $value_name_array = $_POST['value_name'];
        $value_id = xos_db_prepare_input($_POST['value_id']);
        $option_id = xos_db_prepare_input($_POST['option_id']);

        $products_options_value_error = array();
        $error_options_value = false;
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {     
          $check_query = xos_db_query("select pov.products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po where pov2po.products_options_id = '" . $option_id . "' and pov2po.products_options_values_id = pov.products_options_values_id and pov.products_options_values_name = '" . xos_db_input(htmlspecialchars($value_name_array[$languages[$i]['id']])) . "' and pov.language_id = '" . (int)$languages[$i]['id'] . "'"); 
          if (xos_db_num_rows($check_query) || $value_name_array[$languages[$i]['id']] == '') {
            $error_options_value = true;
            $products_options_value_error[$languages[$i]['id']] = $value_name_array[$languages[$i]['id']];             
          }
        } 
        
        if ($error_options_value) {
          $products_options_value_error_array = urlencode(serialize($products_options_value_error));
          $products_options_value_array = urlencode(serialize($value_name_array));
          xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&option_id=' . $option_id . '&options_value=' . $products_options_value_array . '&options_value_error=' . $products_options_value_error_array . '&' . $parameter_string));
        } else {        
          for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
            $value_name = xos_db_prepare_input(htmlspecialchars($value_name_array[$languages[$i]['id']]));

            xos_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name) values ('" . (int)$value_id . "', '" . (int)$languages[$i]['id'] . "', '" . xos_db_input($value_name) . "')");
          }

          xos_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_id, products_options_values_id) values ('" . (int)$option_id . "', '" . (int)$value_id . "')");

          xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string));
        }
        break;
      case 'add_product_attributes':
        $products_id = xos_db_prepare_input($_POST['products_id']);
        $options_id = xos_db_prepare_input($_POST['options_id']);
        $values_id = xos_db_prepare_input($_POST['values_id']);
        $value_price = xos_db_prepare_input($_POST['value_price']);
        $price_prefix = ($_POST['price_prefix'] == '-' && $value_price > 0) ? '-' : '+'; 
        
        $count_query = xos_db_query("select options_values_id, options_sort_order from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and options_id = '" . (int)$options_id . "'");
        
        $existing_option = false;
        $existing_value = false;
        $options_sort_order = 0;
        while($count = xos_db_fetch_array($count_query)) {          
          if ($count['options_values_id'] == $values_id) $existing_value = true;
          $existing_option = true;
          $options_sort_order = $count['options_sort_order'];
        }
        
        if (isset($_POST['values_id']) && !$existing_value) {
          xos_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " values (null, '" . (int)$products_id . "', '" . (int)$options_id . "', '" . (int)$values_id . "', '" . max(1,(int)$options_sort_order) . "', 1, '" . (float)xos_db_input($value_price) . "', '" . xos_db_input($price_prefix) . "')");
          
          if (DOWNLOAD_ENABLED == 'true') {
            $products_attributes_id = xos_db_insert_id();

            $products_attributes_filename = xos_db_prepare_input($_POST['products_attributes_filename']);
            $products_attributes_maxdays = xos_db_prepare_input($_POST['products_attributes_maxdays']);
            $products_attributes_maxcount = xos_db_prepare_input($_POST['products_attributes_maxcount']);

            if (xos_not_null($products_attributes_filename)) {
              xos_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " values (" . (int)$products_attributes_id . ", '" . xos_db_input($products_attributes_filename) . "', '" . xos_db_input($products_attributes_maxdays) . "', '" . xos_db_input($products_attributes_maxcount) . "')");
            }
          }
          
          if (!$existing_option) {
            xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '0', products_last_modified = now(), attributes_quantity = null, attributes_combinations = null, attributes_not_updated = null where products_id = '" . (int)$products_id . "'");

            if (STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
              xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . (int)$products_id . "'");              
            }
            
            $smarty_cache_control->clearAllCache();
          } else {
            $attributes_query = xos_db_query("select attributes_combinations, attributes_not_updated from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
            $attributes = xos_db_fetch_array($attributes_query);
            
            if (xos_not_null($attributes['attributes_combinations'])) {
              $attributes_not_updated = xos_get_attributes_not_updated($attributes['attributes_not_updated']);
              $attributes_not_updated[] = (int)$options_id . ',' . (int)$values_id;
              if (!empty($attributes_not_updated)) xos_db_query("update " . TABLE_PRODUCTS . " set products_last_modified = now(), attributes_not_updated = '" . xos_db_input(serialize($attributes_not_updated)) . "' where products_id = '" . (int)$products_id . "'");
            }  
          }          
        
          $smarty_cache_control->clearCache(null, 'L3|cc_product_info');
        }  
        
        xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $parameter_string));
        break;
      case 'update_option_name':
        $option_name_array = $_POST['option_name'];
        $option_id = xos_db_prepare_input($_POST['option_id']);
        $actual_option_name_array = xos_db_prepare_input($_POST['actual_option_name']);

        $products_options_name_error = array();
        $error_options_name = false;
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          if (mb_strtolower($actual_option_name_array[$languages[$i]['id']], 'UTF-8') != mb_strtolower($option_name_array[$languages[$i]['id']], 'UTF-8') || $option_name_array[$languages[$i]['id']] == '') {     
            $check_query = xos_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages[$i]['id'] . "' and products_options_name = '" . xos_db_input(htmlspecialchars($option_name_array[$languages[$i]['id']])) . "'"); 
            if (xos_db_num_rows($check_query) || $option_name_array[$languages[$i]['id']] == '') {
              $error_options_name = true;
              $products_options_name_error[$languages[$i]['id']] = $option_name_array[$languages[$i]['id']];             
            }
          }  
        } 
        
        if ($error_options_name) {
          $products_options_name_error_array = urlencode(serialize($products_options_name_error));
          $products_options_name_array = urlencode(serialize($option_name_array));
          xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&action=update_option&option_id=' . $option_id . '&options_name=' . $products_options_name_array  . '&options_name_error=' . $products_options_name_error_array . '&' . $parameter_string));
        } else {        
          for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
            $option_name = xos_db_prepare_input(htmlspecialchars($option_name_array[$languages[$i]['id']]));

            xos_db_query("update " . TABLE_PRODUCTS_OPTIONS . " set products_options_name = '" . xos_db_input($option_name) . "' where products_options_id = '" . (int)$option_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          }

          $smarty_cache_control->clearCache(null, 'L3|cc_product_info');

          xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string));
        }
        break;
      case 'update_value':
        $value_name_array = $_POST['value_name'];
        $value_id = xos_db_prepare_input($_POST['value_id']);
        $option_id = xos_db_prepare_input($_POST['option_id']);
        $actual_option_value_array = xos_db_prepare_input($_POST['actual_value_name']);

        $products_options_value_error = array();
        $error_options_value = false;
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          if (mb_strtolower($actual_option_value_array[$languages[$i]['id']], 'UTF-8') != mb_strtolower($value_name_array[$languages[$i]['id']], 'UTF-8') || $value_name_array[$languages[$i]['id']] == '') {     
            $check_query = xos_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages[$i]['id'] . "' and products_options_name = '" . xos_db_input(htmlspecialchars($option_name_array[$languages[$i]['id']])) . "'"); 
            $check_query = xos_db_query("select pov.products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po where pov2po.products_options_id = '" . $option_id . "' and pov2po.products_options_values_id = pov.products_options_values_id and pov.products_options_values_name = '" . xos_db_input(htmlspecialchars($value_name_array[$languages[$i]['id']])) . "' and pov.language_id = '" . (int)$languages[$i]['id'] . "'"); 
            if (xos_db_num_rows($check_query) || $value_name_array[$languages[$i]['id']] == '') {
              $error_options_value = true;
              $products_options_value_error[$languages[$i]['id']] = $value_name_array[$languages[$i]['id']];             
            }                         
          }  
        } 

        if ($error_options_value) {
          $products_options_value_error_array = urlencode(serialize($products_options_value_error));
          $products_options_value_array = urlencode(serialize($value_name_array));
          xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&action=update_option_value&option_id=' . $option_id . '&value_id=' . $value_id . '&options_value=' . $products_options_value_array . '&options_value_error=' . $products_options_value_error_array . '&' . $parameter_string));
        } else {                 
          for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
            $value_name = xos_db_prepare_input(htmlspecialchars($value_name_array[$languages[$i]['id']]));

            xos_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES . " set products_options_values_name = '" . xos_db_input($value_name) . "' where products_options_values_id = '" . xos_db_input($value_id) . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          }

          $smarty_cache_control->clearCache(null, 'L3|cc_product_info');

          xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string));
        }  
        break;
      case 'update_product_attribute':
        $products_id = xos_db_prepare_input($_POST['products_id']);
        $options_id = xos_db_prepare_input($_POST['options_id']);
        $values_id = xos_db_prepare_input($_POST['values_id']);
        $value_price = xos_db_prepare_input($_POST['value_price']);
        $price_prefix = ($_POST['price_prefix'] == '-' && $value_price > 0) ? '-' : '+';
        $attribute_id = xos_db_prepare_input($_POST['attribute_id']);
        $current_options_id = xos_db_prepare_input($_POST['current_options_id']);
        $current_options_values_id = xos_db_prepare_input($_POST['current_options_values_id']);

        $count_query = xos_db_query("select options_values_id, options_sort_order from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and options_id = '" . (int)$options_id . "'");
        
        $existing_option = false;
        $existing_value = false;
        $options_sort_order = 0;
        while($count = xos_db_fetch_array($count_query)) {
          if ($count['options_values_id'] == $values_id && $values_id != $current_options_values_id) $existing_value = true;
          $existing_option = true;
          $options_sort_order = $count['options_sort_order'];
        }
        
        if (isset($_POST['values_id']) && !$existing_value) {           
          if (!$existing_option) {
            xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '0', products_last_modified = now(), attributes_quantity = null, attributes_combinations = null, attributes_not_updated = null where products_id = '" . (int)$products_id . "'");
            
            if (STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
              xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . (int)$products_id . "'");
            }
          } else {
            $combinations_query = xos_db_query("select products_quantity, attributes_quantity, attributes_combinations, attributes_not_updated from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
            $combinations = xos_db_fetch_array($combinations_query);
        
            $qty = 0;               
            if (xos_not_null($combinations['attributes_combinations'])) {         
              $attributes_not_updated = xos_get_attributes_not_updated($combinations['attributes_not_updated']);
              if ($values_id != $current_options_values_id) {
                foreach ($attributes_not_updated as $key_not_updated => $val_not_updated) {                
                  if ($val_not_updated == $current_options_id . ',' . $current_options_values_id) unset($attributes_not_updated[$key_not_updated]);                           
                }

                $attributes_not_updated[] = (int)$options_id . ',' . (int)$values_id;
                                
                ksort($attributes_not_updated);
                if (empty($attributes_not_updated)) { 
                  $not_updated = ", attributes_not_updated = null";              
                } else {
                  $not_updated = ", attributes_not_updated = '". xos_db_input(serialize($attributes_not_updated)) . "'";
                }               
              } else {
                $not_updated = "";
              }                                
                   
              $qty = $combinations['products_quantity'];
              $attributes_quantity = xos_get_attributes_quantity($combinations['attributes_quantity']);
              $combinations['attributes_combinations'] = trim($combinations['attributes_combinations'], '|');
              $elements_comb = explode('|', $combinations['attributes_combinations']);        
              for ($i=0, $n=sizeof($elements_comb); $i<$n; $i++) {      
                if (strpos($elements_comb[$i], $current_options_id . ',' . $current_options_values_id) !== false && $values_id != $current_options_values_id) {
                  $qty -= $attributes_quantity[$elements_comb[$i]] > 0 ? $attributes_quantity[$elements_comb[$i]] : 0;
                  unset($attributes_quantity[$elements_comb[$i]]);
                  unset($elements_comb[$i]);
                }  
              }
       
              ksort($attributes_quantity);
              ksort($elements_comb);
              $comb_str = '';
              $comb_str = implode('|', $elements_comb);
              $qty < 1 || $comb_str == '' ? $qty = 0 : '';
          
              if ($comb_str != '') {
                $comb_str .= '|';
                xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$qty . "', products_last_modified = now(), attributes_quantity = '" . xos_db_input(serialize($attributes_quantity)) . "', attributes_combinations = '" . xos_db_input($comb_str) . "'" . $not_updated . " where products_id = '" . (int)$products_id . "'");
              } else {
                xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$qty . "', products_last_modified = now(), attributes_quantity = null, attributes_combinations = null, attributes_not_updated = null where products_id = '" . (int)$products_id . "'");
              }           
            }        

            if ($qty < 1 && STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
              xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . (int)$products_id . "'");
            }         
          }
          
          xos_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set options_id = '" . (int)$options_id . "', options_values_id = '" . (int)$values_id . "', options_sort_order = '" . max(1,(int)$options_sort_order) . "', " . ($current_options_id != $options_id ? 'options_values_sort_order = 1,' : '') . " options_values_price = '" . (float)xos_db_input($value_price) . "', price_prefix = '" . xos_db_input($price_prefix) . "' where products_attributes_id = '" . (int)$attribute_id . "'");                              
          
          if (DOWNLOAD_ENABLED == 'true') {
            $products_attributes_filename = xos_db_prepare_input($_POST['products_attributes_filename']);
            $products_attributes_maxdays = xos_db_prepare_input($_POST['products_attributes_maxdays']);
            $products_attributes_maxcount = xos_db_prepare_input($_POST['products_attributes_maxcount']);

            if (xos_not_null($products_attributes_filename)) {
              xos_db_query("replace into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " set products_attributes_id = '" . (int)$attribute_id . "', products_attributes_filename = '" . xos_db_input($products_attributes_filename) . "', products_attributes_maxdays = '" . xos_db_input($products_attributes_maxdays) . "', products_attributes_maxcount = '" . xos_db_input($products_attributes_maxcount) . "'");
            } else {
              xos_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . (int)$attribute_id . "'");
            }
          }
        
          $smarty_cache_control->clearAllCache();
        }  
        
        xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $parameter_string));
        break;
      case 'update_options_sort_order':
        reset($_POST['option_sort_order'][(int)$_GET['products_id']]);               
        while (list($key, $value) = each($_POST['option_sort_order'][(int)$_GET['products_id']])) {        
          $value = xos_db_prepare_input($value);          
          if ((int)$value > 0) xos_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set options_sort_order = '" . (int)$value . "' where products_id = '" . (int)$_GET['products_id'] . "' and options_id = '" . (int)$key . "'");               
        }
        
        $combinations_query = xos_db_query("select attributes_combinations from " . TABLE_PRODUCTS . " where products_id = '" . (int)$_GET['products_id'] . "'");
        $combinations = xos_db_fetch_array($combinations_query);
               
        if (xos_not_null($combinations['attributes_combinations'])) {       
          $sort_query = xos_db_query("select distinct options_id from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$_GET['products_id'] . "' order by options_sort_order asc, options_id asc");        
          $c_str = '';
          $sorted_options_id = array();
          while($sort = xos_db_fetch_array($sort_query)) {
            $sorted_options_id[] = $sort['options_id'];
          }

          $attributes_quantity = array(); 
          $c_str = '';
          reset($_POST['string_fragment'][(int)$_GET['products_id']]);
          while (list($key, $value) = @each($_POST['string_fragment'][(int)$_GET['products_id']])) { 
            $qty = isset($_POST['attributes_quantity'][(int)$_GET['products_id']][$value]) ? (int)$_POST['attributes_quantity'][(int)$_GET['products_id']][$value] : 0;       
            $elements_in = explode('_', $value);                    
            for ($i=0, $n=sizeof($elements_in); $i<$n; $i++) {           
              for ($ii=0, $m=sizeof($sorted_options_id); $ii<$m; $ii++) {          
                if (strpos($elements_in[$i], $sorted_options_id[$ii] . ',') !== false) $elements_out[$ii] = $elements_in[$i];                                  
              }
            }          
            ksort($elements_out);
            $value = implode('_', $elements_out);
            $attributes_quantity[$value] = $qty;
            $c_str .= $value . '|';                       
          }

          if ($c_str != '') xos_db_query("update " . TABLE_PRODUCTS . " set products_last_modified = now(), attributes_quantity = '" . xos_db_input(serialize($attributes_quantity)) . "', attributes_combinations = '" . xos_db_input($c_str) . "' where products_id = '" . (int)$_GET['products_id'] . "'");
        }
                
        $smarty_cache_control->clearCache(null, 'L3|cc_product_info');
     
        xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $parameter_string));
        break;         
      case 'update_options_values_sort_order':
        $sort_query = xos_db_query("select products_attributes_id from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$_GET['products_id'] . "' and options_id = '" . (int)$_GET['options_id'] . "'");
        
        while($sort = xos_db_fetch_array($sort_query)) {         
          $option_value_sort_order = xos_db_prepare_input($_POST['option_value_sort_order'][(int)$sort['products_attributes_id']]);          
          if ((int)$option_value_sort_order > 0) xos_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set options_values_sort_order = '" . (int)$option_value_sort_order . "' where products_attributes_id = '" . (int)$sort['products_attributes_id'] . "'");               
        }       
        
        $smarty_cache_control->clearCache(null, 'L3|cc_product_info');
     
        xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $parameter_string));
        break;
      case 'update_combinations':
        $attributes_quantity = array(); 
        $c_str = '';
        $qty = 0;
        reset($_POST['string_fragment'][(int)$_GET['products_id']]);
        while (list($key, $value) = @each($_POST['string_fragment'][(int)$_GET['products_id']])) {        
          $attributes_quantity[$value] = isset($_POST['attributes_quantity'][(int)$_GET['products_id']][$value]) ? (int)$_POST['attributes_quantity'][(int)$_GET['products_id']][$value] : 0;
          $qty += $attributes_quantity[$value] > 0 ? $attributes_quantity[$value] : 0; 
          $c_str .= $value . '|';                                 
        }
        
        if ($c_str != '') xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$qty . "', products_last_modified = now(), products_status = '" . (int)xos_db_prepare_input($_POST['products_status'][(int)$_GET['products_id']]) . "', attributes_quantity = '" . xos_db_input(serialize($attributes_quantity)) . "', attributes_combinations = '" . xos_db_input($c_str) . "', attributes_not_updated = null where products_id = '" . (int)$_GET['products_id'] . "'");                        
        
        if ($qty < 1 && STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
          xos_db_query("update " . TABLE_PRODUCTS . " set products_last_modified = now(), products_status = '0' where products_id = '" . (int)$_GET['products_id'] . "'");          
        }
        
        $smarty_cache_control->clearAllCache();        
     
        xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $parameter_string));
        break;                  
      case 'delete_option':
        $option_id = xos_db_prepare_input($_GET['option_id']);

        xos_db_query("delete from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$option_id . "'");

        xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string));
        break;
      case 'delete_value':
        $value_id = xos_db_prepare_input($_GET['value_id']);

        xos_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$value_id . "'");
        xos_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_values_id = '" . (int)$value_id . "'");        

        xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string));
        break;
      case 'delete_attribute':
        $attribute_id = xos_db_prepare_input($_GET['attribute_id']);
        $products_id = xos_db_prepare_input($_GET['products_id']);

        $combinations_query = xos_db_query("select p.products_quantity, p.attributes_quantity, p.attributes_combinations, p.attributes_not_updated, pa.options_id, pa.options_values_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where p.products_id = '" . (int)$products_id . "' and pa.products_attributes_id = '" . (int)$attribute_id . "'");
        $combinations = xos_db_fetch_array($combinations_query);
        
        $qty = 0;               
        if (xos_not_null($combinations['attributes_combinations'])) {

          $attributes_not_updated = xos_get_attributes_not_updated($combinations['attributes_not_updated']);
          foreach ($attributes_not_updated as $key_not_updated => $val_not_updated) {                
            if ($val_not_updated == $combinations['options_id'] . ',' . $combinations['options_values_id']) unset($attributes_not_updated[$key_not_updated]);                           
          }          
              
          ksort($attributes_not_updated);
          if (empty($attributes_not_updated)) { 
            $not_updated = "attributes_not_updated = null";              
          } else {
            $not_updated = "attributes_not_updated = '". xos_db_input(serialize($attributes_not_updated)) . "'";
          }
        
          $qty = $combinations['products_quantity'];
          $attributes_quantity = xos_get_attributes_quantity($combinations['attributes_quantity']);
          $combinations['attributes_combinations'] = trim($combinations['attributes_combinations'], '|');
          $elements_comb = explode('|', $combinations['attributes_combinations']);        
          for ($i=0, $n=sizeof($elements_comb); $i<$n; $i++) {      
            if (strpos($elements_comb[$i], $combinations['options_id'] . ',' . $combinations['options_values_id']) !== false) {
              $qty -= $attributes_quantity[$elements_comb[$i]] > 0 ? $attributes_quantity[$elements_comb[$i]] : 0;
              unset($attributes_quantity[$elements_comb[$i]]);
              unset($elements_comb[$i]);
            }  
          }
       
          ksort($attributes_quantity);
          ksort($elements_comb);
          $comb_str = '';
          $comb_str = implode('|', $elements_comb);
          $qty < 1 || $comb_str == '' ? $qty = 0 : '';
          
          if ($comb_str != '') {
            $comb_str .= '|';
            xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$qty . "', products_last_modified = now(), attributes_quantity = '" . xos_db_input(serialize($attributes_quantity)) . "', attributes_combinations = '" . xos_db_input($comb_str) . "', " . $not_updated . " where products_id = '" . (int)$products_id . "'");
          } else {
            xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$qty . "', products_last_modified = now(), attributes_quantity = null, attributes_combinations = null, attributes_not_updated = null where products_id = '" . (int)$products_id . "'");
          }
          
          $smarty_cache_control->clearAllCache();           
        }        

        xos_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_attributes_id = '" . (int)$attribute_id . "'");

// added for DOWNLOAD_ENABLED. Always try to remove attributes, even if downloads are no longer enabled
        xos_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . (int)$attribute_id . "'");
               
        if ($qty < 1 && STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
          xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . (int)$products_id . "'");
          $smarty_cache_control->clearAllCache();
        }
        
        $smarty_cache_control->clearCache(null, 'L3|cc_product_info'); 
        
        xos_redirect(xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $parameter_string));
        break;
    }
  }

  define('MAX_ROW_LISTS_OPTIONS', 15);
  define('MAX_PRODUCTS_IN_PULLDOWN', 50);

  $max_display_rows_array = array();
  $max_display_rows_array[] = array('id' => MAX_ROW_LISTS_OPTIONS, 'text' => MAX_ROW_LISTS_OPTIONS);
  for ($i = 20; $i <=200 ; $i=$i+20) {
    $max_display_rows_array[] = array('id' => $i, 'text' => $i);
  }

  $max_display_products_in_pulldown_array = array();
  $max_display_products_in_pulldown_array[] = array('id' => MAX_PRODUCTS_IN_PULLDOWN, 'text' => MAX_PRODUCTS_IN_PULLDOWN);  
  for ($i = 100; $i <=500 ; $i=$i+50) {
    $max_display_products_in_pulldown_array[] = array('id' => $i, 'text' => $i);
  }

  $manufacturers_array = array(array('id' => '', 'text' => TEXT_ALL));
  $manufacturers_query = xos_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " where languages_id = '" . (int)$_SESSION['used_lng_id'] . "' order by manufacturers_name");
  while ($manufacturers = xos_db_fetch_array($manufacturers_query)) {
    $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                   'text' => $manufacturers['manufacturers_name']);
  }

  $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
  $tax_class_query = xos_db_query("select distinct tc.tax_class_id, tc.tax_class_title from " . TABLE_TAX_CLASS . " tc, " . TABLE_TAX_RATES . " tr where tc.tax_class_id = tr.tax_class_id order by tc.tax_class_title");
  while ($tax_class = xos_db_fetch_array($tax_class_query)) {
    $tax_class_array[] = array('id' => $tax_class['tax_class_id'],
                               'text' => $tax_class['tax_class_title']);
  }
    
  $tax_rates_final_array = array(array('id' => '0', 'text' => TEXT_NONE));
  $tax_rates_final_query = xos_db_query("select tr.tax_rates_final_id, tc.tax_class_title, gz.geo_zone_name, tr.tax_rate_final from " . TABLE_TAX_RATES_FINAL . " tr, " . TABLE_TAX_CLASS . " tc, " . TABLE_GEO_ZONES . " gz where tr.tax_class_id = tc.tax_class_id and tr.tax_zone_id = gz.geo_zone_id order by tc.tax_class_title, gz.geo_zone_name");
  while ($tax_rates_final= xos_db_fetch_array($tax_rates_final_query)) {
    $tax_rates_final_array[] = array('id' => $tax_rates_final['tax_rates_final_id'],
                                     'text' => $tax_rates_final['tax_class_title'] . ' (' . $tax_rates_final['geo_zone_name'] . ') [' . $tax_rates_final['tax_rate_final'] . '%]',
                                     'value' => $tax_rates_final['tax_rate_final']);
  } 

  function xos_get_categories_string($parent_id = '', $entrance = false, $categories_string = '') {
    
    if ($entrance) {
      $categories_string = " p2c.categories_or_pages_id = '" . $parent_id . "'";
    }

    $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.parent_id from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and c.parent_id = '" . (int)$parent_id . "' order by c.sort_order, cpd.categories_or_pages_name");
    while ($categories = xos_db_fetch_array($categories_query)) {
      $categories_string .= " or p2c.categories_or_pages_id = '" . $categories['categories_or_pages_id'] . "'";
      $categories_string = xos_get_categories_string($categories['categories_or_pages_id'], '', $categories_string);
    }

    return $categories_string;
  }

  $javascript = '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n\n" .

                'function toggle() {' . "\n" .
                '  if (document.getElementById("options").style.display == "none"){' . "\n" .
                '    document.getElementById("filter").style.display="none";' . "\n" .
                '    document.getElementById("no-filter").style.display="";' . "\n" .
                '    document.getElementById("options").style.display="";' . "\n" .
                '    document.getElementById("attributes").style.display="none";' . "\n" .
                '  } else {' . "\n" .
                '    document.getElementById("filter").style.display="";' . "\n" .
                '    document.getElementById("no-filter").style.display="none";' . "\n" .
                '    document.getElementById("options").style.display="none";' . "\n" .
                '    document.getElementById("attributes").style.display="";' . "\n" .
                '  }' . "\n" .                  
                '}' . "\n\n" .
                   
                '/* ]]> */' . "\n" .
                '</script>' . "\n";                   
                      
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($pID) {
    $smarty->assign(array('single_product' => true,
                          'text_new_product' => sprintf(TEXT_NEW_PRODUCT_3, ($form_action == 'insert_product' ? TEXT_NEW_PRODUCT_1 : TEXT_NEW_PRODUCT_2), xos_output_generated_category_path($current_category_id)),
                          'link_back_to_product_list' => xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pID),    
                          'form_begin_filter_products_attributes' => xos_draw_form('filter_products_attributes', FILENAME_PRODUCTS_ATTRIBUTES, '','get'),
                          'pull_down_menu_max_rows' => xos_draw_pull_down_menu('max_rows', $max_display_rows_array, $_GET['max_rows'], 'style="width: 75px;"'),
                          'hidden_fields_page_info' =>  xos_draw_hidden_field('pID', $pID) . xos_draw_hidden_field('cPath', $cPath) . xos_draw_hidden_field('selected_tax_rate_id', $_GET['selected_tax_rate_id']) . xos_draw_hidden_field('option_page', $_GET['option_page']) . xos_draw_hidden_field('value_page', $_GET['value_page']) . xos_draw_hidden_field('attribute_page', $_GET['attribute_page']),                             
                          'form_end_filter' => '</form>'));
    

  } else{
    $smarty->assign(array('form_begin_filter_products_attributes' => xos_draw_form('filter_products_attributes', FILENAME_PRODUCTS_ATTRIBUTES, '','get'),
                          'pull_down_menu_categories_or_pages_id' => xos_draw_pull_down_menu('categories_or_pages_id', xos_get_category_tree(), $categories_or_pages_id),
                          'pull_down_menu_manufacturers_id' => xos_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $manufacturers_id),
                          'pull_down_menu_max_rows' => xos_draw_pull_down_menu('max_rows', $max_display_rows_array, $_GET['max_rows'], 'style="width: 75px;"'),
                          'pull_down_menu_max_products' => xos_draw_pull_down_menu('max_products_in_pullwown', $max_display_products_in_pulldown_array, $_GET['max_products_in_pullwown'], 'style="width: 155px;"'),
                          'hidden_fields_page_info' =>  xos_draw_hidden_field('selected_tax_rate_id', $_GET['selected_tax_rate_id']) . xos_draw_hidden_field('option_page', $_GET['option_page']) . xos_draw_hidden_field('value_page', $_GET['value_page']) . xos_draw_hidden_field('attribute_page', $_GET['attribute_page']),                             
                          'form_end_filter' => '</form>'));
  }

  if (SID) {
    $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
  }

  $js_init_style = '<script type="text/javascript">' . "\n" .
                   '/* <![CDATA[ */' . "\n\n";
  if ($_GET['first_entrance']) {
    $js_init_style .= '    document.getElementById("filter").style.display="";' . "\n" .
                      '    document.getElementById("no-filter").style.display="none";' . "\n" .
                      '    document.getElementById("options").style.display="none";' . "\n" .
                      '    document.getElementById("attributes").style.display="none";' . "\n\n";                   
  } elseif ($_GET['options_page']) {
    $js_init_style .= '    document.getElementById("filter").style.display="none";' . "\n" .
                      '    document.getElementById("no-filter").style.display="";' . "\n" .
                      '    document.getElementById("options").style.display="";' . "\n" .
                      '    document.getElementById("attributes").style.display="none";' . "\n\n";
  } else {
   $js_init_style .=  '    document.getElementById("filter").style.display="";' . "\n" .
                      '    document.getElementById("no-filter").style.display="none";' . "\n" .
                      '    document.getElementById("options").style.display="none";' . "\n" .
                      '    document.getElementById("attributes").style.display="";' . "\n\n";
  }                  
  $js_init_style .= '/* ]]> */' . "\n" .
                    '</script>' . "\n"; 
                   
  $smarty->assign('js_init_style', $js_init_style);                     

  if (!$_GET['first_entrance']) {
    require(DIR_WS_MODULES . 'attributes_options.php');
    require(DIR_WS_MODULES . 'attributes_values.php');
    require(DIR_WS_MODULES . 'attributes_products.php');
  }  

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'products_attributes');
  $output_products_attributes = $smarty->fetch(ADMIN_TPL . '/products_attributes.tpl');
  
  $smarty->assign('central_contents', $output_products_attributes);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
