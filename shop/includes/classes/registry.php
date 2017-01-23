<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : registry.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2014 Hanspeter Zeller
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
////////////////////////////////////////////////////////////////////////////////

  class Registry
  {
      /**
      * Object registry provides storage for shared objects
      *
      * @var array 
      */
      private static $_registry = array();
  
      /**
      * Adds a new variable to the Registry.
      *
      * @param string $key Name of the variable
      * @param mixed $value Value of the variable
      * @trigger_error
      * @return boolean
      */
      public static function set( $key, $value ) {
          if ( !self::has($key) ) {
              self::$_registry[$key] = $value;
              return true;
          } 
          else {
              trigger_error('Unable to set variable `' . $key . '`. It was already set.', E_USER_ERROR);
              return false;
          }
      }
   
      /**
      * Adds a new variables from an array to the Registry.
      *
      * @param array $array The list of variabls
      * @trigger_error
      * @return boolean
      */
      public static function setFromArray( array $array = null ) {     
          if ( !empty( $array ) ) {
              foreach( $array as $key => $value ) {
                  self::set( $key, $value );
              }
              return true;
          }
          else {
              trigger_error('Array of Variabls was empty.', E_USER_ERROR);
              return false;
          }
      }
   
      /**
      * change a variable to the Registry.
      *
      * @param string $key Name of the variable
      * @param mixed $value Value of the variable
      * @trigger_error
      * @return boolean 
      */
      public static function change( $key, $value ) {
          if ( self::has($key) ) {
              self::$_registry[$key] = $value;
              return true;
          } 
          else {
              trigger_error('Unable to change variable `' . $key . '`. It was not set.', E_USER_ERROR);
              return false;
          }
      }
   
      /**
      * Tests if given $key exists in registry
      *
      * @param string $key
      * @return boolean
      */
      public static function has( $key ) {
          return isset( self::$_registry[$key] );
      }
   
      /**
      * Returns the value of the specified $key in the Registry.
      *
      * @param string $key Name of the variable
      * @return mixed Value of the specified $key
      */
      public static function get( $key )  {
          if ( self::has( $key ) ) {
              return self::$_registry[$key];
          }
          return null;
      }
   
      /**
      * Returns the whole Registry as an array.
      *
      * @return array Whole Registry
      */
      public static function getAll() {
          return self::$_registry;
      }
  
   
  
      /**
      * Removes a variable from the Registry.
      *
      * @param string $key Name of the variable
      * @return boolean
      */
      public static function remove( $key ) {
          if ( self::has( $key ) ) {
              unset( self::$_registry[$key] );
              return true;
          }
          return false;
      }     
  
      /**
      * Removes all variables from the Registry.
      *
      * @return boolean
      */
      public static function removeAll() {
          self::$_registry = array();
          return true;
      }
   
      /**
      * Gets the number ob variables in the Registry
      *
      * @return integer
      */
      public static function size() {
          return sizeof( self::$_registry );
      }     
  
  }