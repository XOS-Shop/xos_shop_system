<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : html_output.php
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
//              filename: html_output.php                     
//
//              Released under the GNU General Public License
////////////////////////////////////////////////////////////////////////////////

  function xos_draw_input_field($name, $text = '', $type = 'text', $parameters = '', $reinsert_value = true) {
    $field = '<input type="' . $type . '" name="' . $name . '"';
    if ( ($key = $GLOBALS[$name]) || ($key = $GLOBALS['_GET'][$name]) || ($key = $GLOBALS['_POST'][$name]) || ($key = $GLOBALS['_SESSION'][$name]) && ($reinsert_value) ) {
      $field .= ' value="' . $key . '"';
    } elseif ($text != '') {
      $field .= ' value="' . $text . '"';
    }
    if ($parameters) $field.= ' ' . $parameters;
    $field .= ' />';

    return $field;
  }

  function xos_draw_password_field($name, $text = '') {
    return xos_draw_input_field($name, $text, 'password', '', false);
  }

  function xos_draw_hidden_field($name, $value) {
    return '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
  }

  function xos_draw_selection_field($name, $type, $value = '', $checked = false) {
    $selection = '<input type="' . $type . '" name="' . $name . '"';
    if ($value != '') $selection .= ' value="' . $value . '"';  
    if ( ($checked == true) || ($GLOBALS['_POST'][$name] == 'on') || ($value == 'on') || ($value && $GLOBALS['_POST'][$name] == $value) ) {
      $selection .= ' checked="checked"';
    }
    $selection .= ' />';

    return $selection;
  }

  function xos_draw_checkbox_field($name, $value = '', $checked = false) {
    return xos_draw_selection_field($name, 'checkbox', $value, $checked);
  }

  function xos_draw_radio_field($name, $value = '', $checked = false) {
    return xos_draw_selection_field($name, 'radio', $value, $checked);
  }
?>
