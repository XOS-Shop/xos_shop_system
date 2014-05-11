<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : checkout_process.php
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
//              filename: checkout_process.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CHECKOUT_PROCESS) == 'overwrite_all')) :
// if the customer is not logged on, redirect them to the login page
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
    
// if there is nothing in the customers cart, redirect them to the shopping cart page 
  if ($_SESSION['cart']->count_contents() < 1) { 
    xos_redirect(xos_href_link(FILENAME_SHOPPING_CART), false);    
  }

  if ( (xos_not_null(MODULE_PAYMENT_INSTALLED)) && (!isset($_SESSION['payment'])) ) {
    xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  }
  
// if no shipping method has been selected, redirect the customer to the shipping method selection page 
  if (!isset($_SESSION['shipping']) || !isset($_SESSION['sendto'])) { 
    xos_redirect(xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')); 
  } 
  
// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($_SESSION['cart']->cartID) && isset($_SESSION['cartID'])) {
    if ($_SESSION['cart']->cartID != $_SESSION['cartID']) {
      xos_redirect(xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

  include(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CHECKOUT_PROCESS);

// load selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment($_SESSION['payment']);

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($_SESSION['shipping']);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;
  
// Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') && (!isset($_GET['return_from'])) ) {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (xos_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        xos_redirect(xos_href_link(FILENAME_SHOPPING_CART), false);
        break;
      }
    }
  }  

  $payment_modules->update_status(); 

  if ( ($payment_modules->selected_module != $_SESSION['payment']) || ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$_SESSION['payment']) ) || (is_object($$_SESSION['payment']) && ($$_SESSION['payment']->enabled == false)) ) { 
    xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL')); 
  }   

  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;

  $order_totals = $order_total_modules->process();
  
// load the before_process function from the payment modules
  $payment_modules->before_process();  

  $sql_data_array = array('customers_id' => $_SESSION['customer_id'],
                          'customers_c_id' => $order->customer['c_id'],
                          'customers_name' => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
                          'customers_company' => $order->customer['company'],
                          'customers_street_address' => $order->customer['street_address'],
                          'customers_suburb' => $order->customer['suburb'],
                          'customers_city' => $order->customer['city'],
                          'customers_postcode' => $order->customer['postcode'], 
                          'customers_state' => $order->customer['state'], 
                          'customers_country' => $order->customer['country']['title'], 
                          'customers_telephone' => $order->customer['telephone'], 
                          'customers_email_address' => $order->customer['email_address'],
                          'customers_address_format_id' => $order->customer['format_id'], 
                          'delivery_name' => trim($order->delivery['firstname'] . ' ' . $order->delivery['lastname']), 
                          'delivery_company' => $order->delivery['company'],
                          'delivery_street_address' => $order->delivery['street_address'], 
                          'delivery_suburb' => $order->delivery['suburb'], 
                          'delivery_city' => $order->delivery['city'], 
                          'delivery_postcode' => $order->delivery['postcode'], 
                          'delivery_state' => $order->delivery['state'], 
                          'delivery_country' => $order->delivery['country']['title'], 
                          'delivery_address_format_id' => $order->delivery['format_id'], 
                          'billing_name' => $order->billing['firstname'] . ' ' . $order->billing['lastname'], 
                          'billing_company' => $order->billing['company'],
                          'billing_street_address' => $order->billing['street_address'], 
                          'billing_suburb' => $order->billing['suburb'], 
                          'billing_city' => $order->billing['city'], 
                          'billing_postcode' => $order->billing['postcode'], 
                          'billing_state' => $order->billing['state'], 
                          'billing_country' => $order->billing['country']['title'], 
                          'billing_address_format_id' => $order->billing['format_id'], 
                          'payment_method' => $order->info['payment_method'], 
                          'cc_type' => $order->info['cc_type'], 
                          'cc_owner' => $order->info['cc_owner'],  
                          'cc_expires' => $order->info['cc_expires'], 
                          'date_purchased' => 'now()', 
                          'orders_status' => $order->info['order_status'],
                          'language_id' => $_SESSION['languages_id'],
                          'language_directory' => $_SESSION['language'], 
                          'currency' => $order->info['currency'], 
                          'currency_value' => $order->info['currency_value']);
  xos_db_perform(TABLE_ORDERS, $sql_data_array);
  $insert_id = xos_db_insert_id();
  if (xos_not_null($order->info['cc_number'])) {  
    xos_db_query("update " . TABLE_ORDERS . " set cc_number = AES_ENCRYPT('" . $order->info['cc_number'] . "', 'key_cc_number') where orders_id = '" . (int)$insert_id . "'");
  }
  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
    $sql_data_array = array('orders_id' => $insert_id,
                            'title' => $order_totals[$i]['title'],
                            'text' => $order_totals[$i]['text'],
                            'value' => $order_totals[$i]['value'],
                            'tax' => $order_totals[$i]['tax'], 
                            'class' => $order_totals[$i]['code'], 
                            'sort_order' => $order_totals[$i]['sort_order']);
    xos_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
  }

  $customer_notification = (SEND_EMAILS == 'true') ? '1' : '0';
  $sql_data_array = array('orders_id' => $insert_id, 
                          'orders_status_id' => $order->info['order_status'], 
                          'date_added' => 'now()', 
                          'customer_notified' => $customer_notification,
                          'comments' => $order->info['comments']);
  xos_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
  
