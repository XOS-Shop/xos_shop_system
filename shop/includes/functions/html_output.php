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
    global $session_started, $request_type, $cats, $mans, $cots, $lng;
    
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

    if (SEARCH_ENGINE_FRIENDLY_URLS == 'true' && $search_engine_safe == true && xos_not_null($parameters)) $parameters = str_replace(array('&amp;', '%2F', '%5C'), array('&', '_.~', '~._'), $parameters); 
        
    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
      if (!isset($cats)) {
        $all_cat_query = xos_db_query("select c.categories_or_pages_id as id, cpd.categories_or_pages_name as name from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "' and c.categories_or_pages_status = '1'"); 
        while ($cat = xos_db_fetch_array($all_cat_query)) {
          $cats[$cat['id']] = $cat['name'];
        }
      }
      
      if (!isset($mans)) {      
        $all_man_query = xos_db_query("select manufacturers_id as id, manufacturers_name as name from " . TABLE_MANUFACTURERS_INFO . " where languages_id = '" . (int)$_SESSION['languages_id'] . "'");       
        while ($man = xos_db_fetch_array($all_man_query)) {
          $mans[$man['id']] = $man['name'];
        }       
      }
            
      if (!isset($cots)) { 
      $all_content_query = xos_db_query("select content_id as id, name from " . TABLE_CONTENTS_DATA . " where language_id = '" . (int)$_SESSION['languages_id'] . "'"); 
        while ($cot = xos_db_fetch_array($all_content_query)) {
          $cots[$cot['id']] = $cot['name'];
        }       
      }
             
      parse_str($parameters, $param_array);
      
      if (sizeof($lng->catalog_languages) > 1 && !empty($_SESSION['languages_code'])) {
        $lng_code = $_SESSION['languages_code'] . '/';
      } else {
        $lng_code = '';
      }      
      
      switch ($page) {
        case FILENAME_DEFAULT:                 
          if (array_key_exists('c', $param_array)) {        
            foreach(explode('_', $param_array['c']) as $value) {
              $c_name_array[] = $cats[$value];
            }                    
            $name_str = implode('^', $c_name_array);                               
          } elseif (array_key_exists('m', $param_array)) {        
            $name_str = $mans[$param_array['m']];             
          } else {        
            $name_str = HEADER_TITLE_HOME;        
          }         
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/a' : FILENAME_DEFAULT;                          
          break;      
        case FILENAME_PRODUCT_INFO:        
          if (array_key_exists('c', $param_array)) {             
            foreach(explode('_', $param_array['c']) as $value) {
              $c_name_array[] = $cats[$value];
            }                  
            $name_str = implode('^', $c_name_array);     
          } elseif (array_key_exists('p', $param_array)) {              
            if (array_key_exists('m', $param_array)) {        
              $name_str = $mans[$param_array['m']];               
            } else {       
              $c_id_str = xos_get_product_path($param_array['p']);                 
              foreach(explode('_', $c_id_str) as $value) {
                $c_name_array[] = $cats[$value];
              }                        
              $name_str = implode('^', $c_name_array);                
            }
          }
          $name_str = $name_str . '^' . htmlspecialchars_decode(xos_get_products_name($param_array['p']));
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/b' : FILENAME_PRODUCT_INFO;                  
          break;
        case FILENAME_CONTENT:                
          if (array_key_exists('co', $param_array)) {      
            $name_str = $cots[$param_array['co']];      
          }         
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/c' : FILENAME_CONTENT;                  
          break;
        case FILENAME_SPECIALS:
          $name_str = SEF_URL_NAME_SPECIALS;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/d' : FILENAME_SPECIALS; 
          break; 
        case FILENAME_PRODUCTS_NEW:
          $name_str = SEF_URL_NAME_NEW_PRODUCTS;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/e' : FILENAME_PRODUCTS_NEW; 
          break;
        case FILENAME_NEWSLETTER_SUBSCRIBE:
          $name_str = SEF_URL_NAME_SUBSCRIBE_NEWSLETTER;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/f' : FILENAME_NEWSLETTER_SUBSCRIBE; 
          break;              
        case FILENAME_REVIEWS:
          $name_str = SEF_URL_NAME_REVIEWS;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/g' : FILENAME_REVIEWS; 
          break;                            
        case FILENAME_PRODUCT_REVIEWS:            
          if (array_key_exists('m', $param_array)) {        
            $name_str = $mans[$param_array['m']];               
          } else {       
            $c_id_str = xos_get_product_path($param_array['p']);                 
            foreach(explode('_', $c_id_str) as $value) {
              $c_name_array[] = $cats[$value];
            }                        
            $name_str = implode('^', $c_name_array);                
          }
          $name_str = $name_str . '^' . htmlspecialchars_decode(xos_get_products_name($param_array['p'])) . '^' . SEF_URL_NAME_REVIEWS;
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/h' : FILENAME_PRODUCT_REVIEWS;
          break; 
        case FILENAME_PRODUCT_REVIEWS_INFO:
          if (array_key_exists('m', $param_array)) {        
            $name_str = $mans[$param_array['m']];               
          } else {       
            $c_id_str = xos_get_product_path($param_array['p']);                 
            foreach(explode('_', $c_id_str) as $value) {
              $c_name_array[] = $cats[$value];
            }                        
            $name_str = implode('^', $c_name_array);                
          }
          $name_str = $name_str . '^' . htmlspecialchars_decode(xos_get_products_name($param_array['p'])) . '^' . SEF_URL_NAME_REVIEWS;               
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/i' : FILENAME_PRODUCT_REVIEWS_INFO; 
          break;
        case FILENAME_TELL_A_FRIEND:  
          if (array_key_exists('m', $param_array)) {        
            $name_str = $mans[$param_array['m']];               
          } else {       
            $c_id_str = xos_get_product_path($param_array['p']);                 
            foreach(explode('_', $c_id_str) as $value) {
              $c_name_array[] = $cats[$value];
            }                        
            $name_str = implode('^', $c_name_array);                
          }            
          $name_str = $name_str . '^' . htmlspecialchars_decode(xos_get_products_name($param_array['p'])) . '^' . SEF_URL_NAME_TELL_A_FRIEND;               
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/k' : FILENAME_TELL_A_FRIEND; 
          break;
        case FILENAME_SHOPPING_CART:
          $name_str = SEF_URL_NAME_SHOPPING_CART;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/l' : FILENAME_SHOPPING_CART; 
          break;
        case FILENAME_LOGIN:
          $name_str = SEF_URL_NAME_LOGIN;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/m' : FILENAME_LOGIN; 
          break; 
        case FILENAME_CREATE_ACCOUNT:
          $name_str = SEF_URL_NAME_CREATE_ACCOUNT;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/n' : FILENAME_CREATE_ACCOUNT; 
          break;
        case FILENAME_PASSWORD_FORGOTTEN:
          $name_str = SEF_URL_NAME_PASSWORD_FORGOTTEN;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/o' : FILENAME_PASSWORD_FORGOTTEN; 
          break;
        case FILENAME_ADVANCED_SEARCH_AND_RESULTS:
          $name_str = SEF_URL_NAME_ADVANCED_SEARCH_AND_RESULTS;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/p' : FILENAME_ADVANCED_SEARCH_AND_RESULTS; 
          break;
        case FILENAME_SEARCH_RESULT:
          $name_str = SEF_URL_NAME_SEARCH_RESULT;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/q' : FILENAME_SEARCH_RESULT; 
          break;
        case FILENAME_COOKIE_USAGE:
          $name_str = SEF_URL_NAME_COOKIE_USAGE;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . '.html/r' : FILENAME_COOKIE_USAGE; 
          break;                                                                                                          
      }                                                
    }    
                 
    if (xos_not_null($parameters)) {                   
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

// Add the session ID when moving from different HTTP and HTTPS servers, or when SESSID is not empty
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'false') ) {
      if (SESSID) {
        $_sid = SESSID;
      } elseif ( ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == 'true') ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') && (ENABLE_SSL == 'true') ) ) && HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN ) {
        $_sid = xos_session_name() . '=' . xos_session_id();
      }
    }

    if (isset($_sid)) {
      $add_parameter = true;
      $link .= $separator . xos_output_string($_sid);
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
    
      $link = str_replace(array('=%20', '&&', '=&', '/?', '?', '&', '='), array('=', '&', '/^/', '/', '/', '/', '/'), $link);    
      
      if ($add_parameter) $link = $link . '/';

    } else {
    
      $link = str_replace(array('&amp;', '&'), array('&', '&amp;'), $link);
    
    }

    return $link;
  }

