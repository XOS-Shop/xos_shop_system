<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : password_funcs.php
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
//              filename: password_funcs.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

////
// This function validates a plain text password with a
// salted or phpass password
  function xos_validate_password($plain, $encrypted) {
    if (xos_not_null($plain) && xos_not_null($encrypted)) {
      if (xos_password_type($encrypted) == 'salt') {
        return xos_validate_old_password($plain, $encrypted);
      }

      if (!class_exists('PasswordHash')) {
        include(DIR_WS_CLASSES . 'passwordhash.php');
      }

      $hasher = new PasswordHash(10, true);

      return $hasher->CheckPassword($plain, $encrypted);
    }

    return false;
  }

////
// This function validates a plain text password with a
// salted password
  function xos_validate_old_password($plain, $encrypted) {
    if (xos_not_null($plain) && xos_not_null($encrypted)) {
// split apart the hash / salt
      $stack = explode(':', $encrypted);

      if (sizeof($stack) != 2) return false;

      if (md5($stack[1] . $plain) == $stack[0]) {
        return true;
      }
    }

    return false;
  }

////
// This function encrypts a phpass password from a plaintext
// password.
  function xos_encrypt_password($plain) {
    if (!class_exists('PasswordHash')) {
      include(DIR_WS_CLASSES . 'passwordhash.php');
    }

    $hasher = new PasswordHash(10, true);

    return $hasher->HashPassword($plain);
  }

////
// This function encrypts a salted password from a plaintext
// password.
  function xos_encrypt_old_password($plain) {
    $password = '';

    for ($i=0; $i<10; $i++) {
      $password .= xos_rand();
    }

    $salt = substr(md5($password), 0, 2);

    $password = md5($salt . $plain) . ':' . $salt;

    return $password;
  }

////
// This function returns the type of the encrpyted password
// (phpass or salt)
  function xos_password_type($encrypted) {
    if (preg_match('/^[A-Z0-9]{32}\:[A-Z0-9]{2}$/i', $encrypted) === 1) {
      return 'salt';
    }

    return 'phpass';
  }
?>