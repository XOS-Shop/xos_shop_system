<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : languages.php
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
//              filename: languages.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_LANGUAGES) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert':
        $use_in_id = xos_db_prepare_input($_POST['use_in_id']);
        $name = xos_db_prepare_input($_POST['name']);
        $code = xos_db_prepare_input(substr($_POST['code'], 0, 2));
        $image = xos_db_prepare_input($_POST['image']);
        $directory = xos_db_prepare_input($_POST['directory']);
        $sort_order = (int)xos_db_prepare_input($_POST['sort_order']);

        xos_db_query("insert into " . TABLE_LANGUAGES . " (use_in_id, display_in_catalog, name, code, image, directory, sort_order) values ('" . xos_db_input($use_in_id) . "', " . (($_POST['display_in_catalog'] == '1') ? "'1', " : "'0', ") .  "'" . xos_db_input($name) . "', '" . xos_db_input($code) . "', '" . xos_db_input($image) . "', '" . xos_db_input($directory) . "', '" . xos_db_input($sort_order) . "')");
        $insert_id = xos_db_insert_id();
        
        if ($use_in_id > '1') {
          $default_language_id_query = xos_db_query("select languages_id from " . TABLE_LANGUAGES . "  where code = '" . DEFAULT_LANGUAGE . "'");
          $default_language_id = xos_db_fetch_array($default_language_id_query);

// create additional banners_content records
          $banners_content_query = xos_db_query("select b.banners_id, bc.banners_title, bc.banners_url, bc.banners_image, bc.banners_html_text from " . TABLE_BANNERS . " b left join " . TABLE_BANNERS_CONTENT . " bc on b.banners_id = bc.banners_id where bc.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($banners_content = xos_db_fetch_array($banners_content_query)) {
            xos_db_query("insert into " . TABLE_BANNERS_CONTENT . " (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('" . (int)$banners_content['banners_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($banners_content['banners_title']) . "', '" . xos_db_input($banners_content['banners_url']) . "', '" . xos_db_input($banners_content['banners_image']) . "', '" . xos_db_input($banners_content['banners_html_text']) . "')");
          }  
        
// create additional categories_or_pages_content records
          $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, cpd.categories_or_pages_heading_title, cpd.categories_or_pages_content from " . TABLE_CATEGORIES_OR_PAGES . " c left join " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd on c.categories_or_pages_id = cpd.categories_or_pages_id where cpd.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($categories = xos_db_fetch_array($categories_query)) {
            xos_db_query("insert into " . TABLE_CATEGORIES_OR_PAGES_DATA . " (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('" . (int)$categories['categories_or_pages_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($categories['categories_or_pages_name']) . "', '" . xos_db_input($categories['categories_or_pages_heading_title']) . "', '" . xos_db_input($categories['categories_or_pages_content']) . "')");
          }
        
// create additional contents_data records
          $content_query = xos_db_query("select c.content_id, cd.name, cd.heading_title, cd.content from " . TABLE_CONTENTS . " c left join " . TABLE_CONTENTS_DATA . " cd on c.content_id = cd.content_id where cd.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($content = xos_db_fetch_array($content_query)) {
            xos_db_query("insert into " . TABLE_CONTENTS_DATA . " (content_id, language_id, name, heading_title, content) values ('" . (int)$content['content_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($content['name']) . "', '" . xos_db_input($content['heading_title']) . "', '" . xos_db_input($content['content']) . "')");
          }        

// create additional products_description records
          $products_query = xos_db_query("select p.products_id, pd.products_name, pd.products_p_unit, pd.products_info, pd.products_description, pd.products_url from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where pd.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($products = xos_db_fetch_array($products_query)) {
            xos_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_p_unit, products_info, products_description, products_url) values ('" . (int)$products['products_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($products['products_name']) . "', '" . xos_db_input($products['products_p_unit']) . "', '" . xos_db_input($products['products_info']) . "', '" . xos_db_input($products['products_description']) . "', '" . xos_db_input($products['products_url']) . "')");
          }

// create additional products_options records
          $products_options_query = xos_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($products_options = xos_db_fetch_array($products_options_query)) {
            xos_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, language_id, products_options_name) values ('" . (int)$products_options['products_options_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($products_options['products_options_name']) . "')");
          }

// create additional products_options_values records
          $products_options_values_query = xos_db_query("select products_options_values_id, products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($products_options_values = xos_db_fetch_array($products_options_values_query)) {
            xos_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name) values ('" . (int)$products_options_values['products_options_values_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($products_options_values['products_options_values_name']) . "')");
          }

