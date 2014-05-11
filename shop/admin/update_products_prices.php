<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : update_products_prices.php
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
//              Copyright (c) 2002 osCommerce
//              filename: xsell_products.php                       
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_UPDATE_PRODUCTS_PRICES) == 'overwrite_all')) :  
  (isset($_GET['categories_or_pages_id']) && is_numeric($_GET['categories_or_pages_id'])) ? $categories_or_pages_id = $_GET['categories_or_pages_id'] : $categories_or_pages_id = 0;
  (isset($_GET['manufacturers_id']) && is_numeric($_GET['manufacturers_id'])) ? $manufacturers_id = $_GET['manufacturers_id'] : $manufacturers_id = 0;
  
  if ($_GET['action'] == 'update_prices') {            
    $products_id = xos_db_prepare_input($_GET['product_ID']);

    $sql_data_array = array('products_tax_class_id' => xos_db_prepare_input($_POST['products_tax_class_id']),
                            'products_last_modified' => 'now()');
                                  
    xos_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "'");

          
    $products_price_array = xos_get_product_prices(stripslashes($_POST['price_array']));
    $customers_group_query = xos_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id");
    $prices_array = array();
    while ($customers_group = xos_db_fetch_array($customers_group_query)) {
          
      if ($_POST['option'][$customers_group['customers_group_id']] || $customers_group['customers_group_id'] == 0) {
        $this_group_specials_error = false;              
        $has_specials = false;
        $all_specials = true;                           
        $prices_array[$customers_group['customers_group_id']][0]['regular'] = number_format($_POST['products_price_' . $customers_group['customers_group_id']], 4, '.', '');
        $prices_array[$customers_group['customers_group_id']][0]['regular'] < 0 ? $prices_array[$customers_group['customers_group_id']][0]['regular'] = number_format(0, 4, '.', '') : '';
        $special_price_formated = number_format($_POST['products_special_price_' . $customers_group['customers_group_id']], 4, '.', '');
        $prices_array[$customers_group['customers_group_id']][0]['regular'] > 0 ? ($special_price_formated > 0 ? $prices_array[$customers_group['customers_group_id']][0]['special'] = $special_price_formated : '') : '';
        if ($prices_array[$customers_group['customers_group_id']][0]['special'] > 0) {
          $product_special_status = xos_db_prepare_input($_POST['products_special_status_' . $customers_group['customers_group_id']]);
          $has_specials = true;
        } else {  
          $product_special_status = 0;
          $all_specials = false;
        }  
        $prices_array[$customers_group['customers_group_id']]['special_status'] = $product_special_status;                 
                            
        $sizeof = count($products_price_array[$customers_group['customers_group_id']]);
        if ($sizeof > 2 && $prices_array[$customers_group['customers_group_id']][0]['regular'] > 0) {
          for ($count=2, $n=(($sizeof+1 < 5) ? 5 : $sizeof+1); $count<$n; $count++) {
            $formated_price = number_format($_POST['products_price_break_' . $customers_group['customers_group_id'] . $count], 4, '.', '');
            $formated_special_price = number_format($_POST['products_special_price_break_' . $customers_group['customers_group_id'] . $count], 4, '.', '');
            if ($_POST['products_quantity_' . $customers_group['customers_group_id'] . $count] > 0 && $formated_price > 0) {
              $prices_array[$customers_group['customers_group_id']][$_POST['products_quantity_' . $customers_group['customers_group_id'] . $count]]['regular'] = $formated_price;
              if ($formated_special_price > 0) {
                $prices_array[$customers_group['customers_group_id']][$_POST['products_quantity_' . $customers_group['customers_group_id'] . $count]]['special'] = $formated_special_price;
                $has_specials = true;
              } else {  
                $all_specials = false;
              }  
            }
          }  
        } elseif ($prices_array[$customers_group['customers_group_id']][0]['regular'] > 0) {
          for ($count=2, $n=4; $count<=$n; $count++) {
            $formated_price = number_format($_POST['products_price_break_' . $customers_group['customers_group_id'] . $count], 4, '.', '');
            $formated_special_price = number_format($_POST['products_special_price_break_' . $customers_group['customers_group_id'] . $count], 4, '.', '');
            if ($_POST['products_quantity_' . $customers_group['customers_group_id'] . $count] > 0 && $formated_price > 0) {
              $prices_array[$customers_group['customers_group_id']][$_POST['products_quantity_' . $customers_group['customers_group_id'] . $count]]['regular'] = $formated_price;
              if ($formated_special_price > 0) {
                $prices_array[$customers_group['customers_group_id']][$_POST['products_quantity_' . $customers_group['customers_group_id'] . $count]]['special'] = $formated_special_price;
                $has_specials = true;
              } else {
                $all_specials = false;
              }
            }                                 
          }
        }
        !$all_specials ? $prices_array[$customers_group['customers_group_id']]['special_status'] = $product_special_status = 0 : '';
        if ($has_specials && !$all_specials) {
          $specials_error = true;
          $this_group_specials_error = true;
          $spec_err_gr .= $customers_group['customers_group_id'] . ',';
        }                                              
      }
                                
      $special_expires_date = xos_date_raw(xos_db_prepare_input($_POST['special_expires_date_' . $customers_group['customers_group_id']]));           
      $special_expires_date = (date('Ymd') <= $special_expires_date && $all_specials) ? $special_expires_date : 'null'; 
            
             
      if ($customers_group['customers_group_id'] == 0) {
        $default_price = xos_db_prepare_input($prices_array[$customers_group['customers_group_id']][0]['regular']);
        $default_special_price = xos_db_prepare_input($prices_array[$customers_group['customers_group_id']][0]['special']);
        $default_product_special_status = $product_special_status;
        $default_special_expires_date = $special_expires_date;
      }
            
      if ($_POST['option'][$customers_group['customers_group_id']]) {
        $regular_price = xos_db_prepare_input($prices_array[$customers_group['customers_group_id']][0]['regular']);
        $special_price = xos_db_prepare_input($prices_array[$customers_group['customers_group_id']][0]['special']);
      } else {
        $regular_price = $default_price;            
        $special_price = $default_special_price; 
        $special_expires_date = $default_special_expires_date;
        $product_special_status = $default_product_special_status;
      }
                          
      $price_count_query = xos_db_query("select products_id from " . TABLE_PRODUCTS_PRICES . " where products_id = '" . (int)$products_id . "' and customers_group_id = '" . $customers_group['customers_group_id'] . "'");
      if (xos_db_num_rows($price_count_query)) {
        xos_db_query("update " . TABLE_PRODUCTS_PRICES . " set customers_group_price = '" . $regular_price . "' where customers_group_id = '" . $customers_group['customers_group_id'] . "' and products_id = '" . (int)$products_id . "'");
      } else {
        xos_db_query("insert into " . TABLE_PRODUCTS_PRICES . " (products_id, customers_group_id, customers_group_price) values ('" . (int)$products_id . "', '" . $customers_group['customers_group_id'] . "', '" . $regular_price . "')");
      }              
      $special_price_count_query = xos_db_query("select products_id from " . TABLE_SPECIALS . " where products_id = '" . (int)$products_id . "' and customers_group_id = '" . $customers_group['customers_group_id'] . "'");
      if (xos_db_num_rows($special_price_count_query)) {
        if ($special_price > 0) {            
          xos_db_perform(TABLE_SPECIALS, array('specials_new_products_price' => $special_price, 'expires_date' => $special_expires_date, 'status' => $product_special_status, 'error' => $this_group_specials_error ? '1' : '0'), 'update', "customers_group_id = '" . $customers_group['customers_group_id'] . "' and products_id = '" . (int)$products_id . "'");
        } else {
          xos_db_query("delete from " . TABLE_SPECIALS . " where customers_group_id = '" . $customers_group['customers_group_id'] . "' and products_id = '" . (int)$products_id . "'");
        }                  
      } else {
        if ($special_price > 0) xos_db_perform(TABLE_SPECIALS, array('products_id' => (int)$products_id, 'customers_group_id' => $customers_group['customers_group_id'], 'specials_new_products_price' => $special_price, 'expires_date' => $special_expires_date, 'status' => $product_special_status, 'error' => $this_group_specials_error ? '1' : '0'));
      }                            
             
    }
                    
    $sql_data_array = array('products_price' => serialize($prices_array));                     
    xos_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "'");

    $smarty_cache_control->clearAllCache();
          
    if ($specials_error) {
      $messageStack->add_session('price_error', ERROR_NOT_ALL_NECESSARY_PRICES, 'error');
      xos_redirect(xos_href_link(FILENAME_UPDATE_PRODUCTS_PRICES, 'product_ID=' . $products_id . '&categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows'] . '&page=' . $_GET['page'] . ($_GET['specials_only'] ? '&specials_only=' . $_GET['specials_only'] : '') . '&errGr=' . substr($spec_err_gr, 0, -1)));
    }  
          
    xos_redirect(xos_href_link(FILENAME_UPDATE_PRODUCTS_PRICES, 'categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows'] . '&page=' . $_GET['page'] . ($_GET['specials_only'] ? '&specials_only=' . $_GET['specials_only'] : '')));
  }

  $max_display_update_prices_results_array = array();
  $set = false;
  for ($i = 50; $i <=500 ; $i=$i+50) {
  
    if (MAX_DISPLAY_RESULTS <= $i && $set == false) {
      $max_display_update_prices_results_array[] = array('id' => MAX_DISPLAY_RESULTS, 'text' => MAX_DISPLAY_RESULTS);
      $set = true;      
    }
    
    if (MAX_DISPLAY_RESULTS != $i) {
      $max_display_update_prices_results_array[] = array('id' => $i, 'text' => $i);
    }
  }
  
  if ($set == false) {
    $max_display_update_prices_results_array[] = array('id' => MAX_DISPLAY_RESULTS, 'text' => MAX_DISPLAY_RESULTS);
  }

  $manufacturers_array = array(array('id' => '', 'text' => TEXT_ALL));
  $manufacturers_query = xos_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " where languages_id = '" . (int)$_SESSION['used_lng_id'] . "' order by manufacturers_name");
  while ($manufacturers = xos_db_fetch_array($manufacturers_query)) {
    $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                   'text' => $manufacturers['manufacturers_name']);
  }

  $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
  $tax_class_query = xos_db_query("select distinct tc.tax_class_id, tc.tax_class_title from " . TABLE_TAX_CLASS . " tc, " . TABLE_TAX_RATES . " tr where tc.tax_class_id = tr.tax_class_id order by tc.tax_class_title");
  while ($tax_class = xos_db_fetch_array($tax_class_query)) {
    $tax_class_array[] = array('id' => $tax_class['tax_class_id'],
                               'text' => $tax_class['tax_class_title']);
  }
    
  $tax_rates_final_array = array(array('id' => '0', 'text' => TEXT_NONE));
  $tax_rates_final_query = xos_db_query("select tr.tax_rates_final_id, tc.tax_class_title, gz.geo_zone_name, tr.tax_rate_final from " . TABLE_TAX_RATES_FINAL . " tr, " . TABLE_TAX_CLASS . " tc, " . TABLE_GEO_ZONES . " gz where tr.tax_class_id = tc.tax_class_id and tr.tax_zone_id = gz.geo_zone_id order by tc.tax_class_title, gz.geo_zone_name");
  while ($tax_rates_final= xos_db_fetch_array($tax_rates_final_query)) {
    $tax_rates_final_array[] = array('id' => $tax_rates_final['tax_rates_final_id'],
                                     'text' => $tax_rates_final['tax_class_title'] . ' (' . $tax_rates_final['geo_zone_name'] . ') [' . $tax_rates_final['tax_rate_final'] . '%]',
                                     'value' => $tax_rates_final['tax_rate_final']);
  } 

  function xos_get_categories_string($parent_id = '', $entrance = false, $categories_string = '') {
    
    if ($entrance) {
      $categories_string = " p2c.categories_or_pages_id = '" . $parent_id . "'";
    }

    $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.parent_id from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and c.parent_id = '" . (int)$parent_id . "' order by c.sort_order, cpd.categories_or_pages_name");
    while ($categories = xos_db_fetch_array($categories_query)) {
      $categories_string .= " or p2c.categories_or_pages_id = '" . $categories['categories_or_pages_id'] . "'";
      $categories_string = xos_get_categories_string($categories['categories_or_pages_id'], '', $categories_string);
    }

    return $categories_string;
  }
  
  if ($_GET['product_ID']) {
  
    $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN_IMAGES . ADMIN_TPL .'/' . $_SESSION['language'] . '/jquery.ui.datepicker-language.min.js"></script>' . "\n"; 
                   
  } else {
  
    $javascript = '<script type="text/JavaScript">' . "\n" .
                  '/* <![CDATA[ */' . "\n" .
                  '  function cOn(td) {' . "\n" .
                  '    if(document.getElementById||(document.all && !(document.getElementById))) {' . "\n" .
                  '      td.style.backgroundColor="#cccccc";' . "\n" .
                  '    }' . "\n" .
                  '  }' . "\n\n" .

                  '  function cOnA(td) {' . "\n" .
                  '    if(document.getElementById||(document.all && !(document.getElementById))) {' . "\n" .
                  '      td.style.backgroundColor="#ccffff";' . "\n" .
                  '    }' . "\n" .
                  '  }' . "\n\n" .

                  '  function cOut(td) {' . "\n" .
                  '    if(document.getElementById||(document.all && !(document.getElementById))) {' . "\n" .
                  '      td.style.backgroundColor="#ebebff";' . "\n" .
                  '    }' . "\n" .
                  '  }' . "\n" .
                  '/* ]]> */' . "\n" .
                  '</script>' . "\n";
                    
  }
   
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  

  if (!$_GET['product_ID']) {
    if ($_GET['page'] == '') $_GET['page'] = '1';
    $smarty->assign(array('set_filter' => true,
                          'form_begin_filter_update_products_prices' => xos_draw_form('filter_update_products_prices', FILENAME_UPDATE_PRODUCTS_PRICES, ($_GET['first_entrance'] ? '' : xos_get_all_get_params()),'get'),
                          'pull_down_menu_categories_or_pages_id' => xos_draw_pull_down_menu('categories_or_pages_id', xos_get_category_tree(), $categories_or_pages_id),
                          'pull_down_menu_manufacturers_id' => xos_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $manufacturers_id),
                          'pull_down_menu_max_rows' => xos_draw_pull_down_menu('max_rows', $max_display_update_prices_results_array, $_GET['max_rows'], 'style="width: 75px;"'),                          
                          'checkbox_specials_only' => xos_draw_checkbox_field('specials_only', '', $_GET['specials_only'])));
    if (SID) {
      $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
    }
  }
  
  if (!$_GET['product_ID'] && !$_GET['first_entrance']) {
  
    if ($categories_or_pages_id) $includes_categories = xos_get_categories_string($categories_or_pages_id, true);
    
    if ($_GET['specials_only']) {
      $products_query_raw = "select distinct a.products_id, b.products_name, a.products_model, a.products_price, a.products_status, a.products_tax_class_id from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_SPECIALS . " s where b.products_id = a.products_id and b.products_id = p2c.products_id and b.products_id = s.products_id and s.error = '0' and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "'" . ($categories_or_pages_id ? " and (" . $includes_categories . ")" : "") . ($manufacturers_id ? " and a.manufacturers_id ='" . $manufacturers_id . "'" : "" ) . " ORDER BY b.products_name";
    } else {
      $products_query_raw = "select distinct a.products_id, b.products_name, a.products_model, a.products_price, a.products_status, a.products_tax_class_id from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where b.products_id = a.products_id and b.products_id = p2c.products_id and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "'" . ($categories_or_pages_id ? " and (" . $includes_categories . ")" : "") . ($manufacturers_id ? " and a.manufacturers_id ='" . $manufacturers_id . "'" : "" ) . " ORDER BY b.products_name";
    }
     
    $products_split = new splitPageResults($_GET['page'], $_GET['max_rows'], $products_query_raw, $products_query_numrows, 'a.products_id');
   
    $products_query = xos_db_query($products_query_raw);
    
    if ($products_query_numrows > 0) {
    
      $form_action = 'update_info';

      /* now we will query the DB for existing related items */      
      $products_array =  array();     
      while ($products = xos_db_fetch_array($products_query)) {
         
        $customers_group_query = xos_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id");      
          
        $products_prices = xos_get_product_prices($products['products_price']); 
        
        $customers_group = array();
        $customers_groups_array = array();
        while ($customers_group = xos_db_fetch_array($customers_group_query)) { 
    
          if ($products_prices[$customers_group['customers_group_id']][0]) {
     
            $price_breaks_array = array();       
            $sizeof = count($products_prices[$customers_group['customers_group_id']]); 
            if ($sizeof > 2) {
              $array_keys = array_keys($products_prices[$customers_group['customers_group_id']]);
              for ($count=2, $n=$sizeof; $count<$n; $count++) {
                $qty = $array_keys[$count];
                $price_breaks_array[]=array('input_quantity' => xos_draw_input_field('products_quantity_' . $customers_group['customers_group_id'] . $count . $products['products_id'], $qty, 'style="background: #fffffe;" size ="2" readonly="readonly"'),
                                            'input_price_break' => xos_draw_input_field('products_price_break_' . $customers_group['customers_group_id'] . $count . $products['products_id'], (string)round($products_prices[$customers_group['customers_group_id']][$qty]['regular'], 4), 'style="background: #fffffe;" size ="11" readonly="readonly"'),
                                            'input_price_break_gross' => xos_draw_input_field('products_price_break_gross_' . $customers_group['customers_group_id'] . $count . $products['products_id'], (string)round($products_prices[$customers_group['customers_group_id']][$qty]['regular'], 4), 'style="background: #fffffe;" size ="11" readonly="readonly"'),
                                            'input_special_price_break' => xos_draw_input_field('products_special_price_break_' . $customers_group['customers_group_id'] . $count . $products['products_id'], (string)round($products_prices[$customers_group['customers_group_id']][$qty]['special'], 4), 'style="background: #ffe1e1; color : red;" size ="11" readonly="readonly"'),
                                            'input_special_price_break_gross' => xos_draw_input_field('products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . $products['products_id'], (string)round($products_prices[$customers_group['customers_group_id']][$qty]['special'], 4), 'style="background: #ffe1e1; color : red;" size ="11" readonly="readonly"')); 
                                                                                                                                           
                $update_gross_string .= 'updateGross(\'products_price_break_' . $customers_group['customers_group_id'] . $count . $products['products_id'] . '\', \'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . $products['products_id'] . '\');' . "\n" . 
                                        'updateGross(\'products_special_price_break_' . $customers_group['customers_group_id'] . $count . $products['products_id'] . '\', \'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . $products['products_id'] . '\');';
                                  
                $update_net_string .= 'updateNet(\'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . $products['products_id'] . '\', \'products_price_break_' . $customers_group['customers_group_id'] . $count . $products['products_id'] . '\');' . "\n" .
                                      'updateNet(\'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . $products['products_id'] . '\', \'products_special_price_break_' . $customers_group['customers_group_id'] . $count . $products['products_id'] . '\');';                                                      
              }
            }
             
            $specials_query = xos_db_query("select date_format(expires_date, '" . DATE_FORMAT_SHORT . "') as expires_date, error from " . TABLE_SPECIALS . " where products_id = '" . (int)$products['products_id'] . "' and customers_group_id = '" . (int)$customers_group['customers_group_id'] . "'");
            $specials = xos_db_fetch_array($specials_query);
            
            $is_special = true;
            
            if ($products_prices[$customers_group['customers_group_id']]['special_status'] == 1 && $specials['error'] == '0') {
              $special_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10);
            } else if ($products_prices[$customers_group['customers_group_id']]['special_status'] == 0 && $specials['error'] == '0') {
              $special_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10);
            } else {
              $special_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/pixel_trans.gif', ICON_TITLE_STATUS_RED, 10, 10);
              $is_special = false;
            }
       
            $customers_groups_array[]=array('name' => $customers_group['customers_group_name'],                                            
                                            'input_price' => xos_draw_input_field('products_price_' . $customers_group['customers_group_id'] . $products['products_id'], (string)round($products_prices[$customers_group['customers_group_id']][0]['regular'], 4), 'style="background: #fffffe;" size ="11" readonly="readonly"'),
                                            'input_price_gross' => xos_draw_input_field('products_price_gross_' . $customers_group['customers_group_id'] . $products['products_id'], (string)round($products_prices[$customers_group['customers_group_id']][0]['regular'], 4), 'style="background: #fffffe;" size ="11" readonly="readonly"'),
                                            'input_special_price' => xos_draw_input_field('products_special_price_' . $customers_group['customers_group_id'] . $products['products_id'], (string)round($products_prices[$customers_group['customers_group_id']][0]['special'], 4), 'style="background: #ffe1e1; color : red;" size ="11" readonly="readonly"'),
                                            'input_special_price_gross' => xos_draw_input_field('products_special_price_gross_' . $customers_group['customers_group_id'] . $products['products_id'], (string)round($products_prices[$customers_group['customers_group_id']][0]['special'], 4), 'style="background: #ffe1e1; color : red;" size ="11" readonly="readonly"'),                                      
                                            'input_special_expires_date' => xos_draw_input_field('special_expires_date_' . $customers_group['customers_group_id'] . $products['products_id'], $specials['expires_date'], 'style="background: #ffffcc;" size ="10" readonly="readonly"'), 
                                            'special_status_image' => $special_status_image,
                                            'is_special' => $is_special,                                                                            
                                            'price_breaks' => $price_breaks_array);
                                      
            unset($price_breaks_array);  

            $update_gross_string .= 'updateGross(\'products_price_' . $customers_group['customers_group_id'] . $products['products_id'] . '\', \'products_price_gross_' . $customers_group['customers_group_id'] . $products['products_id'] . '\');' . "\n" .
                                    'updateGross(\'products_special_price_' . $customers_group['customers_group_id'] . $products['products_id'] . '\', \'products_special_price_gross_' . $customers_group['customers_group_id'] . $products['products_id'] . '\');';
                              
            $update_net_string .= 'updateNet(\'products_price_gross_' . $customers_group['customers_group_id'] . $products['products_id'] . '\', \'products_price_' . $customers_group['customers_group_id'] . $products['products_id'] . '\');' . "\n" .
                                  'updateNet(\'products_special_price_gross_' . $customers_group['customers_group_id'] . $products['products_id'] . '\', \'products_special_price_' . $customers_group['customers_group_id'] . $products['products_id'] . '\');';
     
          }                                                                                          
        } 
                         
        if ($products['products_status'] == '1') {
          $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10);
        } else {
          $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10);
        }
        
        $products_array[]=array('products_id' => $products['products_id'],
                                'products_model' => $products['products_model'],
                                'products_status_image' => $products_status_image,
                                'products_name' => $products['products_name'],
                                'products_tax_class' => $tax_class_array[$products['products_tax_class_id']]['text'],
                                'link_to_edit_related_product' => xos_href_link(FILENAME_UPDATE_PRODUCTS_PRICES, 'product_ID=' . $products['products_id'] . '&categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows'] . '&page=' . $_GET['page'] . ($_GET['specials_only'] ? '&specials_only=' . $_GET['specials_only'] : '')),
                                'products_prices' => $customers_groups_array);      
      }
            
      $javascript = '<script type="text/javascript">' . "\n" .
                    '/* <![CDATA[ */' . "\n" .
                    'var tax_rates = new Array();' . "\n";
      for ($i=0, $n=sizeof($tax_rates_final_array); $i<$n; $i++) {
        if ($tax_rates_final_array[$i]['id'] > 0) {
          $javascript .= 'tax_rates["' . $tax_rates_final_array[$i]['id'] . '"] = ' . $tax_rates_final_array[$i]['value'] . ';' . "\n";
        }
      }
      $javascript .= "\n" .'function doRound(x, places) {' . "\n" .
                     '  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);' . "\n" .
                     '}' . "\n\n" .

                     'function getTaxRate() {' . "\n" .
                     '  var selected_value = document.forms["' . $form_action . '"].tax_rates_final_id.selectedIndex;' . "\n" .
                     '  var parameterVal = document.forms["' . $form_action . '"].tax_rates_final_id[selected_value].value;' . "\n\n" .

                     '  if ( (parameterVal > 0) && (tax_rates[parameterVal] > 0) ) {' . "\n" .
                     '    return tax_rates[parameterVal];' . "\n" .
                     '  } else {' . "\n" .
                     '    return 0;' . "\n" .
                     '  }' . "\n" .
                     '}' . "\n\n" .                  
                   
                     'function updateGross(inField, setField) {' . "\n" .
                     '  var taxRate = getTaxRate();' . "\n" .
                     '  var grossValue = document.forms["' . $form_action . '"].elements[inField].value;' . "\n\n" .

                     '  if (taxRate > 0) {' . "\n" .
                     '    grossValue = grossValue * ((taxRate / 100) + 1);' . "\n" .
                     '  }' . "\n\n" .

                     '  document.forms["' . $form_action . '"].elements[setField].value = doRound(grossValue, 4);' . "\n" .
                     '}' . "\n\n" .

                     'function updateNet(inField, setField) {' . "\n" .
                     '  var taxRate = getTaxRate();' . "\n" .
                     '  var netValue = document.forms["' . $form_action . '"].elements[inField].value;' . "\n\n" .

                     '  if (taxRate > 0) {' . "\n" .
                     '    netValue = netValue / ((taxRate / 100) + 1);' . "\n" .
                     '  }' . "\n\n" . 

                     '  document.forms["' . $form_action . '"].elements[setField].value = doRound(netValue, 4);' . "\n" .
                     '}' . "\n\n" . 
                   
                     'function updatePrices(net, gross) {' . "\n\n" .
                 
                     '  if (gross) {' . "\n" .
                     '    ' . $update_gross_string . "\n" .
                     '  }' . "\n\n" . 
                 
                     '  if (net) {' . "\n" .
                     '    ' . $update_net_string . "\n" .
                     '  }' . "\n\n" . 
                                   
                     '}' . "\n\n" .                                                                         
                   
                     '/* ]]> */' . "\n" .
                     '</script>' . "\n";        
      
      $smarty->assign(array('info_prices' => 'yes',
                            'nav_bar_number' => $products_split->display_count($products_query_numrows, $_GET['max_rows'], $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS),
                            'nav_bar_result' => $products_split->display_links($products_query_numrows, $_GET['max_rows'], MAX_DISPLAY_PAGE_LINKS, $_GET['page'], xos_get_all_get_params(array('page', 'x', 'y'))),
                            'form_begin' => '<form name="' . $form_action . '" action="">',
                            'pull_down_tax_rates' => xos_draw_pull_down_menu('tax_rates_final_id', $tax_rates_final_array, '', 'style="font-size : 9px; font-weight : normal;" onchange="updatePrices(false, true)"'),
                            'javascript' => $javascript,
                            'update_prices' => 'updatePrices(true, true)',
                            'products' => $products_array));

    } else {
    
      $smarty->assign('info_prices', 'no_prices');
 
    }  
    
  } elseif (!$_GET['first_entrance']) { 
  
    $form_action = 'update_prices';
  
    $product_query = xos_db_query("select a.products_id, b.products_name, a.products_model, a.products_price, a.products_status, a.products_tax_class_id from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b where b.products_id = a.products_id and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and a.products_id = '". (int)$_GET['product_ID'] ."'");
    $product = xos_db_fetch_array($product_query);

    $customers_group_query = xos_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id");
    
    $products_prices = xos_get_product_prices($product['products_price']);
  
    $update_gross_string = '';
    $update_net_string = '';
    $update_checked_string = '';
    $customers_groups_array = array();
    $error_groups = array();
    
    if (isset($_GET['errGr'])) $error_groups = explode(',', $_GET['errGr']);
    
    $javascript = '<script type="text/javascript">' . "\n" .
                  '/* <![CDATA[ */' . "\n" .
                  'var tax_rates = new Array();' . "\n";
    for ($i=0, $n=sizeof($tax_rates_final_array); $i<$n; $i++) {
      if ($tax_rates_final_array[$i]['id'] > 0) {
        $javascript .= 'tax_rates["' . $tax_rates_final_array[$i]['id'] . '"] = ' . $tax_rates_final_array[$i]['value'] . ';' . "\n";
      }
    }    
        
    while ($customers_group = xos_db_fetch_array($customers_group_query)) { 
     
      $price_breaks_array = array();       
      $sizeof = count($products_prices[$customers_group['customers_group_id']]); 
      if ($sizeof > 2) {
        $array_keys = array_keys($products_prices[$customers_group['customers_group_id']]);
        for ($count=2, $n=(($sizeof+1 < 5) ? 5 : $sizeof+1); $count<$n; $count++) {
          $qty = $array_keys[$count];
          $price_breaks_array[]=array('input_quantity' => xos_draw_input_field('products_quantity_' . $customers_group['customers_group_id'] . $count, $qty, 'style="background: #fffffe;" size ="2"'),
                                      'input_price_break' => xos_draw_input_field('products_price_break_' . $customers_group['customers_group_id'] . $count, $products_prices[$customers_group['customers_group_id']][$qty]['regular'], 'style="background: #fffffe;" size ="11" onkeyup="updateGross(\'products_price_break_' . $customers_group['customers_group_id'] . $count . '\', \'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\')"'),
                                      'input_price_break_gross' => xos_draw_input_field('products_price_break_gross_' . $customers_group['customers_group_id'] . $count, $products_prices[$customers_group['customers_group_id']][$qty]['regular'], 'style="background: #fffffe;" size ="11" onkeyup="updateNet(\'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\', \'products_price_break_' . $customers_group['customers_group_id'] . $count . '\')"'),
                                      'input_special_price_break' => xos_draw_input_field('products_special_price_break_' . $customers_group['customers_group_id'] . $count, $products_prices[$customers_group['customers_group_id']][$qty]['special'], 'style="background: ' . (in_array($customers_group['customers_group_id'], $error_groups) && !$products_prices[$customers_group['customers_group_id']][$qty]['special'] > 0 && $qty > 0 ? '#000000' : '#ffe1e1') . '; color : red;" size ="11" onkeyup="updateGross(\'products_special_price_break_' . $customers_group['customers_group_id'] . $count . '\', \'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\')"'),
                                      'input_special_price_break_gross' => xos_draw_input_field('products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count, $products_prices[$customers_group['customers_group_id']][$qty]['special'], 'style="background: ' . (in_array($customers_group['customers_group_id'], $error_groups) && !$products_prices[$customers_group['customers_group_id']][$qty]['special'] > 0 && $qty > 0 ? '#000000' : '#ffe1e1') . '; color : red;" size ="11" onkeyup="updateNet(\'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\', \'products_special_price_break_' . $customers_group['customers_group_id'] . $count . '\')"'));                                                                                                      

          $update_gross_string .= 'updateGross(\'products_price_break_' . $customers_group['customers_group_id'] . $count . '\', \'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\');' . "\n" . 
                                  'updateGross(\'products_special_price_break_' . $customers_group['customers_group_id'] . $count . '\', \'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\');';
                                  
          $update_net_string .= 'updateNet(\'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\', \'products_price_break_' . $customers_group['customers_group_id'] . $count . '\');' . "\n" .
                                'updateNet(\'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\', \'products_special_price_break_' . $customers_group['customers_group_id'] . $count . '\');';                                                    
        }
      } else {
        for ($count=2, $n=4; $count<=$n; $count++) {

          $price_breaks_array[]=array('input_quantity' => xos_draw_input_field('products_quantity_' . $customers_group['customers_group_id'] . $count, '', 'style="background: #fffffe;" size ="2"'),
                                      'input_price_break' => xos_draw_input_field('products_price_break_' . $customers_group['customers_group_id'] . $count, '', 'style="background: #fffffe;" size ="11" onkeyup="updateGross(\'products_price_break_' . $customers_group['customers_group_id'] . $count . '\', \'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\')"'),
                                      'input_price_break_gross' => xos_draw_input_field('products_price_break_gross_' . $customers_group['customers_group_id'] . $count, '', 'style="background: #fffffe;" size ="11" onkeyup="updateNet(\'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\', \'products_price_break_' . $customers_group['customers_group_id'] . $count . '\')"'),
                                      'input_special_price_break' => xos_draw_input_field('products_special_price_break_' . $customers_group['customers_group_id'] . $count, '', 'style="background: #ffe1e1; color : red;" size ="11" onkeyup="updateGross(\'products_special_price_break_' . $customers_group['customers_group_id'] . $count . '\', \'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\')"'),
                                      'input_special_price_break_gross' => xos_draw_input_field('products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count, '', 'style="background: #ffe1e1; color : red;" size ="11" onkeyup="updateNet(\'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\', \'products_special_price_break_' . $customers_group['customers_group_id'] . $count . '\')"'));                                     
                                      
          $update_gross_string .= 'updateGross(\'products_price_break_' . $customers_group['customers_group_id'] . $count . '\', \'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\');' . "\n" . 
                                  'updateGross(\'products_special_price_break_' . $customers_group['customers_group_id'] . $count . '\', \'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\');';
                                  
          $update_net_string .= 'updateNet(\'products_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\', \'products_price_break_' . $customers_group['customers_group_id'] . $count . '\');' . "\n" .
                                'updateNet(\'products_special_price_break_gross_' . $customers_group['customers_group_id'] . $count . '\', \'products_special_price_break_' . $customers_group['customers_group_id'] . $count . '\');';                                                                                        
        }
      }
      
      if (!isset($products_prices[$customers_group['customers_group_id']]['special_status'])) $products_prices[$customers_group['customers_group_id']]['special_status'] = $products_prices[0]['special_status'];
      switch ($products_prices[$customers_group['customers_group_id']]['special_status']) {
        case '1': $in_special_status = true; $out_special_status = false; break;
        case '0':
        default: $in_special_status = false; $out_special_status = true;
      }        

      $special_expires_date_query = xos_db_query("select date_format(expires_date, '" . DATE_FORMAT_SHORT . "') as expires_date from " . TABLE_SPECIALS . " where products_id = '" . (int)$product['products_id'] . "' and customers_group_id = '" . (int)$customers_group['customers_group_id'] . "'");
      $special_expires_date = xos_db_fetch_array($special_expires_date_query);
       
      $customers_groups_array[]=array('name' => $customers_group['customers_group_name'],
                                      'id' => $customers_group['customers_group_id'],
                                      'toggle_name' => 'toggle_' . $customers_group['customers_group_id'],
                                      'display' => ($sizeof > 2 ? '' : 'display: none'),
                                      $customers_group['customers_group_id'] == 0 ? '' : 'input_checkbox' => xos_draw_checkbox_field('option[' . $customers_group['customers_group_id'] . ']', 'option[' . $customers_group['customers_group_id'] . ']', $products_prices[$customers_group['customers_group_id']][0] ? true : false, '', 'onclick="updateChecked(\'' . $customers_group['customers_group_id'] . '\')"'),                                            
                                      'input_price' => xos_draw_input_field('products_price_' . $customers_group['customers_group_id'], $products_prices[$customers_group['customers_group_id']][0]['regular'], 'style="background: #fffffe;" size ="11" onkeyup="updateGross(\'products_price_' . $customers_group['customers_group_id'] . '\', \'products_price_gross_' . $customers_group['customers_group_id'] . '\')"'),
                                      'input_price_gross' => xos_draw_input_field('products_price_gross_' . $customers_group['customers_group_id'], $products_prices[$customers_group['customers_group_id']][0]['regular'], 'style="background: #fffffe;" size ="11" onkeyup="updateNet(\'products_price_gross_' . $customers_group['customers_group_id'] . '\', \'products_price_' . $customers_group['customers_group_id'] . '\')"'),
                                      'input_special_price' => xos_draw_input_field('products_special_price_' . $customers_group['customers_group_id'], $products_prices[$customers_group['customers_group_id']][0]['special'], 'style="background: ' . (in_array($customers_group['customers_group_id'], $error_groups) && !$products_prices[$customers_group['customers_group_id']][0]['special'] > 0 ? '#000000' : '#ffe1e1') . '; color : red;" size ="11" onkeyup="updateGross(\'products_special_price_' . $customers_group['customers_group_id'] . '\', \'products_special_price_gross_' . $customers_group['customers_group_id'] . '\')"'),
                                      'input_special_price_gross' => xos_draw_input_field('products_special_price_gross_' . $customers_group['customers_group_id'], $products_prices[$customers_group['customers_group_id']][0]['special'], 'style="background: ' . (in_array($customers_group['customers_group_id'], $error_groups) && !$products_prices[$customers_group['customers_group_id']][0]['special'] > 0 ? '#000000' : '#ffe1e1') . '; color : red;" size ="11" onkeyup="updateNet(\'products_special_price_gross_' . $customers_group['customers_group_id'] . '\', \'products_special_price_' . $customers_group['customers_group_id'] . '\')"'),                                      
                                      'input_special_expires_date' => xos_draw_input_field('special_expires_date_' . $customers_group['customers_group_id'], $special_expires_date['expires_date'], 'id ="special_expires_date_' . $customers_group['customers_group_id'] . '" style="background: #ffffcc;" size ="10"'),                                                                                
                                      'radio_special_status_1' => xos_draw_radio_field('products_special_status_' . $customers_group['customers_group_id'], '1', $in_special_status),
                                      'radio_special_status_0' => xos_draw_radio_field('products_special_status_' . $customers_group['customers_group_id'], '0', $out_special_status),                                                                            
                                      'price_breaks' => $price_breaks_array);
                                      
      unset($price_breaks_array);                                
                                                          
      $update_gross_string .= 'updateGross(\'products_price_' . $customers_group['customers_group_id'] . '\', \'products_price_gross_' . $customers_group['customers_group_id'] . '\');' . "\n" .
                              'updateGross(\'products_special_price_' . $customers_group['customers_group_id'] . '\', \'products_special_price_gross_' . $customers_group['customers_group_id'] . '\');';
                              
      $update_net_string .= 'updateNet(\'products_price_gross_' . $customers_group['customers_group_id'] . '\', \'products_price_' . $customers_group['customers_group_id'] . '\');' . "\n" .
                            'updateNet(\'products_special_price_gross_' . $customers_group['customers_group_id'] . '\', \'products_special_price_' . $customers_group['customers_group_id'] . '\');';
      
      if ($customers_group['customers_group_id'] != 0) $update_checked_string .= 'updateChecked(\'' . $customers_group['customers_group_id'] . '\');';

      $javascript .= "\n" . '$(function() {' . "\n" .  
                     '  $( "#special_expires_date_' . $customers_group['customers_group_id'] . '" ).datepicker({' . "\n" .
                     '    changeMonth: true,' . "\n" .
                     '    changeYear: true' . "\n" .
                     '  });' . "\n" .
                     '});' . "\n";                                                                                  
    }

    $javascript .= "\n" .'function toggle(targetId, iState) {' . "\n" .
                   '  var obj = document.getElementById(targetId).style;' . "\n" .
                   '  if (obj.display == "none" && iState != 0 && iState != 1){' . "\n" .
                   '    obj.display="";' . "\n" .
                   '  } else if (iState != 0 && iState != 1){' . "\n" .
                   '    obj.display="none";' . "\n" .
                   '  }' . "\n" .
                   '  if (iState == 1){' . "\n" .
                   '    obj.display="";' . "\n" .
                   '  } else if (iState == 0){' . "\n" .
                   '    obj.display="none";' . "\n" .
                   '  }' . "\n" .                    
                   '}' . "\n\n" . 

                   'function updateChecked(cuID) {' . "\n" .
                   '  var selected = document.forms["' . $form_action . '"].elements["option[" + cuID + "]"].checked;' . "\n" .
                   '  if (selected) {' . "\n" .
                   '    toggle("box_" + cuID,1);' . "\n" .
                   '  } else {' . "\n" .
                   '    toggle("box_" + cuID,0);' . "\n" . 
                   '  }' . "\n" .
                   '}' . "\n\n" .
                                     
                   'function doRound(x, places) {' . "\n" .
                   '  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);' . "\n" .
                   '}' . "\n\n" .

                   'function getTaxRate() {' . "\n" .
                   '  var selected_value = document.forms["' . $form_action . '"].tax_rates_final_id.selectedIndex;' . "\n" .
                   '  var parameterVal = document.forms["' . $form_action . '"].tax_rates_final_id[selected_value].value;' . "\n\n" .

                   '  if ( (parameterVal > 0) && (tax_rates[parameterVal] > 0) ) {' . "\n" .
                   '    return tax_rates[parameterVal];' . "\n" .
                   '  } else {' . "\n" .
                   '    return 0;' . "\n" .
                   '  }' . "\n" .
                   '}' . "\n\n" .                  
                   
                   'function updateGross(inField, setField) {' . "\n" .
                   '  var taxRate = getTaxRate();' . "\n" .
                   '  var grossValue = document.forms["' . $form_action . '"].elements[inField].value;' . "\n\n" .

                   '  if (taxRate > 0) {' . "\n" .
                   '    grossValue = grossValue * ((taxRate / 100) + 1);' . "\n" .
                   '  }' . "\n\n" .

                   '  document.forms["' . $form_action . '"].elements[setField].value = doRound(grossValue, 4);' . "\n" .
                   '}' . "\n\n" .

                   'function updateNet(inField, setField) {' . "\n" .
                   '  var taxRate = getTaxRate();' . "\n" .
                   '  var netValue = document.forms["' .$form_action . '"].elements[inField].value;' . "\n\n" .

                   '  if (taxRate > 0) {' . "\n" .
                   '    netValue = netValue / ((taxRate / 100) + 1);' . "\n" .
                   '  }' . "\n\n" . 

                   '  document.forms["' . $form_action . '"].elements[setField].value = doRound(netValue, 4);' . "\n" .
                   '}' . "\n\n" . 
                   
                   'function updatePrices(net, gross) {' . "\n\n" .
                 
                   '  if (gross) {' . "\n" .
                   '    ' . $update_gross_string . "\n" .
                   '  }' . "\n\n" . 
                 
                   '  if (net) {' . "\n" .
                   '    ' . $update_net_string . "\n" .
                   '  }' . "\n\n" . 
                                   
                   '}' . "\n\n" .
                   
//                   '$(function() {' . "\n" .                                                                          
//                   '  $( "#ui-datepicker-div" ).css( "font-size", "75%" );' . "\n" .
//                   '});' . "\n\n" .
                   
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n";

    if ($product['products_status'] == '1') {
      $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10);
    } else {
      $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10);
    }

    
    if (isset($_GET['pID'])) {
      $smarty->assign('update', true);
    }

    if ($messageStack->size('price_error') > 0) {
      $smarty->assign('message_price_error', $messageStack->output('price_error'));
    }

    $smarty->assign(array('edit_prices' => true, 
                          'product_id' => $product['products_id'],
                          'product_model' => $product['products_model'],
                          'product_status_image' => $products_status_image,
                          'product_name' => $product['products_name'],    
                          'javascript' => $javascript,
                          'form_begin' => xos_draw_form($form_action, FILENAME_UPDATE_PRODUCTS_PRICES, 'product_ID=' . $product['products_id'] . '&categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows'] . '&page=' . $_GET['page'] . ($_GET['specials_only'] ? '&specials_only=' . $_GET['specials_only'] : '') . '&action=' . $form_action, 'post', 'onsubmit="return confirm(\'' . JS_CONFIRM_UPDATE . '\')" enctype="multipart/form-data"'),
                          'pull_down_products_tax_class' => xos_draw_pull_down_menu('products_tax_class_id', $tax_class_array, $product['products_tax_class_id']),
                          'pull_down_tax_rates' => xos_draw_pull_down_menu('tax_rates_final_id', $tax_rates_final_array, '', 'onchange="updatePrices(false, true)"'),
                          'update_prices' => 'updatePrices(true, true)',
                          'update_checked_string' => $update_checked_string,
                          'customers_groups' => $customers_groups_array,
                          'hidden_price_array' => xos_draw_hidden_field('price_array', $product['products_price']),
                          'link_filename_update_products_prices' => xos_href_link(FILENAME_UPDATE_PRODUCTS_PRICES, 'categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows'] . '&page=' . $_GET['page'] . ($_GET['specials_only'] ? '&specials_only=' . $_GET['specials_only'] : ''))));
    
  }

  $smarty->assign('form_end', '</form>');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'update_products_prices');
  $output_update_products_prices = $smarty->fetch(ADMIN_TPL . '/update_products_prices.tpl');
  
  $smarty->assign('central_contents', $output_update_products_prices);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');
  
  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
