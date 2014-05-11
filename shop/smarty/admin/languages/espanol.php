<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : espanol.php
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
//              filename: espanol.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on Unix/Linux system try 'es_ES.UTF8'
// on Windows environment try 'esp', or 'spanish', or 'Spanish_Spain.28605'
@setlocale(LC_TIME, 'es_ES.UTF8');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S'); // this is used for strftime()

// this array is used for function xos_date_format()
$day_month_names = array(
		   'day_0' => 'Domingo',
		   'day_1' => 'Lunes',
		   'day_2' => 'Martes',
		   'day_3' => 'Miércoles',
		   'day_4' => 'Jueves',
		   'day_5' => 'Viernes',
		   'day_6' => 'Sábado',

		   'day_short_0' => 'Dom',
		   'day_short_1' => 'Lun',
		   'day_short_2' => 'Mar',
		   'day_short_3' => 'Mié',
		   'day_short_4' => 'Jue',
		   'day_short_5' => 'Vie',
		   'day_short_6' => 'Sáb',

		   'month_01' => 'Enero',
		   'month_02' => 'Febrero',
		   'month_03' => 'Marzo',
		   'month_04' => 'Abril',
		   'month_05' => 'Mayo',
		   'month_06' => 'Junio',
		   'month_07' => 'Julio',
		   'month_08' => 'Agosto',
		   'month_09' => 'Septiembre',
		   'month_10' => 'Octubre',
		   'month_11' => 'Noviembre',
		   'month_12' => 'Diciembre',

		   'month_short_01' => 'Ene',
		   'month_short_02' => 'Feb',
		   'month_short_03' => 'Mar',
		   'month_short_04' => 'Abr',
		   'month_short_05' => 'May',
		   'month_short_06' => 'Jun',
		   'month_short_07' => 'Jul',
		   'month_short_08' => 'Ago',
		   'month_short_09' => 'Sep',
		   'month_short_10' => 'Oct',
		   'month_short_11' => 'Nov',
		   'month_short_12' => 'Dic');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function xos_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="es"');

// language attribute for the <html> tag
define('XHTML_LANG','es');

// charset for web pages and emails
define('CHARSET', 'UTF-8');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'Mi Cuenta');

// configuration box text in includes/boxes/menubox_administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrador');
define('BOX_ADMINISTRATOR_MEMBERS', 'Miembros de Admin');
define('BOX_ADMINISTRATOR_MEMBER', 'Miembros');
define('BOX_ADMINISTRATOR_GROUPS', 'Grupos de Admin');
define('BOX_ADMINISTRATOR_GROUP', 'Grupos');
define('BOX_ADMINISTRATOR_BOXES', 'Grupos/Miembros');

// images
define('IMAGE_FILE_PERMISSION', 'Permisos File');
define('IMAGE_GROUPS', 'Lista Grupos');
define('IMAGE_INSERT_FILE', 'Inserta File');
define('IMAGE_MEMBERS', 'Lista Miembros');
define('IMAGE_NEXT', 'Sigue');

// constants for use in xos_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Muestra de <b>%d</b> a <b>%d</b> (of <b>%d</b> nombre de file)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Muestra de <b>%d</b> a <b>%d</b> (of <b>%d</b> miembros)');

// text for gender
define('MALE', 'Varón');
define('FEMALE', 'Mujer');

// configuration box text in includes/boxes/menubox_configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuración');
define('BOX_CONFIGURATION_MYSTORE', 'Mi Tienda');
define('BOX_CONFIGURATION_LOGGING', 'Registro');
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
define('BOX_HEADING_MODULES', 'Módulos');
define('BOX_MODULES_PAYMENT', 'Pago');
define('BOX_MODULES_SHIPPING', 'Envío');

