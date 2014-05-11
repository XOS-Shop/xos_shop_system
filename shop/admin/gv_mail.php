<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : gv_mail.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 20010 Hanspeter Zeller
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
//              Copyright (c) 2002 osCommerce
//              filename: gv_mail.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_GV_MAIL) == 'overwrite_all')) :  
  require(DIR_WS_CLASSES . 'currencies.php');  

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if ( ($action == 'send_email_to_user') && (!empty($_POST['customers_email_address']) || !empty($_POST['email_to'])) && $_POST['back'] == 'false' ) {
    switch ($_POST['customers_email_address']) {
      case '***':
        $mail_query = xos_db_query("select customers_firstname, customers_lastname, customers_email_address, customers_language_id as language_id from " . TABLE_CUSTOMERS);
        $mail_sent_to = TEXT_ALL_CUSTOMERS;
        break;
      case '**D':
        $mail_query = xos_db_query("select s.subscriber_email_address as customers_email_address, s.subscriber_language_id as language_id, c.customers_firstname, c.customers_lastname  from " . TABLE_NEWSLETTER_SUBSCRIBERS . " s left join " . TABLE_CUSTOMERS . " c on s.customers_id = c.customers_id where s.newsletter_status = '1' order by s.customers_id");
        $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
        break;
      default:
        $customers_email_address = xos_db_prepare_input($_POST['customers_email_address']);
        $mail_query = xos_db_query("select customers_firstname, customers_lastname, customers_email_address, customers_language_id as language_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . xos_db_input($customers_email_address) . "'");
        $mail_sent_to = $_POST['customers_email_address'];     
        break;
    }
    
    if (!empty($_POST['email_to'])) {
      $mail_sent_to = xos_db_prepare_input($_POST['email_to']);
    }       

    $from = xos_db_prepare_input($_POST['from']);
    $subject = xos_db_prepare_input($_POST['subject']);
    $message = xos_db_prepare_input($_POST['message']);
    $amount = xos_db_prepare_input($_POST['amount']);    
    $language_directory = xos_db_prepare_input($_POST['language_dir']);
    if (SEND_EMAILS == 'true') {
    //Let's build a message object using the mailer class
      $gv_email = new mailer();

      $address = '';
      $name = ''; 
      $pieces = explode('<', $from);
      if (count($pieces) == 2) {
        $address = trim($pieces[1], " >");      
        $name = trim($pieces[0]); 
      } elseif (count($pieces) == 1) {      
        $pos = stripos($pieces[0], '@');      
        $address = $pos ? trim($pieces[0], " >") : '';
      }   

      $gv_email->From = $address;
      $gv_email->FromName = $name;
      $gv_email->WordWrap = '100';
      $gv_email->Subject = $subject;

      $smarty_gv_email = new Smarty();
      $smarty_gv_email->template_dir = DIR_FS_SMARTY . 'catalog/templates/';
      $smarty_gv_email->compile_dir = DIR_FS_SMARTY . 'catalog/templates_c/';
      $smarty_gv_email->config_dir = DIR_FS_SMARTY . 'catalog/';
      $smarty_gv_email->cache_dir = DIR_FS_SMARTY . 'catalog/cache/';             
      $smarty_gv_email->left_delimiter = '[@{';
      $smarty_gv_email->right_delimiter = '}@]';

      $mailer_error = false;
      if (!empty($_POST['email_to'])) { 
      
        $id1 = create_coupon_code($mail_sent_to);
      
        $languages_query = xos_db_query("select languages_id, code, directory from " . TABLE_LANGUAGES . " where use_in_id > '1' and directory = '" . $language_directory . "'");  
        if (!xos_db_num_rows($languages_query)) {
          $lang_query = xos_db_query("select languages_id, code, directory from " . TABLE_LANGUAGES . " where code = '" . xos_db_input(DEFAULT_LANGUAGE) . "'");
          $languages = xos_db_fetch_array($lang_query);
        } else {
          $languages = xos_db_fetch_array($languages_query);
        }
        
        $used_lang_id = $_SESSION['used_lng_id'];
        $_SESSION['used_lng_id'] = $languages['languages_id'];
        $currencies = new currencies();      

        if (EMAIL_USE_HTML == 'true') {
      
          $smarty_gv_email->assign(array('html_params' => HTML_PARAMS,
                                         'xhtml_lang' => $languages['code'],
                                         'charset' => CHARSET,
                                         'store_name_address' => STORE_NAME_ADDRESS,
                                         'store_name' => STORE_NAME,
                                         'src_embedded_shop_logo' => 'cid:shop_logo',
                                         'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG_IMAGES . 'email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . DEFAULT_TPL . '/') . EMAIL_SHOP_LOGO,
                                         'gv_message' => $message,
                                         'gv_id' => $id1,
                                         'gv_amount' => $currencies->format($amount), 
                                         'link_shop' => xos_catalog_href_link(),                                                             
                                         'link_gv_redeem' => xos_catalog_href_link(FILENAME_CATALOG_GV_REDEEM, 'gv_no=' . $id1, 'SSL')));
      
          $smarty_gv_email->configLoad('languages/' . $languages['directory'] . '_email.conf', 'gv_email_html');
          $output_gv_email_html = $smarty_gv_email->fetch(DEFAULT_TPL . '/includes/email/gv_email_html.tpl');

          $smarty_gv_email->configLoad('languages/' . $languages['directory'] . '_email.conf', 'gv_email_text');  
          $output_gv_email_text = $smarty_gv_email->fetch(DEFAULT_TPL . '/includes/email/gv_email_text.tpl');
        
          $gv_email->isHTML(true);
          $gv_email->Body = $output_gv_email_html;        
          $gv_email->AltBody = $output_gv_email_text;
          $gv_email->addEmbeddedImage(DIR_FS_CATALOG . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'images/email_shop_logo/' : 'images/catalog/templates/' . DEFAULT_TPL . '/') . EMAIL_SHOP_LOGO, 'shop_logo', '', 'base64', 'image/' . substr(strrchr(EMAIL_SHOP_LOGO, '.'), 1)); 
      
        } else {
        
          $smarty_gv_email->assign(array('store_name_address' => STORE_NAME_ADDRESS,
                                         'store_name' => STORE_NAME,
                                         'gv_message' => $message,
                                         'gv_id' => $id1,
                                         'gv_amount' => $currencies->format($amount),
                                         'link_shop' => xos_catalog_href_link(),
                                         'link_gv_redeem' => xos_catalog_href_link(FILENAME_CATALOG_GV_REDEEM, 'gv_no=' . $id1, 'SSL')));        
      
          $smarty_gv_email->configLoad('languages/' . $languages['directory'] . '_email.conf', 'gv_email_text');  
          $output_gv_email_text = $smarty_gv_email->fetch(DEFAULT_TPL . '/includes/email/gv_email_text.tpl');
        
          $gv_email->isHTML(false);
          $gv_email->Body = $output_gv_email_text;         
      
        }
            
        $gv_email->addAddress($mail_sent_to);
        
        if(!$gv_email->send()) {
          $mailer_error = true;
          $messageStack->add_session('header', sprintf(ERROR_PHP_MAILER, $gv_email->ErrorInfo, $mail_sent_to), 'error');
        } else {  
          // Now create the coupon email entry
          xos_db_query("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $id1 . "', 'G', '" . $amount . "', now())");
          $insert_id = xos_db_insert_id();
          xos_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $mail_sent_to . "', now() )"); 
        }
        
        $_SESSION['used_lng_id'] = $used_lang_id;
        
      } else {
      
        $used_lang_id = $_SESSION['used_lng_id'];
                  
        while ($mail = xos_db_fetch_array($mail_query)) {
        
          $id1 = create_coupon_code($mail['customers_email_address']);
        
          $languages_query = xos_db_query("select languages_id, code, directory from " . TABLE_LANGUAGES . " where use_in_id > '1' and languages_id = '" . $mail['language_id'] . "'");  
          if (!xos_db_num_rows($languages_query)) {
            $lang_query = xos_db_query("select languages_id, code, directory from " . TABLE_LANGUAGES . " where code = '" . xos_db_input(DEFAULT_LANGUAGE) . "'");
            $languages = xos_db_fetch_array($lang_query);
          } else {
            $languages = xos_db_fetch_array($languages_query);
          }
                    
          $_SESSION['used_lng_id'] = $languages['languages_id'];
          $currencies = new currencies();      

          if (EMAIL_USE_HTML == 'true') {
      
            $smarty_gv_email->assign(array('html_params' => HTML_PARAMS,
                                           'xhtml_lang' => $languages['code'],
                                           'charset' => CHARSET,
                                           'store_name_address' => STORE_NAME_ADDRESS,
                                           'store_name' => STORE_NAME,
                                           'src_embedded_shop_logo' => 'cid:shop_logo',
                                           'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG_IMAGES . 'email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . DEFAULT_TPL . '/') . EMAIL_SHOP_LOGO,
                                           'gv_message' => $message,
                                           'gv_id' => $id1,
                                           'gv_amount' => $currencies->format($amount),
                                           'link_shop' => xos_catalog_href_link(),
                                           'link_gv_redeem' => xos_catalog_href_link(FILENAME_CATALOG_GV_REDEEM, 'gv_no=' . $id1, 'SSL')));
      
            $smarty_gv_email->configLoad('languages/' . $languages['directory'] . '_email.conf', 'gv_email_html');
            $output_gv_email_html = $smarty_gv_email->fetch(DEFAULT_TPL . '/includes/email/gv_email_html.tpl');

            $smarty_gv_email->configLoad('languages/' . $languages['directory'] . '_email.conf', 'gv_email_text');  
            $output_gv_email_text = $smarty_gv_email->fetch(DEFAULT_TPL . '/includes/email/gv_email_text.tpl');
 
            $gv_email->isHTML(true);
            $gv_email->Body = $output_gv_email_html;        
            $gv_email->AltBody = $output_gv_email_text;
            $gv_email->addEmbeddedImage(DIR_FS_CATALOG . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'images/email_shop_logo/' : 'images/catalog/templates/' . DEFAULT_TPL . '/') . EMAIL_SHOP_LOGO, 'shop_logo', '', 'base64', 'image/' . substr(strrchr(EMAIL_SHOP_LOGO, '.'), 1)); 
      
          } else {
          
            $smarty_gv_email->assign(array('store_name_address' => STORE_NAME_ADDRESS,
                                           'store_name' => STORE_NAME,
                                           'gv_message' => $message,
                                           'gv_id' => $id1,
                                           'gv_amount' => $currencies->format($amount),
                                           'link_shop' => xos_catalog_href_link(),
                                           'link_gv_redeem' => xos_catalog_href_link(FILENAME_CATALOG_GV_REDEEM, 'gv_no=' . $id1, 'SSL')));           
      
            $smarty_gv_email->configLoad('languages/' . $languages['directory'] . '_email.conf', 'gv_email_text');  
            $output_gv_email_text = $smarty_gv_email->fetch(DEFAULT_TPL . '/includes/email/gv_email_text.tpl');
        
            $gv_email->isHTML(false);
            $gv_email->Body = $output_gv_email_text;         
      
          }        
                       
          $gv_email->addAddress($mail['customers_email_address'], $mail['customers_firstname'] . ' ' . $mail['customers_lastname']);
        
          if(!$gv_email->send()) {
            $mailer_error = true;
            $messageStack->add_session('header', sprintf(ERROR_PHP_MAILER, $gv_email->ErrorInfo, $mail['customers_email_address']), 'error');
          } else {  
            // Now create the coupon email entry
            xos_db_query("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $id1 . "', 'G', '" . $amount . "', now())");
            $insert_id = xos_db_insert_id();
            xos_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $mail['customers_email_address'] . "', now() )"); 
          }
      
          $gv_email->clearAddresses();
        }
        
        $_SESSION['used_lng_id'] = $used_lang_id;
        
      }                         
            
      if ($mailer_error == false) {
        $messageStack->add_session('header', sprintf(NOTICE_EMAIL_SENT_TO, $mail_sent_to), 'success');
      }  

      xos_redirect(xos_href_link(FILENAME_GV_MAIL));
    }    
  }

  $email_error = false;
  $entry_email_to_error = false;
  $entry_email_to_check_error = false;
    
  if ( ($action == 'preview') && !empty($_POST['email_to']) ) {  
  
    $email_to = xos_db_prepare_input($_POST['email_to']);
  
    if (strlen($email_to) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $email_error = true;
      $entry_email_to_error = true;
    }

    if (!xos_validate_email($email_to)) {
      $email_error = true;
      $entry_email_to_check_error = true;
    }
  }    
  
  if ( ($action == 'preview') && empty($_POST['customers_email_address']) && empty($_POST['email_to']) ) {
    $messageStack->add('header', ERROR_NO_CUSTOMER_SELECTED, 'error');
  }       
  
  if ( ($action == 'preview') && ($_POST['amount'] == '') ) {
    $messageStack->add('header', ERROR_NO_AMOUNT_SELECTED, 'error');
  }
  
  if ( ($action == 'preview') && !($_POST['amount'] == '')  && !is_numeric($_POST['amount']) ) {
    $messageStack->add('header', ERROR_AMOUNT_MUST_BE_A_NUMBER, 'error');
  }    

  $javascript = ''; 
  
  if ( !(($action == 'preview') && !$email_error && !($_POST['amount'] == '') && is_numeric($_POST['amount']) && (!empty($_POST['customers_email_address']) || !empty($_POST['email_to']))) ) {
  
    $javascript .= '<script type="text/javascript">' . "\n" .    
                   '/* <![CDATA[ */' . "\n\n" .
                   
                   'function check_email_to() {' . "\n" .
                   '  var error = 0;' . "\n" .
                   '  var error_message = "' . JS_ERROR . '";' . "\n" .  
                   '  var email_to = document.mail.email_to.value;' . "\n\n" .

                   '  if (email_to != "" && email_to.length < ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ') {' . "\n" .
                   '    error_message = error_message + "' . JS_EMAIL_ADDRESS . '";' . "\n" .
                   '    error = 1;' . "\n" .
                   '  }' . "\n\n" .

                   '  if (error == 1) {' . "\n" .
                   '    alert(error_message);' . "\n" .
                   '    return false;' . "\n" .
                   '  } else {' . "\n" .
                   '    return true;' . "\n" .
                   '  }' . "\n" .                 
                   '}' . "\n\n" .
                   
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n";
  }  

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');

  if ( ($action == 'preview') && !$email_error && !($_POST['amount'] == '') && is_numeric($_POST['amount']) && (!empty($_POST['customers_email_address']) || !empty($_POST['email_to'])) ) {
    switch ($_POST['customers_email_address']) {
      case '***':
        $mail_sent_to = TEXT_ALL_CUSTOMERS;
        break;
      case '**D':
        $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
        break;
      default:
        $mail_sent_to = $_POST['customers_email_address'];     
        break;
    }
    
    if (!empty($_POST['email_to'])) {
      $mail_sent_to = $_POST['email_to'];
    }       
    
    /* Re-Post all POST'ed variables */
    reset($_POST);
    $hidden_fields = '';
    while (list($key, $value) = each($_POST)) {
      if (!is_array($_POST[$key])) {
        $hidden_fields .= xos_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
      }
    }
    
    $hidden_fields .= xos_draw_hidden_field('back', 'false');

    $currencies = new currencies();
    
    $smarty->assign(array('action_preview' => true,
                          'form_begin_action_send_email_to_user' => xos_draw_form('mail', FILENAME_GV_MAIL, 'action=send_email_to_user'),
                          'to' => $mail_sent_to,
                          'from' => htmlspecialchars(stripslashes($_POST['from'])),
                          'subject' => htmlspecialchars(stripslashes($_POST['subject'])),
                          'amount' => htmlspecialchars(stripslashes($currencies->format($_POST['amount']))),
                          'message' => nl2br(htmlspecialchars(stripslashes($_POST['message']))),
                          'link_filename_gv_mail' => xos_href_link(FILENAME_GV_MAIL),
                          'form_end' => '</form>',
                          'hidden_fields' => $hidden_fields));
    
  } else {
  
    $customers_email_address = $_POST['customers_email_address'];
    $email_to = $_POST['email_to'];
    $from = $_POST['from'];
    $language_dir = $_POST['language_dir'];
    $subject = $_POST['subject'];
    $amount = $_POST['amount'];
    $message = $_POST['message'];  

    $customers = array();
    $customers[] = array('id' => '', 'text' => TEXT_SELECT_CUSTOMER);
    $customers[] = array('id' => '***', 'text' => TEXT_ALL_CUSTOMERS);
    $customers[] = array('id' => '**D', 'text' => TEXT_NEWSLETTER_CUSTOMERS);
    $mail_query = xos_db_query("select customers_email_address, customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " order by customers_lastname");
    while($customers_values = xos_db_fetch_array($mail_query)) {
      $customers[] = array('id' => $customers_values['customers_email_address'],
                           'text' => $customers_values['customers_lastname'] . ', ' . $customers_values['customers_firstname'] . ' (' . $customers_values['customers_email_address'] . ')');
    }
    
    $languages = xos_get_languages();  
    if (sizeof($languages) > 1) {       
      $language_dir_selected = '';                          
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        if ($languages[$i]['id'] == $_SESSION['used_lng_id']) $language_dir_selected = $languages[$i]['directory'];       
        $lang_array[] = array('id' => $languages[$i]['directory'],
                              'text' => $languages[$i]['name']);        
      }
      $smarty->assign(array('languages' => true,
                            'pull_down_languages' => xos_draw_pull_down_menu('language_dir', $lang_array, ($language_dir ? $language_dir : $language_dir_selected))));        
    } else {
      $smarty->assign('hidden_field_language_dir', xos_draw_hidden_field('language_dir', $languages[0]['directory']));
    }
      
    $smarty->assign(array('form_begin_action_preview' => xos_draw_form('mail', FILENAME_GV_MAIL, 'action=preview', 'post', 'onsubmit="return check_email_to();"'),
                          'pull_down_customers_email_address' => xos_draw_pull_down_menu('customers_email_address', $customers, (isset($_GET['customer']) ? $_GET['customer'] : '')),
                          'input_email_to' => xos_draw_input_field('email_to', '', 'onkeyup="updateLanguage()"') . (($entry_email_to_error == true) ? '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR : (($entry_email_to_check_error) ? '&nbsp;' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR : '&nbsp;' . TEXT_SINGLE_EMAIL)),
                          'input_from' => xos_draw_input_field('from', EMAIL_FROM),
                          'input_subject' => xos_draw_input_field('subject'),
                          'input_amount' => xos_draw_input_field('amount'),
                          'textarea_message' => xos_draw_textarea_field('message', '60', '15'),
                          'form_end' => '</form>'));

  }

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'gv_mail');
  $output_gv_mail = $smarty->fetch(ADMIN_TPL . '/gv_mail.tpl');
  
  $smarty->assign('central_contents', $output_gv_mail);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>