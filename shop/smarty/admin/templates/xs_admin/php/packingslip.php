<?php
  $oID = xos_db_prepare_input($_GET['oID']);
  $orders_query = xos_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");

  include(DIR_WS_CLASSES . 'order.php');
  $order = new order($oID);

  $javascript = '<script type="text/javascript">'."\n".
                '/* <![CDATA[ */'."\n".
                'function resize() {'."\n".
                '  window.resizeTo(900, 750);'."\n".
                '   self.focus();'."\n".
                '}'."\n".
                '/* ]]> */'."\n".
                '</script>'."\n";  
  
  require(DIR_WS_INCLUDES . 'html_header.php');  

  $order_products_array = array();
  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {    
      $order_attributes_array = array();        
      for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {        
                
        $order_attributes_array[]=array('option_name' => $order->products[$i]['attributes'][$j]['option'],
                                        'option_value_name' => $order->products[$i]['attributes'][$j]['value']);       
      }
    }
      
    $order_products_array[]=array('qty' => $order->products[$i]['qty'],
                                  'model' => $order->products[$i]['model'],    
                                  'name' => $order->products[$i]['name'],
                                  'packaging_unit' => $order->products[$i]['packaging_unit'],
                                  'product_attributes' => $order_attributes_array);
                                
    unset($order_attributes_array);                                
  }

  $smarty->assign(array('store_name_address' => nl2br(STORE_NAME_ADDRESS),
                        'shop_logo' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/shop_logo.gif', STORE_NAME),
                        'customer_address' => xos_address_format($order->customer['format_id'], $order->customer, 1, '', '<br />'),
                        'delivery_address' => xos_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br />'),
                        'billing_address' => xos_address_format($order->billing['format_id'], $order->billing, 1, '', '<br />'),
                        'o_id' => $oID,
                        'c_id' => $order->customer['c_id'],
                        'customer_telephone' => $order->customer['telephone'],
                        'customer_email_address' => $order->customer['email_address'],
                        'payment_method' => $order->info['payment_method'],
                        'order_products' => $order_products_array));   

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'packingslip');
  
  $language_directory_query = xos_db_query("select directory from " . TABLE_LANGUAGES . " where use_in_id > '1' and directory = '" . $order->info['language_directory'] . "'");  
  if (xos_db_num_rows($language_directory_query)) {
    $smarty->configLoad(DIR_FS_SMARTY . 'catalog/languages/' . $order->info['language_directory'] . '.conf', 'order_info');
  }  
                                                    
  $smarty->display(ADMIN_TPL . '/packingslip.tpl');
  return 'overwrite_all';
?>