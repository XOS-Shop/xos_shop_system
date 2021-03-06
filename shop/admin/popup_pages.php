<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : popup_pages.php
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

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_POPUP_PAGES) == 'overwrite_all')) :  
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'goto_page':    
        if (isset($_POST['goto_page_id']) && $_POST['goto_page_id'] > 0) {  
          $cPath_goto = '';
          $page_path = xos_generate_page_path((int)$_POST['goto_page_id']);
          for ($i=(sizeof($page_path[0])-1); $i>0; $i--) { 
            $_POST['goto_page_id'] != $page_path[0][$i]['id'] ? $cPath_goto .= $page_path[0][$i]['id'] . '_' : ''; 
          } 
          $cPath_goto = substr($cPath_goto, 0, -1); 
          $cPath_goto = (xos_not_null($cPath_goto)) ? 'cPath=' . $cPath_goto . '&' : '';
	  xos_redirect(xos_href_link(FILENAME_POPUP_PAGES, $cPath_goto . 'cpID=' . (int)$_POST['goto_page_id']));
        } else {
          xos_redirect(xos_href_link(FILENAME_POPUP_PAGES));
        }	
	break;     
      case 'setflag_status':
        if ( ($_GET['flag_status'] == '0') || ($_GET['flag_status'] == '1') ) {
          if (isset($_GET['cpID'])) {
            xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set categories_or_pages_status = '" . (int)$_GET['flag_status'] . "', last_modified = now() where categories_or_pages_id = '" . (int)$_GET['cpID'] . "'");
            $tree = xos_get_page_tree($_GET['cpID']);
            for ($i=1; $i<sizeof($tree); $i++) {
              xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set categories_or_pages_status = '" . (int)$_GET['flag_status'] . "', last_modified = now() where categories_or_pages_id = '" . $tree[$i]['id'] . "'");
            }
        
            $smarty_cache_control->clearAllCache();
          }
        }

	xos_redirect(xos_href_link(FILENAME_POPUP_PAGES, 'cPath=' . $_GET['cPath'] . '&cpID=' . $_GET['cpID']));
	break; 	
      case 'setflag_menu':
        if ( ($_GET['flag_menu'] == '0') || ($_GET['flag_menu'] == '1') ) {
          if (isset($_GET['cpID'])) {
            xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set page_not_in_menu = '" . (int)$_GET['flag_menu'] . "', last_modified = now() where categories_or_pages_id = '" . (int)$_GET['cpID'] . "'");
        
            $smarty_cache_control->clearAllCache();
          }
        }

	xos_redirect(xos_href_link(FILENAME_POPUP_PAGES, 'cPath=' . $_GET['cPath'] . '&cpID=' . $_GET['cpID']));
	break;  		         
    }
  }
  
  require(DIR_WS_INCLUDES . 'html_header.php');     
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($messageStack->size('header') > 0) {    
    $smarty->assign('message_stack_header', $messageStack->output('header'));
    $smarty->assign('message_stack_header_error', $messageStack->output('header', 'error'));
    $smarty->assign('message_stack_header_warning', $messageStack->output('header', 'warning')); 
    $smarty->assign('message_stack_header_success', $messageStack->output('header', 'success'));    
  }

  if ($action == 'preview') {


    $cpID = xos_db_prepare_input($_GET['cpID']);
    
    $languages = xos_get_languages();
    $pages_data_array = array();       

    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
    
      $page_data_query = xos_db_query("select categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content from " . TABLE_CATEGORIES_OR_PAGES_DATA . " where categories_or_pages_id = '" . (int)$cpID . "' and language_id = '" . (int)$languages[$i]['id'] . "'");    
      $page_data = xos_db_fetch_array($page_data_query);

      $pages_data_array[]=array('languages_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                                'name' => $page_data['categories_or_pages_name'],
                                'heading_title' => $page_data['categories_or_pages_heading_title'],
                                'content' => $page_data['categories_or_pages_content']);      
    } 

    $smarty->assign(array('action' => 'preview',
                          'pages_data' => $pages_data_array,
                          'link_filename_popup_page_back' => xos_href_link(FILENAME_POPUP_PAGES, 'cPath=' . $cPath . '&cpID=' . (int)$_GET['cpID'])));
        
  } else {

    $pages_count = 0;
    $rows = 0;
    $pages_query = xos_db_query("select c.categories_or_pages_id, c.link_request_type, cpd.categories_or_pages_name, c.parent_id, c.page_not_in_menu, c.sort_order, c.date_added, c.last_modified, c.categories_or_pages_status  from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.parent_id = '" . (int)$current_page_id . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and c.is_page != 'false' and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by c.sort_order, cpd.categories_or_pages_name");
    
    $pages_array = array(); 
    while ($pages = xos_db_fetch_array($pages_query)) {
      $pages_count++;
      $rows++;
      
      $children_in_page = xos_children_in_page_count($pages['categories_or_pages_id']);
      
      if ((!isset($_GET['cpID']) && !isset($_GET['pID']) || (isset($_GET['cpID']) && ($_GET['cpID'] == $pages['categories_or_pages_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
        $page_children = array('children_count' => $children_in_page);

        $cInfo_array = array_merge((array)$pages, (array)$page_children);
        $cInfo = new objectInfo($cInfo_array);
      }          

      $pages_array[]=array('selected' => (isset($cInfo) && is_object($cInfo) && ($pages['categories_or_pages_id'] == $cInfo->categories_or_pages_id) ? true : false ),
                           'children' => ($children_in_page > 0 ? $children_in_page : false ),
                           'status' => ($pages['categories_or_pages_status'] == '1' ? true : false),
                           'page_not_in_menu' => ($pages['page_not_in_menu'] == '1' ? true : false),                                
                           'name' => htmlspecialchars($pages['categories_or_pages_name']),
                           'sort_order' => $pages['sort_order'],                              
                           'icon_status_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN),
                           'icon_status_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED),
                           'icon_status_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT),
                           'icon_status_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT),
                          
                           'icon_not_in_menu_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_not_in_menu_green.gif', ICON_TITLE_STATUS_GREEN),
                           'icon_not_in_menu_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_not_in_menu_red.gif', ICON_TITLE_STATUS_RED),
                           'icon_not_in_menu_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_not_in_menu_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT),
                           'icon_not_in_menu_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_not_in_menu_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT),
                                                      
                           'link_filename_popup_pages_flag_status_0' => xos_href_link(FILENAME_POPUP_PAGES, 'action=setflag_status&flag_status=0&cpID=' . $pages['categories_or_pages_id'] . '&cPath=' . $cPath),
                           'link_filename_popup_pages_flag_status_1' => xos_href_link(FILENAME_POPUP_PAGES, 'action=setflag_status&flag_status=1&cpID=' . $pages['categories_or_pages_id'] . '&cPath=' . $cPath),                                                              
                           'link_filename_popup_pages_flag_not_in_menu_0' => xos_href_link(FILENAME_POPUP_PAGES, 'action=setflag_menu&flag_menu=0&cpID=' . $pages['categories_or_pages_id'] . '&cPath=' . $cPath),
                           'link_filename_popup_pages_flag_not_in_menu_1' => xos_href_link(FILENAME_POPUP_PAGES, 'action=setflag_menu&flag_menu=1&cpID=' . $pages['categories_or_pages_id'] . '&cPath=' . $cPath), 
                           'link_filename_popup_pages_get_path' => xos_href_link(FILENAME_POPUP_PAGES, xos_get_path($pages['categories_or_pages_id'])),
                           'link_filename_popup_pages_cpath_cpath_cid' => xos_href_link(FILENAME_POPUP_PAGES, 'cPath=' . $cPath . '&cpID=' . $pages['categories_or_pages_id']));
    }   

    $cPath_back = '';
    $page_path = xos_generate_page_path($current_page_id);
    for ($i=(sizeof($page_path[0])-1); $i>0; $i--) { 
      $current_page_id != $page_path[0][$i]['id'] ? $cPath_back .= $page_path[0][$i]['id'] . '_' : ''; 
    } 
    $cPath_back = substr($cPath_back, 0, -1); 

    $cPath_back = (xos_not_null($cPath_back)) ? 'cPath=' . $cPath_back . '&' : '';

    if ($current_page_id > 0) {
      $smarty->assign('link_filename_popup_pages_back', xos_href_link(FILENAME_POPUP_PAGES, $cPath_back . 'cpID=' . $current_page_id));
    }
    
    $page_tree = xos_get_page_tree();
    $current_page_name = '';
    for ($i=0, $n=sizeof($page_tree); $i<$n; $i++) {
      if ($current_page_id == $page_tree[$i]['id']) {
        $current_page_name = ltrim($page_tree[$i]['text'], '&nbsp;');
      }
    }      
    
    $smarty->assign(array('pages' => $pages_array,
                          'pages_count' => $pages_count,
                          'current_page_name' => $current_page_name,
                          'form_begin_goto' => xos_draw_form('goto', FILENAME_POPUP_PAGES, 'action=goto_page'),
                          'pull_down_pages' => xos_draw_pull_down_menu('goto_page_id', $page_tree, $cInfo->categories_or_pages_id, 'onchange="this.form.submit();"'),
                          'form_end' => '</form>')); 

    require(DIR_WS_BOXES . 'infobox_popup_pages.php');
    
  }
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'popup_pages');
    
  $smarty->display(ADMIN_TPL . '/popup_pages.tpl');   
endif;  
?>
