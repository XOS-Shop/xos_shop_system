<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : product_reviews_write.php
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
//              filename: product_reviews_write.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_PRODUCT_REVIEWS_WRITE) == 'overwrite_all')) :
  if (PRODUCT_REVIEWS_ENABLED != 'true') {
    xos_redirect(xos_href_link(FILENAME_DEFAULT), false);
  } elseif (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $product_info_query = xos_db_query("select p.products_id, p.products_model, p.products_image, p.products_price, p.products_tax_class_id, pd.products_name, pd.products_p_unit from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where c.categories_or_pages_status = '1' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  if (!xos_db_num_rows($product_info_query)) {
    xos_redirect(xos_href_link(FILENAME_PRODUCT_REVIEWS, xos_get_all_get_params(array('action'))), false);
  } else {
    $product_info = xos_db_fetch_array($product_info_query);
    $products_image_name = xos_get_product_images($product_info['products_image'], 'all');   
  }
 
  $customer_query = xos_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
  $customer = xos_db_fetch_array($customer_query);

  if (isset($_GET['action']) && ($_GET['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    $rating = xos_db_prepare_input($_POST['rating']);
    $review = xos_db_prepare_input(substr(strip_tags($_POST['review']), 0,1000));

    $error = false;
    if (strlen($review) < REVIEW_TEXT_MIN_LENGTH) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_TEXT);
    }

    if (($rating < 1) || ($rating > 5)) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_RATING);
    }

    if ($error == false) {
      xos_db_query("insert into " . TABLE_REVIEWS . " (products_id, customers_id, customers_name, reviews_rating, date_added) values ('" . (int)$_GET['products_id'] . "', '" . (int)$_SESSION['customer_id'] . "', '" . xos_db_input($customer['customers_firstname']) . ' ' . xos_db_input($customer['customers_lastname']) . "', '" . xos_db_input($rating) . "', now())");
      $insert_id = xos_db_insert_id();

      xos_db_query("insert into " . TABLE_REVIEWS_DESCRIPTION . " (reviews_id, languages_id, reviews_text) values ('" . (int)$insert_id . "', '" . (int)$_SESSION['languages_id'] . "', '" . xos_db_input($review) . "')");
      
      $smarty->clearCache(null, 'L3|cc_reviews');
      $smarty->clearCache(null, 'L3|cc_product_reviews');
      
      xos_redirect(xos_href_link(FILENAME_PRODUCT_REVIEWS, xos_get_all_get_params(array('action', 'rmp')) . 'rmp=0'), false);
    }
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_PRODUCT_REVIEWS_WRITE);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_PRODUCT_REVIEWS, xos_get_all_get_params()));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                'function checkForm() {' . "\n" .
                '  var error = 0;' . "\n" .
                '  var error_message = "' . JS_ERROR . '";' . "\n\n" .

                '  var review = document.product_reviews_write.review.value;' . "\n\n" .

                '  if (review.length < ' . REVIEW_TEXT_MIN_LENGTH . ') {' . "\n" .
                '    error_message = error_message + "* ' . JS_REVIEW_TEXT . '\n";' . "\n" .
                '    error = 1;' . "\n" .
                '  }' . "\n\n" .

                '  if ((document.product_reviews_write.rating[0].checked) || (document.product_reviews_write.rating[1].checked) || (document.product_reviews_write.rating[2].checked) || (document.product_reviews_write.rating[3].checked) || (document.product_reviews_write.rating[4].checked)) {' . "\n" .
                '  } else {' . "\n" .
                '    error_message = error_message + "* ' . JS_REVIEW_RATING . '\n";' . "\n" .
                '    error = 1;' . "\n" .
                '  }' . "\n\n" .

                '  if (error == 1) {' . "\n" .
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
  
  $products_prices = xos_get_product_prices($product_info['products_price']);
  $products_tax_rate = xos_get_tax_rate($product_info['products_tax_class_id']);
  $price_breaks_array = array();
  if(isset($products_prices[$customer_group_id][0])) {     
    $product_price = $currencies->display_price($products_prices[$customer_group_id][0]['regular'], $products_tax_rate);
    $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][0]['special'] > 0 ? $product_price_special = $currencies->display_price($products_prices[$customer_group_id][0]['special'], $products_tax_rate) : $product_price_special = '';      
    $sizeof = count($products_prices[$customer_group_id]);
    if ($sizeof > 2) {
      $array_keys = array_keys($products_prices[$customer_group_id]);
      for ($count=2, $n=$sizeof; $count<$n; $count++) {
        $qty = $array_keys[$count];
        $price_breaks_array[]=array('qty' => $qty,
                                    'price_break' => $currencies->display_price($products_prices[$customer_group_id][$qty]['regular'], $products_tax_rate),
                                    'price_break_special' => $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][$qty]['special'] > 0 ? $currencies->display_price($products_prices[$customer_group_id][$qty]['special'], $products_tax_rate) : '');
      }       
    }            
  } else {      
    $product_price = $currencies->display_price($products_prices[0][0]['regular'], $products_tax_rate);
    $products_prices[0]['special_status'] == 1 && $products_prices[0][0]['special'] > 0 ? $product_price_special = $currencies->display_price($products_prices[0][0]['special'], $products_tax_rate) : $product_price_special = '';            
    $sizeof = count($products_prices[0]);
    if ($sizeof > 2) {      
      $array_keys = array_keys($products_prices[0]);
      for ($count=2, $n=$sizeof; $count<$n; $count++) {
        $qty = $array_keys[$count];
        $price_breaks_array[]=array('qty' => $qty,
                                    'price_break' => $currencies->display_price($products_prices[0][$qty]['regular'], $products_tax_rate),
                                    'price_break_special' => $products_prices[0]['special_status'] == 1 && $products_prices[0][$qty]['special'] > 0 ? $currencies->display_price($products_prices[0][$qty]['special'], $products_tax_rate) : '');                                      
      }                                           
    } 
  }                      

  if ($messageStack->size('review') > 0) {
    $smarty->assign('message_stack', $messageStack->output('review'));
  }

  if (xos_not_null($products_image_name)) {
    
    $pop_width = 0;
    $pop_height = 0;
    $small_height = 0;
    $small_width_total = 0;
    foreach ($products_image_name as $products_img_name){   
    if (count($products_image_name)>1) {		  
      $small_img = DIR_WS_IMAGES . 'products/small/' . $products_img_name['name'];
      $small_size = @GetImageSize("$small_img");		
      $small_width_total += $small_size[0] + 10;		
      if (($small_size[1] + 10) > $small_height) $small_height = $small_size[1] + 10;
    }    
    $popup_img = DIR_WS_IMAGES . 'products/large/' . $products_img_name['name'];		
    $pop_size = @GetImageSize("$popup_img");		
    if ($pop_size[0] > $pop_width) $pop_width = $pop_size[0];
    if ($pop_size[1] > $pop_height) $pop_height = $pop_size[1];
    }
        
    if ($small_width_total > $pop_width) $pop_width = $small_width_total; 
    
    $product_image = array_shift($products_image_name);
  
    $smarty->assign(array('box_width' => (int)($pop_width + 50),
                          'box_height' => (int)($pop_height + $small_height + 55),
                          'link_product_img' => xos_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id'] . '&img_name='. rawurlencode($product_image['name']), $request_type),
                          'link_product_img_noscript' => xos_href_link(FILENAME_IMAGES_WINDOW, 'pID=' . $product_info['products_id'], 'NONSSL', true, false, false, false, false),                          
                          'product_img' => xos_image(DIR_WS_IMAGES . 'products/medium/' . rawurlencode($product_image['name']), addslashes($product_info['products_name']), '', '', 'style="margin: 5px;"')));
  }

  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';        
    $back_link = xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']);
  } else {
    $back_link = 'javascript:history.go(-1)';
  }

  $smarty->assign(array('form_begin' => xos_draw_form('product_reviews_write', xos_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, xos_get_all_get_params(array('language', 'currency', 'tpl', 'action')) .'action=process', 'SSL'), 'post', 'onsubmit="return checkForm();"', true),
                        'form_end' => '</form>',
                        'radio_fields' => xos_draw_radio_field('rating', '1') . ' ' . xos_draw_radio_field('rating', '2') . ' ' . xos_draw_radio_field('rating', '3') . ' ' . xos_draw_radio_field('rating', '4') . ' ' . xos_draw_radio_field('rating', '5'),
                        'textarea_field' => xos_draw_textarea_field('review', '60', '15'),
                        'customers_name' => xos_output_string_protected($customer['customers_firstname'] . ' ' . $customer['customers_lastname']),
                        'products_name' => $product_info['products_name'],
                        'products_p_unit' => $product_info['products_p_unit'],
                        'products_model' => $product_info['products_model'],
                        'products_price' => $product_price,
                        'products_price_special' => $product_price_special,
                        'products_price_breaks' => $price_breaks_array,
                        'products_tax_description' => xos_get_products_tax_description($product_info['products_tax_class_id'], $products_tax_rate),
                        'td_width_img' => MEDIUM_PRODUCT_IMAGE_MAX_WIDTH + 10,
                        'link_back' => $back_link,
                        'link_buy_now' => xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('action')) . 'action=buy_now'))); 
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'product_reviews_write');
  $output_product_reviews_write = $smarty->fetch(SELECTED_TPL . '/product_reviews_write.tpl'); 
  
  $smarty->assign('central_contents', $output_product_reviews_write);  
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
endif;
?>
