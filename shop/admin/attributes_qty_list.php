<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : attributes_qty_list.php
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
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_ATTRIBUTES_QTY_LIST) == 'overwrite_all')) :
  require(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/' . FILENAME_CATEGORIES); 
    
  if (xos_has_product_attributes((int)$_GET['products_id']) && STOCK_CHECK == 'true') {

    $product_query = xos_db_query("select attributes_quantity, attributes_not_updated from " . TABLE_PRODUCTS . " where products_status = '1' and products_id = '" . (int)$_GET['products_id'] . "'");
    $product = xos_db_fetch_array($product_query);
    
    $attributes_quantity = xos_get_attributes_quantity($product['attributes_quantity']);
    
    if (xos_not_null($attributes_quantity) && !xos_not_null($product['attributes_not_updated'])) { 
      
      $opt_query = xos_db_query("select pa.options_id, po.products_options_name from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS . " po where pa.products_id = '" . (int)$_GET['products_id'] . "' and pa.options_id = po.products_options_id and po.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by pa.options_sort_order asc, pa.options_id asc");    
    
      $opt_array = array();
      $opt_values_array = array();
      $opt_result_array = array();      
      $opt_rows_array = array();
      $opt_out_array = array();
      
      $i = 0;
      $ii = 1;
      $option_id = '';
      while ($opt = xos_db_fetch_array($opt_query)) {     
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
      for ($i=0, $n=sizeof($opt_array); $i<$n; $i++) {
        $opt_values_query = xos_db_query("select distinct pa.products_attributes_id, pa.options_values_id, pa.options_values_sort_order, po.products_options_name, pov.products_options_values_name from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS . " po, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$_GET['products_id'] . "' and pa.options_id = '" . (int)$opt_array[$i]['options_id'] . "' and pa.options_id = po.products_options_id and pa.options_values_id = pov.products_options_values_id and po.language_id = pov.language_id and po.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by pa.options_sort_order, pa.options_id, pa.options_values_sort_order, pov.products_options_values_name");
        while ($opt_values = xos_db_fetch_array($opt_values_query)) {   
          $opt_values_array[$opt_array[$i]['options_id']][] = array('options_values_id' => $opt_values['options_values_id'],
                                                                    'options_values_name' => $opt_values['products_options_values_name']);   
        }
      }
      
      reset($opt_values_array);
      for ($i=0, $n=$opt_array['rows_total']; $i<$n; $i++) {     
        $comb_string = '';      
        for ($ii=0, $m=sizeof($opt_values_array); $ii<$m; $ii++) {        
          if ($i < ($opt_array[$ii]['rows_per_value'] * max(1, ($opt_rows_array[$ii] + 1)))) {

          } else {                     
            $opt_rows_array[$ii] = $opt_rows_array[$ii] + 1;            
            $opt_out_array[$ii] = $opt_out_array[$ii] + 1;             
            if (($opt_out_array[$ii]) % $opt_array[$ii]['options_values_qty'] == 0) $opt_out_array[$ii] = 0;            
          }  
        
          $opt_result_array[$i][$ii] = $opt_values_array[$opt_array[$ii]['options_id']][max(0, $opt_out_array[$ii])]['options_values_name'];          
          $comb_string .= $opt_array[$ii]['options_id'] . ',' . $opt_values_array[$opt_array[$ii]['options_id']][max(0, $opt_out_array[$ii])]['options_values_id'] . '_';
        }
        
        $comb_string = substr($comb_string, 0, -1);
        if (isset($attributes_quantity[$comb_string])) {
          $opt_result_array[$i][sizeof($opt_values_array)] = xos_draw_input_field('attributes_quantity[' . $comb_string . ']', (isset($attributes_quantity[$comb_string]) ? ($attributes_quantity[$comb_string] == 0 ? '0' : $attributes_quantity[$comb_string]) : ''), 'onfocus="caching_qty(\'attributes_quantity[' . $comb_string . ']\')" onchange="update_total_qty(\'attributes_quantity[' . $comb_string . ']\')" class="smallText" size="8" maxlength="4"');
        } else{
          unset($opt_result_array[$i]);                
        }
      }
      
      unset($opt_array['rows_total']);
      $combinations_array = array();
      $combinations_array['options_names'] = $opt_array;
      $combinations_array['options_values'] = $opt_result_array;
    } else {
      $combinations_array['options_error'] = true;
    }        
  }
  
  $smarty->assign('input_attributes_quantities', $combinations_array);           
                                        
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'categories');
        
  $smarty->display(ADMIN_TPL . '/attributes_qty_list.tpl');
endif;      
?>
