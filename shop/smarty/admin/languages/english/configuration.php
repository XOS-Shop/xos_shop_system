<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : configuration.php
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
//              filename: configuration.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('HEADING_TITLE_CONFIGURATION_GROUP_1', 'My Store');
define('HEADING_TITLE_CONFIGURATION_GROUP_2', 'Minimum Values');
define('HEADING_TITLE_CONFIGURATION_GROUP_3', 'Maximum Values'); 
define('HEADING_TITLE_CONFIGURATION_GROUP_4', 'Images');
define('HEADING_TITLE_CONFIGURATION_GROUP_5', 'Customer Details');
define('HEADING_TITLE_CONFIGURATION_GROUP_6', 'Module Options');
define('HEADING_TITLE_CONFIGURATION_GROUP_7', 'Shipping/Packaging');
define('HEADING_TITLE_CONFIGURATION_GROUP_8', 'Product Listing A (List view)'); 
define('HEADING_TITLE_CONFIGURATION_GROUP_9', 'Product Listing B (Gallery view)');
define('HEADING_TITLE_CONFIGURATION_GROUP_10', 'Stock'); 
define('HEADING_TITLE_CONFIGURATION_GROUP_11', 'Logging'); 
define('HEADING_TITLE_CONFIGURATION_GROUP_12', 'Smarty template'); 
define('HEADING_TITLE_CONFIGURATION_GROUP_13', 'E-Mail Options');
define('HEADING_TITLE_CONFIGURATION_GROUP_14', 'Download');
define('HEADING_TITLE_CONFIGURATION_GROUP_15', 'GZip Compression');
define('HEADING_TITLE_CONFIGURATION_GROUP_16', 'Sessions');
define('HEADING_TITLE_CONFIGURATION_GROUP_17', 'Site offline');

define('STORE_NAME_TITLE', 'Store Name');
define('STORE_OWNER_TITLE', 'Store Owner');
define('STORE_OWNER_EMAIL_ADDRESS_TITLE', 'E-Mail Address');
define('EMAIL_FROM_TITLE', 'E-Mail From'); 
define('STORE_COUNTRY_TITLE', 'Country');
define('STORE_ZONE_TITLE','Zone'); 
define('EXPECTED_PRODUCTS_SORT_TITLE', 'Expected Sort Order'); 
define('EXPECTED_PRODUCTS_FIELD_TITLE', 'Expected Sort Field'); 
define('SEND_EXTRA_ORDER_EMAILS_TO_TITLE', 'Send Extra Order Email(s) To');  
define('DISPLAY_LINK_TO_ROOT_DIRECTORY_TITLE', 'Display link to root directory'); 
define('SEARCH_ENGINE_FRIENDLY_URLS_TITLE', 'Use Search-Engine Safe URLs');  
define('DISPLAY_CART_TITLE', 'Display Cart After Adding Product'); 
define('ALLOW_GUEST_TO_TELL_A_FRIEND_TITLE', 'Allow Guest To Tell A Friend');
define('NEWSLETTER_ENABLED_TITLE', 'Enable Newsletter');
define('PRODUCT_REVIEWS_ENABLED_TITLE', 'Enable product reviews');
define('PRODUCT_NOTIFICATION_ENABLED_TITLE', 'Enable product notifications');  
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_TITLE', 'Default Search Operator'); 
define('STORE_NAME_ADDRESS_TITLE', 'Store Address and Phone');
define('DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY_TITLE', 'Display products from child categories in parent category');
define('SHOW_EMPTY_CATEGORIES_TITLE', 'Show empty categories');  
define('SHOW_COUNTS_TITLE', 'Show Category Counts');
define('PRODUCT_LISTS_FOR_SEARCH_RESULTS_TITLE', 'Product lists for search results');
define('PRODUCT_LISTS_FOR_SPECIALS_TITLE', 'Product lists for special offers');
define('PRODUCT_LISTS_FOR_MANUFACTURERS_TITLE', 'Product lists for manufacturers');
define('PREV_NEXT_BAR_LOCATION_TITLE', 'Location of Prev/Next Navigation Bar');  
define('TAX_DECIMAL_PLACES_TITLE', 'Tax Decimal Places');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_TITLE', 'To offer a gift voucher');
define('NEW_SIGNUP_DISCOUNT_COUPON_TITLE', 'To offer a discount coupon'); 