// create additional manufacturers_info records
          $manufacturers_query = xos_db_query("select m.manufacturers_id, mi.manufacturers_name, mi.manufacturers_url from " . TABLE_MANUFACTURERS . " m left join " . TABLE_MANUFACTURERS_INFO . " mi on m.manufacturers_id = mi.manufacturers_id where mi.languages_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($manufacturers = xos_db_fetch_array($manufacturers_query)) {
            xos_db_query("insert into " . TABLE_MANUFACTURERS_INFO . " (manufacturers_id, languages_id, manufacturers_name, manufacturers_url) values ('" . $manufacturers['manufacturers_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($manufacturers['manufacturers_name']) . "', '" . xos_db_input($manufacturers['manufacturers_url']) . "')");
          }

// create additional orders_status records
          $orders_status_query = xos_db_query("select orders_status_id, orders_status_name, orders_status_code, public_flag, downloads_flag from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($orders_status = xos_db_fetch_array($orders_status_query)) {
            xos_db_query("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('" . (int)$orders_status['orders_status_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($orders_status['orders_status_name']) . "', '" . xos_db_input($orders_status['orders_status_code']) . "', '" . (int)$orders_status['public_flag'] . "', '" . (int)$orders_status['downloads_flag'] . "')");
          }
        
// create additional tax_rates_description records
          $tax_rates_query = xos_db_query("select tr.tax_rates_id, trd.tax_description from " . TABLE_TAX_RATES . " tr left join " . TABLE_TAX_RATES_DESCRIPTION . " trd on tr.tax_rates_id = trd.tax_rates_id where trd.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($tax_rates = xos_db_fetch_array($tax_rates_query)) {
            xos_db_query("insert into " . TABLE_TAX_RATES_DESCRIPTION . " (tax_rates_id, language_id, tax_description) values ('" . (int)$tax_rates['tax_rates_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($tax_rates['tax_description']) . "')");
          }
          
// create additional currencies records
          $currencies_query = xos_db_query("select currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated from " . TABLE_CURRENCIES . " where language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($currencies = xos_db_fetch_array($currencies_query)) {
            xos_db_query("insert into " . TABLE_CURRENCIES . " (currencies_id, language_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('" . (int)$currencies['currencies_id'] . "', '" . (int)$insert_id . "', '" . xos_db_input($currencies['title']) . "', '" . xos_db_input($currencies['code']) . "', '" . xos_db_input($currencies['symbol_left']) . "', '" . xos_db_input($currencies['symbol_right']) . "', '" . xos_db_input($currencies['decimal_point']) . "', '" . xos_db_input($currencies['thousands_point']) . "', '" . (int)$currencies['decimal_places'] . "', '" . xos_db_input($currencies['value']) . "', '" . xos_db_input($currencies['last_updated']) . "')");
          }                    
        }

        $smarty_cache_control->clearAllCache();

        xos_redirect(xos_href_link(FILENAME_LANGUAGES, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'lID=' . $insert_id));
        break;
      case 'save':
        $lID = xos_db_prepare_input($_GET['lID']);
        $use_in_id = xos_db_prepare_input($_POST['use_in_id']);
        $actual_use_in_id = xos_db_prepare_input($_POST['actual_use_in_id']);
        $name = xos_db_prepare_input($_POST['name']);
        $code = xos_db_prepare_input(substr($_POST['code'], 0, 2));
        $image = xos_db_prepare_input($_POST['image']);
        $directory = xos_db_prepare_input($_POST['directory']);
        $sort_order = (int)xos_db_prepare_input($_POST['sort_order']);

        xos_db_query("update " . TABLE_LANGUAGES . " set" . (($_POST['default'] != 'on') ? " use_in_id = '" . xos_db_input($use_in_id) . "'," : "") . (($_POST['display_in_catalog'] == '1') || ($_POST['default'] == 'on') ? " display_in_catalog = '1'," : " display_in_catalog = '0',") . " name = '" . xos_db_input($name) . "', code = '" . xos_db_input($code) . "', image = '" . xos_db_input($image) . "', directory = '" . xos_db_input($directory) . "', sort_order = '" . xos_db_input($sort_order) . "' where languages_id = '" . (int)$lID . "'");

        if ($_POST['default'] == 'on') {
          xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . xos_db_input($code) . "' where configuration_key = 'DEFAULT_LANGUAGE'");
        } else {
          $default_language_id_query = xos_db_query("select languages_id from " . TABLE_LANGUAGES . "  where code = '" . DEFAULT_LANGUAGE . "'");
          $default_language_id = xos_db_fetch_array($default_language_id_query);        
        }
        
        if ($_POST['default'] != 'on' && $use_in_id == '1' && $use_in_id != $actual_use_in_id) {
          xos_db_query("delete from " . TABLE_BANNERS_CONTENT . " where language_id = '" . (int)$lID . "'");
          xos_db_query("delete from " . TABLE_CATEGORIES_OR_PAGES_DATA . " where language_id = '" . (int)$lID . "'");
          xos_db_query("delete from " . TABLE_CONTENTS_DATA . " where language_id = '" . (int)$lID . "'");
          xos_db_query("delete from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = '" . (int)$lID . "'");
          xos_db_query("delete from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$lID . "'");
          xos_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . (int)$lID . "'");
          xos_db_query("delete from " . TABLE_MANUFACTURERS_INFO . " where languages_id = '" . (int)$lID . "'");
          xos_db_query("delete from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$lID . "'");
          xos_db_query("delete from " . TABLE_TAX_RATES_DESCRIPTION . " where language_id = '" . (int)$lID . "'");
          xos_db_query("delete from " . TABLE_CURRENCIES . " where language_id = '" . (int)$lID . "'");
          
          xos_db_query("update " . TABLE_CUSTOMERS . " set customers_language_id = '" . (int)$default_language_id['languages_id'] . "' where customers_language_id = '" . (int)$lID . "'");
          xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set subscriber_language_id = '" . (int)$default_language_id['languages_id'] . "' where subscriber_language_id = '" . (int)$lID . "'");
        } elseif ($_POST['default'] != 'on' && $actual_use_in_id == '1' && $use_in_id != $actual_use_in_id) {

// create additional banners_content records
          $banners_content_query = xos_db_query("select b.banners_id, bc.banners_title, bc.banners_url, bc.banners_image, bc.banners_html_text from " . TABLE_BANNERS . " b left join " . TABLE_BANNERS_CONTENT . " bc on b.banners_id = bc.banners_id where bc.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($banners_content = xos_db_fetch_array($banners_content_query)) {
            xos_db_query("insert into " . TABLE_BANNERS_CONTENT . " (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('" . (int)$banners_content['banners_id'] . "', '" . (int)$lID . "', '" . xos_db_input($banners_content['banners_title']) . "', '" . xos_db_input($banners_content['banners_url']) . "', '" . xos_db_input($banners_content['banners_image']) . "', '" . xos_db_input($banners_content['banners_html_text']) . "')");
          } 
                  
// create additional categories_or_pages_content records
          $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, cpd.categories_or_pages_heading_title, cpd.categories_or_pages_content from " . TABLE_CATEGORIES_OR_PAGES . " c left join " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd on c.categories_or_pages_id = cpd.categories_or_pages_id where cpd.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($categories = xos_db_fetch_array($categories_query)) {
            xos_db_query("insert into " . TABLE_CATEGORIES_OR_PAGES_DATA . " (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('" . (int)$categories['categories_or_pages_id'] . "', '" . (int)$lID . "', '" . xos_db_input($categories['categories_or_pages_name']) . "', '" . xos_db_input($categories['categories_or_pages_heading_title']) . "', '" . xos_db_input($categories['categories_or_pages_content']) . "')");
          }
        
// create additional contents_data records
          $content_query = xos_db_query("select c.content_id, cd.name, cd.heading_title, cd.content from " . TABLE_CONTENTS . " c left join " . TABLE_CONTENTS_DATA . " cd on c.content_id = cd.content_id where cd.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($content = xos_db_fetch_array($content_query)) {
            xos_db_query("insert into " . TABLE_CONTENTS_DATA . " (content_id, language_id, name, heading_title, content) values ('" . (int)$content['content_id'] . "', '" . (int)$lID . "', '" . xos_db_input($content['name']) . "', '" . xos_db_input($content['heading_title']) . "', '" . xos_db_input($content['content']) . "')");
          }        

// create additional products_description records
          $products_query = xos_db_query("select p.products_id, pd.products_name, pd.products_p_unit, pd.products_info, pd.products_description, pd.products_url from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where pd.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($products = xos_db_fetch_array($products_query)) {
            xos_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_p_unit, products_info, products_description, products_url) values ('" . (int)$products['products_id'] . "', '" . (int)$lID . "', '" . xos_db_input($products['products_name']) . "', '" . xos_db_input($products['products_p_unit']) . "', '" . xos_db_input($products['products_info']) . "', '" . xos_db_input($products['products_description']) . "', '" . xos_db_input($products['products_url']) . "')");
          }

// create additional products_options records
          $products_options_query = xos_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($products_options = xos_db_fetch_array($products_options_query)) {
            xos_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, language_id, products_options_name) values ('" . (int)$products_options['products_options_id'] . "', '" . (int)$lID . "', '" . xos_db_input($products_options['products_options_name']) . "')");
          }

