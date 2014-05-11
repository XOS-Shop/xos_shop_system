<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : create_account_success.php
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
//              filename: create_account_success.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CREATE_ACCOUNT_SUCCESS) == 'overwrite_all')) : 
  $_SESSION['navigation']->remove_current_page();

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CREATE_ACCOUNT_SUCCESS);

  $site_trail->add(NAVBAR_TITLE_1);
  $site_trail->add(NAVBAR_TITLE_2);

  if (sizeof($_SESSION['navigation']->snapshot) > 0) {
    $origin_href = xos_href_link($_SESSION['navigation']->snapshot['page'], xos_array_to_query_string($_SESSION['navigation']->snapshot['get'], array(xos_session_name())), $_SESSION['navigation']->snapshot['mode']);
    $_SESSION['navigation']->clear_snapshot();
  } else {
    $origin_href = xos_href_link(FILENAME_DEFAULT);
  }
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');
  
  if (SEND_EMAILS == 'true') {
    $smarty->assign('email', true);
  }
  
  $smarty->assign(array('link_continue' => $origin_href,
                        'link_filename_contact_us' => xos_href_link(FILENAME_CONTACT_US)));    

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'create_account_success');
  $output_create_account_success = $smarty->fetch(SELECTED_TPL . '/create_account_success.tpl');

                        
  $smarty->assign('central_contents', $output_create_account_success);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
