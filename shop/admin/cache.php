<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : cache.php
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
//              filename: cache.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_CACHE) == 'overwrite_all')) :  
  if (isset($_GET['reset']) && xos_not_null($_GET['reset'])) {

    if ($_GET['reset'] == 'all_blocks') {
      $smarty_cache_control->clearAllCache();
    } else {
      $smarty_cache_control->clearCache(null, $_GET['reset']);           
    }

    xos_redirect(xos_href_link(FILENAME_CACHE));
  }

// check if the cache directory exists
  if (is_dir(DIR_FS_SMARTY . 'catalog/cache/')) {
    if (!is_writable(DIR_FS_SMARTY . 'catalog/cache/')) $messageStack->add('header', ERROR_CACHE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add('header', ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST, 'error');
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  if (is_writable(DIR_FS_SMARTY . 'catalog/cache/')) {
    $languages = xos_get_languages();
    $files = array();
    $cache = opendir(DIR_FS_SMARTY . 'catalog/cache/');
    while  ($files[] = readdir($cache)) {}  
    closedir($cache);
    sort($files);
    $cache_blocks_array = array();      
    for($i = 0, $n = sizeof($files); $i < $n; $i++) {
      $prev_file = explode('^', $files[$i-1], 3);        
      $file = explode('^', $files[$i], 3);
      if (($file[0] != $files[$i]) && ($prev_file[1] != $file[1])) {       
        $cache_blocks_array[]=array('title' => $file[0] . ' | ' . $file[1],
                                    'link_filename_cache_reset_block' => xos_href_link(FILENAME_CACHE, 'reset=' . $file[0] . '|' . $file[1]));                                         
      }
    }
  
    $smarty->assign(array('cache_blocks' => $cache_blocks_array,
                          'link_filename_cache_reset_all_blocks' => xos_href_link(FILENAME_CACHE, 'reset=all_blocks')));    
  }
  
  $smarty->assign('cache_dir', DIR_FS_SMARTY . 'catalog/cache/');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'cache');
  $output_cache = $smarty->fetch(ADMIN_TPL . '/cache.tpl');
  
  $smarty->assign('central_contents', $output_cache);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
