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
  
// set default timezone if none exists (PHP 5.3 throws an E_WARNING)
  if (strlen(ini_get('date.timezone')) < 1) {
    date_default_timezone_set(@date_default_timezone_get());
  }
  
// start the timer for the page parse time log
  define('PAGE_PARSE_START_TIME', microtime(true));

// define which tax description should be displayed
  define('FULL_TAX_INFO', 'false');

// Set the length of the redeem code, the longer the more secure
  define('SECURITY_CODE_LENGTH', '8');  

// define the update interval after a new order (0 = immediately, 1 = one day, 2 = two days, ...)
  define('UPDATE_INTERVAL_AFTER_NEW_ORDER', '1');

//
  define('INTERVAL_DAYS_BACK', '30'); 

//
  define('MUST_ACCEPT_CONDITIONS', 'true');  
  
// Set the level of error reporting
  ini_set('display_errors', true);
  error_reporting(E_ALL & ~E_NOTICE);

//  
  $pieces = explode('.php',$_SERVER['PHP_SELF']);
  $_SERVER['BASENAME_PHP_SELF'] = basename($pieces[0]) . '.php';  
  
//  
  header('Content-Type: text/html; charset=utf-8');
  if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) header('X-UA-Compatible: IE=edge,chrome=1');  
 
// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');

// include server parameters
  require('includes/configure.php');  

// include the registry class
  require(DIR_WS_CLASSES . 'registry.php'); 
  
// Use Crawler Detect - a web crawler detection library | https://github.com/JayBizzle/Crawler-Detect
  require(DIR_WS_CLASSES . 'crawler_detect/CrawlerDetect.php'); 
  $CrawlerDetect = new CrawlerDetect;  
   
  if (strlen(DB_SERVER) < 1) {
    if (is_dir('install')) {
      header('Location: install/index.php');
    }
  }

// define the project version
  define('PROJECT_VERSION', 'XOS-Shop version 1.0.5');

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

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// include the database functions "mysqli" and make a connection to the database
  require(DIR_WS_FUNCTIONS . 'database_mysqli.php');
  xos_db_connect();

// include the database class "PDO", create an instance and register it
  require(DIR_WS_CLASSES . 'Db.class.php'); 
  Registry::set( 'DB', new Db());
  $DB = Registry::get('DB'); 
  
// set the application parameters
  $configuration_query = $DB->query
  (
   "SELECT configuration_key   AS cfgKey,
           configuration_value AS cfgValue
    FROM   " . TABLE_CONFIGURATION
  );
  
  while ($configuration = $configuration_query->fetch()) {
    if (($configuration['cfgKey'] == 'SESSION_FORCE_COOKIE_USE' || $configuration['cfgKey'] == 'SESSION_RECREATE') && $configuration['cfgValue'] == 'true' && ENABLE_SSL == 'true' && HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
      define($configuration['cfgKey'], 'false'); 
    } else {
      define($configuration['cfgKey'], $configuration['cfgValue']);
    }    
  }

// Define directory and filename of the page parse time log
  define('STORE_PAGE_PARSE_TIME_LOG', STORE_PAGE_PARSE_TIME_LOG_PATH != '' ? STORE_PAGE_PARSE_TIME_LOG_PATH . 'page_parse_time_' . date('Y-m-d') .'.log' : DIR_FS_LOGS . 'page_parse_time_' . date('Y-m-d') .'.log');
  