// create additional products_options_values records
          $products_options_values_query = xos_db_query("select products_options_values_id, products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($products_options_values = xos_db_fetch_array($products_options_values_query)) {
            xos_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name) values ('" . (int)$products_options_values['products_options_values_id'] . "', '" . (int)$lID . "', '" . xos_db_input($products_options_values['products_options_values_name']) . "')");
          }

// create additional manufacturers_info records
          $manufacturers_query = xos_db_query("select m.manufacturers_id, mi.manufacturers_name, mi.manufacturers_url from " . TABLE_MANUFACTURERS . " m left join " . TABLE_MANUFACTURERS_INFO . " mi on m.manufacturers_id = mi.manufacturers_id where mi.languages_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($manufacturers = xos_db_fetch_array($manufacturers_query)) {
            xos_db_query("insert into " . TABLE_MANUFACTURERS_INFO . " (manufacturers_id, languages_id, manufacturers_name, manufacturers_url) values ('" . $manufacturers['manufacturers_id'] . "', '" . (int)$lID . "', '" . xos_db_input($manufacturers['manufacturers_name']) . "', '" . xos_db_input($manufacturers['manufacturers_url']) . "')");
          }

// create additional orders_status records
          $orders_status_query = xos_db_query("select orders_status_id, orders_status_name, orders_status_code, public_flag, downloads_flag from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($orders_status = xos_db_fetch_array($orders_status_query)) {
            xos_db_query("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('" . (int)$orders_status['orders_status_id'] . "', '" . (int)$lID . "', '" . xos_db_input($orders_status['orders_status_name']) . "', '" . xos_db_input($orders_status['orders_status_code']) . "', '" . (int)$orders_status['public_flag'] . "', '" . (int)$orders_status['downloads_flag'] . "')");
          }
        
