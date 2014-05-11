<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : shopping_cart.php
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
//              filename: shopping_cart.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/shopping_cart.php') == 'overwrite_all')) : 
  if ($_SESSION['cart']->count_contents() > 0) {
    $products = $_SESSION['cart']->get_products();
    if ($_SESSION['sppc_customer_group_discount'] > 0) {
      $smarty->assign(array('box_shopping_cart_total_discount_value' => $_SESSION['sppc_customer_group_discount'] . '%',
                            'box_shopping_cart_total_discount' => $currencies->format($_SESSION['cart']->show_discount($currencies->currencies[$_SESSION['currency']]['value']))));
    }    
    $smarty->assign('box_shopping_cart_total_price', $currencies->format($_SESSION['cart']->show_total($currencies->currencies[$_SESSION['currency']]['value'])));
    $cart_products_array = array();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if ((isset($_SESSION['new_products_id_in_cart'])) && ($_SESSION['new_products_id_in_cart'] == $products[$i]['id'])) {
        $new_product_in_cart = true;
        unset($_SESSION['new_products_id_in_cart']);        
      } else {
        $new_product_in_cart = false;
      }      
      $cart_products_array[]=array('quantity' => $products[$i]['quantity'],
                                   'link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . urlencode($products[$i]['id'])),
                                   'name' => $products[$i]['name'],
                                   'new_product_in_cart' => $new_product_in_cart);      
    }
    
    $smarty->assign('shopping_cart_will_not_display', FILENAME_SHOPPING_CART == basename($_SERVER['PHP_SELF']) ? false : true);
  } else {
    $smarty->assign('box_shopping_cart_cart_empty', true);
  }
  
    $smarty->assign(array('box_shopping_cart_link_filename_shopping_cart' => xos_href_link(FILENAME_SHOPPING_CART),
                          'box_shopping_cart_cart_products' => $cart_products_array));
    $output_shopping_cart = $smarty->fetch(SELECTED_TPL . '/includes/boxes/shopping_cart.tpl');
                          
    $smarty->assign('box_shopping_cart', $output_shopping_cart); 
endif;
?>
