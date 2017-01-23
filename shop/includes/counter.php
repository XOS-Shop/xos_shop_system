<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : counter.php
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
//              filename: counter.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  $counter_query = $DB->query
  (
   "SELECT startdate, 
           counter 
    FROM   " . TABLE_COUNTER
  );

  if (!$counter_query->rowCount()) {
    $date_now = date('Ymd');
    $insert_counter_query = $DB->prepare
    (
     "INSERT INTO " . TABLE_COUNTER . "
                  (
                   startdate,
                   counter
                  )
                  VALUES 
                  (
                  :date_now,
                  '1'
                  )"
    );
    
    $DB->perform($insert_counter_query, array(':date_now' => $date_now));
    
    $counter_startdate = $date_now;
    $counter_now = 1;
  } else {
    $counter = $counter_query->fetch();
    $counter_startdate = $counter['startdate'];
    $counter_now = ($counter['counter'] + 1);
    $DB->exec
    (
     "UPDATE " . TABLE_COUNTER . "
      SET    counter = counter + 1"
    );
  }

  $counter_startdate_formatted =  xos_date_format(DATE_FORMAT_LONG, mktime(0, 0, 0, substr($counter_startdate, 4, 2), substr($counter_startdate, -2), substr($counter_startdate, 0, 4)));