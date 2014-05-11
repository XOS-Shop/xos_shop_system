<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : action_recorder.php
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
//              Copyright (c) 2013 osCommerce
//              filename: action_recorder.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_ACTION_RECORDER) == 'overwrite_all')) :
  $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
  $directory_array = array();
  if ($dir = @dir(DIR_FS_CATALOG_MODULES . 'action_recorder/')) {
    while ($file = $dir->read()) {
      if (!is_dir(DIR_FS_CATALOG_MODULES . 'action_recorder/' . $file)) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {
          $directory_array[] = $file;
        }
      }
    }
    sort($directory_array);
    $dir->close();
  }

  for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
    $file = $directory_array[$i];

    if (file_exists(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/action_recorder/' . $file)) {
      include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/action_recorder/' . $file);
    }

    include(DIR_FS_CATALOG_MODULES . 'action_recorder/' . $file);

    $class = substr($file, 0, strrpos($file, '.'));
    if (xos_class_exists($class)) {
      ${$class} = new $class;
    }
  }

  $modules_array = array();
  $modules_list_array = array(array('id' => '', 'text' => TEXT_ALL_MODULES));

  $modules_query = xos_db_query("select distinct module from " . TABLE_ACTION_RECORDER . " order by module");
  while ($modules = xos_db_fetch_array($modules_query)) {
    $modules_array[] = $modules['module'];

    $modules_list_array[] = array('id' => $modules['module'],
                                  'text' => (is_object(${$modules['module']}) ? ${$modules['module']}->title : $modules['module']));
  }
  
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  
  if (xos_not_null($action)) {
    switch ($action) {
      case 'expire':
        $expired_entries = 0;

        if (isset($_GET['module']) && in_array($_GET['module'], $modules_array)) {
          if (is_object(${$_GET['module']})) {
            $expired_entries += ${$_GET['module']}->expireEntries();
          } else {
            $delete_query = xos_db_query("delete from " . TABLE_ACTION_RECORDER . " where module = '" . xos_db_input($_GET['module']) . "'");
            $expired_entries += xos_db_affected_rows();
          }
        } else {
          foreach ($modules_array as $module) {
            if (is_object(${$module})) {
              $expired_entries += ${$module}->expireEntries();
            }
          }
        }

        $messageStack->add_session('header', sprintf(SUCCESS_EXPIRED_ENTRIES, $expired_entries), 'success');

        xos_redirect(xos_href_link(FILENAME_ACTION_RECORDER));

        break;
    }
  }  

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  $filter = array();

  if (isset($_GET['module']) && in_array($_GET['module'], $modules_array)) {
    $filter[] = " module = '" . xos_db_input($_GET['module']) . "' ";
  }

  if (isset($_GET['search']) && !empty($_GET['search'])) {
    $filter[] = " identifier like '%" . xos_db_input($_GET['search']) . "%' ";
  }

  $actions_query_raw = "select * from " . TABLE_ACTION_RECORDER . (!empty($filter) ? " where " . implode(" and ", $filter) : "") . " order by date_added desc";
  $actions_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $actions_query_raw, $actions_query_numrows);
  $actions_query = xos_db_query($actions_query_raw);
  $actions_array = array();
  while ($actions = xos_db_fetch_array($actions_query)) {

    $module_title = $actions['module'];
    if (is_object(${$actions['module']})) {
      $module_title = ${$actions['module']}->title;
    }

    if ((!isset($_GET['aID']) || (isset($_GET['aID']) && ($_GET['aID'] == $actions['id']))) && !isset($aInfo)) {
      $actions_extra_query = xos_db_query("select identifier from " . TABLE_ACTION_RECORDER . " where id = '" . (int)$actions['id'] . "'");
      $actions_extra = xos_db_fetch_array($actions_extra_query);

      $aInfo_array = array_merge($actions, $actions_extra, array('module' => $module_title));
      $aInfo = new objectInfo($aInfo_array);
    }
    
    $selected = false;
    
    if ( (isset($aInfo) && is_object($aInfo)) && ($actions['id'] == $aInfo->id) ) {
      $selected = true;
    }
    
    $actions_array[]=array('selected' => $selected,
                           'link_filename_action_recorder' => xos_href_link(FILENAME_ACTION_RECORDER, xos_get_all_get_params(array('aID')) . 'aID=' . $actions['id']),
                           'module_title' => $module_title,
                           'success_flag' => (($actions['success'] == '1') ? true : false),
                           'user_name' => xos_output_string_protected($actions['user_name']),
                           'user_id' => (int)$actions['user_id'],
                           'date_added' => xos_datetime_short($actions['date_added']));
  }

  if (SID) {
    $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
  }
  
  if (!empty($actions_array) && empty($_GET['search'])) {
    $smarty->assign('link_filename_action_recorder_delete', xos_href_link(FILENAME_ACTION_RECORDER, 'action=expire' . (isset($_GET['module']) && in_array($_GET['module'], $modules_array) ? '&module=' . $_GET['module'] : '')));
  }   

  $smarty->assign(array('form_begin_search' => xos_draw_form('search', FILENAME_ACTION_RECORDER, '', 'get'),
                        'input_search' => xos_draw_input_field('search', (isset($_GET['search']) ? xos_output_string_protected($_GET['search']) : '')),
                        'hidden_module' => xos_draw_hidden_field('module', (isset($_GET['module']) ? xos_output_string_protected($_GET['module']) : '')),
                        'hidden_search' => xos_draw_hidden_field('search', (isset($_GET['search']) ? xos_output_string_protected($_GET['search']) : '')),
                        'form_begin_filter' => xos_draw_form('filter', FILENAME_ACTION_RECORDER, '', 'get'),
                        'pull_down_module' => xos_draw_pull_down_menu('module', $modules_list_array, (isset($_GET['module']) ? xos_output_string_protected($_GET['module']) : ''), 'onchange="this.form.submit();"'),
                        'form_end' => '</form>',
                        'actions' => $actions_array,
                        'nav_bar_number' => $actions_split->display_count($actions_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ENTRIES),
                        'nav_bar_result' => $actions_split->display_links($actions_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], (isset($_GET['module']) && in_array($_GET['module'], $modules_array) && is_object(${$_GET['module']}) ? 'module=' . $_GET['module'] : null) . '&' . (isset($_GET['search']) && !empty($_GET['search']) ? 'search=' . $_GET['search'] : null))));

  require(DIR_WS_BOXES . 'infobox_action_recorder.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'action_recorder');
 
  $output_action_recorder = $smarty->fetch(ADMIN_TPL . '/action_recorder.tpl');
  
  $smarty->assign('central_contents', $output_action_recorder);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif; 
?>
