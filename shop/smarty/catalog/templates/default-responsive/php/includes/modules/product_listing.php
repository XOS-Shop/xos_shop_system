<?php
////
// The HTML lazy image wrapper function
  function xos_lazy_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false;
    }

// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
    $image = '<img data-original="' . DIR_WS_CATALOG . xos_output_string($src) . '" alt="' . xos_output_string($alt) . '"';

    if (xos_not_null($alt)) {
      $image .= ' title=" ' . xos_output_string($alt) . ' "';
    }

    if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height)) ) {
      if ($image_size = @getimagesize(rawurldecode($src))) {
        if (empty($width) && xos_not_null($height)) {
          $ratio = $height / $image_size[1];
          $width = intval($image_size[0] * $ratio);
        } elseif (xos_not_null($width) && empty($height)) {
          $ratio = $width / $image_size[0];
          $height = intval($image_size[1] * $ratio);
        } elseif (empty($width) && empty($height)) {
          $width = $image_size[0];
          $height = $image_size[1];
        }
      } elseif (IMAGE_REQUIRED == 'false') {
        return false;
      }
    }

    if (xos_not_null($width) && xos_not_null($height)) {
      $image .= ' width="' . xos_output_string($width) . '" height="' . xos_output_string($height) . '"';
    }

    if (xos_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= ' />';

    return $image;
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

  $listing_split = new splitPageResultsBootstrap($listing_sql, $max_display, 'p.products_id');

  $table_heading_array = array();
  $table_heading_alt_array = array();
  $selected_none = true;
  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        $case = 'model';
        break;
      case 'PRODUCT_LIST_NAME':
        $lc_text = TABLE_HEADING_PRODUCTS;
        $case = 'name';
        break;
      case 'PRODUCT_LIST_INFO':
        $lc_text = TABLE_HEADING_INFO;
        $case = 'info';
        break;
        
      case 'PRODUCT_LIST_PACKING_UNIT':
        $lc_text = TABLE_HEADING_PACKING_UNIT;
        $case = 'packing_unit';
        break;        
                
      case 'PRODUCT_LIST_MANUFACTURER':
        $lc_text = TABLE_HEADING_MANUFACTURER;
        $case = 'manufacturer';
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        $case = 'price';
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $lc_text = TABLE_HEADING_QUANTITY;
        $case = 'quantity';
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $lc_text = TABLE_HEADING_WEIGHT;
        $case = 'weight';
        break;
      case 'PRODUCT_LIST_IMAGE':
        $lc_text = TABLE_HEADING_IMAGE;
        $case = 'image';
        break;
      case 'PRODUCT_LIST_BUY_NOW':
        $lc_text = TABLE_HEADING_BUY_NOW;
        $case = 'buy_now';
        break;
    }
//--------[Alternative] wenn hier aendern auch index.php, specials.php, advanced_search_and_results.php, und search_result.php aendern-----------
//    if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') ) {  
//-----------------------------------------------------------------------------------------------------
    if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') && ($column_list[$col] != 'PRODUCT_LIST_INFO') ) {
           
      $heading = $lc_text;
      
//      if($product_list_b) {
        $lc_text = '<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('page', 'info', 'sort', 'lnc', 'currency', 'tpl')) . 'page=1&sort=' . $col . ($_GET['sort'] == $col . 'a' ? 'd' : 'a')) . '" title=" ' . xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col || empty($_GET['sort']) ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading) . ' ">';        
        $lc_text .= (!empty($_GET['sort']) && substr($_GET['sort'], 0, 1) == $col ? (substr($_GET['sort'], 1, 1) == 'a' ? xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_asc_alternate.gif', xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading)) : xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_desc_alternate.gif', xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading))) : xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_asc_desc_alternate.gif', xos_output_string(TEXT_SORT_PRODUCTS . TEXT_ASCENDINGLY . TEXT_BY . $heading))) . $heading . '</a>';
        
        $table_heading_array[]=array('selected' => (!empty($_GET['sort']) && substr($_GET['sort'], 0, 1) == $col ? true : false),
                                     'text' => $lc_text,
                                     'case' => $case);                                                                          
