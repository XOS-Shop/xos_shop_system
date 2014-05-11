<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : orders.php
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
//              filename: orders.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_ORDERS) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'update_order':
        $oID = xos_db_prepare_input($_GET['oID']);
        $status = xos_db_prepare_input($_POST['status']);
        $comments = xos_db_prepare_input($_POST['comments']);

        $order_updated = false;
        $check_status_query = xos_db_query("select customers_name, customers_email_address, orders_status, date_purchased, language_directory from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
        $check_status = xos_db_fetch_array($check_status_query);

        if ( ($check_status['orders_status'] != $status) || xos_not_null($comments)) {
          xos_db_query("update " . TABLE_ORDERS . " set orders_status = '" . xos_db_input($status) . "', last_modified = now() where orders_id = '" . (int)$oID . "'");

          $customer_notified = '0';
          if (isset($_POST['notify']) && ($_POST['notify'] == 'on')) {
            if (SEND_EMAILS == 'true') {
            
              $languages_query = xos_db_query("select languages_id, code, directory from " . TABLE_LANGUAGES . " where use_in_id > '1' and directory = '" . $check_status['language_directory'] . "'");  
              if (!xos_db_num_rows($languages_query)) {
                $lang_query = xos_db_query("select languages_id, code, directory from " . TABLE_LANGUAGES . " where code = '" . xos_db_input(DEFAULT_LANGUAGE) . "'");
                $languages = xos_db_fetch_array($lang_query);
                $check_status['language_directory'] = $languages['directory'];
              } else {
                $languages = xos_db_fetch_array($languages_query);
              }
              
              $order_status_query = xos_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . (int)$status . "' and language_id = '" . (int)$languages['languages_id'] . "'");
              $order_status = xos_db_fetch_array($order_status_query);
              
              include(DIR_FS_SMARTY . 'catalog/languages/' . $check_status['language_directory'] . '/email/order_status_email.php');
                                      
              $smarty_order = new Smarty();
              $smarty_order->template_dir = DIR_FS_SMARTY . 'catalog/templates/';
              $smarty_order->compile_dir = DIR_FS_SMARTY . 'catalog/templates_c/';
              $smarty_order->config_dir = DIR_FS_SMARTY . 'catalog/';
              $smarty_order->cache_dir = DIR_FS_SMARTY . 'catalog/cache/';             
              $smarty_order->left_delimiter = '[@{';
              $smarty_order->right_delimiter = '}@]';
            
              if (isset($_POST['notify_comments']) && ($_POST['notify_comments'] == 'on')) {
                $smarty_order->assign('order_comments', $comments);
              } 
              
              $smarty_order->assign(array('html_params' => HTML_PARAMS,
                                          'xhtml_lang' => $languages['code'],
                                          'charset' => CHARSET,
                                          'store_name_address' => STORE_NAME_ADDRESS,
                                          'store_name' => STORE_NAME,
                                          'src_embedded_shop_logo' => 'cid:shop_logo',
                                          'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG_IMAGES . 'email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . DEFAULT_TPL . '/') . EMAIL_SHOP_LOGO,
                                          'date_ordered' => xos_order_status_email_date_long($check_status['date_purchased']),
                                          'order_id' => $oID,
                                          'order_status' => $order_status['orders_status_name'],
                                          'link_invoice' => xos_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL')));
      
              $smarty_order->configLoad('languages/' . $check_status['language_directory'] . '_email.conf', 'order_status_email_html');
              $output_order_status_email_html = $smarty_order->fetch(DEFAULT_TPL . '/includes/email/order_status_email_html.tpl');
              $smarty_order->configLoad('languages/' . $check_status['language_directory'] . '_email.conf', 'order_status_email_text');  
              $output_order_status_email_text = $smarty_order->fetch(DEFAULT_TPL . '/includes/email/order_status_email_text.tpl');
  
              $email_to_customer = new mailer($check_status['customers_name'], $check_status['customers_email_address'], EMAIL_TEXT_SUBJECT, $output_order_status_email_html, $output_order_status_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SHOP_LOGO);
      
              if(!$email_to_customer->send()) {
                $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_customer->ErrorInfo), 'error');
              }
            }  
            $customer_notified = '1';
          }

          xos_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) values ('" . (int)$oID . "', '" . xos_db_input($status) . "', now(), '" . xos_db_input($customer_notified) . "', '" . xos_db_input($comments)  . "')");

          $order_updated = true;
        }

        if ($order_updated == true) {
         $messageStack->add_session('header', SUCCESS_ORDER_UPDATED, 'success');
        } else {
          $messageStack->add_session('header', WARNING_ORDER_NOT_UPDATED, 'warning');
        }

        xos_redirect(xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('action')) . 'action=edit'));
        break;
      case 'deleteconfirm':
        $oID = xos_db_prepare_input($_GET['oID']);
        $oSC = xos_db_prepare_input($_GET['oSC']);

        xos_remove_order($oID, $_POST['restock'], $oSC);

        xos_redirect(xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action'))));
        break;
    }
  }

  if (($action == 'edit') && isset($_GET['oID'])) {
    $oID = xos_db_prepare_input($_GET['oID']);

    $orders_query = xos_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
    $order_exists = true;
    if (!xos_db_num_rows($orders_query)) {
      $order_exists = false;
      $messageStack->add('header', sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
    }
  }

  include(DIR_WS_CLASSES . 'order.php');

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";

  $javascript .= '<script type="text/javascript">' . "\n" .
                 '/* <![CDATA[ */' . "\n" .
                 'function popupWindow(url) {' . "\n" .
                 '  x = (screen.availWidth - 900) / 2;' . "\n" .
                 '  y = (screen.availHeight - 750) / 2;' . "\n" .                 
                 '  window.open(url,"popupWindow","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=750,screenX="+x+",screenY="+y+",top="+y+",left="+x).focus();' . "\n" .
                 '}' . "\n" .
                 '/* ]]> */' . "\n" .  
                 '</script> ' . "\n"; 
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  if (($action == 'edit') && ($order_exists == true)) {
  
    $orders_statuses = array();
    $orders_status_array = array();
    $orders_status_query = xos_db_query("select orders_status_id, orders_status_name, orders_status_code from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
    while ($orders_status = xos_db_fetch_array($orders_status_query)) {
      if ($orders_status['orders_status_code'] == '') {
        $orders_statuses[] = array('id' => $orders_status['orders_status_id'],
                                   'text' => $orders_status['orders_status_name']);
      }                           
      $orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
    }  
  
    $order = new order($oID);    

    if (xos_not_null($order->info['cc_type']) || xos_not_null($order->info['cc_owner']) || xos_not_null($order->info['cc_number'])) {

      $smarty->assign(array('credit_card' => true,
                            'credit_card_type' => $order->info['cc_type'],
                            'credit_card_owner' => $order->info['cc_owner'],
                            'credit_card_number' => $order->info['cc_number'],
                            'credit_card_expires' => $order->info['cc_expires']));   

    }

    $order_products_array = array();
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      $attributes_options_values_price = false;
      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {    
        $order_attributes_array = array();        
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {        
          $options_values_price = '';
          if ($order->products[$i]['attributes'][$j]['price'] != 0) {
            $attributes_options_values_price = true;
            $options_values_price = $order->products[$i]['attributes'][$j]['price_formated'];
          }         
                
          $order_attributes_array[]=array('option_name' => $order->products[$i]['attributes'][$j]['option'],
                                          'option_value_name' => $order->products[$i]['attributes'][$j]['value'],
                                          'option_price' => $options_values_price,
                                          'option_price_prefix' => $order->products[$i]['attributes'][$j]['prefix']);        
        }
      }
      
      $order_products_array[]=array('qty' => $order->products[$i]['qty'],
                                    'model' => $order->products[$i]['model'],      
                                    'name' => $order->products[$i]['name'],
                                    'packaging_unit' => $order->products[$i]['packaging_unit'],
                                    'tax' => xos_display_tax_value($order->products[$i]['tax']),                                
                                    'price' => $order->products[$i]['price_formated'],
                                    'final_single_price' => $order->products[$i]['final_price_formated'],
                                    'final_price' => $order->products[$i]['total_price_formated'],
                                    'products_attributes_option_price' => $attributes_options_values_price,
                                    'product_attributes' => $order_attributes_array);
       
      unset($order_attributes_array);                                
    }    

    $order_totals_array = array();
    for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
           
      $order_totals_array[]=array('title' => $order->totals[$i]['title'],
                                  'text' => $order->totals[$i]['text'],
                                  'tax' => $order->totals[$i]['class'] == 'ot_shipping' || $order->totals[$i]['class'] == 'ot_loworderfee' || $order->totals[$i]['class'] == 'ot_cod_fee' ? xos_display_tax_value($order->totals[$i]['tax']) : -1);           
    }

    $orders_history_query = xos_db_query("select orders_status_id, date_added, customer_notified, comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . xos_db_input($oID) . "' order by date_added, orders_status_history_id");
    if (xos_db_num_rows($orders_history_query)) {
      $orders_history_array = array();
      while ($orders_history = xos_db_fetch_array($orders_history_query)) {
        
        $customer_notified = false;
        if ($orders_history['customer_notified'] == '1') {
          $customer_notified = true;
        }
             
        $orders_history_array[]=array('date_added' => xos_datetime_short($orders_history['date_added']),
                                      'status' => $orders_status_array[$orders_history['orders_status_id']],
                                      'comments' => nl2br(xos_db_output($orders_history['comments'])),
                                      'customer_notified' => $customer_notified);             
      }
      
      $smarty->assign('orders_history', $orders_history_array);
      
    } else {

    }
    
    $languages_query = xos_db_query("select name from " . TABLE_LANGUAGES . " where use_in_id > '1' and languages_id = '" . $order->info['language_id'] . "'");  
    if (!xos_db_num_rows($languages_query)) {
      $lang_query = xos_db_query("select name from " . TABLE_LANGUAGES . " where code = '" . xos_db_input(DEFAULT_LANGUAGE) . "'");
      $languages = xos_db_fetch_array($lang_query);
    } else {
      $languages = xos_db_fetch_array($languages_query);
    }
    
    if (SEND_EMAILS == 'true') {
      $smarty->assign(array('send_emails' => true,
                            'checkbox_notify' => xos_draw_checkbox_field('notify', '', true),
                            'checkbox_notify_comments' => xos_draw_checkbox_field('notify_comments', '', true)));     
    }
    
    if (sizeof($order->info['tax_groups']) > 1) {  
      $smarty->assign('tax_groups', true);
    }    

    $smarty->assign(array('order_id' => $oID,
                          'order_language_name' => $languages['name'],
                          'date_purchased' => xos_datetime_short($order->info['date_purchased']),
                          'customer_address' => xos_address_format($order->customer['format_id'], $order->customer, 1, '', '<br />'),
                          'delivery_address' => xos_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br />'),
                          'billing_address' => xos_address_format($order->billing['format_id'], $order->billing, 1, '', '<br />'),
                          'c_id' => $order->customer['c_id'],
                          'telephone_number' => $order->customer['telephone'],
                          'email_address' => $order->customer['email_address'],
                          'payment_method' => $order->info['payment_method'],
                          'order_products' => $order_products_array,
                          'order_totals' => $order_totals_array,
                          'form_begin_status' => xos_draw_form('new_status', FILENAME_ORDERS, xos_get_all_get_params(array('action')) . 'action=update_order'),
                          'textarea_comments' => xos_draw_textarea_field('comments', '60', '5'),
                          'pull_down_status' => xos_draw_pull_down_menu('status', $orders_statuses, $order->info['orders_status']),
                          'form_end' => '</form>',
                          'link_filename_orders_invoice' => xos_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $_GET['oID']),
                          'link_filename_orders_packingslip' => xos_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $_GET['oID']),
                          'link_filename_orders' => xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('action'))),
                          'edit' => true));

  } else {

    $orders_statuses = array();
    $orders_status_query = xos_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
    while ($orders_status = xos_db_fetch_array($orders_status_query)) {
        $orders_statuses[] = array('id' => $orders_status['orders_status_id'],
                                   'text' => $orders_status['orders_status_name']);
    }

    $status = $_GET['status'];

    if (isset($_GET['cID'])) {
      $cID = xos_db_prepare_input($_GET['cID']);
      $orders_query_raw = "select o.orders_id, o.customers_name, o.customers_id, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, s.orders_status_code, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$cID . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and ot.class = 'ot_total' group by o.orders_id order by o.orders_id DESC";
    } elseif (isset($_GET['status']) && is_numeric($_GET['status']) && ($_GET['status'] > 0)) {
      $status = xos_db_prepare_input($_GET['status']);
      $orders_query_raw = "select o.orders_id, o.customers_name, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, s.orders_status_code, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and s.orders_status_id = '" . (int)$status . "' and ot.class = 'ot_total' group by o.orders_id order by o.orders_id DESC";
    } else {
      $orders_query_raw = "select o.orders_id, o.customers_name, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, s.orders_status_code, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and ot.class = 'ot_total' group by o.orders_id order by o.orders_id DESC";
    }
    $orders_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $orders_query_raw, $orders_query_numrows, 'o.orders_id');
    $orders_query = xos_db_query($orders_query_raw);
    $orders_array = array();
    while ($orders = xos_db_fetch_array($orders_query)) {
      $oder_total_query = xos_db_query("select text from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$orders['orders_id'] . "' and class = 'ot_total' order by orders_total_id DESC limit 1");
      $oder_total = xos_db_fetch_array($oder_total_query);    
    
      if ((!isset($_GET['oID']) || (isset($_GET['oID']) && ($_GET['oID'] == $orders['orders_id']))) && !isset($oInfo)) {
        $oInfo = new objectInfo($orders);
      }
      
      $selected = false;

      if (isset($oInfo) && is_object($oInfo) && ($orders['orders_id'] == $oInfo->orders_id)) {
        $selected = true;
        $link_filename_orders = xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit');
      } else {
        $link_filename_orders = xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID')) . 'oID=' . $orders['orders_id']);
      }

      $orders_array[]=array('selected' => $selected,
                            'link_filename_orders' => $link_filename_orders,
                            'link_filename_orders_action_edit' => xos_href_link(FILENAME_ORDERS, xos_get_all_get_params(array('oID', 'action')) . 'oID=' . $orders['orders_id'] . '&action=edit'),
                            'customers_name' => $orders['customers_name'],
                            'order_total' => strip_tags($oder_total['text']),
                            'date_purchased' => xos_datetime_short($orders['date_purchased']),
                            'order_status_name' => $orders['orders_status_name']);
    }

    if (SID) {
      $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
    } 

    $smarty->assign(array('form_begin_orders' => xos_draw_form('orders', FILENAME_ORDERS, '', 'get'),
                          'input_oid' => xos_draw_input_field('oID', '', 'size="12"'),
                          'hidden_action' => xos_draw_hidden_field('action', 'edit'),
                          'form_begin_status' => xos_draw_form('new_status', FILENAME_ORDERS, '', 'get'),
                          'pull_down_status' => xos_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_ORDERS)), (array)$orders_statuses), '', 'onchange="this.form.submit();"'),
                          'form_end' => '</form>',
                          'orders' => $orders_array,
                          'nav_bar_number' => $orders_split->display_count($orders_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS),
                          'nav_bar_result' => $orders_split->display_links($orders_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], xos_get_all_get_params(array('page', 'oID', 'action')))));   

    require(DIR_WS_BOXES . 'infobox_orders.php');

  }

 $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'orders');
 
 $language_directory_query = xos_db_query("select directory from " . TABLE_LANGUAGES . " where use_in_id > '1' and directory = '" . $order->info['language_directory'] . "'");  
 if (xos_db_num_rows($language_directory_query)) {
   $smarty->configLoad(DIR_FS_SMARTY . 'catalog/languages/' . $order->info['language_directory'] . '.conf', 'order_info');
 } 
 
 $output_orders = $smarty->fetch(ADMIN_TPL . '/orders.tpl');
  
 $smarty->assign('central_contents', $output_orders);
  
 $smarty->display(ADMIN_TPL . '/frame.tpl');

 require(DIR_WS_INCLUDES . 'application_bottom.php');
endif; 
?>
