<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_backup.php
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
//              filename: backup.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_backup.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'backup':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_BACKUP . '</b>';

      $form_tag = xos_draw_form('backup', FILENAME_BACKUP, 'action=backupnow');
      $contents[] = array('text' => TEXT_INFO_NEW_BACKUP);

      $contents[] = array('text' => '<br />' . xos_draw_radio_field('compress', 'no', true) . ' ' . TEXT_INFO_USE_NO_COMPRESSION);
      if (extension_loaded('zlib')) $contents[] = array('text' => xos_draw_radio_field('compress', 'gzip') . ' ' . TEXT_INFO_USE_GZIP);

      if ($dir_ok == true) {
        $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('download', 'yes') . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br /><br />*' . TEXT_INFO_BEST_THROUGH_HTTPS);
      } else {
        $contents[] = array('text' => '<br />' . xos_draw_radio_field('download', 'yes', true) . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br /><br />*' . TEXT_INFO_BEST_THROUGH_HTTPS);
      }

      $contents[] = array('text' => '<br /><a href="" onclick="backup.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACKUP . ' "><span>' . BUTTON_TEXT_BACKUP . '</span></a><a href="' . xos_href_link(FILENAME_BACKUP) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'restore':
      $heading_title = '<b>' . $buInfo->date . '</b>';

      $contents[] = array('text' => xos_break_string(sprintf(TEXT_INFO_RESTORE, DIR_FS_BACKUP . (($buInfo->compression != TEXT_NO_EXTENSION) ? substr($buInfo->file, 0, strrpos($buInfo->file, '.')) : $buInfo->file), ($buInfo->compression != TEXT_NO_EXTENSION) ? TEXT_INFO_UNPACK : ''), 35, ' '));
      $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file . '&action=restorenow') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_RESTORE . ' "><span>' . BUTTON_TEXT_RESTORE . '</span></a><a href="' . xos_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'restorelocal':
      $heading_title = '<b>' . TEXT_INFO_HEADING_RESTORE_LOCAL . '</b>';

      $form_tag = xos_draw_form('restore', FILENAME_BACKUP, 'action=restorelocalnow', 'post', 'enctype="multipart/form-data"');
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL . '<br /><br />' . TEXT_INFO_BEST_THROUGH_HTTPS);
      $contents[] = array('text' => '<br />' . xos_draw_file_field('sql_file'));
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL_RAW_FILE);
      $contents[] = array('text' => '<br /><a href="" onclick="restore.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_RESTORE . ' "><span>' . BUTTON_TEXT_RESTORE . '</span></a><a href="' . xos_href_link(FILENAME_BACKUP) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'delete':
      $heading_title = '<b>' . $buInfo->date . '</b>';

      $form_tag = xos_draw_form('del', FILENAME_BACKUP, 'file=' . $buInfo->file . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $buInfo->file . '</b>');
      $contents[] = array('text' => '<br /><a href="" onclick="del.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      if (isset($buInfo) && is_object($buInfo)) {
        $heading_title = '<b>' . $buInfo->date . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file . '&action=restore') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_RESTORE . ' "><span>' . BUTTON_TEXT_RESTORE . '</span></a><a href="' . xos_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE . ' ' . $buInfo->date);
        $contents[] = array('text' => TEXT_INFO_SIZE . ' ' . $buInfo->size);
        $contents[] = array('text' => '<br />' . TEXT_INFO_COMPRESSION . ' ' . $buInfo->compression);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                          
  $output_infobox_backup = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_backup.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_backup', $output_infobox_backup);
endif;
?>