define('STORE_NAME_DESCRIPTION', 'The name of my store');
define('STORE_OWNER_DESCRIPTION', 'The name of my store owner'); 
define('STORE_OWNER_EMAIL_ADDRESS_DESCRIPTION', 'The e-mail address of my store owner'); 
define('EMAIL_FROM_DESCRIPTION', 'The e-mail address used in (sent) e-mails'); 
define('STORE_COUNTRY_DESCRIPTION', 'The country my store is located in <br /><br /><b>Note: Please remember to update the store zone.</b>');
define('STORE_ZONE_DESCRIPTION', 'The zone my store is located in');
define('EXPECTED_PRODUCTS_SORT_DESCRIPTION', 'This is the sort order used in the expected products box.'); 
define('EXPECTED_PRODUCTS_FIELD_DESCRIPTION', 'The column to sort by in the expected products box.');  
define('SEND_EXTRA_ORDER_EMAILS_TO_DESCRIPTION', 'Send extra order email(s) to the following email address(es).<br />Format:<br />Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;'); 
define('DISPLAY_LINK_TO_ROOT_DIRECTORY_DESCRIPTION', 'Display the breadcrumb navigation with a link to the root directory.');
define('SEARCH_ENGINE_FRIENDLY_URLS_DESCRIPTION', 'Use search-engine safe urls for all site links');
define('DISPLAY_CART_DESCRIPTION', 'Display the shopping cart after adding a product (or return back to their origin)'); 
define('ALLOW_GUEST_TO_TELL_A_FRIEND_DESCRIPTION', 'Allow guests to tell a friend about a product');
define('NEWSLETTER_ENABLED_DESCRIPTION', 'Enable Newsletter');
define('PRODUCT_REVIEWS_ENABLED_DESCRIPTION', 'Enable product reviews');
define('PRODUCT_NOTIFICATION_ENABLED_DESCRIPTION', 'Enable product notifications'); 
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_DESCRIPTION', 'Default search operators'); 
define('STORE_NAME_ADDRESS_DESCRIPTION', 'This is the Store Name, Address and Phone used on printable documents and displayed online');
define('DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY_DESCRIPTION', 'Show products from child categories in parent category instead of a selection of new products');
define('SHOW_EMPTY_CATEGORIES_DESCRIPTION', 'Shows empty categories in store also');
define('SHOW_COUNTS_DESCRIPTION', 'Count recursively how many products are in each category');
define('PRODUCT_LISTS_FOR_SEARCH_RESULTS_DESCRIPTION', 'Choose a type of product list for search results.<br /><b>A</b> (List view) or <b>B</b> (Gallery view)');
define('PRODUCT_LISTS_FOR_SPECIALS_DESCRIPTION', 'Choose a type of product list for special offers.<br /><b>A</b> (List view) or <b>B</b> (Gallery view)');
define('PRODUCT_LISTS_FOR_MANUFACTURERS_DESCRIPTION', 'Choose a type of product list for manufacturers.<br /><b>A</b> (List view) or <b>B</b> (Gallery view)');
define('PREV_NEXT_BAR_LOCATION_DESCRIPTION', 'Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)');
define('TAX_DECIMAL_PLACES_DESCRIPTION', 'Pad the tax value this amount of decimal places');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_DESCRIPTION', 'Please indicate the amount of the gift voucher which you want to offer a new customer.<br /><br />Put 0 if you do not want to offer gift voucher.');
define('NEW_SIGNUP_DISCOUNT_COUPON_DESCRIPTION', 'To offer a discount coupon to a new customer, enter the code of the coupon.<br /><br/>Leave empty if you do not want to offer discount coupon.');




