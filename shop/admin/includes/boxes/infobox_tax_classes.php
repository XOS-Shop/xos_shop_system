<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_tax_classes.php
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
//              filename: tax_classes.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_tax_classes.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'new':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_TAX_CLASS . '</b>';

      $form_tag = xos_draw_form('classes', FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $_GET['tID'] . '&action=insert');
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      if (isset($_GET['error_title'])) {
        if (empty($_GET['error_title'])) {
          $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_CLASS_TITLE_ERROR_EMPTY . '<br />');        
        } else {
          $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_TAX_CLASS_TITLE_ERROR, $_GET['error_title']) . '<br />');
        }
      }
      $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_TITLE . '<br />' . xos_draw_input_field('tax_class_title', $_GET['tax_class_title']));
      $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_DESCRIPTION . '<br />' . xos_draw_input_field('tax_class_description', $_GET['tax_class_description']));
      $contents[] = array('text' => '<br /><a href="" onclick="classes.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $_GET['tID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
// Steuerklasse kann nicht geaendert werden, wenn bereits zugeortnet      
/*      
    case 'edit':
      $check_query = xos_db_query("select tax_class_id from " . TABLE_TAX_RATES . " where tax_class_id = '" . $tcInfo->tax_class_id . "' LIMIT 1");    
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_TAX_CLASS . '</b>';

      $form_tag = xos_draw_form('classes', FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);     
      if (!xos_db_num_rows($check_query)) {
        if (isset($_GET['error_title'])) {
          if (empty($_GET['error_title'])) {
            $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_CLASS_TITLE_ERROR_EMPTY . '<br />');        
          } else {
            $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_TAX_CLASS_TITLE_ERROR, $_GET['error_title']) . '<br />');
          }
        } 
        $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_TITLE . '<br />' . xos_draw_input_field('tax_class_title', (isset($_GET['tax_class_title']) ? $_GET['tax_class_title'] : $tcInfo->tax_class_title)) . xos_draw_hidden_field('actual_tax_class_title', $tcInfo->tax_class_title));
      } else {
        $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_TITLE . '<br /><b>' . $tcInfo->tax_class_title . '</b>' . xos_draw_hidden_field('tax_class_title', $tcInfo->tax_class_title) . xos_draw_hidden_field('actual_tax_class_title', $tcInfo->tax_class_title));
      }      
      $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_DESCRIPTION . '<br />' . xos_draw_input_field('tax_class_description', (isset($_GET['tax_class_description']) ? $_GET['tax_class_description'] : $tcInfo->tax_class_description)));
      $contents[] = array('text' => '<br /><a href="" onclick="classes.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
*/

// Steuerklasse kann geaendert werden, auch wenn bereits zugeortnet      
    case 'edit':   
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_TAX_CLASS . '</b>';

      $form_tag = xos_draw_form('classes', FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);     
      if (isset($_GET['error_title'])) {
        if (empty($_GET['error_title'])) {
         $contents[] = array('text' => '<br />' . TEXT_INFO_TAX_CLASS_TITLE_ERROR_EMPTY . '<br />');        
        } else {
          $contents[] = array('text' => '<br />' . sprintf(TEXT_INFO_TAX_CLASS_TITLE_ERROR, $_GET['error_title']) . '<br />');
        }
      } 
      $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_TITLE . '<br />' . xos_draw_input_field('tax_class_title', (isset($_GET['tax_class_title']) ? $_GET['tax_class_title'] : $tcInfo->tax_class_title)) . xos_draw_hidden_field('actual_tax_class_title', $tcInfo->tax_class_title));     
      $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_DESCRIPTION . '<br />' . xos_draw_input_field('tax_class_description', (isset($_GET['tax_class_description']) ? $_GET['tax_class_description'] : $tcInfo->tax_class_description)));
      $contents[] = array('text' => '<br /><a href="" onclick="classes.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;      
    case 'delete':
      $check_query = xos_db_query("select tax_class_id from " . TABLE_TAX_RATES . " where tax_class_id = '" . $tcInfo->tax_class_id . "' LIMIT 1");
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_TAX_CLASS . '</b>';
      
      if (!xos_db_num_rows($check_query)) {
        $form_tag = xos_draw_form('classes', FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id . '&action=deleteconfirm');
        $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
        $contents[] = array('text' => '<br /><b>' . $tcInfo->tax_class_title . '</b>');
        $contents[] = array('text' => '<br /><a href="" onclick="classes.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      } else {
        $contents[] = array('text' => TEXT_INFO_DELETE_NOT_ALLOWED . '<br /><br />');
        $contents[] = array('text' => '<br /><a href="' . xos_href_link(FILENAME_TAX_CLASSES, xos_get_all_get_params(array('action'))) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK . ' "><span>' . BUTTON_TEXT_BACK . '</span></a><br />&nbsp;');
      }        
      break;
    default:
      if (isset($tcInfo) && is_object($tcInfo)) {
        $heading_title = '<b>' . $tcInfo->tax_class_title . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_TAX_CLASSES, 'page=' . $_GET['page'] . '&tID=' . $tcInfo->tax_class_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . xos_date_short($tcInfo->date_added));
        $contents[] = array('text' => '' . TEXT_INFO_LAST_MODIFIED . ' ' . xos_date_short($tcInfo->last_modified));
        $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_DESCRIPTION . '<br />' . $tcInfo->tax_class_description);
      }
      break;
  }
  
  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_tax_classes = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_tax_classes.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_tax_classes', $output_infobox_tax_classes);
endif;
?>
