<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : search_result.php
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
//              filename: advanced_search_result.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_SEARCH_RESULT) == 'overwrite_all')) :
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_SEARCH_RESULT); 

  $_GET['keywords'] = xos_sanitize_string($_GET['keywords']);
  
  $keywords = '^^^^^^';

  if (isset($_GET['keywords'])) {
    $keywords = ((strlen(stripcslashes($_GET['keywords'])) > 2) ? $_GET['keywords'] : '^^^^^^');
  }

  if (!xos_parse_search_string($keywords, $search_keywords)) {
    $search_keywords = '^^^^^^';
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_SEARCH_RESULT, xos_get_all_get_params()));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  is_numeric($_GET['max_display_search_results']) && $_GET['max_display_search_results'] >= 1 ? $_SESSION['max_display_search_results'] = (int)$_GET['max_display_search_results'] : '';

  if ($_GET['search_results_view'] == 'list') { 
    $_SESSION['search_results_view'] = 'list'; 
  } elseif ($_GET['search_results_view'] == 'grid') { 
    $_SESSION['search_results_view'] = 'grid';
  }
                       
  if((PRODUCT_LISTS_FOR_SEARCH_RESULTS == 'B' && $_SESSION['search_results_view'] != 'list') || $_SESSION['search_results_view'] == 'grid') {  
  
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

  $select_str = "select distinct " . $select_column_list . " p.manufacturers_id, p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) as final_price ";

  $from_str = "from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "') left join " . TABLE_PRODUCTS_PRICES . " ppz on p.products_id = ppz.products_id and ppz.customers_group_id = '0' left join " . TABLE_PRODUCTS_PRICES . " pp on p.products_id = pp.products_id and pp.customers_group_id = '" . $customer_group_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.customers_group_id = '" . $customer_group_id . "'";

  $from_str .= ", " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c";

  $where_str = " where p.products_status = '1' and c.categories_or_pages_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id ";

  if (isset($search_keywords) && (sizeof($search_keywords) > 0)) {
    $where_str .= " and (";
    for ($i=0, $n=sizeof($search_keywords); $i<$n; $i++ ) {
      switch ($search_keywords[$i]) {
        case '(':
        case ')':
        case 'and':
        case 'or':
          $where_str .= " " . $search_keywords[$i] . " ";
          break;
        default:
          $keyword = xos_db_prepare_input($search_keywords[$i]);
          $where_str .= "(pd.products_name like '%" . xos_db_input($keyword) . "%' or p.products_model like '%" . xos_db_input($keyword) . "%' or mi.manufacturers_name like '%" . xos_db_input($keyword) . "%'";
          $where_str .= ')';
          break;
      }
    }
    $where_str .= " )";
  }

  if ( (empty($_GET['sort'])) || (!preg_match('/^[0-9][ad]$/', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
    for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
        $_GET['sort'] = $i . 'a';
        $order_str = ' order by pd.products_name';
        break;
      }
    }
  } else {
    $sort_col = substr($_GET['sort'], 0 , 1);
    $sort_order = substr($_GET['sort'], 1);
    switch ($column_list[$sort_col]) {
      case 'PRODUCT_LIST_MODEL':
        $order_str .= " order by p.products_model " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_NAME':
        $order_str .= " order by pd.products_name " . ($sort_order == 'd' ? "desc" : "");
        break;
      case 'PRODUCT_LIST_INFO':
//--------[Alternative] wenn hier aendern auch product_listing.php, index.php und specials.php aendern-----------  
//        $order_str .= " order by pd.products_info " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
//------------------------------------------------------------------------------------------------------------------      
        $order_str .= " order by pd.products_name";
        break;
      case 'PRODUCT_LIST_PACKING_UNIT':       
        $order_str .= " order by pd.products_p_unit " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;                
      case 'PRODUCT_LIST_MANUFACTURER':
        $order_str .= " order by mi.manufacturers_name " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $order_str .= " order by p.products_quantity " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_IMAGE':
        $order_str .= " order by pd.products_name";
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $order_str .= " order by p.products_weight " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_PRICE':
        $order_str .= " order by final_price " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
    }
  }

  if ($session_started) { 
    
    $hidden_get_variables = '';
    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if ( ($key != 'max_display_search_results') && ($key != xos_session_name()) && ($key != 'page') && ($key != 'x') && ($key != 'y') ) {
        $hidden_get_variables .= xos_draw_hidden_field($key, $value);
      }
    }
         
    $pull_down_menu_display_search_results = xos_draw_form('display_search_results', xos_href_link(FILENAME_SEARCH_RESULT, '', $request_type, false, true, false, false, false), 'get') . xos_hide_session_id();
    $pull_down_menu_display_search_results .= $hidden_get_variables;
    $max_display_search_results_array = array();
    $set = false;
    for ($i = 10; $i <=50 ; $i=$i+10) {  
      if (MAX_DISPLAY_SEARCH_RESULTS <= $i && $set == false) {
        $max_display_search_results_array[] = array('id' => MAX_DISPLAY_SEARCH_RESULTS, 'text' => MAX_DISPLAY_SEARCH_RESULTS . TEXT_MAX_PRODUCTS);
        $set = true;      
      }    
      if (MAX_DISPLAY_SEARCH_RESULTS != $i) {
        $max_display_search_results_array[] = array('id' => $i, 'text' => $i . TEXT_MAX_PRODUCTS);
      }
    }  
    if ($set == false) {
      $max_display_search_results_array[] = array('id' => MAX_DISPLAY_SEARCH_RESULTS, 'text' => MAX_DISPLAY_SEARCH_RESULTS . TEXT_MAX_PRODUCTS);
    }      
    $pull_down_menu_display_search_results_noscript = $pull_down_menu_display_search_results;
    $pull_down_menu_display_search_results .= xos_draw_pull_down_menu('max_display_search_results', $max_display_search_results_array, (isset($_SESSION['max_display_search_results']) ? $_SESSION['max_display_search_results'] : MAX_DISPLAY_SEARCH_RESULTS), 'id="max_display_search_results" onchange="this.form.submit()"') . '</form>';
    $pull_down_menu_display_search_results_noscript .= xos_draw_pull_down_menu('max_display_search_results', $max_display_search_results_array, (isset($_SESSION['max_display_search_results']) ? $_SESSION['max_display_search_results'] : MAX_DISPLAY_SEARCH_RESULTS), 'id="max_display_search_results" onchange="this.form.submit()"');    

    $link_switch_search_results_view = xos_href_link(FILENAME_SEARCH_RESULT, xos_get_all_get_params(array('search_results_view', 'sort', 'page')) . 'search_results_view=' . ($product_list_b ? 'list' : 'grid'), 'NONSSL', true, true, false, false, false);
  }

  $smarty->assign(array('pull_down_menu_display_products' => $pull_down_menu_display_search_results,
                        'pull_down_menu_display_products_noscript_begin' => $pull_down_menu_display_search_results_noscript,
                        'pull_down_menu_display_products_noscript_end' => '</form>',
                        'label_for_max_display_products' => 'max_display_search_results',
                        'link_switch_view' => $link_switch_search_results_view)); 

  $listing_sql = $select_str . $from_str . $where_str . $order_str;

  $max_display = isset($_SESSION['max_display_search_results']) ? $_SESSION['max_display_search_results'] : MAX_DISPLAY_SEARCH_RESULTS;

  require(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);


  $smarty->assign('link_filename_advanced_search_and_results', xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, xos_get_all_get_params(array('sort', 'page')) . 'from_search_result=1'));
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'search_result');
  $output_search_result = $smarty->fetch(SELECTED_TPL . '/search_result.tpl');

  $smarty->assign('central_contents', $output_search_result);  
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
