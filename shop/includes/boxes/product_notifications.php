<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : product_notifications.php
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
//              filename: product_notifications.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/product_notifications.php') == 'overwrite_all')) : 
  if (isset($_GET['p'])) {
    $allowed_product_query = $DB->prepare
    (
     "SELECT p.products_id total
      FROM   " . TABLE_PRODUCTS . " p,
             " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
             " . TABLE_CATEGORIES_OR_PAGES . " c
      WHERE  p.products_id = :p
      AND    p.products_id = p2c.products_id
      AND    p2c.categories_or_pages_id = c.categories_or_pages_id
      AND    c.categories_or_pages_status = '1'
      AND    p.products_status = '1'"
    );
    
    $DB->perform($allowed_product_query, array(':p' => (int)$_GET['p']));
                                             
    if ($allowed_product_query->rowCount()) {

      if (isset($_SESSION['customer_id'])) {
        $check_query = $DB->prepare
        (
         "SELECT Count(*) AS count
          FROM   " . TABLE_PRODUCTS_NOTIFICATIONS . "
          WHERE  products_id = :p
          AND    customers_id = :customer_id"
        );
        
        $DB->perform($check_query, array(':p' => (int)$_GET['p'],
                                         ':customer_id' => (int)$_SESSION['customer_id']));
                                                   
        $check = $check_query->fetch();
        $notification_exists = (($check['count'] > 0) ? true : false);
      } else {
        $notification_exists = false;
      }

      if ($notification_exists == true) {
        $smarty->assign(array('box_product_notifications_notification_exists' => true,
                              'box_product_notifications_link_notify_notify_remove' => xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('action', 'lnc', 'cur', 'tpl')) . 'action=notify_remove', $request_type),
                              'box_product_notifications_image' => xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/box_products_notifications_remove.gif', IMAGE_BUTTON_REMOVE_NOTIFICATIONS)));
      } else {
        $smarty->assign(array('box_product_notifications_notification_exists' => false,
                              'box_product_notifications_link_notify_notify_remove' => xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('action', 'lnc', 'cur', 'tpl')) . 'action=notify', $request_type),
                              'box_product_notifications_image' => xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/box_products_notifications.gif', IMAGE_BUTTON_NOTIFICATIONS)));
      }
      
      $smarty->assign(array('box_product_notifications_link_filename_account_notifications' => xos_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL'),
                            'box_product_notifications_product_name' => xos_get_products_name($_GET['p'])));
      $output_product_notifications = $smarty->fetch(SELECTED_TPL . '/includes/boxes/product_notifications.tpl');
                          
      $smarty->assign('box_product_notifications', $output_product_notifications);
    }
  }
endif;
?>
