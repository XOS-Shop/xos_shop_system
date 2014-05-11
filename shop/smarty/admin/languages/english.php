<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : english.php
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
//              filename: english.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on Unix/Linux system try 'en_US.UTF8'
// on Windows environment try 'english'
@setlocale(LC_TIME, 'en_US.UTF8');

define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S'); // this is used for strftime()

// this array is used for function xos_date_format()
$day_month_names = array(
		   'day_0' => 'Sunday',
		   'day_1' => 'Monday',
		   'day_2' => 'Tuesday',
		   'day_3' => 'Wednesday',
		   'day_4' => 'Thursday',
		   'day_5' => 'Friday',
		   'day_6' => 'Saturday',

		   'day_short_0' => 'Sun',
		   'day_short_1' => 'Mon',
		   'day_short_2' => 'Tue',
		   'day_short_3' => 'Wed',
		   'day_short_4' => 'Thu',
		   'day_short_5' => 'Fri',
		   'day_short_6' => 'Sat',

		   'month_01' => 'January',
		   'month_02' => 'February',
		   'month_03' => 'March',
		   'month_04' => 'April',
		   'month_05' => 'May ', //The spaces at the end of (May ) is very important 
		   'month_06' => 'June',
		   'month_07' => 'July',
		   'month_08' => 'August',
		   'month_09' => 'September',
		   'month_10' => 'October',
		   'month_11' => 'November',
		   'month_12' => 'December',

		   'month_short_01' => 'Jan',
		   'month_short_02' => 'Feb',
		   'month_short_03' => 'Mar',
		   'month_short_04' => 'Apr',
		   'month_short_05' => 'May',
		   'month_short_06' => 'Jun',
		   'month_short_07' => 'Jul',
		   'month_short_08' => 'Aug',
		   'month_short_09' => 'Sep',
		   'month_short_10' => 'Oct',
		   'month_short_11' => 'Nov',
		   'month_short_12' => 'Dec');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function xos_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="en"');

// language attribute for the <html> tag
define('XHTML_LANG','en');

// charset for web pages and emails
define('CHARSET', 'UTF-8');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'My Account');

// configuration box text in includes/boxes/menubox_administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrator');
define('BOX_ADMINISTRATOR_MEMBERS', 'Admin Members');
define('BOX_ADMINISTRATOR_MEMBER', 'Members');
define('BOX_ADMINISTRATOR_GROUPS', 'Admin Groups');
define('BOX_ADMINISTRATOR_GROUP', 'Groups');
define('BOX_ADMINISTRATOR_BOXES', 'Groups/Members');

// images
define('IMAGE_FILE_PERMISSION', 'File Permissions');
define('IMAGE_GROUPS', 'Groups List');
define('IMAGE_INSERT_FILE', 'Insert File');
define('IMAGE_MEMBERS', 'Members List');
define('IMAGE_NEXT', 'Next');

// constants for use in xos_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> filenames)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> members)');

// text for gender
define('MALE', 'Male');
define('FEMALE', 'Female');

// configuration box text in includes/boxes/menubox_configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuration');
define('BOX_CONFIGURATION_MYSTORE', 'My Store');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_SMARTY_TEMPLATE', 'Smarty&nbsp;template');
define('BOX_CONFIGURATION_1', 'My Store');
define('BOX_CONFIGURATION_2', 'Minimum Values');
define('BOX_CONFIGURATION_3', 'Maximum Values'); 
define('BOX_CONFIGURATION_4', 'Images');
define('BOX_CONFIGURATION_5', 'Customer Details');
define('BOX_CONFIGURATION_6', 'Module Options');
define('BOX_CONFIGURATION_7', 'Shipping/Packaging');
define('BOX_CONFIGURATION_8', 'Product Listing A'); 
define('BOX_CONFIGURATION_9', 'Product Listing B');
define('BOX_CONFIGURATION_10', 'Stock'); 
define('BOX_CONFIGURATION_11', 'Logging'); 
define('BOX_CONFIGURATION_12', 'Smarty&nbsp;template'); 
define('BOX_CONFIGURATION_13', 'E-Mail Options');
define('BOX_CONFIGURATION_14', 'Download');
define('BOX_CONFIGURATION_15', 'GZip Compression');
define('BOX_CONFIGURATION_16', 'Sessions');
define('BOX_CONFIGURATION_17', 'Site&nbsp;offline');