// categories box text in includes/boxes/menubox_catalog.php
define('BOX_HEADING_CATALOG', 'Catálogo');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias/Productos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Comentarios');
define('BOX_CATALOG_SPECIALS', 'Ofertas');
define('BOX_CATALOG_UPDATE_PRODUCTS_PRICES', 'Actualización precios');
define('BOX_CATALOG_XSELL_PRODUCTS', 'Venta Cruzada');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Próximamente');

// customers box text in includes/boxes/menubox_customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Pedidos');
define('BOX_CUSTOMERS_GROUPS', 'Grupos de Clientes');

// taxes box text in includes/boxes/menubox_taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Zonas/Impuestos');
define('BOX_TAXES_COUNTRIES', 'Paises');
define('BOX_TAXES_ZONES', 'Provincias');
define('BOX_TAXES_GEO_ZONES', 'Zonas de Impuestos');
define('BOX_TAXES_TAX_CLASSES', 'Tipos de Impuestos');
define('BOX_TAXES_TAX_RATES', 'Impuestos');

// reports box text in includes/boxes/menubox_reports.php
define('BOX_HEADING_REPORTS', 'Informes');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Los Mas Vistos');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Los Mas Comprados');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total por Cliente');
define('BOX_REPORTS_CREDITS', 'Customer Credit Voucher');

// tools text in includes/boxes/menubox_tools.php
define('BOX_HEADING_TOOLS', 'Herramientas');
define('BOX_TOOLS_ACTION_RECORDER', 'Grabadora de acciones');
define('BOX_TOOLS_BACKUP', 'Copia de Seguridad');
define('BOX_TOOLS_BANNER_MANAGER', 'Banners');
define('BOX_TOOLS_SMARTY_CACHE', 'Smarty control de caché');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definir Idiomas');
define('BOX_TOOLS_FILE_MANAGER', 'Archivos');
define('BOX_TOOLS_IMAGE_PROCESSING', 'Image Processing');
define('BOX_TOOLS_MAIL', 'Enviar Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Boletines');
define('BOX_TOOLS_SERVER_INFO', 'Información');
define('BOX_TOOLS_WHOS_ONLINE', 'Usuarios conectados');

// localizaion box text in includes/boxes/menubox_localization.php
define('BOX_HEADING_LOCALIZATION', 'Localización');
define('BOX_LOCALIZATION_CURRENCIES', 'Monedas');
define('BOX_LOCALIZATION_LANGUAGES', 'Idiomas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Estado Pedidos');

// gv_admin box text in includes/boxes/menubox_gv_admin.php
define('BOX_HEADING_GV_ADMIN', 'Boucher/Cupones');
define('BOX_GV_ADMIN_QUEUE', 'Cola de Boucher de Regalo');
define('BOX_GV_ADMIN_MAIL', 'Correo de oucher de Regalo');
define('BOX_GV_ADMIN_SENT', 'Enviar Boucher de Regalo');
define('BOX_COUPON_ADMIN','Cupon Admin');

// content_manager box text in includes/boxes/menubox_content_manager.php
define('BOX_HEADING_CONTENT_MANAGER', 'Content Manager');
define('BOX_CONTENT_MANAGER_PAGES', 'Páginas en el árbol de menús');
define('BOX_CONTENT_MANAGER_INFO_PAGES', 'Páginas de información');

// javascript messages
define('JS_ERROR', 'Ha habido errores procesando su formulario!\nPor favor, haga las siguientes modificaciones:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* El atributo necesita un precio\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* El atributo necesita un prefijo para el precio\n');

define('JS_PRODUCTS_NAME', '* El producto necesita un nombre\n');
define('JS_PRODUCTS_DESCRIPTION', '* El producto necesita una descripción\n');
define('JS_PRODUCTS_PRICE', '* El producto necesita un precio\n');
define('JS_PRODUCTS_WEIGHT', '* Debe especificar el peso del producto\n');
define('JS_PRODUCTS_QUANTITY', '* Debe especificar la cantidad\n');
define('JS_PRODUCTS_MODEL', '* Debe especificar el modelo\n');
define('JS_PRODUCTS_IMAGE', '* Debe suministrar una imagen\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Debe rellenar el precio\n');

