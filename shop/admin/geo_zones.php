<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : geo_zones.php
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

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_GEO_ZONES) == 'overwrite_all')) :
  $saction = (isset($_GET['saction']) ? $_GET['saction'] : '');

  if (xos_not_null($saction)) {
    switch ($saction) {
      case 'insert_sub':
        $zID = xos_db_prepare_input($_GET['zID']);
        $zone_country_id = xos_db_prepare_input($_POST['zone_country_id']);
        $zone_id = xos_db_prepare_input($_POST['zone_id']);

        xos_db_query("insert into " . TABLE_ZONES_TO_GEO_ZONES . " (zone_country_id, zone_id, geo_zone_id, date_added) values ('" . (int)$zone_country_id . "', '" . (int)$zone_id . "', '" . (int)$zID . "', now())");
        $new_subzone_id = xos_db_insert_id();
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $new_subzone_id));
        break;
      case 'save_sub':
        $sID = xos_db_prepare_input($_GET['sID']);
        $zID = xos_db_prepare_input($_GET['zID']);
        $zone_country_id = xos_db_prepare_input($_POST['zone_country_id']);
        $zone_id = xos_db_prepare_input($_POST['zone_id']);

        xos_db_query("update " . TABLE_ZONES_TO_GEO_ZONES . " set geo_zone_id = '" . (int)$zID . "', zone_country_id = '" . (int)$zone_country_id . "', zone_id = " . (xos_not_null($zone_id) ? "'" . (int)$zone_id . "'" : 'null') . ", last_modified = now() where association_id = '" . (int)$sID . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $_GET['sID']));
        break;
      case 'deleteconfirm_sub':
        $sID = xos_db_prepare_input($_GET['sID']);

        xos_db_query("delete from " . TABLE_ZONES_TO_GEO_ZONES . " where association_id = '" . (int)$sID . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage']));
        break;
    }
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert_zone':
        $geo_zone_name = xos_db_prepare_input($_POST['geo_zone_name']);
        $geo_zone_description = xos_db_prepare_input($_POST['geo_zone_description']);        
        $check_query = xos_db_query("select geo_zone_name from " . TABLE_GEO_ZONES . " where geo_zone_name = '" . xos_db_input($geo_zone_name) . "'");         
        if (xos_db_num_rows($check_query) || $geo_zone_name == '') {
          xos_redirect(xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&geo_zone_name=' . $geo_zone_name . '&geo_zone_description=' . $geo_zone_description . '&action=new_zone&error_name=' . $geo_zone_name));
        }
        
        xos_db_query("insert into " . TABLE_GEO_ZONES . " (geo_zone_name, geo_zone_description, date_added) values ('" . xos_db_input($geo_zone_name) . "', '" . xos_db_input($geo_zone_description) . "', now())");
        $new_zone_id = xos_db_insert_id();
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $new_zone_id));
        break;
      case 'save_zone':
        $zID = xos_db_prepare_input($_GET['zID']);
        $geo_zone_name = xos_db_prepare_input($_POST['geo_zone_name']);
        $actual_geo_zone_name = xos_db_prepare_input($_POST['actual_geo_zone_name']);
        $geo_zone_description = xos_db_prepare_input($_POST['geo_zone_description']);
        if (mb_strtolower($actual_geo_zone_name) != mb_strtolower($geo_zone_name)) {
          $check_query = xos_db_query("select geo_zone_name from " . TABLE_GEO_ZONES . " where geo_zone_name = '" . xos_db_input($geo_zone_name) . "'");
          if (xos_db_num_rows($check_query) || $geo_zone_name == '') {
            xos_redirect(xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&geo_zone_name=' . $geo_zone_name . '&geo_zone_description=' . $geo_zone_description . '&action=edit_zone&error_name=' . $geo_zone_name));
          }
        }  
        
        xos_db_query("update " . TABLE_GEO_ZONES . " set geo_zone_name = '" . xos_db_input($geo_zone_name) . "', geo_zone_description = '" . xos_db_input($geo_zone_description) . "', last_modified = now() where geo_zone_id = '" . (int)$zID . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID']));
        break;
      case 'deleteconfirm_zone':
        $zID = xos_db_prepare_input($_GET['zID']);

        xos_db_query("delete from " . TABLE_GEO_ZONES . " where geo_zone_id = '" . (int)$zID . "'");
        xos_db_query("delete from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)$zID . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage']));
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";  

  if (isset($_GET['zID']) && (($saction == 'edit') || ($saction == 'new'))) {

// javascript to dynamically update the states/provinces list when the country is changed
// TABLES: zones
    function xos_js_zone_list($country, $form, $field) {
      $countries_query = xos_db_query("select distinct zone_country_id from " . TABLE_ZONES . " order by zone_country_id");
      $num_country = 1;
      $output_string = '';
      while ($countries = xos_db_fetch_array($countries_query)) {
        if ($num_country == 1) {
          $output_string .= '  if (' . $country . ' == "' . $countries['zone_country_id'] . '") {' . "\n";
        } else {
          $output_string .= '  } else if (' . $country . ' == "' . $countries['zone_country_id'] . '") {' . "\n";
        }

        $states_query = xos_db_query("select zone_name, zone_id from " . TABLE_ZONES . " where zone_country_id = '" . $countries['zone_country_id'] . "' order by zone_name");

        $num_state = 1;
        while ($states = xos_db_fetch_array($states_query)) {
          if ($num_state == '1') $output_string .= '    ' . $form . '.' . $field . '.options[0] = new Option("' . PLEASE_SELECT . '", "");' . "\n";
          $output_string .= '    ' . $form . '.' . $field . '.options[' . $num_state . '] = new Option("' . $states['zone_name'] . '", "' . $states['zone_id'] . '");' . "\n";
          $num_state++;
        }
        $num_country++;
      }
      $output_string .= '  } else {' . "\n" .
                        '    ' . $form . '.' . $field . '.options[0] = new Option("' . TYPE_BELOW . '", "");' . "\n" .
                        '  }' . "\n";

      return $output_string;
    }
  
    $javascript .= '<script type="text/javascript">' . "\n" .
                   '/* <![CDATA[ */' . "\n" .
                   'function resetZoneSelected(theForm) {' . "\n" .
                   '  if (theForm.state.value != "") {' . "\n" .
                   '    theForm.zone_id.selectedIndex = "0";' . "\n" .
                   '    if (theForm.zone_id.options.length > 0) {' . "\n" .
                   '      theForm.state.value = "' . JS_STATE_SELECT . '";' . "\n" .
                   '    }' . "\n" .
                   '  }' . "\n" .
                   '}' . "\n\n" .

                   'function update_zone(theForm) {' . "\n" .
                   '  var NumState = theForm.zone_id.options.length;' . "\n" .
                   '  var SelectedCountry = "";' . "\n\n" .

                   '  while(NumState > 0) {' . "\n" .
                   '    NumState--;' . "\n" .
                   '    theForm.zone_id.options[NumState] = null;' . "\n" .
                   '  }' . "\n\n" .         

                   '  SelectedCountry = theForm.zone_country_id.options[theForm.zone_country_id.selectedIndex].value;' . "\n\n" .

                   xos_js_zone_list('SelectedCountry', 'theForm', 'zone_id') . "\n\n" .

                   '}' . "\n" .
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n"; 
  
  }
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');     
 
  if ($action == 'list') {

    $rows = 0;
    $zones_query_raw = "select a.association_id, a.zone_country_id, c.countries_name, a.zone_id, a.geo_zone_id, a.last_modified, a.date_added, z.zone_name from " . TABLE_ZONES_TO_GEO_ZONES . " a left join " . TABLE_COUNTRIES . " c on a.zone_country_id = c.countries_id left join " . TABLE_ZONES . " z on a.zone_id = z.zone_id where a.geo_zone_id = " . $_GET['zID'] . " order by association_id";
    $zones_split = new splitPageResults($_GET['spage'], MAX_DISPLAY_RESULTS, $zones_query_raw, $zones_query_numrows);
    $zones_query = xos_db_query($zones_query_raw);
    $zones_array = array();
    while ($zones = xos_db_fetch_array($zones_query)) {
      $rows++;
      if ((!isset($_GET['sID']) || (isset($_GET['sID']) && ($_GET['sID'] == $zones['association_id']))) && !isset($sInfo) && (substr($action, 0, 3) != 'new')) {
        $sInfo = new objectInfo($zones);
      }
      
      $selected = false;
      
      if (isset($sInfo) && is_object($sInfo) && ($zones['association_id'] == $sInfo->association_id)) {
        $selected = true;
        $link_filename_geo_zones = xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=edit');
      } else {
        $link_filename_geo_zones = xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $zones['association_id']);
      }
      
      $zones_array[]=array('selected' => $selected,
                           'link_filename_geo_zones' => $link_filename_geo_zones,
                           'country_name' => (($zones['countries_name']) ? $zones['countries_name'] : TEXT_ALL_COUNTRIES),
                           'zone_name' => (($zones['zone_id']) ? $zones['zone_name'] : PLEASE_SELECT));
    }
    
    $smarty->assign(array('action_list' => true,
                          'zones' => $zones_array,
                          'nav_bar_number' => $zones_split->display_count($zones_query_numrows, MAX_DISPLAY_RESULTS, $_GET['spage'], TEXT_DISPLAY_NUMBER_OF_COUNTRIES),
                          'nav_bar_result' => $zones_split->display_links($zones_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['spage'], 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list', 'spage')));      
 
    if (empty($saction)) {    
      $smarty->assign(array('link_filename_geo_zones' => xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID']),
                            'link_filename_geo_zones_saction_new' => xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&' . (isset($sInfo) ? 'sID=' . $sInfo->association_id . '&' : '') . 'saction=new')));
    }  

  } else {

    $zones_query_raw = "select geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added from " . TABLE_GEO_ZONES . " order by geo_zone_name";
    $zones_split = new splitPageResults($_GET['zpage'], MAX_DISPLAY_RESULTS, $zones_query_raw, $zones_query_numrows);
    $zones_query = xos_db_query($zones_query_raw);
    $zones_array = array();
    while ($zones = xos_db_fetch_array($zones_query)) {
      if ((!isset($_GET['zID']) || (isset($_GET['zID']) && ($_GET['zID'] == $zones['geo_zone_id']))) && !isset($zInfo) && (substr($action, 0, 3) != 'new')) {
        $num_zones_query = xos_db_query("select count(*) as num_zones from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)$zones['geo_zone_id'] . "' group by geo_zone_id");
        $num_zones = xos_db_fetch_array($num_zones_query);

        if ($num_zones['num_zones'] > 0) {
          $zones['num_zones'] = $num_zones['num_zones'];
        } else {
          $zones['num_zones'] = 0;
        }

        $zInfo = new objectInfo($zones);
      }
      
      $selected = false;      
      
      if (isset($zInfo) && is_object($zInfo) && ($zones['geo_zone_id'] == $zInfo->geo_zone_id)) {
        $selected = true;
        $link_filename_geo_zones = xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=list');
      } else {
        $link_filename_geo_zones = xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zones['geo_zone_id']);
      }

      $zones_array[]=array('selected' => $selected,
                           'link_filename_geo_zones' => $link_filename_geo_zones,
                           'link_filename_geo_zones_action_list' => xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zones['geo_zone_id'] . '&action=list'),
                           'geo_zone_name' => $zones['geo_zone_name']);
    }
    
    $smarty->assign(array('zones' => $zones_array,
                          'nav_bar_number' => $zones_split->display_count($zones_query_numrows, MAX_DISPLAY_RESULTS, $_GET['zpage'], TEXT_DISPLAY_NUMBER_OF_TAX_ZONES),
                          'nav_bar_result' => $zones_split->display_links($zones_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['zpage'], '', 'zpage')));   

    if (!$action) {    
      $smarty->assign('link_filename_geo_zones_action_new_zone', xos_href_link(FILENAME_GEO_ZONES, 'zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=new_zone'));
    }

  }

  $smarty->assign('BODY_TAG_PARAMS', 'onload="SetFocus();"');

  require(DIR_WS_BOXES . 'infobox_geo_zones.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'geo_zones');
  $output_geo_zones = $smarty->fetch(ADMIN_TPL . '/geo_zones.tpl');
  
  $smarty->assign('central_contents', $output_geo_zones);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
