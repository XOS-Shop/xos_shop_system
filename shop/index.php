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
    $category_status_query = $DB->prepare
    (
     "SELECT categories_or_pages_id
      FROM   " . TABLE_CATEGORIES_OR_PAGES . "
      WHERE  categories_or_pages_id = :current_category_id
      AND    categories_or_pages_status = '1'"
    );
    
    $DB->perform($category_status_query, array(':current_category_id' => (int)$current_category_id));
    
    if ($category_status_query->rowCount() > 0) {
      $categories_products_query = $DB->prepare
      (
       "SELECT Count(*) AS total
        FROM   " . TABLE_PRODUCTS_TO_CATEGORIES . "
        WHERE  categories_or_pages_id = :current_category_id"
      );
      
      $DB->perform($categories_products_query, array(':current_category_id' => (int)$current_category_id));
      
      $categories_products = $categories_products_query->fetch();
      
      if ($categories_products['total'] > 0) {
        $category_depth = 'products'; // display products
      } else {
        $category_parent_query = $DB->prepare
        (
         "SELECT Count(*) AS total
          FROM   " . TABLE_CATEGORIES_OR_PAGES . "
          WHERE  parent_id = :current_category_id
          AND    categories_or_pages_status = '1'"
        );
        
        $DB->perform($category_parent_query, array(':current_category_id' => (int)$current_category_id));
        
        $category_parent = $category_parent_query->fetch();
        
        if ($category_parent['total'] > 0) {
          $category_depth = 'nested'; // navigate through the categories
        } else {
          $category_depth = 'products'; // category has no products, but display the 'no products' message
        }
      }
    }          
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_DEFAULT);
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  if ($category_depth == 'nested') {
  
    if (DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY == 'true') {
      is_numeric($_GET['mdpc']) && $_GET['mdpc'] >= 1 ? $_SESSION['mdpc'] = $_GET['mdpc'] : '';

      if ($_GET['pcv'] == 'list') { 
        $_SESSION['pcv'] = 'list'; 
      } elseif ($_GET['pcv'] == 'grid') { 
        $_SESSION['pcv'] = 'grid';
      }
    }  
        
    if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
      $smarty->caching = 1;
      $cache_id = 'L3|cc_index_categories|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['c'] . '-' . $_GET['sort'] . '-' . $_GET['page'] . '-' . $_GET['filter'] . '-' . $current_category_id . '-' . $_SESSION['mdpc'] . '-' . $_SESSION['pcv'];
    }    
    
    $category_query = $DB->prepare
    (
     "SELECT cpd.categories_or_pages_name,
             cpd.categories_or_pages_heading_title,
             cpd.categories_or_pages_content,
             c.categories_image,
             c.product_list_b
      FROM   " . TABLE_CATEGORIES_OR_PAGES . " c,
             " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd
      WHERE  c.categories_or_pages_id = :current_category_id
      AND    cpd.categories_or_pages_id = :current_category_id
      AND    cpd.language_id = :languages_id"
    );
 
    $DB->perform($category_query, array(':current_category_id' => (int)$current_category_id,
                                        ':languages_id' => (int)$_SESSION['languages_id'])); 
    
    $category = $category_query->fetch();

    if (DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY == 'true') {
      if ($session_started) {
        $pull_down_menu_display_products_in_category = xos_draw_form('display_products_in_category', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false, true, false, false, false), 'get');
        $pull_down_menu_display_products_in_category_noscript = xos_draw_form('display_products_in_category', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false, false, false, false, false), 'get') . xos_hide_session_id();        
        $pull_down_menu_display_products_in_category_noscript .= xos_draw_hidden_field('c', $cPath) . xos_draw_hidden_field('sort', $_GET['sort']) . xos_draw_hidden_field('filter', $_GET['filter']);
        $max_display_products_in_category_array = array();
        $max_display_products_in_category_array_noscript = array();
        $set = false;
        for ($i = 10; $i <=50 ; $i=$i+10) {  
          if (MAX_DISPLAY_PRODUCTS_IN_CATEGORY <= $i && $set == false) {
            $max_display_products_in_category_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpc', 'page')) . 'mdpc=' . MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
            $max_display_products_in_category_array_noscript[] = array('id' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);            
            $set = true;      
          }    
          if (MAX_DISPLAY_PRODUCTS_IN_CATEGORY != $i) {
            $max_display_products_in_category_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpc', 'page')) . 'mdpc=' . $i, 'NONSSL', true, true, false, false, false), 'text' => $i . TEXT_MAX_PRODUCTS);
            $max_display_products_in_category_array_noscript[] = array('id' => $i, 'text' => $i . TEXT_MAX_PRODUCTS);
          }
        }  
        if ($set == false) {
          $max_display_products_in_category_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpc', 'page')) . 'mdpc=' . MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
          $max_display_products_in_category_array_noscript[] = array('id' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
        }      
        $pull_down_menu_display_products_in_category .= xos_draw_pull_down_menu('mdpc', $max_display_products_in_category_array, xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpc', 'page')) . 'mdpc=' . (isset($_SESSION['mdpc']) ? $_SESSION['mdpc'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY), 'NONSSL', true, true, false, false, false), 'class="form-control" id="mdpc" onchange="location = form.mdpc.options[form.mdpc.selectedIndex].value;"') . '</form>';
        $pull_down_menu_display_products_in_category_noscript .= xos_draw_pull_down_menu('mdpc', $max_display_products_in_category_array_noscript, (isset($_SESSION['mdpc']) ? $_SESSION['mdpc'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY), 'class="form-control" id="mdpc"');    

        $link_switch_products_in_c_view = xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('pcv', 'sort', 'page')) . 'pcv=' . ((($category['product_list_b'] == 1 && $_SESSION['pcv'] != 'list') || (!isset($_GET['m']) && $_SESSION['pcv'] == 'grid')) ? 'list' : 'grid'), 'NONSSL', true, true, false, false, false);
      }
    
      $max_display = isset($_SESSION['mdpc']) ? $_SESSION['mdpc'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY;
            
      $smarty->assign(array('pull_down_menu_display_products' => $pull_down_menu_display_products_in_category,
                            'pull_down_menu_display_products_noscript_begin' => $pull_down_menu_display_products_in_category_noscript,
                            'pull_down_menu_display_products_noscript_end' => '</form>',
                            'label_for_max_display_products' => 'mdpc',
                            'link_switch_view' => $link_switch_products_in_c_view));
    }                

    if(!$smarty->isCached(SELECTED_TPL . '/index.tpl', $cache_id)){ 
        
      $categories_query = $DB->prepare
      (
       "SELECT   c.categories_or_pages_id,
                 cpd.categories_or_pages_name,
                 c.categories_image,
                 c.parent_id
        FROM     " . TABLE_CATEGORIES_OR_PAGES . " c,
                 " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd
        WHERE    c.categories_or_pages_status = '1'
        AND      c.parent_id = :current_category_id
        AND      c.categories_or_pages_id = cpd.categories_or_pages_id
        AND      cpd.language_id = :languages_id
        ORDER BY sort_order,
                 cpd.categories_or_pages_name"
      );
      
      $DB->perform($categories_query, array(':current_category_id' => (int)$current_category_id,
                                            ':languages_id' => (int)$_SESSION['languages_id']));                 

      $number_of_categories = $categories_query->rowCount();

      $rows = 0;
      $categories_array = array();
      while ($categories = $categories_query->fetch()) { 
            
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
        if(($category['product_list_b'] == 1 && $_SESSION['pcv'] != 'list') || $_SESSION['pcv'] == 'grid') {
      
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
        foreach($define_list as $key => $value) {
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
      
        $subcategories_param_array = array();

        $subcategories_array = array();
        xos_get_subcategories($subcategories_array, $current_category_id);
        $subcategories_str = " AND (p2c.categories_or_pages_id = :current_category_id";
        $subcategories_param_array[':current_category_id'] = (int)$current_category_id ;
        for ($i=0, $n=sizeof($subcategories_array); $i<$n; $i++ ) {        
          $subcategories_str .= " OR p2c.categories_or_pages_id = :subcategory_" . $i . "";
          $subcategories_param_array[':subcategory_' . $i] = (int)$subcategories_array[$i];          
        }
        $subcategories_str .= ")"; 

        $listing_param_array = $subcategories_param_array; 
            
// show the products in a given categorie
        if (isset($_GET['filter']) && xos_not_null($_GET['filter'])) {
// We are asked to show only specific catgeory
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {      
            $listing_sql = "SELECT    " . $select_column_list . " 
                                      p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                      (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100))) AS final_price,
                                      tr.tax_rate_final
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_ZONES_TO_GEO_ZONES . " gz
                            ON        (
                                                gz.zone_country_id IS NULL
                                      OR        gz.zone_country_id = '0'
                                      OR        gz.zone_country_id = :customer_country_id)
                            AND       (
                                                gz.zone_id IS NULL
                                      OR        gz.zone_id = '0'
                                      OR        gz.zone_id = :customer_zone_id)
                            LEFT JOIN " . TABLE_TAX_RATES_FINAL . " tr
                            ON        p.products_tax_class_id = tr.tax_class_id
                            AND       gz.geo_zone_id = tr.tax_zone_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       mi.manufacturers_id = :filter
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id 
                                      " . $subcategories_str . "
                            GROUP BY  p.products_id, s.status, s.specials_new_products_price, tr.tax_rate_final"; 
       
            $listing_param_array[':customer_country_id'] = (int)$customer_country_id;
            $listing_param_array[':customer_zone_id'] = (int)$customer_zone_id;
          } else {
            $listing_sql = "SELECT    " . $select_column_list . " 
                                      p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL)AS specials_new_products_price,
                                      IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) AS final_price
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       mi.manufacturers_id = :filter
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id 
                                      " . $subcategories_str . "";
                                      
          }
          $listing_param_array[':filter'] = (int)$_GET['filter'];          
        } else {
// We show them all
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {        
            $listing_sql = "SELECT    " . $select_column_list . " 
                                      p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                      (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100))) AS final_price,
                                      tr.tax_rate_final
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_ZONES_TO_GEO_ZONES . " gz
                            ON        (
                                                gz.zone_country_id IS NULL
                                      OR        gz.zone_country_id = '0'
                                      OR        gz.zone_country_id = :customer_country_id)
                            AND       (
                                                gz.zone_id IS NULL
                                      OR        gz.zone_id = '0'
                                      OR        gz.zone_id = :customer_zone_id)
                            LEFT JOIN " . TABLE_TAX_RATES_FINAL . " tr
                            ON        p.products_tax_class_id = tr.tax_class_id
                            AND       gz.geo_zone_id = tr.tax_zone_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id 
                                      " . $subcategories_str . "
                            GROUP BY  p.products_id, s.status, s.specials_new_products_price, tr.tax_rate_final"; 
                                   
            $listing_param_array[':customer_country_id'] = (int)$customer_country_id;
            $listing_param_array[':customer_zone_id'] = (int)$customer_zone_id;
          } else {
            $listing_sql = "SELECT    " . $select_column_list . " 
                                      p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                      IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) AS final_price
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id 
                                      " . $subcategories_str . "";
                                      
          }
        }
        $listing_param_array[':languages_id'] = (int)$_SESSION['languages_id'];
        $listing_param_array[':customer_group_id'] = (int)$customer_group_id;        

        if ( (empty($_GET['sort'])) || (!preg_match('/^[0-9][ad]$/', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
          for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
            if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
              $listing_sql .= " ORDER BY p.products_sort_order, pd.products_name"; 
              break;
            }
          }
        } else {
          $sort_col = substr($_GET['sort'], 0 , 1);
          $sort_order = substr($_GET['sort'], 1);
          switch ($column_list[$sort_col]) {
            case 'PRODUCT_LIST_MODEL':
              $listing_sql .= " ORDER BY p.products_model " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_NAME':
              $listing_sql .= " ORDER BY pd.products_name " . ($sort_order == 'd' ? 'DESC' : '');
              break;
            case 'PRODUCT_LIST_INFO':
//--------[Alternative] wenn hier aendern auch product_listing.php, specials.php, advanced_search_and_results.php, und search_result.php aendern----------- 
//              $listing_sql .= " ORDER BY pd.products_info ". ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
//------------------------------------------------------------------------------------------------------------------
              $listing_sql .= " ORDER BY pd.products_name";
              break; 
            case 'PRODUCT_LIST_PACKING_UNIT':       
              $listing_sql .= " ORDER BY pd.products_p_unit " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
              break;                   
            case 'PRODUCT_LIST_MANUFACTURER':
              $listing_sql .= " ORDER BY mi.manufacturers_name " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_QUANTITY':
              $listing_sql .= " ORDER BY p.products_quantity " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_IMAGE':
              $listing_sql .= " ORDER BY pd.products_name";
              break;
            case 'PRODUCT_LIST_WEIGHT':
              $listing_sql .= " ORDER BY p.products_weight " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_PRICE':
              $listing_sql .= " ORDER BY final_price " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
              break;
          }
        }

