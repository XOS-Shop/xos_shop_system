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
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_REVIEWS) == 'overwrite_all')) : 
  if (PRODUCT_REVIEWS_ENABLED != 'true') {
    xos_redirect(xos_href_link(FILENAME_DEFAULT), false);
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_REVIEWS);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_REVIEWS, xos_get_all_get_params(array('lnc', 'cur', 'tpl', 'x', 'y'))));
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L3|cc_reviews|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'];
  }
     
  if(!$smarty->isCached(SELECTED_TPL . '/reviews.tpl', $cache_id)) {

    $reviews_query_raw = "SELECT   r.reviews_id,
                          LEFT     (rd.reviews_text, 100) AS reviews_text,
                                   r.reviews_rating,
                                   r.date_added,
                                   p.products_id,
                                   pd.products_name,
                                   p.products_image,
                                   r.customers_name
                          FROM     " . TABLE_REVIEWS . " r,
                                   " . TABLE_REVIEWS_DESCRIPTION . " rd,
                                   " . TABLE_PRODUCTS . " p,
                                   " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                   " . TABLE_CATEGORIES_OR_PAGES . " c,
                                   " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                          WHERE    c.categories_or_pages_status = '1'
                          AND      p.products_id = p2c.products_id
                          AND      p2c.categories_or_pages_id = c.categories_or_pages_id
                          AND      p.products_status = '1'
                          AND      p.products_id = r.products_id
                          AND      r.reviews_id = rd.reviews_id
                          AND      p.products_id = pd.products_id
                          AND      pd.language_id = :languages_id
                          AND      rd.languages_id = :languages_id
                          ORDER BY r.reviews_id DESC";
 
    $reviews_param_array[':languages_id'] = (int)$_SESSION['languages_id'];
    
    $reviews_split = new SplitPageResultsPDO($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS, '*', $reviews_param_array);   
    $reviews_query = $DB->prepare($reviews_split->sql_query);
    $DB->perform($reviews_query, $reviews_split->sql_param);

    if ($reviews_split->number_of_rows > 0) { // Anzahl der Detansaetze total
//  if ($reviews_query->rowCount() > 0) { // Anzahl der Detansaetze fuer diese Seite

      $reviews_array = array();
      while ($reviews = $reviews_query->fetch()) { 
        
        $product_image = xos_get_product_images($reviews['products_image']);
          
        $reviews_array[]=array('link_filename_product_reviews_info' => xos_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'p=' . $reviews['products_id'] . '&r=' . $reviews['reviews_id']),
                                'date_added' => xos_date_long($reviews['date_added']),
                                'products_image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($product_image['name']), $reviews['products_name']),
                                'td_width_img' => SMALL_PRODUCT_IMAGE_MAX_WIDTH + 10,
                                'reviews_rating' => $reviews['reviews_rating'],
                                'review_text' => xos_break_string(xos_output_string_protected($reviews['reviews_text']), 60, '-<br />'),
                                'stars_image' => xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/stars_' . $reviews['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])),
                                'customers_name' => xos_output_string_protected($reviews['customers_name']),
                                'products_name' => $reviews['products_name']);
      }
    
      if (PREV_NEXT_BAR_LOCATION == '1' || PREV_NEXT_BAR_LOCATION == '3') {
        $smarty->assign('nav_bar_top', true);    
      }
    
      if (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3') {
        $smarty->assign('nav_bar_bottom', true);  
      }    
    
      $smarty->assign('reviews', true);    
    }

    $smarty->assign(array('nav_bar_number' => $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS),
                          'nav_bar_result' => TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'lnc', 'cur', 'tpl', 'x', 'y'))),
                          'nav_bar_result_in_pull_down_menu' => $reviews_split->display_links_in_pull_down_menu(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'lnc', 'cur', 'tpl', 'x', 'y'))),
                          'reviews_array' => $reviews_array));
                        
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'reviews');
  }
  
  $output_reviews = $smarty->fetch(SELECTED_TPL . '/reviews.tpl', $cache_id); 
  
  $smarty->assign('central_contents', $output_reviews);  
  
  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
endif;