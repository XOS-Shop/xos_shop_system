<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : tabs_categories.php
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

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/tabs_categories.php') == 'overwrite_all')) :                
  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cat_cache_id = 'L3|box_categories|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $cPath . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'];
    $tab_cache_id = 'L3|box_tabs|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $cPath . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . basename($_SERVER['PHP_SELF']) . '-' . $_GET['manufacturers_id'] . '-' . $_GET['content_id'];
  }
  
  if(!$smarty->isCached(SELECTED_TPL . '/includes/boxes/categories.tpl', $cat_cache_id) || !$smarty->isCached(SELECTED_TPL . '/includes/boxes/tabs.tpl', $tab_cache_id)){

    function xos_show_category_new($tree, $counter, $include_tabs = true, $categories_array = array(), $prev_level = 0, $level_change_last = 0) {
    global $category_selected, $category_name, $category_href_link, $tabs_array, $cPath_array; 
      
      if ($tree[$counter]['level']<='4') {

        if ($tree[$counter]['level']=='0') {
          $class_name = (xos_has_category_subcategories($counter) ? ($cPath_array && in_array($counter, $cPath_array) ? 'main-cat-selected' : 'main-cat') : ($cPath_array && in_array($counter, $cPath_array) ? 'main-cat-last-selected' : 'main-cat-last'));
          if ($cPath_array && in_array($counter, $cPath_array)) {
            $category_name = $tree[$counter]['name']; 
            $category_href_link = xos_href_link(FILENAME_DEFAULT, 'cPath=' . $tree[$counter]['path']);         
            $tab_class_name = 'tab-selected';
            if (xos_has_category_subcategories($counter)) $category_selected = true;
          } else {
            $tab_class_name = 'tab';
          }    
        } else if ($tree[$counter]['level']=='1') {
          $class_name = (xos_has_category_subcategories($counter) ? ($cPath_array && in_array($counter, $cPath_array) ? 'sub-cat-level1-selected' : 'sub-cat-level1') : ($cPath_array && in_array($counter, $cPath_array) ? 'sub-cat-level1-last-selected' : 'sub-cat-level1-last'));
        } else if ($tree[$counter]['level']=='2') {
          $class_name = (xos_has_category_subcategories($counter) ? ($cPath_array && in_array($counter, $cPath_array) ? 'sub-cat-level2-selected' : 'sub-cat-level2') : ($cPath_array && in_array($counter, $cPath_array) ? 'sub-cat-level2-last-selected' : 'sub-cat-level2-last'));
        } else if ($tree[$counter]['level']=='3') {
          $class_name = (xos_has_category_subcategories($counter) ? ($cPath_array && in_array($counter, $cPath_array) ? 'sub-cat-level3-selected' : 'sub-cat-level3') : ($cPath_array && in_array($counter, $cPath_array) ? 'sub-cat-level3-last-selected' : 'sub-cat-level3-last'));
        } else if ($tree[$counter]['level']=='4') {
          $class_name = (xos_has_category_subcategories($counter) ? ($cPath_array && in_array($counter, $cPath_array) ? 'sub-cat-level4-selected' : 'sub-cat-level4') : ($cPath_array && in_array($counter, $cPath_array) ? 'sub-cat-level4-last-selected' : 'sub-cat-level4-last'));
        } 

        $cPath_new = 'cPath=' . $tree[$counter]['path'];
        
        if (SHOW_EMPTY_CATEGORIES == 'false' || SHOW_COUNTS == 'true') {
          $products_in_category = xos_count_products_in_category($counter);
          
          if (SHOW_COUNTS == 'true') {
            $count_products = $products_in_category;
          }          
        }  
        
        if (SHOW_EMPTY_CATEGORIES == 'true' || $products_in_category > 0 || $tree[$counter]['is_page'] != 'false') { 
        
          if (isset($categories_array[sizeof($categories_array) - 1]['level_will_change']))
            $level_change_last -= $categories_array[sizeof($categories_array) - 1]['level_will_change'] = ($prev_level < $tree[$counter]['level']) ? $tree[$counter]['level'] - $prev_level : (($prev_level > $tree[$counter]['level']) ? $tree[$counter]['level'] - $prev_level : '');        
                       
          $categories_array[]=array('class_name' => $class_name,
                                    'level' => $tree[$counter]['level'],
                                    'level_will_change' => $level_change_last,
                                    'href_link' => xos_href_link(FILENAME_DEFAULT, $cPath_new),
                                    'count_products' => ($count_products > 0 ? $count_products : false),
                                    'name' => $tree[$counter]['name']);
       
          if ($tree[$counter]['level']=='0' && $include_tabs) {                          
            $tabs_array[]=array('class_name' => $tab_class_name,
                                'href_link' => xos_href_link(FILENAME_DEFAULT, $cPath_new),
                                'count_products' => ($count_products > 0 ? $count_products : false),
                                'name' => $tree[$counter]['name']); 
          }
        }                                                     

        if ($tree[$counter]['next_id']) {
          if (SHOW_EMPTY_CATEGORIES == 'true' || $products_in_category > 0 || $tree[$counter]['is_page'] != 'false') $prev_level = $tree[$counter]['level'];
          $categories_array = xos_show_category_new($tree, $tree[$counter]['next_id'], $include_tabs, $categories_array, $prev_level, $level_change_last);
        }
      } else {  
        if ($tree[$counter]['next_id']) {                     
          if (SHOW_EMPTY_CATEGORIES == 'true') $prev_level = 4;
          $categories_array = xos_show_category_new($tree, $tree[$counter]['next_id'], $include_tabs, $categories_array, $prev_level, $level_change_last);
        }  
      }
      
      return $categories_array;   
    }

    function xos_get_category_or_page_tree($full_tree = false, $parent_id = '0', $level = '0', $path = '', $category_tree_array = array()) {
    global $cPath_array;
       
      $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.parent_id, c.is_page from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and c.page_not_in_menu != '1' and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "' and c.parent_id = '" . (int)$parent_id . "' and c.categories_or_pages_status = '1' order by c.sort_order, cpd.categories_or_pages_name");
      while ($categories = xos_db_fetch_array($categories_query)) {
        if ($full_tree) {   
          $category_tree_array[$categories['categories_or_pages_id']] = array('is_page' => $categories['is_page'], 'name' => $categories['categories_or_pages_name'], 'parent' => $categories['parent_id'], 'level' => $level, 'path' => $path . $categories['categories_or_pages_id'], 'next_id' => false );
        } else {
          if ($level == '0' || (isset($cPath_array) && in_array($categories['categories_or_pages_id'], $cPath_array)) || (isset($cPath_array) && in_array($categories['parent_id'], $cPath_array))) $category_tree_array[$categories['categories_or_pages_id']] = array('is_page' => $categories['is_page'], 'name' => $categories['categories_or_pages_name'], 'parent' => $categories['parent_id'], 'level' => $level, 'path' => $path . $categories['categories_or_pages_id'], 'next_id' => false );
        }
        $category_tree_array = xos_get_category_or_page_tree($full_tree, $categories['categories_or_pages_id'], $level + 1, $path . $categories['categories_or_pages_id'] . '_', $category_tree_array);
      }
      
      return $category_tree_array;
    } 
    
    $tree = xos_get_category_or_page_tree();    
    foreach ($tree as $key => $value) {    
      if (!isset($first_element)) $first_element = $key;       
      if (isset($prev_key)) $tree[$prev_key]['next_id'] = $key;
      $prev_key = $key;
    } 
    
    $full_tree = xos_get_category_or_page_tree(true);    
    foreach ($full_tree as $key_full => $value_full) {    
      if (!isset($first_element_full_tree)) $first_element_full_tree = $key_full;       
      if (isset($prev_key_full)) $full_tree[$prev_key_full]['next_id'] = $key_full;
      $prev_key_full = $key_full;
    }     
  