// optional Product List Filter
        if (PRODUCT_LIST_FILTER > 0) {
          $filterlist_query = $DB->prepare
          (
           "SELECT DISTINCT mi.manufacturers_id   AS id,
                            mi.manufacturers_name AS name
            FROM            " . TABLE_PRODUCTS . " p,
                            " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                            " . TABLE_MANUFACTURERS_INFO . " mi
            WHERE           p.products_status = '1'
            AND             p.manufacturers_id = mi.manufacturers_id
            AND             mi.languages_id = :languages_id
            AND             p.products_id = p2c.products_id
                            " . $subcategories_str . "         
            ORDER BY        mi.manufacturers_name"
          );

          $filterlist_param_array[':languages_id'] = (int)$_SESSION['languages_id'];
                                                  
          $DB->perform($filterlist_query, array_merge($filterlist_param_array, $subcategories_param_array));
          
          if ($filterlist_query->rowCount() > 1) {
        
            $hidden_get_variables = '';
            if (!$session_started && xos_not_null($_GET['cur'])) {
              $hidden_get_variables .= xos_draw_hidden_field('cur', $_GET['cur']);
            }  

            if (!$session_started && xos_not_null($_GET['lnc'])) {
              $hidden_get_variables .= xos_draw_hidden_field('lnc', $_GET['lnc']);
            }          

            if (!$session_started && xos_not_null($_GET['tpl'])) {
              $hidden_get_variables .= xos_draw_hidden_field('tpl', $_GET['tpl']);
            } 
        
            $pull_down_menu = xos_draw_form('filter', xos_href_link(FILENAME_DEFAULT, '', $request_type, false, true, false, false, false), 'get');
            $pull_down_menu_noscript = xos_draw_form('filter', xos_href_link(FILENAME_DEFAULT, '', $request_type, false, false, false, false, false), 'get') . $hidden_get_variables . xos_hide_session_id();            
            $pull_down_menu_noscript .= xos_draw_hidden_field('c', $cPath) . xos_draw_hidden_field('sort', $_GET['sort']);
            $options = array();
            $options_noscript = array();
            $options = array(array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('filter', 'page')) . 'filter=', 'NONSSL', true, true, false, false, false), 'text' => TEXT_ALL_MANUFACTURERS));
            $options_noscript = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
            while ($filterlist = $filterlist_query->fetch()) {
              $options[] = array('id' =>  xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('filter', 'page')) . 'filter=' . $filterlist['id'], 'NONSSL', true, true, false, false, false), 'text' => $filterlist['name']);
              $options_noscript[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
            }
            $pull_down_menu .= xos_draw_pull_down_menu('filter', $options, xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('filter', 'page')) . 'filter=' . (isset($_GET['filter']) ? $_GET['filter'] : ''), 'NONSSL', true, true, false, false, false), 'class="form-control" id="filter" onchange="location = form.filter.options[form.filter.selectedIndex].value;"') . '</form>';
            $pull_down_menu_noscript .= xos_draw_pull_down_menu('filter', $options_noscript, (isset($_GET['filter']) ? $_GET['filter'] : ''), 'class="form-control" id="filter"'); 
          }
        }

        $smarty->assign(array('pull_down_menu' => $pull_down_menu,
                              'pull_down_menu_noscript_begin' => $pull_down_menu_noscript,
                              'pull_down_menu_noscript_end' => '</form>',
                              'label_for_pull_down_menu' => 'filter'));
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

  } elseif ($category_depth == 'products' || !empty($_GET['m'])) { 
                             
    if (isset($_GET['m'])) { 

      is_numeric($_GET['mdpm']) && $_GET['mdpm'] >= 1 ? $_SESSION['mdpm'] = $_GET['mdpm'] : '';

      if ($_GET['pmv'] == 'list') { 
        $_SESSION['pmv'] = 'list'; 
      } elseif ($_GET['pmv'] == 'grid') { 
        $_SESSION['pmv'] = 'grid';
      }
    
      if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
        $smarty->caching = 1;
        $cache_id = 'L3|cc_index_manufacturers|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['m'] . '-' . $_GET['sort'] . '-' . $_GET['page'] . '-' . $_GET['filter'] . '-' . $_SESSION['mdpm'] . '-' . $_SESSION['pmv'];
      }    
        
      $manufacturer_query = $DB->prepare
      (
      "SELECT m.manufacturers_image,
               mi.manufacturers_name
        FROM   " . TABLE_MANUFACTURERS . " m,
               " . TABLE_MANUFACTURERS_INFO . " mi
        WHERE  m.manufacturers_id = mi.manufacturers_id
        AND    m.manufacturers_id = :m
        AND    mi.languages_id = :languages_id"
      );
      
      $DB->perform($manufacturer_query, array(':m' => (int)$_GET['m'],
                                              ':languages_id' => (int)$_SESSION['languages_id']));      
      
      $manufacturer = $manufacturer_query->fetch();      

      if ($session_started) {
        $pull_down_menu_display_products_of_manufacturer = xos_draw_form('display_products_of_manufacturer', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false, true, false, false, false), 'get');
        $pull_down_menu_display_products_of_manufacturer_noscript = xos_draw_form('display_products_of_manufacturer', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false, false, false, false, false), 'get') . xos_hide_session_id();        
        $pull_down_menu_display_products_of_manufacturer_noscript .= xos_draw_hidden_field('m', $_GET['m']) . xos_draw_hidden_field('sort', $_GET['sort']) . xos_draw_hidden_field('filter', $_GET['filter']);
        $max_display_products_of_manufacturer_array = array(); 
        $max_display_products_of_manufacturer_array_noscript = array();       
        $set = false;
        for ($i = 10; $i <=50 ; $i=$i+10) {  
          if (MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER <= $i && $set == false) {
            $max_display_products_of_manufacturer_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpm', 'page')) . 'mdpm=' . MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER . TEXT_MAX_PRODUCTS);
            $max_display_products_of_manufacturer_array_noscript[] = array('id' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER, 'text' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER . TEXT_MAX_PRODUCTS);
            $set = true;      
          }    
          if (MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER != $i) {
            $max_display_products_of_manufacturer_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpm', 'page')) . 'mdpm=' . $i, 'NONSSL', true, true, false, false, false), 'text' => $i . TEXT_MAX_PRODUCTS);
            $max_display_products_of_manufacturer_array_noscript[] = array('id' => $i, 'text' => $i . TEXT_MAX_PRODUCTS);
          }
        }          
        if ($set == false) {
          $max_display_products_of_manufacturer_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpm', 'page')) . 'mdpm=' . MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER . TEXT_MAX_PRODUCTS);
          $max_display_products_of_manufacturer_array_noscript[] = array('id' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER, 'text' => MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER . TEXT_MAX_PRODUCTS);
        }
        $pull_down_menu_display_products_of_manufacturer .= xos_draw_pull_down_menu('mdpm', $max_display_products_of_manufacturer_array, xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpm', 'page')) . 'mdpm=' . (isset($_SESSION['mdpm']) ? $_SESSION['mdpm'] : MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER), 'NONSSL', true, true, false, false, false), 'class="form-control" id="mdpm" onchange="location = form.mdpm.options[form.mdpm.selectedIndex].value;"') . '</form>';
        $pull_down_menu_display_products_of_manufacturer_noscript .= xos_draw_pull_down_menu('mdpm', $max_display_products_of_manufacturer_array_noscript, (isset($_SESSION['mdpm']) ? $_SESSION['mdpm'] : MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER), 'class="form-control" id="mdpm"');    

        $link_switch_products_of_m_view = xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('pmv', 'sort', 'page')) . 'pmv=' . (((isset($_GET['m']) && $_SESSION['pmv'] != 'list' && PRODUCT_LISTS_FOR_MANUFACTURERS == 'B') || (isset($_GET['m']) && $_SESSION['pmv'] == 'grid')) ? 'list' : 'grid'), 'NONSSL', true, true, false, false, false);
      }

      $max_display = isset($_SESSION['mdpm']) ? $_SESSION['mdpm'] : MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER;
      
      $smarty->assign(array('manufacturer' => true,
                            'heading_title' => $manufacturer['manufacturers_name'],
                            'heading_image' => xos_image(DIR_WS_IMAGES .'manufacturers/' . rawurlencode($manufacturer['manufacturers_image']), $manufacturer['manufacturers_name']), 
                            'pull_down_menu_display_products' => $pull_down_menu_display_products_of_manufacturer,
                            'pull_down_menu_display_products_noscript_begin' => $pull_down_menu_display_products_of_manufacturer_noscript,
                            'pull_down_menu_display_products_noscript_end' => '</form>',
                            'label_for_max_display_products' => 'mdpm',
                            'link_switch_view' => $link_switch_products_of_m_view)); 
            
    } elseif ($current_category_id) {

      is_numeric($_GET['mdpc']) && $_GET['mdpc'] >= 1 ? $_SESSION['mdpc'] = $_GET['mdpc'] : '';

      if ($_GET['pcv'] == 'list') { 
        $_SESSION['pcv'] = 'list'; 
      } elseif ($_GET['pcv'] == 'grid') { 
        $_SESSION['pcv'] = 'grid';
      }
        
      if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
        $smarty->caching = 1;
        $cache_id = 'L3|cc_index_products|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['c'] . '-' . $_GET['sort'] . '-' . $_GET['page'] . '-' . $_GET['filter'] . '-' . $current_category_id . '-' . $_SESSION['mdpc'] . '-' . $_SESSION['pcv'];
      }    
    
      $category_query = $DB->prepare
      (
       "SELECT cpd.categories_or_pages_name,
               cpd.categories_or_pages_heading_title,
               cpd.categories_or_pages_content,
               cpd.categories_or_pages_php_source,
               c.categories_image,
               c.product_list_b
        FROM   " . TABLE_CATEGORIES_OR_PAGES . " c,
               " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd
        WHERE  c.categories_or_pages_id = :current_category_id
        AND    cpd.categories_or_pages_id = :current_category_id
        AND    cpd.language_id = :languages_id"
      );
      
      $DB->perform($category_query, array(':current_category_id' => (int)$current_category_id,
                                          ':languages_id' => (int)$_SESSION['languages_id']));         
         
      $category = $category_query->fetch();
      
      eval(" ?>" . $category['categories_or_pages_php_source'] . "<?php ");

      if ($session_started) {
        $pull_down_menu_display_products_in_category = xos_draw_form('display_products_in_category', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false, true, false, false, false), 'get');
        $pull_down_menu_display_products_in_category_noscript = xos_draw_form('display_products_in_category', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false, false, false, false, false), 'get') . xos_hide_session_id();        
        $pull_down_menu_display_products_in_category_noscript .= xos_draw_hidden_field('c', $cPath) . xos_draw_hidden_field('sort', $_GET['sort']) . xos_draw_hidden_field('filter', $_GET['filter']);
        $max_display_products_in_category_array = array();
        $max_display_products_in_category_array_noscript = array();
        $set = false;
        for ($i = 10; $i <=50 ; $i=$i+10) {  
          if (MAX_DISPLAY_PRODUCTS_IN_CATEGORY <= $i && $set == false) {
            $max_display_products_in_category_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpc', 'page')) . 'mdpc=' . MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
            $max_display_products_in_category_array_noscript[] = array('id' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);            
            $set = true;      
          }    
          if (MAX_DISPLAY_PRODUCTS_IN_CATEGORY != $i) {
            $max_display_products_in_category_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpc', 'page')) . 'mdpc=' . $i, 'NONSSL', true, true, false, false, false), 'text' => $i . TEXT_MAX_PRODUCTS);
            $max_display_products_in_category_array_noscript[] = array('id' => $i, 'text' => $i . TEXT_MAX_PRODUCTS);
          }
        }  
        if ($set == false) {
          $max_display_products_in_category_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpc', 'page')) . 'mdpc=' . MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
          $max_display_products_in_category_array_noscript[] = array('id' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY, 'text' => MAX_DISPLAY_PRODUCTS_IN_CATEGORY . TEXT_MAX_PRODUCTS);
        }      
        $pull_down_menu_display_products_in_category .= xos_draw_pull_down_menu('mdpc', $max_display_products_in_category_array, xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('mdpc', 'page')) . 'mdpc=' . (isset($_SESSION['mdpc']) ? $_SESSION['mdpc'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY), 'NONSSL', true, true, false, false, false), 'class="form-control" id="mdpc" onchange="location = form.mdpc.options[form.mdpc.selectedIndex].value;"') . '</form>';
        $pull_down_menu_display_products_in_category_noscript .= xos_draw_pull_down_menu('mdpc', $max_display_products_in_category_array_noscript, (isset($_SESSION['mdpc']) ? $_SESSION['mdpc'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY), 'class="form-control" id="mdpc"');    

        $link_switch_products_in_c_view = xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('pcv', 'sort', 'page')) . 'pcv=' . ((($category['product_list_b'] == 1 && $_SESSION['pcv'] != 'list') || (!isset($_GET['m']) && $_SESSION['pcv'] == 'grid')) ? 'list' : 'grid'), 'NONSSL', true, true, false, false, false);
      }      

      $max_display = isset($_SESSION['mdpc']) ? $_SESSION['mdpc'] : MAX_DISPLAY_PRODUCTS_IN_CATEGORY;
            
      $smarty->assign(array('heading_title' => $category['categories_or_pages_heading_title'],
                            'category_name' => $category['categories_or_pages_name'],
                            'category_description' => $category['categories_or_pages_content'],
                            'heading_image' => $page_info == 'false' ? xos_image(DIR_WS_IMAGES .'categories/small/' . rawurlencode($category['categories_image']), $category['categories_or_pages_name']) : '',
                            'pull_down_menu_display_products' => $pull_down_menu_display_products_in_category,
                            'pull_down_menu_display_products_noscript_begin' => $pull_down_menu_display_products_in_category_noscript,
                            'pull_down_menu_display_products_noscript_end' => '</form>',
                            'label_for_max_display_products' => 'mdpc',
                            'link_switch_view' => $link_switch_products_in_c_view));                                      
    }
    
    
    if(!$smarty->isCached(SELECTED_TPL . '/index.tpl', $cache_id)){ 
    
      if((($category['product_list_b'] == 1 && $_SESSION['pcv'] != 'list') || (!isset($_GET['m']) && $_SESSION['pcv'] == 'grid')) || ((isset($_GET['m']) && $_SESSION['pmv'] != 'list' && PRODUCT_LISTS_FOR_MANUFACTURERS == 'B') || (isset($_GET['m']) && $_SESSION['pmv'] == 'grid'))) {
      
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
      foreach($define_list as $key => $value) {
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
      
      $listing_param_array = array();
// show the products of a specified manufacturer
      if (isset($_GET['m'])) {
        if (isset($_GET['filter']) && xos_not_null($_GET['filter'])) {
// We are asked to show only a specific category
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {    
            $listing_sql = "SELECT    " . $select_column_list . " 
                                      p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                      (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100))) AS final_price,
                                      tr.tax_rate_final
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_ZONES_TO_GEO_ZONES . " gz
                            ON        (
                                                gz.zone_country_id IS NULL
                                      OR        gz.zone_country_id = '0'
                                      OR        gz.zone_country_id = :customer_country_id)
                            AND       (
                                                gz.zone_id IS NULL
                                      OR        gz.zone_id = '0'
                                      OR        gz.zone_id = :customer_zone_id)
                            LEFT JOIN " . TABLE_TAX_RATES_FINAL . " tr
                            ON        p.products_tax_class_id = tr.tax_class_id
                            AND       gz.geo_zone_id = tr.tax_zone_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       mi.manufacturers_id = :m
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id
                            AND       p2c.categories_or_pages_id = :filter
                            GROUP BY  p.products_id, s.status, s.specials_new_products_price, tr.tax_rate_final";
                            
            $listing_param_array[':customer_country_id'] = (int)$customer_country_id;
            $listing_param_array[':customer_zone_id'] = (int)$customer_zone_id;
          } else {
            $listing_sql = "SELECT    " . $select_column_list . " p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                      IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) AS final_price
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       mi.manufacturers_id = :m
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id
                            AND       p2c.categories_or_pages_id = :filter";
                            
          }
          $listing_param_array[':filter'] = (int)$_GET['filter'];         
        } else {
// We show them all
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {            
            $listing_sql = "SELECT DISTINCT " . $select_column_list . " 
                                            p.products_id,
                                            p.products_delivery_time_id,
                                            p.manufacturers_id,
                                            p.products_price,
                                            p.products_tax_class_id,
                                            IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                            (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100))) AS final_price,
                                            tr.tax_rate_final
                            FROM            " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                            " . TABLE_PRODUCTS . " p
                            LEFT JOIN       " . TABLE_MANUFACTURERS_INFO . " mi
                            ON              (
                                                            p.manufacturers_id = mi.manufacturers_id
                                            AND             mi.languages_id = :languages_id
                                            )
                            LEFT JOIN       " . TABLE_PRODUCTS_PRICES . " ppz
                            ON              p.products_id = ppz.products_id
                            AND             ppz.customers_group_id = '0'
                            LEFT JOIN       " . TABLE_PRODUCTS_PRICES . " pp
                            ON              p.products_id = pp.products_id
                            AND             pp.customers_group_id = :customer_group_id
                            LEFT JOIN       " . TABLE_SPECIALS . " s
                            ON              p.products_id = s.products_id
                            AND             s.customers_group_id = :customer_group_id
                            LEFT JOIN       " . TABLE_ZONES_TO_GEO_ZONES . " gz
                            ON              (
                                                            gz.zone_country_id IS NULL
                                            OR              gz.zone_country_id = '0'
                                            OR              gz.zone_country_id = :customer_country_id)
                            AND             (
                                                            gz.zone_id IS NULL
                                            OR              gz.zone_id = '0'
                                            OR              gz.zone_id = :customer_zone_id)
                            LEFT JOIN       " . TABLE_TAX_RATES_FINAL . " tr
                            ON              p.products_tax_class_id = tr.tax_class_id
                            AND             gz.geo_zone_id = tr.tax_zone_id
                            LEFT JOIN       " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            ON              p.products_id = p2c.products_id
                            LEFT JOIN       " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON              p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE           c.categories_or_pages_status = '1'
                            AND             p.products_status = '1'
                            AND             pd.products_id = p.products_id
                            AND             pd.language_id = :languages_id
                            AND             mi.manufacturers_id = :m
                            GROUP BY        p.products_id, s.status, s.specials_new_products_price, tr.tax_rate_final";
                            
            $listing_param_array[':customer_country_id'] = (int)$customer_country_id;
            $listing_param_array[':customer_zone_id'] = (int)$customer_zone_id;
          } else {
            $listing_sql = "SELECT DISTINCT " . $select_column_list . " 
                                            p.products_id,
                                            p.products_delivery_time_id,
                                            p.manufacturers_id,
                                            p.products_price,
                                            p.products_tax_class_id,
                                            IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                            IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) AS final_price
                            FROM            " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                            " . TABLE_PRODUCTS . " p
                            LEFT JOIN       " . TABLE_MANUFACTURERS_INFO . " mi
                            ON              (
                                                            p.manufacturers_id = mi.manufacturers_id
                                            AND             mi.languages_id = :languages_id
                                            )
                            LEFT JOIN       " . TABLE_PRODUCTS_PRICES . " ppz
                            ON              p.products_id = ppz.products_id
                            AND             ppz.customers_group_id = '0'
                            LEFT JOIN       " . TABLE_PRODUCTS_PRICES . " pp
                            ON              p.products_id = pp.products_id
                            AND             pp.customers_group_id = :customer_group_id
                            LEFT JOIN       " . TABLE_SPECIALS . " s
                            ON              p.products_id = s.products_id
                            AND             s.customers_group_id = :customer_group_id
                            LEFT JOIN       " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            ON              p.products_id = p2c.products_id
                            LEFT JOIN       " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON              p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE           c.categories_or_pages_status = '1'
                            AND             p.products_status = '1'
                            AND             pd.products_id = p.products_id
                            AND             pd.language_id = :languages_id
                            AND             mi.manufacturers_id = :m";
          }
        }
        $listing_param_array[':m'] = (int)$_GET['m'];
      } else {
// show the products in a given categorie
        if (isset($_GET['filter']) && xos_not_null($_GET['filter'])) {
// We are asked to show only specific catgeory
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {      
            $listing_sql = "SELECT    " . $select_column_list . " 
                                      p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                      (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100))) AS final_price,
                                      tr.tax_rate_final
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_ZONES_TO_GEO_ZONES . " gz
                            ON        (
                                                gz.zone_country_id IS NULL
                                      OR        gz.zone_country_id = '0'
                                      OR        gz.zone_country_id = :customer_country_id)
                            AND       (
                                                gz.zone_id IS NULL
                                      OR        gz.zone_id = '0'
                                      OR        gz.zone_id = :customer_zone_id)
                            LEFT JOIN " . TABLE_TAX_RATES_FINAL . " tr
                            ON        p.products_tax_class_id = tr.tax_class_id
                            AND       gz.geo_zone_id = tr.tax_zone_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       mi.manufacturers_id = :filter
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id
                            AND       p2c.categories_or_pages_id = :current_category_id
                            GROUP BY  p.products_id, s.status, s.specials_new_products_price, tr.tax_rate_final"; 
                                   
            $listing_param_array[':customer_country_id'] = (int)$customer_country_id;
            $listing_param_array[':customer_zone_id'] = (int)$customer_zone_id;
          } else {
            $listing_sql = "SELECT    " . $select_column_list . " 
                                      p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                      IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) AS final_price
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       mi.manufacturers_id = :filter
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id
                            AND       p2c.categories_or_pages_id = :current_category_id";
                            
          }
          $listing_param_array[':filter'] = (int)$_GET['filter'];
        } else {
// We show them all
          if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {        
            $listing_sql = "SELECT    " . $select_column_list . " 
                                      p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                      (IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100))) AS final_price,
                                      tr.tax_rate_final
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_ZONES_TO_GEO_ZONES . " gz
                            ON        (
                                                gz.zone_country_id IS NULL
                                      OR        gz.zone_country_id = '0'
                                      OR        gz.zone_country_id = :customer_country_id)
                            AND       (
                                                gz.zone_id IS NULL
                                      OR        gz.zone_id = '0'
                                      OR        gz.zone_id = :customer_zone_id)
                            LEFT JOIN " . TABLE_TAX_RATES_FINAL . " tr
                            ON        p.products_tax_class_id = tr.tax_class_id
                            AND       gz.geo_zone_id = tr.tax_zone_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id
                            AND       p2c.categories_or_pages_id = :current_category_id
                            GROUP BY  p.products_id, s.status, s.specials_new_products_price, tr.tax_rate_final"; 
                                   
            $listing_param_array[':customer_country_id'] = (int)$customer_country_id;
            $listing_param_array[':customer_zone_id'] = (int)$customer_zone_id;
          } else {
            $listing_sql = "SELECT    " . $select_column_list . " 
                                      p.products_id,
                                      p.products_delivery_time_id,
                                      p.manufacturers_id,
                                      p.products_price,
                                      p.products_tax_class_id,
                                      IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                      IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) AS final_price
                            FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                      " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                            ON        (
                                                p.manufacturers_id = mi.manufacturers_id
                                      AND       mi.languages_id = :languages_id
                                      )
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
                            ON        p.products_id = ppz.products_id
                            AND       ppz.customers_group_id = '0'
                            LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
                            ON        p.products_id = pp.products_id
                            AND       pp.customers_group_id = :customer_group_id
                            LEFT JOIN " . TABLE_SPECIALS . " s
                            ON        p.products_id = s.products_id
                            AND       s.customers_group_id = :customer_group_id,
                                      " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                            LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                            ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                            WHERE     c.categories_or_pages_status = '1'
                            AND       p.products_status = '1'
                            AND       p.products_id = p2c.products_id
                            AND       pd.products_id = p2c.products_id
                            AND       pd.language_id = :languages_id
                            AND       p2c.categories_or_pages_id = :current_category_id";
                            
          }
        }
        $listing_param_array[':current_category_id'] = (int)$current_category_id;
      }
      $listing_param_array[':languages_id'] = (int)$_SESSION['languages_id'];
      $listing_param_array[':customer_group_id'] = (int)$customer_group_id;        

      if ( (empty($_GET['sort'])) || (!preg_match('/^[0-9][ad]$/', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
        for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
          if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
            if (isset($_GET['m'])) {
              $_GET['sort'] = $i . 'a';
              $listing_sql .= " ORDER BY pd.products_name";
            } else {
              $listing_sql .= " ORDER BY p.products_sort_order";
            }  
            break;
          }
        }
      } else {
        $sort_col = substr($_GET['sort'], 0 , 1);
        $sort_order = substr($_GET['sort'], 1);
        switch ($column_list[$sort_col]) {
          case 'PRODUCT_LIST_MODEL':
            $listing_sql .= " ORDER BY p.products_model " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
            break;
          case 'PRODUCT_LIST_NAME':
            $listing_sql .= " ORDER BY pd.products_name " . ($sort_order == 'd' ? 'DESC' : '');
            break;
          case 'PRODUCT_LIST_INFO':
//--------[Alternative] wenn hier aendern auch product_listing.php, specials.php, advanced_search_and_results.php, und search_result.php aendern----------- 
//            $listing_sql .= " ORDER BY pd.products_info ". ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
//------------------------------------------------------------------------------------------------------------------
            $listing_sql .= " ORDER BY pd.products_name";
            break; 
          case 'PRODUCT_LIST_PACKING_UNIT':       
            $listing_sql .= " ORDER BY pd.products_p_unit " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
            break;                   
          case 'PRODUCT_LIST_MANUFACTURER':
            $listing_sql .= " ORDER BY mi.manufacturers_name " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $listing_sql .= " ORDER BY p.products_quantity " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
            break;
          case 'PRODUCT_LIST_IMAGE':
            $listing_sql .= " ORDER BY pd.products_name";
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $listing_sql .= " ORDER BY p.products_weight " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
            break;
          case 'PRODUCT_LIST_PRICE':
            $listing_sql .= " ORDER BY final_price " . ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";
            break;
        }
      }

