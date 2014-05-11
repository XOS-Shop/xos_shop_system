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
// on Unix/Linux system try 'en_US.UTF8'
// on Windows environment try 'english'
@setlocale(LC_TIME, 'en_US.UTF8');

// this array is used for function xos_date_format()
$day_month_names = array(
		   'day_0' => 'Sunday',
		   'day_1' => 'Monday',
		   'day_2' => 'Tuesday',
		   'day_3' => 'Wednesday',
		   'day_4' => 'Thursday',
		   'day_5' => 'Friday',
		   'day_6' => 'Saturday',

		   'day_short_0' => 'Sun',
		   'day_short_1' => 'Mon',
		   'day_short_2' => 'Tue',
		   'day_short_3' => 'Wed',
		   'day_short_4' => 'Thu',
		   'day_short_5' => 'Fri',
		   'day_short_6' => 'Sat',

		   'month_01' => 'January',
		   'month_02' => 'February',
		   'month_03' => 'March',
		   'month_04' => 'April',
		   'month_05' => 'May ', //The spaces at the end of (May ) is very important
		   'month_06' => 'June',
		   'month_07' => 'July',
		   'month_08' => 'August',
		   'month_09' => 'September',
		   'month_10' => 'October',
		   'month_11' => 'November',
		   'month_12' => 'December',

		   'month_short_01' => 'Jan',
		   'month_short_02' => 'Feb',
		   'month_short_03' => 'Mar',
		   'month_short_04' => 'Apr',
		   'month_short_05' => 'May',
		   'month_short_06' => 'Jun',
		   'month_short_07' => 'Jul',
		   'month_short_08' => 'Aug',
		   'month_short_09' => 'Sep',
		   'month_short_10' => 'Oct',
		   'month_short_11' => 'Nov',
		   'month_short_12' => 'Dec');

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

define('EMAIL_TEXT_SUBJECT', 'Order Update');
?>
