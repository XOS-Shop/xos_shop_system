<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : reviews.php
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
//              filename: reviews.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_REVIEWS) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'update':
        $reviews_id = xos_db_prepare_input($_GET['rID']);
        $reviews_rating = xos_db_prepare_input($_POST['reviews_rating']);
        $reviews_text = xos_db_prepare_input(substr(strip_tags($_POST['reviews_text']), 0, 1000));

        xos_db_query("update " . TABLE_REVIEWS . " set reviews_rating = '" . xos_db_input($reviews_rating) . "', last_modified = now() where reviews_id = '" . (int)$reviews_id . "'");
        xos_db_query("update " . TABLE_REVIEWS_DESCRIPTION . " set reviews_text = '" . xos_db_input($reviews_text) . "' where reviews_id = '" . (int)$reviews_id . "'");
        
        $smarty_cache_control->clearCache(null, 'L3|cc_reviews');
        $smarty_cache_control->clearCache(null, 'L3|cc_product_reviews');
        $smarty_cache_control->clearCache(null, 'L3|cc_product_reviews_info');
        
        xos_redirect(xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $reviews_id));
        break;
      case 'deleteconfirm':
        $reviews_id = xos_db_prepare_input($_GET['rID']);

        xos_db_query("delete from " . TABLE_REVIEWS . " where reviews_id = '" . (int)$reviews_id . "'");
        xos_db_query("delete from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$reviews_id . "'");

        $smarty_cache_control->clearCache(null, 'L3|cc_reviews');
        $smarty_cache_control->clearCache(null, 'L3|cc_product_reviews');
        $smarty_cache_control->clearCache(null, 'L3|cc_product_reviews_info');

        xos_redirect(xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page']));
        break;
    }
  }
  
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');    

  if ($action == 'edit') {
    $rID = xos_db_prepare_input($_GET['rID']);

    $reviews_query = xos_db_query("select r.reviews_id, r.products_id, r.customers_name, r.date_added, r.last_modified, r.reviews_read, rd.reviews_text, r.reviews_rating from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$rID . "' and r.reviews_id = rd.reviews_id");
    $reviews = xos_db_fetch_array($reviews_query);

    $products_query = xos_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$reviews['products_id'] . "'");
    $products = xos_db_fetch_array($products_query);

    $products_name_query = xos_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$reviews['products_id'] . "' and language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
    $products_name = xos_db_fetch_array($products_name_query);

    $rInfo_array = array_merge((array)$reviews, (array)$products, (array)$products_name);
    $rInfo = new objectInfo($rInfo_array);
    
    $product_image = xos_get_product_images($rInfo->products_image);    

    $reviews_rating = '';
    for ($i=1; $i<=5; $i++) {
    $reviews_rating .= xos_draw_radio_field('reviews_rating', $i, '', $rInfo->reviews_rating);
    }  

    if ($product_image['name']) {
      $smarty->assign('products_image', xos_image(DIR_WS_CATALOG_IMAGES . 'products/medium/' . $product_image['name'], $rInfo->products_name, '', '', 'style="margin: 5px;"'));
    }

    $smarty->assign(array('edit' => true,
                          'form_begin_review' => xos_draw_form('review', FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $_GET['rID'] . '&action=preview'),
                          'products_name' => $rInfo->products_name,
                          'customers_name' => $rInfo->customers_name,
                          'date_added' => xos_date_short($rInfo->date_added),
                          'textarea_reviews_text' => xos_draw_textarea_field('reviews_text', '60', '15', $rInfo->reviews_text),
                          'hidden_reviews_id' => xos_draw_hidden_field('reviews_id', $rInfo->reviews_id),
                          'hidden_products_id' => xos_draw_hidden_field('products_id', $rInfo->products_id),
                          'hidden_customers_name' => xos_draw_hidden_field('customers_name', $rInfo->customers_name),
                          'hidden_products_name' => xos_draw_hidden_field('products_name', $rInfo->products_name),
                          'hidden_products_image' => xos_draw_hidden_field('products_image', $rInfo->products_image),
                          'hidden_date_added' => xos_draw_hidden_field('date_added', $rInfo->date_added),
                          'link_filename_reviews_cancel' => xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $_GET['rID']),
                          'reviews_rating' => $reviews_rating,
                          'form_end' => '</form>'));

  } elseif ($action == 'preview') {
    if (xos_not_null($_POST)) {
      $rInfo = new objectInfo($_POST);
    } else {
      $rID = xos_db_prepare_input($_GET['rID']);

      $reviews_query = xos_db_query("select r.reviews_id, r.products_id, r.customers_name, r.date_added, r.last_modified, r.reviews_read, rd.reviews_text, r.reviews_rating from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$rID . "' and r.reviews_id = rd.reviews_id");
      $reviews = xos_db_fetch_array($reviews_query);

      $products_query = xos_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$reviews['products_id'] . "'");
      $products = xos_db_fetch_array($products_query);

      $products_name_query = xos_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$reviews['products_id'] . "' and language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
      $products_name = xos_db_fetch_array($products_name_query);

      $rInfo_array = array_merge((array)$reviews, (array)$products, (array)$products_name);
      $rInfo = new objectInfo($rInfo_array);
    }
    
    $product_image = xos_get_product_images($rInfo->products_image);    

    if (xos_not_null($_POST)) {
/* Re-Post all POST'ed variables */
      reset($_POST);
      $hidden_post_values = '';
      while(list($key, $value) = each($_POST)) {
        $hidden_post_values .= xos_draw_hidden_field($key, htmlspecialchars(stripslashes($value))); 
      }
      
      $smarty->assign(array('hidden_post_values' => $hidden_post_values,
                            'link_filename_reviews_back_edit' => xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=edit'),
                            'link_filename_reviews_cancel' => xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id)));

    } else {
      if (isset($_GET['origin'])) {
        $back_url = $_GET['origin'];
        $back_url_params = '';
      } else {
        $back_url = FILENAME_REVIEWS;
        $back_url_params = 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id;
      }
      
      $smarty->assign('link_filename_reviews_back', xos_href_link($back_url, $back_url_params));
    } 

    if ($product_image['name']) {
      $smarty->assign('products_image', xos_image(DIR_WS_CATALOG_IMAGES . 'products/medium/' . $product_image['name'], $rInfo->products_name, '', '', 'style="margin: 5px;"'));
    }

    $smarty->assign(array('preview' => true,
                          'form_begin_update' => xos_draw_form('update', FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $_GET['rID'] . '&action=update', 'post', 'enctype="multipart/form-data"'),
                          'products_name' => $rInfo->products_name,
                          'customers_name' => $rInfo->customers_name,
                          'date_added' => xos_date_short($rInfo->date_added),
                          'reviews_text' => xos_break_string(nl2br(xos_db_output(substr(strip_tags(isset($_POST['reviews_text']) ? $_POST['reviews_text'] : $rInfo->reviews_text), 0, 1000))), 60),
                          'stars_image' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/stars_' . $rInfo->reviews_rating . '.gif', sprintf(TEXT_OF_5_STARS, $rInfo->reviews_rating)),
                          'text_of_5_stars' => sprintf(TEXT_OF_5_STARS, $rInfo->reviews_rating),
                          'form_end' => '</form>'));   
    
  } else {

    $reviews_query_raw = "select reviews_id, products_id, date_added, last_modified, reviews_rating from " . TABLE_REVIEWS . " order by date_added DESC";
    $reviews_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $reviews_query_raw, $reviews_query_numrows);
    $reviews_query = xos_db_query($reviews_query_raw);
    $reviews_array = array();
    while ($reviews = xos_db_fetch_array($reviews_query)) {
      if ((!isset($_GET['rID']) || (isset($_GET['rID']) && ($_GET['rID'] == $reviews['reviews_id']))) && !isset($rInfo)) {
        $reviews_text_query = xos_db_query("select r.reviews_read, r.customers_name, length(rd.reviews_text) as reviews_text_size from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$reviews['reviews_id'] . "' and r.reviews_id = rd.reviews_id");
        $reviews_text = xos_db_fetch_array($reviews_text_query);

        $products_image_query = xos_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$reviews['products_id'] . "'");
        $products_image = xos_db_fetch_array($products_image_query);

        $products_name_query = xos_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$reviews['products_id'] . "' and language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
        $products_name = xos_db_fetch_array($products_name_query);

        $reviews_average_query = xos_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from " . TABLE_REVIEWS . " where products_id = '" . (int)$reviews['products_id'] . "'");
        $reviews_average = xos_db_fetch_array($reviews_average_query);

        $review_info = array_merge((array)$reviews_text, (array)$reviews_average, (array)$products_name);
        $rInfo_array = array_merge((array)$reviews, (array)$review_info, (array)$products_image);
        $rInfo = new objectInfo($rInfo_array);
      }
      
      $selected = false;
      
      if (isset($rInfo) && is_object($rInfo) && ($reviews['reviews_id'] == $rInfo->reviews_id) ) {
        $selected = true;
        $link_filename_reviews = xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=preview');
      } else {
        $link_filename_reviews = xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $reviews['reviews_id']);
      }

      $reviews_array[]=array('selected' => $selected,
                             'link_filename_reviews_review' => xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $reviews['reviews_id'] . '&action=preview'),
                             'products_name' => xos_get_products_name($reviews['products_id']),
                             'stars_image' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/stars_' . $reviews['reviews_rating'] . '.gif'), 
                             'date_added' => xos_date_short($reviews['date_added']),
                             'link_filename_reviews' => $link_filename_reviews);
    }
    
    $smarty->assign(array('reviews' => $reviews_array,
                          'nav_bar_number' => $reviews_split->display_count($reviews_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_REVIEWS),
                          'nav_bar_result' => $reviews_split->display_links($reviews_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));   

    require(DIR_WS_BOXES . 'infobox_reviews.php');

  }
  
  $smarty->assign('BODY_TAG_PARAMS', 'onload="SetFocus();"');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'reviews');
  $output_reviews = $smarty->fetch(ADMIN_TPL . '/reviews.tpl');
  
  $smarty->assign('central_contents', $output_reviews);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