// optional Product List Filter
      if (PRODUCT_LIST_FILTER > 0) {
      
        $filterlist_param_array = array();
      
        if (isset($_GET['m'])) {
          $filterlist_sql =  "SELECT DISTINCT c.categories_or_pages_id     AS id,
                                              cpd.categories_or_pages_name AS name
                              FROM            " . TABLE_PRODUCTS . " p,
                                              " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                                              " . TABLE_CATEGORIES_OR_PAGES . " c,
                                              " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd
                              WHERE           c.categories_or_pages_status = '1'
                              AND             p.products_status = '1'
                              AND             p.products_id = p2c.products_id
                              AND             p2c.categories_or_pages_id = c.categories_or_pages_id
                              AND             p2c.categories_or_pages_id = cpd.categories_or_pages_id
                              AND             cpd.language_id = :languages_id
                              AND             p.manufacturers_id = :m
                              ORDER BY        cpd.categories_or_pages_name";
                              
          $filterlist_param_array[':m'] = (int)$_GET['m'];                                                            
        } else {
          $filterlist_sql =  "SELECT DISTINCT mi.manufacturers_id   AS id,
                                              mi.manufacturers_name AS name
                              FROM            " . TABLE_PRODUCTS . " p,
                                              " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                                              " . TABLE_MANUFACTURERS_INFO . " mi
                              WHERE           p.products_status = '1'
                              AND             p.manufacturers_id = mi.manufacturers_id
                              AND             mi.languages_id = :languages_id
                              AND             p.products_id = p2c.products_id
                              AND             p2c.categories_or_pages_id = :current_category_id
                              ORDER BY        mi.manufacturers_name";
                               
          $filterlist_param_array[':current_category_id'] = (int)$current_category_id;                                                            
        }
        
        $filterlist_param_array[':languages_id'] = (int)$_SESSION['languages_id'];
        
        $filterlist_query = $DB->prepare($filterlist_sql);
        
        $DB->perform($filterlist_query, $filterlist_param_array);
        
        if ($filterlist_query->rowCount() > 1) {
        
          $hidden_get_variables = '';
          if (!$session_started && xos_not_null($_GET['cur'])) {
            $hidden_get_variables .= xos_draw_hidden_field('cur', $_GET['cur']);
          }  

          if (!$session_started && xos_not_null($_GET['lnc'])) {
            $hidden_get_variables .= xos_draw_hidden_field('lnc', $_GET['lnc']);
          }          

          if (!$session_started && xos_not_null($_GET['tpl'])) {
            $hidden_get_variables .= xos_draw_hidden_field('tpl', $_GET['tpl']);
          } 
        
          $pull_down_menu = xos_draw_form('filter', xos_href_link(FILENAME_DEFAULT, '', $request_type, false, true, false, false, false), 'get');
          $pull_down_menu_noscript = xos_draw_form('filter', xos_href_link(FILENAME_DEFAULT, '', $request_type, false, false, false, false, false), 'get') . $hidden_get_variables . xos_hide_session_id();            
          $pull_down_menu_noscript .= xos_draw_hidden_field('sort', $_GET['sort']); 
          $options = array();
          $options_noscript = array();
            
          if (isset($_GET['m'])) {
            $pull_down_menu_noscript .= xos_draw_hidden_field('m', $_GET['m']);
            $options = array(array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('filter', 'page')) . 'filter=', 'NONSSL', true, true, false, false, false), 'text' => TEXT_ALL_CATEGORIES));
            $options_noscript = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
          } else {
            $pull_down_menu_noscript .= xos_draw_hidden_field('c', $cPath);
            $options = array(array('id' => xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('filter', 'page')) . 'filter=', 'NONSSL', true, true, false, false, false), 'text' => TEXT_ALL_MANUFACTURERS));
            $options_noscript = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
          }
                     
          while ($filterlist = $filterlist_query->fetch()) {
            $options[] = array('id' =>  xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('filter', 'page')) . 'filter=' . $filterlist['id'], 'NONSSL', true, true, false, false, false), 'text' => $filterlist['name']);
            $options_noscript[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
          }
          $pull_down_menu .= xos_draw_pull_down_menu('filter', $options, xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('filter', 'page')) . 'filter=' . (isset($_GET['filter']) ? $_GET['filter'] : ''), 'NONSSL', true, true, false, false, false), 'class="form-control" id="filter" onchange="location = form.filter.options[form.filter.selectedIndex].value;"') . '</form>';
          $pull_down_menu_noscript .= xos_draw_pull_down_menu('filter', $options_noscript, (isset($_GET['filter']) ? $_GET['filter'] : ''), 'class="form-control" id="filter"'); 
        }        
      }

      $smarty->assign(array('pull_down_menu' => $pull_down_menu,
                            'pull_down_menu_noscript_begin' => $pull_down_menu_noscript,
                            'pull_down_menu_noscript_end' => '</form>',
                            'label_for_pull_down_menu' => 'filter',
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
      $cache_id = 'L3|cc_index_default|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_SESSION['customer_id'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $new_products_category_id . '-' . $current_category_id;
    }
    
    if(!$smarty->isCached(SELECTED_TPL . '/index.tpl', $cache_id)){  
   
      $content_query = $DB->prepare
      (
       "SELECT cd.name,
               cd.heading_title,
               cd.content,
               cd.php_source
        FROM   " . TABLE_CONTENTS . " c,
               " . TABLE_CONTENTS_DATA . " cd
        WHERE  c.type = 'index'
        AND    c.status = '1'
        AND    c.content_id = cd.content_id
        AND    cd.language_id = :languages_id"
      );
      
      $DB->perform($content_query, array(':languages_id' => (int)$_SESSION['languages_id']));      
      
      $content = $content_query->fetch();
      
      eval(" ?>" . $content['php_source'] . "<?php ");
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
                          
  $smarty->assign('central_contents', $output_index);  
  
  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;