<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : currencies.php
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
//              filename: currencies.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_CURRENCIES) == 'overwrite_all')) :
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($_GET['cID'])) $currency_id = xos_db_prepare_input($_GET['cID']);
        $title_array = $_POST['title'];
        $symbol_left_array = $_POST['symbol_left'];
        $symbol_right_array = $_POST['symbol_right'];
        $decimal_point_array = $_POST['decimal_point'];
        $thousands_point_array = $_POST['thousands_point'];
        
        $code = xos_db_prepare_input($_POST['code']);        
        $decimal_places = xos_db_prepare_input($_POST['decimal_places']);
        $value = xos_db_prepare_input($_POST['value']);
        
        
        $languages = xos_get_languages();   
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {

          $language_id = $languages[$i]['id'];        

          $sql_data_array = array('title' => xos_db_prepare_input(htmlspecialchars($title_array[$language_id])),
                                  'code' => $code,
                                  'symbol_left' => xos_db_prepare_input(htmlspecialchars($symbol_left_array[$language_id])),
                                  'symbol_right' => xos_db_prepare_input(htmlspecialchars($symbol_right_array[$language_id])),
                                  'decimal_point' => xos_db_prepare_input($decimal_point_array[$language_id]),
                                  'thousands_point' => xos_db_prepare_input($thousands_point_array[$language_id]),
                                  'decimal_places' => $decimal_places,
                                  'value' => $value,
                                  'last_updated' => 'now()');

          if ($action == 'insert') {
          
            $insert_sql_data = array('currencies_id' => (int)$currency_id,
                                     'language_id' => (int)$language_id);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);          
          
            xos_db_perform(TABLE_CURRENCIES, $sql_data_array);
            $currency_id = xos_db_insert_id();  
            
          } elseif ($action == 'save') {
            xos_db_perform(TABLE_CURRENCIES, $sql_data_array, 'update', "currencies_id = '" . (int)$currency_id . "' and language_id = '" . (int)$language_id . "'");
          }
        }  

        if (isset($_POST['default']) && ($_POST['default'] == 'on')) {
          xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . xos_db_input($code) . "' where configuration_key = 'DEFAULT_CURRENCY'");
        }
        
        $smarty_cache_control->clearAllCache();

        xos_redirect(xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $currency_id));
        break;
      case 'deleteconfirm':
        $currencies_id = xos_db_prepare_input($_GET['cID']);

        $currency_query = xos_db_query("select currencies_id from " . TABLE_CURRENCIES . " where code = '" . DEFAULT_CURRENCY . "'");
        $currency = xos_db_fetch_array($currency_query);

        if ($currency['currencies_id'] == $currencies_id) {
          xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '' where configuration_key = 'DEFAULT_CURRENCY'");
        }

        xos_db_query("delete from " . TABLE_CURRENCIES . " where currencies_id = '" . (int)$currencies_id . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page']));
        break;
      case 'update':
        $server_used = CURRENCY_SERVER_PRIMARY;

        $currency_query = xos_db_query("select currencies_id, code, title from " . TABLE_CURRENCIES . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
        while ($currency = xos_db_fetch_array($currency_query)) {
          $quote_function = 'quote_' . CURRENCY_SERVER_PRIMARY . '_currency';
          $rate = $quote_function($currency['code']);

          if (empty($rate) && (xos_not_null(CURRENCY_SERVER_BACKUP))) {
            $messageStack->add_session('header', sprintf(WARNING_PRIMARY_SERVER_FAILED, CURRENCY_SERVER_PRIMARY, $currency['title'], $currency['code']), 'warning');

            $quote_function = 'quote_' . CURRENCY_SERVER_BACKUP . '_currency';
            $rate = $quote_function($currency['code']);

            $server_used = CURRENCY_SERVER_BACKUP;
          }

          if (xos_not_null($rate)) {
            xos_db_query("update " . TABLE_CURRENCIES . " set value = '" . $rate . "', last_updated = now() where currencies_id = '" . (int)$currency['currencies_id'] . "'");

            $messageStack->add_session('header', sprintf(TEXT_INFO_CURRENCY_UPDATED, $currency['title'], $currency['code'], $server_used), 'success');
          } else {
            $messageStack->add_session('header', sprintf(ERROR_CURRENCY_INVALID, $currency['title'], $currency['code'], $server_used), 'error');
          }
        }
        
        $smarty_cache_control->clearAllCache();

        xos_redirect(xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $_GET['cID']));
        break;
      case 'delete':
        $currencies_id = xos_db_prepare_input($_GET['cID']);

        $currency_query = xos_db_query("select code from " . TABLE_CURRENCIES . " where currencies_id = '" . (int)$currencies_id . "'");
        $currency = xos_db_fetch_array($currency_query);

        $remove_currency = true;
        if ($currency['code'] == DEFAULT_CURRENCY) {
          $remove_currency = false;
          $messageStack->add('header', ERROR_REMOVE_DEFAULT_CURRENCY, 'error');
        }
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');    

  $currency_query_raw = "select currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, last_updated, value from " . TABLE_CURRENCIES . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by title";
  $currency_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $currency_query_raw, $currency_query_numrows);
  $currency_query = xos_db_query($currency_query_raw);
  $currencies_array = array();
  while ($currency = xos_db_fetch_array($currency_query)) {
    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $currency['currencies_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
      $cInfo = new objectInfo($currency);
    }
    
    $selected = false;

    if (isset($cInfo) && is_object($cInfo) && ($currency['currencies_id'] == $cInfo->currencies_id) ) {
      $selected = true;
      $link_filename_currencies = xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id . '&action=edit');
    } else {
      $link_filename_currencies = xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $currency['currencies_id']);
    }
    
    $default_currency = false;

    if (DEFAULT_CURRENCY == $currency['code']) {
      $default_currency = true;
    }

    $currencies_array[]=array('selected' => $selected,
                              'link_filename_currencies' => $link_filename_currencies,
                              'title' => $currency['title'],
                              'code' => $currency['code'],
                              'value' => $currency['value'],
                              'default_currency' => $default_currency);
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'currencies' => $currencies_array,
                        'nav_bar_number' => $currency_split->display_count($currency_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CURRENCIES),
                        'nav_bar_result' => $currency_split->display_links($currency_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));

  if (empty($action)) {
     
    $smarty->assign('link_filename_currencies_action_new', xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id . '&action=new'));

    if (CURRENCY_SERVER_PRIMARY) {
      $smarty->assign('link_filename_currencies_action_update', xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id . '&action=update'));
    }
  }

  require(DIR_WS_BOXES . 'infobox_currencies.php');

 $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'currencies');
 $output_currencies = $smarty->fetch(ADMIN_TPL . '/currencies.tpl');
  
 $smarty->assign('central_contents', $output_currencies);
  
 $smarty->display(ADMIN_TPL . '/frame.tpl');

 require(DIR_WS_INCLUDES . 'application_bottom.php');
endif; 
?>