// modules box heading text in includes/boxes/menubox_modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAYMENT', 'Payment');
define('BOX_MODULES_SHIPPING', 'Shipping');

// categories box text in includes/boxes/menubox_catalog.php
define('BOX_HEADING_CATALOG', 'Catalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categories/Products');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Products Attributes');
define('BOX_CATALOG_MANUFACTURERS', 'Manufacturers');
define('BOX_CATALOG_REVIEWS', 'Reviews');
define('BOX_CATALOG_SPECIALS', 'Specials');
define('BOX_CATALOG_UPDATE_PRODUCTS_PRICES', 'Update prices');
define('BOX_CATALOG_XSELL_PRODUCTS', 'Cross Marketing');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Products Expected');

// customers box text in includes/boxes/menubox_customers.php
define('BOX_HEADING_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_ORDERS', 'Orders');
define('BOX_CUSTOMERS_GROUPS', 'Customers Groups');

// taxes box text in includes/boxes/menubox_taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locations / Taxes');
define('BOX_TAXES_COUNTRIES', 'Countries');
define('BOX_TAXES_ZONES', 'Zones');
define('BOX_TAXES_GEO_ZONES', 'Tax Zones');
define('BOX_TAXES_TAX_CLASSES', 'Tax Classes');
define('BOX_TAXES_TAX_RATES', 'Tax Rates');

// reports box text in includes/boxes/menubox_reports.php
define('BOX_HEADING_REPORTS', 'Reports');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Products Viewed');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Products Purchased');
define('BOX_REPORTS_ORDERS_TOTAL', 'Customer Orders-Total');
define('BOX_REPORTS_CREDITS', 'Customer Credit Voucher');

// tools text in includes/boxes/menubox_tools.php
define('BOX_HEADING_TOOLS', 'Tools');
define('BOX_TOOLS_ACTION_RECORDER', 'Action Recorder');
define('BOX_TOOLS_BACKUP', 'Database Backup');
define('BOX_TOOLS_BANNER_MANAGER', 'Banner Manager');
define('BOX_TOOLS_SMARTY_CACHE', 'Smarty cache control');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Define Languages');
define('BOX_TOOLS_FILE_MANAGER', 'File Manager');
define('BOX_TOOLS_IMAGE_PROCESSING', 'Image Processing');
define('BOX_TOOLS_MAIL', 'Send Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Newsletter Manager');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Who\'s Online');

// localizaion box text in includes/boxes/menubox_localization.php
define('BOX_HEADING_LOCALIZATION', 'Localization');
define('BOX_LOCALIZATION_CURRENCIES', 'Currencies');
define('BOX_LOCALIZATION_LANGUAGES', 'Languages');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Orders Status');

// gv_admin box text in includes/boxes/menubox_gv_admin.php
define('BOX_HEADING_GV_ADMIN', 'Vouchers/Coupons');
define('BOX_GV_ADMIN_QUEUE', 'Gift Voucher Queue');
define('BOX_GV_ADMIN_MAIL', 'Mail Gift Voucher');
define('BOX_GV_ADMIN_SENT', 'Gift Vouchers sent');
define('BOX_COUPON_ADMIN','Coupon Admin');

// content_manager box text in includes/boxes/menubox_content_manager.php
define('BOX_HEADING_CONTENT_MANAGER', 'Content Manager');
define('BOX_CONTENT_MANAGER_PAGES', 'Pages in the menu tree');
define('BOX_CONTENT_MANAGER_INFO_PAGES', 'Info pages');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* The new product atribute needs a price value\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* The new product atribute needs a price prefix\n');

