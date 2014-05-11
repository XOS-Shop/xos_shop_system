<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : tax_rates.php
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
//              filename: tax_rates.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_TAX_RATES) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert':
        $tax_zone_id = xos_db_prepare_input($_POST['tax_zone_id']);
        $tax_class_id = xos_db_prepare_input($_POST['tax_class_id']);
        $tax_description = xos_db_prepare_input($_POST['tax_description']);
        $tax_rate = xos_db_prepare_input($_POST['tax_rate']);
        $tax_priority = xos_db_prepare_input($_POST['tax_priority']);
        $languages = xos_get_languages();
        $tax_description_error = array();
        $error_description = false;
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {     
          $check_query = xos_db_query("select tax_description from " . TABLE_TAX_RATES_DESCRIPTION . " where language_id = '" . (int)$languages[$i]['id'] . "' and tax_description = '" . xos_db_input(htmlspecialchars($tax_description[$languages[$i]['id']])) . "'"); 
          if (xos_db_num_rows($check_query) || $tax_description[$languages[$i]['id']] == '') {
            $error_description = true;
            $tax_description_error[$languages[$i]['id']] = $tax_description[$languages[$i]['id']];             
          }
        }        
        
        if ($error_description) {
          $tax_description_error_array = urlencode(serialize($tax_description_error));
          $tax_description_array = urlencode(serialize($tax_description));
          xos_redirect(xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $_GET['tID'] . '&tax_class_id=' . $tax_class_id . '&tax_description=' . $tax_description_array . '&tax_zone_id=' . $tax_zone_id . '&tax_rate=' . $tax_rate . '&tax_priority=' . $tax_priority . '&action=new&error_description=' . $tax_description_error_array));
        } else {
          xos_db_query("insert into " . TABLE_TAX_RATES . " (tax_zone_id, tax_class_id, tax_rate, tax_priority, date_added) values ('" . (int)$tax_zone_id . "', '" . (int)$tax_class_id . "', '" . xos_db_input($tax_rate) . "', '" . xos_db_input($tax_priority) . "', now())");
          $new_tax_rates_id = xos_db_insert_id();
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
            xos_db_query("insert into " . TABLE_TAX_RATES_DESCRIPTION . " (tax_rates_id, language_id, tax_description) values ('" . (int)$new_tax_rates_id . "', '" . (int)$languages[$i]['id'] . "', '" . xos_db_input(htmlspecialchars($tax_description[$languages[$i]['id']])) . "')");
          }          
          xos_update_table_tax_rates_final();
        
          $smarty_cache_control->clearAllCache();
        
          xos_redirect(xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $new_tax_rates_id));
        }
        break;
      case 'save':
        $tax_rates_id = xos_db_prepare_input($_GET['tID']);
        $tax_zone_id = xos_db_prepare_input($_POST['tax_zone_id']);
        $tax_class_id = xos_db_prepare_input($_POST['tax_class_id']);
        $tax_description = xos_db_prepare_input($_POST['tax_description']);
        $actual_tax_description = xos_db_prepare_input($_POST['actual_tax_description']);        
        $tax_rate = xos_db_prepare_input($_POST['tax_rate']);
        $tax_priority = xos_db_prepare_input($_POST['tax_priority']);
        $languages = xos_get_languages();
        $tax_description_error = array();
        $error_description = false;        
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {        
          if (mb_strtolower($actual_tax_description[$languages[$i]['id']], 'UTF-8') != mb_strtolower($tax_description[$languages[$i]['id']], 'UTF-8') || $tax_description[$languages[$i]['id']] == '') {
            $check_query = xos_db_query("select tax_description from " . TABLE_TAX_RATES_DESCRIPTION . " where language_id = '" . (int)$languages[$i]['id'] . "' and tax_description = '" . xos_db_input(htmlspecialchars($tax_description[$languages[$i]['id']])) . "'");
            if (xos_db_num_rows($check_query) || $tax_description[$languages[$i]['id']] == '') {
              $error_description = true;
              $tax_description_error[$languages[$i]['id']] = $tax_description[$languages[$i]['id']];
            }
          }
        }    
        
        if ($error_description) {
          $tax_description_error_array = urlencode(serialize($tax_description_error));
          $tax_description_array = urlencode(serialize($tax_description));
          xos_redirect(xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $_GET['tID'] . '&tax_class_id=' . $tax_class_id . '&tax_description=' . $tax_description_array . '&tax_zone_id=' . $tax_zone_id . '&tax_rate=' . $tax_rate . '&tax_priority=' . $tax_priority . '&action=edit&error_description=' . $tax_description_error_array));
        } else {
          xos_db_query("update " . TABLE_TAX_RATES . " set tax_rates_id = '" . (int)$tax_rates_id . "', tax_zone_id = '" . (int)$tax_zone_id . "', tax_class_id = '" . (int)$tax_class_id . "', tax_rate = '" . xos_db_input($tax_rate) . "', tax_priority = '" . xos_db_input($tax_priority) . "', last_modified = now() where tax_rates_id = '" . (int)$tax_rates_id . "'");
          $languages = xos_get_languages();
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
            xos_db_query("update " . TABLE_TAX_RATES_DESCRIPTION . " set tax_description = '" . xos_db_input(htmlspecialchars($tax_description[$languages[$i]['id']])) . "' where tax_rates_id = '" . (int)$tax_rates_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          }
          xos_update_table_tax_rates_final();
          
          $smarty_cache_control->clearAllCache();
          
          xos_redirect(xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $tax_rates_id));
        }
        break;
      case 'deleteconfirm':
        $tax_rates_id = xos_db_prepare_input($_GET['tID']);

        xos_db_query("delete from " . TABLE_TAX_RATES . " where tax_rates_id = '" . (int)$tax_rates_id . "'");
        xos_db_query("delete from " . TABLE_TAX_RATES_DESCRIPTION . " where tax_rates_id = '" . (int)$tax_rates_id . "'");
        xos_update_table_tax_rates_final();
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page']));
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n"; 
    
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php'); 

  $rates_query_raw = "select r.tax_rates_id, z.geo_zone_id, z.geo_zone_name, tc.tax_class_title, tc.tax_class_id, r.tax_priority, r.tax_rate, r.date_added, r.last_modified from " . TABLE_TAX_CLASS . " tc, " . TABLE_TAX_RATES . " r left join " . TABLE_GEO_ZONES . " z on r.tax_zone_id = z.geo_zone_id where r.tax_class_id = tc.tax_class_id";
  $rates_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $rates_query_raw, $rates_query_numrows);
  $rates_query = xos_db_query($rates_query_raw);
  $rates_array = array();
  while ($rates = xos_db_fetch_array($rates_query)) {
    if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID'] == $rates['tax_rates_id']))) && !isset($trInfo) && (substr($action, 0, 3) != 'new')) {
      $trInfo = new objectInfo($rates);
    }
    
    $selected = false;

    if (isset($trInfo) && is_object($trInfo) && ($rates['tax_rates_id'] == $trInfo->tax_rates_id)) {
      $selected = true;
      $link_filename_tax_rates = xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id . '&action=edit');
    } else {
      $link_filename_tax_rates = xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $rates['tax_rates_id']);
    }

    $rates_array[]=array('selected' => $selected,
                         'link_filename_tax_rates' => $link_filename_tax_rates,                         
                         'tax_priority' => $rates['tax_priority'],
                         'tax_class_title' => $rates['tax_class_title'],
                         'geo_zone_name' => $rates['geo_zone_name'],
                         'tax_rate' => xos_display_tax_value($rates['tax_rate']));
  }

  if (empty($action)) {
    $smarty->assign('link_filename_tax_rates_action_new', xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id . '&action=new'));
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'rates' => $rates_array,
                        'nav_bar_number' => $rates_split->display_count($rates_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_TAX_RATES),
                        'nav_bar_result' => $rates_split->display_links($rates_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));

  require(DIR_WS_BOXES . 'infobox_tax_rates.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'tax_rates');
  $output_tax_rates = $smarty->fetch(ADMIN_TPL . '/tax_rates.tpl');
  
  $smarty->assign('central_contents', $output_tax_rates);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
