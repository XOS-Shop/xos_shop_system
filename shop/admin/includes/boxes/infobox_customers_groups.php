<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_customers_groups.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_customers_groups.php') == 'overwrite_all')) :
  $contents = array();  
  switch ($action) {
    case 'confirm':
      if ($_GET['cID'] != '0') {
        $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . TEXT_INFO_HEADING_DELETE_GROUP . '</b>';
            
        $form_tag = xos_draw_form('customers_groups', 'customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id . '&action=deleteconfirm');
        $contents[] = array('text' => TEXT_DELETE_INTRO . '<br /><br /><b>' . $cInfo->customers_group_name . ' </b>');
        $contents[] = array('text' => '<br /><a href="" onclick="customers_groups.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link('customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      } else {
        $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . TEXT_INFO_HEADING_DELETE_GROUP . '</b>';
            
        $contents[] = array('text' => TEXT_DELETE_INTRO_NOT_ALLOWED . '<br /><br /><b>' . $cInfo->customers_group_name . ' </b>');
        $contents[] = array('text' => '<br /><a href="' . xos_href_link('customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');
      }
      break;
    default:
      if (is_object($cInfo)) {
        $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . $cInfo->customers_group_name . '</b>';
        
        $contents[] = array('text' => '<a href="' . xos_href_link('customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link('customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id . '&action=confirm') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><br />&nbsp;');
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_customers_groups = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_customers_groups.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                   
  $smarty->assign('infobox_customers_groups', $output_infobox_customers_groups);
endif;
?>