define('JS_PRODUCTS_NAME', '* The new product needs a name\n');
define('JS_PRODUCTS_DESCRIPTION', '* The new product needs a description\n');
define('JS_PRODUCTS_PRICE', '* The new product needs a price value\n');
define('JS_PRODUCTS_WEIGHT', '* The new product needs a weight value\n');
define('JS_PRODUCTS_QUANTITY', '* The new product needs a quantity value\n');
define('JS_PRODUCTS_MODEL', '* The new product needs a model value\n');
define('JS_PRODUCTS_IMAGE', '* The new product needs an image value\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* A new price for this product needs to be set\n');

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n');
define('JS_FIRST_NAME', '* The \'First Name\' entry must have at least ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have at least ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (month/date/year).\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have at least ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_POST_CODE', '* The \'Post Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');
define('JS_CITY', '* The \'City\' entry must have at least ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n');
define('JS_STATE', '* The \'State\' entry is must be selected.\n');
define('JS_STATE_SELECT', '-- Select Above --');
define('JS_ZONE', '* The \'State\' entry must be selected from the list for this country.');
define('JS_COUNTRY', '* The \'Country\' value must be chosen.\n');
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have at least ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD', '* The \'Password\' amd \'Confirmation\' entries must match amd have at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Order Number %s does not exist!');

define('JS_CONFIRM_SAVE', 'Save?');
define('JS_CONFIRM_UPDATE', 'Update?');
define('JS_CONFIRM_INSERT', 'Insert?');
define('JS_THIS_PROCESS_MAY_TAKE_SOME_TIME', 'This process may take some time and may not be interrupted!');
define('JS_ARE_YOU_SURE', 'Are you sure?');

define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">The email address doesn\'t appear to be valid!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">This email address already exists!</span>');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alert off');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alert on');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</span>');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</span>');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_COUNTRY_ERROR', 'You must select a country from the Countries pull down menu.');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</span>');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');
define('ENTRY_CUSTOMERS_GROUP_NAME_ERROR', '');

// button texts
define('BUTTON_TEXT_ANI_SEND_EMAIL', 'Sending E-Mail');
define('BUTTON_TEXT_BACK', 'Back');
define('BUTTON_TEXT_BACK_TO_OVERVIEW', 'Back to overview');
define('BUTTON_TEXT_BACKUP', 'Backup');
define('BUTTON_TEXT_CANCEL', 'Cancel');
define('BUTTON_TEXT_CONFIRM', 'Confirm');
define('BUTTON_TEXT_COPY', 'Copy');
define('BUTTON_TEXT_COPY_TO', 'Copy To');
define('BUTTON_TEXT_DETAILS', 'Details');
define('BUTTON_TEXT_DELETE', 'Delete');
define('BUTTON_TEXT_EDIT', 'Edit');
define('BUTTON_TEXT_EMAIL', 'Email');
define('BUTTON_TEXT_FILE_MANAGER', 'File Manager');
define('BUTTON_TEXT_FILE_PERMISSION', 'File Permissions');
define('BUTTON_TEXT_INSERT', 'Insert');
define('BUTTON_TEXT_LOCK', 'Lock');
define('BUTTON_TEXT_MODULE_INSTALL', 'Install');
define('BUTTON_TEXT_MODULE_REMOVE', 'Remove');
define('BUTTON_TEXT_MOVE', 'Move');
define('BUTTON_TEXT_NEW_BANNER', 'New Banner');
define('BUTTON_TEXT_NEW_CATEGORY', 'New Category');
define('BUTTON_TEXT_NEW_COUNTRY', 'New Country');
define('BUTTON_TEXT_NEW_CURRENCY', 'New Currency');
define('BUTTON_TEXT_NEW_FILE', 'New File');
define('BUTTON_TEXT_NEW_FOLDER', 'New Folder');
define('BUTTON_TEXT_NEW_LANGUAGE', 'New Language');
define('BUTTON_TEXT_NEW_NEWSLETTER', 'New Newsletter');
define('BUTTON_TEXT_NEW_PAGE', 'New page in:');
define('BUTTON_TEXT_NEW_PRODUCT', 'New Product');
define('BUTTON_TEXT_SORT_PRODUCT', 'Sort Product');
define('BUTTON_TEXT_NEW_TAX_CLASS', 'New Tax Class');
define('BUTTON_TEXT_NEW_TAX_RATE', 'New Tax Rate');
define('BUTTON_TEXT_NEW_TAX_ZONE', 'New Tax Zone');
define('BUTTON_TEXT_NEW_ZONE', 'New Zone');
define('BUTTON_TEXT_ORDERS', 'Orders');
define('BUTTON_TEXT_ORDERS_INVOICE', 'Invoice');
define('BUTTON_TEXT_ORDERS_PACKINGSLIP', 'Packing Slip');
define('BUTTON_TEXT_PREVIEW', 'Preview');
define('BUTTON_TEXT_PRODUCTS_ATTRIBUTES', 'Attributes');
define('BUTTON_TEXT_REPORT', 'Report');
define('BUTTON_TEXT_RESTORE', 'Restore');
define('BUTTON_TEXT_RESET', 'Reset');
define('BUTTON_TEXT_REAL_IMAGE', 'Real image');
define('BUTTON_TEXT_SAVE', 'Save');
define('BUTTON_TEXT_SEARCH', 'Search');
define('BUTTON_TEXT_SELECT', 'Select');
define('BUTTON_TEXT_SELECT_FOR_LIGHTBOX', 'Select (for Lightbox or Tabs)');
define('BUTTON_TEXT_SEND', 'Send');
define('BUTTON_TEXT_SEND_EMAIL', 'Send Email');
define('BUTTON_TEXT_UNLOCK', 'Unlock');
define('BUTTON_TEXT_UPDATE', 'Update');
define('BUTTON_TEXT_UPDATE_CURRENCIES', 'Update currencies');
define('BUTTON_TEXT_UPLOAD', 'Upload');

