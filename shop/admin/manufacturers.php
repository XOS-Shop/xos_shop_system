<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : manufacturers.php
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
//              filename: manufacturers.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_MANUFACTURERS) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($_GET['mID'])) $manufacturers_id = xos_db_prepare_input($_GET['mID']);

        if ($action == 'insert') {
          $sql_data_array = array('date_added' => 'now()');
          xos_db_perform(TABLE_MANUFACTURERS, $sql_data_array);
          $manufacturers_id = xos_db_insert_id();
        } elseif ($action == 'save') {
          $sql_data_array = array('last_modified' => 'now()');
          xos_db_perform(TABLE_MANUFACTURERS, $sql_data_array, 'update', "manufacturers_id = '" . (int)$manufacturers_id . "'");
        }
        
        if (!empty($_FILES['manufacturers_image']['name'])) {
          $manufacturers_image = new upload('manufacturers_image', DIR_FS_CATALOG_IMAGES . 'manufacturers/', '777', array('jpg','jpeg','gif','png'));
          if ($manufacturers_image->parse() && $manufacturers_image->save()) {
            $duplicate_image_query = xos_db_query("select count(*) as total from " . TABLE_MANUFACTURERS . " where manufacturers_image = '" . xos_db_input($_POST['current_manufacturer_image']) . "'");
            $duplicate_image = xos_db_fetch_array($duplicate_image_query);          
            if (($duplicate_image['total'] < 2) &! ($_POST['current_manufacturer_image'] == $manufacturers_image->filename)) {
                @unlink(DIR_FS_CATALOG_IMAGES . 'manufacturers/' . $_POST['current_manufacturer_image']);
            }  
            xos_db_query("update " . TABLE_MANUFACTURERS . " set manufacturers_image = '" . $manufacturers_image->filename . "' where manufacturers_id = '" . (int)$manufacturers_id . "'");
          }
        } elseif ($_POST['delete_manufacturer_image'] == 'true') {
          $duplicate_image_query = xos_db_query("select count(*) as total from " . TABLE_MANUFACTURERS . " where manufacturers_image = '" . xos_db_input($_POST['current_manufacturer_image']) . "'");
          $duplicate_image = xos_db_fetch_array($duplicate_image_query);
          if ($duplicate_image['total'] < 2) {            
              @unlink(DIR_FS_CATALOG_IMAGES . 'manufacturers/' . $_POST['current_manufacturer_image']);
          }
          xos_db_query("update " . TABLE_MANUFACTURERS . " set manufacturers_image = '' where manufacturers_id = '" . (int)$manufacturers_id . "'");
        }
 
        $languages = xos_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $manufacturers_name_array = $_POST['manufacturers_name'];
          $manufacturers_url_array = $_POST['manufacturers_url'];
          $language_id = $languages[$i]['id'];

          $sql_data_array = array('manufacturers_name' => xos_db_prepare_input($manufacturers_name_array[$language_id]),
                                  'manufacturers_url' => xos_db_prepare_input($manufacturers_url_array[$language_id]));

          if ($action == 'insert') {
            $insert_sql_data = array('manufacturers_id' => $manufacturers_id,
                                     'languages_id' => $language_id);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            xos_db_perform(TABLE_MANUFACTURERS_INFO, $sql_data_array);
          } elseif ($action == 'save') {
            xos_db_perform(TABLE_MANUFACTURERS_INFO, $sql_data_array, 'update', "manufacturers_id = '" . (int)$manufacturers_id . "' and languages_id = '" . (int)$language_id . "'");
          }
        }
        
        $smarty_cache_control->clearAllCache();

        xos_redirect(xos_href_link(FILENAME_MANUFACTURERS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'mID=' . $manufacturers_id));
        break;
      case 'deleteconfirm':
        $manufacturers_id = xos_db_prepare_input($_GET['mID']);

        if (isset($_POST['delete_image']) && ($_POST['delete_image'] == 'on')) {
          $manufacturer_query = xos_db_query("select manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$manufacturers_id . "'");
          $manufacturer = xos_db_fetch_array($manufacturer_query);
          
          $duplicate_image_query = xos_db_query("select count(*) as total from " . TABLE_MANUFACTURERS . " where manufacturers_image = '" . xos_db_input($manufacturer['manufacturers_image']) . "'");
          $duplicate_image = xos_db_fetch_array($duplicate_image_query);
          if ($duplicate_image['total'] < 2) {          
            $image_location = DIR_FS_CATALOG_IMAGES .'manufacturers/' . $manufacturer['manufacturers_image'];
            @unlink($image_location);
          }  
        }

        xos_db_query("delete from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$manufacturers_id . "'");
        xos_db_query("delete from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturers_id . "'");

        if (isset($_POST['delete_products']) && ($_POST['delete_products'] == 'on')) {
          $products_query = xos_db_query("select products_id from " . TABLE_PRODUCTS . " where manufacturers_id = '" . (int)$manufacturers_id . "'");
          while ($products = xos_db_fetch_array($products_query)) {
            xos_remove_product($products['products_id']);
          }
        } else {
          xos_db_query("update " . TABLE_PRODUCTS . " set products_last_modified = now(), manufacturers_id = '' where manufacturers_id = '" . (int)$manufacturers_id . "'");
        }

        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page']));
        break;
    }
  }
  
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');    

  $manufacturers_query_raw = "select m.manufacturers_id, m.manufacturers_image, m.date_added, m.last_modified, mi.manufacturers_name from " . TABLE_MANUFACTURERS . " m, " . TABLE_MANUFACTURERS_INFO . " mi where m.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['used_lng_id'] . "' order by mi.manufacturers_name";
  $manufacturers_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $manufacturers_query_raw, $manufacturers_query_numrows);
  $manufacturers_query = xos_db_query($manufacturers_query_raw);
  $manufacturers_array = array();
  while ($manufacturers = xos_db_fetch_array($manufacturers_query)) {
    if ((!isset($_GET['mID']) || (isset($_GET['mID']) && ($_GET['mID'] == $manufacturers['manufacturers_id']))) && !isset($mInfo) && (substr($action, 0, 3) != 'new')) {
      $manufacturer_products_query = xos_db_query("select count(*) as products_count from " . TABLE_PRODUCTS . " where manufacturers_id = '" . (int)$manufacturers['manufacturers_id'] . "'");
      $manufacturer_products = xos_db_fetch_array($manufacturer_products_query);

      $mInfo_array = array_merge((array)$manufacturers, (array)$manufacturer_products);
      $mInfo = new objectInfo($mInfo_array);
    }

    $selected = false;

    if (isset($mInfo) && is_object($mInfo) && ($manufacturers['manufacturers_id'] == $mInfo->manufacturers_id)) {
      $selected = true;
      $link_filename_manufacturers = xos_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $manufacturers['manufacturers_id'] . '&action=edit');
    } else {
      $link_filename_manufacturers = xos_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $manufacturers['manufacturers_id']);
    }

    $manufacturers_array[]=array('selected' => $selected,
                                 'link_filename_manufacturers' => $link_filename_manufacturers,
                                 'name' => $manufacturers['manufacturers_name']);
  }

  if (empty($action)) {  
    $smarty->assign('link_filename_manufacturers_action_new', xos_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id . '&action=new'));
  }

  $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                        'manufacturers' => $manufacturers_array,
                        'nav_bar_number' => $manufacturers_split->display_count($manufacturers_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS),
                        'nav_bar_result' => $manufacturers_split->display_links($manufacturers_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));

  require(DIR_WS_BOXES . 'infobox_manufacturers.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'manufacturers');
  $output_manufacturers = $smarty->fetch(ADMIN_TPL . '/manufacturers.tpl');
  
  $smarty->assign('central_contents', $output_manufacturers);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
