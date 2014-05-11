<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : install_1.php
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
//              filename: install.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  reset($_POST);
  $hidden_fields = '';
  while (list($key, $value) = each($_POST)) {
    if (($key != 'x') && ($key != 'y') && ($key != 'DB_TEST_CONNECTION')) {
      if (is_array($value)) {
        for ($i=0; $i<sizeof($value); $i++) {
          $hidden_fields .= xos_draw_hidden_field($key . '[]', $value[$i]);
        }
      } else {
        $hidden_fields .= xos_draw_hidden_field($key, $value);
      }
    }
  }

  $directories_array = array($admin_dir_name . '/backups',
                             $admin_dir_name . '/images/graphs',
                             'contents',
                             'contents/file',
                             'contents/flash',
                             'contents/image',
                             'contents/media',
                             'images/banners',
                             'images/categories/medium',
                             'images/categories/small',
                             'images/categories/uploads',
                             'images/manufacturers',
                             'images/products/extra_small',
                             'images/products/large',
                             'images/products/medium',
                             'images/products/small',
                             'images/products/uploads',
                             'pub',
                             'smarty/admin/cache',
                             'smarty/admin/templates_c',
                             'smarty/catalog/cache',
                             'smarty/catalog/templates_c',); 
                             
  $files_array = array('includes/configure.php',
                       $admin_dir_name . '/includes/configure.php',);                            
                             
  $ws_path = substr(dirname(getenv('SCRIPT_NAME')), 0, -7);
  $fs_path = substr(dirname(getenv('SCRIPT_FILENAME')), 0, -7);                             

  $not_writeable_directories_array = array();
  $nonexistent_directories_array = array();
  $not_writeable_files_array = array();
  $nonexistent_files_array = array();  
  $error = false;

  for ($i=0, $n=sizeof($directories_array); $i<$n; $i++) {
    if (is_dir($fs_path . $directories_array[$i])) {
      if (!is_writable($fs_path . $directories_array[$i])) {
        $not_writeable_directories_array[] = array('directory' => $ws_path . $directories_array[$i]);
        $error = true; 
      }  
    } else {
      $nonexistent_directories_array[] = array('directory' => $ws_path . $directories_array[$i]);
      $error = true;
    }
  }

  for ($i=0, $n=sizeof($files_array); $i<$n; $i++) {
    if (file_exists($fs_path . $files_array[$i])) {
      if (!is_writable($fs_path . $files_array[$i])) {
        $not_writeable_files_array[] = array('file' => $ws_path . $files_array[$i]);
        $error = true; 
      }  
    } else {
      $nonexistent_files_array[] = array('file' => $ws_path . $files_array[$i]);
      $error = true;
    }
  }  

  $smarty->assign(array('error' => $error,
                        'not_writeable_directories' => $not_writeable_directories_array,
                        'nonexistent_directories' => $nonexistent_directories_array,                        
                        'not_writeable_files' => $not_writeable_files_array,
                        'nonexistent_files' => $nonexistent_files_array,                                                
                        'form_begin' => $directories_error ? '<form name="install" action="install.php" method="post">' : '<form name="install" action="install.php?step=2" method="post">',
                        'form_end' => '</form>',
                        'checkbox_database' => xos_draw_checkbox_field('install[]', 'database', true),
                        'checkbox_configure' => xos_draw_checkbox_field('install[]', 'configure', true),
                        'radio_field_database_data_source_without_sample_data' => xos_draw_radio_field('database_data_source', 'xos-shop_without_sample_data.sql'),
                        'radio_field_database_data_source_with_sample_data' => xos_draw_radio_field('database_data_source', 'xos-shop_with_sample_data.sql', true),                        
                        'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                        'hidden_fields' => $hidden_fields));
                            
  $output_install_1 = $smarty->fetch('install_1.tpl');
  $smarty->clearAssign(array('error',
                             'not_writeable_directories',
                             'nonexistent_directories',
                             'not_writeable_files',
                             'nonexistent_files',                               
                             'form_begin',
                             'form_end',
                             'checkbox_database', 
                             'checkbox_configure',
                             'href_link_index',
                             'hidden_fields'));  
                                                    
  $smarty->assign('install_inner_content', $output_install_1);
?>