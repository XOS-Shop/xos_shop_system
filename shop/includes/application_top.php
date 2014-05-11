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

// start the timer for the page parse time log
  define('PAGE_PARSE_START_TIME', microtime());

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
  error_reporting(E_ALL & ~E_NOTICE);

//  
  header('Content-Type: text/html; charset=utf-8');
  header('X-UA-Compatible: IE=edge,chrome=1');  

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');

// include server parameters
  require('includes/configure.php');  

  if (strlen(DB_SERVER) < 1) {
    if (is_dir('install')) {
      header('Location: install/index.php');
    }
  }

// define the project version
  define('PROJECT_VERSION', 'XOS-Shop version 1.0 rc7s');

// set the type of request (secure or not)
  $request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// include the database functions and make a connection to the database
  if (class_exists('mysqli') && version_compare(PHP_VERSION, '5.3.0', '>=')) {
    require(DIR_WS_FUNCTIONS . 'database_mysqli.php');
    xos_db_connect();
  } else { 
    require(DIR_WS_FUNCTIONS . 'database_mysql.php');
    xos_db_connect() or die('Unable to connect to database server!');
  } 

// set the application parameters
  $configuration_query = xos_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = xos_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);  
  }

// require the smarty class and create an instance
  require(DIR_FS_SMARTY . 'Smarty-3.1.18/Smarty.class.php');  
  $smarty = new Smarty();
  $smarty->template_dir = DIR_FS_SMARTY . 'catalog/templates/';
  $smarty->compile_dir = DIR_FS_SMARTY . 'catalog/templates_c/';
  $smarty->config_dir = DIR_FS_SMARTY . 'catalog/';
  $smarty->cache_dir = DIR_FS_SMARTY . 'catalog/cache/';  
  $smarty->left_delimiter = '[@{';
  $smarty->right_delimiter = '}@]';      

  // set the HTTP GET parameters manually if search_engine_friendly_urls is enabled
  if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
    if (strlen(getenv('PATH_INFO')) > 1) {
      $GET_array = array();
      $_SERVER['PHP_SELF'] = str_replace(getenv('PATH_INFO'), '', $_SERVER['PHP_SELF']);
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

// if gzip_compression is enabled, start to buffer the output 
  if ( (GZIP_COMPRESSION == 'true') && (basename($_SERVER['PHP_SELF']) != FILENAME_DOWNLOAD) && ($ext_zlib_loaded = extension_loaded('zlib'))) {
    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
        ob_start('ob_gzhandler');
    } else {
      ini_set('zlib.output_compression_level', GZIP_LEVEL);
    }
  }
  
// define general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');

// some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  xos_session_name('XOSsid');
  xos_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
  ini_set('session.cookie_lifetime', '0');
  ini_set('session.cookie_path', COOKIE_PATH);
  ini_set('session.cookie_domain', COOKIE_DOMAIN);
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
      setcookie('cookie_test', 'please_accept_for_session', 0, COOKIE_PATH, COOKIE_DOMAIN);
    } else {
      if (!isset($_COOKIE[session_name()]) && isset($_GET[session_name()])) setcookie(session_name(), $_GET[session_name()], 0, COOKIE_PATH, COOKIE_DOMAIN);
      xos_session_start();
      $session_started = true;
    }
  } elseif (SESSION_BLOCK_SPIDERS == 'true') {
    $user_agent = strtolower(getenv('HTTP_USER_AGENT'));
    $spider_flag = false;

    if (xos_not_null($user_agent)) {
      $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

      for ($i=0, $n=sizeof($spiders); $i<$n; $i++) {
        if (xos_not_null($spiders[$i])) {
          if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
            $spider_flag = true;
            break;
          }
        }
      }
    }

    if ($spider_flag == false) {
      if (!isset($_COOKIE[session_name()]) && isset($_GET[session_name()])) setcookie(session_name(), $_GET[session_name()], 0, COOKIE_PATH, COOKIE_DOMAIN);
      xos_session_start();
      $session_started = true;
    } else {
      if (isset($_GET[session_name()])) {
        header("HTTP/1.1 404 Not Found");
        die('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"><head><meta http-equiv="content-type" content="text/html; charset=UTF-8" /><title>404 Not Found</title></head><body><h1>Not Found</h1>The requested document was not found on this server.<p></p><hr /><address>Web Server at ' . HTTP_SERVER . '</address></body></html>');
      }
    }
  } else {
    if (!isset($_COOKIE[session_name()]) && isset($_GET[session_name()])) setcookie(session_name(), $_GET[session_name()], 0, COOKIE_PATH, COOKIE_DOMAIN);
    xos_session_start();
    $session_started = true;
  }

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
      setcookie(session_name(), '', time()-42000, COOKIE_PATH, COOKIE_DOMAIN);
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
      setcookie(session_name(), '', time()-42000, COOKIE_PATH, COOKIE_DOMAIN);
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
      setcookie(session_name(), '', time()-42000, COOKIE_PATH, COOKIE_DOMAIN);
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

