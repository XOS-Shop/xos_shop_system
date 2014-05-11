<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : coupon_admin.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2010 Hanspeter Zeller
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
//              filename: coupon_admin.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADIMN_TPL . '/php/' . FILENAME_COUPON_ADMIN) == 'overwrite_all')) :  
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $oldaction = (isset($_GET['oldaction']) ? $_GET['oldaction'] : '');
  
  if (($action == 'send_email_to_user') && ($_POST['customers_email_address']) && (!$_POST['back_x'])) {
    switch ($_POST['customers_email_address']) {
    case '***':
      $mail_query = xos_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS);
      $mail_sent_to = TEXT_ALL_CUSTOMERS;
      break;
    case '**D':
      $mail_query = xos_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_newsletter = '1'");
      $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
      break;
    default:
      $customers_email_address = xos_db_prepare_input($_POST['customers_email_address']);
      $mail_query = xos_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . xos_db_input($customers_email_address) . "'");
      $mail_sent_to = $_POST['customers_email_address'];
      break;
    }
    $coupon_query = xos_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id = '" . $_GET['cid'] . "'");
    $coupon_result = xos_db_fetch_array($coupon_query);
    $coupon_name_query = xos_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cid'] . "' and language_id = '" . $_SESSION['languages_id'] . "'");
    $coupon_name = xos_db_fetch_array($coupon_name_query);

    $from = xos_db_prepare_input($_POST['from']);
    $subject = xos_db_prepare_input($_POST['subject']);
    while ($mail = xos_db_fetch_array($mail_query)) {
      $message = xos_db_prepare_input($_POST['message']);
      $message .= "\n\n" . TEXT_TO_REDEEM . "\n\n";
      $message .= TEXT_VOUCHER_IS . $coupon_result['coupon_code'] . "\n\n";
      $message .= TEXT_REMEMBER . "\n\n";
      $message .= TEXT_VISIT . "\n\n";
     
      //Let's build a message object using the email class
      $mimemessage = new email(array('X-Mailer: osCommerce bulk mailer'));
      // add the message to the object
      $mimemessage->add_text($message);
      $mimemessage->build_message();    
      $mimemessage->send($mail['customers_firstname'] . ' ' . $mail['customers_lastname'], $mail['customers_email_address'], '', $from, $subject);
    }

    xos_redirect(xos_href_link(FILENAME_COUPON_ADMIN, 'mail_sent_to=' . urlencode($mail_sent_to)));
  }
 
  if ( ($action == 'preview_email') && (!$_POST['customers_email_address']) ) {
    $action = 'email';    
    $messageStack->add(ERROR_NO_CUSTOMER_SELECTED, 'error');
  }

  if ($_GET['mail_sent_to']) {
    $messageStack->add(sprintf(NOTICE_EMAIL_SENT_TO, $_GET['mail_sent_to']), 'notice');
  }

  $coupon_id = ((isset($_GET['cid'])) ? xos_db_prepare_input($_GET['cid']) : '');

  switch ($action) {
    case 'setflag':
      if ( ($_GET['flag'] == 'N') || ($_GET['flag'] == 'Y') ) {
        if (isset($_GET['cid'])) {
          xos_set_coupon_status($coupon_id, $_GET['flag']);
        }
      }
      xos_redirect(xos_href_link(FILENAME_COUPON_ADMIN, '&cid=' . $_GET['cid']));
      break;
    case 'confirmdelete':
      xos_db_query("delete from " . TABLE_COUPONS . " where coupon_id='" . (int)$coupon_id . "'");
      xos_db_query("delete from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id='" . (int)$coupon_id . "'");
      break;
    case 'update':
      // get all POST variables and validate
      $_POST['coupon_code'] = trim($_POST['coupon_code']);
        $languages = xos_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];
          if ($_POST['coupon_name'][$language_id]) $_POST['coupon_name'][$language_id] = trim($_POST['coupon_name'][$language_id]);
          if ($_POST['coupon_desc'][$language_id]) $_POST['coupon_desc'][$language_id] = trim($_POST['coupon_desc'][$language_id]);
        }
      $_POST['coupon_amount'] = trim($_POST['coupon_amount']);
      $update_errors = 0;
      if ((!xos_not_null($_POST['coupon_amount'])) && (!xos_not_null($_POST['coupon_free_ship']))) {
        $update_errors = 1;
        $messageStack->add('header', ERROR_NO_COUPON_AMOUNT, 'error');
      }
      $coupon_code = ((xos_not_null($_POST['coupon_code'])) ? $_POST['coupon_code'] : create_coupon_code());

      $query1 = xos_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_code = '" . xos_db_prepare_input($coupon_code) . "'");
      if (xos_db_num_rows($query1) && $_POST['coupon_code'] && $oldaction != 'voucheredit')  {
        $update_errors = 1;
        $messageStack->add('header', ERROR_COUPON_EXISTS, 'error');
      }
      if ($update_errors != 0) {
        $action = 'new';
      } else {
        $action = 'update_preview';
      }
      break;
    case 'update_confirm':
      if ( ($_POST['back_x']) || ($_POST['back_y']) ) {
        if ($oldaction == 'voucheredit') {
          $action = 'voucheredit';
        } else {
          $action = 'new';
        }
      } else {
        $coupon_type = "F";
        $coupon_amount = $_POST['coupon_amount'];
        if (substr($_POST['coupon_amount'], -1) == '%') $coupon_type='P';
        if ($_POST['coupon_free_ship']) {
          $coupon_type = 'S';
          $coupon_amount = 0;
        }
        $sql_data_array = array('coupon_active' => xos_db_prepare_input($_POST['coupon_status']),
                                'coupon_code' => xos_db_prepare_input($_POST['coupon_code']),
                                'coupon_amount' => xos_db_prepare_input($coupon_amount),
                                'coupon_type' => xos_db_prepare_input($coupon_type),
                                'uses_per_coupon' => xos_db_prepare_input($_POST['coupon_uses_coupon']),
                                'uses_per_user' => xos_db_prepare_input($_POST['coupon_uses_user']),
                                'coupon_minimum_order' => xos_db_prepare_input($_POST['coupon_min_order']),
                                'restrict_to_products' => xos_db_prepare_input($_POST['coupon_products']),
                                'restrict_to_categories' => xos_db_prepare_input($_POST['coupon_categories']),
                                'coupon_start_date' => xos_date_raw(xos_db_prepare_input($_POST['coupon_startdate'])),
                                'coupon_expire_date' => xos_date_raw(xos_db_prepare_input($_POST['coupon_finishdate'])),
                                'date_created' => (($_POST['date_created'] != '0') ? $_POST['date_created'] : 'now()'),
                                'date_modified' => 'now()');
        $languages = xos_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];
          $sql_data_marray[$i] = array('coupon_name' => xos_db_prepare_input($_POST['coupon_name'][$language_id]),
                                 'coupon_description' => xos_db_prepare_input($_POST['coupon_desc'][$language_id])
                                 );
        }