// beginn alternative Sortierung fuer product_listing_b                                     
        $lc_text_alt = (!empty($_GET['sort']) && substr($_GET['sort'], 0, 1) == $col ? (substr($_GET['sort'], 1, 1) == 'a' ? xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_asc_alternate.gif') . $heading : xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_desc_alternate.gif') . $heading) : '<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('page', 'info', 'sort', 'lnc', 'currency', 'tpl')) . 'page=1&sort=' . $col . 'a') . '" title=" ' . xos_output_string(TEXT_SORT_PRODUCTS . TEXT_ASCENDINGLY . TEXT_BY . $heading) . ' ">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_asc_alternate.gif', xos_output_string(TEXT_SORT_PRODUCTS . TEXT_ASCENDINGLY . TEXT_BY . $heading)) . $heading . '</a>' . '<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('page', 'info', 'sort', 'lnc', 'currency', 'tpl')) . 'page=1&sort=' . $col . 'd') . '" title=" ' . xos_output_string(TEXT_SORT_PRODUCTS . TEXT_DESCENDINGLY . TEXT_BY . $heading) . ' "><br />' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_desc_alternate.gif', xos_output_string(TEXT_SORT_PRODUCTS . TEXT_DESCENDINGLY . TEXT_BY . $heading)) . $heading . '</a>');
           
        $table_heading_alt_array[]=array('selected' => (!empty($_GET['sort']) && substr($_GET['sort'], 0, 1) == $col ? true : false),
                                           'text' => $lc_text_alt);
                                                                                                               
        if(!empty($_GET['sort']) && substr($_GET['sort'], 0, 1) == $col) {        
          $lc_text_alt = (substr($_GET['sort'], 1, 1) == 'a' ? '<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('page', 'info', 'sort', 'lnc', 'currency', 'tpl')) . 'page=1&sort=' . $col . ($_GET['sort'] == $col . 'a' ? 'd' : 'a')) . '" title=" ' . xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading) . ' ">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_desc_alternate.gif', xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading)) . $heading . '</a>' : '<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('page', 'info', 'sort', 'lnc', 'currency', 'tpl')) . 'page=1&sort=' . $col . ($_GET['sort'] == $col . 'a' ? 'd' : 'a')) . '" title=" ' . xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading) . ' ">' . xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_asc_alternate.gif', xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading)) . $heading . '</a>');          
                                               
          array_unshift($table_heading_alt_array, array('selected' =>  false,
                                                          'text' => $lc_text_alt));                                             
        }
// ende alternative Sortierung fuer product_listing_b                                                                                               
//      } else {
//        $lc_text = '<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('page', 'info', 'sort', 'lnc', 'currency', 'tpl')) . 'page=1&sort=' . $col . ($_GET['sort'] == $col . 'a' ? 'd' : 'a')) . '" title=" ' . xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col || empty($_GET['sort']) ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading) . ' ">' . $heading;
//        $lc_text .= (!empty($_GET['sort']) && substr($_GET['sort'], 0, 1) == $col ? (substr($_GET['sort'], 1, 1) == 'a' ? xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_asc_default.gif', xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading)) : xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_desc_default.gif', xos_output_string(TEXT_SORT_PRODUCTS . ($_GET['sort'] == $col . 'd' || substr($_GET['sort'], 0, 1) != $col ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading))) : xos_image(DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/arrow_asc_desc_default.gif', xos_output_string(TEXT_SORT_PRODUCTS . TEXT_ASCENDINGLY . TEXT_BY . $heading))) . '</a>';      
//      }
    }
    
