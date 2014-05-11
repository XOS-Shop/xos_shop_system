################################################################################
# project    : XOS-Shop, open source e-commerce system
#              http://www.xos-shop.com
#                                                                     
# filename   : xos-shop_with_sample_data.sql
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

drop table if exists action_recorder;
create table action_recorder (
  id int not null auto_increment ,
  module varchar(255) not null ,
  user_id int ,
  user_name varchar(255) ,
  identifier varchar(255) not null ,
  success char(1) ,
  date_added datetime not null ,
  PRIMARY KEY (id) ,
  KEY IDX_ACTION_RECORDER_MODULE (module),
  KEY IDX_ACTION_RECORDER_USER_ID (user_id),
  KEY IDX_ACTION_RECORDER_IDENTIFIER (identifier),
  KEY IDX_ACTION_RECORDER_DATE_ADDED (date_added)
);

drop table if exists address_book;
create table address_book (
  address_book_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  entry_gender char(1) ,
  entry_company varchar(255) ,
  entry_company_tax_id varchar(255) ,
  entry_firstname varchar(255) not null ,
  entry_lastname varchar(255) not null ,
  entry_street_address varchar(255) not null ,
  entry_suburb varchar(255) ,
  entry_postcode varchar(255) not null ,
  entry_city varchar(255) not null ,
  entry_state varchar(255) ,
  entry_country_id int(11) default '0' not null ,
  entry_zone_id int(11) default '0' not null ,
  PRIMARY KEY (address_book_id),
  KEY IDX_CUSTOMERS_ID (customers_id)
);

insert into address_book (address_book_id, customers_id, entry_gender, entry_company, entry_company_tax_id, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_country_id, entry_zone_id) values ('1', '1', 'f', '', '', 'Erika', 'Mustermann', 'Einbahnstrasse 11', '', '12345', 'Bindingen', '', '204', '107');
insert into address_book (address_book_id, customers_id, entry_gender, entry_company, entry_company_tax_id, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_country_id, entry_zone_id) values ('4', '1', 'm', '', NULL, 'Hans', 'Mustermann', 'Siegerstrasse 45', '', '54321', 'Buttingen', '', '14', '98');
insert into address_book (address_book_id, customers_id, entry_gender, entry_company, entry_company_tax_id, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_country_id, entry_zone_id) values ('5', '2', 'm', 'GaGa AG', '', 'Max', 'Mustermann', 'Solgenstrasse 45', '', '57056', 'Baldingen', '', '14', '98');

drop table if exists address_format;
create table address_format (
  address_format_id int(11) not null auto_increment,
  address_format varchar(128) not null ,
  address_summary varchar(48) not null ,
  PRIMARY KEY (address_format_id)
);

