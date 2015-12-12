<?php
  $contents = array();
  switch ($action) {
    case 'delete':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_ORDER . '</b>';

      $form_tag = xos_draw_form('order', FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&oSC=' . $oInfo->orders_status_code . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO . '<br /><br /><b>' . TEXT_ORDER_ID . $oInfo->orders_id . '</b>');
      if ($oInfo->orders_status_code != 'paypal_st' && STOCK_LIMITED == 'true' && STOCK_CHECK == 'true') $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('restock') . ' ' . TEXT_INFO_RESTOCK_PRODUCT_QUANTITY);
      $contents[] = array('text' => '<br /><a href="" onclick="order.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading_title = '<b>[' . $oInfo->orders_id . ']&nbsp;&nbsp;' . xos_datetime_short($oInfo->date_purchased) . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');
        $contents[] = array('text' => '<a href="javascript:popupWindow(\'' . xos_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $oInfo->orders_id) . '\')" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_ORDERS_INVOICE . ' "><span>' . BUTTON_TEXT_ORDERS_INVOICE . '</span></a><a href="javascript:popupWindow(\'' . xos_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $oInfo->orders_id) . '\')" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_ORDERS_PACKINGSLIP . ' "><span>' . BUTTON_TEXT_ORDERS_PACKINGSLIP . '</span></a>');
        $contents[] = array('text' => '<br />' . TEXT_DATE_ORDER_CREATED . ' ' . xos_date_short($oInfo->date_purchased));
        if (xos_not_null($oInfo->last_modified)) $contents[] = array('text' => TEXT_DATE_ORDER_LAST_MODIFIED . ' ' . xos_date_short($oInfo->last_modified));
        $contents[] = array('text' => '<br />' . TEXT_INFO_PAYMENT_METHOD . ' '  . $oInfo->payment_method);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_orders = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_orders.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_orders', $output_infobox_orders);
  return 'overwrite_all';
?>