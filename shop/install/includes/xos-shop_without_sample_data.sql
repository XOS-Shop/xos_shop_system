################################################################################
# project    : XOS-Shop, open source e-commerce system
#              http://www.xos-shop.com
#                                                                     
# filename   : xos-shop_without_sample_data.sql
# author     : Hanspeter Zeller <hpz@xos-shop.com>
# copyright  : Copyright (c) 2014 Hanspeter Zeller
# license    : This file is part of XOS-Shop.
#
#              XOS-Shop is free software: you can redistribute it and/or modify
#              it under the terms of the GNU General Public License as published
#              by the Free Software Foundation, either version 3 of the License,
#              or (at your option) any later version.
#
#              XOS-Shop is distributed in the hope that it will be useful,
#              but WITHOUT ANY WARRANTY; without even the implied warranty of
#              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#              GNU General Public License for more details.
#
#              You should have received a copy of the GNU General Public License
#              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>.    
# ------------------------------------------------------------------------------
# this file is based on: 
#              osCommerce, Open Source E-Commerce Solutions
#              http://www.oscommerce.com
#              Copyright (c) 2003 osCommerce
#              filename: oscommerce.sql                      
#
#              Released under the GNU General Public License
#

################################################################################

DROP TABLE IF EXISTS action_recorder;
CREATE TABLE action_recorder (
  id int NOT NULL auto_increment,
  module varchar(255) NOT NULL,
  user_id int,
  user_name varchar(255),
  identifier varchar(255) NOT NULL,
  success char(1),
  date_added datetime NOT NULL,
  PRIMARY KEY (id),
  KEY IDX_ACTION_RECORDER_MODULE (module),
  KEY IDX_ACTION_RECORDER_USER_ID (user_id),
  KEY IDX_ACTION_RECORDER_IDENTIFIER (identifier),
  KEY IDX_ACTION_RECORDER_DATE_ADDED (date_added)
);

DROP TABLE IF EXISTS address_book;
CREATE TABLE address_book (
   address_book_id int NOT NULL auto_increment,
   customers_id int NOT NULL,
   entry_gender char(1),
   entry_company varchar(255),
   entry_company_tax_id varchar(255) default NULL,   
   entry_firstname varchar(255) NOT NULL,
   entry_lastname varchar(255) NOT NULL,
   entry_street_address varchar(255) NOT NULL,
   entry_suburb varchar(255),
   entry_postcode varchar(255) NOT NULL,
   entry_city varchar(255) NOT NULL,
   entry_state varchar(255),
   entry_country_id int DEFAULT '0' NOT NULL,
   entry_zone_id int DEFAULT '0' NOT NULL,
   PRIMARY KEY (address_book_id),
   KEY IDX_CUSTOMERS_ID (customers_id)
);

DROP TABLE IF EXISTS address_format;
CREATE TABLE address_format (
  address_format_id int NOT NULL auto_increment,
  address_format varchar(128) NOT NULL,
  address_summary varchar(48) NOT NULL,
  PRIMARY KEY (address_format_id)
);

DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
  admin_id int(11) NOT NULL auto_increment,
  admin_groups_id int(11) default NULL,
  admin_firstname varchar(255) NOT NULL default '',
  admin_lastname varchar(255) default NULL,
  admin_email_address varchar(255) NOT NULL default '',
  admin_password varchar(60) NOT NULL default '',
  admin_created datetime default NULL,
  admin_modified datetime NOT NULL default '0000-00-00 00:00:00',
  admin_logdate datetime default NULL,
  admin_lognum int(11) NOT NULL default '0',
  PRIMARY KEY  (admin_id),
  UNIQUE KEY UNI_ADMIN_EMAIL_ADDRESS (admin_email_address)  
);

DROP TABLE IF EXISTS admin_files;
CREATE TABLE admin_files (
  admin_files_id int(11) NOT NULL auto_increment,
  admin_files_languages_key varchar(64) NOT NULL,
  admin_files_name varchar(255) NOT NULL default '',
  admin_files_is_boxes tinyint(5) NOT NULL default '0',
  admin_files_to_boxes int(11) NOT NULL default '0',
  admin_groups_id set('1','2') NOT NULL default '1',
  PRIMARY KEY  (admin_files_id)
);

DROP TABLE IF EXISTS admin_groups;
CREATE TABLE admin_groups (
  admin_groups_id int(11) NOT NULL auto_increment,
  admin_groups_name varchar(255) default NULL,
  PRIMARY KEY  (admin_groups_id),
  UNIQUE KEY UNI_ADMIN_GROUPS_NAME (admin_groups_name)
);

DROP TABLE IF EXISTS banners;
CREATE TABLE banners (
  banners_id int NOT NULL auto_increment,  
  banners_group varchar(255) NOT NULL,  
  expires_impressions int(7) DEFAULT '0',
  expires_date datetime DEFAULT NULL,
  date_scheduled datetime DEFAULT NULL,
  date_added datetime NOT NULL,
  date_status_change datetime DEFAULT NULL,
  status int(1) DEFAULT '1' NOT NULL,
  PRIMARY KEY  (banners_id)
);

DROP TABLE IF EXISTS banners_content;
CREATE TABLE banners_content (
  banners_id int NOT NULL auto_increment,
  language_id int DEFAULT '1' NOT NULL, 
  banners_title varchar(255) NOT NULL,
  banners_url varchar(255) NOT NULL,
  banners_image varchar(255) NOT NULL,
  banners_html_text text,
  PRIMARY KEY (banners_id, language_id)
);

DROP TABLE IF EXISTS banners_history;
CREATE TABLE banners_history (
  banners_history_id int NOT NULL auto_increment,
  banners_id int NOT NULL,
  banners_shown int(5) NOT NULL DEFAULT '0',
  banners_clicked int(5) NOT NULL DEFAULT '0',
  banners_history_date datetime NOT NULL,
  PRIMARY KEY  (banners_history_id)
);

DROP TABLE IF EXISTS categories_or_pages;
CREATE TABLE categories_or_pages (
   categories_or_pages_id int NOT NULL auto_increment,
   categories_image varchar(255),
   parent_id int DEFAULT '0' NOT NULL,
   product_list_b tinyint(1) DEFAULT '0' NOT NULL,
   sort_order int(3),
   is_page varchar(32) NOT NULL,
   page_not_in_menu tinyint(1) DEFAULT '0' NOT NULL,   
   categories_or_pages_status tinyint(1) DEFAULT '0' NOT NULL,
   date_added datetime,
   last_modified datetime,
   PRIMARY KEY (categories_or_pages_id, categories_or_pages_status),
   KEY IDX_PARENT_ID (parent_id)
);

DROP TABLE IF EXISTS categories_or_pages_data;
CREATE TABLE categories_or_pages_data (
   categories_or_pages_id int DEFAULT '0' NOT NULL,
   language_id int DEFAULT '1' NOT NULL,
   categories_or_pages_name varchar(255) NOT NULL,
   categories_or_pages_heading_title varchar(255),
   categories_or_pages_content text,
   PRIMARY KEY (categories_or_pages_id, language_id),
   KEY IDX_CATEGORIES_OR_PAGES_NAME (categories_or_pages_name)
);

DROP TABLE IF EXISTS configuration;
CREATE TABLE configuration (
  configuration_id int NOT NULL auto_increment,
  configuration_key varchar(255) NOT NULL,
  configuration_value text NOT NULL,
  configuration_group_id int NOT NULL,
  sort_order int(5) NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  use_function varchar(255) NULL,
  set_function varchar(255) NULL,
  PRIMARY KEY (configuration_id)
);

DROP TABLE IF EXISTS contents;
CREATE TABLE contents (
  content_id int(11) NOT NULL auto_increment,
  type varchar(32) NOT NULL, 
  status tinyint(1) DEFAULT '0' NOT NULL,
  sort_order int(3),  
  last_modified datetime,
  date_added datetime,
  PRIMARY KEY (content_id)
);

DROP TABLE IF EXISTS contents_data;
CREATE TABLE contents_data (
  content_id int NOT NULL auto_increment,
  language_id int DEFAULT '1' NOT NULL,
  name varchar(255),
  heading_title varchar(255),
  content text,
  PRIMARY KEY (content_id, language_id)
);

DROP TABLE IF EXISTS counter;
CREATE TABLE counter (
  startdate char(8),
  counter int(12)
);

DROP TABLE IF EXISTS counter_history;
CREATE TABLE counter_history (
  month char(8),
  counter int(12)
);

DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  countries_id int NOT NULL auto_increment,
  countries_name varchar(255) NOT NULL,
  countries_iso_code_2 char(2) NOT NULL,
  countries_iso_code_3 char(3) NOT NULL,
  address_format_id int NOT NULL,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
);

DROP TABLE IF EXISTS countries_list;
CREATE TABLE countries_list (
  countries_id int NOT NULL auto_increment,
  countries_name varchar(255) NOT NULL,
  countries_iso_code_2 char(2) NOT NULL,
  countries_iso_code_3 char(3) NOT NULL,
  address_format_id int NOT NULL,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
);

DROP TABLE IF EXISTS coupons;
CREATE TABLE coupons (
  coupon_id int(11) NOT NULL auto_increment,
  coupon_type char(1) NOT NULL default 'F',
  coupon_code varchar(32) NOT NULL default '',
  coupon_amount decimal(8,4) NOT NULL default '0.0000',
  coupon_minimum_order decimal(8,4) NOT NULL default '0.0000',
  coupon_start_date datetime NOT NULL default '0000-00-00 00:00:00',
  coupon_expire_date datetime NOT NULL default '0000-00-00 00:00:00',
  uses_per_coupon int(5) NOT NULL default '1',
  uses_per_user int(5) NOT NULL default '0',
  restrict_to_products varchar(255) default NULL,
  restrict_to_categories varchar(255) default NULL,
  coupon_active char(1) NOT NULL default 'Y',
  date_created datetime NOT NULL default '0000-00-00 00:00:00',
  date_modified datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (coupon_id)
);

DROP TABLE IF EXISTS coupons_description;
CREATE TABLE coupons_description (
  coupon_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '0',
  coupon_name varchar(255) NOT NULL default '',
  coupon_description text,
  KEY coupon_id (coupon_id)
); 

DROP TABLE IF EXISTS coupon_email_track;
CREATE TABLE coupon_email_track (
  unique_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  customer_id_sent int(11) NOT NULL default '0',
  sent_firstname varchar(255) default NULL,
  sent_lastname varchar(255) default NULL,
  emailed_to varchar(255) default NULL,
  date_sent datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (unique_id)
);

DROP TABLE IF EXISTS coupon_gv_customer;
CREATE TABLE coupon_gv_customer (
  customer_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  PRIMARY KEY (customer_id)
);

DROP TABLE IF EXISTS coupon_gv_queue;
CREATE TABLE coupon_gv_queue (
  unique_id int(5) NOT NULL auto_increment,
  customer_id int(5) NOT NULL default '0',
  order_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  date_created datetime NOT NULL default '0000-00-00 00:00:00',
  ipaddr varchar(64) NOT NULL default '',
  release_flag char(1) NOT NULL default 'N',
  PRIMARY KEY (unique_id),
  KEY IDX_UID (customer_id,order_id)
);

DROP TABLE IF EXISTS coupon_redeem_track;
CREATE TABLE coupon_redeem_track (
  unique_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  customer_id int(11) NOT NULL default '0',
  redeem_date datetime NOT NULL default '0000-00-00 00:00:00',
  redeem_ip varchar(64) NOT NULL default '',
  order_id int(11) NOT NULL default '0',
  PRIMARY KEY (unique_id)
);

DROP TABLE IF EXISTS currencies;
CREATE TABLE currencies (
  currencies_id int NOT NULL auto_increment,
  language_id int NOT NULL default '1',
  title varchar(255) NOT NULL,
  code char(3) NOT NULL,
  symbol_left varchar(32),
  symbol_right varchar(32),
  decimal_point char(1),
  thousands_point char(1),
  decimal_places char(1),
  value float(13,8),
  last_updated datetime NULL,
  PRIMARY KEY (currencies_id, language_id)
);

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
   customers_id int NOT NULL auto_increment,
   customers_gender char(1),
   customers_c_id varchar(64), 
   customers_firstname varchar(255) NOT NULL,
   customers_lastname varchar(255) NOT NULL,
   customers_dob datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   customers_email_address varchar(255) NOT NULL,
   customers_language_id int NOT NULL,
   customers_default_address_id int,
   customers_telephone varchar(255) NOT NULL,
   customers_fax varchar(255),
   customers_password varchar(60) NOT NULL,
   customers_group_id smallint NOT NULL default '0',
   customers_group_ra enum('0','1') NOT NULL,
   customers_comments text,       
   PRIMARY KEY (customers_id)
);

