<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : also_purchased_products.php
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
//              filename: also_purchased_products.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/modules/also_purchased_products.php') == 'overwrite_all')) :
  if (isset($_GET['products_id'])) { 
    $orders_query = xos_db_query("select p.products_id, p.products_image, pd.products_name, pd.products_info, p.products_tax_class_id, p.products_price from " . TABLE_ORDERS_PRODUCTS . " opa, " . TABLE_ORDERS_PRODUCTS . " opb, " . TABLE_ORDERS . " o, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where c.categories_or_pages_status = '1' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and opa.products_id = '" . (int)$_GET['products_id'] . "' and opa.orders_id = opb.orders_id and opb.products_id != '" . (int)$_GET['products_id'] . "' and opb.products_id = p.products_id and opb.orders_id = o.orders_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_status = '1' group by p.products_id order by o.date_purchased desc limit " . MAX_DISPLAY_ALSO_PURCHASED);
    $num_products_ordered = xos_db_num_rows($orders_query);
    if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED) {
    
      $also_purchased_products_array = array();
      while ($orders = xos_db_fetch_array($orders_query)) {

        $products_prices = xos_get_product_prices($orders['products_price']);
        $products_tax_rate = xos_get_tax_rate($orders['products_tax_class_id']);
        $orders_price_breaks_array = array();
        if(isset($products_prices[$customer_group_id][0])) {     
          $orders_product_price = $currencies->display_price($products_prices[$customer_group_id][0]['regular'], $products_tax_rate);
          $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][0]['special'] > 0 ? $orders_product_price_special = $currencies->display_price($products_prices[$customer_group_id][0]['special'], $products_tax_rate) : $orders_product_price_special = '';      
          $sizeof = count($products_prices[$customer_group_id]);
/*          
          if ($sizeof > 2) {
            $array_keys = array_keys($products_prices[$customer_group_id]);
            for ($count=2, $n=$sizeof; $count<$n; $count++) {
              $qty = $array_keys[$count];
              $orders_price_breaks_array[]=array('qty' => $qty,
                                                'price_break' => $currencies->display_price($products_prices[$customer_group_id][$qty]['regular'], $products_tax_rate),
                                                'price_break_special' => $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][$qty]['special'] > 0 ? $currencies->display_price($products_prices[$customer_group_id][$qty]['special'], $products_tax_rate) : '');
            }       
          }
*/                      
        } else {      
          $orders_product_price = $currencies->display_price($products_prices[0][0]['regular'], $products_tax_rate);
          $products_prices[0]['special_status'] == 1 && $products_prices[0][0]['special'] > 0 ? $orders_product_price_special = $currencies->display_price($products_prices[0][0]['special'], $products_tax_rate) : $orders_product_price_special = '';            
          $sizeof = count($products_prices[0]);
/*          
          if ($sizeof > 2) {      
            $array_keys = array_keys($products_prices[0]);
            for ($count=2, $n=$sizeof; $count<$n; $count++) {
              $qty = $array_keys[$count];
              $orders_price_breaks_array[]=array('qty' => $qty,
                                                'price_break' => $currencies->display_price($products_prices[0][$qty]['regular'], $products_tax_rate),
                                                'price_break_special' => $products_prices[0]['special_status'] == 1 && $products_prices[0][$qty]['special'] > 0 ? $currencies->display_price($products_prices[0][$qty]['special'], $products_tax_rate) : '');                                      
            }                                           
          }
*/           
        }
        
        $orders_products_image = xos_get_product_images($orders['products_image']);      
                                               
        $also_purchased_products_array[]=array('link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $orders['products_id']),
                                               'image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($orders_products_image['name']), $orders['products_name']),
                                               'info' => $orders['products_info'],
                                               'price' => $orders_product_price,
                                               'price_special' => $orders_product_price_special,
                                               'price_breaks' => $orders_price_breaks_array,
                                               'tax_description' => xos_get_products_tax_description($orders['products_tax_class_id'], $products_tax_rate), 
                                               'name' => $orders['products_name']);
      }
      
      $smarty->assign('also_purchased_products', $also_purchased_products_array);
      $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'also_purchased_products');
      $output_also_purchased_products = $smarty->fetch(SELECTED_TPL . '/includes/modules/also_purchased_products.tpl');
      $smarty->clearAssign('also_purchased_products');
      
      $smarty->assign('also_purchased_products', $output_also_purchased_products);
    }
  }
endif;  
?>
