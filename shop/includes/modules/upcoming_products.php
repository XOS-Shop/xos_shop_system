<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : upcoming_products.php
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
//              filename: upcoming_products.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/modules/upcoming_products.php') == 'overwrite_all')) :
  $expected_query = $DB->prepare
  (
   "SELECT DISTINCT p.products_id,
                    pd.products_name,
                    p.products_date_available AS date_expected
    FROM            " . TABLE_PRODUCTS . " p,
                    " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                    " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                    " . TABLE_CATEGORIES_OR_PAGES . " c
    WHERE           c.categories_or_pages_status = '1'
    AND             p.products_id = p2c.products_id
    AND             p2c.categories_or_pages_id = c.categories_or_pages_id
    AND             p.products_id = pd.products_id
    AND             pd.language_id = :languages_id
    AND             p.products_status = '1'
    AND             p.products_date_available > '".date("Y-m-d")."'
    ORDER BY        " . EXPECTED_PRODUCTS_FIELD . " 
                    " . EXPECTED_PRODUCTS_SORT . "
    LIMIT           " . MAX_DISPLAY_UPCOMING_PRODUCTS
  );
  
  $DB->perform($expected_query, array(':languages_id' => (int)$_SESSION['languages_id']));
    
  if ($expected_query->rowCount() > 0) {

    $upcoming_products_array = array();
    while ($expected = $expected_query->fetch()) {
                      
      $upcoming_products_array[]=array('link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $expected['products_id']),
                                       'date_expected' => xos_date_short($expected['date_expected']),
                                       'name' => $expected['products_name']);                      
    }

    $smarty->assign('upcoming_products', $upcoming_products_array);
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'upcoming_products');
    $output_upcoming_products = $smarty->fetch(SELECTED_TPL . '/includes/modules/upcoming_products.tpl');
    $smarty->clearAssign('upcoming_products');
      
    $smarty->assign('upcoming_products', $output_upcoming_products);
  }
endif;