//    if(!$product_list_b) {
//      $table_heading_array[]=array('text' => $lc_text,
//                                   'case' => $case);
//    }
    
    if (!empty($_GET['sort']) && substr($_GET['sort'], 0, 1) == $col) $selected_none = false;                                                                                                      
  }

  if ($listing_split->number_of_rows > 0) {      
    $rows = 0;
    $table_outer_array = array();
    $listing_query = xos_db_query($listing_split->sql_query);
    while ($listing = xos_db_fetch_array($listing_query)) {
      $rows++;
      
      $products_prices = xos_get_product_prices($listing['products_price']);
      $products_tax_rate = xos_get_tax_rate($listing['products_tax_class_id']);
      $price_breaks = false;      
      $price_breaks_array = array();
      if(isset($products_prices[$customer_group_id][0])) {     
        $product_price = $currencies->display_price($products_prices[$customer_group_id][0]['regular'], $products_tax_rate);
        $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][0]['special'] > 0 ? $product_price_special = $currencies->display_price($products_prices[$customer_group_id][0]['special'], $products_tax_rate) : $product_price_special = '';      
        $sizeof = count($products_prices[$customer_group_id]);
        if ($sizeof > 2) {
          $price_breaks = true;
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
          $price_breaks = true;      
          $array_keys = array_keys($products_prices[0]);
          for ($count=2, $n=$sizeof; $count<$n; $count++) {
            $qty = $array_keys[$count];
            $price_breaks_array[]=array('qty' => $qty,
                                        'price_break' => $currencies->display_price($products_prices[0][$qty]['regular'], $products_tax_rate),
                                        'price_break_special' => $products_prices[0]['special_status'] == 1 && $products_prices[0][$qty]['special'] > 0 ? $currencies->display_price($products_prices[0][$qty]['special'], $products_tax_rate) : '');                                      
          }                                           
        } 
      }       

      $table_inner_array = array();
      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {

        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_MODEL':
            $table_inner_array[]=array('case' => 'model',
                                       'products_model' => $listing['products_model']);
            break;
          case 'PRODUCT_LIST_NAME':
            if (!empty($_GET['m'])) {
              $table_inner_array[]=array('case' => 'name',
                                         'products_name' => $listing['products_name'],
                                         'products_link' => xos_href_link(FILENAME_PRODUCT_INFO, 'm=' . $_GET['m'] . '&p=' . $listing['products_id']));
            } else {
              $table_inner_array[]=array('case' => 'name',
                                         'products_name' => $listing['products_name'],
                                         'products_link' => xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $listing['products_id']));
            }
            break;
          case 'PRODUCT_LIST_INFO':
            $table_inner_array[]=array('case' => 'info',
                                       'products_info' => $listing['products_info']);
            $smarty->assign('product_info', true);                           
            break;
          case 'PRODUCT_LIST_PACKING_UNIT':
            $table_inner_array[]=array('case' => 'packing_unit',
                                       'products_p_unit' => $listing['products_p_unit']);
            break;                      
          case 'PRODUCT_LIST_MANUFACTURER':
            $table_inner_array[]=array('case' => 'manufacturer',
                                       'manufacturers_name' => $listing['manufacturers_name'],
                                       'manufacturers_link' => xos_href_link(FILENAME_DEFAULT, 'm=' . $listing['manufacturers_id']));
            break;
          case 'PRODUCT_LIST_PRICE': 
            $popup_content_id = xos_get_delivery_times_values($listing['products_delivery_time_id'], 'popup_content_id');          
            $table_inner_array[]=array('case' => 'price',
                                       'price_breaks' => $price_breaks,
                                       'products_id' => $listing['products_id'],
                                       'products_delivery_time' => xos_get_delivery_times_values($listing['products_delivery_time_id']),
                                       'link_filename_popup_content_products_delivery_time' => $popup_content_id > 0 ? xos_href_link(FILENAME_POPUP_CONTENT, 'co=' . $popup_content_id . '&p=' . $listing['products_id'], $request_type) : '',
                                       'tax_description' => xos_get_products_tax_description($listing['products_tax_class_id'], $products_tax_rate),
                                       'price' => $product_price,
                                       'price_special' => $product_price_special,
                                       'price_breaks' => $price_breaks_array);
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $table_inner_array[]=array('case' => 'quantity',
                                       'products_quantity' => $listing['products_quantity'] > 0 ? $listing['products_quantity'] : '<span class="red-mark">' . $listing['products_quantity'] . '</span>');
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $table_inner_array[]=array('case' => 'weight',
                                       'products_weight' => $listing['products_weight']);
            break;
          case 'PRODUCT_LIST_IMAGE':
            $products_image_name = xos_get_product_images($listing['products_image']);
            if (!empty($_GET['m'])) {
              $table_inner_array[]=array('case' => 'image',
                                         'products_image_small' => xos_lazy_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($products_image_name['name']), $listing['products_name'], '', '', 'class="img-responsive center-block lazy" style="display: none;"') . '<noscript>' . xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($products_image_name['name']), $listing['products_name'], '', '', 'class="img-responsive center-block"') . '</noscript>',
                                         'products_image_medium' => xos_lazy_image(DIR_WS_IMAGES . 'products/medium/' . rawurlencode($products_image_name['name']), $listing['products_name'], '', '', 'class="img-responsive center-block lazy" style="display: none;"') . '<noscript>' . xos_image(DIR_WS_IMAGES . 'products/medium/' . rawurlencode($products_image_name['name']), $listing['products_name'], '', '', 'class="img-responsive center-block"') . '</noscript>',
                                         'products_link_image' => xos_href_link(FILENAME_PRODUCT_INFO, 'm=' . $_GET['m'] . '&p=' . $listing['products_id']));
            } else {
              $table_inner_array[]=array('case' => 'image',
                                         'products_image_small' => xos_lazy_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($products_image_name['name']), $listing['products_name'], '', '', 'class="img-responsive center-block lazy" style="display: none;"') . '<noscript>' . xos_image(DIR_WS_IMAGES . 'products/small/' . rawurlencode($products_image_name['name']), $listing['products_name'], '', '', 'class="img-responsive center-block"') . '</noscript>',
                                         'products_image_medium' => xos_lazy_image(DIR_WS_IMAGES . 'products/medium/' . rawurlencode($products_image_name['name']), $listing['products_name'], '', '', 'class="img-responsive center-block lazy" style="display: none;"') . '<noscript>' . xos_image(DIR_WS_IMAGES . 'products/medium/' . rawurlencode($products_image_name['name']), $listing['products_name'], '', '', 'class="img-responsive center-block"') . '</noscript>',
                                         'products_link_image' => xos_href_link(FILENAME_PRODUCT_INFO, 'p=' . $listing['products_id']));
            }
            $smarty->assign('product_image', true);
            break;
          case 'PRODUCT_LIST_BUY_NOW':
            $table_inner_array[]=array('case' => 'buy_now',
                                       'products_buy_form_begin' => xos_draw_form('cart_quantity_' . $rows, xos_href_link(basename($_SERVER['PHP_SELF']), xos_get_all_get_params(array('action')) . 'action=add_product', $request_type)),
                                       'form_name' => 'cart_quantity_' . $rows,
                                       'form_end' => '</form>',
                                       'label_for_products_input_quantity' => 'products_quantity_' . $listing['products_id'],
                                       'products_input_quantity' => xos_draw_input_field('products_quantity', '1','id="products_quantity_' . $listing['products_id'] . '" class="form-control input-quantity" maxlength="5"'),
                                       'products_hidden_field' => xos_draw_hidden_field('p', $listing['products_id'])); 
            break;
        }                                            
      }
      
      $table_outer_array[]=array('table_inner' => $table_inner_array);
      unset($price_breaks_array);      
      unset($table_inner_array);    
    }

    if (PREV_NEXT_BAR_LOCATION == '1' || PREV_NEXT_BAR_LOCATION == '3') { 
      $smarty->assign('nav_bar_top', true);  
    }

    if (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3') { 
      $smarty->assign('nav_bar_bottom', true);
    }

    $smarty->assign(array('listing' => true,
                          'selected_none' => $selected_none,
                          'table_heading' => $table_heading_array,
                          'table_heading_alt' => $table_heading_alt_array,
                          'nav_bar_number' => $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS),
                          'nav_bar_result' => '<nav><ul class="pagination">' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, xos_get_all_get_params(array('page', 'info', 'lnc', 'currency', 'tpl', 'x', 'y'))) . '</ul></nav>',
                          'table_data_list' => $table_outer_array));
                          
    if($product_list_b) {
      $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'product_listing_b');
      $output_product_listing = $smarty->fetch(SELECTED_TPL . '/includes/modules/product_listing_b.tpl');    
    } else {                      
//      $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'product_listing_a');
      $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'product_listing_b');      
      $output_product_listing = $smarty->fetch(SELECTED_TPL . '/includes/modules/product_listing_a.tpl');
    }
    
    $smarty->clearAssign(array('product_info',
                               'product_image',
                               'nav_bar_top',
                               'nav_bar_bottom',
                               'listing',
                               'selected_none',
                               'table_heading',
                               'nav_bar_number',
                               'nav_bar_result',
                               'table_data_list'));
                          
    $smarty->assign('product_listing', $output_product_listing); 
      
  } else { 
                                   
    $smarty->assign('text_no_products', TEXT_NO_PRODUCTS);
    
    if($product_list_b) {
      $output_product_listing = $smarty->fetch(SELECTED_TPL . '/includes/modules/product_listing_b.tpl');
    } else {
      $output_product_listing = $smarty->fetch(SELECTED_TPL . '/includes/modules/product_listing_a.tpl');
    } 
     
    $smarty->clearAssign('text_no_products');
    
    $smarty->assign('product_listing', $output_product_listing); 
           
  }
  return 'overwrite_all';
?>