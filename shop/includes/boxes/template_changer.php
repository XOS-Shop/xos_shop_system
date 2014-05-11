<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : template_changer.php
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
//              filename: currencies.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/template_changer.php') == 'overwrite_all')) :     
  $registered_tpls = array();
  $registered_tpls = explode(',', REGISTERED_TPLS);
    
  if (sizeof($registered_tpls) > 1) { 
    
    for ($i=0; $i<sizeof($registered_tpls); $i++) {
      $tpl_array[] = array( 'id' => $registered_tpls[$i], 'text' => $registered_tpls[$i]);
      $template_changer_content_noscript .= '<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('tpl')) . 'tpl=' . $registered_tpls[$i], $request_type, true, true, false, false, false) . '">' . '&nbsp; ' . (SELECTED_TPL == $registered_tpls[$i] ? '<b>' . $registered_tpls[$i] .'</b>' : $registered_tpls[$i]) . '</a><br />';       
    }
    $template_changer_content_noscript = substr($template_changer_content_noscript, 0, -6);    

    $hidden_get_variables = '';
    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if ( ($key != 'tpl') && ($key != xos_session_name()) && ($key != 'x') && ($key != 'y') ) {
        $hidden_get_variables .= xos_draw_hidden_field($key, $value);
      }
    }

    $template_changer_content = xos_draw_form('templates', xos_href_link(basename($_SERVER['PHP_SELF']), '', $request_type, false, true, false, false, false), 'get');
    $template_changer_content .= xos_draw_pull_down_menu('tpl', $tpl_array, SELECTED_TPL, 'onchange="this.form.submit();" style="width: 95%"') . $hidden_get_variables . xos_hide_session_id();
    $template_changer_content .= '</form>';
    
    $smarty->assign(array('box_template_changer_content' => $template_changer_content,
                          'box_template_changer_content_noscript' => $template_changer_content_noscript));    
    $output_template_changer = $smarty->fetch(SELECTED_TPL . '/includes/boxes/template_changer.tpl');
                                          
    $smarty->assign('box_template_changer', $output_template_changer);   
  }
endif;
?>
