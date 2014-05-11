<?php
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_PRODUCT_INFO);
  
  $add_header = '<script type="text/javascript" src="' . DIR_WS_CATALOG . DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL . '/jquery.elevateZoom-3.0.8.patch.min.js"></script>' . "\n" .
                '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'includes/general.js"></script>' . "\n\n" .
  
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n\n" .
                      
		'    $(document).ready(function(){' . "\n" .
                '      $("ul.descrip-tabs").each(function(){' . "\n" .
                '        $(this).show();' . "\n" .
                '        var $active, $content, $links = $(this).find("a");' . "\n" .
                '        $active = $links.first().addClass("active");' . "\n" .
                '        $content = $($active.attr("href"));' . "\n\n" .

                '        $links.not(":first").each(function () {' . "\n" .
                '          $($(this).attr("href")).hide();' . "\n" .
                '        });' . "\n\n" .

                '        $(this).on("click", "a", function(e){' . "\n" .
                '          $active.removeClass("active");' . "\n" .
                '          $content.hide();' . "\n" .
                '          $active = $(this);' . "\n" .
                '          $content = $($(this).attr("href"));' . "\n" .
                '          $active.addClass("active");' . "\n" .
                '          $content.show();' . "\n" .
                '          e.preventDefault();' . "\n" .
                '        });' . "\n" .
                '      });' . "\n" .
                '    });' . "\n\n" .                       
                      
                '/* ]]> */' . "\n" .
                '</script>' . "\n";  

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  


  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true') && !isset($_GET['noscript'])){
    $smarty->caching = 1;
    $cache_id = 'L3|cc_product_info|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_SESSION['sppc_customer_group_id'] . '-' . $_SESSION['sppc_customer_group_show_tax'] . '-' . $_SESSION['sppc_customer_group_tax_exempt'] . '-' . $_GET['cPath'] . '-' . $_GET['manufacturers_id'] . '-' . $_GET['products_id'] . '-' . @implode('_', $_POST['id']);
  }
     
  if(!$smarty->isCached(SELECTED_TPL . '/product_info.tpl', $cache_id)) {
  
    $product_check_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id, " . TABLE_PRODUCTS_DESCRIPTION . "  pd where c.categories_or_pages_status = '1' and p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'"); 
    $product_check = xos_db_fetch_array($product_check_query);   
  
    if (!$product_check['total'] < 1) {
    
      $product_info_query = xos_db_query("select p.products_id, pd.products_name, pd.products_p_unit, pd.products_description_tab_label, pd.products_description, pd.products_url, p.products_model, p.products_quantity, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.products_weight, p.manufacturers_id, p.attributes_quantity, p.attributes_combinations, p.attributes_not_updated from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
      $product_info = xos_db_fetch_array($product_info_query);
    
      $products_prices = xos_get_product_prices($product_info['products_price']);
      $products_tax_rate = xos_get_tax_rate($product_info['products_tax_class_id']);
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
    
      xos_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$_GET['products_id'] . "' and language_id = '" . (int)$_SESSION['languages_id'] . "'");
      
      $products_description_array = array();
      $description = preg_split("#<div[^>]*page-break-after[^>]*>.*?</div>#is" , stripslashes($product_info['products_description']));
      $tab_label = explode(',', $product_info['products_description_tab_label']);
      for ($i=0, $n=sizeof($tab_label); $i<$n; $i++) { 
        $products_description_array[] = array('tab_label' => trim($tab_label[$i]),
                                              'description' => $description[$i]);
      } 
    
      $smarty->assign(array('product_check' => true,
                            'products_name' => $product_info['products_name'],
                            'products_p_unit' => $product_info['products_p_unit'],
                            'products_model' => $product_info['products_model'],
                            'products_weight' => $product_info['products_weight'],
                            'products_quantity' => STOCK_CHECK == 'true' ? ($product_info['products_quantity'] > 0 ? $product_info['products_quantity'] : '<span class="red-mark">' . $product_info['products_quantity'] . '</span>') : '',
                            'products_price' => $product_price,
                            'products_price_special' => $product_price_special,
                            'products_price_breaks' => $price_breaks_array,
                            'products_tax_description' => xos_get_products_tax_description($product_info['products_tax_class_id'], $products_tax_rate),
                            'products_description' => $products_description_array));
    
      $products_image_name = xos_get_product_images($product_info['products_image'], 'all');
        
      if (xos_not_null($products_image_name)) {

        $pop_width = 0;
        $pop_height = 0;
        $small_height = 0;
        $small_width_total = 0;
        foreach ($products_image_name as $products_img_name){   
          if (count($products_image_name)>1) {		  
            $small_img = DIR_WS_IMAGES . 'products/small/' . $products_img_name['name'];
            $small_size = @GetImageSize("$small_img");		
            $small_width_total += $small_size[0] + 10;		
            if (($small_size[1] + 10) > $small_height) $small_height = $small_size[1] + 10;
          }    
          $popup_img = DIR_WS_IMAGES . 'products/large/' . $products_img_name['name'];		
          $pop_size = @GetImageSize("$popup_img");		
          if ($pop_size[0] > $pop_width) $pop_width = $pop_size[0];
          if ($pop_size[1] > $pop_height) $pop_height = $pop_size[1];
        }
        
        if ($small_width_total > $pop_width) $pop_width = $small_width_total;   

        $products_images_array = array();
        $i = 0;
        foreach($products_image_name as $products_img_name) {    
          $products_images_array[]=array('link_product_img' => xos_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id'] . '&img_name='. rawurlencode($products_img_name['name'])),
                                         'link_product_img_noscript' => xos_href_link(FILENAME_IMAGES_WINDOW, 'pID=' . $product_info['products_id'], 'NONSSL', true, false, false, false, false),
                                         'href_to_product_img_large' => xos_href_link(DIR_WS_IMAGES . 'products/large/' . rawurlencode($products_img_name['name']), '', 'NONSSL', false, false, false, false, false),
                                         'src_product_img_medium' => xos_href_link(DIR_WS_IMAGES . 'products/medium/' . rawurlencode($products_img_name['name']), '', 'NONSSL', false, false, false, false, false),
                                         'product_img_extra_small' => xos_image(DIR_WS_IMAGES . 'products/extra_small/' . rawurlencode($products_img_name['name']), addslashes($product_info['products_name'])),
                                         'i' => $i);                              
          $i++;                                                                                                                   
        }
        $smarty->assign(array('box_width' => (int)($pop_width + 50),
                              'box_height' => (int)($pop_height + $small_height + 55),
                              'products_images' => $products_images_array));    
                                 
      }

      if (xos_has_product_attributes((int)$_GET['products_id'])) {

        xos_not_null($product_info['attributes_combinations']) ? $combinations_string = $product_info['attributes_combinations'] : $combinations_string = '';
        $attributes_quantity = xos_get_attributes_quantity($product_info['attributes_quantity']);
        
        if (xos_not_null($attributes_quantity) && $combinations_string != '' && STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
          $combination_elements = explode('|', $combinations_string);
                              
          for ($i=0, $n=sizeof($combination_elements); $i<$n; $i++) {
            if ($attributes_quantity[$combination_elements[$i]] < 1) unset($combination_elements[$i]);
          }
          
          ksort($combination_elements);
          $combinations_string = implode('|', $combination_elements);
          $combinations_string .= '|'; 
        }             
      
        $combi_str = '';
        $comb_str = '';   
        $product_options_array = array();
    
        $products_options_name_query = xos_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$_SESSION['languages_id'] . "' order by patrib.options_sort_order, popt.products_options_id");
        while ($products_options_name = xos_db_fetch_array($products_options_name_query)) {
        
          if (is_array($_POST['id'])) {
            $selected_attribute = $_POST['id'][$products_options_name['products_options_id']];
          } else if (isset($_GET['id_'. $products_options_name['products_options_id']])) {         
            $selected_attribute = $_GET['id_'. $products_options_name['products_options_id']];
          } else if (isset($_SESSION['cart']->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']])) {
            $selected_attribute = $_SESSION['cart']->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']];
          } else {
            $selected_attribute = false;
          }   
       
          $flag == false ? $comb_str = $combi_str .= $c_str : $comb_str = $combi_str;
          $flag = false;
          $c_str = '';
          $selected = false;
          $products_options_noscript_array = array();
          $products_options_array = array();
          $products_options_query = xos_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_sort_order, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$_GET['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$_SESSION['languages_id'] . "' order by pa.options_values_sort_order, pov.products_options_values_name");
          while ($products_options = xos_db_fetch_array($products_options_query)) {

            $pos = strpos($combinations_string, $comb_str . $products_options_name['products_options_id'] . ',' . $products_options['products_options_values_id']);
            
            if ($pos === false && $selected_attribute == $products_options['products_options_values_id']) $selected_attribute = false;
 
            if ($pos !== false || $combinations_string == '') {
              if ($c_str == '') $c_str = $products_options_name['products_options_id'] . ',' . $products_options['products_options_values_id'] . '_';
              $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);        
              
              if (sizeof($products_options_array) == 1) $products_options_noscript_selected_string = '<span class="option-selected">' . $products_options['products_options_values_name'] . ($products_options['options_values_price'] != '0' ? ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], $products_tax_rate) .') ' : '') . '</span><br />' . xos_draw_hidden_field('id[' . $products_options_name['products_options_id'] . ']', $products_options['products_options_values_id']);
              
              if ($selected_attribute == $products_options['products_options_values_id']) {
                $products_options_noscript_array[] = '<span class="option-selected">' . $products_options['products_options_values_name'] . ($products_options['options_values_price'] != '0' ? ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], $products_tax_rate) .') ' : '') . '</span><br />' . xos_draw_hidden_field('id[' . $products_options_name['products_options_id'] . ']', $products_options['products_options_values_id']);
                $selected = true;
              } else {
                $products_options_noscript_array[] = '<a class="option-link" href="' . xos_href_link(FILENAME_PRODUCT_INFO, xos_get_all_get_params(array('action', 'id_' . $products_options_name['products_options_id'], 'noscript')) . 'id_' . $products_options_name['products_options_id'] . '=' . $products_options['products_options_values_id'] . '&noscript=1') . '">' . $products_options['products_options_values_name'] . ($products_options['options_values_price'] != '0' ? ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], $products_tax_rate) .') ' : '') . '</a><br />';
              }
              
              if ($products_options['options_values_price'] != '0') {
                $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], $products_tax_rate) .') ';
              }
              
              if ($flag == false) {
                if ($selected_attribute == false) {
                  $combi_str .= $products_options_name['products_options_id'] . ',' . $products_options['products_options_values_id'] . '_';
                  $flag = true;
                } elseif ($selected_attribute == $products_options['products_options_values_id']) {
                  $combi_str .= $products_options_name['products_options_id'] . ',' . $products_options['products_options_values_id'] . '_';
                  $flag = true;
                }                
              }              
            }                                  
          }
          
          if ($selected == false) $products_options_noscript_array[0] = $products_options_noscript_selected_string; 
          
          $products_options_list_noscript = implode($products_options_noscript_array);
                  
          if (xos_not_null($products_options_array)) {
            $product_options_array[]=array('products_options_name' => $products_options_name['products_options_name'],
                                           'products_options_list_noscript' => $products_options_list_noscript,
                                           'products_options_pull_down' => xos_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute, 'onchange="updateOptions(\'' . xos_href_link(FILENAME_UPDATE_OPTIONS, 'products_id=' . xos_get_prid($_GET['products_id']), 'NONSSL', true, false) . '\')"')); 
