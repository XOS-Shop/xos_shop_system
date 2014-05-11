<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : banner_manager.php
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
//              filename: banner_manager.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_BANNER_MANAGER) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $banner_extension = xos_banner_image_extension();

  if (xos_not_null($action)) {
    switch ($action) {
      case 'setflag':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          xos_set_banner_status($_GET['bID'], $_GET['flag']);

          $messageStack->add_session('header', SUCCESS_BANNER_STATUS_UPDATED, 'success');
        } else {
          $messageStack->add_session('header', ERROR_UNKNOWN_STATUS_FLAG, 'error');
        }

        xos_redirect(xos_href_link(FILENAME_BANNER_MANAGER, 'page=' . $_GET['page'] . '&bID=' . $_GET['bID']));
        break;
      case 'insert':
      case 'update':
        if (isset($_POST['banners_id'])) $banners_id = xos_db_prepare_input($_POST['banners_id']);
        $banners_title = xos_db_prepare_input($_POST['banners_title']);
        $banners_url = xos_db_prepare_input($_POST['banners_url']);
        $new_banners_group = xos_db_prepare_input($_POST['new_banners_group']);
        $banners_group = (empty($new_banners_group)) ? xos_db_prepare_input($_POST['banners_group']) : $new_banners_group;
        $banners_html_text = xos_db_prepare_input($_POST['banners_html_text']);
        $current_banners_image = xos_db_prepare_input($_POST['current_banners_image']);
        $current_date_scheduled = xos_db_prepare_input($_POST['current_date_scheduled']);
        $expires_date = xos_date_raw(xos_db_prepare_input($_POST['expires_date']));
        $expires_impressions = xos_db_prepare_input($_POST['expires_impressions']);
        $date_scheduled = xos_date_raw(xos_db_prepare_input($_POST['date_scheduled']));

        $banner_error = false;

        if (empty($banners_group)) {
          $messageStack->add('header', ERROR_BANNER_GROUP_REQUIRED, 'error');
          $banner_error = true;
        }        
        
        $languages = xos_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          if (empty($banners_title[$languages[$i]['id']])) {
            $messageStack->add('header', ERROR_BANNER_TITLE_REQUIRED, 'error');
            $banner_error = true;
          }
        }        

        if ($banner_error == false) { 

          $sql_data_array = array('banners_group' => $banners_group);

          if ($action == 'insert') {
            $insert_sql_data = array('date_added' => 'now()',
                                     'status' => '1');

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            xos_db_perform(TABLE_BANNERS, $sql_data_array);

            $banners_id = xos_db_insert_id();

            $messageStack->add_session('header', SUCCESS_BANNER_INSERTED, 'success');
          } elseif ($action == 'update') {
            xos_db_perform(TABLE_BANNERS, $sql_data_array, 'update', "banners_id = '" . (int)$banners_id . "'");

            $messageStack->add_session('header', SUCCESS_BANNER_UPDATED, 'success');
          }
       
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {                      
            if (!empty($_FILES['banners_image_' . $languages[$i]['id']]['name'])) {
              $banners_image = new upload('banners_image_' . $languages[$i]['id'], DIR_FS_CATALOG_IMAGES . 'banners/', '777', array('jpg','jpeg','gif','png'));
              if ($banners_image->parse() && $banners_image->save()) {
                $duplicate_image_query = xos_db_query("select count(*) as total from " . TABLE_BANNERS_CONTENT . " where banners_image = '" . xos_db_input($current_banners_image[$languages[$i]['id']]) . "'");
                $duplicate_image = xos_db_fetch_array($duplicate_image_query);          
                if (($duplicate_image['total'] < 2) &! ($current_banners_image[$languages[$i]['id']] == $banners_image->filename)) {
                  @unlink(DIR_FS_CATALOG_IMAGES . 'banners/' . $current_banners_image[$languages[$i]['id']]);
                }  
              }
            } elseif ($_POST['delete_banners_image'][$languages[$i]['id']] == 'true') {
              $duplicate_image_query = xos_db_query("select count(*) as total from " . TABLE_BANNERS_CONTENT . " where banners_image = '" . xos_db_input($current_banners_image[$languages[$i]['id']]) . "'");
              $duplicate_image = xos_db_fetch_array($duplicate_image_query);
              if ($duplicate_image['total'] < 2) {            
                @unlink(DIR_FS_CATALOG_IMAGES . 'banners/' . $current_banners_image[$languages[$i]['id']]);
              }
              $current_banners_image[$languages[$i]['id']] = '';
            }

            $db_image = (xos_not_null($banners_image->filename)) ? $banners_image->filename : $current_banners_image[$languages[$i]['id']];  
            $sql_data_array = array('banners_title' => $banners_title[$languages[$i]['id']],
                                    'banners_url' => $banners_url[$languages[$i]['id']],
                                    'banners_image' => $db_image,
                                    'banners_html_text' => preg_replace_callback('#href=\"?(([^\" >]*?\.php)([^\" >]*?))#siU', 'internal_link_replacement', (trim(str_replace('&#160;', '', strip_tags($banners_html_text[$languages[$i]['id']], '<img>'))) != '') ? $banners_html_text[$languages[$i]['id']] : ''));

            unset($banners_image->filename);
            
            if ($action == 'insert') {
              $sql_data_array['banners_id'] = $banners_id;          
              $sql_data_array['language_id'] = $languages[$i]['id'];              
              xos_db_perform(TABLE_BANNERS_CONTENT, $sql_data_array);
            } elseif ($action == 'update') {
              xos_db_perform(TABLE_BANNERS_CONTENT, $sql_data_array, 'update', "banners_id = '" . (int)$banners_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
            }  
          }
                  
          if (date('Ymd') < $expires_date) {                        
            xos_db_query("update " . TABLE_BANNERS . " set expires_date = '" . xos_db_input($expires_date) . "', expires_impressions = NULL where banners_id = '" . (int)$banners_id . "'");
          } else {
            $expires_impressions < 1 ? $db_input_expires_impressions = 'expires_impressions = NULL,' : $db_input_expires_impressions = 'expires_impressions = ' . (int)$expires_impressions . ',';
            xos_db_query("update " . TABLE_BANNERS . " set " . $db_input_expires_impressions . " expires_date = NULL where banners_id = '" . (int)$banners_id . "'");
          }

          if (xos_not_null($date_scheduled) || xos_not_null($current_date_scheduled)) {
                              
            if (date('Ymd') >= $date_scheduled) { 
//              xos_db_query("update " . TABLE_BANNERS . " set date_scheduled = NULL where banners_id = '" . (int)$banners_id . "'");                                                       
              xos_db_query("update " . TABLE_BANNERS . " set status = '1', date_scheduled = NULL where banners_id = '" . (int)$banners_id . "'");             
            } else {
              xos_db_query("update " . TABLE_BANNERS . " set status = '0', date_scheduled = '" . xos_db_input($date_scheduled) . "' where banners_id = '" . (int)$banners_id . "'"); 
            }
          }

          xos_redirect(xos_href_link(FILENAME_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'bID=' . $banners_id));
        } else {
          $action = 'new';
        }
        break;
      case 'deleteconfirm':
        $banners_id = xos_db_prepare_input($_GET['bID']);

        $languages = xos_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        
          $banners_image_query = xos_db_query("select banners_image from " . TABLE_BANNERS_CONTENT . " where banners_id = '" . (int)$banners_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          $banners_image = xos_db_fetch_array($banners_image_query); 
      
          if (!empty($banners_image['banners_image'])) {         
            $duplicate_image_query = xos_db_query("select count(*) as total from " . TABLE_BANNERS_CONTENT . " where banners_image = '" . xos_db_input($banners_image['banners_image']) . "' and  banners_id <> '" . (int)$banners_id . "'");
            $duplicate_image = xos_db_fetch_array($duplicate_image_query);         
            if ($duplicate_image['total'] < 1) {           
              @unlink(DIR_FS_CATALOG_IMAGES . 'banners/' . $banners_image['banners_image']);
            }
          } 
        }

        xos_db_query("delete from " . TABLE_BANNERS . " where banners_id = '" . (int)$banners_id . "'");
        xos_db_query("delete from " . TABLE_BANNERS_CONTENT . " where banners_id = '" . (int)$banners_id . "'");
        xos_db_query("delete from " . TABLE_BANNERS_HISTORY . " where banners_id = '" . (int)$banners_id . "'");

        if (function_exists('imagecreate') && xos_not_null($banner_extension)) {
          if (is_file(DIR_WS_IMAGES . 'graphs/banner_infobox-' . $banners_id . '.' . $banner_extension)) {
            if (is_writable(DIR_WS_IMAGES . 'graphs/banner_infobox-' . $banners_id . '.' . $banner_extension)) {
              unlink(DIR_WS_IMAGES . 'graphs/banner_infobox-' . $banners_id . '.' . $banner_extension);
            }
          }

          if (is_file(DIR_WS_IMAGES . 'graphs/banner_yearly-' . $banners_id . '.' . $banner_extension)) {
            if (is_writable(DIR_WS_IMAGES . 'graphs/banner_yearly-' . $banners_id . '.' . $banner_extension)) {
              unlink(DIR_WS_IMAGES . 'graphs/banner_yearly-' . $banners_id . '.' . $banner_extension);
            }
          }

          if (is_file(DIR_WS_IMAGES . 'graphs/banner_monthly-' . $banners_id . '.' . $banner_extension)) {
            if (is_writable(DIR_WS_IMAGES . 'graphs/banner_monthly-' . $banners_id . '.' . $banner_extension)) {
              unlink(DIR_WS_IMAGES . 'graphs/banner_monthly-' . $banners_id . '.' . $banner_extension);
            }
          }

          if (is_file(DIR_WS_IMAGES . 'graphs/banner_daily-' . $banners_id . '.' . $banner_extension)) {
            if (is_writable(DIR_WS_IMAGES . 'graphs/banner_daily-' . $banners_id . '.' . $banner_extension)) {
              unlink(DIR_WS_IMAGES . 'graphs/banner_daily-' . $banners_id . '.' . $banner_extension);
            }
          }
        }

        $messageStack->add_session('header', SUCCESS_BANNER_REMOVED, 'success');

        xos_redirect(xos_href_link(FILENAME_BANNER_MANAGER, 'page=' . $_GET['page']));
        break;
    }
  }

