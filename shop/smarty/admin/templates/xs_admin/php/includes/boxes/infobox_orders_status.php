<?php
  $contents = array();
  switch ($action) {
    case 'new':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_ORDERS_STATUS . '</b>';

      $form_tag = xos_draw_form('status', FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&action=insert');
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);

      $orders_status_inputs_string = '';
      $languages = xos_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $orders_status_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . xos_draw_input_field('orders_status_name[' . $languages[$i]['id'] . ']');
      }

      $contents[] = array('text' => '<br />' . TEXT_INFO_ORDERS_STATUS_NAME . $orders_status_inputs_string);
      $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('public_flag', '1') . ' ' . TEXT_SET_PUBLIC_STATUS); 
      $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('downloads_flag', '1') . ' ' . TEXT_SET_DOWNLOADS_STATUS);       
      $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('text' => '<br /><a href="" onclick="status.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'edit':
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_ORDERS_STATUS . '</b>';

      $form_tag = xos_draw_form('status', FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&oID=' . $oInfo->orders_status_id  . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);

      $orders_status_inputs_string = '';
      $languages = xos_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $orders_status_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . xos_draw_input_field('orders_status_name[' . $languages[$i]['id'] . ']', xos_get_orders_status_name($oInfo->orders_status_id, $languages[$i]['id']));
      }

      $contents[] = array('text' => '<br />' . TEXT_INFO_ORDERS_STATUS_NAME . $orders_status_inputs_string);
      $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('public_flag', '1', $oInfo->public_flag) . ' ' . TEXT_SET_PUBLIC_STATUS); 
      $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('downloads_flag', '1', $oInfo->downloads_flag) . ' ' . TEXT_SET_DOWNLOADS_STATUS);      
      if (DEFAULT_ORDERS_STATUS_ID != $oInfo->orders_status_id) $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('text' => '<br /><a href="" onclick="status.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&oID=' . $oInfo->orders_status_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'delete':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_ORDERS_STATUS . '</b>';

      $form_tag = xos_draw_form('status', FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&oID=' . $oInfo->orders_status_id  . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $oInfo->orders_status_name . '</b>');
      $contents[] = array('text' => '<br />' . (($remove_status) ? '<a href="" onclick="status.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>' : '') . '<a href="' . xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&oID=' . $oInfo->orders_status_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading_title = '<b>' . $oInfo->orders_status_name . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&oID=' . $oInfo->orders_status_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_ORDERS_STATUS, 'page=' . $_GET['page'] . '&oID=' . $oInfo->orders_status_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');

        $orders_status_inputs_string = '';
        $languages = xos_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $orders_status_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . xos_get_orders_status_name($oInfo->orders_status_id, $languages[$i]['id']);
        }

        $contents[] = array('text' => $orders_status_inputs_string);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_orders_status = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_orders_status.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_orders_status', $output_infobox_orders_status);
  return 'overwrite_all';
?>