<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : cfg_modules.php
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
//------------------------------------------------------------------------------
// this file is based on: 
//              osCommerce, Open Source E-Commerce Solutions
//              http://www.oscommerce.com
//              Copyright (c) 2010 osCommerce
//              filename: cfg_modules.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class cfg_modules {
    var $_modules = array();

    function cfg_modules() {

      $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
      $directory = DIR_WS_MODULES . 'cfg_modules';

      if ($dir = @dir($directory)) {
        while ($file = $dir->read()) {
          if (!is_dir($directory . $file)) {
            if (substr($file, strrpos($file, '.')) == $file_extension) {
              $class = substr($file, 0, strrpos($file, '.'));

              include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/cfg_modules/' . $file);
              include(DIR_WS_MODULES . 'cfg_modules/' . $class . '.php');

              $m = new $class();

              $this->_modules[] = array('code' => $m->code,
                                        'directory' => $m->directory,
                                        'language_directory' => $m->language_directory,
                                        'key' => $m->key,
                                        'title' => $m->title,
                                        'box_name' => $m->box_name,                                                                                
                                        'template_integration' => $m->template_integration);
            }
          }
        }
      }
    }

    function getAll() {
      return $this->_modules;
    }

    function get($code, $key) {
      foreach ($this->_modules as $m) {
        if ($m['code'] == $code) {
          return $m[$key];
        }
      }
    }

    function exists($code) {
      foreach ($this->_modules as $m) {
        if ($m['code'] == $code) {
          return true;
        }
      }

      return false;
    }
  }
?>