define('ENTRY_FIRST_NAME_MIN_LENGTH_TITLE', 'First Name');
define('ENTRY_LAST_NAME_MIN_LENGTH_TITLE', 'Last Name');
define('ENTRY_DOB_MIN_LENGTH_TITLE', 'Date of Birth');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_TITLE', 'E-Mail Address');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_TITLE', 'Street Address');
define('ENTRY_COMPANY_MIN_LENGTH_TITLE', 'Company');
define('ENTRY_POSTCODE_MIN_LENGTH_TITLE', 'Post Code');
define('ENTRY_CITY_MIN_LENGTH_TITLE', 'City');
define('ENTRY_STATE_MIN_LENGTH_TITLE', 'State');
define('ENTRY_TELEPHONE_MIN_LENGTH_TITLE', 'Telephone Number');
define('ENTRY_PASSWORD_MIN_LENGTH_TITLE', 'Password');
define('CC_OWNER_MIN_LENGTH_TITLE', 'Credit Card Owner Name');
define('CC_NUMBER_MIN_LENGTH_TITLE', 'Credit Card Number');
define('REVIEW_TEXT_MIN_LENGTH_TITLE', 'Review Text');
define('MIN_DISPLAY_BESTSELLERS_TITLE', 'Best Sellers');
define('MIN_DISPLAY_ALSO_PURCHASED_TITLE', 'Also Purchased');

define('ENTRY_FIRST_NAME_MIN_LENGTH_DESCRIPTION', 'Minimum length of first name');
define('ENTRY_LAST_NAME_MIN_LENGTH_DESCRIPTION', 'Minimum length of last name');
define('ENTRY_DOB_MIN_LENGTH_DESCRIPTION', 'Minimum length of date of birth');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_DESCRIPTION', 'Minimum length of e-mail address');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_DESCRIPTION', 'Minimum length of street address');
define('ENTRY_COMPANY_MIN_LENGTH_DESCRIPTION', 'Minimum length of company name');
define('ENTRY_POSTCODE_MIN_LENGTH_DESCRIPTION', 'Minimum length of post code');
define('ENTRY_CITY_MIN_LENGTH_DESCRIPTION', 'Minimum length of city');
define('ENTRY_STATE_MIN_LENGTH_DESCRIPTION', 'Minimum length of state');
define('ENTRY_TELEPHONE_MIN_LENGTH_DESCRIPTION', 'Minimum length of telephone number');
define('ENTRY_PASSWORD_MIN_LENGTH_DESCRIPTION', 'Minimum length of password');
define('CC_OWNER_MIN_LENGTH_DESCRIPTION', 'Minimum length of credit card owner name');
define('CC_NUMBER_MIN_LENGTH_DESCRIPTION', 'Minimum length of credit card number');
define('REVIEW_TEXT_MIN_LENGTH_DESCRIPTION', 'Minimum length of review text');
define('MIN_DISPLAY_BESTSELLERS_DESCRIPTION', 'Minimum number of best sellers to display');
define('MIN_DISPLAY_ALSO_PURCHASED_DESCRIPTION', 'Minimum number of products to display in the \'This Customer Also Purchased\' box');




define('MAX_ADDRESS_BOOK_ENTRIES_TITLE', 'Address Book Entries');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Search Results');
define('MAX_DISPLAY_PRODUCTS_IN_CATEGORY_TITLE', 'Products in a category');
define('MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER_TITLE', 'Products of a manufacturer');
define('MAX_DISPLAY_PAGE_LINKS_TITLE', 'Page Links');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_TITLE', 'Special Products');
define('MAX_DISPLAY_NEW_PRODUCTS_TITLE', 'New Products Module');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_TITLE', 'Products Expected');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_TITLE', 'Manufacturers List');
define('MAX_MANUFACTURERS_LIST_TITLE', 'Manufacturers Select Size');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_TITLE', 'Length of Manufacturers Name');
define('MAX_DISPLAY_NEW_REVIEWS_TITLE', 'New Reviews');
define('MAX_RANDOM_SELECT_REVIEWS_TITLE', 'Selection of Random Reviews');
define('MAX_RANDOM_SELECT_NEW_TITLE', 'Selection of Random New Products');
define('MAX_RANDOM_SELECT_SPECIALS_TITLE', 'Selection of Products on Special');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_TITLE', 'Categories To List Per Row');
define('MAX_DISPLAY_PRODUCTS_NEW_TITLE', 'New Products Listing');
define('MAX_DISPLAY_BESTSELLERS_TITLE', 'Best Sellers');
define('MAX_DISPLAY_ALSO_PURCHASED_TITLE', 'Also Purchased');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_TITLE', 'Customer Order History Box');
define('MAX_DISPLAY_ORDER_HISTORY_TITLE', 'Order History');

