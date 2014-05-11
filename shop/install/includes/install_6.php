<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : install_6.php
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
//              filename: install_6.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  $dir_fs_document_root = $_POST['DIR_FS_DOCUMENT_ROOT'];
  
  $db = array();
  $db['DB_SERVER'] = trim(stripslashes($_POST['DB_SERVER']));
  $db['DB_SERVER_USERNAME'] = trim(stripslashes($_POST['DB_SERVER_USERNAME']));
  $db['DB_SERVER_PASSWORD'] = trim(stripslashes($_POST['DB_SERVER_PASSWORD']));
  $db['DB_DATABASE'] = trim(stripslashes($_POST['DB_DATABASE']));

  $db_error = false;
  xos_db_connect($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD']);

  if ($db_error == false) {
    xos_db_test_connection($db['DB_DATABASE']);
  }

  if ($db_error != false) {

    reset($_POST);
    $hidden_fields = '';
    while (list($key, $value) = each($_POST)) {
      if ($key != 'x' && $key != 'y') {
        if (is_array($value)) {
          for ($i=0; $i<sizeof($value); $i++) {
            $hidden_fields .= xos_draw_hidden_field($key . '[]', $value[$i]);
          }
        } else {
          $hidden_fields .= xos_draw_hidden_field($key, $value);
        }
      }
    }
      
    $db_error .= '&nbsp;';      

    $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=5" method="post">',
                          'form_end' => '</form>',
                          'db_error' => $db_error,
                          'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                          'hidden_fields' => $hidden_fields));
                            
  } elseif ((!is_writable($dir_fs_document_root . 'includes/configure.php')) || (!is_writable($dir_fs_document_root . $admin_dir_name . '/includes/configure.php'))) {

    reset($_POST);
    $hidden_fields = '';
    while (list($key, $value) = each($_POST)) {
      if ($key != 'x' && $key != 'y') {
        if (is_array($value)) {
          for ($i=0; $i<sizeof($value); $i++) {
            $hidden_fields .= xos_draw_hidden_field($key . '[]', $value[$i]);
          }
        } else {
          $hidden_fields .= xos_draw_hidden_field($key, $value);
        }
      }
    }

    $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=6" method="post">',
                          'form_end' => '</form>',
                          'config_file_catalog_writeable' => (is_writable($dir_fs_document_root . 'includes/configure.php')) ? true : false,
                          'config_file_admin_writeable' => (is_writable($dir_fs_document_root . $admin_dir_name . '/includes/configure.php')) ? true : false,
                          'configuration_not_writable' => true,
                          'dir_fs_document_root' => $dir_fs_document_root,
                          'admin_dir_name' => $admin_dir_name,
                          'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                          'hidden_fields' => $hidden_fields));
                          
  } elseif (!is_writable($dir_fs_document_root) && $_POST['RENAME_ADMIN_DIR'] == 'true' && $_POST['ignore_renaming'] != 'true') {                          

    reset($_POST);
    $hidden_fields = '';
    while (list($key, $value) = each($_POST)) {
      if ($key != 'x' && $key != 'y') {
        if (is_array($value)) {
          for ($i=0; $i<sizeof($value); $i++) {
            $hidden_fields .= xos_draw_hidden_field($key . '[]', $value[$i]);
          }
        } else {
          $hidden_fields .= xos_draw_hidden_field($key, $value);
        }
      }
    }

    $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=6" method="post">',
                          'form_end' => '</form>',
                          'admin_can_not_be_renamed' => true,
                          'dir_fs_document_root' => substr($dir_fs_document_root, 0, strlen($dir_fs_document_root) - 1),
                          'admin_dir_name' => $admin_dir_name,
                          'hidden_field_ignore_renaming' => xos_draw_hidden_field('ignore_renaming', 'true'),                          
                          'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                          'hidden_fields' => $hidden_fields));
                            
  } else {
    
    if($_POST['RENAME_ADMIN_DIR'] == 'true') {    
      $possible_char="123456789"; 
      $rand_str = ''; 
      while(strlen($rand_str)<4) { 
        $rand_str .= substr($possible_char,(rand()%(strlen($possible_char))),1); 
      }    
      
      if (@rename($dir_fs_document_root . $admin_dir_name, $dir_fs_document_root . 'admin' . $rand_str)) {    
        $admin_dir_name = 'admin' . $rand_str;
      }  
    }  

    $enable_ssl = (isset($_POST['ENABLE_SSL']) && ($_POST['ENABLE_SSL'] == 'true') ? 'true' : 'false');
    $http_cookie_domain = $_POST['HTTP_COOKIE_DOMAIN'];
    $http_cookie_path = $_POST['HTTP_COOKIE_PATH'];
  
    $http_url = parse_url(urldecode($_POST['HTTP_WWW_ADDRESS']));
    $http_server = $http_url['scheme'] . '://' . $http_url['host'];
    $http_catalog = $http_url['path'];
    if (isset($http_url['port']) && !empty($http_url['port'])) {
      $http_server .= ':' . $http_url['port'];
    }

    $https_server = $enable_ssl == 'true' ? str_replace('http://', 'https://', $http_server) : '';

    if (substr($http_catalog, -1) != '/') {
      $http_catalog .= '/';
    }

    $file_contents = '<?php' . "\n" .    
                     '////////////////////////////////////////////////////////////////////////////////' . "\n" . 
                     '// project    : XOS-Shop, open source e-commerce system' . "\n" .
                     '//              http://www.xos-shop.com' . "\n" .
                     '//' . "\n" .                                                                     
                     '// filename   : configure.php' . "\n" .
                     '// author     : Hanspeter Zeller <hpz@xos-shop.com>' . "\n" .
                     '// copyright  : Copyright (c) 2007 Hanspeter Zeller' . "\n" .
                     '// license    : This file is part of XOS-Shop.' . "\n" .
                     '//' . "\n" .
                     '//              XOS-Shop is free software: you can redistribute it and/or modify' . "\n" .
                     '//              it under the terms of the GNU General Public License as published' . "\n" .
                     '//              by the Free Software Foundation, either version 3 of the License,' . "\n" .
                     '//              or (at your option) any later version.' . "\n" .
                     '//' . "\n" .
                     '//              XOS-Shop is distributed in the hope that it will be useful,' . "\n" .
                     '//              but WITHOUT ANY WARRANTY; without even the implied warranty of' . "\n" .
                     '//              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the' . "\n" .
                     '//              GNU General Public License for more details.' . "\n" .
                     '//' . "\n" .
                     '//              You should have received a copy of the GNU General Public License' . "\n" .
                     '//              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>.' . "\n" .                     
                     '////////////////////////////////////////////////////////////////////////////////' . "\n" .
                     '' . "\n" .
                     '// Define the webserver and path parameters' . "\n" .
                     '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                     '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                     '  define(\'HTTP_SERVER\', \'' . $http_server . '\'); // eg, http://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'HTTPS_SERVER\', \'' . $https_server . '\'); // eg, https://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'ENABLE_SSL\', \'' . $enable_ssl . '\'); // secure webserver' . "\n" .
                     '  define(\'COOKIE_DOMAIN\', \'' . $http_cookie_domain . '\');' . "\n" .
                     '  define(\'COOKIE_PATH\', \'' . $http_cookie_path . '\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                     '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                     '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                     '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                     '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                     '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                     '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                     '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                     '' . "\n" .
                     '  define(\'DIR_WS_DOWNLOAD_PUBLIC\', \'pub/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\');' . "\n" .
                     '  define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');' . "\n" .
                     '  define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');' . "\n" .
                     '  define(\'DIR_FS_SMARTY\', DIR_FS_CATALOG . \'smarty/\');' . "\n" .
                     '' . "\n" .
                     '  define(\'ADMIN_DIR_NAME\', \'' . ($admin_dir_name === 'admin' ? 'default_dir_name' : $admin_dir_name) . '\');' . "\n" .
                     '' . "\n" .
                     '// define our database connection' . "\n" .
                     '  define(\'DB_SERVER\', \'' . $_POST['DB_SERVER'] . '\'); // eg, localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'DB_SERVER_USERNAME\', \'' . $_POST['DB_SERVER_USERNAME'] . '\');' . "\n" .
                     '  define(\'DB_SERVER_PASSWORD\', \'' . $_POST['DB_SERVER_PASSWORD']. '\');' . "\n" .
                     '  define(\'DB_DATABASE\', \'' . $_POST['DB_DATABASE']. '\');' . "\n" .
                     '  define(\'USE_PCONNECT\', \'' . (($_POST['USE_PCONNECT'] == 'true') ? 'true' : 'false') . '\'); // use persistent connections?' . "\n" .
                     '  define(\'STORE_SESSIONS\', \'' . (($_POST['STORE_SESSIONS'] == 'files') ? '' : 'mysql') . '\'); // leave empty \'\' for default handler or set to \'mysql\'' . "\n" .
                     '?>';

    $fp = fopen($dir_fs_document_root . 'includes/configure.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);    
    @chmod($dir_fs_document_root . 'includes/configure.php', 0644);

    $file_contents = '<?php' . "\n" .
                     '////////////////////////////////////////////////////////////////////////////////' . "\n" . 
                     '// project    : XOS-Shop, open source e-commerce system' . "\n" .
                     '//              http://www.xos-shop.com' . "\n" .
                     '//' . "\n" .                                                                     
                     '// filename   : configure.php' . "\n" .
                     '// author     : Hanspeter Zeller <hpz@xos-shop.com>' . "\n" .
                     '// copyright  : Copyright (c) 2007 Hanspeter Zeller' . "\n" .                     
                     '// license    : This file is part of XOS-Shop.' . "\n" .
                     '//' . "\n" .
                     '//              XOS-Shop is free software: you can redistribute it and/or modify' . "\n" .
                     '//              it under the terms of the GNU General Public License as published' . "\n" .
                     '//              by the Free Software Foundation, either version 3 of the License,' . "\n" .
                     '//              or (at your option) any later version.' . "\n" .
                     '//' . "\n" .
                     '//              XOS-Shop is distributed in the hope that it will be useful,' . "\n" .
                     '//              but WITHOUT ANY WARRANTY; without even the implied warranty of' . "\n" .
                     '//              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the' . "\n" .
                     '//              GNU General Public License for more details.' . "\n" .
                     '//' . "\n" .
                     '//              You should have received a copy of the GNU General Public License' . "\n" .
                     '//              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>.' . "\n" .                      
                     '////////////////////////////////////////////////////////////////////////////////' . "\n" .
                     '' . "\n" .
                     '// Define the webserver and path parameters' . "\n" .
                     '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                     '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                     '  define(\'HTTP_SERVER\', \'' . $http_server . '\'); // eg, http://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'HTTPS_SERVER\', \'' . $https_server . '\'); // eg, https://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'ENABLE_SSL\', \'' . $enable_ssl . '\'); // secure webserver' . "\n" .
                     '  define(\'COOKIE_DOMAIN\', \'' . $http_cookie_domain . '\');' . "\n" .
                     '  define(\'COOKIE_PATH\', \'' . $http_cookie_path . '\');' . "\n" .                    
                     '  define(\'DIR_FS_DOCUMENT_ROOT\', \'' . $dir_fs_document_root . '\'); // where the pages are located on the server' . "\n" .
                     '  define(\'DIR_WS_ADMIN\', \'' . $http_catalog . $admin_dir_name . '/\');' . "\n" .
                     '  define(\'DIR_FS_ADMIN\', \'' . $dir_fs_document_root . $admin_dir_name . '/\'); // absolute pate required' . "\n" .
                     '  define(\'DIR_WS_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\'); // absolute path required' . "\n" .
                     '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                     '  define(\'DIR_WS_ADMIN_IMAGES\', DIR_WS_CATALOG . \'images/admin/templates/\');' . "\n" .
                     '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_IMAGES\', DIR_WS_CATALOG . \'images/\');' . "\n" .
                     '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                     '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                     '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                     '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                     '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_IMAGES\', DIR_FS_CATALOG . \'images/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_MODULES\', DIR_FS_CATALOG . \'includes/modules/\');' . "\n" .
                     '  define(\'DIR_FS_BACKUP\', DIR_FS_ADMIN . \'backups/\');' . "\n" .
                     '  define(\'DIR_FS_SMARTY\', DIR_FS_CATALOG . \'smarty/\');' . "\n" .
                     '' . "\n" .
                     '  define(\'ADMIN_DIR_NAME\', \'' . ($admin_dir_name === 'admin' ? 'default_dir_name' : $admin_dir_name) . '\');' . "\n" .
                     '' . "\n" .
                     '// define our database connection' . "\n" .
                     '  define(\'DB_SERVER\', \'' . $_POST['DB_SERVER'] . '\'); // eg, localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'DB_SERVER_USERNAME\', \'' . $_POST['DB_SERVER_USERNAME'] . '\');' . "\n" .
                     '  define(\'DB_SERVER_PASSWORD\', \'' . $_POST['DB_SERVER_PASSWORD']. '\');' . "\n" .
                     '  define(\'DB_DATABASE\', \'' . $_POST['DB_DATABASE']. '\');' . "\n" .
                     '  define(\'USE_PCONNECT\', \'' . (($_POST['USE_PCONNECT'] == 'true') ? 'true' : 'false') . '\'); // use persisstent connections?' . "\n" .
                     '  define(\'STORE_SESSIONS\', \'' . (($_POST['STORE_SESSIONS'] == 'files') ? '' : 'mysql') . '\'); // leave empty \'\' for default handler or set to \'mysql\'' . "\n" .
                     '?>';

    $fp = fopen($dir_fs_document_root . $admin_dir_name . '/includes/configure.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);    
    @chmod($dir_fs_document_root . $admin_dir_name . '/includes/configure.php', 0644);

    $smarty->assign(array('href_link_catalog' => $http_server . $http_catalog . 'index.php?language=' . $_POST['language_code'],
                          'href_link_admin' => $http_server . $http_catalog . $admin_dir_name . '/index.php?language=' . $_POST['language_code']));
                          
  }

  $output_install_6 = $smarty->fetch('install_6.tpl');
  $smarty->clearAssign(array('form_begin',
                              'form_end',
                              'db_error',
                              'dir_fs_document_root',
                              'admin_dir_name' => $admin_dir_name,
                              'href_link_catalog',
                              'href_link_admin',
                              'href_link_index',                              
                              'hidden_fields'));  
                                                    
  $smarty->assign('install_inner_content', $output_install_6);
?>