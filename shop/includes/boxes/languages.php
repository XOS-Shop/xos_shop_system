<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : languages.php
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
//              filename: languages.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/languages.php') == 'overwrite_all')) :

  $languages_string = '';
  $languages_list = '';
  reset($lng->catalog_languages);
  
  if (sizeof($lng->catalog_languages) > 1) { 

    foreach($lng->catalog_languages as $lang_code => $value) {
      $languages_string .= ' <a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('lnc', 'dfrom', 'dto')) . 'lnc=' . $lang_code, $request_type, true, true, false, false, false) . '">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $value['directory'] . '/' . $value['image'], $value['name']) . '</a> ';
      
      if ($value['id'] == $_SESSION['languages_id']) {
        $language_used .= '<span>' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $value['directory'] . '/' . $value['image'], $value['name']) . '</span>';
      } else {
        $languages_list .= '<a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('lnc', 'dfrom', 'dto')) . 'lnc=' . $lang_code, $request_type, true, true, false, false, false) . '">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $value['directory'] . '/' . $value['image'], $value['name']) . '</a>';
      }
    }

    $smarty->assign(array('box_languages_language_used' => $language_used,
                          'box_languages_languages_string' => $languages_string,
                          'box_languages_languages_list' => $languages_list));
                          
    $output_languages = $smarty->fetch(SELECTED_TPL . '/includes/boxes/languages.tpl');
  
    $smarty->assign('box_languages', $output_languages);
  }
endif;
?>
