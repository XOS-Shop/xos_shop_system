<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : best_sellers.php
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
//              filename: best_sellers.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/best_sellers.php') == 'overwrite_all')) : 
  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L3|box_best_sellers|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $current_category_id;
  }
     
  if(!$smarty->isCached(SELECTED_TPL . '/includes/boxes/best_sellers.tpl', $cache_id)){

    if (isset($current_category_id) && ($current_category_id > 0)) { 
      $best_sellers_query = $DB->prepare
      (
       "SELECT DISTINCT p.products_id,
                        p.products_ordered,
                        pd.products_name
        FROM            " . TABLE_PRODUCTS . " p,
                        " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                        " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                        " . TABLE_CATEGORIES_OR_PAGES . " c
        WHERE           p.products_status = '1'
        AND             c.categories_or_pages_status = '1'
        AND             p.products_ordered > 0
        AND             p.products_id = pd.products_id
        AND             pd.language_id = :languages_id
        AND             p.products_id = p2c.products_id
        AND             p2c.categories_or_pages_id = c.categories_or_pages_id
        AND             :current_category_id 
        IN              (
                        c.categories_or_pages_id,
                        c.parent_id
                        )
        ORDER BY        p.products_ordered DESC,
                        pd.products_name
        LIMIT           " . MAX_DISPLAY_BESTSELLERS
      );
      
      $DB->perform($best_sellers_query, array(':languages_id' => (int)$_SESSION['languages_id'],
                                              ':current_category_id' => (int)$current_category_id));
                                            
    } else {
      $best_sellers_query = $DB->prepare
      (
       "SELECT DISTINCT p.products_id,
                        p.products_ordered,
                        pd.products_name
        FROM            " . TABLE_PRODUCTS . " p,
                        " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                        " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                        " . TABLE_CATEGORIES_OR_PAGES . " c
        WHERE           p.products_status = '1'
        AND             c.categories_or_pages_status = '1'
        AND             p.products_ordered > 0
        AND             p.products_id = pd.products_id
        AND             pd.language_id = :languages_id
        AND             p.products_id = p2c.products_id
        AND             p2c.categories_or_pages_id = c.categories_or_pages_id
        ORDER BY        p.products_ordered DESC,
                        pd.products_name
        LIMIT           " . MAX_DISPLAY_BESTSELLERS
      );
      
      $DB->perform($best_sellers_query, array(':languages_id' => (int)$_SESSION['languages_id']));
                                                         
    }

    if ($best_sellers_query->rowCount() >= MIN_DISPLAY_BESTSELLERS) {
      $rows = 0;
      $bestsellers_list = '<table border="0" width="100%" cellspacing="0" cellpadding="1">';
      while ($best_sellers = $best_sellers_query->fetch()) {
        $rows++;      
        $bestsellers_list_array[]=array('number' => xos_row_number_format($rows),
                                        'link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $best_sellers['products_id']),
                                        'name' => $best_sellers['products_name']);
      }  
         
      $smarty->assign(array('box_best_sellers_has_content' => true,
                            'box_best_sellers_bestsellers' => $bestsellers_list_array));                            
    }
  }
   
  $output_best_sellers = $smarty->fetch(SELECTED_TPL . '/includes/boxes/best_sellers.tpl', $cache_id);
    
  $smarty->caching = 0;
    
  $smarty->assign('box_best_sellers', $output_best_sellers);
endif;
?>
