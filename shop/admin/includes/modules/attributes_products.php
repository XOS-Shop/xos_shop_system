<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : attributes_products.php
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
//              filename: products_attributes.php                       
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/modules/attributes_products.php') == 'overwrite_all')) :
  if ($action == 'update_attribute') {
    $form_action = 'update_product_attribute';
  } else {
    $form_action = 'add_product_attributes';
  }
  
  if ($categories_or_pages_id) $includes_categories = xos_get_categories_string($categories_or_pages_id, true);
  
  $max_rows_per_page = $_GET['max_rows'] ? $_GET['max_rows'] : MAX_ROW_LISTS_OPTIONS;  
  $attributes_next = $attributes_prev = $attributes = "select distinct pa.*, p.products_status, p.attributes_quantity, p.attributes_combinations, p.attributes_not_updated, pd.products_name, po.products_options_name, pov.products_options_values_name from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_PRODUCTS_OPTIONS . " po, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where" . ($pID ? " pa.products_id ='" . $pID . "' and" : "" ) . " pa.products_id = p.products_id and pa.products_id = pd.products_id and pa.products_id = p2c.products_id and pa.options_id = po.products_options_id and pa.options_values_id = pov.products_options_values_id and pd.language_id = po.language_id and pd.language_id = pov.language_id and pd.language_id = '" . (int)$_SESSION['used_lng_id'] . "'" . ($categories_or_pages_id ? " and (" . $includes_categories . ")" : "") . ($manufacturers_id ? " and p.manufacturers_id ='" . $manufacturers_id . "'" : "" ) . " order by pd.products_name, pa.options_sort_order, po.products_options_id, pa.options_values_sort_order, pov.products_options_values_name";
  $attributes_split = new splitPageResults($attribute_page, $max_rows_per_page, $attributes, $attributes_query_numrows, 'pa.products_attributes_id');

  $offset = ($max_rows_per_page * ($attribute_page - 1));
  $attributes_prev .= " limit " . max($offset - 1, 0) . ", 1";
  $attributes_next .= " limit " . max($offset + $max_rows_per_page, 0) . ", 1";

  $offset > 0 ? $attributes_prev = xos_db_fetch_array(xos_db_query($attributes_prev)) : $attributes_prev = array();
  $attributes_next = xos_db_fetch_array(xos_db_query($attributes_next));

  $attributes = xos_db_query($attributes);
  $attributes_value = array();
  $rows = 0;
  while ($attributes_values = xos_db_fetch_array($attributes)) {

    if ($attributes_values['products_id'] == $attributes_prev['products_id']) {
      $previous_product_is_the_same = true;
    }
    
    if ($attributes_values['products_id'] == $attributes_next['products_id']) {
      $next_product_is_the_same = true;
    }    
  
    if ($attributes_values['products_id'] != $products_id) {
      $more_options = false;
      $products_id = $attributes_values['products_id'];
      $products_name = $attributes_values['products_name'];

      if ($attributes_values['products_status'] == '1') {
        $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10);
      } else {
        $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10);
      }            
    } else {
      $more_options = true;
      $products_name = '';
      $products_status_image = '';
    } 
    
    if ($attributes_values['options_id'] != $options_id || $products_name != '') {
      $more_options_values = false;
      $options_id = $attributes_values['options_id'];
      $options_name = $attributes_values['products_options_name'];
    } else {
      $more_options_values = true;
      $options_name = '';
    }  
    
    $values_name = $attributes_values['products_options_values_name'];
    
    $inputs_options_name = '';
    $inputs_options_value = '';
    $attribute_action = '';
    if (($action == 'update_attribute') && ($_GET['attribute_id'] == $attributes_values['products_attributes_id'])) { 
      $attribute_action = 'update'; 

      $inputs_options_name .= '<select name="options_id" class="smallText" onchange="update_option_values(this.form);">';
      $options = xos_db_query("select distinct po.* from " . TABLE_PRODUCTS_OPTIONS . " po, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po where po.products_options_id = pov2po.products_options_id and po.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by po.products_options_id");
      while($options_values = xos_db_fetch_array($options)) {
        if ($attributes_values['options_id'] == $options_values['products_options_id']) {
          $inputs_options_name .= '<option value="' . $options_values['products_options_id'] . '" selected="selected">' . $options_values['products_options_name'] . '</option>';
        } else {
          $inputs_options_name .= '<option value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
        }
      }
      $inputs_options_name .= '</select>'; 

      $inputs_options_value .= '<select name="values_id" class="smallText">';
      $values = xos_db_query("select pov.products_options_values_id, pov.products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po where pov.products_options_values_id = pov2po.products_options_values_id and pov2po.products_options_id = '" . $attributes_values['options_id'] . "' and pov.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by pov.products_options_values_name"); 
      while($values_values = xos_db_fetch_array($values)) {
        if ($attributes_values['options_values_id'] == $values_values['products_options_values_id']) {
          $inputs_options_value .= '<option value="' . $values_values['products_options_values_id'] . '" selected="selected">' . $values_values['products_options_values_name'] . '</option>';
        } else {
          $inputs_options_value .= '<option value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
        }
      }
      $inputs_options_value .= '</select>'; 

      if (DOWNLOAD_ENABLED == 'true') {
        $download_query_raw ="select products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount 
                              from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " 
                              where products_attributes_id='" . $attributes_values['products_attributes_id'] . "'";
        $download_query = xos_db_query($download_query_raw);
        if (xos_db_num_rows($download_query) > 0) {
          $download = xos_db_fetch_array($download_query);
          $products_attributes_filename = $download['products_attributes_filename'];
          $products_attributes_maxdays  = $download['products_attributes_maxdays'];
          $products_attributes_maxcount = $download['products_attributes_maxcount'];
        } else {
          $products_attributes_maxdays  = DOWNLOAD_MAX_DAYS;
          $products_attributes_maxcount = DOWNLOAD_MAX_COUNT;      
        }
      }

    } elseif (($action == 'delete_product_attribute') && ($_GET['attribute_id'] == $attributes_values['products_attributes_id'])) {    
      $attribute_action = 'delete';   
    }
    
    $more_options == false && $attributes_value[$rows-1]['products_id'] != $attributes_prev['products_id'] && $attributes_value[$rows-1]['action'] == 'delete' ? $attributes_value[$rows-1]['products_name'] = '<span style="color : red; font-weight : bold;">' . $attributes_value[$rows-1]['products_name'] . '</span>' : '';
    $more_options_values == false && $attributes_value[$rows-1]['options_id'] != $attributes_prev['options_id'] && $attributes_value[$rows-1]['action'] == 'delete' ? $attributes_value[$rows-1]['option_name'] = '<span style="color : red; font-weight : bold;">' . $attributes_value[$rows-1]['option_name'] . '</span>' : '';

    $attributes_value[]=array('action' => $attribute_action,
                              'inputs_options_name' => $inputs_options_name,
                              'inputs_options_value' => $inputs_options_value,
                              'products_name' => $products_name,
                              'products_status_image' => $products_status_image,                                                       
                              'option_name' => $options_name,
                              'attributes_up_to_date' => xos_not_null($attributes_values['attributes_combinations']) && !xos_not_null($attributes_values['attributes_not_updated']) ?  true : false,
                              'box_id_combs' => 'box_qty' . $attributes_values['products_id'],                               
                              'attributes_combs_list_url' => xos_href_link(FILENAME_ATTRIBUTE_LISTS, 'action=combinations&products_id=' . $attributes_values['products_id']),
                              'attributes_options_sort_url' => xos_href_link(FILENAME_ATTRIBUTE_LISTS, 'action=options_sort&products_id=' . $attributes_values['products_id']),
                              'attributes_options_values_sort_url' => xos_href_link(FILENAME_ATTRIBUTE_LISTS, 'action=options_values_sort&options_id=' . $attributes_values['options_id'] . '&products_id=' . $attributes_values['products_id']),                              
                              'box_id_sort_options' => 'box_' . $attributes_values['products_id'],
                              'box_id_sort_options_values' => 'box_' . $attributes_values['products_id'] . '_' . $attributes_values['options_id'],
                              'value_name' => $values_name,
                              'values_price' => '<span id="values_price_' . $attributes_values['products_attributes_id'] . '">' . (string)round($attributes_values["options_values_price"], 4) . '</span>',
                              'values_price_gross' => '<span id="values_price_gross_' . $attributes_values['products_attributes_id'] . '">' . (string)round($attributes_values["options_values_price"], 4) . '</span>',
                              'price_prefix' => $attributes_values["price_prefix"],                                                 
                              'hidden_ids' => '<input type="hidden" name="products_id" value="' . $attributes_values['products_id'] . '" /><input type="hidden" name="attribute_id" value="' . $attributes_values['products_attributes_id'] . '" /><input type="hidden" name="current_options_id" value="' . $attributes_values['options_id'] . '" /><input type="hidden" name="current_options_values_id" value="' . $attributes_values['options_values_id'] . '" />',                             
                              'input_value_price' => '<input type="text" name="value_price" value="' . $attributes_values['options_values_price'] . '" class="smallText" style="text-align:right;" size="6" onkeyup="updateGross(\'value_price\', \'value_price_gross\')" />',
                              'input_value_price_gross' => '<input type="text" name="value_price_gross" value="' . $attributes_values['options_values_price'] . '" class="smallText" style="text-align:right;" size="6" onkeyup="updateNet(\'value_price_gross\', \'value_price\')" />',                                                            
                              'input_price_prefix' => '<input type="text" name="price_prefix" value="' . $attributes_values['price_prefix'] . '" class="smallText" style="text-align:center;" size="1" />',
                              'input_attributes_filename' => xos_draw_input_field('products_attributes_filename', $products_attributes_filename, 'class="smallText" size="15"'),
                              'input_attributes_maxdays' => xos_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'class="smallText" size="5"'),
                              'input_attributes_maxcount' => xos_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'class="smallText" size="5"'),
                              'link_filename_products_attributes_attribute_page' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $parameter_string),
                              'link_filename_products_attributes_delete_attribute' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_attribute&attribute_id=' . $_GET['attribute_id'] . '&products_id=' . $_GET['products_id'] . '&' . $parameter_string),
                              'link_filename_products_attributes_option_page' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $parameter_string),
                              'link_filename_products_attributes_update' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&' . $parameter_string),
                              'link_filename_products_attributes_delete_product_attribute' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_product_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&products_id=' . $attributes_values['products_id'] . '&' . $parameter_string));                          
                              
    $update_gross_string .= 'updateGross(\'values_price_' . $attributes_values['products_attributes_id'] . '\', \'values_price_gross_' . $attributes_values['products_attributes_id'] . '\');';
                              
    $update_net_string .= 'updateNet(\'values_price_gross_' . $attributes_values['products_attributes_id'] . '\', \'values_price_' . $attributes_values['products_attributes_id'] . '\');';
    
    $rows++;
  }
  
  $more_options == false && $attributes_value[$rows-1]['products_id'] != $attributes_prev['products_id'] && $attributes_value[$rows-1]['products_id'] != $attributes_next['products_id'] && $attributes_value[$rows-1]['action'] == 'delete' ? $attributes_value[$rows-1]['products_name'] = '<span style="color : red; font-weight : bold;">' . $attributes_value[$rows-1]['products_name'] . '</span>' : '';
  $more_options_values == false && $attributes_value[$rows-1]['options_id'] != $attributes_prev['options_id'] && $attributes_value[$rows-1]['options_id'] != $attributes_next['options_id'] && $attributes_value[$rows-1]['action'] == 'delete' ? $attributes_value[$rows-1]['option_name'] = '<span style="color : red; font-weight : bold;">' . $attributes_value[$rows-1]['option_name'] . '</span>' : '';   
  
  $update_gross_string .= 'updateGross(\'value_price\', \'value_price_gross\');';
  $update_net_string .= 'updateNet(\'value_price_gross\', \'value_price\');';
  
  $tax_rates_final_array = array(array('id' => '0', 'text' => TEXT_NONE));
  $tax_rates_final_query = xos_db_query("select tr.tax_rates_final_id, tc.tax_class_title, gz.geo_zone_name, tr.tax_rate_final from " . TABLE_TAX_RATES_FINAL . " tr, " . TABLE_TAX_CLASS . " tc, " . TABLE_GEO_ZONES . " gz where tr.tax_class_id = tc.tax_class_id and tr.tax_zone_id = gz.geo_zone_id order by tc.tax_class_title, gz.geo_zone_name");
  while ($tax_rates_final= xos_db_fetch_array($tax_rates_final_query)) {
    $tax_rates_final_array[] = array('id' => $tax_rates_final['tax_rates_final_id'],
                                     'text' => $tax_rates_final['tax_class_title'] . ' (' . $tax_rates_final['geo_zone_name'] . ') [' . $tax_rates_final['tax_rate_final'] . '%]',
                                     'value' => $tax_rates_final['tax_rate_final']);
  }
  
