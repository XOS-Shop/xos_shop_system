<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : checkout_success.php
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
//              filename: checkout_success.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CHECKOUT_SUCCESS) == 'overwrite_all')) :
// if the customer is not logged on, redirect them to the shopping cart page
  if (!isset($_SESSION['customer_id'])) {
    xos_redirect(xos_href_link(FILENAME_SHOPPING_CART), false);
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'update')) {
    $notify_string = '';
    $notify = $_POST['notify'];
    if (!is_array($notify)) $notify = array($notify);
    for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
      if (is_numeric($notify[$i])) { 
        $notify_string .= 'notify[]=' . $notify[$i] . '&'; 
      }      
    } 
       
    if (!empty($notify_string)) $notify_string = 'action=notify&' . substr($notify_string, 0, -1);

    xos_redirect(xos_href_link(FILENAME_DEFAULT, $notify_string));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CHECKOUT_SUCCESS);

  $site_trail->add(NAVBAR_TITLE_1);
  $site_trail->add(NAVBAR_TITLE_2);
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php'); 

  $global_query = $DB->prepare
  (
   "SELECT global_product_notifications
    FROM   " . TABLE_CUSTOMERS_INFO . "
    WHERE  customers_info_id = :customer_id"
  );
  
  $DB->perform($global_query, array(':customer_id' => (int)$_SESSION['customer_id'])); 
                                                 
  $global = $global_query->fetch();

  if ($global['global_product_notifications'] != '1') {
    $orders_query = $DB->prepare
    (
     "SELECT   orders_id
      FROM     " . TABLE_ORDERS . "
      WHERE    customers_id = :customer_id
      ORDER BY date_purchased DESC
      LIMIT    1"
    );
    
    $DB->perform($orders_query, array(':customer_id' => (int)$_SESSION['customer_id']));
    
    $orders = $orders_query->fetch();
    $products_array = array();
    $products_query = $DB->prepare
    (
     "SELECT   products_id,
               products_name
      FROM     " . TABLE_ORDERS_PRODUCTS . "
      WHERE    orders_id = :orders_id
      ORDER BY products_name"
    );
    
    $DB->perform($products_query, array(':orders_id' => (int)$orders['orders_id']));
    
    while ($products = $products_query->fetch()) {
      $products_array[] = array('id' => $products['products_id'],
                                'text' => $products['products_name']);
    }
  }

  if ($global['global_product_notifications'] != '1' && PRODUCT_NOTIFICATION_ENABLED == 'true') { 
    $smarty->assign('notify', true);   
    $products_notify_array = array();
    $products_displayed = array();
    for ($i=0, $n=sizeof($products_array); $i<$n; $i++) {
      if (!in_array($products_array[$i]['id'], $products_displayed)) {
        $products_displayed[] = $products_array[$i]['id'];        
        $products_notify_array[]=array('checkbox_field' => xos_draw_checkbox_field('notify[]', $products_array[$i]['id'], false, 'id="checkbox_product_' . ($i + 1) . '"'),
                                       'text' => $products_array[$i]['text']);        
      }
    }
  }

  $smarty->assign(array('form_begin' => xos_draw_form('order', xos_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')),
                        'form_end' => '</form>',
                        'products_notify' => $products_notify_array,
                        'link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL'),
                        'link_filename_account_history' => xos_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'),
                        'link_filename_contact_us' => xos_href_link(FILENAME_CONTENT, 'co=4')));
 
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'checkout_success');
  
  if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php');
  
  $output_checkout_success = $smarty->fetch(SELECTED_TPL . '/checkout_success.tpl');
                        
  $smarty->assign('central_contents', $output_checkout_success);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
