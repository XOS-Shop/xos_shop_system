<?php
  if (PRODUCT_REVIEWS_ENABLED != 'true') {
    xos_redirect(xos_href_link(FILENAME_DEFAULT), false);
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

  $product_info_query = $DB->prepare
  (
   "SELECT p.products_id,
           p.products_model,
           p.products_quantity,
           p.products_image,
           p.products_price,
           p.products_tax_class_id,
           pd.products_name,
           pd.products_p_unit
    FROM   " . TABLE_PRODUCTS . " p,
           " . TABLE_PRODUCTS_DESCRIPTION . " pd,
           " . TABLE_CATEGORIES_OR_PAGES . " c,
           " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
    WHERE  c.categories_or_pages_status = '1'
    AND    p.products_id = p2c.products_id
    AND    p2c.categories_or_pages_id = c.categories_or_pages_id
    AND    p.products_id = :p
    AND    p.products_status = '1'
    AND    p.products_id = pd.products_id
    AND    pd.language_id = :languages_id"
  );

  $DB->perform($product_info_query, array(':p' => (int)$_GET['p'], ':languages_id' => (int)$_SESSION['languages_id']));
  
  if ($product_info_query->rowCount() < 1) {
    xos_redirect(xos_href_link(FILENAME_REVIEWS));
  }


  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_PRODUCT_REVIEWS);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_PRODUCT_REVIEWS, xos_get_all_get_params(array('lnc', 'cur', 'tpl', 'x', 'y'))));

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php'); 

  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L3|cc_product_reviews|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['c'] . '-' . $_GET['m'] . '-' . $_GET['p'];
  }
     
  if(!$smarty->isCached(SELECTED_TPL . '/product_reviews.tpl', $cache_id)) {

    $product_info = $product_info_query->fetch();

          
    $reviews_query_raw = "SELECT   r.reviews_id,
                          LEFT     (rd.reviews_text, 100) AS reviews_text,
                                   r.reviews_rating,
                                   r.date_added,
                                   r.customers_name
                          FROM     " . TABLE_REVIEWS . " r,
                                   " . TABLE_REVIEWS_DESCRIPTION . " rd
                          WHERE    r.products_id = :products_id
                          AND      r.reviews_id = rd.reviews_id
                          AND      rd.languages_id = :languages_id
                          ORDER BY r.reviews_id DESC";
 
    $reviews_param_array[':products_id'] = (int)$product_info['products_id'];
    $reviews_param_array[':languages_id'] = (int)$_SESSION['languages_id'];

    $reviews_split = new SplitPageResultsBootstrap($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS, '*', $reviews_param_array);   
    $reviews_query = $DB->prepare($reviews_split->sql_query);
    $DB->perform($reviews_query, $reviews_split->sql_param);        

    if ($reviews_split->number_of_rows > 0) { // Anzahl der Detansaetze total
//  if ($reviews_query->rowCount() > 0) { // Anzahl der Detansaetze fuer diese Seite        
   
      $product_reviews_array = array();
      while ($reviews = $reviews_query->fetch()) {
            
        $product_reviews_array[]=array('link_filename_product_reviews_info' => xos_href_link(FILENAME_PRODUCT_REVIEWS_INFO, xos_get_all_get_params(array('lnc', 'cur', 'tpl')) . 'r=' . $reviews['reviews_id']),
                                       'date_added' => xos_date_long($reviews['date_added']),
                                       'reviews_rating' => $reviews['reviews_rating'],
                                       'review_text' => xos_break_string(xos_output_string_protected($reviews['reviews_text']), 60, '-<br />'),
                                       'stars_image' => xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/stars_' . $reviews['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])),
                                       'customers_name' => xos_output_string_protected($reviews['customers_name']));
      }
    
      if (PREV_NEXT_BAR_LOCATION == '1' || PREV_NEXT_BAR_LOCATION == '3') {    
        $smarty->assign('nav_bar_top', true);
      }

      if (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3') {
        $smarty->assign('nav_bar_bottom', true);  
      }  

      $smarty->assign(array('product_reviews_array' => $product_reviews_array,
                            'product_reviews' => true));
    }
    
    $products_image_name = xos_get_product_images($product_info['products_image']);

    if (xos_not_null($products_image_name)) {
      
      $smarty->assign(array('product_img' => xos_image(DIR_WS_IMAGES . 'products/medium/' . rawurlencode($products_image_name['name']), addslashes($product_info['products_name']), '', '', 'class="img-responsive"')));
    }

    $smarty->assign(array('products_name' => $product_info['products_name'], 
                          'products_model' => $product_info['products_model'],
                          'link_filename_product_reviews_write' => xos_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, xos_get_all_get_params(array('lnc', 'cur', 'tpl', 'rmp')), 'SSL'),
                          'nav_bar_number' => $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS),
                          'nav_bar_result' => '<nav><ul class="pagination">' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'lnc', 'cur', 'tpl', 'x', 'y'))) . '</ul></nav>'));
                        
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'product_reviews');
  }

  // link_back will not be cached (nocache)  
  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';    
    $smarty->assign('link_back', xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']), true);
  } else {  
    $smarty->assign('link_back', 'javascript:history.go(-1)', true);
  } 
  
  $output_product_reviews = $smarty->fetch(SELECTED_TPL . '/product_reviews.tpl', $cache_id);
  
  $smarty->assign('central_contents', $output_product_reviews);  
  
  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
  return 'overwrite_all';