// create additional tax_rates_description records
          $tax_rates_query = xos_db_query("select tr.tax_rates_id, trd.tax_description from " . TABLE_TAX_RATES . " tr left join " . TABLE_TAX_RATES_DESCRIPTION . " trd on tr.tax_rates_id = trd.tax_rates_id where trd.language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($tax_rates = xos_db_fetch_array($tax_rates_query)) {
            xos_db_query("insert into " . TABLE_TAX_RATES_DESCRIPTION . " (tax_rates_id, language_id, tax_description) values ('" . (int)$tax_rates['tax_rates_id'] . "', '" . (int)$lID . "', '" . xos_db_input($tax_rates['tax_description']) . "')");
          }
          
// create additional currencies records
          $currencies_query = xos_db_query("select currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated from " . TABLE_CURRENCIES . " where language_id = '" . (int)$default_language_id['languages_id'] . "'");
          while ($currencies = xos_db_fetch_array($currencies_query)) {
            xos_db_query("insert into " . TABLE_CURRENCIES . " (currencies_id, language_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('" . (int)$currencies['currencies_id'] . "', '" . (int)$lID . "', '" . xos_db_input($currencies['title']) . "', '" . xos_db_input($currencies['code']) . "', '" . xos_db_input($currencies['symbol_left']) . "', '" . xos_db_input($currencies['symbol_right']) . "', '" . xos_db_input($currencies['decimal_point']) . "', '" . xos_db_input($currencies['thousands_point']) . "', '" . (int)$currencies['decimal_places'] . "', '" . xos_db_input($currencies['value']) . "', '" . xos_db_input($currencies['last_updated']) . "')");
          }                    
        }        
        
        if ($_SESSION['languages_id'] == (int)$lID && $use_in_id < '3') unset($_SESSION['language']);
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $_GET['lID']));
        break;
      case 'deleteconfirm':
        $lID = xos_db_prepare_input($_GET['lID']);
        
        xos_db_query("delete from " . TABLE_BANNERS_CONTENT . " where language_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_CATEGORIES_OR_PAGES_DATA . " where language_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_CONTENTS_DATA . " where language_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_MANUFACTURERS_INFO . " where languages_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_LANGUAGES . " where languages_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_TAX_RATES_DESCRIPTION . " where language_id = '" . (int)$lID . "'");
        xos_db_query("delete from " . TABLE_CURRENCIES . " where language_id = '" . (int)$lID . "'");
        
        $default_language_id_query = xos_db_query("select languages_id from " . TABLE_LANGUAGES . "  where code = '" . DEFAULT_LANGUAGE . "'");
        $default_language_id = xos_db_fetch_array($default_language_id_query);
                 
        xos_db_query("update " . TABLE_CUSTOMERS . " set customers_language_id = '" . (int)$default_language_id['languages_id'] . "' where customers_language_id = '" . (int)$lID . "'");
        xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set subscriber_language_id = '" . (int)$default_language_id['languages_id'] . "' where subscriber_language_id = '" . (int)$lID . "'");        
        
        if ($_SESSION['languages_id'] == (int)$lID) unset($_SESSION['language']);
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page']));
        break;
      case 'delete':
        $lID = xos_db_prepare_input($_GET['lID']);

        $lng_query = xos_db_query("select code from " . TABLE_LANGUAGES . " where languages_id = '" . (int)$lID . "'");
        $lng = xos_db_fetch_array($lng_query);

        $remove_language = true;
        if ($lng['code'] == DEFAULT_LANGUAGE) {
          $remove_language = false;
          $messageStack->add('header', ERROR_REMOVE_DEFAULT_LANGUAGE, 'error');
        }
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');    

  $languages_query_raw = "select languages_id, use_in_id, display_in_catalog, name, code, image, directory, sort_order from " . TABLE_LANGUAGES . " order by sort_order";
  $languages_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $languages_query_raw, $languages_query_numrows);
  $languages_query = xos_db_query($languages_query_raw);

  $languages_array = array();
  while ($languages = xos_db_fetch_array($languages_query)) {
    if ((!isset($_GET['lID']) || (isset($_GET['lID']) && ($_GET['lID'] == $languages['languages_id']))) && !isset($lInfo) && (substr($action, 0, 3) != 'new')) {
      $lInfo = new objectInfo($languages);
    }
    
    $selected = false;

    if (isset($lInfo) && is_object($lInfo) && ($languages['languages_id'] == $lInfo->languages_id) ) {
      $selected = true;
      $link_filename_languages = xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=edit');
    } else {
      $link_filename_languages = xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $languages['languages_id']);
    }

    $default_language = false;

    if (DEFAULT_LANGUAGE == $languages['code']) {
      $default_language = true;
    }

    $languages_array[]=array('selected' => $selected,
                             'default_language' => $default_language,
                             'link_filename_languages' => $link_filename_languages,
                             'name' => $languages['name'],
                             'code' => $languages['code']);
  }
  