// set the language
  if (!isset($_SESSION['language']) || isset($_GET['language'])) {

    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();

    if (isset($_GET['language']) && xos_not_null($_GET['language'])) {
      $lng->set_language($_GET['language']);
    } else {
      $lng->get_browser_language();
    }

    $_SESSION['language'] = $lng->language['directory'];
    $_SESSION['languages_id'] = $lng->language['id'];
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
  if (!isset($_SESSION['currency']) || isset($_GET['currency'])) {
    if (isset($_GET['currency']) && $currencies->is_set($_GET['currency'])) {
      $_SESSION['currency'] = $_GET['currency'];
    } else {
      $_SESSION['currency'] = DEFAULT_CURRENCY;
    }
  }
  
// set the customer_group values
  if(!isset($_SESSION['sppc_customer_group_id']) || !isset($_SESSION['sppc_customer_group_discount'])  ||  !isset($_SESSION['sppc_customer_group_show_tax'])  || !isset($_SESSION['sppc_customer_group_tax_exempt'])) {

    $check_customer_group = xos_db_query("select customers_group_discount, customers_group_show_tax, customers_group_tax_exempt from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = 0");
    $customer_group = xos_db_fetch_array($check_customer_group);
    
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
      $parameters = array('action', 'cPath', 'products_id', 'pid');
    } else {
      $goto = basename($_SERVER['PHP_SELF']);
      if ($_GET['action'] == 'buy_now' && basename($_SERVER['PHP_SELF']) != FILENAME_PRODUCT_REVIEWS && basename($_SERVER['PHP_SELF']) != FILENAME_PRODUCT_REVIEWS_INFO && basename($_SERVER['PHP_SELF']) != FILENAME_PRODUCT_REVIEWS_WRITE) {
        $parameters = array('action', 'pid', 'products_id');
      } else {
        $parameters = array('action', 'pid');
      }
    }
    switch ($_GET['action']) {
      // customer wants to update the product quantity in their shopping cart and product listings
      case 'update_product' : for ($i=0, $n=sizeof($_POST['products_id']); $i<$n; $i++) {
                                if (in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
                                  $_SESSION['cart']->remove($_POST['products_id'][$i]);
                                } else {
                                  $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
                                  $_SESSION['cart']->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false);
                                }
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params($parameters)));
                              break;
      // customer adds a product from the products page
      case 'add_product' :    if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
                                if (xos_has_product_attributes($_POST['products_id']) && basename($_SERVER['PHP_SELF']) != FILENAME_PRODUCT_INFO) {
                                  xos_redirect(xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_POST['products_id'] . (isset($_GET['manufacturers_id']) ? '&manufacturers_id=' . $_GET['manufacturers_id'] : '')), false);
                                } else {
                                  $attributes = isset($_POST['id']) ? $_POST['id'] : '';                               
                                  $_SESSION['cart']->add_cart($_POST['products_id'], $_SESSION['cart']->get_quantity(xos_get_uprid($_POST['products_id'], $attributes))+($_POST['products_quantity']), $attributes);
                                }  
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params($parameters)), false);
                              break;
      // performed by the 'buy now' button in products new listing and review page
      case 'buy_now' :        if (isset($_GET['products_id'])) {
                                if (xos_has_product_attributes($_GET['products_id'])) {
                                  xos_redirect(xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id'] . (isset($_GET['manufacturers_id']) ? '&manufacturers_id=' . $_GET['manufacturers_id'] : '')));
                                } else {
                                  $_SESSION['cart']->add_cart($_GET['products_id'], $_SESSION['cart']->get_quantity($_GET['products_id'])+1);
                                }
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params($parameters)));
                              break;
      // customer wants to remove the product in their shopping cart
      case 'remove_product' : if (isset($_GET['products_id'])) {
                                  $_SESSION['cart']->remove($_GET['products_id']);
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params(array('action', 'products_id')) . $goto ==  FILENAME_SHOPPING_CART ? 'rmp=0' : ''));
                              break;                              
      case 'notify' :         if (isset($_SESSION['customer_id'])) {
                                if (isset($_GET['products_id'])) {
                                  $notify = $_GET['products_id'];
                                } elseif (isset($_GET['notify'])) {
                                  $notify = $_GET['notify'];
                                } elseif (isset($_POST['notify'])) {
                                  $notify = $_POST['notify'];
                                } else {
                                  xos_redirect(xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('action', 'notify'))));
                                }
                                if (!is_array($notify)) $notify = array($notify);
                                for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
                                  $check_query = xos_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $notify[$i] . "' and customers_id = '" . $_SESSION['customer_id'] . "'");
                                  $check = xos_db_fetch_array($check_query);
                                  if ($check['count'] < 1 && $notify[$i] != '') {
                                    xos_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . $_SESSION['customer_id'] . "', now())");
                                  }
                                }
                                xos_redirect(xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('action', 'notify'))));
                              } else {
                                $_SESSION['navigation']->set_snapshot();
                                xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'notify_remove' :  if (isset($_SESSION['customer_id']) && isset($_GET['products_id'])) {
                                $check_query = xos_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $_SESSION['customer_id'] . "'");
                                $check = xos_db_fetch_array($check_query);
                                if ($check['count'] > 0) {
                                  xos_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $_SESSION['customer_id'] . "'");
                                }
                                xos_redirect(xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('action'))));
                              } else {
                                $_SESSION['navigation']->set_snapshot();
                                xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'cust_order' :     if (isset($_SESSION['customer_id']) && isset($_GET['pid'])) {
                                if (xos_has_product_attributes($_GET['pid'])) {
                                  xos_redirect(xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['pid']));
                                } else {
                                  $_SESSION['cart']->add_cart($_GET['pid'], $_SESSION['cart']->get_quantity($_GET['pid'])+1);
                                }
                              }
                              xos_redirect(xos_href_link($goto, xos_get_all_get_params($parameters)));
                              break;
    }
  }

