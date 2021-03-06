<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//
// filename   : configure.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2018 Hanspeter Zeller
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
////////////////////////////////////////////////////////////////////////////////

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_SERVER', ''); // eg, http://localhost - should not be empty for productive servers
  define('HTTPS_SERVER', ''); // eg, https://localhost - should not be empty for productive servers
  define('ENABLE_SSL', 'false'); // secure webserver
  define('HTTP_COOKIE_DOMAIN', '');
  define('HTTPS_COOKIE_DOMAIN', '');
  define('HTTP_COOKIE_PATH', '');
  define('HTTPS_COOKIE_PATH', '');  

  define('DIR_WS_CATALOG', '');  
  define('DIR_WS_ADMIN', DIR_WS_CATALOG . '');  
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');  
  define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
  define('DIR_WS_ADMIN_IMAGES', DIR_WS_CATALOG . 'images/admin/templates/');    
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');    
  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');  
  define('DIR_FS_DOCUMENT_ROOT', ''); // where the pages are located on the server  
  define('DIR_FS_ADMIN', DIR_FS_DOCUMENT_ROOT . ''); // absolute pate required
  define('DIR_FS_CATALOG', DIR_FS_DOCUMENT_ROOT);     
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');    
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');  
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');    
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');   
  define('DIR_FS_SMARTY', DIR_FS_CATALOG . 'smarty/');
  define('DIR_FS_LOGS', DIR_FS_DOCUMENT_ROOT . 'logs/');   
  define('DIR_FS_TMP', DIR_FS_DOCUMENT_ROOT . 'tmp/');  

  define('ADMIN_DIR_NAME', 'default_dir_name');
  
  define('KEY', '');  

// Define our database connection
  define('DB_SERVER', ''); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', '');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'xos_shop');
  define('USE_PCONNECT', 'false'); // use persisstent connections?
  define('STORE_SESSIONS', ''); // leave empty '' for default handler or set to 'mysql'
  define('DISABLE_SQL_MODE', 'false');