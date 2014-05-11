<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : logoff.php
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
//              filename: logoff.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_LOGOFF) == 'overwrite_all')) :
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_LOGOFF);

  $site_trail->add(NAVBAR_TITLE);

  unset($_SESSION['customer_id'],
        $_SESSION['customer_default_address_id'],
        $_SESSION['customer_gender'],
        $_SESSION['customer_first_name'],
        $_SESSION['customer_lastname'],  
        $_SESSION['sppc_customer_group_id'],
        $_SESSION['sppc_customer_group_discount'],
        $_SESSION['sppc_customer_group_show_tax'],
        $_SESSION['sppc_customer_group_tax_exempt'], 
        $_SESSION['customer_country_id'],
        $_SESSION['customer_zone_id'],
        $_SESSION['billto'],
        $_SESSION['sendto'],  
        $_SESSION['shipping'],
        $_SESSION['payment'],
        $_SESSION['comments']);

  $_SESSION['cart']->reset(); 
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  $smarty->assign('link_filename_default', xos_href_link(FILENAME_DEFAULT));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'logoff');
  $output_logoff = $smarty->fetch(SELECTED_TPL . '/logoff.tpl');
                        
  $smarty->assign('central_contents', $output_logoff);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
