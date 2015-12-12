<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_customers.php
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
//              filename: customers.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_customers.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'confirm':
      $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . TEXT_INFO_HEADING_DELETE_CUSTOMER . '</b>';

      $form_tag = xos_draw_form('customers', FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_DELETE_INTRO . '<br /><br /><b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');
      if (isset($cInfo->number_of_reviews) && $cInfo->number_of_reviews > 0) $contents[] = array('text' => '<div class="checkbox"><label>' . xos_draw_checkbox_field('delete_reviews', 'on', true) . ' ' . sprintf(TEXT_DELETE_REVIEWS, $cInfo->number_of_reviews) . '</label></div>');
      $contents[] = array('text' => '<br /><a href="" onclick="customers.submit(); return false" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a><a href="' . xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    default:
      if (isset($cInfo) && is_object($cInfo)) {
        $heading_title = ''. xos_draw_separator('pixel_trans.gif', '11', '12') .'&nbsp;<br /><b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=edit') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_EDIT . ' ">' . BUTTON_TEXT_EDIT . '</a><a href="' . xos_href_link(FILENAME_CUSTOMERS, xos_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=confirm') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a><a href="' . xos_href_link(FILENAME_ORDERS, 'cID=' . $cInfo->customers_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_ORDERS . ' ">' . BUTTON_TEXT_ORDERS . '</a><a href="' . xos_href_link(FILENAME_MAIL, 'selected_box=tools&customer=' . $cInfo->customers_email_address) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_EMAIL . ' ">' . BUTTON_TEXT_EMAIL . '</a>');
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
endif;
?>