define('MAX_ADDRESS_BOOK_ENTRIES_DESCRIPTION', 'Maximum address book entries a customer is allowed to have');
define('MAX_DISPLAY_SEARCH_RESULTS_DESCRIPTION', 'Amount of products to list');
define('MAX_DISPLAY_PRODUCTS_IN_CATEGORY_DESCRIPTION', 'Amount of products to list');
define('MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER_DESCRIPTION', 'Amount of products to list');
define('MAX_DISPLAY_PAGE_LINKS_DESCRIPTION', 'Number of \'number\' links use for page-sets');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_DESCRIPTION', 'Maximum number of products on special to display');
define('MAX_DISPLAY_NEW_PRODUCTS_DESCRIPTION', 'Maximum number of new products to display in a category');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_DESCRIPTION', 'Maximum number of products expected to display');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_DESCRIPTION', 'Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list');
define('MAX_MANUFACTURERS_LIST_DESCRIPTION', 'Used in manufacturers box; when this value is \'1\' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_DESCRIPTION', 'Used in manufacturers box; maximum length of manufacturers name to display');
define('MAX_DISPLAY_NEW_REVIEWS_DESCRIPTION', 'Maximum number of new reviews to display');
define('MAX_RANDOM_SELECT_REVIEWS_DESCRIPTION', 'How many records to select from to choose one random product review');
define('MAX_RANDOM_SELECT_NEW_DESCRIPTION', 'How many records to select from to choose one random new product to display');
define('MAX_RANDOM_SELECT_SPECIALS_DESCRIPTION', 'How many records to select from to choose one random product special to display');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_DESCRIPTION', 'How many categories to list per row');
define('MAX_DISPLAY_PRODUCTS_NEW_DESCRIPTION', 'Maximum number of new products to display in new products page');
define('MAX_DISPLAY_BESTSELLERS_DESCRIPTION', 'Maximum number of best sellers to display');
define('MAX_DISPLAY_ALSO_PURCHASED_DESCRIPTION', 'Maximum number of products to display in the \'This Customer Also Purchased\' box');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_DESCRIPTION', 'Maximum number of products to display in the customer order history box');
define('MAX_DISPLAY_ORDER_HISTORY_DESCRIPTION', 'Maximum number of orders to display in the order history page');




define('MAX_IMG_TITLE', 'Amount of product images');
define('IMAGE_QUALITY_TITLE', 'Image quality');
define('CONFIG_CALCULATE_IMAGE_SIZE_TITLE', 'Calculate Image Size');
define('IMAGE_REQUIRED_TITLE', 'Image Required');
define('EXTRA_SMALL_PRODUCT_IMAGE_MAX_WIDTH_TITLE', 'Extra small product image width');
define('EXTRA_SMALL_PRODUCT_IMAGE_MAX_HEIGHT_TITLE', 'Extra small product image height');
define('EXTRA_SMALL_PRODUCT_IMAGE_MERGE_TITLE', 'Extra small product image: Merge');
define('SMALL_PRODUCT_IMAGE_MAX_WIDTH_TITLE', 'Small product image width');
define('SMALL_PRODUCT_IMAGE_MAX_HEIGHT_TITLE', 'Small product image height');
define('SMALL_PRODUCT_IMAGE_MERGE_TITLE', 'Small product image: Merge');
define('MEDIUM_PRODUCT_IMAGE_MAX_WIDTH_TITLE', 'Medium product image width');
define('MEDIUM_PRODUCT_IMAGE_MAX_HEIGHT_TITLE', 'Medium product image height');
define('MEDIUM_PRODUCT_IMAGE_MERGE_TITLE', 'Medium product image: Merge');
define('LARGE_PRODUCT_IMAGE_MAX_WIDTH_TITLE', 'Large product image width');
define('LARGE_PRODUCT_IMAGE_MAX_HEIGHT_TITLE', 'Large product image height');
define('LARGE_PRODUCT_IMAGE_MERGE_TITLE', 'Large product image: Merge');
define('SMALL_CATEGORY_IMAGE_MAX_WIDTH_TITLE', 'Small category image width');
define('SMALL_CATEGORY_IMAGE_MAX_HEIGHT_TITLE', 'Small category image height');
define('MEDIUM_CATEGORY_IMAGE_MAX_WIDTH_TITLE', 'Medium category image width');
define('MEDIUM_CATEGORY_IMAGE_MAX_HEIGHT_TITLE', 'Medium category image height'); 

