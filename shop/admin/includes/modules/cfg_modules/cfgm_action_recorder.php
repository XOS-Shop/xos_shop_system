<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : cfgm_action_recorder.php
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
//              filename: cfgm_action_recorder.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class cfgm_action_recorder {
    var $code = 'action_recorder';
    var $directory;
    var $language_directory = DIR_FS_SMARTY;
    var $key = 'MODULE_ACTION_RECORDER_INSTALLED';
    var $title;
    var $template_integration = false;

    function cfgm_action_recorder() {
      $this->directory = DIR_FS_CATALOG_MODULES . 'action_recorder/';
      $this->title = MODULE_CFG_MODULE_ACTION_RECORDER_TITLE;
      $this->box_name = MODULE_CFG_MODULE_ACTION_RECORDER_BOX_NAME;
    }
  }
?>
