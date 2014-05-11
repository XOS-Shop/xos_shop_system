<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : countries.php
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
//              filename: countries.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_COUNTRIES) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert_from_list':
        $country_id = xos_db_prepare_input($_POST['country_id']);
        $address_format_id = xos_db_prepare_input($_POST['address_format_id']);
        $countries_list_query = xos_db_query("select * from " . TABLE_COUNTRIES_LIST . " where countries_id = '" . (int)$country_id . "'");
        $countries_list = xos_db_fetch_array($countries_list_query);       

        xos_db_query("insert into " . TABLE_COUNTRIES . " (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('" . (int)$countries_list['countries_id'] . "', '" . xos_db_input($countries_list['countries_name']) . "', '" . xos_db_input($countries_list['countries_iso_code_2']) . "', '" . xos_db_input($countries_list['countries_iso_code_3']) . "', '" . (int)$address_format_id . "')");
        xos_db_query("insert into " . TABLE_ZONES . " (zone_country_id, zone_code, zone_name) select zone_country_id, zone_code, zone_name from " . TABLE_ZONES_LIST . " where zone_country_id = '" . (int)$country_id . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $_POST['country_id']));
        break;    
      case 'insert':
        $countries_name = xos_db_prepare_input($_POST['countries_name']);
        $countries_iso_code_2 = xos_db_prepare_input($_POST['countries_iso_code_2']);
        $countries_iso_code_3 = xos_db_prepare_input($_POST['countries_iso_code_3']);
        $address_format_id = xos_db_prepare_input($_POST['address_format_id']);
        $check_query = xos_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_name = '" . xos_db_input($countries_name) . "'");
        if (xos_db_num_rows($check_query) || $countries_name == '') {
          xos_redirect(xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&countries_name=' . $countries_name . '&countries_iso_code_2=' . $countries_iso_code_2 . '&countries_iso_code_3=' . $countries_iso_code_3 . '&address_format_id=' . $address_format_id . '&action=new&error_name=' . $countries_name));
        }
                
        $new_country_id = LAST_COUNTRY_ID + 1;        
        xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . (int)$new_country_id . "', last_modified = now() where configuration_key = 'LAST_COUNTRY_ID'");
        xos_db_query("insert into " . TABLE_COUNTRIES . " (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('" . (int)$new_country_id . "', '" . xos_db_input($countries_name) . "', '" . xos_db_input($countries_iso_code_2) . "', '" . xos_db_input($countries_iso_code_3) . "', '" . (int)$address_format_id . "')");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $new_country_id));
        break;
      case 'save':
        $countries_id = xos_db_prepare_input($_GET['cID']);
        $countries_name = xos_db_prepare_input($_POST['countries_name']);
        $actual_countries_name = xos_db_prepare_input($_POST['actual_countries_name']);
        $countries_iso_code_2 = xos_db_prepare_input($_POST['countries_iso_code_2']);
        $countries_iso_code_3 = xos_db_prepare_input($_POST['countries_iso_code_3']);
        $address_format_id = xos_db_prepare_input($_POST['address_format_id']);
        if (mb_strtolower($actual_countries_name) != mb_strtolower($countries_name)) {        
          $check_query = xos_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_name = '" . xos_db_input($countries_name) . "'");
          if (xos_db_num_rows($check_query) || $countries_name == '') {
            xos_redirect(xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $_GET['cID'] . '&countries_name=' . $countries_name . '&countries_iso_code_2=' . $countries_iso_code_2 . '&countries_iso_code_3=' . $countries_iso_code_3 . '&address_format_id=' . $address_format_id . '&action=edit&error_name=' . $countries_name));
          }
        }        

        xos_db_query("update " . TABLE_COUNTRIES . " set countries_name = '" . xos_db_input($countries_name) . "', countries_iso_code_2 = '" . xos_db_input($countries_iso_code_2) . "', countries_iso_code_3 = '" . xos_db_input($countries_iso_code_3) . "', address_format_id = '" . (int)$address_format_id . "' where countries_id = '" . (int)$countries_id . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $_GET['cID']));
        break;
      case 'deleteconfirm':
        $countries_id = xos_db_prepare_input($_GET['cID']);

        xos_db_query("delete from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$countries_id . "'");
        xos_db_query("delete from " . TABLE_ZONES . " where zone_country_id = '" . (int)$countries_id . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page']));
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');     

  $countries_query_raw = "select countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id from " . TABLE_COUNTRIES . " order by countries_name";
  $countries_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $countries_query_raw, $countries_query_numrows);
  $countries_query = xos_db_query($countries_query_raw);
  $countries_array = array();
  while ($countries = xos_db_fetch_array($countries_query)) {
    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $countries['countries_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new') && (substr($action, 0, 13) != 'new_from_list')) {
      $cInfo = new objectInfo($countries);
    }
    
    $selected = false;

    if (isset($cInfo) && is_object($cInfo) && ($countries['countries_id'] == $cInfo->countries_id)) {
      $selected = true;
      $link_filename_countries = xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=edit');
    } else {
      $link_filename_countries = xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $countries['countries_id']);
    }

    $countries_array[]=array('selected' => $selected,
                             'link_filename_countries' => $link_filename_countries,
                             'name' => $countries['countries_name'],
                             'iso_code_2' => $countries['countries_iso_code_2'],
                             'iso_code_3' => $countries['countries_iso_code_3']);
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'countries' => $countries_array,
                        'nav_bar_number' => $countries_split->display_count($countries_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_COUNTRIES),
                        'nav_bar_result' => $countries_split->display_links($countries_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']))); 

  if (empty($action)) {
    $smarty->assign(array('link_filename_countries_action_new_from_list' => xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&action=new_from_list'),
                          'link_filename_countries_action_new' => xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&action=new')));
  }

  require(DIR_WS_BOXES . 'infobox_countries.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'countries');
  $output_countries = $smarty->fetch(ADMIN_TPL . '/countries.tpl');
  
  $smarty->assign('central_contents', $output_countries);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
