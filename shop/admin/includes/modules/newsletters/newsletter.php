<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : newsletter.php
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
//              filename: newsletter.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/modules/newsletters/newsletter.php') == 'overwrite_all')) :
  class newsletter {
    var $show_choose_audience, $title, $language_id, $content_text_plain, $content_text_htlm, $language_code, $language_directory;

    function newsletter($title, $language_id, $content_text_plain, $content_text_htlm, $language_code, $language_directory) {
      $this->show_choose_audience = false;
      $this->title = $title;
      $this->language_id = $language_id;
      $this->content_text_plain = $content_text_plain;
      $this->content_text_htlm = $content_text_htlm;
      $this->language_code = $language_code;
      $this->language_directory = $language_directory;
    }

    function choose_audience() {
      return false;
    }

    function confirm() {

      $mail_addresses_query = xos_db_query("select s.subscriber_id, s.subscriber_email_address, c.customers_firstname, c.customers_lastname  from " . TABLE_NEWSLETTER_SUBSCRIBERS . " s left join " . TABLE_CUSTOMERS . " c on s.customers_id = c.customers_id where s.newsletter_status = '1' " . ($this->language_id > 0 ? 'and s.subscriber_language_id = ' . $this->language_id  : '') . " order by s.customers_id");  
      $count = 0;
      $costomers_array = array();
      while ($mail_addresses = xos_db_fetch_array($mail_addresses_query)) {
        $count ++;
        $costomers_array[] = array('id' => $mail_addresses['subscriber_id'],
                                   'text' =>  '&lt;' .$mail_addresses['subscriber_email_address'] . '&gt; ' . $mail_addresses['customers_firstname'] . ' ' . $mail_addresses['customers_lastname']);                   
      } 
      

      $cancel_button = '<script type="text/javascript">' . "\n" .
                       '/* <![CDATA[ */' . "\n" .
                       'document.write(\'<input type="button" value="' . BUTTON_CANCEL . '" style="width: 8em;" onclick="document.location=\\\'' . xos_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '\\\'" />\');' . "\n" .
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
                         '          <td align="center" class="main"><input type="button" value="' . BUTTON_SELECT . '" style="width: 8em;" onclick="mover(\'remove\');" /><br /><br /><input type="button" value="' . htmlspecialchars(BUTTON_UNSELECT) . '" style="width: 8em;" onclick="mover(\'add\');" /><br /><br /><br /><br /><input type="submit" value="' . BUTTON_SEND . '" style="width: 8em;" /><br /><br />' . $cancel_button . '</td>' . "\n" .
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
                         '          <td align="center" class="main">' . $cancel_button . '</td>' . "\n" .
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
    
      $ids = $_GET['customers_chosen'];
      
      $mail_query = xos_db_query("select s.subscriber_id, s.subscriber_email_address, s.subscriber_identity_code, c.customers_firstname, c.customers_lastname  from " . TABLE_NEWSLETTER_SUBSCRIBERS . " s left join " . TABLE_CUSTOMERS . " c on s.customers_id = c.customers_id where s.subscriber_id in (" . $ids . ") order by s.customers_id");
      
      if (empty($this->language_directory)) {
        $lang_query = xos_db_query("select directory from " . TABLE_LANGUAGES . " where code = '" . xos_db_input(DEFAULT_LANGUAGE) . "'");
        $lang = xos_db_fetch_array($lang_query);
        $this->language_directory = $lang['directory'];
      }
     
      //Let's build a message object using the mailer class
      $email_to_subscriber = new mailer();
      
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
      
      $email_to_subscriber->From = $address;
      $email_to_subscriber->FromName = $name;
      $email_to_subscriber->WordWrap = '100';
      $email_to_subscriber->Subject = $this->title;

      $smarty_newsletter = new Smarty();
      $smarty_newsletter->template_dir = DIR_FS_SMARTY . 'catalog/templates/';
      $smarty_newsletter->compile_dir = DIR_FS_SMARTY . 'catalog/templates_c/';
      $smarty_newsletter->config_dir = DIR_FS_SMARTY . 'catalog/';
      $smarty_newsletter->cache_dir = DIR_FS_SMARTY . 'catalog/cache/';
      $smarty_newsletter->left_delimiter = '[@{';
      $smarty_newsletter->right_delimiter = '}@]';  
      
      $is_html = false;
      
      if (($this->content_text_htlm != '') && (EMAIL_USE_HTML == 'true')) {
        
        $is_html = true;
          
        $smarty_newsletter->assign(array('nl' => "\n",
                                         'html_params' => HTML_PARAMS,
                                         'xhtml_lang' => !empty($this->language_code) ? $this->language_code : DEFAULT_LANGUAGE,
                                         'charset' => CHARSET,
                                         'base_href' => HTTP_SERVER,
                                         'content_text_htlm' => $this->content_text_htlm,
                                         'content_text_plain' => $this->content_text_plain));
        
        $smarty_newsletter->configLoad('languages/' . $this->language_directory . '_email.conf', 'newsletter_email_html');
        $output_newsletter_email_html = $smarty_newsletter->fetch(DEFAULT_TPL . '/includes/email/newsletter_email_html.tpl');     

        $smarty_newsletter->configLoad('languages/' . $this->language_directory . '_email.conf', 'newsletter_email_text');
        $output_newsletter_email_text = $smarty_newsletter->fetch(DEFAULT_TPL . '/includes/email/newsletter_email_text.tpl');
                                                      
        $email_to_subscriber->isHTML(true);
      } else {
        
        $smarty_newsletter->assign(array('nl' => "\n",
                                         'content_text_plain' => $this->content_text_plain));
      
        $smarty_newsletter->configLoad('languages/' . $this->language_directory . '_email.conf', 'newsletter_email_text');
        $output_newsletter_email_text = $smarty_newsletter->fetch(DEFAULT_TPL . '/includes/email/newsletter_email_text.tpl');
      
        $email_to_subscriber->isHTML(false);
      }               
      
      while ($mail = xos_db_fetch_array($mail_query)) {
      
        $link_unsubscribe = xos_catalog_href_link('newsletter_subscribe.php', 'action=unsubscribe&amp;identity_code=' . $mail['subscriber_identity_code'], 'SSL');
      
        if($is_html) {
        
          $email_to_subscriber->Body = $output_newsletter_email_html . 
                                       '<a href="' . $link_unsubscribe . '"  target="_blank">' . $link_unsubscribe . '</a>' . "\n" .
                                       '</div>' . "\n" .
                                       '</body>' . "\n" .
                                       '</html>' . "\n";
                                       
          $email_to_subscriber->AltBody = html_entity_decode(strip_tags($output_newsletter_email_text . $link_unsubscribe), ENT_QUOTES, 'UTF-8');
                                   
        } else { 
        
          $email_to_subscriber->Body = html_entity_decode(strip_tags($output_newsletter_email_text . $link_unsubscribe), ENT_QUOTES, 'UTF-8');
                                              
        }
      
        $email_to_subscriber->addAddress($mail['subscriber_email_address'], $mail['customers_firstname'] . ' ' . $mail['customers_lastname']);
        
        if(!$email_to_subscriber->send()) {
          $messageStack->add('news_email', sprintf(ERROR_PHP_MAILER, $email_to_subscriber->ErrorInfo, '&lt;' . $mail['subscriber_email_address'] . '&gt;'), 'error');
        } else {
          $messageStack->add('news_email', sprintf(NOTICE_EMAIL_SENT_TO, '&lt;' . $mail['subscriber_email_address'] . '&gt;'), 'success');
        }        
        
        $email_to_subscriber->clearAddresses();
      }

      $newsletter_id = xos_db_prepare_input($newsletter_id);
      xos_db_query("update " . TABLE_NEWSLETTERS . " set date_sent = now(), status = '1', locked = '0' where newsletters_id = '" . xos_db_input($newsletter_id) . "'");
    }
  }
endif;
?>
