<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_geo_zones.php
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
//              filename: geo_zones.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_geo_zones.php') == 'overwrite_all')) :
  $contents = array();
  if ($action == 'list') {
    switch ($saction) {
      case 'new':
        $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_SUB_ZONE . '</b>';

        $form_tag = xos_draw_form('zones', FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&' . (isset($_GET['sID']) ? 'sID=' . $_GET['sID'] . '&' : '') . 'saction=insert_sub');
        $contents[] = array('text' => TEXT_INFO_NEW_SUB_ZONE_INTRO);
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY . '<br />' . xos_draw_pull_down_menu('zone_country_id', xos_get_countries(TEXT_ALL_COUNTRIES), '', 'style="font-size:9px" onchange="update_zone(this.form);"'));
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_ZONE . '<br />' . xos_draw_pull_down_menu('zone_id', xos_prepare_country_zones_pull_down(), '', 'style="font-size:9px"'));
        $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&' . (isset($_GET['sID']) ? 'sID=' . $_GET['sID'] : '')) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      case 'edit':
        $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_SUB_ZONE . '</b>';

        $form_tag = xos_draw_form('zones', FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=save_sub');
        $contents[] = array('text' => TEXT_INFO_EDIT_SUB_ZONE_INTRO);
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY . '<br />' . xos_draw_pull_down_menu('zone_country_id', xos_get_countries(TEXT_ALL_COUNTRIES), $sInfo->zone_country_id, 'style="font-size:9px" onchange="update_zone(this.form);"'));
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY_ZONE . '<br />' . xos_draw_pull_down_menu('zone_id', xos_prepare_country_zones_pull_down($sInfo->zone_country_id), $sInfo->zone_id, 'style="font-size:9px"'));
        $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      case 'delete':
        $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_SUB_ZONE . '</b>';

        $form_tag = xos_draw_form('zones', FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=deleteconfirm_sub');
        $contents[] = array('text' => TEXT_INFO_DELETE_SUB_ZONE_INTRO);
        $contents[] = array('text' => '<br /><b>' . $sInfo->countries_name . '</b>');
        $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      default:
        if (isset($sInfo) && is_object($sInfo)) {
          $heading_title = '<b>' . $sInfo->countries_name . '</b>';

          $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');
          $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . xos_date_short($sInfo->date_added));
          if (xos_not_null($sInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . xos_date_short($sInfo->last_modified));
        }
        break;
    }
  } else {
    switch ($action) {
      case 'new_zone':
        $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_ZONE . '</b>';

        $form_tag = xos_draw_form('zones', FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=insert_zone');
        $contents[] = array('text' => TEXT_INFO_NEW_ZONE_INTRO);
        if (isset($_GET['error_name'])) {
          if (empty($_GET['error_name'])) {
            $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_ZONE_NAME_ERROR_EMPTY . '<br />');
          } else {
            $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_TAX_ZONE_NAME_ERROR, $_GET['error_name']) . '<br />');
          }  
        }        
        $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_NAME . '<br />' . xos_draw_input_field('geo_zone_name', $_GET['geo_zone_name']));
        $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_DESCRIPTION . '<br />' . xos_draw_input_field('geo_zone_description', $_GET['geo_zone_description']));
        $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
