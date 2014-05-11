<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : xsell.php
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
//              Copyright (c) 2002 osCommerce
//              filename: xsell_products.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_XSELL_PRODUCTS) == 'overwrite_all')) :
  $max_display_xsell_results_array = array();
  $set = false;
  for ($i = 50; $i <=500 ; $i=$i+50) {
  
    if (MAX_DISPLAY_RESULTS <= $i && $set == false) {
      $max_display_xsell_results_array[] = array('id' => MAX_DISPLAY_RESULTS, 'text' => MAX_DISPLAY_RESULTS);
      $set = true;      
    }
    
    if (MAX_DISPLAY_RESULTS != $i) {
      $max_display_xsell_results_array[] = array('id' => $i, 'text' => $i);
    }
  }
  
  if ($set == false) {
    $max_display_xsell_results_array[] = array('id' => MAX_DISPLAY_RESULTS, 'text' => MAX_DISPLAY_RESULTS);
  }
  
  $manufacturers_array = array(array('id' => '', 'text' => TEXT_ALL));
  $manufacturers_query = xos_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " where languages_id = '" . (int)$_SESSION['used_lng_id'] . "' order by manufacturers_name");
  while ($manufacturers = xos_db_fetch_array($manufacturers_query)) {
    $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                   'text' => $manufacturers['manufacturers_name']);
  }
  
  $categories_or_pages_id = 0;
  if ( isset($_POST['categories_or_pages_id']) ) {
    $categories_or_pages_id = $_POST['categories_or_pages_id'];
  } elseif ( isset($_GET['categories_or_pages_id']) ) {
    $categories_or_pages_id = $_GET['categories_or_pages_id'];
  }  

  $manufacturers_id = 0;
  if ( isset($_POST['manufacturers_id']) ) {
    $manufacturers_id = $_POST['manufacturers_id'];
  } elseif ( isset($_GET['manufacturers_id']) ) {
    $manufacturers_id = $_GET['manufacturers_id'];
  }

  function xos_get_categories_string($parent_id = '', $entrance = false, $categories_string = '') {
    
    if ($entrance) {
      $categories_string = " p2c.categories_or_pages_id = '" . $parent_id . "'";
    }

    $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.parent_id from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and c.parent_id = '" . (int)$parent_id . "' order by c.sort_order, cpd.categories_or_pages_name");
    while ($categories = xos_db_fetch_array($categories_query)) {
      $categories_string .= " or p2c.categories_or_pages_id = '" . $categories['categories_or_pages_id'] . "'";
      $categories_string = xos_get_categories_string($categories['categories_or_pages_id'], '', $categories_string);
    }

    return $categories_string;
  }

  $javascript = '<script type="text/JavaScript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                '  function cOn(td) {' . "\n" .
                '    if(document.getElementById||(document.all && !(document.getElementById))) {' . "\n" .
                '      td.style.backgroundColor="#CCCCCC";' . "\n" .
                '    }' . "\n" .
                '  }' . "\n\n" .

                '  function cOnA(td) {' . "\n" .
                '    if(document.getElementById||(document.all && !(document.getElementById))) {' . "\n" .
                '      td.style.backgroundColor="#CCFFFF";' . "\n" .
                '    }' . "\n" .
                '  }' . "\n\n" .

                '  function cOut(td) {' . "\n" .
                '    if(document.getElementById||(document.all && !(document.getElementById))) {' . "\n" .
                '      td.style.backgroundColor="#DFE4F4";' . "\n" .
                '    }' . "\n" .
                '  }' . "\n" .
                '/* ]]> */' . "\n" .
                '</script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ( !$_GET['sort'] && !$_POST['run_update'] ) {
    if ($_GET['page'] == '') $_GET['page'] = '1';
    $smarty->assign(array('set_filter' => true,
                          'form_begin_filter_xsell_products' => xos_draw_form('filter_xsell_products', FILENAME_XSELL_PRODUCTS, ($_GET['first_entrance'] ? '' : xos_get_all_get_params()),'get'),
                          'pull_down_menu_categories_or_pages_id' => xos_draw_pull_down_menu('categories_or_pages_id', xos_get_category_tree(), $categories_or_pages_id),
                          'pull_down_menu_manufacturers_id' => xos_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $manufacturers_id),
                          'pull_down_menu_max_rows' => xos_draw_pull_down_menu('max_rows', $max_display_xsell_results_array, $_GET['max_rows'], 'style="width: 75px;"'),
                          'hidden_field_add_related_product_ID' => xos_draw_hidden_field('add_related_product_ID', $_GET['add_related_product_ID'])));
    if (SID) {
      $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
    }
  }
