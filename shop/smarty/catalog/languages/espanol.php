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
// on Windows environment try 'esp', or 'spanish'
@setlocale(LC_TIME, 'es_ES.UTF8');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %T'); // this is used for strftime()

define('DATE_OF_BIRTH_FIELD_ORDER', 'DMY');
define('DATE_OF_BIRTH_FIELD_SEPARATOR', '/');
define('DATE_OF_BIRTH_ENTRY_TEXT_MONTH', 'Mes');
define('DATE_OF_BIRTH_ENTRY_TEXT_DAY', 'Día');
define('DATE_OF_BIRTH_ENTRY_TEXT_YEAR', 'Año');

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
// $date should be in format dd/mm/yyyy
// raw date is in format yyyymmdd
function xos_date_raw($date) {
  return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
}

////
// Return datetime in raw format
// $date should be in format dd/mm/yyyy hh:ii:ss
// raw datetime is in format yyyymmddhhiiss
function xos_datetime_raw($date) {
  return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 11, 2) . substr($date, 14, 2) . substr($date, 17, 2);
}

// Sprachspezifische ASCII-Ersetzungen für SEF-URLs (URL-konform)
$sef_url_trail_search = array("&");
$sef_url_trail_replace = array("-y-");

// Insertions for SEF URLs
define('SEF_URL_NAME_REVIEWS', 'Comentarios');
define('SEF_URL_NAME_SPECIALS', 'Ofertas');
define('SEF_URL_NAME_NEW_PRODUCTS', 'Novedades');
define('SEF_URL_NAME_SUBSCRIBE_NEWSLETTER', 'Suscriba al Newsletter');
define('SEF_URL_NAME_TELL_A_FRIEND', 'Enviar a un Amigo');
define('SEF_URL_NAME_SHOPPING_CART', 'Contenido de la Cesta');
define('SEF_URL_NAME_LOGIN', 'Entrar');
define('SEF_URL_NAME_CREATE_ACCOUNT', 'Crear una Cuenta');
define('SEF_URL_NAME_PASSWORD_FORGOTTEN', 'Entrar^Constraseña Olvidada');
define('SEF_URL_NAME_ADVANCED_SEARCH_AND_RESULTS', 'Búsqueda Avanzada');
define('SEF_URL_NAME_SEARCH_RESULT', 'Resultados de la Búsqueda');
define('SEF_URL_NAME_COOKIE_USAGE', 'Uso de Cookies');
define('SEF_URL_NAME_CHECKOUT_ADDRESS', 'Su dirección de cliente');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="es"');

// language attribute for the <html> tag
define('HTML_LANG','es');

// charset for web pages and emails
define('CHARSET', 'UTF-8');

// page title
define('TITLE', STORE_NAME);

// separator for page title
define('PAGE_TITLE_TRAIL_SEPARATOR', ' » ');

// separator for breadcrumb trail
define('BREADCRUMB_TRAIL_SEPARATOR', ' / ');

// text for downloads in includes/modules/downloads.php
define('HEADER_TITLE_MY_ACCOUNT', 'Mi Cuenta');

// header text in includes/application_top.php
define('HEADER_TITLE_TOP', 'Inicio');
define('HEADER_TITLE_HOME', 'Portada del sitio');

// text for gender
define('MALE', 'Sr.');
define('FEMALE', 'Sra.');
define('MALE_ADDRESS', 'Sr.');
define('FEMALE_ADDRESS', 'Sra.');

// format string for advanced search
define('AS_FORMAT_STRING', 'dd/mm/aaaa');
define('AS_FORMAT_STRING_JS', 'dd/mm/yyyy');

// reviews box text in includes/boxes/reviews.php
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s de 5 Estrellas!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Seleccione');
define('TYPE_BELOW', 'Escriba Debajo');

