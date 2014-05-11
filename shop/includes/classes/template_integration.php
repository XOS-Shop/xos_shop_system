<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : template_integration.php
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
//              Copyright (c) 2010 osCommerce
//              filename: osc_template.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class templateIntegration {
    var $_blocks = array();

    function addBlock($block, $group) {
      $this->_blocks[$group][] = $block;
    }

    function hasBlocks($group) {
      return (isset($this->_blocks[$group]) && !empty($this->_blocks[$group]));
    }

    function getBlocks($group) {
      if ($this->hasBlocks($group)) {
        return implode("\n", $this->_blocks[$group]);
      }
    }

    function buildBlocks() {

      if ( defined('TEMPLATE_BLOCK_GROUPS') && xos_not_null(TEMPLATE_BLOCK_GROUPS) ) {
        $tbgroups_array = explode(';', TEMPLATE_BLOCK_GROUPS);

        foreach ($tbgroups_array as $group) {
          $module_key = 'MODULE_' . strtoupper($group) . '_INSTALLED';

          if ( defined($module_key) && xos_not_null(constant($module_key)) ) {
            $modules_array = explode(';', constant($module_key));

            foreach ( $modules_array as $module ) {
              $class = substr($module, 0, strrpos($module, '.'));

              if ( !class_exists($class) ) {
                if ( file_exists(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/modules/' . $group . '/' . $module) ) {
                  include(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/modules/' . $group . '/' . $module);
                }

                if ( file_exists(DIR_WS_MODULES . $group . '/' . $class . '.php') ) {
                  include(DIR_WS_MODULES . $group . '/' . $class . '.php');
                }
              }

              if ( class_exists($class) ) {
                $mb = new $class();

                if ( $mb->isEnabled() ) {
                  $mb->execute();
                }
              }
            }
          }
        }
      }
    }
  }
?>
