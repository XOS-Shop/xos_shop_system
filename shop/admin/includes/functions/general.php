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

//Check login and file access
function xos_admin_check_login() {

  if (!isset($_SESSION['login_id'])) {
    xos_redirect(xos_href_link(FILENAME_LOGIN));
  } else {
    $filename = basename( $_SERVER['PHP_SELF'] );   
    $filename = str_replace(array(FILENAME_POPUP_FILE_MANAGER, FILENAME_POPUP_INFO_PAGES, FILENAME_POPUP_PAGES), array(FILENAME_FILE_MANAGER, FILENAME_INFO_PAGES, FILENAME_PAGES), $filename);
    if (!(in_array($filename, array(FILENAME_DEFAULT,
                                    FILENAME_ATTRIBUTE_LISTS,
                                    FILENAME_ATTRIBUTES_QTY_LIST,
                                    FILENAME_FORBIDDEN,
                                    FILENAME_LOGOFF,
                                    FILENAME_ADMIN_ACCOUNT,
                                    FILENAME_POPUP_FORBIDDEN,
                                    FILENAME_POPUP_IMAGE,
                                    FILENAME_ORDERS_PACKINGSLIP,
                                    FILENAME_ORDERS_INVOICE,
                                    FILENAME_BANNER_STATISTICS)))) { 
      $db_file_query = xos_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $_SESSION['login_groups_id'] . "', admin_groups_id) and admin_files_name = '" . $filename . "'");
      if (!xos_db_num_rows($db_file_query)) {
        !in_array(basename( $_SERVER['PHP_SELF'] ), array(FILENAME_POPUP_FILE_MANAGER, FILENAME_POPUP_INFO_PAGES, FILENAME_POPUP_PAGES)) ? xos_redirect(xos_href_link(FILENAME_FORBIDDEN)) : xos_redirect(xos_href_link(FILENAME_POPUP_FORBIDDEN));
      }
    }
  }
}

////
//Return 'true' or 'false' value to display boxes and files in index.php and column_left.php
function xos_admin_check_boxes($filename, $boxes='') {

  $is_boxes = 1;
  if ($boxes == 'sub_boxes') {
    $is_boxes = 0;
  }
  $dbquery = xos_db_query("select admin_files_id from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $_SESSION['login_groups_id'] . "', admin_groups_id) and admin_files_is_boxes = '" . $is_boxes . "' and admin_files_name = '" . $filename . "'");

  $return_value = false;
  if (xos_db_num_rows($dbquery)) {
    $return_value = true;
  }
  return $return_value;
}

////
//Return 'true' or 'false' value to display files stored in box that can be accessed by user
function xos_admin_check_files($filename) {

  $allowed = false;

  $dbquery = xos_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $_SESSION['login_groups_id'] . "', admin_groups_id) and admin_files_is_boxes = '0' and admin_files_name = '" . $filename . "'");
  if (xos_db_num_rows($dbquery)) {
    $allowed = true;
  }
  return $allowed;
}

////
//Get selected file for index.php
function xos_selected_file($filename) {

  $randomize = FILENAME_ADMIN_ACCOUNT;

  $dbquery = xos_db_query("select admin_files_id as boxes_id from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $_SESSION['login_groups_id'] . "', admin_groups_id) and admin_files_is_boxes = '1' and admin_files_name = '" . $filename . "'");
  if (xos_db_num_rows($dbquery)) {
    $boxes_id = xos_db_fetch_array($dbquery);
    $randomize_query = xos_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $_SESSION['login_groups_id'] . "', admin_groups_id) and admin_files_is_boxes = '0' and admin_files_to_boxes = '" . $boxes_id['boxes_id'] . "'");
    if (xos_db_num_rows($randomize_query)) {
      $file_selected = xos_db_fetch_array($randomize_query);
      $randomize = $file_selected['admin_files_name'];
    }
  }
  return $randomize;
}

