<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : boxes.php
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
//              filename: column_left.php
//              filename: column_right.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes.php') == 'overwrite_all')) :   
  include(DIR_WS_BOXES . 'tabs_categories.php');
       
  if ($is_shop) {  
    if (isset($_GET['products_id'])) include(DIR_WS_BOXES . 'manufacturer_info.php');

    if (isset($_SESSION['customer_id'])) include(DIR_WS_BOXES . 'order_history.php');

    if (isset($_GET['products_id']) && PRODUCT_NOTIFICATION_ENABLED == 'true') {
      if (isset($_SESSION['customer_id'])) {
        $check_query = xos_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$_SESSION['customer_id'] . "' and global_product_notifications = '1'");
        $check = xos_db_fetch_array($check_query);
        if ($check['count'] > 0) {
          include(DIR_WS_BOXES . 'best_sellers.php');
        } else {
          include(DIR_WS_BOXES . 'product_notifications.php');
        }
      } else {
        include(DIR_WS_BOXES . 'product_notifications.php');
      }
    } else {
      include(DIR_WS_BOXES . 'best_sellers.php');
    }

    if (isset($_GET['products_id'])) {
      if (basename($_SERVER['PHP_SELF']) != FILENAME_TELL_A_FRIEND) include(DIR_WS_BOXES . 'share_product.php');
    } else {
      include(DIR_WS_BOXES . 'whats_new.php');
    }

    if (substr(basename($_SERVER['PHP_SELF']), 0, 8) != 'checkout') {
      include(DIR_WS_BOXES . 'currencies.php');
    }

    if (PRODUCT_REVIEWS_ENABLED == 'true') {
      include(DIR_WS_BOXES . 'reviews.php');
    }
  
    if ($session_started) {
      include(DIR_WS_BOXES . 'login_my_account.php');
    }  
    
    include(DIR_WS_BOXES . 'shopping_cart.php');   
    include(DIR_WS_BOXES . 'manufacturers.php');   
    include(DIR_WS_BOXES . 'specials.php');
    include(DIR_WS_BOXES . 'search.php');  
  }
  
  if (substr(basename($_SERVER['PHP_SELF']), 0, 8) != 'checkout') {
    include(DIR_WS_BOXES . 'languages.php');
  } 

  if (ALLOW_VISITORS_TO_CHANGE_TEMPLATE == 'true') include(DIR_WS_BOXES . 'template_changer.php');
  
  if (SEND_EMAILS == 'true' && NEWSLETTER_ENABLED == 'true') {
    include(DIR_WS_BOXES . 'subscribe_newsletter.php');
  }

  include(DIR_WS_BOXES . 'information.php'); 
  include(DIR_WS_BOXES . 'banner_column_1.php');
  include(DIR_WS_BOXES . 'banner_column_2.php');
endif;       
?>
