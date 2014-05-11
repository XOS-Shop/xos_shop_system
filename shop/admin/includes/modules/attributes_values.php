<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : attributes_values.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/modules/attributes_values.php') == 'overwrite_all')) :
  if ($action == 'delete_option_value') { // delete product option value
    $values = xos_db_query("select products_options_values_id, products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$_GET['value_id'] . "' and language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
    $values_values = xos_db_fetch_array($values);

    $products = xos_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and pa.products_id = p.products_id and pa.options_values_id='" . (int)$_GET['value_id'] . "' order by pd.products_name");
    if (xos_db_num_rows($products)) {

      $rows = 0;
      $products_value = array();
      while ($products_values = xos_db_fetch_array($products)) {
        $rows++;

        $products_value[]=array('id' => $products_values['products_id'],                            
                                'name' => $products_values['products_name']);

      }

      $smarty->assign(array('products_linked' => true,
                            'products' => $products_value,
                            'link_filename_products_attributes' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string)));

    } else {
    
      $smarty->assign(array('link_filename_products_attributes' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string),
                            'link_filename_products_attributes_delete' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_value&value_id=' . $_GET['value_id'] . '&options_page=1&' . $parameter_string)));    

    }

    $smarty->assign(array('delete_option_value' => true,
                          'products_options_values_name' => $values_values['products_options_values_name']));    

  } else {

    $options_value_error_array = unserialize(stripslashes(urldecode($_GET['options_value_error'])));
    $options_value_array = unserialize(stripslashes(urldecode($_GET['options_value'])));  
    $set_empty = false;
    $set_not_empty = false;
    
    $values_next = $values_prev = $values = "select po.products_options_id, po.products_options_name, pov.products_options_values_id, pov.products_options_values_name from " . TABLE_PRODUCTS_OPTIONS . " po, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov left join " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po on pov.products_options_values_id = pov2po.products_options_values_id where pov2po.products_options_id = po.products_options_id and po.language_id = pov.language_id and po.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by po.products_options_name, pov.products_options_values_name";
    $values_split = new splitPageResults($value_page, MAX_ROW_LISTS_OPTIONS, $values, $values_query_numrows);

    $offset = (MAX_ROW_LISTS_OPTIONS * ($value_page - 1));
    $values_prev .= " limit " . max($offset - 1, 0) . ", 1";
    $values_next .= " limit " . max($offset + MAX_ROW_LISTS_OPTIONS, 0) . ", 1";

    $offset > 0 ? $values_prev = xos_db_fetch_array(xos_db_query($values_prev)) : $values_prev = array();
    $values_next = xos_db_fetch_array(xos_db_query($values_next));

    $next_id = 1;
    $rows = 0;
    $values = xos_db_query($values);
    $options_value = array();
    while ($values_values = xos_db_fetch_array($values)) { 

      if ($values_values['products_options_id'] == $values_prev['products_options_id']) {
        $previous_option_is_the_same = true;
      }
    
      if ($values_values['products_options_id'] == $values_next['products_options_id']) {
        $next_option_is_the_same = true;
      }  
    
      if ($values_values['products_options_id'] != $options_id) {
        $options_id = $values_values['products_options_id'];
        $options_name = $values_values['products_options_name'];
      } else {
        $options_name = '';
      }      

      $values_name = $values_values['products_options_values_name'];
      
      $rows++;
      
      $error_message = '';
      $inputs_options_value = '';
      if (($action == 'update_option_value') && ($_GET['value_id'] == $values_values['products_options_values_id'])) {
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          if (isset($options_value_error_array[$languages[$i]['id']])) {
            if (empty($options_value_error_array[$languages[$i]['id']]) && !$set_empty) {
              $error_message .= sprintf(TEXT_OPTION_VALUE_NAME_ERROR_EMPTY, TEXT_OPTION_ERROR_EMPTY_MARK) . '<br />';
              $set_empty = true;
            } elseif ($options_value_error_array[$languages[$i]['id']] && !$set_not_empty) {
              $error_message .= sprintf(TEXT_OPTION_VALUE_NAME_ERROR, TEXT_OPTION_ERROR_MARK) . '<br />';
              $set_not_empty = true;
            }  
          }
                 
          $value_name = xos_db_query("select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$values_values['products_options_values_id'] . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          $value_name = xos_db_fetch_array($value_name);
          $inputs_options_value .= '<input type="text" name="value_name[' . $languages[$i]['id'] . ']" class="smallText" size="20" value="' . (isset($options_value_array[$languages[$i]['id']]) ? $options_value_array[$languages[$i]['id']] : $value_name['products_options_values_name']) . '" />&nbsp;' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . xos_draw_hidden_field('actual_value_name[' . $languages[$i]['id'] . ']', $value_name['products_options_values_name']) . (isset($options_value_error_array[$languages[$i]['id']]) ? (empty($options_value_error_array[$languages[$i]['id']]) ? '<font color="red">&nbsp;' . TEXT_OPTION_ERROR_EMPTY_MARK . '</font>' : '<font color="red">&nbsp;' . TEXT_OPTION_ERROR_MARK . '</font>') : '') . '<br />';
        }
      }
      
      $max_values_id_query = xos_db_query("select max(products_options_values_id) + 1 as next_id from " . TABLE_PRODUCTS_OPTIONS_VALUES);
      $max_values_id_values = xos_db_fetch_array($max_values_id_query);
      $next_id = $max_values_id_values['next_id'];
      
      $options_value[]=array('form_begin_values' => '<form name="values" action="' . xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_value&options_page=1&' . $parameter_string) . '" method="post">',
                             'error_message' => $error_message,                            
                             'inputs_options_value' => $inputs_options_value,
                             'id' => $values_values['products_options_values_id'],
                             'option_name' => $options_name,
                             'value_name' => $values_name,                      
                             'hidden_ids' => '<input type="hidden" name="value_id" value="' . $values_values['products_options_values_id'] . '" /><input type="hidden" name="option_id" value="' . $values_values['products_options_id'] . '" />',
                             'link_filename_products_attributes' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string),
                             'form_end' => '</form>',
                             'link_filename_products_attributes_action_update' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option_value&value_id=' . $values_values['products_options_values_id'] . '&options_page=1&' . $parameter_string),
                             'link_filename_products_attributes_action_delete' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_option_value&value_id=' . $values_values['products_options_values_id'] . '&options_page=1&' . $parameter_string));      
    }

    $smarty->assign(array('split_page' => $values_split->display_links($values_query_numrows, MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $value_page, 'options_page=1&' . $cmm_parameter_string . '&option_page=' . $option_page . '&attribute_page=' . $attribute_page, 'value_page'),
                          'previous_option_the_same' => $previous_option_is_the_same,
                          'next_option_the_same' => $next_option_is_the_same,
                          'options' => $options_value));  

    if ($action != 'update_option_value') {

      $inputs_options_name = '<select name="option_id">';
      $options = xos_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by products_options_name");
      while ($options_values = xos_db_fetch_array($options)) {     
        if ($_GET['option_id'] == $options_values['products_options_id']) {
          $inputs_options_name .= '<option value="' . $options_values['products_options_id'] . '" selected="selected">' . $options_values['products_options_name'] . '</option>';
        } else {
          $inputs_options_name .= '<option value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
        }      
      }
      $inputs_options_name .= '</select>';
      
      $error_message = '';
      $inputs_options_value = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
        if (isset($options_value_error_array[$languages[$i]['id']])) {
          if (empty($options_value_error_array[$languages[$i]['id']]) && !$set_empty) {
            $error_message .= sprintf(TEXT_OPTION_VALUE_NAME_ERROR_EMPTY, TEXT_OPTION_ERROR_EMPTY_MARK) . '<br />';
            $set_empty = true;
          } elseif ($options_value_error_array[$languages[$i]['id']] && !$set_not_empty) {
            $error_message .= sprintf(TEXT_OPTION_VALUE_NAME_ERROR, TEXT_OPTION_ERROR_MARK) . '<br />';
            $set_not_empty = true;
          }  
        }
             
        $inputs_options_value .= '<input type="text" name="value_name[' . $languages[$i]['id'] . ']" value="' . $options_value_array[$languages[$i]['id']] . '" class="smallText" size="20" />&nbsp;' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . (isset($options_value_error_array[$languages[$i]['id']]) ? (empty($options_value_error_array[$languages[$i]['id']]) ? '<font color="red">&nbsp;' . TEXT_OPTION_ERROR_EMPTY_MARK . '</font>' : '<font color="red">&nbsp;' . TEXT_OPTION_ERROR_MARK . '</font>') : '') . '<br />';
      }

      $smarty->assign(array('form_begin_option' => '<form name="values" action="' . xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_option_values&options_page=1&' . $parameter_string) . '" method="post">',
                            'next_id' => $next_id,
                            'error_message' => $error_message,
                            'inputs_options_value' => $inputs_options_value,
                            'inputs_options_name' => $inputs_options_name,
                            'hidden_value_id' => '<input type="hidden" name="value_id" value="' . $next_id . '" />',
                            'form_end' => '</form>'));

    }
  }
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'products_attributes');
  $output_attributes_values = $smarty->fetch(ADMIN_TPL . '/includes/modules/attributes_values.tpl');
  $smarty->clearAssign(array('delete_option_value',
                              'products_linked',
                              'products',
                              'link_filename_products_attributes',
                              'link_filename_products_attributes_delete',
                              'products_options_values_name',
                              'split_page',
                              'previous_option_the_same',
                              'next_option_the_same',
                              'options',
                              'form_begin_option',
                              'next_id',
                              'error_message',
                              'inputs_options_value',
                              'inputs_options_name',
                              'hidden_value_id',
                              'form_end'));  
  
  $smarty->assign('attributes_values', $output_attributes_values);    
endif;
?>
