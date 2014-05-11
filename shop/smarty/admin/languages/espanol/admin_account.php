<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : admin_account.php
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
//              filename: admin_account.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('TEXT_INFO_ERROR_EMAIL_USED', 'Direccion Email ya utilizado!');
define('TEXT_INFO_ERROR_EMAIL_NOT_VALID', 'Dirección de E-Mail no parece válida - por favor haga los cambios necesarios.');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Ocultado-');

define('TEXT_INFO_HEADING_DEFAULT', 'Cambia Cuenta ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Confirma Contraseña ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Contraseña:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>ERROR:</b> Contraseña invalida!</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Click <b>editar</b> para cambiar tu cuenta.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br /><b>WARNING:</b><br />Hola <b>%s</b>, you just come here for the first time. We recommend you to change your contraseña!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br /><b>WARNING:</b><br />Hola <b>%s</b>, we recommend you to change your email (<font color="red">admin@localhost</font>) and contraseña!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Todos los campos son obligatorios. Click <b>grabar</b> para guardar tus cambios.');

define('JS_ALERT_FIRSTNAME',        '- Obligatorio: Nombre \n');
define('JS_ALERT_LASTNAME',         '- Obligatorio: Apellido \n');
define('JS_ALERT_EMAIL',            '- Obligatorio: Dirección Email \n');
define('JS_ALERT_PASSWORD',         '- Obligatorio: Contraseña \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Sus nombre deben tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.');
define('JS_ALERT_LASTNAME_LENGTH',  '- Sus apellidos deben tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.');
define('JS_ALERT_PASSWORD_LENGTH',  '- Su contraseña debe tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.');
define('JS_ALERT_EMAIL_LENGTH',     '- Su dirección de E-Mail debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.');
define('JS_ALERT_PASSWORD_CONFIRM', '- Confirma tu Contraseña! \n');

define('ADMIN_EMAIL_SUBJECT', 'Cambios Informaciones Personales');
define('ADMIN_EMAIL_TEXT', 'Hola %s,' . "\n\n" . 'Tus datos personales, talvez tu contraseña, han sido modificados. Si esto no era tu intencion, contacta el administrador inmediatamente!' . "\n\n" . 'Website: %s' . "\n" . 'E-Mail: %s' . "\n" . 'Contraseña: %s' . "\n\n" . 'Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mail automatico, entonces no respondes!');
?>
