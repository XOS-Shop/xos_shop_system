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
  function xos_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true, $add_get_language = true, $add_get_currency = true, $add_get_tpl = true) {
    global $session_started, $request_type;
    
    $add_parameter = false;
    
    if (!xos_not_null($page)) {
      die('<br /><br /><span style="color : #ff0000;"><b>Error!</b></span><br /><br /><b>Unable to determine the page link!</b><br /><br />');
    }
    
    if ($connection == 'REQUEST_TYPE') $connection = $request_type;

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == 'true') {
        $link = HTTPS_SERVER . DIR_WS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_CATALOG;
      }
    } else {
      die('<br /><br /><span style="color : #ff0000;"><b>Error!</b></span><br /><br /><b>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL</b><br /><br />');
    }
      
    if (xos_not_null($parameters)) {
      if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) $parameters = str_replace(array('&amp;', '%2F', '%5C'), array('&', '_.~', '~._'), $parameters);
      $link .= $page . '?' . xos_output_string($parameters);
      $add_parameter = true;
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

    if (!$session_started && xos_not_null($_GET['currency']) && $add_get_currency == true) {
      $link .= $separator . xos_output_string('currency=' . $_GET['currency']);
      $add_parameter = true;
      $separator = '&';
    }  

    if (!$session_started && xos_not_null($_GET['language']) && $add_get_language == true) {
      $link .= $separator . xos_output_string('language=' . $_GET['language']);
      $add_parameter = true;
      $separator = '&';      
    }
    
    if (!$session_started && xos_not_null($_GET['tpl']) && $add_get_tpl == true) {
      $link .= $separator . xos_output_string('tpl=' . $_GET['tpl']);
      $add_parameter = true;     
    }    

// Add the session ID when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'false') && (defined('SID') && xos_not_null(SID)) ) {
      $add_parameter = true;
      $link .= $separator . xos_output_string(SID);
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
    
      while (strstr($link, '=%20')) $link = str_replace('=%20', '=', $link);

      $link = str_replace('&&', '&', $link);
      $link = str_replace('=&', '/^/', $link);
      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link); 
      
      if ($add_parameter) $link = $link . '/';

    } else {
    
      $link = str_replace(array('&amp;', '&'), array('&', '&amp;'), $link);
    
    }

    return $link;
  }

////
// The HTML image wrapper function
  function xos_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false;
    }

// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
    $image = '<img src="' . DIR_WS_CATALOG . xos_output_string($src) . '" alt="' . xos_output_string($alt) . '"';

    if (xos_not_null($alt)) {
      $image .= ' title=" ' . xos_output_string($alt) . ' "';
    }

    if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height)) ) {
      if ($image_size = @getimagesize(rawurldecode($src))) {
        if (empty($width) && xos_not_null($height)) {
          $ratio = $height / $image_size[1];
          $width = intval($image_size[0] * $ratio);
        } elseif (xos_not_null($width) && empty($height)) {
          $ratio = $width / $image_size[0];
          $height = intval($image_size[1] * $ratio);
        } elseif (empty($width) && empty($height)) {
          $width = $image_size[0];
          $height = $image_size[1];
        }
      } elseif (IMAGE_REQUIRED == 'false') {
        return false;
      }
    }

    if (xos_not_null($width) && xos_not_null($height)) {
      $image .= ' width="' . xos_output_string($width) . '" height="' . xos_output_string($height) . '"';
    }

    if (xos_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= ' />';

    return $image;
  }

////
// Output a separator either through whitespace, or with an image
  function xos_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    return xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $image, '', $width, $height);
  }

////
// Output a form
  function xos_draw_form($name, $action, $method = 'post', $parameters = '', $tokenize = false) {
    $form = '<form name="' . xos_output_string($name) . '" action="' . xos_output_string($action) . '" method="' . xos_output_string($method) . '"';

    if (xos_not_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';

    if (($tokenize == true) && isset($_SESSION['sessiontoken'])) {
      $form .= '<input type="hidden" name="formid" value="' . xos_output_string($_SESSION['sessiontoken']) . '" />';
    }

    return $form;
  }

////
// Output a form input field
  function xos_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . xos_output_string($type) . '" name="' . xos_output_string($name) . '"';

    if (xos_not_null($value)) {
      $field .= ' value="' . xos_output_string($value) . '"';
    } elseif ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= ' value="' . xos_output_string(stripslashes($GLOBALS[$name])) . '"';
    }

    if (xos_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= ' />';

    return $field;
  }

////
// Output a form password field
  function xos_draw_password_field($name, $value = '', $parameters = '') {
    $parameters .= ' maxlength="40"';
    return xos_draw_input_field($name, $value, trim($parameters), 'password', false);
  }

////
// Output a selection field - alias function for xos_draw_checkbox_field() and xos_draw_radio_field()
  function xos_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
    $selection = '<input type="' . xos_output_string($type) . '" name="' . xos_output_string($name) . '"';

    if (xos_not_null($value)) $selection .= ' value="' . xos_output_string($value) . '"';

    if ( ($checked == true) || ( isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ( ($GLOBALS[$name] == 'on') || (isset($value) && (stripslashes($GLOBALS[$name]) == $value)) ) ) ) {
      $selection .= ' checked="checked"';
    }

    if (xos_not_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= ' />';

    return $selection;
  }

////
// Output a form checkbox field
  function xos_draw_checkbox_field($name, $value = '', $checked = false, $parameters = '') {
    return xos_draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
  }

////
// Output a form radio field
  function xos_draw_radio_field($name, $value = '', $checked = false, $parameters = '') {
    return xos_draw_selection_field($name, 'radio', $value, $checked, $parameters);
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
// Hide form elements
  function xos_hide_session_id() {
    global $session_started;

    if (($session_started == true) && defined('SID') && xos_not_null(SID)) {
      return xos_draw_hidden_field(xos_session_name(), xos_session_id());
    }
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
      if ($default == $values[$i]['id']) {
        $field .= ' selected="selected"';
      }

      $field .= '>' . xos_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

////
// Creates a pull-down list of countries
  function xos_get_country_list($name, $selected = '', $parameters = '') {
    $countries_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT));
    $countries = xos_get_countries();

    for ($i=0, $n=sizeof($countries); $i<$n; $i++) {
      $countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);
    }

    return xos_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
  }
?>