////
// SEF URL trail converter
  function xos_sef_url_trail_converter($trail_string = '') {
    global $sef_url_trail_search, $sef_url_trail_replace;
  
    if (!is_array($sef_url_trail_search) || !is_array($sef_url_trail_replace) || $trail_string == '' || SEARCH_ENGINE_FRIENDLY_URLS == 'false') return(false);

    // Allgemeine ASCII-Ersetzungen (URL-konform) 
    $search = array("¢", "£", "¥", "€", "°", "™", "–", "—", "%", "/");                       
    $replace  = array("-ct-", "-GBP-", "-Yen-", "-EUR-", "-GRAD-", "-TM-", "-", "-", "-", "-");
  
    // Verbinden von allgemeinen ASCII-Ersetzungen mit sprachspezifischen ASCII-Ersetzungen aus 'smarty/catalog/languages/<sprache>.php' (URL-konform) 
    $search = array_merge($search, $sef_url_trail_search);                        
    $replace = array_merge($replace, $sef_url_trail_replace);                        

    // Alle geschützten HTML-Leerzeichen durch '-' Zeichen ersetzen
    $trail_string = preg_replace("/&(nbsp|#160);/i", "-",$trail_string);

    // Alle benannten HTML-Zeichen in ihre entsprechenden Ursprungszeichen konvertieren
    $trail_string = html_entity_decode($trail_string, ENT_NOQUOTES, 'UTF-8');

    // HTML '<br />' und '<br>' durch '-' ersetzen
    $trail_string = preg_replace("/<br(\s+)?\/?>/i","-",$trail_string);

    // HTML-Tags entfernen
    $trail_string = strip_tags($trail_string);

    // Leerzeichen und folgende Zeichen '!?,*+' durch '-' ersetzen
    $trail_string = preg_replace(array("/[\r\n\s]+/", "/[!?,\*\+]/"),"-",$trail_string);
    // Wenn der Punkt auch ersetzt werden soll diese Zeile verwenden  
    // $trail_string = preg_replace(array("/[\r\n\s]+/", "/[!?,\*\+\.]/"),"-",$trail_string);

    // Die in '$search' und '$sef_url_trail_search' definierten Zeichen durch '$replace' und '$replace, $sef_url_trail_replace' ersetzen
    $trail_string = str_replace($search, $replace,$trail_string);

    // Definiert die letztendlich zugelassenen Zeichen
    $trail_string = preg_replace("'[^a-zA-Z0-9@_\-._^~]+'", "", $trail_string); 
  
    // Mehrfach vorkommende '-' Zeichen auf ein '-' Zeichen reduzieren 
    $trail_string = preg_replace("/(-){2,}/","-", $trail_string);

// Jetzt wird '^' durch '/' ersetzt weil '/' der Wort-Trenner ist, danach werden noch eventuelle '-' vor und nach '/' sowie am Anfang und Ende der Zeichenkette entfernt
// Zusätzlich werden am Anfang und Ende der Zeichenkette noch '_', '~' und '.' entfernt, somit können auch diese Zeichen für die Erkennung verwendet werden. Beispiel:($trail_string . '~/' : FILENAME_DEFAULT)
    $trail_string = str_replace(array("^", "-/", "/-"), "/", $trail_string);
    $trail_string = trim($trail_string,"-_~.");  

    return($trail_string);
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
    } elseif (isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && $reinsert_value == true) {
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

    if ($session_started == true && SESSID) {
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
