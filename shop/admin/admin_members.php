<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : admin_members.php
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

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_ADMIN_MEMBERS) == 'overwrite_all')) :
  $current_boxes = DIR_FS_ADMIN . DIR_WS_BOXES;
  
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'member_new':
        $admin_email_address = xos_db_prepare_input($_POST['admin_email_address']);      
        $check_email_query = xos_db_query("select admin_email_address from " . TABLE_ADMIN . "");
        while ($check_email = xos_db_fetch_array($check_email_query)) {
          $stored_email[] = $check_email['admin_email_address'];
        }
        
        if (xos_validate_email($admin_email_address) == false) {
          xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&error=email_not_valid&action=new_member'));          
        } elseif (in_array($admin_email_address, $stored_email)) {
          xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&error=email_used&action=new_member'));
        } else {
         
          $makePassword = xos_db_prepare_input(xos_create_random_value(7));

          $sql_data_array = array('admin_groups_id' => xos_db_prepare_input($_POST['admin_groups_id']),
                                  'admin_firstname' => xos_db_prepare_input($_POST['admin_firstname']),
                                  'admin_lastname' => xos_db_prepare_input($_POST['admin_lastname']),
                                  'admin_email_address' => $admin_email_address,
                                  'admin_password' => xos_encrypt_password($makePassword),
                                  'admin_created' => 'now()');

          xos_db_perform(TABLE_ADMIN, $sql_data_array);
          $admin_id = xos_db_insert_id();

          if (SEND_EMAILS == 'true') {
            $email_to_admin = new mailer($_POST['admin_firstname'] . ' ' . $_POST['admin_lastname'], $_POST['admin_email_address'], ADMIN_EMAIL_SUBJECT, '', sprintf(ADMIN_EMAIL_TEXT, $_POST['admin_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $_POST['admin_email_address'], $makePassword, STORE_OWNER), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            if(!$email_to_admin->send()) {
              $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_admin->ErrorInfo), 'error');
            } else {
              $messageStack->add_session('header', sprintf(NOTICE_EMAIL_SENT_TO, $_POST['admin_email_address']), 'success');
            }
          }

          xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS));
        }
        break;
      case 'member_edit':
        $admin_id = xos_db_prepare_input($_POST['admin_id']);
        $admin_email_address = xos_db_prepare_input($_POST['admin_email_address']);        
        $hiddenPassword = TEXT_INFO_PASSWORD_HIDDEN;
        $stored_email[] = 'NONE';

        $check_email_query = xos_db_query("select admin_email_address from " . TABLE_ADMIN . " where admin_id <> " . (int)$admin_id . "");
        while ($check_email = xos_db_fetch_array($check_email_query)) {
          $stored_email[] = $check_email['admin_email_address'];
        }

        if (xos_validate_email($admin_email_address) == false) {
          xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $_GET['mID'] . '&error=email_not_valid&action=edit_member'));        
        } elseif (in_array($admin_email_address, $stored_email)) {
          xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $_GET['mID'] . '&error=email_used&action=edit_member'));
        } else {
          $sql_data_array = array('admin_groups_id' => xos_db_prepare_input($_POST['admin_groups_id']),
                                  'admin_firstname' => xos_db_prepare_input($_POST['admin_firstname']),
                                  'admin_lastname' => xos_db_prepare_input($_POST['admin_lastname']),
                                  'admin_email_address' => $admin_email_address,
                                  'admin_modified' => 'now()');

          xos_db_perform(TABLE_ADMIN, $sql_data_array, 'update', 'admin_id = \'' . $admin_id . '\'');

          if (SEND_EMAILS == 'true') {
            $email_to_admin = new mailer($_POST['admin_firstname'] . ' ' . $_POST['admin_lastname'], $_POST['admin_email_address'], ADMIN_EMAIL_EDIT_SUBJECT, '', sprintf(ADMIN_EMAIL_EDIT_TEXT, $_POST['admin_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $_POST['admin_email_address'], $hiddenPassword, STORE_OWNER), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            if(!$email_to_admin->send()) {
              $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_admin->ErrorInfo), 'error');
            } else {
              $messageStack->add_session('header', sprintf(NOTICE_EMAIL_SENT_TO, $_POST['admin_email_address']), 'success');
            }            
          }

          xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $admin_id));
        }
        break;
      case 'member_delete':
        $admin_id = xos_db_prepare_input($_POST['admin_id']);
        xos_db_query("delete from " . TABLE_ADMIN . " where admin_id = '" . (int)$admin_id . "'");

        xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS));
        break;
      case 'group_define':
        $selected_checkbox = $_POST['groups_to_boxes'];

        $define_files_query = xos_db_query("select admin_files_id from " . TABLE_ADMIN_FILES . " order by admin_files_id");
        while ($define_files = xos_db_fetch_array($define_files_query)) {
          $admin_files_id = $define_files['admin_files_id'];

          if (in_array ($admin_files_id, (array)$selected_checkbox)) {
            $sql_data_array = array('admin_groups_id' => xos_db_prepare_input($_POST['checked_' . $admin_files_id]));
            //$set_group_id = $_POST['checked_' . $admin_files_id];
          } else {
            $sql_data_array = array('admin_groups_id' => xos_db_prepare_input($_POST['unchecked_' . $admin_files_id]));
            //$set_group_id = $_POST['unchecked_' . $admin_files_id];
          }
          xos_db_perform(TABLE_ADMIN_FILES, $sql_data_array, 'update', 'admin_files_id = \'' . $admin_files_id . '\'');
        }

        xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $_POST['admin_groups_id']));
        break;
      case 'group_delete':
        $set_groups_id = xos_db_prepare_input($_POST['set_groups_id']);

        xos_db_query("delete from " . TABLE_ADMIN_GROUPS . " where admin_groups_id = '" . $_GET['gID'] . "'");
        xos_db_query("alter table " . TABLE_ADMIN_FILES . " change admin_groups_id admin_groups_id set( " . $set_groups_id . " ) NOT NULL DEFAULT '1' ");
        xos_db_query("delete from " . TABLE_ADMIN . " where admin_groups_id = '" . $_GET['gID'] . "'");

        xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=groups'));
        break;
      case 'group_edit':
        $admin_groups_name = ucwords(strtolower(xos_db_prepare_input($_POST['admin_groups_name'])));
        $name_replace = preg_replace("/ /", "%", $admin_groups_name);

        if (($admin_groups_name == '' || NULL) || (strlen($admin_groups_name) <= 5) ) {
          xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET[gID] . '&gName=false&action=edit_group'));
        } else {
          $check_groups_name_query = xos_db_query("select admin_groups_name as group_name_edit from " . TABLE_ADMIN_GROUPS . " where admin_groups_id <> " . (int)$_GET['gID'] . " and admin_groups_name like '%" . $name_replace . "%'");
          $check_duplicate = xos_db_num_rows($check_groups_name_query);
          if ($check_duplicate > 0){
            xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET['gID'] . '&gName=used&action=edit_group'));
          } else {
            $admin_groups_id = $_GET['gID'];
            xos_db_query("update " . TABLE_ADMIN_GROUPS . " set admin_groups_name = '" . $admin_groups_name . "' where admin_groups_id = '" . $admin_groups_id . "'");
            xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $admin_groups_id));
          }
        }
        break;
      case 'group_new':
        $admin_groups_name = ucwords(strtolower(xos_db_prepare_input($_POST['admin_groups_name'])));
        $name_replace = preg_replace("/ /", "%", $admin_groups_name);

        if (($admin_groups_name == '' || NULL) || (strlen($admin_groups_name) <= 5) ) {
          xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET[gID] . '&gName=false&action=new_group'));
        } else {
          $check_groups_name_query = xos_db_query("select admin_groups_name as group_name_new from " . TABLE_ADMIN_GROUPS . " where admin_groups_name like '%" . $name_replace . "%'");
          $check_duplicate = xos_db_num_rows($check_groups_name_query);
          if ($check_duplicate > 0){
            xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET['gID'] . '&gName=used&action=new_group'));
          } else {
            $sql_data_array = array('admin_groups_name' => $admin_groups_name);
            xos_db_perform(TABLE_ADMIN_GROUPS, $sql_data_array);
            $admin_groups_id = xos_db_insert_id();

            $set_groups_id = xos_db_prepare_input($_POST['set_groups_id']);
            $add_group_id = $set_groups_id . ',\'' . $admin_groups_id . '\'';
            xos_db_query("alter table " . TABLE_ADMIN_FILES . " change admin_groups_id admin_groups_id set( " . $add_group_id . ") NOT NULL DEFAULT '1' ");

            xos_redirect(xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $admin_groups_id));
          }
        }
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  require('includes/account_check.js.php');
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  
    
 if ($_GET['gPath']) {
 
   $smarty->assign('g_path', true);

   $group_name_query = xos_db_query("select admin_groups_name from " . TABLE_ADMIN_GROUPS . " where admin_groups_id = " . $_GET['gPath']);
   $group_name = xos_db_fetch_array($group_name_query);

   if ($_GET['gPath'] == 1) {
     $smarty->assign('form_begin_define', xos_draw_form('defineForm', FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET['gPath']));
   } elseif ($_GET['gPath'] != 1) {
     $smarty->assign(array('form_begin_define' => xos_draw_form('defineForm', FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET['gPath'] . '&action=group_define', 'post', 'enctype="multipart/form-data"'),
                           'hidden_admin_groups_id' => xos_draw_hidden_field('admin_groups_id', $_GET['gPath'])));
   }

  $db_boxes_query = xos_db_query("select admin_files_id as admin_boxes_id, admin_files_languages_key as admin_boxes_languages_key, admin_files_name as admin_boxes_name, admin_groups_id as boxes_group_id from " . TABLE_ADMIN_FILES . " where admin_files_is_boxes = '1'");
  $boxes_array = array();
  $i = 0;
  while ($group_boxes = xos_db_fetch_array($db_boxes_query)) {
    $group_boxes_files_query = xos_db_query("select admin_files_id, admin_files_languages_key, admin_files_name, admin_groups_id from " . TABLE_ADMIN_FILES . " where admin_files_is_boxes = '0' and admin_files_to_boxes = '" . $group_boxes['admin_boxes_id'] . "'");

    $boxe_id_number = 10 + $group_boxes['admin_boxes_id'];
    $selectedGroups = $group_boxes['boxes_group_id'];
    $groupsArray = explode(",", $selectedGroups);

    if (in_array($_GET['gPath'], $groupsArray)) {
      $del_boxes = array($_GET['gPath']);
      $result = array_diff ($groupsArray, $del_boxes);
      sort($result);
      $checkedBox = $selectedGroups;
      $uncheckedBox = implode (",", $result);
      $checked = true;
    } else {
      $add_boxes = array($_GET['gPath']);
      $result = array_merge ($add_boxes, (array)$groupsArray);
      sort($result);
      $checkedBox = implode (",", $result);
      $uncheckedBox = $selectedGroups;
      $checked = false;
    }
    
    $boxes_array[]=array('checkbox' => xos_draw_checkbox_field('groups_to_boxes[]', $group_boxes['admin_boxes_id'], $checked, '', 'id="groups_' . $boxe_id_number . '_' . $i . '" onclick="checkGroups(this)"'),
                         'box_name' => constant($group_boxes['admin_boxes_languages_key']),
                         'hidden_checked' => xos_draw_hidden_field('checked_' . $group_boxes['admin_boxes_id'], $checkedBox),
                         'hidden_unchecked' => xos_draw_hidden_field('unchecked_' . $group_boxes['admin_boxes_id'], $uncheckedBox));    
    
    //$group_boxes_files_query = xos_db_query("select admin_files_id, admin_files_name, admin_groups_id from " . TABLE_ADMIN_FILES . " where admin_files_is_boxes = '0' and admin_files_to_boxes = '" . $group_boxes['admin_boxes_id'] . "'");
    $files_to_boxes_array = array();
    $j = 0;
    while($group_boxes_files = xos_db_fetch_array($group_boxes_files_query)) {
      $selectedGroups = $group_boxes_files['admin_groups_id'];
      $groupsArray = explode(",", $selectedGroups);

      if (in_array($_GET['gPath'], $groupsArray)) {
        $del_boxes = array($_GET['gPath']);
        $result = array_diff ($groupsArray, $del_boxes);
        sort($result);
        $checkedBox = $selectedGroups;
        $uncheckedBox = implode (",", $result);
        $checked = true;
      } else {
        $add_boxes = array($_GET['gPath']);
        $result = array_merge ($add_boxes, (array)$groupsArray);
        sort($result);
        $checkedBox = implode (",", $result);
        $uncheckedBox = $selectedGroups;
        $checked = false;
      }

      $files_to_boxes_array[]=array('checkbox' => xos_draw_checkbox_field('groups_to_boxes[]', $group_boxes_files['admin_files_id'], $checked, '', 'id="subgroups_' . $boxe_id_number . '_' . $i . $j . '" onclick="checkSub(this)"'),
                                    'file_name' => constant($group_boxes_files['admin_files_languages_key']),
                                    'hidden_checked' => xos_draw_hidden_field('checked_' . $group_boxes_files['admin_files_id'], $checkedBox),
                                    'hidden_unchecked' => xos_draw_hidden_field('unchecked_' . $group_boxes_files['admin_files_id'], $uncheckedBox));
                                    
      $j++;                                 
    }
     
    $boxes_array[$i]['files'] = $files_to_boxes_array;
     
    $i++;  
  }

  $smarty->assign('boxes', $boxes_array);
  
  if ($_GET['gPath'] != 1) {
    $smarty->assign('link_filename_admin_members', xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $_GET['gPath']));
  }   

 } elseif ($_GET['gID']) {

  $smarty->assign('g_id', true);
 
  $db_groups_query = xos_db_query("select * from " . TABLE_ADMIN_GROUPS . " order by admin_groups_id");

  $add_groups_prepare = '\'0\'' ;
  $del_groups_prepare = '\'0\'' ;
  $count_groups = 0;
  $groups_array = array();
  while ($groups = xos_db_fetch_array($db_groups_query)) {
    $add_groups_prepare .= ',\'' . $groups['admin_groups_id'] . '\'' ;
    if (((!$_GET['gID']) || ($_GET['gID'] == $groups['admin_groups_id']) || ($_GET['gID'] == 'groups')) && (!$gInfo) ) {
      $gInfo = new objectInfo($groups);
    }
    
    $selected = false;
    
    if ( (is_object($gInfo)) && ($groups['admin_groups_id'] == $gInfo->admin_groups_id) && ($action != 'new_group') ) {
      $selected = true;
      $link_filename_admin_members = xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $groups['admin_groups_id'] . '&action=edit_group');
    } else {
      $link_filename_admin_members = xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $groups['admin_groups_id']);
      $del_groups_prepare .= ',\'' . $groups['admin_groups_id'] . '\'' ;
    }
  
    $groups_array[]=array('selected' => $selected,
                          'name' => $groups['admin_groups_name'],
                          'link_filename_admin_members' => $link_filename_admin_members);
                          
    $count_groups++;
  }
 
  $smarty->assign(array('groups' => $groups_array,
                        'groups_counter' => $count_groups,
                        'link_filename_admin_members' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'gID=' . $gInfo->admin_groups_id . '&action=new_group')));
  
 } else {

  $db_admin_query_raw = "select * from " . TABLE_ADMIN . " order by admin_firstname";

  $db_admin_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $db_admin_query_raw, $db_admin_query_numrows);
  $db_admin_query = xos_db_query($db_admin_query_raw);
  //$db_admin_num_row = xos_db_num_rows($db_admin_query);
  
  $members_array = array(); 
  while ($admin = xos_db_fetch_array($db_admin_query)) {
    $admin_group_query = xos_db_query("select admin_groups_name from " . TABLE_ADMIN_GROUPS . " where admin_groups_id = '" . $admin['admin_groups_id'] . "'");
    $admin_group = xos_db_fetch_array ($admin_group_query);
    if (((!$_GET['mID']) || ($_GET['mID'] == $admin['admin_id'])) && (!$mInfo) ) {
      $mInfo_array = array_merge((array)$admin, (array)$admin_group);
      $mInfo = new objectInfo($mInfo_array);
    }

    $selected = false;

    if ( (is_object($mInfo)) && ($admin['admin_id'] == $mInfo->admin_id) && ($action != 'new_member') ) {
      $selected = true;
      $link_filename_admin_members = xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $admin['admin_id'] . '&action=edit_member');
    } else {
      $link_filename_admin_members = xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $admin['admin_id']);
    }
 
    $members_array[]=array('selected' => $selected,
                           'link_filename_admin_members' => $link_filename_admin_members,
                           'firstname' => $admin['admin_firstname'],
                           'lastname' => $admin['admin_lastname'],
                           'email_address' => $admin['admin_email_address'],
                           'group_name' => $admin_group['admin_groups_name'],
                           'lognum' => $admin['admin_lognum']);

  }

  $smarty->assign(array('members' => $members_array,
                        'nav_bar_number' => $db_admin_split->display_count($db_admin_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_MEMBERS),
                        'nav_bar_result' => $db_admin_split->display_links($db_admin_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']),
                        'link_filename_admin_members' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->admin_id . '&action=new_member')));
  
 }

 $smarty->assign(array('BODY_TAG_PARAMS' => 'onload="SetFocus();"',
                       'heading_title' => HEADING_TITLE,
                       'form_end' => '</form>'));
 
 require(DIR_WS_BOXES . 'infobox_admin_members.php');
 
 $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'admin_members');
 $output_admin_members = $smarty->fetch(ADMIN_TPL . '/admin_members.tpl');
  
 $smarty->assign('central_contents', $output_admin_members);
  
 $smarty->display(ADMIN_TPL . '/frame.tpl');

 require(DIR_WS_INCLUDES . 'application_bottom.php');
endif; 
?>
