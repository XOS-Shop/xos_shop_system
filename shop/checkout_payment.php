<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : checkout_payment.php
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
//              filename: checkout_payment.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CHECKOUT_PAYMENT) == 'overwrite_all')) :
// if the customer is not logged on, redirect them to the login page
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($_SESSION['cart']->count_contents() < 1) {
    xos_redirect(xos_href_link(FILENAME_SHOPPING_CART), false);
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!isset($_SESSION['shipping'])) {
    xos_redirect(xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($_SESSION['cart']->cartID) && isset($_SESSION['cartID'])) {
    if ($_SESSION['cart']->cartID != $_SESSION['cartID']) {
      xos_redirect(xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $_SESSION['cart']->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (xos_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
        xos_redirect(xos_href_link(FILENAME_SHOPPING_CART), false);
        break;
      }
    }
  }

// if no billing destination address was selected, use the customers own address as default
  if (!isset($_SESSION['billto'])) {
    $_SESSION['billto'] = $_SESSION['customer_default_address_id'];
  } else {
// verify the selected billing address
    if ( (is_array($_SESSION['billto']) && empty($_SESSION['billto'])) || is_numeric($_SESSION['billto']) ) {
      $check_address_query = xos_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and address_book_id = '" . (int)$_SESSION['billto'] . "'");
      $check_address = xos_db_fetch_array($check_address_query);

      if ($check_address['total'] != '1') {
        $_SESSION['billto'] = $_SESSION['customer_default_address_id'];
        if (isset($_SESSION['payment'])) unset($_SESSION['payment']);
      }
    }  
  }

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  $total_weight = $_SESSION['cart']->show_weight();
  $total_count = $_SESSION['cart']->count_contents();

// load all enabled payment modules
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment;

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CHECKOUT_PAYMENT);

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL')); 
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                'var selected;' . "\n\n" .

                'function selectRowEffect(object, buttonSelect) {' . "\n" .
                '  if (!selected) {' . "\n" .
                '    if (document.getElementById) {' . "\n" .
                '      selected = document.getElementById("default-selected");' . "\n" .
                '    } else {' . "\n" .
                '      selected = document.all["default-selected"];' . "\n" .
                '    }' . "\n" .
                '  }' . "\n\n" .

                '  if (selected) selected.className = "module-row";' . "\n" .
                '  object.className = "module-row-selected";' . "\n" .
                '  selected = object;' . "\n\n" .

                '// one button is not an array' . "\n" .
                '  if (document.checkout_payment.payment[0]) {' . "\n" .
                '    document.checkout_payment.payment[buttonSelect].checked=true;' . "\n" .
                '  } else {' . "\n" .
                '    document.checkout_payment.payment.checked=true;' . "\n" .
                '  }' . "\n" .
                '}' . "\n\n" .

                'function rowOverEffect(object) {' . "\n" .
                '  if (object.className == "module-row") object.className = "module-row-over";' . "\n" .
                '}' . "\n\n" .

                'function rowOutEffect(object) {' . "\n" .
                '  if (object.className == "module-row-over") object.className = "module-row";' . "\n" .
                '}' . "\n" .
                '/* ]]> */' . "\n" .
                '</script> ' . "\n";  
  
  $add_header .= $payment_modules->javascript_validation();

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php'); 
  
  $selection = $payment_modules->selection();

  $radio_buttons = 0;
  $payment_modules_array = array();
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
    $modules = $selection[$i]['module'];
    (($selection[$i]['id'] == $_SESSION['payment']) || ($n == 1)) ? $actual_payment_method = true : $actual_payment_method = false;    
    if (sizeof($selection) > 1) {
      $radio_field = xos_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $_SESSION['payment']), 'id="payment_' . $radio_buttons . '"');
    } else {
      $radio_field = xos_draw_hidden_field('payment', $selection[$i]['id'], 'id="payment_' . $radio_buttons . '"');
    } 
    $fields = false;
    $module_error = false;    
    if (isset($selection[$i]['error'])) {
      $module_error = true;    
      $module_error_text = $selection[$i]['error'];
    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
      $fields = true;
      $selection_fields_array = array();
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {    
        $selection_fields_array[]=array('title' => $selection[$i]['fields'][$j]['title'],
                                        'field' => $selection[$i]['fields'][$j]['field']);      
      }
    }   
    $payment_modules_array[]=array('radio_field' => $radio_field,
                                   'actual_payment_method' => $actual_payment_method,
                                   'loaded_modules' => $modules,
                                   'module_error_text' => $module_error_text,
                                   'module_error' => $module_error,
                                   'fields' => $fields,
                                   'selection_fields' => $selection_fields_array,
                                   'radio_select' => $radio_buttons); 
    unset($selection_fields_array);  
    $radio_buttons++;
  }
  if (sizeof($selection) > 0) {
    $smarty->assign('payment_modules', true);
  }    
  if (sizeof($selection) > 1) {
    $smarty->assign('several_payment_modules', true);
  }    
  if (isset($_GET['payment_error']) && is_object(${$_GET['payment_error']}) && ($error = ${$_GET['payment_error']}->get_error())) {
    $smarty->assign(array('payment_error' => true,
                          'payment_error_title' => xos_output_string($error['title']),
                          'payment_error_sting' => xos_output_string($error['error'])));
  } 
  
  if (MUST_ACCEPT_CONDITIONS == 'true') {
    $smarty->assign('checkbox_accept_conditions', xos_draw_checkbox_field('accept_conditions', '1', false, 'id="accept_conditions"'));
  }
  
  $popup_status_query = xos_db_query("select status from " . TABLE_CONTENTS . "  where type = 'system_popup' and status = '1' and content_id = '7' LIMIT 1");
      
  $smarty->assign(array('form_begin' => xos_draw_form('checkout_payment', xos_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'), 'post', 'onsubmit="return check_form();"', true),
                        'form_end' => '</form>',
                        'link_filename_popup_content_7' => xos_db_num_rows($popup_status_query) ? xos_href_link(FILENAME_POPUP_CONTENT, 'content_id=7', $request_type) : '',                        
                        'link_filename_checkout_payment_address' => xos_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL'),
                        'link_filename_checkout_shipping' => xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'),
                        'address_label' => xos_address_label($_SESSION['customer_id'], $_SESSION['billto'], true, ' ', '<br />'),
                        'payment_modules' => $payment_modules_array,
                        'textarea' => xos_draw_textarea_field('comments', '60', '5', $_SESSION['comments'], 'id="checkout_payment_comments"')));
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'checkout_payment');
  $output_checkout_payment = $smarty->fetch(SELECTED_TPL . '/checkout_payment.tpl');
                        
  $smarty->assign('central_contents', $output_checkout_payment);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
