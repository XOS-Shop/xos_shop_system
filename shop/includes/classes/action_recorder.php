<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : action_recorder.php
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
//              filename: action_recorder.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class actionRecorder {
    var $_module;
    var $_user_id;
    var $_user_name;

    function actionRecorder($module, $user_id = null, $user_name = null) {

      $module = xos_sanitize_string(str_replace(' ', '', $module));

      if (defined('MODULE_ACTION_RECORDER_INSTALLED') && xos_not_null(MODULE_ACTION_RECORDER_INSTALLED)) {
        if (xos_not_null($module) && in_array($module . '.' . substr(basename($_SERVER['PHP_SELF']), (strrpos(basename($_SERVER['PHP_SELF']), '.')+1)), explode(';', MODULE_ACTION_RECORDER_INSTALLED))) {
          if (!class_exists($module)) {
            if (file_exists(DIR_WS_MODULES . 'action_recorder/' . $module . '.' . substr(basename($_SERVER['PHP_SELF']), (strrpos(basename($_SERVER['PHP_SELF']), '.')+1)))) {
              include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/action_recorder/' . $module . '.' . substr(basename($_SERVER['PHP_SELF']), (strrpos(basename($_SERVER['PHP_SELF']), '.')+1)));
              include(DIR_WS_MODULES . 'action_recorder/' . $module . '.' . substr(basename($_SERVER['PHP_SELF']), (strrpos(basename($_SERVER['PHP_SELF']), '.')+1)));
            } else {
              return false;
            }
          }
        } else {
          return false;
        }
      } else {
        return false;
      }

      $this->_module = $module;

      if (!empty($user_id) && is_numeric($user_id)) {
        $this->_user_id = $user_id;
      }

      if (!empty($user_name)) {
        $this->_user_name = $user_name;
      }

      $GLOBALS[$this->_module] = new $module();
      $GLOBALS[$this->_module]->setIdentifier();
    }

    function canPerform() {
      if (xos_not_null($this->_module)) {
        return $GLOBALS[$this->_module]->canPerform($this->_user_id, $this->_user_name);
      }

      return false;
    }

    function getTitle() {
      if (xos_not_null($this->_module)) {
        return $GLOBALS[$this->_module]->title;
      }
    }

    function getIdentifier() {
      if (xos_not_null($this->_module)) {
        return $GLOBALS[$this->_module]->identifier;
      }
    }

    function record($success = true) {
      if (xos_not_null($this->_module)) {
        xos_db_query("insert into " . TABLE_ACTION_RECORDER . " (module, user_id, user_name, identifier, success, date_added) values ('" . xos_db_input($this->_module) . "', '" . (int)$this->_user_id . "', '" . xos_db_input($this->_user_name) . "', '" . xos_db_input($this->getIdentifier()) . "', '" . ($success == true ? 1 : 0) . "', now())");
      }
    }

    function expireEntries() {
      if (xos_not_null($this->_module)) {
        return $GLOBALS[$this->_module]->expireEntries();
      }
    }
    
    function check() {
      if (xos_not_null($this->_module)) {
        return $GLOBALS[$this->_module]->check();
      }
    }    
  }
?>
