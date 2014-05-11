<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : products_expected.php
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
//              filename: products_expected.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_PRODUCTS_EXPECTED) == 'overwrite_all')) :
  xos_db_query("update " . TABLE_PRODUCTS . " set products_last_modified = now(), products_date_available = '' where to_days(now()) > to_days(products_date_available)");

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  $products_query_raw = "select pd.products_id, pd.products_name, p.products_date_available from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p where p.products_id = pd.products_id and p.products_date_available != '' and pd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by p.products_date_available DESC";
  $products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $products_query_raw, $products_query_numrows);
  $products_query = xos_db_query($products_query_raw);
  $products_array = array();
  while ($products = xos_db_fetch_array($products_query)) {
    if ((!isset($_GET['pID']) || (isset($_GET['pID']) && ($_GET['pID'] == $products['products_id']))) && !isset($pInfo)) {
      $pInfo = new objectInfo($products);
    }
    
    $selected = false;

    if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id)) {
      $selected = true;
    }

    $products_array[]=array('selected' => $selected,
                            'link_filename_categories' => xos_href_link(FILENAME_CATEGORIES, 'pID=' . $products['products_id'] . '&action=new_product'),
                            'link_filename_products_expected' => xos_href_link(FILENAME_PRODUCTS_EXPECTED, 'page=' . $_GET['page'] . '&pID=' . $products['products_id']),
                            'name' => $products['products_name'],
                            'date_available' => xos_date_short($products['products_date_available']));
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'products' => $products_array,
                        'nav_bar_number' => $products_split->display_count($products_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED),
                        'nav_bar_result' => $products_split->display_links($products_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']))); 

  require(DIR_WS_BOXES . 'infobox_products_expected.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'products_expected');
  $output_products_expected = $smarty->fetch(ADMIN_TPL . '/products_expected.tpl');
  
  $smarty->assign('central_contents', $output_products_expected);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
