<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : stats_customers.php
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
//              filename: stats_customers.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_STATS_CUSTOMERS) == 'overwrite_all')) :
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n"; 
    
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  

  if (isset($_GET['page']) && ($_GET['page'] > 1)) $rows = $_GET['page'] * MAX_DISPLAY_RESULTS - MAX_DISPLAY_RESULTS; 
  $customers_query_raw = "select c.customers_firstname, c.customers_lastname, sum(ot.value / o.currency_value) as ordersum from " . TABLE_CUSTOMERS . " c, " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id) where c.customers_id = o.customers_id and ot.class = 'ot_total' group by c.customers_id order by ordersum DESC";
  $customers_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS, $customers_query_raw, $customers_query_numrows, 'c.customers_id');
// fix counted customers
  $customers_query_numrows = xos_db_query("select customers_id from " . TABLE_ORDERS . " group by customers_id");
  $customers_query_numrows = xos_db_num_rows($customers_query_numrows);

  $rows = 0;
  $customers_query = xos_db_query($customers_query_raw);
  $customers_array = array();
  while ($customers = xos_db_fetch_array($customers_query)) {
    $rows++;

    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }

    $customers_array[]=array('link_filename_customers' => xos_href_link(FILENAME_CUSTOMERS, 'search=' . $customers['customers_lastname']),
                             'rows' => $rows,
                             'firstname' => $customers['customers_firstname'],
                             'lastname' => $customers['customers_lastname'],    
                             'ordersum' => $currencies->format($customers['ordersum']));
  }
  
  $smarty->assign(array('customers' => $customers_array,
                        'nav_bar_number' => $customers_split->display_count($customers_query_numrows, MAX_DISPLAY_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS),
                        'nav_bar_result' => $customers_split->display_links($customers_query_numrows, MAX_DISPLAY_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'])));   

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'stats_customers');
  $output_stats_customers = $smarty->fetch(ADMIN_TPL . '/stats_customers.tpl');
  
  $smarty->assign('central_contents', $output_stats_customers);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
