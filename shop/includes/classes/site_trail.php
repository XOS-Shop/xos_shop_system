<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : site_trail.php
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
//              filename: breadcrumb.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class site_trail {
    var $_trail;

    function __construct() {
      $this->reset();
    }

    function reset() {
      $this->_trail = array();
      $this->_canonical_link = '';
    }

    function add($title, $link = '') {
      $this->_trail[] = array('title' => $title, 'link' => $link);
      if ($link != '') $this->_canonical_link = $link; 
    }

    function breadcrumb_trail($separator = ' - ') {
      $trail_string = '';

      for ($i=0, $n=sizeof($this->_trail); $i<$n; $i++) {
        if (isset($this->_trail[$i]['link']) && xos_not_null($this->_trail[$i]['link'])) {
          $trail_string .= '<a href="' . $this->_trail[$i]['link'] . '" class="header-navi">' . $this->_trail[$i]['title'] . '</a>';
        } else {
          $trail_string .= $this->_trail[$i]['title'];
        }

        if (($i+1) < $n) $trail_string .= $separator;
      }

      return $trail_string;
    }
    
    function title_trail($separator = ' - ') {
      $trail_string = '';

      for ($i=1, $n=sizeof($this->_trail); $i<$n; $i++) {
        $trail_string .= $this->_trail[$i]['title'];
        if (($i+1) < $n) $trail_string .= $separator;
      }

      return $trail_string;
    }
    
    function canonical_link() {
    
      if (session_id() == '') return $this->_canonical_link; 

      $id = session_name() . '=' . session_id();
      $id_sef = session_name() . '/' . session_id();

      $link = str_replace(
        array('?' . $id . '&amp;', 
              '?' . $id . '&', 
              '?' . $id, 
              '&amp;' . $id . '&amp;', 
              '&' . $id . '&', 
              '&amp;' . $id, 
              '&' . $id, 
              '/' . $id_sef),
        array('?', 
              '?', 
              '', 
              '&amp;', 
              '&', 
              '', 
              '', 
              ''),      
        $this->_canonical_link);
      
      return $link;
    }
    
    function hreflang_link_and_code() {
      global $lng;
    
      reset($lng->catalog_languages);
      
      if (sizeof($lng->catalog_languages) > 1) {      

        if ($_SESSION['languages_code'] == '') return false; 

        $lnc = 'lnc=' . $_SESSION['languages_code'];
        $lnc_sef = 'lnc/' . $_SESSION['languages_code'];

        $link = str_replace(
          array('?' . $lnc . '&amp;', 
                '?' . $lnc . '&', 
                '?' . $lnc, 
                '&amp;' . $lnc . '&amp;', 
                '&' . $lnc . '&', 
                '&amp;' . $lnc, 
                '&' . $lnc, 
                '/' . $lnc_sef),
          array('?', 
                '?', 
                '', 
                '&amp;', 
                '&', 
                '', 
                '', 
                ''),      
          $this->canonical_link());
        
        $hreflang_link_and_code = array();       
        while (list($lang_code) = each($lng->catalog_languages)) { 
          if ($_SESSION['languages_code'] != $lang_code) {
            $hreflang_link_and_code[] = array('link' => (strpos($link, '.php?') ? $link . '&amp;lnc=' . $lang_code : (strpos($link, '.php') ? $link . '?lnc=' . $lang_code : rtrim($link, '/') . '/lnc/' . $lang_code)),
                                              'lang_code' => $lang_code);
          }        
        }
                               
        return $hreflang_link_and_code;      
      } else { 
           
        return false;
      }      
    }      
  }