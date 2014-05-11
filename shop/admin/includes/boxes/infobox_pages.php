<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_pages.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_pages.php') == 'overwrite_all')) :
    $contents = array();
    switch ($action) {
      case 'delete_page':
        $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_PAGE . '</b>';

        $form_tag = xos_draw_form('pages', FILENAME_PAGES, 'action=delete_page_confirm&cPath=' . $cPath) . xos_draw_hidden_field('categories_or_pages_id', $cInfo->categories_or_pages_id);
        $contents[] = array('text' => TEXT_DELETE_PAGE_INTRO);
        $contents[] = array('text' => '<br /><b>' . $cInfo->categories_or_pages_name . '</b>');
        if ($cInfo->children_count > 0) $contents[] = array('text' => '<br />' . sprintf(TEXT_DELETE_WARNING_CHILDREN, $cInfo->children_count));
        if ($cInfo->products_count > 0) $contents[] = array('text' => '<br />' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $cInfo->products_count));
        $contents[] = array('text' => '<br /><a href="" onclick="pages.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_PAGES, 'cPath=' . $cPath . '&cpID=' . $cInfo->categories_or_pages_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      case 'move_page':
        $heading_title = '<b>' . TEXT_INFO_HEADING_MOVE_PAGE . '</b>';

        $form_tag = xos_draw_form('pages', FILENAME_PAGES, 'action=move_page_confirm&cPath=' . $cPath) . xos_draw_hidden_field('categories_or_pages_id', $cInfo->categories_or_pages_id);
        $contents[] = array('text' => sprintf(TEXT_MOVE_PAGES_INTRO, $cInfo->categories_or_pages_name));
        $contents[] = array('text' => '<br />' . sprintf(TEXT_MOVE, $cInfo->categories_or_pages_name) . '<br />' . xos_draw_pull_down_menu('move_to_page_id', xos_get_page_tree(), $cInfo->categories_or_pages_id));
        $contents[] = array('text' => '<br /><a href="" onclick="pages.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_MOVE . ' "><span>' . BUTTON_TEXT_MOVE . '</span></a><a href="' . xos_href_link(FILENAME_PAGES, 'cPath=' . $cPath . '&cpID=' . $cInfo->categories_or_pages_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      default:
        if ($rows > 0) {
          if (isset($cInfo) && is_object($cInfo)) { // page info box contents
            $page_path_string = ''; 
            $page_path = xos_generate_page_path($cInfo->categories_or_pages_id);
            for ($i=(sizeof($page_path[0])-1); $i>0; $i--) { 
              $page_path_string .= $page_path[0][$i]['id'] . '_'; 
            } 
            $page_path_string = substr($page_path_string, 0, -1); 
          
            $heading_title = '<b>' . $cInfo->categories_or_pages_name . '</b>';
            
            $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_PAGES, 'cPath=' . $page_path_string . '&cpID=' . $cInfo->categories_or_pages_id . '&action=new_page') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_PAGES, 'cPath=' . $page_path_string . '&cpID=' . $cInfo->categories_or_pages_id . '&action=delete_page') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_PAGES, 'cPath=' . $page_path_string . '&cpID=' . $cInfo->categories_or_pages_id . '&action=move_page') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_MOVE . ' "><span>' . BUTTON_TEXT_MOVE . '</span></a><a href="' . xos_href_link(FILENAME_PAGES, xos_get_path($cInfo->categories_or_pages_id) . '&action=new_page') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_NEW_PAGE . ' ' . $cInfo->categories_or_pages_name . ' "><span>' . BUTTON_TEXT_NEW_PAGE . ' "' . $cInfo->categories_or_pages_name . '"</span></a>');
            $contents[] = array('text' => '<br />' . TEXT_DATE_ADDED . ' ' . xos_date_short($cInfo->date_added));
            if (xos_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . xos_date_short($cInfo->last_modified));
            $contents[] = array('text' => '<br />' . TEXT_SUBPAGES . ' ' . $cInfo->children_count . '<br />&nbsp;');
          }
        } else {
          $heading_title = '<b>' . EMPTY_PAGE . '</b>';

          $contents[] = array('text' => TEXT_NO_CHILD_PAGES);
        }
        break;
    }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_pages = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_pages.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                             'info_box_form_tag', 
                             'info_box_contents'));  
                                                    
  $smarty->assign('infobox_pages', $output_infobox_pages);
endif;
?>
