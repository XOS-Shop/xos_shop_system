<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : contact_us.php
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
//              filename: contact_us.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CONTACT_US) == 'overwrite_all')) : 
  if (SEND_EMAILS != 'true') {
    xos_redirect(xos_href_link(FILENAME_DEFAULT), false);
  }  

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    xos_redirect(xos_href_link(FILENAME_COOKIE_USAGE));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CONTACT_US);

  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
    $name = xos_db_prepare_input($_POST['name']);
    $email_address = xos_db_prepare_input($_POST['email_address']);
    $enquiry = xos_db_prepare_input(urldecode($_POST['enquiry']));
    
    $error = false;

    if (!isset($_SESSION['customer_id'])) {
      if (!isset($_SESSION['captcha_spam']) || $_POST['security_code'] != $_SESSION['captcha_spam']) {
        $error = true;

        $messageStack->add('contact', TEXT_SECURITY_CODE_ERROR);    
      }
        
      unset($_SESSION['captcha_spam']);
    }
    
    if (!xos_validate_email($email_address)) {
      $error = true;
      
      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
    
    $actionRecorder = new actionRecorder('ar_contact_us', (isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null), $name);
    if (!$actionRecorder->canPerform() && $actionRecorder->check()) {
      $error = true;

      $actionRecorder->record(false);

      $messageStack->add('contact', sprintf(ERROR_ACTION_RECORDER, (defined('MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES') ? (int)MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES : 15)));
    }      
      
    if ($error == false) {
    
      $smarty->unregisterFilter('output','smarty_outputfilter_trimwhitespace');
    
      $smarty->assign(array('html_params' => HTML_PARAMS,
                            'xhtml_lang' => XHTML_LANG,
                            'charset' => CHARSET,
                            'store_name_address' => STORE_NAME_ADDRESS,
                            'store_name' => STORE_NAME,
                            'src_embedded_shop_logo' => 'cid:shop_logo',
                            'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . SELECTED_TPL . '/') . EMAIL_SHOP_LOGO,
                            'enquiry_text' => $enquiry));
      
      $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'contact_us_email_html');
      $output_contact_us_email_html = $smarty->fetch(SELECTED_TPL . '/includes/email/contact_us_email_html.tpl');
      $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'contact_us_email_text');  
      $output_contact_us_email_text = $smarty->fetch(SELECTED_TPL . '/includes/email/contact_us_email_text.tpl');
      $smarty->clearAssign(array('html_params',
                                  'xhtml_lang',
                                  'charset',
                                  'store_name_address',
                                  'store_name',
                                  'src_embedded_shop_logo',
                                  'src_shop_logo',
                                  'enquiry_text'));  
  
      $email_to_store_owner = new mailer(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $output_contact_us_email_html, $output_contact_us_email_text, $name, $email_address, EMAIL_SHOP_LOGO);
              
      if(!$email_to_store_owner->send()) {
        $messageStack->add('contact', sprintf(ERROR_PHPMAILER, $email_to_store_owner->ErrorInfo));
      } else {
        $actionRecorder->record();
        xos_redirect(xos_href_link(FILENAME_CONTACT_US, 'action=success'));
      }
    }    
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_CONTACT_US));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($messageStack->size('contact') > 0) {
    $smarty->assign('message_stack', $messageStack->output('contact'));
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
    $smarty->assign('sent', true);
  }

  $smarty->assign(array('form_begin' => xos_draw_form('contact_us', xos_href_link(FILENAME_CONTACT_US, 'action=send', 'SSL')),
                        'isset_customer_id' => isset($_SESSION['customer_id']) ? true : false,
                        'input_field_name' => xos_draw_input_field('name', '', 'id="contact_us_name"'),
                        'input_field_email' => xos_draw_input_field('email_address', '', 'id="contact_us_email_address"'),
                        'input_security_code' => xos_draw_input_field('security_code', '', 'id="contact_us_security_code" maxlength="8"', 'text', false),
//                        'captcha_img' => '<img src="' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . '" alt="captcha" title=" captcha " style="cursor:pointer;" onclick="javascript:this.src=\'' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . (SID ? '&amp;' : '?') . '\'+Math.random();" />',
                        'captcha_img' => '<img src="' . xos_href_link(FILENAME_CAPTCHA, '', 'SSL') . '" alt="captcha" title=" captcha " />',                          
                        'link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'textarea' => xos_draw_textarea_field('enquiry', '50', '15', '', 'id="contact_us_enquiry"'),
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'contact_us');
  $output_contact_us = $smarty->fetch(SELECTED_TPL . '/contact_us.tpl');
                        
  $smarty->assign('central_contents', $output_contact_us);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
