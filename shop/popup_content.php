<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : popup_content.php
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
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_POPUP_CONTENT) == 'overwrite_all')) :
  $_SESSION['navigation']->remove_current_page();

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_POPUP_CONTENT);  

  if (isset($_GET['content_id'])) {
    $content_query = xos_db_query("select c.content_id, c.type, cd.name, cd.heading_title, cd.content from " . TABLE_CONTENTS . " c, " . TABLE_CONTENTS_DATA . " cd where c.status = '1' and c.content_id = '" . (int)$_GET['content_id'] . "' and c.content_id = cd.content_id and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  } else {
    $content_query = xos_db_query("select cp.categories_or_pages_id, cpd.categories_or_pages_name as name, cpd.categories_or_pages_heading_title as heading_title, cpd.categories_or_pages_content as content from " . TABLE_CATEGORIES_OR_PAGES . " cp, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where cp.categories_or_pages_status = '1' and cp.categories_or_pages_id = '" . (int)$_GET['page_content_id'] . "' and cp.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  }
  $content = xos_db_fetch_array($content_query);

  $smarty->assign('html_header_add_page_title', PAGE_TITLE_TRAIL_SEPARATOR . $content['name']);
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  
  $smarty->assign(array('content_type' => $content['type'],
                        'heading_title' => $content['heading_title'],
                        'content' => $content['content']));  

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'popup_content');
  
  
  $smarty->display(SELECTED_TPL . '/popup_content.tpl');

  require(DIR_WS_INCLUDES . 'counter.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
