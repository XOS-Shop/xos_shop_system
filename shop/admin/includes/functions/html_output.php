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

////
// The HTML href link wrapper function
  function xos_href_link($page = '', $parameters = '') {
    $connection = $_SESSION['disable_ssl'] ? 'NONSSL' : 'SSL';  
    if ($page == '') {
      die('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><b>Error!</b></font><br /><br /><b>Unable to determine the page link!<br /><br />Function used:<br /><br />xos_href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_ADMIN;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == 'true') {
        $link = HTTPS_SERVER . DIR_WS_ADMIN;
      } else {
        $link = HTTP_SERVER . DIR_WS_ADMIN;
      }
    } else {
      die('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><b>Error!</b></font><br /><br /><b>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL<br /><br />Function used:<br /><br />xos_href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    if ($parameters == '') {
      $link = $link . $page . '?' . SID;
    } else {
      $link = $link . $page . '?' . $parameters . '&' . SID;
    }


    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);
    
    $link = str_replace(array('&amp;', '&'), array('&', '&amp;'), $link);

    return $link;
  }

  function xos_catalog_href_link($page = '', $parameters = '', $connection = 'NONSSL') {
    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == 'true') {
        $link = HTTPS_SERVER . DIR_WS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_CATALOG;
      }
    } else {
      die('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><b>Error!</b></font><br /><br /><b>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL<br /><br />Function used:<br /><br />xos_href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    if ($parameters == '') {
      $link .= $page;
    } else {
      $link .= $page . '?' . $parameters;
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);
    
    $link = str_replace(array('&amp;', '&'), array('&', '&amp;'), $link);
    
    return $link;
  }

////
// The HTML image wrapper function
  function xos_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    $image = '<img src="' . xos_output_string($src) . '" alt="' . xos_output_string($alt) . '"';

    if (xos_not_null($alt)) {
      $image .= ' title=" ' . xos_output_string($alt) . ' "';
    }

    if (xos_not_null($width) && xos_not_null($height)) {
      $image .= ' width="' . xos_output_string($width) . '" height="' . xos_output_string($height) . '"';
    }

    if (xos_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= ' />';

    return $image;
  }

////
// Draw a 1 pixel black line
  function xos_black_line() {
    return xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/pixel_black.gif', '', '100%', '1');
  }

////
// Output a separator either through whitespace, or with an image
  function xos_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    return xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/' . $image, '', $width, $height);
  }

////
// Output a form
  function xos_draw_form($name, $action, $parameters = '', $method = 'post', $params = '') {
    $form = '<form name="' . xos_output_string($name) . '" action="';
    if (xos_not_null($parameters)) {
      $form .= xos_href_link($action, $parameters);
    } else {
      $form .= xos_href_link($action);
    }
    $form .= '" method="' . xos_output_string($method) . '"';
    if (xos_not_null($params)) {
      $form .= ' ' . $params;
    }
    $form .= '>';

    return $form;
  }

////
// Output a form input field
  function xos_draw_input_field($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . xos_output_string($type) . '" name="' . xos_output_string($name) . '"';

    if (xos_not_null($value)) {
      $field .= ' value="' . xos_output_string($value) . '"';
    } elseif (isset($GLOBALS[$name]) && ($reinsert_value == true) && is_string($GLOBALS[$name])) {
      $field .= ' value="' . xos_output_string(stripslashes($GLOBALS[$name])) . '"'; 
    }

    if (xos_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= ' />';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

////
// Output a form password field
  function xos_draw_password_field($name, $value = '', $required = false) {
    $field = xos_draw_input_field($name, $value, 'maxlength="40"', $required, 'password', false);

    return $field;
  }

////
// Output a form filefield
  function xos_draw_file_field($name, $required = false) {
    $field = xos_draw_input_field($name, '', '', $required, 'file');

    return $field;
  }

////
// Output a selection field - alias function for xos_draw_checkbox_field() and xos_draw_radio_field()
  function xos_draw_selection_field($name, $type, $value = '', $checked = false, $compare = '', $parameter = '') {
    $selection = '<input type="' . $type . '" name="' . $name . '"';
    if ($value != '') {
      $selection .= ' value="' . $value . '"';
    }
    if ( ($checked == true) || ($GLOBALS[$name] == 'on') || ($value && ($GLOBALS[$name] == $value)) || ($value && ($value == $compare)) ) {
      $selection .= ' checked="checked"';
    }
    if ($parameter != '') {
      $selection .= ' ' . $parameter;
    }
    $selection .= ' />';

    return $selection;
  }

////
// Output a form checkbox field
  function xos_draw_checkbox_field($name, $value = '', $checked = false, $compare = '', $parameter = '') {
    return xos_draw_selection_field($name, 'checkbox', $value, $checked, $compare, $parameter);
  }

////
// Output a form radio field
  function xos_draw_radio_field($name, $value = '', $checked = false, $compare = '', $parameter = '') {
    return xos_draw_selection_field($name, 'radio', $value, $checked, $compare, $parameter);
  }
  
////
// Output a form textarea field
  function xos_draw_textarea_field($name, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    $field = '<textarea name="' . xos_output_string($name) . '" cols="' . xos_output_string($width) . '" rows="' . xos_output_string($height) . '"';

    if (xos_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (xos_not_null($text)) {
      $field .= xos_output_string_protected($text);
    } elseif ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= xos_output_string_protected(stripslashes($GLOBALS[$name]));
    }

    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function xos_draw_hidden_field($name, $value = '', $parameters = '') {
    $field = '<input type="hidden" name="' . xos_output_string($name) . '"';

    if (xos_not_null($value)) {
      $field .= ' value="' . xos_output_string($value) . '"';
    } elseif (isset($GLOBALS[$name]) && is_string($GLOBALS[$name])) {
      $field .= ' value="' . xos_output_string(stripslashes($GLOBALS[$name])) . '"';
    }

    if (xos_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= ' />';

    return $field;
  }

////
// Output a form pull down menu
  function xos_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    $field = '<select name="' . xos_output_string($name) . '"';

    if (xos_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . xos_output_string($values[$i]['id']) . '"';
      if (xos_not_null($values[$i]['params'])) $field .= ' ' . $values[$i]['params'];
      if ($default == $values[$i]['id']) $field .= ' selected="selected"';

      $field .= '>' . xos_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }
?>
