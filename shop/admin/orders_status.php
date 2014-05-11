<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : orders_status.php
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
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_ORDERS_STATUS) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($_GET['oID'])) $orders_status_id = xos_db_prepare_input($_GET['oID']);
        
        $orders_status_name_array = $_POST['orders_status_name'];
        $languages = xos_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $language_id = $languages[$i]['id'];

          $sql_data_array = array('orders_status_name' => xos_db_prepare_input(htmlspecialchars($orders_status_name_array[$language_id])), 
                                  'public_flag' => ((isset($_POST['public_flag']) && ($_POST['public_flag'] == '1')) ? '1' : '0'), 
                                  'downloads_flag' => ((isset($_POST['downloads_flag']) && ($_POST['downloads_flag'] == '1')) ? '1' : '0'));

          if ($action == 'insert') {
            if (empty($orders_status_id)) {
              $next_id_query = xos_db_query("select max(orders_status_id) as orders_status_id from " . TABLE_ORDERS_STATUS . "");
              $next_id = xos_db_fetch_array($next_id_query);
              $orders_status_id = $next_id['orders_status_id'] + 1;
            }

            $insert_sql_data = array('orders_status_id' => $orders_status_id,
                                     'language_id' => $language_id);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            xos_db_perform(TABLE_ORDERS_STATUS, $sql_data_array);
          } elseif ($action == 'save') {
            xos_db_perform(TABLE_ORDERS_STATUS, $sql_data_array, 'update', "orders_status_id = '" . (int)$orders_status_id . "' and language_id = '" . (int)$language_id . "'");
          }
        }

        if (isset($_POST['default']) && ($_POST['default'] == 'on')) {
          xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . xos_db_input($orders_status_id) . "' where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
        }

        xos_redirect(xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&oID=' . $orders_status_id));
        break;
      case 'deleteconfirm':
        $oID = xos_db_prepare_input($_GET['oID']);

        $orders_status_query = xos_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
        $orders_status = xos_db_fetch_array($orders_status_query);

        if ($orders_status['configuration_value'] == $oID) {
          xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '' where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
        }

        xos_db_query("delete from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . xos_db_input($oID) . "'");

        xos_redirect(xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page']));
        break;
      case 'delete':
        $oID = xos_db_prepare_input($_GET['oID']);

        $status_query = xos_db_query("select count(*) as count from " . TABLE_ORDERS . " where orders_status = '" . (int)$oID . "'");
        $status = xos_db_fetch_array($status_query);

        $remove_status = true;
        if ($oID == DEFAULT_ORDERS_STATUS_ID) {
          $remove_status = false;
          $messageStack->add('header', ERROR_REMOVE_DEFAULT_ORDER_STATUS, 'error');
        } elseif ($status['count'] > 0) {
          $remove_status = false;
          $messageStack->add('header', ERROR_STATUS_USED_IN_ORDERS, 'error');
        } else {
          $history_query = xos_db_query("select count(*) as count from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_status_id = '" . (int)$oID . "'");
          $history = xos_db_fetch_array($history_query);
          if ($history['count'] > 0) {
            $remove_status = false;
            $messageStack->add('header', ERROR_STATUS_USED_IN_HISTORY, 'error');
          }
        }
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php'); 

  $orders_status_query_raw = "select * from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by orders_status_id";
  $orders_status_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $orders_status_query_raw, $orders_status_query_numrows);
  $orders_status_query = xos_db_query($orders_status_query_raw);
  $orders_status_array = array();
  while ($orders_status = xos_db_fetch_array($orders_status_query)) {
    if ((!isset($_GET['oID']) || (isset($_GET['oID']) && ($_GET['oID'] == $orders_status['orders_status_id']))) && !isset($oInfo) && (substr($action, 0, 3) != 'new')) {
      $oInfo = new objectInfo($orders_status);
    }
    
    $selected = false;

    if (isset($oInfo) && is_object($oInfo) && ($orders_status['orders_status_id'] == $oInfo->orders_status_id)) {
      $selected = true;
      $link_filename_orders_status = xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&oID=' . $oInfo->orders_status_id . '&action=edit');
    } else {
      $link_filename_orders_status = xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&oID=' . $orders_status['orders_status_id']);
    }
    
    $default_orders_status_id = false;

    if (DEFAULT_ORDERS_STATUS_ID == $orders_status['orders_status_id']) {
      $default_orders_status_id = true;
    }

    $orders_status_array[]=array('selected' => $selected,
                                 'default_id' => $default_orders_status_id,
                                 'link_filename_orders_status' => $link_filename_orders_status,
                                 'public_flag' => (($orders_status['public_flag'] == '1') ? true : false),
                                 'downloads_flag' => (($orders_status['downloads_flag'] == '1') ? true : false),
                                 'name' => $orders_status['orders_status_name']);
  }

  if (empty($action)) {
    $smarty->assign('link_filename_orders_status_action_new', xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&action=new'));
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'orders_status' => $orders_status_array,
                        'nav_bar_number' => $orders_status_split->display_count($orders_status_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS),
                        'nav_bar_result' => $orders_status_split->display_links($orders_status_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));

  require(DIR_WS_BOXES . 'infobox_orders_status.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'orders_status');
  $output_orders_status = $smarty->fetch(ADMIN_TPL . '/orders_status.tpl');
  
  $smarty->assign('central_contents', $output_orders_status);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
