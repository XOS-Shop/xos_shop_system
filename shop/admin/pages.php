<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : pages.php
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
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_PAGES) == 'overwrite_all')) :  
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
	  xos_redirect(xos_href_link(FILENAME_PAGES, $cPath_goto . 'cpID=' . (int)$_POST['goto_page_id']));
        } else {
          xos_redirect(xos_href_link(FILENAME_PAGES));
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

	xos_redirect(xos_href_link(FILENAME_PAGES, 'cPath=' . $_GET['cPath'] . '&cpID=' . $_GET['cpID']));
	break; 	
      case 'setflag_menu':
        if ( ($_GET['flag_menu'] == '0') || ($_GET['flag_menu'] == '1') ) {
          if (isset($_GET['cpID'])) {
            xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set page_not_in_menu = '" . (int)$_GET['flag_menu'] . "', last_modified = now() where categories_or_pages_id = '" . (int)$_GET['cpID'] . "'");
        
            $smarty_cache_control->clearAllCache();
          }
        }

	xos_redirect(xos_href_link(FILENAME_PAGES, 'cPath=' . $_GET['cPath'] . '&cpID=' . $_GET['cpID']));
	break;  		     
      case 'insert_page':
      case 'update_page':
        if (isset($_POST['categories_or_pages_id'])) $categories_or_pages_id = xos_db_prepare_input($_POST['categories_or_pages_id']);
        $page_not_in_menu = xos_db_prepare_input($_POST['page_not_in_menu']);
        $sort_order = xos_db_prepare_input($_POST['sort_order']);
        $categories_or_pages_status = xos_db_prepare_input($_POST['categories_or_pages_status']);
        $current_categories_or_pages_status = xos_db_prepare_input($_POST['current_categories_or_pages_status']);
        $sql_data_array = array('sort_order' => (int)$sort_order, 'is_page' => 'true', 'page_not_in_menu' => (int)$page_not_in_menu, 'categories_or_pages_status' => (int)$categories_or_pages_status);

        $languages = xos_get_languages();
        
        $page_error = false;
        
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          if (!xos_not_null($_POST['categories_or_pages_name'][$languages[$i]['id']])) {
            $messageStack->add('header', ERROR_PAGE_NAME, 'error');
            $page_error = true;
          }
        }
         
        if ($page_error == false) {
          if ($action == 'insert_page') {
            $insert_sql_data = array('parent_id' => $current_page_id,
                                     'date_added' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            xos_db_perform(TABLE_CATEGORIES_OR_PAGES, $sql_data_array);

            $categories_or_pages_id = xos_db_insert_id();
          } elseif ($action == 'update_page') {
            $update_sql_data = array('last_modified' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $update_sql_data);

            xos_db_perform(TABLE_CATEGORIES_OR_PAGES, $sql_data_array, 'update', "categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
            
            if ($categories_or_pages_status != $current_categories_or_pages_status) {
              $tree = xos_get_page_tree($categories_or_pages_id);
              for ($i=1; $i<sizeof($tree); $i++) {
                xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set categories_or_pages_status =  '" . (int)$categories_or_pages_status . "', last_modified = now() where categories_or_pages_id = '" . $tree[$i]['id'] . "'");
              }
            }                             
          }
                
          $categories_or_pages_name_array = $_POST['categories_or_pages_name'];
          $categories_or_pages_heading_title_array = $_POST['categories_or_pages_heading_title'];
          $categories_or_pages_content_array = $_POST['categories_or_pages_content'];        
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {

            $language_id = $languages[$i]['id'];

            $sql_data_array = array('categories_or_pages_name' => xos_db_prepare_input(htmlspecialchars_decode($categories_or_pages_name_array[$language_id])),         
                                    'categories_or_pages_heading_title' => xos_db_prepare_input(htmlspecialchars($categories_or_pages_heading_title_array[$language_id])),
                                    'categories_or_pages_content' => preg_replace_callback('#href=\"?(([^\" >]*?\.php)([^\" >]*?))#siU', 'internal_link_replacement', (trim(str_replace('&#160;', '', strip_tags(xos_db_prepare_input($categories_or_pages_content_array[$language_id]), '<img>'))) != '') ? xos_db_prepare_input($categories_or_pages_content_array[$language_id]) : ''));

            if ($action == 'insert_page') {
              $insert_sql_data = array('categories_or_pages_id' => $categories_or_pages_id,
                                       'language_id' => $language_id);

              $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

              xos_db_perform(TABLE_CATEGORIES_OR_PAGES_DATA, $sql_data_array);
            } elseif ($action == 'update_page') {
              xos_db_perform(TABLE_CATEGORIES_OR_PAGES_DATA, $sql_data_array, 'update', "categories_or_pages_id = '" . (int)$categories_or_pages_id . "' and language_id = '" . (int)$language_id . "'");
            }
          }
        
          $smarty_cache_control->clearAllCache();
        
          xos_redirect(xos_href_link(FILENAME_PAGES, 'cPath=' . $cPath . '&cpID=' . $categories_or_pages_id));        
        } else {
          $reload = true;
          $action = 'new_page';
        }                        
        break;
      case 'delete_page_confirm':
        if (isset($_POST['categories_or_pages_id'])) {
          $categories_or_pages_id = xos_db_prepare_input($_POST['categories_or_pages_id']);

          $pages = xos_get_page_tree($categories_or_pages_id, '', '0', '', true);

          for ($i=0, $n=sizeof($pages); $i<$n; $i++) {
            xos_remove_page($pages[$i]['id']);
          }
          
          $smarty_cache_control->clearAllCache();
        }

        xos_redirect(xos_href_link(FILENAME_PAGES, 'cPath=' . $cPath));
        break;
      case 'move_page_confirm':
        if (isset($_POST['categories_or_pages_id']) && ($_POST['categories_or_pages_id'] != $_POST['move_to_page_id'])) {
          $categories_or_pages_id = xos_db_prepare_input($_POST['categories_or_pages_id']);
          $new_parent_id = xos_db_prepare_input($_POST['move_to_page_id']);

          $path = explode('_', xos_get_generated_page_path_ids($new_parent_id));

          if (in_array($categories_or_pages_id, $path)) {
            $messageStack->add_session('header', ERROR_CANNOT_MOVE_PAGE_TO_PARENT, 'error');

            xos_redirect(xos_href_link(FILENAME_PAGES, 'cPath=' . $cPath . '&cpID=' . $categories_or_pages_id));
          } else {
            xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set parent_id = '" . (int)$new_parent_id . "', last_modified = now() where categories_or_pages_id = '" . (int)$categories_or_pages_id . "'");
            
            if ($new_parent_id > '0') {
              $pages_query = xos_db_query("select categories_or_pages_status from " . TABLE_CATEGORIES_OR_PAGES . " where categories_or_pages_id = '" . (int)$new_parent_id . "'");
              $pages = xos_db_fetch_array($pages_query);

              if ($pages['categories_or_pages_status'] == '0') {
                $tree = xos_get_page_tree($new_parent_id);
                for ($i=1; $i<sizeof($tree); $i++) {
                  xos_db_query("update " . TABLE_CATEGORIES_OR_PAGES . " set categories_or_pages_status = '0', last_modified = now() where categories_or_pages_id = '" . $tree[$i]['id'] . "'");
                }
              }
            }

            $smarty_cache_control->clearAllCache();
            
            xos_redirect(xos_href_link(FILENAME_PAGES, 'cPath=' . $new_parent_id . '&cpID=' . $categories_or_pages_id));
          }
        }

        break;      
    }
  }
      
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  if ($action == 'new_page' && WYSIWYG_FOR_PAGES == 'true') {
    $javascript .= '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/ckeditor/ckeditor.js"></script>' . "\n";
  } 
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  
    
