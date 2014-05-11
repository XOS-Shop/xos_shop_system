<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : xsell_products.php
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
//              filename: xsell_products.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/modules/xsell_products.php') == 'overwrite_all')) :
  if (isset($_GET['products_id'])) {
    $xsell_query = xos_db_query("select distinct p.products_id, p.products_image, pd.products_name, pd.products_info, p.products_tax_class_id, p.products_price from " . TABLE_PRODUCTS_XSELL . " xp, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where xp.products_id = '" . (int)$_GET['products_id'] . "' and xp.xsell_id = p.products_id and p.products_id = pd.products_id and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_status = '1' and c.categories_or_pages_status = '1' order by xp.sort_order ");  
    $num_products_xsell = xos_db_num_rows($xsell_query);
    if ($num_products_xsell > 0) {
    
      $xsell_products_array = array();
      while ($xsell = xos_db_fetch_array($xsell_query)) { 
      
        $products_prices = xos_get_product_prices($xsell['products_price']);
        $products_tax_rate = xos_get_tax_rate($xsell['products_tax_class_id']);
        $xsell_price_breaks_array = array();
        if(isset($products_prices[$customer_group_id][0])) {     
          $xsell_product_price = $currencies->display_price($products_prices[$customer_group_id][0]['regular'], $products_tax_rate);
          $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][0]['special'] > 0 ? $xsell_product_price_special = $currencies->display_price($products_prices[$customer_group_id][0]['special'], $products_tax_rate) : $xsell_product_price_special = '';      
          $sizeof = count($products_prices[$customer_group_id]);
/*          
          if ($sizeof > 2) {
            $array_keys = array_keys($products_prices[$customer_group_id]);
            for ($count=2, $n=$sizeof; $count<$n; $count++) {
              $qty = $array_keys[$count];
              $xsell_price_breaks_array[]=array('qty' => $qty,
                                                'price_break' => $currencies->display_price($products_prices[$customer_group_id][$qty]['regular'], $products_tax_rate),
                                                'price_break_special' => $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][$qty]['special'] > 0 ? $currencies->display_price($products_prices[$customer_group_id][$qty]['special'], $products_tax_rate) : '');
            }       
          }
*/                      
        } else {      
          $xsell_product_price = $currencies->display_price($products_prices[0][0]['regular'], $products_tax_rate);
          $products_prices[0]['special_status'] == 1 && $products_prices[0][0]['special'] > 0 ? $xsell_product_price_special = $currencies->display_price($products_prices[0][0]['special'], $products_tax_rate) : $xsell_product_price_special = '';            
          $sizeof = count($products_prices[0]);
/*          
          if ($sizeof > 2) {      
            $array_keys = array_keys($products_prices[0]);
            for ($count=2, $n=$sizeof; $count<$n; $count++) {
              $qty = $array_keys[$count];
              $xsell_price_breaks_array[]=array('qty' => $qty,
                                                'price_break' => $currencies->display_price($products_prices[0][$qty]['regular'], $products_tax_rate),
                                                'price_break_special' => $products_prices[0]['special_status'] == 1 && $products_prices[0][$qty]['special'] > 0 ? $currencies->display_price($products_prices[0][$qty]['special'], $products_tax_rate) : '');                                      
            }                                           
          } 
*/          
        }
        
        $xsell_products_image = xos_get_product_images($xsell['products_image']);     
                                               
        $xsell_products_array[]=array('link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']),
                                      'image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($xsell_products_image['name']), $xsell['products_name']),
                                      'info' => $xsell['products_info'],
                                      'price' => $xsell_product_price,
                                      'price_special' => $xsell_product_price_special,
                                      'price_breaks' => $xsell_price_breaks_array,
                                      'tax_description' => xos_get_products_tax_description($xsell['products_tax_class_id'], $products_tax_rate),
                                      'name' => $xsell['products_name']);
      }
      
      $smarty->assign('xsell_products', $xsell_products_array);
      $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'xsell_products');
      $output_xsell_products = $smarty->fetch(SELECTED_TPL . '/includes/modules/xsell_products.tpl');
      $smarty->clearAssign('xsell_products');
      
      $smarty->assign('xsell_products', $output_xsell_products);
    }
  }
endif;  
?>