define('MAX_IMG_DESCRIPTION', 'Amount of product images.');
define('IMAGE_QUALITY_DESCRIPTION', 'Image quality (10= highest compression, 100=best quality)');
define('CONFIG_CALCULATE_IMAGE_SIZE_DESCRIPTION', 'Calculate the size of images?');
define('IMAGE_REQUIRED_DESCRIPTION', 'Enable to display broken images. Good for development.');
define('EXTRA_SMALL_PRODUCT_IMAGE_MAX_WIDTH_DESCRIPTION', 'The max pixel width of extra small product images');
define('EXTRA_SMALL_PRODUCT_IMAGE_MAX_HEIGHT_DESCRIPTION', 'The max pixel height of extra small product images');
define('EXTRA_SMALL_PRODUCT_IMAGE_MERGE_DESCRIPTION', 'Extra small product image: Merge<br /><br />Default-values: overlay.gif,10,10,60<br /><br />overlay merge image<br />Usage:<br />merge image,x start [neg = from right],y start [neg = from base],opacity');
define('SMALL_PRODUCT_IMAGE_MAX_WIDTH_DESCRIPTION', 'The max pixel width of small product images');
define('SMALL_PRODUCT_IMAGE_MAX_HEIGHT_DESCRIPTION', 'The max pixel height of small product images');
define('SMALL_PRODUCT_IMAGE_MERGE_DESCRIPTION', 'Small product image: Merge<br /><br />Default-values: overlay.gif,10,10,60<br /><br />overlay merge image<br />Usage:<br />merge image,x start [neg = from right],y start [neg = from base],opacity');
define('MEDIUM_PRODUCT_IMAGE_MAX_WIDTH_DESCRIPTION', 'The max pixel width of medium product images');
define('MEDIUM_PRODUCT_IMAGE_MAX_HEIGHT_DESCRIPTION', 'The max pixel height of medium product images');
define('MEDIUM_PRODUCT_IMAGE_MERGE_DESCRIPTION', 'Medium product image: Merge<br /><br />Default-values: overlay.gif,10,10,60<br /><br />overlay merge image<br />Usage:<br />merge image,x start [neg = from right],y start [neg = from base],opacity');
define('LARGE_PRODUCT_IMAGE_MAX_WIDTH_DESCRIPTION', 'The max pixel width of large product images');
define('LARGE_PRODUCT_IMAGE_MAX_HEIGHT_DESCRIPTION', 'The max pixel height of large product images');
define('LARGE_PRODUCT_IMAGE_MERGE_DESCRIPTION', 'Large product image: Merge<br /><br />Default-values: overlay.gif,10,10,60<br /><br />overlay merge image<br />Usage:<br />merge image,x start [neg = from right],y start [neg = from base],opacity');
define('SMALL_CATEGORY_IMAGE_MAX_WIDTH_DESCRIPTION', 'The max pixel width of small category images');
define('SMALL_CATEGORY_IMAGE_MAX_HEIGHT_DESCRIPTION', 'The max pixel height of small category images');
define('MEDIUM_CATEGORY_IMAGE_MAX_WIDTH_DESCRIPTION', 'The max pixel width of medium category images');
define('MEDIUM_CATEGORY_IMAGE_MAX_HEIGHT_DESCRIPTION', 'The max pixel height of medium category images');




define('ACCOUNT_GENDER_TITLE', 'Gender');
define('ACCOUNT_DOB_TITLE', 'Date of Birth');
define('ACCOUNT_COMPANY_TITLE', 'Company');
define('ACCOUNT_SUBURB_TITLE', 'Suburb');
define('ACCOUNT_STATE_TITLE', 'State');

define('ACCOUNT_GENDER_DESCRIPTION', 'Display gender in the customers account');
define('ACCOUNT_DOB_DESCRIPTION', 'Display date of birth in the customers account');
define('ACCOUNT_COMPANY_DESCRIPTION', 'Display company in the customers account');
define('ACCOUNT_SUBURB_DESCRIPTION', 'Display suburb in the customers account');
define('ACCOUNT_STATE_DESCRIPTION', 'Display state in the customers account');