//////////////////////////////////////////////////////////////////////////////////
  if (!$_GET['add_related_product_ID'] && !$_GET['first_entrance']) {
  
    if ($categories_or_pages_id) $includes_categories = xos_get_categories_string($categories_or_pages_id, true);
    
    $products_query_raw = "select distinct a.products_id, b.products_name, a.products_model, a.products_status from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where b.products_id = a.products_id and b.products_id = p2c.products_id and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "'" . ($categories_or_pages_id ? " and (" . $includes_categories . ")" : "") . ($manufacturers_id ? " and a.manufacturers_id ='" . $manufacturers_id . "'" : "" ) . " ORDER BY b.products_name";
    $products_split = new splitPageResults($_GET['page'], $_GET['max_rows'], $products_query_raw, $products_query_numrows, 'a.products_id');
   
    $products_query = xos_db_query($products_query_raw);
    
    if ($products_query_numrows > 0) {

      /* now we will query the DB for existing related items */      
      $products_array =  array();     
      while ($products = xos_db_fetch_array($products_query)) {
        
        $related_products_query = xos_db_query("select b.products_name, c.products_model, c.products_status from " . TABLE_PRODUCTS_XSELL . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b, " . TABLE_PRODUCTS . " c WHERE b.products_id = a.xsell_id and a.products_id ='" . $products['products_id'] . "' and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "'  and b.products_id = c.products_id ORDER BY sort_order");        
        
        $related_count = 0;
        $related_products_array =  array();
        if (xos_db_num_rows($related_products_query)) {
    
          while ($related_products = xos_db_fetch_array($related_products_query)) {
            $related_count++;   

            if ($related_products['products_status'] == '1') {
              $related_products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10);
            } else {
              $related_products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10);
            }
            
            $related_products_array[]=array('related_products_model' => $related_products['products_model'],
                                            'related_products_status_image' => $related_products_status_image,
                                            'related_products_name' => $related_products['products_name']);            
          }
        }  

        if ($related_count > 1) {
          $link_to_sort_related_products = xos_href_link(FILENAME_XSELL_PRODUCTS, 'sort=1&add_related_product_ID=' . $products['products_id'] . '&categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows']);
        } else {
          $link_to_sort_related_products = '';
        }

        if ($products['products_status'] == '1') {
          $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10);
        } else {
          $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10);
        }
        
        $products_array[]=array('products_id' => $products['products_id'],
                                'products_model' => $products['products_model'],
                                'products_status_image' => $products_status_image,
                                'products_name' => $products['products_name'],
                                'link_to_sort_related_products' => $link_to_sort_related_products,
                                'link_to_edit_related_product' => xos_href_link(FILENAME_XSELL_PRODUCTS, 'add_related_product_ID=' . $products['products_id'] . '&categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows']),
                                'related_products' => $related_products_array);      
      }

      $smarty->assign(array('relating_products' => 'yes',
                            'nav_bar_number' => $products_split->display_count($products_query_numrows, $_GET['max_rows'], $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS),
                            'nav_bar_result' => $products_split->display_links($products_query_numrows, $_GET['max_rows'], MAX_DISPLAY_PAGE_LINKS, $_GET['page'], xos_get_all_get_params(array('page', 'x', 'y'))),
                            'products' => $products_array));

    } else {
    
      $smarty->assign('relating_products', 'no_products');
 
    }
  }      
