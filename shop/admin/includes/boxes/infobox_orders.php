<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_orders.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2007 Hanspeter Zeller
// license    : This file is part of XOS-Shop.
//
//              XOS-Shop is free software: you can redistribute it and/or modify
//              it under the terms of the GNU General Public License as published
//              by the Free Software Foundation, either version 3 of the License,
//              or (at your option) any later version.
//
//              XOS-Shop is distributed in the hope that it will be useful,
//              but WITHOUT ANY WARRANTY; without even the implied warranty of
//              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//              GNU General Public License for more details.
//
//              You should have received a copy of the GNU General Public License
//              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>.   
//------------------------------------------------------------------------------
// this file is based on: 
//              osCommerce, Open Source E-Commerce Solutions
//              http://www.oscommerce.com
//              Copyright (c) 2003 osCommerce
//              filename: orders.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_orders.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'delete':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_ORDER . '</b>';

      $form_tag = xos_draw_form('order', FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&oSC=' . $oInfo->orders_status_code . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO . '<br /><br /><b>' . TEXT_ORDER_ID . $oInfo->orders_id . '</b>');
      if ($oInfo->orders_status_code != 'paypal_st' && STOCK_LIMITED == 'true' && STOCK_CHECK == 'true') $contents[] = array('text' => '<div class="checkbox"><label>' . xos_draw_checkbox_field('restock') . '&nbsp;' . TEXT_INFO_RESTOCK_PRODUCT_QUANTITY . '</label></div>');
      $contents[] = array('text' => '<br /><a href="" onclick="order.submit(); return false" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a><a href="' . xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading_title = '<b>[' . $oInfo->orders_id . ']&nbsp;&nbsp;' . xos_datetime_short($oInfo->date_purchased) . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_EDIT . ' ">' . BUTTON_TEXT_EDIT . '</a><a href="' . xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a>');
        $contents[] = array('text' => '<a href="javascript:popupWindow(\'' . xos_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $oInfo->orders_id) . '\')" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_ORDERS_INVOICE . ' ">' . BUTTON_TEXT_ORDERS_INVOICE . '</a><a href="javascript:popupWindow(\'' . xos_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $oInfo->orders_id) . '\')" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_ORDERS_PACKINGSLIP . ' ">' . BUTTON_TEXT_ORDERS_PACKINGSLIP . '</a>');
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
endif;
?>