define('SHIPPING_ORIGIN_COUNTRY_TITLE', 'Country of Origin');
define('SHIPPING_ORIGIN_ZIP_TITLE', 'Postal Code');
define('SHIPPING_MAX_WEIGHT_TITLE', 'Enter the Maximum Package Weight you will ship');
define('SHIPPING_BOX_WEIGHT_TITLE', 'Package Tare weight.');
define('SHIPPING_BOX_PADDING_TITLE', 'Larger packages - percentage increase.');

define('SHIPPING_ORIGIN_COUNTRY_DESCRIPTION', 'Select the country of origin to be used in shipping quotes.');
define('SHIPPING_ORIGIN_ZIP_DESCRIPTION', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.');
define('SHIPPING_MAX_WEIGHT_DESCRIPTION', 'Carriers have a max weight limit for a single package. This is a common one for all.');
define('SHIPPING_BOX_WEIGHT_DESCRIPTION', 'What is the weight of typical packaging of small to medium packages?');
define('SHIPPING_BOX_PADDING_DESCRIPTION', 'For 10% enter 10');




define('PRODUCT_LIST_A_IMAGE_TITLE', 'Display Product Image');
define('PRODUCT_LIST_A_MANUFACTURER_TITLE', 'Display Product Manufaturer Name');
define('PRODUCT_LIST_A_MODEL_TITLE', 'Display Product Model');
define('PRODUCT_LIST_A_NAME_TITLE', 'Display Product Name');
define('PRODUCT_LIST_A_INFO_TITLE', 'Display Product short Description');
define('PRODUCT_LIST_A_PACKING_UNIT_TITLE', 'Display Product packing unit');
define('PRODUCT_LIST_A_PRICE_TITLE', 'Display Product Price');
define('PRODUCT_LIST_A_QUANTITY_TITLE', 'Display Product Quantity');
define('PRODUCT_LIST_A_WEIGHT_TITLE', 'Display Product Weight');
define('PRODUCT_LIST_A_BUY_NOW_TITLE', 'Display Button <i>Add to Cart</i>');
define('PRODUCT_LIST_A_FILTER_TITLE', 'Display Category/Manufacturer Filter (0=disable; 1=enable)');

define('PRODUCT_LIST_A_IMAGE_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_MANUFACTURER_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_MODEL_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_NAME_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_INFO_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_PACKING_UNIT_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_PRICE_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_QUANTITY_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_WEIGHT_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_BUY_NOW_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_A_FILTER_DESCRIPTION', 'Do you want to display the Category/Manufacturer Filter? (0=disable; 1=enable)');


define('PRODUCT_LIST_B_IMAGE_TITLE', 'Display Product Image');
define('PRODUCT_LIST_B_MANUFACTURER_TITLE', 'Display Product Manufaturer Name');
define('PRODUCT_LIST_B_MODEL_TITLE', 'Display Product Model');
define('PRODUCT_LIST_B_NAME_TITLE', 'Display Product Name');
define('PRODUCT_LIST_B_INFO_TITLE', 'Display Product short Description');
define('PRODUCT_LIST_B_PACKING_UNIT_TITLE', 'Display Product packing unit');
define('PRODUCT_LIST_B_PRICE_TITLE', 'Display Product Price');
define('PRODUCT_LIST_B_QUANTITY_TITLE', 'Display Product Quantity');
define('PRODUCT_LIST_B_WEIGHT_TITLE', 'Display Product Weight');
define('PRODUCT_LIST_B_BUY_NOW_TITLE', 'Display Button <i>Add to Cart</i>');
define('PRODUCT_LIST_B_FILTER_TITLE', 'Display Category/Manufacturer Filter (0=disable; 1=enable)');

define('PRODUCT_LIST_B_IMAGE_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_MANUFACTURER_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_MODEL_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_NAME_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_INFO_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_PACKING_UNIT_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_PRICE_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_QUANTITY_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_WEIGHT_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_BUY_NOW_DESCRIPTION', 'Leave blank to disable, set to 0-9 to enable.');
define('PRODUCT_LIST_B_FILTER_DESCRIPTION', 'Do you want to display the Category/Manufacturer Filter? (0=disable; 1=enable)');

define('STOCK_CHECK_TITLE', 'Check stock level');
define('STOCK_LIMITED_TITLE', 'Subtract stock');
define('STOCK_ALLOW_CHECKOUT_TITLE', 'Allow Checkout');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_TITLE', 'Mark product out of stock');
define('STOCK_REORDER_LEVEL_TITLE', 'Stock Re-order level');

define('STOCK_CHECK_DESCRIPTION', 'Check to see if sufficent stock is available');
define('STOCK_LIMITED_DESCRIPTION', 'Subtract product in stock by product orders');
define('STOCK_ALLOW_CHECKOUT_DESCRIPTION', 'Allow customer to checkout even if there is insufficient stock');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_DESCRIPTION', 'Display something on screen so customer can see which product has insufficient stock');
define('STOCK_REORDER_LEVEL_DESCRIPTION', 'Define when stock needs to be re-ordered');




define('STORE_PAGE_PARSE_TIME_TITLE', 'Store Page Parse Time');
define('STORE_PAGE_PARSE_TIME_LOG_TITLE', 'Log Destination');
define('STORE_PARSE_DATE_TIME_FORMAT_TITLE', 'Log Date Format');
define('DISPLAY_PAGE_PARSE_TIME_TITLE', 'Display The Page Parse Time');
define('STORE_DB_TRANSACTIONS_TITLE', 'Store Database Queries');

define('STORE_PAGE_PARSE_TIME_DESCRIPTION', 'Store the time it takes to parse a page');
define('STORE_PAGE_PARSE_TIME_LOG_DESCRIPTION', 'Directory and filename of the page parse time log');
define('STORE_PARSE_DATE_TIME_FORMAT_DESCRIPTION', 'The date format');
define('DISPLAY_PAGE_PARSE_TIME_DESCRIPTION', 'Display the page parse time (store page parse time must be enabled)');
define('STORE_DB_TRANSACTIONS_DESCRIPTION', 'Store the database queries in the page parse time log');




define('CACHE_LEVEL_TITLE', 'Use Cache');
define('COMPILE_CHECK_TITLE', 'Compile check');
define('ALLOW_VISITORS_TO_CHANGE_TEMPLATE_TITLE', 'Allow visitors to change the template');
define('DEFAULT_TPL_TITLE', 'Default Template');
define('REGISTERED_TPLS_TITLE', 'Registered Templates');

define('CACHE_LEVEL_DESCRIPTION', 'Use caching level <br />0 = No cache<br />1 = Level1 cache<br />2 = Level2 cache<br />3 = Level3 cache');
define('COMPILE_CHECK_DESCRIPTION', 'Default = "false"');
define('ALLOW_VISITORS_TO_CHANGE_TEMPLATE_DESCRIPTION', 'Default = "false"');
define('DEFAULT_TPL_DESCRIPTION', 'Choose a template as the default template.<br />');
define('REGISTERED_TPLS_DESCRIPTION', 'Register Templates.<br />The templates must be saved before in the following folders:<br /><br />' . DIR_FS_SMARTY . '<br />catalog/templates/<br /><br />and<br /><br />' . DIR_FS_CATALOG_IMAGES . '<br />catalog/templates/<br />');




define('SEND_EMAILS_TITLE', 'Send E-Mails');
define('EMAIL_USE_HTML_TITLE', 'Use MIME HTML When Sending Emails');
define('EMAIL_SHOP_LOGO_TITLE', 'Shop-logo when use MIME HTML');
define('ENTRY_EMAIL_ADDRESS_CHECK_TITLE', 'Verify E-Mail Addresses Through DNS');
define('EMAIL_TRANSPORT_TITLE', 'E-Mail Transport Method');
define('SENDMAIL_PATH_TITLE', 'The Path to sendmail');
define('SMTP_HOST_TITLE', 'Adresses of the SMTP Hosts');
define('SMTP_AUTH_TITLE', 'SMTP AUTH');
define('SMTP_SECURE_TITLE', 'SMTP encryption method');
define('SMTP_USERNAME_TITLE', 'SMTP Username');
define('SMTP_PASSWORD_TITLE', 'SMTP Password');

define('SEND_EMAILS_DESCRIPTION', 'Send out e-mails');
define('EMAIL_USE_HTML_DESCRIPTION', 'Send e-mails in HTML format');
define('EMAIL_SHOP_LOGO_DESCRIPTION', 'Please enter the name of your shop-logo.');
define('ENTRY_EMAIL_ADDRESS_CHECK_DESCRIPTION', 'Verify e-mail address through a DNS server');
define('EMAIL_TRANSPORT_DESCRIPTION', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.');
define('SENDMAIL_PATH_DESCRIPTION', 'If you use sendmail, you should give us the right path (default: /usr/bin/sendmail)');
define('SMTP_HOST_DESCRIPTION', 'Please enter the adresses of your SMTP hosts. All hosts must be separated by a semicolon. You can also specify a different port for each host by using this format: [hostname:port] e.g.(smtp1.example.com:25;smtp2.example.com).');
define('SMTP_AUTH_DESCRIPTION', 'Does your SMTP Server needs secure authentication?');
define('SMTP_SECURE_DESCRIPTION', 'Select the method \'ssl or tls\' for e-mail encryption, or select \'---\' for no encryption.');
define('SMTP_USERNAME_DESCRIPTION', 'Please enter the username of your SMTP Account.');
define('SMTP_PASSWORD_DESCRIPTION', 'Please enter the password of your SMTP Account.');




define('DOWNLOAD_ENABLED_TITLE', 'Enable download');
define('DOWNLOAD_BY_REDIRECT_TITLE', 'Download by redirect');
define('DOWNLOAD_MAX_DAYS_TITLE', 'Expiry delay (days)');
define('DOWNLOAD_MAX_COUNT_TITLE', 'Maximum number of downloads');

define('DOWNLOAD_ENABLED_DESCRIPTION', 'Enable the products download functions.');
define('DOWNLOAD_BY_REDIRECT_DESCRIPTION', 'Use browser redirection for download. Disable on non-Unix systems.');
define('DOWNLOAD_MAX_DAYS_DESCRIPTION', 'Set number of days before the download link expires. 0 means no limit.');
define('DOWNLOAD_MAX_COUNT_DESCRIPTION', 'Set the maximum number of downloads. 0 means no download authorized.');




define('GZIP_COMPRESSION_TITLE', 'Enable GZip Compression');
define('GZIP_LEVEL_TITLE', 'Compression Level');

define('GZIP_COMPRESSION_DESCRIPTION', 'Enable HTTP GZip compression.');
define('GZIP_LEVEL_DESCRIPTION', 'Use this compression level 0-9 (0 = minimum, 9 = maximum).');




define('SESSION_WRITE_DIRECTORY_TITLE', 'Session Directory');
define('SESSION_FORCE_COOKIE_USE_TITLE', 'Force Cookie Use');
define('SESSION_CHECK_SSL_SESSION_ID_TITLE', 'Check SSL Session ID');
define('SESSION_CHECK_USER_AGENT_TITLE', 'Check User Agent');
define('SESSION_CHECK_IP_ADDRESS_TITLE', 'Check IP Address');
define('SESSION_BLOCK_SPIDERS_TITLE', 'Prevent Spider Sessions');
define('SESSION_RECREATE_TITLE', 'Recreate Session');

define('SESSION_WRITE_DIRECTORY_DESCRIPTION', 'If sessions are file based, store them in this directory.');
define('SESSION_FORCE_COOKIE_USE_DESCRIPTION', 'Force the use of sessions when cookies are only enabled.');
define('SESSION_CHECK_SSL_SESSION_ID_DESCRIPTION', 'Validate the SSL_SESSION_ID on every secure HTTPS page request.');
define('SESSION_CHECK_USER_AGENT_DESCRIPTION', 'Validate the clients browser user agent on every page request.');
define('SESSION_CHECK_IP_ADDRESS_DESCRIPTION', 'Validate the clients IP address on every page request.');
define('SESSION_BLOCK_SPIDERS_DESCRIPTION', 'Prevent known spiders from starting a session.');
define('SESSION_RECREATE_DESCRIPTION', 'Recreate the session to generate a new session ID when the customer logs on or creates an account.');




define('SITE_OFFLINE_TITLE', 'The site is offline');

define('SITE_OFFLINE_DESCRIPTION', 'The site is offline.');

define('TEXT_INFO_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_INFO_DATE_ADDED', 'Date Added:');
define('TEXT_INFO_LAST_MODIFIED', 'Last Modified:');
?>
