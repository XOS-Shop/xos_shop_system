<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : checkout_confirmation.php
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
//              filename: checkout_confirmation.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CHECKOUT_CONFIRMATION) == 'overwrite_all')) :
// if the customer is not logged on, redirect them to the login page
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($_SESSION['cart']->count_contents() < 1) {
    xos_redirect(xos_href_link(FILENAME_SHOPPING_CART), false);
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($_SESSION['cart']->cartID) && isset($_SESSION['cartID'])) {
    if ($_SESSION['cart']->cartID != $_SESSION['cartID']) {
      xos_redirect(xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!isset($_SESSION['shipping'])) {
    xos_redirect(xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }
  
  if (isset($_POST['payment'])) $_SESSION['payment'] = $_POST['payment'];

    $_SESSION['comments'] = xos_db_prepare_input(substr(strip_tags($_POST['comments']), 0,1000));

// load the selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment($_SESSION['payment']);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  $payment_modules->update_status();

  if ( ($payment_modules->selected_module != $_SESSION['payment']) || ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$_SESSION['payment']) ) || (is_object($$_SESSION['payment']) && ($$_SESSION['payment']->enabled == false)) ) {
    xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  }
  
  if (MUST_ACCEPT_CONDITIONS == 'true' && $_POST['accept_conditions'] != '1') {
    xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_CONDITIONS_NOT_ACCEPTED), 'SSL'));
  }  

  if (is_array($payment_modules->modules)) {
    $payment_modules->pre_confirmation_check();
  }

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($_SESSION['shipping']);

  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;
  $order_total_modules->process();

// Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (xos_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        xos_redirect(xos_href_link(FILENAME_SHOPPING_CART), false);
        break;
      }
    }
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CHECKOUT_CONFIRMATION);

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2);
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                'function check_form() {' . "\n" .
                '  var error = 0;' . "\n" .
                '  var error_message = "' . JS_ERROR . '";' . "\n"; 
                             
  $add_header .= $payment_modules->js_validation();
  
  $add_header .= "\n" . '  if (error == 1) {' . "\n" .
                 '    alert(error_message);' . "\n" .
                 '    return false;' . "\n" .
                 '  } else {' . "\n" .
                 '    return true;' . "\n" .
                 '  }' . "\n" .
                 '}' . "\n" .
                 '/* ]]> */' . "\n" .
                 '</script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  
  
  $tax_rates = array();
  
  if ($_SESSION['sendto'] != false) {  
    $smarty->assign(array('delivery_address' => xos_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'),
                          'link_filename_checkout_shipping_address' => xos_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'))); 
    if ($order->info['shipping_method']) {    
      $smarty->assign('shipping_method', $order->info['shipping_method']);      
    }
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
    
    $tax_rate = xos_display_tax_value($order->products[$i]['tax']);
     
    $order_products_array[]=array('qty' => $order->products[$i]['qty'],
                                  'model' => $order->products[$i]['model'],    
                                  'name' => $order->products[$i]['name'],
                                  'packaging_unit' => $order->products[$i]['packaging_unit'],
                                  'tax' => $tax_rate,                                
                                  'price' => $order->products[$i]['price_formated'],
                                  'final_single_price' => $order->products[$i]['final_price_formated'],
                                  'final_price' => $order->products[$i]['total_price_formated'],
                                  'products_attributes_option_price' => $attributes_options_values_price,
                                  'product_attributes' => $order_attributes_array);

    
    if (isset($tax_rate)) $tax_rates[$tax_rate] = '1';
    
    unset($order_attributes_array);         
  }

  if (MODULE_ORDER_TOTAL_INSTALLED) {
    $order_totals = $order_total_modules->output();
    $order_totals_array = array();
    for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {                 
      $order_totals_array[]=array('totals_title' => $order_totals[$i]['title'],
                                  'totals_text' => $order_totals[$i]['text'],
                                  'totals_tax' => $order_totals[$i]['tax']);
                                                                  
      if ($order_totals[$i]['tax'] > -1) $tax_rates[$order_totals[$i]['tax']] = '1';                                                                                                                                          
    } 
  }

  if (is_array($payment_modules->modules)) {
    if ($confirmation = $payment_modules->confirmation()) {     
      $confirmation_fields_array = array();
      for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
        $confirmation_fields_array[]=array('title' => $confirmation['fields'][$i]['title'],
                                           'field' => $confirmation['fields'][$i]['field']);
      }
      $smarty->assign(array('confirmation' => true,
                            'confirmation_title' => $confirmation['title'],
                            'confirmation_fields' => $confirmation_fields_array));
    }
  }

  if (xos_not_null($order->info['comments'])) {  
   $smarty->assign(array('comments' => nl2br(xos_output_string_protected($order->info['comments'])),
                         'hidden_field_comments' => xos_draw_hidden_field('comments', $order->info['comments'])));  
  }

  if (isset($$_SESSION['payment']->form_action_url)) {
    $form_action_url = $$_SESSION['payment']->form_action_url;
  } else {
    $form_action_url = xos_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
  }

  if (is_array($payment_modules->modules)) {  
    $smarty->assign('input_process_button', $payment_modules->process_button());
  }
  
  if ((sizeof($tax_rates) > 1) && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) { 
    $smarty->assign('tax_groups', true);
  }
  
  $popup_status_query = xos_db_query("select status from " . TABLE_CONTENTS . "  where type = 'system_popup' and status = '1' and content_id = '7' LIMIT 1");

  $smarty->assign(array('form_begin' => xos_draw_form('checkout_confirmation', $form_action_url, 'post', 'onsubmit="return check_form();"'),
                        'form_end' => '</form>',
                        'link_filename_popup_content_7' => xos_db_num_rows($popup_status_query) ? xos_href_link(FILENAME_POPUP_CONTENT, 'content_id=7', $request_type) : '',
                        'order_products' => $order_products_array,
                        'billing_address' => xos_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'),
                        'payment_method' => $order->info['payment_method'],
                        'link_filename_shopping_cart' => xos_href_link(FILENAME_SHOPPING_CART),
                        'link_filename_checkout_payment_address' => xos_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL'),
                        'link_filename_checkout_payment' => xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'),
                        'link_filename_checkout_shipping' => xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'),
                        'order_totals' => $order_totals_array));
    
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'checkout_confirmation');   
  $output_checkout_confirmation = $smarty->fetch(SELECTED_TPL . '/checkout_confirmation.tpl');                          

  $smarty->assign('central_contents', $output_checkout_confirmation);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
