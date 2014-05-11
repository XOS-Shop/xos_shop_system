<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : new_product.php
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
//              filename: categories.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/modules/new_product.php') == 'overwrite_all')) :  
    $form_action = (isset($_GET['pID'])) ? 'update_product' : 'insert_product';
  
    $parameters = array('products_name' => '',
                        'products_p_unit' => '',
                        'products_info' => '',
                        'products_description' => '',
                        'products_url' => '',
                        'products_id' => '',
                        'products_quantity' => '',
                        'products_sort_order' => '',
                        'products_model' => '',
                        'products_image' => '',
                        'products_price' => '',
                        'products_weight' => '',
                        'products_date_added' => '',
                        'products_last_modified' => '',
                        'products_date_available' => '',
                        'products_status' => '',
                        'products_tax_class_id' => '',
                        'manufacturers_id' => '',
                        'attributes_quantity' => '');

    $pInfo = new objectInfo($parameters);

    if (isset($_GET['pID'])) {
      $product_query = xos_db_query("select p.products_id, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_sort_order, p.products_weight, p.products_date_added, p.products_last_modified, date_format(p.products_date_available, '" . DATE_FORMAT_SHORT . "') as products_date_available, p.products_status, p.products_tax_class_id, p.manufacturers_id, p.attributes_quantity, p.attributes_not_updated from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$_GET['pID'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
      $product = xos_db_fetch_array($product_query);

      $pInfo->objectInfo($product);
    }
   
    $products_image = xos_get_product_images($pInfo->products_image, 'all');

    $manufacturers_array = array(array('id' => '', 'text' => TEXT_NONE));
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

    $languages = xos_get_languages();

    if (!isset($pInfo->products_status)) $pInfo->products_status = '1';
    switch ($pInfo->products_status) {
      case '0': $in_status = false; $out_status = true; break;
      case '1':
      default: $in_status = true; $out_status = false;
    }  

    $customers_group_query = xos_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id");
    
    $products_prices = xos_get_product_prices($pInfo->products_price);
  
    $update_gross_string = '';
    $update_net_string = '';
    $update_checked_string = '';
    $customers_groups_array = array();
    $error_groups = array();
    
    if (isset($_GET['errGr'])) $error_groups = explode(',', $_GET['errGr']);

    $javascript = '<script type="text/javascript">' . "\n" .
                  '/* <![CDATA[ */' . "\n";
    $javascript .= 'var tax_rates = new Array();' . "\n";
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

      $special_expires_date_query = xos_db_query("select date_format(expires_date, '" . DATE_FORMAT_SHORT . "') as expires_date from " . TABLE_SPECIALS . " where products_id = '" . (int)$pInfo->products_id . "' and customers_group_id = '" . (int)$customers_group['customers_group_id'] . "'");
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
       
    $javascript .= "\n" . 'function toggle(targetId, iState) {' . "\n" .
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
                   
                   'function caching_qty(fdName) {' . "\n" .
                   '  current_qty = document.forms["' . $form_action . '"].elements[fdName].value;' . "\n" .
                   '}' . "\n\n" . 
                   
                   'function update_total_qty(fdName) {' . "\n" .                   
                   '  var total_qty = parseInt(document.getElementById("total_qty").innerHTML, 10);' . "\n" .
                   '  var new_qty = parseInt(document.forms["' . $form_action . '"].elements[fdName].value, 10);' . "\n" .
                   '  var old_qty = parseInt(current_qty, 10);' . "\n\n" .                   

                   '  if (old_qty > 0) {' . "\n" .                   
                   '    total_qty = total_qty - old_qty;' . "\n" .
                   '  }' . "\n\n" . 
                   
                   '  if (new_qty > 0) {' . "\n" .                   
                   '    total_qty = total_qty + new_qty;' . "\n" .
                   '  }' . "\n\n" .                    
                                    
                   '  document.getElementById("total_qty").innerHTML = total_qty;' . "\n" .                                      
                   '}' . "\n\n" .                                                                                                                 
                      
                   'function getAbsoluteX (elm) {' . "\n" .
                   '  var x = 0;' . "\n" .
                   '  if (elm && typeof elm.offsetParent != "undefined") {' . "\n" .
                   '    while (elm && typeof elm.offsetLeft == "number") {' . "\n" .
                   '      x += elm.offsetLeft;' . "\n" .
                   '      elm = elm.offsetParent;' . "\n" .
                   '    }' . "\n" .
                   '  }' . "\n" .
                   '  return x;' . "\n" .
                   '}' . "\n\n" . 
                      
                   'function toggleWithAbsoluteX(targetId) {' . "\n" .
                   '  var elem = document.getElementById(targetId);' . "\n" .                      
                   '  if (elem.style.display == "none"){' . "\n" .                  
                   '    elem.style.display="block";' . "\n" .                      
                   '    var x = getAbsoluteX(elem);' . "\n" . 
                   '    elem.style.display="none";' . "\n" .                                                                                                       
                   '    if (x < 0){' . "\n" .
                   '      oldRightValue = elem.style.right;' . "\n" .                                             
                   '      $("#"+targetId).css({"right" : x+"px"}).show(1);' . "\n" .
                   '    } else {' . "\n" . 
                   '      $("#"+targetId).show(1);' . "\n" . 
                   '    }' . "\n" . 
                   '  } else {' . "\n" .                     
                   '    if(typeof(oldRightValue) != "undefined" && oldRightValue != ""){' . "\n" .                                             
                   '      elem.style.right=oldRightValue;' . "\n" .
                   '    }' . "\n" .
                   '    elem.style.display="none";' . "\n" .                                             
                   '  }' . "\n" .                    
                   '}' . "\n\n" . 

                   'function get_attributes_qty_list(url) {' . "\n\n" .

                   '  if (typeof(isLoaded) != "undefined" && isLoaded == true) {' . "\n" .                               
                   '    toggleWithAbsoluteX("box_id_attribute_qty");' . "\n" .                                            
                   '  } else {' . "\n\n" .                       

                   '    http_request = false;' . "\n\n" .

                   '    if (window.XMLHttpRequest) { // Mozilla, Safari,...' . "\n" .
                   '      http_request = new XMLHttpRequest();' . "\n" .
                   '      if (http_request.overrideMimeType) {' . "\n" .
                   '        http_request.overrideMimeType("text/html");' . "\n" .
                   '      }' . "\n" .
                   '    } else if (window.ActiveXObject) { // IE' . "\n" .
                   '      try {' . "\n" .
                   '        http_request = new ActiveXObject("Msxml2.XMLHTTP");' . "\n" .
                   '      } catch (e) {' . "\n" .
                   '        try {' . "\n" .
                   '          http_request = new ActiveXObject("Microsoft.XMLHTTP");' . "\n" .
                   '        } catch (e) {}' . "\n" .
                   '      }' . "\n" .
                   '    }' . "\n\n" .

                   '    if (!http_request) {' . "\n" .
                   '      alert("Ende : Kann keine XMLHTTP-Instanz erzeugen");' . "\n" .
                   '      return false;' . "\n" .
                   '    }' . "\n" .
                   '    http_request.onreadystatechange = response_processing_list;' . "\n" .
                   '    http_request.open("GET", url, true);' . "\n" .
                   '    http_request.send(null);' . "\n\n" .
                                                  
                   '  }' . "\n\n" .
                      
                   '}' . "\n\n" .                   
                                      
                   'function response_processing_list() {' . "\n" .
                   '  if (http_request.readyState == 1) {' . "\n" .
                   '        $("#loading_list").show(1);' . "\n" .                                                                                        
                   '  } else if (http_request.readyState == 4) {' . "\n" .
                   '    if (http_request.status == 200) {' . "\n" .
//                   '      alert(http_request.responseText);' . "\n" .
                   '      document.getElementById("box_id_attribute_qty").innerHTML = http_request.responseText;' . "\n" .
                   '      document.getElementById("loading_list").style.display = "none";' . "\n" .
                   '      isLoaded = true;' . "\n" .                      
                   '      toggleWithAbsoluteX("box_id_attribute_qty");' . "\n" .                                          
                   '    } else {' . "\n" .
                   '      alert("Bei dem Request ist ein Problem aufgetreten.");' . "\n" .
                   '    }' . "\n" .
                   '  }' . "\n" .
                   '}' . "\n\n" .
                   
                   '$(function() {' . "\n" .                                                                                                    
                   '  $( "#products_date_available" ).datepicker({' . "\n" .
                   '    changeMonth: true,' . "\n" .
                   '    changeYear: true' . "\n" .
                   '  });' . "\n" .
                 
//                   "\n" . '  $( "#ui-datepicker-div" ).css( "font-size", "75%" );' . "\n\n" .
                 
                   '});' . "\n\n" .                    
                   
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n";                         
    
    $product_images = array();
    $more_images = false;
    for ($i=0;$i<$max_img;$i++) {
      $img_no = $i + 1;  

      $large_img_size = array();
      if (!empty($products_image[$i]['name'])) $large_img_size = @GetImageSize(DIR_FS_CATALOG_IMAGES . 'products/large/' . $products_image[$i]['name']);

      $product_images[]=array('img_no' => $img_no,
                              'selection_delete_image' => xos_draw_selection_field('delete_product_image_' . $i, 'checkbox', 'true'),
                              'radio_large_image_default_size' => xos_draw_radio_field('large_image_size_' . $i, 'default', true),   
                              'radio_large_image_uploaded_size' => xos_draw_radio_field('large_image_size_' . $i, 'uploaded', false),
                              'radio_large_image_input_size' => xos_draw_radio_field('large_image_size_' . $i, 'input', false),
                              'input_large_image_max_width' => xos_draw_input_field('large_image_max_width_' . $i, '', 'style="background: #fffffe;" size ="2"'),
                              'input_large_image_max_height' => xos_draw_input_field('large_image_max_height_' . $i, '', 'style="background: #fffffe;" size ="2"'),
                              'small_product_image_max_height' => SMALL_PRODUCT_IMAGE_MAX_HEIGHT,                              
                              'image' => xos_image(DIR_WS_CATALOG_IMAGES .'products/small/' . $products_image[$i]['name'], $pInfo->products_name),
                              'file_image' => xos_draw_file_field('products_image_'. $i),                            
                              'image_name' => $products_image[$i]['name'],
                              'large_img_width' => $large_img_size[0],
                              'large_img_height' => $large_img_size[1],
                              'large_img_base' => ($products_image[$i]['large_image_max_width'] == 'default' ? 'default_size' : ($products_image[$i]['large_image_max_width'] == '0' ? 'origin_size' : ((int)$products_image[$i]['large_image_max_width'] > 0 ? 'self_selected_size' : ''))),
                              'hidden_current_image' => xos_draw_hidden_field('current_product_image_' . $i, $products_image[$i]['name']));
                               
      if (empty($products_image[$i]['name'])) $more_images = true;  
    } 

    $product_values = array();    
    if (WYSIWYG_FOR_PRODUCT == 'true') {      
      $smarty->assign(array('wysiwyg' => true,
                            'link_filename_popup_file_manager_link_selection' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents')),
                            'link_filename_popup_file_manager_image' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/image')),
                            'link_filename_popup_file_manager_flash' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/flash')),
                            'product_config' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/product_config.js',
                            'lang_code' => xos_get_languages_code()));
    
    }
    
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
      
      (sizeof($languages) > 1) ? $sort_order = 'products_id' : $sort_order = 'products_p_unit';
      $products_p_units_array = array(array('id' => '', 'text' => TEXT_NONE));
      $products_p_units_query = xos_db_query("select distinct products_p_unit from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = '" . $languages[$i]['id'] . "' order by '" . $sort_order . "'");
      while ($products_p_units = xos_db_fetch_array($products_p_units_query)) {
          if (!empty($products_p_units['products_p_unit'])) $products_p_units_array[] = array('id' => $products_p_units['products_p_unit'], 'text' => $products_p_units['products_p_unit']);
      }       
      
      $product_values[]=array('languages_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                              'input_name' => xos_draw_input_field('products_name[' . $languages[$i]['id'] . ']', (isset($products_name[$languages[$i]['id']]) ? stripslashes($products_name[$languages[$i]['id']]) : xos_get_products_name($pInfo->products_id, $languages[$i]['id'])), 'size="30"'),
                              'input_description_tab_label' => xos_draw_input_field('products_description_tab_label[' . $languages[$i]['id'] . ']', (isset($products_description_tab_label[$languages[$i]['id']]) ? stripslashes($products_description_tab_label[$languages[$i]['id']]) : xos_get_products_description_tab_label($pInfo->products_id, $languages[$i]['id'])), 'size="90"'),
                              'pull_down_input_p_unit' => xos_draw_pull_down_menu('products_p_unit[' . $languages[$i]['id'] . ']', $products_p_units_array, (isset($products_p_unit[$languages[$i]['id']]) ? stripslashes($products_p_unit[$languages[$i]['id']]) : xos_get_products_p_unit($pInfo->products_id, $languages[$i]['id'])), 'style="width: 17em"'),                              
                              'input_new_p_unit' => xos_draw_input_field('products_new_p_unit[' . $languages[$i]['id'] . ']'),
                              'info_name' => 'products_info[' . $languages[$i]['id'] . ']',
                              'description_name' => 'products_description[' . $languages[$i]['id'] . ']',
                              'product_info_template_file' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/templates/' . $languages[$i]['directory'] . '/product_info_template.js',
                              'product_info_template_lang' => $languages[$i]['directory'] . '_default',
                              'product_description_template_file' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/templates/' . $languages[$i]['directory'] . '/product_description_template.js',
                              'product_description_template_lang' => $languages[$i]['directory'] . '_default',
                              'textarea_info' => xos_draw_textarea_field('products_info[' . $languages[$i]['id'] . ']', '90', '4', (isset($products_info[$languages[$i]['id']]) ? stripslashes($products_info[$languages[$i]['id']]) : xos_get_products_info($pInfo->products_id, $languages[$i]['id']))),
                              'textarea_description' => xos_draw_textarea_field('products_description[' . $languages[$i]['id'] . ']', '90', '15', (isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : xos_get_products_description($pInfo->products_id, $languages[$i]['id']))),
                              'input_url' => xos_draw_input_field('products_url[' . $languages[$i]['id'] . ']', (isset($products_url[$languages[$i]['id']]) ? stripslashes($products_url[$languages[$i]['id']]) : xos_get_products_url($pInfo->products_id, $languages[$i]['id']))));    
        
    }        
    
    $has_product_attributes = xos_has_product_attributes($pInfo->products_id);
   
    if (isset($_GET['pID'])) {
      $smarty->assign('update', true);
    }

    if ($messageStack->size('price_error') > 0) {
      $smarty->assign('message_price_error', $messageStack->output('price_error'));
    }

    $smarty->assign(array('javascript' => $javascript,
                          'form_begin' => xos_draw_form($form_action, FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . '&action=' . $form_action, 'post', 'onsubmit="return confirm(\'' . ($form_action == 'insert_product' ? JS_CONFIRM_INSERT : JS_CONFIRM_UPDATE) . '\')" enctype="multipart/form-data"'),
                          'text_new_product' => sprintf(TEXT_NEW_PRODUCT_3, ($form_action == 'insert_product' ? TEXT_NEW_PRODUCT_1 : TEXT_NEW_PRODUCT_2), xos_output_generated_category_path($current_category_id)),
                          'radio_products_status_1' => xos_draw_radio_field('products_status', '1', $in_status),   
                          'radio_products_status_0' => xos_draw_radio_field('products_status', '0', $out_status),
                          'pull_down_manufacturers' => xos_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $pInfo->manufacturers_id),
                          'pull_down_products_tax_class' => xos_draw_pull_down_menu('products_tax_class_id', $tax_class_array, $pInfo->products_tax_class_id),
                          'pull_down_tax_rates' => xos_draw_pull_down_menu('tax_rates_final_id', $tax_rates_final_array, '', 'onchange="updatePrices(false, true)"'),
                          'update_prices' => 'updatePrices(true, true)',
                          'update_checked_string' => $update_checked_string,
                          'customers_groups' => $customers_groups_array,
                          'input_products_date_available' => xos_draw_input_field('products_date_available', $pInfo->products_date_available, 'id="products_date_available" style="background: #ebebff; color : red;" size ="10"'),
                          'input_products_quantity' => STOCK_CHECK == 'true' ? ($has_product_attributes ? '<span id="total_qty">' . $pInfo->products_quantity . '</span>&nbsp;<a href="" onclick="get_attributes_qty_list(\'' . xos_href_link(FILENAME_ATTRIBUTES_QTY_LIST, 'products_id=' . $pInfo->products_id) . '\'); return false">' . xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_arrow_down.gif', '', 24, 15) . '</a>' . xos_draw_hidden_field('products_quantity', $pInfo->products_quantity): xos_draw_input_field('products_quantity', $pInfo->products_quantity, 'size ="8"')) : $pInfo->products_quantity,
                          'input_products_sort_order' => xos_draw_input_field('products_sort_order', $pInfo->products_sort_order, 'size ="8"'),
                          'input_products_model' => xos_draw_input_field('products_model', $pInfo->products_model),
                          'hidden_image_array' => xos_draw_hidden_field('image_array', $pInfo->products_image),
                          'hidden_price_array' => xos_draw_hidden_field('price_array', $pInfo->products_price),
                          'has_attributes_quantities' => STOCK_CHECK == 'true' && $has_product_attributes ? true : false,
                          'product_images' => $product_images,
                          'more_images' => $more_images,
                          'product_values' => $product_values,
                          'input_products_weight' => xos_draw_input_field('products_weight', $pInfo->products_weight, 'size ="8"'),
                          'hidden_products_date_added' => xos_draw_hidden_field('products_date_added', (xos_not_null($pInfo->products_date_added) ? $pInfo->products_date_added : date('Y-m-d'))),
                          'link_filename_categories' => xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '')),
                          'form_end' => '</form>'));
        
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'categories');
    $output_new_product = $smarty->fetch(ADMIN_TPL . '/includes/modules/new_product.tpl');
endif;
?>
