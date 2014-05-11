<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : product_notification.php
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
//              Copyright (c) 2002 osCommerce
//              filename: product_notification.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/modules/newsletters/product_notification.php') == 'overwrite_all')) :
  class product_notification {
    var $show_choose_audience, $title, $language_id, $content_text_plain, $content_text_htlm, $language_code, $language_directory;

    function product_notification($title, $language_id, $content_text_plain, $content_text_htlm, $language_code, $language_directory) {
      $this->show_choose_audience = true;
      $this->title = $title;
      $this->language_id = $language_id;
      $this->content_text_plain = $content_text_plain;
      $this->content_text_htlm = $content_text_htlm;
      $this->language_code = $language_code;
      $this->language_directory = $language_directory;
    }

    function choose_audience() {

      $products_array = array();
      $products_query = xos_db_query("select pd.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and pd.products_id = p.products_id and p.products_status = '1' order by pd.products_name");
      while ($products = xos_db_fetch_array($products_query)) {
        $products_array[] = array('id' => $products['products_id'],
                                  'text' => $products['products_name']);
      }

      $global_button = '<script type="text/javascript">' . "\n" .
                       '/* <![CDATA[ */' . "\n" .
                       'document.write(\'<input type="button" value="' . BUTTON_GLOBAL . '" style="width: 8em;" onclick="document.location=\\\'' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID'] . '&action=confirm&global=true') . '\\\'" />\');' . "\n" .
                       '/* ]]> */' . "\n" .
                       '</script>';

      $cancel_button = '<script type="text/javascript">' . "\n" .
                       '/* <![CDATA[ */' . "\n" .
                       'document.write(\'<input type="button" value="' . BUTTON_CANCEL . '" style="width: 8em;" onclick="document.location=\\\'' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '\\\'" />\');' . "\n" .
                       '/* ]]> */' . "\n" .
                       '</script>';

      $choose_audience_string = "\n" . 
                                '<script type="text/javascript">' . "\n" .    
                                '/* <![CDATA[ */' . "\n" .
                                'function mover(move) {' . "\n" .
                                '  if (move == \'remove\') {' . "\n" .
                                '    for (x=0; x<(document.notifications.products.length); x++) {' . "\n" .
                                '      if (document.notifications.products.options[x].selected) {' . "\n" .
                                '        with(document.notifications.elements[\'chosen[]\']) {' . "\n" .
                                '          options[options.length] = new Option(document.notifications.products.options[x].text,document.notifications.products.options[x].value);' . "\n" .
                                '        }' . "\n" .
                                '        document.notifications.products.options[x] = null;' . "\n" .
                                '        x = -1;' . "\n" .
                                '      }' . "\n" .
                                '    }' . "\n" .
                                '  }' . "\n" .
                                '  if (move == \'add\') {' . "\n" .
                                '    for (x=0; x<(document.notifications.elements[\'chosen[]\'].length); x++) {' . "\n" .
                                '      if (document.notifications.elements[\'chosen[]\'].options[x].selected) {' . "\n" .
                                '        with(document.notifications.products) {' . "\n" .
                                '          options[options.length] = new Option(document.notifications.elements[\'chosen[]\'].options[x].text,document.notifications.elements[\'chosen[]\'].options[x].value);' . "\n" .
                                '        }' . "\n" .
                                '        document.notifications.elements[\'chosen[]\'].options[x] = null;' . "\n" .
                                '        x = -1;' . "\n" .
                                '      }' . "\n" .
                                '    }' . "\n" .
                                '  }' . "\n" .
                                '  return true;' . "\n" .
                                '}' . "\n\n" .

                                'function selectAll(FormName, SelectBox) {' . "\n" .
                                '  temp = "document." + FormName + ".elements[\'" + SelectBox + "\']";' . "\n" .
                                '  Source = eval(temp);' . "\n\n" .

                                '  for (x=0; x<(Source.length); x++) {' . "\n" .
                                '    Source.options[x].selected = "true";' . "\n" .
                                '  }' . "\n\n" .

                                '  if (x<1) {' . "\n" .
                                '    alert(\'' . JS_PLEASE_SELECT_PRODUCTS . '\');' . "\n" .
                                '    return false;' . "\n" .
                                '  } else {' . "\n" .
                                '    return true;' . "\n" .
                                '  }' . "\n" .
                                '}' . "\n" .
                                '/* ]]> */' . "\n" .
                                '</script>' . "\n";

      $choose_audience_string .= '<form name="notifications" action="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID'] . '&action=confirm') . '" method="post" onsubmit="return selectAll(\'notifications\', \'chosen[]\')"><table border="0" width="100%" cellspacing="0" cellpadding="2">' . "\n" .
                                 '  <tr class="dataTableRow">' . "\n" .
                                 '    <td align="center" class="main"><b>' . TEXT_PRODUCTS . '</b><br />' . xos_draw_pull_down_menu('products', $products_array, '', 'size="30" style="width: 30em; font-size:9px" multiple="multiple"') . '</td>' . "\n" .
                                 '    <td align="center" class="main">&nbsp;<br />' . $global_button . '<br /><br /><br /><input type="button" value="' . BUTTON_SELECT . '" style="width: 8em;" onclick="mover(\'remove\');" /><br /><br /><input type="button" value="' . htmlspecialchars(BUTTON_UNSELECT) . '" style="width: 8em;" onclick="mover(\'add\');" /><br /><br /><br /><input type="submit" value="' . BUTTON_SUBMIT . '" style="width: 8em;" /><br /><br />' . $cancel_button . '</td>' . "\n" .
                                 '    <td align="center" class="main"><b>' . TEXT_SELECTED_PRODUCTS . '</b><br />' . xos_draw_pull_down_menu('chosen[]', array(), '', 'size="30" style="width: 30em; font-size:9px" multiple="multiple"') . '</td>' . "\n" .
                                 '  </tr>' . "\n" .
                                 '</table></form>';

      return $choose_audience_string;
    }

    function confirm() {

      $audience = array();

      if (isset($_GET['global']) && ($_GET['global'] == 'true')) {
        $products_query = xos_db_query("select distinct pn.customers_id, c.customers_firstname, c.customers_lastname, c.customers_email_address from " . TABLE_CUSTOMERS . " c, " . TABLE_PRODUCTS_NOTIFICATIONS . " pn where c.customers_id = pn.customers_id " . ($this->language_id > 0 ? 'and c.customers_language_id = ' . $this->language_id  : '') . "");
        while ($products = xos_db_fetch_array($products_query)) {
          $audience[$products['customers_id']] = array('firstname' => $products['customers_firstname'],
                                                       'lastname' => $products['customers_lastname'],
                                                       'email_address' => $products['customers_email_address']);
        }

        $customers_query = xos_db_query("select c.customers_id, c.customers_firstname, c.customers_lastname, c.customers_email_address from " . TABLE_CUSTOMERS . " c, " . TABLE_CUSTOMERS_INFO . " ci where c.customers_id = ci.customers_info_id and ci.global_product_notifications = '1' " . ($this->language_id > 0 ? 'and c.customers_language_id = ' . $this->language_id  : '') . "");
        while ($customers = xos_db_fetch_array($customers_query)) {
          $audience[$customers['customers_id']] = array('firstname' => $customers['customers_firstname'],
                                                        'lastname' => $customers['customers_lastname'],
                                                        'email_address' => $customers['customers_email_address']);
        }
      } else {
        $chosen = $_POST['chosen'];

        $ids = implode(',', $chosen);

        $products_query = xos_db_query("select distinct pn.customers_id, c.customers_firstname, c.customers_lastname, c.customers_email_address from " . TABLE_CUSTOMERS . " c, " . TABLE_PRODUCTS_NOTIFICATIONS . " pn where c.customers_id = pn.customers_id " . ($this->language_id > 0 ? 'and c.customers_language_id = ' . $this->language_id  : '') . " and pn.products_id in (" . $ids . ")");
        while ($products = xos_db_fetch_array($products_query)) {
          $audience[$products['customers_id']] = array('firstname' => $products['customers_firstname'],
                                                       'lastname' => $products['customers_lastname'],
                                                       'email_address' => $products['customers_email_address']);
        }

        $customers_query = xos_db_query("select c.customers_id, c.customers_firstname, c.customers_lastname, c.customers_email_address from " . TABLE_CUSTOMERS . " c, " . TABLE_CUSTOMERS_INFO . " ci where c.customers_id = ci.customers_info_id and ci.global_product_notifications = '1' " . ($this->language_id > 0 ? 'and c.customers_language_id = ' . $this->language_id  : '') . "");
        while ($customers = xos_db_fetch_array($customers_query)) {
          $audience[$customers['customers_id']] = array('firstname' => $customers['customers_firstname'],
                                                        'lastname' => $customers['customers_lastname'],
                                                        'email_address' => $customers['customers_email_address']);
        }
      }

      $count = 0;
      $costomers_array = array();      
      reset($audience);
      while (list($key, $value) = each ($audience)) {
        $count ++;
        $costomers_array[] = array('id' => $key,
                                   'text' => $value['firstname'] . ' ' . $value['lastname'] . ' &lt;' . $value['email_address'] . '&gt;');                   
      }

      $cancel_button = '<script type="text/javascript">' . "\n" .
                       '/* <![CDATA[ */' . "\n" .
                       'document.write(\'<input type="button" value="' . BUTTON_CANCEL . '" style="width: 8em;" onclick="document.location=\\\'' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '\\\'" />\');' . "\n" .
                       '/* ]]> */' . "\n" .
                       '</script>';

      $return_button = '<script type="text/javascript">' . "\n" .
                       '/* <![CDATA[ */' . "\n" .
                       'document.write(\'<input type="button" value="' . BUTTON_BACK . '" style="width: 8em;" onclick="document.location=\\\'' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '&action=send \\\'" />\');' . "\n" .
                       '/* ]]> */' . "\n" .
                       '</script>';

      $confirm_string = "\n" . 
                        '<script type="text/javascript">' . "\n" .    
                        '/* <![CDATA[ */' . "\n" .
                        'function mover(move) {' . "\n" .
                        '  if (move == \'remove\') {' . "\n" .
                        '    for (x=0; x<(document.notifications.costomers.length); x++) {' . "\n" .
                        '      if (document.notifications.costomers.options[x].selected) {' . "\n" .
                        '        with(document.notifications.elements[\'customers_chosen[]\']) {' . "\n" .
                        '          options[options.length] = new Option(document.notifications.costomers.options[x].text,document.notifications.costomers.options[x].value);' . "\n" .
                        '        }' . "\n" .
                        '        document.notifications.costomers.options[x] = null;' . "\n" .
                        '        x = -1;' . "\n" .
                        '      }' . "\n" .
                        '    }' . "\n" .
                        '  }' . "\n" .
                        '  if (move == \'add\') {' . "\n" .
                        '    for (x=0; x<(document.notifications.elements[\'customers_chosen[]\'].length); x++) {' . "\n" .
                        '      if (document.notifications.elements[\'customers_chosen[]\'].options[x].selected) {' . "\n" .
                        '        with(document.notifications.costomers) {' . "\n" .
                        '          options[options.length] = new Option(document.notifications.elements[\'customers_chosen[]\'].options[x].text,document.notifications.elements[\'customers_chosen[]\'].options[x].value);' . "\n" .
                        '        }' . "\n" .
                        '        document.notifications.elements[\'customers_chosen[]\'].options[x] = null;' . "\n" .
                        '        x = -1;' . "\n" .
                        '      }' . "\n" .
                        '    }' . "\n" .
                        '  }' . "\n" .
                        '  return true;' . "\n" .
                        '}' . "\n\n" .

                        'function selectAll(FormName, SelectBox) {' . "\n" .
                        '  temp = "document." + FormName + ".elements[\'" + SelectBox + "\']";' . "\n" .
                        '  Source = eval(temp);' . "\n\n" .

                        '  for (x=0; x<(Source.length); x++) {' . "\n" .
                        '    Source.options[x].selected = "true";' . "\n" .
                        '  }' . "\n\n" .

                        '  if (x<1) {' . "\n" .
                        '    alert(\'' . JS_PLEASE_SELECT_CUSTOMERS . '\');' . "\n" .
                        '    return false;' . "\n" .
                        '  } else {' . "\n" .
                        '    return true;' . "\n" .
                        '  }' . "\n" .
                        '}' . "\n" .
                        '/* ]]> */' . "\n" .
                        '</script>' . "\n";    
            
      $confirm_string .= '<table width="100%" border="0" cellspacing="0" cellpadding="2">' . "\n" .
                         '  <tr class="dataTableRow">' . "\n" .
                         '    <td class="main"><b>' . sprintf(TEXT_COUNT_CUSTOMERS, $count) . '</b></td>' . "\n" .
                         '  </tr>' . "\n" .
                         ($count > 0 ?                         
                         '  <tr class="dataTableRow">' . "\n" .
                         '    <td>' . xos_draw_separator('pixel_trans.gif', '1', '10') . '</td>' . "\n" .
                         '  </tr>' . "\n" .                        
                         '  <tr class="dataTableRow">' . "\n" .
                         '    <td>' .
                         '      <form name="notifications" action="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID'] . '&action=confirm_send') . '" method="post" onsubmit="return selectAll(\'notifications\', \'customers_chosen[]\')"><table border="0" width="100%" cellspacing="0" cellpadding="2">' . "\n" .
                         '        <tr>' . "\n" .
                         '          <td align="center" class="main"><b>' . TEXT_CUSTOMERS . '</b><br />' . xos_draw_pull_down_menu('costomers', $costomers_array, '', 'size="30" style="width: 30em; font-size:9px" multiple="multiple"') . '</td>' . "\n" .
                         '          <td align="center" class="main"><input type="button" value="' . BUTTON_SELECT . '" style="width: 8em;" onclick="mover(\'remove\');" /><br /><br /><input type="button" value="' . htmlspecialchars(BUTTON_UNSELECT) . '" style="width: 8em;" onclick="mover(\'add\');" /><br /><br /><br /><br /><input type="submit" value="' . BUTTON_SEND . '" style="width: 8em;" /><br /><br />' . $return_button . '<br /><br />' . $cancel_button . '</td>' . "\n" .
                         '          <td align="center" class="main"><b>' . TEXT_SELECTED_CUSTOMERS . '</b><br />' . xos_draw_pull_down_menu('customers_chosen[]', array(), '', 'size="30" style="width: 30em; font-size:9px" multiple="multiple"') . '</td>' . "\n" .
                         '       </tr>' . "\n" .
                         '     </table></form>' .
                         '    </td>' .
                         '  </tr>' . "\n" :                         
                         '  <tr class="dataTableRow">' . "\n" .
                         '    <td>' . xos_draw_separator('pixel_trans.gif', '1', '10') . '</td>' . "\n" .
                         '  </tr>' . "\n" .                        
                         '  <tr class="dataTableRow">' . "\n" .
                         '    <td>' .
                         '      <form name="notifications" action="' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID'] . '&action=confirm_send') . '" method="post" onsubmit="return selectAll(\'notifications\', \'customers_chosen[]\')"><table border="0" width="100%" cellspacing="0" cellpadding="2">' . "\n" .
                         '        <tr>' . "\n" .
                         '          <td align="center" class="main"><b>' . TEXT_CUSTOMERS . '</b><br />' . xos_draw_pull_down_menu('costomers', $costomers_array, '', 'size="30" style="width: 30em; font-size:9px" multiple="multiple"') . '</td>' . "\n" .
                         '          <td align="center" class="main">' . $return_button . '<br /><br />' . $cancel_button . '</td>' . "\n" .
                         '          <td align="center" class="main"><b>' . TEXT_SELECTED_CUSTOMERS . '</b><br />' . xos_draw_pull_down_menu('customers_chosen[]', array(), '', 'size="30" style="width: 30em; font-size:9px" multiple="multiple"') . '</td>' . "\n" .
                         '       </tr>' . "\n" .
                         '     </table></form>' .
                         '    </td>' .
                         '  </tr>' . "\n" ) .                         
                         '  <tr class="dataTableRow">' . "\n" .
                         '    <td>' . xos_draw_separator('pixel_trans.gif', '1', '10') . '</td>' . "\n" .
                         '  </tr>' . "\n" .
                         '  <tr class="dataTableRow">' . "\n" .
                         '    <td class="main"><b>' . $this->title . '</b></td>' . "\n" .
                         '  </tr>' . "\n" .
                         '  <tr class="dataTableRow">' . "\n" .
                         '    <td>' . xos_draw_separator('pixel_trans.gif', '1', '10') . '</td>' . "\n" .
                         '  </tr>' . "\n";
                        
      if (($this->content_text_htlm != '') && (EMAIL_USE_HTML == 'true')) {       
        $confirm_string .= '  <tr class="dataHeadingRow">' . "\n" .
                           '    <td class="dataHeadingContent" valign="top">' . TEXT_TEXT . '</td>' . "\n" .
                           '  </tr>' . "\n" .
                           '  <tr>' . "\n" .
                           '    <td>' . xos_draw_separator('pixel_black.gif', '100%', '1') . '</td>' . "\n" .
                           '  </tr>' . "\n" .                            
                           '  <tr>' . "\n" .
                           '    <td class="main"><pre>' . wordwrap($this->content_text_plain, 100) . '</pre></td>' . "\n" .
                           '  </tr>' . "\n" .
                           '  <tr>' . "\n" .
                           '    <td>' . xos_draw_separator('pixel_black.gif', '100%', '1') . '</td>' . "\n" .
                           '  </tr>' . "\n" .                           
                           '  <tr class="dataTableRow">' . "\n" .
                           '    <td>' . xos_draw_separator('pixel_trans.gif', '1', '10') . '</td>' . "\n" .
                           '  </tr>' . "\n" .                               
                           '  <tr class="dataHeadingRow">' . "\n" .
                           '    <td class="dataHeadingContent" valign="top">' . TEXT_HTML . '</td>' . "\n" .
                           '  </tr>' . "\n" .
                           '  <tr>' . "\n" .
                           '    <td>' . xos_draw_separator('pixel_black.gif', '100%', '1') . '</td>' . "\n" .
                           '  </tr>' . "\n" .                                                
                           '  <tr>' . "\n" .
                           '    <td>' . $this->content_text_htlm . '</td>' . "\n" .
                           '  </tr>' . "\n" .
                           '  <tr>' . "\n" .
                           '    <td>' . xos_draw_separator('pixel_black.gif', '100%', '1') . '</td>' . "\n" .
                           '  </tr>' . "\n";                           
      } else {
        $confirm_string .= '  <tr class="dataHeadingRow">' . "\n" .
                           '    <td class="dataHeadingContent" valign="top">' . TEXT_TEXT . '</td>' . "\n" .
                           '  </tr>' . "\n" .
                           '  <tr>' . "\n" .
                           '    <td>' . xos_draw_separator('pixel_black.gif', '100%', '1') . '</td>' . "\n" .
                           '  </tr>' . "\n" .                               
                           '  <tr>' . "\n" .
                           '    <td class="main"><pre>' . wordwrap($this->content_text_plain, 100) . '</pre></td>' . "\n" .
                           '  </tr>' . "\n" .
                           '  <tr>' . "\n" .
                           '    <td>' . xos_draw_separator('pixel_black.gif', '100%', '1') . '</td>' . "\n" .
                           '  </tr>' . "\n";                           
      }                        
      
      $confirm_string .= '</table>';

      return $confirm_string;
    }

    function send($newsletter_id) {
      global $messageStack;
      
      if (SEND_EMAILS != 'true') {
        $messageStack->add('news_email', ERROR_EMAIL_WAS_NOT_SENT, 'error');
        return false;
      }  

      $audience = array();

      $ids = $_GET['customers_chosen'];

      $customers_query = xos_db_query("select c.customers_id, c.customers_firstname, c.customers_lastname, c.customers_email_address from " . TABLE_CUSTOMERS . " c where c.customers_id in (" . $ids . ")");
      while ($customers = xos_db_fetch_array($customers_query)) {
      $audience[$customers['customers_id']] = array('firstname' => $customers['customers_firstname'],
                                                    'lastname' => $customers['customers_lastname'],
                                                    'email_address' => $customers['customers_email_address']);
      }

      if (empty($this->language_directory)) {
        $lang_query = xos_db_query("select directory from " . TABLE_LANGUAGES . " where code = '" . xos_db_input(DEFAULT_LANGUAGE) . "'");
        $lang = xos_db_fetch_array($lang_query);
        $this->language_directory = $lang['directory'];
      }

      //Let's build a message object using the mailer class
      $email_to_customer = new mailer();
      
      $email_from_value = EMAIL_FROM;  
      $from = html_entity_decode($email_from_value, ENT_QUOTES, 'UTF-8');
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
      $email_to_customer->WordWrap = '100';
      $email_to_customer->Subject = $this->title;

      $smarty_product_notification = new Smarty();
      $smarty_product_notification->template_dir = DIR_FS_SMARTY . 'catalog/templates/';
      $smarty_product_notification->compile_dir = DIR_FS_SMARTY . 'catalog/templates_c/';
      $smarty_product_notification->config_dir = DIR_FS_SMARTY . 'catalog/';
      $smarty_product_notification->cache_dir = DIR_FS_SMARTY . 'catalog/cache/';
      $smarty_product_notification->left_delimiter = '[@{';
      $smarty_product_notification->right_delimiter = '}@]';  

      $is_html = false;
      
      if (($this->content_text_htlm != '') && (EMAIL_USE_HTML == 'true')) {    

        $is_html = true;
            
        $smarty_product_notification->assign(array('html_params' => HTML_PARAMS,
                                                   'xhtml_lang' => !empty($this->language_code) ? $this->language_code : DEFAULT_LANGUAGE,
                                                   'charset' => CHARSET,
                                                   'base_href' => HTTP_SERVER,
                                                   'content_text_htlm' => $this->content_text_htlm,
                                                   'content_text_plain' => $this->content_text_plain));

        $smarty_product_notification->configLoad('languages/' . $this->language_directory . '_email.conf', 'product_notification_email_html.tpl');
        $output_product_notification_email_html = $smarty_product_notification->fetch(DEFAULT_TPL . '/includes/email/product_notification_email_html.tpl');     

        $smarty_product_notification->configLoad('languages/' . $this->language_directory . '_email.conf', 'product_notification_email_text.tpl');
        $output_product_notification_email_text = $smarty_product_notification->fetch(DEFAULT_TPL . '/includes/email/product_notification_email_text.tpl');
                                                      
        $email_to_customer->isHTML(true);
      } else {
      
        $smarty_product_notification->assign('content_text_plain', $this->content_text_plain);
      
        $smarty_product_notification->configLoad('languages/' . $this->language_directory . '_email.conf', 'product_notification_email_text.tpl');
        $output_product_notification_email_text = $smarty_product_notification->fetch(DEFAULT_TPL . '/includes/email/product_notification_email_text.tpl');
      
        $email_to_customer->isHTML(false);      
      }         
      
      reset($audience);
      while (list($key, $value) = each ($audience)) {
      
        if($is_html) {
        
          $email_to_customer->Body = $output_product_notification_email_html;
                                       
          $email_to_customer->AltBody = html_entity_decode(strip_tags($output_product_notification_email_text), ENT_QUOTES, 'UTF-8');
                                   
        } else { 
        
          $email_to_customer->Body = html_entity_decode(strip_tags($output_product_notification_email_text), ENT_QUOTES, 'UTF-8');
                                              
        }      
      
        $email_to_customer->addAddress($value['email_address'], $value['firstname'] . ' ' . $value['lastname']);
        
        if(!$email_to_customer->send()) {
          $messageStack->add('news_email', sprintf(ERROR_PHP_MAILER, $email_to_customer->ErrorInfo, '&lt;' . $value['email_address'] . '&gt;'), 'error');
        } else {
          $messageStack->add('news_email', sprintf(NOTICE_EMAIL_SENT_TO, '&lt;' . $value['email_address'] . '&gt;'), 'success');
        }
        
        $email_to_customer->clearAddresses();
      }

      $newsletter_id = xos_db_prepare_input($newsletter_id);
      xos_db_query("update " . TABLE_NEWSLETTERS . " set date_sent = now(), status = '1', locked = '0' where newsletters_id = '" . xos_db_input($newsletter_id) . "'");
    }
  }
endif;
?>
