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

  require(DIR_FS_DOCUMENT_ROOT . FILENAME_CAPTCHA);

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_NEWSLETTER_SUBSCRIBE);

  switch ($_GET['action']) {
    case 'process':
      if (isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
        $error = false;      
        $scy_code = false;
        if (isset($_POST['process_id']) && $_POST['security_code'] == str_decrypt($_POST['process_id'])) $scy_code = true;    
        $subscriber_email_address = $_POST['subscriber_email_address'];
        if (isset($_POST['languages'])) { 
          $language_id = $_POST['languages'];
        } else {    
          $language_id = $_SESSION['languages_id'];
        }   
        if (strlen($subscriber_email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
          $error = true;
          $messageStack->add('newsletter_subscribe', ENTRY_EMAIL_ADDRESS_ERROR);
          $smarty->assign('error_email_address', true);      
        } elseif (!xos_validate_email($subscriber_email_address)) {
          $error = true;
          $messageStack->add('newsletter_subscribe', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
          $smarty->assign('error_email_address', true);      
        } elseif ($scy_code || isset($_SESSION['customer_id'])) { 
          $check_subscriber_query = $DB->prepare
          (
          "SELECT subscriber_id,
                   customers_id,
                   subscriber_identity_code
            FROM   " . TABLE_NEWSLETTER_SUBSCRIBERS . "
            WHERE  subscriber_email_address = :subscriber_email_address"
          );
          
          $DB->perform($check_subscriber_query, array(':subscriber_email_address' => $subscriber_email_address));
          
          if ($check_subscriber_query->rowCount()) {
            $check_subscriber = $check_subscriber_query->fetch();
            $identity_code  = $check_subscriber['subscriber_identity_code'];         
            if ($check_subscriber['customers_id'] > 0)  {  
              $check_customer_query = $DB->prepare
              (
               "SELECT customers_id,
                       customers_firstname,
                       customers_lastname
                FROM   " . TABLE_CUSTOMERS . "
                WHERE  customers_id = :customers_id"
              ); 
              
              $DB->perform($check_customer_query, array(':customers_id' => $check_subscriber['customers_id']));
                
              $check_customer = $check_customer_query->fetch();
            }                    
          } else {
            $identity_code  = xos_create_random_value(12);
          }
        
          $smarty->unregisterFilter('output','smarty_outputfilter_trimwhitespace');
                   
          $smarty->assign(array('html_params' => HTML_PARAMS,
                                'html_lang' => HTML_LANG,
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
                                     'html_lang',
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
              $insert_newsletter_subscribers_query = $DB->prepare
              (
               "INSERT INTO " . TABLE_NEWSLETTER_SUBSCRIBERS . "
                            (
                            subscriber_language_id,
                            subscriber_email_address,
                            subscriber_identity_code,
                            newsletter_status,
                            subscriber_date_added
                            )
                            VALUES 
                            (
                            :language_id,
                            :subscriber_email_address,
                            :identity_code,
                            '0',
                            Now()
                            )"
              );
              
              $DB->perform($insert_newsletter_subscribers_query, array(':language_id' => (int)$language_id,
                                                                       ':subscriber_email_address' => $subscriber_email_address,
                                                                       ':identity_code' => $identity_code));
                                                                               
            } elseif (empty($check_customer['customers_id'])) {
              $update_newsletter_subscribers_query = $DB->prepare
              (
               "UPDATE " . TABLE_NEWSLETTER_SUBSCRIBERS . "
                SET    subscriber_language_id = :language_id
                WHERE  subscriber_id = :subscriber_id"
              );
              
              $DB->perform($update_newsletter_subscribers_query, array(':language_id' => (int)$language_id,
                                                                       ':subscriber_id' => (int)$check_subscriber['subscriber_id']));
                                                                                 
            }
          }
          xos_redirect(xos_href_link(FILENAME_NEWSLETTER_SUBSCRIBE, '', 'SSL'));
        }
      
        if (!$scy_code && !isset($_SESSION['customer_id'])) {
          $error = true;
          $messageStack->add('newsletter_subscribe', TEXT_SECURITY_CODE_ERROR);
        }
        
        if ($error == true) $smarty->assign('error_security_code', true);                    
      }
      break;
    case 'subscribe':
      $identity_code = $_GET['identity_code'];
      $check_subscribe_query = $DB->prepare
      (
       "SELECT subscriber_id,
               customers_id
        FROM   " . TABLE_NEWSLETTER_SUBSCRIBERS . "
        WHERE  subscriber_identity_code = :identity_code"
      );
    
      $DB->perform($check_subscribe_query, array(':identity_code' => $identity_code));
      
      if ($check_subscribe_query->rowCount()) {
        $check_subscribe = $check_subscribe_query->fetch();
        $new_identity_code  = xos_create_random_value(12);
        $update_newsletter_subscribers_query = $DB->prepare
        (
         "UPDATE " . TABLE_NEWSLETTER_SUBSCRIBERS . "
          SET    subscriber_identity_code = :new_identity_code,
                 newsletter_status = '1',
                 newsletter_status_change = Now()
          WHERE  subscriber_id = :subscriber_id"
        );
        
        $DB->perform($update_newsletter_subscribers_query, array(':new_identity_code' => $new_identity_code,
                                                                 ':subscriber_id' => (int)$check_subscribe['subscriber_id']));        
        $successful = true;
      }    
      break;
    case 'unsubscribe':
      $identity_code = $_GET['identity_code'];
      $check_subscribe_query = $DB->prepare
      (
       "SELECT subscriber_id,
               customers_id
        FROM   " . TABLE_NEWSLETTER_SUBSCRIBERS . "
        WHERE  subscriber_identity_code = :identity_code"
      );
      
      $DB->perform($check_subscribe_query, array(':identity_code' => $identity_code));
      
      if ($check_subscribe_query->rowCount()) {
        $check_subscribe = $check_subscribe_query->fetch();
        $new_identity_code  = xos_create_random_value(12);
        
        $update_newsletter_subscribers_query = $DB->prepare
        (
         "UPDATE " . TABLE_NEWSLETTER_SUBSCRIBERS . "
          SET    subscriber_identity_code = :new_identity_code,
                 newsletter_status = '0',
                 newsletter_status_change = Now()
          WHERE  subscriber_id = :subscriber_id"
        );
        
        $DB->perform($update_newsletter_subscribers_query, array(':new_identity_code' => $new_identity_code,
                                                                 ':subscriber_id' =>(int)$check_subscribe['subscriber_id'] )); 
                                                                       
        $successful = true;
      }    
      break;
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_NEWSLETTER_SUBSCRIBE, '', 'SSL'));
  
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
      $smarty->assign('message_stack_error', $messageStack->output('newsletter_subscribe', 'error'));
      $smarty->assign('message_stack_warning', $messageStack->output('newsletter_subscribe', 'warning')); 
      $smarty->assign('message_stack_success', $messageStack->output('newsletter_subscribe', 'success'));      
    }

    reset($lng->catalog_languages);
  
    if (sizeof($lng->catalog_languages) > 1) {

      $lang_array = array();
      $languages_selected = '';
      foreach($lng->catalog_languages as $key => $value) {
        $lang_array[] = array('id' => $value['id'],
                              'text' => $value['name']);
      
        if (!empty($language_id)) {
          $languages_selected = $language_id;                      
        } elseif ($value['id'] == $_SESSION['languages_id']) {
          $languages_selected = $value['id'];
        }                            
      }

      $smarty->assign('pull_down_menu_languages', xos_draw_pull_down_menu('languages', $lang_array, $languages_selected, 'class="form-control" id="newsletter_subscribe_languages"'));
    }

    $smarty->assign(array('form_begin' => xos_draw_form('newsletter_subscribe', xos_href_link(FILENAME_NEWSLETTER_SUBSCRIBE, 'action=process', 'SSL'), 'post', '', true) . xos_draw_hidden_field('process_id', str_encrypt($captcha_text)),
                          'isset_customer_id' => isset($_SESSION['customer_id']) ? true : false,
                          'link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                          'input_field_email_address' => xos_draw_input_field('subscriber_email_address', (($subscriber_email_address) ? '' : $_GET['subscriber_email_address']), 'class="form-control" id="newsletter_subscribe_email_address"'),
                          'input_security_code' => xos_draw_input_field('security_code', '', 'class="form-control" id="newsletter_subscribe_security_code" maxlength="8" autocomplete="off"', 'text', false),
                          'captcha_img' => '<img src="' . $src_captcha_base64 . '" alt="captcha" title=" captcha " />',                           
                          'form_end' => '</form>'));
                        
  }                      

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'newsletter_subscribe');
  $output_newsletter_subscribe = $smarty->fetch(SELECTED_TPL . '/newsletter_subscribe.tpl');
                        
  $smarty->assign('central_contents', $output_newsletter_subscribe);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;