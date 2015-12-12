<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_admin_account.php
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
//              filename: admin_account.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_admin_account.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'edit_process':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DEFAULT . '</b>';

      $contents[] = array('text' => TEXT_INFO_INTRO_EDIT_PROCESS . xos_draw_hidden_field('id_info', $myAccount['admin_id']));
      break;
    case 'check_account':
      $heading_title = '<b>' . TEXT_INFO_HEADING_CONFIRM_PASSWORD . '</b>';

      $contents[] = array('text' => TEXT_INFO_INTRO_CONFIRM_PASSWORD . xos_draw_hidden_field('id_info', $myAccount['admin_id']));
      if ($_GET['error']) {
        $contents[] = array('text' => TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR);
      }
      $contents[] = array('text' => '<div class="form-group">' . xos_draw_password_field('password_confirmation', '', false, 'class="form-control"') . '</div>');
      $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_ADMIN_ACCOUNT) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_BACK . ' ">' . BUTTON_TEXT_BACK . '</a><a href="" onclick="account.submit(); return false" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CONFIRM . ' ">' . BUTTON_TEXT_CONFIRM . '</a><br />&nbsp;');
      break;
    default:
      $heading_title = '<b>' . TEXT_INFO_HEADING_DEFAULT . '</b>';

      $contents[] = array('text' => TEXT_INFO_INTRO_DEFAULT);
      if ($myAccount['admin_email_address'] == 'admin@localhost') {
        $contents[] = array('text' => sprintf(TEXT_INFO_INTRO_DEFAULT_FIRST, $myAccount['admin_firstname']) . '<br />&nbsp;');
      } elseif (($myAccount['admin_modified'] == '0000-00-00 00:00:00') || ($myAccount['admin_logdate'] <= 1) ) {
        $contents[] = array('text' => sprintf(TEXT_INFO_INTRO_DEFAULT_FIRST_TIME, $myAccount['admin_firstname']) . '<br />&nbsp;');
      }

  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_contents' => $contents));
                            
  $output_infobox_admin_account = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_admin_account.tpl');
  $smarty->clearAssign(array('info_box_heading_title', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_admin_account', $output_infobox_admin_account);
endif;
?>