//        $query = xos_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_code = '" . xos_db_prepare_input($_POST['coupon_code']) . "'");    
//        if (!xos_db_num_rows($query)) {
        if ($oldaction=='voucheredit') {
          xos_db_perform(TABLE_COUPONS, $sql_data_array, 'update', "coupon_id='" . (int)$coupon_id . "'"); 
          for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
            $language_id = $languages[$i]['id'];
            xos_db_query("update " . TABLE_COUPONS_DESCRIPTION . " set coupon_name = '" . xos_db_prepare_input($_POST['coupon_name'][$language_id]) . "', coupon_description = '" . xos_db_prepare_input($_POST['coupon_desc'][$language_id]) . "' where coupon_id = '" . (int)$coupon_id . "' and language_id = '" . $language_id . "'");
//            xos_db_perform(TABLE_COUPONS_DESCRIPTION, $sql_data_marray[$i], 'update', "coupon_id='" . $_GET['cid']."'");            
          }
        } else {   
          xos_db_perform(TABLE_COUPONS, $sql_data_array);
// to fix bug to prevent errors when adding a new voucher. This will also fix when there is no name or description in final voucher
          $insert_id = xos_db_insert_id();
          
          for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
            $language_id = $languages[$i]['id'];
            $sql_data_marray[$i]['coupon_id'] = $insert_id;
            $sql_data_marray[$i]['language_id'] = $language_id;
            xos_db_perform(TABLE_COUPONS_DESCRIPTION, $sql_data_marray[$i]);            
          }