// javascript to dynamically update the option values list when the option name is changed
// TABLES: products_options, products_options_values, products_options_values_to_products_options
  function xos_js_option_values_list($option_name, $form, $field) {
    $options_query = xos_db_query("select distinct po.products_options_id from " . TABLE_PRODUCTS_OPTIONS . " po, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po where po.products_options_id = pov2po.products_options_id and po.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by po.products_options_name");  
    $num_option_name = 1;
    $output_string = '';
    while ($options = xos_db_fetch_array($options_query)) {
      if ($num_option_name == 1) {
        $output_string .= '  if (' . $option_name . ' == "' . $options['products_options_id'] . '") {' . "\n";
      } else {
        $output_string .= '  } else if (' . $option_name . ' == "' . $options['products_options_id'] . '") {' . "\n";
      }

      $values_query = xos_db_query("select pov.products_options_values_id, pov.products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po where pov.products_options_values_id = pov2po.products_options_values_id and pov2po.products_options_id = '" . $options['products_options_id'] . "' and pov.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by pov.products_options_values_name");
      $num_option_value = 0;
      while ($values = xos_db_fetch_array($values_query)) {
        $output_string .= '    ' . $form . '.' . $field . '.options[' . $num_option_value . '] = new Option("' . $values['products_options_values_name'] . '", "' . $values['products_options_values_id'] . '");' . "\n";
        $num_option_value++;
      }
      $num_option_name++;
    }
    $output_string .= '  }' . "\n";

    return $output_string;
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
                 '  var selected_value = document.getElementById("tax_rates_final_id").selectedIndex;' . "\n" .
                 '  var parameterVal = document.getElementById("tax_rates_final_id")[selected_value].value;' . "\n\n" .

                 '  if ( (parameterVal > 0) && (tax_rates[parameterVal] > 0) ) {' . "\n" .
                 '    return tax_rates[parameterVal];' . "\n" .
                 '  } else {' . "\n" .
                 '    return 0;' . "\n" .
                 '  }' . "\n" .
                 '}' . "\n\n" .                  
                   
                 'function updateGross(inField, setField) {' . "\n" .
                 '  var taxRate = getTaxRate();' . "\n" .
                 '  if (document.forms["attribute"].elements[inField]) {' . "\n" .
                 '    var grossValue = document.forms["attribute"].elements[inField].value;' . "\n\n" .

                 '    if (taxRate > 0) {' . "\n" .
                 '      grossValue = grossValue * ((taxRate / 100) + 1);' . "\n" .
                 '    }' . "\n\n" .

                 '    document.forms["attribute"].elements[setField].value = doRound(grossValue, 4);' . "\n" .
                 '  } else if (document.getElementById(inField)) {' . "\n" .
                 '    var grossValue = document.getElementById(inField).innerHTML;' . "\n\n" .

                 '    if (taxRate > 0) {' . "\n" .
                 '      grossValue = grossValue * ((taxRate / 100) + 1);' . "\n" .
                 '    }' . "\n\n" .

                 '    document.getElementById(setField).innerHTML = doRound(grossValue, 4);' . "\n" .                 
                 '  }' . "\n" .
                 '}' . "\n\n" .

                 'function updateNet(inField, setField) {' . "\n" .
                 '  var taxRate = getTaxRate();' . "\n" .
                 '  if (document.forms["attribute"].elements[inField]) {' . "\n" .
                 '    var netValue = document.forms["attribute"].elements[inField].value;' . "\n\n" .

                 '    if (taxRate > 0) {' . "\n" .
                 '      netValue = netValue / ((taxRate / 100) + 1);' . "\n" .
                 '    }' . "\n\n" . 

                 '    document.forms["attribute"].elements[setField].value = doRound(netValue, 4);' . "\n" .
                 '  } else if (document.getElementById(inField)) {' . "\n" .
                 '    var netValue = document.getElementById(inField).innerHTML;' . "\n\n" .

                 '    if (taxRate > 0) {' . "\n" .
                 '      netValue = netValue / ((taxRate / 100) + 1);' . "\n" .
                 '    }' . "\n\n" . 

                 '    document.getElementById(setField).innerHTML = doRound(netValue, 4);' . "\n" .                 
                 '  }' . "\n" .
                 '}' . "\n\n" . 
                   
                 'function updatePrices(net, gross) {' . "\n\n" .
                 
                 '  if (gross) {' . "\n" .
                 '    ' . $update_gross_string . "\n" .
                 '  }' . "\n\n" . 
                 
                 '  if (net) {' . "\n" .
                 '    ' . $update_net_string . "\n" .
                 '  }' . "\n\n" . 
                                   
                 '}' . "\n\n" . 

                 'function update_option_values(the_form) {' . "\n" .
                 '  var num_value = the_form.values_id.options.length;' . "\n" .
                 '  var selected_options_name = "";' . "\n\n" .

                 '  while(num_value > 0) {' . "\n" .
                 '    num_value--;' . "\n" .
                 '    the_form.values_id.options[num_value] = null;' . "\n" .
                 '  }' . "\n\n" .         

                 '  selected_options_name = the_form.options_id.options[the_form.options_id.selectedIndex].value;' . "\n\n" .

                 xos_js_option_values_list('selected_options_name', 'the_form', 'values_id') . "\n" .

                 '}' . "\n\n" .

                 'function toggle_box_sort(box_id) {' . "\n" .                 
                 '  var divTag = document.forms["attribute"].getElementsByTagName("div");' . "\n\n" . 
              
                 '  for (var i = 0; i < divTag.length; ++i){' . "\n" .
                 '    divTag[i].style.display="none";' . "\n" .
                 '  }' . "\n\n" .
                 
                 '  if (document.getElementById(box_id+"_1")) {' . "\n" .
                 '    document.getElementById(box_id+"_1").style.display="";' . "\n" .
                 '    document.getElementById(box_id+"_2").style.display="";' . "\n" .
                 '  }' . "\n\n" .
                 
                 '}' . "\n\n" .
                 
                 'function update_action(product_id, option_id, action) {' . "\n" .                                
                 '  document.forms["attribute"].action="' . xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES) . (SID ? '&' : '?') . 'action=" + action + "&products_id=" + product_id + "&options_id=" + option_id + "&' . $parameter_string . '";' . "\n" .                 
                 '}' . "\n\n" .                                  

                   'function get_attribute_lists(url, box_id_combs) {' . "\n\n" .

                   '  box_id = box_id_combs;' . "\n\n" .                     

                   '  http_request = false;' . "\n\n" .

                   '  if (window.XMLHttpRequest) { // Mozilla, Safari,...' . "\n" .
                   '    http_request = new XMLHttpRequest();' . "\n" .
                   '    if (http_request.overrideMimeType) {' . "\n" .
                   '      http_request.overrideMimeType("text/html");' . "\n" .
                   '    }' . "\n" .
                   '  } else if (window.ActiveXObject) { // IE' . "\n" .
                   '    try {' . "\n" .
                   '      http_request = new ActiveXObject("Msxml2.XMLHTTP");' . "\n" .
                   '    } catch (e) {' . "\n" .
                   '      try {' . "\n" .
                   '        http_request = new ActiveXObject("Microsoft.XMLHTTP");' . "\n" .
                   '      } catch (e) {}' . "\n" .
                   '    }' . "\n" .
                   '  }' . "\n\n" .

                   '  if (!http_request) {' . "\n" .
                   '    alert("Ende : Kann keine XMLHTTP-Instanz erzeugen");' . "\n" .
                   '    return false;' . "\n" .
                   '  }' . "\n" .
                   '  http_request.onreadystatechange = response_processing_list;' . "\n" .
                   '  http_request.open("GET", url, true);' . "\n" .
                   '  http_request.send(null);' . "\n\n" .
                      
                   '}' . "\n\n" .                   
                                      
                   'function response_processing_list() {' . "\n" .
                   '  if (http_request.readyState == 1) {' . "\n" .
