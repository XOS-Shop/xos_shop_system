<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : downloads.php
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
//              filename: downloads.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/modules/downloads.php') == 'overwrite_all')) :
  if (!strstr($_SERVER['BASENAME_PHP_SELF'], FILENAME_ACCOUNT_HISTORY_INFO)) {
// Get last order id for checkout_success
    $orders_query = $DB->prepare
    (
     "SELECT   orders_id
      FROM     " . TABLE_ORDERS . "
      WHERE    customers_id = :customer_id
      ORDER BY orders_id DESC
      LIMIT    1"
    );
    
    $DB->perform($orders_query, array(':customer_id' => (int)$_SESSION['customer_id']));
                                                   
    $orders = $orders_query->fetch();
    $last_order = $orders['orders_id'];
  } else {
    $last_order = $_GET['order_id'];
  }

// Now get all downloadable products in that order
  $downloads_query = $DB->prepare 
  (
   "SELECT date_format(o.date_purchased, '%Y-%m-%d') AS date_purchased_day,
           opd.download_maxdays,
           op.products_name,
           opd.orders_products_download_id,
           opd.orders_products_filename,
           opd.download_count,
           opd.download_maxdays
    FROM   " . TABLE_ORDERS . " o,
           " . TABLE_ORDERS_PRODUCTS . " op,
           " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " opd,
           " . TABLE_ORDERS_STATUS . " os
    WHERE  o.customers_id = :customer_id
    AND    o.orders_id = :last_order
    AND    o.orders_id = op.orders_id
    AND    op.orders_products_id = opd.orders_products_id
    AND    opd.orders_products_filename != ''
    AND    o.orders_status = os.orders_status_id
    AND    os.downloads_flag = '1'
    AND    os.language_id = :languages_id"
  );
  
  $DB->perform($downloads_query, array(':customer_id' => (int)$_SESSION['customer_id'],
                                       ':last_order' => (int)$last_order,  
                                       ':languages_id' => (int)$_SESSION['languages_id']));
                                            
  if ($downloads_query->rowCount() > 0) {

    $download_products_array = array();
    while ($downloads = $downloads_query->fetch()) {
// MySQL 3.22 does not have INTERVAL
      list($dt_year, $dt_month, $dt_day) = explode('-', $downloads['date_purchased_day']);
      $download_timestamp = mktime(23, 59, 59, $dt_month, $dt_day + $downloads['download_maxdays'], $dt_year);
      $download_expiry = date('Y-m-d H:i:s', $download_timestamp);

// The link will appear only if:
// - Download remaining count is > 0, AND
// - The file is present in the DOWNLOAD directory, AND EITHER
// - No expiry date is enforced (maxdays == 0), OR
// - The expiry date is not reached
      if ( ($downloads['download_count'] > 0) && (file_exists(DIR_FS_DOWNLOAD . $downloads['orders_products_filename'])) && ( ($downloads['download_maxdays'] == 0) || ($download_timestamp > time())) ) {
        $products_name = '<a href="' . xos_href_link(FILENAME_DOWNLOAD, 'order=' . $last_order . '&id=' . $downloads['orders_products_download_id']) . '">' . $downloads['products_name'] . '</a>';        
      } else {      
        $products_name = $downloads['products_name'];         
      }
           
     $download_products_array[]=array('name' => $products_name,
                                      'expiry_date' => xos_date_long($download_expiry),
                                      'count' => $downloads['download_count']);          
    }

    if (!strstr($_SERVER['BASENAME_PHP_SELF'], FILENAME_ACCOUNT_HISTORY_INFO)) {    
      $smarty->assign('download_link', '<a href="' . xos_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . HEADER_TITLE_MY_ACCOUNT . '</a>');    
    }
    
    $smarty->assign('download_products', $download_products_array);   
    $output_downloads = $smarty->fetch(SELECTED_TPL . '/includes/modules/downloads.tpl');
    $smarty->clearAssign(array('download_link',
                                'download_products'));
               
    $smarty->assign('downloads', $output_downloads);  
  }
endif;