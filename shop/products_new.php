<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : products_new.php
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
//              filename: products_new.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_PRODUCTS_NEW) == 'overwrite_all')) :
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_PRODUCTS_NEW);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_PRODUCTS_NEW, xos_get_all_get_params(array('lnc', 'cur', 'tpl', 'x', 'y'))));
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L3|cc_products_new|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['page'];
  }  
 
  if(!$smarty->isCached(SELECTED_TPL . '/products_new.tpl', $cache_id)){

    $products_new_query_raw = "SELECT DISTINCT p.products_id,
                                               p.products_delivery_time_id,
                                               pd.products_name,
                                               pd.products_p_unit,
                                               pd.products_info,
                                               p.products_model,
                                               p.products_quantity,
                                               p.products_image,
                                               p.products_price,
                                               p.products_tax_class_id,
                                               p.products_date_added,
                                               mi.manufacturers_name
                               FROM            " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                                               " . TABLE_CATEGORIES_OR_PAGES . " c,
                                               " . TABLE_PRODUCTS . " p
                               LEFT JOIN       " . TABLE_MANUFACTURERS_INFO . " mi
                               ON              ( 
                                                p.manufacturers_id = mi.manufacturers_id
                                                AND mi.languages_id = :languages_id
                                               ),
                                               " . TABLE_PRODUCTS_DESCRIPTION . " pd
                               WHERE           c.categories_or_pages_status = '1'
                               AND             p.products_id = p2c.products_id
                               AND             c.categories_or_pages_id = p2c.categories_or_pages_id
                               AND             p.products_status = '1'
                               AND             p.products_date_added > '".date("Y-m-d", mktime(1, 1, 1, date("m"), date("d") - INTERVAL_DAYS_BACK, date("Y")))."'
                               AND             p.products_id = pd.products_id
                               AND             pd.language_id = :languages_id
                               ORDER BY        p.products_date_added DESC,
                                               pd.products_name";
          
    $products_new_param_array[':languages_id'] = (int)$_SESSION['languages_id'];
    
    $products_new_split = new SplitPageResultsPDO($products_new_query_raw, MAX_DISPLAY_PRODUCTS_NEW, 'p.products_id', $products_new_param_array);
    $products_new_query = $DB->prepare($products_new_split->sql_query);
    $DB->perform($products_new_query, $products_new_split->sql_param); 

    if ($products_new_split->number_of_rows > 0) { // Anzahl der Detansaetze total
//  if ($products_new_query->rowCount() > 0) { // Anzahl der Detansaetze fuer diese Seite        
  
      $products_new_array = array();
      while ($products_new = $products_new_query->fetch()) {      
           
        $products_prices = xos_get_product_prices($products_new['products_price']);
        $products_tax_rate = xos_get_tax_rate($products_new['products_tax_class_id']);
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
        
        $product_image = xos_get_product_images($products_new['products_image']);
        $popup_content_id = xos_get_delivery_times_values($products_new['products_delivery_time_id'], 'popup_content_id'); 

        $products_new_array[]=array('link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $products_new['products_id']),
                                    'href_buy_now' => xos_href_link(FILENAME_PRODUCTS_NEW, xos_get_all_get_params(array('action')) . 'action=buy_now&p=' . $products_new['products_id']),
                                    'date_added' => xos_date_long($products_new['products_date_added']),
                                    'image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($product_image['name']), $products_new['products_name']),
                                    'td_width_img' => SMALL_PRODUCT_IMAGE_MAX_WIDTH + 10,
                                    'manufacturer' => $products_new['manufacturers_name'],
                                    'tax_description' => xos_get_products_tax_description($products_new['products_tax_class_id'], $products_tax_rate),
                                    'products_delivery_time' => xos_get_delivery_times_values($products_new['products_delivery_time_id']),
                                    'link_filename_popup_content_products_delivery_time' => $popup_content_id > 0 ? xos_href_link(FILENAME_POPUP_CONTENT, 'co=' . $popup_content_id . '&p=' . $products_new['products_id'], $request_type) : '',                                                                     
                                    'price' => $product_price,
                                    'price_special' => $product_price_special,
                                    'price_breaks' => $price_breaks_array,
                                    'info' => $products_new['products_info'],
                                    'products_p_unit' => $products_new['products_p_unit'],
                                    'products_model' => $products_new['products_model'],
                                    'products_quantity' => $products_new['products_quantity'],
                                    'name' => $products_new['products_name']);
        unset($price_breaks_array);                              
      }
    
      if (PREV_NEXT_BAR_LOCATION == '1' || PREV_NEXT_BAR_LOCATION == '3') {
        $smarty->assign('nav_bar_top', true);
      }
    
      if (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3') {  
        $smarty->assign('nav_bar_bottom', true);
      }

      $smarty->assign('new_products', true);   
    }

    $smarty->assign(array('nav_bar_number' => $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW),
                          'nav_bar_result' => TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'lnc', 'cur', 'tpl', 'x', 'y'))),
                          'nav_bar_result_in_pull_down_menu' => $products_new_split->display_links_in_pull_down_menu(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'lnc', 'cur', 'tpl', 'x', 'y'))),
                          'interval_days_back' => INTERVAL_DAYS_BACK,
                          'products_new' => $products_new_array));
                        
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'products_new');
  }
  
  $output_products_new = $smarty->fetch(SELECTED_TPL . '/products_new.tpl', $cache_id);
  
  $smarty->assign('central_contents', $output_products_new);  
  
  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;