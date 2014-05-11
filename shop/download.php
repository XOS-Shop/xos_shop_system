<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : download.php
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
//              filename: download.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_DOWNLOAD) == 'overwrite_all')) : 
  $_SESSION['navigation']->remove_current_page();

  if (!isset($_SESSION['customer_id'])) die;

// Check download.php was called with proper GET parameters
  if ((isset($_GET['order']) && !is_numeric($_GET['order'])) || (isset($_GET['id']) && !is_numeric($_GET['id'])) ) {
    die;
  }
  
// Check that order_id, customer_id and filename match
  $downloads_query = xos_db_query("select date_format(o.date_purchased, '%Y-%m-%d') as date_purchased_day, opd.download_maxdays, opd.download_count, opd.download_maxdays, opd.orders_products_filename from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " opd, " . TABLE_ORDERS_STATUS . " os where o.customers_id = '" . $_SESSION['customer_id'] . "' and o.orders_id = '" . (int)$_GET['order'] . "' and o.orders_id = op.orders_id and op.orders_products_id = opd.orders_products_id and opd.orders_products_download_id = '" . (int)$_GET['id'] . "' and opd.orders_products_filename != '' and o.orders_status = os.orders_status_id and os.downloads_flag = '1' and os.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  if (!xos_db_num_rows($downloads_query)) die;
  $downloads = xos_db_fetch_array($downloads_query);
// MySQL 3.22 does not have INTERVAL
  list($dt_year, $dt_month, $dt_day) = explode('-', $downloads['date_purchased_day']);
  $download_timestamp = mktime(23, 59, 59, $dt_month, $dt_day + $downloads['download_maxdays'], $dt_year);

// Die if time expired (maxdays = 0 means no time limit)
  if (($downloads['download_maxdays'] != 0) && ($download_timestamp <= time())) die;
// Die if remaining count is <=0
  if ($downloads['download_count'] <= 0) die;
// Die if file is not there
  if (!file_exists(DIR_FS_DOWNLOAD . $downloads['orders_products_filename'])) die;
  
// Now decrement counter
  xos_db_query("update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_count = download_count-1 where orders_products_download_id = '" . (int)$_GET['id'] . "'");

// Returns a random name, 16 to 20 characters long
// There are more than 10^28 combinations
// The directory is "hidden", i.e. starts with '.'
function xos_random_name()
{
  $letters = 'abcdefghijklmnopqrstuvwxyz';
  $dirname = '.';
  $length = floor(xos_rand(16,20));
  for ($i = 1; $i <= $length; $i++) {
   $q = floor(xos_rand(1,26));
   $dirname .= $letters[$q];
  }
  return $dirname;
}

// Unlinks all subdirectories and files in $dir
// Works only on one subdir level, will not recurse
function xos_unlink_temp_dir($dir)
{
  $h1 = opendir($dir);
  while ($subdir = readdir($h1)) {
// Ignore non directories
    if (!is_dir($dir . $subdir)) continue;
// Ignore . and .. and CVS
    if ($subdir == '.' || $subdir == '..' || $subdir == 'CVS') continue;
// Loop and unlink files in subdirectory
    $h2 = opendir($dir . $subdir);
    while ($file = readdir($h2)) {
      if ($file == '.' || $file == '..') continue;
      @unlink($dir . $subdir . '/' . $file);
    }
    closedir($h2); 
    @rmdir($dir . $subdir);
  }
  closedir($h1);
}

  header_remove(); 
// Now send the file with header() magic
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', false);
  header('Pragma: no-cache');  
  header('Content-Type: application/octet-stream');
  header('Content-Length: ' . @filesize(DIR_FS_DOWNLOAD . $downloads['orders_products_filename']));  
  header('Content-Disposition: attachment; filename="' . $downloads['orders_products_filename'] . '"');

  if (DOWNLOAD_BY_REDIRECT == 'true') {
// This will work only on Unix/Linux hosts
    xos_unlink_temp_dir(DIR_FS_DOWNLOAD_PUBLIC);
    $tempdir = xos_random_name();
    @umask(0000);
    @mkdir(DIR_FS_DOWNLOAD_PUBLIC . $tempdir, 0777);
    @symlink(DIR_FS_DOWNLOAD . $downloads['orders_products_filename'], DIR_FS_DOWNLOAD_PUBLIC . $tempdir . '/' . $downloads['orders_products_filename']);
    if (@file_exists(DIR_FS_DOWNLOAD_PUBLIC . $tempdir . '/' . $downloads['orders_products_filename'])) {
      xos_redirect(xos_href_link(DIR_WS_DOWNLOAD_PUBLIC . $tempdir . '/' . $downloads['orders_products_filename'], '', 'NONSSL', false));
    }
  }

// Fallback to readfile() delivery method. This will work on all systems, but will need considerable resources
  @readfile(DIR_FS_DOWNLOAD . $downloads['orders_products_filename']);  
endif;
?>