DROP TABLE IF EXISTS customers_basket;
CREATE TABLE customers_basket (
  customers_basket_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  products_id tinytext NOT NULL,
  customers_basket_quantity int NOT NULL,
  final_price decimal(15,4),
  customers_basket_date_added char(8),
  PRIMARY KEY (customers_basket_id)
);

DROP TABLE IF EXISTS customers_groups;
CREATE TABLE customers_groups (
 customers_group_id smallint NOT NULL,
 customers_group_name varchar(32) NOT NULL default '',
 customers_group_discount decimal(6,2) NOT NULL default '0.00',
 customers_group_show_tax enum('1','0') NOT NULL,
 customers_group_tax_exempt enum('0','1') NOT NULL,
 group_payment_allowed varchar(255) NOT NULL default '',
 group_shipment_allowed varchar(255) NOT NULL default '',
 PRIMARY KEY (customers_group_id)
);

DROP TABLE IF EXISTS customers_info;
CREATE TABLE customers_info (
  customers_info_id int NOT NULL,
  customers_info_date_of_last_logon datetime,
  customers_info_number_of_logons int(5),
  customers_info_date_account_created datetime,
  customers_info_date_account_last_modified datetime,
  global_product_notifications int(1) DEFAULT '0',
  PRIMARY KEY (customers_info_id)
);

DROP TABLE IF EXISTS geo_zones;
CREATE TABLE geo_zones (
  geo_zone_id int NOT NULL auto_increment,
  geo_zone_name varchar(255) NOT NULL,
  geo_zone_description varchar(255) NOT NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (geo_zone_id)
);

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  languages_id int NOT NULL auto_increment,
  use_in_id enum('1','2','3') NOT NULL default '3',
  display_in_catalog tinyint(1) DEFAULT '1' NOT NULL,
  name varchar(64)  NOT NULL,
  code char(2) NOT NULL,
  image varchar(255),
  directory varchar(64),
  sort_order int(3),
  PRIMARY KEY (languages_id),
  KEY IDX_NAME (name)
);


DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers (
  manufacturers_id int NOT NULL auto_increment,
  manufacturers_image varchar(255),
  date_added datetime NULL,
  last_modified datetime NULL,
  PRIMARY KEY (manufacturers_id)
);

DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE manufacturers_info (
  manufacturers_id int NOT NULL,
  languages_id int NOT NULL,
  manufacturers_name varchar(255) NOT NULL,  
  manufacturers_url varchar(255) NOT NULL,
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime NULL,
  PRIMARY KEY (manufacturers_id, languages_id),
  KEY IDX_MANUFACTURERS_NAME (manufacturers_name)  
);

DROP TABLE IF EXISTS newsletter_subscribers;
CREATE TABLE newsletter_subscribers (
   subscriber_id int NOT NULL auto_increment,
   customers_id int NOT NULL,
   subscriber_language_id int NOT NULL,
   subscriber_email_address varchar(255) NOT NULL,
   subscriber_identity_code varchar(12) NOT NULL,
   newsletter_status int(1) DEFAULT '0' NOT NULL,
   newsletter_status_change datetime DEFAULT NULL,
   subscriber_date_added datetime default NULL,
   PRIMARY KEY (subscriber_id)
);

DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
  newsletters_id int NOT NULL auto_increment,
  title varchar(255) NOT NULL,
  language_id int NOT NULL,
  content_text_plain text NOT NULL,
  content_text_htlm text NOT NULL,
  module varchar(255) NOT NULL,
  date_added datetime NOT NULL,
  date_sent datetime,
  status int(1),
  locked int(1) DEFAULT '0',
  PRIMARY KEY (newsletters_id)
);

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  orders_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  customers_c_id varchar(64),
  customers_name varchar(255) NOT NULL,
  customers_company varchar(255),
  customers_street_address varchar(255) NOT NULL,
  customers_suburb varchar(255),
  customers_city varchar(255) NOT NULL,
  customers_postcode varchar(255) NOT NULL,
  customers_state varchar(255),
  customers_country varchar(255) NOT NULL,
  customers_telephone varchar(255) NOT NULL,
  customers_email_address varchar(255) NOT NULL,
  customers_address_format_id int(5) NOT NULL,
  delivery_name varchar(255) NOT NULL,
  delivery_company varchar(255),
  delivery_street_address varchar(255) NOT NULL,
  delivery_suburb varchar(255),
  delivery_city varchar(255) NOT NULL,
  delivery_postcode varchar(255) NOT NULL,
  delivery_state varchar(255),
  delivery_country varchar(255) NOT NULL,
  delivery_address_format_id int(5) NOT NULL,
  billing_name varchar(255) NOT NULL,
  billing_company varchar(255),
  billing_street_address varchar(255) NOT NULL,
  billing_suburb varchar(255),
  billing_city varchar(255) NOT NULL,
  billing_postcode varchar(255) NOT NULL,
  billing_state varchar(255),
  billing_country varchar(255) NOT NULL,
  billing_address_format_id int(5) NOT NULL,
  payment_method varchar(255) NOT NULL,
  cc_type varchar(20),
  cc_owner varchar(255),
  cc_number blob,
  cc_expires varchar(4),
  last_modified datetime,
  date_purchased datetime,
  orders_status int(5) NOT NULL,
  orders_date_finished datetime,
  language_id int(5) NOT NULL,
  language_directory varchar(64),
  currency varchar(3),
  currency_value decimal(14,6),
  PRIMARY KEY (orders_id),
  KEY IDX_CUSTOMERS_ID (customers_id)
);

DROP TABLE IF EXISTS orders_products;
CREATE TABLE orders_products (
  orders_products_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  products_id int NOT NULL,
  products_attributes_sting varchar(32),
  products_model varchar(32),
  products_name varchar(64) NOT NULL,
  products_p_unit varbinary(32) default NULL,  
  products_price decimal(15,4) NOT NULL,
  final_price decimal(15,4) NOT NULL,
  products_price_text varchar(255) NOT NULL,
  final_price_text varchar(255) NOT NULL,
  total_price_text varchar(255) NOT NULL,   
  products_tax decimal(7,4) NOT NULL,
  products_quantity int(4) NOT NULL,
  PRIMARY KEY (orders_products_id),
  KEY IDX_ORDERS_ID (orders_id),
  KEY IDX_PRODUCTS_ID (products_id)
);

DROP TABLE IF EXISTS orders_status;
CREATE TABLE orders_status (
   orders_status_id int DEFAULT '0' NOT NULL,
   language_id int DEFAULT '1' NOT NULL,
   orders_status_name varchar(32) NOT NULL,
   orders_status_code varchar(12) NOT NULL,
   public_flag int DEFAULT '1',
   downloads_flag int DEFAULT '0',   
   PRIMARY KEY (orders_status_id, language_id),
   KEY IDX_ORDERS_STATUS_NAME (orders_status_name)
);

DROP TABLE IF EXISTS orders_status_history;
CREATE TABLE orders_status_history (
   orders_status_history_id int NOT NULL auto_increment,
   orders_id int NOT NULL,
   orders_status_id int(5) NOT NULL,
   date_added datetime NOT NULL,
   customer_notified int(1) DEFAULT '0',
   comments text,
   PRIMARY KEY (orders_status_history_id)
);

DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE orders_products_attributes (
  orders_products_attributes_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  orders_products_id int NOT NULL,
  products_options varchar(32) NOT NULL,
  products_options_values varchar(32) NOT NULL,
  options_values_price decimal(15,4) NOT NULL,
  options_values_price_text varchar(255) NOT NULL,
  price_prefix char(1) NOT NULL,
  PRIMARY KEY (orders_products_attributes_id)
);

DROP TABLE IF EXISTS orders_products_download;
CREATE TABLE orders_products_download (
  orders_products_download_id int NOT NULL auto_increment,
  orders_id int NOT NULL default '0',
  orders_products_id int NOT NULL default '0',
  orders_products_filename varchar(255) NOT NULL default '',
  download_maxdays int(2) NOT NULL default '0',
  download_count int(2) NOT NULL default '0',
  PRIMARY KEY  (orders_products_download_id)
);

DROP TABLE IF EXISTS orders_total;
CREATE TABLE orders_total (
  orders_total_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  title varchar(255) NOT NULL,
  text varchar(255) NOT NULL,
  value decimal(15,4) NOT NULL,
  tax decimal(7,4) NOT NULL,
  class varchar(32) NOT NULL,
  sort_order int NOT NULL,
  PRIMARY KEY (orders_total_id),
  KEY IDX_ORDERS_ID (orders_id)
);

DROP TABLE IF EXISTS products;
CREATE TABLE products (
  products_id int NOT NULL auto_increment,
  products_quantity int(7) NOT NULL,
  products_model varchar(32),
  products_image text,
  products_price text,
  products_sort_order int(6),
  products_date_added datetime NOT NULL,
  products_last_modified datetime,
  products_date_available datetime,
  products_weight decimal(5,2) NOT NULL,
  products_status tinyint(1) NOT NULL,
  products_tax_class_id int NOT NULL,
  manufacturers_id int NULL,
  products_ordered int NOT NULL default '0',
  attributes_quantity text,
  attributes_combinations text,
  attributes_not_updated text,  
  PRIMARY KEY (products_id, products_status),
  KEY IDX_MANUFACTURERS_ID (manufacturers_id)
);

DROP TABLE IF EXISTS products_attributes;
CREATE TABLE products_attributes (
  products_attributes_id int NOT NULL auto_increment,
  products_id int NOT NULL,
  options_id int NOT NULL,
  options_values_id int NOT NULL,
  options_sort_order int(3) NOT NULL default '1',  
  options_values_sort_order int(3) NOT NULL default '1',
  options_values_price decimal(15,4) NOT NULL,
  price_prefix char(1) NOT NULL,
  PRIMARY KEY (products_attributes_id),
  KEY IDX_PRODUCTS_ID (products_id)
);

DROP TABLE IF EXISTS products_attributes_download;
CREATE TABLE products_attributes_download (
  products_attributes_id int NOT NULL,
  products_attributes_filename varchar(255) NOT NULL default '',
  products_attributes_maxdays int(2) default '0',
  products_attributes_maxcount int(2) default '0',
  PRIMARY KEY  (products_attributes_id)
);

DROP TABLE IF EXISTS products_description;
CREATE TABLE products_description (
  products_id int NOT NULL auto_increment,
  language_id int NOT NULL default '1',
  products_name varchar(64) NOT NULL default '',
  products_p_unit varbinary(32) default NULL,
  products_info text,
  products_description_tab_label varchar(512) default NULL,
  products_description text,
  products_url varchar(255) default NULL,
  products_viewed int(5) default '0',
  PRIMARY KEY  (products_id,language_id),
  KEY IDX_PRODUCTS_NAME (products_name)
);

DROP TABLE IF EXISTS products_notifications;
CREATE TABLE products_notifications (
  products_id int NOT NULL,
  customers_id int NOT NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (products_id, customers_id)
);

DROP TABLE IF EXISTS products_options;
CREATE TABLE products_options (
  products_options_id int NOT NULL default '0',
  language_id int NOT NULL default '1',
  products_options_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (products_options_id,language_id)
);

DROP TABLE IF EXISTS products_options_values;
CREATE TABLE products_options_values (
  products_options_values_id int NOT NULL default '0',
  language_id int NOT NULL default '1',
  products_options_values_name varchar(64) NOT NULL default '',
  PRIMARY KEY  (products_options_values_id,language_id)
);

DROP TABLE IF EXISTS products_options_values_to_products_options;
CREATE TABLE products_options_values_to_products_options (
  products_options_id int NOT NULL,
  products_options_values_id int NOT NULL,
  PRIMARY KEY (products_options_id,products_options_values_id)
);

DROP TABLE IF EXISTS products_prices;
CREATE TABLE products_prices (
  customers_group_id smallint NOT NULL default '0',
  customers_group_price decimal(15,4) NOT NULL default '0.0000',
  products_id int(11) NOT NULL default '0',
  PRIMARY KEY  (customers_group_id, products_id)
);

DROP TABLE IF EXISTS products_to_categories;
CREATE TABLE products_to_categories (
  products_id int NOT NULL,
  categories_or_pages_id int NOT NULL,
  PRIMARY KEY (products_id,categories_or_pages_id)
);

DROP TABLE IF EXISTS products_xsell;
CREATE TABLE products_xsell (
   ID int(10) NOT NULL auto_increment,
   products_id int(10) NOT NULL default '1',
   xsell_id int(10) NOT NULL default '1',
   sort_order int(10) NOT NULL default '1',
   PRIMARY KEY  (ID),
   KEY IDX_PRODUCTS_ID (products_id)
);

DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews (
  reviews_id int NOT NULL auto_increment,
  products_id int NOT NULL,
  customers_id int,
  customers_name varchar(255) NOT NULL,
  reviews_rating int(1),
  date_added datetime,
  last_modified datetime,
  reviews_read int(5) NOT NULL default '0',
  PRIMARY KEY (reviews_id)
);

DROP TABLE IF EXISTS reviews_description;
CREATE TABLE reviews_description (
  reviews_id int NOT NULL,
  languages_id int NOT NULL,
  reviews_text text NOT NULL,
  PRIMARY KEY (reviews_id, languages_id)
);

DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions (
  sesskey varchar(32) NOT NULL,
  expiry int(11) unsigned NOT NULL,
  value text NOT NULL,
  PRIMARY KEY (sesskey)
);

DROP TABLE IF EXISTS specials;
CREATE TABLE specials (
  specials_id int NOT NULL auto_increment,
  products_id int NOT NULL,
  customers_group_id smallint NOT NULL default '0',  
  specials_new_products_price decimal(15,4) NOT NULL,
  expires_date datetime,
  status int(1) NOT NULL DEFAULT '1',
  error int(1) NOT NULL,
  PRIMARY KEY (specials_id),
  KEY IDX_PRODUCTS_ID (products_id)
);

DROP TABLE IF EXISTS tax_class;
CREATE TABLE tax_class (
  tax_class_id int NOT NULL auto_increment,
  tax_class_title varchar(32) NOT NULL,
  tax_class_description varchar(255) NOT NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (tax_class_id)
);

DROP TABLE IF EXISTS tax_rates;
CREATE TABLE tax_rates (
  tax_rates_id int NOT NULL auto_increment,
  tax_zone_id int NOT NULL,
  tax_class_id int NOT NULL,
  tax_priority int(5) DEFAULT 1,
  tax_rate decimal(7,4) NOT NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (tax_rates_id)
);

DROP TABLE IF EXISTS tax_rates_description;
CREATE TABLE tax_rates_description (
  tax_rates_id int NOT NULL auto_increment,
  language_id int NOT NULL default '1',
  tax_description varchar(255) NOT NULL,
  PRIMARY KEY (tax_rates_id,language_id)
);

DROP TABLE IF EXISTS tax_rates_final;
CREATE TABLE tax_rates_final (
  tax_rates_final_id int NOT NULL auto_increment,
  tax_zone_id int NOT NULL,
  tax_class_id int NOT NULL,
  tax_rate_final decimal(7,4) NOT NULL,
  PRIMARY KEY (tax_rates_final_id),
  KEY IDX_TAX_ZONE_ID (tax_zone_id),
  KEY IDX_TAX_CLASS_ID (tax_class_id)
);

DROP TABLE IF EXISTS whos_online;
CREATE TABLE whos_online (
  customer_id int,
  full_name varchar(255) NOT NULL,
  session_id varchar(128) NOT NULL,
  ip_address varchar(15) NOT NULL,
  time_entry varchar(14) NOT NULL,
  time_last_click varchar(14) NOT NULL,
  last_page_url text NOT NULL
);

DROP TABLE IF EXISTS zones;
CREATE TABLE zones (
  zone_id int NOT NULL auto_increment,
  zone_country_id int NOT NULL,
  zone_code varchar(32) NOT NULL,
  zone_name varchar(255) NOT NULL,
  PRIMARY KEY (zone_id)
);

DROP TABLE IF EXISTS zones_list;
CREATE TABLE zones_list (
  zone_id int NOT NULL auto_increment,
  zone_country_id int NOT NULL,
  zone_code varchar(32) NOT NULL,
  zone_name varchar(255) NOT NULL,
  PRIMARY KEY (zone_id)
);

DROP TABLE IF EXISTS zones_to_geo_zones;
CREATE TABLE zones_to_geo_zones (
   association_id int NOT NULL auto_increment,
   zone_country_id int NOT NULL,
   zone_id int NULL,
   geo_zone_id int NULL,
   last_modified datetime NULL,
   date_added datetime NOT NULL,
   PRIMARY KEY (association_id),
   KEY IDX_ZONE_COUNTRY_ID (zone_country_id)
);


# data

