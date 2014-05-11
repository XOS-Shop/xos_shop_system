<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : password_forgotten.php
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
//              filename: password_forgotten.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_PASSWORD_FORGOTTEN) == 'overwrite_all')) : 
  if (SEND_EMAILS != 'true') {
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    xos_redirect(xos_href_link(FILENAME_COOKIE_USAGE));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_PASSWORD_FORGOTTEN);

  if (isset($_GET['action']) && ($_GET['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    $email_address = xos_db_prepare_input($_POST['email_address']);
    $error = false;
    
    if (!isset($_SESSION['captcha_spam']) || $_POST['security_code'] != $_SESSION['captcha_spam']) {
      $error = true;

      $messageStack->add('password_forgotten', TEXT_SECURITY_CODE_ERROR);    
    }
    unset($_SESSION['captcha_spam']); 
    
    $actionRecorder = new actionRecorder('ar_reset_password', null, $email_address);
    if (!$actionRecorder->canPerform() && $actionRecorder->check()) {
      $error = true;

      $actionRecorder->record(false);
      
      $messageStack->add('password_forgotten', sprintf(ERROR_ACTION_RECORDER, (defined('MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES') ? (int)MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES : 5)));
    }     
    
    $check_customer_query = xos_db_query("select customers_firstname, customers_lastname, customers_email_address, customers_password, customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . xos_db_input($email_address) . "'");
    if (xos_db_num_rows($check_customer_query) && $error == false) {
      $check_customer = xos_db_fetch_array($check_customer_query);
                      
      $new_password = xos_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
      $crypted_password = xos_encrypt_password($new_password);
      
      $smarty->unregisterFilter('output','smarty_outputfilter_trimwhitespace');
      
      $smarty->assign(array('html_params' => HTML_PARAMS,
                            'xhtml_lang' => XHTML_LANG,
                            'charset' => CHARSET,
                            'store_name_address' => STORE_NAME_ADDRESS,
                            'store_name' => STORE_NAME,
                            'src_embedded_shop_logo' => 'cid:shop_logo',
                            'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . SELECTED_TPL . '/') . EMAIL_SHOP_LOGO,
                            'remote_address' => $_SERVER['REMOTE_ADDR'],
                            'new_password' => $new_password));
      
      $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'password_forgotten_email_html');
      $output_password_forgotten_email_html = $smarty->fetch(SELECTED_TPL . '/includes/email/password_forgotten_email_html.tpl');
      $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'password_forgotten_email_text');  
      $output_password_forgotten_email_text = $smarty->fetch(SELECTED_TPL . '/includes/email/password_forgotten_email_text.tpl');
      $smarty->clearAssign(array('html_params',
                                  'xhtml_lang',
                                  'charset',
                                  'store_name_address',
                                  'store_name',
                                  'src_embedded_shop_logo',
                                  'src_shop_logo',
                                  'remote_address',
                                  'new_password'));  
  
      $email_to_customer = new mailer($check_customer['customers_firstname'] . ' ' . $check_customer['customers_lastname'], $check_customer['customers_email_address'], EMAIL_PASSWORD_REMINDER_SUBJECT, $output_password_forgotten_email_html, $output_password_forgotten_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SHOP_LOGO);
      
      if(!$email_to_customer->send()) {
        $messageStack->add_session('login', sprintf(ERROR_PHPMAILER, $email_to_customer->ErrorInfo));
      } else {
        $actionRecorder->_user_id = $check_customer['customers_id'];
        $actionRecorder->record();
        $messageStack->add_session('login', SUCCESS_PASSWORD_SENT, 'success');
        xos_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . xos_db_input($crypted_password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");
      }
      
      $_SESSION['navigation']->remove_current_page();
      xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
    } elseif (!xos_db_num_rows($check_customer_query)) {
      $messageStack->add('password_forgotten', TEXT_NO_EMAIL_ADDRESS_FOUND);      
    }   
  }

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  if ($messageStack->size('password_forgotten') > 0) {
    $smarty->assign('message_stack', $messageStack->output('password_forgotten'));
  }

  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';        
    $back_link = xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']);
  } else {
    $back_link = 'javascript:history.go(-1)';
  }

  $smarty->assign(array('form_begin' => xos_draw_form('password_forgotten', xos_href_link(FILENAME_PASSWORD_FORGOTTEN, 'action=process', 'SSL'), 'post', '', true),
                        'input_field_email_address' => xos_draw_input_field('email_address', '', 'id="password_forgotten_email_address"'),
                        'input_security_code' => xos_draw_input_field('security_code', '', 'id="password_forgotten_security_code" maxlength="8"', 'text', false),
//                        'captcha_img' => '<img src="' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . '" alt="captcha" title=" captcha " style="cursor:pointer;" onclick="javascript:this.src=\'' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . (SID ? '&amp;' : '?') . '\'+Math.random();" />',
                        'captcha_img' => '<img src="' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . '" alt="captcha" title=" captcha " />',                        
                        'link_back' => $back_link,
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'password_forgotten');
  $output_password_forgotten = $smarty->fetch(SELECTED_TPL . '/password_forgotten.tpl');
                        
  $smarty->assign('central_contents', $output_password_forgotten);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
