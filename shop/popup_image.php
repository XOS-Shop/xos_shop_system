<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : popup_image.php
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
//              filename: popup_image.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  die('not in use');  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_POPUP_IMAGE) == 'overwrite_all')) :
  $_SESSION['navigation']->remove_current_page();

  $products_query = xos_db_query("select pd.products_name, p.products_image, p.products_status from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_status = '1' and p.products_id = '" . (int)$_GET['pID'] . "' and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  $products = xos_db_fetch_array($products_query);
  $products_image_name = xos_get_product_images($products['products_image'], 'all');
  
  if ($products['products_status'] == '1'){
    $img = DIR_WS_IMAGES . 'products/large/' . urldecode($_GET['img_name']);  
    $size = @GetImageSize("$img");
   
    $pop_width = $size[0];
    $pop_height = $size[1];
    $small_height = 0;
    $small_width_total = 0;
    foreach ($products_image_name as $products_img_name){   
      if (count($products_image_name)>1) {		  
        $small_img = DIR_WS_IMAGES . 'products/small/' . $products_img_name['name'];
        $small_size = @GetImageSize("$small_img");		
        $small_width_total += $small_size[0] + 10;		
        if (($small_size[1] + 10) > $small_height) $small_height = $small_size[1] + 10;
      }    
      $popup_img = DIR_WS_IMAGES . 'products/large/' . $products_img_name['name'];		
      $pop_size = @GetImageSize("$popup_img");		
      if ($pop_size[0] > $pop_width) $pop_width = $pop_size[0];
      if ($pop_size[1] > $pop_height) $pop_height = $pop_size[1];
    }
    if ($small_width_total > $pop_width) $pop_width = $small_width_total; 
              
    if (count($products_image_name)>1) {                     
      foreach ($products_image_name as $products_img_name) {
        if ($products_img_name['name'] == urldecode($_GET['img_name'])) $actual = ' class="popup-image-thumb-active"'; else $actual = ' class="popup-image-thumb-non-active"';	
       	    $small_images.= '     <div'.$actual.' style="padding: 2px; margin: 2px; float: left;">'."\n".       	  
                            '       <a href="'.xos_href_link(FILENAME_POPUP_IMAGE, 'pID=' . (int)$_GET['pID'] . '&img_name=' . urlencode($products_img_name['name']), $request_type).'">' . xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($products_img_name['name']), $products['products_name']) . '</a>'."\n".
                            '     </div>'."\n";	
      }
      $small_images.= '     <div class="clear">&nbsp;</div>'."\n";
    }                      
           
    $smarty->assign('html_header_add_page_title', PAGE_TITLE_TRAIL_SEPARATOR . $products['products_name']);
    
    require(DIR_WS_INCLUDES . 'html_header.php');
      
    $smarty->assign(array('product_name' => $products['products_name'],
                          'blind_image_height' => (int)($pop_height+20),
                          'image_padding_top' => (int)(($pop_height+20-$size[1])/2),
                          'thumb_width_total' => (int)($small_width_total+2),
                          'popup_image' => xos_image(DIR_WS_IMAGES . 'products/large/' . rawurlencode(urldecode($_GET['img_name'])), $products['products_name'], $size[0], $size[1], 'class="popup-image-large"'),
                          'small_images' => $small_images));  
    
    $smarty->display(SELECTED_TPL . '/popup_image.tpl');
  }
  require(DIR_WS_INCLUDES . 'counter.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
endif;
?>
