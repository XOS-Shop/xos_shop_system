<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : attributes_options.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/modules/attributes_options.php') == 'overwrite_all')) :
  if ($action == 'delete_product_option') { // delete product option
    $options = xos_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$_GET['option_id'] . "' and language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
    $options_values = xos_db_fetch_array($options);
    
    $smarty->assign('delete_product_option', true);

    $products = xos_db_query("select pov.products_options_values_id, pov.products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po where pov.products_options_values_id = pov2po.products_options_values_id and pov2po.products_options_id='" . (int)$_GET['option_id'] . "' and pov.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by pov.products_options_values_name");
    if (xos_db_num_rows($products)) {    

      $rows = 0;
      $products_value = array();
      while ($products_values = xos_db_fetch_array($products)) {
        $rows++;

        $products_value[]=array('id' => $products_values['products_options_values_id'],                            
                                'name' => $products_values['products_options_values_name']);
      }

      $smarty->assign(array('products_linked' => true,
                            'products_values' => $products_value,
                            'link_filename_products_attributes' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string))); 
                                                           
    } else {
     
      $smarty->assign(array('link_filename_products_attributes' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string),
                            'link_filename_products_attributes_delete' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_option&option_id=' . $_GET['option_id'] . '&options_page=1&' . $parameter_string)));
      
    }
    
    $smarty->assign('products_options_name', $options_values['products_options_name']);

  } else {

    $options_name_error_array = unserialize(stripslashes(urldecode($_GET['options_name_error'])));
    $options_name_array = unserialize(stripslashes(urldecode($_GET['options_name'])));  
    $set_empty = false;
    $set_not_empty = false;
      
    $options = "select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by products_options_name";
    $options_split = new splitPageResults($option_page, MAX_ROW_LISTS_OPTIONS, $options, $options_query_numrows);
   
    $smarty->assign('split_page', $options_split->display_links($options_query_numrows, MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $option_page, 'options_page=1&' . $cmm_parameter_string . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'option_page'));

    $next_id = 1;
    $rows = 0;
    $options = xos_db_query($options);
    $options_value = array();
    while ($options_values = xos_db_fetch_array($options)) {
      $rows++;
      $error_message = '';
      $inputs = '';
      if (($action == 'update_option') && ($_GET['option_id'] == $options_values['products_options_id'])) {
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          if (isset($options_name_error_array[$languages[$i]['id']])) {
            if (empty($options_name_error_array[$languages[$i]['id']]) && !$set_empty) {
              $error_message .= sprintf(TEXT_OPTION_NAME_ERROR_EMPTY, TEXT_OPTION_ERROR_EMPTY_MARK) . '<br />';
              $set_empty = true;
            } elseif ($options_name_error_array[$languages[$i]['id']] && !$set_not_empty) {
              $error_message .= sprintf(TEXT_OPTION_NAME_ERROR, TEXT_OPTION_ERROR_MARK) . '<br />';
              $set_not_empty = true;
            }  
          }
                   
          $option_name = xos_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . $options_values['products_options_id'] . "' and language_id = '" . $languages[$i]['id'] . "'");
          $option_name = xos_db_fetch_array($option_name);
          $inputs .= '<input type="text" name="option_name[' . $languages[$i]['id'] . ']" class="smallText" size="20" value="' . (isset($options_name_array[$languages[$i]['id']]) ? $options_name_array[$languages[$i]['id']] : $option_name['products_options_name']) . '" />&nbsp;' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . xos_draw_hidden_field('actual_option_name[' . $languages[$i]['id'] . ']', $option_name['products_options_name']) . (isset($options_name_error_array[$languages[$i]['id']]) ? (empty($options_name_error_array[$languages[$i]['id']]) ? '<font color="red">&nbsp;' . TEXT_OPTION_ERROR_EMPTY_MARK . '</font>' : '<font color="red">&nbsp;' . TEXT_OPTION_ERROR_MARK . '</font>') : '') . '<br />';         
        }
      }

      $max_options_id_query = xos_db_query("select max(products_options_id) + 1 as next_id from " . TABLE_PRODUCTS_OPTIONS);
      $max_options_id_values = xos_db_fetch_array($max_options_id_query);
      $next_id = $max_options_id_values['next_id'];
      
      
      $options_value[]=array('form_begin_option' => '<form name="option" action="' . xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option_name&options_page=1&' . $parameter_string) . '" method="post">',
                             'error_message' => $error_message,                            
                             'inputs_name' => $inputs,
                             'id' => $options_values['products_options_id'],
                             'name' => $options_values["products_options_name"],                       
                             'hidden_id' => '<input type="hidden" name="option_id" value="' . $options_values['products_options_id'] . '" />',
                             'link_filename_products_attributes' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'options_page=1&' . $parameter_string),
                             'form_end' => '</form>',
                             'link_filename_products_attributes_action_update' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option&option_id=' . $options_values['products_options_id'] . '&options_page=1&' . $parameter_string),
                             'link_filename_products_attributes_action_delete' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_product_option&option_id=' . $options_values['products_options_id'] . '&options_page=1&' . $parameter_string));      
    }
    
    $smarty->assign('options', $options_value);    

    if ($action != 'update_option') {
      $error_message = ''; 
      $inputs = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
        if (isset($options_name_error_array[$languages[$i]['id']])) {
          if (empty($options_name_error_array[$languages[$i]['id']]) && !$set_empty) {
            $error_message .= sprintf(TEXT_OPTION_NAME_ERROR_EMPTY, TEXT_OPTION_ERROR_EMPTY_MARK) . '<br />';
            $set_empty = true;
          } elseif ($options_name_error_array[$languages[$i]['id']] && !$set_not_empty) {
            $error_message .= sprintf(TEXT_OPTION_NAME_ERROR, TEXT_OPTION_ERROR_MARK) . '<br />';
            $set_not_empty = true;
          }  
        }
             
        $inputs .= '<input type="text" name="option_name[' . $languages[$i]['id'] . ']" value="' . $options_name_array[$languages[$i]['id']] . '" class="smallText" size="20" />&nbsp;' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . (isset($options_name_error_array[$languages[$i]['id']]) ? (empty($options_name_error_array[$languages[$i]['id']]) ? '<font color="red">&nbsp;' . TEXT_OPTION_ERROR_EMPTY_MARK . '</font>' : '<font color="red">&nbsp;' . TEXT_OPTION_ERROR_MARK . '</font>') : '') . '<br />';       
      }

      $smarty->assign(array('form_begin_option' => '<form name="options" action="' . xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_options&options_page=1&' . $parameter_string) . '" method="post"><input type="hidden" name="products_options_id" value="' . $next_id . '" />',
                            'next_id' => $next_id,
                            'error_message' => $error_message,
                            'inputs_name' => $inputs,
                            'form_end' => '</form>'));
    }
  }
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'products_attributes');
  $output_attributes_options = $smarty->fetch(ADMIN_TPL . '/includes/modules/attributes_options.tpl');
  $smarty->clearAssign(array('delete_product_option',
                              'products_linked',
                              'products',
                              'link_filename_products_attributes',
                              'link_filename_products_attributes_delete',
                              'products_options_name',
                              'split_page',
                              'options',
                              'form_begin_option',
                              'next_id',
                              'error_message',
                              'inputs_name', 
                              'form_end'));  
  
  $smarty->assign('attributes_options', $output_attributes_options);   
endif;
?>
