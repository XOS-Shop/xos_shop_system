<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : paypal_standard.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2008 Hanspeter Zeller
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
//              Copyright (c) 2008 osCommerce
//              filename: paypal_standard.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  define('MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_TITLE', 'PayPal Website Payments Standard');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_PUBLIC_TITLE', 'PayPal');
//  define('MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_DESCRIPTION', '<img src="' . DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_popup.gif" alt="" />&nbsp;<a href="https://www.paypal.com/mrb/pal=PS2X9Q773CKG4" target="_blank" style="text-decoration: underline; font-weight: bold;">PayPal Webseite besuchen</a>&nbsp;<a href="javascript:toggleDivBlock(\'paypalStdInfo\');">(info)</a><span id="paypalStdInfo" style="display: none;"><br /><i>Bei Benutzung dieses Links erhält XOS-Shop für eine Neukundenvermittlung einen kleinen Bonus.</i></span>');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_TEXT_DESCRIPTION', '<img src="' . DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_popup.gif" alt="" />&nbsp;<a href="https://www.paypal.com/mrb/pal=PS2X9Q773CKG4" target="_blank" style="text-decoration: underline; font-weight: bold;">PayPal Webseite besuchen</a>&nbsp;<a href="javascript:toggleDivBlock(\'paypalStdInfo\');">(info)</a><span id="paypalStdInfo" style="display: none;"><br /><i>Bei Benutzung dieses Links erhält osCommerce für eine Neukundenvermittlung einen kleinen Bonus.</i></span>');  
  
  define('MODULE_PAYMENT_PAYPAL_STANDARD_STATUS_TITLE', 'Enable PayPal Website Payments Standard');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_ID_TITLE', 'E-Mail Address');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_SORT_ORDER_TITLE', 'Sort order of display.');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_ZONE_TITLE', 'Payment Zone');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_PREPARE_ORDER_STATUS_ID_TITLE', 'Set Preparing Order Status');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID_TITLE', 'Set PayPal Acknowledged Order Status');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_GATEWAY_SERVER_TITLE', 'Gateway Server');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_TRANSACTION_METHOD_TITLE', 'Transaction Method');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_PAGE_STYLE_TITLE', 'Page Style');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_DEBUG_EMAIL_TITLE', 'Debug E-Mail Address');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_STATUS_TITLE', 'Enable Encrypted Web Payments');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PRIVATE_KEY_TITLE', 'Your Private Key');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PUBLIC_KEY_TITLE', 'Your Public Certificate');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PAYPAL_KEY_TITLE', 'PayPals Public Certificate');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_CERT_ID_TITLE', 'Your PayPal Public Certificate ID');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY_TITLE', 'Working Directory');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_OPENSSL_TITLE', 'OpenSSL Location');

  define('MODULE_PAYMENT_PAYPAL_STANDARD_STATUS_DESCRIPTION', 'Do you want to accept PayPal Website Payments Standard payments?');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_ID_DESCRIPTION', 'The PayPal seller e-mail address to accept payments for');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_SORT_ORDER_DESCRIPTION', 'Sort order of display. Lowest is displayed first.');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_ZONE_DESCRIPTION', 'If a zone is selected, only enable this payment method for that zone.');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_PREPARE_ORDER_STATUS_ID_DESCRIPTION', 'Set the status of prepared orders made with this payment module to this value');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID_DESCRIPTION', 'Set the status of orders made with this payment module to this value');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_GATEWAY_SERVER_DESCRIPTION', 'Use the testing (sandbox) or live gateway server for transactions?');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_TRANSACTION_METHOD_DESCRIPTION', 'The processing method to use for each transaction.');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_PAGE_STYLE_DESCRIPTION', 'The page style to use for the transaction procedure (defined at your PayPal Profile page)');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_DEBUG_EMAIL_DESCRIPTION', 'All parameters of an Invalid IPN notification will be sent to this email address if one is entered.');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_STATUS_DESCRIPTION', 'Do you want to enable Encrypted Web Payments?');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PRIVATE_KEY_DESCRIPTION', 'The location of your Private Key to use for signing the data. (*.pem)');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PUBLIC_KEY_DESCRIPTION', 'The location of your Public Certificate to use for signing the data. (*.pem)');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PAYPAL_KEY_DESCRIPTION', 'The location of the PayPal Public Certificate for encrypting the data.');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_CERT_ID_DESCRIPTION', 'The Certificate ID to use from your PayPal Encrypted Payment Settings Profile.');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY_DESCRIPTION', 'The working directory to use for temporary files. (trailing slash needed)');
  define('MODULE_PAYMENT_PAYPAL_STANDARD_EWP_OPENSSL_DESCRIPTION', 'The location of the openssl binary file.');  
?>
