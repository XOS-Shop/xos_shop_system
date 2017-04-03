<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : update_options.php
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
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  die('not in use');  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_UPDATE_OPTIONS) == 'overwrite_all')) : 
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_PRODUCT_INFO);
  
  $_SESSION['navigation']->remove_current_page();
  
  usleep(300000);
  
  if (xos_has_product_attributes((int)$_GET['p'])) {
    
    $product_info_query = $DB->prepare
    (
     "SELECT products_tax_class_id,
             attributes_quantity,
             attributes_combinations
      FROM   " . TABLE_PRODUCTS . "
      WHERE  products_status = '1'
      AND    products_id = :p"
    );
    
    $DB->perform($product_info_query, array(':p' => (int)$_GET['p'])); 
                                           
    $product_info = $product_info_query->fetch();
                  
    xos_not_null($product_info['attributes_combinations']) ? $combinations_string = $product_info['attributes_combinations'] : $combinations_string = '';
    $attributes_quantity = xos_get_attributes_quantity($product_info['attributes_quantity']);
    $products_tax_rate = xos_get_tax_rate($product_info['products_tax_class_id']);
        
    if (xos_not_null($attributes_quantity) && $combinations_string != '' && STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
      $combination_elements = explode('|', $combinations_string);
                              
      for ($i=0, $n=sizeof($combination_elements); $i<$n; $i++) {
        if ($attributes_quantity[$combination_elements[$i]] < 1) unset($combination_elements[$i]);
      }
          
      ksort($combination_elements);
      $combinations_string = implode('|', $combination_elements);
      $combinations_string .= '|'; 
    }             
      
    $combi_str = '';
    $comb_str = '';     
    $product_options_array = array();
    
    $products_options_name_query = $DB->prepare
    (
     "SELECT DISTINCT popt.products_options_id,
                      popt.products_options_name
      FROM            " . TABLE_PRODUCTS_OPTIONS . " popt,
                      " . TABLE_PRODUCTS_ATTRIBUTES . " patrib
      WHERE           patrib.products_id = :p
      AND             patrib.options_id = popt.products_options_id
      AND             popt.language_id = :languages_id
      ORDER BY        patrib.options_sort_order,
                      popt.products_options_id"
    );
    
    $DB->perform($products_options_name_query, array(':p' => (int)$_GET['p'],
                                                     ':languages_id' => (int)$_SESSION['languages_id'])); 
                                                                                                          
    $products_options_query = $DB->prepare
    (
     "SELECT   pov.products_options_values_id,
               pov.products_options_values_name,
               pa.options_values_sort_order,
               pa.options_values_price,
               pa.price_prefix
      FROM     " . TABLE_PRODUCTS_ATTRIBUTES . " pa,
               " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov
      WHERE    pa.products_id = :p
      AND      pa.options_id = :products_options_id
      AND      pa.options_values_id = pov.products_options_values_id
      AND      pov.language_id = :languages_id
      ORDER BY pa.options_values_sort_order,
               pov.products_options_values_name"
    );
                                                 
    while ($products_options_name = $products_options_name_query->fetch()) {
        
      if (is_array($_POST['id'])) {
        $selected_attribute = $_POST['id'][$products_options_name['products_options_id']];
      } else if (isset($_SESSION['cart']->contents[$_GET['p']]['attributes'][$products_options_name['products_options_id']])) {
        $selected_attribute = $_SESSION['cart']->contents[$_GET['p']]['attributes'][$products_options_name['products_options_id']];
      } else {
        $selected_attribute = false;
      }   
      
      $flag == false ? $comb_str = $combi_str .= $c_str : $comb_str = $combi_str;
      $flag = false;
      $c_str = '';
      $products_options_array = array();
      
      $DB->perform($products_options_query, array(':p' => (int)$_GET['p'],
                                                  ':products_options_id' => (int)$products_options_name['products_options_id'],
                                                  ':languages_id' => (int)$_SESSION['languages_id']));
                                             
      while ($products_options = $products_options_query->fetch()) {

        $pos = strpos($combinations_string, $comb_str . $products_options_name['products_options_id'] . '*' . $products_options['products_options_values_id']);

        if ($pos === false && $selected_attribute == $products_options['products_options_values_id']) $selected_attribute = false;
 
        if ($pos !== false || $combinations_string == '') {
          if ($c_str == '') $c_str = $products_options_name['products_options_id'] . '*' . $products_options['products_options_values_id'] . '_';
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], $products_tax_rate) .') ';
          }
          if ($flag == false) {
            if ($selected_attribute == false) {
              $combi_str .= $products_options_name['products_options_id'] . '*' . $products_options['products_options_values_id'] . '_';
              $flag = true;
            } elseif ($selected_attribute == $products_options['products_options_values_id']) {
              $combi_str .= $products_options_name['products_options_id'] . '*' . $products_options['products_options_values_id'] . '_';
              $flag = true;
            }                
          }              
        }                                   
      }
          
      if (xos_not_null($products_options_array)) {
        $product_options_array[]=array('products_options_name' => $products_options_name['products_options_name'],
                                       'products_options_id' => $products_options_name['products_options_id'],
                                       'products_options_pull_down' => xos_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute, 'class="form-control" id="option_' . $products_options_name['products_options_id'] . '" onchange="updateOptions(\'' . xos_href_link(FILENAME_UPDATE_OPTIONS, 'p=' . xos_get_prid($_GET['p']), 'NONSSL', true, false) . '\')"')); 
      }                                             
    }

    if (xos_not_null($attributes_quantity) && STOCK_CHECK == 'true') {
      if ($flag == false) $combi_str .= $c_str;
      $att_qty = $attributes_quantity[substr($combi_str, 0, -1)];
      $smarty->assign('qty_for_these_options', $att_qty > 0 ? $att_qty : '<span class="red-mark">' . $att_qty . '</span>');                 
    } 
     
    $smarty->assign(array('get_otions_list' => 'getOptionsList(\'' . xos_href_link(FILENAME_OPTIONS_LIST, 'p=' . xos_get_prid($_GET['p']), 'NONSSL', true, false) . '\');',
                          'products_options' => $product_options_array));
    
  } 
    
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'product_info');
    
  $smarty->display(SELECTED_TPL . '/update_options.tpl');
endif;