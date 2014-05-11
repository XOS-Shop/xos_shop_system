<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : validations.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2011 Hanspeter Zeller
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
//              filename: validations.php                      
//
//              Released under the GNU General Public License   
////////////////////////////////////////////////////////////////////////////////
 

/*
// alternative version
  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : xos_validate_email
  //
  // Arguments   : email   email address to be checked
  //
  // Return      : true  - valid email address
  //               false - invalid email address
  //
  // Description : function for validating email address  
  //               Tries to use PHP built-in validator in the filter extension (from PHP 5.2), falls back to a reasonably competent regex validator
  //               Conforms approximately to RFC2822
  //               link http://www.hexillion.com/samples/#Regex Original pattern found here    
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function xos_validate_email($email) {
    if (function_exists('filter_var') && defined('FILTER_VALIDATE_EMAIL')) { //Introduced in PHP 5.2
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        $validation_result = false;
      } else {
        $validation_result = true;
      }
    } elseif (preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email)) {
      $validation_result = true;
    } else {
      $validation_result = false;
    }
    
    if ($validation_result && ENTRY_EMAIL_ADDRESS_CHECK == 'true') {
      $domain = explode('@', $email);
      if (!checkdnsrr($domain[1], "MX") && !checkdnsrr($domain[1], "A")) {
        $validation_result = false;
      }
    }    
    return $validation_result;
  }
*/  
  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : xos_validate_email
  //
  // Arguments   : email   email address to be checked
  //
  // Return      : true  - valid email address
  //               false - invalid email address
  //
  // Description : function for validating email address that conforms to RFC 822 specs
  //
  //              This function will first attempt to validate the Email address using the filter
  //              extension for performance. If this extension is not available it will
  //              fall back to a regex based validator which doesn't validate all RFC822
  //              addresses but catches 99.9% of them. The regex is based on the code found at
  //              http://www.regular-expressions.info/email.html
  //
  //              Optional validation for validating the domain name is also valid is supplied
  //              and can be enabled using the administration tool.
  //
  // Sample Valid Addresses:
  //
  //    first.last@host.com
  //    firstlast@host.to
  //    first-last@host.com
  //    first_last@host.com
  //
  // Invalid Addresses:
  //
  //    first last@host.com
  //    first@last@host.com
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function xos_validate_email($email) {
    $email = trim($email);
    if (strlen($email) > 255) {
      $valid_address = false;
    } elseif (function_exists('filter_var') && defined('FILTER_VALIDATE_EMAIL')) { //Introduced in PHP 5.2

     $valid_address = (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
    } else {
      if ( substr_count( $email, '@' ) > 1 ) {
        $valid_address = false;
      }

      if ( preg_match("/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i", $email)) {
        $valid_address = true;
      } else {
        $valid_address = false;
      }
    }

    if ($valid_address && ENTRY_EMAIL_ADDRESS_CHECK == 'true') {
      $domain = explode('@', $email);
      if (!checkdnsrr($domain[1], "MX") && !checkdnsrr($domain[1], "A")) {
        $valid_address = false;
      }
    }
    return $valid_address;
  }  
?>