//  $smarty->assign('BODY_TAG_PARAMS', 'onload="SetFocus();"');  

  if ($action == 'new_page') {
    $parameters = array('categories_or_pages_id' => '',
                        'page_name' => '',
                        'page_not_in_menu' => '',
                        'sort_order' => '',                        
                        'categories_or_pages_status' => '');

    $cInfo = new objectInfo($parameters);
    
    if (isset($_GET['cpID']) && $reload != true) {
    
      $cpID = xos_db_prepare_input($_GET['cpID']);
             
      $page_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name as page_name, c.page_not_in_menu, c.sort_order, c.categories_or_pages_status from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = '" . (int)$cpID . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "'");    
      $page = xos_db_fetch_array($page_query);
      $cInfo->objectInfo($page);      
    } elseif (xos_not_null($_POST)) {
      $cInfo->objectInfo($_POST);   
    }        

    if (WYSIWYG_FOR_PAGES == 'true') {
      $smarty->assign(array('wysiwyg' => true,
                            'link_filename_popup_file_manager_link_selection' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents')),
                            'link_filename_popup_file_manager_image' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/image')),
                            'link_filename_popup_file_manager_flash' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/flash')),
                            'page_config' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/page_config.js',
                            'lang_code' => xos_get_languages_code()));
    }

    $languages = xos_get_languages();
    $contents_data_array = array(); 
          
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
    
      $page_data_query = xos_db_query("select categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content from " . TABLE_CATEGORIES_OR_PAGES_DATA . " where categories_or_pages_id = '" . (int)$cInfo->categories_or_pages_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");    
      $page_data = xos_db_fetch_array($page_data_query);

      $pages_data_array[]=array('languages_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                                'input_name' => xos_draw_input_field('categories_or_pages_name[' . $languages[$i]['id'] . ']', (isset($cInfo->categories_or_pages_name[$languages[$i]['id']]) ? stripslashes(htmlspecialchars($cInfo->categories_or_pages_name[$languages[$i]['id']])) : htmlspecialchars($page_data['categories_or_pages_name'])), 'maxlength="64" size="30"', true),
                                'input_heading_title' => xos_draw_input_field('categories_or_pages_heading_title[' . $languages[$i]['id'] . ']', (isset($cInfo->categories_or_pages_heading_title[$languages[$i]['id']]) ? stripslashes($cInfo->categories_or_pages_heading_title[$languages[$i]['id']]) : $page_data['categories_or_pages_heading_title']), 'maxlength="255" size="80"'),
                                'page_description' => 'categories_or_pages_content[' . $languages[$i]['id'] . ']',
                                'page_template_file' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/templates/' . $languages[$i]['directory'] . '/page_template.js',
                                'page_template_lang' => $languages[$i]['directory'] . '_default',
                                'page_textarea' => xos_draw_textarea_field('categories_or_pages_content[' . $languages[$i]['id'] . ']', '130', '25', (isset($cInfo->categories_or_pages_content[$languages[$i]['id']]) ? stripslashes($cInfo->categories_or_pages_content[$languages[$i]['id']]) : $page_data['categories_or_pages_content'])));      
    }          

    $smarty->assign(array('update' => isset($_GET['cpID']) ? true : false,
                          'form_begin' => isset($_GET['cpID']) ? xos_draw_form('update_page', FILENAME_PAGES, 'action=update_page&cPath=' . $cPath . '&cpID=' . $_GET['cpID'], 'post', 'onsubmit="return confirm(\'' . JS_CONFIRM_UPDATE . '\')" enctype="multipart/form-data"') . xos_draw_hidden_field('categories_or_pages_id', $cInfo->categories_or_pages_id) : xos_draw_form('insert_page', FILENAME_PAGES, 'action=insert_page&cPath=' . $cPath, 'post', 'onsubmit="return confirm(\'' . JS_CONFIRM_INSERT . '\')" enctype="multipart/form-data"'),
                          'hidden_fields' => xos_draw_hidden_field('page_name', $cInfo->page_name) . xos_draw_hidden_field('current_categories_or_pages_status', $cInfo->categories_or_pages_status),
                          'pages_data' => $pages_data_array,                         
                          'radio_page_not_in_menu_0' => xos_draw_radio_field('page_not_in_menu', '0', $cInfo->page_not_in_menu == 1 ? false : true),   
                          'radio_page_not_in_menu_1' => xos_draw_radio_field('page_not_in_menu', '1', $cInfo->page_not_in_menu == 1 ? true : false),                         
                          'radio_status_0' => xos_draw_radio_field('categories_or_pages_status', '0', $cInfo->categories_or_pages_status == 1 ? false : true),   
                          'radio_status_1' => xos_draw_radio_field('categories_or_pages_status', '1', $cInfo->categories_or_pages_status == 1 ? true : false),                          
                          'input_sort_order' => xos_draw_input_field('sort_order', $cInfo->sort_order, 'maxlength="5" size="3"'),                                                  
                          'text_new_page' => sprintf(TEXT_NEW_PAGE_3, (!isset($_GET['cpID']) ? TEXT_NEW_PAGE_1 : TEXT_NEW_PAGE_2), xos_output_generated_page_path($current_page_id)),                                                    
                          'link_filename_pages' => xos_href_link(FILENAME_PAGES, 'cPath=' . $cPath . (isset($_GET['cpID']) ? '&cpID=' . (int)$_GET['cpID'] : '')),                          
                          'form_end' => '</form>'));
        
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'pages');
    $output_new_page = $smarty->fetch(ADMIN_TPL . '/includes/modules/new_page.tpl');

    $smarty->assign('central_contents', $output_new_page);  
        
  } else {

    $pages_count = 0;
    $rows = 0;
    $pages_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.parent_id, c.page_not_in_menu, c.sort_order, c.date_added, c.last_modified, c.categories_or_pages_status  from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.parent_id = '" . (int)$current_page_id . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and c.is_page != 'false' and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by c.sort_order, cpd.categories_or_pages_name");
    
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
                           'icon_status_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10),
                           'icon_status_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10),
                           'icon_status_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT, 10, 10),
                           'icon_status_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT, 10, 10),
                          
                           'icon_not_in_menu_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_not_in_menu_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10),
                           'icon_not_in_menu_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_not_in_menu_red.gif', ICON_TITLE_STATUS_RED, 10, 10),
                           'icon_not_in_menu_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_not_in_menu_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT, 10, 10),
                           'icon_not_in_menu_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_not_in_menu_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT, 10, 10),
                                                      
                           'link_filename_pages_flag_status_0' => xos_href_link(FILENAME_PAGES, 'action=setflag_status&flag_status=0&cpID=' . $pages['categories_or_pages_id'] . '&cPath=' . $cPath),
                           'link_filename_pages_flag_status_1' => xos_href_link(FILENAME_PAGES, 'action=setflag_status&flag_status=1&cpID=' . $pages['categories_or_pages_id'] . '&cPath=' . $cPath),                                                              
                           'link_filename_pages_flag_not_in_menu_0' => xos_href_link(FILENAME_PAGES, 'action=setflag_menu&flag_menu=0&cpID=' . $pages['categories_or_pages_id'] . '&cPath=' . $cPath),
                           'link_filename_pages_flag_not_in_menu_1' => xos_href_link(FILENAME_PAGES, 'action=setflag_menu&flag_menu=1&cpID=' . $pages['categories_or_pages_id'] . '&cPath=' . $cPath), 
                           'link_filename_pages_get_path' => xos_href_link(FILENAME_PAGES, xos_get_path($pages['categories_or_pages_id'])),
                           'link_filename_pages_edit' => xos_href_link(FILENAME_PAGES, 'cPath=' . $cPath . '&cpID=' . $pages['categories_or_pages_id'] . '&action=new_page'),
                           'link_filename_pages_cpath_cpath_cid' => xos_href_link(FILENAME_PAGES, 'cPath=' . $cPath . '&cpID=' . $pages['categories_or_pages_id']));
    }   

    $cPath_back = '';
    $page_path = xos_generate_page_path($current_page_id);
    for ($i=(sizeof($page_path[0])-1); $i>0; $i--) { 
      $current_page_id != $page_path[0][$i]['id'] ? $cPath_back .= $page_path[0][$i]['id'] . '_' : ''; 
    } 
    $cPath_back = substr($cPath_back, 0, -1); 

    $cPath_back = (xos_not_null($cPath_back)) ? 'cPath=' . $cPath_back . '&' : '';

    if ($current_page_id > 0) {
      $smarty->assign('link_filename_pages_back', xos_href_link(FILENAME_PAGES, $cPath_back . 'cpID=' . $current_page_id));
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
                          'link_filename_pages_action_new_page' => xos_href_link(FILENAME_PAGES, 'cPath=' . $cPath . '&action=new_page'),
                          'form_begin_goto' => xos_draw_form('goto', FILENAME_PAGES, 'action=goto_page'),
                          'pull_down_pages' => xos_draw_pull_down_menu('goto_page_id', $page_tree, $cInfo->categories_or_pages_id, 'onchange="this.form.submit();"'),
                          'form_end' => '</form>')); 

    require(DIR_WS_BOXES . 'infobox_pages.php');
    
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'pages');
    $output_pages = $smarty->fetch(ADMIN_TPL . '/pages.tpl');  

    $smarty->assign('central_contents', $output_pages);

  }
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');
 
  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