// Steuerzone kann nicht geaendert werden, wenn bereits zugeortnet        
/*        
      case 'edit_zone':
        $check_query = xos_db_query("select tax_zone_id from " . TABLE_TAX_RATES . " where tax_zone_id = '" . $zInfo->geo_zone_id . "' LIMIT 1");      
        $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_ZONE . '</b>';

        $form_tag = xos_draw_form('zones', FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=save_zone');
        $contents[] = array('text' => TEXT_INFO_EDIT_ZONE_INTRO);
        if (!xos_db_num_rows($check_query)) {
          if (isset($_GET['error_name'])) {
            if (empty($_GET['error_name'])) {
              $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_ZONE_NAME_ERROR_EMPTY . '<br />');
            } else {
              $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_TAX_ZONE_NAME_ERROR, $_GET['error_name']) . '<br />');
            }  
          }          
          $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_NAME . '<br />' . xos_draw_input_field('geo_zone_name', (isset($_GET['geo_zone_name']) ? $_GET['geo_zone_name'] : $zInfo->geo_zone_name)) . xos_draw_hidden_field('actual_geo_zone_name', $zInfo->geo_zone_name));
        } else {
          $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_NAME . '<br /><b>' . $zInfo->geo_zone_name . '</b>' . xos_draw_hidden_field('geo_zone_name', $zInfo->geo_zone_name) . xos_draw_hidden_field('actual_geo_zone_name', $zInfo->geo_zone_name));
        }
        $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_DESCRIPTION . '<br />' . xos_draw_input_field('geo_zone_description', (isset($_GET['geo_zone_description']) ? $_GET['geo_zone_description'] : $zInfo->geo_zone_description)));
        $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
*/

// Steuerzone kann geaendert werden, auch wenn bereits zugeortnet        
      case 'edit_zone':    
        $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_ZONE . '</b>';

        $form_tag = xos_draw_form('zones', FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=save_zone');
        $contents[] = array('text' => TEXT_INFO_EDIT_ZONE_INTRO);
        if (isset($_GET['error_name'])) {
          if (empty($_GET['error_name'])) {
            $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_ZONE_NAME_ERROR_EMPTY . '<br />');
          } else {
            $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_TAX_ZONE_NAME_ERROR, $_GET['error_name']) . '<br />');
          }  
        }          
        $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_NAME . '<br />' . xos_draw_input_field('geo_zone_name', (isset($_GET['geo_zone_name']) ? $_GET['geo_zone_name'] : $zInfo->geo_zone_name)) . xos_draw_hidden_field('actual_geo_zone_name', $zInfo->geo_zone_name));
        $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_DESCRIPTION . '<br />' . xos_draw_input_field('geo_zone_description', (isset($_GET['geo_zone_description']) ? $_GET['geo_zone_description'] : $zInfo->geo_zone_description)));
        $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;        
      case 'delete_zone':
        $check_query = xos_db_query("select tax_zone_id from " . TABLE_TAX_RATES . " where tax_zone_id = '" . $zInfo->geo_zone_id . "' LIMIT 1");
        $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_ZONE . '</b>';
        
        if (!xos_db_num_rows($check_query)) {
          $form_tag = xos_draw_form('zones', FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=deleteconfirm_zone');
          $contents[] = array('text' => TEXT_INFO_DELETE_ZONE_INTRO);
          $contents[] = array('text' => '<br /><b>' . $zInfo->geo_zone_name . '</b>');
          $contents[] = array('text' => '<br /><a href="" onclick="zones.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        } else {
          $contents[] = array('text' => TEXT_INFO_DELETE_NOT_ALLOWED . '<br /><br />');
          $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_GEO_ZONES, xos_get_all_get_params(array('action'))) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');
        }        
        break;
      default:
        if (isset($zInfo) && is_object($zInfo)) {
          $heading_title = '<b>' . $zInfo->geo_zone_name . '</b>';

          $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=edit_zone') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=delete_zone') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=list') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DETAILS . ' "><span>' . BUTTON_TEXT_DETAILS . '</span></a>');
          $contents[] = array('text' => '<br />' . TEXT_INFO_NUMBER_ZONES . ' ' . $zInfo->num_zones);
          $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . xos_date_short($zInfo->date_added));
          if (xos_not_null($zInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . xos_date_short($zInfo->last_modified));
          $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_DESCRIPTION . '<br />' . $zInfo->geo_zone_description);
        }
        break;
    }
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_geo_zones = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_geo_zones.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_geo_zones', $output_infobox_geo_zones);
endif;
?>