//////////////////////////////////////////////////////////////////////////////////
  if ( ($_POST['run_update'] || $_POST['xsell_id']) && $_GET['add_related_product_ID'] && !$_GET['sort'] && !$_GET['first_entrance']) {
    $xsell_query = xos_db_query("select xsell_id from " . TABLE_PRODUCTS_XSELL . " WHERE products_id = '" . $_GET['add_related_product_ID'] . "' ORDER BY sort_order");

    $xsell_id = array();
    while ($xsell = xos_db_fetch_array($xsell_query)) {
      $xsell_id[] = $xsell['xsell_id'];
    }  

    if ( $xsell_id != $_POST['xsell_id']){
      if ($_POST['run_update']==true) {
        $query ="DELETE FROM " . TABLE_PRODUCTS_XSELL . " WHERE products_id = '".$_GET['add_related_product_ID']."'";
	if (!xos_db_query($query)) exit('could not delete');
      }
      if ($_POST['xsell_id']) {
	foreach ($_POST['xsell_id'] as $temp) {
	  $query = "INSERT INTO " . TABLE_PRODUCTS_XSELL . " VALUES ('','".$_GET['add_related_product_ID']."',$temp,1)";
	    if (!xos_db_query($query)) exit('could not insert to DB');
	}
      }
      $smarty_cache_control->clearCache(null, 'L3|cc_product_info');		
    }
        
    $product_query = xos_db_query("select a.products_id, a.products_status, b.products_name, a.products_model, a.products_image from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b where b.products_id = a.products_id and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and a.products_id = '". $_GET['add_related_product_ID'] . "'");
    $product = xos_db_fetch_array($product_query); 

    $product_image = xos_get_product_images($product['products_image']);
    
    if ($product['products_status'] == '1') {
      $smarty->assign('product_status_image', xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10));
    } else {
      $smarty->assign('product_status_image', xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10));
    }
    
    if ($xsell_id != $_POST['xsell_id']) {
      $smarty->assign('update_products', true);
    }
    
    if (($xsell_id != $_POST['xsell_id']) && (count($_POST['xsell_id']) > "1")) {
      $smarty->assign('link_to_sort_related_products', xos_href_link(FILENAME_XSELL_PRODUCTS, 'sort=1&add_related_product_ID=' . $_POST['add_related_product_ID'] . '&categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows']));
    }

    $smarty->assign(array('run_update_product' => true,
                          'link_to_relating_products' => xos_href_link(FILENAME_XSELL_PRODUCTS, 'categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows']),
                          'product_id' => $product['products_id'],
                          'product_name' => $product['products_name'],
                          'product_model' => $product['products_model'],
                          'product_image' => xos_info_image('products/small/' . $product_image['name'], $product['products_name'])));
     
  }

  if ($_GET['add_related_product_ID'] && !($_POST['run_update'] || $_POST['xsell_id'] ) && !$_GET['sort'] && !$_GET['first_entrance']) { 

    $product_query = xos_db_query("select a.products_id, a.products_status, b.products_name, a.products_model, a.products_image from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b where b.products_id = a.products_id and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and a.products_id = '". $_GET['add_related_product_ID'] ."'");
    $product = xos_db_fetch_array($product_query);

    $product_image = xos_get_product_images($product['products_image']);

    $_POST['run_update'] = false;
    
    $cross_query = xos_db_query("select xsell_id from " . TABLE_PRODUCTS_XSELL . " WHERE products_id = '" . $_GET['add_related_product_ID'] . "' ORDER BY sort_order");
    
    $selected_cross_products = '';
    if (xos_db_num_rows($cross_query)) {
      $_POST['run_update'] = true;     
   
      $cross_products_array =  array();
      while ($cross = xos_db_fetch_array($cross_query)) {
      
        $selected_cross_products .= " and a.products_id != '" . $cross['xsell_id'] . "'";
        
        $cross_products_query = xos_db_query("select a.products_id, a.products_status, b.products_name, a.products_model, a.products_image from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b where b.products_id = a.products_id and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and a.products_id = " . $cross['xsell_id'] . "");
        $cross_products = xos_db_fetch_array($cross_products_query);

        if ($cross_products['products_status'] == '1') {
          $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10);
        } else {
          $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10);
        }
        
        $cross_products_array[]=array('product_id' => $cross_products['products_id'],
                                      'product_model' => $cross_products['products_model'],
                                      'product_status_image' => $products_status_image,
                                      'product_name' => $cross_products['products_name']);
      }

      $smarty->assign(array('related_products' => true,
                            'cross_products' => $cross_products_array));  
    }
    
    if ($categories_or_pages_id) $includes_categories = xos_get_categories_string($categories_or_pages_id, true);
        
    $products_query_raw = "select distinct a.products_id, b.products_name, a.products_model, a.products_status from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where b.products_id = a.products_id and b.products_id = p2c.products_id and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "'" . ($categories_or_pages_id ? " and (" . $includes_categories . ")" : "") . ($manufacturers_id ? " and a.manufacturers_id ='" . $manufacturers_id . "'" : "" ) . " and a.products_id != '" . $_GET['add_related_product_ID'] . "'" . $selected_cross_products . " ORDER BY b.products_name";
    $products_split = new splitPageResults($_GET['page'], $_GET['max_rows'], $products_query_raw, $products_query_numrows, 'a.products_id');
    
    $products_query = xos_db_query($products_query_raw);

    if ($products_query_numrows > 0) {
     
      $products_array =  array();
      while ($products = xos_db_fetch_array($products_query)) {

        if ($products['products_status'] == '1') {
          $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10);
        } else {
          $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10);
        }
        
        $products_array[]=array('product_id' => $products['products_id'],
                                'product_model' => $products['products_model'],
                                'product_status_image' => $products_status_image,
                                'product_name' => $products['products_name']);
      } 
      
      $smarty->assign(array('new_products' => true,
                            'nav_bar_number' => $products_split->display_count($products_query_numrows, $_GET['max_rows'], $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS),
                            'nav_bar_result' => $products_split->display_links($products_query_numrows, $_GET['max_rows'], MAX_DISPLAY_PAGE_LINKS, $_GET['page'], xos_get_all_get_params(array('page', 'x', 'y'))),
                            'products' => $products_array));   
    }
 
    if ($product['products_status'] == '1') {
      $smarty->assign('product_status_image', xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10));
    } else {
      $smarty->assign('product_status_image', xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10));
    } 
   
    $smarty->assign(array('add_relating_products' => true,
                          'form_begin_add_relating_products' => xos_draw_form('runing_update', FILENAME_XSELL_PRODUCTS, xos_get_all_get_params()),
                          'hidden_field_run_update' => xos_draw_hidden_field('run_update', ($_POST['run_update']==true) ? 'true' : 'false'),
                          'hidden_field_categories_or_pages_id' => xos_draw_hidden_field('categories_or_pages_id', $categories_or_pages_id),
                          'hidden_field_manufacturers_id' => xos_draw_hidden_field('manufacturers_id', $manufacturers_id),
                          'hidden_field_add_related_product_ID' => xos_draw_hidden_field('add_related_product_ID', $_GET['add_related_product_ID']),
                          'link_to_relating_products' => xos_href_link(FILENAME_XSELL_PRODUCTS, 'categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows']),
                          'product_id' => $product['products_id'],
                          'product_name' => $product['products_name'],
                          'product_model' => $product['products_model'],
                          'product_image' => xos_info_image('products/small/' . $product_image['name'], $product['products_name'])));
     
  }
