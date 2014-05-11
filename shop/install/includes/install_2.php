<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : install_2.php
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
//              filename: install_2.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  if (isset($_POST['DB_SERVER']) && !empty($_POST['DB_SERVER']) && isset($_POST['DB_TEST_CONNECTION']) && ($_POST['DB_TEST_CONNECTION'] == 'true')) {
    $db = array();
    $db['DB_SERVER'] = trim(stripslashes($_POST['DB_SERVER']));
    $db['DB_SERVER_USERNAME'] = trim(stripslashes($_POST['DB_SERVER_USERNAME']));
    $db['DB_SERVER_PASSWORD'] = trim(stripslashes($_POST['DB_SERVER_PASSWORD']));
    $db['DB_DATABASE'] = trim(stripslashes($_POST['DB_DATABASE']));

    $db_error = false;
    xos_db_connect($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD']);

    if ($db_error == false) {
      xos_db_test_create_db_permission($db['DB_DATABASE']);
    }

    if ($db_error != false) { 
      
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
      
      $db_error .= '&nbsp;';      

      $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=2" method="post">',
                            'form_end' => '</form>',
                            'db_error' => $db_error,
                            'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                            'hidden_fields' => $hidden_fields));

    } else {
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

      $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=3" method="post">',
                            'form_end' => '</form>',
                            'dir_fs_www_root' => $dir_fs_www_root . 'install/' . (isset($_POST['database_data_source']) ? $_POST['database_data_source'] : 'no_source'),
                            'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                            'hidden_fields' => $hidden_fields));
    }
  } else {

    reset($_POST);
    $hidden_fields = '';
    while (list($key, $value) = each($_POST)) {
      if (($key != 'x') && ($key != 'y') && ($key != 'DB_SERVER') && ($key != 'DB_SERVER_USERNAME') && ($key != 'DB_SERVER_PASSWORD') && ($key != 'DB_DATABASE') && ($key != 'USE_PCONNECT') && ($key != 'STORE_SESSIONS') && ($key != 'DB_TEST_CONNECTION')) {
        if (is_array($value)) {
          for ($i=0; $i<sizeof($value); $i++) {
            $hidden_fields .= xos_draw_hidden_field($key . '[]', $value[$i]);
          }
        } else {
          $hidden_fields .= xos_draw_hidden_field($key, $value);
        }
      }
    }
    
    $hidden_fields .= xos_draw_hidden_field('DB_TEST_CONNECTION', 'true');

    $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=2" method="post">',
                          'form_end' => '</form>',
                          'input_field_server' => xos_draw_input_field('DB_SERVER'),
                          'input_field_username' => xos_draw_input_field('DB_SERVER_USERNAME'),
                          'password_field' => xos_draw_password_field('DB_SERVER_PASSWORD'),
                          'input_field_database' => xos_draw_input_field('DB_DATABASE'),
                          'checkbox_field_pconnect' => xos_draw_checkbox_field('USE_PCONNECT', 'true'),
                          'radio_field_store_sessions_files' => xos_draw_radio_field('STORE_SESSIONS', 'files'),
                          'radio_field_store_sessions_mysql' => xos_draw_radio_field('STORE_SESSIONS', 'mysql', true),
                          'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                          'hidden_fields' => $hidden_fields));
  }

  
  $output_install_2 = $smarty->fetch('install_2.tpl');
  $smarty->clearAssign(array('form_begin',
                              'form_end',
                              'db_error',
                              'dir_fs_www_root',
                              'input_field_server',
                              'input_field_username',
                              'password_field',
                              'input_field_database',
                              'checkbox_field_pconnect',
                              'radio_field_store_sessions_files',
                              'radio_field_store_sessions_mysql',
                              'href_link_index',                               
                              'hidden_fields'));  
                                                    
  $smarty->assign('install_inner_content', $output_install_2);
?>