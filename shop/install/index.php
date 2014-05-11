<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : index.php
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
//              filename: index.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  if (basename(dirname(getenv('SCRIPT_FILENAME'))) !== 'install') {
    header("HTTP/1.1 404 Not Found");
    die('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"><head><meta http-equiv="content-type" content="text/html; charset=UTF-8" /><title>404 Not Found</title></head><body><h1>Not Found</h1>The requested document was not found on this server.<p></p><hr /><address>Web Server at ' . getenv('SERVER_NAME') . '</address></body></html>');    
  }

  error_reporting(E_ALL & ~E_NOTICE);

  require('includes/functions/general.php');
  require('includes/functions/html_output.php');
  require('includes/classes/language.php');

  header('Content-Type:text/html; charset=utf-8');
  header('X-UA-Compatible: IE=edge,chrome=1');
  
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
    
// set the language   
  $lng = new language();

  if (isset($_GET['lang']) && ($_GET['lang'] != '') && (strtolower($_GET['lang']) != 'null') && (strlen(trim($_GET['lang'])) > 0)) {
    $lng->set_language($_GET['lang']);
  } else {
    $lng->get_browser_language();
  }

  $hidden_fields = '';
  $hidden_fields .= xos_draw_hidden_field('language_code', $lng->language['code']);
  $hidden_fields .= xos_draw_hidden_field('language_name', $lng->language['name']);
  $hidden_fields .= xos_draw_hidden_field('language_image', $lng->language['image']);
  $hidden_fields .= xos_draw_hidden_field('language_file_name', $lng->language['file_name']);
  $hidden_fields .= xos_draw_hidden_field('language_directory', $lng->language['directory']);

// Define the admin template
  define('INSTALL_TPL', 'xos-shop_install_default_v1.0.7');
  
// require the smarty class and create an instance
  require('../smarty/Smarty-3.1.18/Smarty.class.php');  
  $smarty = new Smarty(); 
  $smarty->template_dir = 'templates/' . INSTALL_TPL . '/';
  $smarty->config_dir = 'templates/' . INSTALL_TPL . '/';
  $smarty->compile_dir = 'templates_c/';

  $smarty->assign(array('css_path' => 'templates/' . INSTALL_TPL . '/',
                        'images_path' => 'templates/' . INSTALL_TPL . '/images/',
                        'buttons_path' => 'templates/' . INSTALL_TPL . '/images/' . $lng->language['directory'] . '/buttons/'));

  if (!function_exists('version_compare') || version_compare(PHP_VERSION, '5.2.0', '<')) {
    $smarty->assign('php_ver_warning', true); 
  } else {                           
    if (extension_loaded('gd')) {     
      $ver_info = gd_info();
      preg_match('/\d/', $ver_info['GD Version'], $match);              
      $gd_ver = $match[0];
    } else {
      $gd_ver = false;
    } 
        
    $smarty->assign(array('register_globals' => (bool)ini_get('register_globals') ? 'On' : 'Off',
                          'file_uploads' => (bool)ini_get('file_uploads') ? 'On' : 'Off',
                          'session_auto_start' => (bool)ini_get('session.auto_start') ? 'On' : 'Off',
                          'session_use_trans_sid' =>(bool)ini_get('session.use_trans_sid') ? 'On' : 'Off',
                          'extension_gd_loaded' => $gd_ver ? $gd_ver >= 2 ? '2' : '1' : 'not_loaded',
                          'extension_openssl_loaded' => extension_loaded('openssl') ? 'loaded' : 'not_loaded',
                          'extension_curl_loaded' => extension_loaded('curl') ? 'loaded' : 'not_loaded',
                          'extension_mysql_loaded' => extension_loaded('mysql') ? 'loaded' : 'not_loaded'));   
  }
  
  $smarty->assign(array('form_begin' => '<form name="install" action="install.php" method="post">',
                        'form_end' => '</form>',
                        'php_version' => PHP_VERSION,
                        'hidden_fields' => $hidden_fields));
    
  $smarty->configLoad('languages/' . $lng->language['file_name'] . '.conf', 'index');
  $smarty->configLoad('configuration/config.conf');  
  $smarty->display('index.tpl');
?>