//  if (!isset($lInfo->use_in_id)) $lInfo->use_in_id = '3';
  switch ($lInfo->use_in_id) {
    case '1': $use_in_admin = true; $use_in_catalog = false; $use_in_both = false; $lang_info = TEXT_INFO_ADMIN; break;
    case '2': $use_in_admin = false; $use_in_catalog = true; $use_in_both = false; $lang_info = TEXT_INFO_CATALOG; break;
    case '3': $lang_info = TEXT_INFO_ADMIN_AND_CATALOG;
    default: $use_in_admin = false; $use_in_catalog = false; $use_in_both = true;
  }  

  if (empty($action)) {
    $smarty->assign('link_filename_languages_action_new', xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=new'));
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => (($action == 'edit') ? 'onload="SetFocus(); if (document.getElementsByName(\'use_in_id\')[0].checked == true) { document.getElementsByName(\'display_in_catalog\')[0].checked = false; document.getElementsByName(\'display_in_catalog\')[0].disabled = true; }"' : 'onload="SetFocus();"'),
                        'languages' => $languages_array,
                        'nav_bar_number' => $languages_split->display_count($languages_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_LANGUAGES),
                        'nav_bar_result' => $languages_split->display_links($languages_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));

  require(DIR_WS_BOXES . 'infobox_languages.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'languages');
  $output_languages = $smarty->fetch(ADMIN_TPL . '/languages.tpl');
  
  $smarty->assign('central_contents', $output_languages);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
