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
// on Unix/Linux system try 'de_DE.UTF8'
// on Windows environment try 'deu' or 'german'
@setlocale(LC_TIME, 'de_DE.UTF8');

// this array is used for function xos_date_format()
$day_month_names = array(
		   'day_0' => 'Sonntag',
		   'day_1' => 'Montag',
		   'day_2' => 'Dienstag',
		   'day_3' => 'Mittwoch',
		   'day_4' => 'Donnerstag',
		   'day_5' => 'Freitag',
		   'day_6' => 'Samstag',

		   'day_short_0' => 'So',
		   'day_short_1' => 'Mo',
		   'day_short_2' => 'Di',
		   'day_short_3' => 'Mi',
		   'day_short_4' => 'Do',
		   'day_short_5' => 'Fr',
		   'day_short_6' => 'Sa',

		   'month_01' => 'Januar',
		   'month_02' => 'Februar',
		   'month_03' => 'März',
		   'month_04' => 'April',
		   'month_05' => 'Mai ', //The spaces at the end of (Mai ) is very important
		   'month_06' => 'Juni',
		   'month_07' => 'Juli',
		   'month_08' => 'August',
		   'month_09' => 'September',
		   'month_10' => 'Oktober',
		   'month_11' => 'November',
		   'month_12' => 'Dezember',

		   'month_short_01' => 'Jan',
		   'month_short_02' => 'Feb',
		   'month_short_03' => 'Mär',
		   'month_short_04' => 'Apr',
		   'month_short_05' => 'Mai',
		   'month_short_06' => 'Jun',
		   'month_short_07' => 'Jul',
		   'month_short_08' => 'Aug',
		   'month_short_09' => 'Sep',
		   'month_short_10' => 'Okt',
		   'month_short_11' => 'Nov',
		   'month_short_12' => 'Dez');

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

define('EMAIL_TEXT_SUBJECT', 'Statusänderung Ihrer Bestellung');
?>
