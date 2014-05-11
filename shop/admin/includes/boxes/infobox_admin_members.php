<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_admin_members.php
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
//              filename: admin_members.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_admin_members.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'new_member':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW . '</b>';

      $form_tag = xos_draw_form('newmember', FILENAME_ADMIN_MEMBERS, 'action=member_new&page=' . $_GET['page'], 'post', 'enctype="multipart/form-data"');
      if ($_GET['error'] == 'email_used') {
        $contents[] = array('text' => TEXT_INFO_ERROR_EMAIL_USED);
      } elseif ($_GET['error'] == 'email_not_valid') {
        $contents[] = array('text' => TEXT_INFO_ERROR_EMAIL_NOT_VALID);
      } 
      $contents[] = array('text' => '<br />' . TEXT_INFO_FIRSTNAME . '<br />' . xos_draw_input_field('admin_firstname'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LASTNAME . '<br />' . xos_draw_input_field('admin_lastname'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_EMAIL . '<br />' . xos_draw_input_field('admin_email_address'));

      $groups_array = array(array('id' => '0', 'text' => TEXT_NONE));
      $groups_query = xos_db_query("select admin_groups_id, admin_groups_name from " . TABLE_ADMIN_GROUPS);
      while ($groups = xos_db_fetch_array($groups_query)) {
        $groups_array[] = array('id' => $groups['admin_groups_id'],
                                'text' => $groups['admin_groups_name']);
      }
      $contents[] = array('text' => '<br />' . TEXT_INFO_GROUP . '<br />' . xos_draw_pull_down_menu('admin_groups_id', $groups_array, '0'));
      $contents[] = array('text' => '<br /><a href="" onclick="validateForm(); if(document.returnValue)newmember.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $_GET['mID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'edit_member':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW . '</b>';

      $form_tag = xos_draw_form('newmember', FILENAME_ADMIN_MEMBERS, 'action=member_edit&page=' . $_GET['page'] . '&mID=' . $_GET['mID'], 'post', 'enctype="multipart/form-data"');
      if ($_GET['error'] == 'email_used') {
        $contents[] = array('text' => TEXT_INFO_ERROR_EMAIL_USED);
      } elseif ($_GET['error'] == 'email_not_valid') {
        $contents[] = array('text' => TEXT_INFO_ERROR_EMAIL_NOT_VALID);
      } 
      $contents[] = array('text' => xos_draw_hidden_field('admin_id', $mInfo->admin_id));
      $contents[] = array('text' => '<br />' . TEXT_INFO_FIRSTNAME . '<br />' . xos_draw_input_field('admin_firstname', $mInfo->admin_firstname));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LASTNAME . '<br />' . xos_draw_input_field('admin_lastname', $mInfo->admin_lastname));
      if (isset($_GET['error'])) {
        $contents[] = array('text' => '<br />' . TEXT_INFO_EMAIL . '<br />' . xos_draw_input_field('admin_email_address'));
      } else {
        $contents[] = array('text' => '<br />' . TEXT_INFO_EMAIL . '<br />' . xos_draw_input_field('admin_email_address', $mInfo->admin_email_address));
      }
      if ($mInfo->admin_id == 1) {
        $contents[] = array('text' => xos_draw_hidden_field('admin_groups_id', $mInfo->admin_groups_id));
      } else {
        $groups_array = array(array('id' => '0', 'text' => TEXT_NONE));
        $groups_query = xos_db_query("select admin_groups_id, admin_groups_name from " . TABLE_ADMIN_GROUPS);
        while ($groups = xos_db_fetch_array($groups_query)) {
          $groups_array[] = array('id' => $groups['admin_groups_id'],
                                  'text' => $groups['admin_groups_name']);
        }
        $contents[] = array('text' => '<br />' . TEXT_INFO_GROUP . '<br />' . xos_draw_pull_down_menu('admin_groups_id', $groups_array, $mInfo->admin_groups_id));
      }
      $contents[] = array('text' => '<br /><a href="" onclick="validateForm(); if(document.returnValue)newmember.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $_GET['mID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'del_member':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE . '</b>';
      if ($mInfo->admin_id == 1 || $mInfo->admin_email_address == STORE_OWNER_EMAIL_ADDRESS) {
        $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->admin_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');
      } else {
        $form_tag = xos_draw_form('edit', FILENAME_ADMIN_MEMBERS, 'action=member_delete&page=' . $_GET['page'] . '&mID=' . $admin['admin_id'], 'post', 'enctype="multipart/form-data"');
        $contents[] = array('text' => xos_draw_hidden_field('admin_id', $mInfo->admin_id));
        $contents[] = array('text' => sprintf(TEXT_INFO_DELETE_INTRO, $mInfo->admin_firstname . ' ' . $mInfo->admin_lastname));
        $contents[] = array('text' => '<br /><a href="" onclick="edit.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $_GET['mID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      }
      break;
    case 'new_group':
      $heading_title = '<b>' . TEXT_INFO_HEADING_GROUPS . '</b>';

      $form_tag = xos_draw_form('new_group', FILENAME_ADMIN_MEMBERS, 'action=group_new&gID=' . $gInfo->admin_groups_id, 'post', 'enctype="multipart/form-data"');
      if ($_GET['gName'] == 'false') {
        $contents[] = array('text' => TEXT_INFO_GROUPS_NAME_FALSE . '<br />&nbsp;');
      } elseif ($_GET['gName'] == 'used') {
        $contents[] = array('text' => TEXT_INFO_GROUPS_NAME_USED . '<br />&nbsp;');
      }
      $contents[] = array('text' => xos_draw_hidden_field('set_groups_id', substr($add_groups_prepare, 4)) );
      $contents[] = array('text' => TEXT_INFO_GROUPS_NAME . '<br />');
      $contents[] = array('text' => xos_draw_input_field('admin_groups_name'));
      $contents[] = array('text' => '<br /><a href="" onclick="new_group.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $gInfo->admin_groups_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'edit_group':
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_GROUP . '</b>';

      $form_tag = xos_draw_form('edit_group', FILENAME_ADMIN_MEMBERS, 'action=group_edit&gID=' . $_GET['gID'], 'post', 'enctype="multipart/form-data"');
      if ($_GET['gName'] == 'false') {
        $contents[] = array('text' => TEXT_INFO_GROUPS_NAME_FALSE . '<br />&nbsp;');
      } elseif ($_GET['gName'] == 'used') {
        $contents[] = array('text' => TEXT_INFO_GROUPS_NAME_USED . '<br />&nbsp;');
      }
      $contents[] = array('text' => TEXT_INFO_EDIT_GROUPS_INTRO . '<br />&nbsp;<br />' . xos_draw_input_field('admin_groups_name', $gInfo->admin_groups_name));
      $contents[] = array('text' => '<br /><a href="" onclick="edit_group.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $gInfo->admin_groups_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'del_group':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_GROUPS . '</b>';

      $form_tag = xos_draw_form('delete_group', FILENAME_ADMIN_MEMBERS, 'action=group_delete&gID=' . $gInfo->admin_groups_id, 'post', 'enctype="multipart/form-data"');
      if ($gInfo->admin_groups_id == 1) {
        $contents[] = array('text' => sprintf(TEXT_INFO_DELETE_GROUPS_INTRO_NOT, $gInfo->admin_groups_name));
        $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET['gID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');
      } else {
        $contents[] = array('text' => xos_draw_hidden_field('set_groups_id', substr($del_groups_prepare, 4)) );
        $contents[] = array('text' => sprintf(TEXT_INFO_DELETE_GROUPS_INTRO, $gInfo->admin_groups_name));
        $contents[] = array('text' => '<br /><a href="" onclick="delete_group.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET['gID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      }
      break;
    case 'define_group':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DEFINE . '</b>';

      $contents[] = array('text' => sprintf(TEXT_INFO_DEFINE_INTRO, $group_name['admin_groups_name']));
      if ($_GET['gPath'] == 1) {
        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET['gPath']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');
      }
      break;
    default:
      if (is_object($mInfo)) {
        $heading_title = '<b>' . TEXT_INFO_HEADING_DEFAULT . '</b>';
        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->admin_id . '&action=edit_member') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->admin_id . '&action=del_member') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><br />&nbsp;');
        $contents[] = array('text' => '<b>' . TEXT_INFO_FULLNAME . '</b><br />' . $mInfo->admin_firstname . ' ' . $mInfo->admin_lastname);
        $contents[] = array('text' => '<b>' . TEXT_INFO_EMAIL . '</b><br />' . $mInfo->admin_email_address);
        $contents[] = array('text' => '<b>' . TEXT_INFO_GROUP . '</b><br />' . $mInfo->admin_groups_name);
        $contents[] = array('text' => '<b>' . TEXT_INFO_CREATED . '</b><br />' . $mInfo->admin_created);
        $contents[] = array('text' => '<b>' . TEXT_INFO_MODIFIED . '</b><br />' . $mInfo->admin_modified);
        $contents[] = array('text' => '<b>' . TEXT_INFO_LOGDATE . '</b><br />' . $mInfo->admin_logdate);
        $contents[] = array('text' => '<b>' . TEXT_INFO_LOGNUM . '</b><br />' . $mInfo->admin_lognum . '<br />&nbsp;');
      } elseif (is_object($gInfo)) {
        $heading_title = '<b>' . TEXT_INFO_HEADING_DEFAULT_GROUPS . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'gPath=' . $gInfo->admin_groups_id . '&action=define_group') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_FILE_PERMISSION . ' "><span>' . BUTTON_TEXT_FILE_PERMISSION . '</span></a><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $gInfo->admin_groups_id . '&action=edit_group') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $gInfo->admin_groups_id . '&action=del_group') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><br />&nbsp;');
        $contents[] = array('text' => TEXT_INFO_DEFAULT_GROUPS_INTRO . '<br />&nbsp;');
      }
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_admin_members = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_admin_members.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                              
  $smarty->assign('infobox_admin_members', $output_infobox_admin_members);
endif;
?>
