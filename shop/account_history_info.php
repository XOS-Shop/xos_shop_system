<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : account_history_info.php
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
//              filename: account_history_info.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ACCOUNT_HISTORY_INFO) == 'overwrite_all')) :
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id']))) {
    xos_redirect(xos_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }
  
  $customer_info_query = xos_db_query("select o.customers_id from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_STATUS . " s where o.orders_id = '". (int)$_GET['order_id'] . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and s.public_flag = '1'");
  $customer_info = xos_db_fetch_array($customer_info_query);
  if ($customer_info['customers_id'] != $_SESSION['customer_id']) {
    xos_redirect(xos_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ACCOUNT_HISTORY_INFO);

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  $site_trail->add(sprintf(NAVBAR_TITLE_3, $_GET['order_id']), xos_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $_GET['order_id'], 'SSL'));

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order($_GET['order_id']);
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');
  
  if ($order->delivery != false) {  
    $smarty->assign('delivery_address', xos_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'));
    if (xos_not_null($order->info['shipping_method'])) {    
      $smarty->assign('shipping_method', $order->info['shipping_method']);
    }
  }

  if (sizeof($order->info['tax_groups']) > 1) {  
    $smarty->assign('tax_groups', true);
  }
  
  $order_products_array = array();
  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    $attributes_options_values_price = false;   
    if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {    
      $order_attributes_array = array();        
      for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {        
        $options_values_price = '';
        if ($order->products[$i]['attributes'][$j]['price'] != 0) {
          $attributes_options_values_price = true;
          $options_values_price = $order->products[$i]['attributes'][$j]['price_formated'];
        }         
                
        $order_attributes_array[]=array('option_name' => $order->products[$i]['attributes'][$j]['option'],
                                        'option_value_name' => $order->products[$i]['attributes'][$j]['value'],
                                        'option_price' => $options_values_price,
                                        'option_price_prefix' => $order->products[$i]['attributes'][$j]['prefix']);        
      }
    }
    
    $order_products_array[]=array('qty' => $order->products[$i]['qty'], 
                                  'model' => $order->products[$i]['model'],    
                                  'name' => $order->products[$i]['name'],
                                  'packaging_unit' => $order->products[$i]['packaging_unit'],
                                  'tax' => xos_display_tax_value($order->products[$i]['tax']),                                
                                  'price' => $order->products[$i]['price_formated'],
                                  'final_single_price' => $order->products[$i]['final_price_formated'],
                                  'final_price' => $order->products[$i]['total_price_formated'],
                                  'products_attributes_option_price' => $attributes_options_values_price,
                                  'product_attributes' => $order_attributes_array);

    unset($order_attributes_array);         
  }

  $order_totals_array = array();
  for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {                 
    $order_totals_array[]=array('totals_title' => $order->totals[$i]['title'],
                                'totals_text' => $order->totals[$i]['text'],
                                'totals_tax' => $order->totals[$i]['class'] == 'ot_shipping' || $order->totals[$i]['class'] == 'ot_loworderfee' || $order->totals[$i]['class'] == 'ot_cod_fee' ? xos_display_tax_value($order->totals[$i]['tax']) : -1);         
  }

  $statuses_query = xos_db_query("select os.orders_status_name, osh.date_added, osh.comments from " . TABLE_ORDERS_STATUS . " os, " . TABLE_ORDERS_STATUS_HISTORY . " osh where osh.orders_id = '" . (int)$_GET['order_id'] . "' and osh.orders_status_id = os.orders_status_id and os.language_id = '" . (int)$_SESSION['languages_id'] . "' and os.public_flag = '1' order by osh.date_added, osh.orders_status_history_id");
  $statuses_array = array();
  while ($statuses = xos_db_fetch_array($statuses_query)) {         
    $statuses_array[]=array('order_date_added' => xos_date_short($statuses['date_added']),
                            'order_status_name' => $statuses['orders_status_name'],
                            'order_comments' => (empty($statuses['comments']) ? '&nbsp;' : nl2br(xos_output_string_protected($statuses['comments']))));         
  }
  
  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';        
    $back_link = xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']);
  } else {
    $back_link = 'javascript:history.go(-1)';
  }
  
  $smarty->assign(array('order_id' => $_GET['order_id'],
                        'orders_status' => $order->info['orders_status'],
                        'date_purchased' => xos_date_long($order->info['date_purchased']),
                        'order_total' => $order->info['total'],
                        'order_products' => $order_products_array,
                        'billing_address' => xos_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'),
                        'payment_method' => $order->info['payment_method'],
                        'order_totals' => $order_totals_array,
                        'statuses' => $statuses_array,
                        'link_back' => $back_link));
                         
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'account_history_info');
  
  $language_directory_query = xos_db_query("select directory from " . TABLE_LANGUAGES . " where use_in_id > '1' and directory = '" . $order->info['language_directory'] . "'");  
  if (xos_db_num_rows($language_directory_query)) {
    $smarty->configLoad('languages/' . $order->info['language_directory'] . '.conf', 'order_info');
  }
  
  if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php'); 
   
  $output_account_history_info = $smarty->fetch(SELECTED_TPL . '/account_history_info.tpl');                         

  $smarty->assign('central_contents', $output_account_history_info);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');     
endif;
?>
