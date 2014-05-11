<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : backup.php
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
//              filename: backup.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nueva Copia de Seguridad');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurar Localmente');
define('TEXT_INFO_NEW_BACKUP', 'No interrumpa el proceso de copia, que puede durar unos minutos.');
define('TEXT_INFO_UNPACK', '<br /><br />(despues de descomprimir el archivo)');
define('TEXT_INFO_RESTORE', 'No interrumpa el proceso de restauración.<br /><br />Cuanto mas grande sea la copia de seguridad, mas tardará este proceso!<br /><br />Si es posible, use el cliente de mysql.<br /><br />Por ejemplo:<br /><br /><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' &lt; %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'No interrumpa el proceso de restauración.<br /><br />Cuanto mas grande sea la copia de seguridad, mas tardará este proceso!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'El fichero subido debe ser de texto.');
define('TEXT_INFO_DATE', 'Fecha:');
define('TEXT_INFO_SIZE', 'Tamaño:');
define('TEXT_INFO_COMPRESSION', 'Compresión:');
define('TEXT_INFO_USE_GZIP', 'Usar GZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sin Compresión (directamente SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Bajar solo (no guardar en el servidor)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Preferiblemente con una conexión segura');
define('TEXT_NO_EXTENSION', 'Ninguna');
define('TEXT_DELETE_INTRO', 'Seguro que quiere eliminar esta copia?');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de copias de seguridad.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Error: No hay permiso de escritura en el directorio de copias de seguridad.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Error: No se aceptan enlaces.');
define('ERROR_DIRECTORY_NOT_REMOVEABLE', 'Error: No puedo eliminar el directorio. Asigne los permisos adecuados a: %s');
define('ERROR_FILE_NOT_REMOVEABLE', 'Error: No puedo eliminar este fichero. Asigne los permisos adecuados a: %s');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Exito: La fecha de ultima restauración ha sido borrada.');
define('SUCCESS_DATABASE_SAVED', 'Exito: Se ha guardado la base de datos.');
define('SUCCESS_DATABASE_RESTORED', 'Exito: Se ha restaurado la base de datos.');
define('SUCCESS_BACKUP_DELETED', 'Exito: Se ha eliminado la copia de seguridad.');
?>