// require the smarty class and create an instance
  require(DIR_FS_SMARTY . 'Smarty-3.1.30/Smarty.class.php');  
  $smarty = new Smarty();
  $smarty->setTemplateDir(DIR_FS_SMARTY . 'catalog/templates/');
  $smarty->setCompileDir(DIR_FS_SMARTY . 'catalog/templates_c/');
  $smarty->setConfigDir(DIR_FS_SMARTY . 'catalog/');
  $smarty->setCacheDir(DIR_FS_SMARTY . 'catalog/cache/');   
  $smarty->left_delimiter = '[@{';
  $smarty->right_delimiter = '}@]';        

  // set the HTTP GET parameters manually if search_engine_friendly_urls is enabled
  if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
    if (strlen(getenv('PATH_INFO')) > 1) {
      $GET_array = array();
      $vars = explode('/', substr(getenv('PATH_INFO'), 1));
      for ($i=0, $n=sizeof($vars)-1; $i<$n; $i++) {
        if (strpos($vars[$i], '[]')) {
          $GET_array[substr($vars[$i], 0, -2)][] = $vars[$i+1];
        } else {
          $vars[$i+1] = str_replace(array('_.~', '~._'), array('/', '\\'), $vars[$i+1]);          
          ($vars[$i+1] == '^') ? $_GET[$vars[$i]] = ' ' : $_GET[$vars[$i]] = $vars[$i+1];
        }
        $i++;
      }

      if (sizeof($GET_array) > 0) {
        while (list($key, $value) = each($GET_array)) {
          $_GET[$key] = $value;
        }
      }
    }
  }
  
  if (!empty($_GET['go'])) {
    $_GET['lnc'] = $_GET['go'];
    unset($_GET['go']);
  }  