// button titles
define('BUTTON_TITLE_ANI_SEND_EMAIL', 'Sending E-Mail');
define('BUTTON_TITLE_BACK', 'Back');
define('BUTTON_TITLE_BACK_TO_OVERVIEW', 'Back to overview');
define('BUTTON_TITLE_BACKUP', 'Backup');
define('BUTTON_TITLE_CANCEL', 'Cancel');
define('BUTTON_TITLE_CONFIRM', 'Confirm');
define('BUTTON_TITLE_COPY', 'Copy');
define('BUTTON_TITLE_COPY_TO', 'Copy To');
define('BUTTON_TITLE_DETAILS', 'Details');
define('BUTTON_TITLE_DELETE', 'Delete');
define('BUTTON_TITLE_EDIT', 'Edit');
define('BUTTON_TITLE_EMAIL', 'Email');
define('BUTTON_TITLE_FILE_MANAGER', 'File Manager');
define('BUTTON_TITLE_FILE_PERMISSION', 'File Permissions');
define('BUTTON_TITLE_INSERT', 'Insert');
define('BUTTON_TITLE_LOCK', 'Lock');
define('BUTTON_TITLE_MODULE_INSTALL', 'Install Module');
define('BUTTON_TITLE_MODULE_REMOVE', 'Remove Module');
define('BUTTON_TITLE_MOVE', 'Move');
define('BUTTON_TITLE_NEW_BANNER', 'New Banner');
define('BUTTON_TITLE_NEW_CATEGORY', 'New Category');
define('BUTTON_TITLE_NEW_COUNTRY', 'New Country');
define('BUTTON_TITLE_NEW_CURRENCY', 'New Currency');
define('BUTTON_TITLE_NEW_FILE', 'New File');
define('BUTTON_TITLE_NEW_FOLDER', 'New Folder');
define('BUTTON_TITLE_NEW_LANGUAGE', 'New Language');
define('BUTTON_TITLE_NEW_NEWSLETTER', 'New Newsletter');
define('BUTTON_TITLE_NEW_PAGE', 'Create a new page in:');
define('BUTTON_TITLE_NEW_PRODUCT', 'New Product');
define('BUTTON_TITLE_SORT_PRODUCT', 'Sort Product');
define('BUTTON_TITLE_NEW_TAX_CLASS', 'New Tax Class');
define('BUTTON_TITLE_NEW_TAX_RATE', 'New Tax Rate');
define('BUTTON_TITLE_NEW_TAX_ZONE', 'New Tax Zone');
define('BUTTON_TITLE_NEW_ZONE', 'New Zone');
define('BUTTON_TITLE_ORDERS', 'Orders');
define('BUTTON_TITLE_ORDERS_INVOICE', 'Invoice');
define('BUTTON_TITLE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('BUTTON_TITLE_PREVIEW', 'Preview');
define('BUTTON_TITLE_PRODUCTS_ATTRIBUTES', 'Products attributes');
define('BUTTON_TITLE_REPORT', 'Report');
define('BUTTON_TITLE_RESTORE', 'Restore');
define('BUTTON_TITLE_RESET', 'Reset');
define('BUTTON_TITLE_REAL_IMAGE', 'Real image');
define('BUTTON_TITLE_SAVE', 'Save');
define('BUTTON_TITLE_SEARCH', 'Search');
define('BUTTON_TITLE_SELECT', 'Select');
define('BUTTON_TITLE_SELECT_FOR_LIGHTBOX', 'Select (for Lightbox or Tabs)');
define('BUTTON_TITLE_SEND', 'Send');
define('BUTTON_TITLE_SEND_EMAIL', 'Send Email');
define('BUTTON_TITLE_UNLOCK', 'Unlock');
define('BUTTON_TITLE_UPDATE', 'Update');
define('BUTTON_TITLE_UPDATE_CURRENCIES', 'Update Exchange Rate');
define('BUTTON_TITLE_UPLOAD', 'Upload');

//icon titles
define('ICON_TITLE_STATUS_GREEN', 'Active');
define('ICON_TITLE_STATUS_GREEN_LIGHT', 'Set Active');
define('ICON_TITLE_STATUS_RED', 'Inactive');
define('ICON_TITLE_STATUS_RED_LIGHT', 'Set Inactive');
define('ICON_TITLE_CURRENT_FOLDER', 'Current Folder');
define('ICON_TITLE_ERROR', 'Error');
define('ICON_TITLE_FILE', 'File');
define('ICON_TITLE_FILE_DOWNLOAD', 'Download');
define('ICON_TITLE_FOLDER', 'Folder');
define('ICON_TITLE_LOCKED_CLICK_TO_UNLOCK', 'locked, click to unlock');
define('ICON_TITLE_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_TITLE_SUCCESS', 'Success');
define('ICON_TITLE_UNLOCKED', 'unlocked');
define('ICON_TITLE_UNLOCKED_CLICK_TO_LOCK', 'unlocked, click to lock');
define('ICON_TITLE_WARNING', 'Warning');
define('ICON_TITLE_IC_UP_TEXT_SORT', 'Sort');
define('ICON_TITLE_IC_DOWN_TEXT_SORT', 'Sort');
define('ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC', '--> A-B-C  from top');
define('ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX', '--> Z-Y-X  from top');
define('ICON_TITLE_ROW_IS_NOT_UPDATED', 'This row is new and has not been updated');

// constants for use in xos_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s of %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> countries)');
define('TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> coupons)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> customers)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> currencies)');
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> entries)');
define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> gift vouchers)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> languages)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> manufacturers)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders status)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products expected)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> product reviews)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products on special)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax classes)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax zones)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax rates)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> zones)');

