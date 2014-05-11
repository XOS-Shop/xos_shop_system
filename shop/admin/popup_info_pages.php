<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : popup_info_pages.php
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

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_POPUP_INFO_PAGES) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'setflag':      
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['cID']) && isset($_GET['type'])) {
            xos_set_content_status($_GET['cID'], $_GET['flag'], $_GET['type']);
            $smarty_cache_control->clearCache(null, 'L2|box_information');
            $smarty_cache_control->clearCache(null, 'L3|cc_index_default');            
          }
        }

        xos_redirect(xos_href_link(FILENAME_POPUP_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $_GET['cID']));
        break;   
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n\n" .
                
                'function adjustHeight() {' . "\n" . 
                '  var agent = navigator.userAgent.toLowerCase();' . "\n" .              
                '  if (window.innerHeight) {' . "\n" .
                '    document.getElementById("main-div").style.height = window.innerHeight + "px";' . "\n" .
                '  } else if (document.documentElement && document.documentElement.clientHeight) {' . "\n" .  
                '    document.getElementById("main-div").style.height = document.documentElement.clientHeight + "px";' . "\n" . 
                '    if (agent.indexOf("MSIE 5".toLowerCase())>-1 || agent.indexOf("MSIE 6".toLowerCase())>-1 || agent.indexOf("MSIE 7".toLowerCase())>-1) {' . "\n" .  
                '      document.getElementById("inner-div").style.width = document.documentElement.clientWidth-20 + "px";' . "\n" . 
                '    }' . "\n" .
                '  }' . "\n" .                
                '}' . "\n\n" .

                'window.onresize = function(){adjustHeight();}' . "\n\n" .
                   
                '/* ]]> */' . "\n" .
                '</script>' . "\n"; 
  
  require(DIR_WS_INCLUDES . 'html_header.php');     
  require(DIR_WS_INCLUDES . 'footer.php');   

  if ($action == 'preview') {
  
    $cID = xos_db_prepare_input($_GET['cID']);   

    $languages = xos_get_languages();
    $contents_data_array = array();    
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
      $contents_data_query = xos_db_query("select name, heading_title, content from " . TABLE_CONTENTS_DATA . " where content_id = '" . (int)$cID . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
      $contents_data = xos_db_fetch_array($contents_data_query);
      $contents_data_array[]=array('languages_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                                   'name' => $contents_data['name'],
                                   'heading_title' => $contents_data['heading_title'],
                                   'content' => $contents_data['content']);
      
    }

    $smarty->assign(array('action' => 'preview',
                          'contents_data' => $contents_data_array,
                          'link_filename_popup_info_pages_back' => xos_href_link(FILENAME_POPUP_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $cID)));
     
  } else {

    $contents_query = xos_db_query("select c.content_id, c.type, c.status, c.sort_order, c.last_modified, c.date_added, cd.name from " . TABLE_CONTENTS . " c, " . TABLE_CONTENTS_DATA . " cd where c.content_id = cd.content_id and cd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by c.type ASC, c.sort_order ASC, c.content_id ASC ");
    
    $contents_array = array();
    while ($contents = xos_db_fetch_array($contents_query)) {
      if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $contents['content_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
        $cInfo = new objectInfo($contents);
      }
      
      $selected = false;

      if (isset($cInfo) && is_object($cInfo) && ($contents['content_id'] == $cInfo->content_id) ) {
        $selected = true;
        $link_filename_popup_info_page = xos_href_link(FILENAME_POPUP_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->content_id);
      } else {
        $link_filename_popup_info_page = xos_href_link(FILENAME_POPUP_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $contents['content_id']);
      }

      $contents_array[]=array('selected' => $selected,
                              'link_filename_popup_info_pages' => $link_filename_popup_info_page,
                              'content_id' => $contents['content_id'],                               
                              'type' => $contents['type'],
                              'first' => ($contents['type'] != $content_type ? $contents['type'] : ''),
                              'status' => (($contents['status'] == '1') ? true : false),
                              'sort_order' => $contents['sort_order'],
                              'name' => $contents['name'],
                              'icon_status_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10),
                              'icon_status_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10),
                              'icon_status_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT, 10, 10),
                              'icon_status_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT, 10, 10),
                              'link_filename_popup_info_pages_action_setflag_0' => xos_href_link(FILENAME_POPUP_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $contents['content_id'] . '&type=' . $contents['type'] . '&action=setflag&flag=0'),
                              'link_filename_popup_info_pages_action_setflag_1' => xos_href_link(FILENAME_POPUP_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $contents['content_id'] . '&type=' . $contents['type'] . '&action=setflag&flag=1'),
                              'link_filename_popup_info_pages_preview' => xos_href_link(FILENAME_POPUP_INFO_PAGES, 'cID=' . $contents['content_id'] . '&action=preview'));                              
     
      $content_type = $contents['type'];                          
    }
    
    $smarty->assign('contents', $contents_array);  
    
    require(DIR_WS_BOXES . 'infobox_popup_info_pages.php');

  }
  
  $smarty->assign('form_end', '</form>');  

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'popup_info_pages');
  
  $smarty->display(ADMIN_TPL . '/popup_info_pages.tpl');  
endif;  
?>