//  echo '<pre Style="color:fff;">';
//  print_r($tree);    
//  print_r($full_tree); 
//  echo '</pre>';    

    $category_selected = false;
    
    $tabs_array[]=array('class_name' => (stristr(basename($_SERVER['PHP_SELF']),FILENAME_DEFAULT) && !$_GET[manufacturers_id] && !isset($cPath_array) ? 'tab-selected' : 'tab'),
                        'href_link' => xos_href_link(FILENAME_DEFAULT),
                        'name' => 'SMARTY_SHOP_HOME');
                        
    $full_tabs_array[]=array('class_name' => (stristr(basename($_SERVER['PHP_SELF']),FILENAME_DEFAULT) && !$_GET[manufacturers_id] && !isset($cPath_array) ? 'main-cat-last-selected' : 'main-cat-last'),
                             'level' => 0,
                             'level_will_change' => '',
                             'href_link' => xos_href_link(FILENAME_DEFAULT),
                             'count_products' => false,                        
                             'name' => 'SMARTY_SHOP_HOME');                              
    
    $cat_tree = !empty($tree) ? xos_show_category_new($tree, $first_element) : array();
    $full_cat_tree = !empty($full_tree) ? xos_show_category_new($full_tree, $first_element_full_tree, false) : array();

    $full_tabs_array = array_merge($full_tabs_array, $full_cat_tree);

    $page_name = explode('|',((DISPLAY_LINK_TO_ROOT_DIRECTORY == 'true' && DIR_WS_CATALOG != '/') ? '' : '|') . $site_trail->title_trail('|'));
    if (!isset($cPath_array) && $page_name[1]) {    
      $tabs_array[]=array('class_name' => 'tab-selected',
                          'href_link' => false,
                          'name' => $page_name[1]);
                          
      $full_tabs_array[]=array('class_name' => 'main-cat-last-selected',
                               'level' => 0,
                               'level_will_change' => '',      
                               'href_link' => false,
                               'count_products' => false,                          
                               'name' => $page_name[1]);                          
    }                          
    
    $smarty->assign(array('boxes_categories_tabs_category_selected' => $category_selected,
                          'boxes_categories_tabs_categories_tree' => $cat_tree,
                          'boxes_categories_tabs_full_categories_tree' => $full_cat_tree,
                          'boxes_categories_tabs_category_href_link' => $category_href_link,
                          'boxes_categories_tabs_category_name' => $category_name,
                          'boxes_categories_tabs_full_tabs' => $full_tabs_array,
                          'boxes_categories_tabs_tabs' => $tabs_array));                                   
  }
  
  $output_tabs = $smarty->fetch(SELECTED_TPL . '/includes/boxes/tabs.tpl', $tab_cache_id); 
  $output_categories = $smarty->fetch(SELECTED_TPL . '/includes/boxes/categories.tpl', $cat_cache_id);

  $smarty->caching = 0;
  
  $smarty->assign('box_tabs', $output_tabs);    
  $smarty->assign('box_categories', $output_categories);
endif;
?>
