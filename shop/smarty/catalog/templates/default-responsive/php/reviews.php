<?php
  if (PRODUCT_REVIEWS_ENABLED != 'true') {
    xos_redirect(xos_href_link(FILENAME_DEFAULT), false);
  }

  class splitPageResultsBootstrap extends splitPageResults {

/* class function display_links for Bootstrap pagination */
// display split-page-number-links
    function display_links($max_page_links, $parameters = '') {
      global $request_type;

      $display_links_string = '';

      if (xos_not_null($parameters) && (substr($parameters, -1) != '&')) $parameters .= '&';

// previous button
      if ($this->current_page_number > 1) {
        $display_links_string .= '<li><a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . $this->page_name . '=' . ($this->current_page_number - 1), $request_type) . '" class="page-results" title=" ' . PREVNEXT_TITLE_PREVIOUS_PAGE . ' ">' . PREVNEXT_BUTTON_PREV . '</a></li>';
      } elseif ($this->number_of_pages != 1) {
        $display_links_string .= '<li class="disabled"><span><span aria-hidden="true">' . PREVNEXT_BUTTON_PREV . '</span></span></li>';
      }

// check if number_of_pages > $max_page_links
      $cur_window_num = intval($this->current_page_number / $max_page_links);
      if ($this->current_page_number % $max_page_links) $cur_window_num++;

      $max_window_num = intval($this->number_of_pages / $max_page_links);
      if ($this->number_of_pages % $max_page_links) $max_window_num++;

// previous window of pages
      if ($cur_window_num > 1) $display_links_string .= '<li><a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . $this->page_name . '=' . (($cur_window_num - 1) * $max_page_links), $request_type) . '" class="page-results" title=" ' . sprintf(PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE, $max_page_links) . ' ">...</a></li>';

// page nn button
      for ($jump_to_page = 1 + (($cur_window_num - 1) * $max_page_links); ($jump_to_page <= ($cur_window_num * $max_page_links)) && ($jump_to_page <= $this->number_of_pages); $jump_to_page++) {
        if ($jump_to_page == $this->current_page_number) {
          if ($this->number_of_pages > 1) $display_links_string .= '<li class="active"><span>' . $jump_to_page . '<span class="sr-only">(current)</span></span></li>';
        } else {
          $display_links_string .= '<li><a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . $this->page_name . '=' . $jump_to_page, $request_type) . '" class="page-results" title=" ' . sprintf(PREVNEXT_TITLE_PAGE_NO, $jump_to_page) . ' ">' . $jump_to_page . '</a></li>';
        }
      }

// next window of pages
      if ($cur_window_num < $max_window_num) $display_links_string .= '<li><a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . $this->page_name . '=' . (($cur_window_num) * $max_page_links + 1), $request_type) . '" class="page-results" title=" ' . sprintf(PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE, $max_page_links) . ' ">...</a></li>';

// next button
      if ($this->current_page_number < $this->number_of_pages) {
        $display_links_string .= '<li><a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . 'page=' . ($this->current_page_number + 1), $request_type) . '" class="page-results" title=" ' . PREVNEXT_TITLE_NEXT_PAGE . ' ">' . PREVNEXT_BUTTON_NEXT . '</a></li>';
      } elseif ($this->number_of_pages != 1) {
        $display_links_string .= '<li class="disabled"><span><span aria-hidden="true">' . PREVNEXT_BUTTON_NEXT . '</span></span></li>';
      } 

      return $display_links_string;
    }
  }

  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_REVIEWS);

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_REVIEWS, xos_get_all_get_params(array('language', 'currency', 'tpl', 'x', 'y'))));
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L3|cc_reviews|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'];
  }
     
  if(!$smarty->isCached(SELECTED_TPL . '/reviews.tpl', $cache_id)) {

    $reviews_query_raw = "select r.reviews_id, left(rd.reviews_text, 100) as reviews_text, r.reviews_rating, r.date_added, p.products_id, pd.products_name, p.products_image, r.customers_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where c.categories_or_pages_status = '1' and p.products_id = p2c.products_id and p2c.categories_or_pages_id = c.categories_or_pages_id and p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "' order by r.reviews_id DESC";
    $reviews_split = new splitPageResultsBootstrap($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS);

    if ($reviews_split->number_of_rows > 0) {

      $reviews_query = xos_db_query($reviews_split->sql_query);
      $reviews_array = array();
      while ($reviews = xos_db_fetch_array($reviews_query)) {
        
        $product_image = xos_get_product_images($reviews['products_image']);
          
        $reviews_array[]=array('link_filename_product_reviews_info' => xos_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'p=' . $reviews['products_id'] . '&r=' . $reviews['reviews_id']),
                                'date_added' => xos_date_long($reviews['date_added']),
                                'products_image' => xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($product_image['name']), $reviews['products_name'], '', '', 'class="img-responsive"'),
                                'td_width_img' => SMALL_PRODUCT_IMAGE_MAX_WIDTH + 10,
                                'reviews_rating' => $reviews['reviews_rating'],
                                'review_text' => xos_break_string(xos_output_string_protected($reviews['reviews_text']), 60, '-<br />'),
                                'stars_image' => xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/stars_' . $reviews['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])),
                                'customers_name' => xos_output_string_protected($reviews['customers_name']),
                                'products_name' => $reviews['products_name']);
      }
    
      if (PREV_NEXT_BAR_LOCATION == '1' || PREV_NEXT_BAR_LOCATION == '3') {
        $smarty->assign('nav_bar_top', true);    
      }
    
      if (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3') {
        $smarty->assign('nav_bar_bottom', true);  
      }    
    
      $smarty->assign('reviews', true);    
    }

    $smarty->assign(array('nav_bar_number' => $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS),
                          'nav_bar_result' => '<nav><ul class="pagination">' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'language', 'currency', 'tpl', 'x', 'y'))) . '</ul></nav>',
                          'reviews_array' => $reviews_array));
                        
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'reviews');
  }
  
  $output_reviews = $smarty->fetch(SELECTED_TPL . '/reviews.tpl', $cache_id); 
  
  $smarty->assign('central_contents', $output_reviews);  
  
  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
  return 'overwrite_all';
?>