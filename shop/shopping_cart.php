<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : shopping_cart.php
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
//              filename: shopping_cart.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_SHOPPING_CART) == 'overwrite_all')) :
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_SHOPPING_CART);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_SHOPPING_CART));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');   

  if ($_SESSION['cart']->count_contents() > 0) {  
    $any_out_of_stock = 0;
    $products = $_SESSION['cart']->get_products($currencies->currencies[$_SESSION['currency']]['value']);
    
    $tax_address_query = xos_db_query("select ab.entry_country_id, ab.entry_zone_id from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) where ab.customers_id = '" . (int)$_SESSION['customer_id'] . "' and ab.address_book_id = '" . (int)($_SESSION['cart']->get_content_type() == 'virtual' ? $_SESSION['billto'] : $_SESSION['sendto']) . "'");
    $tax_address = xos_db_fetch_array($tax_address_query);    
    
    $tax_rates = array();  
    $products_array =  array();       
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      $products_tax_rate = xos_get_tax_rate($products[$i]['tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']);
      $attributes_options_values_price = false;    
      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
    
        $hidden_field = '';        
        $attributes_array =  array();
        reset($products[$i]['attributes']);       
        while (list($option, $value) = each($products[$i]['attributes'])) {          
          $hidden_field = xos_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);                    
          $attributes = xos_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                                      from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                      where pa.products_id = '" . (int)$products[$i]['id'] . "'
                                       and pa.options_id = '" . (int)$option . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . (int)$value . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                       and poval.language_id = '" . (int)$_SESSION['languages_id'] . "'");
          $attributes_values = xos_db_fetch_array($attributes);
          
          
          $options_values_price = '';
          if ($attributes_values['options_values_price'] != 0) {
          $attributes_options_values_price = true;
          $options_values_price = $currencies->format(xos_add_tax($currencies->currencies[$_SESSION['currency']]['value'] * $attributes_values['options_values_price'], $products_tax_rate));
          }
          
          $attributes_array[]=array('products_options_name' => $attributes_values['products_options_name'],
                                    'options_values_id' => $value,
                                    'products_options_values_name' => $attributes_values['products_options_values_name'],
                                    'options_values_price' => $options_values_price,
                                    'hidden_field' => $hidden_field,
                                    'price_prefix' => $attributes_values['price_prefix']);                            
        }        
      }
                
      if (STOCK_CHECK == 'true') {
        $stock_check = xos_check_stock($products[$i]['id'], $products[$i]['quantity']);
        if (xos_not_null($stock_check)) {
          $any_out_of_stock = 1;
          $products_name .= $stock_check;
        }
      }
      
      $tax_rate = xos_display_tax_value($products_tax_rate);
      $product_image = xos_get_product_images($products[$i]['image']);
                       
      $products_array[]=array('checkbox_cart_delete' => xos_draw_checkbox_field('cart_delete[]', $products[$i]['id'], false, 'id="cart_delete_' . ($i + 1) . '"'),
                              'link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . urlencode($products[$i]['id'])),
                              'link_remove_product' => xos_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&rmp=0&products_id=' . urlencode($products[$i]['id'])),
                              'products_image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($product_image['name']), $products[$i]['name']),
                              'products_name' => $products[$i]['name'],
                              'products_packaging_unit' => $products[$i]['packaging_unit'],
                              'products_model' => $products[$i]['model'],
                              'stock_check' => $stock_check,
                              'input_and_hidden_fields_quantity' => xos_draw_input_field('cart_quantity[]', $products[$i]['quantity'], 'id="cart_quantity_' . ($i + 1) . '" size="2"') . xos_draw_hidden_field('products_id[]', $products[$i]['id']),
                              'products_tax' => xos_display_tax_value($products_tax_rate),
                              'products_price' => $currencies->format($products[$i]['price']),
                              'products_final_single_price' => $currencies->format($products[$i]['final_price']),
                              'products_final_price' => $currencies->format($products[$i]['quantity'] * $products[$i]['final_price']),
                              'products_attributes_option_price' => $attributes_options_values_price,
                              'products_attributes' => $attributes_array); 

      if (isset($tax_rate)) $tax_rates[$tax_rate] = '1';
                              
      unset($attributes_array);                                                                                                                               
    }

    include(DIR_WS_CLASSES . 'payment.php');
    $payment_modules = new payment;    
    $initialize_checkout_methods = $payment_modules->checkout_initialization_method();
    $alternative_checkout_methods_array = array();
    if (!empty($initialize_checkout_methods)) {
      reset($initialize_checkout_methods);
      while (list(, $value) = each($initialize_checkout_methods)) {
        $alternative_checkout_methods_array[] = array('value' => $value);
      }
    }
   
    $tax_groups = $_SESSION['cart']->show_tax_groups($currencies->currencies[$_SESSION['currency']]['value']);
    $tax_groups_array = array();
    reset($tax_groups);   
    while (list($key, $value) = each($tax_groups)) {
      if ($value > 0) {
        $tax_groups_array[] = array('title' => ($_SESSION['sppc_customer_group_show_tax'] == '1' ? TEXT_TAX_INC_VAT : TEXT_TAX_PLUS_VAT) . '&nbsp;' . $key . ':',
                                    'text' => $currencies->format($value),
                                    'value' => $value);
      }
    }                                                
      
    if (STOCK_CHECK == 'true' && $any_out_of_stock == 1) {
      if (STOCK_ALLOW_CHECKOUT == 'true') {     
        $smarty->assign('out_of_stock', 'can_checkout');  
      } else {      
        $smarty->assign('out_of_stock', 'cant_checkout');
      }      
    }

    $back = sizeof($_SESSION['navigation']->path)-2;
    if (!empty($_SESSION['navigation']->path[$back])) {
      $get_params_array = $_SESSION['navigation']->path[$back]['get'];
      $get_params_array['rmp'] = '0';        
      $smarty->assign('link_back', xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']));
    } else {
      $smarty->assign('link_back', xos_href_link(FILENAME_DEFAULT, 'rmp=0'));
    } 

    if ($_SESSION['sppc_customer_group_discount'] > 0) {
      $smarty->assign(array('discount_value' => $_SESSION['sppc_customer_group_discount'] . '%',
                            'sub_total_discount' => $currencies->format($_SESSION['cart']->show_discount($currencies->currencies[$_SESSION['currency']]['value']))));
    }

    if ((sizeof($tax_rates) > 1) && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) { 
      $smarty->assign('tax_groups', true);
    }
    
    $smarty->assign(array('products_in_cart' => true,
                          'products' => $products_array,
                          'alternative_checkout_methods' => $alternative_checkout_methods_array,
                          'sub_total_tax_groups' => $tax_groups_array,
                          'sub_total' => $currencies->format($_SESSION['cart']->show_total($currencies->currencies[$_SESSION['currency']]['value'])),
                          'link_filename_checkout_shipping' => xos_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')));  

  }
  $smarty->assign(array('stock_mark' => STOCK_MARK_PRODUCT_OUT_OF_STOCK,
                        'form_begin' => xos_draw_form('cart_quantity', xos_href_link(FILENAME_SHOPPING_CART, 'action=update_product')),
                        'link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'form_end' => '</form>'));
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'shopping_cart');
  $output_shopping_cart = $smarty->fetch(SELECTED_TPL . '/shopping_cart.tpl');  

  $smarty->assign('central_contents', $output_shopping_cart);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