//                                           'products_options_pull_down' => xos_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute, 'onchange="change_action(this.form); this.form.submit();"'));
          }                                             
        }
        
        $jscript_op = '<script type="text/javascript">' . "\n" .
                      '/* <![CDATA[ */' . "\n\n" .
                
//                      '    function change_action(the_form) {' . "\n" .                
//                      '      the_form.action = "' . str_replace('&amp;', '&', xos_href_link(FILENAME_PRODUCT_INFO, xos_get_all_get_params(array('action')))) . '";' . "\n" .  
//                      '    }' . "\n\n" .
                   
                      '    var http_request = false;' . "\n\n" .

                      '    function updateOptions(url,serialized_attributes) {' . "\n\n" .
                          
                      '      var serialized_options = "";' . "\n\n" . 
                      
                      '      if(typeof(serialized_attributes) == "undefined"){' . "\n" .
                      '        for (var i = 0; i < document.getElementsByTagName("select").length; i++) {' . "\n" .
                      '          if(document.getElementsByTagName("select")[i].form.name == "cart_quantity") {' . "\n" .
                      '            option_name = document.getElementsByTagName("select")[i].name;' . "\n" .
                      '            selected_options_value_id = document.getElementsByTagName("select")[i].options[document.getElementsByTagName("select")[i].selectedIndex].value;' . "\n" .
                      '            serialized_options += option_name + "=" + selected_options_value_id + "&";' . "\n" .
