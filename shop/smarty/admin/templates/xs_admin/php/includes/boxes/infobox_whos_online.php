<?php
  $contents = array();
  if (isset($info)) {
    $heading_title = '<b>' . TABLE_HEADING_SHOPPING_CART . '</b>';

    if (STORE_SESSIONS == 'mysql') {
      $session_data = xos_db_query("select value from " . TABLE_SESSIONS . " WHERE sesskey = '" . $info . "'");
      $session_data = xos_db_fetch_array($session_data);
      $session_data = trim($session_data['value']);
    } else {
      if ( (file_exists(xos_session_save_path() . '/sess_' . $info)) && (filesize(xos_session_save_path() . '/sess_' . $info) > 0) ) {
        $session_data = file(xos_session_save_path() . '/sess_' . $info);
        $session_data = trim(implode('', $session_data));
      }
    }

    if ($length = strlen($session_data)) {     
        $start_id = strpos($session_data, 'customer_id|s');
        $start_cart = strpos($session_data, 'cart|O');
        $start_currency = strpos($session_data, 'currency|s');
        $start_languages_id = strpos($session_data, 'languages_id|s');
        $start_billto = strpos($session_data, 'billto|s');
        $start_sendto = strpos($session_data, 'sendto|s');
        $start_country = strpos($session_data, 'customer_country_id|s');
        $start_zone = strpos($session_data, 'customer_zone_id|s');
        $start_group_id = strpos($session_data, 'sppc_customer_group_id|s');
        $start_group_show_tax = strpos($session_data, 'sppc_customer_group_show_tax|i');
        $start_group_tax_exempt = strpos($session_data, 'sppc_customer_group_tax_exempt|i');      

      for ($i=$start_cart; $i<$length; $i++) {
        if ($session_data[$i] == '{') {
          if (isset($tag)) {
            $tag++;
          } else {
            $tag = 1;
          }
        } elseif ($session_data[$i] == '}') {
          $tag--;
        } elseif ( (isset($tag)) && ($tag < 1) ) {
          break;
        }
      }

      $session_data_id = substr($session_data, $start_id, (strpos($session_data, ';', $start_id) - $start_id + 1));
      $session_data_cart = substr($session_data, $start_cart, $i - $start_cart);
      $session_data_currency = substr($session_data, $start_currency, (strpos($session_data, ';', $start_currency) - $start_currency + 1));      
      $session_data_languages_id = str_replace('languages_id', 'costom_lang_id', substr($session_data, $start_languages_id, (strpos($session_data, ';', $start_languages_id) - $start_languages_id + 1)));    
      $session_data_billto = substr($session_data, $start_billto, (strpos($session_data, ';', $start_billto) - $start_billto + 1));
      $session_data_sendto = substr($session_data, $start_sendto, (strpos($session_data, ';', $start_sendto) - $start_sendto + 1));
      $session_data_country = substr($session_data, $start_country, (strpos($session_data, ';', $start_country) - $start_country + 1));
      $session_data_zone = substr($session_data, $start_zone, (strpos($session_data, ';', $start_zone) - $start_zone + 1));
      $session_data_group_id = substr($session_data, $start_group_id, (strpos($session_data, ';', $start_group_id) - $start_group_id + 1));
      $session_data_group_show_tax = substr($session_data, $start_group_show_tax, (strpos($session_data, ';', $start_group_show_tax) - $start_group_show_tax + 1));
      $session_data_group_tax_exempt = substr($session_data, $start_group_tax_exempt, (strpos($session_data, ';', $start_group_tax_exempt) - $start_group_tax_exempt + 1));
      
      if ($start_id !== false) session_decode($session_data_id);
      if ($start_currency !== false) session_decode($session_data_currency);      
      if ($start_languages_id !== false) session_decode($session_data_languages_id);      
      if ($start_billto !== false) session_decode($session_data_billto);
      if ($start_sendto !== false) session_decode($session_data_sendto);
      if ($start_country !== false) session_decode($session_data_country);
      if ($start_zone !== false) session_decode($session_data_zone);
      if ($start_cart !== false) session_decode($session_data_cart);
      if ($start_group_id !== false) session_decode($session_data_group_id);
      if ($start_group_show_tax !== false) session_decode($session_data_group_show_tax);
      if ($start_group_tax_exempt !== false) session_decode($session_data_group_tax_exempt);

      if (is_object($_SESSION['cart'])) {
        $products = $_SESSION['cart']->get_products();
        for ($i = 0, $n = sizeof($products); $i < $n; $i++) {
          $contents[] = array('text' => $products[$i]['quantity'] . ' x ' . $products[$i]['name']);
        }

        if (sizeof($products) > 0) {
          $contents[] = array('text' => xos_draw_separator('pixel_black.gif', '100%', '1'));
          $contents[] = array('text'  => '<div style="float: right">' . TEXT_SHOPPING_CART_SUBTOTAL . ' ' . $currencies->format($_SESSION['cart']->show_total($currencies->currencies[$_SESSION['currency']]['value']), 1, $_SESSION['currency']). '</div>');
        } else {
          $contents[] = array('text' => '&nbsp;');
        }
      }
    }
    unset($_SESSION['customer_id']);
    unset($_SESSION['cart']);
    unset($_SESSION['currency']);
    unset($_SESSION['costom_lang_id']);
    unset($_SESSION['billto']);
    unset($_SESSION['sendto']);
    unset($_SESSION['customer_country_id']);
    unset($_SESSION['customer_zone_id']);   
    unset($_SESSION['sppc_customer_group_id']);
    unset($_SESSION['sppc_customer_group_show_tax']);
    unset($_SESSION['sppc_customer_group_tax_exempt']);    
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_contents' => $contents));
                           
  $output_infobox_whos_online = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_whos_online.tpl');
  $smarty->clearAssign(array('info_box_heading_title', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_whos_online', $output_infobox_whos_online);
  return 'overwrite_all';
?>