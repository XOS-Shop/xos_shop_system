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
        $delivery_times_inputs_string .= '<br /><div class="input-group"><span class="input-group-addon">' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '</span>' . xos_draw_input_field('delivery_times_text[' . $languages[$i]['id'] . ']', '', 'class="form-control"') . '</div>';
      }

      $contents[] = array('text' => '<br />' . TEXT_INFO_DELIVERY_TIMES_TEXT . $delivery_times_inputs_string);
      $contents[] = array('text' => '<br />' . TEXT_INFO_POPUP_CONTENT_ID . '<br /><div class="form-group">' . xos_draw_input_field('popup_content_id', '', 'class="form-control"') . '</div>');        
      $contents[] = array('text' => '<div class="checkbox"><label>' . xos_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT . '</label></div>');
      $contents[] = array('text' => '<br /><a href="" onclick="delivery_time.submit(); return false" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_INSERT . ' ">' . BUTTON_TEXT_INSERT . '</a><a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page']) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    case 'edit':
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_DELIVERY_TIME . '</b>';

      $form_tag = xos_draw_form('delivery_time', FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id  . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);

      $delivery_times_inputs_string = '';
      $languages = xos_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $delivery_times_inputs_string .= '<br /><div class="input-group"><span class="input-group-addon">' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '</span>' . xos_draw_input_field('delivery_times_text[' . $languages[$i]['id'] . ']', xos_get_delivery_times_values($dInfo->delivery_times_id, 'delivery_times_text', $languages[$i]['id']), 'class="form-control"') . '</div>';
      }

      $contents[] = array('text' => '<br />' . TEXT_INFO_DELIVERY_TIMES_TEXT . $delivery_times_inputs_string);
      $contents[] = array('text' => '<br />' . TEXT_INFO_POPUP_CONTENT_ID . '<br /><div class="form-group">' . xos_draw_input_field('popup_content_id', (($dInfo->popup_content_id > 0) ? $dInfo->popup_content_id : ''), 'class="form-control"') . '</div>');     
      if (DEFAULT_DELIVERY_TIMES_ID != $dInfo->delivery_times_id) $contents[] = array('text' => '<div class="checkbox"><label>' . xos_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT . '</label></div>');
      $contents[] = array('text' => '<br /><a href="" onclick="delivery_time.submit(); return false" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_UPDATE . ' ">' . BUTTON_TEXT_UPDATE . '</a><a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    case 'delete':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_DELIVERY_TIME . '</b>';

      $form_tag = xos_draw_form('delivery_time', FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id  . '&action=deleteconfirm');
      if ($remove_delivery_time) $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $dInfo->delivery_times_text . '</b>');
      $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a>' . (($remove_delivery_time) ? '<a href="" onclick="delivery_time.submit(); return false" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a>' : '') . '<br />&nbsp;');
      break;
    default:
      if (isset($dInfo) && is_object($dInfo)) {
        $heading_title = '<b>' . $dInfo->delivery_times_text . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id . '&action=edit') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_EDIT . ' ">' . BUTTON_TEXT_EDIT . '</a><a href="' . xos_href_link(FILENAME_DELIVERY_TIMES, 'page=' . $_GET['page'] . '&dID=' . $dInfo->delivery_times_id . '&action=delete') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a>');

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
