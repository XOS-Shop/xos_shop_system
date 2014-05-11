<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : index.php
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
//              filename: index.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_DEFAULT) == 'overwrite_all')) :
// the following cPath references come from application_top.php
  $category_depth = 'top';
  if (isset($cPath) && xos_not_null($cPath)) {
    $category_status_query = xos_db_query("select categories_or_pages_id from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$current_category_id . "' and categories_or_pages_status = '1'");
    if (xos_db_num_rows($category_status_query) > 0) {
      $categories_products_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_or_pages_id = '" . (int)$current_category_id . "'");
      $categories_products = xos_db_fetch_array($categories_products_query);
      if ($categories_products['total'] > 0) {
        $category_depth = 'products'; // display products
      } else {
        $category_parent_query = xos_db_query("select count(*) as total from " . TABLE_CATEGORIES_OR_PAGES . " where parent_id = '" . (int)$current_category_id . "' and categories_or_pages_status = '1'");
        $category_parent = xos_db_fetch_array($category_parent_query);
        if ($category_parent['total'] > 0) {
          $category_depth = 'nested'; // navigate through the categories
        } else {
          $category_depth = 'products'; // category has no products, but display the 'no products' message
        }
      }
    }          
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_DEFAULT);
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  if ($category_depth == 'nested') {
  
    if (DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY == 'true') {
      is_numeric($_GET['max_display_products_in_category']) && $_GET['max_display_products_in_category'] >= 1 ? $_SESSION['max_display_products_in_category'] = $_GET['max_display_products_in_category'] : '';

      if ($_GET['products_in_c_view'] == 'list') { 
        $_SESSION['products_in_c_view'] = 'list'; 
      } elseif ($_GET['products_in_c_view'] == 'grid') { 
        $_SESSION['products_in_c_view'] = 'grid';
      }
    }  
        
    if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
      $smarty->caching = 1;
      $cache_id = 'L3|cc_index_categories|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['cPath'] . '-' . $_GET['sort'] . '-' . $_GET['page'] . '-' . $_GET['filter_id'] . '-' . $current_category_id . '-' . $_SESSION['max_display_products_in_category'] . '-' . $_SESSION['products_in_c_view'];
    }    
    
    $category_query = xos_db_query("select cpd.categories_or_pages_name, cpd.categories_or_pages_heading_title, cpd.categories_or_pages_content, c.categories_image, c.product_list_b from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = '" . (int)$current_category_id . "' and cpd.categories_or_pages_id = '" . (int)$current_category_id . "' and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
    $category = xos_db_fetch_array($category_query);

    if (DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY == 'true') {
      if ($session_started) {
        $pull_down_menu_display_products_in_category = xos_draw_form('display_products_in_category', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false, true, false, false, false), 'get') . xos_hide_session_id();
        $pull_down_menu_display_products_in_category .= xos_draw_hidden_field('cPath', $cPath) . xos_draw_hidden_field('sort', $_GET['sort']) . xos_draw_hidden_field('filter_id', $_GET['filter_id']);
        $max_display_products_in_category_array = array();
        $set = false;
        for ($i = 10; $i <=50 ; $i=$i+10) {  
          if (MAX_DISPLAY_PRODUCTS_IN_CATEGORY <= $i && $set == false) {
            $max_display_products_in_category_array[] = array('id' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
            $set = true;      
          }    
          if (MAX_DISPLAY_PRODUCTS_IN_CATEGORY != $i) {
            $max_display_products_in_category_array[] = array('id' => $i, 'text' => $i . TEXT_MAX_PRODUCTS);
          }
        }  
        if ($set == false) {
          $max_display_products_in_category_array[] = array('id' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
        }      
        $pull_down_menu_display_products_in_category_noscript = $pull_down_menu_display_products_in_category;
        $pull_down_menu_display_products_in_category .= xos_draw_pull_down_menu('max_display_products_in_category', $max_display_products_in_category_array, (isset($_SESSION['max_display_products_in_category']) ? $_SESSION['max_display_products_in_category'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY), 'id="max_display_products_in_category" onchange="this.form.submit()"') . '</form>';
        $pull_down_menu_display_products_in_category_noscript .= xos_draw_pull_down_menu('max_display_products_in_category', $max_display_products_in_category_array, (isset($_SESSION['max_display_products_in_category']) ? $_SESSION['max_display_products_in_category'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY), 'id="max_display_products_in_category"');    

        $link_switch_products_in_c_view = xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('products_in_c_view', 'sort', 'page')) . 'products_in_c_view=' . ((($category['product_list_b'] == 1 && $_SESSION['products_in_c_view'] != 'list') || (!isset($_GET['manufacturers_id']) && $_SESSION['products_in_c_view'] == 'grid')) ? 'list' : 'grid'), 'NONSSL', true, true, false, false, false);
      }
    
      $max_display = isset($_SESSION['max_display_products_in_category']) ? $_SESSION['max_display_products_in_category'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY;
            
      $smarty->assign(array('pull_down_menu_display_products' => $pull_down_menu_display_products_in_category,
                            'pull_down_menu_display_products_noscript_begin' => $pull_down_menu_display_products_in_category_noscript,
                            'pull_down_menu_display_products_noscript_end' => '</form>',
                            'label_for_max_display_products' => 'max_display_products_in_category',
                            'link_switch_view' => $link_switch_products_in_c_view));
    }                

    if(!$smarty->isCached(SELECTED_TPL . '/index.tpl', $cache_id)){ 
           
      if (isset($cPath) && strpos('_', $cPath)) {
// check to see if there are deeper categories within the current category
        $category_links = array_reverse($cPath_array);
        for($i=0, $n=sizeof($category_links); $i<$n; $i++) {
          $categories_query = xos_db_query("select count(*) as total from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_status = '1' and c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
          $categories = xos_db_fetch_array($categories_query);
          if ($categories['total'] < 1) {
          // do nothing, go through the loop
          } else {
            $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_status = '1' and c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by sort_order, cpd.categories_or_pages_name");
            break; // we've found the deepest category the customer is in
          }
        }
      } else {
        $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_status = '1' and c.parent_id = '" . (int)$current_category_id . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by sort_order, cpd.categories_or_pages_name");
      }

      $number_of_categories = xos_db_num_rows($categories_query);

      $rows = 0;
      $categories_array = array();
      while ($categories = xos_db_fetch_array($categories_query)) { 
            
        if (SHOW_EMPTY_CATEGORIES == 'true') {
          $products_in_categories = 1;          
        } else {
          $products_in_categories = xos_count_products_in_category($categories['categories_or_pages_id']);        
        }       
            
        if ($products_in_categories > 0) {      
          $rows++;
          $cPath_new = xos_get_path($categories['categories_or_pages_id']);
          $width = (int)((100 / MAX_DISPLAY_CATEGORIES_PER_ROW) -1) . '%';
          if ((($rows / MAX_DISPLAY_CATEGORIES_PER_ROW) == floor($rows / MAX_DISPLAY_CATEGORIES_PER_ROW)) && ($rows != $number_of_categories)) {
            $more_rows = true;
          } else {
            $more_rows = false;
          }     
          $categories_array[]=array('link_to_product_listing' => xos_href_link(FILENAME_DEFAULT, $cPath_new),
                                    'image' => xos_image(DIR_WS_IMAGES .'categories/medium/' . rawurlencode($categories['categories_image']), $categories['categories_or_pages_name']),
                                    'name' => $categories['categories_or_pages_name'],
                                    'td_width' => $width,
                                    'more_rows' => $more_rows); 
        }
      }

      $smarty->assign(array('heading_title' => $category['categories_or_pages_heading_title'],
                            'category_name' => $category['categories_or_pages_name'],
                            'category_description' => $category['categories_or_pages_content'],
                            'heading_image' => $page_info == 'false' ? xos_image(DIR_WS_IMAGES .'categories/small/' . rawurlencode($category['categories_image']), $category['categories_or_pages_name']) : '',
                            'display' => 'categories',
                            'categories' => $categories_array));
                            
// needed for the new products module shown below
      $new_products_category_id = $current_category_id;                       
      
      if (DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY == 'true') {
        if(($category['product_list_b'] == 1 && $_SESSION['products_in_c_view'] != 'list') || $_SESSION['products_in_c_view'] == 'grid') {
      
          $product_list_b = true;
      
          // create column list
          $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_B_MODEL,
                               'PRODUCT_LIST_NAME' => PRODUCT_LIST_B_NAME,
                               'PRODUCT_LIST_INFO' => PRODUCT_LIST_B_INFO,
                               'PRODUCT_LIST_PACKING_UNIT' => PRODUCT_LIST_B_PACKING_UNIT,
                               'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_B_MANUFACTURER,
                               'PRODUCT_LIST_PRICE' => PRODUCT_LIST_B_PRICE,
                               'PRODUCT_LIST_QUANTITY' => STOCK_CHECK == 'true' ? PRODUCT_LIST_B_QUANTITY : '',
                               'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_B_WEIGHT,
                               'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_B_IMAGE,
                               'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_B_BUY_NOW);
    
          define('PRODUCT_LIST_FILTER', PRODUCT_LIST_B_FILTER); 
      
        } else {
      
          $product_list_b = false; 
        
          // create column list
          $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_A_MODEL,
                               'PRODUCT_LIST_NAME' => PRODUCT_LIST_A_NAME,
                               'PRODUCT_LIST_INFO' => PRODUCT_LIST_A_INFO,
                               'PRODUCT_LIST_PACKING_UNIT' => PRODUCT_LIST_A_PACKING_UNIT,
                               'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_A_MANUFACTURER,
                               'PRODUCT_LIST_PRICE' => PRODUCT_LIST_A_PRICE,
                               'PRODUCT_LIST_QUANTITY' => STOCK_CHECK == 'true' ? PRODUCT_LIST_A_QUANTITY : '',
                               'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_A_WEIGHT,
                               'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_A_IMAGE,
                               'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_A_BUY_NOW);         
      
          define('PRODUCT_LIST_FILTER', PRODUCT_LIST_A_FILTER);
      
        }                          

        asort($define_list);

        $column_list = array();
        reset($define_list);
        while (list($key, $value) = each($define_list)) {
          if ($value == '') $value = -1;
          if ($value >= 0) $column_list[] = $key;
        }

        $select_column_list = '';

        for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
          switch ($column_list[$i]) {
            case 'PRODUCT_LIST_MODEL':
              $select_column_list .= 'p.products_model, ';
              break;
            case 'PRODUCT_LIST_NAME':
              $select_column_list .= 'pd.products_name, ';
              break;
            case 'PRODUCT_LIST_INFO':
              $select_column_list .= 'pd.products_info, ';
              break;
            case 'PRODUCT_LIST_PACKING_UNIT':
              $select_column_list .= 'pd.products_p_unit, ';
              break;                   
            case 'PRODUCT_LIST_MANUFACTURER':
              $select_column_list .= 'mi.manufacturers_name, ';
              break;
            case 'PRODUCT_LIST_QUANTITY':
              $select_column_list .= 'p.products_quantity, ';
              break;
            case 'PRODUCT_LIST_IMAGE':
              $select_column_list .= 'p.products_image, ';
              break;
            case 'PRODUCT_LIST_WEIGHT':
              $select_column_list .= 'p.products_weight, ';
              break;
          }
        }

        if (!isset($_SESSION['customer_id'])) {
          $customer_country_id = STORE_COUNTRY;
          $customer_zone_id = STORE_ZONE;
        } else {
          $customer_country_id = $_SESSION['customer_country_id'];
          $customer_zone_id = $_SESSION['customer_zone_id'];
        }    

        $subcategories_array = array();
        xos_get_subcategories($subcategories_array, $current_category_id);
        $subcategories_str = " and (p2c.categories_or_pages_id = '" . (int)$current_category_id . "'";
        for ($i=0, $n=sizeof($subcategories_array); $i<$n; $i++ ) {
          $subcategories_str .= " or p2c.categories_or_pages_id = '" . (int)$subcategories_array[$i] . "'";
        }
        $subcategories_str .= ")";

// show the products in a given categorie
        if (isset($_GET['filter_id']) && xos_not_null($_GET['filter_id'])) {
// We are asked to show only specific catgeory
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {      
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * if(tr.tax_rate_final is null, 1, 1 + (tr.tax_rate_final / 100))) as final_price, tr.tax_rate_final from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_ZONES_TO_GEO_ZONES . " gz on (gz.zone_country_id is null or gz.zone_country_id = '0' or gz.zone_country_id = '" . (int)$customer_country_id . "') and (gz.zone_id is null or gz.zone_id = '0' or gz.zone_id = '" . (int)$customer_zone_id . "') left join " . TABLE_TAX_RATES_FINAL . " tr on p.products_tax_class_id = tr.tax_class_id and gz.geo_zone_id = tr.tax_zone_id," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and mi.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' " . $subcategories_str . " group by p.products_id";        
          } else {
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "'," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and mi.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' " . $subcategories_str . "";
          }
        } else {
// We show them all
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {        
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * if(tr.tax_rate_final is null, 1, 1 + (tr.tax_rate_final / 100))) as final_price, tr.tax_rate_final from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_ZONES_TO_GEO_ZONES . " gz on (gz.zone_country_id is null or gz.zone_country_id = '0' or gz.zone_country_id = '" . (int)$customer_country_id . "') and (gz.zone_id is null or gz.zone_id = '0' or gz.zone_id = '" . (int)$customer_zone_id . "') left join " . TABLE_TAX_RATES_FINAL . " tr on p.products_tax_class_id = tr.tax_class_id and gz.geo_zone_id = tr.tax_zone_id," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' " . $subcategories_str . " group by p.products_id";        
          } else {
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "'," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' " . $subcategories_str . "";
          }
        }

        if ( (empty($_GET['sort'])) || (!preg_match('/^[0-9][ad]$/', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
          for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
            if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
              $listing_sql .= " order by p.products_sort_order, pd.products_name"; 
              break;
            }
          }
        } else {
          $sort_col = substr($_GET['sort'], 0 , 1);
          $sort_order = substr($_GET['sort'], 1);
          switch ($column_list[$sort_col]) {
            case 'PRODUCT_LIST_MODEL':
              $listing_sql .= " order by p.products_model " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_NAME':
              $listing_sql .= " order by pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
              break;
            case 'PRODUCT_LIST_INFO':
//--------[Alternative] wenn hier aendern auch product_listing.php, specials.php, advanced_search_and_results.php, und search_result.php aendern----------- 
//              $listing_sql .= " order by pd.products_info ". ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
//------------------------------------------------------------------------------------------------------------------
              $listing_sql .= " order by pd.products_name";
              break; 
            case 'PRODUCT_LIST_PACKING_UNIT':       
              $listing_sql .= " order by pd.products_p_unit " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;                   
            case 'PRODUCT_LIST_MANUFACTURER':
              $listing_sql .= " order by mi.manufacturers_name " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_QUANTITY':
              $listing_sql .= " order by p.products_quantity " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_IMAGE':
              $listing_sql .= " order by pd.products_name";
              break;
            case 'PRODUCT_LIST_WEIGHT':
              $listing_sql .= " order by p.products_weight " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_PRICE':
              $listing_sql .= " order by final_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
          }
        }

// optional Product List Filter
        if (PRODUCT_LIST_FILTER > 0) {
          $filterlist_sql= "select distinct mi.manufacturers_id as id, mi.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS_INFO . " mi where p.products_status = '1' and p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id = p2c.products_id " . $subcategories_str . " order by mi.manufacturers_name";
          $filterlist_query = xos_db_query($filterlist_sql);
          if (xos_db_num_rows($filterlist_query) > 1) {
        
            $hidden_get_variables = '';
            if (!$session_started && xos_not_null($_GET['currency'])) {
              $hidden_get_variables .= xos_draw_hidden_field('currency', $_GET['currency']);
            }  

            if (!$session_started && xos_not_null($_GET['language'])) {
              $hidden_get_variables .= xos_draw_hidden_field('language', $_GET['language']);
            }          

            if (!$session_started && xos_not_null($_GET['tpl'])) {
              $hidden_get_variables .= xos_draw_hidden_field('tpl', $_GET['tpl']);
            } 
        
            $pull_down_menu = xos_draw_form('filter', xos_href_link(FILENAME_DEFAULT, '', $request_type, false, true, false, false, false), 'get') . $hidden_get_variables . xos_hide_session_id();
            $pull_down_menu .= xos_draw_hidden_field('cPath', $cPath);
            $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
            $pull_down_menu .= xos_draw_hidden_field('sort', $_GET['sort']);
            while ($filterlist = xos_db_fetch_array($filterlist_query)) {
              $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
            }
            $pull_down_menu_noscript = $pull_down_menu;
            $pull_down_menu .= xos_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'id="filter_id" onchange="this.form.submit()"') . '</form>';
            $pull_down_menu_noscript .= xos_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'id="filter_id"'); 
          }
        }

        $smarty->assign(array('pull_down_menu' => $pull_down_menu,
                              'pull_down_menu_noscript_begin' => $pull_down_menu_noscript,
                              'pull_down_menu_noscript_end' => '</form>',
                              'label_for_pull_down_menu' => 'filter_id'));
      }                          
    
      $smarty->caching = 0;
      
      if (DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY == 'true') {
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);
      } else {
        include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS);
      }      
    
      if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
        $smarty->caching = 1;
      }            
    }    

  } elseif ($category_depth == 'products' || !empty($_GET['manufacturers_id'])) { 
                             
    if (isset($_GET['manufacturers_id'])) { 

      is_numeric($_GET['max_display_products_of_manufacturer']) && $_GET['max_display_products_of_manufacturer'] >= 1 ? $_SESSION['max_display_products_of_manufacturer'] = $_GET['max_display_products_of_manufacturer'] : '';

      if ($_GET['products_of_m_view'] == 'list') { 
        $_SESSION['products_of_m_view'] = 'list'; 
      } elseif ($_GET['products_of_m_view'] == 'grid') { 
        $_SESSION['products_of_m_view'] = 'grid';
      }
    
      if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
        $smarty->caching = 1;
        $cache_id = 'L3|cc_index_manufacturers|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['manufacturers_id'] . '-' . $_GET['sort'] . '-' . $_GET['page'] . '-' . $_GET['filter_id'] . '-' . $_SESSION['max_display_products_of_manufacturer'] . '-' . $_SESSION['products_of_m_view'];
      }    
        
      $manufacturer_query = xos_db_query("select m.manufacturers_image, mi.manufacturers_name from " . TABLE_MANUFACTURERS . " m, " . TABLE_MANUFACTURERS_INFO . " mi where m.manufacturers_id = mi.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "'");
      $manufacturer = xos_db_fetch_array($manufacturer_query);      

      if ($session_started) {
        $pull_down_menu_display_products_of_manufacturer = xos_draw_form('display_products_of_manufacturer', xos_href_link(FILENAME_DEFAULT, '', $request_type, false, true, false, false, false), 'get') . xos_hide_session_id();
        $pull_down_menu_display_products_of_manufacturer .= xos_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']) . xos_draw_hidden_field('sort', $_GET['sort']) . xos_draw_hidden_field('filter_id', $_GET['filter_id']);
        $max_display_products_of_manufacturer_array = array();
        $set = false;
        for ($i = 10; $i <=50 ; $i=$i+10) {  
          if (MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER <= $i && $set == false) {
            $max_display_products_of_manufacturer_array[] = array('id' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER, 'text' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER . TEXT_MAX_PRODUCTS);
            $set = true;      
          }    
          if (MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER != $i) {
            $max_display_products_of_manufacturer_array[] = array('id' => $i, 'text' => $i . TEXT_MAX_PRODUCTS);
          }
        }  
        if ($set == false) {
          $max_display_products_of_manufacturer_array[] = array('id' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER, 'text' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER . TEXT_MAX_PRODUCTS);
        }      
        $pull_down_menu_display_products_of_manufacturer_noscript = $pull_down_menu_display_products_of_manufacturer;
        $pull_down_menu_display_products_of_manufacturer .= xos_draw_pull_down_menu('max_display_products_of_manufacturer', $max_display_products_of_manufacturer_array, (isset($_SESSION['max_display_products_of_manufacturer']) ? $_SESSION['max_display_products_of_manufacturer'] : MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER), 'id="max_display_products_of_manufacturer" onchange="this.form.submit()"') . '</form>';
        $pull_down_menu_display_products_of_manufacturer_noscript .= xos_draw_pull_down_menu('max_display_products_of_manufacturer', $max_display_products_of_manufacturer_array, (isset($_SESSION['max_display_products_of_manufacturer']) ? $_SESSION['max_display_products_of_manufacturer'] : MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER), 'id="max_display_products_of_manufacturer"');    

        $link_switch_products_of_m_view = xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('products_of_m_view', 'sort', 'page')) . 'products_of_m_view=' . (((isset($_GET['manufacturers_id']) && $_SESSION['products_of_m_view'] != 'list' && PRODUCT_LISTS_FOR_MANUFACTURERS == 'B') || (isset($_GET['manufacturers_id']) && $_SESSION['products_of_m_view'] == 'grid')) ? 'list' : 'grid'), 'NONSSL', true, true, false, false, false);
      }

      $max_display = isset($_SESSION['max_display_products_of_manufacturer']) ? $_SESSION['max_display_products_of_manufacturer'] : MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER;
      
      $smarty->assign(array('manufacturer' => true,
                            'heading_title' => $manufacturer['manufacturers_name'],
                            'heading_image' => xos_image(DIR_WS_IMAGES .'manufacturers/' . rawurlencode($manufacturer['manufacturers_image']), $manufacturer['manufacturers_name']), 
                            'pull_down_menu_display_products' => $pull_down_menu_display_products_of_manufacturer,
                            'pull_down_menu_display_products_noscript_begin' => $pull_down_menu_display_products_of_manufacturer_noscript,
                            'pull_down_menu_display_products_noscript_end' => '</form>',
                            'label_for_max_display_products' => 'max_display_products_of_manufacturer',
                            'link_switch_view' => $link_switch_products_of_m_view)); 
            
    } elseif ($current_category_id) {

      is_numeric($_GET['max_display_products_in_category']) && $_GET['max_display_products_in_category'] >= 1 ? $_SESSION['max_display_products_in_category'] = $_GET['max_display_products_in_category'] : '';

      if ($_GET['products_in_c_view'] == 'list') { 
        $_SESSION['products_in_c_view'] = 'list'; 
      } elseif ($_GET['products_in_c_view'] == 'grid') { 
        $_SESSION['products_in_c_view'] = 'grid';
      }
        
      if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
        $smarty->caching = 1;
        $cache_id = 'L3|cc_index_products|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['cPath'] . '-' . $_GET['sort'] . '-' . $_GET['page'] . '-' . $_GET['filter_id'] . '-' . $current_category_id . '-' . $_SESSION['max_display_products_in_category'] . '-' . $_SESSION['products_in_c_view'];
      }    
    
      $category_query = xos_db_query("select cpd.categories_or_pages_name, cpd.categories_or_pages_heading_title, cpd.categories_or_pages_content, c.categories_image, c.product_list_b from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = '" . (int)$current_category_id . "' and cpd.categories_or_pages_id = '" . (int)$current_category_id . "' and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
      $category = xos_db_fetch_array($category_query);

      if ($session_started) {
        $pull_down_menu_display_products_in_category = xos_draw_form('display_products_in_category', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false, true, false, false, false), 'get') . xos_hide_session_id();
        $pull_down_menu_display_products_in_category .= xos_draw_hidden_field('cPath', $cPath) . xos_draw_hidden_field('sort', $_GET['sort']) . xos_draw_hidden_field('filter_id', $_GET['filter_id']);
        $max_display_products_in_category_array = array();
        $set = false;
        for ($i = 10; $i <=50 ; $i=$i+10) {  
          if (MAX_DISPLAY_PRODUCTS_IN_CATEGORY <= $i && $set == false) {
            $max_display_products_in_category_array[] = array('id' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
            $set = true;      
          }    
          if (MAX_DISPLAY_PRODUCTS_IN_CATEGORY != $i) {
            $max_display_products_in_category_array[] = array('id' => $i, 'text' => $i . TEXT_MAX_PRODUCTS);
          }
        }  
        if ($set == false) {
          $max_display_products_in_category_array[] = array('id' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
        }      
        $pull_down_menu_display_products_in_category_noscript = $pull_down_menu_display_products_in_category;
        $pull_down_menu_display_products_in_category .= xos_draw_pull_down_menu('max_display_products_in_category', $max_display_products_in_category_array, (isset($_SESSION['max_display_products_in_category']) ? $_SESSION['max_display_products_in_category'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY), 'id="max_display_products_in_category" onchange="this.form.submit()"') . '</form>';
        $pull_down_menu_display_products_in_category_noscript .= xos_draw_pull_down_menu('max_display_products_in_category', $max_display_products_in_category_array, (isset($_SESSION['max_display_products_in_category']) ? $_SESSION['max_display_products_in_category'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY), 'id="max_display_products_in_category"');    

        $link_switch_products_in_c_view = xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('products_in_c_view', 'sort', 'page')) . 'products_in_c_view=' . ((($category['product_list_b'] == 1 && $_SESSION['products_in_c_view'] != 'list') || (!isset($_GET['manufacturers_id']) && $_SESSION['products_in_c_view'] == 'grid')) ? 'list' : 'grid'), 'NONSSL', true, true, false, false, false);
      }

      $max_display = isset($_SESSION['max_display_products_in_category']) ? $_SESSION['max_display_products_in_category'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY;
            
      $smarty->assign(array('heading_title' => $category['categories_or_pages_heading_title'],
                            'category_name' => $category['categories_or_pages_name'],
                            'category_description' => $category['categories_or_pages_content'],
                            'heading_image' => $page_info == 'false' ? xos_image(DIR_WS_IMAGES .'categories/small/' . rawurlencode($category['categories_image']), $category['categories_or_pages_name']) : '',
                            'pull_down_menu_display_products' => $pull_down_menu_display_products_in_category,
                            'pull_down_menu_display_products_noscript_begin' => $pull_down_menu_display_products_in_category_noscript,
                            'pull_down_menu_display_products_noscript_end' => '</form>',
                            'label_for_max_display_products' => 'max_display_products_in_category',
                            'link_switch_view' => $link_switch_products_in_c_view));                                      
    }
    
    
    if(!$smarty->isCached(SELECTED_TPL . '/index.tpl', $cache_id)){ 
    
      if((($category['product_list_b'] == 1 && $_SESSION['products_in_c_view'] != 'list') || (!isset($_GET['manufacturers_id']) && $_SESSION['products_in_c_view'] == 'grid')) || ((isset($_GET['manufacturers_id']) && $_SESSION['products_of_m_view'] != 'list' && PRODUCT_LISTS_FOR_MANUFACTURERS == 'B') || (isset($_GET['manufacturers_id']) && $_SESSION['products_of_m_view'] == 'grid'))) {
      
        $product_list_b = true;
      
        // create column list
        $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_B_MODEL,
                             'PRODUCT_LIST_NAME' => PRODUCT_LIST_B_NAME,
                             'PRODUCT_LIST_INFO' => PRODUCT_LIST_B_INFO,
                             'PRODUCT_LIST_PACKING_UNIT' => PRODUCT_LIST_B_PACKING_UNIT,
                             'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_B_MANUFACTURER,
                             'PRODUCT_LIST_PRICE' => PRODUCT_LIST_B_PRICE,
                             'PRODUCT_LIST_QUANTITY' => STOCK_CHECK == 'true' ? PRODUCT_LIST_B_QUANTITY : '',
                             'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_B_WEIGHT,
                             'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_B_IMAGE,
                             'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_B_BUY_NOW);
    
        define('PRODUCT_LIST_FILTER', PRODUCT_LIST_B_FILTER); 
      
      } else {
      
        $product_list_b = false; 
        
        // create column list
        $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_A_MODEL,
                             'PRODUCT_LIST_NAME' => PRODUCT_LIST_A_NAME,
                             'PRODUCT_LIST_INFO' => PRODUCT_LIST_A_INFO,
                             'PRODUCT_LIST_PACKING_UNIT' => PRODUCT_LIST_A_PACKING_UNIT,
                             'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_A_MANUFACTURER,
                             'PRODUCT_LIST_PRICE' => PRODUCT_LIST_A_PRICE,
                             'PRODUCT_LIST_QUANTITY' => STOCK_CHECK == 'true' ? PRODUCT_LIST_A_QUANTITY : '',
                             'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_A_WEIGHT,
                             'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_A_IMAGE,
                             'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_A_BUY_NOW);         
      
        define('PRODUCT_LIST_FILTER', PRODUCT_LIST_A_FILTER);
      
      }                          

      asort($define_list);

      $column_list = array();
      reset($define_list);
      while (list($key, $value) = each($define_list)) {
        if ($value == '') $value = -1;
        if ($value >= 0) $column_list[] = $key;
      }

      $select_column_list = '';

      for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
        switch ($column_list[$i]) {
          case 'PRODUCT_LIST_MODEL':
            $select_column_list .= 'p.products_model, ';
            break;
          case 'PRODUCT_LIST_NAME':
            $select_column_list .= 'pd.products_name, ';
            break;
          case 'PRODUCT_LIST_INFO':
            $select_column_list .= 'pd.products_info, ';
            break;
          case 'PRODUCT_LIST_PACKING_UNIT':
            $select_column_list .= 'pd.products_p_unit, ';
            break;                   
          case 'PRODUCT_LIST_MANUFACTURER':
            $select_column_list .= 'mi.manufacturers_name, ';
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $select_column_list .= 'p.products_quantity, ';
            break;
          case 'PRODUCT_LIST_IMAGE':
            $select_column_list .= 'p.products_image, ';
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $select_column_list .= 'p.products_weight, ';
            break;
        }
      }

      if (!isset($_SESSION['customer_id'])) {
        $customer_country_id = STORE_COUNTRY;
        $customer_zone_id = STORE_ZONE;
      } else {
        $customer_country_id = $_SESSION['customer_country_id'];
        $customer_zone_id = $_SESSION['customer_zone_id'];
      }    

// show the products of a specified manufacturer
      if (isset($_GET['manufacturers_id'])) {
        if (isset($_GET['filter_id']) && xos_not_null($_GET['filter_id'])) {
// We are asked to show only a specific category
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {    
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * if(tr.tax_rate_final is null, 1, 1 + (tr.tax_rate_final / 100))) as final_price, tr.tax_rate_final from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_ZONES_TO_GEO_ZONES . " gz on (gz.zone_country_id is null or gz.zone_country_id = '0' or gz.zone_country_id = '" . (int)$customer_country_id . "') and (gz.zone_id is null or gz.zone_id = '0' or gz.zone_id = '" . (int)$customer_zone_id . "') left join " . TABLE_TAX_RATES_FINAL . " tr on p.products_tax_class_id = tr.tax_class_id and gz.geo_zone_id = tr.tax_zone_id," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and mi.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p2c.categories_or_pages_id = '" . (int)$_GET['filter_id'] . "' group by p.products_id";
          } else {
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "'," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and mi.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p2c.categories_or_pages_id = '" . (int)$_GET['filter_id'] . "'";
          }         
        } else {
// We show them all
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {            
            $listing_sql = "select distinct " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * if(tr.tax_rate_final is null, 1, 1 + (tr.tax_rate_final / 100))) as final_price, tr.tax_rate_final from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_ZONES_TO_GEO_ZONES . " gz on (gz.zone_country_id is null or gz.zone_country_id = '0' or gz.zone_country_id = '" . (int)$customer_country_id . "') and (gz.zone_id is null or gz.zone_id = '0' or gz.zone_id = '" . (int)$customer_zone_id . "') left join " . TABLE_TAX_RATES_FINAL . " tr on p.products_tax_class_id = tr.tax_class_id and gz.geo_zone_id = tr.tax_zone_id left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and mi.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' group by p.products_id";
          } else {
            $listing_sql = "select distinct " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and mi.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'";
          }
        }
      } else {
// show the products in a given categorie
        if (isset($_GET['filter_id']) && xos_not_null($_GET['filter_id'])) {
// We are asked to show only specific catgeory
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {      
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * if(tr.tax_rate_final is null, 1, 1 + (tr.tax_rate_final / 100))) as final_price, tr.tax_rate_final from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_ZONES_TO_GEO_ZONES . " gz on (gz.zone_country_id is null or gz.zone_country_id = '0' or gz.zone_country_id = '" . (int)$customer_country_id . "') and (gz.zone_id is null or gz.zone_id = '0' or gz.zone_id = '" . (int)$customer_zone_id . "') left join " . TABLE_TAX_RATES_FINAL . " tr on p.products_tax_class_id = tr.tax_class_id and gz.geo_zone_id = tr.tax_zone_id," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and mi.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p2c.categories_or_pages_id = '" . (int)$current_category_id . "' group by p.products_id";        
          } else {
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "'," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and mi.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p2c.categories_or_pages_id = '" . (int)$current_category_id . "'";
          }
        } else {
// We show them all
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {        
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * if(tr.tax_rate_final is null, 1, 1 + (tr.tax_rate_final / 100))) as final_price, tr.tax_rate_final from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_ZONES_TO_GEO_ZONES . " gz on (gz.zone_country_id is null or gz.zone_country_id = '0' or gz.zone_country_id = '" . (int)$customer_country_id . "') and (gz.zone_id is null or gz.zone_id = '0' or gz.zone_id = '" . (int)$customer_zone_id . "') left join " . TABLE_TAX_RATES_FINAL . " tr on p.products_tax_class_id = tr.tax_class_id and gz.geo_zone_id = tr.tax_zone_id," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p2c.categories_or_pages_id = '" . (int)$current_category_id . "' group by p.products_id";        
          } else {
            $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "'," . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p2c.categories_or_pages_id = '" . (int)$current_category_id . "'";
          }
        }
      }

      if ( (empty($_GET['sort'])) || (!preg_match('/^[0-9][ad]$/', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
        for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
          if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
            if (isset($_GET['manufacturers_id'])) {
              $_GET['sort'] = $i . 'a';
              $listing_sql .= " order by pd.products_name";
            } else {
              $listing_sql .= " order by p.products_sort_order";
            }  
            break;
          }
        }
      } else {
        $sort_col = substr($_GET['sort'], 0 , 1);
        $sort_order = substr($_GET['sort'], 1);
        switch ($column_list[$sort_col]) {
          case 'PRODUCT_LIST_MODEL':
            $listing_sql .= " order by p.products_model " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
            break;
          case 'PRODUCT_LIST_NAME':
            $listing_sql .= " order by pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
            break;
          case 'PRODUCT_LIST_INFO':
//--------[Alternative] wenn hier aendern auch product_listing.php, specials.php, advanced_search_and_results.php, und search_result.php aendern----------- 
//            $listing_sql .= " order by pd.products_info ". ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
//------------------------------------------------------------------------------------------------------------------
            $listing_sql .= " order by pd.products_name";
            break; 
          case 'PRODUCT_LIST_PACKING_UNIT':       
            $listing_sql .= " order by pd.products_p_unit " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
            break;                   
          case 'PRODUCT_LIST_MANUFACTURER':
            $listing_sql .= " order by mi.manufacturers_name " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $listing_sql .= " order by p.products_quantity " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
            break;
          case 'PRODUCT_LIST_IMAGE':
            $listing_sql .= " order by pd.products_name";
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $listing_sql .= " order by p.products_weight " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
            break;
          case 'PRODUCT_LIST_PRICE':
            $listing_sql .= " order by final_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
            break;
        }
      }

