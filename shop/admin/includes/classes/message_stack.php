<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : message_stack.php
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
//              filename: message_stack.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class messageStack {

// class constructor
    function __construct() {

      $this->messages = array();

      if (isset($_SESSION['messageToStack'])) {
        for ($i=0, $n=sizeof($_SESSION['messageToStack']); $i<$n; $i++) {
          $this->add($_SESSION['messageToStack'][$i]['class'], $_SESSION['messageToStack'][$i]['text'], $_SESSION['messageToStack'][$i]['type']);
        }
        unset($_SESSION['messageToStack']);
      }
    }

// class methods
    function add($class, $message, $type = 'error') {

      if ($type == 'error') {
        $this->messages[] = array('class' => $class, 'type' => $type, 'text' => '<p>' . $message . '</p>' . "\n");
      } elseif ($type == 'warning') {
        $this->messages[] = array('class' => $class, 'type' => $type, 'text' => '<p>' . $message . '</p>' . "\n");
      } elseif ($type == 'success') {
        $this->messages[] = array('class' => $class, 'type' => $type, 'text' => '<p>' . $message . '</p>' . "\n");
      } else {
        $this->messages[] = array('class' => $class, 'type' => $type, 'text' => '<p>' . $message . '</p>' . "\n");
      }      
    }

    function add_session($class, $message, $type = 'error') {

      if (!isset($_SESSION['messageToStack'])) {
        $_SESSION['messageToStack'] = array();
      }

      $_SESSION['messageToStack'][] = array('class' => $class, 'text' => $message, 'type' => $type);
    }

    function reset() {
      $this->messages = array();
    }

    function output($class, $type = '') {
    
//      if ($this->size($class) == 0) return false;

      $output_string = '';      
      for ($i=0, $n=sizeof($this->messages); $i<$n; $i++) {
        if ($this->messages[$i]['class'] == $class && ($this->messages[$i]['type'] == $type || $type == '')) {
          $output_string .= $this->messages[$i]['text'];
        }
      }      

      return $output_string;
    }

    function size($class, $type = '') {
      $count = 0;

      for ($i=0, $n=sizeof($this->messages); $i<$n; $i++) {
        if ($this->messages[$i]['class'] == $class && ($this->messages[$i]['type'] == $type || $type == '')) {
          $count++;
        }
      }

      return $count;
    }   
  }
?>