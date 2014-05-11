<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : login.php
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
//              filename: login.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_LOGIN) == 'overwrite_all')) :
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    xos_redirect(xos_href_link(FILENAME_COOKIE_USAGE));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_LOGIN);

  $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    $email_address = xos_db_prepare_input($_POST['email_address']);
    $password = xos_db_prepare_input($_POST['password']);

// Check if email exists
    $check_customer_query = xos_db_query("select customers_id, customers_gender, customers_firstname, customers_lastname, customers_group_id, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . xos_db_input($email_address) . "'");

    if (!xos_db_num_rows($check_customer_query)) {
      $error = true;
    } else {
      $check_customer = xos_db_fetch_array($check_customer_query);
// Check that password is good
      if (!xos_validate_password($password, $check_customer['customers_password'])) {
        $error = true;
      } else {
        if (SESSION_RECREATE == 'true') {
          xos_session_recreate();
        }
        
// migrate old hashed password to new phpass password
        if (xos_password_type($check_customer['customers_password']) != 'phpass') {
          xos_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . xos_encrypt_password($password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");
        }
                
// note that tax rates depend on your registered address!
        if ($_GET['skip'] != 'true' && $_POST['email_address'] == SPPC_TOGGLE_LOGIN_PASSWORD ) {
          $existing_customers_query = xos_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id ");   
          while ($existing_customers =  xos_db_fetch_array($existing_customers_query)) {
            $existing_customers_array[] = array("id" => $existing_customers['customers_group_id'], "text" => "&nbsp;".$existing_customers['customers_group_name']."&nbsp;");
          }
          
          $smarty->assign(array('sppc_toggle_login' => true,
                                'customers_groups_pull_down_menu' => xos_draw_pull_down_menu('new_customers_group_id', $existing_customers_array, $check_customer['customers_group_id'], 'id="new_customers_group_id"'),
                                'hidden_field_email_address' => xos_draw_hidden_field('email_address', $_POST['email_address']),
                                'hidden_field_password' => xos_draw_hidden_field('password', $_POST['password'])));
        } else {
        
          $check_country_query = xos_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_customer['customers_id'] . "' and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'");
          $check_country = xos_db_fetch_array($check_country_query);

	  if ($_GET['skip'] == 'true' && $_POST['email_address'] == SPPC_TOGGLE_LOGIN_PASSWORD && isset($_POST['new_customers_group_id']))  {
	    $sppc_customer_group_id = $_POST['new_customers_group_id'];
	    $check_customer_group = xos_db_query("select customers_group_discount, customers_group_show_tax, customers_group_tax_exempt from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" .(int)$_POST['new_customers_group_id'] . "'");
	  } else {
	    $sppc_customer_group_id = $check_customer['customers_group_id'];
	    $check_customer_group = xos_db_query("select customers_group_discount, customers_group_show_tax, customers_group_tax_exempt from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" .(int)$check_customer['customers_group_id'] . "'");
	  }
	  $customer_group = xos_db_fetch_array($check_customer_group);
          if (ACCOUNT_GENDER == 'true') {
            $_SESSION['customer_gender'] = $check_customer['customers_gender'];
          }
          $_SESSION['customer_id'] = $check_customer['customers_id'];
          $_SESSION['customer_default_address_id'] = $check_customer['customers_default_address_id'];
          $_SESSION['customer_first_name'] = $check_customer['customers_firstname'];
          $_SESSION['customer_lastname'] = $check_customer['customers_lastname'];
          $_SESSION['sppc_customer_group_id'] = $sppc_customer_group_id;
          $_SESSION['sppc_customer_group_discount'] = $customer_group['customers_group_discount'];          
          $_SESSION['sppc_customer_group_show_tax'] = (int)$customer_group['customers_group_show_tax'];
          $_SESSION['sppc_customer_group_tax_exempt'] = (int)$customer_group['customers_group_tax_exempt'];         
          $_SESSION['customer_country_id'] = $check_country['entry_country_id'];
          $_SESSION['customer_zone_id'] = $check_country['entry_zone_id'];	  

          xos_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$_SESSION['customer_id'] . "'");

// reset session token
          $_SESSION['sessiontoken'] = md5(xos_rand() . xos_rand() . xos_rand() . xos_rand()); 

// restore cart contents
          $_SESSION['cart']->restore_contents();
          
          $_SESSION['navigation']->remove_current_page();
          
          if (sizeof($_SESSION['navigation']->snapshot) > 0) {
            $origin_href = xos_href_link($_SESSION['navigation']->snapshot['page'], xos_array_to_query_string($_SESSION['navigation']->snapshot['get'], array(xos_session_name())), $_SESSION['navigation']->snapshot['mode']);
            $_SESSION['navigation']->clear_snapshot();
            xos_redirect($origin_href);
          } else {
            xos_redirect(xos_href_link(FILENAME_DEFAULT));
          }                  
        }  
      }
    }
  }

  if ($error == true) {
    $messageStack->add('login', TEXT_LOGIN_ERROR);
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_LOGIN, '', 'SSL'));

  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';            
                
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');                  
  
  if ($messageStack->size('login') > 0) {
    $smarty->assign('message_stack', $messageStack->output('login'));
  }

  if ($_SESSION['cart']->count_contents() > 0) {
    $smarty->assign('cart_contents', true);
  }
  
  if (SEND_EMAILS == 'true') {
    $smarty->assign('link_filename_password_forgotten', xos_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'));
  }
  
  if ($_GET['skip'] != 'true' && $_POST['email_address'] == SPPC_TOGGLE_LOGIN_PASSWORD && $error != true) {
    $smarty->assign('form_begin', xos_draw_form('login', xos_href_link(FILENAME_LOGIN, 'action=process&skip=true', 'SSL'), 'post', '', true));
  } else {
    $smarty->assign('form_begin', xos_draw_form('login', xos_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', '', true));
  } 

  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';        
    $back_link = xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']);
  } else {
    $back_link = 'javascript:history.go(-1)';
  }
  
  $popup_status_query = xos_db_query("select status from " . TABLE_CONTENTS . "  where type = 'system_popup' and status = '1' and content_id = '9' LIMIT 1");
  
  $smarty->assign(array('link_filename_create_account' => xos_href_link(FILENAME_CREATE_ACCOUNT, 'rmp=0', 'SSL'),
                        'link_back' => $back_link,
                        'input_field_email_address' => xos_draw_input_field('email_address', '', 'id="email_address"'),
                        'input_field_password' => xos_draw_password_field('password', '', 'id="password"'),
                        'link_filename_popup_content_9' => xos_db_num_rows($popup_status_query) ? xos_href_link(FILENAME_POPUP_CONTENT, 'content_id=9', $request_type) : '',
                        'store_name' => STORE_NAME,
                        'form_end' => '</form>'));   

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'login');
  $output_login = $smarty->fetch(SELECTED_TPL . '/login.tpl');
                        
  $smarty->assign('central_contents', $output_login);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
