<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : general.php
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
//              filename: general.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

////
// Redirect to another page or site
  function xos_redirect($url, $change_connection = true) {
    if ( (strstr($url, "\n") != false) || (strstr($url, "\r") != false) ) { 
      xos_redirect(xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
    }

    if ( (ENABLE_SSL == 'true') && (getenv('HTTPS') == 'on') && ($change_connection == true)) { // We are loading an SSL page
      if (substr($url, 0, strlen(HTTP_SERVER)) == HTTP_SERVER) { // NONSSL url
        $url = HTTPS_SERVER . substr($url, strlen(HTTP_SERVER)); // Change it to SSL
      }
    }

    $url = str_replace('&amp;', '&', $url);

    header('Location: ' . $url);

    exit();
  }

////
// Parse the data used in the html tags to ensure the tags will not break
  function xos_parse_input_field_data($data, $parse) {
    return strtr(trim($data), $parse);
  }

  function xos_output_string($string, $translate = false, $protected = false) {
    if ($protected == true) {
      return htmlspecialchars($string);
    } else {
      if ($translate == false) {
        return xos_parse_input_field_data($string, array('"' => '&quot;'));
      } else {
        return xos_parse_input_field_data($string, $translate);
      }
    }
  }

  function xos_output_string_protected($string) {
    return xos_output_string($string, false, true);
  }

  function xos_sanitize_string($string) {
    $string = preg_replace('/ +/', ' ', trim($string));

    return preg_replace("/[<>]/", '_', $string);
  }

////
// Return a random row from a database query
  function xos_random_select($query) {
    $random_product = '';
    $random_query = xos_db_query($query);
    $num_rows = xos_db_num_rows($random_query);
    if ($num_rows > 0) {
      $random_row = xos_rand(0, ($num_rows - 1));
      xos_db_data_seek($random_query, $random_row);
      $random_product = xos_db_fetch_array($random_query);
    }

    return $random_product;
  }

////
// Return a product's name
// TABLES: products
  function xos_get_products_name($product_id, $language_id = 0) {

    if ($language_id == 0) $language_id = $_SESSION['languages_id'];
    $product_query = xos_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = xos_db_fetch_array($product_query);

    return $product['products_name'];
  }

////
// Check if the required stock is available
// If insufficent stock is available return an out of stock message
  function xos_check_stock($products_id, $products_quantity) {
    $out_of_stock = '';  
    $product_id = xos_get_prid($products_id);
 
    if ($product_id == $products_id) {   
      $stock_query = xos_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
      $stock_values = xos_db_fetch_array($stock_query);
    } else {                  
      $stock_query = xos_db_query("select attributes_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
      $stock_values = xos_db_fetch_array($stock_query);
     
      $attributes_quantity = xos_get_attributes_quantity($stock_values['attributes_quantity']);
      list($prid, $params_sting) = explode('-', $products_id);
      $stock_values['products_quantity'] = $attributes_quantity[$params_sting];
    }  
    
    if (($stock_values['products_quantity'] - $products_quantity) < 0) {
      $out_of_stock = '<span class="mark-product-out-of-stock">' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</span>';
    }

    return $out_of_stock;
  }

////
// Break a word in a string if it is longer than a specified length ($len)
  function xos_break_string($string, $len, $break_char = '-') {
    $l = 0;
    $output = '';
    for ($i=0, $n=strlen($string); $i<$n; $i++) {
      $char = substr($string, $i, 1);
      if ($char != ' ') {
        $l++;
      } else {
        $l = 0;
      }
      if ($l > $len) {
        $l = 1;
        $output .= $break_char;
      }
      $output .= $char;
    }

    return $output;
  }

////
// Return all HTTP GET variables, except those passed as a parameter
  function xos_get_all_get_params($exclude_array = '') {

    if (!is_array($exclude_array)) $exclude_array = array();

    $get_url = '';
    if (is_array($_GET) && (sizeof($_GET) > 0)) {
      reset($_GET);
      while (list($key, $value) = each($_GET)) {
        if ( is_string($value) && (strlen($value) > 0) && ($key != xos_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array)) && ($key != 'x') && ($key != 'y') ) {
          $get_url .= $key . '=' . rawurlencode(stripslashes($value)) . '&';
        }
      }
    }

    return $get_url;
  }

////
// Returns an array with countries
// TABLES: countries
  function xos_get_countries($countries_id = '', $with_iso_codes = false) {
    $countries_array = array();
    if (xos_not_null($countries_id)) {
      if ($with_iso_codes == true) {
        $countries = xos_db_query("select countries_name, countries_iso_code_2, countries_iso_code_3 from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$countries_id . "' order by countries_name");
        $countries_values = xos_db_fetch_array($countries);
        $countries_array = array('countries_name' => $countries_values['countries_name'],
                                 'countries_iso_code_2' => $countries_values['countries_iso_code_2'],
                                 'countries_iso_code_3' => $countries_values['countries_iso_code_3']);
      } else {
        $countries = xos_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$countries_id . "'");
        $countries_values = xos_db_fetch_array($countries);
        $countries_array = array('countries_name' => $countries_values['countries_name']);
      }
    } else {
      $countries = xos_db_query("select countries_id, countries_name from " . TABLE_COUNTRIES . " order by countries_name");
      while ($countries_values = xos_db_fetch_array($countries)) {
        $countries_array[] = array('countries_id' => $countries_values['countries_id'],
                                   'countries_name' => $countries_values['countries_name']);
      }
    }

    return $countries_array;
  }

////
// Alias function to xos_get_countries, which also returns the countries iso codes
  function xos_get_countries_with_iso_codes($countries_id) {
    return xos_get_countries($countries_id, true);
  }

////
// Generate a path to categories
  function xos_get_path($current_category_id = '') {
    global $cPath_array;

    if (xos_not_null($current_category_id)) {
      $cp_size = sizeof($cPath_array);
      if ($cp_size == 0) {
        $cPath_new = $current_category_id;
      } else {
        $cPath_new = '';
        $last_category_query = xos_db_query("select parent_id from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$cPath_array[($cp_size-1)] . "'");
        $last_category = xos_db_fetch_array($last_category_query);

        $current_category_query = xos_db_query("select parent_id from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$current_category_id . "'");
        $current_category = xos_db_fetch_array($current_category_query);

        if ($last_category['parent_id'] == $current_category['parent_id']) {
          for ($i=0; $i<($cp_size-1); $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        } else {
          for ($i=0; $i<$cp_size; $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        }
        $cPath_new .= '_' . $current_category_id;

        if (substr($cPath_new, 0, 1) == '_') {
          $cPath_new = substr($cPath_new, 1);
        }
      }
    } else {
      $cPath_new = implode('_', $cPath_array);
    }

    return 'cPath=' . $cPath_new;
  }

////
// Returns the clients browser
  function xos_browser_detect($component) {

    return stristr($_SERVER['HTTP_USER_AGENT'], $component);
  }

////
// Alias function to xos_get_countries()
  function xos_get_country_name($country_id) {
    $country_array = xos_get_countries($country_id);

    return $country_array['countries_name'];
  }

////
// Returns the zone (State/Province) name
// TABLES: zones
  function xos_get_zone_name($country_id, $zone_id, $default_zone) {
    $zone_query = xos_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' and zone_id = '" . (int)$zone_id . "'");
    if (xos_db_num_rows($zone_query)) {
      $zone = xos_db_fetch_array($zone_query);
      return $zone['zone_name'];
    } else {
      return $default_zone;
    }
  }

////
// Returns the zone (State/Province) code
// TABLES: zones
  function xos_get_zone_code($country_id, $zone_id, $default_zone) {
    $zone_query = xos_db_query("select zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' and zone_id = '" . (int)$zone_id . "'");
    if (xos_db_num_rows($zone_query)) {
      $zone = xos_db_fetch_array($zone_query);
      return $zone['zone_code'];
    } else {
      return $default_zone;
    }
  }
// alte Versionen
/*
////
// Returns the tax rate for a zone / class
// TABLES: tax_rates, zones_to_geo_zones
  function xos_get_tax_rate($class_id, $country_id = '', $zone_id = '') {

    if ($_SESSION['sppc_customer_group_tax_exempt'] == '1') {
      return 0;
    }

    if ( ($country_id == '') && ($zone_id == '') ) {
      if (!isset($_SESSION['customer_id'])) {
        $country_id = STORE_COUNTRY;
        $zone_id = STORE_ZONE;
      } else {
        $country_id = $_SESSION['customer_country_id'];
        $zone_id = $_SESSION['customer_zone_id'];
      }
    }

    $tax_query = xos_db_query("select sum(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' group by tr.tax_priority");
    if (xos_db_num_rows($tax_query)) {
      $tax_multiplier = 1.0;
      while ($tax = xos_db_fetch_array($tax_query)) {
        $tax_multiplier *= 1.0 + ($tax['tax_rate'] / 100);
      }
      return ($tax_multiplier - 1.0) * 100;
    } else {
      return 0;
    }
  }

////
// Return the tax description for a zone / class
// TABLES: tax_rates;
  function xos_get_tax_description($class_id, $country_id, $zone_id) {
  
    if ( ($country_id == '') && ($zone_id == '') ) {
      if (!isset($_SESSION['customer_id'])) {
        $country_id = STORE_COUNTRY;
        $zone_id = STORE_ZONE;
      } else {
        $country_id = $_SESSION['customer_country_id'];
        $zone_id = $_SESSION['customer_zone_id'];
      }
    }
      
    $tax_query = xos_db_query("select tax_description from " . TABLE_TAX_RATES_DESCRIPTION . " trd, " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where trd.tax_rates_id = tr.tax_rates_id and (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' and trd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by tr.tax_priority");
    if (xos_db_num_rows($tax_query)) {
      $tax_description = '';
      while ($tax = xos_db_fetch_array($tax_query)) {
        $tax_description .= $tax['tax_description'] . ' + ';
      }
      $tax_description = '[' . substr($tax_description, 0, -3) . ']';
      
      $tax_description .= ' (' . xos_display_tax_value(xos_get_tax_rate($class_id, $country_id, $zone_id)) . '%)';

      return $tax_description;
    } else {
      return TEXT_UNKNOWN_TAX_RATE;
    }
  }
*/
////
// Returns the tax rate for a zone / class
// TABLES: tax_rates, zones_to_geo_zones
  function xos_get_tax_rate($class_id, $country_id = '', $zone_id = '') {
    static $tax_rates = array();

    if ($_SESSION['sppc_customer_group_tax_exempt'] == '1') {
      return 0;
    }

    if ( ($country_id == '') && ($zone_id == '') ) {
      if (!isset($_SESSION['customer_id'])) {
        $country_id = STORE_COUNTRY;
        $zone_id = STORE_ZONE;
      } else {
        $country_id = $_SESSION['customer_country_id'];
        $zone_id = $_SESSION['customer_zone_id'];
      }
    }

    if (!isset($tax_rates[$class_id][$country_id][$zone_id]['rate'])) {
      $tax_query = xos_db_query("select sum(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' group by tr.tax_priority");
      if (xos_db_num_rows($tax_query)) {
        $tax_multiplier = 1.0;
        while ($tax = xos_db_fetch_array($tax_query)) {
          $tax_multiplier *= 1.0 + ($tax['tax_rate'] / 100);
        }

        $tax_rates[$class_id][$country_id][$zone_id]['rate'] = ($tax_multiplier - 1.0) * 100;
      } else {
        $tax_rates[$class_id][$country_id][$zone_id]['rate'] = 0;
      }
    }

    return $tax_rates[$class_id][$country_id][$zone_id]['rate'];
  }
  
////
// Return the tax description for a zone / class
// TABLES: tax_rates;
  function xos_get_tax_description($class_id, $country_id, $zone_id) {
    static $tax_rates = array();
    
    if ( ($country_id == '') && ($zone_id == '') ) {
      if (!isset($_SESSION['customer_id'])) {
        $country_id = STORE_COUNTRY;
        $zone_id = STORE_ZONE;
      } else {
        $country_id = $_SESSION['customer_country_id'];
        $zone_id = $_SESSION['customer_zone_id'];
      }
    }
    
    if (!isset($tax_rates[$class_id][$country_id][$zone_id]['description'])) {
      $tax_query = xos_db_query("select tax_description from " . TABLE_TAX_RATES_DESCRIPTION . " trd, " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where trd.tax_rates_id = tr.tax_rates_id and (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' and trd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by tr.tax_priority");
      if (xos_db_num_rows($tax_query)) {
        $tax_description = '';
        while ($tax = xos_db_fetch_array($tax_query)) {
          $tax_description .= $tax['tax_description'] . ' + ';
        }
        $tax_description = '[' . substr($tax_description, 0, -3) . ']';
      
        $tax_description .= ' (' . xos_display_tax_value(xos_get_tax_rate($class_id, $country_id, $zone_id)) . '%)';

        $tax_rates[$class_id][$country_id][$zone_id]['description'] = $tax_description;
      } else {
        $tax_rates[$class_id][$country_id][$zone_id]['description'] = TEXT_UNKNOWN_TAX_RATE;
      }
    }

    return $tax_rates[$class_id][$country_id][$zone_id]['description'];
  } 

////
// Return the tax description of the ad for a product price
  function xos_get_products_tax_description($class_id, $tax_rate) {

    if ($_SESSION['sppc_customer_group_tax_exempt'] == '1') {
      return 'SMARTY_TAX_WITHOUT_VAT';
    } elseif (!$tax_rate > 0) {
      return 'SMARTY_TAX_NO_VAT';  
    } elseif (FULL_TAX_INFO == 'true') { 
              
      if (!isset($_SESSION['customer_id'])) {
        $country_id = STORE_COUNTRY;
        $zone_id = STORE_ZONE;
      } else {
        $country_id = $_SESSION['customer_country_id'];
        $zone_id = $_SESSION['customer_zone_id'];
      }
   
      $tax_query = xos_db_query("select tax_description from " . TABLE_TAX_RATES_DESCRIPTION . " trd, " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where trd.tax_rates_id = tr.tax_rates_id and (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' and trd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by tr.tax_priority");
      if (xos_db_num_rows($tax_query)) {
        $tax_description = '';
        while ($tax = xos_db_fetch_array($tax_query)) {
          $tax_description .= $tax['tax_description'] . ' + ';
        }
        $tax_description = substr($tax_description, 0, -3);
      
        if ($_SESSION['sppc_customer_group_show_tax'] == '1') {
          $products_tax_description = TEXT_TAX_INC_VAT . '&nbsp;[' . $tax_description . '] (' . xos_display_tax_value($tax_rate) . '%)';
        } else {
          $products_tax_description = TEXT_TAX_PLUS_VAT . '&nbsp;[' . $tax_description . '] (' . xos_display_tax_value($tax_rate) . '%)';
        } 

        return $products_tax_description;
      } else {      
        return TEXT_UNKNOWN_TAX_RATE;
      }    
    } elseif ($_SESSION['sppc_customer_group_show_tax'] == '1') { 
      return 'SMARTY_TAX_INC_VAT (' . xos_display_tax_value($tax_rate) . '%)';
    } else {
      return 'SMARTY_TAX_PLUS_VAT (' . xos_display_tax_value($tax_rate) . '%)';
    }      
  } 

////
// Add tax to a products price
  function xos_add_tax($price, $tax) {
    global $currencies;

    if (($tax > 0) && ($_SESSION['sppc_customer_group_show_tax'] == '1')) {
      return round($price, $currencies->currencies[$_SESSION['currency']]['decimal_places']) + xos_calculate_tax($price, $tax);
    } else {
      return round($price, $currencies->currencies[$_SESSION['currency']]['decimal_places']);
    }
  }

// Calculates Tax rounding the result
  function xos_calculate_tax($price, $tax) {
    global $currencies;

    return round($price * $tax / 100, $currencies->currencies[$_SESSION['currency']]['decimal_places']);
  }

////
// Return the number of products in a category
// TABLES: products, products_to_categories, categories
  function xos_count_products_in_category($category_id, $include_inactive = false) {
    $products_count = 0;
    if ($include_inactive == true) {
      $products_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = p2c.products_id and p2c.categories_or_pages_id = '" . (int)$category_id . "'");
    } else {
      $products_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where p.products_id = p2c.products_id and c.categories_or_pages_status = '1' and p.products_status = '1' and p2c.categories_or_pages_id = '" . (int)$category_id . "'");
    }
    $products = xos_db_fetch_array($products_query);
    $products_count += $products['total'];

    $child_categories_query = xos_db_query("select categories_or_pages_id from " . TABLE_CATEGORIES_OR_PAGES . " where parent_id = '" . (int)$category_id . "'");
    if (xos_db_num_rows($child_categories_query)) {
      while ($child_categories = xos_db_fetch_array($child_categories_query)) {
        $products_count += xos_count_products_in_category($child_categories['categories_or_pages_id'], $include_inactive);
      }
    }

    return $products_count;
  }

////
// Return true if the category has subcategories
// TABLES: categories
  function xos_has_category_subcategories($category_id) {
    $child_category_query = xos_db_query("select count(*) as count from " . TABLE_CATEGORIES_OR_PAGES . " where parent_id = '" . (int)$category_id . "' and page_not_in_menu != '1' and categories_or_pages_status = '1'");
    $child_category = xos_db_fetch_array($child_category_query);

    if ($child_category['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }

////
// Returns the address_format_id for the given country
// TABLES: countries;
  function xos_get_address_format_id($country_id) {
    $address_format_query = xos_db_query("select address_format_id as format_id from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$country_id . "'");
    if (xos_db_num_rows($address_format_query)) {
      $address_format = xos_db_fetch_array($address_format_query);
      return $address_format['format_id'];
    } else {
      return '1';
    }
  }

////
// Return a formatted address
// TABLES: address_format
  function xos_address_format($address_format_id, $address, $html, $boln, $eoln) {
    $address_format_query = xos_db_query("select address_format as format from " . TABLE_ADDRESS_FORMAT . " where address_format_id = '" . (int)$address_format_id . "'");
    $address_format = xos_db_fetch_array($address_format_query);

    $company = xos_output_string_protected($address['company']);
    if (isset($address['firstname']) && xos_not_null($address['firstname'])) {
      $firstname = xos_output_string_protected($address['firstname']);
      $lastname = xos_output_string_protected($address['lastname']);
    } elseif (isset($address['name']) && xos_not_null($address['name'])) {
      $firstname = xos_output_string_protected($address['name']);
      $lastname = '';
    } else {
      $firstname = '';
      $lastname = '';
    }
    $street = xos_output_string_protected($address['street_address']);
    $suburb = xos_output_string_protected($address['suburb']);
    $city = xos_output_string_protected($address['city']);
    $state = xos_output_string_protected($address['state']);
    if (isset($address['country_id']) && xos_not_null($address['country_id'])) {
      $country = xos_get_country_name($address['country_id']);

      if (isset($address['zone_id']) && xos_not_null($address['zone_id'])) {
        $state = xos_get_zone_code($address['country_id'], $address['zone_id'], $state);
      }
    } elseif (isset($address['country']) && xos_not_null($address['country'])) {
      $country = xos_output_string_protected($address['country']);
    } else {
      $country = '';
    }
    $postcode = xos_output_string_protected($address['postcode']);
    $zip = $postcode;

    if ($html) {
// HTML Mode
      $HR = '<hr />';
      $hr = '<hr />';
      if ( ($boln == '') && ($eoln == "\n") ) { // Values not specified, use rational defaults
        $CR = '<br />';
        $cr = '<br />';
        $eoln = $cr;
      } else { // Use values supplied
        $CR = $eoln . $boln;
        $cr = $CR;
      }
    } else {
// Text Mode
      $CR = $eoln;
      $cr = $CR;
      $HR = '----------------------------------------';
      $hr = '----------------------------------------';
    }

    $statecomma = '';
    $streets = $street;
    if ($suburb != '') $streets = $street . $cr . $suburb;
    if ($state != '') $statecomma = $state . ', ';

    $fmt = $address_format['format'];
    eval("\$address = \"$fmt\";");

    if ( (ACCOUNT_COMPANY == 'true') && (xos_not_null($company)) ) {
      $address = $company . $cr . $address;
    }

    return $address;
  }

////
// Return a formatted address
// TABLES: customers, address_book
  function xos_address_label($customers_id, $address_id = 1, $html = false, $boln = '', $eoln = "\n") {
    if (is_array($address_id) && !empty($address_id)) {
      return xos_address_format($address_id['address_format_id'], $address_id, $html, $boln, $eoln);
    }
  
    $address_query = xos_db_query("select entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customers_id . "' and address_book_id = '" . (int)$address_id . "'");
    $address = xos_db_fetch_array($address_query);

    $format_id = xos_get_address_format_id($address['country_id']);

    return xos_address_format($format_id, $address, $html, $boln, $eoln);
  }

  function xos_row_number_format($number) {
    if ( ($number < 10) && (substr($number, 0, 1) != '0') ) $number = '0' . $number;

    return $number;
  }

  function xos_get_categories($categories_array = '', $parent_id = '', $indent = '', $include_empty_categories = true) {

    if (!is_array($categories_array)) $categories_array = array();
    if ($parent_id == '') $parent_id = '0';

    $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where parent_id = '" . (int)$parent_id . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and c.categories_or_pages_status = '1' and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by sort_order, cpd.categories_or_pages_name");

    if($include_empty_categories) {
      while ($categories = xos_db_fetch_array($categories_query)) {
        $categories_array[] = array('id' => $categories['categories_or_pages_id'],
                                    'text' => $indent . $categories['categories_or_pages_name']); 
                                    
        if ($categories['categories_or_pages_id'] != $parent_id) {
          $categories_array = xos_get_categories($categories_array, $categories['categories_or_pages_id'], $indent . '&nbsp;&nbsp;');
        }
      }      
    } else {  
      while ($categories = xos_db_fetch_array($categories_query)) {
        if(xos_count_products_in_category($categories['categories_or_pages_id']) > 0) {
          $categories_array[] = array('id' => $categories['categories_or_pages_id'],
                                      'text' => $indent . $categories['categories_or_pages_name']);
                                      
          if ($categories['categories_or_pages_id'] != $parent_id) {
            $categories_array = xos_get_categories($categories_array, $categories['categories_or_pages_id'], $indent . '&nbsp;&nbsp;', false);
          }
        }  
      }      
    }  

    return $categories_array;
  }

  function xos_get_manufacturers($manufacturers_array = '') {
    if (!is_array($manufacturers_array)) $manufacturers_array = array();

    $manufacturers_query = xos_db_query("select distinct mi.manufacturers_id, mi.manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " mi left join " . TABLE_PRODUCTS . " p on (mi.manufacturers_id = p.manufacturers_id  and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' order by mi.manufacturers_name");
    while ($manufacturers = xos_db_fetch_array($manufacturers_query)) {
      $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'], 'text' => $manufacturers['manufacturers_name']);
    }

    return $manufacturers_array;
  }

////
// Return all subcategory IDs
// TABLES: categories
  function xos_get_subcategories(&$subcategories_array, $parent_id = 0) {
    $subcategories_query = xos_db_query("select categories_or_pages_id from " . TABLE_CATEGORIES_OR_PAGES . " where parent_id = '" . (int)$parent_id . "' and categories_or_pages_status = '1'");
    while ($subcategories = xos_db_fetch_array($subcategories_query)) {
      $subcategories_array[sizeof($subcategories_array)] = $subcategories['categories_or_pages_id'];
      if ($subcategories['categories_or_pages_id'] != $parent_id) {
        xos_get_subcategories($subcategories_array, $subcategories['categories_or_pages_id']);
      }
    }
  }

// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
  function xos_date_long($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    return xos_date_format(DATE_FORMAT_LONG, mktime($hour,$minute,$second,$month,$day,$year));
  } 

////
// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
// NOTE: Includes a workaround for dates before 01/01/1970 that fail on windows servers
  function xos_date_short($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || empty($raw_date) ) return false;

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    if (@date('Y', mktime($hour, $minute, $second, $month, $day, $year)) == $year) {
      return date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
    } else {
      return preg_replace('/2037' . '$/', $year, date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, 2037)));
    }
  }
  
  function xos_date_format($format = '', $timestamp = '') {
    global $day_month_names;
    
    if ($format == '') return false;
    if ($timestamp == '') $timestamp = time();    
    $format = str_replace(array('%A', '%a', '%B', '%b'), array('day_%w', 'day_short_%w', 'month_%m', 'month_short_%m'), $format);  
    $date_formatted = str_replace(array_flip($day_month_names), $day_month_names, strftime($format, $timestamp));
                                     
    return $date_formatted;
  }   

////
// Parse search string into indivual objects
  function xos_parse_search_string($search_str = '', &$objects) {
    $search_str = trim($search_str);

// Break up $search_str on whitespace; quoted string will be reconstructed later
    $pieces = str_replace('AND', 'and', str_replace('OR', 'or', preg_split('/[[:space:]]+/', $search_str)));
    $objects = array();
    $tmpstring = '';
    $flag = '';

    for ($k=0; $k<count($pieces); $k++) {
      while (substr($pieces[$k], 0, 1) == '(') {
        $objects[] = '(';
        if (strlen($pieces[$k]) > 1) {
          $pieces[$k] = substr($pieces[$k], 1);
        } else {
          $pieces[$k] = '';
        }
      }

      $post_objects = array();

      while (substr($pieces[$k], -1) == ')')  {
        $post_objects[] = ')';
        if (strlen($pieces[$k]) > 1) {
          $pieces[$k] = substr($pieces[$k], 0, -1);
        } else {
          $pieces[$k] = '';
        }
      }

// Check individual words

      if ( (substr($pieces[$k], -1) != '"') && (substr($pieces[$k], 0, 1) != '"') ) {
        $objects[] = trim($pieces[$k]);

        for ($j=0; $j<count($post_objects); $j++) {
          $objects[] = $post_objects[$j];
        }
      } else {
/* This means that the $piece is either the beginning or the end of a string.
   So, we'll slurp up the $pieces and stick them together until we get to the
   end of the string or run out of pieces.
*/

// Add this word to the $tmpstring, starting the $tmpstring
        $tmpstring = trim(preg_replace('/"/', ' ', $pieces[$k]));

// Check for one possible exception to the rule. That there is a single quoted word.
        if (substr($pieces[$k], -1 ) == '"') {
// Turn the flag off for future iterations
          $flag = 'off';

          $objects[] = trim($pieces[$k]);

          for ($j=0; $j<count($post_objects); $j++) {
            $objects[] = $post_objects[$j];
          }

          unset($tmpstring);

// Stop looking for the end of the string and move onto the next word.
          continue;
        }

// Otherwise, turn on the flag to indicate no quotes have been found attached to this word in the string.
        $flag = 'on';

// Move on to the next word
        $k++;

// Keep reading until the end of the string as long as the $flag is on

        while ( ($flag == 'on') && ($k < count($pieces)) ) {
          while (substr($pieces[$k], -1) == ')') {
            $post_objects[] = ')';
            if (strlen($pieces[$k]) > 1) {
              $pieces[$k] = substr($pieces[$k], 0, -1);
            } else {
              $pieces[$k] = '';
            }
          }

// If the word doesn't end in double quotes, append it to the $tmpstring.
          if (substr($pieces[$k], -1) != '"') {
// Tack this word onto the current string entity
            $tmpstring .= ' ' . $pieces[$k];

// Move on to the next word
            $k++;
            continue;
          } else {
/* If the $piece ends in double quotes, strip the double quotes, tack the
   $piece onto the tail of the string, push the $tmpstring onto the $haves,
   kill the $tmpstring, turn the $flag "off", and return.
*/
            $tmpstring .= ' ' . trim(preg_replace('/"/', ' ', $pieces[$k]));

// Push the $tmpstring onto the array of stuff to search for
            $objects[] = trim($tmpstring);

            for ($j=0; $j<count($post_objects); $j++) {
              $objects[] = $post_objects[$j];
            }

            unset($tmpstring);

// Turn off the flag to exit the loop
            $flag = 'off';
          }
        }
      }
    }

// add default logical operators if needed
    $temp = array();
    for($i=0; $i<(count($objects)-1); $i++) {
      $temp[] = $objects[$i];
      if ( ($objects[$i] != 'and') &&
           ($objects[$i] != 'or') &&
           ($objects[$i] != '(') &&
           ($objects[$i+1] != 'and') &&
           ($objects[$i+1] != 'or') &&
           ($objects[$i+1] != ')') ) {
        $temp[] = ADVANCED_SEARCH_DEFAULT_OPERATOR;
      }
    }
    $temp[] = $objects[$i];
    $objects = $temp;

    $keyword_count = 0;
    $operator_count = 0;
    $balance = 0;
    for($i=0; $i<count($objects); $i++) {
      if ($objects[$i] == '(') $balance --;
      if ($objects[$i] == ')') $balance ++;
      if ( ($objects[$i] == 'and') || ($objects[$i] == 'or') ) {
        $operator_count ++;
      } elseif ( ($objects[$i]) && ($objects[$i] != '(') && ($objects[$i] != ')') ) {
        $keyword_count ++;
      }
    }

    if ( ($operator_count < $keyword_count) && ($balance == 0) ) {
      return true;
    } else {
      return false;
    }
  }

////
// Check date
  function xos_checkdate($date_to_check, $format_string, &$date_array) {
    $separator_idx = -1;

    $separators = array('-', ' ', '/', '.');
    $month_abbr = array('jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec');
    $no_of_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    $format_string = strtolower($format_string);

    if (strlen($date_to_check) != strlen($format_string)) {
      return false;
    }

    $size = sizeof($separators);
    for ($i=0; $i<$size; $i++) {
      $pos_separator = strpos($date_to_check, $separators[$i]);
      if ($pos_separator != false) {
        $date_separator_idx = $i;
        break;
      }
    }

    for ($i=0; $i<$size; $i++) {
      $pos_separator = strpos($format_string, $separators[$i]);
      if ($pos_separator != false) {
        $format_separator_idx = $i;
        break;
      }
    }

    if ($date_separator_idx != $format_separator_idx) {
      return false;
    }

    if ($date_separator_idx != -1) {
      $format_string_array = explode( $separators[$date_separator_idx], $format_string );
      if (sizeof($format_string_array) != 3) {
        return false;
      }

      $date_to_check_array = explode( $separators[$date_separator_idx], $date_to_check );
      if (sizeof($date_to_check_array) != 3) {
        return false;
      }

      $size = sizeof($format_string_array);
      for ($i=0; $i<$size; $i++) {
        if ($format_string_array[$i] == 'mm' || $format_string_array[$i] == 'mmm') $month = $date_to_check_array[$i];
        if (($format_string_array[$i] == 'dd') || ($format_string_array[$i] == 'tt')) $day = $date_to_check_array[$i];
        if ( ($format_string_array[$i] == 'yyyy') || ($format_string_array[$i] == 'aaaa') || ($format_string_array[$i] == 'jjjj') ) $year = $date_to_check_array[$i];
      }
    } else {
      if (strlen($format_string) == 8 || strlen($format_string) == 9) {
        $pos_month = strpos($format_string, 'mmm');
        if ($pos_month != false) {
          $month = substr( $date_to_check, $pos_month, 3 );
          $size = sizeof($month_abbr);
          for ($i=0; $i<$size; $i++) {
            if ($month == $month_abbr[$i]) {
              $month = $i;
              break;
            }
          }
        } else {
          $month = substr($date_to_check, strpos($format_string, 'mm'), 2);
        }
      } else {
        return false;
      }

      $day = substr($date_to_check, strpos($format_string, 'dd'), 2);
      $year = substr($date_to_check, strpos($format_string, 'yyyy'), 4);
    }

    if (strlen($year) != 4) {
      return false;
    }

    if (!settype($year, 'integer') || !settype($month, 'integer') || !settype($day, 'integer')) {
      return false;
    }

    if ($month > 12 || $month < 1) {
      return false;
    }

    if ($day < 1) {
      return false;
    }

    if (xos_is_leap_year($year)) {
      $no_of_days[1] = 29;
    }

    if ($day > $no_of_days[$month - 1]) {
      return false;
    }

    $date_array = array($year, $month, $day);

    return true;
  }

////
// Check if year is a leap year
  function xos_is_leap_year($year) {
    if ($year % 100 == 0) {
      if ($year % 400 == 0) return true;
    } else {
      if (($year % 4) == 0) return true;
    }

    return false;
  }

////
// Recursively go through the categories and retreive all parent categories IDs
// TABLES: categories
  function xos_get_parent_categories(&$categories, $categories_or_pages_id) {
    $parent_categories_query = xos_db_query("select parent_id from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
    while ($parent_categories = xos_db_fetch_array($parent_categories_query)) {
      if ($parent_categories['parent_id'] == 0) return true;
      $categories[sizeof($categories)] = $parent_categories['parent_id'];
      if ($parent_categories['parent_id'] != $categories_or_pages_id) {
        xos_get_parent_categories($categories, $parent_categories['parent_id']);
      }
    }
  }

////
// Construct a category path to the product
// TABLES: products_to_categories
  function xos_get_product_path($products_id) {
    $cPath = '';

    $category_query = xos_db_query("select c.categories_or_pages_id from " . TABLE_PRODUCTS . " p, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = '" . (int)$products_id . "' and p.products_status = '1' and c.categories_or_pages_id = p2c.categories_or_pages_id and p.products_id = p2c.products_id and c.categories_or_pages_status = '1' limit 1");
    if (xos_db_num_rows($category_query)) {
      $category = xos_db_fetch_array($category_query);

      $categories = array();
      xos_get_parent_categories($categories, $category['categories_or_pages_id']);

      $categories = array_reverse($categories);

      $cPath = implode('_', $categories);

      if (xos_not_null($cPath)) $cPath .= '_';
      $cPath .= $category['categories_or_pages_id'];
    }

    return $cPath;
  }

////
// Return a product ID with attributes
  function xos_get_uprid($prid, $params) {
    if (is_numeric($prid)) {
      $uprid = $prid;

      if (is_array($params) && (sizeof($params) > 0)) {
        $attributes_check = true;
        $attributes_ids = '';

        reset($params);
        while (list($option, $value) = each($params)) {
          if (is_numeric($option) && is_numeric($value)) {
            $attributes_ids .= (int)$option . ',' . (int)$value . '_';
          } else {
            $attributes_check = false;
            break;
          }
        }
        
        $attributes_ids = substr($attributes_ids, 0, -1);

        if ($attributes_check == true) {
          $uprid .= ($attributes_ids != '' ? '-' : '') . $attributes_ids;
        }
      }
    } else {
      $uprid = xos_get_prid($prid);

      if (is_numeric($uprid)) {
        if (strpos($prid, '-') !== false) {
          $attributes_check = true;
          $attributes_ids = '';
          
          list($prid, $params_sting) = explode('-', $prid);
          $params = explode('_', $params_sting);
          for ($i=0, $n=sizeof($params); $i<$n; $i++) {
            $pair = explode(',', $params[$i]);
            if (is_numeric($pair[0]) && is_numeric($pair[1])) {
              $attributes_ids .= (int)$pair[0] . ',' . (int)$pair[1] . '_';
            } else {
              $attributes_check = false;
              break;
            }
          }
          
          $attributes_ids = substr($attributes_ids, 0, -1); 
          
          if ($attributes_check == true) {
            $uprid .= ($attributes_ids != '' ? '-' : '') . $attributes_ids;
          }                       
        }
      } else {
        return false;
      }
    }

    return $uprid;
  }

////
// Return a product ID from a product ID with attributes
  function xos_get_prid($uprid) {
    $pieces = explode('-', $uprid);

    if (is_numeric($pieces[0])) {
      return $pieces[0];
    } else {
      return false;
    }
  }

////
// Check if product has attributes
  function xos_has_product_attributes($products_id) {
    $attributes_query = xos_db_query("select count(*) as count from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "'");
    $attributes = xos_db_fetch_array($attributes_query);

    if ($attributes['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }

////
// Get the number of times a word/character is present in a string
  function xos_word_count($string, $needle) {
    $temp_array = preg_split('!' . $needle . '!', $string);

    return sizeof($temp_array);
  }

  function xos_count_modules($modules = '') {
    $count = 0;

    if (empty($modules)) return $count;

    $modules_array = explode(';', $modules);

    for ($i=0, $n=sizeof($modules_array); $i<$n; $i++) {
      $class = substr($modules_array[$i], 0, strrpos($modules_array[$i], '.'));

      if (is_object($GLOBALS[$class])) {
        if ($GLOBALS[$class]->enabled) {
          $count++;
        }
      }
    }

    return $count;
  }

  function xos_count_payment_modules() {
    return xos_count_modules(MODULE_PAYMENT_INSTALLED);
  }

  function xos_count_shipping_modules() {
    return xos_count_modules(MODULE_SHIPPING_INSTALLED);
  }

  function xos_create_random_value($length, $type = 'mixed') {
    if ( ($type != 'mixed') && ($type != 'chars') && ($type != 'digits')) return false;

    $rand_value = '';
    while (strlen($rand_value) < $length) {
      if ($type == 'digits') {
        $char = xos_rand(0,9);
      } else {
        $char = chr(xos_rand(0,255));
      }
      if ($type == 'mixed') {
        if (preg_match('/^[a-z0-9]$/i', $char)) $rand_value .= $char;
      } elseif ($type == 'chars') {
        if (preg_match('/^[a-z]$/i', $char)) $rand_value .= $char;
      } elseif ($type == 'digits') {
        if (preg_match('/^[0-9]$/', $char)) $rand_value .= $char;
      }
    }

    return $rand_value;
  }

  function xos_array_to_query_string($array, $exclude = '', $equals = '=', $separator = '&') {
    if (!is_array($exclude)) $exclude = array();

    $get_string = '';
    if (sizeof($array) > 0) {
      reset($array);
      while (list($key, $value) = each($array)) {
        if ( (!in_array($key, $exclude)) && ($key != 'x') && ($key != 'y') ) {
          $get_string .= $key . $equals . rawurlencode(stripslashes($value)) . $separator;
        }
      }
      $remove_chars = strlen($separator);
      $get_string = substr($get_string, 0, -$remove_chars);
    }

    return $get_string;
  }

  function xos_not_null($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {  
      if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }

////
// Output the tax percentage with optional padded decimals
  function xos_display_tax_value($value, $padding = TAX_DECIMAL_PLACES) {
    if (strpos($value, '.')) {
      $loop = true;
      while ($loop) {
        if (substr($value, -1) == '0') {
          $value = substr($value, 0, -1);
        } else {
          $loop = false;
          if (substr($value, -1) == '.') {
            $value = substr($value, 0, -1);
          }
        }
      }
    }

    if ($padding > 0) {
      if ($decimal_pos = strpos($value, '.')) {
        $decimals = strlen(substr($value, ($decimal_pos+1)));
        for ($i=$decimals; $i<$padding; $i++) {
          $value .= '0';
        }
      } else {
        $value .= '.';
        for ($i=0; $i<$padding; $i++) {
          $value .= '0';
        }
      }
    }

    return $value;
  }
  
////
  function xos_string_to_int($string) {
    return (int)$string;
  }

////
// Parse and secure the cPath parameter values
  function xos_parse_category_path($cPath) {
// make sure the category IDs are integers
    $cPath_array = array_map('xos_string_to_int', explode('_', $cPath));

// make sure no duplicate category IDs exist which could lock the server in a loop
    $tmp_array = array();
    $n = sizeof($cPath_array);
    for ($i=0; $i<$n; $i++) {
      if (!in_array($cPath_array[$i], $tmp_array)) {
        $tmp_array[] = $cPath_array[$i];
      }
    }

    return $tmp_array;
  }

////
// Return a random value
  function xos_rand($min = null, $max = null) {
    static $seeded;

    if (!isset($seeded)) {
      mt_srand((double)microtime()*1000000);
      $seeded = true;
    }

    if (isset($min) && isset($max)) {
      if ($min >= $max) {
        return $min;
      } else {
        return mt_rand($min, $max);
      }
    } else {
      return mt_rand();
    }
  }

  function xos_validate_ip_address($ip_address) {
    if (function_exists('filter_var') && defined('FILTER_VALIDATE_IP')) {
      return filter_var($ip_address, FILTER_VALIDATE_IP, array('flags' => FILTER_FLAG_IPV4));
    }

    if (preg_match('/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/', $ip_address)) {
      $parts = explode('.', $ip_address);

      foreach ($parts as $ip_parts) {
        if ( (intval($ip_parts) > 255) || (intval($ip_parts) < 0) ) {
          return false; // number is not within 0-255
        }
      }

      return true;
    }

    return false;
  }

  function xos_get_ip_address() {

    $ip_address = null;
    $ip_addresses = array();

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      foreach ( array_reverse(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])) as $x_ip ) {
        $x_ip = trim($x_ip);

        if (xos_validate_ip_address($x_ip)) {
          $ip_addresses[] = $x_ip;
        }
      }
    }

    if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip_addresses[] = $_SERVER['HTTP_CLIENT_IP'];
    }

    if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && !empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
      $ip_addresses[] = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }

    if (isset($_SERVER['HTTP_PROXY_USER']) && !empty($_SERVER['HTTP_PROXY_USER'])) {
      $ip_addresses[] = $_SERVER['HTTP_PROXY_USER'];
    }

    $ip_addresses[] = $_SERVER['REMOTE_ADDR'];

    foreach ( $ip_addresses as $ip ) {
      if (!empty($ip) && xos_validate_ip_address($ip)) {
        $ip_address = $ip;
        break;
      }
    }

    return $ip_address;
  }

  function xos_count_customer_orders($id = '', $check_session = true) {

    if (is_numeric($id) == false) {
      if (isset($_SESSION['customer_id'])) {
        $id = $_SESSION['customer_id'];
      } else {
        return 0;
      }
    }

    if ($check_session == true) {
      if ( (isset($_SESSION['customer_id']) == false) || ($id != $_SESSION['customer_id']) ) {
        return 0;
      }
    }

    $orders_check_query = xos_db_query("select count(*) as total from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$id . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and s.public_flag = '1'");
    $orders_check = xos_db_fetch_array($orders_check_query);

    return $orders_check['total'];
  }

  function xos_count_customer_address_book_entries($id = '', $check_session = true) {

    if (is_numeric($id) == false) {
      if (isset($_SESSION['customer_id'])) {
        $id = $_SESSION['customer_id'];
      } else {
        return 0;
      }
    }

    if ($check_session == true) {
      if ( (isset($_SESSION['customer_id']) == false) || ($id != $_SESSION['customer_id']) ) {
        return 0;
      }
    }

    $addresses_query = xos_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$id . "'");
    $addresses = xos_db_fetch_array($addresses_query);

    return $addresses['total'];
  }

// nl2br() prior PHP 4.2.0 did not convert linefeeds on all OSs (it only converted \n)
  function xos_convert_linefeeds($from, $to, $string) {
      return str_replace($from, $to, $string);
  }
  
  function xos_get_products_info($product_id) { 

    $product_query = xos_db_query("select products_info from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . $product_id . "' and language_id = '" . (int)$_SESSION['languages_id'] . "'"); 
    $product_info = xos_db_fetch_array($product_query); 

    return $product_info['products_info']; 
  }
  
////  
// Return unserialize image/images_array 
  function xos_get_product_images(&$serialize_images_array, $first = 'first') {
    
    $images_array = unserialize($serialize_images_array);
    if (!is_array($images_array)) $images_array = array();
    if ($first == 'first')  {
      return array_shift($images_array);
    }
    return $images_array;  
  }
  
////  
// Return unserialize prices_array  
  function xos_get_product_prices(&$serialize_prices_array) {   
    $prices_array = unserialize($serialize_prices_array);
    if (!is_array($prices_array)) $prices_array = array();
    return $prices_array;  
  }
  
////  
// Return unserialize attributes_quantity_array  
  function xos_get_attributes_quantity(&$serialize_attributes_quantity_array) {   
    $attributes_quantity_array = unserialize($serialize_attributes_quantity_array);
    if (!is_array($attributes_quantity_array)) $attributes_quantity_array = array();
    return $attributes_quantity_array;  
  }
  
////
// Create a Coupon Code. length may be between 1 and 16 Characters
// $salt needs some thought.

  function create_coupon_code($salt="secret", $length=SECURITY_CODE_LENGTH) {
    $ccid = md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    srand((double)microtime()*1000000); // seed the random number generator
    $random_start = @rand(0, (128-$length));
    $good_result = 0;
    while ($good_result == 0) {
      $id1=substr($ccid, $random_start,$length);        
      $query = xos_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_code = '" . $id1 . "'");    
      if (!xos_db_num_rows($query)) $good_result = 1;
    }
    return $id1;
  }              
?>