//        }
      }
    }
  }
    
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
    
  if ($action == 'new') {
    $javascript .= '<script type="text/javascript" src="' . DIR_WS_ADMIN_IMAGES . ADMIN_TPL .'/' . $_SESSION['language'] . '/jquery.ui.datepicker-language.min.js"></script>' . "\n" .  
                   '<script type="text/javascript">' . "\n" .
                   '/* <![CDATA[ */' . "\n\n" . 
                 
                   '$(function() {' . "\n" .                                                                                        
                   '  $( "#coupon_startdate" ).datepicker({' . "\n" .
                   '    changeMonth: true,' . "\n" .
                   '    changeYear: true' . "\n" .
                   '  });' . "\n\n" .
                              
                   '  $( "#coupon_finishdate" ).datepicker({' . "\n" .
                   '    changeMonth: true,' . "\n" .
                   '    changeYear: true' . "\n" .
                   '  });' . "\n\n" .
                 
//                   '  $( "#ui-datepicker-div" ).css( "font-size", "75%" );' . "\n\n" .
                 
                   '});' . "\n\n" .                 
                 
                   '/* ]]> */' . "\n" .
                   '</script> ' . "\n";                    
  }   
  
  $javascript .= '<script type="text/javascript">' . "\n" .
                 '/* <![CDATA[ */' . "\n" .
                 'function popupImageWindow(url) {' . "\n" .
                 '  window.open(url,"popupImageWindow","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150").focus();' . "\n" .
                 '}' . "\n" .
                 '/* ]]> */' . "\n" .
                 '</script> ' . "\n"; 

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');
  
  switch ($action) {
  case 'voucherreport':

    break;
  case 'preview_email':
  
    break;       
  case 'email':
  
    break;
  case 'update_preview': 
  
  
///////////////////////////////////////////////////////////////////////
  $coupon_min_order = (($_POST['coupon_min_order'] == round($_POST['coupon_min_order'])) ? number_format($_POST['coupon_min_order'], 2) : number_format($_POST['coupon_min_order'], 2));
  $coupon_amount = (($_POST['coupon_amount'] == round($_POST['coupon_amount'])) ? number_format($_POST['coupon_amount'], 2) : number_format($_POST['coupon_amount'], 2));

// echo xos_image_submit('button_confirm.gif',IMAGE_CONFIRM);
// echo xos_image_submit('button_back.gif',IMAGE_BACK, 'name=back'); 
//////////////////////////////////////////////////////////////////////////////////////////
    $hidden_fields = xos_draw_hidden_field('coupon_status', $_POST['coupon_status']) .
                     xos_draw_hidden_field('coupon_amount', $_POST['coupon_amount']) .
                     xos_draw_hidden_field('coupon_min_order', $_POST['coupon_min_order']) .
                     xos_draw_hidden_field('coupon_free_ship', $_POST['coupon_free_ship']) .
                     xos_draw_hidden_field('coupon_code', $coupon_code) .
                     xos_draw_hidden_field('coupon_uses_coupon', $_POST['coupon_uses_coupon']) .
                     xos_draw_hidden_field('coupon_uses_user', $_POST['coupon_uses_user']) .
                     xos_draw_hidden_field('coupon_products', $_POST['coupon_products']) .
                     xos_draw_hidden_field('coupon_categories', $_POST['coupon_categories']) .
                     xos_draw_hidden_field('coupon_startdate', $_POST['coupon_startdate']) .
                     xos_draw_hidden_field('coupon_finishdate', $_POST['coupon_finishdate']) .
                     xos_draw_hidden_field('date_created', ((xos_not_null($_POST['date_created'])) ? date('Y-m-d', strtotime($_POST['date_created'])) : '0'));

    $languages = xos_get_languages();
    $coupon_content_array = array();    
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {      
      $language_id = $languages[$i]['id'];      
      $coupon_content_array[]=array('languages_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                                    'coupon_name' => $_POST['coupon_name'][$language_id],
                                    'coupon_desc' => $_POST['coupon_desc'][$language_id]);
                                    
      $hidden_fields .= xos_draw_hidden_field('coupon_name[' . $languages[$i]['id'] . ']', $_POST['coupon_name'][$language_id]);
      $hidden_fields .= xos_draw_hidden_field('coupon_desc[' . $languages[$i]['id'] . ']', $_POST['coupon_desc'][$language_id]);                                    
    }             

    $smarty->assign(array('update_preview' => true,                            
                          'form_begin' => xos_draw_form('coupon', FILENAME_COUPON_ADMIN, 'action=update_confirm&oldaction=' . $oldaction . '&cid=' . $_GET['cid'], 'post', 'enctype="multipart/form-data"'),                                          
                          'coupon_status' => (($_POST['coupon_status'] == 'Y') ? IMAGE_ICON_STATUS_GREEN : IMAGE_ICON_STATUS_RED),
                          'coupon_amount' => ((!$_POST['coupon_free_ship']) ? $coupon_amount : ''),
                          'coupon_min_order' => $coupon_min_order,
                          'coupon_free_ship' => (($_POST['coupon_free_ship']) ? TEXT_FREE_SHIPPING : TEXT_NO_FREE_SHIPPING),
                          'coupon_code' => $coupon_code, 
                          'coupon_uses_coupon' => $_POST['coupon_uses_coupon'],
                          'coupon_uses_user' => $_POST['coupon_uses_user'],
                          'coupon_products' => $_POST['coupon_products'],
                          'coupon_categories' => $_POST['coupon_categories'],
                          'coupon_startdate' => $_POST['coupon_startdate'],
                          'coupon_finishdate' => $_POST['coupon_finishdate'],                      
                          'link_filename_coupon_admin' => xos_href_link(FILENAME_COUPON_ADMIN),
                          'hidden_fields' => $hidden_fields,
                          'coupon_content' => $coupon_content_array,
                          'form_end' => '</form>'));
  
   
    break;
  case 'voucheredit':

    break;  
  case 'new':      
    
// molafish: set default if not editing an existing coupon or showing an error
    if ($action == 'new' && !$oldaction == 'new') {
      if (!$coupon_uses_user) {
        $coupon_uses_user=1;
      }
      if (!$date_created) {
        $date_created = '0';
      }
    }
    if (!isset($coupon_status)) $coupon_status = 'Y';
    switch ($coupon_status) {
      case 'N': $in_status = false; $out_status = true; break;
      case 'Y':
      default: $in_status = true; $out_status = false;
    }
/*
// molafish: fixed reset to default of dates when editing an existing coupon or showing an error message
    if ($action == 'new' && !$_POST['coupon_startdate'] && !$oldaction == 'new') {
      $coupon_startdate = preg_split("/[-]/", date('Y-m-d'));
    } elseif (xos_not_null($_POST['coupon_startdate'])) {
      $coupon_startdate = preg_split("/[-]/", $_POST['coupon_startdate']);
    } elseif (!$oldaction == 'new') {   // for action=voucheredit
      $coupon_startdate = preg_split("/[-]/", date('Y-m-d', strtotime($coupon['coupon_start_date'])));
    } else {   // error is being displayed
      $coupon_startdate = preg_split("/[-]/", date('Y-m-d', mktime(0, 0, 0, $_POST['coupon_startdate_month'],$_POST['coupon_startdate_day'] ,$_POST['coupon_startdate_year'] )));
    }
    if ($action == 'new' && !$_POST['coupon_finishdate'] && !$oldaction == 'new') {
      $coupon_finishdate = preg_split("/[-]/", date('Y-m-d'));
      $coupon_finishdate[0] = $coupon_finishdate[0] + 1;
    } elseif (xos_not_null($_POST['coupon_finishdate'])) {
      $coupon_finishdate = preg_split("/[-]/", $_POST['coupon_finishdate']);
    } elseif (!$oldaction == 'new') {   // for action=voucheredit
      $coupon_finishdate = preg_split("/[-]/", date('Y-m-d', strtotime($coupon['coupon_expire_date'])));
    } else {   // error is being displayed
      $coupon_finishdate = preg_split("/[-]/", date('Y-m-d', mktime(0, 0, 0, $_POST['coupon_finishdate_month'],$_POST['coupon_finishdate_day'] ,$_POST['coupon_finishdate_year'] )));
    }
    
    'input_coupon_startdate' => xos_draw_date_selector('coupon_startdate', mktime(0,0,0, $coupon_startdate[1], $coupon_startdate[2], $coupon_startdate[0])),
    'input_coupon_finishdate' => xos_draw_date_selector('coupon_finishdate', mktime(0,0,0, $coupon_finishdate[1], $coupon_finishdate[2], $coupon_finishdate[0])),        
*/                                    
               
    $languages = xos_get_languages();
    $coupon_content_array = array();    
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {      
      $language_id = $languages[$i]['id'];      
      $coupon_content_array[]=array('languages_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                                    'input_coupon_name' => xos_draw_input_field('coupon_name[' . $languages[$i]['id'] . ']', $coupon_name[$language_id]),
                                    'textarea_coupon_desc' => xos_draw_textarea_field('coupon_desc[' . $languages[$i]['id'] . ']','24','3', $coupon_desc[$language_id]));      
    }             

    $smarty->assign(array('new' => true,                            
                          'form_begin' => xos_draw_form('coupon', FILENAME_COUPON_ADMIN, 'action=update&oldaction='. (($oldaction == 'voucheredit') ? $oldaction : $action) . '&cid=' . $_GET['cid'], 'post', 'enctype="multipart/form-data"'),
                          'radio_coupon_status_Y' => xos_draw_radio_field('coupon_status', 'Y', $in_status),   
                          'radio_coupon_status_N' => xos_draw_radio_field('coupon_status', 'N', $out_status),
                          'input_coupon_amount' => xos_draw_input_field('coupon_amount', $coupon_amount),
                          'input_coupon_min_order' => xos_draw_input_field('coupon_min_order', $coupon_min_order),
                          'checkbox_coupon_free_ship' => xos_draw_checkbox_field('coupon_free_ship', $coupon_free_ship),
                          'input_coupon_code' => xos_draw_input_field('coupon_code', $coupon_code), 
                          'input_coupon_uses_coupon' => xos_draw_input_field('coupon_uses_coupon', $coupon_uses_coupon),
                          'input_coupon_uses_user' => xos_draw_input_field('coupon_uses_user', $coupon_uses_user),
                          'input_coupon_products' => xos_draw_input_field('coupon_products', $coupon_products),
                          'input_coupon_categories' => xos_draw_input_field('coupon_categories', $coupon_categories),                         
                          'input_coupon_startdate' => xos_draw_input_field('coupon_startdate', xos_date_format(DATE_FORMAT_SHORT), 'id="coupon_startdate" style="background: #ffffcc;" size ="10"'),
                          'input_coupon_finishdate' => xos_draw_input_field('coupon_finishdate', xos_date_format(DATE_FORMAT_SHORT, mktime(0, 0, 0, date("m"), date("d"), date("Y")+1)), 'id="coupon_finishdate" style="background: #ffffcc;" size ="10"'),                                                    
                          'link_filename_coupon_admin' => xos_href_link(FILENAME_COUPON_ADMIN),
                          'hidden_field_date_created' => xos_draw_hidden_field('date_created', $date_created),
                          'coupon_content' => $coupon_content_array,
                          'form_end' => '</form>'));
                           
    break;
  default:
      
    if ($_GET['status'] == 'Y' || $_GET['status'] == 'N') {
      $cc_query_raw = "select coupon_active, coupon_id, coupon_code, coupon_amount, coupon_minimum_order, coupon_type, coupon_start_date,coupon_expire_date,uses_per_user,uses_per_coupon,restrict_to_products, restrict_to_categories, date_created,date_modified from " . TABLE_COUPONS ." where coupon_active='" . xos_db_input($_GET['status']) . "' and coupon_type != 'G'";
    } else {
      $cc_query_raw = "select coupon_active, coupon_id, coupon_code, coupon_amount, coupon_minimum_order, coupon_type, coupon_start_date,coupon_expire_date,uses_per_user,uses_per_coupon,restrict_to_products, restrict_to_categories, date_created,date_modified from " . TABLE_COUPONS . " where coupon_type != 'G'";
    }
    $cc_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $cc_query_raw, $cc_query_numrows);
    $cc_query = xos_db_query($cc_query_raw);
    $cc_list_array = array();
    while ($cc_list = xos_db_fetch_array($cc_query)) {
      $redeem_query = xos_db_query("select redeem_date from " . TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . $cc_list['coupon_id'] . "'");
      if ($_GET['status'] == 'R' && xos_db_num_rows($redeem_query) == 0) {
        continue;
      }
      if (((!$_GET['cid']) || (@$_GET['cid'] == $cc_list['coupon_id'])) && (!$cInfo)) {
        $cInfo = new objectInfo($cc_list);
      } 
      
      $selected = false;      
         
      if ( (is_object($cInfo)) && ($cc_list['coupon_id'] == $cInfo->coupon_id) ) {
        $selected = true;      
        $link_filename_coupon_admin_edit = xos_href_link(FILENAME_COUPON_ADMIN, xos_get_all_get_params(array('cid', 'action')) . 'cid=' . $cInfo->coupon_id . '&action=edit');
      } 

      $coupon_description_query = xos_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cc_list['coupon_id'] . "' and language_id = '" . $_SESSION['languages_id'] . "'");
      $coupon_desc = xos_db_fetch_array($coupon_description_query);

      if ($cc_list['coupon_type'] == 'P') {
        // not floating point value, don't display decimal info
        $coupon_amount = (($cc_list['coupon_amount'] == round($cc_list['coupon_amount'])) ? number_format($cc_list['coupon_amount']) : number_format($cc_list['coupon_amount'], 2)) . '%';
      } elseif ($cc_list['coupon_type'] == 'S') {
        $coupon_amount = TEXT_FREE_SHIPPING;
      } else {
        $coupon_amount = $currencies->format($cc_list['coupon_amount']);
      }

      $redemptions = xos_db_num_rows($redeem_query);
     
      $coupon_status = false;
      if ($cc_list['coupon_active'] == 'Y') {
        $coupon_status = true;
      }
           
      $cc_list_array[]=array('selected' => $selected,
                             'status' => $coupon_status,
                             'name' => $coupon_desc['coupon_name'],
                             'amount' => $coupon_amount,
                             'code' => $cc_list['coupon_code'],
                             'redemptions' => $redemptions,
                             'icon_status_green' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green.gif', ICON_TITLE_STATUS_GREEN, 10, 10),
                             'icon_status_red' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red.gif', ICON_TITLE_STATUS_RED, 10, 10),
                             'icon_status_green_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_green_light.gif', ICON_TITLE_STATUS_GREEN_LIGHT, 10, 10),
                             'icon_status_red_light' => xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/icon_status_red_light.gif', ICON_TITLE_STATUS_RED_LIGHT, 10, 10),
                             'link_filename_coupon_admin_action_setflag_N' => xos_href_link(FILENAME_COUPON_ADMIN, 'action=setflag&flag=N&cid=' . $cc_list['coupon_id']),
                             'link_filename_coupon_admin_action_setflag_Y' => xos_href_link(FILENAME_COUPON_ADMIN, 'action=setflag&flag=Y&cid=' . $cc_list['coupon_id']),                              
                             'link_filename_coupon_admin' => xos_href_link(FILENAME_COUPON_ADMIN, xos_get_all_get_params(array('cid', 'action')) . 'cid=' . $cc_list['coupon_id']),
                             'link_filename_coupon_admin_edit' => $link_filename_coupon_admin_edit);

    }
        
    $smarty->assign('cc_list', $cc_list_array);    
                       
    $status_array[] = array('id' => 'Y', 'text' => TEXT_COUPON_ACTIVE);
    $status_array[] = array('id' => 'N', 'text' => TEXT_COUPON_INACTIVE);
    $status_array[] = array('id' => 'R', 'text' => TEXT_COUPON_REDEEMED);
    $status_array[] = array('id' => '*', 'text' => TEXT_COUPON_ALL);

    if ($_GET['status']) {
      $status = xos_db_prepare_input($_GET['status']);
    } else {
      // Changed from "Y" to "*" to see the Red Active and the Green Inactive status
      $status = '*';
    } 

    if (SID) {
      $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
    }  

    $smarty->assign(array('form_begin_status' => xos_draw_form('status', FILENAME_COUPON_ADMIN, '', 'get'),
                          'pull_down_status' => xos_draw_pull_down_menu('status', $status_array, $status, 'onchange="this.form.submit();"'),
                          'form_end' => '</form>')); 
                        
    $smarty->assign(array('nav_bar_number' => $cc_split->display_count($cc_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_COUPONS),
                          'nav_bar_result' => $cc_split->display_links($cc_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], 'status=' . $_GET['status']),
                          'link_filename_coupon_admin_new' => xos_href_link(FILENAME_COUPON_ADMIN, 'page=' . $_GET['page'] . '&cID=' . $cInfo->coupon_id . '&action=new'))); 

    require(DIR_WS_BOXES . 'infobox_coupon_admin.php');

  } 

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'coupon_admin');
  $output_coupon_admin = $smarty->fetch(ADMIN_TPL . '/coupon_admin.tpl');
  
  $smarty->assign('central_contents', $output_coupon_admin);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');
 
  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;   
?>