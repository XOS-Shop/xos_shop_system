<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_tax_rates.php
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
//              filename: tax_rates.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_tax_rates.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'new':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_TAX_RATE . '</b>'; 
      
      if (($tax_classes_pull_down = xos_tax_classes_pull_down('name="tax_class_id" style="font-size:10px"', $_GET['tax_class_id'])) && ($geo_zones_pull_down = xos_geo_zones_pull_down('name="tax_zone_id" style="font-size:10px"', $_GET['tax_zone_id']))) {
        $form_tag = xos_draw_form('rates', FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $_GET['tID'] . '&action=insert');
        $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
        $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_TITLE . '<br />' . $tax_classes_pull_down);
        $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_NAME . '<br />' . $geo_zones_pull_down);
        $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_RATE . '<br />' . xos_draw_input_field('tax_rate', $_GET['tax_rate']));
        $tax_description_error_array = unserialize(stripslashes(urldecode($_GET['error_description'])));
        $tax_description_array = unserialize(stripslashes(urldecode($_GET['tax_description'])));       
        $tax_description_inputs_string = '';
        $languages = xos_get_languages();
        $set_empty = false;
        $set_not_empty = false;
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) { 
          if (isset($tax_description_error_array[$languages[$i]['id']])) {
            if (empty($tax_description_error_array[$languages[$i]['id']]) && !$set_empty) {
              $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_DESCRIPTION_ERROR_EMPTY, TEXT_INFO_DESCRIPTION_ERROR_EMPTY_MARK) . '<br />');
              $set_empty = true;
            } elseif ($tax_description_error_array[$languages[$i]['id']] && !$set_not_empty) {
              $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_DESCRIPTION_ERROR, TEXT_INFO_DESCRIPTION_ERROR_MARK) . '<br />');
              $set_not_empty = true;
            }  
          }    
          $tax_description_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . xos_draw_input_field('tax_description[' . $languages[$i]['id'] . ']', $tax_description_array[$languages[$i]['id']]) . (isset($tax_description_error_array[$languages[$i]['id']]) ? (empty($tax_description_error_array[$languages[$i]['id']]) ? '<font color="red">&nbsp;' . TEXT_INFO_DESCRIPTION_ERROR_EMPTY_MARK . '</font>' : '<font color="red">&nbsp;' . TEXT_INFO_DESCRIPTION_ERROR_MARK . '</font>') : '');
        }         
        $contents[] = array('text' => '<br />' . TEXT_INFO_RATE_DESCRIPTION . $tax_description_inputs_string);  
        $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_RATE_PRIORITY . '<br />' . xos_draw_input_field('tax_priority', $_GET['tax_priority']));
        $contents[] = array('text' => '<br /><a href="" onclick="rates.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $_GET['tID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      } else {
        $contents[] = array('text' => TEXT_INFO_NO_TAX_CLASS_AND_OR_NO_TAX_ZONE_DEFINED . '<br /><br />');
        $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_TAX_RATES, xos_get_all_get_params(array('tID', 'action'))) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');     
      }
      break;
    case 'edit':
      $check_query = xos_db_query("select tr.tax_class_id from " . TABLE_TAX_RATES . " tr left join " . TABLE_PRODUCTS . " p on tr.tax_class_id = p.products_tax_class_id where products_tax_class_id = '" . $trInfo->tax_class_id . "' group by tr.tax_rates_id");
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_TAX_RATE . '</b>';

      $form_tag = xos_draw_form('rates', FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id  . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      if (xos_db_num_rows($check_query) != 1) {
        $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_TITLE . '<br />' . xos_tax_classes_pull_down('name="tax_class_id" style="font-size:10px"', (isset($_GET['tax_class_id']) ? $_GET['tax_class_id'] : $trInfo->tax_class_id)));
      } else {
        $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_TITLE . '<br /><b>' . $trInfo->tax_class_title . '</b>' . xos_draw_hidden_field('tax_class_id', $trInfo->tax_class_id));
      }
      $contents[] = array('text' => '<br />' . TEXT_INFO_ZONE_NAME . '<br />' . xos_geo_zones_pull_down('name="tax_zone_id" style="font-size:10px"', (isset($_GET['tax_zone_id']) ? $_GET['tax_zone_id'] : $trInfo->geo_zone_id)));
      $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_RATE . '<br />' . xos_draw_input_field('tax_rate', (isset($_GET['tax_rate']) ? $_GET['tax_rate'] : $trInfo->tax_rate)));
      $tax_description_error_array = unserialize(stripslashes(urldecode($_GET['error_description'])));
      $tax_description_array = unserialize(stripslashes(urldecode($_GET['tax_description'])));       
      $tax_description_inputs_string = '';
      $languages = xos_get_languages();
      $set_empty = false;
      $set_not_empty = false;
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        if (isset($tax_description_error_array[$languages[$i]['id']])) {
          if (empty($tax_description_error_array[$languages[$i]['id']]) && !$set_empty) {
            $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_DESCRIPTION_ERROR_EMPTY, TEXT_INFO_DESCRIPTION_ERROR_EMPTY_MARK) . '<br />');
            $set_empty = true;
          } elseif ($tax_description_error_array[$languages[$i]['id']] && !$set_not_empty) {
            $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_DESCRIPTION_ERROR, TEXT_INFO_DESCRIPTION_ERROR_MARK) . '<br />');
            $set_not_empty = true;
          }  
        }
        $tax_description = xos_get_tax_rates_description($trInfo->tax_rates_id, $languages[$i]['id']);
        $tax_description_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . xos_draw_input_field('tax_description[' . $languages[$i]['id'] . ']', (isset($tax_description_array[$languages[$i]['id']]) ? $tax_description_array[$languages[$i]['id']] : $tax_description)) . xos_draw_hidden_field('actual_tax_description[' . $languages[$i]['id'] . ']', $tax_description) . (isset($tax_description_error_array[$languages[$i]['id']]) ? (empty($tax_description_error_array[$languages[$i]['id']]) ? '<font color="red">&nbsp;' . TEXT_INFO_DESCRIPTION_ERROR_EMPTY_MARK . '</font>' : '<font color="red">&nbsp;' . TEXT_INFO_DESCRIPTION_ERROR_MARK . '</font>') : '');
      }       
      $contents[] = array('text' => '<br />' . TEXT_INFO_RATE_DESCRIPTION  . $tax_description_inputs_string);
      $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_RATE_PRIORITY . '<br />' . xos_draw_input_field('tax_priority', (isset($_GET['tax_priority']) ? $_GET['tax_priority'] : $trInfo->tax_priority)));
      $contents[] = array('text' => '<br /><a href="" onclick="rates.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'delete':
      $check_query = xos_db_query("select tr.tax_class_id from " . TABLE_TAX_RATES . " tr left join " . TABLE_PRODUCTS . " p on tr.tax_class_id = p.products_tax_class_id where products_tax_class_id = '" . $trInfo->tax_class_id . "' group by tr.tax_rates_id");     
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_TAX_RATE . '</b>';
           
      if (xos_db_num_rows($check_query) != 1) {
        $form_tag = xos_draw_form('rates', FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id  . '&action=deleteconfirm');
        $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
        $contents[] = array('text' => '<br /><b>' . $trInfo->tax_class_title . ' ' . number_format($trInfo->tax_rate, TAX_DECIMAL_PLACES) . '%</b>');
        $contents[] = array('text' => '<br /><a href="" onclick="rates.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      } else {
        $contents[] = array('text' => TEXT_INFO_DELETE_NOT_ALLOWED . '<br /><br />');
        $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_TAX_RATES, xos_get_all_get_params(array('action'))) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');      
      }
      break;
    default:
      if (is_object($trInfo)) {
        $heading_title = '<b>' . $trInfo->tax_class_title . '</b>';
        
        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . xos_date_short($trInfo->date_added));
        $contents[] = array('text' => '' . TEXT_INFO_LAST_MODIFIED . ' ' . xos_date_short($trInfo->last_modified));
        $tax_description_inputs_string = '';
        $languages = xos_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $tax_description = xos_get_tax_rates_description($trInfo->tax_rates_id, $languages[$i]['id']);      
          $tax_description_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' .  $tax_description;
        }         
        $contents[] = array('text' => '<br />' . TEXT_INFO_RATE_DESCRIPTION . '<br />' . $tax_description_inputs_string);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_tax_rates = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_tax_rates.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_tax_rates', $output_infobox_tax_rates);
endif;
?>
