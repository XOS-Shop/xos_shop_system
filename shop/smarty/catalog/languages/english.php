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
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S'); // this is used for strftime()

define('DATE_OF_BIRTH_FIELD_ORDER', 'MDY');
define('DATE_OF_BIRTH_FIELD_SEPARATOR', '/');
define('DATE_OF_BIRTH_ENTRY_TEXT_MONTH', 'Month');
define('DATE_OF_BIRTH_ENTRY_TEXT_DAY', 'Day');
define('DATE_OF_BIRTH_ENTRY_TEXT_YEAR', 'Year');

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
define('HTML_PARAMS','dir="LTR" lang="en"');

// language attribute for the <html> tag
define('XHTML_LANG','en');

// charset for web pages and emails
define('CHARSET', 'UTF-8');

// page title
define('TITLE', STORE_NAME);

// separator for page title
define('PAGE_TITLE_TRAIL_SEPARATOR', ' » ');

// separator for breadcrumb trail
define('BREADCRUMB_TRAIL_SEPARATOR', ' » ');

// text for downloads in includes/modules/downloads.php
define('HEADER_TITLE_MY_ACCOUNT', 'My Account');

// header text in includes/application_top.php
define('HEADER_TITLE_TOP', 'Top');
define('HEADER_TITLE_HOME', 'Home');

// text for gender
define('MALE', 'Male');
define('FEMALE', 'Female');
define('MALE_ADDRESS', 'Mr.');
define('FEMALE_ADDRESS', 'Ms.');

// format string for advanced search
define('AS_FORMAT_STRING', 'mm/dd/yyyy');
define('AS_FORMAT_STRING_JS', 'mm/dd/yyyy');

// reviews box text in includes/boxes/reviews.php
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s of 5 Stars!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Please Select');
define('TYPE_BELOW', 'Type Below');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form.\nPlease make the following corrections:\n\n');
define('JS_REVIEW_TEXT', 'The \'Review Text\' must have at least ' . REVIEW_TEXT_MIN_LENGTH . ' characters.');
define('JS_REVIEW_RATING', 'You must rate the product for your review.');
define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Please select a payment method for your order.\n');
define('JS_ERROR_CONDITIONS_NOT_ACCEPTED', '* Please confirm the General Business Conditions.\n');
define('JS_ERROR_SUBMITTED', 'This form has already been submitted. Please press Ok and wait for this process to be completed.');
define('JS_ERROR_KEYWORD_FIELD_EMPTY', 'The search field must not be empty.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Please select a payment method for your order.');
define('ERROR_CONDITIONS_NOT_ACCEPTED', 'Please confirm the General Business Conditions.');

define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
define('ENTRY_GENDER_ERROR', 'Please select your Gender.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME_ERROR', 'Your First Name must contain a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME_ERROR', 'Your Last Name must contain a minimum of ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Your Date of Birth must be in this format: MM/DD/YYYY (eg 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', 'MM/DD/YYYY (eg. 05/21/1970) *');
define('ENTRY_DATE_OF_BIRTH_TEXT_1', '(MM/DD/YYYY) *');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Your E-Mail Address must contain a minimum of ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Your E-Mail Address does not appear to be valid - please make any necessary corrections.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Your E-Mail Address already exists in our records - please log in with the e-mail address or create an account with a different address.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS_ERROR', 'Your Street Address must contain a minimum of ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE_ERROR', 'Your Post Code must contain a minimum of ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY_ERROR', 'Your City must contain a minimum of ' . ENTRY_CITY_MIN_LENGTH . ' characters.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE_ERROR', 'Your State must contain a minimum of ' . ENTRY_STATE_MIN_LENGTH . ' characters.');
define('ENTRY_STATE_ERROR_SELECT', 'Please select a state from the States pull down menu.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY_ERROR', 'You must select a country from the Countries pull down menu.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Your Telephone Number must contain a minimum of ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');
define('ENTRY_PASSWORD_ERROR', 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'The Password Confirmation must match your Password.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Password Confirmation:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Current Password:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_NEW', 'New Password:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Your new Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'The Password Confirmation must match your new Password.');
define('PASSWORD_HIDDEN', '--HIDDEN--');

// constants for use in xos_prev_next_display function
define('TEXT_RESULT_PAGE', 'Result Pages:');
define('TEXT_RESULT_PAGE_IN_PULL_DOWN_MENU', 'Page %s of %d');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> reviews)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new products)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> specials)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'First Page');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Previous Page');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Next Page');
define('PREVNEXT_TITLE_LAST_PAGE', 'Last Page');
define('PREVNEXT_TITLE_PAGE_NO', 'Page %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Previous Set of %d Pages');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Next Set of %d Pages');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;FIRST');
define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');
define('PREVNEXT_BUTTON_LAST', 'LAST&gt;&gt;');

define('IMAGE_BUTTON_IN_CART', 'Add to Cart');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notifications');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Remove Notifications');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Write Review');

define('ICON_ARROW_RIGHT', 'more');
define('ICON_CART', 'In Cart');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Success');
define('ICON_WARNING', 'Warning');

define('TEXT_GREETING_PERSONAL', 'Welcome back <span class="greet-user">%s!</span> Would you like to see which <a href="%s"><span class="text-deco-underline">new products</span></a> are available to purchase?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>If you are not %s, please <a href="%s"><span class="text-deco-underline">log yourself in</span></a> with your account information.</small>');
define('TEXT_GREETING_GUEST', 'Welcome <span class="greet-user">Guest!</span> Would you like to <a href="%s"><span class="text-deco-underline">log yourself in</span></a>? Or would you prefer to <a href="%s"><span class="text-deco-underline">create an account</span></a>?');
define('BOX_TEXT_GREETING_PERSONAL', 'Welcome back<br /><span class="greet-user">%s</span>');
define('BOX_TEXT_GREETING_GUEST', 'Welcome <span class="greet-user">Guest</span>');

define('TEXT_MAX_PRODUCTS', ' products');
define('TEXT_SORT_PRODUCTS', 'Sort products ');
define('TEXT_DESCENDINGLY', 'descendingly');
define('TEXT_ASCENDINGLY', 'ascendingly');
define('TEXT_BY', ' by ');

define('TEXT_UNKNOWN_TAX_RATE', 'Unknown tax rate');
define('TEXT_TAX_INC_VAT', 'incl.');
define('TEXT_TAX_PLUS_VAT', 'plus');

define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warning: The sessions directory does not exist: ' . xos_session_save_path() . '. Sessions will not work until this directory is created.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warning: I am not able to write to the sessions directory: ' . xos_session_save_path() . '. Sessions will not work until the right user permissions are set.');
define('WARNING_SESSION_AUTO_START', 'Warning: session.auto_start is enabled - please disable this php feature in php.ini and restart the web server.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warning: The downloadable products directory does not exist: ' . DIR_FS_DOWNLOAD . '. Downloadable products will not work until this directory is valid.');
define('WARNING_SITE_IS_OFFLINE', 'Warning: The site is currently offline!');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'The expiry date entered for the credit card is invalid.<br />Please check the date and try again.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'The credit card number entered is invalid.<br />Please check the number and try again.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'The first four digits of the number entered are: <b>%s</b><br />If that number is correct, we do not accept that type of credit card.<br />If it is wrong, please try again.');

define('ERROR_PHPMAILER', 'Mailer Error: %s (E-Mail was not sent)');
?>
