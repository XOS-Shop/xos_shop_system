<?php
  $contents = array();
  switch ($action) {
    case 'delete':
      $heading_title = '<b>' . $nInfo->title . '</b>';

      $form_tag = xos_draw_form('newsletters', FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $nInfo->title . '</b>');
      $contents[] = array('text' => '<br /><a href="" onclick="newsletters.submit(); return false" class="button-default" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      if (is_object($nInfo)) {
        $heading_title = '<b>' . $nInfo->title . '</b>';

        if ($nInfo->locked > 0) {
          if (SEND_EMAILS == 'true') {
            $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=new') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_PREVIEW . ' "><span>' . BUTTON_TEXT_PREVIEW . '</span></a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=send') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SEND . ' "><span>' . BUTTON_TEXT_SEND . '</span></a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=unlock') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UNLOCK . ' "><span>' . BUTTON_TEXT_UNLOCK . '</span></a>');
          } else {
            $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=new') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_PREVIEW . ' "><span>' . BUTTON_TEXT_PREVIEW . '</span></a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=unlock') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UNLOCK . ' "><span>' . BUTTON_TEXT_UNLOCK . '</span></a>');
          }
        } else {
          $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_PREVIEW . ' "><span>' . BUTTON_TEXT_PREVIEW . '</span></a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=lock') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_LOCK . ' "><span>' . BUTTON_TEXT_LOCK . '</span></a>');
        }
        $contents[] = array('text' => '<br />' . TEXT_NEWSLETTER_DATE_ADDED . ' ' . xos_date_short($nInfo->date_added));
        if ($nInfo->status == '1') $contents[] = array('text' => TEXT_NEWSLETTER_DATE_SENT . ' ' . xos_date_short($nInfo->date_sent));
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_newsletters = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_newsletters.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_newsletters', $output_infobox_newsletters);
  return 'overwrite_all';
?>