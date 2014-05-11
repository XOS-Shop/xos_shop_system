<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : mail.php
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
//              filename: mail.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_MAIL) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if ( ($action == 'send_email_to_user') && !empty($_POST['customers_email_address']) && $_POST['back'] == 'false' ) {
    switch ($_POST['customers_email_address']) {
      case '***':
        $mail_query = xos_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS);
        $mail_sent_to = TEXT_ALL_CUSTOMERS;
        break;
      case '**D':
        $mail_query = xos_db_query("select s.subscriber_email_address as customers_email_address, c.customers_firstname, c.customers_lastname  from " . TABLE_NEWSLETTER_SUBSCRIBERS . " s left join " . TABLE_CUSTOMERS . " c on s.customers_id = c.customers_id where s.newsletter_status = '1' order by s.customers_id");
        $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
        break;
      default:
        $customers_email_address = xos_db_prepare_input($_POST['customers_email_address']);

        $mail_query = xos_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . xos_db_input($customers_email_address) . "'");
        $mail_sent_to = $_POST['customers_email_address'];
        break;
    }

    $from = xos_db_prepare_input($_POST['from']);
    $subject = xos_db_prepare_input($_POST['subject']);
    $message = xos_db_prepare_input($_POST['message']);
    if (SEND_EMAILS == 'true') {
    //Let's build a message object using the mailer class
      $email_to_customer = new mailer();

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

      $email_to_customer->From = $address;
      $email_to_customer->FromName = $name;
//      $email_to_customer->WordWrap = '';
      $email_to_customer->Subject = $subject;
      
      $email_to_customer->isHTML(false);
      $email_to_customer->Body = strip_tags($message);
      
      $mailer_error = false;
      while ($mail = xos_db_fetch_array($mail_query)) {
        $email_to_customer->addAddress($mail['customers_email_address'], $mail['customers_firstname'] . ' ' . $mail['customers_lastname']);
        
        if(!$email_to_customer->send()) {
          $mailer_error = true;
          $messageStack->add_session('header', sprintf(ERROR_PHP_MAILER, $email_to_customer->ErrorInfo, $mail['customers_email_address']), 'error');
        }
      
        $email_to_customer->clearAddresses();
      }
      
      if ($mailer_error == false) {
        $messageStack->add_session('header', sprintf(NOTICE_EMAIL_SENT_TO, $mail_sent_to), 'success');
      }  

      xos_redirect(xos_href_link(FILENAME_MAIL));
    }    
  }

  if ( ($action == 'preview') && empty($_POST['customers_email_address']) ) {
    $messageStack->add('header', ERROR_NO_CUSTOMER_SELECTED, 'error');
  }

  $javascript = '';

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');

  if ( ($action == 'preview') && !empty($_POST['customers_email_address']) ) {
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
    
    /* Re-Post all POST'ed variables */
    reset($_POST);
    $hidden_fields = '';
    while (list($key, $value) = each($_POST)) {
      if (!is_array($_POST[$key])) {
        $hidden_fields .= xos_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
      }
    }
    
    $hidden_fields .= xos_draw_hidden_field('back', 'false');

    $smarty->assign(array('action_preview' => true,
                          'form_begin_action_send_email_to_user' => xos_draw_form('mail', FILENAME_MAIL, 'action=send_email_to_user'),
                          'to' => $mail_sent_to,
                          'from' => htmlspecialchars(stripslashes($_POST['from'])),
                          'subject' => htmlspecialchars(stripslashes($_POST['subject'])),
                          'message' => nl2br(htmlspecialchars(stripslashes($_POST['message']))),
                          'link_filename_mail' => xos_href_link(FILENAME_MAIL),
                          'form_end' => '</form>',
                          'hidden_fields' => $hidden_fields));
    
  } else {
  
    $customers_email_address = $_POST['customers_email_address'];
    $from = $_POST['from'];
    $subject = $_POST['subject'];
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
    
    $smarty->assign(array('form_begin_action_preview' => xos_draw_form('mail', FILENAME_MAIL, 'action=preview'),
                          'pull_down_customers_email_address' => xos_draw_pull_down_menu('customers_email_address', $customers, (isset($_GET['customer']) ? $_GET['customer'] : '')),
                          'input_from' => xos_draw_input_field('from', EMAIL_FROM),
                          'input_subject' => xos_draw_input_field('subject'),
                          'textarea_message' => xos_draw_textarea_field('message', '60', '15'),
                          'form_end' => '</form>'));

  }

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'mail');
  $output_mail = $smarty->fetch(ADMIN_TPL . '/mail.tpl');
  
  $smarty->assign('central_contents', $output_mail);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
