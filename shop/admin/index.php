<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : index.php
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
//              filename: index.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_DEFAULT) == 'overwrite_all')) :  
  if ($_GET['ssl'] == 'disable') {
    $_SESSION['disable_ssl'] = true;
    xos_redirect(xos_href_link(FILENAME_DEFAULT, (!SESSID) ? xos_session_name() . '=' . xos_session_id() : ''));
  } elseif ($_GET['ssl'] == 'enable') {
    unset($_SESSION['disable_ssl']);
    xos_redirect(xos_href_link(FILENAME_DEFAULT, (!SESSID) ? xos_session_name() . '=' . xos_session_id() : ''));
  } 

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";                                  

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  $languages_query = xos_db_query("select languages_id, name, code, image, directory from " . TABLE_LANGUAGES . " where use_in_id <> '2' order by sort_order");
  $languages_array = array();
  while ($languages = xos_db_fetch_array($languages_query)) {
    $languages_array[] = array('id' => $languages['languages_id'],
                               'name' => $languages['name'],
                               'code' => $languages['code'],
                               'image' => $languages['image'],
                               'directory' => $languages['directory']);
  }

  $lang_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages_array); $i < $n; $i++) {
    $lang_array[] = array('id' => $languages_array[$i]['code'],
                          'text' => $languages_array[$i]['name']);
    if ($languages_array[$i]['directory'] == $_SESSION['language']) {
      $languages_selected = $languages_array[$i]['code'];
    }
  }

  $software_content = '<a href="http://xos-shop.com" target="_blank">' . BOX_ENTRY_INFORMATION_PORTAL . '</a><br />' .
//                      '<a href="http://xos-shop.com" target="_blank">' . BOX_ENTRY_SUPPORT_SITE . '</a><br />' .
                      '<a href="http://xos-shop.com/forum" target="_blank">' . BOX_ENTRY_SUPPORT_FORUMS . '</a><br />' .
//                      '<a href="http://www.xos-shop.com/main/redirect.php?action=mlists" target="_blank">' . BOX_ENTRY_MAILING_LISTS . '</a><br />' .
//                      '<a href="http://www.xos-shop.com/main/redirect.php?action=bugs" target="_blank">' . BOX_ENTRY_BUG_REPORTS . '</a><br />' .
//                      '<a href="http://www.xos-shop.com/main/redirect.php?action=faq" target="_blank">' . BOX_ENTRY_FAQ . '</a><br />' .
//                      '<a href="http://www.xos-shop.com/main/redirect.php?action=irc" target="_blank">' . BOX_ENTRY_LIVE_DISCUSSIONS . '</a><br />' .
                      '<a href="http://github.com/XOS-Shop/xos_shop_system" target="_blank">' . BOX_ENTRY_CVS_REPOSITORY . '</a>';


  $orders_contents = '';
  $orders_status_query = xos_db_query("select orders_status_name, orders_status_id from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
  while ($orders_status = xos_db_fetch_array($orders_status_query)) {
    $orders_pending_query = xos_db_query("select count(*) as count from " . TABLE_ORDERS . " where orders_status = '" . $orders_status['orders_status_id'] . "'");
    $orders_pending = xos_db_fetch_array($orders_pending_query);
    if (xos_admin_check_boxes(FILENAME_ORDERS, 'sub_boxes') == true) {
      $orders_contents .= '<a href="' . xos_href_link(FILENAME_ORDERS, 'selected_box=customers&status=' . $orders_status['orders_status_id']) . '">' . $orders_status['orders_status_name'] . '</a>: ' . $orders_pending['count'] . '<br />';
    } else {
      $orders_contents .= '' . $orders_status['orders_status_name'] . ': ' . $orders_pending['count'] . '<br />';
    }   
  }
  $orders_contents = substr($orders_contents, 0, -6);


  $customers_query = xos_db_query("select count(*) as count from " . TABLE_CUSTOMERS);
  $customers = xos_db_fetch_array($customers_query);
  $products_query = xos_db_query("select count(*) as count from " . TABLE_PRODUCTS . " where products_status = '1'");
  $products = xos_db_fetch_array($products_query);
  $reviews_query = xos_db_query("select count(*) as count from " . TABLE_REVIEWS);
  $reviews = xos_db_fetch_array($reviews_query);


  $statistics_content = BOX_ENTRY_CUSTOMERS . ' ' . $customers['count'] . '<br />' .
                        BOX_ENTRY_PRODUCTS . ' ' . $products['count'] . '<br />' .
                        BOX_ENTRY_REVIEWS . ' ' . $reviews['count'];


  if ($request_type == 'SSL') {
    $size = ((getenv('SSL_CIPHER_ALGKEYSIZE')) ? getenv('SSL_CIPHER_ALGKEYSIZE') . '-bit' : '<i>' . BOX_CONNECTION_UNKNOWN . '</i>');
    $content_ssl = sprintf(BOX_CONNECTION_PROTECTED, $size);
    $title_ssl = ICON_TITLE_LOCKED_CLICK_TO_UNLOCK;
    $link_ssl = xos_href_link(FILENAME_DEFAULT, 'ssl=disable');
    $ssl_enabled = true;
  } elseif ($_SESSION['disable_ssl']) {
    $content_ssl = BOX_CONNECTION_UNPROTECTED;
    $title_ssl = ICON_TITLE_UNLOCKED_CLICK_TO_LOCK;
    $link_ssl = xos_href_link(FILENAME_DEFAULT, 'ssl=enable');
    $ssl_enabled = false;    
  } else {
    $content_ssl = BOX_CONNECTION_UNPROTECTED;
    $title_ssl = '';
    $link_ssl = '';
    $ssl_enabled = false;       
  }

  if (SESSID) {
    $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
  }
    
  $smarty->assign(array('box_software_content' => $software_content,
                        'box_orders_content' => $orders_contents,
                        'box_statistics_content' => $statistics_content,
                        'box_ssl_content' => $content_ssl,
                        'link_ssl' => $link_ssl,
                        'title_ssl' => $title_ssl,
                        'ssl_enabled' => $ssl_enabled,
                        'form_languages_begin' => xos_draw_form('languages', 'index.php', '', 'get'),
                        'pull_down_menu_language' => (sizeof($lang_array) > 1) ? xos_draw_pull_down_menu('lnc', $lang_array, $languages_selected, 'onchange="this.form.submit();"') : '',
                        'form_end' => '</form>')); 
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'index');                                                    
  $output_index = $smarty->fetch(ADMIN_TPL . '/index.tpl');
  
  $smarty->assign('central_contents', $output_index);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
endif;  
?>
