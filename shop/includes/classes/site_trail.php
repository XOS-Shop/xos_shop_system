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
      $trail_string = '  <ol class="breadcrumb-list">' . PHP_EOL;
      
      $json_ld_str = PHP_EOL . '<script type="application/ld+json">' . PHP_EOL .
                               ' {' . PHP_EOL .
                               '   "@context": "http://schema.org/",' . PHP_EOL .
                               '   "@type": "BreadcrumbList",' . PHP_EOL .
                               '   "itemListElement": [' . PHP_EOL;      

      for ($i=0, $n=sizeof($this->_trail); $i<$n; $i++) {
        $trail_string .= '    <li>' . PHP_EOL; 
            
        if (!empty($this->_trail[$i]['link'])) {
          if (($i+1) < $n) {
            $trail_string .= '      <a href="' . $this->_trail[$i]['link'] . '" class="header-navi">' . PHP_EOL .
                             '        <span>' . $this->_trail[$i]['title'] . '</span>' . PHP_EOL .
                             '      </a>' . PHP_EOL;
          } else {
            $trail_string .= '      <span class="current">' . $this->_trail[$i]['title'] . '</span>' . PHP_EOL;
          }                  
                           
          $json_ld_str .= '     {' . PHP_EOL .
                          '        "@type": "ListItem",' . PHP_EOL .
                          '        "position": "' . ($i+1) . '",' . PHP_EOL .
                          '        "item": {' . PHP_EOL .
                          '          "@id": "' . $this->_trail[$i]['link'] . '",' . PHP_EOL .
                          '          "name": "' . addcslashes($this->_trail[$i]['title'], '"') . '"' . PHP_EOL .
                          '       }' . PHP_EOL .
                          '     },' . PHP_EOL;                             
                           
                           
        } else {
          $trail_string .= '      <span>' . $this->_trail[$i]['title'] . '</span>' . PHP_EOL;         
        }

        if (($i+1) < $n) $trail_string .= '      <span>' . $separator . '</span>' . PHP_EOL;
        $trail_string .= '    </li>' . PHP_EOL;
      }
      
      if (strrpos($json_ld_str, ',') !== false) $json_ld_str = substr_replace($json_ld_str, '', strrpos($json_ld_str, ',')) . PHP_EOL;      
      
      $json_ld_str .= '   ]' . PHP_EOL .
                      ' }' . PHP_EOL .
                      '</script>' . PHP_EOL;       

      return $trail_string . '  </ol>' . $json_ld_str;
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

        if ($_SESSION['languages_code'] == '') return NULL; 

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
                '/' . $lnc_sef,
                '/' . $_SESSION['languages_code'] . '/'),
          array('?', 
                '?', 
                '', 
                '&amp;', 
                '&', 
                '', 
                '', 
                '',
                '/'),      
          $this->canonical_link());
        
        $hreflang_link_and_code = array();       
        while (list($lang_code) = each($lng->catalog_languages)) { 
          if ($_SESSION['languages_code'] != $lang_code) {
            $hreflang_link_and_code[] = array('link' => (strpos($link, '.php?') ? $link . '&amp;go=' . $lang_code : (strpos($link, '.php') ? $link . '?go=' . $lang_code : rtrim($link, '/') . '/go/' . $lang_code)),
                                              'lang_code' => $lang_code);
          }        
        }
                               
        return $hreflang_link_and_code;     
      } else { 
           
        return NULL;
      }      
    }      
  }