// if gzip_compression is enabled, start to buffer the output 
  if ( (GZIP_COMPRESSION == 'true') && ($_SERVER['BASENAME_PHP_SELF'] != FILENAME_DOWNLOAD) && ($_SERVER['BASENAME_PHP_SELF'] != FILENAME_CAPTCHA) && ($ext_zlib_loaded = extension_loaded('zlib'))) {
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
  
// define general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');
 
// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  xos_session_name('XOSsid');
  xos_session_save_path(SESSION_WRITE_DIRECTORY != '' ? SESSION_WRITE_DIRECTORY : DIR_FS_TMP);

// set the session cookie parameters
  ini_set('session.cookie_lifetime', '0');
  ini_set('session.cookie_path', $cookie_path);
  ini_set('session.cookie_domain', $cookie_domain);
  ini_set('session.use_only_cookies', (SESSION_FORCE_COOKIE_USE == 'true') ? 1 : 0);  

/*
// set the session ID if it exists
   if (isset($_POST[xos_session_name()])) {
     xos_session_id($_POST[xos_session_name()]);
   } elseif ( ($request_type == 'SSL') && isset($_GET[xos_session_name()]) ) {
     xos_session_id($_GET[xos_session_name()]);
   }
*/

// start the session
  $session_started = false;
  if (SESSION_FORCE_COOKIE_USE == 'true') {
    if (!isset($_COOKIE['cookie_test'])) {  
      setcookie('cookie_test', 'please_accept_for_session', 0, $cookie_path, $cookie_domain);
    } else {
      if (!isset($_COOKIE[session_name()]) && isset($_GET[session_name()])) setcookie(session_name(), $_GET[session_name()], 0, $cookie_path, $cookie_domain);
      xos_session_start();
      $session_started = true;
    }
  } elseif (SESSION_BLOCK_SPIDERS == 'true') {
    $spider_flag = false;

    // Check the user agent of the current 'visitor'
    if($CrawlerDetect->isCrawler()) {
      // true if crawler user agent detected
      $spider_flag = true;	
    }
    
    if ($spider_flag == false) {
      if ((!isset($_COOKIE[session_name()]) && isset($_GET[session_name()])) || (isset($_COOKIE[session_name()]) && isset($_GET[session_name()]) && $request_type == 'SSL' && ENABLE_SSL == 'true' && $_COOKIE[session_name()] != $_GET[session_name()] && HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN)) setcookie(session_name(), $_GET[session_name()], 0, $cookie_path, $cookie_domain);
      xos_session_start();
      $session_started = true;
    } else {
      if (isset($_GET[session_name()])) {
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        die('<!DOCTYPE html><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1>The requested document was not found on this server.<p></p><hr /><address>Web Server at ' . HTTP_SERVER . '</address></body></html>');
      }
    }
  } else {
    if ((!isset($_COOKIE[session_name()]) && isset($_GET[session_name()])) || (isset($_COOKIE[session_name()]) && isset($_GET[session_name()]) && $request_type == 'SSL' && ENABLE_SSL == 'true' && $_COOKIE[session_name()] != $_GET[session_name()] && HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN)) setcookie(session_name(), $_GET[session_name()], 0, $cookie_path, $cookie_domain);
    xos_session_start();
    $session_started = true;
  }

// Define the SESSID 
  define('SESSID', empty($_COOKIE[session_name()]) ? xos_session_name() . '=' . xos_session_id() : '');

//  if ($session_started && !preg_match('/^(?:(?:[a-zA-Z0-9,-]{26})|(?:[a-zA-Z0-9,-]{32}))$/i', session_id())) session_regenerate_id(true);
  if ($session_started && !preg_match('/^[a-zA-Z0-9,-]{22,40}$/i', session_id())) session_regenerate_id(true); 
  
// initialize a session token
  if (!isset($_SESSION['sessiontoken'])) {
    $_SESSION['sessiontoken'] = md5(xos_rand() . xos_rand() . xos_rand() . xos_rand());
  }

// verify the ssl_session_id if the feature is enabled
  if ( ($request_type == 'SSL') && (SESSION_CHECK_SSL_SESSION_ID == 'true') && (ENABLE_SSL == 'true') && ($session_started == true) ) {
    $ssl_session_id = getenv('SSL_SESSION_ID');
    if (!isset($_SESSION['SESSION_SSL_ID'])) {
      $_SESSION['SESSION_SSL_ID'] = $ssl_session_id;
    }

    if ($_SESSION['SESSION_SSL_ID'] != $ssl_session_id) {
      setcookie(session_name(), '', time()-42000, $cookie_path, $cookie_domain);
      session_destroy();
      xos_redirect(xos_href_link(FILENAME_SSL_CHECK, '', 'NONSSL', false));
    }
  }

// verify the browser user agent if the feature is enabled
  if (SESSION_CHECK_USER_AGENT == 'true' && $session_started == true) {
    $http_user_agent = getenv('HTTP_USER_AGENT');
    if (!isset($_SESSION['SESSION_USER_AGENT'])) {
      $_SESSION['SESSION_USER_AGENT'] = $http_user_agent;
    }

    if ($_SESSION['SESSION_USER_AGENT'] != $http_user_agent) {
      setcookie(session_name(), '', time()-42000, $cookie_path, $cookie_domain);
      xos_redirect(xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
    }
  }

// verify the IP address if the feature is enabled
  if (SESSION_CHECK_IP_ADDRESS == 'true' && $session_started == true) {
    $ip_address = xos_get_ip_address();
    if (!isset($_SESSION['SESSION_IP_ADDRESS'])) {
      $_SESSION['SESSION_IP_ADDRESS'] = $ip_address;
    }

    if ($_SESSION['SESSION_IP_ADDRESS'] != $ip_address) {
      setcookie(session_name(), '', time()-42000, $cookie_path, $cookie_domain);
      xos_redirect(xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
    }
  }

// if site offline is enabled, set site offline
  if (SITE_OFFLINE == 'true') {
    if ($_SESSION['access_allowed'] != 'true' && !strpos($_SERVER['REQUEST_URI'], FILENAME_OFFLINE)) {
        xos_redirect(xos_href_link(FILENAME_OFFLINE, '', 'SSL'));
    }
  } else {
    unset($_SESSION['access_allowed']);
    if (strpos($_SERVER['REQUEST_URI'], FILENAME_OFFLINE)) xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
  }

// include the mail class 
  require(DIR_WS_CLASSES . 'mailer.php');

// set the template
  if (ALLOW_VISITORS_TO_CHANGE_TEMPLATE == 'true') { 
    $registered_tpls = explode(',', REGISTERED_TPLS);
    if (!in_array($_SESSION['tpl'], $registered_tpls) || !empty($_GET['tpl'])) {
      $tpl = $_GET['tpl'];
      if (in_array($tpl, $registered_tpls)) {
        $_SESSION['tpl'] = $tpl; 
      } else { 
        $_SESSION['tpl'] = DEFAULT_TPL;
        $_GET['tpl'] = '';    
      }       	    	         
    }    
    define('SELECTED_TPL', $_SESSION['tpl']);
  } else {
    define('SELECTED_TPL', DEFAULT_TPL);
  }

// require the language class and create an instance
  include(DIR_WS_CLASSES . 'language.php');
  $lng = new language();

// set the language
  if (!isset($_SESSION['language']) || isset($_GET['lnc'])) {

    if (isset($_GET['lnc']) && xos_not_null($_GET['lnc'])) {
      $lng->set_language($_GET['lnc']);
    } else {
      $lng->get_browser_language();
    }

    $_SESSION['language'] = $lng->language['directory'];
    $_SESSION['languages_id'] = $lng->language['id'];
    $_SESSION['languages_code'] = $lng->language['code'];
  }
  
// create the shopping cart & fix the cart if necesary
  if (!is_object($_SESSION['cart'])) {
    $_SESSION['cart'] = new shoppingCart;
  }

// include currencies class and create an instance
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();    

// include the language translations
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '.php');

// currency
  if (!isset($_SESSION['currency']) || isset($_GET['cur'])) {
    if (isset($_GET['cur']) && $currencies->is_set($_GET['cur'])) {
      $_SESSION['currency'] = $_GET['cur'];
    } else {
      $_SESSION['currency'] = DEFAULT_CURRENCY;
    }
  }
  
// set the customer_group values
  if(!isset($_SESSION['sppc_customer_group_id']) || !isset($_SESSION['sppc_customer_group_discount'])  ||  !isset($_SESSION['sppc_customer_group_show_tax'])  || !isset($_SESSION['sppc_customer_group_tax_exempt'])) {

    $check_customer_group = $DB->query
    (
     "SELECT customers_group_discount,
             customers_group_show_tax,
             customers_group_tax_exempt
      FROM   " . TABLE_CUSTOMERS_GROUPS . "
      WHERE  customers_group_id = 0"
    );
    
    $customer_group = $check_customer_group->fetch();
    
    $_SESSION['sppc_customer_group_id'] = 0;
    $_SESSION['sppc_customer_group_discount'] = $customer_group['customers_group_discount'];
    $_SESSION['sppc_customer_group_show_tax'] = (int)$customer_group['customers_group_show_tax'];
    $_SESSION['sppc_customer_group_tax_exempt'] = (int)$customer_group['customers_group_tax_exempt'];    

  }

// set the customer_group_id  
  $customer_group_id = $_SESSION['sppc_customer_group_id'];
  
// navigation history
  if (!is_object($_SESSION['navigation'])) {
    $_SESSION['navigation'] = new navigationHistory;
  }
  
  if (isset($_GET['rmp'])) {
    $_SESSION['navigation']->remove_page((int)$_GET['rmp']);
    unset($_GET['rmp']);
  }  
  
  $_SESSION['navigation']->add_current_page(); 

// Shopping cart actions
  if (isset($_GET['action'])) {
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
      xos_redirect(xos_href_link(FILENAME_COOKIE_USAGE));
    }

    if (DISPLAY_CART == 'true' || $_SESSION['javascript_enabled'] != 'true') {
      $goto =  FILENAME_SHOPPING_CART;
      $parameters = array('action', 'c', 'p', 'pid');
    } else {
      $goto = $_SERVER['BASENAME_PHP_SELF'];
      if ($_GET['action'] == 'buy_now' && $_SERVER['BASENAME_PHP_SELF'] != FILENAME_PRODUCT_REVIEWS && $_SERVER['BASENAME_PHP_SELF'] != FILENAME_PRODUCT_REVIEWS_INFO && $_SERVER['BASENAME_PHP_SELF'] != FILENAME_PRODUCT_REVIEWS_WRITE) {
        $parameters = array('action', 'pid', 'p');
      } else {
        $parameters = array('action', 'pid');
      }
    }
    switch ($_GET['action']) {
      // customer wants to update the product quantity in their shopping cart and product listings
      case 'update_product' : for ($i=0, $n=sizeof($_POST['p']); $i<$n; $i++) {
                                if (in_array($_POST['p'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
                                  $_SESSION['cart']->remove($_POST['p'][$i]);
                                } else {
                                  $attributes = ($_POST['id'][$_POST['p'][$i]]) ? $_POST['id'][$_POST['p'][$i]] : '';
                                  $_SESSION['cart']->add_cart($_POST['p'][$i], $_POST['cart_quantity'][$i], $attributes, false);
                                }
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params($parameters)));
                              break;
      // customer adds a product from the products page
      case 'add_product' :    if (isset($_POST['p']) && is_numeric($_POST['p'])) {
                                if (xos_has_product_attributes($_POST['p']) && $_SERVER['BASENAME_PHP_SELF'] != FILENAME_PRODUCT_INFO) {
                                  xos_redirect(xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $_POST['p'] . (isset($_GET['m']) ? '&m=' . $_GET['m'] : '')), false);
                                } else {
                                  $attributes = isset($_POST['id']) ? $_POST['id'] : '';                               
                                  $_SESSION['cart']->add_cart($_POST['p'], $_SESSION['cart']->get_quantity(xos_get_uprid($_POST['p'], $attributes))+($_POST['products_quantity']), $attributes);
                                }  
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params($parameters)), false);
                              break;
      // performed by the 'buy now' button in products new listing and review page
      case 'buy_now' :        if (isset($_GET['p'])) {
                                if (xos_has_product_attributes($_GET['p'])) {
                                  xos_redirect(xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $_GET['p'] . (isset($_GET['m']) ? '&m=' . $_GET['m'] : '')));
                                } else {
                                  $_SESSION['cart']->add_cart($_GET['p'], $_SESSION['cart']->get_quantity($_GET['p'])+1);
                                }
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params($parameters)));
                              break;
      // customer wants to remove the product in their shopping cart
      case 'remove_product' : if (isset($_GET['p'])) {
                                  $_SESSION['cart']->remove($_GET['p']);
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params(array('action', 'p')) . $goto ==  FILENAME_SHOPPING_CART ? 'rmp=0' : ''));
                              break;                              
      case 'notify' :         if (isset($_SESSION['customer_id'])) {
                                if (isset($_GET['p'])) {
                                  $notify = $_GET['p'];
                                } elseif (isset($_GET['notify'])) {
                                  $notify = $_GET['notify'];
                                } elseif (isset($_POST['notify'])) {
                                  $notify = $_POST['notify'];
                                } else {
                                  xos_redirect(xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('action', 'notify'))));
                                }
                                if (!is_array($notify)) $notify = array($notify);
                                
                                $check_query = $DB->prepare
                                (
                                 "SELECT Count(*) AS count
                                  FROM   " . TABLE_PRODUCTS_NOTIFICATIONS . "
                                  WHERE  products_id = :notify
                                  AND    customers_id = :customer_id"
                                );
                                
                                $insert_products_notifications_query = $DB->prepare
                                (
                                 "INSERT INTO " . TABLE_PRODUCTS_NOTIFICATIONS . "
                                              (
                                              products_id,
                                              customers_id,
                                              date_added
                                              )
                                              VALUES
                                              (
                                              :notify,
                                              :customer_id,
                                              now()
                                              )"
                                );                                
                                                                  
                                for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
                                  
                                  $DB->perform($check_query, array(':notify' => $notify[$i],
                                                                   ':customer_id' => (int)$_SESSION['customer_id']));  
                                                                             
                                  $check = $check_query->fetch();
                                  if ($check['count'] < 1 && $notify[$i] != '') {
                                    
                                    $DB->perform($insert_products_notifications_query, array(':notify' => $notify[$i],
                                                                                             ':customer_id' => (int)$_SESSION['customer_id']));  
                                                                                                                                
                                  }
                                }
                                xos_redirect(xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('action', 'notify'))));
                              } else {
                                $_SESSION['navigation']->set_snapshot();
                                xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'notify_remove' :  if (isset($_SESSION['customer_id']) && isset($_GET['p'])) {
      
                                $check_query = $DB->prepare
                                (
                                 "SELECT Count(*) AS count
                                  FROM   " . TABLE_PRODUCTS_NOTIFICATIONS . "
                                  WHERE  products_id = :p
                                  AND    customers_id = :customer_id"
                                );
                                
                                $DB->perform($check_query, array(':p' => $_GET['p'],
                                                                 ':customer_id' => (int)$_SESSION['customer_id']));
                                                                                                  
                                $check = $check_query->fetch();
                                if ($check['count'] > 0) {  
                                                                
                                  $delete_products_notifications_query = $DB->prepare
                                  (
                                   "DELETE
                                    FROM   " . TABLE_PRODUCTS_NOTIFICATIONS . "
                                    WHERE  products_id = :p
                                    AND    customers_id = :customer_id"
                                  );
                                  
                                  $DB->perform($delete_products_notifications_query, array(':p' => $_GET['p'],
                                                                                           ':customer_id' => (int)$_SESSION['customer_id']));
                                                                                                   
                                }
                                xos_redirect(xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('action'))));
                              } else {
                                $_SESSION['navigation']->set_snapshot();
                                xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'cust_order' :     if (isset($_SESSION['customer_id']) && isset($_GET['pid'])) {
                                if (xos_has_product_attributes($_GET['pid'])) {
                                  xos_redirect(xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $_GET['pid']));
                                } else {
                                  $_SESSION['cart']->add_cart($_GET['pid'], $_SESSION['cart']->get_quantity($_GET['pid'])+1);
                                }
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params($parameters)));
                              break;
    }
  }

