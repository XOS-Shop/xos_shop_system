<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_currencies.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_currencies.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'new':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_CURRENCY . '</b>';

      $form_tag = xos_draw_form('currencies', FILENAME_CURRENCIES, 'page=' . $_GET['page'] . (isset($cInfo) ? '&cID=' . $cInfo->currencies_id : '') . '&action=insert');
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      
      $languages = xos_get_languages();
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {             
        $contents[] = array('text' => '<br />&nbsp;<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']));
        $contents[] = array('text' => TEXT_INFO_CURRENCY_TITLE . '<br /><div class="form-group">' . xos_draw_input_field('title[' . $languages[$i]['id'] . ']', '', 'class="form-control"') . '</div>');
        $contents[] = array('text' => TEXT_INFO_CURRENCY_SYMBOL_LEFT . '<br /><div class="form-group">' . xos_draw_input_field('symbol_left[' . $languages[$i]['id'] . ']', '', 'class="form-control"') . '</div>');
        $contents[] = array('text' => TEXT_INFO_CURRENCY_SYMBOL_RIGHT . '<br /><div class="form-group">' . xos_draw_input_field('symbol_right[' . $languages[$i]['id'] . ']', '', 'class="form-control"') . '</div>');
        $contents[] = array('text' => TEXT_INFO_CURRENCY_DECIMAL_POINT . '<br /><div class="form-group">' . xos_draw_input_field('decimal_point[' . $languages[$i]['id'] . ']', '', 'class="form-control"') . '</div>');
        $contents[] = array('text' => TEXT_INFO_CURRENCY_THOUSANDS_POINT . '<br /><div class="form-group">' . xos_draw_input_field('thousands_point[' . $languages[$i]['id'] . ']', '', 'class="form-control"') . '</div>');     
      }

      $contents[] = array('text' => '<br />&nbsp;<br />&nbsp;<br />' . TEXT_INFO_CURRENCY_CODE . '<br /><div class="form-group">' . xos_draw_input_field('code', '', 'class="form-control"') . '</div>');
      $contents[] = array('text' => TEXT_INFO_CURRENCY_DECIMAL_PLACES . '<br /><div class="form-group">' . xos_draw_input_field('decimal_places', '', 'class="form-control"') . '</div>');
      $contents[] = array('text' => TEXT_INFO_CURRENCY_VALUE . '<br /><div class="form-group">' . xos_draw_input_field('value', '', 'class="form-control"') . '</div>');
      $contents[] = array('text' => '<div class="checkbox"><label>' . xos_draw_checkbox_field('default') . ' ' . TEXT_INFO_SET_AS_DEFAULT . '</label></div>');
      $contents[] = array('text' => '<br /><a href="" onclick="currencies.submit(); return false" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_INSERT . ' ">' . BUTTON_TEXT_INSERT . '</a><a href="' . xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $_GET['cID']) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    case 'edit':
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_CURRENCY . '</b>';

      $form_tag = xos_draw_form('currencies', FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      
      $languages = xos_get_languages();
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $currency_query = xos_db_query("select title, symbol_left, symbol_right, decimal_point, thousands_point from " . TABLE_CURRENCIES . " where currencies_id = '" . $cInfo->currencies_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
        $currency = xos_db_fetch_array($currency_query);
        $contents[] = array('text' => '<br />&nbsp;<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']));      
        $contents[] = array('text' => TEXT_INFO_CURRENCY_TITLE . '<br /><div class="form-group">' . xos_draw_input_field('title[' . $languages[$i]['id'] . ']', $currency['title'], 'class="form-control"') . '</div>');
        $contents[] = array('text' => TEXT_INFO_CURRENCY_SYMBOL_LEFT . '<br /><div class="form-group">' . xos_draw_input_field('symbol_left[' . $languages[$i]['id'] . ']', $currency['symbol_left'], 'class="form-control"') . '</div>');
        $contents[] = array('text' => TEXT_INFO_CURRENCY_SYMBOL_RIGHT . '<br /><div class="form-group">' . xos_draw_input_field('symbol_right[' . $languages[$i]['id'] . ']', $currency['symbol_right'], 'class="form-control"') . '</div>');
        $contents[] = array('text' => TEXT_INFO_CURRENCY_DECIMAL_POINT . '<br /><div class="form-group">' . xos_draw_input_field('decimal_point[' . $languages[$i]['id'] . ']', $currency['decimal_point'], 'class="form-control"') . '</div>');
        $contents[] = array('text' => TEXT_INFO_CURRENCY_THOUSANDS_POINT . '<br /><div class="form-group">' . xos_draw_input_field('thousands_point[' . $languages[$i]['id'] . ']', $currency['thousands_point'], 'class="form-control"') . '</div>');        
      }
      
      $contents[] = array('text' => '<br />&nbsp;<br />&nbsp;<br />' . TEXT_INFO_CURRENCY_CODE . '<br /><div class="form-group">' . xos_draw_input_field('code', $cInfo->code, 'class="form-control"') . '</div>');
      $contents[] = array('text' => TEXT_INFO_CURRENCY_DECIMAL_PLACES . '<br /><div class="form-group">' . xos_draw_input_field('decimal_places', $cInfo->decimal_places, 'class="form-control"') . '</div>');      
      $contents[] = array('text' => TEXT_INFO_CURRENCY_VALUE . '<br /><div class="form-group">' . xos_draw_input_field('value', $cInfo->value, 'class="form-control"') . '</div>');
      if (DEFAULT_CURRENCY != $cInfo->code) $contents[] = array('text' => '<div class="checkbox"><label>' . xos_draw_checkbox_field('default') . ' ' . TEXT_INFO_SET_AS_DEFAULT . '</label></div>');
      $contents[] = array('text' => '<br /><a href="" onclick="currencies.submit(); return false" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_UPDATE . ' ">' . BUTTON_TEXT_UPDATE . '</a><a href="' . xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    case 'delete':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_CURRENCY . '</b>';

      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $cInfo->title . '</b>');
      $contents[] = array('text' => '<br />' . '<a href="' . xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a>' . (($remove_currency) ? '<a href="' . xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id . '&action=deleteconfirm') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a>' : '') . '<br />&nbsp;');
      break;
    default:
      if (is_object($cInfo)) {
        $heading_title = '<b>' . $cInfo->title . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id . '&action=edit') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_EDIT . ' ">' . BUTTON_TEXT_EDIT . '</a><a href="' . xos_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id . '&action=delete') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a>');
        
        $languages = xos_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $currency_query = xos_db_query("select title, symbol_left, symbol_right, decimal_point, thousands_point from " . TABLE_CURRENCIES . " where currencies_id = '" . $cInfo->currencies_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          $currency = xos_db_fetch_array($currency_query);               
          $contents[] = array('text' => '<br />&nbsp;<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']));
          $contents[] = array('text' => TEXT_INFO_CURRENCY_TITLE . ' ' . $currency['title']);
          $contents[] = array('text' => '<br />' . TEXT_INFO_CURRENCY_SYMBOL_LEFT . ' ' . $currency['symbol_left']);
          $contents[] = array('text' => TEXT_INFO_CURRENCY_SYMBOL_RIGHT . ' ' . $currency['symbol_right']);
          $contents[] = array('text' => '<br />' . TEXT_INFO_CURRENCY_DECIMAL_POINT . ' ' . $currency['decimal_point']);
          $contents[] = array('text' => TEXT_INFO_CURRENCY_THOUSANDS_POINT . ' ' . $currency['thousands_point']);                  
        }
        
        $contents[] = array('text' => '<br />&nbsp;<br />&nbsp;<br />' . TEXT_INFO_CURRENCY_CODE . ' ' . $cInfo->code);
        $contents[] = array('text' => TEXT_INFO_CURRENCY_DECIMAL_PLACES . ' ' . $cInfo->decimal_places);        
        $contents[] = array('text' => TEXT_INFO_CURRENCY_VALUE . ' ' . number_format($cInfo->value, 8));
        $contents[] = array('text' => TEXT_INFO_CURRENCY_EXAMPLE . ' ' . $currencies->format('30') . ' = ' . $currencies->format('30', true, $cInfo->code));
        $contents[] = array('text' => TEXT_INFO_CURRENCY_LAST_UPDATED . ' ' . xos_date_short($cInfo->last_updated));        
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_currencies = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_currencies.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_currencies', $output_infobox_currencies);
endif;
?>
