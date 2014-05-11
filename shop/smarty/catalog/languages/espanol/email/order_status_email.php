<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : order_status_email.php
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
////////////////////////////////////////////////////////////////////////////////

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on Unix/Linux system try 'es_ES.UTF8'
// on Windows environment try 'esp', or 'spanish'
@setlocale(LC_TIME, 'es_ES.UTF8');

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

function xos_order_status_email_date_long($raw_date) {
  if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

  $year = (int)substr($raw_date, 0, 4);
  $month = (int)substr($raw_date, 5, 2);
  $day = (int)substr($raw_date, 8, 2);
  $hour = (int)substr($raw_date, 11, 2);
  $minute = (int)substr($raw_date, 14, 2);
  $second = (int)substr($raw_date, 17, 2);

  return xos_date_format('%A %d %B, %Y', mktime($hour, $minute, $second, $month, $day, $year));
}

define('EMAIL_TEXT_SUBJECT', 'Actualización del Pedido');
?>