// check if the graphs directory exists
  $dir_ok = false;
  if (function_exists('imagecreate') && xos_not_null($banner_extension)) {
    if (is_dir(DIR_WS_IMAGES . 'graphs')) {
      if (is_writable(DIR_WS_IMAGES . 'graphs')) {
        $dir_ok = true;
      } else {
        $messageStack->add('header', ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE, 'error');
      }
    } else {
      $messageStack->add('header', ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST, 'error');
    }
  }
    
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
    
  if ($action == 'new') {
    $javascript .= '<script type="text/javascript" src="' . DIR_WS_ADMIN_IMAGES . ADMIN_TPL .'/' . $_SESSION['language'] . '/jquery.ui.datepicker-language.min.js"></script>' . "\n" .  
                   '<script type="text/javascript">' . "\n" .
                   '/* <![CDATA[ */' . "\n\n" . 
                 
                   '$(function() {' . "\n" .                                                                                        
                   '  $( "#date_scheduled" ).datepicker({' . "\n" .
                   '    changeMonth: true,' . "\n" .
                   '    changeYear: true' . "\n" .
                   '  });' . "\n\n" .
                              
                   '  $( "#expires_date" ).datepicker({' . "\n" .
                   '    changeMonth: true,' . "\n" .
                   '    changeYear: true' . "\n" .
                   '  });' . "\n\n" .
                 
//                   '  $( "#ui-datepicker-div" ).css( "font-size", "75%" );' . "\n\n" .
                 
                   '});' . "\n\n" .                 
                 
                   '/* ]]> */' . "\n" .
                   '</script> ' . "\n";   
    if (WYSIWYG_FOR_BANNER_MANAGER == 'true') {
      $javascript .= '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/ckeditor/ckeditor.js"></script>' . "\n";
    }                 
  }   
  
  $javascript .= '<script type="text/javascript">' . "\n" .
                 '/* <![CDATA[ */' . "\n" .                                 
                 'function popupImageWindow(url) {' . "\n" .
                 '  x = (screen.availWidth - 100 - 30) / 2;' . "\n" .
                 '  y = (screen.availHeight - 100 -115) / 2;' . "\n" .                  
                 '  window.open(url,"popupImageWindow","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX="+x+",screenY="+y+",top="+y+",left="+x).focus();' . "\n" .
                 '}' . "\n" .
                 '/* ]]> */' . "\n" .
                 '</script> ' . "\n"; 

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');

  if ($action == 'new') {
    $form_action = 'insert';

    $parameters = array('banners_id' => '',
                        'banners_group' => '',
                        'status' => '',
                        'date_scheduled' => '',
                        'expires_date' => '',
                        'expires_impressions' => '',
                        'date_status_change' => '');

    $bInfo = new objectInfo($parameters);

    if (isset($_GET['bID'])) {
      $form_action = 'update';

      $bID = xos_db_prepare_input($_GET['bID']);

      $banner_query = xos_db_query("select banners_id, banners_group, status, date_format(date_scheduled, '" . DATE_FORMAT_SHORT . "') as date_scheduled, date_format(expires_date, '" . DATE_FORMAT_SHORT . "') as expires_date, expires_impressions, date_status_change from " . TABLE_BANNERS . " where banners_id = '" . (int)$bID . "'"); 
                                           
      $banner = xos_db_fetch_array($banner_query);

      $bInfo->objectInfo($banner);
    } elseif (xos_not_null($_POST)) {
      $bInfo->objectInfo($_POST);
    }

    $groups_array = array();
    $groups_query = xos_db_query("select distinct banners_group from " . TABLE_BANNERS . " order by banners_group");
    while ($groups = xos_db_fetch_array($groups_query)) {
      $groups_array[] = array('id' => $groups['banners_group'], 'text' => $groups['banners_group']);
    }

    if ($form_action == 'insert') {
      $smarty->assign('form_action_insert', true);
    } else {
      $smarty->assign('hidden_field_banners_id', xos_draw_hidden_field('banners_id', $bID));
    }
                                                 
    if (WYSIWYG_FOR_BANNER_MANAGER == 'true') {
      $smarty->assign(array('wysiwyg' => true,
                            'link_filename_popup_file_manager_link_selection' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents')),
                            'link_filename_popup_file_manager_image' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/image')),
                            'link_filename_popup_file_manager_flash' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/flash')),
                            'banner_manager_config' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/banner_manager_config.js',                            
                            'lang_code' => xos_get_languages_code()));

    }
    
    $languages = xos_get_languages();
    $banners_content_array = array();    
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
      $banners_content_query = xos_db_query("select banners_title, banners_url, banners_image, banners_html_text from " . TABLE_BANNERS_CONTENT . " where banners_id = '" . (int)$bInfo->banners_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
      $banners_content = xos_db_fetch_array($banners_content_query);
      $banners_content_array[]=array('languages_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                                     'link_popup_image' => xos_href_link(FILENAME_POPUP_IMAGE, 'banner=' . $bInfo->banners_id . '&lang=' . $languages[$i]['id']),                                     
                                     'input_banners_title' => xos_draw_input_field('banners_title[' . $languages[$i]['id'] . ']', isset($bInfo->banners_title[$languages[$i]['id']]) ? stripslashes($bInfo->banners_title[$languages[$i]['id']]) : $banners_content['banners_title'], '', true),
                                     'input_banners_url' => xos_draw_input_field('banners_url[' . $languages[$i]['id'] . ']', isset($bInfo->banners_url[$languages[$i]['id']]) ? stripslashes($bInfo->banners_url[$languages[$i]['id']]) : $banners_content['banners_url']),                                                                                            
                                     'input_banners_image' => xos_draw_file_field('banners_image_' . $languages[$i]['id']),                                    
                                     'current_banners_image' => isset($bInfo->banners_image[$languages[$i]['id']]) ? stripslashes($bInfo->banners_image[$languages[$i]['id']]) : $banners_content['banners_image'],
                                     'selection_field_delete_banners_image' => xos_draw_selection_field('delete_banners_image[' . $languages[$i]['id'] . ']', 'checkbox', 'true'),                                      
                                     'hidden_field_current_banners_image' => xos_draw_hidden_field('current_banners_image[' . $languages[$i]['id'] . ']', isset($bInfo->banners_image[$languages[$i]['id']]) ? stripslashes($bInfo->banners_image[$languages[$i]['id']]) : $banners_content['banners_image']),                                    
                                     'banners_html_text_name' => 'banners_html_text[' . $languages[$i]['id'] . ']',
                                     'banner_manager_template_file' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/templates/' . $languages[$i]['directory'] . '/banner_manager_template.js',
                                     'banner_manager_template_lang' => $languages[$i]['directory'] . '_default',                                    
                                     'textarea_banners_html_text' => xos_draw_textarea_field('banners_html_text[' . $languages[$i]['id'] . ']', '110', '18', isset($bInfo->banners_html_text[$languages[$i]['id']]) ? stripslashes($bInfo->banners_html_text[$languages[$i]['id']]) : $banners_content['banners_html_text']));      
    }             

    $smarty->assign(array('new_banner' => true,
                          'form_begin' => xos_draw_form('new_banner', FILENAME_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'action=' . $form_action, 'post', 'onsubmit="return confirm(\'' . ($form_action == 'insert' ? JS_CONFIRM_INSERT : JS_CONFIRM_UPDATE) . '\')" enctype="multipart/form-data"'),
                          'pull_down_banners_group' => xos_draw_pull_down_menu('banners_group', $groups_array, $bInfo->banners_group),
                          'input_new_banners_group' => xos_draw_input_field('new_banners_group', '', '', ((sizeof($groups_array) > 0) ? false : true)),
                          'dir_fs_catalog_images_banners' => DIR_FS_CATALOG_IMAGES . 'banners/',
                          'hidden_field_current_date_scheduled' => xos_draw_hidden_field('current_date_scheduled', $bInfo->date_scheduled),
                          'input_date_scheduled' => xos_draw_input_field('date_scheduled', $bInfo->date_scheduled, 'id="date_scheduled" style="background: #ffffcc;" size ="10"'),
                          'input_expires_date' => xos_draw_input_field('expires_date', $bInfo->expires_date, 'id="expires_date" style="background: #ffffcc;" size ="10"'),
                          'input_expires_impressions' => xos_draw_input_field('expires_impressions', $bInfo->expires_impressions, 'maxlength="7" size="7"'),
                          'banners_content' => $banners_content_array,
                          'link_filename_banner_manager' => xos_href_link(FILENAME_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . (isset($_GET['bID']) ? 'bID=' . $_GET['bID'] : '')),
                          'form_end' => '</form>'));
                          
  } else {

    $banners_query_raw = "select b.banners_id, bc.banners_title, b.banners_group, b.status, b.expires_date, b.expires_impressions, b.date_status_change, b.date_scheduled, b.date_added from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_CONTENT . " bc where b.banners_id = bc.banners_id and bc.language_id = '" . (int)$_SESSION['used_lng_id'] . "' order by banners_title, banners_group";
    $banners_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $banners_query_raw, $banners_query_numrows);
    $banners_query = xos_db_query($banners_query_raw);
    $banners_array = array();
    while ($banners = xos_db_fetch_array($banners_query)) {
      $info_query = xos_db_query("select sum(banners_shown) as banners_shown, sum(banners_clicked) as banners_clicked from " . TABLE_BANNERS_HISTORY . " where banners_id = '" . (int)$banners['banners_id'] . "'");
      $info = xos_db_fetch_array($info_query);

      if ((!isset($_GET['bID']) || (isset($_GET['bID']) && ($_GET['bID'] == $banners['banners_id']))) && !isset($bInfo) && (substr($action, 0, 3) != 'new')) {
        $bInfo_array = array_merge((array)$banners, (array)$info);
        $bInfo = new objectInfo($bInfo_array);
      }

      $banners_shown = ($info['banners_shown'] != '') ? $info['banners_shown'] : '0';
      $banners_clicked = ($info['banners_clicked'] != '') ? $info['banners_clicked'] : '0';
      
      $selected = false;

      if (isset($bInfo) && is_object($bInfo) && ($banners['banners_id'] == $bInfo->banners_id)) {
        $selected = true;
        $link_filename_banner_statistics = xos_href_link(FILENAME_BANNER_STATISTICS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->banners_id);
      }
      
      $status = false;

      if ($banners['status'] == '1') {
        $status = true;
      }
           
      $banners_array[]=array('selected' => $selected,
                             'status' => $status,
                             'title' => $banners['banners_title'],
                             'group' => $banners['banners_group'],
                             'shown' => $banners_shown,
                             'clicked' => $banners_clicked,
                             'icon_status_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10),
                             'icon_status_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10),
                             'icon_status_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT, 10, 10),
                             'icon_status_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT, 10, 10),
                             'link_filename_banner_manager_action_setflag_0' => xos_href_link(FILENAME_BANNER_MANAGER, 'page=' . $_GET['page'] . '&bID=' . $banners['banners_id'] . '&action=setflag&flag=0'),
                             'link_filename_banner_manager_action_setflag_1' => xos_href_link(FILENAME_BANNER_MANAGER, 'page=' . $_GET['page'] . '&bID=' . $banners['banners_id'] . '&action=setflag&flag=1'),                              
                             'link_filename_banner_manager' => xos_href_link(FILENAME_BANNER_MANAGER, 'page=' . $_GET['page'] . '&bID=' . $banners['banners_id']),
                             'link_filename_banner_statistics_icon' => xos_href_link(FILENAME_BANNER_STATISTICS, 'page=' . $_GET['page'] . '&bID=' . $banners['banners_id']),
                             'link_filename_banner_statistics' => $link_filename_banner_statistics);

    }
    
    $smarty->assign(array('banners' => $banners_array,
                          'nav_bar_number' => $banners_split->display_count($banners_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_BANNERS),
                          'nav_bar_result' => $banners_split->display_links($banners_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']),
                          'link_filename_banner_manager' => xos_href_link(FILENAME_BANNER_MANAGER, 'action=new'))); 
                          
    require(DIR_WS_BOXES . 'infobox_banner_manager.php');                        
  }
 
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'banner_manager');
  $output_banner_manager = $smarty->fetch(ADMIN_TPL . '/banner_manager.tpl');
  
  $smarty->assign('central_contents', $output_banner_manager);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');
 
  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
