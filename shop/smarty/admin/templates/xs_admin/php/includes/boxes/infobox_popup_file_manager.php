<?php
    $contents = array();
    switch ($action) {
      case 'delete':
        $heading_title = '<b>' . $fInfo->name . '</b>';

        $form_tag = xos_draw_form('file', FILENAME_POPUP_FILE_MANAGER, 'info=' . urlencode($fInfo->name) . '&action=deleteconfirm');
        $contents[] = array('text' => TEXT_DELETE_INTRO);
        $contents[] = array('text' => '<br /><b>' . $fInfo->name . '</b>');
        $contents[] = array('text' => '<br /><a href="" onclick="file.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, (xos_not_null($fInfo->name) ? 'info=' . urlencode($fInfo->name) : '')) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      case 'new_folder':
        $heading_title = '<b>' . TEXT_NEW_FOLDER . '</b>';

        $form_tag = xos_draw_form('folder', FILENAME_POPUP_FILE_MANAGER, 'action=insert');
        $contents[] = array('text' => TEXT_NEW_FOLDER_INTRO);
        $contents[] = array('text' => '<br />' . TEXT_FILE_NAME . '<br />' . xos_draw_input_field('folder_name'));
        $contents[] = array('text' => '<br />' . (($directory_writeable == true) ? '<a href="" onclick="folder.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SAVE . ' "><span>' . BUTTON_TEXT_SAVE . '</span></a>' : '') . '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, (isset($_GET['info']) ? 'info=' . urlencode($_GET['info']) : '')) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      case 'upload':
        $heading_title = '<b>' . TEXT_INFO_HEADING_UPLOAD . '</b>';

        $form_tag = xos_draw_form('file', FILENAME_POPUP_FILE_MANAGER, 'action=processuploads', 'post', 'enctype="multipart/form-data"');
        $contents[] = array('text' => TEXT_UPLOAD_INTRO);

        $file_upload = '';
        for ($i=1; $i<6; $i++) $file_upload .= xos_draw_file_field('file_' . $i) . '<br />';

        $contents[] = array('text' => '<br />' . $file_upload);
        $contents[] = array('text' => '<br />' . (($directory_writeable == true) ? '<a href="" onclick="file.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPLOAD . ' "><span>' . BUTTON_TEXT_UPLOAD . '</span></a>' : '') . '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, (isset($_GET['info']) ? 'info=' . urlencode($_GET['info']) : '')) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      default:
        if (isset($fInfo) && is_object($fInfo)) {
          $heading_title = '<b>' . $fInfo->name . '</b>';

          $ws_path = str_replace(DIR_FS_DOCUMENT_ROOT, DIR_WS_CATALOG, $_SESSION['current_path']);
          if (substr($ws_path, -1) != '/') $ws_path = $ws_path . '/';

          if (!($fInfo->is_dir || $fInfo->is_image)) {
            $contents[] = array('text' => ($_SESSION['link_entrence'] ? '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK_TO_OVERVIEW . ' "><span>' . BUTTON_TEXT_BACK_TO_OVERVIEW . '</span></a>' : '') . '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'info=' . urlencode($fInfo->name) . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . $ws_path . $fInfo->name . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT . '</span></a>');
          }
          if ($fInfo->is_dir && $_SESSION['link_entrence']) {
            $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK_TO_OVERVIEW . ' "><span>' . BUTTON_TEXT_BACK_TO_OVERVIEW . '</span></a>');
          }
          if ($fInfo->is_image) {
            $contents[] = array('text' => ($_SESSION['link_entrence'] ? '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK_TO_OVERVIEW . ' "><span>' . BUTTON_TEXT_BACK_TO_OVERVIEW . '</span></a>' : '') . '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'info=' . urlencode($fInfo->name) . '&action=view') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_REAL_IMAGE . ' "><span>' . BUTTON_TEXT_REAL_IMAGE . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . $ws_path . $fInfo->name . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT . '</span></a>');
            $contents[] = array('text' => '<br />' . xos_image($ws_path . rawurlencode($fInfo->name), $fInfo->name, '', '', 'style="max-width: 250px; max-height: 250px;"'));
          }
          $contents[] = array('text' => '<br />' . TEXT_FILE_NAME . ' <b>' . $fInfo->name . '</b>');
          if ($fInfo->is_image) {
            $contents[] = !empty($fInfo->image_data['mime']) ? array('text' => '<br />' . TEXT_IMAGE_MIME_TYPE . ' <b>' . $fInfo->image_data['mime'] . '</b>') : array('text' => '<br />' . TEXT_IMAGE_MIME_TYPE . ' <b>' . TEXT_UNKNOWN . '</b>');
            $contents[] = !empty($fInfo->image_data[0]) ? array('text' => TEXT_IMAGE_WIDTH . ' <b>' . $fInfo->image_data[0] . ' px</b>'): array('text' => TEXT_IMAGE_WIDTH . ' <b>' . TEXT_UNKNOWN . '</b>');           
            $contents[] = !empty($fInfo->image_data[1]) ? array('text' => TEXT_IMAGE_HEIGHT . ' <b>' . $fInfo->image_data[1] . ' px</b>') : array('text' => TEXT_IMAGE_HEIGHT . ' <b>' . TEXT_UNKNOWN . '</b>');
            $contents[] = array('text' => TEXT_FILE_SIZE . ' <b>' . $fInfo->size . '</b>');
          } elseif (!$fInfo->is_dir) {
            $contents[] = array('text' => '<br />' . TEXT_FILE_SIZE . ' <b>' . $fInfo->size . '</b>');
          }  
          $contents[] = array('text' => '<br />' . TEXT_LAST_MODIFIED . ' ' . $fInfo->last_modified);
        }        
        
    }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_popup_file_manager = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_popup_file_manager.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_popup_file_manager', $output_infobox_popup_file_manager);
  return 'overwrite_all';
?>