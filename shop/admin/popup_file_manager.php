<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : popup_file_manager.php
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
//              filename: file_manager.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_POPUP_FILE_MANAGER) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if ($action == 'link_entrence') {
    $_SESSION['link_entrence'] = true;
  } else if ($action == 'no_link_entrence') {
    $_SESSION['link_entrence'] = false;
  }  
  
  if (!isset($_SESSION['current_path'])) {
    $_SESSION['current_path'] = DIR_FS_DOCUMENT_ROOT;
  }

  if (isset($_GET['CKEditorFuncNum'])) {
    $_SESSION['ckeditor_func_num'] = (int)$_GET['CKEditorFuncNum'];
  }

  if (isset($_GET['goto'])) {
    $_SESSION['current_path'] = $_GET['goto'];
    unset($_GET['goto']); 
  }

  if (strstr($_SESSION['current_path'], '..')) $_SESSION['current_path'] = DIR_FS_DOCUMENT_ROOT;

  if (!is_dir($_SESSION['current_path'])) $_SESSION['current_path'] = DIR_FS_DOCUMENT_ROOT;

  if (!preg_match('!^' . DIR_FS_DOCUMENT_ROOT . '!', $_SESSION['current_path'])) $_SESSION['current_path'] = DIR_FS_DOCUMENT_ROOT;

  if (xos_not_null($action)) {
    switch ($action) {
      case 'reset':
        $_SESSION['current_path'] = DIR_FS_DOCUMENT_ROOT;
        break;
      case 'deleteconfirm':
        if (strstr($_GET['info'], '..')) xos_redirect(xos_href_link(FILENAME_POPUP_FILE_MANAGER));

        xos_remove($_SESSION['current_path'] . '/' . $_GET['info']);
        if (!$xos_remove_error) xos_redirect(xos_href_link(FILENAME_POPUP_FILE_MANAGER));
        break;
      case 'insert':
        if (isset($_POST['folder_name']) && xos_not_null(basename($_POST['folder_name'])) && mkdir($_SESSION['current_path'] . '/' . basename($_POST['folder_name']), 0777)) {
          xos_redirect(xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'info=' . urlencode($_POST['folder_name'])));
        }
        break;
      case 'save':          
        if (isset($_POST['filename']) && xos_not_null(basename($_POST['filename']))) { 
          if (is_writable($_SESSION['current_path']) && ($fp = fopen($_SESSION['current_path'] . '/' . basename($_POST['filename']), 'w+'))) {
            fputs($fp, stripslashes(urldecode($_POST['file_contents']))); 
            fclose($fp); 
            xos_redirect(xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'info=' . urlencode(basename($_POST['filename'])))); 
          } 
        } else { 
          $action = 'new_file'; 
          $directory_writeable = true; 
          $messageStack->add('header', ERROR_FILENAME_EMPTY, 'error');                    
        }
        break;
      case 'processuploads':      
        for ($i=1; $i<6; $i++) {
          if (!empty($_FILES['file_' . $i]['name'])) {       
            $upload = new upload('file_' . $i, $_SESSION['current_path'], '644');
            $upload->parse();
            $upload->save();
          }
        }

        xos_redirect(xos_href_link(FILENAME_POPUP_FILE_MANAGER));
        break;
      case 'download':
      
        header_remove();      
      
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');        
        header('Content-Type: application/octet-stream');      
        header('Content-Length: ' . @filesize($_SESSION['current_path'] . '/' . urldecode($_GET['filename'])));
        header('Content-Disposition: attachment; filename="' . urldecode($_GET['filename']) . '"');        
        @readfile($_SESSION['current_path'] . '/' . urldecode($_GET['filename']));
        exit;
        break;
      case 'upload':
      case 'new_folder':
      case 'new_file':
        $directory_writeable = true;
        if (!is_writable($_SESSION['current_path'])) {
          $directory_writeable = false;
          $messageStack->add('header', sprintf(ERROR_DIRECTORY_NOT_WRITEABLE, $_SESSION['current_path']), 'error');
        }
        break;
      case 'edit':
        if (strstr($_GET['info'], '..')) xos_redirect(xos_href_link(FILENAME_POPUP_FILE_MANAGER));

        $file_writeable = true;
        if (!is_writable($_SESSION['current_path'] . '/' . $_GET['info'])) {
          $file_writeable = false;
          $messageStack->add('header', sprintf(ERROR_FILE_NOT_WRITEABLE, $_SESSION['current_path'] . '/' . $_GET['info']), 'error');
        }
        break;
      case 'view':
        if (strstr($_GET['info'], '..')) xos_redirect(xos_href_link(FILENAME_POPUP_FILE_MANAGER));
        if (!(in_array(strtolower(substr($_GET['info'], -4)), array('.gif', '.jpg', '.png', '.ico', '.svg')) || strtolower(substr($_GET['info'], -5)) == '.jpeg')) xos_redirect(FILENAME_POPUP_FILE_MANAGER . (isset($_GET['info']) ? '?info=' . urlencode($_GET['info']) : ''));
        break;          
      case 'delete':
        if (strstr($_GET['info'], '..')) xos_redirect(xos_href_link(FILENAME_POPUP_FILE_MANAGER));
        break;
    }
  }

  $current_path_array = explode('/', $_SESSION['current_path']);
  $document_root_array = explode('/', DIR_FS_DOCUMENT_ROOT);
  $goto_array = array(array('id' => DIR_FS_DOCUMENT_ROOT, 'text' => '/'));
  for ($i=0, $n=sizeof($current_path_array); $i<$n; $i++) {
    if ((isset($document_root_array[$i]) && ($current_path_array[$i] != $document_root_array[$i])) || !isset($document_root_array[$i])) {
      $goto_array[] = array('id' => implode('/', array_slice($current_path_array, 0, $i+1)), 'text' => $current_path_array[$i]);
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
  
  if ($messageStack->size('header') > 0) {
    $smarty->assign('message_stack_output', $messageStack->output('header'));
  }  

  if ($action == 'link_entrence') {

    $smarty->assign(array('entrence_link' => true,
                          'link_filename_popup_file_manager' => xos_href_link(FILENAME_POPUP_FILE_MANAGER),
                          'link_filename_popup_info_pages' => xos_href_link(FILENAME_POPUP_INFO_PAGES),
                          'link_filename_popup_pages' => xos_href_link(FILENAME_POPUP_PAGES)));

  } elseif ( (($action == 'new_file') && ($directory_writeable == true)) || ($action == 'edit') ) {
  
    if (isset($_GET['info']) && strstr($_GET['info'], '..')) xos_redirect(xos_href_link(FILENAME_POPUP_FILE_MANAGER));

    if (!isset($file_writeable)) $file_writeable = true;
    $file_contents = '';
    if ($action == 'new_file') {
      $filename_input_field = xos_draw_input_field('filename');
    } elseif ($action == 'edit') {
      if ($file_array = file($_SESSION['current_path'] . '/' . $_GET['info'])) {
        $file_contents = implode('', $file_array);
      }
      $filename_input_field = $_GET['info'] . xos_draw_hidden_field('filename', $_GET['info']);
    }

    if ($file_writeable == true) {
      $smarty->assign('file_writeable', true);
    }

    $smarty->assign(array('new_edit_file' => true,
                          'form_begin_new_file' => xos_draw_form('new_file', FILENAME_POPUP_FILE_MANAGER, 'action=save'),
                          'filename_or_input_filename' => $filename_input_field,
                          'textarea_file_contents' => xos_draw_textarea_field('file_contents', '110', '25', $file_contents, 'style="width: 99%; height: 500px;"' . (($file_writeable) ? '' : 'readonly="readonly"')),
                          'link_filename_popup_file_manager' => xos_href_link(FILENAME_POPUP_FILE_MANAGER, (isset($_GET['info']) ? 'info=' . urlencode($_GET['info']) : ''))));

  } elseif ($action == 'view') {
    
    $ws_path = str_replace(DIR_FS_DOCUMENT_ROOT, DIR_WS_CATALOG, $_SESSION['current_path']);
    $ws_path .= (substr($ws_path, -1) != '/') ? '/' : '';  
          
    $smarty->assign(array('image_view' => true,
                          'filename' => $_GET['info'],
                          'image_data' => @getimagesize($_SESSION['current_path'] . '/' . $_GET['info']),
                          'image_src' => $ws_path . rawurlencode($_GET['info']),
                          'link_filename_popup_file_manager' => xos_href_link(FILENAME_POPUP_FILE_MANAGER, (isset($_GET['info']) ? 'info=' . urlencode($_GET['info']) : ''))));     

  } else {
    $showuser = (function_exists('posix_getpwuid') ? true : false);
    $contents = array();
    $dir = dir($_SESSION['current_path']);
    while ($file = $dir->read()) {
      if ( ($file != '.') && ($file != 'CVS') && ( ($file != '..') || ($_SESSION['current_path'] != DIR_FS_DOCUMENT_ROOT) ) ) {
      
        $file_size = number_format(filesize($_SESSION['current_path'] . '/' . $file)) . ' bytes';

        $is_image = (in_array(strtolower(substr($file, -4)), array('.gif', '.jpg', '.png', '.ico', '.svg')) || strtolower(substr($file, -5)) == '.jpeg') ? true : false;

        $permissions = xos_get_file_permissions(fileperms($_SESSION['current_path'] . '/' . $file));
        if ($showuser) {
          $user = @posix_getpwuid(fileowner($_SESSION['current_path'] . '/' . $file));
          $group = @posix_getgrgid(filegroup($_SESSION['current_path'] . '/' . $file));
        } else {
          $user = $group = array();
        }

        $contents[] = array('name' => $file,
                            'is_dir' => is_dir($_SESSION['current_path'] . '/' . $file),
                            'is_image' => $is_image,
                            'last_modified' => xos_date_format(DATE_TIME_FORMAT, filemtime($_SESSION['current_path'] . '/' . $file)),
                            'size' => $file_size,
                            'image_data' => ($is_image) ? @getimagesize($_SESSION['current_path'] . '/' . $file) : array(),
                            'permissions' => $permissions,
                            'user' => $user['name'],
                            'group' => $group['name']);
      }
    }

    function xos_cmp($a, $b) {
      return strcmp( ($a['is_dir'] ? 'D' : 'F') . $a['name'], ($b['is_dir'] ? 'D' : 'F') . $b['name']);
    }
    usort($contents, 'xos_cmp');

    $folders_and_files_array = array();
    for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
      if ((!isset($_GET['info']) || (isset($_GET['info']) && ($_GET['info'] == $contents[$i]['name']))) && !isset($fInfo) && ($action != 'upload') && ($action != 'new_folder')) {
        $fInfo = new objectInfo($contents[$i]);
      }

      if ($contents[$i]['name'] == '..') {
        $goto_link = substr($_SESSION['current_path'], 0, strrpos($_SESSION['current_path'], '/'));
      } else {
        $goto_link = (DIR_FS_DOCUMENT_ROOT == $_SESSION['current_path']) ? $_SESSION['current_path'] . $contents[$i]['name'] : $_SESSION['current_path'] . '/' . $contents[$i]['name'];
      }
    
      $selected = false;

      if (isset($fInfo) && is_object($fInfo) && ($contents[$i]['name'] == $fInfo->name)) {
        $selected = true;
        if ($fInfo->is_dir) {
          $onclick_link = 'goto=' . $goto_link;
        } elseif ($fInfo->is_image) {
          $onclick_link = 'info=' . urlencode($fInfo->name) . '&action=view';           
        } else {
          $onclick_link = 'info=' . urlencode($fInfo->name) . '&action=edit';
        }
      } else {
        $onclick_link = 'info=' . urlencode($contents[$i]['name']);
      }

      if ($contents[$i]['is_dir']) {
        if ($contents[$i]['name'] == '..') {
          $icon = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icons/previous_level.gif', ICON_TITLE_PREVIOUS_LEVEL);
        } else {
          $icon = (isset($fInfo) && is_object($fInfo) && ($contents[$i]['name'] == $fInfo->name) ? xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icons/current_folder.gif', ICON_TITLE_CURRENT_FOLDER) : xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icons/folder.gif', ICON_TITLE_FOLDER));
        }
        $link = xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'goto=' . $goto_link);
      } else {
        $icon = ($contents[$i]['is_image']) ? xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icons/image_download.gif', ICON_TITLE_FILE_DOWNLOAD) : xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icons/file_download.gif', ICON_TITLE_FILE_DOWNLOAD);
        $link = xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=download&filename=' . urlencode($contents[$i]['name']));
      }

      if ($contents[$i]['name'] != '..') {
        $link_delete = xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'info=' . urlencode($contents[$i]['name']) . '&action=delete');
      }

      $folders_and_files_array[]=array('selected' => $selected,
                                       'link_onclick' => xos_href_link(FILENAME_POPUP_FILE_MANAGER, $onclick_link),
                                       'link' => $link,
                                       'icon' => $icon,
                                       'name' => $contents[$i]['name'],
                                       'size' => ($contents[$i]['is_dir'] ? '&nbsp;' : $contents[$i]['size']),
                                       'permissions' => $contents[$i]['permissions'],
                                       'user' => $contents[$i]['user'],
                                       'group' => $contents[$i]['group'],
                                       'last_modified' => $contents[$i]['last_modified'],
                                       'link_delete' => $link_delete,
                                       'link_filename_popup_file_manager_info' => xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'info=' . urlencode($contents[$i]['name'])));
    }
  
    $smarty->assign(array('folders_and_files' => $folders_and_files_array,
                          'link_filename_popup_file_manager_reset' => xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=reset'),
                          'link_filename_popup_file_manager_upload' => xos_href_link(FILENAME_POPUP_FILE_MANAGER, (isset($_GET['info']) ? 'info=' . urlencode($_GET['info']) . '&' : '') . 'action=upload'),
                          'link_filename_popup_file_manager_new_file' => xos_href_link(FILENAME_POPUP_FILE_MANAGER, (isset($_GET['info']) ? 'info=' . urlencode($_GET['info']) . '&' : '') . 'action=new_file'),
                          'link_filename_popup_file_manager_new_folder' => xos_href_link(FILENAME_POPUP_FILE_MANAGER, (isset($_GET['info']) ? 'info=' . urlencode($_GET['info']) . '&' : '') . 'action=new_folder')));

    require(DIR_WS_BOXES . 'infobox_popup_file_manager.php');
  }

  if (SID) {
    $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
  }
  
  $smarty->assign(array('form_begin_goto' => xos_draw_form('goto', FILENAME_POPUP_FILE_MANAGER, '', 'get'),
                        'current_path' => $_SESSION['current_path'],
                        'pull_down_goto' => xos_draw_pull_down_menu('goto', $goto_array, $_SESSION['current_path'], 'onchange="this.form.submit();"'),
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'popup_file_manager');
  
  $smarty->display(ADMIN_TPL . '/popup_file_manager.tpl');
endif;  
?>
