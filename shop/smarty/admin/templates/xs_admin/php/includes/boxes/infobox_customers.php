<?php
  $contents = array();
  switch ($action) {
    case 'confirm':
      $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . TEXT_INFO_HEADING_DELETE_CUSTOMER . '</b>';

      $form_tag = xos_draw_form('customers', FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_DELETE_INTRO . '<br /><br /><b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');
      if (isset($cInfo->number_of_reviews) && $cInfo->number_of_reviews > 0) $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('delete_reviews', 'on', true) . ' ' . sprintf(TEXT_DELETE_REVIEWS, $cInfo->number_of_reviews));
      $contents[] = array('text' => '<br /><a href="" onclick="customers.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      if (isset($cInfo) && is_object($cInfo)) {
        $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=confirm') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_ORDERS, 'cID=' . $cInfo->customers_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_ORDERS . ' "><span>' . BUTTON_TEXT_ORDERS . '</span></a><a href="' . xos_href_link(FILENAME_MAIL, 'selected_box=tools&customer=' . $cInfo->customers_email_address) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EMAIL . ' "><span>' . BUTTON_TEXT_EMAIL . '</span></a>');
        $contents[] = array('text' => '<br />' . TEXT_DATE_ACCOUNT_CREATED . ' ' . xos_date_short($cInfo->date_account_created));
        $contents[] = array('text' => '<br />' . TEXT_DATE_ACCOUNT_LAST_MODIFIED . ' ' . xos_date_short($cInfo->date_account_last_modified));
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_LAST_LOGON . ' '  . xos_date_short($cInfo->date_last_logon));
        $contents[] = array('text' => '<br />' . TEXT_INFO_NUMBER_OF_LOGONS . ' ' . $cInfo->number_of_logons);
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY . ' ' . $cInfo->countries_name);
        $contents[] = array('text' => '<br />' . TEXT_INFO_NUMBER_OF_REVIEWS . ' ' . $cInfo->number_of_reviews);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_customers = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_customers.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_customers', $output_infobox_customers);
  return 'overwrite_all';
?>