define('JS_GENDER', '* Debe elegir un \'Sexo\'.\n');
define('JS_FIRST_NAME', '* El \'Nombre\' debe tener al menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras.\n');
define('JS_LAST_NAME', '* El \'Apellido\' debe tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.\n');
define('JS_DOB', '* La \'Fecha de Nacimiento\' debe tener el formato: xx/xx/xxxx (dia/mes/año).\n');
define('JS_EMAIL_ADDRESS', '* El \'E-Mail\' debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.\n');
define('JS_ADDRESS', '* El \'Domicilio\' debe tener al menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras.\n');
define('JS_POST_CODE', '* El \'Código Postal\' debe tener al menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras.\n');
define('JS_CITY', '* La \'Ciudad\' debe tener al menos ' . ENTRY_CITY_MIN_LENGTH . ' letras.\n');
define('JS_STATE', '* Debe indicar la \'Provincia\'.\n');
define('JS_STATE_SELECT', '-- Seleccione Arriba --');
define('JS_ZONE', '* La \'Provincia\' se debe seleccionar de la lista para este pais.');
define('JS_COUNTRY', '* Debe seleccionar un \'Pais\'.\n');
define('JS_TELEPHONE', '* El \'Telefono\' debe tener al menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras.\n');
define('JS_PASSWORD', '* La \'Contraseña\' y \'Confirmación\' deben ser iguales y tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'El número de pedido %s no existe!');

define('JS_CONFIRM_SAVE', 'grabar?');
define('JS_CONFIRM_UPDATE', 'actualizar?');
define('JS_CONFIRM_INSERT', 'insertar?');
define('JS_THIS_PROCESS_MAY_TAKE_SOME_TIME', 'This process may take some time and may not be interrupted!');
define('JS_ARE_YOU_SURE', 'Are you sure?');

define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">obligatorio</span>');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras</span>');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras</span>');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(p.ej. 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Su Email no parece correcto!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">email ya existe!</span>');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alerta apagada');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alerta encendida');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras</span>');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras</span>');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' letras</span>');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">obligatorio</span>');
define('ENTRY_COUNTRY_ERROR', 'Debe seleccionar un país de la lista desplegable.');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras</span>');
define('ENTRY_NEWSLETTER_YES', 'suscrito');
define('ENTRY_NEWSLETTER_NO', 'no suscrito');
define('ENTRY_CUSTOMERS_GROUP_NAME_ERROR', '');

