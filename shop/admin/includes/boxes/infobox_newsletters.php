<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_newsletters.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_newsletters.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'delete':
      $heading_title = '<b>' . $nInfo->title . '</b>';

      $form_tag = xos_draw_form('newsletters', FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=deleteconfirm');
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $nInfo->title . '</b>');
      $contents[] = array('text' => '<br /><a href="" onclick="newsletters.submit(); return false" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_CANCEL . ' ">' . BUTTON_TEXT_CANCEL . '</a><br />&nbsp;');
      break;
    default:
      if (is_object($nInfo)) {
        $heading_title = '<b>' . $nInfo->title . '</b>';

        if ($nInfo->locked > 0) {
          if (SEND_EMAILS == 'true') {
            $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=new') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_EDIT . ' ">' . BUTTON_TEXT_EDIT . '</a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=delete') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_PREVIEW . ' ">' . BUTTON_TEXT_PREVIEW . '</a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=send') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_SEND . ' ">' . BUTTON_TEXT_SEND . '</a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=unlock') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_UNLOCK . ' ">' . BUTTON_TEXT_UNLOCK . '</a>');
          } else {
            $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=new') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_EDIT . ' ">' . BUTTON_TEXT_EDIT . '</a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=delete') . '" class="btn btn-danger btn-margin-infobox" title=" ' . BUTTON_TITLE_DELETE . ' ">' . BUTTON_TEXT_DELETE . '</a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_PREVIEW . ' ">' . BUTTON_TEXT_PREVIEW . '</a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=unlock') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_UNLOCK . ' ">' . BUTTON_TEXT_UNLOCK . '</a>');
          }
        } else {
          $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_PREVIEW . ' ">' . BUTTON_TEXT_PREVIEW . '</a><a href="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=lock') . '" class="btn btn-default btn-margin-infobox" title=" ' . BUTTON_TITLE_LOCK . ' ">' . BUTTON_TEXT_LOCK . '</a>');
        }
        $contents[] = array('text' => '<br />' . TEXT_NEWSLETTER_DATE_ADDED . ' ' . xos_date_short($nInfo->date_added));
        if ($nInfo->status == '1') $contents[] = array('text' => TEXT_NEWSLETTER_DATE_SENT . ' ' . xos_date_short($nInfo->date_sent));
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_newsletters = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_newsletters.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_newsletters', $output_infobox_newsletters);
endif;
?>
