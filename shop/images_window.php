<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : images_window.php
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
  die('not in use');  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_IMAGES_WINDOW) == 'overwrite_all')) :
  $_SESSION['navigation']->remove_current_page();

  $products_query = xos_db_query("select pd.products_name, p.products_image, p.products_status from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_status = '1' and p.products_id = '" . (int)$_GET['pID'] . "' and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  $products = xos_db_fetch_array($products_query);
  $products_image_name = xos_get_product_images($products['products_image'], 'all');
  
  if ($products['products_status'] == '1'){
  
    $images_array = array();
    foreach ($products_image_name as $products_img_name){
      $images_array[] = xos_image(DIR_WS_IMAGES . 'products/large/' . rawurlencode($products_img_name['name']), $products['products_name']);		   
    }
          
    $smarty->assign('html_header_add_page_title', PAGE_TITLE_TRAIL_SEPARATOR . $products['products_name']);
    
    require(DIR_WS_INCLUDES . 'html_header.php');
      
    $smarty->assign(array('product_name' => $products['products_name'],
                          'images' => $images_array));  
    
    $smarty->display(SELECTED_TPL . '/images_window.tpl');
  }
  require(DIR_WS_INCLUDES . 'counter.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
endif;
?>