// javascript messages
define('JS_ERROR', 'Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n');
define('JS_REVIEW_TEXT', 'Su \'Comentario\' debe tener al menos ' . REVIEW_TEXT_MIN_LENGTH . ' letras.');
define('JS_REVIEW_RATING', 'Debe evaluar el producto sobre el que opina.');
define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Por favor, seleccione un método de pago para su pedido.\n');
define('JS_ERROR_CONDITIONS_NOT_ACCEPTED', '* Por favor, confirme las Condiciones General de Negocios.\n');
define('JS_ERROR_SUBMITTED', 'Ya ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.');
define('JS_ERROR_KEYWORD_FIELD_EMPTY', 'El campo de búsqueda no debe ser vacío.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Por favor, seleccione un método de pago para su pedido');
define('ERROR_CONDITIONS_NOT_ACCEPTED', 'Por favor, confirme las Condiciones General de Negocios');

define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
define('ENTRY_GENDER_ERROR', 'Por favor, seleccione su saludo.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME_ERROR', 'Su Nombre debe tener al menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME_ERROR', 'Sus apellidos deben tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Su fecha de nacimiento debe tener este formato: DD/MM/AAAA (p.ej. 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_DAY_SELECT', 'Por favor seleccione un día de la lista.');
define('ENTRY_DATE_OF_BIRTH_MONTH_SELECT', 'Por favor seleccione un mes de la lista.');
define('ENTRY_DATE_OF_BIRTH_JEAR_SELECT', 'Por favor seleccione un año de la lista.');
define('ENTRY_DATE_OF_BIRTH_TEXT', 'DD/MM/AAAA (p.ej. 21/05/1970) *');
define('ENTRY_DATE_OF_BIRTH_TEXT_1', '<span style="color: #03A31B;">(DD/MM/AAAA)</span> *');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Su dirección de E-Mail debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Su dirección de E-Mail no parece válida - por favor haga los cambios necesarios.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Esta dirección de correo electrónico ya existe en nuestros registros. Por favor, crea tu cuenta con una dirección diferente.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS_CHOOSE_DIFFERENT_ADDRESS', 'Esta dirección de correo electrónico ya existe en nuestros registros. Por favor elija una dirección diferente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS_ERROR', 'Su dirección debe tener al menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_MISSING_HOUSE_NUMBER_TEXT_1', 'Número de casa es falta!');
define('ENTRY_MISSING_HOUSE_NUMBER_TEXT_2', 'Ignorar este mensaje si no tiene ningún número de la casa.');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE_ERROR', 'Su código postal debe tener al menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY_ERROR', 'Su población debe tener al menos ' . ENTRY_CITY_MIN_LENGTH . ' letras.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE_ERROR', 'Su provincia/estado debe tener al menos ' . ENTRY_STATE_MIN_LENGTH . ' letras.');
define('ENTRY_STATE_ERROR_SELECT', 'Por favor seleccione de la lista desplegable.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY_ERROR', 'Debe seleccionar un país de la lista desplegable.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Su número de teléfono debe tener al menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'suscribirse');
define('ENTRY_NEWSLETTER_NO', 'no suscribirse');
define('ENTRY_PASSWORD_ERROR', 'La contraseña debe tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres y debe contener letras mayúsculas y minúsculas, así como números y caracteres especiales.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'La confirmación de la contraseña debe ser igual a la contraseña.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirme Contraseña:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Contraseña Actual:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_NEW', 'Nueva Contraseña:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Su contraseña nueva debe tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'La confirmación de su contraseña debe coincidir con su contraseña nueva.');
define('ENTRY_PASSWORD_PLACEHOLDER', 'Min. ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres eg Yltx)7k!Iu');
define('PASSWORD_HIDDEN', '--OCULTO--');

// constants for use in xos_prev_next_display function
define('TEXT_RESULT_PAGE', 'Páginas de Resultados:');
define('TEXT_RESULT_PAGE_IN_PULL_DOWN_MENU', 'Página %s de %d');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Viendo&nbsp;del <b>%d</b>&nbsp;al&nbsp;<b>%d</b>&nbsp;(de&nbsp;<b>%d</b>&nbsp;productos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Viendo&nbsp;del <b>%d</b>&nbsp;al&nbsp;<b>%d</b>&nbsp;(de&nbsp;<b>%d</b>&nbsp;pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Viendo&nbsp;del <b>%d</b>&nbsp;al&nbsp;<b>%d</b>&nbsp;(de&nbsp;<b>%d</b>&nbsp;comentarios)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Viendo&nbsp;del <b>%d</b>&nbsp;al&nbsp;<b>%d</b>&nbsp;(de&nbsp;<b>%d</b>&nbsp;productos&nbsp;nuevos)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Viendo&nbsp;del <b>%d</b>&nbsp;al&nbsp;<b>%d</b>&nbsp;(de&nbsp;<b>%d</b>&nbsp;ofertas)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Principio');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Siguiente');
define('PREVNEXT_TITLE_LAST_PAGE', 'Final');
define('PREVNEXT_TITLE_PAGE_NO', 'Página %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Anteriores %d Páginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Siguientes %d Páginas');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PRINCIPIO');
define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');
define('PREVNEXT_BUTTON_LAST', 'FINAL&gt;&gt;');

define('IMAGE_BUTTON_IN_CART', 'Añadir a la Cesta');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notificaciones');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Eliminar Notificaciones');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Escribir Comentario');

define('ICON_ARROW_RIGHT', 'más');
define('ICON_CART', 'En Cesta');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Correcto');
define('ICON_WARNING', 'Advertencia');

define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Si no es %s, por favor <a href="%s"><span class="text-deco-underline">entre aqui</span></a> e introduzca sus datos.</small>');
define('BOX_TEXT_GREETING_PERSONAL', 'Bienvenido de nuevo<br /><span class="greet-user">%s</span>');
define('BOX_TEXT_GREETING_GUEST', 'Bienvenido <span class="greet-user">Invitado</span>');

define('TEXT_MAX_PRODUCTS', ' productos');
define('TEXT_SORT_PRODUCTS', 'Ordenar Productos ');
define('TEXT_DESCENDINGLY', 'Descendentemente');
define('TEXT_ASCENDINGLY', 'Ascendentemente');
define('TEXT_BY', ' por ');

define('TEXT_UNKNOWN_TAX_RATE', 'Impuesto desconocido');
define('TEXT_TAX_INC_VAT', 'con');
define('TEXT_TAX_PLUS_VAT', 'más');

define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio para guardar datos de sesión no existe: ' . xos_session_save_path() . '. Las sesiones no funcionarán hasta que no se corriga este error.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Avertencia: No puedo escribir en el directorio para datos de sesión: ' . xos_session_save_path() . '. Las sesiones no funcionarán hasta que no se corriga este error.');
define('WARNING_SESSION_AUTO_START', 'Advertencia: session.auto_start esta activado - desactive esta caracteristica en el fichero php.ini and reinicie el servidor web.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio para productos descargables no existe: ' . DIR_FS_DOWNLOAD . '. Los productos descargables no funcionarán hasta que no se corriga este error.');
define('WARNING_SITE_IS_OFFLINE', 'Warning: El sitio no está conectado!');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La fecha de caducidad de la tarjeta de crédito es incorrecta.<br />Compruebe la fecha e inténtelo de nuevo.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'El número de la tarjeta de crédito es incorrecto.<br />Compruebe el numero e inténtelo de nuevo.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Los primeros cuatro digitos de su tarjeta son: <b>%s</b><br />Si este número es correcto, no aceptamos este tipo de tarjetas.<br />Si es incorrecto, inténtelo de nuevo.');

define('ERROR_PHPMAILER', 'Mailer Error: %s (E-mail no fue enviado)');
?>
