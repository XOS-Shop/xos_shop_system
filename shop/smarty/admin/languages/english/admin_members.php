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

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Admin Groups');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Define Groups');
} else {
  define('HEADING_TITLE', 'Admin Members');
}

define('TABLE_HEADING_PASSWORD', 'Password');
define('TABLE_HEADING_CONFIRM', 'Confirm Password');
define('TABLE_HEADING_CREATED', 'Account Created');
define('TABLE_HEADING_MODIFIED', 'Account Created');
define('TABLE_HEADING_LOGDATE', 'Last Access');
define('TABLE_HEADING_LOG_NUM', 'Log Number');

define('TABLE_HEADING_GROUPS_GROUP', 'Level');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Categories Permission');


define('TEXT_INFO_HEADING_DEFAULT', 'Admin Member ');
define('TEXT_INFO_HEADING_DELETE', 'Delete Permission ');
define('TEXT_INFO_HEADING_EDIT', 'Edit Category / ');
define('TEXT_INFO_HEADING_NEW', 'New Admin Member ');

define('TEXT_INFO_DEFAULT_INTRO', 'Member group');
define('TEXT_INFO_DELETE_INTRO', 'Remove <b>%s</b> from Admin Members?');
define('TEXT_INFO_DELETE_INTRO_NOT', 'You can not delete %s group!');
define('TEXT_INFO_EDIT_INTRO', 'Set permission level here: ');

define('TEXT_INFO_FULLNAME', 'Name: ');
define('TEXT_INFO_FIRSTNAME', 'Firstname: ');
define('TEXT_INFO_LASTNAME', 'Lastname: ');
define('TEXT_INFO_EMAIL', 'E-Mail Address: ');
define('TEXT_INFO_PASSWORD', 'Password: ');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Hidden-');
define('TEXT_INFO_CONFIRM', 'Confirm Password: ');
define('TEXT_INFO_CREATED', 'Account Created: ');
define('TEXT_INFO_MODIFIED', 'Account Modified: ');
define('TEXT_INFO_LOGDATE', 'Last Access: ');
define('TEXT_INFO_LOGNUM', 'Log Number: ');
define('TEXT_INFO_GROUP', 'Group Level: ');
define('TEXT_INFO_ERROR_EMAIL_USED', '<font color="red">E-Mail Address has already been used! Please try again.</font>');
define('TEXT_INFO_ERROR_EMAIL_NOT_VALID', '<font color="red">E-Mail Address does not appear to be valid - please make any necessary corrections.</font>');
    
define('JS_ALERT_FIRSTNAME', '- Required: Firstname \n');
define('JS_ALERT_LASTNAME', '- Required: Lastname \n');
define('JS_ALERT_EMAIL', '- Required: E-Mail Address \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Your First Name must contain a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.');
define('JS_ALERT_LASTNAME_LENGTH',  '- Your Last Name must contain a minimum of ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.');
define('JS_ALERT_EMAIL_LENGTH',     '- Your E-Mail Address must contain a minimum of ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters');

define('ADMIN_EMAIL_SUBJECT', 'New Admin Member');
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'You can access the admin panel with the following password. Once you access the admin, please change your password!' . "\n\n" . 'Website: %s' . "\n" . 'E-Mail Address: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Admin Member Profile Edit');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hi %s,' . "\n\n" . 'Your personal information has been updated by an administrator.' . "\n\n" . 'Website: %s' . "\n" . 'E-Mail Address: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!');
define('NOTICE_EMAIL_SENT_TO', 'Notice: Email sent to: %s');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Admin Group ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Delete Group ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>NOTE:</b><br /><br /><b>edit:</b><br />edit group name.<br /><br /><b>delete:</b><br />delete group.<br /><br /><b>new permission:</b><br />define group access.');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'It\'s also will delete member of this group. Are you sure want to delete <b>%s</b> group?');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'You can not delete this groups!');
define('TEXT_INFO_GROUPS_INTRO', 'Give an unique group name. Click next to submit.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Give an unique group name. Click next to submit.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Admin Group');
define('TEXT_INFO_HEADING_GROUPS', 'New Group');
define('TEXT_INFO_GROUPS_NAME', ' <b>Group Name:</b><br />Give an unique group name. Then, click next to submit.<br />');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>ERROR:</b> At least the group name must have more than 5 character!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>ERROR:</b> Group name has already been used!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Group Level: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Boxes Permission:</b><br />Give access to selected boxes.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Include files stored in: ');

define('TEXT_INFO_HEADING_DEFINE', 'Define Group');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />You can not change file permission for this group.<br /><br />');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />Change permission for this group by selecting or unselecting boxes and files provided. Click <b>save</b> to save the changes.<br /><br />');
}
?>
