<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : whos_online.php
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
//              filename: whos_online.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  $xx_mins_ago = (time() - 900);

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_WHOS_ONLINE) == 'overwrite_all')) :
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

// remove entries that have expired
  xos_db_query("delete from " . TABLE_WHOS_ONLINE . " where time_last_click < '" . $xx_mins_ago . "'");

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n"; 
    
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  

  $whos_online_query = xos_db_query("select customer_id, full_name, ip_address, time_entry, time_last_click, last_page_url, session_id from " . TABLE_WHOS_ONLINE);
  $whos_online_array = array();
  while ($whos_online = xos_db_fetch_array($whos_online_query)) {
    $time_online = (time() - $whos_online['time_entry']);
    if ((!isset($_GET['info']) || (isset($_GET['info']) && ($_GET['info'] == $whos_online['session_id'] . $whos_online['ip_address']))) && !isset($info)) {
      $info = $whos_online['session_id'] . $whos_online['ip_address'];
    }
    
    $selected = false;

    if ($whos_online['session_id'] . $whos_online['ip_address'] == $info) {
      $info = $whos_online['session_id'];
      $selected = true;
    }

    $last_page_url = '';

    if (preg_match('/^(.*)XOSsid[=|\/]+[a-z,0-9]+[&|\/]?(.*)/i', $whos_online['last_page_url'], $array)) {
      $last_page_url = $array[1] . $array[2];
    } else {
      $last_page_url = $whos_online['last_page_url'];
    }

    $whos_online_array[]=array('selected' => $selected,
                               'link_filename_whos_online' => xos_href_link(FILENAME_WHOS_ONLINE, xos_get_all_get_params(array('info', 'action')) . 'info=' . $whos_online['session_id'] . $whos_online['ip_address']),                         
                               'time_online' => gmdate('H:i:s', $time_online),
                               'customer_id' => $whos_online['customer_id'],
                               'full_name' => $whos_online['full_name'],
                               'ip_address' => $whos_online['ip_address'],
                               'time_entry' => date('H:i:s', $whos_online['time_entry']),
                               'time_last_click' => date('H:i:s', $whos_online['time_last_click']),
                               'last_page_url' => (strlen($last_page_url) > 50) ? "<acronym title=\"" . htmlspecialchars($last_page_url) . "\">".substr(htmlspecialchars($last_page_url), 0, 50)."&nbsp;</acronym>" : htmlspecialchars($last_page_url));
  }
  
  $smarty->assign(array('whos_online' => $whos_online_array,
                        'text_number_of_customers' => sprintf(TEXT_NUMBER_OF_CUSTOMERS, xos_db_num_rows($whos_online_query))));

  require(DIR_WS_BOXES . 'infobox_whos_online.php');

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'whos_online');
  $output_whos_online = $smarty->fetch(ADMIN_TPL . '/whos_online.tpl');
  
  $smarty->assign('central_contents', $output_whos_online);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
