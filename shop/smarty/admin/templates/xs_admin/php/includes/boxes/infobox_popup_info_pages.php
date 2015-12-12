<?php
  $contents = array();

  if (is_object($cInfo)) {
    $heading_title = '<b>' . $cInfo->name . '</b>'; 
    $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK_TO_OVERVIEW . ' "><span>' . BUTTON_TEXT_BACK_TO_OVERVIEW . '</span></a><a href="' . xos_href_link(FILENAME_POPUP_INFO_PAGES, 'cID=' . $cInfo->content_id . '&action=preview') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_PREVIEW . ' "><span>' . BUTTON_TEXT_PREVIEW . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . ($cInfo->link_request_type == 'SSL' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG . 'content.php?co=' . $cInfo->content_id . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT_FOR_LIGHTBOX . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . ($cInfo->link_request_type == 'SSL' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG . 'popup_content.php?co=' . $cInfo->content_id . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT_FOR_LIGHTBOX . '</span></a>');
    $contents[] = array('text' => '<br />' . TEXT_CONTENT_DATE_ADDED . ' ' . xos_date_short($cInfo->date_added));
    if ($cInfo->last_modified) $contents[] = array('text' => TEXT_CONTENT_LAST_MODIFIED . ' ' . xos_date_short($cInfo->last_modified));
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_popup_info_pages = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_popup_info_pages.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                             'info_box_form_tag', 
                             'info_box_contents'));  
                                                    
  $smarty->assign('infobox_popup_info_pages', $output_infobox_popup_info_pages);
  return 'overwrite_all';
?>