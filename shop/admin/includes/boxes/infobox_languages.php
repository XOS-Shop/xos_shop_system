<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_languages.php
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
//              filename: languages.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_languages.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'new':
      $heading_title = '<b>' . TEXT_INFO_HEADING_NEW_LANGUAGE . '</b>';

      $form_tag = xos_draw_form('languages', FILENAME_LANGUAGES, 'action=insert');
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_NAME . '<br />' . xos_draw_input_field('name'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_CODE . '<br />' . xos_draw_input_field('code'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_IMAGE . '<br />' . xos_draw_input_field('image', 'icon.gif'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_DIRECTORY . '<br />' . xos_draw_input_field('directory'));      
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_USE_IN . '<br />' . xos_draw_radio_field('use_in_id', '1', $use_in_admin, '', 'onclick="if (this.checked == true) { document.getElementsByName(\'display_in_catalog\')[0].checked = false; document.getElementsByName(\'display_in_catalog\')[0].disabled = true; }"') . ' ' . TEXT_INFO_ADMIN . '<br /><div style="background: #b4b4b4; padding: 0 3px 3px 0; float: left;">' . xos_draw_radio_field('use_in_id', '2', $use_in_catalog, '', 'onclick="document.getElementsByName(\'display_in_catalog\')[0].disabled = false;"') . ' ' . TEXT_INFO_CATALOG . '<br />' . xos_draw_radio_field('use_in_id', '3', $use_in_both, '', 'onclick="document.getElementsByName(\'display_in_catalog\')[0].disabled = false;"') . ' ' . TEXT_INFO_ADMIN_AND_CATALOG . xos_draw_hidden_field('actual_use_in_id', $lInfo->use_in_id) . '<span style="display:;"><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . xos_draw_checkbox_field('display_in_catalog', '1', true) . ' ' . 'Im Katalog-Bereich anzeigen</span></div>');     
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_SORT_ORDER . '<br />' . xos_draw_input_field('sort_order'));
      $contents[] = array('text' => '<br /><a href="" onclick="languages.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_INSERT . ' "><span>' . BUTTON_TEXT_INSERT . '</span></a><a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $_GET['lID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'edit':
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_LANGUAGE . '</b>';

      $form_tag = xos_draw_form('languages', FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_NAME . '<br />' . xos_draw_input_field('name', $lInfo->name));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_CODE . '<br />' . xos_draw_input_field('code', $lInfo->code));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_IMAGE . '<br />' . xos_draw_input_field('image', $lInfo->image));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_DIRECTORY . '<br />' . xos_draw_input_field('directory', $lInfo->directory));
      (DEFAULT_LANGUAGE != $lInfo->code) ? $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_USE_IN . '<br />' . xos_draw_radio_field('use_in_id', '1', $use_in_admin, '', 'onclick="if (this.checked == true) { document.getElementsByName(\'display_in_catalog\')[0].checked = false; document.getElementsByName(\'display_in_catalog\')[0].disabled = true; }"') . ' ' . TEXT_INFO_ADMIN . '<br /><div style="background: #b4b4b4; padding: 0 3px 3px 0; float: left;">' . xos_draw_radio_field('use_in_id', '2', $use_in_catalog, '', 'onclick="document.getElementsByName(\'display_in_catalog\')[0].disabled = false;"') . ' ' . TEXT_INFO_CATALOG . '<br />' . xos_draw_radio_field('use_in_id', '3', $use_in_both, '', 'onclick="document.getElementsByName(\'display_in_catalog\')[0].disabled = false;"') . ' ' . TEXT_INFO_ADMIN_AND_CATALOG . xos_draw_hidden_field('actual_use_in_id', $lInfo->use_in_id) . '<span style="display:;"><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . xos_draw_checkbox_field('display_in_catalog', '1', (($lInfo->display_in_catalog == '1') ? true : false)) . ' ' . TEXT_INFO_DISPLAY_IN_CATALOG . '</span></div>') : $contents[] = array('text' => xos_draw_hidden_field('use_in_id', $lInfo->use_in_id) . xos_draw_hidden_field('actual_use_in_id', $lInfo->use_in_id) . xos_draw_hidden_field('display_in_catalog', '1'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_SORT_ORDER . '<br />' . xos_draw_input_field('sort_order', $lInfo->sort_order));
      if (DEFAULT_LANGUAGE != $lInfo->code && $use_in_both) $contents[] = array('text' => '<br />' . xos_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('text' => '<br /><a href="" onclick="languages.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    case 'delete':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_LANGUAGE . '</b>';

      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $lInfo->name . '</b>');
      $contents[] = array('text' => '<br />' . (($remove_language) ? '<a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=deleteconfirm') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>' : '') . '<a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      if (is_object($lInfo)) {
        $heading_title = '<b>' . $lInfo->name . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>' . (($lInfo->use_in_id > 1) ? '<a href="' . xos_href_link(FILENAME_DEFINE_LANGUAGE, 'selected_box=tools&lngdir=' . $lInfo->directory) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DETAILS . ' "><span>' . BUTTON_TEXT_DETAILS . '</span></a>' : ''));
        $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_NAME . ' ' . $lInfo->name);
        $contents[] = array('text' => TEXT_INFO_LANGUAGE_CODE . ' ' . $lInfo->code);
        $contents[] = array('text' => '<br />' . xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $lInfo->directory . '/' . $lInfo->image, $lInfo->name));
        $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_DIRECTORY . '<br />' . DIR_FS_SMARTY . '<br />catalog/languages/<b>[' . $lInfo->directory . ']</b>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_USES_IN . '<br />' . $lang_info . (($lInfo->use_in_id > 1 && $lInfo->display_in_catalog != '1') ? ', ' . TEXT_INFO_NOT_DISPLAYED_IN_CATALOG : ''));
        $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_SORT_ORDER . ' ' . $lInfo->sort_order);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_languages = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_languages.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_languages', $output_infobox_languages);
endif;
?>