insert into address_format (address_format_id, address_format, address_summary) values ('1', '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country', '$city / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('2', '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('3', '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$state / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('4', '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('5', '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');

drop table if exists admin;
create table admin (
  admin_id int(11) not null auto_increment,
  admin_groups_id int(11) ,
  admin_firstname varchar(255) not null ,
  admin_lastname varchar(255) ,
  admin_email_address varchar(255) not null ,
  admin_password varchar(60) not null ,
  admin_created datetime ,
  admin_modified datetime default '0000-00-00 00:00:00' not null ,
  admin_logdate datetime ,
  admin_lognum int(11) default '0' not null ,
  PRIMARY KEY (admin_id),
  UNIQUE KEY UNI_ADMIN_EMAIL_ADDRESS (admin_email_address)
);

insert into admin (admin_id, admin_groups_id, admin_firstname, admin_lastname, admin_email_address, admin_password, admin_created, admin_modified, admin_logdate, admin_lognum) values ('1', '1', 'AdminFirstname', 'AdminLastname', 'admin@localhost', '351683ea4e19efe34874b501fdbf9792:9b', now(), '0000-00-00 00:00:00', NULL, '14');

drop table if exists admin_files;
create table admin_files (
  admin_files_id int(11) not null auto_increment,
  admin_files_languages_key varchar(64) not null ,
  admin_files_name varchar(255) not null ,
  admin_files_is_boxes tinyint(5) default '0' not null ,
  admin_files_to_boxes int(11) default '0' not null ,
  admin_groups_id set('1','2') default '1' not null ,
  PRIMARY KEY (admin_files_id)
);

insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('1', 'BOX_HEADING_ADMINISTRATOR', 'menubox_administrator.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('2', 'BOX_HEADING_CONFIGURATION', 'menubox_configuration.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('3', 'BOX_HEADING_MODULES', 'menubox_modules.php', '1', '0', '1'); 
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('4', 'BOX_HEADING_CONTENT_MANAGER', 'menubox_content_manager.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('5', 'BOX_HEADING_CATALOG', 'menubox_catalog.php', '1', '0', '1'); 
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('6', 'BOX_HEADING_CUSTOMERS', 'menubox_customers.php', '1', '0', '1');
#insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('7', 'BOX_HEADING_GV_ADMIN', 'menubox_gv_admin.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('8', 'BOX_HEADING_LOCATION_AND_TAXES', 'menubox_taxes.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('9', 'BOX_HEADING_LOCALIZATION', 'menubox_localization.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('10', 'BOX_HEADING_REPORTS', 'menubox_reports.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('11', 'BOX_HEADING_TOOLS', 'menubox_tools.php', '1', '0', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('12', 'BOX_ADMINISTRATOR_BOXES', 'admin_members.php', '0', '1', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('13', 'BOX_HEADING_CONFIGURATION', 'configuration.php', '0', '2', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('14', 'BOX_HEADING_MODULES', 'modules.php', '0', '3', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('15', 'BOX_CONTENT_MANAGER_PAGES', 'pages.php', '0', '4', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('16', 'BOX_CONTENT_MANAGER_INFO_PAGES', 'info_pages.php', '0', '4', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('17', 'BOX_CATALOG_CATEGORIES_PRODUCTS', 'categories.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('18', 'BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'products_attributes.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('19', 'BOX_CATALOG_MANUFACTURERS', 'manufacturers.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('20', 'BOX_CATALOG_REVIEWS', 'reviews.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('21', 'BOX_CATALOG_UPDATE_PRODUCTS_PRICES', 'update_products_prices.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('22', 'BOX_CATALOG_XSELL_PRODUCTS', 'xsell.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('23', 'BOX_CATALOG_PRODUCTS_EXPECTED', 'products_expected.php', '0', '5', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('24', 'BOX_CUSTOMERS_CUSTOMERS', 'customers.php', '0', '6', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('25', 'BOX_CUSTOMERS_ORDERS', 'orders.php', '0', '6', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('26', 'BOX_CUSTOMERS_GROUPS', 'customers_groups.php', '0', '6', '1');
#insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('27', 'BOX_COUPON_ADMIN', 'coupon_admin.php', '0', '7', '1');
#insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('28', 'BOX_GV_ADMIN_QUEUE', 'gv_queue.php', '0', '7', '1');
#insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('29', 'BOX_GV_ADMIN_MAIL', 'gv_mail.php', '0', '7', '1');
#insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('30', 'BOX_GV_ADMIN_SENT', 'gv_sent.php', '0', '7', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('31', 'BOX_TAXES_COUNTRIES', 'countries.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('32', 'BOX_TAXES_ZONES', 'zones.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('33', 'BOX_TAXES_GEO_ZONES', 'geo_zones.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('34', 'BOX_TAXES_TAX_CLASSES', 'tax_classes.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('35', 'BOX_TAXES_TAX_RATES', 'tax_rates.php', '0', '8', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('36', 'BOX_LOCALIZATION_CURRENCIES', 'currencies.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('37', 'BOX_LOCALIZATION_LANGUAGES', 'languages.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('38', 'BOX_LOCALIZATION_ORDERS_STATUS', 'orders_status.php', '0', '9', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('39', 'BOX_REPORTS_PRODUCTS_VIEWED', 'stats_products_viewed.php', '0', '10', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('40', 'BOX_REPORTS_PRODUCTS_PURCHASED', 'stats_products_purchased.php', '0', '10', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('41', 'BOX_REPORTS_ORDERS_TOTAL', 'stats_customers.php', '0', '10', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('42', 'BOX_REPORTS_CREDITS', 'stats_credits.php', '0', '10', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('43', 'BOX_TOOLS_ACTION_RECORDER', 'action_recorder.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('44', 'BOX_TOOLS_BACKUP', 'backup.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('45', 'BOX_TOOLS_IMAGE_PROCESSING', 'image_processing.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('46', 'BOX_TOOLS_BANNER_MANAGER', 'banner_manager.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('47', 'BOX_TOOLS_SMARTY_CACHE', 'cache.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('48', 'BOX_TOOLS_DEFINE_LANGUAGE', 'define_language.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('49', 'BOX_TOOLS_FILE_MANAGER', 'file_manager.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('50', 'BOX_TOOLS_MAIL', 'mail.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('51', 'BOX_TOOLS_NEWSLETTER_MANAGER', 'newsletters.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('52', 'BOX_TOOLS_SERVER_INFO', 'server_info.php', '0', '11', '1');
insert into admin_files (admin_files_id, admin_files_languages_key, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) values ('53', 'BOX_TOOLS_WHOS_ONLINE', 'whos_online.php', '0', '11', '1');

drop table if exists admin_groups;
create table admin_groups (
  admin_groups_id int(11) not null auto_increment,
  admin_groups_name varchar(255) ,
  PRIMARY KEY (admin_groups_id),
  UNIQUE KEY UNI_ADMIN_GROUPS_NAME (admin_groups_name)
);

insert into admin_groups (admin_groups_id, admin_groups_name) values ('1', 'Top Administrator');
insert into admin_groups (admin_groups_id, admin_groups_name) values ('2', 'Customer Relations');

drop table if exists banners;
create table banners (
  banners_id int(11) not null auto_increment,
  banners_group varchar(255) not null ,
  expires_impressions int(7) default '0' ,
  expires_date datetime ,
  date_scheduled datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  date_status_change datetime ,
  status int(1) default '1' not null ,
  PRIMARY KEY (banners_id)
);

insert into banners (banners_id, banners_group, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status) values ('1', 'footer', '0', NULL, NULL, date_sub(now(),interval 1 day), NULL, '1');
insert into banners (banners_id, banners_group, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status) values ('2', 'header', '0', NULL, NULL, date_sub(now(),interval 1 day), NULL, '1');
insert into banners (banners_id, banners_group, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status) values ('3', 'column_1', '0', NULL, NULL, date_sub(now(),interval 1 day), NULL, '0');
insert into banners (banners_id, banners_group, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status) values ('4', 'column_2', '0', NULL, NULL, date_sub(now(),interval 1 day), NULL, '1');
insert into banners (banners_id, banners_group, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status) values ('5', 'column_1', '0', NULL, NULL, date_sub(now(),interval 1 day), NULL, '1');

drop table if exists banners_content;
create table banners_content (
  banners_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  banners_title varchar(255) not null ,
  banners_url varchar(255) not null ,
  banners_image varchar(255) not null ,
  banners_html_text text ,
  PRIMARY KEY (banners_id, language_id)
);

insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('1', '1', 'XOS-Shop', 'http://www.xos-shop.com', 'xos-shop_banner.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('1', '2', 'XOS-Shop', 'http://www.xos-shop.com', 'xos-shop_banner.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('1', '3', 'XOS-Shop', 'http://www.xos-shop.com', 'xos-shop_banner.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('2', '1', 'Note', '', '', '<div style=\"text-align: center; border-bottom: red 2px solid; border-left: red 2px solid; padding-bottom: 2px; background-color: rgb(216,216,216); margin-top: 2px; padding-left: 10px; padding-right: 10px; font-family: arial; font-size: 16px; border-top: red 2px solid; border-right: red 2px solid; padding-top: 2px\">This is a default setup of the XOS-Shop project, products shown are for demonstrational purposes, any products purchased will not be delivered nor will the customer be billed. Any information seen on these products is to be treated as fictional.</div>');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('2', '2', 'Hinweis', '', '', '<div style=\"text-align: center; border-bottom: red 2px solid; border-left: red 2px solid; padding-bottom: 2px; background-color: rgb(216,216,216); margin-top: 2px; padding-left: 10px; padding-right: 10px; font-family: arial; font-size: 16px; border-top: red 2px solid; border-right: red 2px solid; padding-top: 2px\">Dies ist eine XOS-Shop Standardinstallation. Alle hier gezeigten Produkte sind fiktiv zu verstehen. Eine hier getätigte Bestellung wird NICHT ausgeführt, Sie erhalten keine Lieferung oder Rechnung !</div>');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('2', '3', 'Nota', '', '', '<div style=\"text-align: center; border-bottom: red 2px solid; border-left: red 2px solid; padding-bottom: 2px; background-color: rgb(216,216,216); margin-top: 2px; padding-left: 4px; padding-right: 4px; font-family: arial; font-size: 16px; border-top: red 2px solid; border-right: red 2px solid; padding-top: 2px\">Esta es la configuración por defecto de XOS-Shop, los productos mostrados aqui son únicamente para demonstración, cualquier compra realizada no será entregada al cliente, ni se le cobrará. Cualquier información que vea sobre estos productos debe ser tratada como ficticia.</div>');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('3', '1', 'Validome', 'http://www.validome.org/referer', 'valid_xhtml_1_0.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('3', '2', 'Validome', 'http://www.validome.org/referer', 'valid_xhtml_1_0.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('3', '3', 'Validome', 'http://www.validome.org/referer', 'valid_xhtml_1_0.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('4', '1', 'W3C', 'http://validator.w3.org/check?uri=referer', 'valid-xhtml10.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('4', '2', 'W3C', 'http://validator.w3.org/check?uri=referer', 'valid-xhtml10.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('4', '3', 'W3C', 'http://validator.w3.org/check?uri=referer', 'valid-xhtml10.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('5', '2', 'valid-css21', 'http://jigsaw.w3.org/css-validator/check/referer', 'valid-css21.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('5', '1', 'valid-css21', 'http://jigsaw.w3.org/css-validator/check/referer', 'valid-css21.gif', '');
insert into banners_content (banners_id, language_id, banners_title, banners_url, banners_image, banners_html_text) values ('5', '3', 'valid-css21', 'http://jigsaw.w3.org/css-validator/check/referer', 'valid-css21.gif', '');

drop table if exists banners_history;
create table banners_history (
  banners_history_id int(11) not null auto_increment,
  banners_id int(11) default '0' not null ,
  banners_shown int(5) default '0' not null ,
  banners_clicked int(5) default '0' not null ,
  banners_history_date datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (banners_history_id)
);

drop table if exists categories_or_pages;
create table categories_or_pages (
  categories_or_pages_id int(11) not null auto_increment,
  categories_image varchar(255) ,
  parent_id int(11) default '0' not null ,
  product_list_b tinyint(1) default '0' not null ,
  sort_order int(3) ,
  is_page varchar(32) not null ,
  page_not_in_menu tinyint(1) default '0' not null ,  
  categories_or_pages_status tinyint(1) default '0' not null ,
  date_added datetime ,
  last_modified datetime ,
  PRIMARY KEY (categories_or_pages_id, categories_or_pages_status),
  KEY IDX_PARENT_ID (parent_id)
);

insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('1', 'category_hardware.gif', '0', '0', '10', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('2', 'category_software.gif', '0', '0', '20', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('3', 'category_dvd_movies.gif', '0', '0', '30', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('4', 'subcategory_graphic_cards.gif', '1', '0', '40', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('5', 'subcategory_printers.gif', '1', '0', '30', 'false', '0', '1', date_sub(now(),interval 1 day), now());
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('6', 'subcategory_monitors.gif', '1', '0', '10', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('7', 'subcategory_speakers.gif', '1', '0', '50', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('8', 'subcategory_keyboards.gif', '1', '0', '80', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('9', 'subcategory_mice.gif', '1', '0', '60', 'false', '0', '1', date_sub(now(),interval 1 day), now());
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('10', 'subcategory_action.gif', '3', '1', '10', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('11', 'subcategory_science_fiction.gif', '3', '0', '40', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('12', 'subcategory_comedy.gif', '3', '0', '30', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('13', 'subcategory_cartoons.gif', '3', '0', '60', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('14', 'subcategory_thriller.gif', '3', '0', '50', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('15', 'subcategory_drama.gif', '3', '0', '20', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('16', 'subcategory_memory.gif', '1', '0', '70', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('17', 'subcategory_cdrom_drives.gif', '1', '0', '20', 'false', '0', '1', date_sub(now(),interval 1 day), now());
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('18', 'subcategory_simulation.gif', '2', '0', '20', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('19', 'subcategory_action_games.gif', '2', '0', '10', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);
insert into categories_or_pages (categories_or_pages_id, categories_image, parent_id, product_list_b, sort_order, is_page, page_not_in_menu, categories_or_pages_status, date_added, last_modified) values ('20', 'subcategory_strategy.gif', '2', '0', '30', 'false', '0', '1', date_sub(now(),interval 1 day), NULL);

drop table if exists categories_or_pages_data;
create table categories_or_pages_data (
  categories_or_pages_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  categories_or_pages_name varchar(255) not null ,
  categories_or_pages_heading_title varchar(255) ,
  categories_or_pages_content text ,
  PRIMARY KEY (categories_or_pages_id, language_id),
  KEY IDX_CATEGORIES_OR_PAGES_NAME (categories_or_pages_name)
);

insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('1', '1', 'Hardware', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('2', '1', 'Software', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('3', '1', 'DVD Movies', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('4', '1', 'Graphics Cards', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('5', '1', 'Printers', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('6', '1', 'Monitors', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('7', '1', 'Speakers', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('8', '1', 'Keyboards', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('9', '1', 'Mice', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('10', '1', 'Action', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('11', '1', 'Science Fiction', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('12', '1', 'Comedy', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('13', '1', 'Cartoons', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('14', '1', 'Thriller', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('15', '1', 'Drama', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('16', '1', 'Memory', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('17', '1', 'CDROM Drives', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('18', '1', 'Simulation', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('19', '1', 'Action', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('20', '1', 'Strategy', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('1', '2', 'Hardware', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('2', '2', 'Software', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('3', '2', 'DVD Filme', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('4', '2', 'Grafikkarten', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('5', '2', 'Drucker', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('6', '2', 'Bildschirme', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('7', '2', 'Lautsprecher', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('8', '2', 'Tastaturen', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('9', '2', 'Mäuse', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('10', '2', 'Action', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('11', '2', 'Science Fiction', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('12', '2', 'Komödie', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('13', '2', 'Zeichentrick', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('14', '2', 'Thriller', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('15', '2', 'Drama', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('16', '2', 'Speicher', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('17', '2', 'CDROM Laufwerke', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('18', '2', 'Simulation', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('19', '2', 'Action', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('20', '2', 'Strategie', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('1', '3', 'Hardware', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('2', '3', 'Software', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('3', '3', 'Peliculas DVD', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('4', '3', 'Tarjetas Graficas', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('5', '3', 'Impresoras', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('6', '3', 'Monitores', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('7', '3', 'Altavoces', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('8', '3', 'Teclados', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('9', '3', 'Ratones', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('10', '3', 'Accion', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('11', '3', 'Ciencia Ficcion', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('12', '3', 'Comedia', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('13', '3', 'Dibujos Animados', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('14', '3', 'Suspense', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('15', '3', 'Drama', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('16', '3', 'Memoria', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('17', '3', 'Unidades CDROM', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('18', '3', 'Simulacion', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('19', '3', 'Accion', '', '');
insert into categories_or_pages_data (categories_or_pages_id, language_id, categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content) values ('20', '3', 'Estrategia', '', '');

drop table if exists configuration;
create table configuration (
  configuration_id int(11) not null auto_increment,
  configuration_key varchar(255) not null ,
  configuration_value text not null ,
  configuration_group_id int(11) default '0' not null ,
  sort_order int(5) ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  use_function varchar(255) ,
  set_function varchar(255) ,
  PRIMARY KEY (configuration_id)
);

insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_NAME', 'XOS-Shop', '1', '1', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_OWNER', 'Felix Muster', '1', '2', now(), now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_OWNER_EMAIL_ADDRESS', 'root@localhost', '1', '3', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('EMAIL_FROM', 'XOS-Shop &lt;root@localhost&gt;', '1', '4', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_COUNTRY', '204', '1', '5', now(), now(), 'xos_get_country_name', 'xos_cfg_pull_down_country_list(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_ZONE', '129', '1', '6', now(), now(), 'xos_cfg_get_zone_name', 'xos_cfg_pull_down_zone_list(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('EXPECTED_PRODUCTS_SORT', 'desc', '1', '7', NULL, now(), NULL, 'xos_cfg_select_option(array(\'asc\', \'desc\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('EXPECTED_PRODUCTS_FIELD', 'date_expected', '1', '8', NULL, now(), NULL, 'xos_cfg_select_option(array(\'products_name\', \'date_expected\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SEND_EXTRA_ORDER_EMAILS_TO', 'Name 1 &lt;name1@localhost&gt;, Name 2 &lt;name2@localhost&gt;', '1', '9', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DISPLAY_LINK_TO_ROOT_DIRECTORY', 'false', '1', '10', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SEARCH_ENGINE_FRIENDLY_URLS', 'false', '1', '11', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DISPLAY_CART', 'false', '1', '12', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', '1', '13', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('NEWSLETTER_ENABLED', 'true', '1', '14', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_REVIEWS_ENABLED', 'true', '1', '15', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_NOTIFICATION_ENABLED', 'false', '1', '16', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', '1', '17', NULL, now(), NULL, 'xos_cfg_select_option(array(\'and\', \'or\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_NAME_ADDRESS', 'Store Name\nAddress\nCountry\nPhone', '1', '18', NULL, now(), NULL, 'xos_cfg_textarea(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY', 'false', '1', '19', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SHOW_EMPTY_CATEGORIES', 'true', '1', '20', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SHOW_COUNTS', 'true', '1', '21', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LISTS_FOR_SEARCH_RESULTS', 'A', '1', '22', NULL, now(), NULL, 'xos_cfg_select_option(array(\'A\', \'B\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LISTS_FOR_SPECIALS', 'B', '1', '23', NULL, now(), NULL, 'xos_cfg_select_option(array(\'A\', \'B\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LISTS_FOR_MANUFACTURERS', 'B', '1', '24', NULL, now(), NULL, 'xos_cfg_select_option(array(\'A\', \'B\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PREV_NEXT_BAR_LOCATION', '3', '1', '25', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('TAX_DECIMAL_PLACES', '2', '1', '26', NULL, now(), NULL, NULL);
#insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', '0', '1', '27', NULL, now(), NULL, NULL);
#insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('NEW_SIGNUP_DISCOUNT_COUPON', '', '1', '28', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_FIRST_NAME_MIN_LENGTH', '2', '2', '1', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_LAST_NAME_MIN_LENGTH', '2', '2', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_DOB_MIN_LENGTH', '10', '2', '3', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', '2', '4', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', '2', '5', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_COMPANY_MIN_LENGTH', '2', '2', '6', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_POSTCODE_MIN_LENGTH', '4', '2', '7', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_CITY_MIN_LENGTH', '3', '2', '8', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_STATE_MIN_LENGTH', '2', '2', '9', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_TELEPHONE_MIN_LENGTH', '3', '2', '10', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_PASSWORD_MIN_LENGTH', '5', '2', '11', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('CC_OWNER_MIN_LENGTH', '3', '2', '12', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('CC_NUMBER_MIN_LENGTH', '10', '2', '13', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('REVIEW_TEXT_MIN_LENGTH', '50', '2', '14', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MIN_DISPLAY_BESTSELLERS', '1', '2', '15', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MIN_DISPLAY_ALSO_PURCHASED', '1', '2', '16', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_ADDRESS_BOOK_ENTRIES', '5', '3', '1', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_SEARCH_RESULTS', '7', '3', '2', now(), now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_PRODUCTS_IN_CATEGORY', '4', '3', '3', now(), now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER', '2', '3', '4', now(), now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_PAGE_LINKS', '5', '3', '5', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_SPECIAL_PRODUCTS', '9', '3', '6', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_NEW_PRODUCTS', '9', '3', '7', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_UPCOMING_PRODUCTS', '10', '3', '8', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', '3', '9', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_MANUFACTURERS_LIST', '1', '3', '10', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', '3', '11', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_NEW_REVIEWS', '6', '3', '12', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_RANDOM_SELECT_REVIEWS', '10', '3', '13', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_RANDOM_SELECT_NEW', '10', '3', '14', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_RANDOM_SELECT_SPECIALS', '10', '3', '15', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_CATEGORIES_PER_ROW', '3', '3', '16', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_PRODUCTS_NEW', '10', '3', '17', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_BESTSELLERS', '10', '3', '18', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_ALSO_PURCHASED', '6', '3', '19', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', '3', '20', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_DISPLAY_ORDER_HISTORY', '10', '3', '21', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MAX_IMG', '9', '4', '1', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('IMAGE_QUALITY', '80', '4', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('CONFIG_CALCULATE_IMAGE_SIZE', 'true', '4', '3', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('IMAGE_REQUIRED', 'true', '4', '4', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('EXTRA_SMALL_PRODUCT_IMAGE_MAX_WIDTH', '26', '4', '5', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('EXTRA_SMALL_PRODUCT_IMAGE_MAX_HEIGHT', '26', '4', '6', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('EXTRA_SMALL_PRODUCT_IMAGE_MERGE', '', '4', '7', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMALL_PRODUCT_IMAGE_MAX_WIDTH', '90', '4', '8', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMALL_PRODUCT_IMAGE_MAX_HEIGHT', '90', '4', '9', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMALL_PRODUCT_IMAGE_MERGE', '', '4', '10', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MEDIUM_PRODUCT_IMAGE_MAX_WIDTH', '180', '4', '11', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MEDIUM_PRODUCT_IMAGE_MAX_HEIGHT', '180', '4', '12', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MEDIUM_PRODUCT_IMAGE_MERGE', '', '4', '13', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('LARGE_PRODUCT_IMAGE_MAX_WIDTH', '400', '4', '14', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('LARGE_PRODUCT_IMAGE_MAX_HEIGHT', '400', '4', '15', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('LARGE_PRODUCT_IMAGE_MERGE', 'overlay.gif,10,10,60', '4', '16', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMALL_CATEGORY_IMAGE_MAX_WIDTH', '60', '4', '17', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMALL_CATEGORY_IMAGE_MAX_HEIGHT', '60', '4', '18', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MEDIUM_CATEGORY_IMAGE_MAX_WIDTH', '100', '4', '19', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MEDIUM_CATEGORY_IMAGE_MAX_HEIGHT', '100', '4', '20', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ACCOUNT_GENDER', 'true', '5', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ACCOUNT_DOB', 'true', '5', '2', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ACCOUNT_COMPANY', 'true', '5', '3', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ACCOUNT_SUBURB', 'true', '5', '4', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ACCOUNT_STATE', 'true', '5', '5', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ACTION_RECORDER_INSTALLED', 'ar_admin_login.php;ar_contact_us.php;ar_reset_password.php;ar_tell_a_friend.php', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES', '5', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS', '3', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES', '15', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES', '5', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS', '1', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES', '15', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_INSTALLED', 'cc.php;cod.php;invoice.php', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_shipping.php;ot_tax.php;ot_total.php', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SHIPPING_INSTALLED', 'flat.php', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_COD_STATUS', 'true', '6', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_COD_ZONE', '0', '6', '2', NULL, now(), 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_COD_SORT_ORDER', '3', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', '6', '0', NULL, now(), 'xos_get_order_status_name', 'xos_cfg_pull_down_order_statuses(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_CC_STATUS', 'true', '6', '0', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_CC_EMAIL', '', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_CC_SORT_ORDER', '2', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_CC_ZONE', '0', '6', '2', NULL, now(), 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', '6', '0', NULL, now(), 'xos_get_order_status_name', 'xos_cfg_pull_down_order_statuses(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SHIPPING_FLAT_STATUS', 'true', '6', '0', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SHIPPING_FLAT_COST', '5.11', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SHIPPING_FLAT_TAX_CLASS', '1', '6', '0', NULL, now(), 'xos_get_tax_class_title', 'xos_cfg_pull_down_tax_classes(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SHIPPING_FLAT_ZONE', '0', '6', '0', NULL, now(), 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SHIPPING_FLAT_SORT_ORDER', '1', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DEFAULT_CURRENCY', 'CHF', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DEFAULT_LANGUAGE', 'de', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DEFAULT_ORDERS_STATUS_ID', '1', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', '6', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '8', '6', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'false', '6', '3', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '50', '6', '4', NULL, now(), 'currencies->format', NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', '6', '5', NULL, now(), NULL, 'xos_cfg_select_option(array(\'national\', \'international\', \'both\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', '6', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', '6', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_TAX_STATUS', 'true', '6', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '10', '6', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', '6', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '12', '6', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_INVOICE_STATUS', 'true', '6', '0', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_INVOICE_ZONE', '0', '6', '2', NULL, now(), 'xos_get_zone_class_title', 'xos_cfg_pull_down_zone_classes(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_INVOICE_SORT_ORDER', '4', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID', '0', '6', '0', NULL, now(), 'xos_get_order_status_name', 'xos_cfg_pull_down_order_statuses(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_INVOICE_FROM_ORDER', '0', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_PAYMENT_INVOICE_ENABLED_FOR_DOWNLOADS', 'false', '6', '0', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SOCIAL_BOOKMARKS_INSTALLED', 'sb_email.php;sb_facebook.php;sb_twitter.php', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS', 'true', '6', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER', '10', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SOCIAL_BOOKMARKS_FACEBOOK_STATUS', 'true', '6', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SOCIAL_BOOKMARKS_FACEBOOK_SORT_ORDER', '20', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SOCIAL_BOOKMARKS_TWITTER_STATUS', 'true', '6', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('MODULE_SOCIAL_BOOKMARKS_TWITTER_SORT_ORDER', '30', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('LAST_CUSTOMERS_GROUPS_ID', '1', '6', '0', now(), now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STATUS_POPUP_CONTENT_5', '1', '6', '0', now(), now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('LAST_COUNTRY_ID', '300', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('NEW_ORDER', 'false', '6', '0', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SHIPPING_ORIGIN_COUNTRY', '204', '7', '1', now(), now(), 'xos_get_country_name', 'xos_cfg_pull_down_country_list(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SHIPPING_ORIGIN_ZIP', '5698', '7', '2', now(), now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SHIPPING_MAX_WEIGHT', '50', '7', '3', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SHIPPING_BOX_WEIGHT', '3', '7', '4', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SHIPPING_BOX_PADDING', '10', '7', '5', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_IMAGE', '0', '8', '1', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_MANUFACTURER', '', '8', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_MODEL', '2', '8', '3', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_NAME', '1', '8', '4', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_INFO', '', '8', '5', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_PACKING_UNIT', '', '8', '6', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_PRICE', '3', '8', '7', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_QUANTITY', '', '8', '8', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_WEIGHT', '', '8', '9', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_BUY_NOW', '4', '8', '10', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_A_FILTER', '1', '8', '11', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_IMAGE', '1', '9', '1', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_MANUFACTURER', '4', '9', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_MODEL', '3', '9', '3', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_NAME', '0', '9', '4', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_INFO', '2', '9', '5', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_PACKING_UNIT', '5', '9', '6', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_PRICE', '8', '9', '7', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_QUANTITY', '7', '9', '8', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_WEIGHT', '6', '9', '9', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_BUY_NOW', '9', '9', '10', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('PRODUCT_LIST_B_FILTER', '1', '9', '11', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STOCK_CHECK', 'true', '10', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STOCK_LIMITED', 'true', '10', '2', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STOCK_ALLOW_CHECKOUT', 'true', '10', '3', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', '10', '4', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STOCK_REORDER_LEVEL', '5', '10', '5', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_PAGE_PARSE_TIME', 'false', '11', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/tep/page_parse_time.log', '11', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', '11', '3', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DISPLAY_PAGE_PARSE_TIME', 'true', '11', '4', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('STORE_DB_TRANSACTIONS', 'false', '11', '5', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('CACHE_LEVEL', '0', '12', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('COMPILE_CHECK', 'false', '12', '2', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ALLOW_VISITORS_TO_CHANGE_TEMPLATE', 'true', '12', '3', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DEFAULT_TPL', 'black-tabs', '12', '4', now(), now(), NULL, 'xos_cfg_pull_down_templates(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('REGISTERED_TPLS', 'black-tabs,black-tabs-cbox,black-tabs-cbox-dotted,blue-tabs-a,blue-tabs-b,blue-tabs-c,blue-tabs-c-html5,dark-standard,dark-tabs,orange-standard,orange-table,orange-tabs,orange-tabs-table,osc-table', '12', '5', now(), now(), 'xos_get_registered_tpls_list', 'xos_cfg_checkbox_templates(');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SEND_EMAILS', 'true', '13', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('EMAIL_USE_HTML', 'true', '13', '2', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('EMAIL_SHOP_LOGO', 'shop_logo.gif', '13', '3', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('ENTRY_EMAIL_ADDRESS_CHECK', 'false', '13', '4', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('EMAIL_TRANSPORT', 'sendmail', '13', '5', NULL, now(), NULL, 'xos_cfg_select_option(array(\'sendmail\', \'smtp\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SENDMAIL_PATH', '/usr/sbin/sendmail', '13', '6', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP_HOST', 'smtp1.example.com:25;smtp2.example.com', '13', '7', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP_AUTH', 'false', '13', '8', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP_SECURE', '---', '13', '9', NULL, now(), NULL, 'xos_cfg_select_option(array(\'---\', \'ssl\', \'tls\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP_USERNAME', 'Please Enter', '13', '10', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SMTP_PASSWORD', 'Please Enter', '13', '11', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DOWNLOAD_ENABLED', 'false', '14', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DOWNLOAD_BY_REDIRECT', 'false', '14', '2', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DOWNLOAD_MAX_DAYS', '7', '14', '3', NULL, now(), NULL, '');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('DOWNLOAD_MAX_COUNT', '5', '14', '4', NULL, now(), NULL, '');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('GZIP_COMPRESSION', 'false', '15', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('GZIP_LEVEL', '5', '15', '2', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SESSION_WRITE_DIRECTORY', '/tmp', '16', '1', NULL, now(), NULL, NULL);
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SESSION_FORCE_COOKIE_USE', 'false', '16', '2', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SESSION_CHECK_SSL_SESSION_ID', 'false', '16', '3', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SESSION_CHECK_USER_AGENT', 'false', '16', '4', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SESSION_CHECK_IP_ADDRESS', 'false', '16', '5', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SESSION_BLOCK_SPIDERS', 'true', '16', '6', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SESSION_RECREATE', 'false', '16', '7', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');
insert into configuration (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('SITE_OFFLINE', 'false', '17', '1', NULL, now(), NULL, 'xos_cfg_select_option(array(\'true\', \'false\'),');

drop table if exists contents;
create table contents (
  content_id int(11) not null auto_increment,
  type varchar(32) not null ,
  status tinyint(1) default '0' not null ,
  sort_order int(3) ,
  last_modified datetime ,
  date_added datetime ,
  PRIMARY KEY (content_id)
);

insert into contents (content_id, type, status, sort_order, last_modified, date_added) values ('1', 'info', '1', '1', NULL, date_sub(now(),interval 1 day));
insert into contents (content_id, type, status, sort_order, last_modified, date_added) values ('2', 'info', '1', '2', NULL, date_sub(now(),interval 1 day));
insert into contents (content_id, type, status, sort_order, last_modified, date_added) values ('3', 'info', '1', '3', NULL, date_sub(now(),interval 1 day));
insert into contents (content_id, type, status, sort_order, last_modified, date_added) values ('4', 'index', '1', '0', now(), date_sub(now(),interval 1 day));
insert into contents (content_id, type, status, sort_order, last_modified, date_added) values ('5', 'system_popup', '1', '0', NULL, date_sub(now(),interval 1 day));
insert into contents (content_id, type, status, sort_order, last_modified, date_added) values ('6', 'system_popup', '1', '0', NULL, date_sub(now(),interval 1 day));
insert into contents (content_id, type, status, sort_order, last_modified, date_added) values ('7', 'system_popup', '1', '0', NULL, date_sub(now(),interval 1 day));
insert into contents (content_id, type, status, sort_order, last_modified, date_added) values ('8', 'system_popup', '1', '0', NULL, date_sub(now(),interval 1 day));
insert into contents (content_id, type, status, sort_order, last_modified, date_added) values ('9', 'system_popup', '1', '0', NULL, date_sub(now(),interval 1 day));

drop table if exists contents_data;
create table contents_data (
  content_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  name varchar(255) ,
  heading_title varchar(255) ,
  content text ,
  PRIMARY KEY (content_id, language_id)
);

insert into contents_data (content_id, language_id, name, heading_title, content) values ('1', '1', 'Shipping &amp; Returns', 'Shipping &amp; Returns', 'Put here your Shipping &amp; Returns information.');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('1', '2', 'Liefer- und Versandkosten', 'Liefer- und Versandkosten', 'Fügen Sie hier Ihre Informationen über Liefer- und Versandkosten ein.');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('1', '3', 'Envíos / Devoluciones', 'Envíos y Devoluciones', 'Ponga aqui información sobre los Envíos y Devoluciones.');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('2', '1', 'Privacy Notice', 'Privacy Notice', 'Put here your Privacy Notice information.');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('2', '2', 'Privatsphäre / Datenschutz', 'Privatsphäre und Datenschutz', 'Fügen Sie hier Ihre Informationen über Privatsphäre und Datenschutz ein.');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('2', '3', 'Confidencialidad', 'Confidencialidad', 'Ponga aqui información sobre el tratamiento de los datos.');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('3', '1', 'Terms and Conditions', 'General Business Conditions', 'Put here your general business conditions information.');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('3', '2', 'Unsere AGB\'s', 'Allgemeine Geschäftsbedingungen', 'Fügen Sie hier Ihre allgemeinen Geschäftsbedingungen ein.');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('3', '3', 'Términos y Condiciones', 'Condiciones General de Negocios', 'Ponga aqui sus condiciones general de negocios.');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('4', '1', 'What\'s New Here?', 'What\'s New Here?', '<div>[@{$welcome}@]</div><div>&#160;</div><div>This is a default setup of the XOS-Shop project, products shown are for demonstrational purposes, <strong>any products purchased will not be delivered nor will the customer be billed</strong>. Any information seen on these products is to be treated as fictional.</div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('4', '2', 'Unser Angebot', '[@{$welcome}@]', '<div>Dies ist eine XOS-Shop Standardinstallation. Alle hier gezeigten Produkte sind fiktiv zu verstehen. <strong>Eine hier getätigte Bestellung wird NICHT ausgeführt, Sie erhalten keine Lieferung oder Rechnung!</strong></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('4', '3', '¿Que hay de nuevo por aqui?', '¿Que hay de nuevo por aqui?', '<div>[@{$welcome}@]</div><div>&#160;</div><div>Esta es la configuración por defecto de XOS-Shop, los productos mostrados aqui son únicamente para demonstración, <strong>cualquier compra realizada no será entregada al cliente, ni se le cobrará</strong>. Cualquier información que vea sobre estos productos debe ser tratada como ficticia.</div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('5', '2', 'Liefer- und Versandkosten', 'Liefer- und Versandkosten', '<div style=\"width: 600px;\"><p>Fügen Sie hier Ihre Informationen über Liefer- und Versandkosten ein.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('5', '1', 'Shipping &amp; Returns', 'Shipping &amp; Returns', '<div style=\"width: 600px;\"><p>Put here your Shipping &amp; Returns information.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('5', '3', 'Envíos / Devoluciones', 'Envíos y Devoluciones', '<div style=\"width: 600px;\"><p>Ponga aqui información sobre los Envíos y Devoluciones.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('6', '2', 'Privatsphäre / Datenschutz', 'Privatsphäre und Datenschutz', '<div style=\"width: 600px;\"><p>Fügen Sie hier Ihre Informationen über Privatsphäre und Datenschutz ein.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('6', '1', 'Privacy Notice', 'Privacy Notice', '<div style=\"width: 600px;\"><p>Put here your Privacy Notice information.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('6', '3', 'Confidencialidad', 'Confidencialidad', '<div style=\"width: 600px;\"><p>Ponga aqui información sobre el tratamiento de los datos.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('7', '2', 'Unsere AGB\'s', 'Allgemeine Geschäftsbedingungen', '<div style=\"width: 600px;\"><p>Fügen Sie hier Ihre allgemeinen Geschäftsbedingungen ein.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('7', '1', 'Terms and Conditions', 'General Business Conditions', '<div style=\"width: 600px;\"><p>Put here your general business conditions information.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('7', '3', 'Términos y Condiciones', 'Condiciones General de Negocios', '<div style=\"width: 600px;\"><p>Ponga aqui sus condiciones general de negocios.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('8', '2', 'Hilfe zur erweiterten Suche', 'Hilfe zur erweiterten Suche', '<div style=\"width: 600px;\"><p>Die Suchfunktion ermöglicht Ihnen die Suche in den Produktnamen, Produktbeschreibungen, Herstellern und Artikelnummern.<br /> <br /> Sie haben die Möglichkeit logische Operatoren wie \"AND\" (Und) und \"OR\" (oder) zu verwenden.<br /> <br /> Als Beispiel könnten Sie also angeben: <u>Microsoft AND Maus</u>.<br /> <br /> Desweiteren können Sie Klammern verwenden um die Suche zu verschachteln, also z.B.:<br /> <br /> <u>Microsoft AND (Maus OR Tastatur OR \"Visual Basic\")</u>.<br /> <br /> Mit Anführungszeichen können Sie mehrere Worte zu einem Suchbegriff zusammenfassen.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('8', '1', 'Search Help', 'Search Help', '<div style=\"width: 600px;\"><p>Keywords may be separated by AND and/or OR statements for greater control of the search results.<br /> <br /> For example, <u>Microsoft AND mouse</u> would generate a result set that contain both words. However, for <u>mouse OR keyboard</u>, the result set returned would contain both or either words.<br /> <br /> Exact matches can be searched for by enclosing keywords in double-quotes.<br /> <br /> For example, <u>\"notebook computer\"</u> would generate a result set which match the exact string.<br /> <br /> Brackets can be used for further control on the result set.<br /> <br /> For example, <u>Microsoft and (keyboard or mouse or \"visual basic\")</u>.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('8', '3', 'Consejos para Búsqueda Avanzada', 'Consejos para Búsqueda Avanzada', '<div style=\"width: 600px;\"><p>El motor de búsqueda le permite hacer una búsqueda por palabras clave en el modelo, nombre y descripción del producto y en el nombre del fabricante.<br /> <br /> Cuando haga una busqueda por palabras o frases clave, puede separar estas con los operadores lógicos AND y OR. Por ejemplo, puede hacer una busqueda por <u>microsoft AND raton</u>. Esta búsqueda daría como resultado los productos que contengan ambas palabras. Por el contrario, si teclea <u>raton OR teclado</u>, conseguirá una lista de los productos que contengan las dos o solo una de las palabras. Si no se separan las palabras o frases clave con AND o con OR, la búsqueda se hara usando por defecto el operador logico AND.<br /> <br /> Puede realizar busquedas exactas de varias palabras encerrandolas entre comillas. Por ejemplo, si busca <u>\"ordenador portatil\"</u>, obtendrás una lista de productos que tengan exactamente esa cadena en ellos.<br /> <br /> Se pueden usar paratensis para controlar el orden de las operaciones lógicas. Por ejemplo, puede introducir <u>microsoft and (teclado or raton or \"visual basic\")</u>.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('9', '2', 'Besucherwarenkorb / Kundenwarenkorb', 'Besucherwarenkorb / Kundenwarenkorb', '<div style=\"width: 600px;\"><p><b><i>Besucherwarenkorb</i></b><br /> Jeder Besucher unseres Online-Shops bekommt einen \'Besucherwarenkorb\'. Damit kann er seine ausgewählten Produkte sammeln. Sobald der Besucher den Online-Shop verlässt, verfällt dessen Inhalt.</p> <p><b><i>Kundenwarenkorb</i></b><br /> Jeder angemeldete Kunde verfügt über einen \'Kundenwarenkorb\' zum Einkaufen, mit dem er auch zu einem späterem Zeitpunkt den Einkauf beenden kann. Jeder Artikel bleibt darin registriert bis der Kunde zur Kasse geht, oder die Produkte darin löscht.</p> <p><b><i>Information</i></b><br /> Die Besuchereingaben werden automatisch bei der Registrierung als Kunde in den Kundenwarenkorb übernommen</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('9', '1', 'Visitors Cart / Members Cart', 'Visitors Cart / Members Cart', '<div style=\"width: 600px;\"><p><b><i>Visitors Cart</i></b><br /> Every visitor to our online shop will be given a \'Visitors Cart\'. This allows the visitor to store their products in a temporary shopping cart. Once the visitor leaves the online shop, so will the contents of their shopping cart.</p> <p><b><i>Members Cart</i></b><br /> Every member to our online shop that logs in is given a \'Members Cart\'. This allows the member to add products to their shopping cart, and come back at a later date to finalize their checkout. All products remain in their shopping cart until the member has checked them out, or removed the products themselves.</p> <p><b><i>Info</i></b><br /> If a member adds products to their \'Visitors Cart\' and decides to log in to the online shop to use their \'Members Cart\', the contents of their \'Visitors Cart\' will merge with their \'Members Cart\' contents automatically.</p></div>');
insert into contents_data (content_id, language_id, name, heading_title, content) values ('9', '3', 'Cesta del Visitante / Cesta del Asociado', 'Cesta del Visitante / Cesta del Asociado', '<div style=\"width: 600px;\"><p><b><i>Cesta de Visitante</i></b><br /> A cada visitante de nuestro catálogo le es asignado una \'Cesta de Visitante\'. Esto permite al invitado guardar sus productos en una cesta temporal. Una vez que el visitante abandona el catálogo, tambien desaparece el contenido de su cesta.</p> <p><b><i>Cesta de Asociado</i></b><br /> A cada miembro nuestro se le asigna una \'Cesta de Asociado\'. Esto permite al asociado añadir productos a su cesta de la compra, y volver mas tarde para finalizar el pedido. Todos los productos permanecen en la cesta hasta que el asociado ha realizado el pedido, o hasta que sean eliminados de la cesta manualmente.</p> <p><b><i>Información</i></b><br /> Si un asociado añade un articulo a su \'Cesta de Visitante\' y despues decide Entrar a su Cuenta para usar su \'Cesta de Asociado\', el contenido de la \'Cesta de Visitante\' sera añadido a la \'Cesta de Asociado\' automáticamente.</p></div>');

drop table if exists counter;
create table counter (
  startdate char(8) ,
  counter int(12) 
);

drop table if exists counter_history;
create table counter_history (
  month char(8) ,
  counter int(12) 
);

drop table if exists countries;
create table countries (
  countries_id int(11) not null auto_increment,
  countries_name varchar(255) not null ,
  countries_iso_code_2 varchar(2) not null ,
  countries_iso_code_3 varchar(3) not null ,
  address_format_id int(11) default '0' not null ,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
);

insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('14', 'Österreich', 'AT', 'AUT', '5');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('81', 'Deutschland', 'DE', 'DEU', '5');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('204', 'Schweiz', 'CH', 'CHE', '5');

drop table if exists countries_list;
create table countries_list (
  countries_id int(11) not null auto_increment,
  countries_name varchar(255) not null ,
  countries_iso_code_2 varchar(2) not null ,
  countries_iso_code_3 varchar(3) not null ,
  address_format_id int(11) default '0' not null ,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
);

insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('1', 'Afghanistan', 'AF', 'AFG', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('2', 'Albania', 'AL', 'ALB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('3', 'Algeria', 'DZ', 'DZA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('4', 'American Samoa', 'AS', 'ASM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('5', 'Andorra', 'AD', 'AND', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('6', 'Angola', 'AO', 'AGO', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('7', 'Anguilla', 'AI', 'AIA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('8', 'Antarctica', 'AQ', 'ATA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('9', 'Antigua and Barbuda', 'AG', 'ATG', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('10', 'Argentina', 'AR', 'ARG', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('11', 'Armenia', 'AM', 'ARM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('12', 'Aruba', 'AW', 'ABW', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('13', 'Australia', 'AU', 'AUS', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('14', 'Austria', 'AT', 'AUT', '5');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('15', 'Azerbaijan', 'AZ', 'AZE', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('16', 'Bahamas', 'BS', 'BHS', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('17', 'Bahrain', 'BH', 'BHR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('18', 'Bangladesh', 'BD', 'BGD', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('19', 'Barbados', 'BB', 'BRB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('20', 'Belarus', 'BY', 'BLR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('21', 'Belgium', 'BE', 'BEL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('22', 'Belize', 'BZ', 'BLZ', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('23', 'Benin', 'BJ', 'BEN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('24', 'Bermuda', 'BM', 'BMU', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('25', 'Bhutan', 'BT', 'BTN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('26', 'Bolivia', 'BO', 'BOL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('27', 'Bosnia and Herzegowina', 'BA', 'BIH', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('28', 'Botswana', 'BW', 'BWA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('29', 'Bouvet Island', 'BV', 'BVT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('30', 'Brazil', 'BR', 'BRA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('31', 'British Indian Ocean Territory', 'IO', 'IOT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('32', 'Brunei Darussalam', 'BN', 'BRN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('33', 'Bulgaria', 'BG', 'BGR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('34', 'Burkina Faso', 'BF', 'BFA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('35', 'Burundi', 'BI', 'BDI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('36', 'Cambodia', 'KH', 'KHM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('37', 'Cameroon', 'CM', 'CMR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('38', 'Canada', 'CA', 'CAN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('39', 'Cape Verde', 'CV', 'CPV', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('40', 'Cayman Islands', 'KY', 'CYM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('41', 'Central African Republic', 'CF', 'CAF', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('42', 'Chad', 'TD', 'TCD', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('43', 'Chile', 'CL', 'CHL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('44', 'China', 'CN', 'CHN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('45', 'Christmas Island', 'CX', 'CXR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('46', 'Cocos (Keeling) Islands', 'CC', 'CCK', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('47', 'Colombia', 'CO', 'COL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('48', 'Comoros', 'KM', 'COM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('49', 'Congo', 'CG', 'COG', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('50', 'Cook Islands', 'CK', 'COK', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('51', 'Costa Rica', 'CR', 'CRI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('52', 'Cote D\'Ivoire', 'CI', 'CIV', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('53', 'Croatia', 'HR', 'HRV', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('54', 'Cuba', 'CU', 'CUB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('55', 'Cyprus', 'CY', 'CYP', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('56', 'Czech Republic', 'CZ', 'CZE', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('57', 'Denmark', 'DK', 'DNK', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('58', 'Djibouti', 'DJ', 'DJI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('59', 'Dominica', 'DM', 'DMA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('60', 'Dominican Republic', 'DO', 'DOM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('61', 'East Timor', 'TP', 'TMP', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('62', 'Ecuador', 'EC', 'ECU', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('63', 'Egypt', 'EG', 'EGY', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('64', 'El Salvador', 'SV', 'SLV', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('65', 'Equatorial Guinea', 'GQ', 'GNQ', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('66', 'Eritrea', 'ER', 'ERI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('67', 'Estonia', 'EE', 'EST', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('68', 'Ethiopia', 'ET', 'ETH', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('69', 'Falkland Islands (Malvinas)', 'FK', 'FLK', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('70', 'Faroe Islands', 'FO', 'FRO', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('71', 'Fiji', 'FJ', 'FJI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('72', 'Finland', 'FI', 'FIN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('73', 'France', 'FR', 'FRA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('74', 'France, Metropolitan', 'FX', 'FXX', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('75', 'French Guiana', 'GF', 'GUF', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('76', 'French Polynesia', 'PF', 'PYF', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('77', 'French Southern Territories', 'TF', 'ATF', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('78', 'Gabon', 'GA', 'GAB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('79', 'Gambia', 'GM', 'GMB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('80', 'Georgia', 'GE', 'GEO', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('81', 'Germany', 'DE', 'DEU', '5');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('82', 'Ghana', 'GH', 'GHA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('83', 'Gibraltar', 'GI', 'GIB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('84', 'Greece', 'GR', 'GRC', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('85', 'Greenland', 'GL', 'GRL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('86', 'Grenada', 'GD', 'GRD', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('87', 'Guadeloupe', 'GP', 'GLP', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('88', 'Guam', 'GU', 'GUM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('89', 'Guatemala', 'GT', 'GTM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('90', 'Guinea', 'GN', 'GIN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('91', 'Guinea-bissau', 'GW', 'GNB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('92', 'Guyana', 'GY', 'GUY', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('93', 'Haiti', 'HT', 'HTI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('94', 'Heard and Mc Donald Islands', 'HM', 'HMD', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('95', 'Honduras', 'HN', 'HND', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('96', 'Hong Kong', 'HK', 'HKG', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('97', 'Hungary', 'HU', 'HUN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('98', 'Iceland', 'IS', 'ISL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('99', 'India', 'IN', 'IND', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('100', 'Indonesia', 'ID', 'IDN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('101', 'Iran (Islamic Republic of)', 'IR', 'IRN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('102', 'Iraq', 'IQ', 'IRQ', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('103', 'Ireland', 'IE', 'IRL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('104', 'Israel', 'IL', 'ISR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('105', 'Italy', 'IT', 'ITA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('106', 'Jamaica', 'JM', 'JAM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('107', 'Japan', 'JP', 'JPN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('108', 'Jordan', 'JO', 'JOR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('109', 'Kazakhstan', 'KZ', 'KAZ', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('110', 'Kenya', 'KE', 'KEN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('111', 'Kiribati', 'KI', 'KIR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('112', 'Korea, Democratic People\'s Republic of', 'KP', 'PRK', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('113', 'Korea, Republic of', 'KR', 'KOR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('114', 'Kuwait', 'KW', 'KWT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('115', 'Kyrgyzstan', 'KG', 'KGZ', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('116', 'Lao People\'s Democratic Republic', 'LA', 'LAO', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('117', 'Latvia', 'LV', 'LVA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('118', 'Lebanon', 'LB', 'LBN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('119', 'Lesotho', 'LS', 'LSO', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('120', 'Liberia', 'LR', 'LBR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('121', 'Libyan Arab Jamahiriya', 'LY', 'LBY', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('122', 'Liechtenstein', 'LI', 'LIE', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('123', 'Lithuania', 'LT', 'LTU', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('124', 'Luxembourg', 'LU', 'LUX', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('125', 'Macau', 'MO', 'MAC', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('126', 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('127', 'Madagascar', 'MG', 'MDG', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('128', 'Malawi', 'MW', 'MWI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('129', 'Malaysia', 'MY', 'MYS', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('130', 'Maldives', 'MV', 'MDV', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('131', 'Mali', 'ML', 'MLI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('132', 'Malta', 'MT', 'MLT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('133', 'Marshall Islands', 'MH', 'MHL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('134', 'Martinique', 'MQ', 'MTQ', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('135', 'Mauritania', 'MR', 'MRT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('136', 'Mauritius', 'MU', 'MUS', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('137', 'Mayotte', 'YT', 'MYT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('138', 'Mexico', 'MX', 'MEX', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('139', 'Micronesia, Federated States of', 'FM', 'FSM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('140', 'Moldova, Republic of', 'MD', 'MDA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('141', 'Monaco', 'MC', 'MCO', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('142', 'Mongolia', 'MN', 'MNG', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('143', 'Montserrat', 'MS', 'MSR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('144', 'Morocco', 'MA', 'MAR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('145', 'Mozambique', 'MZ', 'MOZ', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('146', 'Myanmar', 'MM', 'MMR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('147', 'Namibia', 'NA', 'NAM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('148', 'Nauru', 'NR', 'NRU', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('149', 'Nepal', 'NP', 'NPL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('150', 'Netherlands', 'NL', 'NLD', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('151', 'Netherlands Antilles', 'AN', 'ANT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('152', 'New Caledonia', 'NC', 'NCL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('153', 'New Zealand', 'NZ', 'NZL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('154', 'Nicaragua', 'NI', 'NIC', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('155', 'Niger', 'NE', 'NER', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('156', 'Nigeria', 'NG', 'NGA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('157', 'Niue', 'NU', 'NIU', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('158', 'Norfolk Island', 'NF', 'NFK', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('159', 'Northern Mariana Islands', 'MP', 'MNP', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('160', 'Norway', 'NO', 'NOR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('161', 'Oman', 'OM', 'OMN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('162', 'Pakistan', 'PK', 'PAK', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('163', 'Palau', 'PW', 'PLW', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('164', 'Panama', 'PA', 'PAN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('165', 'Papua New Guinea', 'PG', 'PNG', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('166', 'Paraguay', 'PY', 'PRY', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('167', 'Peru', 'PE', 'PER', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('168', 'Philippines', 'PH', 'PHL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('169', 'Pitcairn', 'PN', 'PCN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('170', 'Poland', 'PL', 'POL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('171', 'Portugal', 'PT', 'PRT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('172', 'Puerto Rico', 'PR', 'PRI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('173', 'Qatar', 'QA', 'QAT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('174', 'Reunion', 'RE', 'REU', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('175', 'Romania', 'RO', 'ROM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('176', 'Russian Federation', 'RU', 'RUS', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('177', 'Rwanda', 'RW', 'RWA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('178', 'Saint Kitts and Nevis', 'KN', 'KNA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('179', 'Saint Lucia', 'LC', 'LCA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('180', 'Saint Vincent and the Grenadines', 'VC', 'VCT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('181', 'Samoa', 'WS', 'WSM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('182', 'San Marino', 'SM', 'SMR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('183', 'Sao Tome and Principe', 'ST', 'STP', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('184', 'Saudi Arabia', 'SA', 'SAU', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('185', 'Senegal', 'SN', 'SEN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('186', 'Seychelles', 'SC', 'SYC', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('187', 'Sierra Leone', 'SL', 'SLE', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('188', 'Singapore', 'SG', 'SGP', '4');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('189', 'Slovakia (Slovak Republic)', 'SK', 'SVK', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('190', 'Slovenia', 'SI', 'SVN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('191', 'Solomon Islands', 'SB', 'SLB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('192', 'Somalia', 'SO', 'SOM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('193', 'South Africa', 'ZA', 'ZAF', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('194', 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('195', 'Spain', 'ES', 'ESP', '3');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('196', 'Sri Lanka', 'LK', 'LKA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('197', 'St. Helena', 'SH', 'SHN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('198', 'St. Pierre and Miquelon', 'PM', 'SPM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('199', 'Sudan', 'SD', 'SDN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('200', 'Suriname', 'SR', 'SUR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('201', 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('202', 'Swaziland', 'SZ', 'SWZ', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('203', 'Sweden', 'SE', 'SWE', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('204', 'Switzerland', 'CH', 'CHE', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('205', 'Syrian Arab Republic', 'SY', 'SYR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('206', 'Taiwan', 'TW', 'TWN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('207', 'Tajikistan', 'TJ', 'TJK', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('208', 'Tanzania, United Republic of', 'TZ', 'TZA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('209', 'Thailand', 'TH', 'THA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('210', 'Togo', 'TG', 'TGO', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('211', 'Tokelau', 'TK', 'TKL', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('212', 'Tonga', 'TO', 'TON', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('213', 'Trinidad and Tobago', 'TT', 'TTO', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('214', 'Tunisia', 'TN', 'TUN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('215', 'Turkey', 'TR', 'TUR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('216', 'Turkmenistan', 'TM', 'TKM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('217', 'Turks and Caicos Islands', 'TC', 'TCA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('218', 'Tuvalu', 'TV', 'TUV', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('219', 'Uganda', 'UG', 'UGA', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('220', 'Ukraine', 'UA', 'UKR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('221', 'United Arab Emirates', 'AE', 'ARE', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('222', 'United Kingdom', 'GB', 'GBR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('223', 'United States', 'US', 'USA', '2');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('224', 'United States Minor Outlying Islands', 'UM', 'UMI', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('225', 'Uruguay', 'UY', 'URY', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('226', 'Uzbekistan', 'UZ', 'UZB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('227', 'Vanuatu', 'VU', 'VUT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('228', 'Vatican City State (Holy See)', 'VA', 'VAT', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('229', 'Venezuela', 'VE', 'VEN', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('230', 'Viet Nam', 'VN', 'VNM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('231', 'Virgin Islands (British)', 'VG', 'VGB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('232', 'Virgin Islands (U.S.)', 'VI', 'VIR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('233', 'Wallis and Futuna Islands', 'WF', 'WLF', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('234', 'Western Sahara', 'EH', 'ESH', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('235', 'Yemen', 'YE', 'YEM', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('236', 'Yugoslavia', 'YU', 'YUG', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('237', 'Zaire', 'ZR', 'ZAR', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('238', 'Zambia', 'ZM', 'ZMB', '1');
insert into countries_list (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('239', 'Zimbabwe', 'ZW', 'ZWE', '1');

drop table if exists coupons;
create table coupons (
  coupon_id int(11) not null auto_increment,
  coupon_type char(1) not null default 'F',
  coupon_code varchar(32) not null default '',
  coupon_amount decimal(8,4) not null default '0.0000',
  coupon_minimum_order decimal(8,4) not null default '0.0000',
  coupon_start_date datetime not null default '0000-00-00 00:00:00',
  coupon_expire_date datetime not null default '0000-00-00 00:00:00',
  uses_per_coupon int(5) not null default '1',
  uses_per_user int(5) not null default '0',
  restrict_to_products varchar(255) default null,
  restrict_to_categories varchar(255) default null,
  coupon_active char(1) not null default 'Y',
  date_created datetime not null default '0000-00-00 00:00:00',
  date_modified datetime not null default '0000-00-00 00:00:00',
  PRIMARY KEY (coupon_id)
);

drop table if exists coupons_description;
create table coupons_description (
  coupon_id int(11) not null default '0',
  language_id int(11) not null default '0',
  coupon_name varchar(255) not null default '',
  coupon_description text,
  KEY coupon_id (coupon_id)
);

drop table if exists coupon_email_track;
create table coupon_email_track (
  unique_id int(11) not null auto_increment,
  coupon_id int(11) not null default '0',
  customer_id_sent int(11) not null default '0',
  sent_firstname varchar(255) default null,
  sent_lastname varchar(255) default null,
  emailed_to varchar(255) default null,
  date_sent datetime not null default '0000-00-00 00:00:00',
  PRIMARY KEY (unique_id)
);

drop table if exists coupon_gv_customer;
create table coupon_gv_customer (
  customer_id int(5) not null default '0',
  amount decimal(8,4) not null default '0.0000',
  PRIMARY KEY (customer_id)
);

drop table if exists coupon_gv_queue;
create table coupon_gv_queue (
  unique_id int(5) not null auto_increment,
  customer_id int(5) not null default '0',
  order_id int(5) not null default '0',
  amount decimal(8,4) not null default '0.0000',
  date_created datetime not null default '0000-00-00 00:00:00',
  ipaddr varchar(64) not null default '',
  release_flag char(1) not null default 'N',
  PRIMARY KEY (unique_id),
  KEY IDX_UID (customer_id,order_id)
);

drop table if exists coupon_redeem_track;
create table coupon_redeem_track (
  unique_id int(11) not null auto_increment,
  coupon_id int(11) not null default '0',
  customer_id int(11) not null default '0',
  redeem_date datetime not null default '0000-00-00 00:00:00',
  redeem_ip varchar(64) not null default '',
  order_id int(11) not null default '0',
  PRIMARY KEY (unique_id)
);

drop table if exists currencies;
create table currencies (
  currencies_id int(11) not null auto_increment ,
  language_id int(11) default '1' not null ,
  title varchar(255) not null ,
  code varchar(3) not null ,
  symbol_left varchar(32) ,
  symbol_right varchar(32) ,
  decimal_point char(1) ,
  thousands_point char(1) ,
  decimal_places char(1) ,
  value float(13,8) ,
  last_updated datetime ,
  PRIMARY KEY (currencies_id, language_id)
);

insert into currencies (currencies_id, language_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('1', '2', 'Schweizer Franken', 'CHF', 'SFr.', '', '.', ',', '2', '1.00000000', now());
insert into currencies (currencies_id, language_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('1', '1', 'Swiss franc', 'CHF', '', 'CHF', '.', ',', '2', '1.00000000', now());
insert into currencies (currencies_id, language_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('1', '3', 'Franco suizo', 'CHF', '', 'CHF', '.', ',', '2', '1.00000000', now());
insert into currencies (currencies_id, language_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('2', '2', 'Euro', 'EUR', '', '€', '.', ',', '2', '0.62760597', now());
insert into currencies (currencies_id, language_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('2', '1', 'Euro', 'EUR', '', '€', '.', ',', '2', '0.62760597', now());
insert into currencies (currencies_id, language_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('2', '3', 'Euro', 'EUR', '', '€', '.', ',', '2', '0.62760597', now());

drop table if exists customers;
create table customers (
  customers_id int(11) not null auto_increment,
  customers_gender char(1) ,
  customers_c_id varchar(64) ,
  customers_firstname varchar(255) not null ,
  customers_lastname varchar(255) not null ,
  customers_dob datetime default '0000-00-00 00:00:00' not null ,
  customers_email_address varchar(255) not null ,
  customers_language_id int(11) not null,
  customers_default_address_id int(11) ,
  customers_telephone varchar(255) not null ,
  customers_fax varchar(255) ,
  customers_password varchar(60) not null ,
  customers_group_id smallint(5) default '0' not null ,
  customers_group_ra enum('0','1') default '0' not null ,
  customers_comments text ,
  PRIMARY KEY (customers_id)
);

insert into customers (customers_id, customers_gender, customers_c_id, customers_firstname, customers_lastname, customers_dob, customers_email_address, customers_language_id, customers_default_address_id, customers_telephone, customers_fax, customers_password, customers_group_id, customers_group_ra) values ('1', 'f', '123-321-456', 'Erika', 'Mustermann', '2001-01-01 00:00:00', 'retail@localhost', '2', '1', '123 456 789', '', 'afe47190d0daf47ddd47486c22fa0c52:2b', '0', '0');
insert into customers (customers_id, customers_gender, customers_c_id, customers_firstname, customers_lastname, customers_dob, customers_email_address, customers_language_id, customers_default_address_id, customers_telephone, customers_fax, customers_password, customers_group_id, customers_group_ra) values ('2', 'm', '123-321-459', 'Max', 'Mustermann', '1989-10-28 00:00:00', 'reseller@localhost', '2', '5', '456 467 9432', '456 467 9433', 'ee84b3e5058c8f8e1997f05832d88e10:90', '1', '0');

drop table if exists customers_basket;
create table customers_basket (
  customers_basket_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  products_id tinytext not null ,
  customers_basket_quantity int(11) default '0' not null ,
  final_price decimal(15,4) ,
  customers_basket_date_added varchar(8) ,
  PRIMARY KEY (customers_basket_id)
);

drop table if exists customers_groups;
create table customers_groups (
  customers_group_id smallint(5) default '0' not null ,
  customers_group_name varchar(32) not null ,
  customers_group_discount decimal(6,2) default '0.00' not null ,
  customers_group_show_tax enum('1','0') default '1' not null ,
  customers_group_tax_exempt enum('0','1') default '0' not null ,
  group_payment_allowed varchar(255) not null ,
  group_shipment_allowed varchar(255) not null ,
  PRIMARY KEY (customers_group_id)
);

insert into customers_groups (customers_group_id, customers_group_name, customers_group_discount, customers_group_show_tax, customers_group_tax_exempt, group_payment_allowed, group_shipment_allowed) values ('0', 'Retail', '0.00', '1', '0', 'cc.php;cod.php', 'flat.php');
insert into customers_groups (customers_group_id, customers_group_name, customers_group_discount, customers_group_show_tax, customers_group_tax_exempt, group_payment_allowed, group_shipment_allowed) values ('1', 'Reseller', '7.75', '0', '0', 'cc.php;invoice.php', 'flat.php');

drop table if exists customers_info;
create table customers_info (
  customers_info_id int(11) default '0' not null ,
  customers_info_date_of_last_logon datetime ,
  customers_info_number_of_logons int(5) ,
  customers_info_date_account_created datetime ,
  customers_info_date_account_last_modified datetime ,
  global_product_notifications int(1) default '0' ,
  PRIMARY KEY (customers_info_id)
);

insert into customers_info (customers_info_id, customers_info_date_of_last_logon, customers_info_number_of_logons, customers_info_date_account_created, customers_info_date_account_last_modified, global_product_notifications) values ('1', now(), '15', now(), now(), '0');
insert into customers_info (customers_info_id, customers_info_date_of_last_logon, customers_info_number_of_logons, customers_info_date_account_created, customers_info_date_account_last_modified, global_product_notifications) values ('2', now(), '3', now(), now(), '0');

drop table if exists geo_zones;
create table geo_zones (
  geo_zone_id int(11) not null auto_increment,
  geo_zone_name varchar(255) not null ,
  geo_zone_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (geo_zone_id)
);

insert into geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) values ('1', 'Deutschland', 'Deutsches Steuergebiet', now(), date_sub(now(),interval 3 day));
insert into geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) values ('2', 'Schweiz', 'Schweizer Steuergebiet', NULL, date_sub(now(),interval 3 day));
insert into geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) values ('3', 'Österreich', 'Österreichisches Steuergebiet', NULL, date_sub(now(),interval 3 day));

drop table if exists languages;
create table languages (
  languages_id int(11) not null auto_increment,
  use_in_id enum('1','2','3') default '3' not null ,
  display_in_catalog tinyint(1) default '1' not null ,
  name varchar(64) not null ,
  code varchar(2) not null ,
  image varchar(255) ,
  directory varchar(64) ,
  sort_order int(3) ,
  PRIMARY KEY (languages_id),
  KEY IDX_NAME (name)
);

insert into languages (languages_id, use_in_id, display_in_catalog, name, code, image, directory, sort_order) values ('1', '3', '1', 'English', 'en', 'icon.gif', 'english', '2');
insert into languages (languages_id, use_in_id, display_in_catalog, name, code, image, directory, sort_order) values ('2', '3', '1', 'Deutsch', 'de', 'icon.gif', 'german', '1');
insert into languages (languages_id, use_in_id, display_in_catalog, name, code, image, directory, sort_order) values ('3', '3', '1', 'Español', 'es', 'icon.gif', 'espanol', '3');

drop table if exists manufacturers;
create table manufacturers (
  manufacturers_id int(11) not null auto_increment ,
  manufacturers_image varchar(255) ,
  date_added datetime ,
  last_modified datetime ,
  PRIMARY KEY (manufacturers_id)
);

insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('1', 'manufacturer_matrox.gif', date_sub(now(),interval 1 day), now());
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('2', 'manufacturer_microsoft.gif', date_sub(now(),interval 1 day), NULL);
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('3', 'manufacturer_warner.gif', date_sub(now(),interval 1 day), NULL);
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('4', 'manufacturer_fox.gif', date_sub(now(),interval 1 day), now());
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('5', 'manufacturer_logitech.gif', date_sub(now(),interval 1 day), NULL);
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('6', 'manufacturer_canon.gif', date_sub(now(),interval 1 day), now());
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('7', 'manufacturer_sierra.gif', date_sub(now(),interval 1 day), NULL);
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('8', 'manufacturer_gt_interactive.gif', date_sub(now(),interval 1 day), NULL);
insert into manufacturers (manufacturers_id, manufacturers_image, date_added, last_modified) values ('9', 'manufacturer_hewlett_packard.gif', date_sub(now(),interval 1 day), NULL);

drop table if exists manufacturers_info;
create table manufacturers_info (
  manufacturers_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  manufacturers_name varchar(255) not null ,
  manufacturers_url varchar(255) not null ,
  url_clicked int(5) default '0' not null ,
  date_last_click datetime ,
  PRIMARY KEY (manufacturers_id, languages_id),
  KEY IDX_MANUFACTURERS_NAME (manufacturers_name)  
);

insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('1', '1', 'Matrox', 'http://www.matrox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('1', '2', 'Matrox', 'http://www.matrox.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('1', '3', 'Matrox', 'http://www.matrox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('2', '1', 'Microsoft', 'http://www.microsoft.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('2', '2', 'Microsoft', 'http://www.microsoft.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('2', '3', 'Microsoft', 'http://www.microsoft.es', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('3', '1', 'Warner', 'http://www.warner.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('3', '2', 'Warner', 'http://www.warner.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('3', '3', 'Warner', 'http://www.warner.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('4', '1', 'Fox', 'http://www.fox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('4', '2', 'Fox', 'http://www.fox.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('4', '3', 'Fox', 'http://www.fox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('5', '1', 'Logitech', 'http://www.logitech.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('5', '2', 'Logitech', 'http://www.logitech.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('5', '3', 'Logitech', 'http://www.logitech.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('6', '1', 'Canon', 'http://www.canon.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('6', '2', 'Canon', 'http://www.canon.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('6', '3', 'Canon', 'http://www.canon.es', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('7', '1', 'Sierra', 'http://www.sierra.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('7', '2', 'Sierra', 'http://www.sierra.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('7', '3', 'Sierra', 'http://www.sierra.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('8', '1', 'GT Interactive', 'http://www.infogrames.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('8', '2', 'GT Interactive', 'http://www.infogrames.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('8', '3', 'GT Interactive', 'http://www.infogrames.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('9', '1', 'Hewlett Packard', 'http://www.hewlettpackard.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('9', '2', 'Hewlett Packard', 'http://www.hewlettpackard.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_name, manufacturers_url, url_clicked, date_last_click) values ('9', '3', 'Hewlett Packard', 'http://welcome.hp.com/country/es/spa/welcome.htm', '0', NULL);

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

insert into newsletter_subscribers (subscriber_id, customers_id, subscriber_language_id, subscriber_email_address, subscriber_identity_code, newsletter_status, newsletter_status_change, subscriber_date_added) values ('1', '1', '2', 'retail@localhost', 'CBP0RzhdRh0U', '1', date_sub(now(),interval 1 day), date_sub(now(),interval 2 day));
insert into newsletter_subscribers (subscriber_id, customers_id, subscriber_language_id, subscriber_email_address, subscriber_identity_code, newsletter_status, newsletter_status_change, subscriber_date_added) values ('2', '2', '2', 'reseller@localhost', 'PpQbIHCoOlsQ', '1', date_sub(now(),interval 2 day), date_sub(now(),interval 5 day));
insert into newsletter_subscribers (subscriber_id, customers_id, subscriber_language_id, subscriber_email_address, subscriber_identity_code, newsletter_status, newsletter_status_change, subscriber_date_added) values ('3', '0', '1', 'subscriber@localhost', 'PCBVFTdF1LpI', '1', date_sub(now(),interval 2 day), date_sub(now(),interval 3 day));

drop table if exists newsletters;
create table newsletters (
  newsletters_id int(11) not null auto_increment,
  title varchar(255) not null ,
  language_id int not null ,
  content_text_plain text not null ,
  content_text_htlm text not null ,
  module varchar(255) not null ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  date_sent datetime ,
  status int(1) ,
  locked int(1) default '0' ,
  PRIMARY KEY (newsletters_id)
);

drop table if exists orders;
create table orders (
  orders_id int(11) not null auto_increment,
  customers_id int(11) default '0' not null ,
  customers_c_id varchar(64) ,
  customers_name varchar(255) not null ,
  customers_company varchar(255) ,
  customers_street_address varchar(255) not null ,
  customers_suburb varchar(255) ,
  customers_city varchar(255) not null ,
  customers_postcode varchar(255) not null ,
  customers_state varchar(255) ,
  customers_country varchar(255) not null ,
  customers_telephone varchar(255) not null ,
  customers_email_address varchar(255) not null ,
  customers_address_format_id int(5) default '0' not null ,
  delivery_name varchar(255) not null ,
  delivery_company varchar(255) ,
  delivery_street_address varchar(255) not null ,
  delivery_suburb varchar(255) ,
  delivery_city varchar(255) not null ,
  delivery_postcode varchar(255) not null ,
  delivery_state varchar(255) ,
  delivery_country varchar(255) not null ,
  delivery_address_format_id int(5) default '0' not null ,
  billing_name varchar(255) not null ,
  billing_company varchar(255) ,
  billing_street_address varchar(255) not null ,
  billing_suburb varchar(255) ,
  billing_city varchar(255) not null ,
  billing_postcode varchar(255) not null ,
  billing_state varchar(255) ,
  billing_country varchar(255) not null ,
  billing_address_format_id int(5) default '0' not null ,
  payment_method varchar(255) not null ,
  cc_type varchar(20) ,
  cc_owner varchar(255) ,
  cc_number blob ,
  cc_expires varchar(4) ,
  last_modified datetime ,
  date_purchased datetime ,
  orders_status int(5) default '0' not null ,
  orders_date_finished datetime ,
  language_id int(5) default '0' not null ,
  language_directory varchar(64) ,
  currency varchar(3) ,
  currency_value decimal(14,6) ,
  PRIMARY KEY (orders_id),
  KEY IDX_CUSTOMERS_ID (customers_id)
);

insert into orders (orders_id, customers_id, customers_c_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, language_id, language_directory, currency, currency_value) values ('10', '2', '123-321-459', 'Max Mustermann', 'GaGa AG', 'Solgenstrasse 45', '', 'Baldingen', '57056', 'Salzburg', 'Österreich', '456 467 9432', 'reseller@localhost', '5', 'Max Mustermann', 'GaGa AG', 'Solgenstrasse 45', '', 'Baldingen', '57056', 'Salzburg', 'Österreich', '5', 'Max Mustermann', 'GaGa AG', 'Solgenstrasse 45', '', 'Baldingen', '57056', 'Salzburg', 'Österreich', '5', 'PayPal', '', '', '', '', now(), now(), '3', NULL, '2', 'german', 'EUR', '0.655200');
insert into orders (orders_id, customers_id, customers_c_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, language_id, language_directory, currency, currency_value) values ('11', '1', '123-321-456', 'Erika Mustermann', '', 'Einbahnstrasse 11', '', 'Bindingen', '12345', 'Bern', 'Schweiz', '123 456 789', 'retail@localhost', '5', 'Erika Mustermann', '', 'Einbahnstrasse 11', '', 'Bindingen', '12345', 'Bern', 'Schweiz', '5', 'Erika Mustermann', '', 'Einbahnstrasse 11', '', 'Bindingen', '12345', 'Bern', 'Schweiz', '5', 'Nachnahme', '', '', '', '', now(), now(), '2', NULL, '2', 'german', 'CHF', '1.000000');
insert into orders (orders_id, customers_id, customers_c_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, language_id, language_directory, currency, currency_value) values ('12', '1', '123-321-456', 'Erika Mustermann', '', 'Einbahnstrasse 11', '', 'Bindingen', '12345', 'Bern', 'Schweiz', '123 456 789', 'retail@localhost', '5', 'Erika Mustermann', '', 'Einbahnstrasse 11', '', 'Bindingen', '12345', 'Bern', 'Schweiz', '5', 'Erika Mustermann', '', 'Einbahnstrasse 11', '', 'Bindingen', '12345', 'Bern', 'Schweiz', '5', 'PayPal', '', '', '', '', now(), now(), '1', NULL, '2', 'german', 'EUR', '0.655200');

drop table if exists orders_products;
create table orders_products (
  orders_products_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  products_id int(11) default '0' not null ,
  products_attributes_sting varchar(32) ,
  products_model varchar(32) ,
  products_name varchar(64) not null ,
  products_p_unit varbinary(32) ,
  products_price decimal(15,4) default '0.0000' not null ,
  final_price decimal(15,4) default '0.0000' not null ,  
  products_price_text varchar(255) not null ,
  final_price_text varchar(255) not null ,
  total_price_text varchar(255) not null ,  
  products_tax decimal(7,4) default '0.0000' not null ,
  products_quantity int(4) default '0' not null ,
  PRIMARY KEY (orders_products_id),
  KEY IDX_ORDERS_ID (orders_id),
  KEY IDX_PRODUCTS_ID (products_id)  
);

insert into orders_products (orders_products_id, orders_id, products_id, products_attributes_sting, products_model, products_name, products_p_unit, products_price, final_price, products_price_text, final_price_text, total_price_text, products_tax, products_quantity) values ('46', '12', '27', NULL, 'HPLJ1100XI', 'Hewlett-Packard LaserJet 1100Xi', 'Set', '334.8100', '334.8100', '334.81 €', '334.81 €', '334.81 €', '2.4000', '1');
insert into orders_products (orders_products_id, orders_id, products_id, products_attributes_sting, products_model, products_name, products_p_unit, products_price, final_price, products_price_text, final_price_text, total_price_text, products_tax, products_quantity) values ('39', '10', '26', '3,9', 'MSIMEXP', 'Microsoft IntelliMouse Explorer', 'Schachtel', '40.4900', '44.4100', '40.49 €', '44.41 €', '44.41 €', '20.0000', '1');
insert into orders_products (orders_products_id, orders_id, products_id, products_attributes_sting, products_model, products_name, products_p_unit, products_price, final_price, products_price_text, final_price_text, total_price_text, products_tax, products_quantity) values ('40', '10', '27', NULL, 'HPLJ1100XI', 'Hewlett-Packard LaserJet 1100Xi', 'Set', '326.9600', '326.9600', '326.96 €', '326.96 €', '653.92 €', '10.0000', '2');
insert into orders_products (orders_products_id, orders_id, products_id, products_attributes_sting, products_model, products_name, products_p_unit, products_price, final_price, products_price_text, final_price_text, total_price_text, products_tax, products_quantity) values ('41', '10', '23', NULL, 'PC-TWOF', 'The Wheel Of Time', 'Schachtel', '60.8600', '60.8600', '60.86 €', '60.86 €', '60.86 €', '20.0000', '1');
insert into orders_products (orders_products_id, orders_id, products_id, products_attributes_sting, products_model, products_name, products_p_unit, products_price, final_price, products_price_text, final_price_text, total_price_text, products_tax, products_quantity) values ('42', '10', '2', '3,7_4,3', 'MG400-32MB', 'Matrox G400 32 MB', 'Schachtel', '327.5400', '399.6000', '327.54 €', '399.60 €', '399.60 €', '20.0000', '1');
insert into orders_products (orders_products_id, orders_id, products_id, products_attributes_sting, products_model, products_name, products_p_unit, products_price, final_price, products_price_text, final_price_text, total_price_text, products_tax, products_quantity) values ('43', '11', '26', '3,9', 'MSIMEXP', 'Microsoft IntelliMouse Explorer', 'Schachtel', '66.5000', '72.9500', 'SFr. 66.50', 'SFr. 72.95', 'SFr. 72.95', '7.6000', '1');
insert into orders_products (orders_products_id, orders_id, products_id, products_attributes_sting, products_model, products_name, products_p_unit, products_price, final_price, products_price_text, final_price_text, total_price_text, products_tax, products_quantity) values ('44', '11', '19', NULL, 'DVD-TSAB', 'Verrückt nach Mary', 'Schachtel', '49.9000', '49.9000', 'SFr. 49.90', 'SFr. 49.90', 'SFr. 49.90', '7.6000', '1');
insert into orders_products (orders_products_id, orders_id, products_id, products_attributes_sting, products_model, products_name, products_p_unit, products_price, final_price, products_price_text, final_price_text, total_price_text, products_tax, products_quantity) values ('45', '12', '2', '3,7_4,3', 'MG400-32MB', 'Matrox G400 32 MB', 'Schachtel', '352.4300', '429.9600', '352.43 €', '429.96 €', '429.96 €', '7.6000', '1');

drop table if exists orders_products_attributes;
create table orders_products_attributes (
  orders_products_attributes_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  orders_products_id int(11) default '0' not null ,
  products_options varchar(32) not null ,
  products_options_values varchar(32) not null ,
  options_values_price decimal(15,4) default '0.0000' not null ,
  options_values_price_text varchar(255) not null ,
  price_prefix char(1) not null ,
  PRIMARY KEY (orders_products_attributes_id)
);

insert into orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, options_values_price_text, price_prefix) values ('22', '12', '45', 'Modell', 'Deluxe Ausgabe', '84.5800', '84.58 €', '+');
insert into orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, options_values_price_text, price_prefix) values ('21', '11', '43', 'Modell', 'USB Anschluss', '6.4500', 'SFr. 6.45', '+');
insert into orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, options_values_price_text, price_prefix) values ('20', '10', '42', 'Speicher', '16 MB', '6.5500', '6.55 €', '-');
insert into orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, options_values_price_text, price_prefix) values ('18', '10', '39', 'Modell', 'USB Anschluss', '3.9200', '3.92 €', '+');
insert into orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, options_values_price_text, price_prefix) values ('19', '10', '42', 'Modell', 'Deluxe Ausgabe', '78.6100', '78.61 €', '+');
insert into orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, options_values_price_text, price_prefix) values ('23', '12', '45', 'Speicher', '16 MB', '7.0500', '7.05 €', '-');

drop table if exists orders_products_download;
create table orders_products_download (
  orders_products_download_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  orders_products_id int(11) default '0' not null ,
  orders_products_filename varchar(255) not null ,
  download_maxdays int(2) default '0' not null ,
  download_count int(2) default '0' not null ,
  PRIMARY KEY (orders_products_download_id)
);

drop table if exists orders_status;
create table orders_status (
  orders_status_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  orders_status_name varchar(32) not null ,
  orders_status_code varchar(12) not null ,
  public_flag int default '1',
  downloads_flag int default '0',  
  PRIMARY KEY (orders_status_id, language_id),
  KEY IDX_ORDERS_STATUS_NAME (orders_status_name)
);

insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('1', '1', 'Pending', '', '1', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('1', '2', 'Offen', '', '1', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('1', '3', 'Pendiente', '', '1', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('2', '1', 'Processing', '', '1', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('2', '2', 'In Bearbeitung', '', '1', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('2', '3', 'Proceso', '', '1', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('3', '1', 'Delivered', '', '1', '1');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('3', '2', 'Versendet', '', '1', '1');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('3', '3', 'Entregado', '', '1', '1');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('4', '2', 'Storniert', '', '1', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('4', '1', 'Revoked', '', '1', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('4', '3', 'Revocado', '', '1', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('5', '2', 'Vorbereitung [PayPal Standard]', 'paypal_st', '0', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('5', '1', 'Preparing [PayPal Standard]', 'paypal_st', '0', '0');
insert into orders_status (orders_status_id, language_id, orders_status_name, orders_status_code, public_flag, downloads_flag) values ('5', '3', 'Preparación [PayPal Standard]', 'paypal_st', '0', '0');

drop table if exists orders_status_history;
create table orders_status_history (
  orders_status_history_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  orders_status_id int(5) default '0' not null ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  customer_notified int(1) default '0' ,
  comments text ,
  PRIMARY KEY (orders_status_history_id)
);

insert into orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) values ('24', '11', '1', date_sub(now(),interval 2 day), '1', '');
insert into orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) values ('26', '12', '5', date_sub(now(),interval 2 day), '0', '');
insert into orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) values ('27', '12', '1', date_sub(now(),interval 2 day), '1', '');
insert into orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) values ('21', '10', '5', date_sub(now(),interval 2 day), '0', '');
insert into orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) values ('22', '10', '1', date_sub(now(),interval 2 day), '1', '');
insert into orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) values ('23', '10', '3', date_sub(now(),interval 2 day), '1', '');

drop table if exists orders_total;
create table orders_total (
  orders_total_id int(10) not null auto_increment,
  orders_id int(11) default '0' not null ,
  title varchar(255) not null ,
  text varchar(255) not null ,
  value decimal(15,4) default '0.0000' not null ,
  tax decimal(7,4) default '0.0000' not null ,
  class varchar(32) not null ,
  sort_order int(11) default '0' not null ,
  PRIMARY KEY (orders_total_id),
  KEY IDX_ORDERS_ID (orders_id)
);

insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('65', '10', '<span style=\"color : #ff0000;\">7.75% Rabatt:</span>', '<span style=\"color : #ff0000;\">-89.81 €</span>', '-89.8100', '0.0000', 'ot_subtotal', '1');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('66', '10', 'Zwischensumme:', '1,068.98 €', '1068.9800', '0.0000', 'ot_subtotal', '1');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('67', '10', 'Pauschale Versandkosten (Bester Weg):', '3.35 €', '3.3480', '20.0000', 'ot_shipping', '3');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('68', '10', 'zzgl.&nbsp;[MwSt.(A)] (20.00%):', '93.81 €', '93.8100', '0.0000', 'ot_tax', '4');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('69', '10', 'zzgl.&nbsp;[MwSt.(reduziert)(A)] (10.00%):', '60.32 €', '60.3200', '0.0000', 'ot_tax', '4');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('70', '10', '<b>Summe</b>:', '<b>1,226.46 €</b>', '1226.4600', '0.0000', 'ot_total', '5');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('71', '11', 'Zwischensumme:', 'SFr. 122.85', '122.8500', '0.0000', 'ot_subtotal', '1');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('72', '11', 'Pauschale Versandkosten (Bester Weg):', 'SFr. 5.50', '5.5000', '7.6000', 'ot_shipping', '3');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('73', '11', 'inkl.&nbsp;[MwSt.(CH)] (7.60%):', 'SFr. 9.06', '9.0600', '0.0000', 'ot_tax', '4');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('74', '11', '<b>Summe</b>:', '<b>SFr. 128.35</b>', '128.3500', '0.0000', 'ot_total', '5');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('75', '12', 'Zwischensumme:', '764.77 €', '764.7700', '0.0000', 'ot_subtotal', '1');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('76', '12', 'Pauschale Versandkosten (Bester Weg):', '3.60 €', '3.5980', '7.6000', 'ot_shipping', '3');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('77', '12', 'inkl.&nbsp;[MwSt.(CH)] (7.60%):', '30.62 €', '30.6200', '0.0000', 'ot_tax', '4');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('78', '12', 'inkl.&nbsp;[MwSt.(reduziert)(CH)] (2.40%):', '7.85 €', '7.8500', '0.0000', 'ot_tax', '4');
insert into orders_total (orders_total_id, orders_id, title, text, value, tax, class, sort_order) values ('79', '12', '<b>Summe</b>:', '<b>768.37 €</b>', '768.3700', '0.0000', 'ot_total', '5');

drop table if exists products;
create table products (
  products_id int(11) not null auto_increment,
  products_quantity int(7) default '0' not null ,
  products_model varchar(32) ,
  products_image text ,
  products_price text ,
  products_sort_order int(6) ,
  products_date_added datetime default '0000-00-00 00:00:00' not null ,
  products_last_modified datetime ,
  products_date_available datetime ,
  products_weight decimal(5,2) default '0.00' not null ,
  products_status tinyint(1) default '0' not null ,
  products_tax_class_id int(11) default '0' not null ,
  manufacturers_id int(11) ,
  products_ordered int(11) default '0' not null ,
  attributes_quantity text ,
  attributes_combinations text ,
  attributes_not_updated text ,
  PRIMARY KEY (products_id, products_status),
  KEY IDX_MANUFACTURERS_ID (manufacturers_id)
);

insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('1', '40', 'MG200MMS', 'a:1:{i:0;a:3:{s:4:\"name\";s:16:\"1_0_mg200mms.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:8:\"299.2565\";}s:14:\"special_status\";i:0;}}', '20', date_sub(now(),interval 10 day), now(), NULL, '23.00', '1', '1', '1', '1', 'a:5:{s:7:\"3,6_4,3\";i:7;s:7:\"3,6_4,1\";i:5;s:7:\"3,6_4,2\";i:10;s:7:\"3,5_4,1\";i:10;s:7:\"3,5_4,2\";i:8;}', '3,6_4,3|3,6_4,1|3,6_4,2|3,5_4,1|3,5_4,2|', NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('2', '41', 'MG400-32MB', 'a:1:{i:0;a:3:{s:4:\"name\";s:18:\"2_0_mg400-32mb.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:8:\"499.9071\";}s:14:\"special_status\";i:0;}}', '10', date_sub(now(),interval 10 day), now(), NULL, '23.00', '1', '1', '1', '1', 'a:4:{s:7:\"3,7_4,3\";i:12;s:7:\"3,7_4,4\";i:9;s:7:\"3,6_4,3\";i:12;s:7:\"3,6_4,4\";i:8;}', '3,7_4,3|3,7_4,4|3,6_4,3|3,6_4,4|', NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('3', '54', 'MSIMPRO', 'a:1:{i:0;a:3:{s:4:\"name\";s:15:\"3_0_msimpro.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:2:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"50.0929\";}s:14:\"special_status\";i:0;}i:1;a:5:{i:0;a:1:{s:7:\"regular\";s:7:\"49.2565\";}s:14:\"special_status\";i:0;i:12;a:1:{s:7:\"regular\";s:7:\"44.6097\";}i:24;a:1:{s:7:\"regular\";s:7:\"39.9628\";}i:36;a:1:{s:7:\"regular\";s:7:\"36.2454\";}}}', '10', date_sub(now(),interval 12 day), now(), NULL, '7.00', '1', '1', '3', '26', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('4', '13', 'DVD-RPMK', 'a:1:{i:0;a:3:{s:4:\"name\";s:27:\"4_0_replacement_killers.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"42.0074\";}s:14:\"special_status\";i:0;}}', '40', date_sub(now(),interval 12 day), now(), NULL, '23.00', '1', '1', '2', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('5', '17', 'DVD-BLDRNDC', 'a:1:{i:0;a:3:{s:4:\"name\";s:20:\"5_0_blade_runner.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"36.0130\";}s:14:\"special_status\";i:0;}}', '10', date_sub(now(),interval 15 day), now(), NULL, '7.00', '1', '1', '3', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('6', '10', 'DVD-MATR', 'a:1:{i:0;a:3:{s:4:\"name\";s:18:\"6_0_the_matrix.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:2:{s:7:\"regular\";s:7:\"39.9628\";s:7:\"special\";s:7:\"35.3160\";}s:14:\"special_status\";s:1:\"0\";}}', '60', date_sub(now(),interval 15 day), now(), NULL, '7.00', '1', '1', '3', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('7', '9', 'DVD-YGEM', 'a:1:{i:0;a:3:{s:4:\"name\";s:22:\"7_0_youve_got_mail.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:2:{s:7:\"regular\";s:7:\"34.9442\";s:7:\"special\";s:7:\"31.5520\";}s:14:\"special_status\";s:1:\"1\";}}', '20', date_sub(now(),interval 16 day), now(), NULL, '7.00', '1', '1', '3', '1', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('8', '17', 'DVD-ABUG', 'a:1:{i:0;a:3:{s:4:\"name\";s:19:\"8_0_a_bugs_life.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"35.9665\";}s:14:\"special_status\";i:0;}}', '10', date_sub(now(),interval 18 day), now(), NULL, '7.00', '1', '1', '3', '12', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('9', '10', 'DVD-UNSG', 'a:1:{i:0;a:3:{s:4:\"name\";s:19:\"9_0_under_siege.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"30.0186\";}s:14:\"special_status\";i:0;}}', '30', date_sub(now(),interval 18 day), now(), NULL, '7.00', '1', '1', '3', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('10', '9', 'DVD-UNSG2', 'a:1:{i:0;a:3:{s:4:\"name\";s:21:\"10_0_under_siege2.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:2:{s:7:\"regular\";s:7:\"29.7398\";s:7:\"special\";s:7:\"25.8364\";}s:14:\"special_status\";s:1:\"1\";}}', '20', date_sub(now(),interval 25 day), now(), date_add(now(),interval 30 day), '7.00', '1', '1', '3', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('11', '10', 'DVD-FDBL', 'a:1:{i:0;a:3:{s:4:\"name\";s:24:\"11_0_fire_down_below.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"29.9721\";}s:14:\"special_status\";i:0;}}', '50', date_sub(now(),interval 25 day), now(), NULL, '7.00', '1', '1', '3', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('12', '10', 'DVD-DHWV', 'a:1:{i:0;a:3:{s:4:\"name\";s:19:\"12_0_die_hard_3.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"40.0093\";}s:14:\"special_status\";i:0;}}', '90', date_sub(now(),interval 25 day), now(), NULL, '7.00', '1', '1', '4', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('13', '10', 'DVD-LTWP', 'a:1:{i:0;a:3:{s:4:\"name\";s:22:\"13_0_lethal_weapon.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"34.9442\";}s:14:\"special_status\";i:0;}}', '10', date_sub(now(),interval 27 day), now(), NULL, '7.00', '1', '1', '3', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('14', '10', 'DVD-REDC', 'a:1:{i:0;a:3:{s:4:\"name\";s:19:\"14_0_red_corner.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"31.9703\";}s:14:\"special_status\";i:0;}}', '20', date_sub(now(),interval 25 day), now(), NULL, '7.00', '1', '1', '3', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('15', '9', 'DVD-FRAN', 'a:1:{i:0;a:3:{s:4:\"name\";s:16:\"15_0_frantic.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"34.3866\";}s:14:\"special_status\";i:0;}}', '10', date_sub(now(),interval 29 day), now(), NULL, '7.00', '1', '1', '3', '1', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('16', '10', 'DVD-CUFI', 'a:1:{i:0;a:3:{s:4:\"name\";s:27:\"16_0_courage_under_fire.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"38.9870\";}s:14:\"special_status\";i:0;}}', '10', date_sub(now(),interval 29 day), NULL, NULL, '7.00', '1', '1', '4', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('17', '10', 'DVD-SPEED', 'a:1:{i:0;a:3:{s:4:\"name\";s:14:\"17_0_speed.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"39.9628\";}s:14:\"special_status\";i:0;}}', '70', date_sub(now(),interval 29 day), NULL, NULL, '7.00', '1', '1', '4', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('18', '10', 'DVD-SPEED2', 'a:1:{i:0;a:3:{s:4:\"name\";s:16:\"18_0_speed_2.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"42.3327\";}s:14:\"special_status\";i:0;}}', '80', date_sub(now(),interval 30 day), now(), NULL, '7.00', '1', '1', '4', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('19', '84', 'DVD-TSAB', 'a:1:{i:0;a:3:{s:4:\"name\";s:36:\"19_0_theres_something_about_mary.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:2:{s:7:\"regular\";s:7:\"49.2565\";s:7:\"special\";s:7:\"46.3755\";}s:14:\"special_status\";s:1:\"1\";}}', '10', date_sub(now(),interval 31 day), NULL, NULL, '7.00', '1', '1', '4', '16', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('20', '10', 'DVD-BELOVED', 'a:1:{i:0;a:3:{s:4:\"name\";s:16:\"20_0_beloved.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"54.9721\";}s:14:\"special_status\";i:0;}}', '30', date_sub(now(),interval 38 day), now(), NULL, '7.00', '1', '1', '3', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('21', '16', 'PC-SWAT3', 'a:1:{i:0;a:3:{s:4:\"name\";s:15:\"21_0_swat_3.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"80.0186\";}s:14:\"special_status\";i:0;}}', '10', date_sub(now(),interval 45 day), now(), NULL, '7.00', '1', '1', '7', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('22', '10009', 'PC-UNTM', 'a:1:{i:0;a:3:{s:4:\"name\";s:26:\"22_0_unreal_tournament.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"89.9628\";}s:14:\"special_status\";i:0;}}', '10', date_sub(now(),interval 52 day), now(), NULL, '7.00', '1', '1', '8', '0', 'a:2:{s:4:\"5,13\";i:10;s:4:\"5,10\";i:9999;}', '5,13|5,10|', NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('23', '36', 'PC-TWOF', 'a:1:{i:0;a:3:{s:4:\"name\";s:22:\"23_0_wheel_of_time.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:2:{s:7:\"regular\";s:7:\"99.9535\";s:7:\"special\";s:7:\"92.8903\";}s:14:\"special_status\";s:1:\"1\";}}', '10', date_sub(now(),interval 64 day), NULL, NULL, '10.00', '1', '1', '8', '13', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('24', '17', 'PC-DISC', 'a:1:{i:0;a:3:{s:4:\"name\";s:18:\"24_0_disciples.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:7:\"90.0093\";}s:14:\"special_status\";i:0;}}', '20', date_sub(now(),interval 92 day), now(), NULL, '8.00', '1', '1', '8', '0', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('25', '15', 'MSINTKB', 'a:1:{i:0;a:3:{s:4:\"name\";s:23:\"25_0_intkeyboardps2.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:5:{i:0;a:1:{s:7:\"regular\";s:7:\"69.9814\";}s:14:\"special_status\";i:0;i:3;a:1:{s:7:\"regular\";s:7:\"66.9145\";}i:5;a:1:{s:7:\"regular\";s:7:\"64.8699\";}i:7;a:1:{s:7:\"regular\";s:7:\"62.9647\";}}}', '10', date_sub(now(),interval 92 day), NULL, NULL, '8.00', '1', '1', '2', '1', NULL, NULL, NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('26', '36', 'MSIMEXP', 'a:3:{i:0;a:3:{s:4:\"name\";s:19:\"26_0_imexplorer.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}i:4;a:3:{s:4:\"name\";s:24:\"26_4_explorer_mouse1.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}i:5;a:3:{s:4:\"name\";s:24:\"26_5_explorer_mouse2.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:4:{i:0;a:2:{s:7:\"regular\";s:7:\"64.1264\";s:7:\"special\";s:7:\"61.8030\";}s:14:\"special_status\";s:1:\"1\";i:3;a:2:{s:7:\"regular\";s:7:\"61.0595\";s:7:\"special\";s:7:\"59.0149\";}i:5;a:2:{s:7:\"regular\";s:7:\"57.6208\";s:7:\"special\";s:7:\"55.5762\";}}}', '20', date_sub(now(),interval 125 day), now(), NULL, '8.00', '1', '1', '2', '3', 'a:2:{s:3:\"3,8\";i:18;s:3:\"3,9\";i:18;}', '3,8|3,9|', NULL);
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_sort_order, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, attributes_quantity, attributes_combinations, attributes_not_updated) values ('27', '60', 'HPLJ1100XI', 'a:1:{i:0;a:3:{s:4:\"name\";s:17:\"27_0_lj1100xi.jpg\";s:21:\"large_image_max_width\";s:7:\"default\";s:22:\"large_image_max_height\";s:7:\"default\";}}', 'a:1:{i:0;a:2:{i:0;a:1:{s:7:\"regular\";s:8:\"499.0234\";}s:14:\"special_status\";i:0;}}', '10', date_sub(now(),interval 125 day), NULL, NULL, '45.00', '1', '2', '9', '8', NULL, NULL, NULL);

drop table if exists products_attributes;
create table products_attributes (
  products_attributes_id int(11) not null auto_increment,
  products_id int(11) default '0' not null ,
  options_id int(11) default '0' not null ,
  options_values_id int(11) default '0' not null ,
  options_sort_order int(3) default '1' not null ,  
  options_values_sort_order int(3) default '1' not null ,
  options_values_price decimal(15,4) default '0.0000' not null ,
  price_prefix char(1) not null ,
  PRIMARY KEY (products_attributes_id),
  KEY IDX_PRODUCTS_ID (products_id)
);

insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('1', '1', '4', '1', '1', '1', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('2', '1', '4', '2', '1', '1', '50.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('3', '1', '4', '3', '1', '1', '69.9814', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('4', '1', '3', '5', '1', '1', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('5', '1', '3', '6', '1', '1', '100.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('6', '2', '4', '3', '1', '1', '9.9907', '-');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('7', '2', '4', '4', '1', '1', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('8', '2', '3', '6', '1', '1', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('9', '2', '3', '7', '1', '1', '119.9814', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('10', '26', '3', '8', '1', '1', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('11', '26', '3', '9', '1', '1', '5.9944', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('26', '22', '5', '10', '1', '1', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_sort_order, options_values_sort_order, options_values_price, price_prefix) values ('27', '22', '5', '13', '1', '1', '0.0000', '+');

drop table if exists products_attributes_download;
create table products_attributes_download (
  products_attributes_id int(11) default '0' not null ,
  products_attributes_filename varchar(255) not null ,
  products_attributes_maxdays int(2) default '0' ,
  products_attributes_maxcount int(2) default '0' ,
  PRIMARY KEY (products_attributes_id)
);

insert into products_attributes_download (products_attributes_id, products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount) values ('26', 'unreal.zip', '7', '3');

drop table if exists products_description;
create table products_description (
  products_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  products_name varchar(64) not null ,
  products_p_unit varbinary(32) ,
  products_info text ,
  products_description_tab_label varchar(512) ,
  products_description text ,
  products_url varchar(255) ,
  products_viewed int(5) default '0' ,
  PRIMARY KEY (products_id, language_id),
  KEY IDX_PRODUCTS_NAME (products_name)
);

insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('1', '1', 'Matrox G200 MMS', 'Box', 'Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8\" PCI board.', '', '<p>Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8\" PCI board.<br /> <br /> With continuing demand for digital flat panels in the financial workplace, the Matrox G200 MMS is the ultimate in flexible solutions. The Matrox G200 MMS also supports the new digital video interface (DVI) created by the Digital Display Working Group (DDWG) designed to ease the adoption of digital flat panels. Other configurations include composite video capture ability and onboard TV tuner, making the Matrox G200 MMS the complete solution for business needs.<br /> <br /> Based on the award-winning MGA-G200 graphics chip, the Matrox G200 Multi-Monitor Series provides superior 2D/3D graphics acceleration to meet the demanding needs of business applications such as real-time stock quotes (Versus), live video feeds (Reuters &amp; Bloombergs), multiple windows applications, word processing, spreadsheets and CAD.</p>', 'www.matrox.com/mga/products/g200_mms/home.cfm', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('2', '1', 'Matrox G400 32MB', 'Box', '<ul>  <li>New Matrox G400 256-bit DualBus graphics chip</li>  <li>Explosive 3D, 2D and DVD performance</li>  <li>DualHead Display</li>  <li>Superior DVD and TV output</li>  <li>3D Environment-Mapped Bump Mapping</li>  <li>Vibrant Color Quality rendering</li> </ul>', '', '<p><strong>Dramatically Different High Performance Graphics</strong><br /> <br /> Introducing the Millennium G400 Series - a dramatically different, high performance graphics experience. Armed with the industry\'s fastest graphics chip, the Millennium G400 Series takes explosive acceleration two steps further by adding unprecedented image quality, along with the most versatile display options for all your 3D, 2D and DVD applications. As the most powerful and innovative tools in your PC\'s arsenal, the Millennium G400 Series will not only change the way you see graphics, but will revolutionize the way you use your computer.<br /> <br /> <strong>Key features:</strong></p> <ul>  <li>New Matrox G400 256-bit DualBus graphics chip</li>  <li>Explosive 3D, 2D and DVD performance</li>  <li>DualHead Display</li>  <li>Superior DVD and TV output</li>  <li>3D Environment-Mapped Bump Mapping</li>  <li>Vibrant Color Quality rendering</li>  <li>UltraSharp DAC of up to 360 MHz</li>  <li>3D Rendering Array Processor</li>  <li>Support for 16 or 32 MB of memory</li> </ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('3', '1', 'Microsoft IntelliMouse Pro', 'Setbox', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research.', '', '<p>Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft\'s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.</p>', 'www.microsoft.com/hardware/mouse/intellimouse.asp', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('4', '1', 'The Replacement Killers', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Picture Format: 16:9 Wide-Screen.<br /> Length: (approx) 80 minutes.<br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', 'www.replacement-killers.com', '1');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('5', '1', 'Blade Runner - Director\'s Cut', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Picture Format: 16:9 Wide-Screen.<br /> Length: (approx) 112 minutes.<br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', 'www.bladerunner.com', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('6', '1', 'The Matrix', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch. <br /> Audio: Dolby Surround. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 131 minutes. <br /> Other: Interactive Menus, Chapter Selection, Making Of.</p>', 'www.thematrix.com', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('7', '1', 'You\'ve Got Mail', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch, Spanish. <br /> Subtitles: English, Deutsch, Spanish, French, Nordic, Polish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch, Spanish. <br /> Subtitles: English, Deutsch, Spanish, French, Nordic, Polish. <br /> Audio: Dolby Digital 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 115 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', 'www.youvegotmail.com', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('8', '1', 'A Bug\'s Life', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', 'Product Description, Plot', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Digital 5.1 / Dobly Surround Stereo. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 91 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p> <div style=\"page-break-after: always;\"> 	<span style=\"display: none;\">&nbsp;</span></div> <p> 	Flik, an individualist and would-be inventor, lives in a colony of ants. The ants are led by Princess Atta and her mother, the Queen, and they live on a small island in the middle of a creek. Flik is different and always unappreciated because of his problematic inventions. The colony is oppressed by a gang of marauding grasshoppers led by Hopper who arrive every season demanding food from the ants. When the annual offering is inadvertently knocked into a stream by Flik\'s latest invention, a harvester device, the grasshoppers demand twice as much food as compensation. Given a temporary reprieve by the grasshoppers, Flik tricks the ants into accepting his plan to recruit \"warrior bugs\" to fight off the grasshoppers. While Flik actually believes in the plan, the other ants see it as a fool\'s errand to get rid of Flik and save themselves trouble. Making his way to the \"big city\" (a heap of trash under a trailer), Flik mistakes a group of circus bugs for the warrior bugs he seeks. The bugs, in turn, mistake Flik for a talent agent, and agree to travel with him back to Ant Island.<br /> 	Discovering their mutual misunderstanding, the circus bugs attempt to leave, but are forced back by a bird. They save Princess Dot, the Queen\'s daughter and Atta\'s sister, from the bird as they flee, gaining the ants\' trust in the process. They continue the ruse of being \"warriors\" so the troupe can continue to enjoy the attention and hospitality of the ants. The bird encounter inspires Flik into creating an artificial bird to scare away Hopper, leader of the grasshoppers, who is deeply afraid of birds. The bird is constructed, but the circus bugs are exposed by their former ringmaster, P.T. Flea, when he arrives searching for them. Angered at Flik\'s deception, the ants exile him and desperately attempt to pull together enough food for a new offering to the grasshoppers, but fail to do so. When the grasshoppers discover a meager offering upon their arrival, they take control of the entire colony and begin eating the ants\' winter store of food. After overhearing Hopper\'s plan to kill the queen, Dot leaves in search of Flik and convinces him to return and save the colony with his original plan. The plan nearly works, but P.T. Flea lights the bird model on fire, causing it to crash and be exposed as a fake. Hopper has Flik beaten in retaliation, but Flik defies Hopper and inspires the entire colony to stand up to the grasshoppers and drive them out of the colony.<br /> 	Before Hopper can be disposed of, it begins to rain. In the chaos, Hopper viciously pursues Flik, who leads him to an actual bird\'s nest. Mistaking the real bird for another fake one, Hopper attracts its attention by taunting it. Hopper is eaten by the bird\'s chicks. Some time later, Flik has been welcomed back to the colony, and he and Atta are now a couple. As the troupe departs with the last grasshopper, Molt, as an employee, Atta is crowned the new Queen, while Dot gets the princess\' crown. The circus troupe then departs as Flik, Atta and Dot watch and wave farewell in a tree branch.</p>', 'www.abugslife.com', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('9', '1', 'Under Siege', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 98 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('10', '1', 'Under Siege 2 - Dark Territory', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Picture Format: 16:9 Wide-Screen.<br /> Length: (approx) 98 minutes.<br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('11', '1', 'Fire Down Below', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 100 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('12', '1', 'Die Hard With A Vengeance', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 122 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('13', '1', 'Lethal Weapon', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 100 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('14', '1', 'Red Corner', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 117 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('15', '1', 'Frantic', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 115 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('16', '1', 'Courage Under Fire', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 112 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('17', '1', 'Speed', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 112 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('18', '1', 'Speed 2: Cruise Control', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 120 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('19', '1', 'There\'s Something About Mary', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Picture Format: 16:9 Wide-Screen.<br /> Length: (approx) 114 minutes.<br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('20', '1', 'Beloved', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 164 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('21', '1', 'SWAT 3: Close Quarters Battle', 'Box', 'Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and \"When needed\" to use deadly force to keep the peace.', '', '<p><strong>Windows 95/98</strong><br /> <br /> 211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and \"When needed\" to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!</p>', 'www.swat3.com', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('22', '1', 'Unreal Tournament', 'Box / Download', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.', '', '<p>From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br /> <br /> This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It\'s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of \'bots\' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.</p>', 'www.unrealtournament.net', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('23', '1', 'The Wheel Of Time', 'Box', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan\'s pages; it\'s huge and consists of many different environments.', '', '<p>The world in which The Wheel of Time takes place is lifted directly out of Jordan\'s pages; it\'s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you\'re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter\'angreal, Portal Stones, and the Ways. However you move around, though, you\'ll quickly discover that means of locomotion can easily become the least of the your worries...<br /> <br /> During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time\'s main characters. Some of these places are ripped directly from the pages of Jordan\'s books, made flesh with Legend\'s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you\'ll have this year.</p>', 'www.wheeloftime.com', '1');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('24', '1', 'Disciples: Sacred Lands', 'Box', 'Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars.', '', '<p>A new age is dawning...<br /> <br /> Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br /> <br /> The day of reckoning has come... and only the chosen will survive.</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('25', '1', 'Microsoft Internet Keyboard PS/2', 'Setbox', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest.', '', '<p>The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!</p>', '', '2');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('26', '1', 'Microsoft IntelliMouse Explorer', 'Box', 'IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse.', '', '<p>Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!</p>', 'www.microsoft.com/hardware/mouse/explorer.asp', '8');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('27', '1', 'Hewlett Packard LaserJet 1100Xi', 'Set', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed.', '', '<p>HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP\'s Resolution Enhancement technology (REt) makes every document more professional.<br /> <br /> Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br /> <br /> HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).</p>', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('1', '2', 'Matrox G200 MMS', 'Schachtel', '<ul>  <li>Preisgekrönter Matrox G200 128-Bit Grafikchip</li>  <li>Schneller 8 MB SGRAM-Speicher pro Kanal</li>  <li>Integrierter, leistungsstarker 250 MHz RAMDAC</li> </ul>', '', '<p><strong>Unterstützung für zwei bzw. vier analoge oder digitale Monitore</strong><br /> <br /> Die Matrox G200 Multi-Monitor-Serie führt die bewährte Matrox Tradition im Multi-Monitor- Bereich fort und bietet flexible und fortschrittliche Lösungen.Matrox stellt als erstes Unternehmen einen vierfachen digitalen PanelLink&reg; DVI Flachbildschirm Ausgang zur Verfügung. Mit den optional erhältlichen TV Tuner und Video-Capture Möglichkeiten stellt die Matrox G200 MMS eine alles umfassende Mehrschirm-Lösung dar.<br /> <br /> <strong>Leistungsmerkmale:</strong></p> <ul>  <li>Preisgekrönter Matrox G200 128-Bit Grafikchip</li>  <li>Schneller 8 MB SGRAM-Speicher pro Kanal</li>  <li>Integrierter, leistungsstarker 250 MHz RAMDAC</li>  <li>Unterstützung für bis zu 16 Bildschirme über 4 Quad-Karten (unter Win NT,ab Treiber 4.40)</li>  <li>Unterstützung von 9 Monitoren unter Win 98</li>  <li>2 bzw. 4 analoge oder digitale Ausgabekanäle pro PCI-Karte</li>  <li>Desktop-Darstellung von 1800 x 1440 oder 1920 x 1200 pro Chip</li>  <li>Anschlußmöglichkeit an einen 15-poligen VGA-Monitor oder an einen 30-poligen digitalen DVI-Flachbildschirm plus integriertem Composite-Video-Eingang (bei der TV-Version)</li>  <li>PCI Grafikkarte, kurze Baulänge</li>  <li>Treiberunterstützung: Windows&reg; 2000, Windows NT&reg; und Windows&reg; 98</li>  <li>Anwendungsbereiche: Börsenumgebung mit zeitgleich großem Visualisierungsbedarf, Videoüberwachung, Video-Conferencing</li> </ul>', 'www.matrox.com/mga/deutsch/products/g200_mms/home.cfm', '12');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('2', '2', 'Matrox G400 32 MB', 'Schachtel', '<ul>  <li>DualHead Display und TV-Ausgang</li>  <li>Environment Mapped Bump Mapping</li>  <li>Matrox G400 256-Bit DualBus</li>  <li>3D Rendering Array Prozessor</li>  <li>Vibrant Color Quality&sup2; (VCQ&sup2;)</li>  <li>UltraSharp DAC</li> </ul>', '', '<p><strong>Neu! Matrox G400 \"all inclusive\" und vieles mehr...</strong><br /> <br /> Die neue Millennium G400-Serie - Hochleistungsgrafik mit dem sensationellen Unterschied. Ausgestattet mit dem neu eingeführten Matrox G400 Grafikchip, bietet die Millennium G400-Serie eine überragende Beschleunigung inklusive bisher nie dagewesener Bildqualitat und enorm flexibler Darstellungsoptionen bei allen Ihren 3D-, 2D- und DVD-Anwendungen.</p> <ul>  <li>DualHead Display und TV-Ausgang</li>  <li>Environment Mapped Bump Mapping</li>  <li>Matrox G400 256-Bit DualBus</li>  <li>3D Rendering Array Prozessor</li>  <li>Vibrant Color Quality&sup2; (VCQ&sup2;)</li>  <li>UltraSharp DAC</li> </ul> <p><em>\"Bleibt abschließend festzustellen, daß die Matrox Millennium G400 Max als Allroundkarte für den Highend-PC derzeit unerreicht ist. Das ergibt den Testsieg und unsere wärmste Empfehlung.\"</em><br /> <strong>GameStar 8/99 (S.184)</strong></p>', 'www.matrox.com/mga/deutsch/products/mill_g400/home.cfm', '15');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('3', '2', 'Microsoft IntelliMouse Pro', 'Schachtel (Set)', 'Die IntelliMouse Pro hat mit der IntelliRad-Technologie einen neuen Standard gesetzt. Anwenderfreundliche Handhabung und produktiveres Arbeiten am PC zeichnen die IntelliMouse aus.', '', '<p>Die IntelliMouse Pro hat mit der IntelliRad-Technologie einen neuen Standard gesetzt. Anwenderfreundliche Handhabung und produktiveres Arbeiten am PC zeichnen die IntelliMouse aus. Die gewölbte Oberseite paßt sich natürlich in die Handfläche ein, die geschwungene Form erleichtert das Bedienen der Maus. Sie ist sowohl für Rechts- wie auch für Linkshänder geeignet. Mit dem Rad der IntelliMouse kann der Anwender einfach und komfortabel durch Dokumente navigieren.<br /> <br /> <strong>Eigenschaften:</strong></p> <ul>  <li><strong>ANSCHLUSS:</strong> PS/2</li>  <li><strong>FARBE:</strong> weiß</li>  <li><strong>TECHNIK:</strong> Mauskugel</li>  <li><strong>TASTEN:</strong> 3 (incl. Scrollrad)</li>  <li><strong>SCROLLRAD:</strong> Ja</li> </ul>', '', '3');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('4', '2', 'Die Ersatzkiller', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br />', '', '<p>Originaltitel: \"The Replacement Killers\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 80 minutes.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> (USA 1998). Til Schweiger schießt auf Hongkong-Star Chow Yun-Fat (\"Anna und der König\") &shy; ein Fehler ...</p>', 'www.replacement-killers.com', '3');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('5', '2', 'Blade Runner - Director\'s Cut', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 112 minutes.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> <strong>Sci-Fi-Klassiker, USA 1983, 112 Min.</strong><br /> <br /> Los Angeles ist im Jahr 2019 ein Hexenkessel. Dauerregen und Smog tauchen den überbevölkerten Moloch in ewige Dämmerung. Polizeigleiter schwirren durch die Luft und überwachen das grelle Ethnogemisch, das sich am Fuße 400stöckiger Stahlbeton-Pyramiden tummelt. Der abgehalfterte Ex-Cop und \"Blade Runner\" Rick Deckard ist Spezialist für die Beseitigung von Replikanten, künstlichen Menschen, geschaffen für harte Arbeit auf fremden Planeten. Nur ihm kann es gelingen, vier flüchtige, hochintelligente \"Nexus 6\"-Spezialmodelle zu stellen. Die sind mit ihrem starken und brandgefährlichen Anführer Batty auf der Suche nach ihrem Schöpfer. Er soll ihnen eine längere Lebenszeit schenken. Das muß Rick Deckard verhindern. Als sich der eiskalte Jäger in Rachel, die Sekretärin seines Auftraggebers, verliebt, gerät sein Weltbild jedoch ins Wanken. Er entdeckt, daß sie - vielleicht wie er selbst - ein Replikant ist ...<br /> <br /> Die Konfrontation des Menschen mit \"Realität\" und \"Virtualität\" und das verstrickte Spiel mit getürkten Erinnerungen zieht sich als roter Faden durch das Werk von Autor Philip K. Dick (\"Die totale Erinnerung\"). Sein Roman \"Träumen Roboter von elektrischen Schafen?\" liefert die Vorlage für diesen doppelbödigen Thriller, der den Zuschauer mit faszinierenden Zukunftsvisionen und der gigantischen Kulisse des Großstadtmolochs gefangen nimmt.</p>', 'www.bladerunner.com', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('6', '2', 'Matrix', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"The Matrix\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 136 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> (USA 1999) Der Geniestreich der Wachowski-Brüder. In dieser technisch perfekten Utopie kämpft Hacker Keanu Reeves gegen die Diktatur der Maschinen...</p>', 'www.whatisthematrix.com', '2');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('7', '2', 'e-m@il für Dich', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Original: \"You\'ve got mail\"<br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 112 minutes.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> (USA 1998) von Nora Ephron (\"Schlaflos in Seattle\"). Meg Ryan und Tom Hanks knüpfen per E-Mail zarte Bande. Dass sie sich schon kennen, ahnen sie nicht ...</p>', 'www.youvegotmail.com', '3');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('8', '2', 'Das Große Krabbeln', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', 'Produkt-Beschreibung, Handlung', '<p>Originaltitel: \"A Bug\'s Life\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> (USA 1998). Ameise Flik zettelt einen Aufstand gegen gefräßige Grashüpfer an ... Eine fantastische Computeranimation des \"Toy Story\"-Teams.</p> <div style=\"page-break-after: always;\"> 	<span style=\"display: none;\">&nbsp;</span></div> <p> 	Der Film handelt von einer Kolonie Ameisen, die auf einer Insel lebt. Eine der Ameisen ist der impulsive und tolpatschige Erfinder Flik, der verzweifelt versucht, seinen Platz in der Gruppe zu finden. Er kann sich aber nicht in das konservative System im Ameisenhaufen einfügen und eckt mit seinen seltsamen, selten funktionierenden Ideen andauernd an; besonders Atta, die Kronprinzessin der Kolonie, ist nicht sehr begeistert von ihm. Die einzige Ameise der Kolonie, die Flik eine treue Freundin ist, ist Dot, Prinzessin Attas kleine Schwester.<br /> 	Die Kolonie sammelt Nahrung für den Winter – mehr als sie eigentlich müssten, denn jedes Jahr im Sommer spielt sich das gleiche Szenario ab: Der Grashüpfer Hopper und seine Bande terrorisieren die Kolonie und zwingen die Ameisen, regelmäßig für sie Futter bereitzustellen. Die Ameisen haben sich aus Angst längst damit abgefunden. Aber dieses Jahr passiert Flick mit einer seiner Erfindungen ein Missgeschick, und die gesamte Futteransammlung fällt in den Fluss, der die Insel umgibt. Die Drohung der Grashüpfer kommt kurzerhand: Im Herbst kommen sie wieder, und dieses Mal soll die doppelte Menge für sie bereit liegen.<br /> 	Da Flick die ganze Sache unglaublich leidtut, hat er einen Plan: Er will Verstärkung besorgen, die gegen die Grashüpfer kämpft und sie endlich verjagt. Der hohe Rat der Ameisen stimmt diesem Plan nur zu, um ihn bei ihren Reparaturbemühungen endlich aus dem Weg zu haben. Flik aber verkalkuliert sich: Zwar findet er Insekten, aber durch ein Missverständnis erfährt er erst später, dass es sich um Zirkusartisten handelt, die gerade von ihrem Direktor nach einer katastrophalen Vorstellung gefeuert wurden. Doch er will seine Leute nicht noch einmal enttäuschen und heckt einen neuen Plan aus. Zur Abschreckung der Grashüpfer hätten sich die Krieger eine raffinierte Taktik ausgedacht: Da Hopper sich vor Vögeln zu Tode fürchtet, soll ein Vogel aus Ästen und Blättern gebaut werden, um die Grashüpfer von der Insel zu verjagen.<br /> 	Die Kolonie ist zunächst skeptisch, stimmt dann aber zu und setzt alles daran, die Idee zu verwirklichen. Doch der Schwindel, die Insekten seien Krieger, fliegt auf, als der Zirkusdirektor auf der Suche nach seinen Artisten auf der Insel auftaucht, und das Projekt erleidet einen herben Rückschlag. Flik wird aus der Gemeinschaft verstoßen und schließt sich den Zirkusartisten an, die nun wieder von dannen ziehen.<br /> 	Die Ameisen machen sich jetzt schleunigst wieder daran, das Futter zu beschaffen, doch es ist nicht genug da, um die Forderung zu erfüllen. Als die Grashüpfer eintreffen, beginnt für die Kolonie eine Tortur. Wie Sklaven werden sie von den Grashüpfern getrieben, um das Futter zu besorgen, und um die Ameisen weiter zu demoralisieren, fasst Hopper den Plan, bei Abschluss der Arbeit die Königin zu töten. Dot erfährt von dem Plan, eilt Flik und den Artisten nach und berichtet ihnen von der Lage. Flick wird bewusst, dass er nun alles wiedergutmachen kann, und eilt mit den Insekten zurück zur Insel. Sie geben den Grashüpfern eine Zirkusvorstellung – ein Ablenkungsmanöver, um die Königin unauffällig aus der Bahn zu bringen und den Vogel startklar zu machen.<br /> 	Als der Vogel startet, läuft zunächst alles nach Plan, doch der Zirkusdirektor nimmt fälschlicherweise an, der Angriff gelte seinen Artisten, und setzt den Vogel in Brand. Nun fliegt die ganze Sache auf, und alles scheint vorbei – doch dann macht Flik seinen Mitameisen bewusst, dass sie in ihrer Gemeinschaft viel stärker sind als die Grashüpferbande. Mit diesem neu gewonnen Selbstbewusstsein vertreiben sie die Grashüpfer. Hopper versucht aus Rache, Flik zu töten, wird aber von diesem zu einem Vogelnest gelockt und von dessen Bewohner aufgefressen.<br /> 	Im Frühling verabschiedet die gesamte Kolonie die Artisten als Freunde. Flik hat durch seine Heldentat endlich seinen Platz in der Kolonie gefunden, nicht nur weil seine Erfindungen jetzt endlich als nützlich angesehen werden, sondern auch als Gefährte von Atta, die die Königskrone übernimmt.</p>', 'www.abugslife.com', '2');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('9', '2', 'Alarmstufe: Rot', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br />', '', '<p>Originaltitel: \"Under Siege\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> <strong>Actionthriller. Smutje Steven Seagal versalzt Schurke Tommy Lee Jones die Suppe</strong><br /> <br /> Katastrophe ahoi: Kurz vor Ausmusterung der \"U.S.S. Missouri\" kapert die High-tech-Bande von Ex-CIA-Agent Strannix (Tommy Lee Jones) das Schlachtschiff. Strannix will die Nuklearraketen des Kreuzers klauen und verscherbeln. Mit Hilfe des irren Ersten Offiziers Krill (lustig: Gary Busey) killen die Gangster den Käpt&rsquo;n und sperren seine Crew unter Deck. Blöd, dass sie dabei Schiffskoch Rybak (Steven Seagal) vergessen. Der Ex-Elitekämpfer knipst einen Schurken nach dem anderen aus. Eine Verbündete findet er in Stripperin Jordan (Ex-\"Baywatch\"-Biene Erika Eleniak). Die sollte eigentlich aus Käpt&rsquo;ns Geburtstagstorte hüpfen ... Klar: Seagal ist kein Edelmime. Dafür ist Regisseur Andrew Davis (\"Auf der Flucht\") ein Könner: Er würzt die Action-Orgie mit Ironie und nutzt die imposante Schiffskulisse voll aus. Für Effekte und Ton gab es 1993 Oscar-Nominierungen.</p>', '', '1');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('10', '2', 'Alarmstufe: Rot 2', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br />', '', '<p>Originaltitel: \"Under Siege 2: Dark Territory\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> (USA &rsquo;95). Von einem gekaperten Zug aus übernimmt Computerspezi Dane die Kontrolle über einen Kampfsatelliten und erpresst das Pentagon. Aber auch Ex-Offizier Ryback (Steven Seagal) ist im Zug ...</p>', '', '10');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('11', '2', 'Fire Down Below', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> Ein mysteriöser Mordfall führt den Bundesmarschall Jack Taggert in eine Kleinstadt im US-Staat Kentucky. Doch bei seinen Ermittlungen stößt er auf eine Mauer des Schweigens. Angst beherrscht die Stadt, und alle Spuren führen zu dem undurchsichtigen Minen-Tycoon Orin Hanner. Offenbar werden in der friedlichen Berglandschaft gigantische Mengen Giftmülls verschoben, mit unkalkulierbaren Risiken. Um eine Katastrophe zu verhindern, räumt Taggert gnadenlos auf ...</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('12', '2', 'Stirb Langsam - Jetzt Erst Recht', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"Die Hard With A Vengeance\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> So explosiv, so spannend, so rasant wie nie zuvor: Bruce Willis als Detectiv John McClane in einem Action-Thriller der Superlative! Das ist heute nicht McClanes Tag. Seine Frau hat ihn verlassen, sein Boß hat ihn vom Dienst suspendiert und irgendein Verrückter hat ihn gerade zum Gegenspieler in einem teuflischen Spiel erkoren - und der Einsatz ist New York selbst. Ein Kaufhaus ist explodiert, doch das ist nur der Auftakt. Der geniale Superverbrecher Simon droht, die ganze Stadt Stück für Stück in die Luft zu sprengen, wenn McClane und sein Partner wider Willen seine explosiven\" Rätsel nicht lösen. Eine mörderische Hetzjagd quer durch New York beginnt - bis McClane merkt, daß der Bombenterror eigentlich nur ein brillantes Ablenkungsmanöver ist...!<br /> <em>\"Perfekt gemacht und stark besetzt. Das Action-Highlight des Jahres!\"</em> <strong>(Bild)</strong></p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('13', '2', 'Zwei stahlharte Profis', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"Lethal Weapon\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> Sie sind beide Cops in L.A.. Sie haben beide in Vietnam für eine Spezialeinheit gekämpft. Und sie hassen es beide, mit einem Partner arbeiten zu müssen. Aber sie sind Partner: Martin Riggs, der Mann mit dem Todeswunsch, für wen auch immer. Und Roger Murtaugh, der besonnene Polizist. Gemeinsam enttarnen sie einen gigantischen Heroinschmuggel, hinter dem sich eine Gruppe ehemaliger CIA-Söldner verbirgt. Eine Killerbande gegen zwei Profis ...</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('14', '2', 'Labyrinth ohne Ausweg', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"Red Corner\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> Dem Amerikaner Jack Moore wird in China der bestialische Mord an einem Fotomodel angehängt. Brutale Gefängnisschergen versuchen, ihn durch Folter zu einem Geständnis zu zwingen. Vor Gericht fordert die Anklage die Todesstrafe - Moore\'s Schicksal scheint besiegelt. Durch einen Zufall gelingt es ihm, aus der Haft zu fliehen, doch aus der feindseligen chinesischen Hauptstadt gibt es praktisch kein Entkommen ...</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('15', '2', 'Frantic', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"Frantic\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> Ein romantischer Urlaub in Paris, der sich in einen Alptraum verwandelt. Ein Mann auf der verzweifelten Suche nach seiner entführten Frau. Ein düster-bedrohliches Paris, in dem nur ein Mensch Licht in die tödliche Affäre bringen kann.</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('16', '2', 'Mut Zur Wahrheit', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"Courage Under Fire\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> Lieutenant Colonel Nathaniel Serling (Denzel Washington) lässt während einer Schlacht im Golfkrieg versehentlich auf einen US-Panzer schießen, dessen Mannschaft dabei ums Leben kommt. Ein Jahr nach diesem Vorfall wird Serling, der mittlerweile nach Washington D.C. versetzt wurde, die Aufgabe übertragen, sich um einen Kandidaten zu kümmern, der während des Krieges starb und dem der höchste militärische Orden zuteil werden soll. Allerdings sind sowohl der Fall und als auch der betreffende Soldat ein politisch heißes Eisen -- Captain Karen Walden (Meg Ryan) ist Amerikas erster weiblicher Soldat, der im Kampf getötet wurde.<br /> <br /> Serling findet schnell heraus, dass es im Fall des im felsigen Gebiet von Kuwait abgestürzten Rettungshubschraubers Diskrepanzen gibt. In Flashbacks werden von unterschiedlichen Personen verschiedene Versionen von Waldens Taktik, die Soldaten zu retten und den Absturz zu überleben, dargestellt (à la Kurosawas Rashomon). Genau wie in Glory erweist sich Regisseur Edward Zwicks Zusammenstellung von bekannten und unbekannten Schauspielern als die richtige Mischung. Waldens Crew ist besonders überzeugend. Matt Damon als der Sanitäter kommt gut als der leichtfertige Typ rüber, als er Washington seine Geschichte erzählt. Im Kampf ist er ein mit Fehlern behafteter, humorvoller Soldat.<br /> <br /> Die erstaunlichste Arbeit in Mut zur Wahrheit leistet Lou Diamond Phillips (als der Schütze der Gruppe), dessen Karriere sich auf dem Weg in die direkt für den Videomarkt produzierten Filme befand. Und dann ist da noch Ryan. Sie hat sich in dramatischen Filmen in der Vergangenheit gut behauptet (Eine fast perfekte Liebe, Ein blutiges Erbe), es aber nie geschafft, ihrem Image zu entfliehen, das sie in die Ecke der romantischen Komödie steckte. Mit gefärbtem Haar, einem leichten Akzent und der von ihr geforderten Darstellungskunst hat sie endlich einen langlebigen dramatischen Film. Obwohl sie nur halb so oft wie Washington im Film zu sehen ist, macht ihre mutige und beeindruckend nachhaltige Darstellung Mut zur Wahrheit zu einem speziellen Film bis hin zu dessen seltsamer, aber lohnender letzter Szene.</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('17', '2', 'Speed', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"Speed\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> Er ist ein Cop aus der Anti-Terror-Einheit von Los Angeles. Und so ist der Alarm für Jack Traven nichts Ungewöhnliches: Ein Terrorist will drei Millionen Dollar erpressen, oder die zufälligen Geiseln in einem Aufzug fallen 35 Stockwerke in die Tiefe. Doch Jack schafft das Unmögliche - die Geiseln werden gerettet und der Terrorist stirbt an seiner eigenen Bombe. Scheinbar. Denn schon wenig später steht Jack (Keanu Reeves) dem Bombenexperten Payne erneut gegenüber. Diesmal hat sich der Erpresser eine ganz perfide Mordwaffe ausgedacht: Er plaziert eine Bombe in einem öffentlichen Bus. Der Mechanismus der Sprengladung schaltet sich automatisch ein, sobald der Bus schneller als 50 Meilen in der Stunde fährt und detoniert sofort, sobald die Geschwindigkeit sinkt. Plötzlich wird für eine Handvoll ahnungsloser Durchschnittsbürger der Weg zur Arbeit zum Höllentrip - und nur Jack hat ihr Leben in der Hand. Als der Busfahrer verletzt wird, übernimmt Fahrgast Annie (Sandra Bullock) das Steuer. Doch wohin mit einem Bus, der nicht bremsen kann in der Stadt der Staus? Doch es kommt noch schlimmer: Payne (Dennis Hopper) will jetzt nicht nur seine drei Millionen Dollar. Er will Jack. Um jeden Preis.</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('18', '2', 'Speed 2: Cruise Control', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"Speed 2 - Cruise Control\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> Halten Sie ihre Schwimmwesten bereit, denn die actiongeladene Fortsetzung von Speed begibt sich auf Hochseekurs. Erleben Sie Sandra Bullock erneut in ihrer Star-Rolle als Annie Porter. Die Karibik-Kreuzfahrt mit ihrem Freund Alex entwickelt sich unaufhaltsam zur rasenden Todesfahrt, als ein wahnsinniger Computer-Spezialist den Luxusliner in seine Gewalt bringt und auf einen mörderischen Zerstörungskurs programmiert. Eine hochexplosive Reise, bei der kein geringerer als Action-Spezialist Jan De Bont das Ruder in die Hand nimmt. Speed 2: Cruise Controll läßt ihre Adrenalin-Wellen in rasender Geschwindigkeit ganz nach oben schnellen.</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('19', '2', 'Verrückt nach Mary', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"There\'s Something About Mary\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> 13 Jahre nachdem Teds Rendezvous mit seiner angebeteten Mary in einem peinlichen Fiasko endete, träumt er immer noch von ihr und engagiert den windigen Privatdetektiv Healy um sie aufzuspüren. Der findet Mary in Florida und verliebt sich auf den ersten Blick in die atemberaubende Traumfrau. Um Ted als Nebenbuhler auszuschalten, tischt er ihm dicke Lügen über Mary auf. Ted läßt sich jedoch nicht abschrecken, eilt nach Miami und versucht nun alles, um Healy die Balztour zu vermasseln. Doch nicht nur Healy ist verrückt nach Mary und Ted bekommt es mit einer ganzen Legion liebeskranker Konkurrenten zu tun ...</p>', '', '8');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('20', '2', 'Menschenkind', 'Schachtel', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.', '', '<p>Originaltitel: \"Beloved\"<br /> <br /> Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Sprachen: English, Deutsch.<br /> Untertitel: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Bildformat: 16:9 Wide-Screen.<br /> Dauer: (approx) 96 minuten.<br /> Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br /> <br /> Dieser vielschichtige Film ist eine Arbeit, die Regisseur Jonathan Demme und dem amerikanischen Talkshow-Star Oprah Winfrey sehr am Herzen lag. Der Film deckt im Verlauf seiner dreistündigen Spielzeit viele Bereiche ab. Menschenkind ist teils Sklavenepos, teils Mutter-Tochter-Drama und teils Geistergeschichte.<br /> <br /> Der Film fordert vom Publikum höchste Aufmerksamkeit, angefangen bei seiner dramatischen und etwas verwirrenden Eingangssequenz, in der die Bewohner eines Hauses von einem niederträchtigen übersinnlichen Angriff heimgesucht werden. Aber Demme und seine talentierte Besetzung bereiten denen, die dabei bleiben ein unvergessliches Erlebnis. Der Film folgt den Spuren von Sethe (in ihren mittleren Jahren von Oprah Winfrey dargestellt), einer ehemaligen Sklavin, die sich scheinbar ein friedliches und produktives Leben in Ohio aufgebaut hat. Aber durch den erschreckenden und sparsamen Einsatz von Rückblenden deckt Demme, genau wie das literarische Meisterwerk von Toni Morrison, auf dem der Film basiert, langsam die Schrecken von Sethes früherem Leben auf und das schreckliche Ereignis, dass dazu führte, dass Sethes Haus von Geistern heimgesucht wird.<br /> <br /> Während die Gräuel der Sklaverei und das blutige Ereignis in Sethes Familie unleugbar tief beeindrucken, ist die Qualität des Film auch in kleineren, genauso befriedigenden Details sichtbar. Die geistlich beeinflusste Musik von Rachel Portman ist gleichzeitig befreiend und bedrückend, und der Einblick in die afro-amerikanische Gemeinschaft nach der Sklaverei -- am Beispiel eines Familienausflugs zu einem Jahrmarkt, oder dem gospelsingenden Nähkränzchen -- machen diesen Film zu einem speziellen Vergnügen sowohl für den Geist als auch für das Herz. Die Schauspieler, besonders Kimberley Elise als Sethes kämpfende Tochter und Thandie Newton als der mysteriöse Titelcharakter, sind sehr rührend. Achten Sie auch auf Danny Glover (Lethal Weapon) als Paul D.</p>', '', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('21', '2', 'SWAT 3: Elite Edition', 'Schachtel', 'Los Angeles, 2005. In wenigen Tagen steht die Unterzeichnung des Abkommens der Vereinten Nationen zur Atom-Ächtung durch Vertreter aller Nationen der Welt an. Radikale terroristische Vereinigungen machen sich in der ganzen Stadt breit. Verantwortlich für die Sicherheit der Delegierten zeichnet sich eine Eliteeinheit der LAPD: das SWAT-Team. Das Schicksal der Stadt liegt in Ihren Händen.', '', '<p><strong>KEINE KOMPROMISSE!</strong><br /> <em>Kämpfen Sie Seite an Seite mit Ihren LAPD SWAT-Kameraden gegen das organisierte Verbrechen!</em><br /> <br /> Eine der realistischsten 3D-Taktiksimulationen der letzten Zeit jetzt mit Multiplayer-Modus, 5 neuen Missionen und jede Menge nützliche Tools!<br /> <br /> Los Angeles, 2005. In wenigen Tagen steht die Unterzeichnung des Abkommens der Vereinten Nationen zur Atom-Ächtung durch Vertreter aller Nationen der Welt an. Radikale terroristische Vereinigungen machen sich in der ganzen Stadt breit. Verantwortlich für die Sicherheit der Delegierten zeichnet sich eine Eliteeinheit der LAPD: das SWAT-Team. Das Schicksal der Stadt liegt in Ihren Händen.<br /> <br /> <strong>Neue Features:</strong></p> <ul>  <li>Multiplayer-Modus (Co op-Modus, Deathmatch in den bekannten Variationen)</li>  <li>5 neue Missionen an original Örtlichkeiten Las (U-Bahn, Whitman Airport, etc.)</li>  <li>neue Charakter</li>  <li>neue Skins</li>  <li>neue Waffen</li>  <li>neue Sounds</li>  <li>verbesserte KI</li>  <li>Tools-Package</li>  <li>Scenario-Editor</li>  <li>Level-Editor</li> </ul> <p>Die dritte Folge der Bestseller-Reihe im Bereich der 3D-Echtzeit-Simulationen präsentiert sich mit einer neuen Spielengine mit extrem ausgeprägtem Realismusgrad. Der Spieler übernimmt das Kommando über eine der besten Polizei-Spezialeinheiten oder einer der übelsten Terroristen-Gangs der Welt. Er durchläuft - als \"Guter\" oder \"Böser\" - eine der härtesten und elitärsten Kampfausbildungen, in der er lernt, mit jeder Art von Krisensituationen umzugehen. Bei diesem Action-Abenteuer geht es um das Leben prominenter Vertreter der Vereinten Nationen und bei 16 Missionen an Originalschauplätzen in LA gibt die \"lebensechte\" KI den Protagonisten jeder Seite so einige harte Nüsse zu knacken.</p>', 'www.swat3.com', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('22', '2', 'Unreal Tournament', 'Schachtel / Runterladen', '<div id=\"result_box\" dir=\"ltr\">Von den&nbsp;Unreal Schöpfern, kommt Unreal Tournament. Eine neue Art von Single-Player-Erfahrung. Eine rücksichtslose Multiplayer-Revolution.</div>', '', '<p>2341: Die Gewalt ist eine Lebensweise, die sich ihren Weg durch die dunklen Risse der Gesellschaft bahnt. Sie bedroht die Macht und den Einfluss der regierenden Firmen, die schnellstens ein Mittel finden müssen, die tobenden Massen zu besänftigen - ein profitables Mittel ... Gladiatorenkämpfe sind die Lösung. Sie sollen den Durst der Menschen nach Blut stillen und sind die perfekte Gelegenheit, die Aufständischen, Kriminellen und Aliens zu beseitigen, die die Firmenelite bedrohen.<br /> <br /> Das Turnier war geboren - ein Kampf auf Leben und Tod. Galaxisweit live und in Farbe! Kämpfen Sie für Freiheit, Ruhm und Ehre. Sie müssen stark, schnell und geschickt sein ... oder Sie bleiben auf der Strecke.<br /> <br /> Kämpfen Sie allein oder kommandieren Sie ein Team gegen Armeen unbarmherziger Krieger, die alle nur ein Ziel vor Augen haben: Die Arenen lebend zu verlassen und sich dem Grand Champion zu stellen ... um ihn dann zu bezwingen!<br /> <br /> <strong>Features:</strong></p> <ul>  <li>Auf dem PC mehrfach als Spiel des Jahres ausgezeichnet!</li>  <li>Mehr als 50 faszinierende Level - verlassene Raumstationen, gotische Kathedralen und graffitibedeckte Großstädte.</li>  <li>Vier actionreiche Spielmodi - Deathmatch, Capture the Flag, Assault und Domination werden Ihren Adrenalinpegel in die Höhe schnellen lassen.</li>  <li>Dramatische Mehrspieler-Kämpfe mit 2, 3 und 4 Spielern, auch über das Netzwerk</li>  <li>Gnadenlos aggressive Computergegner verlangen Ihnen das Äußerste ab.</li>  <li>Neuartiges Benutzerinterface und verbesserte Steuerung - auch mit USB-Maus und -Tastatur spielbar.</li> </ul> <p>Der Nachfolger des Actionhits \"Unreal\" verspricht ein leichtes, intuitives Interface, um auch Einsteigern schnellen Zugang zu den Duellen gegen die Bots zu ermöglichen. Mit diesen KI-Kriegern kann man auch Teams bilden und im umfangreichen Multiplayermodus ohne Onlinekosten in den Kampf ziehen. 35 komplett neue Arenen und das erweiterte Waffenangebot bilden dazu den würdigen Rahmen.</p>', 'www.unrealtournament.net', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('23', '2', 'The Wheel Of Time', 'Schachtel', '<strong><em>\"Wheel Of Time\"(Das Rad der Zeit)</em></strong> basiert auf den Fantasy-Romanen von Kultautor Robert Jordan und stellt einen einzigartigen Mix aus Strategie-, Action- und Rollenspielelementen dar.', '', '<p><strong><em>\"Wheel Of Time\"(Das Rad der Zeit)</em></strong> basiert auf den Fantasy-Romanen von Kultautor Robert Jordan und stellt einen einzigartigen Mix aus Strategie-, Action- und Rollenspielelementen dar. Obwohl die Welt von \"Wheel of Time\" eng an die literarische Vorlage der Romane angelehnt ist, erzählt das Spiel keine lineare Geschichte. Die Story entwickelt sich abhängig von den Aktionen der Spieler, die jeweils die Rollen der Hauptcharaktere aus dem Roman übernehmen. Jede Figur hat den Oberbefehl über eine große Gefolgschaft, militärische Einheiten und Ländereien. Die Spieler können ihre eigenen Festungen konstruieren, individuell ausbauen, von dort aus das umliegende Land erforschen, magische Gegenstände sammeln oder die gegnerischen Zitadellen erstürmen. Selbstverständlich kann man sich auch über LAN oder Internet gegenseitig Truppen auf den Hals hetzen und die Festungen seiner Mitspieler in Schutt und Asche legen. Dreh- und Anlegepunkt von \"Wheel of Time\" ist der Kampf um die finstere Macht \"The Dark One\", die vor langer Zeit die Menschheit beinahe ins Verderben stürzte und nur mit Hilfe gewaltiger magischer Energie verbannt werden konnte. \"The Amyrlin Seat\" und \"The Children of the Night\" kämpfen nur gegen \"The Forsaken\" und \"The Hound\" um den Besitz des Schlüssels zu \"Shayol Ghul\" - dem magischen Siegel, mit dessen Hilfe \"The Dark One\" seinerzeit gebannt werden konnte.<br /> <br /> <strong>Features:</strong></p> <ul>  <li>Ego-Shooter mit Strategie-Elementen</li>  <li>Spielumgebung in Echtzeit-3D</li>  <li>Konstruktion aud Ausbau der eigenen Festung</li>  <li>Einsatz von über 100 Artefakten und Zaubersprüchen</li>  <li>Single- und Multiplayermodus</li> </ul> <p>Im Mittelpunkt steht der Kampf gegen eine finstere Macht namens The Dark One. Deren Schergen müssen mit dem Einsatz von über 100 Artefakten und Zaubereien wie Blitzschlag oder Teleportation aus dem Weg geräumt werden. Die opulente 3D-Grafik verbindet Strategie- und Rollenspielelemente. <strong>Voraussetzungen</strong> mind. P200, 32MB RAM, 4x CD-Rom, Win95/98, DirectX 5.0 komp.Grafikkarte und Soundkarte.</p>', 'www.wheeloftime.com', '12');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('24', '2', 'Disciples: Sacred Land', 'Schachtel', 'Rundenbasierende Fantasy/RTS-Strategie mit gutem Design (vor allem die Levels, 4 versch. Rassen, tolle Einheiten), fantastischer Atmosphäre und exzellentem Soundtrack. Grafisch leider auf das Niveau von 1990.', '', '<p>Rundenbasierende Fantasy/RTS-Strategie mit gutem Design (vor allem die Levels, 4 versch. Rassen, tolle Einheiten), fantastischer Atmosphäre und exzellentem Soundtrack. Grafisch leider auf das Niveau von 1990.</p>', 'www.strategyfirst.com/disciples/welcome.html', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('25', '2', 'Microsoft Internet Tastatur PS/2', 'Schachtel (Set)', '<em>Microsoft Internet Keyboard,Windows-Tastatur mit 10 zusätzl. Tasten,2 selbst programmierbar, abnehmbare Handgelenkauflage. Treiber im Lieferumfang.</em>', '', '<p><em>Microsoft Internet Keyboard,Windows-Tastatur mit 10 zusätzl. Tasten,2 selbst programmierbar, abnehmbareHandgelenkauflage. Treiber im Lieferumfang.</em><br /> <br /> Ein-Klick-Zugriff auf das Internet und vieles mehr! Das Internet Keyboard verfügt über 10 zusätzliche Abkürzungstasten auf einer benutzerfreundlichen Standardtastatur, die darüber hinaus eine abnehmbare Handballenauflage aufweist. Über die Abkürzungstasten können Sie durch das Internet surfen oder direkt von der Tastatur aus auf E-Mails zugreifen. Die IntelliType Pro-Software ermöglicht außerdem das individuelle Belegen der Tasten.</p>', '', '20');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('26', '2', 'Microsoft IntelliMouse Explorer', 'Schachtel', 'Die IntelliMouse Explorer überzeugt durch ihr modernes Design mit silberfarbenem Gehäuse, sowie rot schimmernder Unter- und Rückseite.', '', '<p>Die IntelliMouse Explorer überzeugt durch ihr modernes Design mit silberfarbenem Gehäuse, sowie rot schimmernder Unter- und Rückseite. Die neuartige IntelliEye-Technologie sorgt für eine noch nie dagewesene Präzision, da statt der beweglichen Teile (zum Abtasten der Bewegungsänderungen an der Unterseite der Maus) ein optischer Sensor die Bewegungen der Maus erfaßt. Das Herzstück der Microsoft IntelliEye-Technologie ist ein kleiner Chip, der einen optischen Sensor und einen digitalen Signalprozessor (DSP) enthält.<br /> <br /> Da auf bewegliche Teile, die Staub, Schmutz und Fett aufnehmen können, verzichtet wurde, muß die IntelliMouse Explorer nicht mehr gereinigt werden. Darüber hinaus arbeitet die IntelliMouse Explorer auf nahezu jeder Arbeitsoberfläche, so daß kein Mauspad mehr erforderlich ist. Mit dem Rad und zwei neuen zusätzlichen Maustasten ermöglicht sie effizientes und komfortables Arbeiten am PC.<br /> <br /> <strong>Eigenschaften:</strong></p> <ul>  <li><strong>ANSCHLUSS:</strong> USB (PS/2-Adapter enthalten)</li>  <li><strong>FARBE:</strong> metallic-grau</li>  <li><strong>TECHNIK:</strong> Optisch (Akt.: ca. 1500 Bilder/s)</li>  <li><strong>TASTEN:</strong> 5 (incl. Scrollrad)</li>  <li><strong>SCROLLRAD:</strong> Ja</li> </ul> <p><em><strong>BEMERKUNG:</strong><br /> Keine Reinigung bewegter Teile mehr notwendig, da statt der Mauskugel ein Fotoempfänger benutzt wird.</em></p>', '', '66');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('27', '2', 'Hewlett-Packard LaserJet 1100Xi', 'Set', 'Der HP LaserJet 1100Xi Drucker verbindet exzellente Laserdruckqualität mit hoher Geschwindigkeit für mehr Effizienz.', '', '<p><strong>HP LaserJet für mehr Produktivität und Flexibilität am Arbeitsplatz</strong><br /> <br /> Der HP LaserJet 1100Xi Drucker verbindet exzellente Laserdruckqualität mit hoher Geschwindigkeit für mehr Effizienz.<br /> <br /> <strong>Zielkunden</strong></p> <ul>  <li>Einzelanwender, die Wert auf professionelle Ausdrucke in Laserqualität legen und schnelle Ergebnisse auch bei komplexen Dokumenten erwarten.</li>  <li>Der HP LaserJet 1100 sorgt mit gestochen scharfen Texten und Grafiken für ein professionelles Erscheinungsbild Ihrer Arbeit und Ihres Unternehmens. Selbst bei komplexen Dokumenten liefert er schnelle Ergebnisse. Andere Medien - wie z.B. Transparentfolien und Briefumschläge, etc. - lassen sich problemlos bedrucken. Somit ist der HP LaserJet 1100 ein Multifunktionstalent im Büroalltag.</li> </ul> <p><strong>Eigenschaften</strong></p> <ul>  <li><strong>Druckqualität</strong> Schwarzweiß: 600 x 600 dpi</li>  <li><strong>Monatliche Druckleistung</strong> Bis zu 7000 Seiten</li>  <li><strong>Speicher</strong> 2 MB Standardspeicher, erweiterbar auf 18 MB</li>  <li><strong>Schnittstelle/gemeinsame Nutzung</strong> Parallel, IEEE 1284-kompatibel</li>  <li><strong>Softwarekompatibilität</strong> DOS/Win 3.1x/9x/NT 4.0</li>  <li><strong>Papierzuführung</strong> 125-Blatt-Papierzuführung</li>  <li><strong>Druckmedien</strong> Normalpapier, Briefumschläge, Transparentfolien, kartoniertes Papier, Postkarten und Etiketten</li>  <li><strong>Netzwerkfähig</strong> Über HP JetDirect PrintServer</li>  <li><strong>Lieferumfang</strong> HP LaserJet 1100Xi Drucker (Lieferumfang: Drucker, Tonerkassette, 2 m Parallelkabel, Netzkabel, Kurzbedienungsanleitung, Benutzerhandbuch, CD-ROM, 3,5\"-Disketten mit Windows&reg; 3.1x, 9x, NT 4.0 Treibern und DOS-Dienstprogrammen)</li>  <li><strong>Gewährleistung</strong> Ein Jahr</li> </ul>', 'www.hp.com', '4');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('1', '3', 'Matrox G200 MMS', 'Box', 'Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8\" PCI board.', '', '<p>Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8\" PCI board.<br /> <br /> With continuing demand for digital flat panels in the financial workplace, the Matrox G200 MMS is the ultimate in flexible solutions. The Matrox G200 MMS also supports the new digital video interface (DVI) created by the Digital Display Working Group (DDWG) designed to ease the adoption of digital flat panels. Other configurations include composite video capture ability and onboard TV tuner, making the Matrox G200 MMS the complete solution for business needs.<br /> <br /> Based on the award-winning MGA-G200 graphics chip, the Matrox G200 Multi-Monitor Series provides superior 2D/3D graphics acceleration to meet the demanding needs of business applications such as real-time stock quotes (Versus), live video feeds (Reuters &amp; Bloombergs), multiple windows applications, word processing, spreadsheets and CAD.</p>', 'www.matrox.com/mga/products/g200_mms/home.cfm', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('2', '3', 'Matrox G400 32MB', 'Box', '<ul>  <li>New Matrox G400 256-bit DualBus graphics chip</li>  <li>Explosive 3D, 2D and DVD performance</li>  <li>DualHead Display</li>  <li>Superior DVD and TV output</li>  <li>3D Environment-Mapped Bump Mapping</li>  <li>Vibrant Color Quality rendering</li> </ul>', '', '<p><strong>Dramatically Different High Performance Graphics</strong><br /> <br /> Introducing the Millennium G400 Series - a dramatically different, high performance graphics experience. Armed with the industry\'s fastest graphics chip, the Millennium G400 Series takes explosive acceleration two steps further by adding unprecedented image quality, along with the most versatile display options for all your 3D, 2D and DVD applications. As the most powerful and innovative tools in your PC\'s arsenal, the Millennium G400 Series will not only change the way you see graphics, but will revolutionize the way you use your computer.<br /> <br /> <strong>Key features:</strong></p> <ul>  <li>New Matrox G400 256-bit DualBus graphics chip</li>  <li>Explosive 3D, 2D and DVD performance</li>  <li>DualHead Display</li>  <li>Superior DVD and TV output</li>  <li>3D Environment-Mapped Bump Mapping</li>  <li>Vibrant Color Quality rendering</li>  <li>UltraSharp DAC of up to 360 MHz</li>  <li>3D Rendering Array Processor</li>  <li>Support for 16 or 32 MB of memory</li> </ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', '0');
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('3', '3', 'Microsoft IntelliMouse Pro', 'Setbox', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research.', '', '<p>Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft\'s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.</p>', 'www.microsoft.com/hardware/mouse/intellimouse.asp', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('4', '3', 'The Replacement Killers', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Picture Format: 16:9 Wide-Screen.<br /> Length: (approx) 80 minutes.<br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', 'www.replacement-killers.com', '2'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('5', '3', 'Blade Runner - Director\'s Cut', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Picture Format: 16:9 Wide-Screen.<br /> Length: (approx) 112 minutes.<br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', 'www.bladerunner.com', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('6', '3', 'The Matrix', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch. <br /> Audio: Dolby Surround. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 131 minutes. <br /> Other: Interactive Menus, Chapter Selection, Making Of.</p>', 'www.thematrix.com', '1'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('7', '3', 'You\'ve Got Mail', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch, Spanish. <br /> Subtitles: English, Deutsch, Spanish, French, Nordic, Polish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch, Spanish. <br /> Subtitles: English, Deutsch, Spanish, French, Nordic, Polish. <br /> Audio: Dolby Digital 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 115 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', 'www.youvegotmail.com', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('8', '3', 'A Bug\'s Life', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', 'Descripción del producto, Argumento', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Digital 5.1 / Dobly Surround Stereo. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 91 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p> <div style=\"page-break-after: always;\"> 	<span style=\"display: none;\">&nbsp;</span></div> <p> 	Flik es un individualista y aspirante a inventor en una colonia de hormigas que viven en una pequeña isla en medio de un arroyo. Flik es diferente y siempre causa problemas por sus invenciones. La colonia está constantemente oprimida por una banda de saltamontes merodeadores que llegan cada temporada exigiendo comida de las hormigas. Sin embargo, cuando las hormigas estaban preparando una ofrenda de comida, esta es golpeada accidentalmente por el último invento de Flik, ​​un dispositivo de cosechadora. El líder de los saltamontes, Hopper, tras conocer el hecho reclama doble ración de comida para la próxima temporada. Las hormigas están dispuestas a castigar a Flik por el accidente, pero este piensa que había que pedir ayuda a otros insectos en la \"gran ciudad\". Las hormigas ven esto como una buena opción para deshacerse de Flik mientras pagan la deuda de los saltamontes, por lo que le permiten ir.<br /> 	Flik encuentra su camino a la \"gran ciudad\" (un vertedero de basura), donde se confunde viendo a un grupo de insectos de circo. Flik piensa que eran los insectos guerreros que buscaba, y los insectos creen que es un cazatalentos y acceden ir con él a la isla.<br /> 	Los insectos se ganan el respeto de las hormigas después de salvar a la hija de la reina de ser devorada por un pájaro. El ataque del pájaro inspira a Flik a hacer un plan para construir un pájaro falso para asustar a Hopper, que tiene un profundo temor a las aves. Finalmente, el maestro de ceremonias del circo, Pete, llega en busca de los insectos de circo cuando estaban diseñando el pájaro. Las hormigas se enfurecen por el engaño de Flik y le expulsan de la isla con los insectos.<br /> 	Las hormigas tratan desesperadamente de reunir suficiente alimento para la demanda de Hopper, pero son incapaces de hacerlo. Hopper llega y encuentran que las hormigas no habían reunido suficiente comida, por lo que decide matar a la reina. Cuando lo iba a hacer, la hija pequeña de la reina, Dot, sale en busca de Flik y le convence para volver y hacer un plan para salvar a la reina. Flik y los insectos cogen el pájaro falso y se lo echan a Hopper. El plan casi funciona, pero Pete cree que es un pájaro de verdad y le prende fuego. El pájaro se destruye y Flik es descubierto. Hopper le ordena a uno de sus saltamontes que ataque a Flik, ​​luego Hopper se lo lleva para matarle. Antes de que pueda hacerlo, la princesa Atta interviene y defiende a Flik, ​​provocando que el resto de la colonia haga frente a los saltamontes y luchen contra ellos. En medio del caos, Hopper persigue a Flik, ​​que le lleva a un nido de pájaro real. El pájaro aparece y Hopper cree que es de mentira, pero era el verdadero. Hopper es comido por el pájaro y sus polluelos.<br /> 	Al día siguiente, a Flik se le da la bienvenida de nuevo a la colonia, y los bichos de circo se unen a la celebración. Ahora todo el mundo respeta Flik y lo trata bien. Cuando los bichos de circo se marchaban, la reina le da a la princesa Atta su corona y esta se convierte en reina de la colonia.</p>', 'www.abugslife.com', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('9', '3', 'Under Siege', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 98 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('10', '3', 'Under Siege 2 - Dark Territory', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Picture Format: 16:9 Wide-Screen.<br /> Length: (approx) 98 minutes.<br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('11', '3', 'Fire Down Below', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 100 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('12', '3', 'Die Hard With A Vengeance', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 122 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('13', '3', 'Lethal Weapon', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 100 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('14', '3', 'Red Corner', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 117 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('15', '3', 'Frantic', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 115 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('16', '3', 'Courage Under Fire', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 112 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('17', '3', 'Speed', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 112 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('18', '3', 'Speed 2: Cruise Control', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 120 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('19', '3', 'There\'s Something About Mary', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br /> Languages: English, Deutsch.<br /> Subtitles: English, Deutsch, Spanish.<br /> Audio: Dolby Surround 5.1.<br /> Picture Format: 16:9 Wide-Screen.<br /> Length: (approx) 114 minutes.<br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('20', '3', 'Beloved', 'Box', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish.', '', '<p>Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br /> Languages: English, Deutsch. <br /> Subtitles: English, Deutsch, Spanish. <br /> Audio: Dolby Surround 5.1. <br /> Picture Format: 16:9 Wide-Screen. <br /> Length: (approx) 164 minutes. <br /> Other: Interactive Menus, Chapter Selection, Subtitles (more languages).</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('21', '3', 'SWAT 3: Close Quarters Battle', 'Box', 'Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and \"When needed\" to use deadly force to keep the peace.', '', '<p><strong>Windows 95/98</strong><br /> <br /> 211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and \"When needed\" to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!</p>', 'www.swat3.com', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('22', '3', 'Unreal Tournament', 'Box / Download', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.', '', '<p>From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br /> <br /> This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It\'s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of \'bots\' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.</p>', 'www.unrealtournament.net', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('23', '3', 'The Wheel Of Time', 'Box', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan\'s pages; it\'s huge and consists of many different environments.', '', '<p>The world in which The Wheel of Time takes place is lifted directly out of Jordan\'s pages; it\'s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you\'re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter\'angreal, Portal Stones, and the Ways. However you move around, though, you\'ll quickly discover that means of locomotion can easily become the least of the your worries...<br /> <br /> During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time\'s main characters. Some of these places are ripped directly from the pages of Jordan\'s books, made flesh with Legend\'s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you\'ll have this year.</p>', 'www.wheeloftime.com', '2'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('24', '3', 'Disciples: Sacred Lands', 'Box', 'Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars.', '', '<p>A new age is dawning...<br /> <br /> Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br /> <br /> The day of reckoning has come... and only the chosen will survive.</p>', '', '0'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('25', '3', 'Microsoft Internet Keyboard PS/2', 'Setbox', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest.', '', '<p>The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!</p>', '', '2'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('26', '3', 'Microsoft IntelliMouse Explorer', 'Box', 'IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse.', '', '<p>Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!</p>', 'www.microsoft.com/hardware/mouse/explorer.asp', '14'); 
insert into products_description (products_id, language_id, products_name, products_p_unit, products_info, products_description_tab_label, products_description, products_url, products_viewed) values ('27', '3', 'Hewlett Packard LaserJet 1100Xi', 'Set', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed.', '', '<p>HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP\'s Resolution Enhancement technology (REt) makes every document more professional.<br /> <br /> Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br /> <br /> HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).</p>', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', '0');

drop table if exists products_notifications;
create table products_notifications (
  products_id int(11) default '0' not null ,
  customers_id int(11) default '0' not null ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (products_id, customers_id)
);

insert into products_notifications (products_id, customers_id, date_added) values ('10', '1', date_sub(now(),interval 2 day));
insert into products_notifications (products_id, customers_id, date_added) values ('26', '1', date_sub(now(),interval 1 day));

drop table if exists products_options;
create table products_options (
  products_options_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_name varchar(32) not null ,
  PRIMARY KEY (products_options_id, language_id)
);

insert into products_options (products_options_id, language_id, products_options_name) values ('1', '1', 'Color');
insert into products_options (products_options_id, language_id, products_options_name) values ('2', '1', 'Size');
insert into products_options (products_options_id, language_id, products_options_name) values ('3', '1', 'Model');
insert into products_options (products_options_id, language_id, products_options_name) values ('4', '1', 'Memory');
insert into products_options (products_options_id, language_id, products_options_name) values ('1', '2', 'Farbe');
insert into products_options (products_options_id, language_id, products_options_name) values ('2', '2', 'Größe');
insert into products_options (products_options_id, language_id, products_options_name) values ('3', '2', 'Modell');
insert into products_options (products_options_id, language_id, products_options_name) values ('4', '2', 'Speicher');
insert into products_options (products_options_id, language_id, products_options_name) values ('1', '3', 'Color');
insert into products_options (products_options_id, language_id, products_options_name) values ('2', '3', 'Talla');
insert into products_options (products_options_id, language_id, products_options_name) values ('3', '3', 'Modelo');
insert into products_options (products_options_id, language_id, products_options_name) values ('4', '3', 'Memoria');
insert into products_options (products_options_id, language_id, products_options_name) values ('5', '3', 'Version');
insert into products_options (products_options_id, language_id, products_options_name) values ('5', '2', 'Version');
insert into products_options (products_options_id, language_id, products_options_name) values ('5', '1', 'Version');

drop table if exists products_options_values;
create table products_options_values (
  products_options_values_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_values_name varchar(64) not null ,
  PRIMARY KEY (products_options_values_id, language_id)
);

insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('1', '1', '4 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('2', '1', '8 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('3', '1', '16 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('4', '1', '32 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('5', '1', 'Value');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('6', '1', 'Premium');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('7', '1', 'Deluxe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('8', '1', 'PS/2');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('9', '1', 'USB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('1', '2', '4 MB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('2', '2', '8 MB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('3', '2', '16 MB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('4', '2', '32 MB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('5', '2', 'Value Ausgabe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('6', '2', 'Premium Ausgabe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('7', '2', 'Deluxe Ausgabe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('8', '2', 'PS/2 Anschluss');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('9', '2', 'USB Anschluss');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('1', '3', '4 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('2', '3', '8 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('3', '3', '16 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('4', '3', '32 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('5', '3', 'Value');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('6', '3', 'Premium');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('7', '3', 'Deluxe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('8', '3', 'PS/2');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('9', '3', 'USB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('10', '1', 'Download: Windows - English');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('10', '2', 'Download: Windows - Englisch');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('10', '3', 'Download: Windows - Inglese');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('13', '1', 'Box: Windows - English');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('13', '2', 'Box: Windows - Englisch');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('13', '3', 'Box: Windows - Inglese');

drop table if exists products_options_values_to_products_options;
create table products_options_values_to_products_options (
  products_options_id int(11) default '0' not null ,
  products_options_values_id int(11) default '0' not null ,
  PRIMARY KEY (products_options_id,products_options_values_id)
);

insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('4', '1');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('4', '2');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('4', '3');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('4', '4');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('3', '5');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('3', '6');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('3', '7');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('3', '8');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('3', '9');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('5', '10');
insert into products_options_values_to_products_options (products_options_id, products_options_values_id) values ('5', '13');

drop table if exists products_prices;
create table products_prices (
  customers_group_id smallint(5) default '0' not null ,
  customers_group_price decimal(15,4) default '0.0000' not null ,
  products_id int(11) default '0' not null ,
  PRIMARY KEY (customers_group_id, products_id)
);

insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '299.2565', '1');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '499.9071', '2');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '50.0929', '3');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '42.0074', '4');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '36.0130', '5');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '39.9628', '6');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '34.9442', '7');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '35.9665', '8');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '30.0186', '9');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '29.7398', '10');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '29.9721', '11');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '40.0093', '12');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '34.9442', '13');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '31.9703', '14');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '34.3866', '15');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '38.9870', '16');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '39.9628', '17');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '42.3327', '18');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '49.2565', '19');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '54.9721', '20');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '80.0186', '21');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '89.9628', '22');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '99.9535', '23');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '90.0093', '24');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '69.9814', '25');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '64.1264', '26');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('0', '499.0234', '27');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '64.1264', '26');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '49.2565', '3');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '29.7398', '10');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '34.9442', '7');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '39.9628', '6');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '99.9535', '23');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '49.2565', '19');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '30.0186', '9');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '36.0130', '5');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '35.9665', '8');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '42.0074', '4');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '90.0093', '24');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '29.9721', '11');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '34.3866', '15');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '499.0234', '27');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '31.9703', '14');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '299.2565', '1');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '499.9071', '2');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '54.9721', '20');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '69.9814', '25');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '38.9870', '16');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '39.9628', '17');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '42.3327', '18');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '40.0093', '12');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '80.0186', '21');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '89.9628', '22');
insert into products_prices (customers_group_id, customers_group_price, products_id) values ('1', '34.9442', '13');

drop table if exists products_to_categories;
create table products_to_categories (
  products_id int(11) default '0' not null ,
  categories_or_pages_id int(11) default '0' not null ,
  PRIMARY KEY (products_id, categories_or_pages_id)
);

insert into products_to_categories (products_id, categories_or_pages_id) values ('1', '4');
insert into products_to_categories (products_id, categories_or_pages_id) values ('2', '4');
insert into products_to_categories (products_id, categories_or_pages_id) values ('3', '9');
insert into products_to_categories (products_id, categories_or_pages_id) values ('4', '10');
insert into products_to_categories (products_id, categories_or_pages_id) values ('5', '11');
insert into products_to_categories (products_id, categories_or_pages_id) values ('6', '10');
insert into products_to_categories (products_id, categories_or_pages_id) values ('7', '12');
insert into products_to_categories (products_id, categories_or_pages_id) values ('8', '13');
insert into products_to_categories (products_id, categories_or_pages_id) values ('9', '10');
insert into products_to_categories (products_id, categories_or_pages_id) values ('10', '10');
insert into products_to_categories (products_id, categories_or_pages_id) values ('11', '10');
insert into products_to_categories (products_id, categories_or_pages_id) values ('12', '10');
insert into products_to_categories (products_id, categories_or_pages_id) values ('13', '10');
insert into products_to_categories (products_id, categories_or_pages_id) values ('14', '15');
insert into products_to_categories (products_id, categories_or_pages_id) values ('15', '14');
insert into products_to_categories (products_id, categories_or_pages_id) values ('16', '15');
insert into products_to_categories (products_id, categories_or_pages_id) values ('17', '10');
insert into products_to_categories (products_id, categories_or_pages_id) values ('18', '10');
insert into products_to_categories (products_id, categories_or_pages_id) values ('19', '12');
insert into products_to_categories (products_id, categories_or_pages_id) values ('20', '15');
insert into products_to_categories (products_id, categories_or_pages_id) values ('21', '18');
insert into products_to_categories (products_id, categories_or_pages_id) values ('22', '19');
insert into products_to_categories (products_id, categories_or_pages_id) values ('23', '20');
insert into products_to_categories (products_id, categories_or_pages_id) values ('24', '20');
insert into products_to_categories (products_id, categories_or_pages_id) values ('25', '8');
insert into products_to_categories (products_id, categories_or_pages_id) values ('26', '9');
insert into products_to_categories (products_id, categories_or_pages_id) values ('27', '5');

drop table if exists products_xsell;
create table products_xsell (
  ID int(10) not null auto_increment,
  products_id int(10) default '1' not null ,
  xsell_id int(10) default '1' not null ,
  sort_order int(10) default '1' not null ,
  PRIMARY KEY (ID),
  KEY IDX_PRODUCTS_ID (products_id)
);

insert into products_xsell (ID, products_id, xsell_id, sort_order) values ('1', '25', '26', '2');
insert into products_xsell (ID, products_id, xsell_id, sort_order) values ('2', '25', '3', '1');

drop table if exists reviews;
create table reviews (
  reviews_id int(11) not null auto_increment,
  products_id int(11) default '0' not null ,
  customers_id int(11) ,
  customers_name varchar(255) not null ,
  reviews_rating int(1) ,
  date_added datetime ,
  last_modified datetime ,
  reviews_read int(5) default '0' not null ,
  PRIMARY KEY (reviews_id)
);

insert into reviews (reviews_id, products_id, customers_id, customers_name, reviews_rating, date_added, last_modified, reviews_read) values ('2', '19', '1', 'Erika Mustermann', '5', date_sub(now(),interval 1 day), now(), '0');
insert into reviews (reviews_id, products_id, customers_id, customers_name, reviews_rating, date_added, last_modified, reviews_read) values ('3', '19', '1', 'Erika Mustermann', '5', date_sub(now(),interval 5 day), NULL, '0');
insert into reviews (reviews_id, products_id, customers_id, customers_name, reviews_rating, date_added, last_modified, reviews_read) values ('4', '19', '1', 'Erika Mustermann', '5', date_sub(now(),interval 2 day), NULL, '13');

drop table if exists reviews_description;
create table reviews_description (
  reviews_id int(11) default '0' not null ,
  languages_id int(11) default '0' not null ,
  reviews_text text not null ,
  PRIMARY KEY (reviews_id, languages_id)
);

insert into reviews_description (reviews_id, languages_id, reviews_text) values ('2', '1', 'this has to be one of the funniest movies released for 1999!');
insert into reviews_description (reviews_id, languages_id, reviews_text) values ('3', '3', 'this has to be one of the funniest movies released for 1999!');
insert into reviews_description (reviews_id, languages_id, reviews_text) values ('4', '2', 'Einer der lustigsten Filme der 1999 erschienen ist!');

drop table if exists sessions;
create table sessions (
  sesskey varchar(32) not null ,
  expiry int(11) unsigned default '0' not null ,
  value text not null ,
  PRIMARY KEY (sesskey)
);

drop table if exists specials;
create table specials (
  specials_id int(11) not null auto_increment,
  products_id int(11) default '0' not null ,
  customers_group_id smallint(5) default '0' not null ,
  specials_new_products_price decimal(15,4) default '0.0000' not null ,
  expires_date datetime ,
  status int(1) default '1' not null ,
  error int(1) default '0' not null ,
  PRIMARY KEY (specials_id),
  KEY IDX_PRODUCTS_ID (products_id)
);

insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('1', '26', '0', '61.8030', NULL, '1', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('2', '23', '0', '92.8903', NULL, '1', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('3', '10', '0', '25.8364', NULL, '1', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('4', '6', '0', '35.3160', NULL, '0', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('5', '7', '0', '31.5520', NULL, '1', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('6', '19', '0', '46.3755', NULL, '1', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('7', '26', '1', '61.8030', NULL, '1', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('8', '10', '1', '25.8364', NULL, '1', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('9', '7', '1', '31.5520', NULL, '1', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('10', '6', '1', '35.3160', NULL, '0', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('11', '23', '1', '92.8903', NULL, '1', '0');
insert into specials (specials_id, products_id, customers_group_id, specials_new_products_price, expires_date, status, error) values ('12', '19', '1', '46.3755', NULL, '1', '0');

drop table if exists tax_class;
create table tax_class (
  tax_class_id int(11) not null auto_increment,
  tax_class_title varchar(32) not null ,
  tax_class_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (tax_class_id)
);

insert into tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) values ('1', 'MwSt. normal', 'Mehrwertsteuer normaler Satz', now(), date_sub(now(),interval 2 day));
insert into tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) values ('2', 'MwSt. reduziert', 'Mehrwertsteuer reduzierter Satz', NULL, date_sub(now(),interval 2 day));

drop table if exists tax_rates;
create table tax_rates (
  tax_rates_id int(11) not null auto_increment,
  tax_zone_id int(11) default '0' not null ,
  tax_class_id int(11) default '0' not null ,
  tax_priority int(5) default '1' ,
  tax_rate decimal(7,4) default '0.0000' not null ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (tax_rates_id)
);

insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, last_modified, date_added) values ('1', '1', '1', '1', '19.0000', now(), date_sub(now(),interval 2 day));
insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, last_modified, date_added) values ('2', '2', '1', '1', '7.6000', NULL, date_sub(now(),interval 2 day));
insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, last_modified, date_added) values ('3', '3', '1', '1', '20.0000', NULL, date_sub(now(),interval 2 day));
insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, last_modified, date_added) values ('4', '2', '2', '1', '2.4000', NULL, date_sub(now(),interval 2 day));
insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, last_modified, date_added) values ('5', '3', '2', '1', '10.0000', NULL, date_sub(now(),interval 2 day));
insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, last_modified, date_added) values ('6', '1', '2', '1', '7.0000', NULL, date_sub(now(),interval 2 day));

drop table if exists tax_rates_description;
create table tax_rates_description (
  tax_rates_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  tax_description varchar(255) not null ,
  PRIMARY KEY (tax_rates_id, language_id)
);

insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('1', '1', 'VAT(DE)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('1', '2', 'MwSt.(DE)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('1', '3', 'IVA(DE)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('2', '1', 'VAT(CH)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('2', '2', 'MwSt.(CH)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('2', '3', 'IVA(CH)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('3', '1', 'VAT(AT)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('3', '2', 'MwSt.(AT)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('3', '3', 'IVA(AT)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('4', '1', 'VAT(reduced)(CH)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('4', '2', 'MwSt.(reduziert)(CH)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('4', '3', 'IVA(reducido)(CH)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('5', '1', 'VAT(reduced)(AT)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('5', '2', 'MwSt.(reduziert)(AT)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('5', '3', 'IVA(reducido)(AT)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('6', '1', 'VAT(reduced)(DE)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('6', '2', 'MwSt.(reduziert)(DE)');
insert into tax_rates_description (tax_rates_id, language_id, tax_description) values ('6', '3', 'IVA(reducido)(DE)');

drop table if exists tax_rates_final;
create table tax_rates_final (
  tax_rates_final_id int(11) not null auto_increment,
  tax_zone_id int(11) default '0' not null ,
  tax_class_id int(11) default '0' not null ,
  tax_rate_final decimal(7,4) default '0.0000' not null ,
  PRIMARY KEY (tax_rates_final_id),
  KEY IDX_TAX_ZONE_ID (tax_zone_id),
  KEY IDX_TAX_CLASS_ID (tax_class_id)  
);

insert into tax_rates_final (tax_rates_final_id, tax_zone_id, tax_class_id, tax_rate_final) values ('1', '1', '1', '19.0000');
insert into tax_rates_final (tax_rates_final_id, tax_zone_id, tax_class_id, tax_rate_final) values ('2', '2', '1', '7.6000');
insert into tax_rates_final (tax_rates_final_id, tax_zone_id, tax_class_id, tax_rate_final) values ('3', '3', '1', '20.0000');
insert into tax_rates_final (tax_rates_final_id, tax_zone_id, tax_class_id, tax_rate_final) values ('4', '1', '2', '7.0000');
insert into tax_rates_final (tax_rates_final_id, tax_zone_id, tax_class_id, tax_rate_final) values ('5', '2', '2', '2.4000');
insert into tax_rates_final (tax_rates_final_id, tax_zone_id, tax_class_id, tax_rate_final) values ('6', '3', '2', '10.0000');

drop table if exists whos_online;
create table whos_online (
  customer_id int(11) ,
  full_name varchar(255) not null ,
  session_id varchar(128) not null ,
  ip_address varchar(15) not null ,
  time_entry varchar(14) not null ,
  time_last_click varchar(14) not null ,
  last_page_url text not null 
);

drop table if exists zones;
create table zones (
  zone_id int(11) not null auto_increment,
  zone_country_id int(11) default '0' not null ,
  zone_code varchar(32) not null ,
  zone_name varchar(255) not null ,
  PRIMARY KEY (zone_id)
);

insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('79', '81', 'NDS', 'Niedersachsen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('80', '81', 'BAW', 'Baden-Württemberg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('81', '81', 'BAY', 'Bayern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('82', '81', 'BER', 'Berlin');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('83', '81', 'BRG', 'Brandenburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('84', '81', 'BRE', 'Bremen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('85', '81', 'HAM', 'Hamburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('86', '81', 'HES', 'Hessen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('87', '81', 'MEC', 'Mecklenburg-Vorpommern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('88', '81', 'NRW', 'Nordrhein-Westfalen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('89', '81', 'RHE', 'Rheinland-Pfalz');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('90', '81', 'SAR', 'Saarland');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('91', '81', 'SAS', 'Sachsen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('92', '81', 'SAC', 'Sachsen-Anhalt');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('93', '81', 'SCN', 'Schleswig-Holstein');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('94', '81', 'THE', 'Thüringen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('95', '14', 'WI', 'Wien');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('96', '14', 'NO', 'Niederösterreich');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('97', '14', 'OO', 'Oberösterreich');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('98', '14', 'SB', 'Salzburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('99', '14', 'KN', 'Kärnten');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('100', '14', 'ST', 'Steiermark');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('101', '14', 'TI', 'Tirol');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('102', '14', 'BL', 'Burgenland');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('103', '14', 'VB', 'Voralberg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('104', '204', 'AG', 'Aargau');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('105', '204', 'AI', 'Appenzell Innerrhoden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('106', '204', 'AR', 'Appenzell Ausserrhoden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('107', '204', 'BE', 'Bern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('108', '204', 'BL', 'Basel-Landschaft');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('109', '204', 'BS', 'Basel-Stadt');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('110', '204', 'FR', 'Freiburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('111', '204', 'GE', 'Genf');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('112', '204', 'GL', 'Glarus');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('113', '204', 'GR', 'Graubünden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('114', '204', 'JU', 'Jura');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('115', '204', 'LU', 'Luzern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('116', '204', 'NE', 'Neuenburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('117', '204', 'NW', 'Nidwalden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('118', '204', 'OW', 'Obwalden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('119', '204', 'SG', 'St. Gallen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('120', '204', 'SH', 'Schaffhausen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('121', '204', 'SO', 'Solothurn');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('122', '204', 'SZ', 'Schwyz');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('123', '204', 'TG', 'Thurgau');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('124', '204', 'TI', 'Tessin');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('125', '204', 'UR', 'Uri');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('126', '204', 'VD', 'Waadt');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('127', '204', 'VS', 'Wallis');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('128', '204', 'ZG', 'Zug');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('129', '204', 'ZH', 'Zürich');

drop table if exists zones_list;
create table zones_list (
  zone_id int(11) not null auto_increment,
  zone_country_id int(11) default '0' not null ,
  zone_code varchar(32) not null ,
  zone_name varchar(255) not null ,
  PRIMARY KEY (zone_id)
);

insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('1', '223', 'AL', 'Alabama');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('2', '223', 'AK', 'Alaska');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('3', '223', 'AS', 'American Samoa');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('4', '223', 'AZ', 'Arizona');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('5', '223', 'AR', 'Arkansas');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('6', '223', 'AF', 'Armed Forces Africa');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('7', '223', 'AA', 'Armed Forces Americas');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('8', '223', 'AC', 'Armed Forces Canada');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('9', '223', 'AE', 'Armed Forces Europe');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('10', '223', 'AM', 'Armed Forces Middle East');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('11', '223', 'AP', 'Armed Forces Pacific');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('12', '223', 'CA', 'California');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('13', '223', 'CO', 'Colorado');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('14', '223', 'CT', 'Connecticut');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('15', '223', 'DE', 'Delaware');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('16', '223', 'DC', 'District of Columbia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('17', '223', 'FM', 'Federated States Of Micronesia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('18', '223', 'FL', 'Florida');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('19', '223', 'GA', 'Georgia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('20', '223', 'GU', 'Guam');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('21', '223', 'HI', 'Hawaii');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('22', '223', 'ID', 'Idaho');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('23', '223', 'IL', 'Illinois');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('24', '223', 'IN', 'Indiana');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('25', '223', 'IA', 'Iowa');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('26', '223', 'KS', 'Kansas');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('27', '223', 'KY', 'Kentucky');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('28', '223', 'LA', 'Louisiana');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('29', '223', 'ME', 'Maine');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('30', '223', 'MH', 'Marshall Islands');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('31', '223', 'MD', 'Maryland');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('32', '223', 'MA', 'Massachusetts');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('33', '223', 'MI', 'Michigan');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('34', '223', 'MN', 'Minnesota');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('35', '223', 'MS', 'Mississippi');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('36', '223', 'MO', 'Missouri');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('37', '223', 'MT', 'Montana');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('38', '223', 'NE', 'Nebraska');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('39', '223', 'NV', 'Nevada');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('40', '223', 'NH', 'New Hampshire');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('41', '223', 'NJ', 'New Jersey');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('42', '223', 'NM', 'New Mexico');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('43', '223', 'NY', 'New York');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('44', '223', 'NC', 'North Carolina');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('45', '223', 'ND', 'North Dakota');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('46', '223', 'MP', 'Northern Mariana Islands');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('47', '223', 'OH', 'Ohio');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('48', '223', 'OK', 'Oklahoma');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('49', '223', 'OR', 'Oregon');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('50', '223', 'PW', 'Palau');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('51', '223', 'PA', 'Pennsylvania');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('52', '223', 'PR', 'Puerto Rico');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('53', '223', 'RI', 'Rhode Island');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('54', '223', 'SC', 'South Carolina');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('55', '223', 'SD', 'South Dakota');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('56', '223', 'TN', 'Tennessee');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('57', '223', 'TX', 'Texas');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('58', '223', 'UT', 'Utah');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('59', '223', 'VT', 'Vermont');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('60', '223', 'VI', 'Virgin Islands');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('61', '223', 'VA', 'Virginia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('62', '223', 'WA', 'Washington');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('63', '223', 'WV', 'West Virginia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('64', '223', 'WI', 'Wisconsin');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('65', '223', 'WY', 'Wyoming');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('66', '38', 'AB', 'Alberta');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('67', '38', 'BC', 'British Columbia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('68', '38', 'MB', 'Manitoba');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('69', '38', 'NF', 'Newfoundland');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('70', '38', 'NB', 'New Brunswick');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('71', '38', 'NS', 'Nova Scotia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('72', '38', 'NT', 'Northwest Territories');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('73', '38', 'NU', 'Nunavut');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('74', '38', 'ON', 'Ontario');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('75', '38', 'PE', 'Prince Edward Island');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('76', '38', 'QC', 'Quebec');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('77', '38', 'SK', 'Saskatchewan');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('78', '38', 'YT', 'Yukon Territory');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('79', '81', 'NDS', 'Niedersachsen');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('80', '81', 'BAW', 'Baden-Württemberg');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('81', '81', 'BAY', 'Bayern');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('82', '81', 'BER', 'Berlin');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('83', '81', 'BRG', 'Brandenburg');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('84', '81', 'BRE', 'Bremen');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('85', '81', 'HAM', 'Hamburg');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('86', '81', 'HES', 'Hessen');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('87', '81', 'MEC', 'Mecklenburg-Vorpommern');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('88', '81', 'NRW', 'Nordrhein-Westfalen');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('89', '81', 'RHE', 'Rheinland-Pfalz');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('90', '81', 'SAR', 'Saarland');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('91', '81', 'SAS', 'Sachsen');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('92', '81', 'SAC', 'Sachsen-Anhalt');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('93', '81', 'SCN', 'Schleswig-Holstein');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('94', '81', 'THE', 'Thüringen');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('95', '14', 'WI', 'Wien');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('96', '14', 'NO', 'Niederösterreich');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('97', '14', 'OO', 'Oberösterreich');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('98', '14', 'SB', 'Salzburg');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('99', '14', 'KN', 'Kärnten');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('100', '14', 'ST', 'Steiermark');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('101', '14', 'TI', 'Tirol');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('102', '14', 'BL', 'Burgenland');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('103', '14', 'VB', 'Voralberg');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('104', '204', 'AG', 'Aargau');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('105', '204', 'AI', 'Appenzell Innerrhoden');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('106', '204', 'AR', 'Appenzell Ausserrhoden');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('107', '204', 'BE', 'Bern');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('108', '204', 'BL', 'Basel-Landschaft');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('109', '204', 'BS', 'Basel-Stadt');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('110', '204', 'FR', 'Freiburg');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('111', '204', 'GE', 'Genf');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('112', '204', 'GL', 'Glarus');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('113', '204', 'GR', 'Graubünden');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('114', '204', 'JU', 'Jura');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('115', '204', 'LU', 'Luzern');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('116', '204', 'NE', 'Neuenburg');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('117', '204', 'NW', 'Nidwalden');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('118', '204', 'OW', 'Obwalden');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('119', '204', 'SG', 'St. Gallen');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('120', '204', 'SH', 'Schaffhausen');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('121', '204', 'SO', 'Solothurn');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('122', '204', 'SZ', 'Schwyz');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('123', '204', 'TG', 'Thurgau');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('124', '204', 'TI', 'Tessin');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('125', '204', 'UR', 'Uri');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('126', '204', 'VD', 'Waadt');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('127', '204', 'VS', 'Wallis');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('128', '204', 'ZG', 'Zug');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('129', '204', 'ZH', 'Zürich');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('130', '195', 'A Coruña', 'A Coruña');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('131', '195', 'Alava', 'Alava');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('132', '195', 'Albacete', 'Albacete');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('133', '195', 'Alicante', 'Alicante');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('134', '195', 'Almeria', 'Almeria');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('135', '195', 'Asturias', 'Asturias');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('136', '195', 'Avila', 'Avila');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('137', '195', 'Badajoz', 'Badajoz');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('138', '195', 'Baleares', 'Baleares');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('139', '195', 'Barcelona', 'Barcelona');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('140', '195', 'Burgos', 'Burgos');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('141', '195', 'Caceres', 'Caceres');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('142', '195', 'Cadiz', 'Cadiz');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('143', '195', 'Cantabria', 'Cantabria');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('144', '195', 'Castellon', 'Castellon');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('145', '195', 'Ceuta', 'Ceuta');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('146', '195', 'Ciudad Real', 'Ciudad Real');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('147', '195', 'Cordoba', 'Cordoba');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('148', '195', 'Cuenca', 'Cuenca');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('149', '195', 'Girona', 'Girona');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('150', '195', 'Granada', 'Granada');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('151', '195', 'Guadalajara', 'Guadalajara');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('152', '195', 'Guipuzcoa', 'Guipuzcoa');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('153', '195', 'Huelva', 'Huelva');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('154', '195', 'Huesca', 'Huesca');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('155', '195', 'Jaen', 'Jaen');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('156', '195', 'La Rioja', 'La Rioja');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('157', '195', 'Las Palmas', 'Las Palmas');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('158', '195', 'Leon', 'Leon');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('159', '195', 'Lleida', 'Lleida');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('160', '195', 'Lugo', 'Lugo');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('161', '195', 'Madrid', 'Madrid');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('162', '195', 'Malaga', 'Malaga');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('163', '195', 'Melilla', 'Melilla');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('164', '195', 'Murcia', 'Murcia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('165', '195', 'Navarra', 'Navarra');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('166', '195', 'Ourense', 'Ourense');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('167', '195', 'Palencia', 'Palencia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('168', '195', 'Pontevedra', 'Pontevedra');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('169', '195', 'Salamanca', 'Salamanca');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('170', '195', 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('171', '195', 'Segovia', 'Segovia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('172', '195', 'Sevilla', 'Sevilla');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('173', '195', 'Soria', 'Soria');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('174', '195', 'Tarragona', 'Tarragona');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('175', '195', 'Teruel', 'Teruel');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('176', '195', 'Toledo', 'Toledo');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('177', '195', 'Valencia', 'Valencia');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('178', '195', 'Valladolid', 'Valladolid');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('179', '195', 'Vizcaya', 'Vizcaya');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('180', '195', 'Zamora', 'Zamora');
insert into zones_list (zone_id, zone_country_id, zone_code, zone_name) values ('181', '195', 'Zaragoza', 'Zaragoza');

drop table if exists zones_to_geo_zones;
create table zones_to_geo_zones (
  association_id int(11) not null auto_increment,
  zone_country_id int(11) default '0' not null ,
  zone_id int(11) ,
  geo_zone_id int(11) ,
  last_modified datetime ,
  date_added datetime default '0000-00-00 00:00:00' not null ,
  PRIMARY KEY (association_id),
  KEY IDX_ZONE_COUNTRY_ID (zone_country_id)
);

insert into zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) values ('1', '81', NULL, '1', now(), date_sub(now(),interval 2 day));
insert into zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) values ('3', '204', '0', '2', NULL, date_sub(now(),interval 2 day));
insert into zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) values ('4', '14', '0', '3', NULL, date_sub(now(),interval 2 day));