//                      '            alert(encodeURI(serialized_options));' . "\n" .
                      '          }' . "\n" .
                      '        }' . "\n" .
                      '      } else {' . "\n" .
                      '        serialized_options = serialized_attributes;' . "\n" .
                      '      }' . "\n\n" .  
                      
                      '      http_request = false;' . "\n\n" .

                      '      if (window.XMLHttpRequest) { // Mozilla, Safari,...' . "\n" .
                      '        http_request = new XMLHttpRequest();' . "\n" .
                      '        if (http_request.overrideMimeType) {' . "\n" .
                      '          http_request.overrideMimeType("text/html");' . "\n" .
                      '        }' . "\n" .
                      '      } else if (window.ActiveXObject) { // IE' . "\n" .
                      '        try {' . "\n" .
                      '          http_request = new ActiveXObject("Msxml2.XMLHTTP");' . "\n" .
                      '        } catch (e) {' . "\n" .
                      '          try {' . "\n" .
                      '            http_request = new ActiveXObject("Microsoft.XMLHTTP");' . "\n" .
                      '          } catch (e) {}' . "\n" .
                      '        }' . "\n" .
                      '      }' . "\n\n" .

                      '      if (!http_request) {' . "\n" .
                      '        alert("Ende : Kann keine XMLHTTP-Instanz erzeugen");' . "\n" .
                      '        return false;' . "\n" .
                      '      }' . "\n" .
                      '      http_request.onreadystatechange = response_processing;' . "\n" .
                      '      http_request.open("POST", url, true);' . "\n" .
                      '      http_request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");' . "\n" .
                      '      http_request.send(encodeURI(serialized_options));' . "\n\n" .

                      '    }' . "\n\n" .

                      '    function response_processing() {' . "\n" .
                      '      if (http_request.readyState == 1) {' . "\n" .
                      '        document.getElementById("options").style.visibility = "hidden";' . "\n" .
                      '        document.getElementById("loading").style.visibility = "visible";' . "\n" .                      
                      '        document.getElementById("products_quantity").style.visibility = "hidden";' . "\n" .
                      '        document.getElementById("add_to_cart").style.visibility = "hidden";' . "\n" .                                                                   
                      '      } else if (http_request.readyState == 4) {' . "\n" .
                      '        if (http_request.status == 200) {' . "\n" .
