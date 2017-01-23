<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : manufacturers.php
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
//              filename: manufacturers.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/manufacturers.php') == 'overwrite_all')) : 
  $manufacturers_query = $DB->prepare
  (
   "SELECT DISTINCT mi.manufacturers_id,
                    mi.manufacturers_name
    FROM            " . TABLE_MANUFACTURERS_INFO . " mi
    LEFT JOIN       " . TABLE_PRODUCTS . " p
    ON              mi.manufacturers_id = p.manufacturers_id
    LEFT JOIN       " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
    ON              p.products_id = p2c.products_id
    LEFT JOIN       " . TABLE_CATEGORIES_OR_PAGES . " c
    ON              p2c.categories_or_pages_id = c.categories_or_pages_id
    WHERE           c.categories_or_pages_status = '1'
    AND             p.products_status = '1'
    AND             mi.languages_id = :languages_id
    ORDER BY        mi.manufacturers_name"
  );
  
  $DB->perform($manufacturers_query, array(':languages_id' => (int)$_SESSION['languages_id']));  

  if ($number_of_rows = $manufacturers_query->rowCount()) {
  
    $manufacturers_content = '';
    $manufacturers_content_noscript = '';
    
    $manufacturers_array = array();
    if (MAX_MANUFACTURERS_LIST < 2) {
      $manufacturers_array[] = array('id' => '', 'text' => PULL_DOWN_DEFAULT);
    }
    while ($manufacturers = $manufacturers_query->fetch()) {
      $manufacturers_name = ((strlen($manufacturers['manufacturers_name']) > MAX_DISPLAY_MANUFACTURER_NAME_LEN) ? (function_exists('mb_substr') ? mb_substr($manufacturers['manufacturers_name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN, 'UTF-8') : substr($manufacturers['manufacturers_name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN)) . '..' : $manufacturers['manufacturers_name']);     
      $manufacturers_array[] = array('id' => xos_href_link(FILENAME_DEFAULT, 'm=' . $manufacturers['manufacturers_id']),
                                     'text' => $manufacturers_name); 
                                               
      if (isset($_GET['m']) && ($_GET['m'] == $manufacturers['manufacturers_id'])) $manufacturers_name = '<b>' . $manufacturers_name .'</b>';
      $manufacturers_content_noscript .= '<a href="' . xos_href_link(FILENAME_DEFAULT, 'm=' . $manufacturers['manufacturers_id']) . '">' . $manufacturers_name . '</a><br />';
    }
    $manufacturers_content_noscript = substr($manufacturers_content_noscript, 0, -6);   

    $manufacturers_content = xos_draw_form('manufacturers', xos_href_link(FILENAME_DEFAULT, '', $request_type, false, true, false, false, false), 'get');
    $manufacturers_content .= xos_draw_pull_down_menu('m', $manufacturers_array, (isset($_GET['m']) ? xos_href_link(FILENAME_DEFAULT, 'm=' . $_GET['m']) : ''), 'class="form-control" onchange="if (form.m.selectedIndex != 0) location = form.m.options[form.m.selectedIndex].value;" size="' . MAX_MANUFACTURERS_LIST . '"');
    $manufacturers_content .= '</form>';
                                   

    
    if ($number_of_rows <= MAX_DISPLAY_MANUFACTURERS_IN_A_LIST) {
      $manufacturers_content = $manufacturers_content_noscript;
    }  

    $smarty->assign(array('box_manufacturers_manufacturers' => $manufacturers_content,
                          'box_manufacturers_manufacturers_noscript' => $manufacturers_content_noscript));
    $output_manufacturers = $smarty->fetch(SELECTED_TPL . '/includes/boxes/manufacturers.tpl');
    
    $smarty->assign('box_manufacturers', $output_manufacturers);
  }
endif;
?>
