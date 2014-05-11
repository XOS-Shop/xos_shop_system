<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : search.php
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
//              filename: search.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/search.php') == 'overwrite_all')) : 
  if (CACHE_LEVEL > 0 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L1|box_search|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'];
  }
  
  if(!$smarty->isCached(SELECTED_TPL . '/includes/boxes/search.tpl', $cache_id)){

    $js_check_keywords_string .= '<script type="text/javascript">' . "\n" .
                                 '/* <![CDATA[ */' . "\n" .
                                 'function check_keywords() {' . "\n" .
                                 '  var error_message = "' . JS_ERROR . '";' . "\n" .               
                                 '  var keywords = document.quick_find.keywords.value;' . "\n\n" .

                                 '  String.prototype.trim = function () {' . "\n" .
                                 '    return (this.replace(/\s+$/,"").replace(/^\s+/,""));' . "\n" .
                                 '  };' . "\n\n" .

                                 '  if ((keywords == "") || (keywords.trim().length < 1)) {' . "\n" .
                                 '    error_message = error_message + "* ' . JS_ERROR_KEYWORD_FIELD_EMPTY . '\n";' . "\n" .               
                                 '    alert(error_message);' . "\n" .
                                 '    document.quick_find.keywords.focus();' . "\n" .
                                 '    return false;' . "\n" .                               
                                 '  }' . "\n" .
                                 '}' . "\n" .
                                 '/* ]]> */' . "\n" .
                                 '</script> ' . "\n"; 

    $hidden_get_variables = '';
    if (!$session_started && xos_not_null($_GET['currency'])) {
      $hidden_get_variables .= xos_draw_hidden_field('currency', $_GET['currency']);
    }  

    if (!$session_started && xos_not_null($_GET['language'])) {
      $hidden_get_variables .= xos_draw_hidden_field('language', $_GET['language']);
    }

    if (!$session_started && xos_not_null($_GET['tpl'])) {
      $hidden_get_variables .= xos_draw_hidden_field('tpl', $_GET['tpl']);
    } 
                 
    $smarty->assign(array('box_search_link_filename_advanced_search_and_results' => xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS),
                          'box_search_js_check_keywords' => $js_check_keywords_string,
                          'box_search_link_quick_search_suggest' => str_replace('&amp;', '&', substr(xos_href_link(FILENAME_QUICK_SEARCH_SUGGEST, '', $request_type, true, false), -4) == '.php' ? xos_href_link(FILENAME_QUICK_SEARCH_SUGGEST, '', $request_type, true, false) . '?keywords=' : xos_href_link(FILENAME_QUICK_SEARCH_SUGGEST, '', $request_type, true, false) . '&keywords='),                           
                          'box_search_imput_field' => xos_draw_input_field('keywords', '', 'id="box_search_keywords" size="10" maxlength="30" style="width: 118px"', 'text', false),
                          'box_search_form_begin' => xos_draw_form('quick_find', xos_href_link(FILENAME_SEARCH_RESULT, '', $request_type, false, true, false, false, false), 'get', 'onsubmit="return check_keywords(this);"') . $hidden_get_variables . xos_hide_session_id(),
                          'box_search_form_end' => '</form>'));
  }
  
  $output_search = $smarty->fetch(SELECTED_TPL . '/includes/boxes/search.tpl', $cache_id);

  $smarty->caching = 0;                            
                        
  $smarty->assign('box_search', $output_search);  
endif;
?>
