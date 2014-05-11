<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : tell_a_friend.php
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
//              filename: tell_a_friend.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_TELL_A_FRIEND) == 'overwrite_all')) :  
  if (SEND_EMAILS != 'true') {
    xos_redirect(xos_href_link(FILENAME_DEFAULT), false);
  }   

  if (!isset($_SESSION['customer_id']) && (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false' || !$session_started)) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $valid_product = false;
  if (isset($_GET['products_id'])) {
    $product_info_query = xos_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
    if (xos_db_num_rows($product_info_query)) {
      $valid_product = true;
      $product_info = xos_db_fetch_array($product_info_query);
    }
  }

  if ($valid_product == false) {
    xos_redirect(xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['products_id']), false);
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_TELL_A_FRIEND);

  if (isset($_GET['action']) && ($_GET['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    $error = false;

    $to_email_address = xos_db_prepare_input($_POST['to_email_address']);
    $to_name = xos_db_prepare_input($_POST['to_name']);
    $from_email_address = xos_db_prepare_input($_POST['from_email_address']);
    $from_name = xos_db_prepare_input($_POST['from_name']);
    $message = xos_db_prepare_input(substr(strip_tags($_POST['message']), 0,1000));

    if (empty($from_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_NAME);
    }

    if (strlen($from_email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_ADDRESS_MIN_LENGTH);
    } elseif (!xos_validate_email($from_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_ADDRESS);
    }

    if (empty($to_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_NAME);
    }

    if (strlen($to_email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_ADDRESS_MIN_LENGTH);
    } elseif (!xos_validate_email($to_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_ADDRESS);
    }
    
    if (!isset($_SESSION['customer_id'])) {
      if (!isset($_SESSION['captcha_spam']) || $_POST['security_code'] != $_SESSION['captcha_spam']) {
        $error = true;

        $messageStack->add('friend', ERROR_SECURITY_CODE);    
      }
        
      unset($_SESSION['captcha_spam']);
    }

    $actionRecorder = new actionRecorder('ar_tell_a_friend', (isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null), $from_name);
    if (!$actionRecorder->canPerform() && $actionRecorder->check()) {
      $error = true;

      $actionRecorder->record(false);

      $messageStack->add('friend', sprintf(ERROR_ACTION_RECORDER, (defined('MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES') ? (int)MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES : 15)));
    }
    
    if ($error == false) {
//      $lng_code_query = xos_db_query("select code from " . TABLE_LANGUAGES . " where languages_id = '" . (int)$_SESSION['languages_id'] . "'");
//      $customer_lng = xos_db_fetch_array($lng_code_query);
       
      $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);

      $smarty->unregisterFilter('output','smarty_outputfilter_trimwhitespace');
      
      if (xos_not_null($message)) {
        $smarty->assign('message', $message);
      }

      $smarty->assign(array('html_params' => HTML_PARAMS,
                            'xhtml_lang' => XHTML_LANG,
                            'charset' => CHARSET,
                            'store_name_address' => STORE_NAME_ADDRESS,
                            'store_name' => STORE_NAME,
                            'src_embedded_shop_logo' => 'cid:shop_logo',
                            'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . SELECTED_TPL . '/') . EMAIL_SHOP_LOGO,
                            'to_name' => $to_name,
                            'from_name' => $from_name,
                            'products_name' => $product_info['products_name'],
                            'link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['products_id'], 'NONSSL', false, false)));
//      $smarty->assign('link_filename_product_info', xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['products_id'] . '&language=' . $customer_lng['code'], 'NONSSL', false, false));
      
      $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'tell_a_friend_email_html');
      $output_tell_a_friend_email_html = $smarty->fetch(SELECTED_TPL . '/includes/email/tell_a_friend_email_html.tpl');
      $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'tell_a_friend_email_text');  
      $output_tell_a_friend_email_text = $smarty->fetch(SELECTED_TPL . '/includes/email/tell_a_friend_email_text.tpl');
      $smarty->clearAssign(array('message',
                                  'html_params',
                                  'xhtml_lang',
                                  'charset',
                                  'store_name_address',
                                  'store_name',
                                  'src_embedded_shop_logo',
                                  'src_shop_logo',
                                  'to_name',
                                  'from_name',
                                  'products_name',
                                  'link_filename_product_info'));  
  
      $email_to_friend = new mailer($to_name, $to_email_address, $email_subject, $output_tell_a_friend_email_html, $output_tell_a_friend_email_text, $from_name, $from_email_address, EMAIL_SHOP_LOGO);
    
      if(!$email_to_friend->send()) {
        $messageStack->add('friend', sprintf(ERROR_PHPMAILER, $email_to_friend->ErrorInfo));
      } else {
        $actionRecorder->record();
        $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $product_info['products_name'], xos_output_string_protected($to_name)), 'success');        
        $_SESSION['navigation']->remove_current_page();
        xos_redirect(xos_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['products_id']), false);
      }
    }
  } elseif (isset($_SESSION['customer_id'])) {
    $account_query = xos_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
    $account = xos_db_fetch_array($account_query);

    $from_name = $account['customers_firstname'] . ' ' . $account['customers_lastname'];
    $from_email_address = $account['customers_email_address'];
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . (int)$_GET['products_id']));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($messageStack->size('friend') > 0) {
    $smarty->assign('message_stack', $messageStack->output('friend'));
  }

  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';        
    $back_link = xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']);
  } else {
    $back_link = 'javascript:history.go(-1)';
  }
 
  $smarty->assign(array('form_begin' => xos_draw_form('email_friend', xos_href_link(FILENAME_TELL_A_FRIEND, 'action=process&products_id=' . (int)$_GET['products_id'], 'SSL'), 'post', '', true),
                        'isset_customer_id' => isset($_SESSION['customer_id']) ? true : false,
                        'products_name' => $product_info['products_name'],
                        'input_field_from_name' => xos_draw_input_field('from_name', '', (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false' ? 'id="tell_a_friend_from_name" readonly="readonly"' : 'id="tell_a_friend_from_name"')),
                        'input_field_from_email_address' => xos_draw_input_field('from_email_address', '', (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false' ? 'id="tell_a_friend_from_email_address" readonly="readonly"' : 'id="tell_a_friend_from_email_address"')),
                        'input_field_to_name' => xos_draw_input_field('to_name', '', 'id="tell_a_friend_to_name"'),
                        'input_field_to_email_address' => xos_draw_input_field('to_email_address', (($to_email_address) ? '' : $_GET['to_email_address']), 'id="tell_a_friend_to_email_address"'),
                        'input_security_code' => xos_draw_input_field('security_code', '', 'id="tell_a_friend_security_code" maxlength="8"', 'text', false),
//                        'captcha_img' => '<img src="' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . '" alt="captcha" title=" captcha " style="cursor:pointer;" onclick="javascript:this.src=\'' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . (SID ? '&amp;' : '?') . '\'+Math.random();" />',
                        'captcha_img' => '<img src="' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . '" alt="captcha" title=" captcha " />',                          
                        'textarea_field_message' => xos_draw_textarea_field('message', '40', '8', '', 'id="tell_a_friend_message"'),
                        'link_back' => $back_link,
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'tell_a_friend');
  $output_tell_a_friend = $smarty->fetch(SELECTED_TPL . '/tell_a_friend.tpl');
                        
  $smarty->assign('central_contents', $output_tell_a_friend);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