// Set new order true and add last modified in table configuration
  if (NEW_ORDER == 'false') {
    xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = 'true', last_modified = '" . date('Ymd') . "' where configuration_key = 'NEW_ORDER'");
  }
  
// initialized for the email confirmation
  $tax_rates = array();
  $order_products_array = array();
  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
// Stock Update
    if (STOCK_LIMITED == 'true' && STOCK_CHECK == 'true') {   
      $product_id = xos_get_prid($order->products[$i]['id']);
 
      if ($product_id == $order->products[$i]['id']) {   
        $stock_query = xos_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
        $stock_values = xos_db_fetch_array($stock_query);

        $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
        xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$stock_left . "' where products_id = '" . (int)$product_id . "'");

        if ( ($stock_left < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
          xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . (int)$product_id . "'");
          $smarty->clearAllCache();
        }

      } else {                  
        $stock_query = xos_db_query("select products_quantity, attributes_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
        $stock_values = xos_db_fetch_array($stock_query);
     
        $attributes_quantity = xos_get_attributes_quantity($stock_values['attributes_quantity']);        

        if (xos_not_null($attributes_quantity)) {               
          list($prid, $params_sting) = explode('-', $order->products[$i]['id']);        
          $stock_left = $attributes_quantity[$params_sting] - $order->products[$i]['qty'];
          
          if ($attributes_quantity[$params_sting] > 0) {          
            $stock_values['products_quantity'] = $stock_values['products_quantity'] - min($attributes_quantity[$params_sting], $order->products[$i]['qty']);          
          }
                  
          $attributes_quantity[$params_sting] = $stock_left;        
          xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)max(0, $stock_values['products_quantity']) . "', attributes_quantity = '" . xos_db_input(serialize($attributes_quantity)) . "' where products_id = '" . (int)$product_id . "'");
        
          if ($stock_left < 1) {
            $smarty->clearCache(null, 'L3|cc_product_info');
          }
          
          if ( ($stock_values['products_quantity'] < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
            xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . (int)$product_id . "'");
            $smarty->clearAllCache();
          }                  
        }        
      }   
    }

// Update products_ordered (for bestsellers list)
    xos_db_query("update " . TABLE_PRODUCTS . " set products_last_modified = now(), products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = '" . xos_get_prid($order->products[$i]['id']) . "'");
    
    $attributes_sting = null;
    if (strpos($order->products[$i]['id'], '-') !== false) {
      list($prid, $attributes_sting) = explode('-', $order->products[$i]['id']);
    }
    
    $sql_data_array = array('orders_id' => $insert_id, 
                            'products_id' => xos_get_prid($order->products[$i]['id']),
                            'products_attributes_sting' => $attributes_sting, 
                            'products_model' => $order->products[$i]['model'], 
                            'products_name' => $order->products[$i]['name'],
                            'products_p_unit' => $order->products[$i]['packaging_unit'], 
                            'products_price' => $order->products[$i]['price'], 
                            'final_price' => $order->products[$i]['final_price'],
                            'products_price_text' => $order->products[$i]['price_formated'], 
                            'final_price_text' => $order->products[$i]['final_price_formated'],
                            'total_price_text' => $order->products[$i]['total_price_formated'],                            
                            'products_tax' => $order->products[$i]['tax'], 
                            'products_quantity' => $order->products[$i]['qty']);
    xos_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);
    $order_products_id = xos_db_insert_id();