//                      '            alert(http_request.responseText);' . "\n" .
                      '          document.getElementById("options").innerHTML = http_request.responseText;' . "\n" .
                      '          document.getElementById("options").style.visibility = "visible";' . "\n" .
                      '          document.getElementById("loading").style.visibility = "hidden";' . "\n" .                      
                      '          document.getElementById("products_quantity").style.visibility = "visible";' . "\n" . 
                      '          document.getElementById("add_to_cart").style.visibility = "visible";' . "\n" .                                           
                      '        } else {' . "\n" .
                      '          alert("Bei dem Request ist ein Problem aufgetreten.");' . "\n" .
                      '        }' . "\n" .
                      '      }' . "\n" .
                      '    }' . "\n\n" .

                      '    function getOptionsList(url) {' . "\n\n" .

                      '      if (typeof(isLoaded) != "undefined" && isLoaded == true) {' . "\n" .                               
                      '          toggle("box_products_options_overview");' . "\n" .                                            
                      '      } else {' . "\n\n" .                       

                      '        http_request = false;' . "\n\n" .

                      '        if (window.XMLHttpRequest) { // Mozilla, Safari,...' . "\n" .
                      '            http_request = new XMLHttpRequest();' . "\n" .
                      '            if (http_request.overrideMimeType) {' . "\n" .
                      '                http_request.overrideMimeType("text/html");' . "\n" .
                      '            }' . "\n" .
                      '        } else if (window.ActiveXObject) { // IE' . "\n" .
                      '            try {' . "\n" .
                      '                http_request = new ActiveXObject("Msxml2.XMLHTTP");' . "\n" .
                      '            } catch (e) {' . "\n" .
                      '                try {' . "\n" .
                      '                    http_request = new ActiveXObject("Microsoft.XMLHTTP");' . "\n" .
                      '                } catch (e) {}' . "\n" .
                      '            }' . "\n" .
                      '        }' . "\n\n" .

                      '        if (!http_request) {' . "\n" .
                      '            alert("Ende : Kann keine XMLHTTP-Instanz erzeugen");' . "\n" .
                      '            return false;' . "\n" .
                      '        }' . "\n" .
                      '        http_request.onreadystatechange = response_processing_list;' . "\n" .
                      '        http_request.open("GET", url, true);' . "\n" .
                      '        http_request.send(null);' . "\n\n" .
                                                  
                      '      }' . "\n\n" .
                      
                      '    }' . "\n\n" .                   
                                      
                      '    function response_processing_list() {' . "\n" .
                      '      if (http_request.readyState == 1) {' . "\n" .
                      '        $("#loading_list").show(1);' . "\n" .                                                                                        
                      '      } else if (http_request.readyState == 4) {' . "\n" .
                      '        if (http_request.status == 200) {' . "\n" .