//                   '    document.getElementById("loading_list").style.display = "";' . "\n" .                                                                                        
                   '  } else if (http_request.readyState == 4) {' . "\n" .
                   '    if (http_request.status == 200) {' . "\n" .
//                   '      alert(http_request.responseText);' . "\n" .
                   '      document.getElementById(box_id+"_2").innerHTML = http_request.responseText;' . "\n" .                                       
                   '    } else {' . "\n" .
                   '      alert("Bei dem Request ist ein Problem aufgetreten.");' . "\n" .
                   '    }' . "\n" .
                   '  }' . "\n" .
                   '}' . "\n\n" . 
                   
                 '/* ]]> */' . "\n" .
                 '</script>' . "\n";  
                  
  $smarty->assign(array('form_begin_tax_rates' => xos_draw_form('tax_rates', FILENAME_PRODUCTS_ATTRIBUTES, '', 'get'),  
                        'pull_down_tax_rates' => xos_draw_pull_down_menu('selected_tax_rate_id', $tax_rates_final_array, $_GET['selected_tax_rate_id'], 'id="tax_rates_final_id" class="smallText" onchange="this.form.submit();"'),
                        'hidden_fields' =>  xos_draw_hidden_field('pID', $pID) . xos_draw_hidden_field('cPath', $cPath) . xos_draw_hidden_field('categories_or_pages_id', $categories_or_pages_id) . xos_draw_hidden_field('manufacturers_id', $manufacturers_id) . xos_draw_hidden_field('max_rows', $_GET['max_rows']) . xos_draw_hidden_field('max_products_in_pullwown', $_GET['max_products_in_pullwown']) . xos_draw_hidden_field('option_page', $_GET['option_page']) . xos_draw_hidden_field('value_page', $_GET['value_page']) . xos_draw_hidden_field('attribute_page', $_GET['attribute_page']) . ((SID) ? xos_draw_hidden_field(xos_session_name(), xos_session_id()) : ''),
                        'form_begin_attributes' => '<form name="attribute" action="' . xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=' . $form_action . '&' . $parameter_string) . '" method="post">',                        
                        'previous_product_the_same' => $previous_product_is_the_same,
                        'next_product_the_same' => $next_product_is_the_same,
                        'javascript' => $javascript,
                        'update_prices' => 'updatePrices(true, true)',  
                        'split_page' => $attributes_split->display_links($attributes_query_numrows, $_GET['max_rows'] ? $_GET['max_rows'] : MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $attribute_page, $cmm_parameter_string . '&option_page=' . $option_page . '&value_page=' . $value_page, 'attribute_page'),
                        'attributes' => $attributes_value));
  
  if ($action != 'update_attribute') {
  
    $smarty->assign('insert_new_attribute', true);
    
    $products = xos_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where" . ($pID ? " pd.products_id ='" . $pID . "' and" : "" ) . " pd.products_id = p.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['used_lng_id'] . "'" . ($categories_or_pages_id ? " and (" . $includes_categories . ")" : "") . ($manufacturers_id ? " and p.manufacturers_id ='" . $manufacturers_id . "'" : "" ) . " order by pd.products_name LIMIT " . ($_GET['max_products_in_pullwown'] ? $_GET['max_products_in_pullwown'] : MAX_PRODUCTS_IN_PULLDOWN) . "");
    if (xos_db_num_rows($products) > 0) {
      $inputs_products_name = '<select name="products_id" class="smallText">';
      while ($products_values = xos_db_fetch_array($products)) {
        $inputs_products_name .= '<option value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
      }
      $inputs_products_name .= '</select>';
    } else {
      $smarty->assign('no_products', true);
    }  

    $inputs_options_name = '<select name="options_id" class="smallText" onchange="update_option_values(this.form);">'; 
    $options = xos_db_query("select distinct po.* from " . TABLE_PRODUCTS_OPTIONS . " po, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po where po.products_options_id = pov2po.products_options_id and po.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by po.products_options_id");
    while ($options_values = xos_db_fetch_array($options)) {
      if (!isset($first_options_id))  $first_options_id = $options_values['products_options_id'];
      $inputs_options_name .= '<option value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
    }
    $inputs_options_name .= '</select>'; 

    $inputs_options_value = '<select name="values_id" class="smallText">';
    $values = xos_db_query("select pov.products_options_values_id, pov.products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po where pov.products_options_values_id = pov2po.products_options_values_id and pov2po.products_options_id = '" . $first_options_id . "' and pov.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by pov.products_options_values_name"); 
    while ($values_values = xos_db_fetch_array($values)) {
      $inputs_options_value .= '<option value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
    }
    $inputs_options_value .= '</select>'; 

    if (DOWNLOAD_ENABLED == 'true') {
      $products_attributes_maxdays  = DOWNLOAD_MAX_DAYS;
      $products_attributes_maxcount = DOWNLOAD_MAX_COUNT;
    }

    $smarty->assign(array('inputs_products_name' => $inputs_products_name,
                          'inputs_options_name' => $inputs_options_name,
                          'inputs_options_value' => $inputs_options_value,
                          'input_value_price' => '<input type="text" name="value_price" class="smallText" style="text-align:right;" size="6" onkeyup="updateGross(\'value_price\', \'value_price_gross\')" />',
                          'input_value_price_gross' => '<input type="text" name="value_price_gross" class="smallText" style="text-align:right;" size="6" onkeyup="updateNet(\'value_price_gross\', \'value_price\')" />',                                                       
                          'input_price_prefix' => '<input type="text" name="price_prefix" class="smallText" style="text-align:center;" size="1" value="+" />',
                          'input_attributes_filename' => xos_draw_input_field('products_attributes_filename', $products_attributes_filename, 'class="smallText" size="15"'),
                          'input_attributes_maxdays' => xos_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'class="smallText" size="5"'),
                          'input_attributes_maxcount' => xos_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'class="smallText" size="5"')));
     
  }
  
  if (DOWNLOAD_ENABLED == 'true') {
    $smarty->assign('download', true);
  }
  
  $smarty->assign('form_end', '</form>');  

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'products_attributes');
  $output_attributes_products = $smarty->fetch(ADMIN_TPL . '/includes/modules/attributes_products.tpl');
  $smarty->clearAssign(array('form_begin_tax_rates',
                              'pull_down_tax_rates',
                              'hidden_fields',
                              'form_begin_attributes',
                              'previous_product_the_same',
                              'next_product_the_same',
                              'javascript',
                              'update_prices',
                              'split_page',
                              'attributes',
                              'insert_new_attribute',
                              'no_products',
                              'next_id',
                              'inputs_products_name',
                              'inputs_options_name',
                              'inputs_options_value',
                              'input_value_price',
                              'input_value_price_gross',
                              'input_price_prefix',
                              'input_attributes_filename',
                              'input_attributes_maxdays',
                              'input_attributes_maxcount',
                              'download',
                              'form_end'));  
  
  $smarty->assign('attributes_products', $output_attributes_products);
endif;
?>
