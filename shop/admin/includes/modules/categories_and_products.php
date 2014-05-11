<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : categories_and_products.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/modules/categories_and_products.php') == 'overwrite_all')) :
    $categories_count = 0;
    $rows = 0;
    if (!isset($_GET['search'])) {
      $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.categories_image, c.parent_id, c.product_list_b, c.sort_order, c.date_added, c.last_modified, c.categories_or_pages_status  from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and c.is_page = 'false' and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by c.sort_order, cpd.categories_or_pages_name");
    
      $categories_array = array(); 
      while ($categories = xos_db_fetch_array($categories_query)) {
        $categories_count++;
        $rows++;

        if ((!isset($_GET['cpID']) && !isset($_GET['pID']) || (isset($_GET['cpID']) && ($_GET['cpID'] == $categories['categories_or_pages_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
          $category_children = array('children_count' => xos_children_in_category_count($categories['categories_or_pages_id']));
          $category_products = array('products_count' => xos_products_in_category_count($categories['categories_or_pages_id']));

          $cInfo_array = array_merge((array)$categories, (array)$category_children, (array)$category_products);
          $cInfo = new objectInfo($cInfo_array);
        }          

        $categories_array[]=array('selected' => (isset($cInfo) && is_object($cInfo) && ($categories['categories_or_pages_id'] == $cInfo->categories_or_pages_id) ? true : false ),
                                  'status' => ($categories['categories_or_pages_status'] == '1' ? true : false),                                
                                  'name' => htmlspecialchars($categories['categories_or_pages_name']),
                                  'sort_order' => $categories['sort_order'],                              
                                  'icon_status_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10),
                                  'icon_status_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10),
                                  'icon_status_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT, 10, 10),
                                  'icon_status_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT, 10, 10),
                                  'link_filename_categories_flag_0' => xos_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&flag=0&cpID=' . $categories['categories_or_pages_id'] . '&cPath=' . $cPath),
                                  'link_filename_categories_flag_1' => xos_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&flag=1&cpID=' . $categories['categories_or_pages_id'] . '&cPath=' . $cPath),                                                              
                                  'link_filename_categories_get_path' => xos_href_link(FILENAME_CATEGORIES, xos_get_path($categories['categories_or_pages_id'])),
                                  'link_filename_categories_cpath_cpath_cid' => xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cpID=' . $categories['categories_or_pages_id']));
      }
    }    

    $products_count = 0;
    if (isset($_GET['search'])) {
      $search = xos_db_prepare_input($_GET['search']);    
      $products_query = xos_db_query("select distinct p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_sort_order, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p2c.categories_or_pages_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and p.products_id = p2c.products_id and pd.products_name like '%" . xos_db_input($search) . "%' group by p.products_id order by p.products_sort_order, pd.products_name LIMIT 20");
    } else {
      $products_query = xos_db_query("select p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_sort_order, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = '" . (int)$current_category_id . "' order by p.products_sort_order, pd.products_name");
    }
    
    $products_array = array();
    while ($products = xos_db_fetch_array($products_query)) {
      $products_count++;
      $rows++;

// Get categories_or_pages_id for product if search
      if (isset($_GET['search'])) { 
        $cPath = '';
        $cat_path = xos_generate_category_path($products['products_id'], 'product');      
        for ($i=0, $n=sizeof($cat_path[0]); $i<$n; $i++) {
          $cPath .= $cat_path[0][$i]['id'] . '_'; 
        } 
        $cPath = substr($cPath, 0, -1); 
      }           

      if ( (!isset($_GET['pID']) && !isset($_GET['cpID']) || (isset($_GET['pID']) && ($_GET['pID'] == $products['products_id']))) && !isset($pInfo) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
// find out the rating average from customer reviews
        $reviews_query = xos_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from " . TABLE_REVIEWS . " where products_id = '" . (int)$products['products_id'] . "'");
        $reviews = xos_db_fetch_array($reviews_query);
        $pInfo_array = array_merge((array)$products, (array)$reviews);
        $pInfo = new objectInfo($pInfo_array);
      }
      
      $products_array[]=array('selected' => (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id) ? true : false ),
                              'status' => ($products['products_status'] == '1' ? true : false),                                
                              'name' => $products['products_name'],
                              'sort_order' => $products['products_sort_order'],                             
                              'icon_status_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10),
                              'icon_status_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10),
                              'icon_status_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT, 10, 10),
                              'icon_status_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT, 10, 10),
                              'link_filename_categories_flag_0' => xos_href_link(FILENAME_CATEGORIES, 'action=setflag&flag=0&pID=' . $products['products_id'] . '&cPath=' . $cPath),
                              'link_filename_categories_flag_1' => xos_href_link(FILENAME_CATEGORIES, 'action=setflag&flag=1&pID=' . $products['products_id'] . '&cPath=' . $cPath),                                                              
                              'link_filename_categories_action_product_preview' => xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id'] . '&action=product_preview&read=only'),
                              'link_filename_categories_cpath_cpath_pid' => xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id']));
    }

    $cPath_back = '';
    $category_path = xos_generate_category_path($current_category_id);
    for ($i=(sizeof($category_path[0])-1); $i>0; $i--) { 
      $current_category_id != $category_path[0][$i]['id'] ? $cPath_back .= $category_path[0][$i]['id'] . '_' : ''; 
    } 
    $cPath_back = substr($cPath_back, 0, -1); 

    $cPath_back = (xos_not_null($cPath_back)) ? 'cPath=' . $cPath_back . '&' : '';

    if (isset($_GET['search'])) {
      $smarty->assign('link_filename_categories_back', xos_href_link(FILENAME_CATEGORIES));
    } elseif ($current_category_id > 0) {
      $smarty->assign('link_filename_categories_back', xos_href_link(FILENAME_CATEGORIES, $cPath_back . 'cpID=' . $current_category_id));
    }  
      
    if (!isset($_GET['search'])) {
      $smarty->assign(array('link_filename_categories_action_new_category' => xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&action=new_category'),
                            'link_filename_categories_action_new_product' => xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&action=new_product')));
    } 

    if (SID) {
      $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
    }
    
    $smarty->assign(array('categories' => $categories_array,
                          'products' => $products_array,
                          'categories_count' => $categories_count,
                          'products_count' => $products_count,
                          'is_level_top' => ($current_category_id == 0 ? true : false),
                          'form_begin_search' => xos_draw_form('search', FILENAME_CATEGORIES, '', 'get'),
                          'input_search' => xos_draw_input_field('search'),
                          'form_begin_goto' => xos_draw_form('goto', FILENAME_CATEGORIES, '', 'get'),
                          'pull_down_categories' => xos_draw_pull_down_menu('cPath', xos_get_category_tree(), $current_category_id, 'onchange="this.form.submit();"'),
                          'form_end' => '</form>')); 

    require(DIR_WS_BOXES . 'infobox_categories.php');
    
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'categories');
    $output_categories_and_products = $smarty->fetch(ADMIN_TPL . '/includes/modules/categories_and_products.tpl');    
endif;
?>