define('PREVNEXT_BUTTON_PREV', '<strong>&lt;&lt;</strong>');
define('PREVNEXT_BUTTON_NEXT', '<strong>&gt;&gt;</strong>');

define('TEXT_DEFAULT', 'default');
define('TEXT_SET_DEFAULT', 'Set as default');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Required</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: There is currently no default currency set. Please set one at: Administration Tool->Localization->Currencies');
define('ERROR_NO_DEFAULT_LANGUAGE_DEFINED', 'Error: There is currently no default language set. Please set one at: Administration Tool->Localization->Languages');

define('TEXT_CACHE_CATEGORIES', 'Categories Box');
define('TEXT_CACHE_MANUFACTURERS', 'Manufacturers Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module');

define('TEXT_ALL_LANGUAGES', 'all languages');
define('TEXT_ALL', '--all--');
define('TEXT_NONE', '--none--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination not writeable.');
define('ERROR_FILE_NOT_SAVED', 'Error: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: File uploads are disabled in the php.ini configuration file.');
define('WARNING_SITE_IS_OFFLINE', 'Warning: The site is currently offline!');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warning: Installation directory exists at: ' . DIR_FS_DOCUMENT_ROOT . 'install. Please remove this directory for security reasons.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warning: I am able to write to the configuration file: ' . DIR_FS_CATALOG . 'includes/configure.php. This is a potential security risk - please set the right user permissions on this file.');
define('WARNING_ADMIN_CONFIG_FILE_WRITEABLE', 'Warning: I am able to write to the configuration file: ' . DIR_FS_ADMIN . 'includes/configure.php. This is a potential security risk - please set the right user permissions on this file.');

define('ERROR_PHPMAILER', 'Mailer Error: %s (E-Mail was not sent)');

define('TEXT_IMAGE_NONEXISTENT', 'IMAGE DOES NOT EXIST');
?>
