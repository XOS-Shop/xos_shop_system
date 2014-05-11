<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : sb_email.php
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
//              filename: sb_email.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class sb_email {
    var $code = 'sb_email';
    var $title;
    var $description;
    var $sort_order;
    var $icon = 'email.png';
    var $enabled = false;

    function sb_email() {
      $this->title = MODULE_SOCIAL_BOOKMARKS_EMAIL_TITLE;
      $this->public_title = MODULE_SOCIAL_BOOKMARKS_EMAIL_PUBLIC_TITLE;
      $this->description = MODULE_SOCIAL_BOOKMARKS_EMAIL_DESCRIPTION;

      if ( defined('MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS') ) {
        $this->sort_order = MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER;
        $this->enabled = (MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS == 'true');
      }
    }

    function getOutput() {

      return SEND_EMAILS == 'true' ? '<a href="' . xos_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . (int)$_GET['products_id'], 'SSL') . '"><img src="' . DIR_WS_CATALOG . DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/icons_social_bookmarks/' . $this->icon . '" style="border: 0;" title="' . xos_output_string_protected($this->public_title) . '" alt="' . xos_output_string_protected($this->public_title) . '" /></a>' : '';
    }

    function isEnabled() {
      return $this->enabled;
    }

    function getIcon() {
      return $this->icon;
    }

    function getPublicTitle() {
      return $this->public_title;
    }

    function check() {
      return defined('MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS');
    }

    function install() {
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS', 'true', '6', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER', '0', '6', '0', now())");
    }

    function remove() {
      xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS', 'MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER');
    }
  }
?>
