<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : currencies.php
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
//              filename: currencies.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/currencies.php') == 'overwrite_all')) : 
  if (isset($currencies) && is_object($currencies)) {

    $currencies_content = '';
    $currencies_content_string = '';
    $currencies_content_noscript = '';
    reset($currencies->currencies);
    
    if (sizeof($currencies->currencies) > 1) { 
    
      $currencies_array = array();
      foreach($currencies->currencies as $key => $value) {
        $currencies_array[] = array('id' => xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('cur')) . 'cur=' . $key, $request_type, true, true, false, false, false), 'text' => $value['title']);
        if ($_SESSION['currency'] == $key) {
          $currencies_content_string .= '<span><b>' . $value['title'] .'</b></span>';
          $currencies_content_noscript .= '<a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('cur')) . 'cur=' . $key, $request_type, true, true, false, false, false) . '">' . '&nbsp; <b>' . $value['title'] . '</b></a><br />';
        } else {  
          $currencies_content_string .= '<a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('cur')) . 'cur=' . $key, $request_type, true, true, false, false, false) . '">' . $value['title'] . '</a>';
          $currencies_content_noscript .= '<a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('cur')) . 'cur=' . $key, $request_type, true, true, false, false, false) . '">' . '&nbsp; ' . $value['title'] . '</a><br />';       
        }
      }
      $currencies_content_noscript = substr($currencies_content_noscript, 0, -6);
                             
      $currencies_content = xos_draw_form('currencies', xos_href_link($_SERVER['BASENAME_PHP_SELF'], '', $request_type, false, true, false, false, false), 'get');
      $currencies_content .= xos_draw_pull_down_menu('cur', $currencies_array, xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('cur')) . 'cur=' . $_SESSION['currency'], $request_type, true, true, false, false, false), 'class="form-control input-sm" onchange="location = form.cur.options[form.cur.selectedIndex].value;"');
      $currencies_content .= '</form>';
    
      $smarty->assign(array('box_currencies_currencies' => $currencies_content,
                            'box_currencies_currencies_string' => $currencies_content_string,
                            'box_currencies_currencies_noscript' => $currencies_content_noscript));    
      $output_currencies = $smarty->fetch(SELECTED_TPL . '/includes/boxes/currencies.tpl');
                                          
      $smarty->assign('box_currencies', $output_currencies);    
    }
  }
endif;
?>
