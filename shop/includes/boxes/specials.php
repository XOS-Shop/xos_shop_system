<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : specials.php
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
//              filename: specials.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/specials.php') == 'overwrite_all')) : 
  if ($random_product = xos_random_select("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where c.categories_or_pages_status = '1' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and s.status = '1' and s.customers_group_id = '" . $customer_group_id . "' order by p.products_date_added DESC limit " . MAX_RANDOM_SELECT_SPECIALS)) {

    $products_prices = xos_get_product_prices($random_product['products_price']);
    $products_tax_rate = xos_get_tax_rate($random_product['products_tax_class_id']);
    $specials_price_breaks_array = array();
    if(isset($products_prices[$customer_group_id][0])) {     
      $specials_product_price = $currencies->display_price($products_prices[$customer_group_id][0]['regular'], $products_tax_rate);
      $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][0]['special'] > 0 ? $specials_product_price_special = $currencies->display_price($products_prices[$customer_group_id][0]['special'], $products_tax_rate) : $specials_product_price_special = '';      
      $sizeof = count($products_prices[$customer_group_id]);
/*      
      if ($sizeof > 2) {
        $array_keys = array_keys($products_prices[$customer_group_id]);
        for ($count=2, $n=$sizeof; $count<$n; $count++) {
          $qty = $array_keys[$count];
          $specials_price_breaks_array[]=array('qty' => $qty,
                                               'price_break' => $currencies->display_price($products_prices[$customer_group_id][$qty]['regular'], $products_tax_rate),
                                               'price_break_special' => $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][$qty]['special'] > 0 ? $currencies->display_price($products_prices[$customer_group_id][$qty]['special'], $products_tax_rate) : '');
        }       
      }
*/                  
    } else {      
      $specials_product_price = $currencies->display_price($products_prices[0][0]['regular'], $products_tax_rate);
      $products_prices[0]['special_status'] == 1 && $products_prices[0][0]['special'] > 0 ? $specials_product_price_special = $currencies->display_price($products_prices[0][0]['special'], $products_tax_rate) : $specials_product_price_special = '';            
      $sizeof = count($products_prices[0]);
/*      
      if ($sizeof > 2) {      
        $array_keys = array_keys($products_prices[0]);
        for ($count=2, $n=$sizeof; $count<$n; $count++) {
          $qty = $array_keys[$count];
          $specials_price_breaks_array[]=array('qty' => $qty,
                                               'price_break' => $currencies->display_price($products_prices[0][$qty]['regular'], $products_tax_rate),
                                               'price_break_special' => $products_prices[0]['special_status'] == 1 && $products_prices[0][$qty]['special'] > 0 ? $currencies->display_price($products_prices[0][$qty]['special'], $products_tax_rate) : '');                                      
        }                                           
      } 
*/      
    }
    
    $random_special_product_image = xos_get_product_images($random_product['products_image']);                                              

    $smarty->assign(array('box_specials_link_filename_specials' => xos_href_link(FILENAME_SPECIALS),
                          'box_specials_link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"]),
                          'box_specials_product_image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($random_special_product_image['name']), $random_product['products_name']),
                          'box_specials_product_name' => $random_product['products_name'],
                          'box_specials_product_price' => $specials_product_price,
                          'box_specials_product_price_special' => $specials_product_price_special,
                          'box_specials_products_tax_description' => xos_get_products_tax_description($random_product['products_tax_class_id'], $products_tax_rate),
                          'box_specials_product_price_breaks' => $specials_price_breaks_array));
    $output_specials = $smarty->fetch(SELECTED_TPL . '/includes/boxes/specials.tpl');
                          
    $smarty->assign('box_specials', $output_specials);
  }
endif;
?>
