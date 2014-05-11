<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : define_language.php
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
//              filename: define_language.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_DEFINE_LANGUAGE) == 'overwrite_all')) :
  if (!isset($_GET['lngdir'])) $_GET['lngdir'] = $_SESSION['language'];

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'save':
        if (isset($_GET['lngdir']) && isset($_GET['filename'])) {
          if (($_GET['filename'] == $_GET['lngdir'] . '.php') || ($_GET['filename'] == $_GET['lngdir'] . '.conf') || ($_GET['filename'] == $_GET['lngdir'] . '_email.conf')) {
            $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['filename'];           
          } elseif ($_GET['subdir'] == 'order_total') {
            $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/modules/order_total/' . $_GET['filename'];
          } elseif ($_GET['subdir'] == 'payment') {
            $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/modules/payment/' . $_GET['filename'];
          } elseif ($_GET['subdir'] == 'shipping') {
            $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/modules/shipping/' . $_GET['filename'];               
          } else {
            $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/' . $_GET['filename'];
          }

          if (file_exists($file)) {
            if (file_exists('bak' . $file)) {
              @unlink('bak' . $file);
            }

            @rename($file, 'bak' . $file);

            $new_file = fopen($file, 'w');
            $file_contents = stripslashes($_POST['file_contents']);
            fwrite($new_file, $file_contents, strlen($file_contents));
            fclose($new_file);
            $messageStack->add_session('header', sprintf(TEXT_FILE_UPDATED, $_GET['filename']), 'success');
          }
          xos_redirect(xos_href_link(FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir']));
        }
        break;
    }
  }

  $languages_array = array();
  $languages = xos_get_languages();
  $lng_exists = false;
  for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
    if ($languages[$i]['directory'] == $_GET['lngdir']) $lng_exists = true;

    $languages_array[] = array('id' => $languages[$i]['directory'],
                               'text' => $languages[$i]['name']);
  }

  if (!$lng_exists) $_GET['lngdir'] = $_SESSION['language'];

  if (isset($_GET['lngdir']) && isset($_GET['filename'])) {
    
    if (($_GET['filename'] == $_GET['lngdir'] . '.php') || ($_GET['filename'] == $_GET['lngdir'] . '.conf') || ($_GET['filename'] == $_GET['lngdir'] . '_email.conf')) {
      $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['filename'];     
    } else {
      $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/' . $_GET['filename'];
    }

    if (file_exists($file) && !is_writable($file)) {
        $messageStack->reset();
        $messageStack->add('header', sprintf(ERROR_FILE_NOT_WRITEABLE, $file), 'error');
    }
  }
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  if (isset($_GET['lngdir']) && isset($_GET['filename'])) {
  
    if (($_GET['filename'] == $_GET['lngdir'] . '.php') || ($_GET['filename'] == $_GET['lngdir'] . '.conf') || ($_GET['filename'] == $_GET['lngdir'] . '_email.conf')) {
      $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['filename']; 
    } elseif ($_GET['subdir'] == 'order_total') {
      $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/modules/order_total/' . $_GET['filename'];
    } elseif ($_GET['subdir'] == 'payment') {
      $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/modules/payment/' . $_GET['filename'];
    } elseif ($_GET['subdir'] == 'shipping') {
      $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/modules/shipping/' . $_GET['filename'];               
    } else {
      $file = DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/' . $_GET['filename'];
    }

    if (file_exists($file)) {
    
      $smarty->assign('file_exists', true);
    
      $file_array = file($file);
      $contents = implode('', $file_array);

      $file_writeable = true;
      if (!is_writable($file)) {
        $file_writeable = false;
      }
            
      $smarty->assign(array('form_begin_save' => xos_draw_form('define_lng', FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir'] . '&filename=' . $_GET['filename'] . '&subdir=' . $_GET['subdir'] . '&action=save'),
                            'filename' => $_GET['filename'],
                            'textarea_file_contents' => xos_draw_textarea_field('file_contents', '110', '25', $contents, 'style="width: 99%; height: 500px;"' . (($file_writeable) ? '' : 'readonly="readonly"'))));
 
      if ($file_writeable == true) {       
        $smarty->assign('file_writeable', true);
      } else {
        $smarty->assign('file_not_writeable', sprintf(ERROR_FILE_NOT_WRITEABLE, $_GET['filename']));
      }
    }

    $smarty->assign(array('file_edit' => true,
                          'link_filename_define_language' => xos_href_link(FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir'])));
    
  } else {
    $filename = $_GET['lngdir'] . '.php';
    $filename_conf = $_GET['lngdir'] . '.conf';
    $filename_email_conf = $_GET['lngdir'] . '_email.conf';
       
    if ($dir = @dir(DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'])) {
      $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
      $files_array = array();
      while ($file = $dir->read()) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {        
          $files_array[]=array('filename' => $file,
                               'link_filename_define_language_filename' => xos_href_link(FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir'] . '&filename=' . $file));
        }       
      }
      $dir->close();
      
      $smarty->assign('files', $files_array);
    }
    
    if ($dir = @dir(DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/modules/order_total')) {
      $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
      $files_array = array();
      while ($file = $dir->read()) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {        
          $files_array[]=array('filename' => $file,
                               'link_filename_define_language_filename' => xos_href_link(FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir'] . '&subdir=order_total&filename=' . $file));
        }       
      }
      $dir->close();
      
      $smarty->assign('files_order_total', $files_array);
    }
    
    if ($dir = @dir(DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/modules/payment')) {
      $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
      $files_array = array();
      while ($file = $dir->read()) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {        
          $files_array[]=array('filename' => $file,
                               'link_filename_define_language_filename' => xos_href_link(FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir'] . '&subdir=payment&filename=' . $file));
        }       
      }
      $dir->close();
      
      $smarty->assign('files_payment', $files_array);
    }
    
    if ($dir = @dir(DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir'] . '/modules/shipping')) {
      $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
      $files_array = array();
      while ($file = $dir->read()) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {        
          $files_array[]=array('filename' => $file,
                               'link_filename_define_language_filename' => xos_href_link(FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir'] . '&subdir=shipping&filename=' . $file));
        }       
      }
      $dir->close();
      
      $smarty->assign('files_shipping', $files_array);
    }            
    
    $smarty->assign(array('filename' => $filename,
                          'filename_conf' => $filename_conf,
                          'filename_email_conf' => $filename_email_conf,
                          'link_filename_define_language_filename' => xos_href_link(FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir'] . '&filename=' . $filename),
                          'link_filename_define_language_filename_conf' => xos_href_link(FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir'] . '&filename=' . $filename_conf),
                          'link_filename_define_language_filename_email_conf' => xos_href_link(FILENAME_DEFINE_LANGUAGE, 'lngdir=' . $_GET['lngdir'] . '&filename=' . $filename_email_conf),
                          'link_filename_file_manager' => xos_href_link(FILENAME_FILE_MANAGER, 'goto=' . DIR_FS_SMARTY . 'catalog/languages/')));
    
//    $smarty->assign('link_filename_file_manager', xos_href_link(FILENAME_FILE_MANAGER, 'goto=' . DIR_FS_SMARTY . 'catalog/languages/' . $_GET['lngdir']));    

  }
  
  if (SID) {
    $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
  }  

  $smarty->assign(array('form_begin_language' => xos_draw_form('lng', FILENAME_DEFINE_LANGUAGE, '', 'get'),
                        'pull_down_lngdir' => xos_draw_pull_down_menu('lngdir', $languages_array, $_GET['lngdir'], 'onchange="this.form.submit();"'),
                        'form_end' => '</form>'));  

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'define_language');
  $output_define_language = $smarty->fetch(ADMIN_TPL . '/define_language.tpl');
  
  $smarty->assign('central_contents', $output_define_language);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
