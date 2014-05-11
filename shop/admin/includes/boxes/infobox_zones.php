<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_zones.php
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
//              filename: zones.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_zones.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'new':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_ZONE . '</b>';

      $form_tag = xos_draw_form('zones', FILENAME_ZONES, 'page=' . $_GET['page'] . '&action=insert');
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      if (isset($_GET['error_name'])) {
        if (empty($_GET['error_name'])) {
          $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_NAME_ERROR_EMPTY . '<br />');
        } else {
          $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_ZONES_NAME_ERROR, $_GET['error_name']) . '<br />');
        }  
      }      
      $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_NAME . '<br />' . xos_draw_input_field('zone_name', $_GET['zone_name']));
      $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_CODE . '<br />' . xos_draw_input_field('zone_code', $_GET['zone_code']));
      $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br />' . xos_draw_pull_down_menu('zone_country_id', xos_get_countries(), $_GET['zone_country_id'], 'style="font-size:9px"'));
      $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
// Kanton/Bundesland kann nicht geaendert werden, wenn bereits zugeortnet      
/*      
    case 'edit':
      $check_query = xos_db_query("select ab.entry_zone_id, zgz.zone_id from " . TABLE_ADDRESS_BOOK . " ab, " . TABLE_ZONES_TO_GEO_ZONES . " zgz where ab.entry_zone_id = '" . (int)$cInfo->zone_id . "' or zgz.zone_id = '" . (int)$cInfo->zone_id . "' LIMIT 1");
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_ZONE . '</b>';

      $form_tag = xos_draw_form('zones', FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      if (!xos_db_num_rows($check_query) && STORE_ZONE != $cInfo->zone_id) {
        if (isset($_GET['error_name'])) {
          if (empty($_GET['error_name'])) {
            $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_NAME_ERROR_EMPTY . '<br />');
          } else {
            $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_ZONES_NAME_ERROR, $_GET['error_name']) . '<br />');
          }  
        }      
        $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_NAME . '<br />' . xos_draw_input_field('zone_name', (isset($_GET['zone_name']) ? $_GET['zone_name'] : $cInfo->zone_name)) . xos_draw_hidden_field('actual_zone_name', $cInfo->zone_name));
      } else {
        $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_NAME . '<br /><b>' . $cInfo->zone_name . '</b>' . xos_draw_hidden_field('zone_name', $cInfo->zone_name) . xos_draw_hidden_field('actual_zone_name', $cInfo->zone_name));
      }
      $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_CODE . '<br />' . xos_draw_input_field('zone_code', (isset($_GET['zone_code']) ? $_GET['zone_code'] : $cInfo->zone_code)));
      if (!xos_db_num_rows($check_query) && STORE_ZONE != $cInfo->zone_id) {
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br />' . xos_draw_pull_down_menu('zone_country_id', xos_get_countries(), (isset($_GET['zone_country_id']) ? $_GET['zone_country_id'] : $cInfo->countries_id), 'style="font-size:9px"') . xos_draw_hidden_field('actual_zone_country_id', $cInfo->countries_id));
      } else {
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br /><b>' . $cInfo->countries_name . '</b>' . xos_draw_hidden_field('zone_country_id', $cInfo->countries_id) . xos_draw_hidden_field('actual_zone_country_id', $cInfo->countries_id));
      }  
      $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
*/

// Kanton/Bundesland kann geaendert werden, auch wenn bereits zugeortnet      
    case 'edit':
      $check_query = xos_db_query("select ab.entry_zone_id, zgz.zone_id from " . TABLE_ADDRESS_BOOK . " ab, " . TABLE_ZONES_TO_GEO_ZONES . " zgz where ab.entry_zone_id = '" . (int)$cInfo->zone_id . "' or zgz.zone_id = '" . (int)$cInfo->zone_id . "' LIMIT 1");
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_ZONE . '</b>';

      $form_tag = xos_draw_form('zones', FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      if (isset($_GET['error_name'])) {
        if (empty($_GET['error_name'])) {
          $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_NAME_ERROR_EMPTY . '<br />');
        } else {
          $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_ZONES_NAME_ERROR, $_GET['error_name']) . '<br />');
        }  
      }      
      $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_NAME . '<br />' . xos_draw_input_field('zone_name', (isset($_GET['zone_name']) ? $_GET['zone_name'] : $cInfo->zone_name)) . xos_draw_hidden_field('actual_zone_name', $cInfo->zone_name));
      $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_CODE . '<br />' . xos_draw_input_field('zone_code', (isset($_GET['zone_code']) ? $_GET['zone_code'] : $cInfo->zone_code)));
      if (!xos_db_num_rows($check_query) && STORE_ZONE != $cInfo->zone_id) {
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br />' . xos_draw_pull_down_menu('zone_country_id', xos_get_countries(), (isset($_GET['zone_country_id']) ? $_GET['zone_country_id'] : $cInfo->countries_id), 'style="font-size:9px"') . xos_draw_hidden_field('actual_zone_country_id', $cInfo->countries_id));
      } else {
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . '<br /><b>' . $cInfo->countries_name . '</b>' . xos_draw_hidden_field('zone_country_id', $cInfo->countries_id) . xos_draw_hidden_field('actual_zone_country_id', $cInfo->countries_id));
      }  
      $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;            
    case 'delete':
      $check_query = xos_db_query("select ab.entry_zone_id, zgz.zone_id from " . TABLE_ADDRESS_BOOK . " ab, " . TABLE_ZONES_TO_GEO_ZONES . " zgz where ab.entry_zone_id = '" . (int)$cInfo->zone_id . "' or zgz.zone_id = '" . (int)$cInfo->zone_id . "' LIMIT 1");
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_ZONE . '</b>';
      
      if (!xos_db_num_rows($check_query) && STORE_ZONE != $cInfo->zone_id) {
        $form_tag = xos_draw_form('zones', FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=deleteconfirm');
        $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
        $contents[] = array('text' => '<br /><b>' . $cInfo->zone_name . '</b>');
        $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      } else {
        $contents[] = array('text' => TEXT_INFO_DELETE_NOT_ALLOWED . '<br /><br />');
        $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_ZONES, xos_get_all_get_params(array('action'))) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');      
      }  
      break;
    default:
      if (isset($cInfo) && is_object($cInfo)) {
        $heading_title = '<b>' . $cInfo->zone_name . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_ZONES_NAME . '<br />' . $cInfo->zone_name . ' (' . $cInfo->zone_code . ')');
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_NAME . ' ' . $cInfo->countries_name);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_zones = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_zones.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_zones', $output_infobox_zones);
endif;
?>