// include the who's online functions
  if (!(in_array(basename($_SERVER['PHP_SELF']), array(FILENAME_CSS, FILENAME_JS, FILENAME_TEST)))) {
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
  if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
  } elseif (isset($_GET['products_id']) && !isset($_GET['manufacturers_id'])) {
    $cPath = xos_get_product_path($_GET['products_id']);
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

  if (DISPLAY_LINK_TO_ROOT_DIRECTORY == 'true' && DIR_WS_CATALOG != '/') $site_trail->add(HEADER_TITLE_TOP, str_replace(DIR_WS_CATALOG . FILENAME_DEFAULT, '', xos_href_link(FILENAME_DEFAULT, '', 'NONSSL', true, false)));
//  $site_trail->add(HEADER_TITLE_TOP, HTTP_SERVER);    
  $site_trail->add(HEADER_TITLE_HOME, xos_href_link(FILENAME_DEFAULT));

// add category names or the manufacturer name to the site trail
  if (isset($cPath_array)) {
    for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
      $categories_query = xos_db_query("select c.is_page, cpd.categories_or_pages_name from " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd left join " . TABLE_CATEGORIES_OR_PAGES . " c on cpd.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and cpd.categories_or_pages_id = '" . (int)$cPath_array[$i] . "' and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "'");    
      if (xos_db_num_rows($categories_query) > 0) {
        $categories = xos_db_fetch_array($categories_query);
        $site_trail->add($categories['categories_or_pages_name'], xos_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i+1)))));
        $page_info = $categories['is_page'];
      } else {
        break;
      }
    }
  } elseif (isset($_GET['manufacturers_id']) && (basename($_SERVER['PHP_SELF']) != FILENAME_SHOPPING_CART)) {  
    $manufacturers_query = xos_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and languages_id = '" . (int)$_SESSION['languages_id'] . "'");
    if (xos_db_num_rows($manufacturers_query)) {
      $manufacturers = xos_db_fetch_array($manufacturers_query);
      $site_trail->add($manufacturers['manufacturers_name'], xos_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $_GET['manufacturers_id']));
      $page_info = 'false';
    }
  } 
