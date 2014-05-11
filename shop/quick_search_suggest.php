<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : quick_search_suggest.php
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
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  die('<div style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; white-space: nowrap; background-color: #fff; padding: 5px; border: 1px solid #000;">not in use</div>');  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_QUICK_SEARCH_SUGGEST) == 'overwrite_all')) : 
  $_SESSION['navigation']->remove_current_page();
	
  if (!empty($_GET['keywords'])) {

    $results_array = array();
              
//    $search_suggest_sql = "select insert(insert(pd.products_name, instr(pd.products_name, '" . $_GET['keywords'] . "') + char_length('" . $_GET['keywords'] . "'), 0, '</span>'), instr(pd.products_name, '" . $_GET['keywords'] . "'), 0, '<span class=\"red-mark\">') as products_name_marked, p.products_id from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS . " p on pd.products_id = p.products_id where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and pd.products_name like('%" . xos_db_input($_GET['keywords']) . "%') limit 15";
    $search_suggest_sql = "select distinct insert(insert(pd.products_name, instr(pd.products_name, '" . $_GET['keywords'] . "') + char_length('" . $_GET['keywords'] . "'), 0, '</span>'), instr(pd.products_name, '" . $_GET['keywords'] . "'), 0, '<span class=\"red-mark\">') as products_name_marked, p.products_id from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS . " p on pd.products_id = p.products_id, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and c.categories_or_pages_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and pd.products_name like('%" . xos_db_input($_GET['keywords']) . "%') limit 15";  
    $suggest_query = xos_db_query($search_suggest_sql);
    while($results = xos_db_fetch_array($suggest_query)) {
      if (strpos($results['products_name_marked'], '<span') !== false) { 
        $results_array[]=array('products_name' => $results['products_name_marked'],    	   
                               'products_link' => xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $results['products_id']));	   
      }
    }
/*
    $search_suggest_sql = "select pd.products_name, p.products_id from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS . " p on pd.products_id = p.products_id where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and pd.products_name like('%" . xos_db_input($_GET['keywords']) . "%') limit 15";
    $suggest_query = xos_db_query($search_suggest_sql);
    while($results = xos_db_fetch_array($suggest_query)) {
      $products_name_marked = str_ireplace(mb_strtoupper(stripslashes($_GET['keywords']), 'UTF-8'), '<span class="red-mark">' . mb_strtoupper(stripslashes($_GET['keywords']), 'UTF-8') . '</span>', mb_strtoupper($results['products_name'], 'UTF-8'));
      if (strpos($products_name_marked, '<span') !== false) { 
        $results_array[]=array('products_name' => $products_name_marked,
                               'products_link' => xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $results['products_id']));	   
      }
    } 
       
    $search_suggest_sql = "select pd.products_name, p.products_id from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS . " p on pd.products_id = p.products_id where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and pd.products_name like('%" . xos_db_input($_GET['keywords']) . "%') limit 15";
    $suggest_query = xos_db_query($search_suggest_sql);
    while($results = xos_db_fetch_array($suggest_query)) {
      $results_array[]=array('products_name' => str_ireplace(mb_strtoupper(stripslashes($_GET['keywords']), 'UTF-8'), '<span class="red-mark">' . mb_strtoupper(stripslashes($_GET['keywords']), 'UTF-8') . '</span>', mb_strtoupper($results['products_name'], 'UTF-8')),
                             'products_link' => xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $results['products_id']));	   
    }    
*/    
    if (!empty($results_array)) {
    
      $smarty->assign('results', $results_array);	   
   
      $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'quick_search_suggest');
    
      $smarty->display(SELECTED_TPL . '/quick_search_suggest.tpl');
    }
  } 
endif;
?>