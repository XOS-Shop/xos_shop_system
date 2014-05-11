<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : install_5.php
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
//              filename: install_5.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  reset($_POST);
  $hidden_fields = '';  
  while (list($key, $value) = each($_POST)) {
    if (($key != 'x') && ($key != 'y') && ($key != 'DB_SERVER') && ($key != 'DB_SERVER_USERNAME') && ($key != 'DB_SERVER_PASSWORD') && ($key != 'DB_DATABASE') && ($key != 'USE_PCONNECT') && ($key != 'STORE_SESSIONS')) {
      if (is_array($value)) {
        for ($i=0; $i<sizeof($value); $i++) {
          $hidden_fields .= xos_draw_hidden_field($key . '[]', $value[$i]);
        }
      } else {
        $hidden_fields .= xos_draw_hidden_field($key, $value);
      }
    }
  }
  
  $smarty->assign(array('form_begin' => '<form name="install" action="install.php?step=6" method="post">',
                        'form_end' => '</form>',
                        'input_field_server' => xos_draw_input_field('DB_SERVER'),
                        'input_field_username' => xos_draw_input_field('DB_SERVER_USERNAME'),
                        'password_field' => xos_draw_password_field('DB_SERVER_PASSWORD'),
                        'input_field_database' => xos_draw_input_field('DB_DATABASE'),
                        'checkbox_field_pconnect' => xos_draw_checkbox_field('USE_PCONNECT', 'true'),
                        'radio_field_store_sessions_files' => xos_draw_radio_field('STORE_SESSIONS', 'files'),
                        'radio_field_store_sessions_mysql' => xos_draw_radio_field('STORE_SESSIONS', 'mysql', (isset($_POST['STORE_SESSIONS']) ? '' : true)),
                        'href_link_index' => 'index.php?lang=' . $_POST['language_code'],
                        'hidden_fields' => $hidden_fields));

  $output_install_5 = $smarty->fetch('install_5.tpl');
  $smarty->clearAssign(array('form_begin',
                              'form_end',
                              'input_field_server',
                              'input_field_username',
                              'password_field',
                              'input_field_database',
                              'checkbox_field_pconnect',
                              'radio_field_store_sessions_files',
                              'radio_field_store_sessions_mysql',
                              'href_link_index',                            
                              'hidden_fields'));  
                                                    
  $smarty->assign('install_inner_content', $output_install_5);
?>