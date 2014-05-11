<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : checkout_shipping.php
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
//              filename: checkout_shipping.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CHECKOUT_SHIPPING) == 'overwrite_all')) :
  require('includes/classes/http_client.php');

// if the customer is not logged on, redirect them to the login page
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// restore cart contents
  $_SESSION['cart']->restore_contents();

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($_SESSION['cart']->count_contents() < 1) {
    xos_redirect(xos_href_link(FILENAME_SHOPPING_CART), false);
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

// if no shipping destination address was selected, use the customers own address as default
  if (!isset($_SESSION['sendto'])) {
    $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];
  } else {
// verify the selected shipping address
    if ( (is_array($_SESSION['sendto']) && empty($_SESSION['sendto'])) || is_numeric($_SESSION['sendto']) ) {
      $check_address_query = xos_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and address_book_id = '" . (int)$_SESSION['sendto'] . "'");
      $check_address = xos_db_fetch_array($check_address_query);

      if ($check_address['total'] != '1') {
        $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];
        if (isset($_SESSION['shipping'])) unset($_SESSION['shipping']);
      }
    }  
  }

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents

  $_SESSION['cartID'] = $_SESSION['cart']->cartID;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed
  if ($order->content_type == 'virtual') {
  
    $_SESSION['shipping'] = false;
    $_SESSION['sendto'] = false;
    xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  }

  $total_weight = $_SESSION['cart']->show_weight();
  $total_count = $_SESSION['cart']->count_contents();

// load all enabled shipping modules
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping;

  if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
    $pass = false;

    switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
      case 'national':
        if ($order->delivery['country_id'] == STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'international':
        if ($order->delivery['country_id'] != STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'both':
        $pass = true;
        break;
    }

    $free_shipping = false;
    if ( ($pass == true) && ($order->info['subtotal'] >= $currencies->currencies[$_SESSION['currency']]['value'] * MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
      $free_shipping = true;

      include(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/modules/order_total/ot_shipping.php');
    }
  } else {
    $free_shipping = false;
  }

// process the selected shipping method
  if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {

      $_SESSION['comments'] = xos_db_prepare_input(substr(strip_tags($_POST['comments']), 0,1000));

    if ( (xos_count_shipping_modules() > 0) || ($free_shipping == true) ) {
      if ( (isset($_POST['shipping'])) && (strpos($_POST['shipping'], '_')) ) {
        $_SESSION['shipping'] = $_POST['shipping'];

        list($module, $method) = explode('_', $_SESSION['shipping']);
        if ( is_object($$module) || ($_SESSION['shipping'] == 'free_free') ) {
          if ($_SESSION['shipping'] == 'free_free') {
            $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
            $quote[0]['methods'][0]['cost'] = '0';
          } else {
            $quote = $shipping_modules->quote($method, $module);
          }
          if (isset($quote['error'])) {
            unset($_SESSION['shipping']);
          } else {
            if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
              $_SESSION['shipping'] = array('id' => $_SESSION['shipping'],
                                'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                'cost' => $quote[0]['methods'][0]['cost']);

              xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
          }
        } else {
          unset($_SESSION['shipping']);
        }
      }
    } else {
      $_SESSION['shipping'] = false;
                
      xos_redirect(xos_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }    
  }

// get all available shipping quotes
  $quotes = $shipping_modules->quote();

// if no shipping method has been selected, automatically select the cheapest method.
// if the modules status was changed when none were available, to save on implementing
// a javascript force-selection method, also automatically select the cheapest shipping
// method if more than one module is now enabled
  if ( !isset($_SESSION['shipping']) || ( isset($_SESSION['shipping']) && ($_SESSION['shipping'] == false) && (xos_count_shipping_modules() > 1) ) ) $_SESSION['shipping'] = $shipping_modules->cheapest();

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CHECKOUT_SHIPPING);

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  
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
                '  if (document.checkout_address.shipping[0]) {' . "\n" .
                '    document.checkout_address.shipping[buttonSelect].checked=true;' . "\n" .
                '  } else {' . "\n" .
                '    document.checkout_address.shipping.checked=true;' . "\n" .
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

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');
  
  if (xos_count_shipping_modules() > 0) {

    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
      $smarty->assign('several_shipping_modules', true);
    }

    if ($free_shipping == true) {
      $smarty->assign(array('free_shipping' => true,
                            'free_shipping_over' => $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER, $currencies->currencies[$_SESSION['currency']]['value']),
                            'hidden_field_shipping' => xos_draw_hidden_field('shipping', 'free_free')));
//      $smarty->assign('shipping_icon', $quotes[0]['icon']);
    } else {
      $radio_buttons = 0;
      $shipping_modules_array = array();
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {

        if (!isset($quotes[$i]['error'])) {
          $shipping_modules_methods_array = array();
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
            $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $_SESSION['shipping']['id']) ? true : false);
            
            ( ($checked == true) || ($n == 1 && $n2 == 1) ) ? $actual_method = true : $actual_method = false;
            
            if ( ($n > 1) || ($n2 > 1) ) {
              $several_methods = true;
              $cost = $currencies->format(xos_add_tax($currencies->currencies[$_SESSION['currency']]['value'] * $quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)));
            } else {
              $several_methods = false;
              $cost = $currencies->format(xos_add_tax($currencies->currencies[$_SESSION['currency']]['value'] * $quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax']));
            }

            $shipping_modules_methods_array[]=array('radio_field' => xos_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked, 'id="shipping_' . $radio_buttons . '"'),
                                                    'several_methods' => $several_methods,                                                    
                                                    'hidden_field' => xos_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], 'id="shipping_' . $radio_buttons . '"'),                                       
                                                    'cost' => $cost,                                                   
                                                    'actual_method' => $actual_method,                                                                                           
                                                    'title' => $quotes[$i]['methods'][$j]['title'],
                                                    'radio_select' => $radio_buttons); 
            $radio_buttons++;
          }
        }

        $shipping_modules_array[]=array('name' => $quotes[$i]['module'],
                                        'icon' => $quotes[$i]['icon'],
                                        'error' => $quotes[$i]['error'],
                                        'methods' => $shipping_modules_methods_array);
        unset($shipping_modules_methods_array);
      }
    }
    
    $smarty->assign(array('shipping_modules' => true,
                          'shipping_modules_array' => $shipping_modules_array));
  }

  $smarty->assign(array('form_begin' => xos_draw_form('checkout_address', xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'), 'post', '', true),
                        'hidden_field' => xos_draw_hidden_field('action', 'process'),
                        'form_end' => '</form>',
                        'link_filename_checkout_shipping_address' => xos_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'),
                        'address_label' => xos_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br />'),
                        'textarea' => xos_draw_textarea_field('comments', '60', '5', $_SESSION['comments'], 'id="checkout_shipping_comments"')));
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'checkout_shipping');
  $output_checkout_shipping = $smarty->fetch(SELECTED_TPL . '/checkout_shipping.tpl');
                        
  $smarty->assign('central_contents', $output_checkout_shipping);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
