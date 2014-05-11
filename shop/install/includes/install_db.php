<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : install_db.php
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
//              filename: install_3.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////
 

  if (basename(substr(dirname(getenv('SCRIPT_FILENAME')), 0, -9)) !== 'install') {
    header("HTTP/1.1 404 Not Found");
    die('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"><head><meta http-equiv="content-type" content="text/html; charset=UTF-8" /><title>404 Not Found</title></head><body><h1>Not Found</h1>The requested document was not found on this server.<p></p><hr /><address>Web Server at ' . getenv('SERVER_NAME') . '</address></body></html>');    
  }  

  if (isset($_POST['language_file_name'])) {
  
    error_reporting(E_ALL & ~E_NOTICE);

    if (class_exists('mysqli') && version_compare(PHP_VERSION, '5.3.0', '>=')) {
      require('functions/database_mysqli.php');
    } else {
      require('functions/database_mysql.php'); 
    } 

    require('functions/general.php');
    require('functions/html_output.php');
  
    header( 'Content-Type:text/html; charset=utf-8' );
    
// set default timezone if none exists (PHP 5.3 throws an E_WARNING)
    if ((strlen(ini_get('date.timezone')) < 1) && function_exists('date_default_timezone_set')) {
      date_default_timezone_set(@date_default_timezone_get());
    }    

// Define the admin template
    define('INSTALL_TPL', 'xos-shop_install_default_v1.0.7');
  
// require the smarty class and create an instance
    require('../../smarty/Smarty-3.1.18/Smarty.class.php');  
    $smarty = new Smarty(); 
    $smarty->template_dir = '../templates/' . INSTALL_TPL . '/';
    $smarty->config_dir = '../templates/' . INSTALL_TPL . '/';
    $smarty->compile_dir = '../templates_c/';

    $smarty->assign(array('images_path' => 'templates/' . INSTALL_TPL . '/images/',
                          'buttons_path' => 'templates/' . INSTALL_TPL . '/images/' . $_POST['language_directory'] . '/buttons/'));  

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

    if (xos_in_array('database', $_POST['install'])) {
      $db = array();
      $db['DB_SERVER'] = trim(stripslashes($_POST['DB_SERVER']));
      $db['DB_SERVER_USERNAME'] = trim(stripslashes($_POST['DB_SERVER_USERNAME']));
      $db['DB_SERVER_PASSWORD'] = trim(stripslashes($_POST['DB_SERVER_PASSWORD']));
      $db['DB_DATABASE'] = trim(stripslashes($_POST['DB_DATABASE']));

      xos_db_connect($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD']);

      $db_error = false;
      $sql_file = $dir_fs_www_root . 'includes/' . (isset($_POST['database_data_source']) ? $_POST['database_data_source'] : 'no_source');

      xos_set_time_limit(0);
      xos_db_install($db['DB_DATABASE'], $sql_file);

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

        $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=3" method="post">',
                              'form_end' => '</form>',
                              'db_error' => $db_error,
                              'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                              'hidden_fields' => $hidden_fields));
                            
      } else {

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

        $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=4" method="post">',
                              'form_end' => '</form>',
                              'configure_also' => xos_in_array('configure', $_POST['install']) ? true : false,
                              'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                              'hidden_fields' => $hidden_fields));
      }       
    } else {  
      $smarty->assign('fatal_error', true);    
    }
   
    $smarty->configLoad('languages/' . $_POST['language_file_name'] . '.conf', 'install_db');
    $smarty->configLoad('configuration/config.conf');  
    $smarty->display('install_db.tpl');
  }    
?>