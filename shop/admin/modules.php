<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : modules.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2014 Hanspeter Zeller
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
//              Copyright (c) 2010 osCommerce
//              filename: modules.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_MODULES) == 'overwrite_all')) :  
// initialize configuration modules
  require(DIR_WS_CLASSES . 'cfg_modules.php');
  $cfgModules = new cfg_modules();  

  $set = (isset($_GET['set']) ? $_GET['set'] : '');

  $modules = $cfgModules->getAll();

  if (empty($set) || !$cfgModules->exists($set)) {
    $set = $modules[0]['code'];
  }

  $module_type = $cfgModules->get($set, 'code');
  $module_directory = $cfgModules->get($set, 'directory');
  $module_language_directory = $cfgModules->get($set, 'language_directory');
  $module_key = $cfgModules->get($set, 'key');;
  define('HEADING_TITLE', $cfgModules->get($set, 'title'));
  $template_integration = $cfgModules->get($set, 'template_integration');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'save':       
        reset($_POST['configuration']);
        while (list($key, $value) = each($_POST['configuration'])) {
          xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . $value . "' where configuration_key = '" . $key . "'");
        }
        $smarty_cache_control->clearAllCache();
        xos_redirect(xos_href_link(FILENAME_MODULES, 'set=' . $set . '&module=' . $_GET['module']));
        break;                
      case 'install':
      case 'remove':       
        $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
        $class = basename($_GET['module']);
        if (file_exists($module_directory . $class . $file_extension)) {
          include($module_directory . $class . $file_extension);
          $module = new $class;
          if ($action == 'install') {
            $module->install();
            $modules_installed = explode(';', constant($module_key));
            $modules_installed[] = $class . $file_extension;
            xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . implode(';', $modules_installed) . "' where configuration_key = '" . $module_key . "'");
            $smarty_cache_control->clearAllCache();
            xos_redirect(xos_href_link(FILENAME_MODULES, 'set=' . $set . '&module=' . $class));            
          } elseif ($action == 'remove') {
            $module->remove();
            $modules_installed = explode(';', constant($module_key));
            unset($modules_installed[array_search($class . $file_extension, $modules_installed)]);
            xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . implode(';', $modules_installed) . "' where configuration_key = '" . $module_key . "'");
            $smarty_cache_control->clearAllCache();
            xos_redirect(xos_href_link(FILENAME_MODULES, 'set=' . $set));            
          }
        }
        xos_redirect(xos_href_link(FILENAME_MODULES, 'set=' . $set . '&module=' . $class));
        break;        
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');

  $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
  $directory_array = array();
  if ($dir = @dir($module_directory)) {
    while ($file = $dir->read()) {
      if (!is_dir($module_directory . $file)) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {
          $directory_array[] = $file;
        }
      }
    }
    sort($directory_array);
    $dir->close();
  }
  
  $modules_array = array();
  $installed_modules = array();
  for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
    $file = $directory_array[$i];

    include($module_directory . $file);
    include($module_language_directory . 'admin/languages/' . $_SESSION['language'] . '/modules/' . $module_type . '/' . $file);

    $class = substr($file, 0, strrpos($file, '.'));
    if (xos_class_exists($class)) {
      $module = new $class;
      if ($module->check() > 0) {
        if (($module->sort_order > 0) && !isset($installed_modules[$module->sort_order])) {
          $installed_modules[$module->sort_order] = $file;
        } else {
          $installed_modules[] = $file;
        }
      }

      if ((empty($_GET['module']) || ($_GET['module'] == $class)) && !isset($mInfo)) {
        $module_info = array('code' => $module->code,
                             'title' => $module->title,
                             'description' => $module->description,
                             'status' => $module->check(),
                             'signature' => (isset($module->signature) ? $module->signature : null),
                             'api_version' => (isset($module->api_version) ? $module->api_version : null));                             

        $module_keys = $module->keys();
        
        if ($module->check() > 0) {
          $keys_extra = array();
          for ($j=0, $k=sizeof($module_keys); $j<$k; $j++) {
            $key_value_query = xos_db_query("select configuration_key as lang_key, configuration_value, use_function, set_function from " . TABLE_CONFIGURATION . " where configuration_key = '" . $module_keys[$j] . "'");
            $key_value = xos_db_fetch_array($key_value_query);

            $keys_extra[$module_keys[$j]]['title'] = constant($key_value['lang_key'] . '_TITLE');
            $keys_extra[$module_keys[$j]]['value'] = $key_value['configuration_value'];
            $keys_extra[$module_keys[$j]]['description'] = constant($key_value['lang_key'] . '_DESCRIPTION');
            $keys_extra[$module_keys[$j]]['use_function'] = $key_value['use_function'];
            $keys_extra[$module_keys[$j]]['set_function'] = $key_value['set_function'];
          }
        }

        $module_info['keys'] = $keys_extra;

        $mInfo = new objectInfo($module_info);
      }

      $selected = false;
      $installed = false;
      
      if (isset($mInfo) && is_object($mInfo) && ($class == $mInfo->code) ) {
        $selected = true;
        $link_filename_modules = xos_href_link(FILENAME_MODULES, 'set=' . $set . '&module=' . $class . '&action=edit');
        if ($module->check() > 0) {
          $installed = true;
        }
      } else {
        $link_filename_modules = xos_href_link(FILENAME_MODULES, 'set=' . $set . '&module=' . $class);
      }

       if (is_numeric($module->sort_order)) {
         $sort_order = $module->sort_order;
       }else {
         $sort_order = '';
       }  

       $modules_array[]=array('selected' => $selected,
                              'installed' => $installed,
                              'link_filename_modules' => $link_filename_modules,
                              'title' => $module->title,
                              'sort_order' => $sort_order);

    }
  }  

  ksort($installed_modules);
  $check_query = xos_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = '" . $module_key . "'");
  if (xos_db_num_rows($check_query)) {
    $check = xos_db_fetch_array($check_query);
    if ($check['configuration_value'] != implode(';', $installed_modules)) {
      xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . implode(';', $installed_modules) . "', last_modified = now() where configuration_key = '" . $module_key . "'");
    }
  } else {
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('" . $module_key . "', '" . implode(';', $installed_modules) . "', '6', '0', now())");
  }
  
  if ($template_integration == true) {
    $check_query = xos_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'TEMPLATE_BLOCK_GROUPS'");
    if (xos_db_num_rows($check_query)) {
      $check = xos_db_fetch_array($check_query);
      $tbgroups_array = explode(';', $check['configuration_value']);
      if (!in_array($module_type, $tbgroups_array)) {
        $tbgroups_array[] = $module_type;
        sort($tbgroups_array);
        xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . implode(';', $tbgroups_array) . "', last_modified = now() where configuration_key = 'TEMPLATE_BLOCK_GROUPS'");
      }
    } else {
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('TEMPLATE_BLOCK_GROUPS', '" . $module_type . "', '6', '0', now())");
    }
  }  

  $smarty->assign(array('modules' => $modules_array,
                        'directory_path' => $module_directory,
                        'heading_title' => HEADING_TITLE));
  
  require(DIR_WS_BOXES . 'infobox_modules.php');
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'modules');
  $output_modules = $smarty->fetch(ADMIN_TPL . '/modules.tpl');
  
  $smarty->assign('central_contents', $output_modules);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');  

  require(DIR_WS_INCLUDES . 'application_bottom.php');  
endif;  
?>
