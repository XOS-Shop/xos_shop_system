<?php
  $contents = array();
  switch ($action) {
    case 'edit':
      $heading_title = '<b>' . constant($cInfo->lang_key . '_TITLE') . '</b>';

      if ($cInfo->set_function) {
        eval('$value_field = ' . $cInfo->set_function . '"' . $cInfo->configuration_value . '");');
      } else {
        $value_field = xos_draw_input_field('configuration_value', $cInfo->configuration_value);
      }

      $form_tag = xos_draw_form('configuration', FILENAME_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br /><b>' . constant($cInfo->lang_key . '_TITLE') . '</b><br />' . constant($cInfo->lang_key . '_DESCRIPTION') . '<br />' . $value_field);
      $contents[] = array('text' => '<br /><a href="" onclick="configuration.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      if (isset($cInfo) && is_object($cInfo)) {
        $heading_title = '<b>' . constant($cInfo->lang_key . '_TITLE') . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a>');
        $contents[] = array('text' => '<br />' . constant($cInfo->lang_key . '_DESCRIPTION'));
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . xos_date_short($cInfo->date_added));
        if (xos_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . xos_date_short($cInfo->last_modified));
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_configuration = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_configuration.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_configuration', $output_infobox_configuration);
  return 'overwrite_all';
?>