// button texts
define('BUTTON_TEXT_ANI_SEND_EMAIL', 'Enviando E-Mail');
define('BUTTON_TEXT_BACK', 'Volver');
define('BUTTON_TEXT_BACK_TO_OVERVIEW', 'Volver a vista general');
define('BUTTON_TEXT_BACKUP', 'Copiar');
define('BUTTON_TEXT_CANCEL', 'Cancelar');
define('BUTTON_TEXT_CONFIRM', 'Confirmar');
define('BUTTON_TEXT_COPY', 'Copiar');
define('BUTTON_TEXT_COPY_TO', 'Copiar A');
define('BUTTON_TEXT_DETAILS', 'Detalle');
define('BUTTON_TEXT_DELETE', 'Eliminar');
define('BUTTON_TEXT_EDIT', 'Editar');
define('BUTTON_TEXT_EMAIL', 'Email');
define('BUTTON_TEXT_FILE_MANAGER', 'Archivos');
define('BUTTON_TEXT_FILE_PERMISSION', 'Permisos File');
define('BUTTON_TEXT_INSERT', 'Insertar');
define('BUTTON_TEXT_LOCK', 'Bloqueado');
define('BUTTON_TEXT_MODULE_INSTALL', 'Instalar');
define('BUTTON_TEXT_MODULE_REMOVE', 'Quitar');
define('BUTTON_TEXT_MOVE', 'Mover');
define('BUTTON_TEXT_NEW_BANNER', 'Nuevo Banner');
define('BUTTON_TEXT_NEW_CATEGORY', 'Nueva Categoria');
define('BUTTON_TEXT_NEW_COUNTRY', 'Nuevo Pais');
define('BUTTON_TEXT_NEW_CURRENCY', 'Nueva Moneda');
define('BUTTON_TEXT_NEW_FILE', 'Nuevo Fichero');
define('BUTTON_TEXT_NEW_FOLDER', 'Nueva Carpeta');
define('BUTTON_TEXT_NEW_LANGUAGE', 'Nueva Idioma');
define('BUTTON_TEXT_NEW_NEWSLETTER', 'Nuevo Boletín');
define('BUTTON_TEXT_NEW_PAGE', 'Nueva página en:');
define('BUTTON_TEXT_NEW_PRODUCT', 'Nuevo Producto');
define('BUTTON_TEXT_SORT_PRODUCT', 'Ordenar Producto');
define('BUTTON_TEXT_NEW_TAX_CLASS', 'Nuevo Impuesto');
define('BUTTON_TEXT_NEW_TAX_RATE', 'Nuevo Impuesto');
define('BUTTON_TEXT_NEW_TAX_ZONE', 'Nueva Zona');
define('BUTTON_TEXT_NEW_ZONE', 'Nueva Zona');
define('BUTTON_TEXT_ORDERS', 'Pedidos');
define('BUTTON_TEXT_ORDERS_INVOICE', 'Factura');
define('BUTTON_TEXT_ORDERS_PACKINGSLIP', 'Albarán');
define('BUTTON_TEXT_PREVIEW', 'Ver');
define('BUTTON_TEXT_PRODUCTS_ATTRIBUTES', 'Atributos');
define('BUTTON_TEXT_REPORT', 'Report');
define('BUTTON_TEXT_RESET', 'Resetear');
define('BUTTON_TEXT_RESTORE', 'Restaurar');
define('BUTTON_TEXT_REAL_IMAGE', 'Imagen real');
define('BUTTON_TEXT_SAVE', 'Grabar');
define('BUTTON_TEXT_SEARCH', 'Buscar');
define('BUTTON_TEXT_SELECT', 'Seleccionar');
define('BUTTON_TEXT_SELECT_FOR_LIGHTBOX', 'Seleccionar (por Lightbox o Tabs)');
define('BUTTON_TEXT_SEND', 'Enviar');
define('BUTTON_TEXT_SEND_EMAIL', 'Send Email');
define('BUTTON_TEXT_UNLOCK', 'Desbloqueado');
define('BUTTON_TEXT_UPDATE', 'Actualizar');
define('BUTTON_TEXT_UPDATE_CURRENCIES', 'Actualizar Cambio');
define('BUTTON_TEXT_UPLOAD', 'Subir');

