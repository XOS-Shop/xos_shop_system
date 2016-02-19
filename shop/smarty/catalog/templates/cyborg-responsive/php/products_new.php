<?php
  class splitPageResultsBootstrap extends splitPageResults {

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

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_PRODUCTS_NEW);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_PRODUCTS_NEW, xos_get_all_get_params(array('lnc', 'cur', 'tpl', 'x', 'y'))));
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L3|cc_products_new|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['page'];
  }  
 
  if(!$smarty->isCached(SELECTED_TPL . '/products_new.tpl', $cache_id)){

    $products_new_query_raw = "select distinct p.products_id, p.products_delivery_time_id, pd.products_name, pd.products_p_unit, pd.products_info, p.products_model, p.products_quantity, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_added, mi.manufacturers_name from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on (p.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "'), " . TABLE_PRODUCTS_DESCRIPTION . " pd where c.categories_or_pages_status = '1' and p.products_id = p2c.products_id and c.categories_or_pages_id = p2c.categories_or_pages_id and p.products_status = '1' and p.products_date_added > '".date("Y-m-d", mktime(1, 1, 1, date("m"), date("d") - INTERVAL_DAYS_BACK, date("Y")))."' and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by p.products_date_added DESC, pd.products_name";
    $products_new_split = new splitPageResultsBootstrap($products_new_query_raw, MAX_DISPLAY_PRODUCTS_NEW, 'p.products_id');

    if ($products_new_split->number_of_rows > 0) {   
  
      $products_new_query = xos_db_query($products_new_split->sql_query);
      $products_new_array = array();
      while ($products_new = xos_db_fetch_array($products_new_query)) {
           
        $products_prices = xos_get_product_prices($products_new['products_price']);
        $products_tax_rate = xos_get_tax_rate($products_new['products_tax_class_id']);
        $price_breaks_array = array();
        if(isset($products_prices[$customer_group_id][0])) {     
          $product_price = $currencies->display_price($products_prices[$customer_group_id][0]['regular'], $products_tax_rate);
          $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][0]['special'] > 0 ? $product_price_special = $currencies->display_price($products_prices[$customer_group_id][0]['special'], $products_tax_rate) : $product_price_special = '';      
          $sizeof = count($products_prices[$customer_group_id]);
          if ($sizeof > 2) {
            $array_keys = array_keys($products_prices[$customer_group_id]);
            for ($count=2, $n=$sizeof; $count<$n; $count++) {
              $qty = $array_keys[$count];
              $price_breaks_array[]=array('qty' => $qty,
                                          'price_break' => $currencies->display_price($products_prices[$customer_group_id][$qty]['regular'], $products_tax_rate),
                                          'price_break_special' => $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][$qty]['special'] > 0 ? $currencies->display_price($products_prices[$customer_group_id][$qty]['special'], $products_tax_rate) : '');
            }       
          }            
        } else {      
          $product_price = $currencies->display_price($products_prices[0][0]['regular'], $products_tax_rate);
          $products_prices[0]['special_status'] == 1 && $products_prices[0][0]['special'] > 0 ? $product_price_special = $currencies->display_price($products_prices[0][0]['special'], $products_tax_rate) : $product_price_special = '';            
          $sizeof = count($products_prices[0]);
          if ($sizeof > 2) {      
            $array_keys = array_keys($products_prices[0]);
            for ($count=2, $n=$sizeof; $count<$n; $count++) {
              $qty = $array_keys[$count];
              $price_breaks_array[]=array('qty' => $qty,
                                          'price_break' => $currencies->display_price($products_prices[0][$qty]['regular'], $products_tax_rate),
                                          'price_break_special' => $products_prices[0]['special_status'] == 1 && $products_prices[0][$qty]['special'] > 0 ? $currencies->display_price($products_prices[0][$qty]['special'], $products_tax_rate) : '');                                      
            }                                           
          } 
        }
        
        $product_image = xos_get_product_images($products_new['products_image']);
        $popup_content_id = xos_get_delivery_times_values($products_new['products_delivery_time_id'], 'popup_content_id'); 

        $products_new_array[]=array('link_filename_product_info' => xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $products_new['products_id']),
                                    'href_buy_now' => xos_href_link(FILENAME_PRODUCTS_NEW, xos_get_all_get_params(array('action')) . 'action=buy_now&p=' . $products_new['products_id']),
                                    'date_added' => xos_date_long($products_new['products_date_added']),
                                    'image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($product_image['name']), $products_new['products_name'], '', '', 'class="img-responsive"'),
                                    'td_width_img' => SMALL_PRODUCT_IMAGE_MAX_WIDTH + 10,
                                    'manufacturer' => $products_new['manufacturers_name'],
                                    'tax_description' => xos_get_products_tax_description($products_new['products_tax_class_id'], $products_tax_rate),
                                    'products_delivery_time' => xos_get_delivery_times_values($products_new['products_delivery_time_id']),
                                    'link_filename_popup_content_products_delivery_time' => $popup_content_id > 0 ? xos_href_link(FILENAME_POPUP_CONTENT, 'co=' . $popup_content_id . '&p=' . $products_new['products_id'], $request_type) : '',                                                                     
                                    'price' => $product_price,
                                    'price_special' => $product_price_special,
                                    'price_breaks' => $price_breaks_array,
                                    'info' => $products_new['products_info'],
                                    'products_p_unit' => $products_new['products_p_unit'],
                                    'products_model' => $products_new['products_model'],
                                    'products_quantity' => $products_new['products_quantity'],
                                    'name' => $products_new['products_name']);
        unset($price_breaks_array);                              
      }
    
      if (PREV_NEXT_BAR_LOCATION == '1' || PREV_NEXT_BAR_LOCATION == '3') {
        $smarty->assign('nav_bar_top', true);
      }
    
      if (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3') {  
        $smarty->assign('nav_bar_bottom', true);
      }

      $smarty->assign('new_products', true);   
    }

    $smarty->assign(array('nav_bar_number' => $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW),
                          'nav_bar_result' => '<nav><ul class="pagination">' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'lnc', 'cur', 'tpl', 'x', 'y'))) . '</ul></nav>',
                          'interval_days_back' => INTERVAL_DAYS_BACK,
                          'products_new' => $products_new_array));
                        
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'products_new');
  }
  
  $output_products_new = $smarty->fetch(SELECTED_TPL . '/products_new.tpl', $cache_id);
  
  $smarty->assign('central_contents', $output_products_new);  
  
  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
  return 'overwrite_all';
?>