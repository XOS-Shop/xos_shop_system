<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : install.php
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
//              Copyright (c) 2002 osCommerce
//              filename: install.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  if (basename(dirname(getenv('SCRIPT_FILENAME'))) !== 'install') {
    header("HTTP/1.1 404 Not Found");
    die('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"><head><meta http-equiv="content-type" content="text/html; charset=UTF-8" /><title>404 Not Found</title></head><body><h1>Not Found</h1>The requested document was not found on this server.<p></p><hr /><address>Web Server at ' . getenv('SERVER_NAME') . '</address></body></html>');    
  }

  error_reporting(E_ALL & ~E_NOTICE);

  if (!isset($_POST['language_file_name'])) {
    header('Location:' . str_replace(stristr($_SERVER['PHP_SELF'], 'install.php'), 'index.php', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']));
    exit;
  }

  if (class_exists('mysqli') && version_compare(PHP_VERSION, '5.3.0', '>=')) {
    require('includes/functions/database_mysqli.php');
  } else {
    require('includes/functions/database_mysql.php'); 
  }  

  require('includes/functions/general.php'); 
  require('includes/functions/html_output.php');
  @include('../includes/configure.php');
  
  header('Content-Type:text/html; charset=utf-8');
  header('X-UA-Compatible: IE=edge,chrome=1');
   
  if(defined('ADMIN_DIR_NAME') && ADMIN_DIR_NAME !== 'default_dir_name') { 
    $admin_dir_name = ADMIN_DIR_NAME;    
  } else { 
    $admin_dir_name = 'admin';
  }      
    
// set default timezone if none exists (PHP 5.3 throws an E_WARNING)
  if ((strlen(ini_get('date.timezone')) < 1) && function_exists('date_default_timezone_set')) {
    date_default_timezone_set(@date_default_timezone_get());
  }  

// check if the templates_c directory exists and is writeable 
  if (is_dir(dirname(getenv('SCRIPT_FILENAME')) . '/templates_c')) {
    if (!is_writable(dirname(getenv('SCRIPT_FILENAME')) . '/templates_c')) die('<br /><br /><span style="color : #ff0000;"><b>Error!</b></span><br /><br />The ' . dirname(getenv('SCRIPT_NAME')) . '/<b>templates_c</b> directory is not writeable!<br />The directory need to have the permission set to (chmod 775). If (chmod 775) does not work, please try (chmod 777).<br /><br />');
  } else {
    die('<br /><br /><span style="color : #ff0000;"><b>Error!</b></span><br /><br />The ' . dirname(getenv('SCRIPT_NAME')) . '/<b>templates_c</b> directory does not exist!<br />Create the missing directory on your webserver, or transfer it to an FTP program such as from your computer to the web server.<br /><br />');
  }
  
// check if the admin directory exists
  if (!is_dir('../' . $admin_dir_name)) {
    die('<br /><br /><span style="color : #ff0000;"><b>Error!</b></span><br /><br />The ' . str_replace('install/install.php', '', getenv('SCRIPT_NAME')) . '<b>' . $admin_dir_name . '</b> directory does not exist!<br />Please correct the above errors and retry the installation procedure with the changes in place.<br /><br />');
  }  

// Define the admin template
  define('INSTALL_TPL', 'xos-shop_install_default_v1.0.7');
  
// require the smarty class and create an instance
  require('../smarty/Smarty-3.1.18/Smarty.class.php');  
  $smarty = new Smarty(); 
  $smarty->template_dir = 'templates/' . INSTALL_TPL . '/';
  $smarty->config_dir = 'templates/' . INSTALL_TPL . '/';
  $smarty->compile_dir = 'templates_c/';

  $smarty->assign(array('css_path' => 'templates/' . INSTALL_TPL . '/',
                        'js_path' => 'templates/' . INSTALL_TPL . '/',
                        'images_path' => 'templates/' . INSTALL_TPL . '/images/',
                        'buttons_path' => 'templates/' . INSTALL_TPL . '/images/' . $_POST['language_directory'] . '/buttons/'));  

  switch ($_GET['step']) {
    case '2':
      if (xos_in_array('database', $_POST['install'])) {
        $page_contents = 'install_2.php';
      } elseif (xos_in_array('configure', $_POST['install'])) {
        $page_contents = 'install_4.php';
      } else {
        $page_contents = 'install_1.php';
      }
      break;
    case '3':
      if (xos_in_array('database', $_POST['install'])) {
        $page_contents = 'install_3.php';
      } else {
        $page_contents = 'install_1.php';
      }
      break;
    case '4':
      if (xos_in_array('configure', $_POST['install'])) {
        $page_contents = 'install_4.php';
      } else {
        $page_contents = 'install_1.php';
      }
      break;
    case '5':
      if (xos_in_array('configure', $_POST['install'])) {
        $page_contents = 'install_5.php';
      } else {
        $page_contents = 'install_1.php';
      }
      break;
    case '6':
      if (xos_in_array('configure', $_POST['install'])) {
        $page_contents = 'install_6.php';
      } else {
        $page_contents = 'install_1.php';
      }
      break;
    default:
      $page_contents = 'install_1.php';
  }

  $smarty->configLoad('languages/' . $_POST['language_file_name'] . '.conf', substr($page_contents, 0, -4));
  $smarty->configLoad('configuration/config.conf');
      
  require('includes/' . $page_contents);
  
  $smarty->display('install.tpl');  
?>
