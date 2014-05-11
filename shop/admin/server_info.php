<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : server_info.php
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
//              filename: server_info.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_SERVER_INFO) == 'overwrite_all')) :  
  $style = '<style type="text/css">' . "\n" .
           '/* <![CDATA[ */' . "\n" .
           '.center {font-family: sans-serif; font-size: 10px;}' . "\n" .                
           '.p {text-align: left;}' . "\n" .
           '.e {background-color: #ccccff; font-weight: bold;}' . "\n" .
           '.h {background-color: #9999cc; font-weight: bold;}' . "\n" .
           '.v {background-color: #cccccc;}' . "\n" .
           'i {color: #666666;}' . "\n" .
           'hr {display: none;}' . "\n" .
           '/* ]]> */' . "\n" .
           '</style>' . "\n";

  $javascript = '';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  ob_start();
  phpinfo();
  $phpinfo = ob_get_contents();
  ob_end_clean();
  $phpinfo = str_replace('border: 1px', '', $phpinfo);
  preg_match('!<body>(.*)</body>!is', $phpinfo, $regs);
  
  $smarty->assign(array('system' => xos_get_system_information(),
                        'phpinfo' => $regs[1],
                        'project_version' => PROJECT_VERSION));    

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'server_info');
  $output_server_info = $smarty->fetch(ADMIN_TPL . '/server_info.tpl');
  
  $smarty->assign('central_contents', $output_server_info);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