# 1 - Default, 2 - USA, 3 - Spain, 4 - Singapore, 5 - Germany
INSERT INTO address_format VALUES (1, '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','$city / $country');
INSERT INTO address_format VALUES (2, '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','$city, $state / $country');
INSERT INTO address_format VALUES (3, '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country');
INSERT INTO address_format VALUES (4, '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
INSERT INTO address_format VALUES (5, '$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country');

INSERT INTO admin VALUES (1, 1, 'AdminFirstname', 'AdminLastname', 'admin@localhost', '351683ea4e19efe34874b501fdbf9792:9b', now(), '0000-00-00 00:00:00', null, 0);

INSERT INTO admin_files VALUES ('1', 'BOX_HEADING_ADMINISTRATOR', 'menubox_administrator.php', '1', '0', '1');
INSERT INTO admin_files VALUES ('2', 'BOX_HEADING_CONFIGURATION', 'menubox_configuration.php', '1', '0', '1');
INSERT INTO admin_files VALUES ('3', 'BOX_HEADING_MODULES', 'menubox_modules.php', '1', '0', '1'); 
INSERT INTO admin_files VALUES ('4', 'BOX_HEADING_CONTENT_MANAGER', 'menubox_content_manager.php', '1', '0', '1');
INSERT INTO admin_files VALUES ('5', 'BOX_HEADING_CATALOG', 'menubox_catalog.php', '1', '0', '1');
INSERT INTO admin_files VALUES ('6', 'BOX_HEADING_CUSTOMERS', 'menubox_customers.php', '1', '0', '1');
# INSERT INTO admin_files VALUES ('7', 'BOX_HEADING_GV_ADMIN', 'menubox_gv_admin.php', '1', '0', '1');
INSERT INTO admin_files VALUES ('8', 'BOX_HEADING_LOCATION_AND_TAXES', 'menubox_taxes.php', '1', '0', '1');
INSERT INTO admin_files VALUES ('9', 'BOX_HEADING_LOCALIZATION', 'menubox_localization.php', '1', '0', '1');
INSERT INTO admin_files VALUES ('10', 'BOX_HEADING_REPORTS', 'menubox_reports.php', '1', '0', '1');
INSERT INTO admin_files VALUES ('11', 'BOX_HEADING_TOOLS', 'menubox_tools.php', '1', '0', '1');
INSERT INTO admin_files VALUES ('12', 'BOX_ADMINISTRATOR_BOXES', 'admin_members.php', '0', '1', '1');
INSERT INTO admin_files VALUES ('13', 'BOX_HEADING_CONFIGURATION', 'configuration.php', '0', '2', '1');
INSERT INTO admin_files VALUES ('14', 'BOX_HEADING_MODULES', 'modules.php', '0', '3', '1');
INSERT INTO admin_files VALUES ('15', 'BOX_CONTENT_MANAGER_PAGES', 'pages.php', '0', '4', '1');
INSERT INTO admin_files VALUES ('16', 'BOX_CONTENT_MANAGER_INFO_PAGES', 'info_pages.php', '0', '4', '1');
INSERT INTO admin_files VALUES ('17', 'BOX_CATALOG_CATEGORIES_PRODUCTS', 'categories.php', '0', '5', '1');
INSERT INTO admin_files VALUES ('18', 'BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'products_attributes.php', '0', '5', '1');
INSERT INTO admin_files VALUES ('19', 'BOX_CATALOG_MANUFACTURERS', 'manufacturers.php', '0', '5', '1');
INSERT INTO admin_files VALUES ('20', 'BOX_CATALOG_REVIEWS', 'reviews.php', '0', '5', '1');
INSERT INTO admin_files VALUES ('21', 'BOX_CATALOG_UPDATE_PRODUCTS_PRICES', 'update_products_prices.php', '0', '5', '1');
INSERT INTO admin_files VALUES ('22', 'BOX_CATALOG_XSELL_PRODUCTS', 'xsell.php', '0', '5', '1');
INSERT INTO admin_files VALUES ('23', 'BOX_CATALOG_PRODUCTS_EXPECTED', 'products_expected.php', '0', '5', '1'); 
INSERT INTO admin_files VALUES ('24', 'BOX_CUSTOMERS_CUSTOMERS', 'customers.php', '0', '6', '1');
INSERT INTO admin_files VALUES ('25', 'BOX_CUSTOMERS_ORDERS', 'orders.php', '0', '6', '1');
INSERT INTO admin_files VALUES ('26', 'BOX_CUSTOMERS_GROUPS', 'customers_groups.php', '0', '6', '1');
# INSERT INTO admin_files VALUES ('27', 'BOX_COUPON_ADMIN', 'coupon_admin.php', '0', '7', '1');
# INSERT INTO admin_files VALUES ('28', 'BOX_GV_ADMIN_QUEUE', 'gv_queue.php', '0', '7', '1');
# INSERT INTO admin_files VALUES ('29', 'BOX_GV_ADMIN_MAIL', 'gv_mail.php', '0', '7', '1');
# INSERT INTO admin_files VALUES ('30', 'BOX_GV_ADMIN_SENT', 'gv_sent.php', '0', '7', '1');
INSERT INTO admin_files VALUES ('31', 'BOX_TAXES_COUNTRIES', 'countries.php', '0', '8', '1');
INSERT INTO admin_files VALUES ('32', 'BOX_TAXES_ZONES', 'zones.php', '0', '8', '1');
INSERT INTO admin_files VALUES ('33', 'BOX_TAXES_GEO_ZONES', 'geo_zones.php', '0', '8', '1');
INSERT INTO admin_files VALUES ('34', 'BOX_TAXES_TAX_CLASSES', 'tax_classes.php', '0', '8', '1');
INSERT INTO admin_files VALUES ('35', 'BOX_TAXES_TAX_RATES', 'tax_rates.php', '0', '8', '1');
INSERT INTO admin_files VALUES ('36', 'BOX_LOCALIZATION_CURRENCIES', 'currencies.php', '0', '9', '1');
INSERT INTO admin_files VALUES ('37', 'BOX_LOCALIZATION_LANGUAGES', 'languages.php', '0', '9', '1');
INSERT INTO admin_files VALUES ('38', 'BOX_LOCALIZATION_ORDERS_STATUS', 'orders_status.php', '0', '9', '1');
INSERT INTO admin_files VALUES ('39', 'BOX_REPORTS_PRODUCTS_VIEWED', 'stats_products_viewed.php', '0', '10', '1');
INSERT INTO admin_files VALUES ('40', 'BOX_REPORTS_PRODUCTS_PURCHASED', 'stats_products_purchased.php', '0', '10', '1');
INSERT INTO admin_files VALUES ('41', 'BOX_REPORTS_ORDERS_TOTAL', 'stats_customers.php', '0', '10', '1');
INSERT INTO admin_files VALUES ('42', 'BOX_REPORTS_CREDITS', 'stats_credits.php', '0', '10', '1');
INSERT INTO admin_files VALUES ('43', 'BOX_TOOLS_ACTION_RECORDER', 'action_recorder.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('44', 'BOX_TOOLS_BACKUP', 'backup.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('45', 'BOX_TOOLS_IMAGE_PROCESSING', 'image_processing.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('46', 'BOX_TOOLS_BANNER_MANAGER', 'banner_manager.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('47', 'BOX_TOOLS_SMARTY_CACHE', 'cache.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('48', 'BOX_TOOLS_DEFINE_LANGUAGE', 'define_language.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('49', 'BOX_TOOLS_FILE_MANAGER', 'file_manager.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('50', 'BOX_TOOLS_MAIL', 'mail.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('51', 'BOX_TOOLS_NEWSLETTER_MANAGER', 'newsletters.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('52', 'BOX_TOOLS_SERVER_INFO', 'server_info.php', '0', '11', '1');
INSERT INTO admin_files VALUES ('53', 'BOX_TOOLS_WHOS_ONLINE', 'whos_online.php', '0', '11', '1');

INSERT INTO admin_groups VALUES (1, 'Top Administrator');
INSERT INTO admin_groups VALUES (2, 'Customer Relations');

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('STORE_NAME', 'XOS-Shop', '1', '1', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('STORE_OWNER', 'Harald Ponce de Leon', '1', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('STORE_OWNER_EMAIL_ADDRESS', 'root@localhost', '1', '3', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('EMAIL_FROM', 'XOS-Shop &lt;root@localhost&gt;', '1', '4', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('STORE_COUNTRY', '223', '1', '5', 'xos_get_country_name', 'xos_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('STORE_ZONE', '18', '1', '6', 'xos_cfg_get_zone_name', 'xos_cfg_pull_down_zone_list(', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('EXPECTED_PRODUCTS_SORT', 'desc', '1', '7', 'xos_cfg_select_option(array(\'asc\', \'desc\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('EXPECTED_PRODUCTS_FIELD', 'date_expected', '1', '8', 'xos_cfg_select_option(array(\'products_name\', \'date_expected\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SEND_EXTRA_ORDER_EMAILS_TO', 'Name 1 &lt;name1@localhost&gt;, Name 2 &lt;name2@localhost&gt;', '1', '9', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('DISPLAY_LINK_TO_ROOT_DIRECTORY', 'false', '1', '10', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SEARCH_ENGINE_FRIENDLY_URLS', 'false', '1', '11', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('DISPLAY_CART', 'false', '1', '12', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', '1', '13', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('NEWSLETTER_ENABLED', 'true', '1', '14', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('PRODUCT_REVIEWS_ENABLED', 'true', '1', '15', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('PRODUCT_NOTIFICATION_ENABLED', 'false', '1', '16', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', '1', '17', 'xos_cfg_select_option(array(\'and\', \'or\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('STORE_NAME_ADDRESS', 'Store Name\nAddress\nCountry\nPhone', '1', '18', 'xos_cfg_textarea(', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY', 'false', '1', '19', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SHOW_EMPTY_CATEGORIES', 'true', '1', '20', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SHOW_COUNTS', 'true', '1', '21', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('PRODUCT_LISTS_FOR_SEARCH_RESULTS', 'A', '1', '22', 'xos_cfg_select_option(array(\'A\', \'B\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('PRODUCT_LISTS_FOR_SPECIALS', 'B', '1', '23', 'xos_cfg_select_option(array(\'A\', \'B\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('PRODUCT_LISTS_FOR_MANUFACTURERS', 'B', '1', '24', 'xos_cfg_select_option(array(\'A\', \'B\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PREV_NEXT_BAR_LOCATION', '3', '1', '25', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('TAX_DECIMAL_PLACES', '2', '1', '26', now());
# INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', '0', '1', '27', now());
# INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('NEW_SIGNUP_DISCOUNT_COUPON', '', '1', '28', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_FIRST_NAME_MIN_LENGTH', '2', '2', '1', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_LAST_NAME_MIN_LENGTH', '2', '2', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_DOB_MIN_LENGTH', '10', '2', '3', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', '2', '4', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', '2', '5', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_COMPANY_MIN_LENGTH', '2', '2', '6', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_POSTCODE_MIN_LENGTH', '4', '2', '7', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_CITY_MIN_LENGTH', '3', '2', '8', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_STATE_MIN_LENGTH', '2', '2', '9', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_TELEPHONE_MIN_LENGTH', '3', '2', '10', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('ENTRY_PASSWORD_MIN_LENGTH', '5', '2', '11', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('CC_OWNER_MIN_LENGTH', '3', '2', '12', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('CC_NUMBER_MIN_LENGTH', '10', '2', '13', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('REVIEW_TEXT_MIN_LENGTH', '50', '2', '14', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MIN_DISPLAY_BESTSELLERS', '1', '2', '15', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MIN_DISPLAY_ALSO_PURCHASED', '1', '2', '16', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_ADDRESS_BOOK_ENTRIES', '5', '3', '1', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_SEARCH_RESULTS', '20', '3', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_PRODUCTS_IN_CATEGORY', '20', '3', '3', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER', '20', '3', '4', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_PAGE_LINKS', '5', '3', '5', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_SPECIAL_PRODUCTS', '9', '3', '6', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_NEW_PRODUCTS', '9', '3', '7', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_UPCOMING_PRODUCTS', '10', '3', '8', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', '3', '9', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_MANUFACTURERS_LIST', '1', '3', '10', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', '3', '11', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_NEW_REVIEWS', '6', '3', '12', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_RANDOM_SELECT_REVIEWS', '10', '3', '13', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_RANDOM_SELECT_NEW', '10', '3', '14', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_RANDOM_SELECT_SPECIALS', '10', '3', '15', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_CATEGORIES_PER_ROW', '3', '3', '16', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_PRODUCTS_NEW', '10', '3', '17', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_BESTSELLERS', '10', '3', '18', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_ALSO_PURCHASED', '6', '3', '19', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', '3', '20', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_DISPLAY_ORDER_HISTORY', '10', '3', '21', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MAX_IMG', '9', '4', '1', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('IMAGE_QUALITY', '80', '4', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('CONFIG_CALCULATE_IMAGE_SIZE', 'true', '4', '3', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('IMAGE_REQUIRED', 'true', '4', '4', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('EXTRA_SMALL_PRODUCT_IMAGE_MAX_WIDTH', '26', '4', '5', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('EXTRA_SMALL_PRODUCT_IMAGE_MAX_HEIGHT', '26', '4', '6', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('EXTRA_SMALL_PRODUCT_IMAGE_MERGE', '', '4', '7', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SMALL_PRODUCT_IMAGE_MAX_WIDTH', '90', '4', '8', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SMALL_PRODUCT_IMAGE_MAX_HEIGHT', '90', '4', '9', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SMALL_PRODUCT_IMAGE_MERGE', '', '4', '10', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MEDIUM_PRODUCT_IMAGE_MAX_WIDTH', '180', '4', '11', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MEDIUM_PRODUCT_IMAGE_MAX_HEIGHT', '180', '4', '12', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MEDIUM_PRODUCT_IMAGE_MERGE', '', '4', '13', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('LARGE_PRODUCT_IMAGE_MAX_WIDTH', '400', '4', '14', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('LARGE_PRODUCT_IMAGE_MAX_HEIGHT', '400', '4', '15', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('LARGE_PRODUCT_IMAGE_MERGE', 'overlay.gif,10,10,60', '4', '16', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SMALL_CATEGORY_IMAGE_MAX_WIDTH', '60', '4', '17', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SMALL_CATEGORY_IMAGE_MAX_HEIGHT', '60', '4', '18', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MEDIUM_CATEGORY_IMAGE_MAX_WIDTH', '100', '4', '19', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MEDIUM_CATEGORY_IMAGE_MAX_HEIGHT', '100', '4', '20', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('ACCOUNT_GENDER', 'true', '5', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('ACCOUNT_DOB', 'true', '5', '2', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('ACCOUNT_COMPANY', 'true', '5', '3', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('ACCOUNT_SUBURB', 'true', '5', '4', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('ACCOUNT_STATE', 'true', '5', '5', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ACTION_RECORDER_INSTALLED', 'ar_admin_login.php;ar_contact_us.php;ar_reset_password.php;ar_tell_a_friend.php', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES', '5', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS', '3', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES', '15', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES', '5', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS', '1', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES', '15', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_PAYMENT_INSTALLED', 'cc.php;cod.php', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_INSTALLED', 'flat.php', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_PAYMENT_COD_STATUS', 'true', '6', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('MODULE_PAYMENT_COD_ZONE', '0', '6', '2', 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_PAYMENT_COD_SORT_ORDER', '3', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', '6', '0', 'xos_cfg_pull_down_order_statuses(', 'xos_get_order_status_name', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_PAYMENT_CC_STATUS', 'true', '6', '0', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_PAYMENT_CC_EMAIL', '', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_PAYMENT_CC_SORT_ORDER', '2', '6', '0' , now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('MODULE_PAYMENT_CC_ZONE', '0', '6', '2', 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', '6', '0', 'xos_cfg_pull_down_order_statuses(', 'xos_get_order_status_name', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_SHIPPING_FLAT_STATUS', 'true', '6', '0', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_FLAT_COST', '5.00', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('MODULE_SHIPPING_FLAT_TAX_CLASS', '0', '6', '0', 'xos_get_tax_class_title', 'xos_cfg_pull_down_tax_classes(', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('MODULE_SHIPPING_FLAT_ZONE', '0', '6', '0', 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_FLAT_SORT_ORDER', '1', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('DEFAULT_CURRENCY', 'CHF', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('DEFAULT_LANGUAGE', 'de', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('DEFAULT_ORDERS_STATUS_ID', '1', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', '6', '1','xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '8', '6', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'false', '6', '3', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '50', '6', '4', 'currencies->format', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', '6', '5', 'xos_cfg_select_option(array(\'national\', \'international\', \'both\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', '6', '1','xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', '6', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_ORDER_TOTAL_TAX_STATUS', 'true', '6', '1','xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '10', '6', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', '6', '1','xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '12', '6', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SOCIAL_BOOKMARKS_INSTALLED', 'sb_email.php;sb_facebook.php;sb_twitter.php', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS', 'true', '6', '1','xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER', '10', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_SOCIAL_BOOKMARKS_FACEBOOK_STATUS', 'true', '6', '1','xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SOCIAL_BOOKMARKS_FACEBOOK_SORT_ORDER', '20', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_SOCIAL_BOOKMARKS_TWITTER_STATUS', 'true', '6', '1','xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SOCIAL_BOOKMARKS_TWITTER_SORT_ORDER', '30', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('LAST_CUSTOMERS_GROUPS_ID', '0', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('STATUS_POPUP_CONTENT_5', '1', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('LAST_COUNTRY_ID', '300', '6', '0', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('NEW_ORDER', 'false', '6', '0', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('SHIPPING_ORIGIN_COUNTRY', '223', '7', '1', 'xos_get_country_name', 'xos_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SHIPPING_ORIGIN_ZIP', 'NONE', '7', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SHIPPING_MAX_WEIGHT', '50', '7', '3', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SHIPPING_BOX_WEIGHT', '3', '7', '4', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SHIPPING_BOX_PADDING', '10', '7', '5', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_IMAGE', '0', '8', '1', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_MANUFACTURER', '', '8', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_MODEL', '2', '8', '3', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_NAME', '1', '8', '4', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_INFO', '', '8', '5',now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_PACKING_UNIT', '', '8', '6',now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_PRICE', '3', '8', '7', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_QUANTITY', '', '8', '8', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_WEIGHT', '', '8', '9', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_BUY_NOW', '4', '8', '10', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_A_FILTER', '1', '8', '11', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_IMAGE', '1', '9', '1', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_MANUFACTURER', '4', '9', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_MODEL', '3', '9', '3', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_NAME', '0', '9', '4', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_INFO', '2', '9', '5',now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_PACKING_UNIT', '5', '9', '6',now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_PRICE', '8', '9', '7', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_QUANTITY', '7', '9', '8', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_WEIGHT', '6', '9', '9', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_BUY_NOW', '9', '9', '10', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('PRODUCT_LIST_B_FILTER', '1', '9', '11', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('STOCK_CHECK', 'true', '10', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('STOCK_LIMITED', 'true', '10', '2', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('STOCK_ALLOW_CHECKOUT', 'true', '10', '3', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', '10', '4', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('STOCK_REORDER_LEVEL', '5', '10', '5', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('STORE_PAGE_PARSE_TIME', 'false', '11', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/tep/page_parse_time.log', '11', '2', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', '11', '3', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('DISPLAY_PAGE_PARSE_TIME', 'true', '11', '4', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('STORE_DB_TRANSACTIONS', 'false', '11', '5', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('CACHE_LEVEL', '0', '12', '1', 'xos_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('COMPILE_CHECK', 'false', '12', '2', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('ALLOW_VISITORS_TO_CHANGE_TEMPLATE', 'true', '12', '3', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('DEFAULT_TPL', 'black-tabs', '12', '4', 'xos_cfg_pull_down_templates(', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('REGISTERED_TPLS', 'black-tabs,black-tabs-cbox,black-tabs-cbox-dotted,blue-tabs-a,blue-tabs-b,blue-tabs-c,blue-tabs-c-html5,dark-standard,dark-tabs,orange-standard,orange-table,orange-tabs,orange-tabs-table,osc-table', '12', '5', 'xos_get_registered_tpls_list', 'xos_cfg_checkbox_templates(', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SEND_EMAILS', 'true', '13', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('EMAIL_USE_HTML', 'true', '13', '2', 'xos_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('EMAIL_SHOP_LOGO', 'shop_logo.gif', '13', '3', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('ENTRY_EMAIL_ADDRESS_CHECK', 'false', '13', '4', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('EMAIL_TRANSPORT', 'sendmail', '13', '5', 'xos_cfg_select_option(array(\'sendmail\', \'smtp\'),', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SENDMAIL_PATH', '/usr/sbin/sendmail', '13', '6', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SMTP_HOST', 'smtp1.example.com:25;smtp2.example.com', '13', '7', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SMTP_AUTH', 'false', '13', '8', 'xos_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SMTP_SECURE', '---', '13', '9', 'xos_cfg_select_option(array(\'---\', \'ssl\', \'tls\'),', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SMTP_USERNAME', 'Please Enter', '13', '10', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SMTP_PASSWORD', 'Please Enter', '13', '11', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('DOWNLOAD_ENABLED', 'false', '14', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('DOWNLOAD_BY_REDIRECT', 'false', '14', '2', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('DOWNLOAD_MAX_DAYS', '7', '14', '3', '', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('DOWNLOAD_MAX_COUNT', '5', '14', '4', '', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('GZIP_COMPRESSION', 'false', '15', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('GZIP_LEVEL', '5', '15', '2', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('SESSION_WRITE_DIRECTORY', '/tmp', '16', '1', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SESSION_FORCE_COOKIE_USE', 'false', '16', '2', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SESSION_CHECK_SSL_SESSION_ID', 'false', '16', '3', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SESSION_CHECK_USER_AGENT', 'false', '16', '4', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SESSION_CHECK_IP_ADDRESS', 'false', '16', '5', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SESSION_BLOCK_SPIDERS', 'true', '16', '6', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SESSION_RECREATE', 'false', '16', '7', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('SITE_OFFLINE', 'false', '17', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO contents (content_id, type, status, sort_order, date_added) VALUES ('1', 'info', '1', '1', now());
INSERT INTO contents (content_id, type, status, sort_order, date_added) VALUES ('2', 'info', '1', '2', now());
INSERT INTO contents (content_id, type, status, sort_order, date_added) VALUES ('3', 'info', '1', '3', now());
INSERT INTO contents (content_id, type, status, sort_order, date_added) VALUES ('4', 'index', '1', '0', now());
INSERT INTO contents (content_id, type, status, sort_order, date_added) VALUES ('5', 'system_popup', '1', '0', now());
INSERT INTO contents (content_id, type, status, sort_order, date_added) VALUES ('6', 'system_popup', '1', '0', now());
INSERT INTO contents (content_id, type, status, sort_order, date_added) VALUES ('7', 'system_popup', '1', '0', now());
INSERT INTO contents (content_id, type, status, sort_order, date_added) VALUES ('8', 'system_popup', '1', '0', now());
INSERT INTO contents (content_id, type, status, sort_order, date_added) VALUES ('9', 'system_popup', '1', '0', now());

INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('1', '1', 'Shipping &amp; Returns', 'Shipping &amp; Returns', 'Put here your Shipping &amp; Returns information.');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('1', '2', 'Liefer- und Versandkosten', 'Liefer- und Versandkosten', 'Fügen Sie hier Ihre Informationen über Liefer- und Versandkosten ein.');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('1', '3', 'Envíos / Devoluciones', 'Envíos y Devoluciones', 'Ponga aqui información sobre los Envíos y Devoluciones.');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('2', '1', 'Privacy Notice', 'Privacy Notice', 'Put here your Privacy Notice information.');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('2', '2', 'Privatsphäre / Datenschutz', 'Privatsphäre und Datenschutz', 'Fügen Sie hier Ihre Informationen über Privatsphäre und Datenschutz ein.');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('2', '3', 'Confidencialidad', 'Confidencialidad', 'Ponga aqui información sobre el tratamiento de los datos.');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('3', '1', 'Terms and Conditions', 'General Business Conditions', 'Put here your general business conditions information.');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('3', '2', 'Unsere AGB\'s', 'Allgemeine Geschäftsbedingungen', 'Fügen Sie hier Ihre allgemeinen Geschäftsbedingungen ein.');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('3', '3', 'Términos y Condiciones', 'Condiciones General de Negocios', 'Ponga aqui sus condiciones general de negocios.');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('4', '1', 'What\'s New Here?', 'What\'s New Here?', '<div>This is a default setup of the XOS-Shop project, products shown are for demonstrational purposes, <strong>any products purchased will not be delivered nor will the customer be billed</strong>. Any information seen on these products is to be treated as fictional.</div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('4', '2', 'Unser Angebot', 'Unser Angebot', '<div>Dies ist eine Standardinstallation von XOS-Shop. Alle hier gezeigten Produkte sind fiktiv zu verstehen. <strong>Eine hier getätigte Bestellung wird NICHT ausgeführt werden, Sie erhalten keine Lieferung oder Rechnung.</strong></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) VALUES ('4', '3', '¿Que hay de nuevo por aqui?', '¿Que hay de nuevo por aqui?', '<div>Esta es la configuración por defecto de XOS-Shop, los productos mostrados aqui son únicamente para demonstración, <strong>cualquier compra realizada no será entregada al cliente, ni se le cobrará</strong>. Cualquier información que vea sobre estos productos debe ser tratada como ficticia.</div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('5', '2', 'Liefer- und Versandkosten', 'Liefer- und Versandkosten', '<div style=\"width: 600px;\"><p>Fügen Sie hier Ihre Informationen über Liefer- und Versandkosten ein.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('5', '1', 'Shipping &amp; Returns', 'Shipping &amp; Returns', '<div style=\"width: 600px;\"><p>Put here your Shipping &amp; Returns information.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('5', '3', 'Envíos / Devoluciones', 'Envíos y Devoluciones', '<div style=\"width: 600px;\"><p>Ponga aqui información sobre los Envíos y Devoluciones.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('6', '2', 'Privatsphäre / Datenschutz', 'Privatsphäre und Datenschutz', '<div style=\"width: 600px;\"><p>Fügen Sie hier Ihre Informationen über Privatsphäre und Datenschutz ein.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('6', '1', 'Privacy Notice', 'Privacy Notice', '<div style=\"width: 600px;\"><p>Put here your Privacy Notice information.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('6', '3', 'Confidencialidad', 'Confidencialidad', '<div style=\"width: 600px;\"><p>Ponga aqui información sobre el tratamiento de los datos.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('7', '2', 'Unsere AGB\'s', 'Allgemeine Geschäftsbedingungen', '<div style=\"width: 600px;\"><p>Fügen Sie hier Ihre allgemeinen Geschäftsbedingungen ein.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('7', '1', 'Terms and Conditions', 'General Business Conditions', '<div style=\"width: 600px;\"><p>Put here your general business conditions information.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('7', '3', 'Términos y Condiciones', 'Condiciones General de Negocios', '<div style=\"width: 600px;\"><p>Ponga aqui sus condiciones general de negocios.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('8', '2', 'Hilfe zur erweiterten Suche', 'Hilfe zur erweiterten Suche', '<div style=\"width: 600px;\"><p>Die Suchfunktion ermöglicht Ihnen die Suche in den Produktnamen, Produktbeschreibungen, Herstellern und Artikelnummern.<br /> <br /> Sie haben die Möglichkeit logische Operatoren wie \"AND\" (Und) und \"OR\" (oder) zu verwenden.<br /> <br /> Als Beispiel könnten Sie also angeben: <u>Microsoft AND Maus</u>.<br /> <br /> Desweiteren können Sie Klammern verwenden um die Suche zu verschachteln, also z.B.:<br /> <br /> <u>Microsoft AND (Maus OR Tastatur OR \"Visual Basic\")</u>.<br /> <br /> Mit Anführungszeichen können Sie mehrere Worte zu einem Suchbegriff zusammenfassen.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('8', '1', 'Search Help', 'Search Help', '<div style=\"width: 600px;\"><p>Keywords may be separated by AND and/or OR statements for greater control of the search results.<br /> <br /> For example, <u>Microsoft AND mouse</u> would generate a result set that contain both words. However, for <u>mouse OR keyboard</u>, the result set returned would contain both or either words.<br /> <br /> Exact matches can be searched for by enclosing keywords in double-quotes.<br /> <br /> For example, <u>\"notebook computer\"</u> would generate a result set which match the exact string.<br /> <br /> Brackets can be used for further control on the result set.<br /> <br /> For example, <u>Microsoft and (keyboard or mouse or \"visual basic\")</u>.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('8', '3', 'Consejos para Búsqueda Avanzada', 'Consejos para Búsqueda Avanzada', '<div style=\"width: 600px;\"><p>El motor de búsqueda le permite hacer una búsqueda por palabras clave en el modelo, nombre y descripción del producto y en el nombre del fabricante.<br /> <br /> Cuando haga una busqueda por palabras o frases clave, puede separar estas con los operadores lógicos AND y OR. Por ejemplo, puede hacer una busqueda por <u>microsoft AND raton</u>. Esta búsqueda daría como resultado los productos que contengan ambas palabras. Por el contrario, si teclea <u>raton OR teclado</u>, conseguirá una lista de los productos que contengan las dos o solo una de las palabras. Si no se separan las palabras o frases clave con AND o con OR, la búsqueda se hara usando por defecto el operador logico AND.<br /> <br /> Puede realizar busquedas exactas de varias palabras encerrandolas entre comillas. Por ejemplo, si busca <u>\"ordenador portatil\"</u>, obtendrás una lista de productos que tengan exactamente esa cadena en ellos.<br /> <br /> Se pueden usar paratensis para controlar el orden de las operaciones lógicas. Por ejemplo, puede introducir <u>microsoft and (teclado or raton or \"visual basic\")</u>.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('9', '2', 'Besucherwarenkorb / Kundenwarenkorb', 'Besucherwarenkorb / Kundenwarenkorb', '<div style=\"width: 600px;\"><p><b><i>Besucherwarenkorb</i></b><br /> Jeder Besucher unseres Online-Shops bekommt einen \'Besucherwarenkorb\'. Damit kann er seine ausgewählten Produkte sammeln. Sobald der Besucher den Online-Shop verlässt, verfällt dessen Inhalt.</p> <p><b><i>Kundenwarenkorb</i></b><br /> Jeder angemeldete Kunde verfügt über einen \'Kundenwarenkorb\' zum Einkaufen, mit dem er auch zu einem späterem Zeitpunkt den Einkauf beenden kann. Jeder Artikel bleibt darin registriert bis der Kunde zur Kasse geht, oder die Produkte darin löscht.</p> <p><b><i>Information</i></b><br /> Die Besuchereingaben werden automatisch bei der Registrierung als Kunde in den Kundenwarenkorb übernommen</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('9', '1', 'Visitors Cart / Members Cart', 'Visitors Cart / Members Cart', '<div style=\"width: 600px;\"><p><b><i>Visitors Cart</i></b><br /> Every visitor to our online shop will be given a \'Visitors Cart\'. This allows the visitor to store their products in a temporary shopping cart. Once the visitor leaves the online shop, so will the contents of their shopping cart.</p> <p><b><i>Members Cart</i></b><br /> Every member to our online shop that logs in is given a \'Members Cart\'. This allows the member to add products to their shopping cart, and come back at a later date to finalize their checkout. All products remain in their shopping cart until the member has checked them out, or removed the products themselves.</p> <p><b><i>Info</i></b><br /> If a member adds products to their \'Visitors Cart\' and decides to log in to the online shop to use their \'Members Cart\', the contents of their \'Visitors Cart\' will merge with their \'Members Cart\' contents automatically.</p></div>');
INSERT INTO contents_data (content_id, language_id, name, heading_title, content) values ('9', '3', 'Cesta del Visitante / Cesta del Asociado', 'Cesta del Visitante / Cesta del Asociado', '<div style=\"width: 600px;\"><p><b><i>Cesta de Visitante</i></b><br /> A cada visitante de nuestro catálogo le es asignado una \'Cesta de Visitante\'. Esto permite al invitado guardar sus productos en una cesta temporal. Una vez que el visitante abandona el catálogo, tambien desaparece el contenido de su cesta.</p> <p><b><i>Cesta de Asociado</i></b><br /> A cada miembro nuestro se le asigna una \'Cesta de Asociado\'. Esto permite al asociado añadir productos a su cesta de la compra, y volver mas tarde para finalizar el pedido. Todos los productos permanecen en la cesta hasta que el asociado ha realizado el pedido, o hasta que sean eliminados de la cesta manualmente.</p> <p><b><i>Información</i></b><br /> Si un asociado añade un articulo a su \'Cesta de Visitante\' y despues decide Entrar a su Cuenta para usar su \'Cesta de Asociado\', el contenido de la \'Cesta de Visitante\' sera añadido a la \'Cesta de Asociado\' automáticamente.</p></div>');

INSERT INTO countries VALUES (14,'Österreich','AT','AUT','5');
INSERT INTO countries VALUES (81,'Deutschland','DE','DEU','5');
INSERT INTO countries VALUES (204,'Schweiz','CH','CHE','1');

INSERT INTO countries_list VALUES (1,'Afghanistan','AF','AFG','1');
INSERT INTO countries_list VALUES (2,'Albania','AL','ALB','1');
INSERT INTO countries_list VALUES (3,'Algeria','DZ','DZA','1');
INSERT INTO countries_list VALUES (4,'American Samoa','AS','ASM','1');
INSERT INTO countries_list VALUES (5,'Andorra','AD','AND','1');
INSERT INTO countries_list VALUES (6,'Angola','AO','AGO','1');
INSERT INTO countries_list VALUES (7,'Anguilla','AI','AIA','1');
INSERT INTO countries_list VALUES (8,'Antarctica','AQ','ATA','1');
INSERT INTO countries_list VALUES (9,'Antigua and Barbuda','AG','ATG','1');
INSERT INTO countries_list VALUES (10,'Argentina','AR','ARG','1');
INSERT INTO countries_list VALUES (11,'Armenia','AM','ARM','1');
INSERT INTO countries_list VALUES (12,'Aruba','AW','ABW','1');
INSERT INTO countries_list VALUES (13,'Australia','AU','AUS','1');
INSERT INTO countries_list VALUES (14,'Austria','AT','AUT','5');
INSERT INTO countries_list VALUES (15,'Azerbaijan','AZ','AZE','1');
INSERT INTO countries_list VALUES (16,'Bahamas','BS','BHS','1');
INSERT INTO countries_list VALUES (17,'Bahrain','BH','BHR','1');
INSERT INTO countries_list VALUES (18,'Bangladesh','BD','BGD','1');
INSERT INTO countries_list VALUES (19,'Barbados','BB','BRB','1');
INSERT INTO countries_list VALUES (20,'Belarus','BY','BLR','1');
INSERT INTO countries_list VALUES (21,'Belgium','BE','BEL','1');
INSERT INTO countries_list VALUES (22,'Belize','BZ','BLZ','1');
INSERT INTO countries_list VALUES (23,'Benin','BJ','BEN','1');
INSERT INTO countries_list VALUES (24,'Bermuda','BM','BMU','1');
INSERT INTO countries_list VALUES (25,'Bhutan','BT','BTN','1');
INSERT INTO countries_list VALUES (26,'Bolivia','BO','BOL','1');
INSERT INTO countries_list VALUES (27,'Bosnia and Herzegowina','BA','BIH','1');
INSERT INTO countries_list VALUES (28,'Botswana','BW','BWA','1');
INSERT INTO countries_list VALUES (29,'Bouvet Island','BV','BVT','1');
INSERT INTO countries_list VALUES (30,'Brazil','BR','BRA','1');
INSERT INTO countries_list VALUES (31,'British Indian Ocean Territory','IO','IOT','1');
INSERT INTO countries_list VALUES (32,'Brunei Darussalam','BN','BRN','1');
INSERT INTO countries_list VALUES (33,'Bulgaria','BG','BGR','1');
INSERT INTO countries_list VALUES (34,'Burkina Faso','BF','BFA','1');
INSERT INTO countries_list VALUES (35,'Burundi','BI','BDI','1');
INSERT INTO countries_list VALUES (36,'Cambodia','KH','KHM','1');
INSERT INTO countries_list VALUES (37,'Cameroon','CM','CMR','1');
INSERT INTO countries_list VALUES (38,'Canada','CA','CAN','1');
INSERT INTO countries_list VALUES (39,'Cape Verde','CV','CPV','1');
INSERT INTO countries_list VALUES (40,'Cayman Islands','KY','CYM','1');
INSERT INTO countries_list VALUES (41,'Central African Republic','CF','CAF','1');
INSERT INTO countries_list VALUES (42,'Chad','TD','TCD','1');
INSERT INTO countries_list VALUES (43,'Chile','CL','CHL','1');
INSERT INTO countries_list VALUES (44,'China','CN','CHN','1');
INSERT INTO countries_list VALUES (45,'Christmas Island','CX','CXR','1');
INSERT INTO countries_list VALUES (46,'Cocos (Keeling) Islands','CC','CCK','1');
INSERT INTO countries_list VALUES (47,'Colombia','CO','COL','1');
INSERT INTO countries_list VALUES (48,'Comoros','KM','COM','1');
INSERT INTO countries_list VALUES (49,'Congo','CG','COG','1');
INSERT INTO countries_list VALUES (50,'Cook Islands','CK','COK','1');
INSERT INTO countries_list VALUES (51,'Costa Rica','CR','CRI','1');
INSERT INTO countries_list VALUES (52,'Cote D\'Ivoire','CI','CIV','1');
INSERT INTO countries_list VALUES (53,'Croatia','HR','HRV','1');
INSERT INTO countries_list VALUES (54,'Cuba','CU','CUB','1');
INSERT INTO countries_list VALUES (55,'Cyprus','CY','CYP','1');
INSERT INTO countries_list VALUES (56,'Czech Republic','CZ','CZE','1');
INSERT INTO countries_list VALUES (57,'Denmark','DK','DNK','1');
INSERT INTO countries_list VALUES (58,'Djibouti','DJ','DJI','1');
INSERT INTO countries_list VALUES (59,'Dominica','DM','DMA','1');
INSERT INTO countries_list VALUES (60,'Dominican Republic','DO','DOM','1');
INSERT INTO countries_list VALUES (61,'East Timor','TP','TMP','1');
INSERT INTO countries_list VALUES (62,'Ecuador','EC','ECU','1');
INSERT INTO countries_list VALUES (63,'Egypt','EG','EGY','1');
INSERT INTO countries_list VALUES (64,'El Salvador','SV','SLV','1');
INSERT INTO countries_list VALUES (65,'Equatorial Guinea','GQ','GNQ','1');
INSERT INTO countries_list VALUES (66,'Eritrea','ER','ERI','1');
INSERT INTO countries_list VALUES (67,'Estonia','EE','EST','1');
INSERT INTO countries_list VALUES (68,'Ethiopia','ET','ETH','1');
INSERT INTO countries_list VALUES (69,'Falkland Islands (Malvinas)','FK','FLK','1');
INSERT INTO countries_list VALUES (70,'Faroe Islands','FO','FRO','1');
INSERT INTO countries_list VALUES (71,'Fiji','FJ','FJI','1');
INSERT INTO countries_list VALUES (72,'Finland','FI','FIN','1');
INSERT INTO countries_list VALUES (73,'France','FR','FRA','1');
INSERT INTO countries_list VALUES (74,'France, Metropolitan','FX','FXX','1');
INSERT INTO countries_list VALUES (75,'French Guiana','GF','GUF','1');
INSERT INTO countries_list VALUES (76,'French Polynesia','PF','PYF','1');
INSERT INTO countries_list VALUES (77,'French Southern Territories','TF','ATF','1');
INSERT INTO countries_list VALUES (78,'Gabon','GA','GAB','1');
INSERT INTO countries_list VALUES (79,'Gambia','GM','GMB','1');
INSERT INTO countries_list VALUES (80,'Georgia','GE','GEO','1');
INSERT INTO countries_list VALUES (81,'Germany','DE','DEU','5');
INSERT INTO countries_list VALUES (82,'Ghana','GH','GHA','1');
INSERT INTO countries_list VALUES (83,'Gibraltar','GI','GIB','1');
INSERT INTO countries_list VALUES (84,'Greece','GR','GRC','1');
INSERT INTO countries_list VALUES (85,'Greenland','GL','GRL','1');
INSERT INTO countries_list VALUES (86,'Grenada','GD','GRD','1');
INSERT INTO countries_list VALUES (87,'Guadeloupe','GP','GLP','1');
INSERT INTO countries_list VALUES (88,'Guam','GU','GUM','1');
INSERT INTO countries_list VALUES (89,'Guatemala','GT','GTM','1');
INSERT INTO countries_list VALUES (90,'Guinea','GN','GIN','1');
INSERT INTO countries_list VALUES (91,'Guinea-bissau','GW','GNB','1');
INSERT INTO countries_list VALUES (92,'Guyana','GY','GUY','1');
INSERT INTO countries_list VALUES (93,'Haiti','HT','HTI','1');
INSERT INTO countries_list VALUES (94,'Heard and Mc Donald Islands','HM','HMD','1');
INSERT INTO countries_list VALUES (95,'Honduras','HN','HND','1');
INSERT INTO countries_list VALUES (96,'Hong Kong','HK','HKG','1');
INSERT INTO countries_list VALUES (97,'Hungary','HU','HUN','1');
INSERT INTO countries_list VALUES (98,'Iceland','IS','ISL','1');
INSERT INTO countries_list VALUES (99,'India','IN','IND','1');
INSERT INTO countries_list VALUES (100,'Indonesia','ID','IDN','1');
INSERT INTO countries_list VALUES (101,'Iran (Islamic Republic of)','IR','IRN','1');
INSERT INTO countries_list VALUES (102,'Iraq','IQ','IRQ','1');
INSERT INTO countries_list VALUES (103,'Ireland','IE','IRL','1');
INSERT INTO countries_list VALUES (104,'Israel','IL','ISR','1');
INSERT INTO countries_list VALUES (105,'Italy','IT','ITA','1');
INSERT INTO countries_list VALUES (106,'Jamaica','JM','JAM','1');
INSERT INTO countries_list VALUES (107,'Japan','JP','JPN','1');
INSERT INTO countries_list VALUES (108,'Jordan','JO','JOR','1');
INSERT INTO countries_list VALUES (109,'Kazakhstan','KZ','KAZ','1');
INSERT INTO countries_list VALUES (110,'Kenya','KE','KEN','1');
INSERT INTO countries_list VALUES (111,'Kiribati','KI','KIR','1');
INSERT INTO countries_list VALUES (112,'Korea, Democratic People\'s Republic of','KP','PRK','1');
INSERT INTO countries_list VALUES (113,'Korea, Republic of','KR','KOR','1');
INSERT INTO countries_list VALUES (114,'Kuwait','KW','KWT','1');
INSERT INTO countries_list VALUES (115,'Kyrgyzstan','KG','KGZ','1');
INSERT INTO countries_list VALUES (116,'Lao People\'s Democratic Republic','LA','LAO','1');
INSERT INTO countries_list VALUES (117,'Latvia','LV','LVA','1');
INSERT INTO countries_list VALUES (118,'Lebanon','LB','LBN','1');
INSERT INTO countries_list VALUES (119,'Lesotho','LS','LSO','1');
INSERT INTO countries_list VALUES (120,'Liberia','LR','LBR','1');
INSERT INTO countries_list VALUES (121,'Libyan Arab Jamahiriya','LY','LBY','1');
INSERT INTO countries_list VALUES (122,'Liechtenstein','LI','LIE','1');
INSERT INTO countries_list VALUES (123,'Lithuania','LT','LTU','1');
INSERT INTO countries_list VALUES (124,'Luxembourg','LU','LUX','1');
INSERT INTO countries_list VALUES (125,'Macau','MO','MAC','1');
INSERT INTO countries_list VALUES (126,'Macedonia, The Former Yugoslav Republic of','MK','MKD','1');
INSERT INTO countries_list VALUES (127,'Madagascar','MG','MDG','1');
INSERT INTO countries_list VALUES (128,'Malawi','MW','MWI','1');
INSERT INTO countries_list VALUES (129,'Malaysia','MY','MYS','1');
INSERT INTO countries_list VALUES (130,'Maldives','MV','MDV','1');
INSERT INTO countries_list VALUES (131,'Mali','ML','MLI','1');
INSERT INTO countries_list VALUES (132,'Malta','MT','MLT','1');
INSERT INTO countries_list VALUES (133,'Marshall Islands','MH','MHL','1');
INSERT INTO countries_list VALUES (134,'Martinique','MQ','MTQ','1');
INSERT INTO countries_list VALUES (135,'Mauritania','MR','MRT','1');
INSERT INTO countries_list VALUES (136,'Mauritius','MU','MUS','1');
INSERT INTO countries_list VALUES (137,'Mayotte','YT','MYT','1');
INSERT INTO countries_list VALUES (138,'Mexico','MX','MEX','1');
INSERT INTO countries_list VALUES (139,'Micronesia, Federated States of','FM','FSM','1');
INSERT INTO countries_list VALUES (140,'Moldova, Republic of','MD','MDA','1');
INSERT INTO countries_list VALUES (141,'Monaco','MC','MCO','1');
INSERT INTO countries_list VALUES (142,'Mongolia','MN','MNG','1');
INSERT INTO countries_list VALUES (143,'Montserrat','MS','MSR','1');
INSERT INTO countries_list VALUES (144,'Morocco','MA','MAR','1');
INSERT INTO countries_list VALUES (145,'Mozambique','MZ','MOZ','1');
INSERT INTO countries_list VALUES (146,'Myanmar','MM','MMR','1');
INSERT INTO countries_list VALUES (147,'Namibia','NA','NAM','1');
INSERT INTO countries_list VALUES (148,'Nauru','NR','NRU','1');
INSERT INTO countries_list VALUES (149,'Nepal','NP','NPL','1');
INSERT INTO countries_list VALUES (150,'Netherlands','NL','NLD','1');
INSERT INTO countries_list VALUES (151,'Netherlands Antilles','AN','ANT','1');
INSERT INTO countries_list VALUES (152,'New Caledonia','NC','NCL','1');
INSERT INTO countries_list VALUES (153,'New Zealand','NZ','NZL','1');
INSERT INTO countries_list VALUES (154,'Nicaragua','NI','NIC','1');
INSERT INTO countries_list VALUES (155,'Niger','NE','NER','1');
INSERT INTO countries_list VALUES (156,'Nigeria','NG','NGA','1');
INSERT INTO countries_list VALUES (157,'Niue','NU','NIU','1');
INSERT INTO countries_list VALUES (158,'Norfolk Island','NF','NFK','1');
INSERT INTO countries_list VALUES (159,'Northern Mariana Islands','MP','MNP','1');
INSERT INTO countries_list VALUES (160,'Norway','NO','NOR','1');
INSERT INTO countries_list VALUES (161,'Oman','OM','OMN','1');
INSERT INTO countries_list VALUES (162,'Pakistan','PK','PAK','1');
INSERT INTO countries_list VALUES (163,'Palau','PW','PLW','1');
INSERT INTO countries_list VALUES (164,'Panama','PA','PAN','1');
INSERT INTO countries_list VALUES (165,'Papua New Guinea','PG','PNG','1');
INSERT INTO countries_list VALUES (166,'Paraguay','PY','PRY','1');
INSERT INTO countries_list VALUES (167,'Peru','PE','PER','1');
INSERT INTO countries_list VALUES (168,'Philippines','PH','PHL','1');
INSERT INTO countries_list VALUES (169,'Pitcairn','PN','PCN','1');
INSERT INTO countries_list VALUES (170,'Poland','PL','POL','1');
INSERT INTO countries_list VALUES (171,'Portugal','PT','PRT','1');
INSERT INTO countries_list VALUES (172,'Puerto Rico','PR','PRI','1');
INSERT INTO countries_list VALUES (173,'Qatar','QA','QAT','1');
INSERT INTO countries_list VALUES (174,'Reunion','RE','REU','1');
INSERT INTO countries_list VALUES (175,'Romania','RO','ROM','1');
INSERT INTO countries_list VALUES (176,'Russian Federation','RU','RUS','1');
INSERT INTO countries_list VALUES (177,'Rwanda','RW','RWA','1');
INSERT INTO countries_list VALUES (178,'Saint Kitts and Nevis','KN','KNA','1');
INSERT INTO countries_list VALUES (179,'Saint Lucia','LC','LCA','1');
INSERT INTO countries_list VALUES (180,'Saint Vincent and the Grenadines','VC','VCT','1');
INSERT INTO countries_list VALUES (181,'Samoa','WS','WSM','1');
INSERT INTO countries_list VALUES (182,'San Marino','SM','SMR','1');
INSERT INTO countries_list VALUES (183,'Sao Tome and Principe','ST','STP','1');
INSERT INTO countries_list VALUES (184,'Saudi Arabia','SA','SAU','1');
INSERT INTO countries_list VALUES (185,'Senegal','SN','SEN','1');
INSERT INTO countries_list VALUES (186,'Seychelles','SC','SYC','1');
INSERT INTO countries_list VALUES (187,'Sierra Leone','SL','SLE','1');
INSERT INTO countries_list VALUES (188,'Singapore','SG','SGP', '4');
INSERT INTO countries_list VALUES (189,'Slovakia (Slovak Republic)','SK','SVK','1');
INSERT INTO countries_list VALUES (190,'Slovenia','SI','SVN','1');
INSERT INTO countries_list VALUES (191,'Solomon Islands','SB','SLB','1');
INSERT INTO countries_list VALUES (192,'Somalia','SO','SOM','1');
INSERT INTO countries_list VALUES (193,'South Africa','ZA','ZAF','1');
INSERT INTO countries_list VALUES (194,'South Georgia and the South Sandwich Islands','GS','SGS','1');
INSERT INTO countries_list VALUES (195,'Spain','ES','ESP','3');
INSERT INTO countries_list VALUES (196,'Sri Lanka','LK','LKA','1');
INSERT INTO countries_list VALUES (197,'St. Helena','SH','SHN','1');
INSERT INTO countries_list VALUES (198,'St. Pierre and Miquelon','PM','SPM','1');
INSERT INTO countries_list VALUES (199,'Sudan','SD','SDN','1');
INSERT INTO countries_list VALUES (200,'Suriname','SR','SUR','1');
INSERT INTO countries_list VALUES (201,'Svalbard and Jan Mayen Islands','SJ','SJM','1');
INSERT INTO countries_list VALUES (202,'Swaziland','SZ','SWZ','1');
INSERT INTO countries_list VALUES (203,'Sweden','SE','SWE','1');
INSERT INTO countries_list VALUES (204,'Switzerland','CH','CHE','1');
INSERT INTO countries_list VALUES (205,'Syrian Arab Republic','SY','SYR','1');
INSERT INTO countries_list VALUES (206,'Taiwan','TW','TWN','1');
INSERT INTO countries_list VALUES (207,'Tajikistan','TJ','TJK','1');
INSERT INTO countries_list VALUES (208,'Tanzania, United Republic of','TZ','TZA','1');
INSERT INTO countries_list VALUES (209,'Thailand','TH','THA','1');
INSERT INTO countries_list VALUES (210,'Togo','TG','TGO','1');
INSERT INTO countries_list VALUES (211,'Tokelau','TK','TKL','1');
INSERT INTO countries_list VALUES (212,'Tonga','TO','TON','1');
INSERT INTO countries_list VALUES (213,'Trinidad and Tobago','TT','TTO','1');
INSERT INTO countries_list VALUES (214,'Tunisia','TN','TUN','1');
INSERT INTO countries_list VALUES (215,'Turkey','TR','TUR','1');
INSERT INTO countries_list VALUES (216,'Turkmenistan','TM','TKM','1');
INSERT INTO countries_list VALUES (217,'Turks and Caicos Islands','TC','TCA','1');
INSERT INTO countries_list VALUES (218,'Tuvalu','TV','TUV','1');
INSERT INTO countries_list VALUES (219,'Uganda','UG','UGA','1');
INSERT INTO countries_list VALUES (220,'Ukraine','UA','UKR','1');
INSERT INTO countries_list VALUES (221,'United Arab Emirates','AE','ARE','1');
INSERT INTO countries_list VALUES (222,'United Kingdom','GB','GBR','1');
INSERT INTO countries_list VALUES (223,'United States','US','USA', '2');
INSERT INTO countries_list VALUES (224,'United States Minor Outlying Islands','UM','UMI','1');
INSERT INTO countries_list VALUES (225,'Uruguay','UY','URY','1');
INSERT INTO countries_list VALUES (226,'Uzbekistan','UZ','UZB','1');
INSERT INTO countries_list VALUES (227,'Vanuatu','VU','VUT','1');
INSERT INTO countries_list VALUES (228,'Vatican City State (Holy See)','VA','VAT','1');
INSERT INTO countries_list VALUES (229,'Venezuela','VE','VEN','1');
INSERT INTO countries_list VALUES (230,'Viet Nam','VN','VNM','1');
INSERT INTO countries_list VALUES (231,'Virgin Islands (British)','VG','VGB','1');
INSERT INTO countries_list VALUES (232,'Virgin Islands (U.S.)','VI','VIR','1');
INSERT INTO countries_list VALUES (233,'Wallis and Futuna Islands','WF','WLF','1');
INSERT INTO countries_list VALUES (234,'Western Sahara','EH','ESH','1');
INSERT INTO countries_list VALUES (235,'Yemen','YE','YEM','1');
INSERT INTO countries_list VALUES (236,'Yugoslavia','YU','YUG','1');
INSERT INTO countries_list VALUES (237,'Zaire','ZR','ZAR','1');
INSERT INTO countries_list VALUES (238,'Zambia','ZM','ZMB','1');
INSERT INTO countries_list VALUES (239,'Zimbabwe','ZW','ZWE','1');

INSERT INTO currencies VALUES ('1', '2', 'Schweizer Franken', 'CHF', '', 'CHF', '.', ',', '2', '1.00000000', now());
INSERT INTO currencies VALUES ('1', '1', 'Swiss franc', 'CHF', '', 'CHF', '.', ',', '2', '1.00000000', now());
INSERT INTO currencies VALUES ('1', '3', 'Franco suizo', 'CHF', '', 'CHF', '.', ',', '2', '1.00000000', now());
INSERT INTO currencies VALUES ('2', '2', 'Euro', 'EUR', '', '€', '.', ',', '2', '0.62760597', now());
INSERT INTO currencies VALUES ('2', '1', 'Euro', 'EUR', '', '€', '.', ',', '2', '0.62760597', now());
INSERT INTO currencies VALUES ('2', '3', 'Euro', 'EUR', '', '€', '.', ',', '2', '0.62760597', now());

INSERT INTO customers_groups VALUES ('0','Retail','','1','0','','');

INSERT INTO languages VALUES ('1', '3', '1', 'English','en','icon.gif','english',2);
INSERT INTO languages VALUES ('2', '3', '1', 'Deutsch','de','icon.gif','german',1);
INSERT INTO languages VALUES ('3', '3', '1', 'Español','es','icon.gif','espanol',3);

INSERT INTO orders_status VALUES ( '1', '1', 'Pending', '', '1', '0');
INSERT INTO orders_status VALUES ( '1', '2', 'Offen', '', '1', '0');
INSERT INTO orders_status VALUES ( '1', '3', 'Pendiente', '', '1', '0');
INSERT INTO orders_status VALUES ( '2', '1', 'Processing', '', '1', '0');
INSERT INTO orders_status VALUES ( '2', '2', 'In Bearbeitung', '', '1', '0');
INSERT INTO orders_status VALUES ( '2', '3', 'Proceso', '', '1', '0');
INSERT INTO orders_status VALUES ( '3', '1', 'Delivered', '', '1', '0');
INSERT INTO orders_status VALUES ( '3', '2', 'Versendet', '', '1', '0');
INSERT INTO orders_status VALUES ( '3', '3', 'Entregado', '', '1', '0');

# Germany
INSERT INTO zones VALUES (79,81,'NDS','Niedersachsen');
INSERT INTO zones VALUES (80,81,'BAW','Baden-Württemberg');
INSERT INTO zones VALUES (81,81,'BAY','Bayern');
INSERT INTO zones VALUES (82,81,'BER','Berlin');
INSERT INTO zones VALUES (83,81,'BRG','Brandenburg');
INSERT INTO zones VALUES (84,81,'BRE','Bremen');
INSERT INTO zones VALUES (85,81,'HAM','Hamburg');
INSERT INTO zones VALUES (86,81,'HES','Hessen');
INSERT INTO zones VALUES (87,81,'MEC','Mecklenburg-Vorpommern');
INSERT INTO zones VALUES (88,81,'NRW','Nordrhein-Westfalen');
INSERT INTO zones VALUES (89,81,'RHE','Rheinland-Pfalz');
INSERT INTO zones VALUES (90,81,'SAR','Saarland');
INSERT INTO zones VALUES (91,81,'SAS','Sachsen');
INSERT INTO zones VALUES (92,81,'SAC','Sachsen-Anhalt');
INSERT INTO zones VALUES (93,81,'SCN','Schleswig-Holstein');
INSERT INTO zones VALUES (94,81,'THE','Thüringen');

# Austria
INSERT INTO zones VALUES (95,14,'WI','Wien');
INSERT INTO zones VALUES (96,14,'NO','Niederösterreich');
INSERT INTO zones VALUES (97,14,'OO','Oberösterreich');
INSERT INTO zones VALUES (98,14,'SB','Salzburg');
INSERT INTO zones VALUES (99,14,'KN','Kärnten');
INSERT INTO zones VALUES (100,14,'ST','Steiermark');
INSERT INTO zones VALUES (101,14,'TI','Tirol');
INSERT INTO zones VALUES (102,14,'BL','Burgenland');
INSERT INTO zones VALUES (103,14,'VB','Voralberg');

# Swizterland
INSERT INTO zones VALUES (104,204,'AG','Aargau');
INSERT INTO zones VALUES (105,204,'AI','Appenzell Innerrhoden');
INSERT INTO zones VALUES (106,204,'AR','Appenzell Ausserrhoden');
INSERT INTO zones VALUES (107,204,'BE','Bern');
INSERT INTO zones VALUES (108,204,'BL','Basel-Landschaft');
INSERT INTO zones VALUES (109,204,'BS','Basel-Stadt');
INSERT INTO zones VALUES (110,204,'FR','Freiburg');
INSERT INTO zones VALUES (111,204,'GE','Genf');
INSERT INTO zones VALUES (112,204,'GL','Glarus');
INSERT INTO zones VALUES (113,204,'GR','Graubünden');
INSERT INTO zones VALUES (114,204,'JU','Jura');
INSERT INTO zones VALUES (115,204,'LU','Luzern');
INSERT INTO zones VALUES (116,204,'NE','Neuenburg');
INSERT INTO zones VALUES (117,204,'NW','Nidwalden');
INSERT INTO zones VALUES (118,204,'OW','Obwalden');
INSERT INTO zones VALUES (119,204,'SG','St. Gallen');
INSERT INTO zones VALUES (120,204,'SH','Schaffhausen');
INSERT INTO zones VALUES (121,204,'SO','Solothurn');
INSERT INTO zones VALUES (122,204,'SZ','Schwyz');
INSERT INTO zones VALUES (123,204,'TG','Thurgau');
INSERT INTO zones VALUES (124,204,'TI','Tessin');
INSERT INTO zones VALUES (125,204,'UR','Uri');
INSERT INTO zones VALUES (126,204,'VD','Waadt');
INSERT INTO zones VALUES (127,204,'VS','Wallis');
INSERT INTO zones VALUES (128,204,'ZG','Zug');
INSERT INTO zones VALUES (129,204,'ZH','Zürich');


# USA
INSERT INTO zones_list VALUES (1,223,'AL','Alabama');
INSERT INTO zones_list VALUES (2,223,'AK','Alaska');
INSERT INTO zones_list VALUES (3,223,'AS','American Samoa');
INSERT INTO zones_list VALUES (4,223,'AZ','Arizona');
INSERT INTO zones_list VALUES (5,223,'AR','Arkansas');
INSERT INTO zones_list VALUES (6,223,'AF','Armed Forces Africa');
INSERT INTO zones_list VALUES (7,223,'AA','Armed Forces Americas');
INSERT INTO zones_list VALUES (8,223,'AC','Armed Forces Canada');
INSERT INTO zones_list VALUES (9,223,'AE','Armed Forces Europe');
INSERT INTO zones_list VALUES (10,223,'AM','Armed Forces Middle East');
INSERT INTO zones_list VALUES (11,223,'AP','Armed Forces Pacific');
INSERT INTO zones_list VALUES (12,223,'CA','California');
INSERT INTO zones_list VALUES (13,223,'CO','Colorado');
INSERT INTO zones_list VALUES (14,223,'CT','Connecticut');
INSERT INTO zones_list VALUES (15,223,'DE','Delaware');
INSERT INTO zones_list VALUES (16,223,'DC','District of Columbia');
INSERT INTO zones_list VALUES (17,223,'FM','Federated States Of Micronesia');
INSERT INTO zones_list VALUES (18,223,'FL','Florida');
INSERT INTO zones_list VALUES (19,223,'GA','Georgia');
INSERT INTO zones_list VALUES (20,223,'GU','Guam');
INSERT INTO zones_list VALUES (21,223,'HI','Hawaii');
INSERT INTO zones_list VALUES (22,223,'ID','Idaho');
INSERT INTO zones_list VALUES (23,223,'IL','Illinois');
INSERT INTO zones_list VALUES (24,223,'IN','Indiana');
INSERT INTO zones_list VALUES (25,223,'IA','Iowa');
INSERT INTO zones_list VALUES (26,223,'KS','Kansas');
INSERT INTO zones_list VALUES (27,223,'KY','Kentucky');
INSERT INTO zones_list VALUES (28,223,'LA','Louisiana');
INSERT INTO zones_list VALUES (29,223,'ME','Maine');
INSERT INTO zones_list VALUES (30,223,'MH','Marshall Islands');
INSERT INTO zones_list VALUES (31,223,'MD','Maryland');
INSERT INTO zones_list VALUES (32,223,'MA','Massachusetts');
INSERT INTO zones_list VALUES (33,223,'MI','Michigan');
INSERT INTO zones_list VALUES (34,223,'MN','Minnesota');
INSERT INTO zones_list VALUES (35,223,'MS','Mississippi');
INSERT INTO zones_list VALUES (36,223,'MO','Missouri');
INSERT INTO zones_list VALUES (37,223,'MT','Montana');
INSERT INTO zones_list VALUES (38,223,'NE','Nebraska');
INSERT INTO zones_list VALUES (39,223,'NV','Nevada');
INSERT INTO zones_list VALUES (40,223,'NH','New Hampshire');
INSERT INTO zones_list VALUES (41,223,'NJ','New Jersey');
INSERT INTO zones_list VALUES (42,223,'NM','New Mexico');
INSERT INTO zones_list VALUES (43,223,'NY','New York');
INSERT INTO zones_list VALUES (44,223,'NC','North Carolina');
INSERT INTO zones_list VALUES (45,223,'ND','North Dakota');
INSERT INTO zones_list VALUES (46,223,'MP','Northern Mariana Islands');
INSERT INTO zones_list VALUES (47,223,'OH','Ohio');
INSERT INTO zones_list VALUES (48,223,'OK','Oklahoma');
INSERT INTO zones_list VALUES (49,223,'OR','Oregon');
INSERT INTO zones_list VALUES (50,223,'PW','Palau');
INSERT INTO zones_list VALUES (51,223,'PA','Pennsylvania');
INSERT INTO zones_list VALUES (52,223,'PR','Puerto Rico');
INSERT INTO zones_list VALUES (53,223,'RI','Rhode Island');
INSERT INTO zones_list VALUES (54,223,'SC','South Carolina');
INSERT INTO zones_list VALUES (55,223,'SD','South Dakota');
INSERT INTO zones_list VALUES (56,223,'TN','Tennessee');
INSERT INTO zones_list VALUES (57,223,'TX','Texas');
INSERT INTO zones_list VALUES (58,223,'UT','Utah');
INSERT INTO zones_list VALUES (59,223,'VT','Vermont');
INSERT INTO zones_list VALUES (60,223,'VI','Virgin Islands');
INSERT INTO zones_list VALUES (61,223,'VA','Virginia');
INSERT INTO zones_list VALUES (62,223,'WA','Washington');
INSERT INTO zones_list VALUES (63,223,'WV','West Virginia');
INSERT INTO zones_list VALUES (64,223,'WI','Wisconsin');
INSERT INTO zones_list VALUES (65,223,'WY','Wyoming');

# Canada
INSERT INTO zones_list VALUES (66,38,'AB','Alberta');
INSERT INTO zones_list VALUES (67,38,'BC','British Columbia');
INSERT INTO zones_list VALUES (68,38,'MB','Manitoba');
INSERT INTO zones_list VALUES (69,38,'NF','Newfoundland');
INSERT INTO zones_list VALUES (70,38,'NB','New Brunswick');
INSERT INTO zones_list VALUES (71,38,'NS','Nova Scotia');
INSERT INTO zones_list VALUES (72,38,'NT','Northwest Territories');
INSERT INTO zones_list VALUES (73,38,'NU','Nunavut');
INSERT INTO zones_list VALUES (74,38,'ON','Ontario');
INSERT INTO zones_list VALUES (75,38,'PE','Prince Edward Island');
INSERT INTO zones_list VALUES (76,38,'QC','Quebec');
INSERT INTO zones_list VALUES (77,38,'SK','Saskatchewan');
INSERT INTO zones_list VALUES (78,38,'YT','Yukon Territory');

# Germany
INSERT INTO zones_list VALUES (79,81,'NDS','Niedersachsen');
INSERT INTO zones_list VALUES (80,81,'BAW','Baden-Württemberg');
INSERT INTO zones_list VALUES (81,81,'BAY','Bayern');
INSERT INTO zones_list VALUES (82,81,'BER','Berlin');
INSERT INTO zones_list VALUES (83,81,'BRG','Brandenburg');
INSERT INTO zones_list VALUES (84,81,'BRE','Bremen');
INSERT INTO zones_list VALUES (85,81,'HAM','Hamburg');
INSERT INTO zones_list VALUES (86,81,'HES','Hessen');
INSERT INTO zones_list VALUES (87,81,'MEC','Mecklenburg-Vorpommern');
INSERT INTO zones_list VALUES (88,81,'NRW','Nordrhein-Westfalen');
INSERT INTO zones_list VALUES (89,81,'RHE','Rheinland-Pfalz');
INSERT INTO zones_list VALUES (90,81,'SAR','Saarland');
INSERT INTO zones_list VALUES (91,81,'SAS','Sachsen');
INSERT INTO zones_list VALUES (92,81,'SAC','Sachsen-Anhalt');
INSERT INTO zones_list VALUES (93,81,'SCN','Schleswig-Holstein');
INSERT INTO zones_list VALUES (94,81,'THE','Thüringen');

# Austria
INSERT INTO zones_list VALUES (95,14,'WI','Wien');
INSERT INTO zones_list VALUES (96,14,'NO','Niederösterreich');
INSERT INTO zones_list VALUES (97,14,'OO','Oberösterreich');
INSERT INTO zones_list VALUES (98,14,'SB','Salzburg');
INSERT INTO zones_list VALUES (99,14,'KN','Kärnten');
INSERT INTO zones_list VALUES (100,14,'ST','Steiermark');
INSERT INTO zones_list VALUES (101,14,'TI','Tirol');
INSERT INTO zones_list VALUES (102,14,'BL','Burgenland');
INSERT INTO zones_list VALUES (103,14,'VB','Voralberg');

# Swizterland
INSERT INTO zones_list VALUES (104,204,'AG','Aargau');
INSERT INTO zones_list VALUES (105,204,'AI','Appenzell Innerrhoden');
INSERT INTO zones_list VALUES (106,204,'AR','Appenzell Ausserrhoden');
INSERT INTO zones_list VALUES (107,204,'BE','Bern');
INSERT INTO zones_list VALUES (108,204,'BL','Basel-Landschaft');
INSERT INTO zones_list VALUES (109,204,'BS','Basel-Stadt');
INSERT INTO zones_list VALUES (110,204,'FR','Freiburg');
INSERT INTO zones_list VALUES (111,204,'GE','Genf');
INSERT INTO zones_list VALUES (112,204,'GL','Glarus');
INSERT INTO zones_list VALUES (113,204,'GR','Graubünden');
INSERT INTO zones_list VALUES (114,204,'JU','Jura');
INSERT INTO zones_list VALUES (115,204,'LU','Luzern');
INSERT INTO zones_list VALUES (116,204,'NE','Neuenburg');
INSERT INTO zones_list VALUES (117,204,'NW','Nidwalden');
INSERT INTO zones_list VALUES (118,204,'OW','Obwalden');
INSERT INTO zones_list VALUES (119,204,'SG','St. Gallen');
INSERT INTO zones_list VALUES (120,204,'SH','Schaffhausen');
INSERT INTO zones_list VALUES (121,204,'SO','Solothurn');
INSERT INTO zones_list VALUES (122,204,'SZ','Schwyz');
INSERT INTO zones_list VALUES (123,204,'TG','Thurgau');
INSERT INTO zones_list VALUES (124,204,'TI','Tessin');
INSERT INTO zones_list VALUES (125,204,'UR','Uri');
INSERT INTO zones_list VALUES (126,204,'VD','Waadt');
INSERT INTO zones_list VALUES (127,204,'VS','Wallis');
INSERT INTO zones_list VALUES (128,204,'ZG','Zug');
INSERT INTO zones_list VALUES (129,204,'ZH','Zürich');

# Spain
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'A Coruña','A Coruña');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Alava','Alava');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Albacete','Albacete');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Alicante','Alicante');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Almeria','Almeria');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Asturias','Asturias');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Avila','Avila');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Badajoz','Badajoz');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Baleares','Baleares');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Barcelona','Barcelona');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Burgos','Burgos');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Caceres','Caceres');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Cadiz','Cadiz');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Cantabria','Cantabria');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Castellon','Castellon');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Ceuta','Ceuta');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Ciudad Real','Ciudad Real');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Cordoba','Cordoba');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Cuenca','Cuenca');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Girona','Girona');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Granada','Granada');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Guadalajara','Guadalajara');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Guipuzcoa','Guipuzcoa');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Huelva','Huelva');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Huesca','Huesca');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Jaen','Jaen');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'La Rioja','La Rioja');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Las Palmas','Las Palmas');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Leon','Leon');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Lleida','Lleida');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Lugo','Lugo');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Madrid','Madrid');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Malaga','Malaga');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Melilla','Melilla');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Murcia','Murcia');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Navarra','Navarra');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Ourense','Ourense');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Palencia','Palencia');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Pontevedra','Pontevedra');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Salamanca','Salamanca');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Santa Cruz de Tenerife','Santa Cruz de Tenerife');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Segovia','Segovia');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Sevilla','Sevilla');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Soria','Soria');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Tarragona','Tarragona');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Teruel','Teruel');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Toledo','Toledo');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Valencia','Valencia');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Valladolid','Valladolid');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Vizcaya','Vizcaya');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Zamora','Zamora');
INSERT INTO zones_list (zone_country_id, zone_code, zone_name) VALUES (195,'Zaragoza','Zaragoza');
