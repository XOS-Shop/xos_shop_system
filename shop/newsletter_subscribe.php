<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : newsletter_subscribe.php
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
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_NEWSLETTER_SUBSCRIBE) == 'overwrite_all')) :  
  if (SEND_EMAILS != 'true' || NEWSLETTER_ENABLED != 'true') {
    xos_redirect(xos_href_link(FILENAME_DEFAULT));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_NEWSLETTER_SUBSCRIBE);

  switch ($_GET['action']) {
    case 'process':
      if (isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {      
        $scy_code = false;
        if (isset($_SESSION['captcha_spam']) && $_POST['security_code'] == $_SESSION['captcha_spam']) $scy_code = true;    
        unset($_SESSION['captcha_spam']);
        $subscriber_email_address = xos_db_prepare_input($_POST['subscriber_email_address']);
        if (isset($_POST['languages'])) { 
          $language_id = xos_db_prepare_input($_POST['languages']);
        } else {    
          $language_id = $_SESSION['languages_id'];
        }   
        if (strlen($subscriber_email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
          $messageStack->add('newsletter_subscribe', ENTRY_EMAIL_ADDRESS_ERROR);      
        } elseif (!xos_validate_email($subscriber_email_address)) {
          $messageStack->add('newsletter_subscribe', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);      
        } elseif ($scy_code || isset($_SESSION['customer_id'])) { 
          $check_subscriber_query = xos_db_query("select subscriber_id, customers_id, subscriber_identity_code from " . TABLE_NEWSLETTER_SUBSCRIBERS . " where subscriber_email_address = '" . xos_db_input($subscriber_email_address) . "'");
          if (xos_db_num_rows($check_subscriber_query)) {
            $check_subscriber = xos_db_fetch_array($check_subscriber_query);
            $identity_code  = $check_subscriber['subscriber_identity_code'];         
            if ($check_subscriber['customers_id'] > 0)  {  
              $check_customer_query = xos_db_query("select customers_id, customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $check_subscriber['customers_id'] . "'");   
              $check_customer = xos_db_fetch_array($check_customer_query);
            }                    
          } else {
            $identity_code  = xos_create_random_value(12);
          }
        
          $smarty->unregisterFilter('output','smarty_outputfilter_trimwhitespace');
                   
          $smarty->assign(array('html_params' => HTML_PARAMS,
                                'xhtml_lang' => XHTML_LANG,
                                'charset' => CHARSET,
                                'store_name_address' => STORE_NAME_ADDRESS,
                                'store_name' => STORE_NAME,
                                'src_embedded_shop_logo' => 'cid:shop_logo',
                                'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . SELECTED_TPL . '/') . EMAIL_SHOP_LOGO,
                                'remote_address' => $_SERVER['REMOTE_ADDR'],
                                'link_filename_newsletter_subscribe' => xos_href_link(FILENAME_NEWSLETTER_SUBSCRIBE, 'action=subscribe&identity_code=' . $identity_code, 'SSL', false, false)));
      
          $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'newsletter_subscribe_email_html');
          $output_newsletter_subscribe_email_html = $smarty->fetch(SELECTED_TPL . '/includes/email/newsletter_subscribe_email_html.tpl');
          $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'newsletter_subscribe_email_text');  
          $output_newsletter_subscribe_email_text = $smarty->fetch(SELECTED_TPL . '/includes/email/newsletter_subscribe_email_text.tpl');
          $smarty->clearAssign(array('html_params',
                                     'xhtml_lang',
                                     'charset',
                                     'store_name_address',
                                     'store_name',
                                     'src_embedded_shop_logo',
                                     'src_shop_logo',
                                     'remote_address',
                                     'link_filename_newsletter_subscribe'));  
  
          $email_to_subscriber = new mailer((!empty($check_customer['customers_id']) ? $check_customer['customers_firstname'] . ' ' . $check_customer['customers_lastname'] : ''), $subscriber_email_address, EMAIL_NEWSLETTER_SUBSCRIBE_SUBJECT, $output_newsletter_subscribe_email_html, $output_newsletter_subscribe_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SHOP_LOGO);
    
          if(!$email_to_subscriber->send()) {
            $messageStack->add_session('newsletter_subscribe', sprintf(ERROR_PHPMAILER, $email_to_subscriber->ErrorInfo));
          } else {
            $messageStack->add_session('newsletter_subscribe', NEWSLETTER_CONFIRMATION_EMAIL_SENT, 'success');
            if (empty($check_subscriber['subscriber_id'])) {
              xos_db_query("insert into " . TABLE_NEWSLETTER_SUBSCRIBERS . " (subscriber_language_id, subscriber_email_address, subscriber_identity_code, newsletter_status, subscriber_date_added) values ('" . xos_db_input($language_id) . "', '" . xos_db_input($subscriber_email_address) . "', '" . $identity_code . "', '0', now())");
            } elseif (empty($check_customer['customers_id'])) {
              xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set subscriber_language_id = '" . xos_db_input($language_id) . "' where subscriber_id = '" . (int)$check_subscriber['subscriber_id'] . "'");
            }
          }
          xos_redirect(xos_href_link(FILENAME_NEWSLETTER_SUBSCRIBE, '', 'SSL'));
        }
      
        if (!$scy_code && !isset($_SESSION['customer_id'])) $messageStack->add('newsletter_subscribe', TEXT_SECURITY_CODE_ERROR);                  
      }
      break;
    case 'subscribe':
      $identity_code = xos_db_prepare_input($_GET['identity_code']);
      $check_subscribe_query = xos_db_query("select subscriber_id, customers_id from " . TABLE_NEWSLETTER_SUBSCRIBERS . " where subscriber_identity_code = '" . xos_db_input($identity_code) . "'");
      if (xos_db_num_rows($check_subscribe_query)) {
        $check_subscribe = xos_db_fetch_array($check_subscribe_query);
        $new_identity_code  = xos_create_random_value(12);
        xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set subscriber_identity_code = '" . $new_identity_code . "', newsletter_status = '1', newsletter_status_change = now() where subscriber_id = '" . (int)$check_subscribe['subscriber_id'] . "'");
        $successful = true;
      }    
      break;
    case 'unsubscribe':
      $identity_code = xos_db_prepare_input($_GET['identity_code']);
      $check_subscribe_query = xos_db_query("select subscriber_id, customers_id from " . TABLE_NEWSLETTER_SUBSCRIBERS . " where subscriber_identity_code = '" . xos_db_input($identity_code) . "'");
      if (xos_db_num_rows($check_subscribe_query)) {
        $check_subscribe = xos_db_fetch_array($check_subscribe_query);
        $new_identity_code  = xos_create_random_value(12);
        xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set subscriber_identity_code = '" . $new_identity_code . "', newsletter_status = '0', newsletter_status_change = now() where subscriber_id = '" . (int)$check_subscribe['subscriber_id'] . "'");
        $successful = true;
      }    
      break;
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_NEWSLETTER_SUBSCRIBE, '', 'SSL'));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  if (isset($_GET['action']) && $_GET['action'] == 'subscribe') {

    $smarty->assign(array('action' => 'subscribe',
                          'successful' => $successful,
                          'link_filename_default' => xos_href_link(FILENAME_DEFAULT)));
    
  } elseif (isset($_GET['action']) && $_GET['action'] == 'unsubscribe') {
  
    $smarty->assign(array('action' => 'unsubscribe',
                          'successful' => $successful,
                          'link_filename_default' => xos_href_link(FILENAME_DEFAULT)));
  
  } else {

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
    if ($session_started == false) {
      xos_redirect(xos_href_link(FILENAME_COOKIE_USAGE));
    }
    
    if ($messageStack->size('newsletter_subscribe') > 0) {
      if (!isset($_GET['action'])) $smarty->assign('newsletter_conf_email_sent', true); 
      $smarty->assign('message_stack', $messageStack->output('newsletter_subscribe'));
    }

    if (!isset($lng) || (isset($lng) && !is_object($lng))) {
      include(DIR_WS_CLASSES . 'language.php');
      $lng = new language;
    }

    reset($lng->catalog_languages);
  
    if (sizeof($lng->catalog_languages) > 1) {

      $lang_array = array();
      $languages_selected = '';
      while (list($key, $value) = each($lng->catalog_languages)) {
        $lang_array[] = array('id' => $value['id'],
                              'text' => $value['name']);
      
        if (!empty($language_id)) {
          $languages_selected = $language_id;                      
        } elseif ($value['id'] == $_SESSION['languages_id']) {
          $languages_selected = $value['id'];
        }                            
      }

      $smarty->assign('pull_down_menu_languages', xos_draw_pull_down_menu('languages', $lang_array, $languages_selected, 'id="newsletter_subscribe_languages"'));
    }

    $smarty->assign(array('form_begin' => xos_draw_form('newsletter_subscribe', xos_href_link(FILENAME_NEWSLETTER_SUBSCRIBE, 'action=process', 'SSL'), 'post', '', true),
                          'isset_customer_id' => isset($_SESSION['customer_id']) ? true : false,
                          'link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                          'input_field_email_address' => xos_draw_input_field('subscriber_email_address', (($subscriber_email_address) ? '' : $_GET['subscriber_email_address']), 'id="newsletter_subscribe_email_address"'),
                          'input_security_code' => xos_draw_input_field('security_code', '', 'id="newsletter_subscribe_security_code" maxlength="8"', 'text', false),
//                          'captcha_img' => '<img src="' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . '" alt="captcha" title=" captcha " style="cursor:pointer;" onclick="javascript:this.src=\'' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . (SID ? '&amp;' : '?') . '\'+Math.random();" />',
                          'captcha_img' => '<img src="' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . '" alt="captcha" title=" captcha " />',                           
                          'form_end' => '</form>'));
                        
  }                      

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'newsletter_subscribe');
  $output_newsletter_subscribe = $smarty->fetch(SELECTED_TPL . '/newsletter_subscribe.tpl');
                        
  $smarty->assign('central_contents', $output_newsletter_subscribe);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
