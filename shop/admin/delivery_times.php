<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : delivery_times.php
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
//              filename: orders_status.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_DELIVERY_TIMES) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($_GET['dID'])) $delivery_times_id = xos_db_prepare_input($_GET['dID']);
        
        $delivery_times_text_array = $_POST['delivery_times_text'];
        $languages = xos_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $language_id = $languages[$i]['id'];

          $sql_data_array = array('delivery_times_text' => xos_db_prepare_input(htmlspecialchars($delivery_times_text_array[$language_id])),
                                  'popup_content_id' => ((isset($_POST['popup_content_id']) && ((int)$_POST['popup_content_id'] > 0)) ? (int)$_POST['popup_content_id'] : 0));

          if ($action == 'insert') {
            if (empty($delivery_times_id)) {
              $next_id_query = xos_db_query("select max(delivery_times_id) as delivery_times_id from " . TABLE_DELIVERY_TIMES . "");
              $next_id = xos_db_fetch_array($next_id_query);
              $delivery_times_id = $next_id['delivery_times_id'] + 1;
            }

            $insert_sql_data = array('delivery_times_id' => $delivery_times_id,
                                     'language_id' => $language_id);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            xos_db_perform(TABLE_DELIVERY_TIMES, $sql_data_array);
          } elseif ($action == 'save') {
            xos_db_perform(TABLE_DELIVERY_TIMES, $sql_data_array, 'update', "delivery_times_id = '" . (int)$delivery_times_id . "' and language_id = '" . (int)$language_id . "'");
          }
        }

        if (isset($_POST['default']) && ($_POST['default'] == 'on')) {
          xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . xos_db_input($delivery_times_id) . "' where configuration_key = 'DEFAULT_DELIVERY_TIMES_ID'");
        }
        
        $smarty_cache_control->clearAllCache();

        xos_redirect(xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $delivery_times_id));
        break;
      case 'deleteconfirm':
        $dID = xos_db_prepare_input($_GET['dID']);

        $delivery_time_query = xos_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_DELIVERY_TIMES_ID'");
        $delivery_time = xos_db_fetch_array($delivery_time_query);

        if ($delivery_time['configuration_value'] == $dID) {
          xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '' where configuration_key = 'DEFAULT_DELIVERY_TIMES_ID'");
        }

        xos_db_query("delete from " . TABLE_DELIVERY_TIMES . " where delivery_times_id = '" . xos_db_input($dID) . "'");
       
        $smarty_cache_control->clearAllCache();
       
        xos_redirect(xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page']));
        break;
      case 'delete':
        $dID = xos_db_prepare_input($_GET['dID']);

        $delivery_time_query = xos_db_query("select count(*) as count from " . TABLE_PRODUCTS . " where products_delivery_time_id = '" . (int)$dID . "'");
        $delivery_time = xos_db_fetch_array($delivery_time_query);

        $remove_delivery_time = true;
        if ($dID == DEFAULT_DELIVERY_TIMES_ID) {
          $remove_delivery_time = false;
          $messageStack->add('header', ERROR_REMOVE_DEFAULT_DELIVERY_TIME, 'error');
        } elseif ($delivery_time['count'] > 0) {
          $remove_delivery_time = false;
          $messageStack->add('header', ERROR_DELIVERY_TIME_USED_IN_PRODUCTS, 'error');
        }
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php'); 

  $delivery_times_query_raw = "select * from " . TABLE_DELIVERY_TIMES . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by delivery_times_id";
  $delivery_times_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $delivery_times_query_raw, $delivery_times_query_numrows);
  $delivery_times_query = xos_db_query($delivery_times_query_raw);
  $delivery_times_array = array();
  while ($delivery_times = xos_db_fetch_array($delivery_times_query)) {
    if ((!isset($_GET['dID']) || (isset($_GET['dID']) && ($_GET['dID'] == $delivery_times['delivery_times_id']))) && !isset($dInfo) && (substr($action, 0, 3) != 'new')) {
      $dInfo = new objectInfo($delivery_times);
    }
    
    $selected = false;

    if (isset($dInfo) && is_object($dInfo) && ($delivery_times['delivery_times_id'] == $dInfo->delivery_times_id)) {
      $selected = true;
      $link_filename_delivery_times = xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id . '&action=edit');
    } else {
      $link_filename_delivery_times = xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $delivery_times['delivery_times_id']);
    }
    
    $default_delivery_times_id = false;

    if (DEFAULT_DELIVERY_TIMES_ID == $delivery_times['delivery_times_id']) {
      $default_delivery_times_id = true;
    }

    $delivery_times_array[]=array('selected' => $selected,
                                  'default_id' => $default_delivery_times_id,
                                  'popup_content_id' => (($delivery_times['popup_content_id'] > 0) ? $delivery_times['popup_content_id'] : ''),
                                  'link_filename_delivery_times' => $link_filename_delivery_times,
                                  'text' => $delivery_times['delivery_times_text']);
  }

  if (empty($action)) {
    $smarty->assign('link_filename_delivery_times_action_new', xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&action=new'));
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'delivery_times' => $delivery_times_array,
                        'nav_bar_number' => $delivery_times_split->display_count($delivery_times_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_DELIVERY_TIMES),
                        'nav_bar_result' => $delivery_times_split->display_links($delivery_times_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));

  require(DIR_WS_BOXES . 'infobox_delivery_times.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'delivery_times');
  $output_delivery_times = $smarty->fetch(ADMIN_TPL . '/delivery_times.tpl');
  
  $smarty->assign('central_contents', $output_delivery_times);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
