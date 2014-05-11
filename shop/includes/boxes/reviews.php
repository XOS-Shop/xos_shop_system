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

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/reviews.php') == 'overwrite_all')) :   
  $allowed = true;
  if (isset($_GET['products_id'])) {
    $allowed_product_query = xos_db_query("select p.products_id total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES_OR_PAGES . " c where p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and c.categories_or_pages_status = '1' and p.products_status = '1'");
    if (!xos_db_num_rows($allowed_product_query)) $allowed = false;
  }

  if ($allowed == true) {
    $random_select = "select r.reviews_id, r.reviews_rating, p.products_id, p.products_image, pd.products_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where c.categories_or_pages_status='1' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
    if (isset($_GET['products_id'])) {
      $random_select .= " and p.products_id = '" . (int)$_GET['products_id'] . "'";
    }
    $random_select .= " order by r.reviews_id desc limit " . MAX_RANDOM_SELECT_REVIEWS;
    $random_product = xos_random_select($random_select);

    if ($random_product) {
// display random review box
      $rand_review_query = xos_db_query("select substring(reviews_text, 1, 70) as reviews_text from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$random_product['reviews_id'] . "' and languages_id = '" . (int)$_SESSION['languages_id'] . "'");
      $rand_review = xos_db_fetch_array($rand_review_query);

      $rand_review_text = xos_break_string(xos_output_string_protected($rand_review['reviews_text']), 20, '-<br />');
      $random_review_product_image = xos_get_product_images($random_product['products_image']);
 
      $smarty->assign(array('box_reviews_link_filename_product_reviews_info' => xos_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $random_product['products_id'] . '&reviews_id=' . $random_product['reviews_id']),
                            'box_reviews_product_image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($random_review_product_image['name']), $random_product['products_name']),
                            'box_reviews_review_text' => strip_tags($rand_review_text),
                            'box_reviews_stars_image' => xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/stars_' . $random_product['reviews_rating'] . '.gif' , sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $random_product['reviews_rating']))));
    
    } elseif (isset($_GET['products_id'])) {
// display 'write a review' box
      $smarty->assign(array('box_reviews_link_filename_product_reviews_write' => xos_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'products_id=' . $_GET['products_id'], 'SSL'),
                            'box_reviews_write_review_image' => xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/box_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW)));
    }
 
    $smarty->assign('box_reviews_link_filename_reviews', xos_href_link(FILENAME_REVIEWS));  
    $output_reviews = $smarty->fetch(SELECTED_TPL . '/includes/boxes/reviews.tpl');
                        
    $smarty->assign('box_reviews', $output_reviews);
  }
endif;
?>
