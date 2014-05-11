<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : install_4.php
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
//              filename: install_4.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  $cookie_path = substr(dirname(getenv('SCRIPT_NAME')), 0, -7);

  $www_location = 'http://' . getenv('HTTP_HOST') . getenv('SCRIPT_NAME');
  $www_location = substr($www_location, 0, stripos($www_location, 'install'));

  $script_filename = getenv('PATH_TRANSLATED');
  if (empty($script_filename)) {
    $script_filename = getenv('SCRIPT_FILENAME');
  }

  $script_filename = str_replace('\\', '/', $script_filename);
  $script_filename = str_replace('//', '/', $script_filename);

  $dir_fs_www_root_array = explode('/', dirname($script_filename));
  $dir_fs_www_root = array();
  for ($i=0, $n=sizeof($dir_fs_www_root_array)-1; $i<$n; $i++) {
    $dir_fs_www_root[] = $dir_fs_www_root_array[$i];
  }
  $dir_fs_www_root = implode('/', $dir_fs_www_root) . '/';

  reset($_POST);
  $hidden_fields = '';
  while (list($key, $value) = each($_POST)) {
    if (($key != 'x') && ($key != 'y')) {
      if (is_array($value)) {
        for ($i=0; $i<sizeof($value); $i++) {
          $hidden_fields .= xos_draw_hidden_field($key . '[]', $value[$i]);
        }
      } else {
        $hidden_fields .= xos_draw_hidden_field($key, $value);
      }
    }
  }

  $hidden_fields .= xos_draw_hidden_field('install[]', 'configure');
  
  $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=5" method="post">',
                        'form_end' => '</form>',
                        'input_field_http_www_address' => xos_draw_input_field('HTTP_WWW_ADDRESS', $www_location),                       
                        'input_field_document_root' => xos_draw_input_field('DIR_FS_DOCUMENT_ROOT', $dir_fs_www_root),
                        'input_field_http_cookie_domain' => xos_draw_input_field('HTTP_COOKIE_DOMAIN', getenv('HTTP_HOST')),
                        'input_field_http_cookie_path' => xos_draw_input_field('HTTP_COOKIE_PATH', $cookie_path),
                        'checkbox_field_rename_admin_dir' => xos_draw_checkbox_field('RENAME_ADMIN_DIR', 'true'),
                        'checkbox_field_enable_ssl' => xos_draw_checkbox_field('ENABLE_SSL', 'true'),
                        'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                        'hidden_fields' => $hidden_fields));

  $output_install_4 = $smarty->fetch('install_4.tpl');
  $smarty->clearAssign(array('form_begin',
                              'form_end',
                              'input_field_http_www_address',                       
                              'input_field_document_root',
                              'input_field_http_cookie_domain',
                              'input_field_http_cookie_path',
                              'checkbox_field_enable_ssl',
                              'href_link_index',                           
                              'hidden_fields'));  
                                                    
  $smarty->assign('install_inner_content', $output_install_4);
?>