<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : tax_classes.php
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
//              filename: tax_classes.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_TAX_CLASSES) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert':
        $tax_class_title = xos_db_prepare_input($_POST['tax_class_title']);
        $tax_class_description = xos_db_prepare_input($_POST['tax_class_description']);
        $check_query = xos_db_query("select tax_class_title from " . TABLE_TAX_CLASS . " where tax_class_title = '" . xos_db_input($tax_class_title) . "'");
        if (xos_db_num_rows($check_query) || $tax_class_title == '') {
          xos_redirect(xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $_GET['tID'] . '&tax_class_title=' . $tax_class_title . '&tax_class_description=' . $tax_class_description . '&action=new&error_title=' . $tax_class_title));
        }
        
        xos_db_query("insert into " . TABLE_TAX_CLASS . " (tax_class_title, tax_class_description, date_added) values ('" . xos_db_input($tax_class_title) . "', '" . xos_db_input($tax_class_description) . "', now())");
        $new_tax_class_id = xos_db_insert_id();
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $new_tax_class_id));
        break;
      case 'save':
        $tax_class_id = xos_db_prepare_input($_GET['tID']);
        $tax_class_title = xos_db_prepare_input($_POST['tax_class_title']);
        $actual_tax_class_title = xos_db_prepare_input($_POST['actual_tax_class_title']);
        $tax_class_description = xos_db_prepare_input($_POST['tax_class_description']);
        if (mb_strtolower($actual_tax_class_title) != mb_strtolower($tax_class_title)) {
          $check_query = xos_db_query("select tax_class_title from " . TABLE_TAX_CLASS . " where tax_class_title = '" . xos_db_input($tax_class_title) . "'");
          if (xos_db_num_rows($check_query) || $tax_class_title == '') {
            xos_redirect(xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $_GET['tID'] . '&tax_class_title=' . $tax_class_title . '&tax_class_description=' . $tax_class_description . '&action=edit&error_title=' . $tax_class_title));
          }
        }             

        xos_db_query("update " . TABLE_TAX_CLASS . " set tax_class_id = '" . (int)$tax_class_id . "', tax_class_title = '" . xos_db_input($tax_class_title) . "', tax_class_description = '" . xos_db_input($tax_class_description) . "', last_modified = now() where tax_class_id = '" . (int)$tax_class_id . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tax_class_id));
        break;
      case 'deleteconfirm':
        $tax_class_id = xos_db_prepare_input($_GET['tID']);

        xos_db_query("delete from " . TABLE_TAX_CLASS . " where tax_class_id = '" . (int)$tax_class_id . "'");
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page']));
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n"; 
    
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');      

  $classes_query_raw = "select tax_class_id, tax_class_title, tax_class_description, last_modified, date_added from " . TABLE_TAX_CLASS . " order by tax_class_title";
  $classes_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $classes_query_raw, $classes_query_numrows);
  $classes_query = xos_db_query($classes_query_raw);
  $classes_array = array();
  while ($classes = xos_db_fetch_array($classes_query)) {
    if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID'] == $classes['tax_class_id']))) && !isset($tcInfo) && (substr($action, 0, 3) != 'new')) {
      $tcInfo = new objectInfo($classes);
    }
    
    $selected = false;

    if (isset($tcInfo) && is_object($tcInfo) && ($classes['tax_class_id'] == $tcInfo->tax_class_id)) {
      $selected = true;
      $link_filename_tax_classes = xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id . '&action=edit');
    } else {
      $link_filename_tax_classes = xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $classes['tax_class_id']);
    }

    $classes_array[]=array('selected' => $selected,
                           'link_filename_tax_classes' => $link_filename_tax_classes,
                           'tax_class_title' => $classes['tax_class_title']);
  }

  if (empty($action)) {
    $smarty->assign('link_filename_tax_classes_action_new', xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id . '&action=new'));
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'classes' => $classes_array,
                        'nav_bar_number' => $classes_split->display_count($classes_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES),
                        'nav_bar_result' => $classes_split->display_links($classes_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));  

  require(DIR_WS_BOXES . 'infobox_tax_classes.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'tax_classes');
  $output_tax_classes = $smarty->fetch(ADMIN_TPL . '/tax_classes.tpl');
  
  $smarty->assign('central_contents', $output_tax_classes);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
