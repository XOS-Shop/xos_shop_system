<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : address_book.php
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
//              filename: address_book.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ADDRESS_BOOK) == 'overwrite_all')) :
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ADDRESS_BOOK);

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                'function rowOverEffect(object) {' . "\n" .
                '  if (object.className == "module-row") object.className = "module-row-over";' . "\n" .
                '}' . "\n\n" .

                'function rowOutEffect(object) {' . "\n" .
                '  if (object.className == "module-row-over") object.className = "module-row";' . "\n" .
                '}' . "\n" .
                '/* ]]> */' . "\n" .
                '</script> ' . "\n"; 
 
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  $addresses_query = xos_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' order by firstname, lastname");
  $addresses_array = array();
  while ($addresses = xos_db_fetch_array($addresses_query)) {
    $format_id = xos_get_address_format_id($addresses['country_id']);
    
    $addresses_array[]=array('name' => xos_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']),
                             'primary_address' => ($addresses['address_book_id'] == $_SESSION['customer_default_address_id']) ? true : false,
                             'link_filename_address_book_process_edit' => xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL'),
                             'link_filename_address_book_process_delete' => xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL'),
                             'format_address' => xos_address_format($format_id, $addresses, true, ' ', '<br />'),
                             'order_total' => $orders['order_total']);
  }

  if (xos_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
     $smarty->assign('link_filename_address_book_process', xos_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL')); 
  }

  if ($messageStack->size('addressbook') > 0) {
    $smarty->assign('message_stack', $messageStack->output('addressbook'));
  } 
  
  $smarty->assign(array('addresses' => $addresses_array,
                        'primary_address_label' => xos_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], true, ' ', '<br />'),
                        'link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL'),
                        'max_address_book_entries' => MAX_ADDRESS_BOOK_ENTRIES));
                        
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'address_book');
  $output_address_book = $smarty->fetch(SELECTED_TPL . '/address_book.tpl'); 
  
  $smarty->assign('central_contents', $output_address_book);  
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