//                      '            alert(http_request.responseText);' . "\n" .
                      '          document.getElementById("box_products_options_overview").innerHTML = http_request.responseText;' . "\n" .
                      '          document.getElementById("loading_list").style.display = "none";' . "\n" .
                      '          isLoaded = true;' . "\n" .                      
                      '          toggle("box_products_options_overview");' . "\n" .                                          
                      '        } else {' . "\n" .
                      '          alert("Bei dem Request ist ein Problem aufgetreten.");' . "\n" .
                      '        }' . "\n" .
                      '      }' . "\n" .
                      '    }' . "\n\n" .                                      
                      
                      '    function getAbsoluteX (elm) {' . "\n" .
                      '      var x = 0;' . "\n" .
                      '      if (elm && typeof elm.offsetParent != "undefined") {' . "\n" .
                      '        while (elm && typeof elm.offsetLeft == "number") {' . "\n" .
                      '          x += elm.offsetLeft;' . "\n" .
                      '          elm = elm.offsetParent;' . "\n" .
                      '        }' . "\n" .
                      '      }' . "\n" .
                      '      return x;' . "\n" .
                      '    }' . "\n\n" . 
                      
                      '    function toggle(targetId) {' . "\n" .
                      '      var elem = document.getElementById(targetId);' . "\n" .                      
                      '      if (elem.style.display == "none"){' . "\n" .
                      '        elem.style.display="block";' . "\n" .                      
                      '        var x = getAbsoluteX(elem);' . "\n" . 
                      '        elem.style.display="none";' . "\n" .                                                                                       
                      '        if (x < 0){' . "\n" .
                      '          oldRightValue = elem.style.right;' . "\n" .                                             
                      '          $("#"+targetId).css({"right" : x+"px"}).show(1);' . "\n" .
                      '        } else {' . "\n" . 
                      '          $("#"+targetId).show(1);' . "\n" . 
                      '        }' . "\n" .                        
                      '      } else {' . "\n" .              
                      '        if(typeof(oldRightValue) != "undefined" && oldRightValue != ""){' . "\n" .                                             
                      '          elem.style.right=oldRightValue;' . "\n" .
                      '        }' . "\n" .
                      '        elem.style.display="none";' . "\n" .                                             
                      '      }' . "\n" .                    
                      '    }' . "\n\n" . 

                      '    function toggleByClassName(targetClass) {' . "\n" .
                      '      var allElems = document.getElementsByTagName("span");' . "\n" .
                      '      for (var i = 0; i < allElems.length; i++) {' . "\n" .
                      '        var thisElem = allElems[i];' . "\n" .
                      '        if (thisElem.className && thisElem.className == targetClass) {' . "\n" .                      
                      '          if (thisElem.style.display == "none"){' . "\n" .
                      '            thisElem.style.display = "";' . "\n" .
                      '          } else {' . "\n" .
                      '            thisElem.style.display = "none";' . "\n" .
                      '          }' . "\n" .                                               
                      '        }' . "\n" .
                      '      }' . "\n" .                   
                      '    }' . "\n\n" .                    
                      
                      '/* ]]> */' . "\n" .
                      '</script>' . "\n";                                

        if (xos_not_null($attributes_quantity) && STOCK_CHECK == 'true') {
          if ($flag == false) $combi_str .= $c_str;
          $att_qty = $attributes_quantity[substr($combi_str, 0, -1)];
          $smarty->assign('qty_for_these_options', $att_qty > 0 ? $att_qty : '<span class="red-mark">' . $att_qty . '</span>');                
        } 

        $smarty->assign(array('link_options_noscript' => xos_href_link(FILENAME_OPTIONS_WINDOW, 'products_id=' . $product_info['products_id'] . '&products_name=' . urlencode($product_info['products_name'])),
                              'get_otions_list' => 'getOptionsList(\'' . xos_href_link(FILENAME_OPTIONS_LIST, 'products_id=' . xos_get_prid($_GET['products_id']), 'NONSSL', true, false) . '\');',
                              'products_options' => $product_options_array));           
      }
        
      $reviews_query = xos_db_query("select count(*) as count from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.products_id = '" . (int)$_GET['products_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'");
      $reviews = xos_db_fetch_array($reviews_query);
    
      if ($reviews['count'] > 0) {    
        $smarty->assign('reviews_count', $reviews['count']);
      }

      if (xos_not_null($product_info['products_url'])) {    
        $smarty->assign('link_products_url', xos_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false));
      }

      if ($product_info['products_date_available'] > 0) {    
        $smarty->assign('products_date_available', xos_date_long($product_info['products_date_available']));
      } else {    
        $smarty->assign('products_date_added', xos_date_long($product_info['products_date_added']));
      }
      
      if (PRODUCT_REVIEWS_ENABLED == 'true') {    
        $smarty->assign('link_filename_product_reviews', xos_href_link(FILENAME_PRODUCT_REVIEWS, xos_get_all_get_params(array('language', 'currency', 'tpl'))));
      }       
    
      $smarty->assign(array('input_products_quantity' => xos_draw_input_field('products_quantity', '1','id="products_quantity" size="3"'),
                            'hidden_field_products_id' => xos_draw_hidden_field('products_id', $product_info['products_id']),
                            'javascript' => $jscript_op,
                            'form_begin' => xos_draw_form('cart_quantity', xos_href_link(FILENAME_PRODUCT_INFO, xos_get_all_get_params(array('action')) . 'action=add_product')),
                            'form_end' => '</form>'));
                          
      $smarty->caching = 0; 
              
      include(DIR_WS_MODULES . FILENAME_XSELL_PRODUCTS);
      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
   
      if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true') && !isset($_GET['noscript'])){
        $smarty->caching = 1;
      }
    }
    
    $smarty->assign('link_filename_default', xos_href_link(FILENAME_DEFAULT));
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'product_info');
  
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
    
  $output_product_info = $smarty->fetch(SELECTED_TPL . '/product_info.tpl', $cache_id); 
                          
  $smarty->assign('central_contents', $output_product_info);  
  
  $smarty->caching = 0;

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
  return 'overwrite_all';
?>