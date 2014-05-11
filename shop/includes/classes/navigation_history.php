<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : navigation_history.php
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
//              filename: navigation_history.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class navigationHistory {
    var $path, $snapshot;

    function navigationHistory() {
      $this->reset();
    }

    function reset() {
      $this->path = array();
      $this->snapshot = array();
    }

    function add_current_page() {
      global $request_type;

      $last_position = sizeof($this->path) - 1;
      if ($this->path[$last_position]['page'] == basename($_SERVER['PHP_SELF']) && $this->path[$last_position]['get']['cPath'] == $_GET['cPath'] && $this->path[$last_position]['get']['products_id'] == $_GET['products_id'] && $this->path[$last_position]['get']['content_id'] == $_GET['content_id']) {
        array_splice($this->path, ($last_position));
      }
      
      array_splice($this->path, 0, -9);
      

      $this->path[] = array('page' => basename($_SERVER['PHP_SELF']),
                            'mode' => $request_type,
                            'get' => $this->filter_parameters($_GET),
                            'post' => $this->filter_parameters($_POST));                   
    }

    function remove_current_page() {
      $last_entry_position = sizeof($this->path) - 1;
      if ($this->path[$last_entry_position]['page'] == basename($_SERVER['PHP_SELF'])) {
        unset($this->path[$last_entry_position]);
      }
    }
    
    function remove_page($history = 0) {
      array_splice($this->path, (sizeof($this->path) - 1 - $history), 1);
    }    

    function set_snapshot($page = '') {
      global $request_type;

      if (is_array($page)) {
        $this->snapshot = array('page' => $page['page'],
                                'mode' => $page['mode'],
                                'get' => $this->filter_parameters($page['get']),
                                'post' => $this->filter_parameters($page['post']));
      } else {
        $this->snapshot = array('page' => basename($_SERVER['PHP_SELF']),
                                'mode' => $request_type,
                                'get' => $this->filter_parameters($_GET),
                                'post' => $this->filter_parameters($_POST));
      }
    }

    function clear_snapshot() {
      $this->snapshot = array();
    }

    function set_path_as_snapshot($history = 0) {
      $pos = (sizeof($this->path)-1-$history);
      $this->snapshot = array('page' => $this->path[$pos]['page'],
                              'mode' => $this->path[$pos]['mode'],
                              'get' => $this->path[$pos]['get'],
                              'post' => $this->path[$pos]['post']);
    }

    function debug() {
      for ($i=0, $n=sizeof($this->path); $i<$n; $i++) {
        echo $this->path[$i]['page'];
        $get_string = '';
        reset($this->path[$i]['get']);
        while (list($key, $value) = each($this->path[$i]['get'])) {
          $get_string .=  $key . '=' . $value . '&';
        }
        if ($get_string != '') $get_string = '?' . $get_string;
        echo substr($get_string, 0, -1);
        
        if (sizeof($this->path[$i]['post']) > 0) {
          reset($this->path[$i]['post']);
          while (list($key, $value) = each($this->path[$i]['post'])) {
            echo '&nbsp;/&nbsp;<b>' . $key . '=' . $value . '</b>';
          }
        }
        echo '<br />';
      }

      if (sizeof($this->snapshot) > 0) {
        echo '<br /><br />';

        echo $this->snapshot['mode'] . ' ' . $this->snapshot['page'] . '?' . xos_array_to_query_string($this->snapshot['get'], array(xos_session_name())) . '<br />';
      }
    }
    
    function filter_parameters($parameters) {
      $clean = array();

      if (is_array($parameters)) {
        reset($parameters);
        while (list($key, $value) = each($parameters)) {
          if (strpos($key, '_nh-dns') < 1) {
            $clean[$key] = $value;
          }
        }
      }

      return $clean;
    }    
  }
?>
