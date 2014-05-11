<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : configuration.php
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
//              filename: configuration.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_CONFIGURATION) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'save':
        $configuration_value = (is_array($_POST['configuration_value'])) ? implode(',', xos_db_prepare_input($_POST['configuration_value'])) : xos_db_prepare_input(htmlspecialchars($_POST['configuration_value']));         
        
        $cID = xos_db_prepare_input($_GET['cID']);

        xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . xos_db_input($configuration_value) . "', last_modified = now() where configuration_id = '" . (int)$cID . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cID));
        break;
    }
  }

  $gID = (isset($_GET['gID'])) ? $_GET['gID'] : 1;
  
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  $configuration_query = xos_db_query("select configuration_id, configuration_key as lang_key, configuration_value, use_function from " . TABLE_CONFIGURATION . " where configuration_group_id = '" . (int)$gID . "' order by sort_order");
  $configurations_array = array();
  while ($configuration = xos_db_fetch_array($configuration_query)) {
    if (xos_not_null($configuration['use_function'])) {
      $use_function = $configuration['use_function'];
      if (preg_match('/->/', $use_function)) {
        $class_method = explode('->', $use_function);
        if (!is_object(${$class_method[0]})) {
          include(DIR_WS_CLASSES . $class_method[0] . '.php');
          ${$class_method[0]} = new $class_method[0]();
        }
        $cfgValue = xos_call_function($class_method[1], $configuration['configuration_value'], ${$class_method[0]});
      } else {
        $cfgValue = xos_call_function($use_function, $configuration['configuration_value']);
      }
    } else {
      $cfgValue = $configuration['configuration_value'];
    }

    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $configuration['configuration_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
//      $cfg_extra_query = xos_db_query("select configuration_key as lang_key, date_added, last_modified, use_function, set_function from " . TABLE_CONFIGURATION . " where configuration_id = '" . (int)$configuration['configuration_id'] . "'");    
      $cfg_extra_query = xos_db_query("select date_added, last_modified, use_function, set_function from " . TABLE_CONFIGURATION . " where configuration_id = '" . (int)$configuration['configuration_id'] . "'");
      $cfg_extra = xos_db_fetch_array($cfg_extra_query);

      $cInfo_array = array_merge((array)$configuration, (array)$cfg_extra);
      $cInfo = new objectInfo($cInfo_array);
    }

    $selected = false;

    if ( (isset($cInfo) && is_object($cInfo)) && ($configuration['configuration_id'] == $cInfo->configuration_id) ) {
      $selected = true;
      $link_filename_configuration = xos_href_link(FILENAME_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=edit');
    } else {
      $link_filename_configuration = xos_href_link(FILENAME_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id']);
    }

    $configurations_array[]=array('selected' => $selected,
                                  'link_filename_configuration' => $link_filename_configuration,
                                  'title' => constant($configuration['lang_key'] . '_TITLE'),
                                  'value' => $cfgValue);

  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'configurations' => $configurations_array,
                        'configuration_group_title' => constant(HEADING_TITLE_CONFIGURATION_GROUP_ . (int)$gID)));
 
  require(DIR_WS_BOXES . 'infobox_configuration.php');
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'configuration');
  $output_configuration = $smarty->fetch(ADMIN_TPL . '/configuration.tpl');
  
  $smarty->assign('central_contents', $output_configuration);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');  

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
