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
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_NAME . '<br /><div class="form-group">' . xos_draw_input_field('name', '', 'class="form-control"') . '</div>');
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_CODE . '<br /><div class="form-group">' . xos_draw_input_field('code', '', 'class="form-control"') . '</div>');
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_IMAGE . '<br /><div class="form-group">' . xos_draw_input_field('image', 'icon.gif', 'class="form-control"') . '</div>');
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_DIRECTORY . '<br /><div class="form-group">' . xos_draw_input_field('directory', '', 'class="form-control"') . '</div>');      
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_USE_IN . '<br /><div class="form-group"><div class="radio"><label>' . xos_draw_radio_field('use_in_id', '1', $use_in_admin, '', 'onclick="if (this.checked == true) { document.getElementsByName(\'display_in_catalog\')[0].checked = false; document.getElementsByName(\'display_in_catalog\')[0].disabled = true; }"') . ' ' . TEXT_INFO_ADMIN . '</label></div><div class="bg-aqua"><div class="radio"><label>' . xos_draw_radio_field('use_in_id', '2', $use_in_catalog, '', 'onclick="document.getElementsByName(\'display_in_catalog\')[0].disabled = false;"') . ' ' . TEXT_INFO_CATALOG . '</label></div><div class="radio"><label>' . xos_draw_radio_field('use_in_id', '3', $use_in_both, '', 'onclick="document.getElementsByName(\'display_in_catalog\')[0].disabled = false;"') . ' ' . TEXT_INFO_ADMIN_AND_CATALOG . xos_draw_hidden_field('actual_use_in_id', $lInfo->use_in_id) . '</label></div><div class="checkbox" style="margin: -10px 0 0 20px"><label>' . xos_draw_checkbox_field('display_in_catalog', '1', true) . ' ' . TEXT_INFO_DISPLAY_IN_CATALOG . '</label></div></div></div>');     
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_SORT_ORDER . '<br /><div class="form-group">' . xos_draw_input_field('sort_order', '', 'class="form-control"') . '</div>');
      $contents[] = array('text' => '<br /><a href="" onclick="languages.submit(); return false" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_INSERT . ' ">' . BUTTON_TEXT_INSERT . '</a><a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $_GET['lID']) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    case 'edit':
      $heading_title = '<b>' . TEXT_INFO_HEADING_EDIT_LANGUAGE . '</b>';

      $form_tag = xos_draw_form('languages', FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=save');
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_NAME . '<br /><div class="form-group">' . xos_draw_input_field('name', $lInfo->name, 'class="form-control"') . '</div>');
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_CODE . '<br /><div class="form-group">' . xos_draw_input_field('code', $lInfo->code, 'class="form-control"') . '</div>');
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_IMAGE . '<br /><div class="form-group">' . xos_draw_input_field('image', $lInfo->image, 'class="form-control"') . '</div>');
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_DIRECTORY . '<br /><div class="form-group">' . xos_draw_input_field('directory', $lInfo->directory, 'class="form-control"') . '</div>');
      (DEFAULT_LANGUAGE != $lInfo->code) ? $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_USE_IN . '<br /><div class="form-group"><div class="radio"><label>' . xos_draw_radio_field('use_in_id', '1', $use_in_admin, '', 'onclick="if (this.checked == true) { document.getElementsByName(\'display_in_catalog\')[0].checked = false; document.getElementsByName(\'display_in_catalog\')[0].disabled = true; }"') . ' ' . TEXT_INFO_ADMIN . '</label></div><div class="bg-aqua"><div class="radio"><label>' . xos_draw_radio_field('use_in_id', '2', $use_in_catalog, '', 'onclick="document.getElementsByName(\'display_in_catalog\')[0].disabled = false;"') . ' ' . TEXT_INFO_CATALOG . '</label></div><div class="radio"><label>' . xos_draw_radio_field('use_in_id', '3', $use_in_both, '', 'onclick="document.getElementsByName(\'display_in_catalog\')[0].disabled = false;"') . ' ' . TEXT_INFO_ADMIN_AND_CATALOG . xos_draw_hidden_field('actual_use_in_id', $lInfo->use_in_id) . '</label></div><div class="checkbox" style="margin: -10px 0 0 20px"><label>' . xos_draw_checkbox_field('display_in_catalog', '1', (($lInfo->display_in_catalog == '1') ? true : false)) . ' ' . TEXT_INFO_DISPLAY_IN_CATALOG . '</label></div></div></div>') : $contents[] = array('text' => xos_draw_hidden_field('use_in_id', $lInfo->use_in_id) . xos_draw_hidden_field('actual_use_in_id', $lInfo->use_in_id) . xos_draw_hidden_field('display_in_catalog', '1'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_LANGUAGE_SORT_ORDER . '<br /><div class="form-group">' . xos_draw_input_field('sort_order', $lInfo->sort_order, 'class="form-control"') . '</div>');
      if (DEFAULT_LANGUAGE != $lInfo->code && $use_in_both) $contents[] = array('text' => '<br /><div class="checkbox"><label>' . xos_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT . '</label></div>');
      $contents[] = array('text' => '<br /><a href="" onclick="languages.submit(); return false" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_UPDATE . ' ">' . BUTTON_TEXT_UPDATE . '</a><a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    case 'delete':
      $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_LANGUAGE . '</b>';

      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $lInfo->name . '</b>');
      $contents[] = array('text' => '<br />' . (($remove_language) ? '<a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=deleteconfirm') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a>' : '') . '<a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    default:
      if (is_object($lInfo)) {
        $heading_title = '<b>' . $lInfo->name . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=edit') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_EDIT . ' ">' . BUTTON_TEXT_EDIT . '</a><a href="' . xos_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=delete') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a>' . (($lInfo->use_in_id > 1) ? '<a href="' . xos_href_link(FILENAME_DEFINE_LANGUAGE, 'selected_box=tools&lngdir=' . $lInfo->directory) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_DETAILS . ' ">' . BUTTON_TEXT_DETAILS . '</a>' : ''));
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