// update stats products_viewed
  if ($_SERVER['BASENAME_PHP_SELF'] == FILENAME_PRODUCT_INFO && !empty($_GET['p'])) {
  
    $insert_products_stats_query = $DB->prepare
    (
     "INSERT INTO " . TABLE_PRODUCTS_STATS . "
                  (
                  products_id,
                  language_id,
                  products_viewed
                  )
                  VALUES
                  (
                  :p,
                  :languages_id,
                  '1'
                  )
      ON          DUPLICATE KEY
      UPDATE      products_viewed = products_viewed+1" 
    );
    
    $DB->perform($insert_products_stats_query, array(':p' => $_GET['p'],
                                                     ':languages_id' => (int)$_SESSION['languages_id']));
    
  }  

// include the who's online functions
  if (!(in_array($_SERVER['BASENAME_PHP_SELF'], array(FILENAME_CSS, FILENAME_JS, FILENAME_TEST)))) {
    require(DIR_WS_FUNCTIONS . 'whos_online.php');
    xos_update_whos_online();
  }  

// include the password crypto functions
  require(DIR_WS_FUNCTIONS . 'password_funcs.php');

// include validation functions (right now only email address)
  require(DIR_WS_FUNCTIONS . 'validations.php');

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// action recorder
  require(DIR_WS_CLASSES . 'action_recorder.php');