//------insert customer choosen option to order--------
    $attributes_exist = '0';
    $attributes_options_values_price = false;
    if (isset($order->products[$i]['attributes'])) {
      $attributes_exist = '1';    
      $order_attributes_array = array();      
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        if (DOWNLOAD_ENABLED == 'true') {
          $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename 
                               from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa 
                               left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                on pa.products_attributes_id=pad.products_attributes_id
                               where pa.products_id = '" . $order->products[$i]['id'] . "' 
                                and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' 
                                and pa.options_id = popt.products_options_id 
                                and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' 
                                and pa.options_values_id = poval.products_options_values_id 
                                and popt.language_id = '" . $_SESSION['languages_id'] . "' 
                                and poval.language_id = '" . $_SESSION['languages_id'] . "'";
          $attributes = xos_db_query($attributes_query);
        } else {
          $attributes = xos_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $_SESSION['languages_id'] . "' and poval.language_id = '" . $_SESSION['languages_id'] . "'");
        }
        $attributes_values = xos_db_fetch_array($attributes);

        $sql_data_array = array('orders_id' => $insert_id, 
                                'orders_products_id' => $order_products_id, 
                                'products_options' => $attributes_values['products_options_name'],
                                'products_options_values' => $attributes_values['products_options_values_name'], 
                                'options_values_price' => $order->products[$i]['attributes'][$j]['price'],
                                'options_values_price_text' => $order->products[$i]['attributes'][$j]['price'] != 0 ? $order->products[$i]['attributes'][$j]['price_formated'] : '', 
                                'price_prefix' => $attributes_values['price_prefix']);
        xos_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);

        if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && xos_not_null($attributes_values['products_attributes_filename'])) {
          $sql_data_array = array('orders_id' => $insert_id, 
                                  'orders_products_id' => $order_products_id, 
                                  'orders_products_filename' => $attributes_values['products_attributes_filename'], 
                                  'download_maxdays' => $attributes_values['products_attributes_maxdays'], 
                                  'download_count' => $attributes_values['products_attributes_maxcount']);
          xos_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
        }
        $options_values_price = '';
        if ($attributes_values['options_values_price'] != 0) {
          $attributes_options_values_price = true;
          $options_values_price = $order->products[$i]['attributes'][$j]['price_formated'];
        }  
         
        $order_attributes_array[]=array('option_name' => $attributes_values['products_options_name'],
                                        'option_value_name' => $attributes_values['products_options_values_name'],
                                        'option_price' => $options_values_price,
                                        'option_price_prefix' => $attributes_values['price_prefix']);      
      }
    }
//------insert customer choosen option eof ----    
    $tax_rate = xos_display_tax_value($order->products[$i]['tax']);
    
    $order_products_array[]=array('qty' => $order->products[$i]['qty'], 
                                  'model' => $order->products[$i]['model'],    
                                  'name' => $order->products[$i]['name'],
                                  'packaging_unit' => $order->products[$i]['packaging_unit'],
                                  'tax_value' => $tax_rate,
                                  'price' => $order->products[$i]['price_formated'],
                                  'final_single_price' => $order->products[$i]['final_price_formated'],
                                  'final_price' => $order->products[$i]['total_price_formated'],                                  
                                  'products_attributes_option_price' => $attributes_options_values_price,
                                  'product_attributes' => $order_attributes_array);
                                  
    if (isset($tax_rate)) $tax_rates[$tax_rate] = '1';                              

    unset($order_attributes_array); 
  }
 
  $order_totals_array = array();
  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {                 
    $order_totals_array[]=array('totals_title' => $order_totals[$i]['title'],
                                'totals_text' => $order_totals[$i]['text'],
                                'totals_tax' => $order_totals[$i]['tax']); 
                                
    if ($order_totals[$i]['tax'] > -1) $tax_rates[$order_totals[$i]['tax']] = '1';                                     
  }

