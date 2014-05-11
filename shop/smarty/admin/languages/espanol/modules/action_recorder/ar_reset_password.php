<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : ar_reset_password.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2014 Hanspeter Zeller
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
//              Copyright (c) 2013 osCommerce
//              filename: ar_reset_password.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('MODULE_ACTION_RECORDER_RESET_PASSWORD_TITLE', 'Customer Password Reset');
define('MODULE_ACTION_RECORDER_RESET_PASSWORD_DESCRIPTION', 'Record usage of customer password resets.');
  
define('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES_TITLE', 'Allowed Minutes');
define('MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS_TITLE', 'Allowed Attempts'); 

define('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES_DESCRIPTION', 'Number of minutes to allow password resets to occur.');
define('MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS_DESCRIPTION', 'Number of password reset attempts to allow within the specified period.'); 
?>
