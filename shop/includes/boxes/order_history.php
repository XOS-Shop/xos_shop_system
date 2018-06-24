<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : order_history.php
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
//              filename: order_history.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/order_history.php') == 'overwrite_all')) : 
  if (isset($_SESSION['customer_id'])) {
// retreive the last x products purchased
    $orders_query = $DB->prepare
    (
     "SELECT DISTINCT op.products_id,
                      o.date_purchased
      FROM            " . TABLE_ORDERS . " o,
                      " . TABLE_ORDERS_PRODUCTS . " op,
                      " . TABLE_PRODUCTS . " p,
                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                      " . TABLE_CATEGORIES_OR_PAGES . " c
      WHERE           o.customers_id = :customer_id 
      AND             o.orders_id = op.orders_id
      AND             op.products_id = p.products_id
      AND             op.products_id = p2c.products_id
      AND             p2c.categories_or_pages_id = c.categories_or_pages_id
      AND             c.categories_or_pages_status = '1'
      AND             p.products_status = '1'
      GROUP BY        products_id, o.date_purchased
      ORDER BY        o.date_purchased DESC
      LIMIT           " . MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX
    );
    
    $DB->perform($orders_query, array(':customer_id' => (int)$_SESSION['customer_id']));
                
    if ($orders_query->rowCount()) {

      $product_ids = '';
      while ($orders = $orders_query->fetch()) {
        $product_ids .= (int)$orders['products_id'] . ',';
      }
      $product_ids = substr($product_ids, 0, -1);

      $products_query = $DB->prepare
      (
       "SELECT   products_id,
                 products_name
        FROM     " . TABLE_PRODUCTS_DESCRIPTION . "
        WHERE    products_id 
        IN       (
                 " . $product_ids . "
                 )
        AND      language_id = :languages_id
        ORDER BY products_name"
      );
      
      $DB->perform($products_query, array(':languages_id' => (int)$_SESSION['languages_id']));            
      
      $customer_orders_array = array();
      while ($products = $products_query->fetch()) {                                    
        $customer_orders_array[]=array('in_cart' => xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('action')) . 'action=cust_order&pid=' . $products['products_id']),
                                       'link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $products['products_id']),
                                       'name' => $products['products_name']);                                   
      }
      
      $smarty->assign('box_order_history_customer_orders', $customer_orders_array);
      $output_order_history = $smarty->fetch(SELECTED_TPL . '/includes/boxes/order_history.tpl');
      
      $smarty->assign('box_order_history', $output_order_history);
    }
  }
endif;
?>
