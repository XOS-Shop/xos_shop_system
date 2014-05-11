<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : share_product.php
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
//              filename: tell_a_friend.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/share_product.php') == 'overwrite_all')) : 
  if (CACHE_LEVEL > 1 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L2|box_share_product|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_GET['products_id'];
  }

  if(!$smarty->isCached(SELECTED_TPL . '/includes/boxes/share_product.tpl', $cache_id)){

    $allowed_product_query = xos_db_query("select p.products_id total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES_OR_PAGES . " c where p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and c.categories_or_pages_status = '1' and p.products_status = '1'");
    if (xos_db_num_rows($allowed_product_query)) {
      
      $social_bookmarks = array();
      
      if (defined('MODULE_SOCIAL_BOOKMARKS_INSTALLED') && xos_not_null(MODULE_SOCIAL_BOOKMARKS_INSTALLED) ) {
        $sbm_array = explode(';', MODULE_SOCIAL_BOOKMARKS_INSTALLED);
        
        foreach ( $sbm_array as $sbm ) {
          $class = substr($sbm, 0, strrpos($sbm, '.')); 
        
          if ( !class_exists($class) ) {
            if ( file_exists(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/modules/social_bookmarks/' . $sbm) ) {
              include(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/modules/social_bookmarks/' . $sbm);
            }

            if ( file_exists(DIR_WS_MODULES . 'social_bookmarks/' . $class . '.php') ) {
              include(DIR_WS_MODULES . 'social_bookmarks/' . $class . '.php');
            }
          }

          if ( class_exists($class) ) {
            $sb = new $class();

            if ( $sb->isEnabled() ) {
              $social_bookmarks[] = $sb->getOutput();
            }
          }
        }
      }                                          
                                   
      $smarty->assign('box_share_product_social_bookmarks', implode(' ', $social_bookmarks));
    }
  }
    
  $output_share_product = $smarty->fetch(SELECTED_TPL . '/includes/boxes/share_product.tpl', $cache_id);
                              
  $smarty->caching = 0;                            
                        
  $smarty->assign('box_share_product', $output_share_product);
endif;
?>