/*
// add the products model to the site trail
  if (isset($_GET['products_id'])) {
    $model_query = xos_db_query("select p.products_model from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id, " . TABLE_PRODUCTS_DESCRIPTION . "  pd where c.categories_or_pages_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id");
    if (xos_db_num_rows($model_query)) {
      $model = xos_db_fetch_array($model_query);
      if (isset($_GET['manufacturers_id'])) {
        $site_trail->add($model['products_model'], xos_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $_GET['products_id']));
      } else { 
        $site_trail->add($model['products_model'], xos_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . '&products_id=' . $_GET['products_id']));
      }
    }
  }
*/
// add the products name to the site trail
  if (isset($_GET['products_id'])) {
    $name_query = xos_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id, " . TABLE_PRODUCTS_DESCRIPTION . "  pd where p.products_status = '1' and c.categories_or_pages_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
    if (xos_db_num_rows($name_query)) {
      $name = xos_db_fetch_array($name_query);
      if (isset($_GET['manufacturers_id'])) {      
        $site_trail->add($name['products_name'], xos_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $_GET['products_id']));        
      } else {
        $site_trail->add($name['products_name'], xos_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . '&products_id=' . $_GET['products_id']));
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
  $check_is_shop_query = xos_db_query("select count(*) as count from " . TABLE_CATEGORIES_OR_PAGES . " where parent_id = '0' and is_page = 'false' and categories_or_pages_status = '1'");
  $check_is_shop = xos_db_fetch_array($check_is_shop_query);
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
  $smarty->loadFilter('output','set_internal_link');    
//  $smarty->loadFilter('output','trimwhitespace');
  $smarty->assign(array('nl' => "\n",
                        'is_shop' => $is_shop,
                        'page_info' => $page_info,                        
                        'link_filename_popup_content_5' => STATUS_POPUP_CONTENT_5 == '1' ? xos_href_link(FILENAME_POPUP_CONTENT, 'content_id=5', $request_type) : '',
                        'end_tags' => (DISPLAY_PAGE_PARSE_TIME == 'true' && STORE_PAGE_PARSE_TIME == 'true' ? $templateIntegration->getBlocks('footer_scripts') : $templateIntegration->getBlocks('footer_scripts') . "</body>\n</html>"),
                        'date_format_long' => xos_date_format(DATE_FORMAT_LONG),
                        'languages_path' => DIR_WS_CATALOG . DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $_SESSION['language'] . '/',
                        'buttons_path' => DIR_WS_CATALOG . DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $_SESSION['language'] . '/buttons/',
                        'images_path' => DIR_WS_CATALOG . DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/'));                        
?>
