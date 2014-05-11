<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : filenames.php
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
//              filename: filenames.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////
  
// define the filenames used in the project
  define('FILENAME_ACTION_RECORDER', 'action_recorder.php');
  define('FILENAME_ATTRIBUTE_LISTS', 'attribute_lists.php');
  define('FILENAME_ATTRIBUTES_QTY_LIST', 'attributes_qty_list.php');
  define('FILENAME_BACKUP', 'backup.php');
  define('FILENAME_BANNER_MANAGER', 'banner_manager.php');
  define('FILENAME_BANNER_STATISTICS', 'banner_statistics.php');
  define('FILENAME_CACHE', 'cache.php');
  define('FILENAME_CATALOG_ACCOUNT_HISTORY_INFO', 'account_history_info.php');
  define('FILENAME_CATALOG_GV_REDEEM', 'gv_redeem.php');  
  define('FILENAME_CATEGORIES', 'categories.php');
  define('FILENAME_CONFIGURATION', 'configuration.php');
  define('FILENAME_COUNTRIES', 'countries.php');
  define('FILENAME_COUPON_ADMIN', 'coupon_admin.php');
  define('FILENAME_CURRENCIES', 'currencies.php');
  define('FILENAME_CUSTOMERS', 'customers.php');
  define('FILENAME_CUSTOMERS_GROUPS', 'customers_groups.php');  
  define('FILENAME_DEFAULT', 'index.php');
  define('FILENAME_DEFINE_LANGUAGE', 'define_language.php');
  define('FILENAME_FILE_MANAGER', 'file_manager.php');
  define('FILENAME_GEO_ZONES', 'geo_zones.php');  
  define('FILENAME_GV_MAIL', 'gv_mail.php');
  define('FILENAME_GV_QUEUE', 'gv_queue.php');
  define('FILENAME_GV_SENT', 'gv_sent.php');        
  define('FILENAME_IMAGE_PROCESSING', 'image_processing.php');
  define('FILENAME_INFO_PAGES', 'info_pages.php');  
  define('FILENAME_LANGUAGES', 'languages.php');
  define('FILENAME_MAIL', 'mail.php');
  define('FILENAME_MANUFACTURERS', 'manufacturers.php');
  define('FILENAME_MODULES', 'modules.php');
  define('FILENAME_NEWSLETTERS', 'newsletters.php');
  define('FILENAME_ORDERS', 'orders.php');
  define('FILENAME_ORDERS_INVOICE', 'invoice.php');
  define('FILENAME_ORDERS_PACKINGSLIP', 'packingslip.php');
  define('FILENAME_ORDERS_STATUS', 'orders_status.php');
  define('FILENAME_PAGES', 'pages.php');  
  define('FILENAME_POPUP_FILE_MANAGER', 'popup_file_manager.php');
  define('FILENAME_POPUP_FORBIDDEN', 'popup_forbidden.php');
  define('FILENAME_POPUP_IMAGE', 'popup_image.php');
  define('FILENAME_POPUP_INFO_PAGES', 'popup_info_pages.php');
  define('FILENAME_POPUP_PAGES', 'popup_pages.php');    
  define('FILENAME_PRODUCTS_ATTRIBUTES', 'products_attributes.php');
  define('FILENAME_PRODUCTS_EXPECTED', 'products_expected.php');
  define('FILENAME_REVIEWS', 'reviews.php');
  define('FILENAME_SERVER_INFO', 'server_info.php');
  define('FILENAME_SHIPPING_MODULES', 'shipping_modules.php');
  define('FILENAME_STATS_CREDITS', 'stats_credits.php');  
  define('FILENAME_STATS_CUSTOMERS', 'stats_customers.php');      
  define('FILENAME_STATS_PRODUCTS_PURCHASED', 'stats_products_purchased.php');
  define('FILENAME_STATS_PRODUCTS_VIEWED', 'stats_products_viewed.php');
  define('FILENAME_TAX_CLASSES', 'tax_classes.php');
  define('FILENAME_TAX_RATES', 'tax_rates.php');
  define('FILENAME_WHOS_ONLINE', 'whos_online.php');
  define('FILENAME_XSELL_PRODUCTS', 'xsell.php');
  define('FILENAME_ZONES', 'zones.php');
  define('FILENAME_ADMIN_ACCOUNT', 'admin_account.php');
  define('FILENAME_ADMIN_MEMBERS', 'admin_members.php');
  Define('FILENAME_FORBIDDEN', 'forbidden.php');
  define('FILENAME_LOGIN', 'login.php');
  define('FILENAME_LOGOFF', 'logoff.php');
  define('FILENAME_PASSWORD_FORGOTTEN', 'password_forgotten.php');
  define('FILENAME_UPDATE_PRODUCTS_PRICES', 'update_products_prices.php');
  
  $linkable_files = array('account.php' => 'SSL',
                          'account_edit.php' => 'SSL',
                          'account_history.php' => 'SSL',
                          'account_history_info.php' => 'SSL',
                          'account_newsletters.php' => 'SSL',
                          'account_notifications.php' => 'SSL',
                          'account_password.php' => 'SSL',
                          'address_book.php' => 'SSL',
                          'address_book_process.php' => 'SSL',
                          'advanced_search_and_results.php' => 'NONSSL',  
                          'checkout_confirmation.php' => 'SSL',
                          'checkout_payment.php' => 'SSL',
                          'checkout_payment_address.php' => 'SSL',
                          'checkout_process.php' => 'SSL',
                          'checkout_shipping.php' => 'SSL',
                          'checkout_shipping_address.php' => 'SSL',
                          'checkout_success.php' => 'SSL',  
                          'content.php' => 'NONSSL',
                          'contact_us.php' => 'SSL',
                          'cookie_usage.php' => 'NONSSL',
                          'create_account.php' => 'SSL',
                          'create_account_success.php' => 'SSL',
                          'index.php' => 'NONSSL',
                          'images_window.php' => 'NONSSL',  
                          'login.php' => 'SSL',
                          'logoff.php' => 'SSL',
                          'newsletter_subscribe.php' => 'SSL',
                          'options_window.php' => 'NONSSL',    
                          'password_forgotten.php' => 'SSL',
                          'popup_content.php' => 'REQUEST_TYPE',
                          'popup_image.php' => 'REQUEST_TYPE',
                          'product_info.php' => 'NONSSL',
                          'product_listing.php' => 'NONSSL',
                          'product_reviews.php' => 'NONSSL',
                          'product_reviews_info.php' => 'NONSSL',
                          'product_reviews_write.php' => 'SSL',
                          'products_new.php' => 'NONSSL',
                          'reviews.php' => 'NONSSL',
                          'search_result.php' => 'NONSSL',
                          'shopping_cart.php' => 'NONSSL',
                          'specials.php' => 'NONSSL',
                          'ssl_check.php' => 'NONSSL',                      
                          'tell_a_friend.php' => 'SSL');    
?>
