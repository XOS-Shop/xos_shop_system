<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : info_pages.php
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
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_INFO_PAGES) == 'overwrite_all')) :
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

        xos_redirect(xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $_GET['cID']));
        break;          
      case 'insert':
      case 'update':
        if (isset($_POST['content_id'])) $content_id = xos_db_prepare_input($_POST['content_id']);
        $type = xos_db_prepare_input($_POST['type']);
        
        if ($_POST['status'] == 1) {
          $status = xos_db_prepare_input($_POST['status']);
        } else {
          $status = 0;
        }
        
        $sort_order = xos_db_prepare_input($_POST['sort_order']);

        $content_error = false;
        
        $languages = xos_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          if (!xos_not_null($_POST['name'][$languages[$i]['id']])) {
            $messageStack->add('header', ERROR_CONTENT_NAME, 'error');
            $content_error = true;
          }
        }

        if ($content_error == false) {
          $sql_data_array = array('type' => $type,
                                  'sort_order' => $sort_order);
                                                     
          if ($action == 'insert') {
            $sql_data_array['status'] = '0';          
            $sql_data_array['date_added'] = 'now()';

            xos_db_perform(TABLE_CONTENTS, $sql_data_array);
            $content_id = xos_db_insert_id();
          } elseif ($action == 'update') {          
            xos_set_content_status($content_id, $status, $type);            
            $sql_data_array['last_modified'] = 'now()';
            xos_db_perform(TABLE_CONTENTS, $sql_data_array, 'update', "content_id = '" . (int)$content_id . "'");
          }
          
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
            $sql_data_array = array('name' => xos_db_prepare_input(htmlspecialchars_decode($_POST['name'][$languages[$i]['id']])),         
                                    'heading_title' => xos_db_prepare_input(htmlspecialchars($_POST['heading_title'][$languages[$i]['id']])),
                                    'content' => preg_replace_callback('#href=\"?(([^\" >]*?\.php)([^\" >]*?))#siU', 'internal_link_replacement', (trim(str_replace('&#160;', '', strip_tags(xos_db_prepare_input($_POST['content'][$languages[$i]['id']]), '<img>'))) != '') ? xos_db_prepare_input($_POST['content'][$languages[$i]['id']]) : ''));
            
            if ($action == 'insert') {
              $sql_data_array['content_id'] = $content_id;          
              $sql_data_array['language_id'] = $languages[$i]['id'];              
              xos_db_perform(TABLE_CONTENTS_DATA, $sql_data_array);
            } elseif ($action == 'update') {
              xos_db_perform(TABLE_CONTENTS_DATA, $sql_data_array, 'update', "content_id = '" . (int)$content_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
            }                              
          }
          
          $smarty_cache_control->clearCache(null, 'L2|box_information');
          $smarty_cache_control->clearCache(null, 'L3|cc_index_default');          

          xos_redirect(xos_href_link(FILENAME_INFO_PAGES, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'cID=' . $content_id));
        } else {
          $reload = true;
          $action = 'new';
        }
        break;
      case 'deleteconfirm':
        $content_id = xos_db_prepare_input($_GET['cID']);

        xos_db_query("delete from " . TABLE_CONTENTS . " where content_id = '" . (int)$content_id . "'");
        xos_db_query("delete from " . TABLE_CONTENTS_DATA . " where content_id = '" . (int)$content_id . "'");

        $smarty_cache_control->clearCache(null, 'L2|box_information');
        $smarty_cache_control->clearCache(null, 'L3|cc_index_default');

        xos_redirect(xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page']));
        break;     
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";

  if ($action == 'new' && WYSIWYG_FOR_INFO_PAGES == 'true') {
    $javascript .= '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/ckeditor/ckeditor.js"></script>' . "\n";
  }
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  if ($action == 'new') {
    $form_action = 'insert';

    $parameters = array('content_id' => '',
                        'type' => '',
                        'status' => '',
                        'sort_order' => '');

    $cInfo = new objectInfo($parameters);

    if (isset($_GET['cID'])) {
      $form_action = 'update';
            
      $cID = xos_db_prepare_input($_GET['cID']);
      
      if (!$reload == true) {
        $contents_query =  xos_db_query("select content_id, type, status, sort_order   from " . TABLE_CONTENTS . " where content_id = '" . (int)$cID . "'");
        $contents = xos_db_fetch_array($contents_query);
        $cInfo->objectInfo($contents);
      } elseif (xos_not_null($_POST)) {
        $cInfo->objectInfo($_POST);
      }
    } elseif (xos_not_null($_POST)) {
      $cInfo->objectInfo($_POST);   
    }

    $smarty->assign(array('action' => 'new',
                          'form_begin_new' => xos_draw_form('content', FILENAME_INFO_PAGES, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') .  (isset($_GET['cID']) ? 'cID=' . $_GET['cID'] . '&' : '') . 'action=' . $form_action, 'post', 'onsubmit="return confirm(\'' . ($form_action == 'insert' ? JS_CONFIRM_INSERT : JS_CONFIRM_UPDATE) . '\')" enctype="multipart/form-data"')));
    
    if ($form_action == 'update') {
      $smarty->assign(array('update' => true,
                            'hidden_content_id' => xos_draw_hidden_field('content_id', $cID)));
    }

/// durch auskommentieren koennen neue popup's generiert werden.    
// /*    
    if ($cInfo->type == 'system_popup') {
      $type_array[] = array('id' => 'system_popup', 'text' => 'system_popup');
    } else { 
      $type_array[] = array('id' => 'index', 'text' => 'index');     
      $type_array[] = array('id' => 'info', 'text' => 'info');
      $type_array[] = array('id' => 'not_in_menu', 'text' => 'not_in_menu');          
    }
// */        
//    $type_array[] = array('id' => 'index', 'text' => 'index');     
//    $type_array[] = array('id' => 'info', 'text' => 'info');
//    $type_array[] = array('id' => 'system_popup', 'text' => 'system_popup');
//    $type_array[] = array('id' => 'not_in_menu', 'text' => 'not_in_menu');   
     
    $smarty->assign(array('pull_down_type' => xos_draw_pull_down_menu('type', $type_array, $cInfo->type, 'onchange="updateSort()"'),                          
                          'radio_status_0' => xos_draw_radio_field('status', '0', $cInfo->status == 1 ? false : true),   
                          'radio_status_1' => xos_draw_radio_field('status', '1', $cInfo->status == 1 ? true : false),                                                    
                          'input_sort_order' => xos_draw_input_field('sort_order', $cInfo->sort_order, 'maxlength="3" size="3"')));

    if (WYSIWYG_FOR_INFO_PAGES == 'true') {
      $smarty->assign(array('wysiwyg' => true,
                            'link_filename_popup_file_manager_link_selection' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents')),
                            'link_filename_popup_file_manager_image' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/image')),
                            'link_filename_popup_file_manager_flash' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/flash')),
                            'info_pages_config' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/info_pages_config.js',
                            'lang_code' => xos_get_languages_code()));
    }

    $languages = xos_get_languages();
    $contents_data_array = array();    
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
      $contents_data_query = xos_db_query("select name, heading_title, content from " . TABLE_CONTENTS_DATA . " where content_id = '" . (int)$cInfo->content_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
      $contents_data = xos_db_fetch_array($contents_data_query);
      $contents_data_array[]=array('languages_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                                   'input_name' => xos_draw_input_field('name[' . $languages[$i]['id'] . ']', (isset($cInfo->name[$languages[$i]['id']]) ? stripslashes(htmlspecialchars($cInfo->name[$languages[$i]['id']])) : htmlspecialchars($contents_data['name'])), 'maxlength="64" size="30"', true),
                                   'input_heading_title' => xos_draw_input_field('heading_title[' . $languages[$i]['id'] . ']', (isset($cInfo->heading_title[$languages[$i]['id']]) ? stripslashes($cInfo->heading_title[$languages[$i]['id']]) : $contents_data['heading_title']), 'maxlength="255" size="80"'),
                                   'content_name' => 'content[' . $languages[$i]['id'] . ']',
                                   'info_pages_template_file' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/templates/' . $languages[$i]['directory'] . '/info_pages_template.js',
                                   'info_pages_template_lang' => $languages[$i]['directory'] . '_default',
                                   'textarea_content' => xos_draw_textarea_field('content[' . $languages[$i]['id'] . ']', '130', '25', (isset($cInfo->content[$languages[$i]['id']]) ? stripslashes($cInfo->content[$languages[$i]['id']]) : $contents_data['content'])));
      
    }
    
    $smarty->assign(array('contents_data' => $contents_data_array,
                          'link_filename_info_pages_cancel' => xos_href_link(FILENAME_INFO_PAGES, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . (isset($_GET['cID']) ? 'cID=' . $_GET['cID'] : ''))));

  } elseif ($action == 'preview') {
  
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
                          'link_filename_info_pages_back' => xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $cID)));
     
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
        $link_filename_info_pages = xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->content_id . '&action=new');
      } else {
        $link_filename_info_pages = xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $contents['content_id']);
      }

      $contents_array[]=array('selected' => $selected,
                              'link_filename_info_pages' => $link_filename_info_pages,
                              'content_id' => $contents['content_id'],                               
                              'type' => $contents['type'],
                              'first' => ($contents['type'] != $content_type ? $contents['type'] : ''),
                              'status' => (($contents['status'] == '1') ? true : false),
                              'sort_order' => $contents['sort_order'],
                              'name' => htmlspecialchars($contents['name']),
                              'icon_status_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10),
                              'icon_status_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10),
                              'icon_status_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT, 10, 10),
                              'icon_status_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT, 10, 10),
                              'link_filename_info_pages_action_setflag_0' => xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $contents['content_id'] . '&type=' . $contents['type'] . '&action=setflag&flag=0'),
                              'link_filename_info_pages_action_setflag_1' => xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $contents['content_id'] . '&type=' . $contents['type'] . '&action=setflag&flag=1'),
                              'link_filename_info_pages_preview' => xos_href_link(FILENAME_INFO_PAGES, 'page=' . $_GET['page'] . '&cID=' . $contents['content_id'] . '&action=preview'));                              
     
      $content_type = $contents['type'];                          
    }
    
    $smarty->assign(array('contents' => $contents_array,
                          'link_filename_info_pages_new' => xos_href_link(FILENAME_INFO_PAGES, 'action=new')));    
    
    require(DIR_WS_BOXES . 'infobox_info_pages.php');

  }
  
  $smarty->assign('form_end', '</form>');  

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'info_pages');
  $output_info_pages = $smarty->fetch(ADMIN_TPL . '/info_pages.tpl');
  
  $smarty->assign('central_contents', $output_info_pages);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