// button titles
define('BUTTON_TITLE_ANI_SEND_EMAIL', 'Enviando E-Mail');
define('BUTTON_TITLE_BACK', 'Volver');
define('BUTTON_TITLE_BACK_TO_OVERVIEW', 'Volver a vista general');
define('BUTTON_TITLE_BACKUP', 'Copiar');
define('BUTTON_TITLE_CANCEL', 'Cancelar');
define('BUTTON_TITLE_CONFIRM', 'Confirmar');
define('BUTTON_TITLE_COPY', 'Copiar');
define('BUTTON_TITLE_COPY_TO', 'Copiar A');
define('BUTTON_TITLE_DETAILS', 'Detalle');
define('BUTTON_TITLE_DELETE', 'Eliminar');
define('BUTTON_TITLE_EDIT', 'Editar');
define('BUTTON_TITLE_EMAIL', 'Email');
define('BUTTON_TITLE_FILE_MANAGER', 'Archivos');
define('BUTTON_TITLE_FILE_PERMISSION', 'Permisos File');
define('BUTTON_TITLE_INSERT', 'Insertar');
define('BUTTON_TITLE_LOCK', 'Bloqueado');
define('BUTTON_TITLE_MODULE_INSTALL', 'Instalar Módulo');
define('BUTTON_TITLE_MODULE_REMOVE', 'Quitar Módulo');
define('BUTTON_TITLE_MOVE', 'Mover');
define('BUTTON_TITLE_NEW_BANNER', 'Nuevo Banner');
define('BUTTON_TITLE_NEW_CATEGORY', 'Nueva Categoria');
define('BUTTON_TITLE_NEW_COUNTRY', 'Nuevo Pais');
define('BUTTON_TITLE_NEW_CURRENCY', 'Nueva Moneda');
define('BUTTON_TITLE_NEW_FILE', 'Nuevo Fichero');
define('BUTTON_TITLE_NEW_FOLDER', 'Nueva Carpeta');
define('BUTTON_TITLE_NEW_LANGUAGE', 'Nueva Idioma');
define('BUTTON_TITLE_NEW_NEWSLETTER', 'Nuevo Boletín');
define('BUTTON_TITLE_NEW_PAGE', 'Crear una nueva página en:');
define('BUTTON_TITLE_NEW_PRODUCT', 'Nuevo Producto');
define('BUTTON_TITLE_SORT_PRODUCT', 'Ordenar Producto');
define('BUTTON_TITLE_NEW_TAX_CLASS', 'Nuevo Tipo de Impuesto');
define('BUTTON_TITLE_NEW_TAX_RATE', 'Nuevo Impuesto');
define('BUTTON_TITLE_NEW_TAX_ZONE', 'Nueva Zona');
define('BUTTON_TITLE_NEW_ZONE', 'Nueva Zona');
define('BUTTON_TITLE_ORDERS', 'Pedidos');
define('BUTTON_TITLE_ORDERS_INVOICE', 'Factura');
define('BUTTON_TITLE_ORDERS_PACKINGSLIP', 'Albarán');
define('BUTTON_TITLE_PREVIEW', 'Ver');
define('BUTTON_TITLE_PRODUCTS_ATTRIBUTES', 'Atributos');
define('BUTTON_TITLE_REPORT', 'Report');
define('BUTTON_TITLE_RESET', 'Resetear');
define('BUTTON_TITLE_RESTORE', 'Restaurar');
define('BUTTON_TITLE_REAL_IMAGE', 'Imagen real');
define('BUTTON_TITLE_SAVE', 'Grabar');
define('BUTTON_TITLE_SEARCH', 'Buscar');
define('BUTTON_TITLE_SELECT', 'Seleccionar');
define('BUTTON_TITLE_SELECT_FOR_LIGHTBOX', 'Seleccionar (por Lightbox o Tabs)');
define('BUTTON_TITLE_SEND', 'Enviar');
define('BUTTON_TITLE_SEND_EMAIL', 'Send Email');
define('BUTTON_TITLE_UNLOCK', 'Desbloqueado');
define('BUTTON_TITLE_UPDATE', 'Actualizar');
define('BUTTON_TITLE_UPDATE_CURRENCIES', 'Actualizar Cambio de Moneda');
define('BUTTON_TITLE_UPLOAD', 'Subir');