// auto activate and expire banners
  require(DIR_WS_FUNCTIONS . 'banner.php');
  xos_activate_banners();
  xos_expire_banners();

// auto expire special products
// auto update products date available
// reset new order date and clear all cache
  require(DIR_WS_FUNCTIONS . 'reset_and_update.php');
  xos_expire_specials();
  xos_update_products_date_available();
  if (CACHE_LEVEL > 0 && NEW_ORDER == 'true') xos_update_new_order_date();   

// calculate category path
  if (isset($_GET['c'])) {
    $cPath = $_GET['c'];
  } elseif (isset($_GET['p']) && !isset($_GET['m'])) {
    $cPath = xos_get_product_path($_GET['p']);
  } else {
    $cPath = '';
  }

  if (xos_not_null($cPath)) {
    $cPath_array = xos_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
  } else {
    $current_category_id = 0;
  }

// include the site trail class and start the site trail
  require(DIR_WS_CLASSES . 'site_trail.php');
  $site_trail = new site_trail;

  if (DISPLAY_LINK_TO_ROOT_DIRECTORY == 'true' && DIR_WS_CATALOG != '') $site_trail->add(HEADER_TITLE_TOP, str_replace(DIR_WS_CATALOG . FILENAME_DEFAULT, '', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', true, false)));
//  $site_trail->add(HEADER_TITLE_TOP, HTTP_SERVER);    
  $site_trail->add(HEADER_TITLE_HOME, xos_href_link(FILENAME_DEFAULT));

// add category names or the manufacturer name to the site trail
  if (isset($cPath_array)) {
  
    $categories_query = $DB->prepare
    (
     "SELECT    c.link_request_type,
                c.is_page,
                cpd.categories_or_pages_name
      FROM      " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd
      LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
      ON        cpd.categories_or_pages_id = c.categories_or_pages_id
      WHERE     c.categories_or_pages_status = '1'
      AND       cpd.categories_or_pages_id = :cPath
      AND       cpd.language_id = :languages_id"
    );
        
    for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) { 
      
      $DB->perform($categories_query, array(':cPath' => (int)$cPath_array[$i],
                                            ':languages_id' => (int)$_SESSION['languages_id']));
                                                     
      if ($categories_query->rowCount() > 0) {
        $categories = $categories_query->fetch();
        $site_trail->add($categories['categories_or_pages_name'], xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('p', 'c', 'lnc', 'cur', 'tpl', 'x', 'y')) . 'c=' . implode('_', array_slice($cPath_array, 0, ($i+1))), (!empty($categories['link_request_type']) ? $categories['link_request_type'] : 'NONSSL')));
        $page_info = $categories['is_page'];
      } else {
        break;
      }
    }
  } elseif (isset($_GET['m']) && ($_SERVER['BASENAME_PHP_SELF'] != FILENAME_SHOPPING_CART)) {  
    $manufacturers_query = $DB->prepare
    (
     "SELECT manufacturers_name
      FROM   " . TABLE_MANUFACTURERS_INFO . "
      WHERE  manufacturers_id = :m
      AND    languages_id = :languages_id"
    );
    
    $DB->perform($manufacturers_query, array(':m' => (int)$_GET['m'],
                                             ':languages_id' => (int)$_SESSION['languages_id']));
                                                
    if ($manufacturers_query->rowCount()) {
      $manufacturers = $manufacturers_query->fetch();
      $site_trail->add($manufacturers['manufacturers_name'], xos_href_link(FILENAME_DEFAULT, xos_get_all_get_params(array('p', 'm', 'lnc', 'cur', 'tpl', 'x', 'y')) . 'm=' . $_GET['m']));
      $page_info = 'false';
    }
  } 
