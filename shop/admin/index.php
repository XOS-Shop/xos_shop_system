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
    xos_redirect(xos_href_link(FILENAME_DEFAULT));
  } elseif ($_GET['ssl'] == 'enable') {
    unset($_SESSION['disable_ssl']);
    xos_redirect(xos_href_link(FILENAME_DEFAULT));
  } 

  $javascript = '<script type="text/javascript">' . "\n" .   
                '/* <![CDATA[ */' . "\n" .
                'function center() {' . "\n" .
                '  var height = document.getElementById("text").offsetHeight;' . "\n" .
                '  var marg = (height / 2);' . "\n" .
                '  document.getElementById("spacer").style.margin = "-" + marg + "px" + " 0px" + " 0px" + " 0px";' . "\n" .
                '}' . "\n" .                   
                '/* ]]> */' . "\n" .
                '</script>' . "\n";                                  

  require(DIR_WS_INCLUDES . 'html_header_with_special_stylesheet.php');  
  require(DIR_WS_INCLUDES . 'footer.php');    
  
  $cat = array(array('title' => BOX_HEADING_MY_ACCOUNT,
                     'image' => 'my_account.gif',
                     'href' => xos_href_link(FILENAME_ADMIN_ACCOUNT, 'selected_box=0'),
                     'children' => array(array('title' => BOX_MY_ACCOUNT,
                                               'link' => xos_href_link(FILENAME_ADMIN_ACCOUNT, 'selected_box=0')),
                                         array('title' => BOX_LOGOFF,
                                               'link' => xos_href_link(FILENAME_LOGOFF)))),
               (xos_admin_check_boxes('menubox_administrator.php')) ? 
               array('title' => BOX_HEADING_ADMINISTRATOR,
                     'image' => 'administrator.gif',
                     'href' => xos_href_link(xos_selected_file('administrator.php'), 'selected_box=administrator'),
                     'children' => array((xos_admin_check_files(FILENAME_ADMIN_MEMBERS)) ?
                                         array('title' => BOX_ADMINISTRATOR_MEMBER,
                                               'link' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator')) : '',
                                         (xos_admin_check_files(FILENAME_ADMIN_MEMBERS)) ?
                                         array('title' => BOX_ADMINISTRATOR_GROUP,
                                               'link' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator&gID=groups')) : '')) : '',
               (xos_admin_check_boxes('menubox_configuration.php')) ?                                         
               array('title' => BOX_HEADING_CONFIGURATION,                    
                     'image' => 'configuration.gif',
                     'href' => xos_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1'),
                     'children' => array(array('title' => BOX_CONFIGURATION_MYSTORE,
                                               'link' => xos_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1')),
                                         array('title' => BOX_CONFIGURATION_LOGGING,
                                               'link' => xos_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=11')),
                                         array('title' => BOX_CONFIGURATION_SMARTY_TEMPLATE,
                                               'link' => xos_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=12')))) : '',
               (xos_admin_check_boxes('menubox_modules.php')) ?      
               array('title' => BOX_HEADING_MODULES,                                                
                     'image' => 'modules.gif',
                     'href' => xos_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment'),
                     'children' => array(array('title' => BOX_MODULES_PAYMENT,
                                               'link' => xos_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment')),
                                         array('title' => BOX_MODULES_SHIPPING,
                                               'link' => xos_href_link(FILENAME_MODULES, 'selected_box=modules&set=shipping')))) : '',                                                
               (xos_admin_check_boxes('menubox_content_manager.php')) ?                                
               array('title' => BOX_HEADING_CONTENT_MANAGER,                                   
                     'image' => 'content_manager.gif',
                     'href' => xos_href_link(FILENAME_PAGES, 'selected_box=content_manager'),
                     'children' => array((xos_admin_check_files(FILENAME_PAGES)) ?
                                         array('title' => BOX_CONTENT_MANAGER_PAGES,
                                               'link' => xos_href_link(FILENAME_PAGES, 'selected_box=content_manager')) : '',
                                         (xos_admin_check_files(FILENAME_INFO_PAGES)) ?      
                                         array('title' => BOX_CONTENT_MANAGER_INFO_PAGES,
                                               'link' => xos_href_link(FILENAME_INFO_PAGES, 'selected_box=content_manager')) : '')) : '',     
               (xos_admin_check_boxes('menubox_catalog.php')) ?                                
               array('title' => BOX_HEADING_CATALOG,                                   
                     'image' => 'catalog.gif',
                     'href' => xos_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'),
                     'children' => array((xos_admin_check_files(FILENAME_CATEGORIES)) ?
                                         array('title' => BOX_CATALOG_CATEGORIES_PRODUCTS,
                                               'link' => xos_href_link(FILENAME_CATEGORIES, 'selected_box=catalog')) : '',
                                         (xos_admin_check_files(FILENAME_MANUFACTURERS)) ?      
                                         array('title' => BOX_CATALOG_MANUFACTURERS,
                                               'link' => xos_href_link(FILENAME_MANUFACTURERS, 'selected_box=catalog')) : '')) : '',
               (xos_admin_check_boxes('menubox_taxes.php')) ?                                
               array('title' => BOX_HEADING_LOCATION_AND_TAXES,                                
                     'image' => 'location.gif',
                     'href' => xos_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'),
                     'children' => array((xos_admin_check_files(FILENAME_COUNTRIES)) ?
                                         array('title' => BOX_TAXES_COUNTRIES,
                                               'link' => xos_href_link(FILENAME_COUNTRIES, 'selected_box=taxes')) : '',
                                         (xos_admin_check_files(FILENAME_GEO_ZONES)) ?      
                                         array('title' => BOX_TAXES_GEO_ZONES,
                                               'link' => xos_href_link(FILENAME_GEO_ZONES, 'selected_box=taxes')) : '')) : '',
               (xos_admin_check_boxes('menubox_customers.php')) ?                                
               array('title' => BOX_HEADING_CUSTOMERS,                                 
                     'image' => 'customers.gif',
                     'href' => xos_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'),
                     'children' => array((xos_admin_check_files(FILENAME_CUSTOMERS)) ?
                                         array('title' => BOX_CUSTOMERS_CUSTOMERS,
                                               'link' => xos_href_link(FILENAME_CUSTOMERS, 'selected_box=customers')) : '',
                                         (xos_admin_check_files(FILENAME_ORDERS)) ?      
                                         array('title' => BOX_CUSTOMERS_ORDERS,
                                               'link' => xos_href_link(FILENAME_ORDERS, 'selected_box=customers')) : '')) : '',
               (xos_admin_check_boxes('menubox_localization.php')) ?                                
               array('title' => BOX_HEADING_LOCALIZATION,                                  
                     'image' => 'localization.gif',
                     'href' => xos_href_link(FILENAME_CURRENCIES, 'selected_box=localization'),
                     'children' => array((xos_admin_check_files(FILENAME_CURRENCIES)) ?
                                         array('title' => BOX_LOCALIZATION_CURRENCIES,
                                               'link' => xos_href_link(FILENAME_CURRENCIES, 'selected_box=localization')) : '',
                                         (xos_admin_check_files(FILENAME_LANGUAGES)) ?      
                                         array('title' => BOX_LOCALIZATION_LANGUAGES,
                                               'link' => xos_href_link(FILENAME_LANGUAGES, 'selected_box=localization')) : '')) : '',
               (xos_admin_check_boxes('menubox_reports.php')) ?                                
               array('title' => BOX_HEADING_REPORTS,                                  
                     'image' => 'reports.gif',
                     'href' => xos_href_link(FILENAME_STATS_PRODUCTS_VIEWED, 'selected_box=reports'),
                     'children' => array((xos_admin_check_files(FILENAME_STATS_PRODUCTS_PURCHASED)) ?
                                         array('title' => REPORTS_PRODUCTS,
                                               'link' => xos_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports')) : '',
                                         (xos_admin_check_files(FILENAME_STATS_CUSTOMERS)) ?      
                                         array('title' => REPORTS_ORDERS,
                                               'link' => xos_href_link(FILENAME_STATS_CUSTOMERS, 'selected_box=reports')) : '')) : '',
               (xos_admin_check_boxes('menubox_tools.php')) ?                                
               array('title' => BOX_HEADING_TOOLS,                                   
                     'image' => 'tools.gif',
                     'href' => xos_href_link(FILENAME_BACKUP, 'selected_box=tools'),
                     'children' => array((xos_admin_check_files(FILENAME_BACKUP)) ?
                                         array('title' => TOOLS_BACKUP,
                                               'link' => xos_href_link(FILENAME_BACKUP, 'selected_box=tools')) : '',
                                         (xos_admin_check_files(FILENAME_BANNER_MANAGER)) ?      
                                         array('title' => TOOLS_BANNERS,
                                               'link' => xos_href_link(FILENAME_BANNER_MANAGER, 'selected_box=tools')) : '',
                                         (xos_admin_check_files(FILENAME_WHOS_ONLINE)) ?      
                                         array('title' => TOOLS_WHOS_ONLINE,
                                               'link' => xos_href_link(FILENAME_WHOS_ONLINE, 'selected_box=tools')) : '')) : ''
         );

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

  $software_content = '<a href="http://www.xos-shop.com" target="_blank">' . BOX_ENTRY_SUPPORT_SITE . '</a><br />' .
                      '<a href="http://www.xos-shop.com/main/redirect.php?action=forum" target="_blank">' . BOX_ENTRY_SUPPORT_FORUMS . '</a><br />' .
                      '<a href="http://www.xos-shop.com/main/redirect.php?action=mlists" target="_blank">' . BOX_ENTRY_MAILING_LISTS . '</a><br />' .
                      '<a href="http://www.xos-shop.com/main/redirect.php?action=bugs" target="_blank">' . BOX_ENTRY_BUG_REPORTS . '</a><br />' .
                      '<a href="http://www.xos-shop.com/main/redirect.php?action=faq" target="_blank">' . BOX_ENTRY_FAQ . '</a><br />' .
                      '<a href="http://www.xos-shop.com/main/redirect.php?action=irc" target="_blank">' . BOX_ENTRY_LIVE_DISCUSSIONS . '</a><br />' .
                      '<a href="http://www.xos-shop.com/main/redirect.php?action=cvs" target="_blank">' . BOX_ENTRY_CVS_REPOSITORY . '</a><br />' .
                      '<a href="http://www.xos-shop.com/main/redirect.php?action=portal" target="_blank">' . BOX_ENTRY_INFORMATION_PORTAL . '</a>';


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


  if (getenv('HTTPS') == 'on') {
    $size = ((getenv('SSL_CIPHER_ALGKEYSIZE')) ? getenv('SSL_CIPHER_ALGKEYSIZE') . '-bit' : '<i>' . BOX_CONNECTION_UNKNOWN . '</i>');
    $content_ssl = '<a href="' . xos_href_link(FILENAME_DEFAULT, 'ssl=disable') . '">' . xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icons/locked.gif', ICON_TITLE_LOCKED_CLICK_TO_UNLOCK, '', '', 'align="right"') . '</a>' . sprintf(BOX_CONNECTION_PROTECTED, $size);
  } elseif ($_SESSION['disable_ssl']) {
    $content_ssl = '<a href="' . xos_href_link(FILENAME_DEFAULT, 'ssl=enable') . '">' . xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icons/unlocked.gif', ICON_TITLE_UNLOCKED_CLICK_TO_LOCK, '', '', 'align="right"') . '</a>' . BOX_CONNECTION_UNPROTECTED;
  } else {
    $content_ssl = xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icons/unlocked.gif', ICON_TITLE_UNLOCKED, '', '', 'align="right"') . BOX_CONNECTION_UNPROTECTED;
  }

  if (SID) {
    $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
  }
    
  $smarty->assign(array('link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'link_catalog' => xos_catalog_href_link(),
                        'box_software_content' => $software_content,
                        'box_orders_content' => $orders_contents,
                        'box_statistics_content' => $statistics_content,
                        'box_ssl_content' => $content_ssl,
                        'form_languages_begin' => xos_draw_form('languages', 'index.php', '', 'get'),
                        'pull_down_menu_language' => (sizeof($lang_array) > 1) ? xos_draw_pull_down_menu('language', $lang_array, $languages_selected, 'onchange="this.form.submit();"') : '',
                        'form_end' => '</form>',
                        'categories' => array_filter($cat))); 
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'index');
                                                    
  $smarty->display(ADMIN_TPL . '/index.tpl');
endif;  
?>
