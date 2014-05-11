<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : account_history.php
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
//              filename: account_history.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ACCOUNT_HISTORY) == 'overwrite_all')) :
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ACCOUNT_HISTORY);

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  $orders_total = xos_count_customer_orders();

  if ($orders_total > 0) {
    $history_query_raw = "select o.orders_id, o.date_purchased, o.delivery_name, o.billing_name, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$_SESSION['customer_id'] . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and s.public_flag = '1' group by o.orders_id order by o.orders_id DESC";
    $history_split = new splitPageResults($history_query_raw, MAX_DISPLAY_ORDER_HISTORY, 'o.orders_id');
    $history_query = xos_db_query($history_split->sql_query);
    
    $orders_array = array();
    while ($history = xos_db_fetch_array($history_query)) {
      $products_query = xos_db_query("select count(*) as count from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$history['orders_id'] . "'");
      $products = xos_db_fetch_array($products_query);
      
      $oder_total_query = xos_db_query("select text from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$history['orders_id'] . "' and class = 'ot_total' order by orders_total_id DESC limit 1");
      $oder_total = xos_db_fetch_array($oder_total_query);

      if (xos_not_null($history['delivery_name'])) {
        $order_type = 'shipped_to';
        $order_name = $history['delivery_name'];
      } else {
        $order_type = 'billed_to';
        $order_name = $history['billing_name'];
      } 
      
      
      $orders_array[]=array('link_filename_account_history_info' => xos_href_link(FILENAME_ACCOUNT_HISTORY_INFO, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'order_id=' . $history['orders_id'], 'SSL'),
                            'order_id' => $history['orders_id'],
                            'order_status_name' => $history['orders_status_name'],
                            'date_purchased' => xos_date_long($history['date_purchased']),
                            'order_type' => $order_type,
                            'order_name' => xos_output_string_protected($order_name),
                            'products_count' => $products['count'],
                            'order_total' => strip_tags($oder_total['text']));      
    }
    
    $smarty->assign(array('orders' => true,
                          'nav_bar_number' => $history_split->display_count(TEXT_DISPLAY_NUMBER_OF_ORDERS),
                          'nav_bar_result' => TEXT_RESULT_PAGE . ' ' . $history_split->display_links(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'language', 'currency', 'tpl', 'x', 'y'))),
                          'nav_bar_result_in_pull_down_menu' => $history_split->display_links_in_pull_down_menu(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'language', 'currency', 'tpl', 'x', 'y')))));
  }

  $smarty->assign(array('orders_array' => $orders_array,
                        'link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL')));
                        
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'account_history');
  $output_account_history = $smarty->fetch(SELECTED_TPL . '/account_history.tpl');
  
  $smarty->assign('central_contents', $output_account_history);  
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
