<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_delivery_times.php
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
//              filename: orders_status.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_delivery_times.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'new':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_DELIVERY_TIME . '</b>';

      $form_tag = xos_draw_form('delivery_time', FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&action=insert');
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);

      $delivery_times_inputs_string = '';
      $languages = xos_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $delivery_times_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . xos_draw_input_field('delivery_times_text[' . $languages[$i]['id'] . ']');
      }

      $contents[] = array('text' => '<br />' . TEXT_INFO_DELIVERY_TIMES_TEXT . $delivery_times_inputs_string);
      $contents[] = array('text' => '<br />' . TEXT_INFO_POPUP_CONTENT_ID . '<br />' . xos_draw_input_field('popup_content_id'));        
      $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('text' => '<br /><a href="" onclick="delivery_time.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'edit':
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_DELIVERY_TIME . '</b>';

      $form_tag = xos_draw_form('delivery_time', FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id  . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);

      $delivery_times_inputs_string = '';
      $languages = xos_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $delivery_times_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . xos_draw_input_field('delivery_times_text[' . $languages[$i]['id'] . ']', xos_get_delivery_times_values($dInfo->delivery_times_id, 'delivery_times_text', $languages[$i]['id']));
      }

      $contents[] = array('text' => '<br />' . TEXT_INFO_DELIVERY_TIMES_TEXT . $delivery_times_inputs_string);
      $contents[] = array('text' => '<br />' . TEXT_INFO_POPUP_CONTENT_ID . '<br />' . xos_draw_input_field('popup_content_id', ($dInfo->popup_content_id > 0) ? $dInfo->popup_content_id : ''));     
      if (DEFAULT_DELIVERY_TIMES_ID != $dInfo->delivery_times_id) $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('text' => '<br /><a href="" onclick="delivery_time.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'delete':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_DELIVERY_TIME . '</b>';

      $form_tag = xos_draw_form('delivery_time', FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id  . '&action=deleteconfirm');
      if ($remove_delivery_time) $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $dInfo->delivery_times_text . '</b>');
      $contents[] = array('text' => '<br />' . (($remove_delivery_time) ? '<a href="" onclick="delivery_time.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>' : '') . '<a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      if (isset($dInfo) && is_object($dInfo)) {
        $heading_title = '<b>' . $dInfo->delivery_times_text . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');

        $delivery_times_inputs_string = '';
        $languages = xos_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $delivery_times_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . xos_get_delivery_times_values($dInfo->delivery_times_id, 'delivery_times_text', $languages[$i]['id']);
        }

        $contents[] = array('text' => $delivery_times_inputs_string);
        if ($dInfo->popup_content_id > 0) $contents[] = array('text' => '<br />' . TEXT_INFO_POPUP_CONTENT_ID . ' ' . $dInfo->popup_content_id);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_delivery_times = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_delivery_times.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                             'info_box_form_tag', 
                             'info_box_contents'));  
                                                    
  $smarty->assign('infobox_delivery_times', $output_infobox_delivery_times);
endif;
?>
