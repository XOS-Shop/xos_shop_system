<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : login_my_account.php
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
//              Copyright (c) 2002 osCommerce
//              filename: search.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/login_my_account.php') == 'overwrite_all')) : 
  if (CACHE_LEVEL > 1 && !isset($_SESSION['customer_id']) && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L2|box_login_my_account|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'];
  }
  
  if(!$smarty->isCached(SELECTED_TPL . '/includes/boxes/login_my_account.tpl', $cache_id)){

    if (isset($_SESSION['customer_first_name']) && isset($_SESSION['customer_id'])) {
      if (ACCOUNT_GENDER == 'true' && isset($_SESSION['customer_gender']) && $_SESSION['customer_gender'] != '') {
        $box_welcome_string = sprintf(BOX_TEXT_GREETING_PERSONAL, ($_SESSION['customer_gender'] == 'm' ? MALE_ADDRESS : FEMALE_ADDRESS) . '<br />' . xos_output_string_protected($_SESSION['customer_first_name']) . '&nbsp;' . xos_output_string_protected($_SESSION['customer_lastname']));
      } else {
        $box_welcome_string = sprintf(BOX_TEXT_GREETING_PERSONAL, xos_output_string_protected($_SESSION['customer_first_name']) . '&nbsp;' . xos_output_string_protected($_SESSION['customer_lastname'])); 
      }
    } else {
      $box_welcome_string = BOX_TEXT_GREETING_GUEST;
    }

    if (SEND_EMAILS == 'true') {
      $smarty->assign('box_login_my_account_link_filename_password_forgotten', xos_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'));
    }
                 
    $smarty->assign(array('box_login_my_account_link_filename_create_account' => xos_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'),
                          'box_login_my_account_link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL'),
                          'box_login_my_account_link_filename_account_edit' => xos_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'),
                          'box_login_my_account_link_filename_account_history' => xos_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'),
                          'box_login_my_account_link_filename_address_book' => xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'),
                          'box_login_my_account_link_filename_account_notifications' => (PRODUCT_NOTIFICATION_ENABLED == 'true') ? xos_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') : '',
                          'box_login_my_account_link_filename_logoff' => xos_href_link(FILENAME_LOGOFF, '', 'SSL'),
                          'box_login_my_account_display_box_my_account' => isset($_SESSION['customer_id']) ? true : false,
                          'box_login_my_account_welcome_string' => $box_welcome_string,
                          'box_login_my_account_input_field_email_address' => xos_draw_input_field('email_address', '', 'id="box_login_email_address" size="10" maxlength="40" style="width: 130px"'),
                          'box_login_my_account_input_field_password' => xos_draw_password_field('password', '', 'id="box_login_password" size="10" style="width: 130px"'),
                          'box_login_my_account_form_begin' => xos_draw_form('box_login', xos_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', '', true),
                          'box_login_my_account_form_end' => '</form>'));
  }
  
  $output_login_my_account = $smarty->fetch(SELECTED_TPL . '/includes/boxes/login_my_account.tpl', $cache_id);

  $smarty->caching = 0;                            
                        
  $smarty->assign('box_login_my_account', $output_login_my_account);  
endif;
?>