//////////////////////////////////////////////////////////////////////////////////
  if ($_GET['sort']==1 && !$_GET['first_entrance']) {
    $product_query = xos_db_query("select a.products_id, a.products_status, b.products_name, a.products_model, a.products_image from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b where b.products_id = a.products_id and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and a.products_id = '" . $_GET['add_related_product_ID'] . "'");
    $product = xos_db_fetch_array($product_query);
    
    $product_image = xos_get_product_images($product['products_image']);
      
    // first lets take care of the DB update.
    if ($_POST) {
      foreach ($_POST as $key_a => $value_a) {
        xos_db_connect();
        $query = "UPDATE " . TABLE_PRODUCTS_XSELL . " SET sort_order = '" . $value_a . "' WHERE products_id ='" . $product['products_id'] . "' and xsell_id= '$key_a' ";
        if ($value_a != 'Update') {
	  if (!xos_db_query($query)) exit('Could not UPDATE DB');
	}
      }
      $smarty_cache_control->clearCache(null, 'L3|cc_product_info');
    }
    
    $cross_query = xos_db_query("select xsell_id, sort_order from " . TABLE_PRODUCTS_XSELL . " WHERE products_id = '" . $_GET['add_related_product_ID'] . "' ORDER BY sort_order");   
    $ordering_size = xos_db_num_rows($cross_query);    
     
    $cross_products_array =  array();
    while ($cross = xos_db_fetch_array($cross_query)) {
      $cross_products_query = xos_db_query("select a.products_id, a.products_status, b.products_name, a.products_model, a.products_image from " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " b where b.products_id = a.products_id and b.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and a.products_id = " . $cross['xsell_id'] . "");
      $cross_products = xos_db_fetch_array($cross_products_query);
     
      $select = '<select name="' . $cross_products['products_id'] . '">';  
      for ($y=1;$y<=$ordering_size;$y++) {
        $select .= '<option value="' . $y . '"';
        if (!(strcmp($y, $cross['sort_order']))) {
         $select .= ' selected="selected"';
        }
        $select .= '>' . $y . '</option>';
      }
      $select .= '</select>';

      if ($cross_products['products_status'] == '1') {
        $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10);
      } else {
        $products_status_image = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10);
      }
        
      $cross_products_array[]=array('product_id' => $cross_products['products_id'],
                                    'product_model' => $cross_products['products_model'],
                                    'product_status_image' => $products_status_image,
                                    'product_name' => $cross_products['products_name'],
                                    'select_tag' => $select);
    }

    if ($product['products_status'] == '1') {
      $smarty->assign('product_status_image', xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10));
    } else {
      $smarty->assign('product_status_image', xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10));
    }
     
    $smarty->assign(array('sort_related_products' => true,
                          'form_begin_runing_update' => xos_draw_form('runing_update', FILENAME_XSELL_PRODUCTS, 'sort=1&add_related_product_ID=' . $_GET['add_related_product_ID']. '&categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows']),
                          'link_to_relating_products' => xos_href_link(FILENAME_XSELL_PRODUCTS, 'categories_or_pages_id=' . $categories_or_pages_id . '&manufacturers_id=' . $manufacturers_id . '&max_rows=' . $_GET['max_rows']),
                          'product_id' => $product['products_id'],
                          'product_name' => $product['products_name'],
                          'product_model' => $product['products_model'],
                          'product_image' => xos_info_image('products/small/' . $product_image['name'], $product['products_name']),
                          'cross_products' => $cross_products_array));

  } 

  $smarty->assign('form_end', '</form>');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'xsell');
  $output_xsell = $smarty->fetch(ADMIN_TPL . '/xsell.tpl');
  
  $smarty->assign('central_contents', $output_xsell);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');
  
  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
