<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : zones.php
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

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_ZONES) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert':
        $zone_name = xos_db_prepare_input($_POST['zone_name']);
        $zone_code = xos_db_prepare_input($_POST['zone_code']);        
        $zone_country_id = xos_db_prepare_input($_POST['zone_country_id']);        
        $check_query = xos_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$zone_country_id . "' and zone_name = '" . xos_db_input($zone_name) . "'");
        if (xos_db_num_rows($check_query) || $zone_name == '') {
          xos_redirect(xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&zone_name=' . $zone_name . '&zone_code=' . $zone_code . '&zone_country_id=' . $zone_country_id . '&action=new&error_name=' . $zone_name));
        }
        
        xos_db_query("insert into " . TABLE_ZONES . " (zone_country_id, zone_code, zone_name) values ('" . (int)$zone_country_id . "', '" . xos_db_input($zone_code) . "', '" . xos_db_input($zone_name) . "')");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page']));
        break;
      case 'save':
        $zone_id = xos_db_prepare_input($_GET['cID']);
        $zone_name = xos_db_prepare_input($_POST['zone_name']);
        $actual_zone_name = xos_db_prepare_input($_POST['actual_zone_name']);        
        $zone_code = xos_db_prepare_input($_POST['zone_code']);
        $zone_country_id = xos_db_prepare_input($_POST['zone_country_id']);
        $actual_zone_country_id = xos_db_prepare_input($_POST['actual_zone_country_id']);
        if (mb_strtolower($actual_zone_name) != mb_strtolower($zone_name) || $actual_zone_country_id != $zone_country_id) {               
          $check_query = xos_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$zone_country_id . "' and zone_name = '" . xos_db_input($zone_name) . "'");
          if (xos_db_num_rows($check_query) || $zone_name == '') {
            xos_redirect(xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $_GET['cID'] . '&zone_name=' . $zone_name . '&zone_code=' . $zone_code . '&zone_country_id=' . $zone_country_id . '&action=edit&error_name=' . $zone_name));
          }
        }  
          
        xos_db_query("update " . TABLE_ZONES . " set zone_country_id = '" . (int)$zone_country_id . "', zone_code = '" . xos_db_input($zone_code) . "', zone_name = '" . xos_db_input($zone_name) . "' where zone_id = '" . (int)$zone_id . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $_GET['cID']));
        break;
      case 'deleteconfirm':
        $zone_id = xos_db_prepare_input($_GET['cID']);

        xos_db_query("delete from " . TABLE_ZONES . " where zone_id = '" . (int)$zone_id . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page']));
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php'); 

  $zones_query_raw = "select z.zone_id, c.countries_id, c.countries_name, z.zone_name, z.zone_code, z.zone_country_id from " . TABLE_ZONES . " z, " . TABLE_COUNTRIES . " c where z.zone_country_id = c.countries_id order by c.countries_name, z.zone_name";
  $zones_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $zones_query_raw, $zones_query_numrows);
  $zones_query = xos_db_query($zones_query_raw);
  $zones_array = array();
  while ($zones = xos_db_fetch_array($zones_query)) {
    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $zones['zone_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
      $cInfo = new objectInfo($zones);
    }
    
    $selected = false;

    if (isset($cInfo) && is_object($cInfo) && ($zones['zone_id'] == $cInfo->zone_id)) {
      $selected = true;
      $link_filename_zones = xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=edit');
    } else {
      $link_filename_zones = xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&cID=' . $zones['zone_id']);
    }

    $zones_array[]=array('selected' => $selected,
                         'link_filename_zones' => $link_filename_zones,
                         'country_name' => $zones['countries_name'],
                         'zone_name' => $zones['zone_name'],
                         'zone_code' => $zones['zone_code']);
  }

  if (empty($action)) {
    $smarty->assign('link_filename_zones_action_new', xos_href_link(FILENAME_ZONES, 'page=' . $_GET['page'] . '&action=new'));
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'zones' => $zones_array,
                        'nav_bar_number' => $zones_split->display_count($zones_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ZONES),
                        'nav_bar_result' => $zones_split->display_links($zones_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));  

  require(DIR_WS_BOXES . 'infobox_zones.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'zones');
  $output_zones = $smarty->fetch(ADMIN_TPL . '/zones.tpl');
  
  $smarty->assign('central_contents', $output_zones);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
