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
//              Copyright (c) 2002 osCommerce
//              filename: logoff.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_LOGOFF) == 'overwrite_all')) :
//xos_session_destroy();
  unset($_SESSION['login_id']);
  unset($_SESSION['login_firstname']);
  unset($_SESSION['login_groups_id']);
  unset($_SESSION['selected_box']);

  $javascript = '<script type="text/javascript">' . "\n" .   
                '/* <![CDATA[ */' . "\n" .
                'function center() {' . "\n" .
                '  var height = document.getElementById("text").offsetHeight;' . "\n" .
                '  var marg = (height / 2);' . "\n" .
                '  document.getElementById("spacer").style.margin = "-" + marg + "px" + " 0px" + " 0px" + " 0px";' . "\n" .
                '}' . "\n" .                   
                '/* ]]> */' . "\n" .
                '</script>' . "\n";                                  

  require(DIR_WS_INCLUDES . 'html_header_with_special_stylesheet.php'); 
  require(DIR_WS_INCLUDES . 'footer.php');

  $smarty->assign(array('link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'link_catalog' => xos_catalog_href_link(),
                        'link_filename_login' => xos_href_link(FILENAME_LOGIN)));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'logoff');

  $smarty->display(ADMIN_TPL . '/logoff.tpl');
  
  unset($_SESSION['language']);
  unset($_SESSION['languages_id']);
  unset($_SESSION['used_lng_id']);
endif;  
?>
