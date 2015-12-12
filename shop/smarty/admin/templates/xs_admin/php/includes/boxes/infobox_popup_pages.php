<?php
  $contents = array();
    
  if ($rows > 0) {
    if (isset($cInfo) && is_object($cInfo)) { // page info box contents
      $page_path_string = ''; 
      $page_path = xos_generate_page_path($cInfo->categories_or_pages_id);
      for ($i=(sizeof($page_path[0])-1); $i>0; $i--) { 
        $page_path_string .= $page_path[0][$i]['id'] . '_'; 
      }
      
      $page_link_string = $page_path_string . $cInfo->categories_or_pages_id;
       
      $page_path_string = substr($page_path_string, 0, -1); 
          
      $heading_title = '<b>' . $cInfo->categories_or_pages_name . '</b>';
            
      $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK_TO_OVERVIEW . ' "><span>' . BUTTON_TEXT_BACK_TO_OVERVIEW . '</span></a><a href="' . xos_href_link(FILENAME_POPUP_PAGES, 'cPath=' . $_GET['cPath'] . '&cpID=' . $cInfo->categories_or_pages_id . '&action=preview') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_PREVIEW . ' "><span>' . BUTTON_TEXT_PREVIEW . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . ($cInfo->link_request_type == 'SSL' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG . 'index.php?c=' . $page_link_string . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT_FOR_LIGHTBOX . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . ($cInfo->link_request_type == 'SSL' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG . 'popup_content.php?pco=' . $cInfo->categories_or_pages_id . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT_FOR_LIGHTBOX . '</span></a>');
      $contents[] = array('text' => '<br />' . TEXT_DATE_ADDED . ' ' . xos_date_short($cInfo->date_added));
      if (xos_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . xos_date_short($cInfo->last_modified));
      $contents[] = array('text' => '<br />' . TEXT_SUBPAGES . ' ' . $cInfo->children_count . '<br />&nbsp;');
    }
  } else {
    $heading_title = '<b>' . EMPTY_PAGE . '</b>';

      $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK_TO_OVERVIEW . ' "><span>' . BUTTON_TEXT_BACK_TO_OVERVIEW . '</span></a>');
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_popup_pages = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_popup_pages.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                             'info_box_form_tag', 
                             'info_box_contents'));  
                                                    
  $smarty->assign('infobox_popup_pages', $output_infobox_popup_pages);
  return 'overwrite_all';
?>