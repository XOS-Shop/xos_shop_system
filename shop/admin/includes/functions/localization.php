<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : localization.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2017 Hanspeter Zeller
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
//              filename: localization.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  function quote_fixer_currency($code, $base = DEFAULT_CURRENCY) {
    $url = 'https://api.fixer.io/latest?base=' . $base . '&symbols=' . $code;
    $currency = get_external_content($url, 3, false);
    $currency = json_decode($currency, true);
   
    if ($base == $code) $currency['rates'][$code] = 1;
   
    if (isset($currency['rates'][$code])) {
      return $currency['rates'][$code];
    } else {
      return false;
    }
  }

  function quote_xe_currency($to, $from = DEFAULT_CURRENCY) {
    $url = 'http://www.xe.com/currencyconverter/convert/?Amount=1&From=' . $from . '&To=' . $to;
    $page = get_external_content($url, 3, false);

    preg_match('/[0-9.]+\s*' . $from . '\s*=\s*([0-9.]+)\s*' . $to . '/', $page, $match);  

    if (sizeof($match) > 0) {
      return $match[1];
    } else {
      return false;
    }
  }
  
  function get_external_content($url, $timeout='3', $rss=true) {
    $data = '';

    if (function_exists('curl_version') && is_array(curl_version())) {
      $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
              curl_close($ch);

      if ($data && !check_valid_xml($data, $rss))
        $data='';
    }
    if ($data=='' && function_exists('file_get_contents')) {
      $opts = array('http' => array('method'=>"GET", 'header'=>"Content-Type: text/html; charset=UTF-8", 'timeout' => $timeout));
      $context = stream_context_create($opts); 
      $data = @file_get_contents($url, false, $context);

      if ($data && !check_valid_xml($data, $rss))
        $data='';
    }
    if ($data=='' && function_exists('fopen')) {
      ini_set('default_socket_timeout', $timeout);  
      $fp = @fopen($url, 'r');
      if (is_resource($fp)) {
        $data = @stream_get_contents($fp);
        fclose($fp);
      }

      if ($data && !check_valid_xml($data, $rss))
        $data='';
    }
        
    return $data;
  }
  
  function check_valid_xml($data, $rss) {
    $valid = true;
    
    if (!$rss)
      return $valid;
      
    libxml_use_internal_errors(true);
    libxml_clear_errors();
    
    if (class_exists('SimpleXmlElement')) {
      $xml = simplexml_load_string($data);
      if (sizeof(libxml_get_errors()) > 0) {
        $valid = false;
      }
    } else {
      $xml = new DOMDocument;
      $xml->load($data);
      if (sizeof(libxml_get_errors()) > 0) {      
        $valid = false;
      }
    }
    libxml_clear_errors();
    
    return $valid;
  }