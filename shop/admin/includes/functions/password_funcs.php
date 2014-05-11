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

////
// This function produces a crypted string using the APR-MD5 algorithm
// Source: http://www.php.net/crypt
  function xos_crypt_apr_md5($password, $salt = null) {
    if (empty($salt)) {
      $salt_string = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

      $salt = '';

      for ($i = 0; $i < 8; $i++) {
        $salt .= $salt_string[rand(0, 61)];
      }
    }

    $len = strlen($password);

    $result = $password . '$apr1$' . $salt;

    $bin = pack('H32', md5($password . $salt . $password));

    for ($i=$len; $i>0; $i-=16) {
      $result .= substr($bin, 0, min(16, $i));
    }

    for ($i=$len; $i>0; $i>>= 1) {
      $result .= ($i & 1) ? chr(0) : $password[0];
    }

    $bin = pack('H32', md5($result));

    for ($i=0; $i<1000; $i++) {
      $new = ($i & 1) ? $password : $bin;

      if ($i % 3) {
        $new .= $salt;
      }

      if ($i % 7) {
        $new .= $password;
      }

      $new .= ($i & 1) ? $bin : $password;

      $bin = pack('H32', md5($new));
    }

    for ($i=0; $i<5; $i++) {
      $k = $i + 6;
      $j = $i + 12;

      if ($j == 16) {
        $j = 5;
      }

      $tmp = $bin[$i] . $bin[$k] . $bin[$j] . $tmp;
    }

    $tmp = chr(0) . chr(0) . $bin[11] . $tmp;
    $tmp = strtr(strrev(substr(base64_encode($tmp), 2)), 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/', './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');

    return '$apr1$' . $salt . '$' . $tmp;
  }
?>