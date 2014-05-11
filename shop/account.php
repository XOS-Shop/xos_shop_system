<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : account.php
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
//              filename: account.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ACCOUNT) == 'overwrite_all')) :  
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ACCOUNT);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));

  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                'function rowOverEffect(object) {' . "\n" .
                '  if (object.className == "module-row") object.className = "module-row-over";' . "\n" .
                '}' . "\n\n" .

                'function rowOutEffect(object) {' . "\n" .
                '  if (object.className == "module-row-over") object.className = "module-row";' . "\n" .
                '}' . "\n" .
                '/* ]]> */' . "\n" . 
                '</script> ' . "\n"; 
 
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  if (xos_count_customer_orders() > 0) { 

    $orders_query = xos_db_query("select o.orders_id, o.date_purchased, o.delivery_name, o.delivery_country, o.billing_name, o.billing_country, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$_SESSION['customer_id'] . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and s.public_flag = '1' group by o.orders_id order by o.orders_id desc limit 3");
    $orders_array = array();    
    while ($orders = xos_db_fetch_array($orders_query)) {
      $oder_total_query = xos_db_query("select text from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$orders['orders_id'] . "' and class = 'ot_total' order by orders_total_id DESC limit 1");
      $oder_total = xos_db_fetch_array($oder_total_query);    
    
      if (xos_not_null($orders['delivery_name'])) {
        $order_name = $orders['delivery_name'];
        $order_country = $orders['delivery_country'];
      } else {
        $order_name = $orders['billing_name'];
        $order_country = $orders['billing_country'];
      } 
      
      $orders_array[]=array('link_filename_account_history_info' => xos_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL'),
                            'date_purchased' => xos_date_short($orders['date_purchased']),
                            'order_id' => $orders['orders_id'],
                            'order_name' => xos_output_string_protected($order_name),
                            'order_country' => $order_country,
                            'order_status_name' => $orders['orders_status_name'],
                            'order_total' => strip_tags($oder_total['text']));
    } 
    
    $smarty->assign('customer_orders', true);     
  }

  if ($messageStack->size('account') > 0) {
    $smarty->assign('message_stack', $messageStack->output('account'));
  } 
  
  $smarty->assign(array('orders' => $orders_array,
                        'link_filename_account_history' => xos_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'),
                        'link_filename_account_edit' => xos_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'),
                        'link_filename_address_book' => xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'),
                        'link_filename_account_password' => xos_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'),
                        'link_filename_account_newsletters' => (NEWSLETTER_ENABLED == 'true') ? xos_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') : '',
                        'link_filename_account_notifications' => (PRODUCT_NOTIFICATION_ENABLED == 'true') ? xos_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') : ''));
                        
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'account');
  $output_account = $smarty->fetch(SELECTED_TPL . '/account.tpl'); 
  
  $smarty->assign('central_contents', $output_account);  
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
