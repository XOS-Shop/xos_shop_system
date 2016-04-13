<?php
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
    case 'restorenow':
      $heading_title = '<b>' . $buInfo->date . '</b>';

      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL . '<br /><br /><b><span id="restoreProcessInfo">' . TEXT_PLEASE_WAIT . '&nbsp;|&nbsp;' . TEXT_RUN . '&nbsp;1</span></b><br /><br /><a id="button-ok" href="' . xos_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file) . '" class="button-default" style="display: none; margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_OK . ' "><span>' . BUTTON_TEXT_OK . '</span></a><br />&nbsp;');
      break;      
    case 'restorelocalnow':
      $heading_title = '<b>' . TEXT_INFO_HEADING_RESTORE_LOCAL . '</b>';

      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL . '<br /><br /><b><span id="restoreProcessInfo">' . TEXT_PLEASE_WAIT . '&nbsp;|&nbsp;' . TEXT_RUN . '&nbsp;1</span></b><br /><br /><a id="button-ok" href="' . xos_href_link(FILENAME_BACKUP) . '" class="button-default" style="display: none; margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_OK . ' "><span>' . BUTTON_TEXT_OK . '</span></a><br />&nbsp;');
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
  return 'overwrite_all';
?>