// optional Product List Filter
      if (PRODUCT_LIST_FILTER > 0) {
        if (isset($_GET['manufacturers_id'])) {
          $filterlist_sql = "select distinct c.categories_or_pages_id as id, cpd.categories_or_pages_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_status = '1' and p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and p2c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' order by cpd.categories_or_pages_name";
        } else {
          $filterlist_sql= "select distinct mi.manufacturers_id as id, mi.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS_INFO . " mi where p.products_status = '1' and p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = '" . (int)$current_category_id . "' order by mi.manufacturers_name";
        }
        $filterlist_query = xos_db_query($filterlist_sql);
        if (xos_db_num_rows($filterlist_query) > 1) {
        
          $hidden_get_variables = '';
          if (!$session_started && xos_not_null($_GET['currency'])) {
            $hidden_get_variables .= xos_draw_hidden_field('currency', $_GET['currency']);
          }  

          if (!$session_started && xos_not_null($_GET['language'])) {
            $hidden_get_variables .= xos_draw_hidden_field('language', $_GET['language']);
          }          

          if (!$session_started && xos_not_null($_GET['tpl'])) {
            $hidden_get_variables .= xos_draw_hidden_field('tpl', $_GET['tpl']);
          } 
        
          $pull_down_menu = xos_draw_form('filter', xos_href_link(FILENAME_DEFAULT, '', $request_type, false, true, false, false, false), 'get') . $hidden_get_variables . xos_hide_session_id();
          if (isset($_GET['manufacturers_id'])) {
            $pull_down_menu .= xos_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']);
            $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
          } else {
            $pull_down_menu .= xos_draw_hidden_field('cPath', $cPath);
            $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
          }
          $pull_down_menu .= xos_draw_hidden_field('sort', $_GET['sort']);
          while ($filterlist = xos_db_fetch_array($filterlist_query)) {
            $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
          }
          $pull_down_menu_noscript = $pull_down_menu;
          $pull_down_menu .= xos_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'id="filter_id" onchange="this.form.submit()"') . '</form>';
          $pull_down_menu_noscript .= xos_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'id="filter_id"'); 
        }
      }

      $smarty->assign(array('pull_down_menu' => $pull_down_menu,
                            'pull_down_menu_noscript_begin' => $pull_down_menu_noscript,
                            'pull_down_menu_noscript_end' => '</form>',
                            'label_for_pull_down_menu' => 'filter_id',
                            'display' => 'products'));    
    
      $smarty->caching = 0;
    
      include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);
    
      if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
        $smarty->caching = 1;
      }            
    }
        
  } else { // default page 
    
    if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
      $smarty->caching = 1;
      $cache_id = 'L3|cc_index_default|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_SESSION['customer_id'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $new_products_category_id . '-' . $current_category_id;
    }
    
    if(!$smarty->isCached(SELECTED_TPL . '/index.tpl', $cache_id)){  
   
      $content_query = xos_db_query("select cd.name, cd.heading_title, cd.content from " . TABLE_CONTENTS . " c, " . TABLE_CONTENTS_DATA . " cd where c.type = 'index' and c.status = '1' and c.content_id = cd.content_id and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
      $content = xos_db_fetch_array($content_query);
    
      $smarty->assign(array('heading_title' => $content['heading_title'],
                            'content' => $content['content']));

      $smarty->caching = 0;
    
      include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS);
      include(DIR_WS_MODULES . FILENAME_UPCOMING_PRODUCTS);

      if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
        $smarty->caching = 1;
      }
    }  
  } 

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'index');    
  $output_index = $smarty->fetch(SELECTED_TPL . '/index.tpl', $cache_id);
 
  if (isset($_SESSION['customer_first_name']) && isset($_SESSION['customer_id'])) {
    if (ACCOUNT_GENDER == 'true' && isset($_SESSION['customer_gender']) && $_SESSION['customer_gender'] != '') {
      $welcome_string = sprintf(TEXT_GREETING_PERSONAL, ($_SESSION['customer_gender'] == 'm' ? MALE_ADDRESS : FEMALE_ADDRESS) . '&nbsp;' . xos_output_string_protected($_SESSION['customer_first_name']) . '&nbsp;' . xos_output_string_protected($_SESSION['customer_lastname']), xos_href_link(FILENAME_PRODUCTS_NEW));
    } else {
      $welcome_string = sprintf(TEXT_GREETING_PERSONAL, xos_output_string_protected($_SESSION['customer_first_name']) . '&nbsp;' . xos_output_string_protected($_SESSION['customer_lastname']), xos_href_link(FILENAME_PRODUCTS_NEW)); 
    }
  } else {
    $welcome_string = sprintf(TEXT_GREETING_GUEST, xos_href_link(FILENAME_LOGIN, '', 'SSL'), xos_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
  }
      
  $output_index = str_replace('[@{$welcome}@]', '<span class="welcome-string">' . $welcome_string . '</span>', $output_index);    
                          
  $smarty->assign('central_contents', $output_index);  
  
  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
