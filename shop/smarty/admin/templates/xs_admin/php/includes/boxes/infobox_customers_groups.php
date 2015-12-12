<?php
  $contents = array();  
  switch ($action) {
    case 'confirm':
      if ($_GET['cID'] != '0') {
        $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . TEXT_INFO_HEADING_DELETE_GROUP . '</b>';
            
        $form_tag = xos_draw_form('customers_groups', 'customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id . '&action=deleteconfirm');
        $contents[] = array('text' => TEXT_DELETE_INTRO . '<br /><br /><b>' . $cInfo->customers_group_name . ' </b>');
        $contents[] = array('text' => '<br /><a href="" onclick="customers_groups.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link('customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      } else {
        $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . TEXT_INFO_HEADING_DELETE_GROUP . '</b>';
            
        $contents[] = array('text' => TEXT_DELETE_INTRO_NOT_ALLOWED . '<br /><br /><b>' . $cInfo->customers_group_name . ' </b>');
        $contents[] = array('text' => '<br /><a href="' . xos_href_link('customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');
      }
      break;
    default:
      if (is_object($cInfo)) {
        $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . $cInfo->customers_group_name . '</b>';
        
        $contents[] = array('text' => '<a href="' . xos_href_link('customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link('customers_groups.php', xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_group_id . '&action=confirm') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><br />&nbsp;');
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_customers_groups = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_customers_groups.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                   
  $smarty->assign('infobox_customers_groups', $output_infobox_customers_groups);
  return 'overwrite_all';
?>