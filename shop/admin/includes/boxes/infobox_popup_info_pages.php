<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_popup_info_pages.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_popup_info_pages.php') == 'overwrite_all')) :
  $contents = array();

  if (is_object($cInfo)) {
    $heading_title = '<b>' . $cInfo->name . '</b>'; 
    $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK_TO_OVERVIEW . ' "><span>' . BUTTON_TEXT_BACK_TO_OVERVIEW . '</span></a><a href="' . xos_href_link(FILENAME_POPUP_INFO_PAGES, 'cID=' . $cInfo->content_id . '&action=preview') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_PREVIEW . ' "><span>' . BUTTON_TEXT_PREVIEW . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . DIR_WS_CATALOG . 'content.php?content_id=' . $cInfo->content_id . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT_FOR_LIGHTBOX . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . DIR_WS_CATALOG . 'popup_content.php?content_id=' . $cInfo->content_id . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT_FOR_LIGHTBOX . '</span></a>');
    $contents[] = array('text' => '<br />' . TEXT_CONTENT_DATE_ADDED . ' ' . xos_date_short($cInfo->date_added));
    if ($cInfo->last_modified) $contents[] = array('text' => TEXT_CONTENT_LAST_MODIFIED . ' ' . xos_date_short($cInfo->last_modified));
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_popup_info_pages = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_popup_info_pages.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                             'info_box_form_tag', 
                             'info_box_contents'));  
                                                    
  $smarty->assign('infobox_popup_info_pages', $output_infobox_popup_info_pages);
endif;
?>
