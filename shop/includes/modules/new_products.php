<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : new_products.php
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
//              filename: new_products.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/modules/new_products.php') == 'overwrite_all')) :
  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
    $new_products_query = $DB->prepare
    (
     "SELECT DISTINCT p.products_id,
                      p.products_image,
                      pd.products_name,
                      pd.products_info,
                      p.products_tax_class_id,
                      p.products_price,
                      p.products_date_added                                            
      FROM            " . TABLE_PRODUCTS . " p,
                      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                      " . TABLE_CATEGORIES_OR_PAGES . " c
      WHERE           c.categories_or_pages_status = '1'
      AND             p.products_id = p2c.products_id
      AND             p2c.categories_or_pages_id = c.categories_or_pages_id
      AND             p.products_id = pd.products_id
      AND             pd.language_id = :languages_id
      AND             p.products_status = '1'
      AND             p.products_date_added > '".date("Y-m-d", mktime(1, 1, 1, date("m"), date("d") - INTERVAL_DAYS_BACK, date("Y")))."'
      ORDER BY        p.products_date_added DESC,
                      pd.products_name
      LIMIT           " . MAX_DISPLAY_NEW_PRODUCTS
    );
    
    $DB->perform($new_products_query, array(':languages_id' => (int)$_SESSION['languages_id']));
           
  } else { 

    function xos_get_categories_string($parent_id = '', $entrance = false, $categories_string = '') {

      $DB = Registry::get('DB');
      if ($entrance) {
        $categories_string = " c.parent_id = '" . $parent_id . "'";
      }
      $categories_query = $DB->prepare
      (
       "SELECT   c.categories_or_pages_id,
                 cpd.categories_or_pages_name,
                 c.parent_id
        FROM     " . TABLE_CATEGORIES_OR_PAGES . " c,
                 " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd
        WHERE    c.categories_or_pages_id = cpd.categories_or_pages_id
        AND      cpd.language_id = :languages_id
        AND      c.parent_id = :parent_id
        ORDER BY c.sort_order,
                 cpd.categories_or_pages_name"
      );
      
      $DB->perform($categories_query, array(':languages_id' => (int)$_SESSION['languages_id'],
                                            ':parent_id' => (int)$parent_id));
                                            
      while ($categories = $categories_query->fetch()) {
        $categories_string .= " or c.parent_id = '" . $categories['categories_or_pages_id'] . "'";
        $categories_string = xos_get_categories_string($categories['categories_or_pages_id'], '', $categories_string);
      }
      return $categories_string;
    }
 
    $includes_categories = xos_get_categories_string($new_products_category_id, true);
   
    $new_products_query = $DB->prepare
    (
     "SELECT DISTINCT p.products_id,
                      p.products_image,
                      pd.products_name,
                      pd.products_info,
                      p.products_tax_class_id,
                      p.products_price,
                      p.products_date_added                                            
      FROM            " . TABLE_PRODUCTS . " p,
                      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                      " . TABLE_CATEGORIES_OR_PAGES . " c
      WHERE           c.categories_or_pages_status = '1'
      AND             p.products_id = pd.products_id
      AND             pd.language_id = :languages_id
      AND             p.products_id = p2c.products_id
      AND             p2c.categories_or_pages_id = c.categories_or_pages_id
      AND             (
                      " . $includes_categories . "
                      )
      AND             p.products_status = '1'
      AND             p.products_date_added > '".date("Y-m-d", mktime(1, 1, 1, date("m"), date("d") - INTERVAL_DAYS_BACK, date("Y")))."'
      ORDER BY        p.products_date_added DESC,
                      pd.products_name
      LIMIT           " . MAX_DISPLAY_NEW_PRODUCTS
    );
    
    $DB->perform($new_products_query, array(':languages_id' => (int)$_SESSION['languages_id']));     
  }
  
  $num_new_products = $new_products_query->rowCount();
  if ($num_new_products > 0) {
  
    $new_products_array = array();
    while ($new_products = $new_products_query->fetch()) {

      $products_prices = xos_get_product_prices($new_products['products_price']);
      $products_tax_rate = xos_get_tax_rate($new_products['products_tax_class_id']);
      $new_price_breaks_array = array();
      if(isset($products_prices[$customer_group_id][0])) {     
        $new_product_price = $currencies->display_price($products_prices[$customer_group_id][0]['regular'], $products_tax_rate);
        $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][0]['special'] > 0 ? $new_product_price_special = $currencies->display_price($products_prices[$customer_group_id][0]['special'], $products_tax_rate) : $new_product_price_special = '';      
        $sizeof = count($products_prices[$customer_group_id]);
/*        
        if ($sizeof > 2) {
          $array_keys = array_keys($products_prices[$customer_group_id]);
          for ($count=2, $n=$sizeof; $count<$n; $count++) {
            $qty = $array_keys[$count];
            $new_price_breaks_array[]=array('qty' => $qty,
                                            'price_break' => $currencies->display_price($products_prices[$customer_group_id][$qty]['regular'], $products_tax_rate),
                                            'price_break_special' => $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][$qty]['special'] > 0 ? $currencies->display_price($products_prices[$customer_group_id][$qty]['special'], $products_tax_rate) : '');
          }       
        }
*/                    
      } else {      
        $new_product_price = $currencies->display_price($products_prices[0][0]['regular'], $products_tax_rate);
        $products_prices[0]['special_status'] == 1 && $products_prices[0][0]['special'] > 0 ? $new_product_price_special = $currencies->display_price($products_prices[0][0]['special'], $products_tax_rate) : $new_product_price_special = '';            
        $sizeof = count($products_prices[0]);
/*        
        if ($sizeof > 2) {      
          $array_keys = array_keys($products_prices[0]);
          for ($count=2, $n=$sizeof; $count<$n; $count++) {
            $qty = $array_keys[$count];
            $new_price_breaks_array[]=array('qty' => $qty,
                                            'price_break' => $currencies->display_price($products_prices[0][$qty]['regular'], $products_tax_rate),
                                            'price_break_special' => $products_prices[0]['special_status'] == 1 && $products_prices[0][$qty]['special'] > 0 ? $currencies->display_price($products_prices[0][$qty]['special'], $products_tax_rate) : '');                                      
          }                                           
        }
*/         
      }
      
      $new_products_image = xos_get_product_images($new_products['products_image']);
                                               
      $new_products_array[]=array('link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $new_products['products_id']),
                                  'image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($new_products_image['name']), $new_products['products_name']),
                                  'info' => $new_products['products_info'],
                                  'price' => $new_product_price,
                                  'price_special' => $new_product_price_special,
                                  'price_breaks' => $new_price_breaks_array,
                                  'tax_description' => xos_get_products_tax_description($new_products['products_tax_class_id'], $products_tax_rate),
                                  'name' => $new_products['products_name']); 
      unset($price_breaks_array);                              
    }
  
    $smarty->assign('new_products', $new_products_array);
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'new_products');
    $output_new_products = $smarty->fetch(SELECTED_TPL . '/includes/modules/new_products.tpl');
    $smarty->clearAssign('new_products');
      
    $smarty->assign('new_products', $output_new_products);
  }
endif;