/*
// add the products model to the site trail
  if (isset($_GET['p'])) {
    $model_query = $DB->prepare
    (
     "SELECT    p.products_model
      FROM      " . TABLE_PRODUCTS . " p
      LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
      ON        p.products_id = p2c.products_id
      LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
      ON        p2c.categories_or_pages_id = c.categories_or_pages_id,
                " . TABLE_PRODUCTS_DESCRIPTION . " pd
      WHERE     c.categories_or_pages_status = '1'
      AND       p.products_id = :p
      AND       p.products_id = pd.products_id"
    );
    
    $DB->perform($model_query, array(':p' => (int)$_GET['p']));
                                        
    if ($model_query->rowCount()) {
      $model = $model_query->fetch();
      if (isset($_GET['m'])) {
        $site_trail->add($model['products_model'], xos_href_link(FILENAME_PRODUCT_INFO, 'm=' . $_GET['m'] . '&p=' . $_GET['p']));
      } else { 
        $site_trail->add($model['products_model'], xos_href_link(FILENAME_PRODUCT_INFO, 'c=' . $cPath . '&p=' . $_GET['p']));
      }
    }
  }
*/
// add the products name to the site trail
  if (isset($_GET['p'])) {
    $name_query = $DB->prepare
    (
     "SELECT    pd.products_name
      FROM      " . TABLE_PRODUCTS . " p
      LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
      ON        p.products_id = p2c.products_id
      LEFT JOIN " . TABLE_CATEGORIES_OR_PAGES . " c
      ON        p2c.categories_or_pages_id = c.categories_or_pages_id,
                " . TABLE_PRODUCTS_DESCRIPTION . " pd
      WHERE     p.products_status = '1'
      AND       c.categories_or_pages_status = '1'
      AND       p.products_id = :p
      AND       p.products_id = pd.products_id
      AND       pd.language_id = :languages_id"
    );
    
    $DB->perform($name_query, array(':p' => (int)$_GET['p'],
                                    ':languages_id' => (int)$_SESSION['languages_id']));
                                                 
    if ($name_query->rowCount()) {
      $name = $name_query->fetch();
      if (isset($_GET['m'])) {      
        $site_trail->add($name['products_name'], xos_href_link(FILENAME_PRODUCT_INFO, 'm=' . $_GET['m'] . '&p=' . $_GET['p']));        
      } else {
        $site_trail->add($name['products_name'], xos_href_link(FILENAME_PRODUCT_INFO, 'c=' . $cPath . '&p=' . $_GET['p']));
      }
    }
  }
  
