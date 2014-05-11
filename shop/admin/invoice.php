<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : invoice.php
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
//              filename: invoice.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_ORDERS_INVOICE) == 'overwrite_all')) :
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
    $attributes_options_values_price = false;
    if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {    
      $order_attributes_array = array();        
      for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {        
        $options_values_price = '';
        if ($order->products[$i]['attributes'][$j]['price'] != 0) {
          $attributes_options_values_price = true;
          $options_values_price = $order->products[$i]['attributes'][$j]['price_formated'];
        }         
                
        $order_attributes_array[]=array('option_name' => $order->products[$i]['attributes'][$j]['option'],
                                        'option_value_name' => $order->products[$i]['attributes'][$j]['value'],
                                        'option_price' => $options_values_price,
                                        'option_price_prefix' => $order->products[$i]['attributes'][$j]['prefix']);        
      }
    }
      
    $order_products_array[]=array('qty' => $order->products[$i]['qty'],
                                  'model' => $order->products[$i]['model'],    
                                  'name' => $order->products[$i]['name'],
                                  'packaging_unit' => $order->products[$i]['packaging_unit'],
                                  'tax' => xos_display_tax_value($order->products[$i]['tax']),                                
                                  'price' => $order->products[$i]['price_formated'],
                                  'final_single_price' => $order->products[$i]['final_price_formated'],
                                  'final_price' => $order->products[$i]['total_price_formated'],
                                  'products_attributes_option_price' => $attributes_options_values_price,
                                  'product_attributes' => $order_attributes_array);
       
    unset($order_attributes_array);                                
  }    

  $order_totals_array = array();
  for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
           
    $order_totals_array[]=array('title' => $order->totals[$i]['title'],
                                'text' => $order->totals[$i]['text'],
                                'tax' => $order->totals[$i]['class'] == 'ot_shipping' || $order->totals[$i]['class'] == 'ot_loworderfee' || $order->totals[$i]['class'] == 'ot_cod_fee' ? xos_display_tax_value($order->totals[$i]['tax']) : -1);           
  }
  
  if (sizeof($order->info['tax_groups']) > 1) {  
    $smarty->assign('tax_groups', true);
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
                        'order_products' => $order_products_array,
                        'order_totals' => $order_totals_array));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'invoice');

  $language_directory_query = xos_db_query("select directory from " . TABLE_LANGUAGES . " where use_in_id > '1' and directory = '" . $order->info['language_directory'] . "'");  
  if (xos_db_num_rows($language_directory_query)) {
    $smarty->configLoad(DIR_FS_SMARTY . 'catalog/languages/' . $order->info['language_directory'] . '.conf', 'order_info');
  }
                                                    
  $smarty->display(ADMIN_TPL . '/invoice.tpl');
endif;  
?>
