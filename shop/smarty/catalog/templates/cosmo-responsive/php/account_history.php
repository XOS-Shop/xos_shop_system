<?php
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->remove_current_page();
    $_SESSION['navigation']->set_snapshot();
    xos_redirect(xos_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  
  class SplitPageResultsBootstrap extends SplitPageResultsPDO {

/* class function display_links for Bootstrap pagination */
// display split-page-number-links
    function display_links($max_page_links, $parameters = '') {
      global $request_type;

      $display_links_string = '';

      if (xos_not_null($parameters) && (substr($parameters, -1) != '&')) $parameters .= '&';

// previous button
      if ($this->current_page_number > 1) {
        $display_links_string .= '<li><a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], $parameters . $this->page_name . '=' . ($this->current_page_number - 1), $request_type) . '" class="page-results" title=" ' . PREVNEXT_TITLE_PREVIOUS_PAGE . ' ">' . PREVNEXT_BUTTON_PREV . '</a></li>';
      } elseif ($this->number_of_pages != 1) {
        $display_links_string .= '<li class="disabled"><span><span aria-hidden="true">' . PREVNEXT_BUTTON_PREV . '</span></span></li>';
      }

// check if number_of_pages > $max_page_links
      $cur_window_num = intval($this->current_page_number / $max_page_links);
      if ($this->current_page_number % $max_page_links) $cur_window_num++;

      $max_window_num = intval($this->number_of_pages / $max_page_links);
      if ($this->number_of_pages % $max_page_links) $max_window_num++;

// previous window of pages
      if ($cur_window_num > 1) $display_links_string .= '<li><a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], $parameters . $this->page_name . '=' . (($cur_window_num - 1) * $max_page_links), $request_type) . '" class="page-results" title=" ' . sprintf(PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE, $max_page_links) . ' ">...</a></li>';

// page nn button
      for ($jump_to_page = 1 + (($cur_window_num - 1) * $max_page_links); ($jump_to_page <= ($cur_window_num * $max_page_links)) && ($jump_to_page <= $this->number_of_pages); $jump_to_page++) {
        if ($jump_to_page == $this->current_page_number) {
          if ($this->number_of_pages > 1) $display_links_string .= '<li class="active"><span>' . $jump_to_page . '<span class="sr-only">(current)</span></span></li>';
        } else {
          $display_links_string .= '<li><a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], $parameters . $this->page_name . '=' . $jump_to_page, $request_type) . '" class="page-results" title=" ' . sprintf(PREVNEXT_TITLE_PAGE_NO, $jump_to_page) . ' ">' . $jump_to_page . '</a></li>';
        }
      }

// next window of pages
      if ($cur_window_num < $max_window_num) $display_links_string .= '<li><a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], $parameters . $this->page_name . '=' . (($cur_window_num) * $max_page_links + 1), $request_type) . '" class="page-results" title=" ' . sprintf(PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE, $max_page_links) . ' ">...</a></li>';

// next button
      if ($this->current_page_number < $this->number_of_pages) {
        $display_links_string .= '<li><a href="' . xos_href_link($_SERVER['BASENAME_PHP_SELF'], $parameters . 'page=' . ($this->current_page_number + 1), $request_type) . '" class="page-results" title=" ' . PREVNEXT_TITLE_NEXT_PAGE . ' ">' . PREVNEXT_BUTTON_NEXT . '</a></li>';
      } elseif ($this->number_of_pages != 1) {
        $display_links_string .= '<li class="disabled"><span><span aria-hidden="true">' . PREVNEXT_BUTTON_NEXT . '</span></span></li>';
      } 

      return $display_links_string;
    }
  }  

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ACCOUNT_HISTORY);

  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  $orders_total = xos_count_customer_orders();

  if ($orders_total > 0) {
    $history_query_raw = "SELECT   o.orders_id,
                                   o.date_purchased,
                                   o.delivery_name,
                                   o.billing_name,
                                   s.orders_status_name
                          FROM     " . TABLE_ORDERS . " o,
                                   " . TABLE_ORDERS_TOTAL . " ot,
                                   " . TABLE_ORDERS_STATUS . " s
                          WHERE    o.customers_id = :customer_id
                          AND      o.orders_id = ot.orders_id
                          AND      ot.class = 'ot_total'
                          AND      o.orders_status = s.orders_status_id
                          AND      s.language_id = :languages_id
                          AND      s.public_flag = '1'
                          GROUP BY o.orders_id
                          ORDER BY o.orders_id DESC"; 
                          
    $history_param_array = array(':customer_id' => (int)$_SESSION['customer_id'],
                                 ':languages_id' => (int)$_SESSION['languages_id']); 

    $history_param_array = array(':customer_id' => (int)$_SESSION['customer_id'], ':languages_id' => (int)$_SESSION['languages_id']);
    $history_split = new SplitPageResultsBootstrap($history_query_raw, MAX_DISPLAY_ORDER_HISTORY, 'o.orders_id', $history_param_array);   
    $history_query = $DB->prepare($history_split->sql_query);
    $DB->perform($history_query, $history_split->sql_param);
        
    $orders_array = array();
    while ($history = $history_query->fetch()) {    
    
      $products_query = $DB->prepare
      (
       "SELECT Count(*) AS count
        FROM   " . TABLE_ORDERS_PRODUCTS . "
        WHERE  orders_id = :orders_id"
      );
      
      $DB->perform($products_query, array(':orders_id' => (int)$history['orders_id']));
            
      $products = $products_query->fetch();
      
      $oder_total_query = $DB->prepare
      (
       "SELECT   text
        FROM     " . TABLE_ORDERS_TOTAL . "
        WHERE    orders_id = :orders_id
        AND      class = 'ot_total'
        ORDER BY orders_total_id DESC
        LIMIT    1"
      );
      
      $DB->perform($oder_total_query, array(':orders_id' => (int)$history['orders_id']));
      
      $oder_total = $oder_total_query->fetch();

      if (xos_not_null($history['delivery_name'])) {
        $order_type = 'shipped_to';
        $order_name = $history['delivery_name'];
      } else {
        $order_type = 'billed_to';
        $order_name = $history['billing_name'];
      } 
      
      
      $orders_array[]=array('link_filename_account_history_info' => xos_href_link(FILENAME_ACCOUNT_HISTORY_INFO, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'order_id=' . $history['orders_id'], 'SSL'),
                            'order_id' => $history['orders_id'],
                            'order_status_name' => $history['orders_status_name'],
                            'date_purchased' => xos_date_long($history['date_purchased']),
                            'order_type' => $order_type,
                            'order_name' => xos_output_string_protected($order_name),
                            'products_count' => $products['count'],
                            'order_total' => strip_tags($oder_total['text']));      
    }
    
    $smarty->assign(array('orders' => true,
                          'nav_bar_number' => $history_split->display_count(TEXT_DISPLAY_NUMBER_OF_ORDERS),
                          'nav_bar_result' => '<nav><ul class="pagination">' . $history_split->display_links(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'lnc', 'cur', 'tpl', 'x', 'y'))) . '</ul></nav>'));
  }

  $smarty->assign(array('orders_array' => $orders_array,
                        'link_filename_account' => xos_href_link(FILENAME_ACCOUNT, '', 'SSL')));
                        
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'account_history');
  $output_account_history = $smarty->fetch(SELECTED_TPL . '/account_history.tpl');
  
  $smarty->assign('central_contents', $output_account_history);  
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
  return 'overwrite_all';