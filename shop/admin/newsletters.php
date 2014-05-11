<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : newsletters.php
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
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_NEWSLETTERS) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'send_now':      
        $nID = xos_db_prepare_input($_GET['nID']);

        $newsletter_query = xos_db_query("select ns.newsletters_id, ns.title, ns.language_id, ns.content_text_plain, ns.content_text_htlm, ns.module, ls.code as language_code, ls.directory as language_directory from " . TABLE_NEWSLETTERS . " ns left join " . TABLE_LANGUAGES . " ls on ns.language_id = ls.languages_id where newsletters_id = '" . (int)$nID . "'");
        $newsletter = xos_db_fetch_array($newsletter_query);

        $nInfo = new objectInfo($newsletter);

        // include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/newsletters/' . $nInfo->module . substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.')));
        include(DIR_WS_MODULES . 'newsletters/' . $nInfo->module . substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.')));
        $module_name = $nInfo->module;
        $module = new $module_name($nInfo->title, $nInfo->language_id, $nInfo->content_text_plain, $nInfo->content_text_htlm, $nInfo->language_code, $nInfo->language_directory);

        xos_set_time_limit(0);
        $module->send($nInfo->newsletters_id);        

        if ($messageStack->size('news_email') > 0) {
          $smarty->assign('message_stack_output', $messageStack->output('news_email'));
        }
        
        $smarty->assign(array('send_now' => true,
                              'link_filename_newsletters_back' => xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']))); 
    
        $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'newsletters');
        $output_newsletters_send = $smarty->fetch(ADMIN_TPL . '/newsletters.tpl');
    
        echo $output_newsletters_send; 
        die;
      case 'lock':
      case 'unlock':
        $newsletter_id = xos_db_prepare_input($_GET['nID']);
        $status = (($action == 'lock') ? '1' : '0');

        xos_db_query("update " . TABLE_NEWSLETTERS . " set locked = '" . $status . "' where newsletters_id = '" . (int)$newsletter_id . "'");

        xos_redirect(xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']));
        break;
      case 'insert':
      case 'update':
        if (isset($_POST['newsletter_id'])) $newsletter_id = xos_db_prepare_input($_POST['newsletter_id']);
        $newsletter_module = xos_db_prepare_input($_POST['module']);
        $title = xos_db_prepare_input($_POST['title']);
        $language_id = xos_db_prepare_input($_POST['language_id']);
        $content_text_plain = xos_db_prepare_input(html_entity_decode(strip_tags($_POST['content_text_plain']), ENT_QUOTES, 'UTF-8'));
        if (EMAIL_USE_HTML == 'true') {
          $content_text_htlm = xos_db_prepare_input($_POST['content_text_htlm']);
          if (trim(str_replace('&#160;', '', strip_tags($content_text_htlm, '<img>'))) == '') $content_text_htlm = '';
        }  

        $newsletter_error = false;
        if (empty($title)) {
          $messageStack->add('header', ERROR_NEWSLETTER_TITLE, 'error');
          $newsletter_error = true;
        }

        if (empty($newsletter_module)) {
          $messageStack->add('header', ERROR_NEWSLETTER_MODULE, 'error');
          $newsletter_error = true;
        }

        if ($newsletter_error == false) {
          $sql_data_array = array('title' => $title,
                                  'language_id' => $language_id,
                                  'content_text_plain' => $content_text_plain,
                                  'module' => $newsletter_module);
                                  
          if (isset($content_text_htlm)) {
            $sql_data_array['content_text_htlm'] = $content_text_htlm;
          }                        

          if ($action == 'insert') {
            $sql_data_array['date_added'] = 'now()';
            $sql_data_array['status'] = '0';
            $sql_data_array['locked'] = '0';

            xos_db_perform(TABLE_NEWSLETTERS, $sql_data_array);
            $newsletter_id = xos_db_insert_id();
          } elseif ($action == 'update') {
            xos_db_perform(TABLE_NEWSLETTERS, $sql_data_array, 'update', "newsletters_id = '" . (int)$newsletter_id . "'");
          }

          xos_redirect(xos_href_link(FILENAME_NEWSLETTERS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'nID=' . $newsletter_id));
        } else {
          $action = 'new';
        }
        break;
      case 'deleteconfirm':
        $newsletter_id = xos_db_prepare_input($_GET['nID']);

        xos_db_query("delete from " . TABLE_NEWSLETTERS . " where newsletters_id = '" . (int)$newsletter_id . "'");

        xos_redirect(xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page']));
        break;
      case 'send':
      case 'confirm_send': 
        if (SEND_EMAILS != 'true') {
          xos_redirect(xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']));
          break;
        }                           
      case 'delete':
      case 'new': if (!isset($_GET['nID'])) break;
        $newsletter_id = xos_db_prepare_input($_GET['nID']);

        $check_query = xos_db_query("select locked from " . TABLE_NEWSLETTERS . " where newsletters_id = '" . (int)$newsletter_id . "'");
        $check = xos_db_fetch_array($check_query);

        if ($check['locked'] < 1) {
          switch ($action) {
            case 'delete': $error = ERROR_REMOVE_UNLOCKED_NEWSLETTER; break;
            case 'new': $error = ERROR_EDIT_UNLOCKED_NEWSLETTER; break;
            case 'send': $error = ERROR_SEND_UNLOCKED_NEWSLETTER; break;
            case 'confirm_send': $error = ERROR_SEND_UNLOCKED_NEWSLETTER; break;
          }

          $messageStack->add_session('header', $error, 'error');

          xos_redirect(xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']));
        }      
        break;
    }
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";

  if ($action == 'new' && WYSIWYG_FOR_NEWSLETTER == 'true' && EMAIL_USE_HTML == 'true') {
    $javascript .= '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/ckeditor/ckeditor.js"></script>' . "\n";
  }  
  
  if ($action == 'confirm_send') {  
    $javascript .= '<script type="text/javascript">' . "\n\n" .
    
                   '/* <![CDATA[ */' . "\n" .
                   '    var http_request = false;' . "\n\n" .

                   '    function confirmSent(url) {' . "\n\n" .

                   '        http_request = false;' . "\n\n" .

                   '        if (window.XMLHttpRequest) { // Mozilla, Safari,...' . "\n" .
                   '            http_request = new XMLHttpRequest();' . "\n" .
                   '            if (http_request.overrideMimeType) {' . "\n" .
                   '                http_request.overrideMimeType("text/html");' . "\n" .
                   '            }' . "\n" .
                   '        } else if (window.ActiveXObject) { // IE' . "\n" .
                   '            try {' . "\n" .
                   '                http_request = new ActiveXObject("Msxml2.XMLHTTP");' . "\n" .
                   '            } catch (e) {' . "\n" .
                   '                try {' . "\n" .
                   '                    http_request = new ActiveXObject("Microsoft.XMLHTTP");' . "\n" .
                   '                } catch (e) {}' . "\n" .
                   '            }' . "\n" .
                   '        }' . "\n\n" .

                   '        if (!http_request) {' . "\n" .
                   '            alert("Ende : Kann keine XMLHTTP-Instanz erzeugen");' . "\n" .
                   '            return false;' . "\n" .
                   '        }' . "\n" .
                   '        http_request.onreadystatechange = response_processing;' . "\n" .
                   '        http_request.open("GET", url, true);' . "\n" .
                   '        http_request.send(null);' . "\n\n" .

                   '    }' . "\n\n" .

                   '    function response_processing() {' . "\n\n" .

                   '        if (http_request.readyState == 4) {' . "\n" .
                   '            if (http_request.status == 200) {' . "\n" .
//                   '                alert(http_request.responseText);' . "\n" .
                   '                document.getElementById("infoSend").innerHTML = http_request.responseText;' . "\n" .
                   '            } else {' . "\n" .
                   '                alert("Bei dem Request ist ein Problem aufgetreten.");' . "\n" .
                   '            }' . "\n" .
                   '        }' . "\n\n" .

                   '    }' . "\n" .
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n";                
  }
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  if ($action == 'new') {
    $form_action = 'insert';

    $parameters = array('title' => '',
                        'language_id' => '',
                        'content_text_plain' => '',
                        'content_text_htlm' => '',                        
                        'module' => '');

    $nInfo = new objectInfo($parameters);

    if (isset($_GET['nID'])) {
      $form_action = 'update';

      $nID = xos_db_prepare_input($_GET['nID']);

      $newsletter_query = xos_db_query("select title, language_id, content_text_plain, content_text_htlm, module from " . TABLE_NEWSLETTERS . " where newsletters_id = '" . (int)$nID . "'");
      $newsletter = xos_db_fetch_array($newsletter_query);

      $nInfo->objectInfo($newsletter);
    } elseif ($_POST) {
      $nInfo->objectInfo($_POST);
    }

    $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
    $directory_array = array();
    if ($dir = dir(DIR_WS_MODULES . 'newsletters/')) {
      while ($file = $dir->read()) {
        if (!is_dir(DIR_WS_MODULES . 'newsletters/' . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension) {
            $directory_array[] = $file;
          }
        }
      }
      sort($directory_array);
      $dir->close();
    }

    for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
      if (NEWSLETTER_ENABLED == 'true' && substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')) == 'newsletter')
        $modules_array[] = array('id' => substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')), 'text' => substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')));
      if (PRODUCT_NOTIFICATION_ENABLED == 'true' && substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')) == 'product_notification')
        $modules_array[] = array('id' => substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')), 'text' => substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')));
    }
    
    if ($form_action == 'update') {
      $smarty->assign(array('update' => true,
                            'hidden_newsletter_id' => xos_draw_hidden_field('newsletter_id', $nID)));
    }
  
    if (WYSIWYG_FOR_NEWSLETTER == 'true' && EMAIL_USE_HTML == 'true') {
      $smarty->assign(array('wysiwyg' => true,
                            'link_filename_popup_file_manager_link_selection' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents')),
                            'link_filename_popup_file_manager_image' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/image')),
                            'link_filename_popup_file_manager_flash' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/flash')),
                            'newsletter_config' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/newsletter_config.js',
                            'newsletter_template_file' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/templates/' . $_SESSION['language'] . '/newsletter_template.js',
                            'newsletter_template_lang' => $_SESSION['language'] . '_default',
                            'lang_code' => xos_get_languages_code(),
                            'textarea_content_text_htlm' => xos_draw_textarea_field('content_text_htlm', '130', '25', $nInfo->content_text_htlm)));    
    } elseif (EMAIL_USE_HTML == 'true') {
      $smarty->assign(array('use_html' => true,
                            'textarea_content_text_htlm' => xos_draw_textarea_field('content_text_htlm', '130', '25', $nInfo->content_text_htlm)));
    }
      
    $smarty->assign('textarea_content_text_plain', xos_draw_textarea_field('content_text_plain', '130', '25', $nInfo->content_text_plain));

       
    $languages = xos_get_languages();  
    if (sizeof($languages) > 1) {       
      $languages_id_selected = '';
      $lang_array = array(array('id' => '0', 'text' => TEXT_ALL_LANGUAGES));                          
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) { 
        $lang_array[] = array('id' => $languages[$i]['id'],
                              'text' => $languages[$i]['name']);        
      }
      $smarty->assign(array('languages' => true,
                            'pull_down_languages' => xos_draw_pull_down_menu('language_id', $lang_array, $nInfo->language_id)));        
    } else {
      $smarty->assign('hidden_field_language_id', xos_draw_hidden_field('language_id', $languages[0]['id']));
    }    
      
    $smarty->assign(array('action' => 'new',
                          'form_begin_new' => xos_draw_form('newsletter', FILENAME_NEWSLETTERS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'action=' . $form_action, 'post', 'onsubmit="return confirm(\'' . ($form_action == 'insert' ? JS_CONFIRM_INSERT : JS_CONFIRM_UPDATE) . '\')" enctype="multipart/form-data"'),
                          'pull_down_module' => xos_draw_pull_down_menu('module', $modules_array, $nInfo->module),
                          'input_title' => xos_draw_input_field('title', $nInfo->title, '', true),
                          'link_filename_newsletters_cancel' => xos_href_link(FILENAME_NEWSLETTERS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . (isset($_GET['nID']) ? 'nID=' . $_GET['nID'] : ''))));
    
  } elseif ($action == 'preview') {
    $nID = xos_db_prepare_input($_GET['nID']);

    $newsletter_query = xos_db_query("select title, content_text_plain, content_text_htlm, module from " . TABLE_NEWSLETTERS . " where newsletters_id = '" . (int)$nID . "'");
    $newsletter = xos_db_fetch_array($newsletter_query);

    $nInfo = new objectInfo($newsletter);

    if (($nInfo->content_text_htlm != '') && (EMAIL_USE_HTML == 'true')) {
      $smarty->assign(array('content_text_plain' => '<td class="main"><pre>' . wordwrap($nInfo->content_text_plain, 100) . '</pre></td>',
                            'content_text_htlm' => '<td>' . $nInfo->content_text_htlm . '</td>'));  
    } else {
      $smarty->assign('content_text_plain', '<td class="main"><pre>' . wordwrap($nInfo->content_text_plain, 100) . '</pre></td>');
    }      

    $smarty->assign(array('action' => 'preview',
                          'link_filename_newsletters_back' => xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID'])));
  
  } elseif ($action == 'send') {
    $nID = xos_db_prepare_input($_GET['nID']);

    $newsletter_query = xos_db_query("select ns.title, ns.language_id, ns.content_text_plain, ns.content_text_htlm, ns.module, ls.code as language_code, ls.directory as language_directory from " . TABLE_NEWSLETTERS . " ns left join " . TABLE_LANGUAGES . " ls on ns.language_id = ls.languages_id where newsletters_id = '" . (int)$nID . "'");
    $newsletter = xos_db_fetch_array($newsletter_query);

    $nInfo = new objectInfo($newsletter);

    include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/newsletters/' . $nInfo->module . substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.')));
    include(DIR_WS_MODULES . 'newsletters/' . $nInfo->module . substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.')));
    $module_name = $nInfo->module;
    $module = new $module_name($nInfo->title, $nInfo->language_id, $nInfo->content_text_plain, $nInfo->content_text_htlm, $nInfo->language_code, $nInfo->language_directory);

    $smarty->assign('action', 'send');

    if ($module->show_choose_audience) {
      $smarty->assign('module', $module->choose_audience());
    } else {
      $smarty->assign('module', $module->confirm());
    }

  } elseif ($action == 'confirm') {
    $nID = xos_db_prepare_input($_GET['nID']);

    $newsletter_query = xos_db_query("select ns.title, ns.language_id, ns.content_text_plain, ns.content_text_htlm, ns.module, ls.code as language_code, ls.directory as language_directory from " . TABLE_NEWSLETTERS . " ns left join " . TABLE_LANGUAGES . " ls on ns.language_id = ls.languages_id where newsletters_id = '" . (int)$nID . "'");
    $newsletter = xos_db_fetch_array($newsletter_query);

    $nInfo = new objectInfo($newsletter);

    include(DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/modules/newsletters/' . $nInfo->module . substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.')));
    include(DIR_WS_MODULES . 'newsletters/' . $nInfo->module . substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.')));
    $module_name = $nInfo->module;
    $module = new $module_name($nInfo->title, $nInfo->language_id, $nInfo->content_text_plain, $nInfo->content_text_htlm, $nInfo->language_code, $nInfo->language_directory);

    $smarty->assign(array('action' => 'confirm',
                          'module' => $module->confirm()));

  } elseif ($action == 'confirm_send') {

    if (isset($_POST['customers_chosen'])) {
      $customers_chosen = implode(',', $_POST['customers_chosen']);
    }  

    $smarty->assign(array('action' => 'confirm_send',
                          'BODY_TAG_PARAMS' => 'onload="confirmSent(\'newsletters.php?page=' . $_GET['page'] . '&amp;nID=' . $_GET['nID'] . '&amp;customers_chosen=' . $customers_chosen . '&amp;action=send_now&amp;' .session_name() . '=' .  session_id() . '\')"'));
    
  } else {

    $newsletters_query_raw = "select ns.newsletters_id, ns.title, ns.language_id, length(ns.content_text_plain) + length(ns.content_text_htlm) as content_length, ns.module, ns.date_added, ns.date_sent, ns.status, ns.locked, ls.name as language_name from " . TABLE_NEWSLETTERS . " ns left join " . TABLE_LANGUAGES . " ls on ns.language_id = ls.languages_id order by date_added desc";
    $newsletters_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $newsletters_query_raw, $newsletters_query_numrows);
    $newsletters_query = xos_db_query($newsletters_query_raw);
    $newsletters_array = array();
    while ($newsletters = xos_db_fetch_array($newsletters_query)) {
      if ((!isset($_GET['nID']) || (isset($_GET['nID']) && ($_GET['nID'] == $newsletters['newsletters_id']))) && !isset($nInfo) && (substr($action, 0, 3) != 'new')) {
        $nInfo = new objectInfo($newsletters);
      }
      
      $selected = false;

      if (isset($nInfo) && is_object($nInfo) && ($newsletters['newsletters_id'] == $nInfo->newsletters_id) ) {
        $selected = true;
        $link_filename_newsletters = xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview');
      } else {
        $link_filename_newsletters = xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $newsletters['newsletters_id']);
      }

      $newsletters_array[]=array('selected' => $selected,
                                 'link_filename_newsletters' => $link_filename_newsletters,
                                 'link_filename_newsletters_preview' => xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $newsletters['newsletters_id'] . '&action=preview'),
                                 'title' => $newsletters['title'],
                                 'langauge_name' => !empty($newsletters['language_name']) ? $newsletters['language_name'] : TEXT_ALL_LANGUAGES,                                 
                                 'content_length' => number_format($newsletters['content_length']),
                                 'module_name' => $newsletters['module'],
                                 'status' => (($newsletters['status'] == '1') ? true : false),
                                 'locked' => (($newsletters['locked'] > 0) ? true : false));
    }
    
    $smarty->assign(array('newsletters' => $newsletters_array,
                          'nav_bar_number' => $newsletters_split->display_count($newsletters_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS),
                          'nav_bar_result' => $newsletters_split->display_links($newsletters_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']),
                          'link_filename_newsletters_new' => xos_href_link(FILENAME_NEWSLETTERS, 'action=new')));    

    
    require(DIR_WS_BOXES . 'infobox_newsletters.php');

  }
  
  $smarty->assign('form_end', '</form>');  

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'newsletters');
  $output_newsletters = $smarty->fetch(ADMIN_TPL . '/newsletters.tpl');
  
  $smarty->assign('central_contents', $output_newsletters);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
