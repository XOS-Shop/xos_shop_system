<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : options_list.php
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
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_OPTIONS_LIST) == 'overwrite_all')) :
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_PRODUCT_INFO);

  $_SESSION['navigation']->remove_current_page();

  usleep(300000);

  if (xos_has_product_attributes((int)$_GET['p'])) {
  
    $product_query = $DB->prepare
    (
     "SELECT attributes_quantity,
             products_tax_class_id
      FROM   " . TABLE_PRODUCTS . "
      WHERE  products_status = '1'
      AND    products_id = :p"
    );
    
    $DB->perform($product_query, array(':p' => (int)$_GET['p']));
    
    $product = $product_query->fetch();
    
    $attributes_quantity = xos_get_attributes_quantity($product['attributes_quantity']);
    $products_tax_rate = xos_get_tax_rate($product['products_tax_class_id']);
             
    $opt_query = $DB->prepare
    (
     "SELECT   pa.options_id,
               po.products_options_name
      FROM     " . TABLE_PRODUCTS_ATTRIBUTES . " pa,
               " . TABLE_PRODUCTS_OPTIONS . " po
      WHERE    pa.products_id = :p
      AND      pa.options_id = po.products_options_id
      AND      po.language_id = :languages_id
      ORDER BY pa.options_sort_order ASC,
               pa.options_id ASC"
    );
    
    $DB->perform($opt_query, array(':p' => (int)$_GET['p'],
                                   ':languages_id' => (int)$_SESSION['languages_id']));     
    
    $opt_array = array();
    $opt_values_array = array();
    $opt_result_array = array();      
    $opt_rows_array = array();
    $opt_out_array = array();
      
    $i = 0;
    $ii = 1;
    $option_id = '';
    while ($opt = $opt_query->fetch()) {     
      if ($option_id == $opt['options_id']) $i--;          
      $opt_array[$i] = array('options_id' => $opt['options_id'],
                             'options_name' => $opt['products_options_name'],
                             'options_values_qty' => $option_id == $opt['options_id'] || $option_id == '' ? $ii : $ii = 1);                    
      $option_id = $opt['options_id'];                            
      $i++;
      $ii++;
    }
      
    reset($opt_array);
    for ($i=sizeof($opt_array) - 1, $n=0; $i>=$n; $i--) {
     $opt_array[$i]['rows_per_value'] = max(1, $opt_array[$i + 1]['rows_per_value']) * max(1, $opt_array[$i + 1]['options_values_qty']);       
    }
      
    $opt_array['rows_total'] = $opt_array[0]['rows_per_value'] * $opt_array[0]['options_values_qty'];
       
    reset($opt_array);
    $options_values_price = false;
    
    $opt_values_query = $DB->prepare
    (
     "SELECT DISTINCT pa.options_id,
                      pa.products_attributes_id,
                      pa.options_values_id,
                      pa.options_values_sort_order,
                      pa.options_sort_order,
                      pa.options_values_price,
                      pa.price_prefix,
                      po.products_options_name,
                      pov.products_options_values_name
      FROM            " . TABLE_PRODUCTS_ATTRIBUTES . " pa,
                      " . TABLE_PRODUCTS_OPTIONS . " po,
                      " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov
      WHERE           pa.products_id = :p
      AND             pa.options_id = :options_id
      AND             pa.options_id = po.products_options_id
      AND             pa.options_values_id = pov.products_options_values_id
      AND             po.language_id = pov.language_id
      AND             po.language_id = :languages_id
      ORDER BY        pa.options_sort_order,
                      pa.options_id,
                      pa.options_values_sort_order,
                      pov.products_options_values_name"
    );
         
    for ($i=0, $n=sizeof($opt_array) - 1; $i<$n; $i++) {
      
      $DB->perform($opt_values_query, array(':p' => (int)$_GET['p'],
                                            ':options_id' => (int)$opt_array[$i]['options_id'],
                                            ':languages_id' => (int)$_SESSION['languages_id'])); 
                                          
      while ($opt_values = $opt_values_query->fetch()) {    
        $opt_values_array[$opt_array[$i]['options_id']][] = array('options_values_id' => $opt_values['options_values_id'],
                                                                  'options_values_name' => (($opt_values['options_values_price'] != '0') ? $opt_values['products_options_values_name'] . '<span class="options-price"> (' . $opt_values['price_prefix'] . $currencies->display_price($opt_values['options_values_price'], $products_tax_rate) .') </span>' : $opt_values['products_options_values_name']));                                                                                                                                                                                                                 

        if ($opt_values['options_values_price'] != '0') $options_values_price = true;
      }
    }        
    
    reset($opt_values_array);
    for ($i=0, $n=$opt_array['rows_total']; $i<$n; $i++) {     
      $comb_string = '';
      $serialized_options = '';      
      for ($ii=0, $m=sizeof($opt_values_array); $ii<$m; $ii++) {        
        if ($i < ($opt_array[$ii]['rows_per_value'] * max(1, ($opt_rows_array[$ii] + 1)))) {

        } else {                     
          $opt_rows_array[$ii] = $opt_rows_array[$ii] + 1;            
          $opt_out_array[$ii] = $opt_out_array[$ii] + 1;             
          if (($opt_out_array[$ii]) % $opt_array[$ii]['options_values_qty'] == 0) $opt_out_array[$ii] = 0;            
        }  
        
        $opt_result_array[$i][$ii] = $opt_values_array[$opt_array[$ii]['options_id']][max(0, $opt_out_array[$ii])]['options_values_name'];          
        $comb_string .= $opt_array[$ii]['options_id'] . 'O' . $opt_values_array[$opt_array[$ii]['options_id']][max(0, $opt_out_array[$ii])]['options_values_id'] . '_';
        $serialized_options .= 'id[' . $opt_array[$ii]['options_id'] . ']=' . $opt_values_array[$opt_array[$ii]['options_id']][max(0, $opt_out_array[$ii])]['options_values_id'] . '&';
      }
          
      $onclick_update_options_string = '<a class="options-list" href="" onclick="updateOptions(\'' . xos_href_link(FILENAME_UPDATE_OPTIONS, 'p=' . xos_get_prid($_GET['p']), 'NONSSL', true, false) . '\',\'' . $serialized_options . '\'); toggle(\'box_products_options_overview\'); return false">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . 'pixel_trans.gif', TEXT_OPTION_TO_INSERT, '16', '16') . '</a>';
        
      $comb_string = substr($comb_string, 0, -1);
      if (isset($attributes_quantity[$comb_string])) {
        $opt_result_array[$i][sizeof($opt_values_array)] = (STOCK_CHECK == 'true' ? (isset($attributes_quantity[$comb_string]) ? ($attributes_quantity[$comb_string] <= 0 ? (STOCK_ALLOW_CHECKOUT == 'false' ? '<span class="red-mark options-list">0</span>' : '<span class="red-mark options-list">' . $attributes_quantity[$comb_string] . '</span>') : '<span class="options-list">' . $attributes_quantity[$comb_string] . '</span>') : '') : 'tick');
        $opt_result_array[$i][sizeof($opt_values_array) + 1] = (STOCK_CHECK == 'true' ? (isset($attributes_quantity[$comb_string]) ? ($attributes_quantity[$comb_string] <= 0 ? (STOCK_ALLOW_CHECKOUT == 'false' ? '<span class="options-list-draw-separator">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . 'pixel_trans.gif', '', '16', '16') . '</span>' : $onclick_update_options_string) : $onclick_update_options_string) : '<span class="options-list-draw-separator">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . 'pixel_trans.gif', '', '16', '16') . '</span>') : $onclick_update_options_string);
      } else{
        $opt_result_array[$i][sizeof($opt_values_array)] = (STOCK_CHECK == 'true' ? '<span class="red-mark options-list">X</span>' : 'cross');
        $opt_result_array[$i][sizeof($opt_values_array) + 1] = '<span class="options-list-draw-separator">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . 'pixel_trans.gif', '', '16', '16') . '</span>';
//      unset($opt_result_array[$i]);                
      }
    }
            
    unset($opt_array['rows_total']);
    $combinations_array = array();
    $combinations_array['options_names'] = $opt_array;
    $combinations_array['options_values'] = $opt_result_array; 
  
    $smarty->assign(array('products_options_overview' => $combinations_array,
                          'options_values_price' => $options_values_price,
                          'stock_allow_checkout' => STOCK_ALLOW_CHECKOUT,
                          'stock_check' => STOCK_CHECK));           
  }
                                        
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'product_info');
         
  $smarty->display(SELECTED_TPL . '/options_list.tpl');    
endif;