//icon titles
define('ICON_TITLE_STATUS_GREEN', 'Activado');
define('ICON_TITLE_STATUS_GREEN_LIGHT', 'Activar');
define('ICON_TITLE_STATUS_RED', 'Desactivado');
define('ICON_TITLE_STATUS_RED_LIGHT', 'Desactivar');
define('ICON_TITLE_CURRENT_FOLDER', 'Directorio Actual');
define('ICON_TITLE_ERROR', 'Error');
define('ICON_TITLE_FILE', 'Fichero');
define('ICON_TITLE_FILE_DOWNLOAD', 'Descargar');
define('ICON_TITLE_FOLDER', 'Carpeta');
define('ICON_TITLE_LOCKED_CLICK_TO_UNLOCK', 'bloqueado, haga clic para desbloquear');
define('ICON_TITLE_PREVIOUS_LEVEL', 'Nivel Anterior');
define('ICON_TITLE_SUCCESS', 'Exito');
define('ICON_TITLE_UNLOCKED', 'desbloqueada');
define('ICON_TITLE_UNLOCKED_CLICK_TO_LOCK', 'desbloqueada, haga clic para bloqueo');
define('ICON_TITLE_WARNING', 'Advertencia');
define('ICON_TITLE_IC_UP_TEXT_SORT', 'Sort');
define('ICON_TITLE_IC_DOWN_TEXT_SORT', 'Sort');
define('ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC', '--> A-B-C  from top');
define('ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX', '--> Z-Y-X  from top');
define('ICON_TITLE_ROW_IS_NOT_UPDATED', 'Esta fila es nuevo y no ha sido actualizado');

// constants for use in xos_prev_next_display function
define('TEXT_RESULT_PAGE', 'Página %s de %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> paises)');
define('TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> Cupones)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> clientes)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> monedas)');
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> entradas)');
define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> Bouchers regalados)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> idiomas)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> fabricantes)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> boletines)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> estado de pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> productos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> productos esperados)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> comentarios)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> ofertas)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> zonas de impuestos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> porcentajes de impuestos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> tipos de impuesto)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> zonas)');

define('PREVNEXT_BUTTON_PREV', '<strong>&lt;&lt;</strong>');
define('PREVNEXT_BUTTON_NEXT', '<strong>&gt;&gt;</strong>');

define('TEXT_DEFAULT', 'predeterminado/a');
define('TEXT_SET_DEFAULT', 'Establecer como predeterminado/a');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Obligatorio</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: No hay moneda predeterminada. Por favor establezca una en: Herramientas de Administracion->Localización->Monedas');
define('ERROR_NO_DEFAULT_LANGUAGE_DEFINED', 'Error: No hay idioma predeterminada. Por favor establezca una en: Herramientas de Administracion->Localización->Idiomas');

define('TEXT_CACHE_CATEGORIES', 'Categorias');
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes');
define('TEXT_CACHE_ALSO_PURCHASED', 'También Han Comprado');

define('TEXT_ALL_LANGUAGES', 'todos los idiomas');
define('TEXT_ALL', '--todos--');
define('TEXT_NONE', '--ninguno--');
define('TEXT_TOP', 'Principio');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destino no existe.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: No se puede escribir en el destino.');
define('ERROR_FILE_NOT_SAVED', 'Error: El archivo subido no se ha guardado.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: Extension de fichero no permitida.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Exito: Fichero guardado con éxito.');
define('WARNING_NO_FILE_UPLOADED', 'Advertencia: No se ha subido ningun archivo.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Advertencia: Se ha desactivado la subida de archivos en el fichero de configuración php.ini.');
define('WARNING_SITE_IS_OFFLINE', 'Warning: El sitio no está conectado!');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Advertencia: El directorio de instalación existe en: ' . DIR_FS_DOCUMENT_ROOT . 'install. Por razones de seguridad, elimine este directorio completamente.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Advertencia: Puedo escribir en el fichero de configuración: ' . DIR_FS_CATALOG . 'includes/configure.php. En determinadas circunstancias esto puede suponer un riesgo - por favor corriga los permisos de este fichero.');
define('WARNING_ADMIN_CONFIG_FILE_WRITEABLE', 'Advertencia: Puedo escribir en el fichero de configuración: ' . DIR_FS_ADMIN . 'includes/configure.php. En determinadas circunstancias esto puede suponer un riesgo - por favor corriga los permisos de este fichero.');

define('ERROR_PHPMAILER', 'Mailer Error: %s (E-mail no fue enviado)');

define('TEXT_IMAGE_NONEXISTENT', 'NO EXISTE IMAGEN');
?>
