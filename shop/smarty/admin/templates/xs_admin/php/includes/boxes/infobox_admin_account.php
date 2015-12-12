<?php
  $contents = array();
  switch ($action) {
    case 'edit_process':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DEFAULT . '</b>';

      $contents[] = array('text' => TEXT_INFO_INTRO_EDIT_PROCESS . xos_draw_hidden_field('id_info', $myAccount['admin_id']));
      break;
    case 'check_account':
      $heading_title = '<b>' . TEXT_INFO_HEADING_CONFIRM_PASSWORD . '</b>';

      $contents[] = array('text' => TEXT_INFO_INTRO_CONFIRM_PASSWORD . xos_draw_hidden_field('id_info', $myAccount['admin_id']));
      if ($_GET['error']) {
        $contents[] = array('text' => TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR);
      }
      $contents[] = array('text' => xos_draw_password_field('password_confirmation'));
      $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_ADMIN_ACCOUNT) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><a href="" onclick="account.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CONFIRM . ' "><span>' . BUTTON_TEXT_CONFIRM . '</span></a><br />&nbsp;');
      break;
    default:
      $heading_title = '<b>' . TEXT_INFO_HEADING_DEFAULT . '</b>';

      $contents[] = array('text' => TEXT_INFO_INTRO_DEFAULT);
      if ($myAccount['admin_email_address'] == 'admin@localhost') {
        $contents[] = array('text' => sprintf(TEXT_INFO_INTRO_DEFAULT_FIRST, $myAccount['admin_firstname']) . '<br />&nbsp;');
      } elseif (($myAccount['admin_modified'] == '0000-00-00 00:00:00') || ($myAccount['admin_logdate'] <= 1) ) {
        $contents[] = array('text' => sprintf(TEXT_INFO_INTRO_DEFAULT_FIRST_TIME, $myAccount['admin_firstname']) . '<br />&nbsp;');
      }

  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_contents' => $contents));
                            
  $output_infobox_admin_account = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_admin_account.tpl');
  $smarty->clearAssign(array('info_box_heading_title', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_admin_account', $output_infobox_admin_account);
  return 'overwrite_all';
?>