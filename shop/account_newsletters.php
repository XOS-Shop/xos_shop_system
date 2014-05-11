<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : account_newsletters.php
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
//              filename: account_newsletters.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ACCOUNT_NEWSLETTERS) == 'overwrite_all')) :
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  } elseif (NEWSLETTER_ENABLED != 'true') {
    xos_redirect(xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ACCOUNT_NEWSLETTERS);

  $newsletter_query = xos_db_query("select newsletter_status from " . TABLE_NEWSLETTER_SUBSCRIBERS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
  $newsletter = xos_db_fetch_array($newsletter_query);

  if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    if (isset($_POST['newsletter_general']) && is_numeric($_POST['newsletter_general'])) {
      $newsletter_general = xos_db_prepare_input($_POST['newsletter_general']);
    } else {
      $newsletter_general = '0';
    }

    if ($newsletter_general != $newsletter['newsletter_status']) {
      $newsletter_general = (($newsletter['newsletter_status'] == '1') ? '0' : '1');

      xos_db_query("update " . TABLE_NEWSLETTER_SUBSCRIBERS . " set newsletter_status = '" . (int)$newsletter_general . "', newsletter_status_change = now() where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
    }

    $messageStack->add_session('account', SUCCESS_NEWSLETTER_UPDATED, 'success');

    xos_redirect(xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  }

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL'));

  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                'function rowOverEffect(object) {' . "\n" .
                '  if (object.className == "module-row") object.className = "module-row-over";' . "\n" .
                '}' . "\n\n" .

                'function rowOutEffect(object) {' . "\n" .
                '  if (object.className == "module-row-over") object.className = "module-row";' . "\n" .
                '}' . "\n\n" .
                
                'function checkBox(object) {' . "\n" .
                '  document.account_newsletter.elements[object].checked = !document.account_newsletter.elements[object].checked;' . "\n" .
                '}' . "\n" .
                '/* ]]> */' . "\n" .                
                '</script> ' . "\n"; 
 
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  $smarty->assign(array('form_begin' => xos_draw_form('account_newsletter', xos_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL'), 'post', '', true),
                        'hidden_field' => xos_draw_hidden_field('action', 'process'),
                        'checkbox_field' => xos_draw_checkbox_field('newsletter_general', '1', (($newsletter['newsletter_status'] == '1') ? true : false), 'id="checkbox_newsletter_general" onclick="checkBox(\'newsletter_general\')"'),
                        'link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL'),
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'account_newsletters');
  $output_account_newsletters = $smarty->fetch(SELECTED_TPL . '/account_newsletters.tpl');
                        
  $smarty->assign('central_contents', $output_account_newsletters);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
