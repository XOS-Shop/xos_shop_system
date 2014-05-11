<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_countries.php
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
//              filename: countries.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_countries.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'new_from_list':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_COUNTRY_FROM_LIST . '</b>';

      $form_tag = xos_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&action=insert_from_list');
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br />' . xos_draw_pull_down_menu('country_id', xos_get_countries_from_list(), '', 'style="font-size:9px"'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_ADDRESS_FORMAT . '<br />' . xos_draw_pull_down_menu('address_format_id', xos_get_address_formats()));
      $contents[] = array('text' => '<br /><a href="" onclick="countries.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;  
    case 'new':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_COUNTRY . '</b>';

      $form_tag = xos_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&action=insert');
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      if (isset($_GET['error_name'])) {
        if (empty($_GET['error_name'])) {
          $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME_ERROR_EMPTY . '<br />');
        } else {
          $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_COUNTRY_NAME_ERROR, $_GET['error_name']) . '<br />');
        }  
      }      
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br />' . xos_draw_input_field('countries_name', $_GET['countries_name']));
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_CODE_2 . '<br />' . xos_draw_input_field('countries_iso_code_2', $_GET['countries_iso_code_2']));
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_CODE_3 . '<br />' . xos_draw_input_field('countries_iso_code_3', $_GET['countries_iso_code_3']));
      $contents[] = array('text' => '<br />' . TEXT_INFO_ADDRESS_FORMAT . '<br />' . xos_draw_pull_down_menu('address_format_id', xos_get_address_formats(), $_GET['address_format_id']));
      $contents[] = array('text' => '<br /><a href="" onclick="countries.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
// Land kann nicht geaendert werden, wenn bereits zugeortnet      
/*      
    case 'edit':
      $check_query = xos_db_query("select ab.entry_country_id, zgz.zone_country_id from " . TABLE_ADDRESS_BOOK . " ab, " . TABLE_ZONES_TO_GEO_ZONES . " zgz where ab.entry_country_id = '" . (int)$cInfo->countries_id . "' or zgz.zone_country_id = '" . (int)$cInfo->countries_id . "' LIMIT 1");
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_COUNTRY . '</b>';

      $form_tag = xos_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      if (!xos_db_num_rows($check_query) && STORE_COUNTRY != $cInfo->countries_id) {
        if (isset($_GET['error_name'])) {
          if (empty($_GET['error_name'])) {
            $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME_ERROR_EMPTY . '<br />');
          } else {
            $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_COUNTRY_NAME_ERROR, $_GET['error_name']) . '<br />');
          }  
        }      
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br />' . xos_draw_input_field('countries_name', (isset($_GET['countries_name']) ? $_GET['countries_name'] : $cInfo->countries_name)) . xos_draw_hidden_field('actual_countries_name', $cInfo->countries_name));  
      } else {
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br /><b>' . $cInfo->countries_name . '</b>' . xos_draw_hidden_field('countries_name', $cInfo->countries_name) . xos_draw_hidden_field('actual_countries_name', $cInfo->countries_name));
      }
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_CODE_2 . '<br />' . xos_draw_input_field('countries_iso_code_2', (isset($_GET['countries_iso_code_2']) ? $_GET['countries_iso_code_2'] : $cInfo->countries_iso_code_2)));
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_CODE_3 . '<br />' . xos_draw_input_field('countries_iso_code_3', (isset($_GET['countries_iso_code_3']) ? $_GET['countries_iso_code_3'] : $cInfo->countries_iso_code_3)));
      $contents[] = array('text' => '<br />' . TEXT_INFO_ADDRESS_FORMAT . '<br />' . xos_draw_pull_down_menu('address_format_id', xos_get_address_formats(), (isset($_GET['address_format_id']) ? $_GET['address_format_id'] : $cInfo->address_format_id)));
      $contents[] = array('text' => '<br /><a href="" onclick="countries.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
*/

// Land kann geaendert werden, auch wenn bereits zugeortnet            
    case 'edit':
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_COUNTRY . '</b>';

      $form_tag = xos_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      if (isset($_GET['error_name'])) {
        if (empty($_GET['error_name'])) {
          $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME_ERROR_EMPTY . '<br />');
        } else {
          $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_COUNTRY_NAME_ERROR, $_GET['error_name']) . '<br />');
        }  
      }      
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br />' . xos_draw_input_field('countries_name', (isset($_GET['countries_name']) ? $_GET['countries_name'] : $cInfo->countries_name)) . xos_draw_hidden_field('actual_countries_name', $cInfo->countries_name));  
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_CODE_2 . '<br />' . xos_draw_input_field('countries_iso_code_2', (isset($_GET['countries_iso_code_2']) ? $_GET['countries_iso_code_2'] : $cInfo->countries_iso_code_2)));
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_CODE_3 . '<br />' . xos_draw_input_field('countries_iso_code_3', (isset($_GET['countries_iso_code_3']) ? $_GET['countries_iso_code_3'] : $cInfo->countries_iso_code_3)));
      $contents[] = array('text' => '<br />' . TEXT_INFO_ADDRESS_FORMAT . '<br />' . xos_draw_pull_down_menu('address_format_id', xos_get_address_formats(), (isset($_GET['address_format_id']) ? $_GET['address_format_id'] : $cInfo->address_format_id)));
      $contents[] = array('text' => '<br /><a href="" onclick="countries.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'delete':    
      $check_query = xos_db_query("select ab.entry_country_id, zgz.zone_country_id from " . TABLE_ADDRESS_BOOK . " ab, " . TABLE_ZONES_TO_GEO_ZONES . " zgz where ab.entry_country_id = '" . (int)$cInfo->countries_id . "' or zgz.zone_country_id = '" . (int)$cInfo->countries_id . "' LIMIT 1");
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_COUNTRY . '</b>';
         
      if (!xos_db_num_rows($check_query) && STORE_COUNTRY != $cInfo->countries_id) {
        $form_tag = xos_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=deleteconfirm');
        $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
        $contents[] = array('text' => '<br /><b>' . $cInfo->countries_name . '</b>');
        $contents[] = array('text' => '<br /><a href="" onclick="countries.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      } else {
        $contents[] = array('text' => TEXT_INFO_DELETE_NOT_ALLOWED . '<br /><br />');
        $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_COUNTRIES, xos_get_all_get_params(array('action'))) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');      
      }
      break;
    default:
      if (is_object($cInfo)) {
        $heading_title = '<b>' . $cInfo->countries_name . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br />' . $cInfo->countries_name);
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_CODE_2 . ' ' . $cInfo->countries_iso_code_2);
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_CODE_3 . ' ' . $cInfo->countries_iso_code_3);
        $contents[] = array('text' => '<br />' . TEXT_INFO_ADDRESS_FORMAT . ' ' . $cInfo->address_format_id);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_countries = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_countries.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_countries', $output_infobox_countries);
endif;
?>