// lets start with the email confirmation
  if (SEND_EMAILS == 'true') {
  
    $smarty->unregisterFilter('output','smarty_outputfilter_trimwhitespace');
  
    if ((sizeof($tax_rates) > 1) && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) { 
      $smarty->assign('more_tax_groups', true);
    }   
  
    if ($order->info['comments']) {
      $smarty->assign('order_comments', xos_db_output($order->info['comments']));
    }
  
    if ($order->content_type != 'virtual') {
      $smarty->assign('delivery_address', xos_address_label($_SESSION['customer_id'], $_SESSION['sendto'], 0, '', "\n"));
    } 
  
    if (is_object($$_SESSION['payment'])) {
      $payment_class = $$_SESSION['payment'];
      $smarty->assign('payment_method', $order->info['payment_method']);
      if ($payment_class->email_footer) {
        $smarty->assign('payment_email_footer', $payment_class->email_footer); 
      }
    }
  
    $smarty->assign(array('html_params' => HTML_PARAMS,
                          'xhtml_lang' => XHTML_LANG,
                          'charset' => CHARSET,
                          'link_invoice' => xos_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false, false),
                          'default_address' => xos_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], 0, '', "\n"),
                          'billing_address' => xos_address_label($_SESSION['customer_id'], $_SESSION['billto'], 0, '', "\n"),
                          'store_name' => STORE_NAME,
                          'store_name_address' => STORE_NAME_ADDRESS,
                          'order_id' => $insert_id,
                          'date_ordered' => xos_date_format(DATE_FORMAT_LONG),
                          'order_products' => $order_products_array,
                          'order_totals' => $order_totals_array,
                          'src_embedded_shop_logo' => 'cid:shop_logo',
                          'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . SELECTED_TPL . '/') . EMAIL_SHOP_LOGO));
  
    $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'order_email_html');
    $output_order_email_html = $smarty->fetch(SELECTED_TPL . '/includes/email/order_email_html.tpl');
    $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'order_email_text');  
    $output_order_email_text = $smarty->fetch(SELECTED_TPL . '/includes/email/order_email_text.tpl');
  
    $email_to_customer = new mailer($order->customer['firstname'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], sprintf(EMAIL_TEXT_SUBJECT_CUSTOMER, $insert_id, xos_date_format(DATE_FORMAT_SHORT)), $output_order_email_html, $output_order_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SHOP_LOGO);
  
    if(!$email_to_customer->send()) {
      $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_customer->ErrorInfo));
    } 
  
// send emails to other people
    if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
      $send_extra_order_emails_to = SEND_EXTRA_ORDER_EMAILS_TO;
      $decoded_send_extra_order_emails_to = html_entity_decode($send_extra_order_emails_to, ENT_QUOTES, 'UTF-8');      
      $recipients = explode(',', $decoded_send_extra_order_emails_to);      
      for ($i=0, $n=count($recipients); $i<$n; $i++) {
        $address = '';
        $name = ''; 
        $pieces = explode('<', $recipients[$i]);
        if (count($pieces) == 2) {
          $address = trim($pieces[1], " >");      
          $name = trim($pieces[0]); 
        } elseif (count($pieces) == 1) {      
          $pos = stripos($pieces[0], '@');      
          $address = $pos ? trim($pieces[0], " >") : '';
        } 
      
        $email_to_other_people = new mailer($name, $address, sprintf(EMAIL_TEXT_SUBJECT_OTHER, $insert_id, xos_date_format(DATE_FORMAT_SHORT)), $output_order_email_html, $output_order_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SHOP_LOGO);
    
        if(!$email_to_other_people->send()) {
          $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_other_people->ErrorInfo));
        } 
      }                  
    }
  }  
    
// load the after_process function from the payment modules
  $payment_modules->after_process();

  $_SESSION['cart']->reset(true);

// unregister session variables used during checkout
  unset($_SESSION['sendto']);
  unset($_SESSION['billto']);
  unset($_SESSION['shipping']);
  unset($_SESSION['payment']);
  unset($_SESSION['comments']);
  
  xos_redirect(xos_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
endif;
?>