////
// Redirect to another page or site
  function xos_redirect($url) {
    global $logger;

    if ( (strstr($url, "\n") != false) || (strstr($url, "\r") != false) ) {
      xos_redirect(xos_href_link(FILENAME_DEFAULT));
    }
    
    $url = str_replace('&amp;', '&', $url);
    
    header('Location: ' . $url);

    if (STORE_PAGE_PARSE_TIME == 'true') {
      if (!is_object($logger)) $logger = new logger;
      $logger->timer_stop();
    }

    exit;
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

  function xos_customers_name($customers_id) {
    $customers = xos_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customers_id . "'");
    $customers_values = xos_db_fetch_array($customers);

    return $customers_values['customers_firstname'] . ' ' . $customers_values['customers_lastname'];
  }

  function xos_get_path($current_category_id = '') {
    global $cPath_array;

    if ($current_category_id == '') {
      $cPath_new = implode('_', $cPath_array);
    } else {
      if (sizeof($cPath_array) == 0) {
        $cPath_new = $current_category_id;
      } else {
        $cPath_new = '';
        $last_category_query = xos_db_query("select parent_id from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$cPath_array[(sizeof($cPath_array)-1)] . "'");
        $last_category = xos_db_fetch_array($last_category_query);

        $current_category_query = xos_db_query("select parent_id from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$current_category_id . "'");
        $current_category = xos_db_fetch_array($current_category_query);

        if ($last_category['parent_id'] == $current_category['parent_id']) {
          for ($i = 0, $n = sizeof($cPath_array) - 1; $i < $n; $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        } else {
          for ($i = 0, $n = sizeof($cPath_array); $i < $n; $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        }

        $cPath_new .= '_' . $current_category_id;

        if (substr($cPath_new, 0, 1) == '_') {
          $cPath_new = substr($cPath_new, 1);
        }
      }
    }

    return 'cPath=' . $cPath_new;
  }

  function xos_get_all_get_params($exclude_array = '') {

    if ($exclude_array == '') $exclude_array = array();

    $get_url = '';

    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if (($key != xos_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array))) $get_url .= $key . '=' . $value . '&';
    }

    return $get_url;
  }

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
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

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

  function xos_datetime_short($raw_datetime) {
    if ( ($raw_datetime == '0000-00-00 00:00:00') || ($raw_datetime == '') ) return false;

    $year = (int)substr($raw_datetime, 0, 4);
    $month = (int)substr($raw_datetime, 5, 2);
    $day = (int)substr($raw_datetime, 8, 2);
    $hour = (int)substr($raw_datetime, 11, 2);
    $minute = (int)substr($raw_datetime, 14, 2);
    $second = (int)substr($raw_datetime, 17, 2);

    return xos_date_format(DATE_TIME_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
  }

  function xos_date_format($format = '', $timestamp = '') {
    global $day_month_names;
    
    if ($format == '') return false;
    if ($timestamp == '') $timestamp = time();    
    $format = str_replace(array('%A', '%a', '%B', '%b'), array('day_%w', 'day_short_%w', 'month_%m', 'month_short_%m'), $format); 
    $date_formatted = str_replace(array_flip($day_month_names), $day_month_names, strftime($format, $timestamp));
                                     
    return $date_formatted;
  } 

  function xos_get_category_tree($parent_id = '0', $spacing = '', $exclude = '', $category_tree_array = '', $include_itself = false) {

    if (!is_array($category_tree_array)) $category_tree_array = array();
    if ( (sizeof($category_tree_array) < 1) && ($exclude != '0') ) $category_tree_array[] = array('id' => '0', 'text' => TEXT_TOP);

    if ($include_itself) {
      $category_query = xos_db_query("select cpd.categories_or_pages_name, c.categories_or_pages_status from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and c.is_page = 'false' and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and cpd.categories_or_pages_id = '" . (int)$parent_id . "'");
      $category = xos_db_fetch_array($category_query);
      $category_tree_array[] = array('id' => $parent_id, 'text' => $category['categories_or_pages_name']);
    }

    $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.parent_id, c.categories_or_pages_status from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and c.is_page = 'false' and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and c.parent_id = '" . (int)$parent_id . "' order by c.sort_order, cpd.categories_or_pages_name");
    while ($categories = xos_db_fetch_array($categories_query)) {
      if ($exclude != $categories['categories_or_pages_id']) $category_tree_array[] = array('id' => $categories['categories_or_pages_id'], 'text' => $spacing . $categories['categories_or_pages_name'], 'params' => (($categories['categories_or_pages_status'] == 0) ? 'style="color: red;"' : ''));
      $category_tree_array = xos_get_category_tree($categories['categories_or_pages_id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $category_tree_array);
    }

    return $category_tree_array;
  }
  
  function xos_get_page_tree($parent_id = '0', $spacing = '', $exclude = '', $page_tree_array = '', $include_itself = false) {

    if (!is_array($page_tree_array)) $page_tree_array = array();
    if ( (sizeof($page_tree_array) < 1) && ($exclude != '0') ) $page_tree_array[] = array('id' => '0', 'text' => TEXT_TOP);

    if ($include_itself) {
      $page_query = xos_db_query("select cpd.categories_or_pages_name, c.page_not_in_menu, c.categories_or_pages_status from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and c.is_page != 'false' and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and cpd.categories_or_pages_id = '" . (int)$parent_id . "'");
      $page = xos_db_fetch_array($page_query);
      $page_tree_array[] = array('id' => $parent_id, 'text' => $page['categories_or_pages_name'], 'params' => (($page['categories_or_pages_status'] == 0) ? 'style="color: red;"' : (($page['page_not_in_menu'] == 1) ? 'style="color: #ffaaaa;"' : '')));
    }

    $pages_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.parent_id, c.page_not_in_menu, c.categories_or_pages_status from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and c.is_page != 'false' and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and c.parent_id = '" . (int)$parent_id . "' order by c.sort_order, cpd.categories_or_pages_name");
    while ($pages = xos_db_fetch_array($pages_query)) {
      if ($exclude != $pages['categories_or_pages_id']) $page_tree_array[] = array('id' => $pages['categories_or_pages_id'], 'text' => $spacing . $pages['categories_or_pages_name'], 'params' => (($pages['categories_or_pages_status'] == 0) ? 'style="color: red;"' : (($pages['page_not_in_menu'] == 1) ? 'style="color: #ffaaaa;"' : '')));
      $page_tree_array = xos_get_page_tree($pages['categories_or_pages_id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $page_tree_array);
    }

    return $page_tree_array;
  }  

  function xos_options_name($options_id) {

    $options = xos_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$options_id . "' and language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
    $options_values = xos_db_fetch_array($options);

    return $options_values['products_options_name'];
  }

  function xos_values_name($values_id) {

    $values = xos_db_query("select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$values_id . "' and language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
    $values_values = xos_db_fetch_array($values);

    return $values_values['products_options_values_name'];
  }
  
  function xos_info_image($image, $alt, $width = '', $height = '') {
    if (is_file(DIR_FS_CATALOG_IMAGES . $image)) {
      $image = xos_image(DIR_WS_CATALOG_IMAGES . $image, $alt, $width, $height);
    } else {
      $image = TEXT_IMAGE_NONEXISTENT;
    }

    return $image;
  }  

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

  function xos_get_country_name($country_id) {
    $country_query = xos_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$country_id . "'");

    if (!xos_db_num_rows($country_query)) {
      return $country_id;
    } else {
      $country = xos_db_fetch_array($country_query);
      return $country['countries_name'];
    }
  }

  function xos_get_zone_name($country_id, $zone_id, $default_zone) {
    $zone_query = xos_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' and zone_id = '" . (int)$zone_id . "'");
    if (xos_db_num_rows($zone_query)) {
      $zone = xos_db_fetch_array($zone_query);
      return $zone['zone_name'];
    } else {
      return $default_zone;
    }
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
  
  function internal_link_replacement($match) {
    global $linkable_files;

    $replacement = '';  
    $filename = str_replace(array(HTTP_SERVER, HTTPS_SERVER, DIR_WS_CATALOG), '', $match[2]);

    if (array_key_exists($filename, $linkable_files))  {

      $p_url = parse_url($match[3]);           
 
      if (!empty($p_url['path'])) { 
        $get_params = array();
        $get_array = array();        
        $vars = explode('/', substr(rawurldecode($p_url['path']), 1));
        for ($i=0, $n=sizeof($vars)-1; $i<$n; $i++) {
          if (strpos($vars[$i], '[]')) {
            $get_array[substr($vars[$i], 0, -2)][] = $vars[$i+1];
          } else {
            $vars[$i+1] = str_replace(array('_.~', '~._'), array('/', '\\'), $vars[$i+1]);          
            ($vars[$i+1] == '^') ? $get_params[$vars[$i]] = ' ' : $get_params[$vars[$i]] = $vars[$i+1];
          }
          $i++;
        }

        if (sizeof($get_array) > 0) {
          while (list($key, $value) = each($get_array)) {
            $get_params[$key] = $value;
          }
        }            
      } elseif (!empty($p_url['query'])) {   
        parse_str(htmlspecialchars_decode($p_url['query']), $get_params);
      }
   
      $query_return = xos_array_to_query_string($get_params, array('action', 'currency', 'language', 'tpl', 'rmp', 'XOSsid')); 
  
      $replacement = str_replace($match[1], '[@{link xos_href_link(\''.$filename.'\', \''.$query_return.'\', \''.$linkable_files[$filename].'\')}@]', $match[0]);  
    } else {
      $replacement = $match[0];
    }  
    return $replacement;
  }   
  
  function xos_not_null($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {  
      if ( (is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }

  function xos_browser_detect($component) {

    return stristr($_SERVER['HTTP_USER_AGENT'], $component);    
  }

  function xos_tax_classes_pull_down($parameters, $selected = '') {
    $classes_query = xos_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    if (xos_db_num_rows($classes_query)) {
      $select_string = '<select ' . $parameters . '>';
      while ($classes = xos_db_fetch_array($classes_query)) {
        $select_string .= '<option value="' . $classes['tax_class_id'] . '"';
        if ($selected == $classes['tax_class_id']) $select_string .= ' selected="selected"';
        $select_string .= '>' . $classes['tax_class_title'] . '</option>';
      }
      $select_string .= '</select>';

      return $select_string;
    }
    return false;
  }

  function xos_geo_zones_pull_down($parameters, $selected = '') {
    $zones_query = xos_db_query("select geo_zone_id, geo_zone_name from " . TABLE_GEO_ZONES . " order by geo_zone_name");
    if (xos_db_num_rows($zones_query)) {
      $select_string = '<select ' . $parameters . '>';    
      while ($zones = xos_db_fetch_array($zones_query)) {
        $select_string .= '<option value="' . $zones['geo_zone_id'] . '"';
        if ($selected == $zones['geo_zone_id']) $select_string .= ' selected="selected"';
        $select_string .= '>' . $zones['geo_zone_name'] . '</option>';
      }
      $select_string .= '</select>';

      return $select_string;
    }
    return false;    
  }

  function xos_get_geo_zone_name($geo_zone_id) {
    $zones_query = xos_db_query("select geo_zone_name from " . TABLE_GEO_ZONES . " where geo_zone_id = '" . (int)$geo_zone_id . "'");

    if (!xos_db_num_rows($zones_query)) {
      $geo_zone_name = $geo_zone_id;
    } else {
      $zones = xos_db_fetch_array($zones_query);
      $geo_zone_name = $zones['geo_zone_name'];
    }

    return $geo_zone_name;
  }

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

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : xos_get_zone_code
  //
  // Arguments   : country           country code string
  //               zone              state/province zone_id
  //               def_state         default string if zone==0
  //
  // Return      : state_prov_code   state/province code
  //
  // Description : Function to retrieve the state/province code (as in FL for Florida etc)
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function xos_get_zone_code($country, $zone, $def_state) {

    $state_prov_query = xos_db_query("select zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and zone_id = '" . (int)$zone . "'");

    if (!xos_db_num_rows($state_prov_query)) {
      $state_prov_code = $def_state;
    }
    else {
      $state_prov_values = xos_db_fetch_array($state_prov_query);
      $state_prov_code = $state_prov_values['zone_code'];
    }
    
    return $state_prov_code;
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

  function xos_get_languages() {
    $languages_query = xos_db_query("select languages_id, name, code, image, directory from " . TABLE_LANGUAGES . " where use_in_id > '1' order by sort_order");
    while ($languages = xos_db_fetch_array($languages_query)) {
      $languages_array[] = array('id' => $languages['languages_id'],
                                 'name' => $languages['name'],
                                 'code' => $languages['code'],
                                 'image' => $languages['image'],
                                 'directory' => $languages['directory']);
    }

    return $languages_array;
  }
  
  function xos_get_languages_code($language_id = '') {
    
    if ($language_id == '') $language_id = $_SESSION['used_lng_id'];
    $lang_query = xos_db_query("select code from " . TABLE_LANGUAGES . " where languages_id = '" . xos_db_input($language_id) . "'");
    if (xos_db_num_rows($lang_query)) {
      $lang = xos_db_fetch_array($lang_query);
      return $lang['code'];
    } else {
      return false;
    }
  }
  
  function xos_get_languages_id($language_code = '') {
    
    if ($language_code == '') return false;;
    $lang_query = xos_db_query("select languages_id from " . TABLE_LANGUAGES . " where code = '" . xos_db_input($language_code) . "'");
    if (xos_db_num_rows($lang_query)) {
      $lang = xos_db_fetch_array($lang_query);
      return $lang['languages_id'];
    } else {
      return false;
    }
  }     

  function xos_get_orders_status_name($orders_status_id, $language_id = '') {

    if ($language_id == '') $language_id = $_SESSION['used_lng_id'];
    $orders_status_query = xos_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . (int)$orders_status_id . "' and language_id = '" . (int)$language_id . "'");
    $orders_status = xos_db_fetch_array($orders_status_query);

    return $orders_status['orders_status_name'];
  }

  function xos_get_orders_status() {

    $orders_status_array = array();
    $orders_status_query = xos_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by orders_status_id");
    while ($orders_status = xos_db_fetch_array($orders_status_query)) {
      $orders_status_array[] = array('id' => $orders_status['orders_status_id'],
                                     'text' => $orders_status['orders_status_name']);
    }

    return $orders_status_array;
  }

  function xos_get_products_name($product_id, $language_id = '') {

    if ($language_id == '') $language_id = $_SESSION['used_lng_id'];
    $product_query = xos_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = xos_db_fetch_array($product_query);

    return $product['products_name'];
  }
  
  function xos_get_products_p_unit($product_id, $language_id = '') {

    if ($language_id == '') $language_id = $_SESSION['used_lng_id'];
    $product_query = xos_db_query("select products_p_unit from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = xos_db_fetch_array($product_query);

    return $product['products_p_unit'];
  }  
  
  function xos_get_products_info($product_id, $language_id) {
    $product_query = xos_db_query("select products_info from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = xos_db_fetch_array($product_query);

    return $product['products_info'];
  }  

  function xos_get_products_description_tab_label($product_id, $language_id) {
    $product_query = xos_db_query("select products_description_tab_label from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = xos_db_fetch_array($product_query);

    return $product['products_description_tab_label'];
  }

  function xos_get_products_description($product_id, $language_id) {
    $product_query = xos_db_query("select products_description from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = xos_db_fetch_array($product_query);

    return $product['products_description'];
  }

  function xos_get_products_url($product_id, $language_id) {
    $product_query = xos_db_query("select products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = xos_db_fetch_array($product_query);

    return $product['products_url'];
  }

////
// Return the manufacturers URL in the needed language
// TABLES: manufacturers_info
  function xos_get_manufacturer_url($manufacturer_id, $language_id) {
    $manufacturer_query = xos_db_query("select manufacturers_url from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = xos_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_url'];
  }
  
////
// Return the manufacturers name in the needed language
// TABLES: manufacturers_info
  function xos_get_manufacturers_name($manufacturer_id, $language_id) {
    $manufacturer_query = xos_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = xos_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_name'];
  }  

////
// Wrapper for class_exists() function
// This function is not available in all PHP versions so we test it before using it.
  function xos_class_exists($class_name) {
    if (function_exists('class_exists')) {
      return class_exists($class_name);
    } else {
      return true;
    }
  }

////
// Count how many products exist in a category
// TABLES: products, products_to_categories, categories
  function xos_products_in_category_count($categories_or_pages_id, $include_deactivated = false) {
    $products_count = 0;

    if ($include_deactivated) {
      $products_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = p2c.products_id and p2c.categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
    } else {
      $products_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = p2c.products_id and p.products_status = '1' and p2c.categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
    }

    $products = xos_db_fetch_array($products_query);

    $products_count += $products['total'];

    $children_query = xos_db_query("select categories_or_pages_id from " . TABLE_CATEGORIES_OR_PAGES . " where parent_id = '" . (int)$categories_or_pages_id . "'");
    if (xos_db_num_rows($children_query)) {
      while ($children = xos_db_fetch_array($children_query)) {
        $products_count += xos_products_in_category_count($children['categories_or_pages_id'], $include_deactivated);
      }
    }

    return $products_count;
  }

////
// Count how many subcategories exist in a category
// TABLES: categories_or_pages
  function xos_children_in_category_count($categories_or_pages_id) {
    $categories_count = 0;

    $categories_query = xos_db_query("select categories_or_pages_id from " . TABLE_CATEGORIES_OR_PAGES . " where is_page = 'false' and parent_id = '" . (int)$categories_or_pages_id . "'");
    while ($categories = xos_db_fetch_array($categories_query)) {
      $categories_count++;
      $categories_count += xos_children_in_category_count($categories['categories_or_pages_id']);
    }

    return $categories_count;
  }
  
////
// Count how many subpages exist in a page
// TABLES: categories_or_pages
  function xos_children_in_page_count($categories_or_pages_id) {
    $pages_count = 0;

    $pages_query = xos_db_query("select categories_or_pages_id from " . TABLE_CATEGORIES_OR_PAGES . " where is_page != 'false' and parent_id = '" . (int)$categories_or_pages_id . "'");
    while ($pages = xos_db_fetch_array($pages_query)) {
      $pages_count++;
      $pages_count += xos_children_in_page_count($pages['categories_or_pages_id']);
    }

    return $pages_count;
  }  

////
// Returns an array with countries
// TABLES: countries
  function xos_get_countries($default = '') {
    $countries_array = array();
    if ($default) {
      $countries_array[] = array('id' => '',
                                 'text' => $default);
    }
    $countries_query = xos_db_query("select countries_id, countries_name from " . TABLE_COUNTRIES . " order by countries_name");
    while ($countries = xos_db_fetch_array($countries_query)) {
      $countries_array[] = array('id' => $countries['countries_id'],
                                 'text' => $countries['countries_name']);
    }

    return $countries_array;
  }
  
////
// Returns an array with countries from DBtable countries_list
// TABLES: countries
/*
  function xos_get_countries_from_list() {  
    $countries_array = array();
    $countries_query = xos_db_query("select distinct cl.countries_id, cl.countries_name from " . TABLE_COUNTRIES_LIST . " cl left join " . TABLE_COUNTRIES . " c on cl.countries_id = c.countries_id where c.countries_id <=> NULL order by countries_name");
    while ($countries = xos_db_fetch_array($countries_query)) {
      $check_query = xos_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_name = '" . xos_db_input($countries['countries_name']) . "'");
      if (!xos_db_num_rows($check_query)) {
        $countries_array[] = array('id' => $countries['countries_id'],
                                   'text' => $countries['countries_name']);
      }                             
    }

    return $countries_array;
  }  
*/
  function xos_get_countries_from_list() {  
    $countries_array = array();
    $countries_query = xos_db_query("select countries_id, countries_name from " . TABLE_COUNTRIES_LIST . " order by countries_name");
    while ($countries = xos_db_fetch_array($countries_query)) {
      $check_query = xos_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_name = '" . xos_db_input($countries['countries_name']) . "' or countries_id = '" . xos_db_input($countries['countries_id']) . "'");
      if (!xos_db_num_rows($check_query)) {
        $countries_array[] = array('id' => $countries['countries_id'],
                                   'text' => $countries['countries_name']);
      }                             
    }

    return $countries_array;
  } 
  
////
// return an array with country zones
  function xos_get_country_zones($country_id) {
    $zones_array = array();
    $zones_query = xos_db_query("select zone_id, zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' order by zone_name");
    while ($zones = xos_db_fetch_array($zones_query)) {
      $zones_array[] = array('id' => $zones['zone_id'],
                             'text' => $zones['zone_name']);
    }

    return $zones_array;
  }

  function xos_prepare_country_zones_pull_down($country_id = '') {
// preset the width of the drop-down for Netscape
    $pre = '';
    if ( (!xos_browser_detect('MSIE')) && (xos_browser_detect('Mozilla/4')) ) {
      for ($i=0; $i<45; $i++) $pre .= '&nbsp;';
    }

    $zones = xos_get_country_zones($country_id);

    if (sizeof($zones) > 0) {
      $zones_select = array(array('id' => '', 'text' => PLEASE_SELECT));
      $zones = array_merge($zones_select, (array)$zones);
    } else {
      $zones = array(array('id' => '', 'text' => TYPE_BELOW));
// create dummy options for Netscape to preset the height of the drop-down
      if ( (!xos_browser_detect('MSIE')) && (xos_browser_detect('Mozilla/4')) ) {
        for ($i=0; $i<9; $i++) {
          $zones[] = array('id' => '', 'text' => $pre);
        }
      }
    }

    return $zones;
  }

////
// Get list of address_format_id's
  function xos_get_address_formats() {
    $address_format_query = xos_db_query("select address_format_id from " . TABLE_ADDRESS_FORMAT . " order by address_format_id");
    $address_format_array = array();
    while ($address_format_values = xos_db_fetch_array($address_format_query)) {
      $address_format_array[] = array('id' => $address_format_values['address_format_id'],
                                      'text' => $address_format_values['address_format_id']);
    }
    return $address_format_array;
  }

////
// Alias function for Store configuration values in the Administration Tool
  function xos_cfg_pull_down_country_list($country_id) {
    return xos_draw_pull_down_menu('configuration_value', xos_get_countries(), $country_id, 'style="font-size:9px"');
  }

  function xos_cfg_pull_down_zone_list($zone_id) {
    return xos_draw_pull_down_menu('configuration_value', xos_get_country_zones(STORE_COUNTRY), $zone_id, 'style="font-size:9px"');
  }

  function xos_cfg_pull_down_tax_classes($tax_class_id, $key = '') {
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $tax_class_query = xos_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while ($tax_class = xos_db_fetch_array($tax_class_query)) {
      $tax_class_array[] = array('id' => $tax_class['tax_class_id'],
                                 'text' => $tax_class['tax_class_title']);
    }

    return xos_draw_pull_down_menu($name, $tax_class_array, $tax_class_id);
  }
  
  function xos_cfg_pull_down_templates() {

    $registered_tpls_array = array();
    $registered_tpls_array = explode(',', REGISTERED_TPLS);
    
    for ($i=0; $i<sizeof($registered_tpls_array); $i++) {
      $tpl_array[] = array( 'id' => $registered_tpls_array[$i], 'text' => $registered_tpls_array[$i]);
    }    
    
    sort($tpl_array);
    return xos_draw_pull_down_menu('configuration_value', $tpl_array, DEFAULT_TPL);
  } 

  function xos_cfg_checkbox_templates() {
   
    $registered_tpls_array = array();
    $registered_tpls_array = explode(',', REGISTERED_TPLS);

    $handle = opendir(DIR_FS_CATALOG_IMAGES . 'catalog/templates/');
    $tpl_array = array();
    while  (($tpl = readdir($handle)) !== false) {
       if (is_dir(DIR_FS_CATALOG_IMAGES . 'catalog/templates/' . $tpl) && ($tpl != '.') && ($tpl != '..')) {
         $tpl_array[] = $tpl;
       }
    }         
    closedir($handle);
        
    $handle = opendir(DIR_FS_SMARTY . 'catalog/templates/');
    $tpl_array_1 = array();
    while  (($tpl = readdir($handle)) !== false) {
      if ((in_array($tpl, $tpl_array)) && (is_dir(DIR_FS_SMARTY . 'catalog/templates/' . $tpl)) && ($tpl != '.') && ($tpl != '..')) {
        $tpl_array_1[] =  xos_draw_checkbox_field('configuration_value[]', $tpl, (in_array($tpl, $registered_tpls_array) ? true : false), '', ($tpl == DEFAULT_TPL ? 'disabled="disabled"' : '')) . $tpl . ($tpl == DEFAULT_TPL ? xos_draw_hidden_field('configuration_value[]', $tpl) . '<br />' : '<br />') . "\n";
      }
    }
    closedir($handle);
    
    sort($tpl_array_1);    
    $tpl_string = "\n";  
    $tpl_string .= implode($tpl_array_1);           
    return $tpl_string;
  } 
  
////
// Function to read in text area in admin
 function xos_cfg_textarea($text, $key = '') {
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');
    return xos_draw_textarea_field($name, 35, 5, $text);
 }

  function xos_cfg_get_zone_name($zone_id) {
    $zone_query = xos_db_query("select zone_name from " . TABLE_ZONES . " where zone_id = '" . (int)$zone_id . "'");

    if (!xos_db_num_rows($zone_query)) {
      return $zone_id;
    } else {
      $zone = xos_db_fetch_array($zone_query);
      return $zone['zone_name'];
    }
  }

////
// Sets the status of a banner
  function xos_set_banner_status($banners_id, $status) {
    if ($status == '1') {
      $banners_query = xos_db_query("select b.expires_date, b.expires_impressions, sum(bh.banners_shown) as banners_shown from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_HISTORY . " bh where b.banners_id = '" . (int)$banners_id . "' and b.banners_id = bh.banners_id group by b.banners_id");
      $banners = xos_db_fetch_array($banners_query);
      (date('Y-m-d H:i:s') >= $banners['expires_date']) ? $db_input_expires_date = 'expires_date = NULL,' : $db_input_expires_date = '';
      (($banners['expires_impressions'] > 0) && ($banners['banners_shown'] >= $banners['expires_impressions'])) ? $db_input_expires_impressions = 'expires_impressions = NULL,' : $db_input_expires_impressions = '';          
      return xos_db_query("update " . TABLE_BANNERS . " set status = '1', " . $db_input_expires_impressions . $db_input_expires_date ." date_scheduled = NULL, date_status_change = now() where banners_id = '" . (int)$banners_id . "'");      
    } elseif ($status == '0') {
      return xos_db_query("update " . TABLE_BANNERS . " set status = '0', date_status_change = now() where banners_id = '" . (int)$banners_id . "'");
    } else {
      return -1;
    }
  }

////
// Sets the status of a product on special
  function xos_set_specials_status($specials_id, $status) {
    if ($status == '1') {
      return xos_db_query("update " . TABLE_SPECIALS . " set status = '1', expires_date = NULL where specials_id = '" . (int)$specials_id . "'");
    } elseif ($status == '0') {
      return xos_db_query("update " . TABLE_SPECIALS . " set status = '0' where specials_id = '" . (int)$specials_id . "'");
    } else {
      return -1;
    }
  }
  
////
// Sets the status of a content
  function xos_set_content_status($content_id, $status, $type) {
    if ($status == '1') {
      if ($type == 'index') {        
        $dbquery = xos_db_query("select content_id from " . TABLE_CONTENTS . " where type = 'index' and status = '1'");
        while ($contents_id = xos_db_fetch_array($dbquery)) {
          xos_db_query("update " . TABLE_CONTENTS . " set status = '0', last_modified = now() where content_id = '" . (int)$contents_id['content_id'] . "'");
        }
      }
      if ((int)$content_id == 5) {
        xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '1', last_modified = now() where configuration_key = 'STATUS_POPUP_CONTENT_5'");
      }        
      return xos_db_query("update " . TABLE_CONTENTS . " set status = '1', last_modified = now() where content_id = '" . (int)$content_id . "'");
    } elseif ($status == '0') {
      if ((int)$content_id == 5) {
        xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '0', last_modified = now() where configuration_key = 'STATUS_POPUP_CONTENT_5'");
      }      
      return xos_db_query("update " . TABLE_CONTENTS . " set status = '0', last_modified = now() where content_id = '" . (int)$content_id . "'");
    } else {
      return -1;
    }
  }  

////
// Sets timeout for the current script.
// Cant be used in safe mode.
  function xos_set_time_limit($limit) {
    if (!get_cfg_var('safe_mode')) {
      set_time_limit($limit);
    }
  }

////
// Alias function for Store configuration values in the Administration Tool
  function xos_cfg_select_option($select_array, $key_value, $key = '') {
    $string = '';

    for ($i=0, $n=sizeof($select_array); $i<$n; $i++) {
      $name = ((xos_not_null($key)) ? 'configuration[' . $key . ']' : 'configuration_value');

      $string .= '<br /><input type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';

      if ($key_value == $select_array[$i]) $string .= ' checked="checked"';

      $string .= ' /> ' . $select_array[$i];
    }

    return $string;
  }

////
// Alias function for module configuration keys
  function xos_mod_select_option($select_array, $key_name, $key_value) {
    reset($select_array);
    while (list($key, $value) = each($select_array)) {
      if (is_int($key)) $key = $value;
      $string .= '<br /><input type="radio" name="configuration[' . $key_name . ']" value="' . $key . '"';
      if ($key_value == $key) $string .= ' checked="checked"';
      $string .= ' /> ' . $value;
    }

    return $string;
  }

////
// Retreive server information
  function xos_get_system_information($link = 'db_link') {
    global $$link;
    
    $db_query = xos_db_query("select now() as datetime");
    $db = xos_db_fetch_array($db_query);

    list($system, $host, $kernel) = preg_split('/[\s,]+/', @exec('uname -a'), 5);

    return array('date' => xos_datetime_short(date('Y-m-d H:i:s')),
                 'system' => $system,
                 'kernel' => $kernel,
                 'host' => $host,
                 'ip' => gethostbyname($host),
                 'uptime' => @exec('uptime'),
                 'http_server' => $_SERVER['SERVER_SOFTWARE'],
                 'php' => PHP_VERSION,
                 'zend' => (function_exists('zend_version') ? zend_version() : ''),
                 'db_server' => DB_SERVER,
                 'db_ip' => gethostbyname(DB_SERVER),
                 'db_version' => 'MySQL ' . (class_exists('mysqli') && version_compare(PHP_VERSION, '5.3.0', '>=') ? mysqli_get_server_info($$link) : (function_exists('mysql_get_server_info') ? mysql_get_server_info() : '')),
                 'db_date' => xos_datetime_short($db['datetime']));
  }

  function xos_generate_category_path($id, $from = 'category', $categories_array = '', $index = 0) {

    if (!is_array($categories_array)) $categories_array = array();

    if ($from == 'product') {
      $categories_query = xos_db_query("select categories_or_pages_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$id . "'");
      while ($categories = xos_db_fetch_array($categories_query)) {
        if ($categories['categories_or_pages_id'] == '0') {
          $categories_array[$index][] = array('id' => '0', 'text' => TEXT_TOP);
        } else {
          $category_query = xos_db_query("select cpd.categories_or_pages_name, c.parent_id from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = '" . (int)$categories['categories_or_pages_id'] . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
          $category = xos_db_fetch_array($category_query);
          $categories_array[$index][] = array('id' => $categories['categories_or_pages_id'], 'text' => $category['categories_or_pages_name']);
          if ( (xos_not_null($category['parent_id'])) && ($category['parent_id'] != '0') ) $categories_array = xos_generate_category_path($category['parent_id'], 'category', $categories_array, $index);
          $categories_array[$index] = array_reverse($categories_array[$index]);
        }
        $index++;
      }
    } elseif ($from == 'category') {
      $category_query = xos_db_query("select cpd.categories_or_pages_name, c.parent_id from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = '" . (int)$id . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
      $category = xos_db_fetch_array($category_query);
      $categories_array[$index][] = array('id' => $id, 'text' => $category['categories_or_pages_name']);
      if ( (xos_not_null($category['parent_id'])) && ($category['parent_id'] != '0') ) $categories_array = xos_generate_category_path($category['parent_id'], 'category', $categories_array, $index);
    }

    return $categories_array;
  }
  
  function xos_generate_page_path($id, $pages_array = '', $index = 0) {

    if (!is_array($pages_array)) $pages_array = array();

    $page_query = xos_db_query("select cpd.categories_or_pages_name, c.parent_id from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = '" . (int)$id . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
    $page = xos_db_fetch_array($page_query);
    $pages_array[$index][] = array('id' => $id, 'text' => $page['categories_or_pages_name']);
    if ( (xos_not_null($page['parent_id'])) && ($page['parent_id'] != '0') ) $pages_array = xos_generate_page_path($page['parent_id'], $pages_array, $index);

    return $pages_array;
  }  

  function xos_output_generated_category_path($id, $from = 'category') {
    $calculated_category_path_string = '';
    $calculated_category_path = xos_generate_category_path($id, $from);
    for ($i=0, $n=sizeof($calculated_category_path); $i<$n; $i++) {
      for ($j=0, $k=sizeof($calculated_category_path[$i]); $j<$k; $j++) {
        $calculated_category_path_string .= $calculated_category_path[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
      }
      $calculated_category_path_string = substr($calculated_category_path_string, 0, -16) . '<br />';
    }
    $calculated_category_path_string = substr($calculated_category_path_string, 0, -6);

    if (strlen($calculated_category_path_string) < 1) $calculated_category_path_string = TEXT_TOP;

    return $calculated_category_path_string;
  }
  
  function xos_output_generated_page_path($id) {
    $calculated_page_path_string = '';
    $calculated_page_path = xos_generate_page_path($id);
    for ($i=0, $n=sizeof($calculated_page_path); $i<$n; $i++) {
      for ($j=0, $k=sizeof($calculated_page_path[$i]); $j<$k; $j++) {
        $calculated_page_path_string .= $calculated_page_path[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
      }
      $calculated_page_path_string = substr($calculated_page_path_string, 0, -16) . '<br />';
    }
    $calculated_page_path_string = substr($calculated_page_path_string, 0, -6);

    if (strlen($calculated_page_path_string) < 1) $calculated_page_path_string = TEXT_TOP;

    return $calculated_page_path_string;
  }  

  function xos_get_generated_category_path_ids($id, $from = 'category') {
    $calculated_category_path_string = '';
    $calculated_category_path = xos_generate_category_path($id, $from);
    for ($i=0, $n=sizeof($calculated_category_path); $i<$n; $i++) {
      for ($j=0, $k=sizeof($calculated_category_path[$i]); $j<$k; $j++) {
        $calculated_category_path_string .= $calculated_category_path[$i][$j]['id'] . '_';
      }
      $calculated_category_path_string = substr($calculated_category_path_string, 0, -1) . '<br />';
    }
    $calculated_category_path_string = substr($calculated_category_path_string, 0, -6);

    if (strlen($calculated_category_path_string) < 1) $calculated_category_path_string = TEXT_TOP;

    return $calculated_category_path_string;
  }
  
  function xos_get_generated_page_path_ids($id) {
    $calculated_page_path_string = '';
    $calculated_page_path = xos_generate_page_path($id);
    for ($i=0, $n=sizeof($calculated_page_path); $i<$n; $i++) {
      for ($j=0, $k=sizeof($calculated_page_path[$i]); $j<$k; $j++) {
        $calculated_page_path_string .= $calculated_page_path[$i][$j]['id'] . '_';
      }
      $calculated_page_path_string = substr($calculated_page_path_string, 0, -1) . '<br />';
    }
    $calculated_page_path_string = substr($calculated_page_path_string, 0, -6);

    if (strlen($calculated_page_path_string) < 1) $calculated_page_path_string = TEXT_TOP;

    return $calculated_page_path_string;
  }  

  function xos_remove_category($category_id) {
    $category_image_query = xos_db_query("select categories_image from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$category_id . "'");
    $category_image = xos_db_fetch_array($category_image_query);

    $duplicate_image_query = xos_db_query("select count(*) as total from " . TABLE_CATEGORIES_OR_PAGES . " where categories_image = '" . xos_db_input($category_image['categories_image']) . "'");
    $duplicate_image = xos_db_fetch_array($duplicate_image_query);

    if ($duplicate_image['total'] < 2) {
        @unlink(DIR_FS_CATALOG_IMAGES . 'categories/uploads/' . $category_image['categories_image']);
        @unlink(DIR_FS_CATALOG_IMAGES . 'categories/small/' . $category_image['categories_image']);
        @unlink(DIR_FS_CATALOG_IMAGES . 'categories/medium/' . $category_image['categories_image']);
    }

    xos_db_query("delete from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$category_id . "'");
    xos_db_query("delete from " . TABLE_CATEGORIES_OR_PAGES_DATA . " where categories_or_pages_id = '" . (int)$category_id . "'");
    xos_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_or_pages_id = '" . (int)$category_id . "'");

  }
  
  function xos_remove_page($page_id) {
    xos_db_query("delete from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$page_id . "'");
    xos_db_query("delete from " . TABLE_CATEGORIES_OR_PAGES_DATA . " where categories_or_pages_id = '" . (int)$page_id . "'");
  }  

  function xos_remove_product($product_id) {
    $product_image_query = xos_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
    $product_image = xos_db_fetch_array($product_image_query);
    $products_image_name = xos_get_product_images($product_image['products_image'], 'all');
    reset($products_image_name);
    while($image = each($products_image_name)) {
        @unlink(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $image[1]['name']);
        @unlink(DIR_FS_CATALOG_IMAGES . 'products/extra_small/' . $image[1]['name']);
        @unlink(DIR_FS_CATALOG_IMAGES . 'products/small/' . $image[1]['name']);
        @unlink(DIR_FS_CATALOG_IMAGES . 'products/medium/' . $image[1]['name']);
        @unlink(DIR_FS_CATALOG_IMAGES . 'products/large/' . $image[1]['name']);
    } 
    
    xos_db_query("delete from " . TABLE_SPECIALS . " where products_id = '" . (int)$product_id . "'");
    xos_db_query("delete from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
    xos_db_query("delete from " . TABLE_PRODUCTS_PRICES . " where products_id = '" . (int)$product_id . "'");
    xos_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
    xos_db_query("delete from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "'");
    xos_db_query("delete from " . TABLE_PRODUCTS_XSELL . " where products_id = '" . (int)$product_id . "' or xsell_id = '" . (int)$product_id . "'");
    xos_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where products_id = '" . (int)$product_id . "' or products_id like '" . (int)$product_id . "-%'");   

    $products_attributes_id_query = xos_db_query("select products_attributes_id from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$product_id . "'");
    while ($products_attributes_id = xos_db_fetch_array($products_attributes_id_query)) {
      xos_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . (int)$products_attributes_id['products_attributes_id'] . "'");
    }

    xos_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$product_id . "'");

    $product_reviews_query = xos_db_query("select reviews_id from " . TABLE_REVIEWS . " where products_id = '" . (int)$product_id . "'");
    while ($product_reviews = xos_db_fetch_array($product_reviews_query)) {
      xos_db_query("delete from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$product_reviews['reviews_id'] . "'");
    }
    
    xos_db_query("delete from " . TABLE_REVIEWS . " where products_id = '" . (int)$product_id . "'");
  }

  function xos_remove_order($order_id, $restock = false, $orders_status_code = '') {
    global $messageStack;
    
    $order_query = xos_db_query("select products_id, products_model, products_name, products_attributes_sting, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$order_id . "'");                
    while ($order = xos_db_fetch_array($order_query)) {
      $error = false;
      if ($restock == 'on') {      
        $stock_query = xos_db_query("select products_quantity, attributes_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$order['products_id'] . "'");
        $stock_values = xos_db_fetch_array($stock_query);              
        if (xos_not_null($order['products_attributes_sting'])) { 
          $attributes_quantity = xos_get_attributes_quantity($stock_values['attributes_quantity']);                  
          if (xos_not_null($attributes_quantity[$order['products_attributes_sting']])) {                     
            $stock_new = $attributes_quantity[$order['products_attributes_sting']] + $order['products_quantity'];             
            if ($attributes_quantity[$order['products_attributes_sting']] >= 0) {          
              $stock_values['products_quantity'] = $stock_values['products_quantity'] + $order['products_quantity'];          
            } else {
              $stock_values['products_quantity'] = $stock_values['products_quantity'] + max(0, $stock_new) ;
            }            
            $attributes_quantity[$order['products_attributes_sting']] = $stock_new;        
            xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$stock_values['products_quantity'] . "', products_last_modified = now(), attributes_quantity = '" . xos_db_input(serialize($attributes_quantity)) . "' where products_id = '" . (int)$order['products_id'] . "'");                                             
          } else {
            $error = true;
            $messageStack->add_session('header', sprintf(COULD_NOT_RESTOCK_PRODUCT_QUANTITY, $order['products_model'], $order['products_name']), 'error');
          }                  
        } else {
          if (xos_not_null($stock_values['attributes_quantity'])) {
            $error = true;
            $messageStack->add_session('header', sprintf(COULD_NOT_RESTOCK_PRODUCT_QUANTITY, $order['products_model'], $order['products_name']), 'error'); 
          } else {
            xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity + " . $order['products_quantity'] . ", products_last_modified = now() where products_id = '" . (int)$order['products_id'] . "'");              
          }                     
        }
      }
      // Update products_ordered (for bestsellers list)
      if (!$error && $orders_status_code != 'paypal_st') {
        xos_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered - " . $order['products_quantity'] . " where products_id = '" . (int)$order['products_id'] . "'");
      }
    }
    
    xos_db_query("delete from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
    xos_db_query("delete from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$order_id . "'");
    xos_db_query("delete from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . (int)$order_id . "'");
    xos_db_query("delete from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . (int)$order_id . "'");
    xos_db_query("delete from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order_id . "'");
    xos_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_DOWNLOAD . ' where orders_id = "' . (int)$order_id . '"');
  }

  function xos_get_file_permissions($mode) {
// determine type
    if ( ($mode & 0xC000) == 0xC000) { // unix domain socket
      $type = 's';
    } elseif ( ($mode & 0x4000) == 0x4000) { // directory
      $type = 'd';
    } elseif ( ($mode & 0xA000) == 0xA000) { // symbolic link
      $type = 'l';
    } elseif ( ($mode & 0x8000) == 0x8000) { // regular file
      $type = '-';
    } elseif ( ($mode & 0x6000) == 0x6000) { //bBlock special file
      $type = 'b';
    } elseif ( ($mode & 0x2000) == 0x2000) { // character special file
      $type = 'c';
    } elseif ( ($mode & 0x1000) == 0x1000) { // named pipe
      $type = 'p';
    } else { // unknown
      $type = '?';
    }

// determine permissions
    $owner['read']    = ($mode & 00400) ? 'r' : '-';
    $owner['write']   = ($mode & 00200) ? 'w' : '-';
    $owner['execute'] = ($mode & 00100) ? 'x' : '-';
    $group['read']    = ($mode & 00040) ? 'r' : '-';
    $group['write']   = ($mode & 00020) ? 'w' : '-';
    $group['execute'] = ($mode & 00010) ? 'x' : '-';
    $world['read']    = ($mode & 00004) ? 'r' : '-';
    $world['write']   = ($mode & 00002) ? 'w' : '-';
    $world['execute'] = ($mode & 00001) ? 'x' : '-';

// adjust for SUID, SGID and sticky bit
    if ($mode & 0x800 ) $owner['execute'] = ($owner['execute'] == 'x') ? 's' : 'S';
    if ($mode & 0x400 ) $group['execute'] = ($group['execute'] == 'x') ? 's' : 'S';
    if ($mode & 0x200 ) $world['execute'] = ($world['execute'] == 'x') ? 't' : 'T';

    return $type .
           $owner['read'] . $owner['write'] . $owner['execute'] .
           $group['read'] . $group['write'] . $group['execute'] .
           $world['read'] . $world['write'] . $world['execute'];
  }

  function xos_remove($source) {
    global $messageStack, $xos_remove_error;

    if (isset($xos_remove_error)) $xos_remove_error = false;

    if (is_dir($source)) {
      $dir = dir($source);
      while ($file = $dir->read()) {
        if ( ($file != '.') && ($file != '..') ) {
          if (is_writable($source . '/' . $file)) {
            xos_remove($source . '/' . $file);
          } else {
            $messageStack->add('header', sprintf(ERROR_FILE_NOT_REMOVEABLE, $source . '/' . $file), 'error');
            $xos_remove_error = true;
          }
        }
      }
      $dir->close();

      if (is_writable($source)) {
        rmdir($source);
      } else {
        $messageStack->add('header', sprintf(ERROR_DIRECTORY_NOT_REMOVEABLE, $source), 'error');
        $xos_remove_error = true;
      }
    } else {
      if (is_writable($source)) {
        unlink($source);
      } else {
        $messageStack->add('header', sprintf(ERROR_FILE_NOT_REMOVEABLE, $source), 'error');
        $xos_remove_error = true;
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

  function xos_get_tax_class_title($tax_class_id) {
    if ($tax_class_id == '0') {
      return TEXT_NONE;
    } else {
      $classes_query = xos_db_query("select tax_class_title from " . TABLE_TAX_CLASS . " where tax_class_id = '" . (int)$tax_class_id . "'");
      $classes = xos_db_fetch_array($classes_query);

      return $classes['tax_class_title'];
    }
  }

  function xos_banner_image_extension() {
    if (function_exists('imagetypes')) {
      if (imagetypes() & IMG_PNG) {
        return 'png';
      } elseif (imagetypes() & IMG_JPG) {
        return 'jpg';
      } elseif (imagetypes() & IMG_GIF) {
        return 'gif';
      }
    } elseif (function_exists('imagecreatefrompng') && function_exists('imagepng')) {
      return 'png';
    } elseif (function_exists('imagecreatefromjpeg') && function_exists('imagejpeg')) {
      return 'jpg';
    } elseif (function_exists('imagecreatefromgif') && function_exists('imagegif')) {
      return 'gif';
    }

    return false;
  }

  function xos_call_function($function, $parameter, $object = '') {
    if ($object == '') {
      return call_user_func($function, $parameter);
    } else {
      return call_user_func(array($object, $function), $parameter);
    }
  }

  function xos_get_zone_class_title($zone_class_id) {
    if ($zone_class_id == '0') {
      return TEXT_NONE;
    } else {
      $classes_query = xos_db_query("select geo_zone_name from " . TABLE_GEO_ZONES . " where geo_zone_id = '" . (int)$zone_class_id . "'");
      $classes = xos_db_fetch_array($classes_query);

      return $classes['geo_zone_name'];
    }
  }

  function xos_cfg_pull_down_zone_classes($zone_class_id, $key = '') {
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $zone_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $zone_class_query = xos_db_query("select geo_zone_id, geo_zone_name from " . TABLE_GEO_ZONES . " order by geo_zone_name");
    while ($zone_class = xos_db_fetch_array($zone_class_query)) {
      $zone_class_array[] = array('id' => $zone_class['geo_zone_id'],
                                  'text' => $zone_class['geo_zone_name']);
    }

    return xos_draw_pull_down_menu($name, $zone_class_array, $zone_class_id);
  }

  function xos_cfg_pull_down_order_statuses($order_status_id, $key = '') {

    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $statuses_array = array(array('id' => '0', 'text' => TEXT_DEFAULT));
    $statuses_query = xos_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_code = '' and language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by orders_status_name");
    while ($statuses = xos_db_fetch_array($statuses_query)) {
      $statuses_array[] = array('id' => $statuses['orders_status_id'],
                                'text' => $statuses['orders_status_name']);
    }

    return xos_draw_pull_down_menu($name, $statuses_array, $order_status_id);
  }

  function xos_get_order_status_name($order_status_id, $language_id = '') {

    if ($order_status_id < 1) return TEXT_DEFAULT;

    if ($language_id == '') $language_id = $_SESSION['used_lng_id'];

    $status_query = xos_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . (int)$order_status_id . "' and language_id = '" . (int)$language_id . "'");
    $status = xos_db_fetch_array($status_query);

    return $status['orders_status_name'];
  }

////
// Return a random value
  function xos_rand($min = null, $max = null) {
    static $seeded;

    if (!$seeded) {
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

// nl2br() prior PHP 4.2.0 did not convert linefeeds on all OSs (it only converted \n)
  function xos_convert_linefeeds($from, $to, $string) {
      return str_replace($from, $to, $string);
  }

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
// Return unserialize attributes_not_updated_array  
  function xos_get_attributes_not_updated(&$serialize_attributes_not_updated_array) {   
    $attributes_not_updated_array = unserialize($serialize_attributes_not_updated_array);
    if (!is_array($attributes_not_updated_array)) $attributes_not_updated_array = array();
    return $attributes_not_updated_array;  
  }      
/*  
  function xos_update_table_tax_rates_final() {
  
    $tax_class_ids_query = xos_db_query("select distinct tax_class_id from " . TABLE_TAX_RATES . " order by tax_class_id");
    xos_db_query("delete from " . TABLE_TAX_RATES_FINAL);
    $tax_rates_final_id = 1;  
    while ($tax_class_ids = xos_db_fetch_array($tax_class_ids_query)) {
  
      $tax_zone_ids_query = xos_db_query("select distinct tax_zone_id from " . TABLE_TAX_RATES . " order by tax_zone_id");
      while ($tax_zone_ids = xos_db_fetch_array($tax_zone_ids_query)) {
    
        $tax_rates_query = xos_db_query("select tax_class_id, tax_zone_id, tax_priority, sum(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " where tax_class_id = '" .$tax_class_ids[tax_class_id] . "' and tax_zone_id = '" . $tax_zone_ids[tax_zone_id] ."' group by tax_priority");
        if (xos_db_num_rows($tax_rates_query)) {        
          $tax_multiplier = 1.0;
          while ($tax_rates = xos_db_fetch_array($tax_rates_query)) {       
            $tax_multiplier *= 1.0 + ($tax_rates['tax_rate'] / 100); 
            $tax_zone_id = $tax_rates[tax_zone_id]; 
            $tax_class_id = $tax_rates[tax_class_id];                   
          }      
          xos_db_query("insert into " . TABLE_TAX_RATES_FINAL . " (tax_rates_final_id, tax_zone_id, tax_class_id, tax_rate_final) values ('" . (int)$tax_rates_final_id . "', '" . (int)$tax_zone_id . "', '" . (int)$tax_class_id . "', '" . ($tax_multiplier - 1.0) * 100 . "')");
          $tax_rates_final_id++;
        }
      }     
    }
  }
*/
  function xos_update_table_tax_rates_final() {
    
    $tax_query = xos_db_query("select tax_class_id, tax_zone_id, tax_priority, sum(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " group by tax_priority, tax_zone_id, tax_class_id  order by tax_class_id, tax_zone_id");
    xos_db_query("delete from " . TABLE_TAX_RATES_FINAL);        
    if (xos_db_num_rows($tax_query)) {    
      $tax_rates_final_id = 1;
      $tax_multiplier = 1.0;
      $tax_class_id = '';
      $tax_zone_id = '';
      while ($tax = xos_db_fetch_array($tax_query)) {      
        if (($tax_class_id != $tax[tax_class_id]) || ($tax_zone_id != $tax[tax_zone_id])) {         
          if ($tax_class_id != '') {
            xos_db_query("insert into " . TABLE_TAX_RATES_FINAL . " (tax_rates_final_id, tax_zone_id, tax_class_id, tax_rate_final) values ('" . (int)$tax_rates_final_id . "', '" . (int)$tax_zone_id . "', '" . (int)$tax_class_id . "', '" . ($tax_multiplier - 1.0) * 100 . "')");
            $tax_rates_final_id++;          
          }                
          $tax_multiplier = 1.0;
        }        
        $tax_multiplier *= 1.0 + ($tax['tax_rate'] / 100);      
        $tax_class_id = $tax[tax_class_id];
        $tax_zone_id = $tax[tax_zone_id];
      }
      xos_db_query("insert into " . TABLE_TAX_RATES_FINAL . " (tax_rates_final_id, tax_zone_id, tax_class_id, tax_rate_final) values ('" . (int)$tax_rates_final_id . "', '" . (int)$tax_zone_id . "', '" . (int)$tax_class_id . "', '" . ($tax_multiplier - 1.0) * 100 . "')");
    }
  }
  
  function xos_get_tax_rates_description($tax_rates_id, $language_id) {
    $tax_rates_description_query = xos_db_query("select tax_description from " . TABLE_TAX_RATES_DESCRIPTION . " where tax_rates_id = '" . (int)$tax_rates_id . "' and language_id = '" . (int)$language_id . "'");
    $tax_rates_description = xos_db_fetch_array($tax_rates_description_query);

    return $tax_rates_description['tax_description'];
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
  
  function xos_get_registered_tpls_list($registered_tpls_string) {
    return str_replace(',', '<br />', $registered_tpls_string);
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
?>
