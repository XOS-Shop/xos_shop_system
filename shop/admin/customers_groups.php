<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : customers_groups.php
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
//              Copyright (c) 2005 osCommerce
//              filename: customers_groups.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_CUSTOMERS_GROUPS) == 'overwrite_all')) :  
  $cg_show_tax_array = array(array('id' => '1', 'text' => ENTRY_GROUP_SHOW_TAX_YES),
                             array('id' => '0', 'text' => ENTRY_GROUP_SHOW_TAX_NO));
  $cg_tax_exempt_array = array(array('id' => '1', 'text' => ENTRY_GROUP_TAX_EXEMPT_YES),
                               array('id' => '0', 'text' => ENTRY_GROUP_TAX_EXEMPT_NO));
  
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {

      case 'update':
        $error = false;
	  $customers_group_id = xos_db_prepare_input($_GET['cID']);
		$customers_group_name = xos_db_prepare_input($_POST['customers_group_name']);
		$customers_group_discount = xos_db_prepare_input($_POST['customers_group_discount']);
		$customers_group_show_tax = xos_db_prepare_input($_POST['customers_group_show_tax']);
		$customers_group_tax_exempt = xos_db_prepare_input($_POST['customers_group_tax_exempt']);
		$group_payment_allowed = '';
		if ($_POST['payment_allowed'] && $_POST['group_payment_settings'] == '1') {
		  reset($_POST['payment_allowed']);
		  while(list($key, $val) = each($_POST['payment_allowed'])) {
		    if ($val == true) { 
		    $group_payment_allowed .= xos_db_prepare_input($val).';'; 
		    }
		  } // end while
		  $group_payment_allowed = substr($group_payment_allowed,0,strlen($group_payment_allowed)-1);
		} // end if ($_POST['payment_allowed'])
		$group_shipment_allowed = '';
		if ($_POST['shipping_allowed'] && $_POST['group_shipment_settings'] == '1') {
		  reset($_POST['shipping_allowed']);
		  while(list($key, $val) = each($_POST['shipping_allowed'])) {
		    if ($val == true) { 
		    $group_shipment_allowed .= xos_db_prepare_input($val).';'; 
		    }
		  } // end while
		  $group_shipment_allowed = substr($group_shipment_allowed,0,strlen($group_shipment_allowed)-1);
		} // end if ($_POST['shipment_allowed'])

        xos_db_query("update " . TABLE_CUSTOMERS_GROUPS . " set customers_group_name='" . $customers_group_name . "', customers_group_discount='" . $customers_group_discount . "', customers_group_show_tax = '" . $customers_group_show_tax . "', customers_group_tax_exempt = '" . $customers_group_tax_exempt . "', group_payment_allowed = '". $group_payment_allowed ."', group_shipment_allowed = '". $group_shipment_allowed ."' where customers_group_id = " . xos_db_input($customers_group_id) );
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_CUSTOMERS_GROUPS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $customers_group_id));
        break;
        
      case 'deleteconfirm':
        $group_id = xos_db_prepare_input($_GET['cID']);
        xos_db_query("delete from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id= " . $group_id);
        xos_db_query("delete from " . TABLE_PRODUCTS_PRICES . " where customers_group_id = " . $group_id);
        xos_db_query("delete from " . TABLE_SPECIALS . " where customers_group_id = " . $group_id); 
        $customers_id_query = xos_db_query("select customers_id from " . TABLE_CUSTOMERS . " where customers_group_id=" . $group_id);
        while($customers_id = xos_db_fetch_array($customers_id_query)) {
            xos_db_query("update " . TABLE_CUSTOMERS . " set customers_group_id = '0' where customers_id=" . $customers_id['customers_id']);
        }
        
        $smarty_cache_control->clearAllCache();
             
        xos_redirect(xos_href_link(FILENAME_CUSTOMERS_GROUPS, xos_get_all_get_params(array('cID', 'action')))); 
        break;
        
      case 'newconfirm':
        $customers_group_name = xos_db_prepare_input($_POST['customers_group_name']);
        $customers_group_discount = xos_db_prepare_input($_POST['customers_group_discount']);
        $customers_group_show_tax = xos_db_prepare_input($_POST['customers_group_show_tax']);
	$customers_group_tax_exempt = xos_db_prepare_input($_POST['customers_group_tax_exempt']);
	$group_payment_allowed = '';
	if ($_POST['payment_allowed'] && $_POST['group_payment_settings'] == '1') {
	      reset($_POST['payment_allowed']);
	      while(list($key, $val) = each($_POST['payment_allowed'])) {
	         if ($val == true) { 
	         $group_payment_allowed .= xos_db_prepare_input($val).';'; 
	         }
	      } // end while
	   $group_payment_allowed = substr($group_payment_allowed,0,strlen($group_payment_allowed)-1);
	} // end if ($_POST['payment_allowed'])
		$group_shipment_allowed = '';
		if ($_POST['shipping_allowed'] && $_POST['group_shipment_settings'] == '1') {
		  reset($_POST['shipping_allowed']);
		  while(list($key, $val) = each($_POST['shipping_allowed'])) {
		    if ($val == true) { 
		    $group_shipment_allowed .= xos_db_prepare_input($val).';'; 
		    }
		  } // end while
		  $group_shipment_allowed = substr($group_shipment_allowed,0,strlen($group_shipment_allowed)-1);
		} // end if ($_POST['shipment_allowed'])        
        $new_cg_id = LAST_CUSTOMERS_GROUPS_ID + 1;        
        xos_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . (int)$new_cg_id . "', last_modified = now() where configuration_key = 'LAST_CUSTOMERS_GROUPS_ID'");
        xos_db_query("insert into " . TABLE_CUSTOMERS_GROUPS . " set customers_group_id = '" . $new_cg_id . "', customers_group_name = '" . $customers_group_name . "', customers_group_discount='" . $customers_group_discount . "', customers_group_show_tax = '" . $customers_group_show_tax . "', customers_group_tax_exempt = '" . $customers_group_tax_exempt . "', group_payment_allowed = '". $group_payment_allowed ."', group_shipment_allowed = '". $group_shipment_allowed ."'");              
        $special_prices_query = xos_db_query("select products_id, specials_new_products_price, expires_date, status, error from " . TABLE_SPECIALS . " where customers_group_id = '0'");
        while ($special_prices = xos_db_fetch_array($special_prices_query)) {
          $special_expires_date = ($special_prices['expires_date'] == null) ? 'null' : xos_db_input($special_prices['expires_date']);
          xos_db_perform(TABLE_SPECIALS, array('products_id' => xos_db_input($special_prices['products_id']), 'customers_group_id' => $new_cg_id, 'specials_new_products_price' => xos_db_input($special_prices['specials_new_products_price']), 'expires_date' => $special_expires_date, 'status' => xos_db_input($special_prices['status']), 'error' => xos_db_input($special_prices['error'])));
        }
        
        $smarty_cache_control->clearAllCache();
                                 
        xos_redirect(xos_href_link(FILENAME_CUSTOMERS_GROUPS, xos_get_all_get_params(array('action'))));
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";

  if ($action == 'edit' || $action == 'new') {
  
    $javascript .= '<script type="text/javascript">' . "\n\n" .
    
                   '/* <![CDATA[ */' . "\n" .
                   'function check_form() {' . "\n" .
                   '  var error = 0;' . "\n\n" .

                   '  var customers_group_name = document.customers.customers_group_name.value;' . "\n\n" .
  
                   '  if (customers_group_name == "") {' . "\n" .
                   '    error_message = "' . ERROR_CUSTOMERS_GROUP_NAME . '";' . "\n" .
                   '    error = 1;' . "\n" .
                   '  }' . "\n\n" .

                   '  if (error == 1) {' . "\n" .
                   '    alert(error_message);' . "\n" .
                   '    return false;' . "\n" .
                   '  } else {' . "\n" .
                   '    return true;' . "\n" .
                   '  }' . "\n" .  
                   '}' . "\n\n" .
                   
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n";
  }
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');                       

  if ($action == 'edit') {
    $customers_groups_query = xos_db_query("select c.customers_group_id, c.customers_group_name, c.customers_group_discount, c.customers_group_show_tax, c.customers_group_tax_exempt, c.group_payment_allowed, c.group_shipment_allowed from " . TABLE_CUSTOMERS_GROUPS . " c  where c.customers_group_id = '" . $_GET['cID'] . "'");
    $customers_groups = xos_db_fetch_array($customers_groups_query);
    $cInfo = new objectInfo($customers_groups);
    
    $payments_allowed = explode (";",$cInfo->group_payment_allowed);
    $shipment_allowed = explode (";",$cInfo->group_shipment_allowed);
    $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
    $ship_module_directory = DIR_FS_CATALOG_MODULES . 'shipping/';

    $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
    $directory_array = array();
    if ($dir = @dir($module_directory)) {
      while ($file = $dir->read()) {
        if (!is_dir($module_directory . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension) {
            $directory_array[] = $file; // array of all the payment modules present in includes/modules/payment
          }
        }
      }
      sort($directory_array);
      $dir->close();
    }

    $ship_directory_array = array();
    if ($dir = @dir($ship_module_directory)) {
      while ($file = $dir->read()) {
        if (!is_dir($ship_module_directory . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension) {
            $ship_directory_array[] = $file; // array of all shipping modules present in includes/modules/shipping
          }
        }
      }
      sort($ship_directory_array);
      $dir->close();
    }

    $module_active = explode (";",MODULE_PAYMENT_INSTALLED);
    $payment_allowed_array = array();
    for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
      $file = $directory_array[$i];
      if (in_array ($directory_array[$i], $module_active)) {      
        include($module_directory . $file);      
        include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/payment/' . $file);      
        $class = substr($file, 0, strrpos($file, '.'));
        if (xos_class_exists($class)) {      
          $module = new $class;
          if ($module->enabled) {
            $payment_allowed_array[]=array('group_payment_allowed_in_out_values' => xos_draw_checkbox_field('payment_allowed[' . $i . ']', $module->code.".php" , (in_array ($module->code.".php", $payments_allowed)) ?  1 : 0),
                                           'group_payment_allowed_title' => $module->title);   
          }
        }      
      } 
    }
    
    $smarty->assign('payment_allowed', $payment_allowed_array);

    $ship_module_active = explode (";",MODULE_SHIPPING_INSTALLED);
    $shipping_allowed_array = array();
    for ($i = 0, $n = sizeof($ship_directory_array); $i < $n; $i++) {
      $file = $ship_directory_array[$i];
      if (in_array ($ship_directory_array[$i], $ship_module_active)) {     
        include($ship_module_directory . $file);      
        include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/shipping/' . $file);           
        $ship_class = substr($file, 0, strrpos($file, '.'));
        if (xos_class_exists($ship_class)) {        
          $ship_module = new $ship_class;
          if ($ship_module->enabled) {            
            $shipping_allowed_array[]=array('group_shipping_allowed_in_out_values' => xos_draw_checkbox_field('shipping_allowed[' . $i . ']', $ship_module->code.".php" , (in_array ($ship_module->code.".php", $shipment_allowed)) ?  1 : 0),
                                            'group_shipping_allowed_title' => $ship_module->title);
          }
        }        
      }
    }
    
    $smarty->assign(array('shipping_allowed' => $shipping_allowed_array,
                          'edit' => true,
                          'form_begin_customers_update' => xos_draw_form('customers', FILENAME_CUSTOMERS_GROUPS, xos_get_all_get_params(array('action')) . 'action=update', 'post', 'onsubmit="return check_form();"'),
                          'group_name_in_out_values' => xos_draw_input_field('customers_group_name', $cInfo->customers_group_name, 'maxlength="32"', false),
                          'group_discount_in_out_values' => xos_draw_input_field('customers_group_discount', $cInfo->customers_group_discount, 'maxlength="5" size="5"', false),
                          'group_show_tax_in_out_values' => xos_draw_pull_down_menu('customers_group_show_tax', $cg_show_tax_array, (($cInfo->customers_group_show_tax == '1') ? '1' : '0')),
                          'group_tax_exempt_in_out_values' => xos_draw_pull_down_menu('customers_group_tax_exempt', $cg_tax_exempt_array, (($cInfo->customers_group_tax_exempt == '1') ? '1' : '0')),
                          'group_payment_settings_in_out_values_1' => xos_draw_radio_field('group_payment_settings', '1', false, (xos_not_null($cInfo->group_payment_allowed)? '1' : '0' )),
                          'group_payment_settings_in_out_values_0' => xos_draw_radio_field('group_payment_settings', '0', false, (xos_not_null($cInfo->group_payment_allowed)? '1' : '0' )),
                          'group_shipment_settings_in_out_values_1' => xos_draw_radio_field('group_shipment_settings', '1', false, (xos_not_null($cInfo->group_shipment_allowed)? '1' : '0' )),
                          'group_shipment_settings_in_out_values_0' => xos_draw_radio_field('group_shipment_settings', '0', false, (xos_not_null($cInfo->group_shipment_allowed)? '1' : '0' )),
                          'link_filename_customers_groups' => xos_href_link(FILENAME_CUSTOMERS_GROUPS, xos_get_all_get_params(array('action'))),
                          'form_end' => '</form>'));   
    
  } else if($action == 'new') {   
    
    $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
    $ship_module_directory = DIR_FS_CATALOG_MODULES . 'shipping/';

// code slightly adapted from admin/modules.php
    $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
    $directory_array = array();
    if ($dir = @dir($module_directory)) {
      while ($file = $dir->read()) {
        if (!is_dir($module_directory . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension) {
            $directory_array[] = $file; // array of all the payment modules present in includes/modules/payment
          }
        }
      }
      $dir->close();
    } // end if ($dir = @dir($module_directory))

    $ship_directory_array = array();
    if ($dir = @dir($ship_module_directory)) {
      while ($file = $dir->read()) {
        if (!is_dir($ship_module_directory . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension) {
            $ship_directory_array[] = $file; // array of all shipping modules present in includes/modules/shipping
          }
        }
      }
      sort($ship_directory_array);
      $dir->close();
    }
    
    $module_active = explode (";",MODULE_PAYMENT_INSTALLED);
    $payment_allowed_array = array();    
    for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
      $file = $directory_array[$i];
      if (in_array ($directory_array[$i], $module_active)) {
        include($module_directory . $file);      
        include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/payment/' . $file);
        $class = substr($file, 0, strrpos($file, '.'));
        if (xos_class_exists($class)) {
          $module = new $class;
          if ($module->enabled) {            
            $payment_allowed_array[]=array('group_payment_allowed_in_values' => xos_draw_checkbox_field('payment_allowed[' . $y . ']', $file , 0),
                                           'group_payment_allowed_title' => $module->title);            
          }
        }
      }
    }
    
    $smarty->assign('payment_allowed', $payment_allowed_array);

    $ship_module_active = explode (";",MODULE_SHIPPING_INSTALLED);
    $shipping_allowed_array = array();
    for ($i = 0, $n = sizeof($ship_directory_array); $i < $n; $i++) {
      $file = $ship_directory_array[$i];
      if (in_array ($ship_directory_array[$i], $ship_module_active)) {
        include($ship_module_directory . $file);      
        include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/shipping/' . $file);
        $ship_class = substr($file, 0, strrpos($file, '.'));
        if (xos_class_exists($ship_class)) {
          $ship_module = new $ship_class;
          if ($ship_module->enabled) {            
            $shipping_allowed_array[]=array('group_shipping_allowed_in_values' => xos_draw_checkbox_field('shipping_allowed[' . $y . ']', $file , 0),
                                            'group_shipping_allowed_title' => $ship_module->title);            
          }
        }
      }
    }
    
    $smarty->assign(array('shipping_allowed' => $shipping_allowed_array,
                          'new' => true,
                          'form_begin_customers_new' => xos_draw_form('customers', FILENAME_CUSTOMERS_GROUPS, xos_get_all_get_params(array('action')) . 'action=newconfirm', 'post', 'onsubmit="return check_form();"'),
                          'group_name_in_values' => xos_draw_input_field('customers_group_name', '', 'maxlength="32"', false),
                          'group_discount_in_out_values' => xos_draw_input_field('customers_group_discount', $cInfo->customers_group_discount, 'maxlength="5" size="5"', false),
                          'group_show_tax_in_values' => xos_draw_pull_down_menu('customers_group_show_tax', $cg_show_tax_array, '1'),
                          'group_tax_exempt_in_values' => xos_draw_pull_down_menu('customers_group_tax_exempt', $cg_tax_exempt_array, '0'),
                          'group_payment_settings_in_values_1' => xos_draw_radio_field('group_payment_settings', '1', false, '0'),
                          'group_payment_settings_in_values_0' => xos_draw_radio_field('group_payment_settings', '0', false, '0'),
                          'group_shipment_settings_in_values_1' => xos_draw_radio_field('group_shipment_settings', '1', false, (xos_not_null($cInfo->group_shipment_allowed)? '1' : '0' )),
                          'group_shipment_settings_in_values_0' => xos_draw_radio_field('group_shipment_settings', '0', false, (xos_not_null($cInfo->group_shipment_allowed)? '1' : '0' )),
                          'link_filename_customers_groups' => xos_href_link(FILENAME_CUSTOMERS_GROUPS, xos_get_all_get_params(array('action','cID'))),
                          'form_end' => '</form>'));

  } else {

          switch ($_GET[listing]) {
              case "group":
              $order = "g.customers_group_name";
              break;
              case "group-desc":
              $order = "g.customers_group_name DESC";
              break;
              default:
              $order = "g.customers_group_id ASC";
          }

    $search_string = '';
    if ( ($_GET['search']) && (xos_not_null($_GET['search'])) ) {
      $keywords = xos_db_input(xos_db_prepare_input($_GET['search']));
      $search_string = "where g.customers_group_name like '%" . $keywords . "%'";
    }

    $customers_groups_query_raw = "select g.customers_group_id, g.customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " g  " . $search_string . " order by $order";
    $customers_groups_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $customers_groups_query_raw, $customers_groups_query_numrows);
    $customers_groups_query = xos_db_query($customers_groups_query_raw);
    $customers_groups_array = array();
    while ($customers_groups = xos_db_fetch_array($customers_groups_query)) {
      $info_query = xos_db_query("select customers_info_date_account_created as date_account_created, customers_info_date_account_last_modified as date_account_last_modified, customers_info_date_of_last_logon as date_last_logon, customers_info_number_of_logons as number_of_logons from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . $customers_groups['customers_group_id'] . "'");
      $info = xos_db_fetch_array($info_query);

      if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $customers_groups['customers_group_id']))) && !isset($cInfo)) {
        $cInfo = new objectInfo($customers_groups);
      }
      
      $selected = false;

      if ( (is_object($cInfo)) && ($customers_groups['customers_group_id'] == $cInfo->customers_group_id) ) {
        $selected = true;
        $link_filename_customers_groups = xos_href_link(FILENAME_CUSTOMERS_GROUPS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id . '&action=edit');
      } else {
        $link_filename_customers_groups = xos_href_link(FILENAME_CUSTOMERS_GROUPS, xos_get_all_get_params(array('cID')) . 'cID=' . $customers_groups['customers_group_id']);
      }

      $customers_groups_array[]=array('selected' => $selected,
                                      'link_filename_customers_groups' => $link_filename_customers_groups,
                                      'group_name' => $customers_groups['customers_group_name']);
    }

    if (SID) {
      $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
    }

    $smarty->assign(array('form_begin_search' => xos_draw_form('search', FILENAME_CUSTOMERS_GROUPS, '', 'get'),
                          'input_search' => xos_draw_input_field('search'),
                          'form_end' => '</form>',
                          'link_filename_customers_groups_sort_asc' => xos_href_link(FILENAME_CUSTOMERS_GROUPS, 'listing=group'),
                          'text_sort_asc' => ICON_TITLE_IC_UP_TEXT_SORT . ' ' . TABLE_HEADING_NAME . ' ' . ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC,
                          'link_filename_customers_groups_sort_desc' => xos_href_link(FILENAME_CUSTOMERS_GROUPS, 'listing=group-desc'),
                          'text_sort_desc' => ICON_TITLE_IC_DOWN_TEXT_SORT . ' ' . TABLE_HEADING_NAME . ' ' . ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX,
                          'customers_groups' => $customers_groups_array,
                          'nav_bar_number' => $customers_groups_split->display_count($customers_groups_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS_GROUPS),
                          'nav_bar_result' => $customers_groups_split->display_links($customers_groups_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], xos_get_all_get_params(array('page', 'info', 'x', 'y', 'cID')))));
    
    if (isset($_GET['search']) && xos_not_null($_GET['search'])) {      
      $smarty->assign('link_filename_customers_groups_reset', xos_href_link(FILENAME_CUSTOMERS_GROUPS));
    } else {
      $smarty->assign('link_filename_customers_groups_insert', xos_href_link(FILENAME_CUSTOMERS_GROUPS, 'page=' . $_GET['page'] . '&action=new'));
    } 

    require(DIR_WS_BOXES . 'infobox_customers_groups.php');
  }

  $smarty->assign('BODY_TAG_PARAMS', 'onload="SetFocus();"');
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'customers_groups');
  $output_customers_groups = $smarty->fetch(ADMIN_TPL . '/customers_groups.tpl');
  
  $smarty->assign('central_contents', $output_customers_groups);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;    
?>
