<?php
  $contents = array();
  if (isset($pInfo) && is_object($pInfo)) {
    $heading_title = '<b>' . $pInfo->products_name . '</b>';

    $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_CATEGORIES, 'pID=' . $pInfo->products_id . '&action=new_product') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a>');
    $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_EXPECTED . ' ' . xos_date_short($pInfo->products_date_available));
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_contents' => $contents));
                            
  $output_infobox_products_expected = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_products_expected.tpl');
  $smarty->clearAssign(array('info_box_heading_title', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_products_expected', $output_infobox_products_expected);
  return 'overwrite_all';
?>