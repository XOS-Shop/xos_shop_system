<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : offline.php
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
if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_OFFLINE) == 'overwrite_all')) :

  header('HTTP/1.1 503 Service Temporarily Unavailable');
  header('Status: 503 Service Temporarily Unavailable'); 
 
  $_SESSION['navigation']->remove_current_page();

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_OFFLINE);

  $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $email_address = $_POST['email_address'];
    $password = $_POST['password'];

// Check if email exists
    $check_admin_query = $DB->prepare
    (
     "SELECT admin_id            AS login_id,
             admin_email_address AS login_email_address,
             admin_password      AS login_password
      FROM   " . TABLE_ADMIN . "
      WHERE  admin_email_address = :email_address"
    );
    
    $DB->perform($check_admin_query, array(':email_address' => $email_address));

    if (!$check_admin_query->rowCount()) {
      $error = true;
    } else {
      $check_admin = $check_admin_query->fetch();
// Check that password is good
      if (!xos_validate_password($password, $check_admin['login_password'])) {
        $error = true;
      } else {         
        $_SESSION['access_allowed'] = true;        
        xos_redirect(xos_href_link(FILENAME_DEFAULT), false);
      }
    }
  }

  if ($error == true) {
    unset($_SESSION['access_allowed']);
    $messageStack->add('offline', TEXT_OFFLINE_ERROR);
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_OFFLINE, '', 'SSL'));
                
  require(DIR_WS_INCLUDES . 'html_header.php');
//  require(DIR_WS_INCLUDES . 'boxes.php');
//  require(DIR_WS_INCLUDES . 'header.php');
//  require(DIR_WS_INCLUDES . 'footer.php');                  
  
  if ($messageStack->size('offline') > 0) {
    $smarty->assign('message_stack', $messageStack->output('offline'));
    $smarty->assign('message_stack_error', $messageStack->output('offline', 'error'));
    $smarty->assign('message_stack_warning', $messageStack->output('offline', 'warning')); 
    $smarty->assign('message_stack_success', $messageStack->output('offline', 'success'));    
  }

  $language_string = '';
  reset($lng->catalog_languages);
  
  if (sizeof($lng->catalog_languages) > 1) { 
  
    while (list($key, $value) = each($lng->catalog_languages)) {
      $language_str .= ' <a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], xos_get_all_get_params(array('lnc', 'cur', 'tpl', 'dfrom', 'dto')) . 'lnc=' . $key, $request_type) . '">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/' . $value['directory'] . '/' . $value['image'], $value['name']) . '</a> ';
    }

    $smarty->assign('language_str', $language_str);
  }

  if ($banner_offline = xos_banner_exists('dynamic', 'offline')) {
    $banner = array(); 
    $banner = xos_display_banner('static', $banner_offline);
    eval(" ?>" . $banner['banner_php_source'] . "<?php ");
    $smarty->assign('offline_banner_offline', $banner['banner_string']);
  }
  
  $smarty->assign(array('form_begin' => xos_draw_form('offline', xos_href_link(FILENAME_OFFLINE, 'action=process', 'SSL')),
                        'input_field_email_address' => xos_draw_input_field('email_address', '', 'id="email_address"'),
                        'input_field_password' => xos_draw_password_field('password', '', 'id="password"'),
                        'form_end' => '</form>'));   

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'offline');
  $output_offline = $smarty->fetch(SELECTED_TPL . '/offline.tpl');
                        
  $smarty->assign('central_contents', $output_offline);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
