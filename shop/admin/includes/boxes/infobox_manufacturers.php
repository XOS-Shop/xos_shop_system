<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_manufacturers.php
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
//              filename: manufacturers.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_manufacturers.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'new':
      $heading_title = '<b>' . TEXT_HEADING_NEW_MANUFACTURER . '</b>';

      $form_tag = xos_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'action=insert', 'post', 'enctype="multipart/form-data"');
      $contents[] = array('text' => TEXT_NEW_INTRO);
      
      $manufacturer_inputs_string = '';
      $languages = xos_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $manufacturer_inputs_string .= '<br /><div class="input-group"><span class="input-group-addon">' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '</span>' . xos_draw_input_field('manufacturers_name[' . $languages[$i]['id'] . ']', '', 'class="form-control"') . '</div>';
      }

      $contents[] = array('text' => '<br />' . TEXT_MANUFACTURERS_NAME . $manufacturer_inputs_string);   
      
      $manufacturer_inputs_string = '';
      $languages = xos_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $manufacturer_inputs_string .= '<br /><div class="input-group"><span class="input-group-addon">' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '</span>' . xos_draw_input_field('manufacturers_url[' . $languages[$i]['id'] . ']', '', 'class="form-control"') . '</div>';
      }

      $contents[] = array('text' => '<br />' . TEXT_MANUFACTURERS_URL . $manufacturer_inputs_string);    
            
      $contents[] = array('text' => '<br />' . TEXT_MANUFACTURERS_IMAGE . '<br />' . xos_draw_file_field('manufacturers_image'));
      $contents[] = array('text' => '<br /><a href="" onclick="manufacturers.submit(); return false" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_SAVE . ' ">' . BUTTON_TEXT_SAVE . '</a><a href="' . xos_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $_GET['mID']) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    case 'edit':
      $heading_title = '<b>' . TEXT_HEADING_EDIT_MANUFACTURER . '</b>';

      $form_tag = xos_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id . '&action=save', 'post', 'enctype="multipart/form-data"');
      $contents[] = array('text' => TEXT_EDIT_INTRO);
      
      $manufacturer_inputs_string = '';
      $languages = xos_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $manufacturer_inputs_string .= '<br /><div class="input-group"><span class="input-group-addon">' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '</span>' . xos_draw_input_field('manufacturers_name[' . $languages[$i]['id'] . ']', xos_get_manufacturers_name($mInfo->manufacturers_id, $languages[$i]['id']), 'class="form-control"') . '</div>';
      }

      $contents[] = array('text' => '<br />' . TEXT_MANUFACTURERS_NAME . $manufacturer_inputs_string);
        
      $manufacturer_inputs_string = '';
      $languages = xos_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $manufacturer_inputs_string .= '<br /><div class="input-group"><span class="input-group-addon">' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '</span>' . xos_draw_input_field('manufacturers_url[' . $languages[$i]['id'] . ']', xos_get_manufacturer_url($mInfo->manufacturers_id, $languages[$i]['id']), 'class="form-control"') . '</div>';
      }

      $contents[] = array('text' => '<br />' . TEXT_MANUFACTURERS_URL . $manufacturer_inputs_string);
         
      if ($mInfo->manufacturers_image) {
        $contents[] = array('text' => '<br />' . xos_image(DIR_WS_CATALOG_IMAGES .'manufacturers/' . $mInfo->manufacturers_image, $mInfo->manufacturers_name) . '<br /><b>' . $mInfo->manufacturers_image . '</b><div class="checkbox"><label>' . xos_draw_selection_field('delete_manufacturer_image', 'checkbox', 'true') . TEXT_DELETE . '</label></div>' . xos_draw_hidden_field('current_manufacturer_image', $mInfo->manufacturers_image));
      }
      $contents[] = array('text' => '<br />' . TEXT_MANUFACTURERS_IMAGE . '<br />' . xos_draw_file_field('manufacturers_image') . '<br />');
      $contents[] = array('text' => '<br /><a href="" onclick="manufacturers.submit(); return false" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_SAVE . ' ">' . BUTTON_TEXT_SAVE . '</a><a href="' . xos_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    case 'delete':
      $heading_title = '<b>' . TEXT_HEADING_DELETE_MANUFACTURER . '</b>';

      $form_tag = xos_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $mInfo->manufacturers_name . '</b>');
      
      if ($mInfo->manufacturers_image) {
        $contents[] = array('text' => '<div class="checkbox"><label>' . xos_draw_checkbox_field('delete_image') . ' ' . TEXT_DELETE_IMAGE . '</label></div>');
      }
     
      if ($mInfo->products_count > 0) {
        $contents[] = array('text' => '<div class="checkbox"><label>' . xos_draw_checkbox_field('delete_products') . ' ' . TEXT_DELETE_PRODUCTS . '</label></div>');
        $contents[] = array('text' => '<br />' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $mInfo->products_count));
      }

      $contents[] = array('text' => '<br /><a href="" onclick="manufacturers.submit(); return false" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a><a href="' . xos_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    default:
      if (isset($mInfo) && is_object($mInfo)) {
        $heading_title = '<b>' . $mInfo->manufacturers_name . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id . '&action=edit') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_EDIT . ' ">' . BUTTON_TEXT_EDIT . '</a><a href="' . xos_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id . '&action=delete') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a>');
        $contents[] = array('text' => '<br />' . TEXT_DATE_ADDED . ' ' . xos_date_short($mInfo->date_added));
        if (xos_not_null($mInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . xos_date_short($mInfo->last_modified));
        
        $manufacturer_inputs_string = '';
        $languages = xos_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $manufacturer_inputs_string .= '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . xos_get_manufacturers_name($mInfo->manufacturers_id, $languages[$i]['id']);
        }

        $contents[] = array('text' => $manufacturer_inputs_string);
        
        $contents[] = array('text' => '<br />' . xos_info_image('manufacturers/' . $mInfo->manufacturers_image, $mInfo->manufacturers_name));
        $contents[] = array('text' => '<br />' . TEXT_PRODUCTS . ' ' . $mInfo->products_count);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_manufacturers = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_manufacturers.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_manufacturers', $output_infobox_manufacturers);
endif;
?>
