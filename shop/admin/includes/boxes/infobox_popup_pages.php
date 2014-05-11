<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_popup_pages.php
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
//              filename: categories.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_popup_pages.php') == 'overwrite_all')) :
  $contents = array();
    
  if ($rows > 0) {
    if (isset($cInfo) && is_object($cInfo)) { // page info box contents
      $page_path_string = ''; 
      $page_path = xos_generate_page_path($cInfo->categories_or_pages_id);
      for ($i=(sizeof($page_path[0])-1); $i>0; $i--) { 
        $page_path_string .= $page_path[0][$i]['id'] . '_'; 
      }
      
      $page_link_string = $page_path_string . $cInfo->categories_or_pages_id;
       
      $page_path_string = substr($page_path_string, 0, -1); 
          
      $heading_title = '<b>' . $cInfo->categories_or_pages_name . '</b>';
            
      $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK_TO_OVERVIEW . ' "><span>' . BUTTON_TEXT_BACK_TO_OVERVIEW . '</span></a><a href="' . xos_href_link(FILENAME_POPUP_PAGES, 'cPath=' . $_GET['cPath'] . '&cpID=' . $cInfo->categories_or_pages_id . '&action=preview') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_PREVIEW . ' "><span>' . BUTTON_TEXT_PREVIEW . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . DIR_WS_CATALOG . 'index.php?cPath=' . $page_link_string . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT . '</span></a><a href="" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_SELECT_FOR_LIGHTBOX . ' " onclick="window.opener.CKEDITOR.tools.callFunction(\'' . $_SESSION['ckeditor_func_num'] . '\', \'' . DIR_WS_CATALOG . 'popup_content.php?page_content_id=' . $cInfo->categories_or_pages_id . '\', \'\');window.close();window.opener.focus();return false;"><span>' . BUTTON_TEXT_SELECT_FOR_LIGHTBOX . '</span></a>');
      $contents[] = array('text' => '<br />' . TEXT_DATE_ADDED . ' ' . xos_date_short($cInfo->date_added));
      if (xos_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . xos_date_short($cInfo->last_modified));
      $contents[] = array('text' => '<br />' . TEXT_SUBPAGES . ' ' . $cInfo->children_count . '<br />&nbsp;');
    }
  } else {
    $heading_title = '<b>' . EMPTY_PAGE . '</b>';

      $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_BACK_TO_OVERVIEW . ' "><span>' . BUTTON_TEXT_BACK_TO_OVERVIEW . '</span></a>');
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_popup_pages = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_popup_pages.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                             'info_box_form_tag', 
                             'info_box_contents'));  
                                                    
  $smarty->assign('infobox_popup_pages', $output_infobox_popup_pages);
endif;
?>
