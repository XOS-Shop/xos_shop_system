<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : install_3.php
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
//              filename: install_3.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  reset($_POST);
  $body_tag_params = 'onload="dbImport(\'includes/install_db.php\', \'';     
  while (list($key, $value) = each($_POST)) {
    if (($key != 'x') && ($key != 'y') && ($key != 'DB_TEST_CONNECTION')) {
      if (is_array($value)) {
        for ($i=0; $i<sizeof($value); $i++) {
          $body_tag_params .= $key . '[]=' . $value[$i] . '&amp;';
        }
      } else {
        $body_tag_params .= $key . '=' . $value . '&amp;';
      }
    }
  }
      
  $body_tag_params .= '\')"';
         
  $smarty->assign('body_tag_params', $body_tag_params);
                                   
  $output_install_3 = $smarty->fetch('install_3.tpl');
                                                    
  $smarty->assign('install_inner_content', $output_install_3);    
?>