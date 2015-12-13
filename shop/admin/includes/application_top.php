<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : application_top.php
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
//              filename: application_top.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

// Define the admin template
  define('ADMIN_TPL', 'admin_lte');

// Start the clock for the page parse time log
  define('PAGE_PARSE_START_TIME', microtime());

// Set the length of the redeem code, the longer the more secure
  define('SECURITY_CODE_LENGTH', '8');

// Set the level of error reporting
  ini_set('display_errors', true);
  error_reporting(E_ALL & ~E_NOTICE);

//  
  header('Content-Type: text/html; charset=utf-8');
  header('X-UA-Compatible: IE=edge,chrome=1');

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');
  
// Include application configuration parameters
  require('../includes/configure.php');  
  
  @include(DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/configuration/config.php');  

// set the type of request (secure or not)
  $request_type = (((isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1'))) ||
                    (isset($_SERVER['HTTP_X_FORWARDED_BY']) && strpos(strtoupper($_SERVER['HTTP_X_FORWARDED_BY']), 'SSL') !== false) ||
                    (isset($_SERVER['HTTP_X_FORWARDED_HOST']) && strpos(strtoupper($_SERVER['HTTP_X_FORWARDED_HOST']), 'SSL') !== false) ||
                    (isset($_SERVER['HTTP_X_FORWARDED_HTTPS']) && ($_SERVER['HTTP_X_FORWARDED_HTTPS'] == 'on' || strtolower($_SERVER['HTTP_X_FORWARDED_HTTPS']) == '1')) ||                 
                    (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && ($_SERVER['HTTP_X_FORWARDED_SSL'] == 'on' || strtolower($_SERVER['HTTP_X_FORWARDED_SSL']) == '1')) ||
                    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && (strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'ssl' || strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https')) ||
                    (isset($_SERVER['HTTP_SSLSESSIONID']) && $_SERVER['HTTP_SSLSESSIONID'] != '') ||
                    (isset($_SERVER['SCRIPT_URI']) && strtolower(substr($_SERVER['SCRIPT_URI'], 0, 6)) == 'https:') ||                    
                    (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443')) ? 'SSL' : 'NONSSL';

// Define the absulute maximum size for large product images
  define('ABSULUTE_MAXIMUM_WIDTH_FOR_LARGE_PRODUCT_IMAGES', '1200');
  define('ABSULUTE_MAXIMUM_HEIGHT_FOR_LARGE_PRODUCT_IMAGES', '1000');  

// Define the project version
  define('PROJECT_VERSION', 'XOS-Shop version 1.0.1');
  
// Define the project title
  define('PROJECT_TITLE', 'XOS-Shop');

// Define the project logo
  define('PROJECT_LOGO', 'xos-shop_project_logo.gif');
  
  define('WYSIWYG_FOR_PAGES', 'true');
  define('WYSIWYG_FOR_INFO_PAGES', 'true');
  define('WYSIWYG_FOR_NEWSLETTER', 'true');
  define('WYSIWYG_FOR_PRODUCT', 'true');
  define('WYSIWYG_FOR_CATEGORY', 'true'); 
  define('WYSIWYG_FOR_BANNER_MANAGER', 'true');

  define('MAX_DISPLAY_RESULTS', 20);

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// customization for the design layout
  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

// Define how do we update currency exchange rates
// Possible values are 'oanda' 'xe' or ''
  define('CURRENCY_SERVER_PRIMARY', 'oanda');
  define('CURRENCY_SERVER_BACKUP', 'xe');

// include the database functions and make a connection to the database
  if (class_exists('mysqli') && version_compare(PHP_VERSION, '5.3.0', '>=')) {
    require(DIR_WS_FUNCTIONS . 'database_mysqli.php');
    xos_db_connect();
  } else { 
    require(DIR_WS_FUNCTIONS . 'database_mysql.php');
    xos_db_connect() or die('Unable to connect to database server!');
  }     

// set application wide parameters
  $configuration_query = xos_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = xos_db_fetch_array($configuration_query)) {
    if ($configuration['cfgKey'] == 'SESSION_FORCE_COOKIE_USE' && $configuration['cfgValue'] == 'true' && ENABLE_SSL == 'true' && HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
      define($configuration['cfgKey'], 'false'); 
    } else {
      define($configuration['cfgKey'], $configuration['cfgValue']);
    }     
  }
    
// require the smarty class and create an instance
  require(DIR_FS_SMARTY . 'Smarty-3.1.27/Smarty.class.php');  
  $smarty = new Smarty();
  $smarty->setTemplateDir(DIR_FS_SMARTY . 'admin/templates/');
  $smarty->setCompileDir(DIR_FS_SMARTY . 'admin/templates_c/');
  $smarty->setConfigDir(DIR_FS_SMARTY . 'admin/');
  $smarty->setCacheDir(DIR_FS_SMARTY . 'admin/cache/');
  $smarty->left_delimiter = '[@{';
  $smarty->right_delimiter = '}@]';
  
// and create an smarty instance for cache control  
  $smarty_cache_control = new Smarty();
  $smarty_cache_control->setCompileDir(DIR_FS_SMARTY . 'catalog/templates_c/');
  $smarty_cache_control->setCacheDir(DIR_FS_SMARTY . 'catalog/cache/');       

// if gzip_compression is enabled, start to buffer the output 
  if ( (GZIP_COMPRESSION == 'true') && ($_GET['action'] != 'download') && ($_GET['action'] != 'backupnow') && ($ext_zlib_loaded = extension_loaded('zlib'))) {
    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
        ob_start('ob_gzhandler');
    } else {
      ini_set('zlib.output_compression_level', GZIP_LEVEL);
    }
  } 

// set the cookie domain
  $cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
  
// set the cookie path
  $cookie_path = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);  

// define our general functions used application-wide 
  if (!(@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/functions/general.php')) {
    require(DIR_WS_FUNCTIONS . 'general.php');
  }
    
  require(DIR_WS_FUNCTIONS . 'html_output.php');
  require(DIR_WS_FUNCTIONS . 'password_funcs.php'); 
// initialize the logger class
  require(DIR_WS_CLASSES . 'logger.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  xos_session_name('XOSsidAdmin');
  xos_session_save_path(SESSION_WRITE_DIRECTORY != '' ? SESSION_WRITE_DIRECTORY : DIR_FS_TMP);

// set the session cookie parameters
  ini_set('session.cookie_lifetime', '0');
  ini_set('session.cookie_path', $cookie_path);
  ini_set('session.cookie_domain', $cookie_domain);
  ini_set('session.use_only_cookies', (SESSION_FORCE_COOKIE_USE == 'true') ? 1 : 0);        

// start the session
  if (!isset($_COOKIE[session_name()]) && isset($_GET[session_name()])) setcookie(session_name(), $_GET[session_name()], 0, $cookie_path, $cookie_domain);
  xos_session_start();

// Define the SESSID 
  define('SESSID', empty($_COOKIE[session_name()]) ? xos_session_name() . '=' . xos_session_id() : '');

//  if ($session_started && !preg_match('/^(?:(?:[a-zA-Z0-9,-]{26})|(?:[a-zA-Z0-9,-]{32}))$/i', session_id())) session_regenerate_id(true);
  if ($session_started && !preg_match('/^[a-zA-Z0-9,-]{22,40}$/i', session_id())) session_regenerate_id(true);  

// set the language
  if (!isset($_SESSION['language']) || isset($_GET['lnc'])) {
  
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();  

    if (isset($_GET['lnc']) && xos_not_null($_GET['lnc'])) {
      $lng->set_language($_GET['lnc']);
    } else {
      $lng->get_browser_language();
    }

    $_SESSION['language'] = $lng->language['directory'];
    $_SESSION['languages_id'] = $lng->language['id'];
    $_SESSION['languages_code'] = $lng->language['code'];
    
    if ($lng->language['use_in_id'] == 1) {  
      $_SESSION['used_lng_id'] = xos_get_languages_id(DEFAULT_LANGUAGE);
    } else {
      $_SESSION['used_lng_id'] = $lng->language['id'];
    }
  } 

// include the language translations
  require(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '.php');
  $current_page = basename($_SERVER['PHP_SELF']);
  if (file_exists(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/' . $current_page)) {
    include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/' . $current_page);
  }

// define our localization functions
  require(DIR_WS_FUNCTIONS . 'localization.php');

// Include validation functions (right now only email address)
  require(DIR_WS_FUNCTIONS . 'validations.php');

// initialize the message stack for output messages
  if (!(@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/classes/message_stack.php')) {
    require(DIR_WS_CLASSES . 'message_stack.php');
  }
  $messageStack = new messageStack;

// initialize configuration modules
  require(DIR_WS_CLASSES . 'cfg_modules.php');
  $cfgModules = new cfg_modules();

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// entry/item info classes
  require(DIR_WS_CLASSES . 'object_info.php');

// include the mail class  
  require(DIR_WS_CLASSES . 'mailer.php');

// file uploading class
  require(DIR_WS_CLASSES . 'upload.php');

// calculate category path
  if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
  } else {
    $cPath = '';
  }

  if (xos_not_null($cPath)) {
    $cPath_array = xos_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $current_page_id = $cPath_array[(sizeof($cPath_array)-1)];
  } else {
    $current_category_id = $current_page_id = 0;
  }

// default open navigation box
//  if (!isset($_SESSION['selected_box'])) {
//    $_SESSION['selected_box'] = 'configuration';
//  }

  if (isset($_GET['selected_box'])) {
    $_SESSION['selected_box'] = $_GET['selected_box'];
  }

// check if a default currency is set
  if (!defined('DEFAULT_CURRENCY')) {
    $messageStack->add('header', ERROR_NO_DEFAULT_CURRENCY_DEFINED, 'error');
  }

// check if a default language is set
  if (!defined('DEFAULT_LANGUAGE')) {
    $messageStack->add('header', ERROR_NO_DEFAULT_LANGUAGE_DEFINED, 'error');
  }

  if (function_exists('ini_get') && ((bool)ini_get('file_uploads') == false) ) {
    $messageStack->add('header', WARNING_FILE_UPLOADS_DISABLED, 'warning');
  }

// warn the admin if the site is offline
  if (SITE_OFFLINE == 'true') {
    $messageStack->add('header', WARNING_SITE_IS_OFFLINE, 'warning');
  }

// check if the 'install' directory exists, and warn of its existence
  if (file_exists(DIR_FS_DOCUMENT_ROOT . 'install')) {
    $messageStack->add('header', WARNING_INSTALL_DIRECTORY_EXISTS, 'warning');
  }

// check if the configure.php file is writeable  
  if ( (file_exists(DIR_FS_CATALOG . 'includes/configure.php')) && (is_writable(DIR_FS_CATALOG . 'includes/configure.php')) ) {
    $messageStack->add('header', WARNING_CONFIG_FILE_WRITEABLE, 'warning');
  }  

  if (basename($_SERVER['PHP_SELF']) == FILENAME_LOGIN || basename($_SERVER['PHP_SELF']) == FILENAME_PASSWORD_FORGOTTEN) {
    if (!defined('SECURITY_CHECK')) {
      header("HTTP/1.1 404 Not Found");
      header("Status: 404 Not Found");
      die('<!DOCTYPE html><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1>The requested document was not found on this server.<p></p><hr /><address>Web Server at ' . HTTP_SERVER . '</address></body></html>');   
    }
  } else {
    xos_admin_check_login();
  }
  
  $smarty->compile_check = false;
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'general');     
  $smarty->configLoad('templates/' . ADMIN_TPL . '/includes/configuration/config.conf'); 
//  $smarty->loadFilter('output','trimwhitespace');
  $smarty->assign(array('images_path' => DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/',
                        'request_type' => $request_type,
                        'project_title' => PROJECT_TITLE,
                        'project_logo' => PROJECT_LOGO,
                        'end_tags' => (DISPLAY_PAGE_PARSE_TIME == 'true' && STORE_PAGE_PARSE_TIME == 'true' ? '' : "</body>\n</html>"),
                        'nl' => "\n")); 
?>
