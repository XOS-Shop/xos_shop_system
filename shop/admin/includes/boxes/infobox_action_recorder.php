<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_action_recorder.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2014 Hanspeter Zeller
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
//              Copyright (c) 2013 osCommerce
//              filename: action_recorder.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_action_recorder.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    default:
      if (isset($aInfo) && is_object($aInfo)) {
        $heading_title = '<b>' . $aInfo->module . '</b>';

        $contents[] = array('text' => TEXT_INFO_IDENTIFIER . '<br /><br />' . (!empty($aInfo->identifier) ? '<a href="' . xos_href_link(FILENAME_ACTION_RECORDER, 'search=' . $aInfo->identifier) . '"><u>' . xos_output_string_protected($aInfo->identifier) . '</u></a>': '(empty)'));
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . xos_datetime_short($aInfo->date_added));
      }
      break;
  }
  
  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_contents' => $contents));
                            
  $output_infobox_action_recorder = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_action_recorder.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_action_recorder', $output_infobox_action_recorder);
endif;
?>
