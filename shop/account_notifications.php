<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : account_notifications.php
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
//              filename: account_notifications.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ACCOUNT_NOTIFICATIONS) == 'overwrite_all')) :
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  } elseif (PRODUCT_NOTIFICATION_ENABLED != 'true') {
    xos_redirect(xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ACCOUNT_NOTIFICATIONS);

  $global_query = $DB->prepare
  (
   "SELECT global_product_notifications
    FROM   " . TABLE_CUSTOMERS_INFO . "
    WHERE  customers_info_id = :customer_id"
  );
  
  $DB->perform($global_query, array(':customer_id' => (int)$_SESSION['customer_id']));
  
  $global = $global_query->fetch();

  if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    if (isset($_POST['product_global']) && is_numeric($_POST['product_global'])) {
      $product_global = $_POST['product_global'];
    } else {
      $product_global = '0';
    }

    (array)$products = $_POST['products'];

    if ($product_global != $global['global_product_notifications']) {
      $product_global = (($global['global_product_notifications'] == '1') ? '0' : '1');

      $update_customers_info_query = $DB->prepare
  	  (
       "UPDATE " . TABLE_CUSTOMERS_INFO . "
        SET    global_product_notifications = :product_global
        WHERE  customers_info_id = :customer_id"
  	  );
	  
      $DB->perform($update_customers_info_query, array(':product_global' => (int)$product_global,
                                                       ':customer_id' => (int)$_SESSION['customer_id']));	  
	  
    } elseif (sizeof($products) > 0) {
      $products_parsed = array();
      foreach ($products as $product) {
        if (is_numeric($product)) {
          $products_parsed[] = (int)$product;
        }
      }       

      if (sizeof($products_parsed) > 0) {
        $check_query = $DB->prepare
        (
         "SELECT Count(*) AS total
          FROM   " . TABLE_PRODUCTS_NOTIFICATIONS . "
          WHERE  customers_id = :customer_id
          AND    products_id 
          NOT IN (
                 " . implode(',', $products_parsed) . "
                 )"
        );
		
        $DB->perform($check_query, array(':customer_id' => (int)$_SESSION['customer_id']));
													   
        $check = $check_query->fetch();

        if ($check['total'] > 0) {
          $delete_products_notifications_query = $DB->prepare
          (
           "DELETE 
            FROM   " . TABLE_PRODUCTS_NOTIFICATIONS . "
            WHERE  customers_id = :customer_id
            AND    products_id 
            NOT IN (
                   " . implode(',', $products_parsed) . "
                   )"
          );
		  
          $DB->perform($delete_products_notifications_query, array(':customer_id' => (int)$_SESSION['customer_id']));
										 
        }
      }
    } else {
      $check_query = $DB->prepare
  	  (
       "SELECT Count(*) AS total
        FROM   " . TABLE_PRODUCTS_NOTIFICATIONS . "
        WHERE  customers_id = :customer_id"
  	  );
	  
      $DB->perform($check_query, array(':customer_id' => (int)$_SESSION['customer_id']));
																   
      $check = $check_query->fetch();

      if ($check['total'] > 0) {
        $delete_products_notifications_query = $DB->prepare
        (
         "DELETE 
          FROM   " . TABLE_PRODUCTS_NOTIFICATIONS . "
          WHERE  customers_id = :customer_id"
        );
		
        $DB->perform($delete_products_notifications_query, array(':customer_id' => (int)$_SESSION['customer_id']));
																   
      }
    }

    $messageStack->add_session('account', SUCCESS_NOTIFICATIONS_UPDATED, 'success');

    xos_redirect(xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  }

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL'));
  
  $add_header = '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                'function rowOverEffect(object) {' . "\n" .
                '  if (object.className == "module-row") object.className = "module-row-over";' . "\n" .
                '}' . "\n\n" .

                'function rowOutEffect(object) {' . "\n" .
                '  if (object.className == "module-row-over") object.className = "module-row";' . "\n" .
                '}' . "\n\n" .
                
                'function checkBox(object) {' . "\n" .
                '  document.account_notifications.elements[object].checked = !document.account_notifications.elements[object].checked;' . "\n" .
                '}' . "\n" .
                '/* ]]> */' . "\n" .                
                '</script> ' . "\n"; 
 
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($global['global_product_notifications'] != '1') {
  
    $smarty->assign('not_global_product_notifications', true);

    $products_check_query = $DB->prepare
  	(
     "SELECT Count(*) AS total
      FROM   " . TABLE_PRODUCTS_NOTIFICATIONS . "
      WHERE  customers_id = :customer_id"
  	);
	
	$DB->perform($products_check_query, array(':customer_id' => (int)$_SESSION['customer_id']));
	
    $products_check = $products_check_query->fetch();
    if ($products_check['total'] > 0) {
    
    $smarty->assign('products_notification', true);

      $counter = 0;
      $products_query = $DB->prepare
  	  (
       "SELECT   pd.products_id,
                 pd.products_name
        FROM     " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                 " . TABLE_PRODUCTS_NOTIFICATIONS . " pn
        WHERE    pn.customers_id = :customer_id
        AND      pn.products_id = pd.products_id
        AND      pd.language_id = :languages_id
        ORDER BY pd.products_name"
  	  );
	  
      $DB->perform($products_query, array(':customer_id' => (int)$_SESSION['customer_id'],
                                          ':languages_id' => (int)$_SESSION['languages_id'] ));	  
													   
      $products_notifications_array = array();
      while ($products = $products_query->fetch()) {
      
        $products_notifications_array[]=array('product_counter' => $counter,
                                              'product_name' => $products['products_name'],
                                              'checkbox_field_product' => xos_draw_checkbox_field('products[' . $counter . ']', $products['products_id'], true, 'id="checkbox_product_' . (int)($counter + 1) . '" onclick="checkBox(\'products[' . $counter . ']\')"'));
        $counter++;
      }
    }
  }

  $smarty->assign(array('form_begin' => xos_draw_form('account_notifications', xos_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL'), 'post', '', true),
                        'hidden_field' => xos_draw_hidden_field('action', 'process'),
                        'checkbox_field_product_global' => xos_draw_checkbox_field('product_global', '1', (($global['global_product_notifications'] == '1') ? true : false), 'id="checkbox_products_global" onclick="checkBox(\'product_global\')"'),
                        'products_notifications_array' => $products_notifications_array,
                        'link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL'),
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'account_notifications');
  $output_account_notifications = $smarty->fetch(SELECTED_TPL . '/account_notifications.tpl');
                        
  $smarty->assign('central_contents', $output_account_notifications);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;