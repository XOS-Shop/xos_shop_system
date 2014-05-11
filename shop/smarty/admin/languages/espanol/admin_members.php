<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : admin_members.php
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
//              filename: admin_members.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Grupos de Admin');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Definicion Grupos');
} else {
  define('HEADING_TITLE', 'Miembros de Admin');
}

define('TABLE_HEADING_PASSWORD', 'Contraseña');
define('TABLE_HEADING_CONFIRM', 'Confirma Contraseña');
define('TABLE_HEADING_CREATED', 'Cuenta Creada');
define('TABLE_HEADING_MODIFIED', 'Cuenta Creada');
define('TABLE_HEADING_LOGDATE', 'Ultimo Acceso');
define('TABLE_HEADING_LOG_NUM', 'Log Numero');

define('TABLE_HEADING_GROUPS_GROUP', 'Nivel');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Permisos Categorias');


define('TEXT_INFO_HEADING_DEFAULT', 'Miembros de Admin ');
define('TEXT_INFO_HEADING_DELETE', 'Cancelar Permiso ');
define('TEXT_INFO_HEADING_EDIT', 'Cambia Categoria / ');
define('TEXT_INFO_HEADING_NEW', 'Nuevo Miembro Admin ');

define('TEXT_INFO_DEFAULT_INTRO', 'grupo Miembro');
define('TEXT_INFO_DELETE_INTRO', 'Remover <b>%s</b> desde Miembros de Admin?');
define('TEXT_INFO_DELETE_INTRO_NOT', 'No puedes eliminar el grupo %s!');
define('TEXT_INFO_EDIT_INTRO', 'Configura nivel de permiso aqui: ');

define('TEXT_INFO_FULLNAME', 'Nombre completo: ');
define('TEXT_INFO_FIRSTNAME', 'Nombre: ');
define('TEXT_INFO_LASTNAME', 'Apellido: ');
define('TEXT_INFO_EMAIL', 'Dirección Email: ');
define('TEXT_INFO_PASSWORD', 'Contraseña: ');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Ocultado-');
define('TEXT_INFO_CONFIRM', 'Confirma Contraseña: ');
define('TEXT_INFO_CREATED', 'Cuenta Creada: ');
define('TEXT_INFO_MODIFIED', 'Cuenta Modificada: ');
define('TEXT_INFO_LOGDATE', 'Ultimo Acceso: ');
define('TEXT_INFO_LOGNUM', 'Log Numero: ');
define('TEXT_INFO_GROUP', 'Nivel Grupo: ');
define('TEXT_INFO_ERROR_EMAIL_USED', '<font color="red">Direccion Email ya utilizado!</font>');
define('TEXT_INFO_ERROR_EMAIL_NOT_VALID', '<font color="red">Dirección de E-Mail no parece válida - por favor haga los cambios necesarios.</font>');

define('JS_ALERT_FIRSTNAME', '- Obligatorio: Nombre \n');
define('JS_ALERT_LASTNAME', '- Obligatorio: Apellido \n');
define('JS_ALERT_EMAIL', '- Obligatorio: Dirección Email \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Sus nombre deben tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.');
define('JS_ALERT_LASTNAME_LENGTH',  '- Sus apellidos deben tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.');
define('JS_ALERT_EMAIL_LENGTH',     '- Su dirección de E-Mail debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.');

define('ADMIN_EMAIL_SUBJECT', 'Nuevo  Miembro Admin');
define('ADMIN_EMAIL_TEXT', 'Hola %s,' . "\n\n" . 'Puedes entrar en el Panel de administracion con la siguiente contraseña. Apenas entrado, cambia tu contraseña!' . "\n\n" . 'Website: %s' . "\n" . 'E-Mail: %s' . "\n" . 'Contraseña: %s' . "\n\n" . 'Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mail automatico, entonces no respondes!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Edita Profilo Miembro Admin');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hola %s,' . "\n\n" . 'Tus datos personales han sido modificados por el administrador.' . "\n\n" . 'Website: %s' . "\n" . 'E-Mail: %s' . "\n" . 'Contraseña: %s' . "\n\n" . 'Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mail automatico, entonces no respondes!');
define('NOTICE_EMAIL_SENT_TO', 'Aviso: Email enviado a: %s');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Grupo Admin ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Eliminar Grupo ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>NOTA:</b><br /><br /><b>editar:</b><br />edita nombre grupo.<br /><br /><b>eliminar:</b><br />elimina grupo.<br /><br /><b>nuevo permiso:</b><br />para definir acceso grupo.');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Esto elimina tambien los miembros del grupo. Quieres eliminar el grupo <b>%s</b>?');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'No puedes eliminar estos grupos!');
define('TEXT_INFO_GROUPS_INTRO', 'Elijes un nombre de grupo univoco. Click <b>sigue</b> para enviar.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Elijes un nombre de grupo univoco. Click <b>sigue</b> para enviar.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Grupo Admin');
define('TEXT_INFO_HEADING_GROUPS', 'Nuevo Grupo');
define('TEXT_INFO_GROUPS_NAME', ' <b>Nombre Grupo:</b><br />Elijes un nombre de grupo univoco. Pues, click <b>sigue</b> para enviar.<br />');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>ERROR:</b> El nombre de grupo tienes que ser mas largo que 5 caracteros!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>ERROR:</b> Nombre Grupo ya utilizado!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Nivel Grupo: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Permiso  Boxes:</b><br />Das acceso al box seleccionado.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Incluye file guardados en: ');

define('TEXT_INFO_HEADING_DEFINE', 'Definir Grupo');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />No puedes cambiar los Permisos a los File por este grupo.<br /><br />');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />Cambia permiso a este grupo seleccionando o deseleccionando los boxes y los files. Click <b>grabar</b> para guardar cambios.<br /><br />');
}
?>
