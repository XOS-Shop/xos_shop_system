<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : product_reviews_info.php
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
//              filename: product_reviews_info.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_PRODUCT_REVIEWS_INFO) == 'overwrite_all')) :
  if (PRODUCT_REVIEWS_ENABLED != 'true') {
    xos_redirect(xos_href_link(FILENAME_DEFAULT), false);
  }

  if (isset($_GET['reviews_id']) && xos_not_null($_GET['reviews_id']) && isset($_GET['products_id']) && xos_not_null($_GET['products_id'])) {
    $review_query = xos_db_query("select rd.reviews_text, r.reviews_rating, r.reviews_id, r.customers_name, r.date_added, r.reviews_read, p.products_id, p.products_price, p.products_tax_class_id, p.products_image, p.products_model, p.products_quantity, pd.products_name, pd.products_p_unit from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where c.categories_or_pages_status = '1' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and r.reviews_id = '" . (int)$_GET['reviews_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "' and r.products_id = p.products_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '". (int)$_SESSION['languages_id'] . "'");    

    if (!xos_db_num_rows($review_query)) {
      xos_redirect(xos_href_link(FILENAME_PRODUCT_REVIEWS, xos_get_all_get_params(array('reviews_id'))));
    }
    
  } else {
    xos_redirect(xos_href_link(FILENAME_PRODUCT_REVIEWS, xos_get_all_get_params(array('reviews_id'))));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_PRODUCT_REVIEWS_INFO);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_PRODUCT_REVIEWS, xos_get_all_get_params()));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php'); 
  
  xos_db_query("update " . TABLE_REVIEWS . " set reviews_read = reviews_read+1 where reviews_id = '" . (int)$_GET['reviews_id'] . "'"); 

  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L3|cc_product_reviews_info|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['cPath'] . '-' . $_GET['manufacturers_id'] . '-' . $_GET['products_id'] . '-' . $_GET['reviews_id'];
  }
     
  if(!$smarty->isCached(SELECTED_TPL . '/product_reviews_info.tpl', $cache_id)) {
  
    $review = xos_db_fetch_array($review_query);
  
    $products_image_name = xos_get_product_images($review['products_image'], 'all');
    $products_prices = xos_get_product_prices($review['products_price']);
    $products_tax_rate = xos_get_tax_rate($review['products_tax_class_id']);
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
                            'link_product_img' => xos_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $review['products_id'] . '&img_name='. rawurlencode($product_image['name'])),
                            'link_product_img_noscript' => xos_href_link(FILENAME_IMAGES_WINDOW, 'pID=' . $review['products_id'], 'NONSSL', true, false, false, false, false),
                            'product_img' => xos_image(DIR_WS_IMAGES . 'products/medium/' . rawurlencode($product_image['name']), addslashes($review['products_name']), '', '', 'style="margin: 5px;"'))); 
    }

    $smarty->assign(array('date_added' => xos_date_long($review['date_added']),
                          'review_rating' => $review['reviews_rating'],
                          'review_text' => xos_break_string(nl2br(xos_output_string_protected($review['reviews_text'])), 60, '-<br />'),
                          'stars_image' => xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/stars_' . $review['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $review['reviews_rating'])),
                          'customers_name' => xos_output_string_protected($review['customers_name']),
                          'products_name' => $review['products_name'],
                          'products_p_unit' => $review['products_p_unit'],
                          'products_model' => $review['products_model'],
                          'products_quantity' => $review['products_quantity'],
                          'products_price' => $product_price,
                          'products_price_special' => $product_price_special,
                          'products_price_breaks' => $price_breaks_array,
                          'products_tax_description' => xos_get_products_tax_description($review['products_tax_class_id'], $products_tax_rate),
                          'td_width_img' => MEDIUM_PRODUCT_IMAGE_MAX_WIDTH + 10,
                          'link_filename_product_reviews_write' => xos_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, xos_get_all_get_params(array('language', 'currency', 'tpl', 'rmp')), 'SSL'),
                          'link_buy_now' => xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('action')) . 'action=buy_now')));
                        
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'product_reviews_info');
  }

  // link_back will not be cached (nocache)  
  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';    
    $smarty->assign('link_back', xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']), true);
  } else {  
    $smarty->assign('link_back', 'javascript:history.go(-1)', true);
  } 
  
  $output_product_reviews_info = $smarty->fetch(SELECTED_TPL . '/product_reviews_info.tpl', $cache_id); 
  
  $smarty->assign('central_contents', $output_product_reviews_info);  
  
  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
endif;
?>
