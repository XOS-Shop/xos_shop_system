<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : logger.php
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
//              filename: logger.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class logger {
    var $timer_start, $timer_stop, $timer_total;

// class constructor
    function __construct() {
      $this->timer_start();
    }

    function timer_start() {
      if (defined("PAGE_PARSE_START_TIME")) {
        $this->timer_start = PAGE_PARSE_START_TIME;
      } else {
        $this->timer_start = microtime(true);
      }
    }

    function timer_stop($display = 'false') {
      $this->timer_stop = microtime(true);

      $this->timer_total = number_format(($this->timer_stop - $this->timer_start), 3);

      $this->write(getenv('REQUEST_URI'), $this->timer_total . 's');

      if ($display == 'true') {
        return $this->timer_display();
      }
    }

    function timer_display() {
      return "<span class=\"display-parse-time\">Parse Time: " . $this->timer_total . "s</span>\n</body>\n</html>";
    }

    function write($message, $type) {
      global $day_month_names;
      
      if (is_array($day_month_names)) error_log(xos_date_format(STORE_PARSE_DATE_TIME_FORMAT) . ' (' . $type . ') ' . (!empty(getenv('REMOTE_ADDR')) ? '[' . str_pad(getenv('REMOTE_ADDR'), 15) . '] ' : '[---------------] ') . '(------------) ' . $message . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }
  }