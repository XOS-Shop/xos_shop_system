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
    global $session_started, $request_type, $cats, $mans, $cots, $lng, $lang_code;
    
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
      
      // Alternative parameter delimetrs
         $param_delim = '.html/';
      // $param_delim = '/.';  
           
      $lng_code = '';
      // enable this lines if language code is needed
      // if (sizeof($lng->catalog_languages) > 1) {
      //   if (!empty($lang_code)) {       
      //     $lng_code = $lang_code . '/';
      //   } else if (!empty($_SESSION['languages_code'])) {
      //     $lng_code = $_SESSION['languages_code'] . '/';
      //   }             
      // }     
      
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
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'a' : FILENAME_DEFAULT;                          
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
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'b' : FILENAME_PRODUCT_INFO;                  
          break;
        case FILENAME_CONTENT:                
          if (array_key_exists('co', $param_array)) {      
            $name_str = $cots[$param_array['co']];      
          }         
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'c' : FILENAME_CONTENT;                  
          break;
        case FILENAME_SPECIALS:
          $name_str = SEF_URL_NAME_SPECIALS;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'd' : FILENAME_SPECIALS; 
          break; 
        case FILENAME_PRODUCTS_NEW:
          $name_str = SEF_URL_NAME_NEW_PRODUCTS;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'e' : FILENAME_PRODUCTS_NEW; 
          break;
        case FILENAME_NEWSLETTER_SUBSCRIBE:
          $name_str = SEF_URL_NAME_SUBSCRIBE_NEWSLETTER;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'f' : FILENAME_NEWSLETTER_SUBSCRIBE; 
          break;              
        case FILENAME_REVIEWS:
          $name_str = SEF_URL_NAME_REVIEWS;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'g' : FILENAME_REVIEWS; 
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
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'h' : FILENAME_PRODUCT_REVIEWS;
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
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'i' : FILENAME_PRODUCT_REVIEWS_INFO; 
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
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'k' : FILENAME_TELL_A_FRIEND; 
          break;
        case FILENAME_SHOPPING_CART:
          $name_str = SEF_URL_NAME_SHOPPING_CART;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'l' : FILENAME_SHOPPING_CART; 
          break;
        case FILENAME_LOGIN:
          $name_str = SEF_URL_NAME_LOGIN;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'm' : FILENAME_LOGIN; 
          break; 
        case FILENAME_CREATE_ACCOUNT:
          $name_str = SEF_URL_NAME_CREATE_ACCOUNT;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'n' : FILENAME_CREATE_ACCOUNT; 
          break;
        case FILENAME_PASSWORD_FORGOTTEN:
          $name_str = SEF_URL_NAME_PASSWORD_FORGOTTEN;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'o' : FILENAME_PASSWORD_FORGOTTEN; 
          break;
        case FILENAME_ADVANCED_SEARCH_AND_RESULTS:
          $name_str = SEF_URL_NAME_ADVANCED_SEARCH_AND_RESULTS;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'p' : FILENAME_ADVANCED_SEARCH_AND_RESULTS; 
          break;
        case FILENAME_SEARCH_RESULT:
          $name_str = SEF_URL_NAME_SEARCH_RESULT;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'q' : FILENAME_SEARCH_RESULT; 
          break;
        case FILENAME_COOKIE_USAGE:
          $name_str = SEF_URL_NAME_COOKIE_USAGE;                
          $page = ($trail_string = xos_sef_url_trail_converter($name_str)) ? $lng_code . $trail_string . $param_delim . 'r' : FILENAME_COOKIE_USAGE; 
          break;                                                                                                          
      } 
      
      $page = str_replace('.php', $param_delim . 'z', $page);                                                
    }    
                 
    if (xos_not_null($parameters)) {                   
      $link .= $page . '?' . xos_output_string($parameters);
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

    if (!$session_started && xos_not_null($_GET['cur']) && $add_get_currency == true) {
      $link .= $separator . xos_output_string('cur=' . $_GET['cur']);
      $separator = '&';
    }  

    if (!$session_started && xos_not_null($_GET['lnc']) && $add_get_language == true) {
      $link .= $separator . xos_output_string('lnc=' . $_GET['lnc']);
      $separator = '&';      
    }
    
    if (!$session_started && xos_not_null($_GET['tpl']) && $add_get_tpl == true) {
      $link .= $separator . xos_output_string('tpl=' . $_GET['tpl']);   
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
      $link .= $separator . xos_output_string($_sid);
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
    
      $link = rtrim(str_replace(array('=%20', '&&', '=&', '/?', '?', '&', '='), array('=', '&', '/^/', '/', '/', '/', '/'), $link), '/');

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

	  // Sprachspezifische ASCII-Ersetzungen für SEF-URLs (URL-konform)
  	$char_map = array(
  		// Lateinische Zeichen diverse Sprachen
  		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
  		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
  		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
  		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
  		'ẞ' => 'SS', 
  		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
  		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
  		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
  		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
  		'ß' => 'ss', 'ÿ' => 'y',
  
  		// Lateinische Zeichen Symbole
  		'©' => '(c)',
  
  		// Türkisch
  		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
  		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 
  
  		// Tschechisch
  		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
  		'Ž' => 'Z', 
  		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
  		'ž' => 'z', 
  
  		// Polnisch
  		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
  		'Ż' => 'Z', 
  		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
  		'ż' => 'z',
  
  		// Lettisch
  		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
  		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
  		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
  		'š' => 's', 'ū' => 'u', 'ž' => 'z',
  
  		// Transliteration Griechisch [griechisches Alphabet] nach [lateinisches Alphabet (ASCII)]
  		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
  		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
  		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
  		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
  		'Ϋ' => 'Y',
  		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
  		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
  		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
  		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
  		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        
  		// Transkription Russisch [kyrillisches Alphabet] nach Englisch [lateinisches Alphabet (ASCII)]
  		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
  		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
  		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
  		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
  		'Я' => 'Ya',
  		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
  		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
  		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
  		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
  		'я' => 'ya',
      
  		// Transkription Ukrainisch [kyrillisches Alphabet] nach Englisch [lateinisches Alphabet (ASCII)]
  		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
  		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g'      
  	);
                          
		$trail_string = str_replace(array_keys($char_map), $char_map, $trail_string); 

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