// initialize the message stack for output messages
  require(DIR_WS_CLASSES . 'message_stack.php');
  $messageStack = new messageStack; 

  require(DIR_WS_CLASSES . 'template_integration.php');
  $templateIntegration = new templateIntegration();
  $templateIntegration->buildBlocks();
  
// check for active product categories in Level 0  
  $check_is_shop_query = $DB->query
  (
   "SELECT Count(*) AS count
    FROM   " . TABLE_CATEGORIES_OR_PAGES . "
    WHERE  parent_id = '0'
    AND    is_page = 'false'
    AND    categories_or_pages_status = '1'"
  );
  
  $check_is_shop = $check_is_shop_query->fetch();
  $is_shop = false;
  if ($check_is_shop['count'] > 0) $is_shop = true; 

// set which precautions should be checked
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
  define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'true');
  
  $smarty->caching = 0;
  $smarty->cache_lifetime = -1;
  $smarty->compile_check = constant(COMPILE_CHECK);
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'general');    
  $smarty->configLoad('templates/' . SELECTED_TPL . '/includes/configuration/config.conf');
  $smarty->addPluginsDir(DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/tpl_smarty_plugins/');   
  $smarty->loadFilter('output','set_internal_link');    
//  $smarty->loadFilter('output','trimwhitespace');
  $smarty->assign(array('nl' => "\n",
                        'is_shop' => $is_shop,
                        'page_info' => $page_info,
                        'request_type' => $request_type,                        
                        'link_filename_popup_content_6' => STATUS_POPUP_CONTENT_6 == '1' ? xos_href_link(FILENAME_POPUP_CONTENT, 'co=6', $request_type) : '',
                        'end_tags' => (DISPLAY_PAGE_PARSE_TIME == 'true' && STORE_PAGE_PARSE_TIME == 'true' ? $templateIntegration->getBlocks('footer_scripts') : $templateIntegration->getBlocks('footer_scripts') . "</body>\n</html>"),
                        'date_format_long' => xos_date_format(DATE_FORMAT_LONG),
                        'languages_path' => DIR_WS_CATALOG . DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $_SESSION['language'] . '/',
                        'buttons_path' => DIR_WS_CATALOG . DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $_SESSION['language'] . '/buttons/',
                        'images_path' => DIR_WS_CATALOG . DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/'));