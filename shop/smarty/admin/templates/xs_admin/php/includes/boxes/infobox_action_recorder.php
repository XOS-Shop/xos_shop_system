<?php
  $contents = array();
  switch ($action) {
    default:
      if (isset($aInfo) && is_object($aInfo)) {
        $heading_title = '<b>' . $aInfo->module . '</b>';

        $contents[] = array('text' => TEXT_INFO_IDENTIFIER . '<br /><br />' . (!empty($aInfo->identifier) ? '<a href="' . xos_href_link(FILENAME_ACTION_RECORDER, 'search=' . $aInfo->identifier) . '"><u>' . xos_output_string_protected($aInfo->identifier) . '</u></a>': '(empty)'));
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . xos_datetime_short($aInfo->date_added));
      }
      break;
  }
  
  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_contents' => $contents));
                            
  $output_infobox_action_recorder = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_action_recorder.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_action_recorder', $output_infobox_action_recorder);
  return 'overwrite_all';
?>