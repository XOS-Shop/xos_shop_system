<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : categories.php
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

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_CATEGORIES) == 'overwrite_all')) :   
  require('includes/classes/image_creator.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  $max_img = (MAX_IMG > 100) ? 100 : MAX_IMG;
  
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'setflag':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['pID'])) {            
            if ($_GET['flag'] == '1') {
              if (STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
                $quantity_check_query = xos_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$_GET['pID'] . "'");
                $quantity_check = xos_db_fetch_array($quantity_check_query);
                if ($quantity_check['products_quantity'] > 0) xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '1', products_last_modified = now() where products_id = '" . (int)$_GET['pID'] . "'");
              } else {
                xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '1', products_last_modified = now() where products_id = '" . (int)$_GET['pID'] . "'");
              }
            } elseif ($_GET['flag'] == '0') {
              xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0', products_last_modified = now() where products_id = '" . (int)$_GET['pID'] . "'");
            }       
            
            $smarty_cache_control->clearAllCache();
          }
        }

        xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath'] . '&pID=' . $_GET['pID']));
        break;
      case 'setflag_cat':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['cpID'])) {
            xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set categories_or_pages_status =  '" . (int)$_GET['flag'] . "', last_modified = now() where categories_or_pages_id = '" . (int)$_GET['cpID'] . "'");
            $tree = xos_get_category_tree($_GET['cpID']);
            for ($i=1; $i<sizeof($tree); $i++) {
              xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set categories_or_pages_status =  '" . (int)$_GET['flag'] . "', last_modified = now() where categories_or_pages_id = '" . $tree[$i]['id'] . "'");
            }
        
            $smarty_cache_control->clearAllCache();
          }
        }

	xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath'] . '&cpID=' . $_GET['cpID']));
	break;      
      case 'insert_category':
      case 'update_category':
        if (isset($_POST['categories_or_pages_id'])) $categories_or_pages_id = xos_db_prepare_input($_POST['categories_or_pages_id']);
        $product_list_b = xos_db_prepare_input($_POST['product_list_b']);
        $sort_order = xos_db_prepare_input($_POST['sort_order']);
        $categories_or_pages_status = xos_db_prepare_input($_POST['categories_or_pages_status']);
        $current_categories_or_pages_status = xos_db_prepare_input($_POST['current_categories_or_pages_status']);
        $sql_data_array = array('product_list_b' => (int)$product_list_b, 'sort_order' => (int)$sort_order, 'is_page' => 'false', 'categories_or_pages_status' => (int)$categories_or_pages_status);

        $languages = xos_get_languages();
        
        $category_error = false;
        
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          if (!xos_not_null($_POST['categories_or_pages_name'][$languages[$i]['id']])) {
            $messageStack->add('header', ERROR_CATEGORY_NAME, 'error');
            $category_error = true;
          }
        }
         
        if ($category_error == false) {
          if ($action == 'insert_category') {
            $insert_sql_data = array('parent_id' => $current_category_id,
                                     'date_added' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            xos_db_perform(TABLE_CATEGORIES_OR_PAGES, $sql_data_array);

            $categories_or_pages_id = xos_db_insert_id();
          } elseif ($action == 'update_category') {
            $update_sql_data = array('last_modified' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $update_sql_data);

            xos_db_perform(TABLE_CATEGORIES_OR_PAGES, $sql_data_array, 'update', "categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
            
            if ($categories_or_pages_status != $current_categories_or_pages_status) {
              $tree = xos_get_category_tree($categories_or_pages_id);
              for ($i=1; $i<sizeof($tree); $i++) {
                xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set categories_or_pages_status =  '" . (int)$categories_or_pages_status . "', last_modified = now() where categories_or_pages_id = '" . $tree[$i]['id'] . "'");
              }
            }                                          
          }
                
          $categories_or_pages_name_array = $_POST['categories_or_pages_name'];
          $categories_or_pages_heading_title_array = $_POST['categories_or_pages_heading_title'];
          $categories_or_pages_content_array = $_POST['categories_or_pages_content'];        
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {

            $language_id = $languages[$i]['id'];

            $sql_data_array = array('categories_or_pages_name' => xos_db_prepare_input(htmlspecialchars_decode($categories_or_pages_name_array[$language_id])),         
                                    'categories_or_pages_heading_title' => xos_db_prepare_input(htmlspecialchars($categories_or_pages_heading_title_array[$language_id])),
                                    'categories_or_pages_content' => preg_replace_callback('#href=\"?(([^\" >]*?\.php)([^\" >]*?))#siU', 'internal_link_replacement', (trim(str_replace('&#160;', '', strip_tags(xos_db_prepare_input($categories_or_pages_content_array[$language_id]), '<img>'))) != '') ? xos_db_prepare_input($categories_or_pages_content_array[$language_id]) : ''));

            if ($action == 'insert_category') {
              $insert_sql_data = array('categories_or_pages_id' => $categories_or_pages_id,
                                       'language_id' => $language_id);

              $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

              xos_db_perform(TABLE_CATEGORIES_OR_PAGES_DATA, $sql_data_array);
            } elseif ($action == 'update_category') {
              xos_db_perform(TABLE_CATEGORIES_OR_PAGES_DATA, $sql_data_array, 'update', "categories_or_pages_id = '" . (int)$categories_or_pages_id . "' and language_id = '" . (int)$language_id . "'");
            }
          }
        
          if (!empty($_FILES['categories_image']['name'])) { 
            $categories_image = new upload('categories_image', DIR_FS_CATALOG_IMAGES . 'categories/uploads/', '777', array('jpg','jpeg','gif','png'));
            if ($categories_image->parse() && $categories_image->save()) {        
              $duplicate_image_query = xos_db_query("select count(*) as total from " . TABLE_CATEGORIES_OR_PAGES . " where categories_image = '" . xos_db_input($_POST['current_category_image']) . "'");
              $duplicate_image = xos_db_fetch_array($duplicate_image_query);
              if (($duplicate_image['total'] < 2) &! ($_POST['current_category_image'] == $categories_image->filename)) {
                  @unlink(DIR_FS_CATALOG_IMAGES . 'categories/uploads/' . $_POST['current_category_image']);
                  @unlink(DIR_FS_CATALOG_IMAGES . 'categories/small/' . $_POST['current_category_image']);
                  @unlink(DIR_FS_CATALOG_IMAGES . 'categories/medium/' . $_POST['current_category_image']);
              }                       
              xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set categories_image = '" . xos_db_input($categories_image->filename) . "' where categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
            
              new image_create(DIR_FS_CATALOG_IMAGES . 'categories/uploads/' . $categories_image->filename, DIR_FS_CATALOG_IMAGES . 'categories/small/' . $categories_image->filename, SMALL_CATEGORY_IMAGE_MAX_WIDTH, SMALL_CATEGORY_IMAGE_MAX_HEIGHT, IMAGE_QUALITY);
              new image_create(DIR_FS_CATALOG_IMAGES . 'categories/uploads/' . $categories_image->filename, DIR_FS_CATALOG_IMAGES . 'categories/medium/' . $categories_image->filename, MEDIUM_CATEGORY_IMAGE_MAX_WIDTH, MEDIUM_CATEGORY_IMAGE_MAX_HEIGHT, IMAGE_QUALITY);
            }  
          } elseif ($_POST['delete_category_image'] == 'true') {
            $duplicate_image_query = xos_db_query("select count(*) as total from " . TABLE_CATEGORIES_OR_PAGES . " where categories_image = '" . xos_db_input($_POST['current_category_image']) . "'");
            $duplicate_image = xos_db_fetch_array($duplicate_image_query);
            if ($duplicate_image['total'] < 2) {  
                @unlink(DIR_FS_CATALOG_IMAGES . 'categories/uploads/' . $_POST['current_category_image']);
                @unlink(DIR_FS_CATALOG_IMAGES . 'categories/small/' . $_POST['current_category_image']);
                @unlink(DIR_FS_CATALOG_IMAGES . 'categories/medium/' . $_POST['current_category_image']);
            }
            xos_db_query("update ".TABLE_CATEGORIES_OR_PAGES." set categories_image = '' where categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
          }
        
          $smarty_cache_control->clearAllCache();
        
          xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cpID=' . $categories_or_pages_id));        
        } else {
          $reload = true;
          $action = 'new_category';
        }                        
        break;
      case 'delete_category_confirm':
        if (isset($_POST['categories_or_pages_id'])) {
          $categories_or_pages_id = xos_db_prepare_input($_POST['categories_or_pages_id']);

          $categories = xos_get_category_tree($categories_or_pages_id, '', '0', '', true);
          $products = array();
          $products_delete = array();

          for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
            $product_ids_query = xos_db_query("select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_or_pages_id = '" . (int)$categories[$i]['id'] . "'");

            while ($product_ids = xos_db_fetch_array($product_ids_query)) {
              $products[$product_ids['products_id']]['categories'][] = $categories[$i]['id'];
            }
          }

          reset($products);
          while (list($key, $value) = each($products)) {
            $category_ids = '';

            for ($i=0, $n=sizeof($value['categories']); $i<$n; $i++) {
              $category_ids .= "'" . (int)$value['categories'][$i] . "', ";
            }
            $category_ids = substr($category_ids, 0, -2);

            $check_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$key . "' and categories_or_pages_id not in (" . $category_ids . ")");
            $check = xos_db_fetch_array($check_query);
            if ($check['total'] < '1') {
              $products_delete[$key] = $key;
            }
          }

// removing categories can be a lengthy process
          xos_set_time_limit(0);
          for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
            xos_remove_category($categories[$i]['id']);
          }

          reset($products_delete);
          while (list($key) = each($products_delete)) {
            xos_remove_product($key);
          }
          
          $smarty_cache_control->clearAllCache();
        }


        xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
        break;
      case 'delete_product_confirm':
        if (isset($_POST['products_id']) && isset($_POST['product_categories']) && is_array($_POST['product_categories'])) {
          $product_id = xos_db_prepare_input($_POST['products_id']);
          $product_categories = $_POST['product_categories'];

          for ($i=0, $n=sizeof($product_categories); $i<$n; $i++) {
            xos_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "' and categories_or_pages_id = '" . (int)$product_categories[$i] . "'");
          }

          $product_categories_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
          $product_categories = xos_db_fetch_array($product_categories_query);

          if ($product_categories['total'] == '0') {
            xos_remove_product($product_id);
          }
          
          $smarty_cache_control->clearAllCache();
        }


        xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
        break;
      case 'move_category_confirm':
        if (isset($_POST['categories_or_pages_id']) && ($_POST['categories_or_pages_id'] != $_POST['move_to_category_id'])) {
          $categories_or_pages_id = xos_db_prepare_input($_POST['categories_or_pages_id']);
          $new_parent_id = xos_db_prepare_input($_POST['move_to_category_id']);

          $path = explode('_', xos_get_generated_category_path_ids($new_parent_id));

          if (in_array($categories_or_pages_id, $path)) {
            $messageStack->add_session('header', ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT, 'error');

            xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cpID=' . $categories_or_pages_id));
          } elseif (xos_children_in_category_count($new_parent_id) == 0 && xos_products_in_category_count($new_parent_id) > 0) {
            $messageStack->add_session('header', ERROR_CANNOT_MOVE_CATEGORY_TO_CATEGORY_CONTAINING_PRODUCTS, 'error');

            xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cpID=' . $categories_or_pages_id));             
          } else {
            xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set parent_id = '" . (int)$new_parent_id . "', last_modified = now() where categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
            
            if ($new_parent_id > '0') {
              $categories_query = xos_db_query("select categories_or_pages_status from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$new_parent_id . "'");
              $categories = xos_db_fetch_array($categories_query);

              if ($categories['categories_or_pages_status'] == '0') {
                $tree = xos_get_category_tree($new_parent_id);
                for ($i=1; $i<sizeof($tree); $i++) {
                  xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set categories_or_pages_status = '0', last_modified = now() where categories_or_pages_id = '" . $tree[$i]['id'] . "'");
                }
              }
            }

            $smarty_cache_control->clearAllCache();
            
            xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $new_parent_id . '&cpID=' . $categories_or_pages_id));
          }
        }

        break;
      case 'move_product_confirm':
        $products_id = xos_db_prepare_input($_POST['products_id']);
        $new_parent_id = xos_db_prepare_input($_POST['move_to_category_id']);

        if (xos_children_in_category_count($new_parent_id) > 0) {
          $messageStack->add_session('header', ERROR_CANNOT_MOVE_PRODUCT_TO_TOP_OR_TO_CATEGORY_CONTAINS_SUBCATEGORIES, 'error');

          xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id));             
        } else {
          $duplicate_check_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_or_pages_id = '" . (int)$new_parent_id . "'");
          $duplicate_check = xos_db_fetch_array($duplicate_check_query);
          if ($duplicate_check['total'] < 1) {
            xos_db_query("update " . TABLE_PRODUCTS_TO_CATEGORIES . " set categories_or_pages_id = '" . (int)$new_parent_id . "' where products_id = '" . (int)$products_id . "' and categories_or_pages_id = '" . (int)$current_category_id . "'");
            $smarty_cache_control->clearAllCache();
          }    


          xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $new_parent_id . '&pID=' . $products_id));
        }  
        break;
      case 'insert_product':
      case 'update_product':            
          if (isset($_GET['pID'])) $products_id = xos_db_prepare_input($_GET['pID']);
          $products_date_available = xos_date_raw(xos_db_prepare_input($_POST['products_date_available']));
          $products_date_available = (date('Ymd') < $products_date_available) ? $products_date_available : 'null';
          
          $qty = 0;
          $qty = xos_db_prepare_input($_POST['products_quantity']);
          
          $sql_data_array = array('products_quantity' => (int)$qty,
                                  'products_sort_order' => (int)xos_db_prepare_input($_POST['products_sort_order']),
                                  'products_model' => xos_db_prepare_input(htmlspecialchars($_POST['products_model'])),                                
                                  'products_date_available' => $products_date_available,
                                  'products_weight' => (float)xos_db_prepare_input($_POST['products_weight']),
                                  'products_status' => (int)xos_db_prepare_input($_POST['products_status']),
                                  'products_tax_class_id' => (int)xos_db_prepare_input($_POST['products_tax_class_id']),
                                  'manufacturers_id' => (int)xos_db_prepare_input($_POST['manufacturers_id']));
                                  
          if ($action == 'insert_product') {
            $insert_sql_data = array('products_date_added' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            xos_db_perform(TABLE_PRODUCTS, $sql_data_array);
            $products_id = xos_db_insert_id();

            xos_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_or_pages_id) values ('" . (int)$products_id . "', '" . (int)$current_category_id . "')");
          } elseif ($action == 'update_product') {
            $update_sql_data = array('products_last_modified' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $update_sql_data);

            xos_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "'");
          }
          
          if (isset($_POST['attributes_quantity'])) {
            $attributes_qty = xos_db_prepare_input($_POST['attributes_quantity']);
            $attributes_quantity = array(); 
            $qty = 0;
            reset($attributes_qty);
            
            while (list($key, $value) = @each($attributes_qty)) { 

              $attributes_quantity[$key] = !empty($attributes_qty[$key]) ? (int)$value : 0;
              $qty += $attributes_quantity[$key] > 0 ? $attributes_quantity[$key] : 0;

            }

            if (xos_not_null($attributes_quantity)) xos_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$qty . "', attributes_quantity = '" . xos_db_input(serialize($attributes_quantity)) . "' where products_id = '" . (int)$products_id . "'");       
          }
          
          if ($qty < 1 && STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
            xos_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . (int)$products_id . "'");
          }            
                   
          $languages = xos_get_languages();
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
            $language_id = $languages[$i]['id'];
        
            $products_new_p_unit = '';    
            $products_new_p_unit = xos_db_prepare_input(htmlspecialchars($_POST['products_new_p_unit'][$language_id]));
            $products_p_unit = (empty($products_new_p_unit)) ? xos_db_prepare_input(htmlspecialchars($_POST['products_p_unit'][$language_id])) : $products_new_p_unit;
            
            $sql_data_array = array('products_name' => xos_db_prepare_input(htmlspecialchars($_POST['products_name'][$language_id])),
                                    'products_description_tab_label' => xos_db_prepare_input(htmlspecialchars($_POST['products_description_tab_label'][$language_id])),
                                    'products_p_unit' => $products_p_unit,
                                    'products_info' => preg_replace_callback('#href=\"?(([^\" >]*?\.php)([^\" >]*?))#siU', 'internal_link_replacement', (trim(str_replace('&#160;', '', strip_tags(xos_db_prepare_input($_POST['products_info'][$language_id]), '<img>'))) != '') ? xos_db_prepare_input($_POST['products_info'][$language_id]) : ''),
                                    'products_description' => preg_replace_callback('#href=\"?(([^\" >]*?\.php)([^\" >]*?))#siU', 'internal_link_replacement', (trim(str_replace('&#160;', '', strip_tags(xos_db_prepare_input($_POST['products_description'][$language_id]), '<img>'))) != '') ? xos_db_prepare_input($_POST['products_description'][$language_id]) : ''),
                                    'products_url' => xos_db_prepare_input(htmlspecialchars($_POST['products_url'][$language_id])));

            if ($action == 'insert_product') {
              $insert_sql_data = array('products_id' => $products_id,
                                       'language_id' => $language_id);

              $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

              xos_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array);
            } elseif ($action == 'update_product') {
              xos_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "' and language_id = '" . (int)$language_id . "'");
            }
          }

          $image_array = xos_get_product_images(stripslashes($_POST['image_array']), 'all');         
          for ($i=0;$i<$max_img;$i++) {
            if (!empty($_FILES['products_image_'. $i]['name'])) {
              $products_image = new upload('products_image_'. $i, DIR_FS_CATALOG_IMAGES . 'products/uploads/', '777', array('jpg','jpeg','gif','png'));
              if ($products_image->parse() && $products_image->save()) {
                $products_image_new_name = $products_id . '_'. $i . '_' . $products_image->filename;
                if (is_file(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $products_image_new_name)) {
                  @unlink(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $products_image_new_name);
                }
                rename(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $products_image->filename, DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $products_image_new_name);
                $image_array[$i]['name'] = $products_image_new_name; 
                
                switch ($_POST['large_image_size_' . $i]) {
                  case 'input':
                    $image_array[$i]['large_image_max_width'] = (!empty($_POST['large_image_max_width_' . $i]) && !empty($_POST['large_image_max_height_' . $i]) ? max(min((int)$_POST['large_image_max_width_' . $i], ABSULUTE_MAXIMUM_WIDTH_FOR_LARGE_PRODUCT_IMAGES), 10) : 'default');
                    $image_array[$i]['large_image_max_height'] = (!empty($_POST['large_image_max_width_' . $i]) && !empty($_POST['large_image_max_height_' . $i]) ? max(min((int)$_POST['large_image_max_height_' . $i], ABSULUTE_MAXIMUM_HEIGHT_FOR_LARGE_PRODUCT_IMAGES), 10) : 'default');
                    break;
                  case 'uploaded':
                    $image_array[$i]['large_image_max_width'] = '0';
                    $image_array[$i]['large_image_max_height'] = '0'; 
                    break;
                  case 'default':
                  default:
                    $image_array[$i]['large_image_max_width'] = 'default';
                    $image_array[$i]['large_image_max_height'] = 'default';     
                }                

                if (isset($_POST['current_product_image_' . $i]) && xos_not_null($_POST['current_product_image_' . $i]) && ($_POST['current_product_image_' . $i] != $products_image_new_name)) {           
                  @unlink(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $_POST['current_product_image_' . $i]);
                  @unlink(DIR_FS_CATALOG_IMAGES . 'products/extra_small/' . $_POST['current_product_image_' . $i]);
                  @unlink(DIR_FS_CATALOG_IMAGES . 'products/small/' . $_POST['current_product_image_' . $i]);
                  @unlink(DIR_FS_CATALOG_IMAGES . 'products/medium/' . $_POST['current_product_image_' . $i]);
                  @unlink(DIR_FS_CATALOG_IMAGES . 'products/large/' . $_POST['current_product_image_' . $i]);
                }
                new image_create(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $products_image_new_name, DIR_FS_CATALOG_IMAGES . 'products/extra_small/' . $products_image_new_name, EXTRA_SMALL_PRODUCT_IMAGE_MAX_WIDTH, EXTRA_SMALL_PRODUCT_IMAGE_MAX_HEIGHT, IMAGE_QUALITY, EXTRA_SMALL_PRODUCT_IMAGE_MERGE);
                new image_create(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $products_image_new_name, DIR_FS_CATALOG_IMAGES . 'products/small/' . $products_image_new_name, SMALL_PRODUCT_IMAGE_MAX_WIDTH, SMALL_PRODUCT_IMAGE_MAX_HEIGHT, IMAGE_QUALITY, SMALL_PRODUCT_IMAGE_MERGE);
                new image_create(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $products_image_new_name, DIR_FS_CATALOG_IMAGES . 'products/medium/' . $products_image_new_name, MEDIUM_PRODUCT_IMAGE_MAX_WIDTH, MEDIUM_PRODUCT_IMAGE_MAX_HEIGHT, IMAGE_QUALITY, MEDIUM_PRODUCT_IMAGE_MERGE);
                new image_create(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $products_image_new_name, DIR_FS_CATALOG_IMAGES . 'products/large/' . $products_image_new_name, ($image_array[$i]['large_image_max_width'] == 'default' ? LARGE_PRODUCT_IMAGE_MAX_WIDTH : $image_array[$i]['large_image_max_width']), ($image_array[$i]['large_image_max_height'] == 'default' ? LARGE_PRODUCT_IMAGE_MAX_HEIGHT : $image_array[$i]['large_image_max_height']), IMAGE_QUALITY, LARGE_PRODUCT_IMAGE_MERGE);
              }                                                                                   
            } elseif ($_POST['delete_product_image_' . $i] == 'true') { 
              @unlink(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $_POST['current_product_image_' . $i]);
              @unlink(DIR_FS_CATALOG_IMAGES . 'products/extra_small/' . $_POST['current_product_image_' . $i]);
              @unlink(DIR_FS_CATALOG_IMAGES . 'products/small/' . $_POST['current_product_image_' . $i]);
              @unlink(DIR_FS_CATALOG_IMAGES . 'products/medium/' . $_POST['current_product_image_' . $i]);
              @unlink(DIR_FS_CATALOG_IMAGES . 'products/large/' . $_POST['current_product_image_' . $i]);
              unset($image_array[$i]);
            }
          }
          ksort($image_array);
          
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
                          
            if ($action == 'insert_product') {
              xos_db_query("insert into " . TABLE_PRODUCTS_PRICES . " (products_id, customers_group_id, customers_group_price) values ('" . (int)$products_id . "', '" . $customers_group['customers_group_id'] . "', '" . $regular_price . "')"); 
              if ($special_price > 0) xos_db_perform(TABLE_SPECIALS, array('products_id' => (int)$products_id, 'customers_group_id' => $customers_group['customers_group_id'], 'specials_new_products_price' => $special_price, 'expires_date' => $special_expires_date, 'status' => $product_special_status));               
            } elseif ($action == 'update_product') {
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
          }
                    
          $sql_data_array = array('products_image' => serialize($image_array),                                 
                                  'products_price' => serialize($prices_array));                     
          
          xos_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "'");
          
          $smarty_cache_control->clearAllCache();
          
          if ($specials_error) {
            $messageStack->add_session('price_error', ERROR_NOT_ALL_NECESSARY_PRICES, 'error');
            xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id . '&errGr=' . substr($spec_err_gr, 0, -1) . '&action=new_product'));
          }  
          
          xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id));
        break;
      case 'copy_to_confirm':
        if (isset($_POST['products_id']) && isset($_POST['categories_or_pages_id'])) {
          $products_id = xos_db_prepare_input($_POST['products_id']);
          $categories_or_pages_id = xos_db_prepare_input($_POST['categories_or_pages_id']);

          if (xos_children_in_category_count($categories_or_pages_id) > 0) {
            $messageStack->add_session('header', ERROR_CANNOT_LINKED_PRODUCT_TO_TOP_OR_TO_CATEGORY_CONTAINS_SUBCATEGORIES, 'error');

            xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id));             
          } else {
        
            if ($_POST['copy_as'] == 'link') {
              if ($categories_or_pages_id != $current_category_id) {
                $check_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
                $check = xos_db_fetch_array($check_query);
                if ($check['total'] < '1') {
                  xos_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_or_pages_id) values ('" . (int)$products_id . "', '" . (int)$categories_or_pages_id . "')");
                  $smarty_cache_control->clearAllCache();
                }
              } else {
                $messageStack->add_session('header', ERROR_CANNOT_LINK_TO_SAME_CATEGORY, 'error');
              }
            } elseif ($_POST['copy_as'] == 'duplicate') {
              $product_query = xos_db_query("select products_quantity, products_model, products_image, products_price, products_date_available, products_weight, products_tax_class_id, manufacturers_id, attributes_quantity, attributes_combinations from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
              $product = xos_db_fetch_array($product_query);
            
              xos_db_query("insert into " . TABLE_PRODUCTS . " (products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, attributes_quantity, attributes_combinations) values ('" . xos_db_input($product['products_quantity']) . "', '" . xos_db_input($product['products_model']) . "', '" . xos_db_input($product['products_image']) . "', '" . xos_db_input($product['products_price']) . "', '0', now(), " . (empty($product['products_date_available']) ? "null" : "'" . xos_db_input($product['products_date_available']) . "'") . ", '" . xos_db_input($product['products_weight']) . "', '0', '" . (int)$product['products_tax_class_id'] . "', '" . (int)$product['manufacturers_id'] . "', " . (xos_not_null($product['attributes_quantity']) ? "'" .xos_db_input($product['attributes_quantity']) . "'" : "null") . ", " . (xos_not_null($product['attributes_combinations']) ? "'" .xos_db_input($product['attributes_combinations']) . "'" : "null") . ")");
              $dup_products_id = xos_db_insert_id();

              $products_image_name = xos_get_product_images($product['products_image'], 'all');
              foreach($products_image_name as $key => $val) {
                $products_image_name[$key]['name'] = $dup_products_id . stristr($val['name'], '_');
                $products_image_name[$key]['large_image_max_width'] = $val['large_image_max_width'];
                $products_image_name[$key]['large_image_max_height'] = $val['large_image_max_height'];              
                @copy(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $val['name'], DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $products_image_name[$key]['name']);
                @copy(DIR_FS_CATALOG_IMAGES . 'products/extra_small/' . $val['name'], DIR_FS_CATALOG_IMAGES . 'products/extra_small/' . $products_image_name[$key]['name']);
                @copy(DIR_FS_CATALOG_IMAGES . 'products/small/' . $val['name'], DIR_FS_CATALOG_IMAGES . 'products/small/' . $products_image_name[$key]['name']);
                @copy(DIR_FS_CATALOG_IMAGES . 'products/medium/' . $val['name'], DIR_FS_CATALOG_IMAGES . 'products/medium/' . $products_image_name[$key]['name']);
                @copy(DIR_FS_CATALOG_IMAGES . 'products/large/' . $val['name'], DIR_FS_CATALOG_IMAGES . 'products/large/' . $products_image_name[$key]['name']);                 
              }
              ksort($products_image_name);          
              xos_db_query("update " . TABLE_PRODUCTS . " set products_image = '" . xos_db_input(serialize($products_image_name)) . "' where products_id = '" . (int)$dup_products_id . "'");
            
              $prices_query = xos_db_query("select customers_group_id, customers_group_price from " . TABLE_PRODUCTS_PRICES . " where products_id = '" . (int)$products_id . "'");
              while ($prices = xos_db_fetch_array($prices_query)) {
                xos_db_query("insert into " . TABLE_PRODUCTS_PRICES . " (products_id, customers_group_id, customers_group_price) values ('" . (int)$dup_products_id . "', '" . xos_db_input($prices['customers_group_id']) . "', '" . xos_db_input($prices['customers_group_price']) . "')");
              }
            
              $special_prices_query = xos_db_query("select customers_group_id, specials_new_products_price, expires_date, status, error from " . TABLE_SPECIALS . " where products_id = '" . (int)$products_id . "'");
              while ($special_prices = xos_db_fetch_array($special_prices_query)) {
                $special_expires_date = ($special_prices['expires_date'] == null) ? 'null' : xos_db_input($special_prices['expires_date']);
                xos_db_perform(TABLE_SPECIALS, array('products_id' => (int)$dup_products_id, 'customers_group_id' => xos_db_input($special_prices['customers_group_id']), 'specials_new_products_price' => xos_db_input($special_prices['specials_new_products_price']), 'expires_date' => $special_expires_date, 'status' => xos_db_input($special_prices['status']), 'error' => xos_db_input($special_prices['error'])));
              }            
                    
              $description_query = xos_db_query("select language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products_id . "'");
              while ($description = xos_db_fetch_array($description_query)) {
                xos_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('" . (int)$dup_products_id . "', '" . (int)$description['language_id'] . "', '" . xos_db_input($description['products_name']) . "', '" . xos_db_input($description['products_p_unit']) . "', '" . xos_db_input($description['products_info']) . "', '" . xos_db_input($description['products_description_tab_label']) . "', '" . xos_db_input($description['products_description']) . "', '" . xos_db_input($description['products_url']) . "', '0')");
              }
            
              $attributes_query = xos_db_query("select * from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "'");
              while ($attributes = xos_db_fetch_array($attributes_query)) {
              
                xos_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('" . (int)$dup_products_id . "', '" . (int)$attributes['options_id'] . "', '" . (int)$attributes['options_values_id'] . "', '" . (int)$attributes['options_sort_order'] . "', '" . (int)$attributes['options_values_sort_order'] . "', '" . xos_db_input($attributes['options_values_price']) . "', '" . xos_db_input($attributes['price_prefix']) . "')");
                $dup_products_attributes_id = xos_db_insert_id();

                $attributes_download_query = xos_db_query("select products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . (int)$attributes['products_attributes_id'] . "'");
                if (xos_db_num_rows($attributes_download_query) == 1) {
                  $attributes_download = xos_db_fetch_array($attributes_download_query);
                  xos_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " (products_attributes_id, products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount) values ('" . (int)$dup_products_attributes_id . "', '" . xos_db_input($attributes_download['products_attributes_filename']) . "', '" . (int)$attributes_download['products_attributes_maxdays'] . "', '" . (int)$attributes_download['products_attributes_maxcount'] . "')");
                }
              }
            
              xos_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_or_pages_id) values ('" . (int)$dup_products_id . "', '" . (int)$categories_or_pages_id . "')");
              $products_id = $dup_products_id;
              $smarty_cache_control->clearAllCache();
            }
          }
        }

        xos_redirect(xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $categories_or_pages_id . '&pID=' . $products_id));
        break;
    }
  }
      
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  if ($action == 'new_product') {
    $javascript .= '<script type="text/javascript" src="' . DIR_WS_ADMIN_IMAGES . ADMIN_TPL .'/' . $_SESSION['language'] . '/jquery.ui.datepicker-language.min.js"></script>' . "\n"; 
    if (WYSIWYG_FOR_PRODUCT == 'true') {
      $javascript .= '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/ckeditor/ckeditor.js"></script>' . "\n";
    }
  } elseif ($action == 'new_category' && WYSIWYG_FOR_CATEGORY == 'true') {
    $javascript .= '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/ckeditor/ckeditor.js"></script>' . "\n";
  } 
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  
    
//  $smarty->assign('BODY_TAG_PARAMS', 'onload="SetFocus();"');  

  if ($action == 'new_product') { 
   
    require(DIR_WS_MODULES . 'new_product.php');
    $smarty->assign('central_contents', $output_new_product);
    
  } elseif ($action == 'new_category') {
    
    require(DIR_WS_MODULES . 'new_category.php');
    $smarty->assign('central_contents', $output_new_category);  
  
  } elseif ($action == 'product_preview') {
    
    require(DIR_WS_MODULES . 'product_preview.php');
    $smarty->assign('central_contents', $output_product_preview);
    
  } else {
  
    require(DIR_WS_MODULES . 'categories_and_products.php');
    $smarty->assign('central_contents', $output_categories_and_products);

  }
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');
 
  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
