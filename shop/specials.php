<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : specials.php
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
//              filename: specials.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_SPECIALS) == 'overwrite_all')) :
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_SPECIALS);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_SPECIALS, xos_get_all_get_params(array('lnc', 'cur', 'tpl', 'x', 'y'))));
    
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  is_numeric($_GET['mdsp']) && $_GET['mdsp'] >= 1 ? $_SESSION['mdsp'] = (int)$_GET['mdsp'] : '';
  
  if ($_GET['sv'] == 'list') { 
    $_SESSION['sv'] = 'list'; 
  } elseif ($_GET['sv'] == 'grid') { 
    $_SESSION['sv'] = 'grid';
  }
   
  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L3|cc_specials|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['sort'] . '-' . $_GET['page'] . '-' . $_GET['filter'] . '-' . $_SESSION['mdsp'] . '-' . $_SESSION['sv'];
  }  
 
  if(!$smarty->isCached(SELECTED_TPL . '/specials.tpl', $cache_id)){ 
                        
    if((PRODUCT_LISTS_FOR_SPECIALS == 'B' && $_SESSION['sv'] != 'list') || $_SESSION['sv'] == 'grid') {
     
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
    if (isset($_GET['filter']) && xos_not_null($_GET['filter'])) {
// We are asked to show only a specific category
      if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) { 
         
        $listing_sql = "SELECT    " . $select_column_list . " 
                                  p.products_id,
                                  p.products_delivery_time_id,
                                  p.manufacturers_id,
                                  p.products_price,
                                  p.products_tax_class_id, 
                                  IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,(
                                   IF(s.status, s.specials_new_products_price, 
                                     IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * 
                                   IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100))) AS final_price,                                  
                                  tr.tax_rate_final
                        FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                  " . TABLE_PRODUCTS . " p
                        LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                        ON        (
                                  p.manufacturers_id = mi.manufacturers_id
                                  AND  mi.languages_id = :languages_id
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
                                  OR gz.zone_country_id = '0'
                                  OR gz.zone_country_id = :customer_country_id
                                  )
                        AND       (
                                  gz.zone_id IS NULL
                                  OR gz.zone_id = '0'
                                  OR gz.zone_id = :customer_zone_id
                                  )
                        LEFT JOIN " . TABLE_TAX_RATES_FINAL . " tr
                        ON        p.products_tax_class_id = tr.tax_class_id
                        AND       gz.geo_zone_id = tr.tax_zone_id,
                                  " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                        LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
                        ON        p2c.categories_or_pages_id = c.categories_or_pages_id
                        WHERE     c.categories_or_pages_status = '1'
                        AND       p.products_status = '1'
                        AND       s.status = '1'
                        AND       p.products_id = p2c.products_id
                        AND       pd.products_id = p2c.products_id
                        AND       pd.language_id = :languages_id
                        AND       p2c.categories_or_pages_id = :filter
                        GROUP BY  p.products_id, s.specials_new_products_price, tr.tax_rate_final";
                        
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
                                  IF(s.status, s.specials_new_products_price, 
                                    IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) AS final_price
                        FROM      " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                  " . TABLE_PRODUCTS . " p
                        LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
                        ON        (
                                  p.manufacturers_id = mi.manufacturers_id
                                  AND mi.languages_id = :languages_id
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
                        AND       s.status = '1'
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
                                        IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,(
                                         IF(s.status, s.specials_new_products_price,                                     
                                           IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * 
                                         IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100))) AS final_price,
                                        tr.tax_rate_final
                        FROM            " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                        " . TABLE_PRODUCTS . " p
                        LEFT JOIN       " . TABLE_MANUFACTURERS_INFO . " mi
                        ON              (
                                        p.manufacturers_id = mi.manufacturers_id
                                        AND mi.languages_id = :languages_id
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
                                        OR gz.zone_country_id = '0'
                                        OR gz.zone_country_id = :customer_country_id
                                        )
                        AND             (
                                        gz.zone_id IS NULL
                                        OR gz.zone_id = '0'
                                        OR gz.zone_id = :customer_zone_id
                                        )
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
                        AND             s.status = '1'
                        GROUP BY        p.products_id, s.specials_new_products_price, tr.tax_rate_final";

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
                                        IF(s.status, s.specials_new_products_price, 
                                          IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) AS final_price
                        FROM            " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                        " . TABLE_PRODUCTS . " p
                        LEFT JOIN       " . TABLE_MANUFACTURERS_INFO . " mi
                        ON              (
                                        p.manufacturers_id = mi.manufacturers_id
                                        AND mi.languages_id = :languages_id
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
                        AND             s.status = '1'";

      }
    }
    $listing_param_array[':languages_id'] = (int)$_SESSION['languages_id'];
    $listing_param_array[':customer_group_id'] = (int)$customer_group_id;

    if ( (empty($_GET['sort'])) || (!preg_match('/^[0-9][ad]$/', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
      for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
        if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
          $_GET['sort'] = $i . 'a';
          $listing_sql .= " ORDER BY pd.products_name";  
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
//--------[Alternative] wenn hier aendern auch product_listing.php, index.php, advanced_search_and_results.php, und search_result.php aendern-----------  
//          $listing_sql .= " ORDER BY pd.products_info ". ($sort_order == 'd' ? 'DESC' : '') . ", pd.products_name";      
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

      $filterlist_sql = "SELECT DISTINCT c.categories_or_pages_id     AS id,
                                         cpd.categories_or_pages_name AS name
                         FROM            " . TABLE_PRODUCTS . " p,
                                         " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                                         " . TABLE_CATEGORIES_OR_PAGES . " c,
                                         " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd,
                                         " . TABLE_SPECIALS . " s
                         WHERE           c.categories_or_pages_status = '1'
                         AND             p.products_status = '1'
                         AND             p.products_id = p2c.products_id
                         AND             p2c.categories_or_pages_id = c.categories_or_pages_id
                         AND             p2c.categories_or_pages_id = cpd.categories_or_pages_id
                         AND             cpd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                         AND             s.products_id = p2c.products_id
                         AND             s.customers_group_id = '" . $customer_group_id . "'
                         AND             s.status = '1'
                         ORDER BY        name";

      $filterlist_query = $DB->prepare($filterlist_sql); 
      
      $DB->perform($filterlist_query, array(':languages_id' => (int)$_SESSION['languages_id'],
                                            ':customer_group_id' => $customer_group_id));
                                                          
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
        
        $pull_down_menu = xos_draw_form('filter', xos_href_link(FILENAME_SPECIALS, '', 'NONSSL', false, true, false, false, false), 'get');
        $pull_down_menu_noscript = xos_draw_form('filter', xos_href_link(FILENAME_SPECIALS, '', 'NONSSL', false, false, false, false, false), 'get') . $hidden_get_variables . xos_hide_session_id();            
        $pull_down_menu_noscript .=  xos_draw_hidden_field('sort', $_GET['sort']);
        $options = array();
        $options_noscript = array();
        $options = array(array('id' => xos_href_link(FILENAME_SPECIALS, xos_get_all_get_params(array('filter', 'page')) . 'filter=', 'NONSSL', true, true, false, false, false), 'text' => TEXT_ALL_CATEGORIES));
        $options_noscript = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
        while ($filterlist = $filterlist_query->fetch()) {
          $options[] = array('id' =>  xos_href_link(FILENAME_SPECIALS, xos_get_all_get_params(array('filter', 'page')) . 'filter=' . $filterlist['id'], 'NONSSL', true, true, false, false, false), 'text' => $filterlist['name']);
          $options_noscript[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
        }
        $pull_down_menu .= xos_draw_pull_down_menu('filter', $options, xos_href_link(FILENAME_SPECIALS, xos_get_all_get_params(array('filter', 'page')) . 'filter=' . (isset($_GET['filter']) ? $_GET['filter'] : ''), 'NONSSL', true, true, false, false, false), 'class="form-control" id="filter" onchange="location = form.filter.options[form.filter.selectedIndex].value;"') . '</form>';
        $pull_down_menu_noscript .= xos_draw_pull_down_menu('filter', $options_noscript, (isset($_GET['filter']) ? $_GET['filter'] : ''), 'class="form-control" id="filter"'); 
      }
    }
    
    if ($session_started) {      
      $pull_down_menu_display_special_products = xos_draw_form('display_special_products', xos_href_link(FILENAME_SPECIALS, '', 'NONSSL', false, true, false, false, false), 'get');
      $pull_down_menu_display_special_products_noscript = xos_draw_form('display_special_products', xos_href_link(FILENAME_SPECIALS, '', 'NONSSL', false, false, false, false, false), 'get') . xos_hide_session_id();
      $pull_down_menu_display_special_products_noscript .= xos_draw_hidden_field('sort', $_GET['sort']) . xos_draw_hidden_field('filter', $_GET['filter']);
      $max_display_special_products_array = array();
      $max_display_special_products_array_noscript = array();
      $set = false;
      for ($i = 10; $i <=50 ; $i=$i+10) {  
        if (MAX_DISPLAY_SPECIAL_PRODUCTS <= $i && $set == false) {
          $max_display_special_products_array[] = array('id' => xos_href_link(FILENAME_SPECIALS, xos_get_all_get_params(array('mdsp', 'page')) . 'mdsp=' . MAX_DISPLAY_SPECIAL_PRODUCTS, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_SPECIAL_PRODUCTS . TEXT_MAX_PRODUCTS);
          $max_display_special_products_array_noscript[] = array('id' => MAX_DISPLAY_SPECIAL_PRODUCTS, 'text' => MAX_DISPLAY_SPECIAL_PRODUCTS . TEXT_MAX_PRODUCTS);
          $set = true;      
        }    
        if (MAX_DISPLAY_SPECIAL_PRODUCTS != $i) {
          $max_display_special_products_array[] = array('id' => xos_href_link(FILENAME_SPECIALS, xos_get_all_get_params(array('mdsp', 'page')) . 'mdsp=' . $i, 'NONSSL', true, true, false, false, false), 'text' => $i . TEXT_MAX_PRODUCTS);
          $max_display_special_products_array_noscript[] = array('id' => $i, 'text' => $i . TEXT_MAX_PRODUCTS);
        }
      }  
      if ($set == false) {
        $max_display_special_products_array[] = array('id' => xos_href_link(FILENAME_SPECIALS, xos_get_all_get_params(array('mdsp', 'page')) . 'mdsp=' . MAX_DISPLAY_SPECIAL_PRODUCTS, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_SPECIAL_PRODUCTS . TEXT_MAX_PRODUCTS);
        $max_display_special_products_array_noscript[] = array('id' => MAX_DISPLAY_SPECIAL_PRODUCTS, 'text' => MAX_DISPLAY_SPECIAL_PRODUCTS . TEXT_MAX_PRODUCTS);
      }      
      $pull_down_menu_display_special_products .= xos_draw_pull_down_menu('mdsp', $max_display_special_products_array, xos_href_link(FILENAME_SPECIALS, xos_get_all_get_params(array('mdsp', 'page')) . 'mdsp=' . (isset($_SESSION['mdsp']) ? $_SESSION['mdsp'] : MAX_DISPLAY_SPECIAL_PRODUCTS), 'NONSSL', true, true, false, false, false), 'class="form-control" id="mdsp" onchange="location = form.mdsp.options[form.mdsp.selectedIndex].value;"') . '</form>';
      $pull_down_menu_display_special_products_noscript .= xos_draw_pull_down_menu('mdsp', $max_display_special_products_array_noscript, (isset($_SESSION['mdsp']) ? $_SESSION['mdsp'] : MAX_DISPLAY_SPECIAL_PRODUCTS), 'class="form-control" id="mdsp"');
      
      $link_switch_special_view = xos_href_link(FILENAME_SPECIALS, xos_get_all_get_params(array('sv', 'sort', 'page')) . 'sv=' . ($product_list_b ? 'list' : 'grid'), 'NONSSL', true, true, false, false, false);
    }

    $smarty->assign(array('pull_down_menu' => $pull_down_menu,
                          'pull_down_menu_noscript_begin' => $pull_down_menu_noscript,
                          'pull_down_menu_noscript_end' => '</form>',
                          'label_for_pull_down_menu' => 'filter',
                          'pull_down_menu_display_products' => $pull_down_menu_display_special_products,
                          'pull_down_menu_display_products_noscript_begin' => $pull_down_menu_display_special_products_noscript,
                          'pull_down_menu_display_products_noscript_end' => '</form>',
                          'label_for_max_display_products' => 'mdsp',
                          'link_switch_view' => $link_switch_special_view));   

    $max_display = isset($_SESSION['mdsp']) ? $_SESSION['mdsp'] : MAX_DISPLAY_SPECIAL_PRODUCTS;

    $smarty->caching = 0;
    
    include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);

    if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
      $smarty->caching = 1;
    }

    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'specials');
  }

  $output_specials = $smarty->fetch(SELECTED_TPL . '/specials.tpl', $cache_id); 
  
  $smarty->assign('central_contents', $output_specials);  

  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;