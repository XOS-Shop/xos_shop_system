<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_info_pages.php
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
//              filename: newsletters.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_info_pages.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'delete':
      $heading_title = '<b>' . $cInfo->name . '</b>';

      $form_tag = xos_draw_form('contents', FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->content_id . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $cInfo->name . '</b>');
      $contents[] = array('text' => '<br />' . (($cInfo->type != 'system_popup') ? '<a href="" onclick="contents.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>' : '') . '<a href="' . xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $_GET['cID']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      if (is_object($cInfo)) {
        $heading_title = '<b>' . $cInfo->name . '</b>'; 
        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->content_id . '&action=new') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a>' . (($cInfo->type != 'system_popup') ? '<a href="' . xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->content_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>' : '') . '<a href="' . xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->content_id . '&action=preview') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_PREVIEW . ' "><span>' . BUTTON_TEXT_PREVIEW . '</span></a>');
        $contents[] = array('text' => '<br />' . TEXT_CONTENT_DATE_ADDED . ' ' . xos_date_short($cInfo->date_added));
        if ($cInfo->last_modified) $contents[] = array('text' => TEXT_CONTENT_LAST_MODIFIED . ' ' . xos_date_short($cInfo->last_modified));
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_info_pages = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_info_pages.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_info_pages', $output_infobox_info_pages);
endif;
?>
